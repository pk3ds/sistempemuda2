<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Jobs\WhatsappBlastingProcess;
use App\Models\CheckIn;
use App\Models\WhatsappBatches;
use App\Models\WhatsappNumber;
use Illuminate\Bus\Batch;
use Illuminate\Bus\BatchRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Bus;
use App\Models\User;
use App\BatchHandlers\WhatsappBatchHandler;

class WhatsappController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $whatsappNumbers = WhatsappNumber::with([
      'users',
      'first_whatsappBatches',
    ])->get();

    return Inertia::render('Whatsapp/Index', [
      'whatsappNumber' => $whatsappNumbers,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
{
    $whatsappNumber = WhatsappNumber::where('id', $request->number)->firstOrFail();
    $increaseTimeLimit = set_time_limit(0);
    
    // Construct base API URL
    $baseUrl = $whatsappNumber->address 
        ? "192.168.{$whatsappNumber->address}" 
        : env('WHATSAPP_API');
    
    // Ensure port is added
    $baseUrl = $baseUrl . ':' . $whatsappNumber->port;
    dd($baseUrl, $whatsappNumber);
    
    // Log the constructed URL
    \Log::info('Constructing WhatsApp API URL', [
        'base_url' => $baseUrl,
        'whatsapp_number' => $whatsappNumber->id
    ]);

    // Determine endpoint based on option
    $endpoint = match($request->option) {
        'message' => '/send/message',
        'photo' => '/send/image',
        'video' => '/send/video',
        default => throw new \InvalidArgumentException('Invalid option type')
    };
    
    // Construct final API URL
    $apiUrl = $baseUrl . $endpoint;
    
    \Log::info('Final API URL constructed', [
        'api_url' => $apiUrl
    ]);

    // Prepare message object
    $passObject = match($request->option) {
        'message' => ['message' => $request->message],
        'photo', 'video' => [
            'caption' => $request->message,
            'compress' => true
        ],
        default => throw new \InvalidArgumentException('Invalid option type')
    };

    // Handle file upload
    $uploadedFile = null;
    if ($request->file_upload) {
        $file = $request->file('file_upload');
        $filePath = $file->store('uploads', 'public');
        // Use storage_path helper to get the correct absolute path
        $uploadedFile = storage_path('app/public/' . $filePath);
        
        \Log::info('File uploaded', [
            'original_name' => $file->getClientOriginalName(),
            'stored_path' => $uploadedFile,
            'exists' => file_exists($uploadedFile)
        ]);
    }

    // Create batch handler
    $batchHandler = new WhatsappBatchHandler($uploadedFile);

    // Create and configure batch
    $batch = Bus::batch([])
        ->then([$batchHandler, 'then'])
        ->catch([$batchHandler, 'catch'])
        ->dispatch();

    // Create WhatsappBatches record
    $whatsappBatches = WhatsappBatches::create([
        'whatsapp_number_id' => $whatsappNumber->id,
        'job_batches_id' => $batch->id,
        'isActive' => true,
    ]);

    // Add jobs to batch based on personal/group sending
    if (!$request->array_number) {
        // Get groups
        $groupsResponse = Http::get($baseUrl . '/user/my/groups');
        if (!$groupsResponse->successful()) {
            throw new \Exception('Failed to fetch WhatsApp groups');
        }
        
        $groups = $groupsResponse->json()['results']['data'] ?? [];
        
        foreach ($groups as $group) {
            $messageData = $passObject;
            $messageData['phone'] = $group['JID'];
            
            $batch->add(new WhatsappBlastingProcess(
                $messageData,
                $apiUrl,
                $uploadedFile
            ));
        }
    } else {
        // Handle personal messages
        $numbers = array_filter(explode(',', $request->array_number));
        foreach ($numbers as $number) {
            $messageData = $passObject;
            $messageData['phone'] = trim($number) . '@s.whatsapp.net';
            
            $batch->add(new WhatsappBlastingProcess(
                $messageData,
                $apiUrl,
                $uploadedFile
            ));
        }
    }

    return redirect()->back()->with('success', 'Message send is being processed');
}

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  public function manage()
  {
    return Inertia::render('Whatsapp/Manage', [
      'whatsappNumbers' => WhatsappNumber::with('users')->get(),
      'users' => User::select('id', 'name')->get(),
    ]);
  }

  public function storeNumber(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'number' => 'required|string|max:255',
      'port' => 'required|string|max:255',
      'address' => 'nullable|string|max:255',
      'canSendPersonal' => 'boolean',
      'isActive' => 'boolean',
    ]);

    WhatsappNumber::create($validated);

    return redirect()
      ->back()
      ->with('success', 'WhatsApp number created successfully.');
  }

  public function destroyNumber(WhatsappNumber $whatsappNumber)
  {
    $whatsappNumber->delete();
    return redirect()
      ->back()
      ->with('success', 'WhatsApp number deleted successfully.');
  }

  public function updateUsers(Request $request, WhatsappNumber $whatsappNumber)
  {
    $validated = $request->validate([
      'user_ids' => 'required|array',
      'user_ids.*' => 'exists:users,id',
    ]);

    $whatsappNumber->users()->sync($validated['user_ids']);

    return redirect()
      ->back()
      ->with('success', 'Users updated successfully.');
  }

  public function updateNumber(Request $request, WhatsappNumber $whatsappNumber)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'number' => 'required|string|max:255',
      'port' => 'required|string|max:255',
      'address' => 'nullable|string|max:255',
      'canSendPersonal' => 'boolean',
      'isActive' => 'boolean',
    ]);

    $whatsappNumber->update($validated);

    return redirect()
      ->back()
      ->with('success', 'WhatsApp number updated successfully.');
  }
}
