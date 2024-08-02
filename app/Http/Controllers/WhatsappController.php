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

class WhatsappController extends BaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $whatsappNumber = WhatsappNumber::where('isActive', 1)
      ->with('first_whatsappBatches')
      ->get();
    return Inertia::render('Whatsapp/Index', [
      'whatsappNumber' => $whatsappNumber,
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
    $whatsappNumber = WhatsappNumber::where(
      'id',
      $request->number
    )->firstOrFail();
    $increaseTimeLimit = set_time_limit(0);
    $port = $whatsappNumber->port;
    $message = $request->message;
    $link = $whatsappNumber->address
      ? '192.168.' . $whatsappNumber->address . ':'
      : env('WHATSAPP_API');
    $number = strtolower($request->number);
    if (isset($request->port)) {
      $link = $link . $port;
    } else {
      $link = $link . $port;
    }
    // if ($number === 'penerangan') {
    //     $link = $link . "3000";
    // } elseif ($number === 'mfast') {
    //     $link = $link . "3001";
    // } elseif (!isset($request->number)) {
    //     $link = $link . '3000';
    // }
    $personal = isset($request->array_number);
    if ($personal) {
      $myArray = $request->array_number;
    }
    $linkGroup = $link . '/user/my/groups';
    $getGroupsResponse = Http::get($linkGroup);
    $data = $getGroupsResponse->json();
    if ($request->option === 'message') {
      $link = $link . '/send/message';
      $passObject["message"] = $message;
    } elseif ($request->option === 'photo') {
      $link = $link . '/send/image';
      $passObject["caption"] = $message;
      $passObject["compress"] = true;
    } elseif ($request->option === 'video') {
      $link = $link . '/send/video';
      $passObject["caption"] = $message;
      $passObject["compress"] = true;
    }
    if (!$personal) {
      if (strtolower($data['code']) === 'success') {
        $groups = $data['results']['data'];
      } else {
        return redirect()
          ->route('whatsapp')
          ->with('error', 'Error, whatsapp is not running.');
        // session()->flash('error', 'Error, whatsapp is not running.');
        // return $this->sendError('Error, whatsapp is not running.');
      }
    }
    if ($request->file_upload) {
      $file = $request->file('file_upload');
      $filePath = $file->store('uploads', 'public');
      $file = public_path() . '//storage//' . $filePath;
    } else {
      $file = "";
    }
    $findWhatsappNumberId = $request->number;
    // dd($findWhatsappNumberId);
    $batch = Bus::batch([])
      ->then(function (Batch $batch) use ($passObject, $link, $file) {
        if ($file !== "") {
          File::delete($file);
        }
        WhatsappBatches::where('job_batches_id', $batch->id)->update([
          'isActive' => false,
        ]);
      })
      ->finally(function (Batch $batch) use ($passObject, $link, $file) {
        if (!$batch->finished()) {
          resolve(BatchRepository::class)->markAsFinished($batch->id);
        }
        if ($file !== "") {
          File::delete($file);
        }
        WhatsappBatches::where('job_batches_id', $batch->id)->update([
          'isActive' => false,
        ]);
        $checkWhatsappBatches = WhatsappBatches::where(
          'job_batches_id',
          $batch->id
        );
        echo strval($batch);
        echo "finished";
        echo strval($checkWhatsappBatches);
      })
      ->dispatch();
    $whatsappBatches = WhatsappBatches::create([
      'whatsapp_number_id' => $findWhatsappNumberId,
      'job_batches_id' => $batch->id,
      'isActive' => true,
    ]);
    // $activeWhatsappAndAvailable = WhatsappNumber::where('isActive', true)->whereRelation('whatsappBatches', 'isActive', '=', false)->get();
    // $activeWhatsappAndAvailable = WhatsappNumber::where('isActive', true)->whereHas('whatsappBatches', function($query) {
    //     $query->where('isActive', false);
    // })->orDoesntHave('whatsappBatches');
    // $activeWhatsappAndAvailable = WhatsappNumber::where('isActive', 1)->whereDoesntHave('whatsappBatches')->orWhereHas('whatsappBatches', function($query) {
    //     $query->where('isActive', false);
    // })->get();
    // dd($activeWhatsappAndAvailable);
    if (!$personal) {
      foreach ($groups as $key => $group) {
        // uncomment this for the prod function
        $passObject['phone'] = $group['JID'];
        // $passObject['phone'] = '601110100119@s.whatsapp.net';

        if (isset($file)) {
          $batch->add(new WhatsappBlastingProcess($passObject, $link, $file));
        } else {
          $batch->add(new WhatsappBlastingProcess($passObject, $link, null));
        }
      }
    } else {
      foreach ($myArray as $key => $numberPersonal) {
        $passObject['phone'] = trim($numberPersonal) . '@s.whatsapp.net';
        // $passObject['phone'] = '601110100119@s.whatsapp.net';
        if (isset($file)) {
          $batch->add(new WhatsappBlastingProcess($passObject, $link, $file));
        } else {
          $batch->add(new WhatsappBlastingProcess($passObject, $link, null));
        }
      }
    }
    return redirect()
      ->route('whatsapp')
      ->with('success', 'Message send is being processed', $batch);
    // session()->flash('success', 'Message send is being processed');
    // return $this->sendResponse($batch, 'Message send is being processed');
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
}
