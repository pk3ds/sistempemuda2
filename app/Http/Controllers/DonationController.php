<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\UploadedFile;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Request;
// use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = new Request;
        return Inertia::render('Donations/Index', [
            'filters' => $request->all('search'),
            'donations' => Donation::select('*')
                ->orderBy('created_at')
                ->filter($request->only('search'))
                ->paginate(5)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Donations/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDonationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'target' => 'required|decimal:2|min:1',
            'file_upload' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        $file = $request->file('file_upload');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads', 'public');

        // Store file information in the database
        // $uploadedFile = new UploadedFile();
        // $uploadedFile = new UploadedFile();
        // $uploadedFile->id = Str::uuid()->toString();
        // $uploadedFile->filename = $fileName;
        // $uploadedFile->original_name = $file->getClientOriginalName();
        // $uploadedFile->path = $filePath;
        // $uploadedFile->uploadFor = "DONATION";
        // $uploadedFile->user_id = Auth::user()->id;
        // $uploadedFile->save();

        $createUploadedFile = UploadedFile::create([
            'id' => Str::uuid()->toString(),
            'filename' => $fileName,
            'original_name' => $file->getClientOriginalName(),
            'path' => $filePath,
            'uploadFor' => 'DONATION',
            'user_id' => Auth::user()->id
        ]);
        $request->merge([
            'uuid' => Str::uuid()->toString(),
            'uploaded_files_id' => $createUploadedFile->id
        ]);
        $donation = Donation::create($request->only('uuid', 'name', 'description', 'target', 'uploaded_files_id'));
        return redirect()
            ->route('donations')
            ->with('success', 'Donation "' . $donation->name . ' "created');
        // dd($validated);
        
        // Request::validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'nullable|string|max:255',
        //     'target' => 'required|decimal:2|min:1'
        // ]);

        // $donations = Request::merge(['uuid' => Str::uuid()->toString()]);
        // dd($donations);
        // $donation = Donation::create(Request::only('uuid', 'name', 'description', 'target'));
        // return redirect()
        //     ->route('donations')
        //     ->with('success', 'Donation "' . $donation->name . ' "created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        return Inertia::render('Donations/Edit', [
            'donation' => $donation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDonationRequest  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        $validated = Request::validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255|',
            'target' => 'required|decimal:2|min:1'
        ]);
        
        $donation->update($validated);


        return redirect()
            ->back()
            ->with('success', 'Donation "' . $donation->name . '" updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        //
    }
}
