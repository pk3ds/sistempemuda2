<?php

namespace App\Http\Controllers;

use App\Models\UploadedFile;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUploadedFileRequest;
use App\Http\Requests\UpdateUploadedFileRequest;
use Illuminate\Support\Facades\Auth;

class UploadedFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uploadedFiles = UploadedFile::all();
        return view('donation', compact('uploadedFiles'));
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
     * @param  \App\Http\Requests\StoreUploadedFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the incoming file. Refuses anything bigger than 2048 kilobytes (=2MB)
        $request->validate([
            'file_upload' => 'required|mimes:png,jpg|max:2048'
        ]);

        // Store the file in storage\app\public folder
        $file = $request->file('file_upload');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads', 'public');

        // Store file information in the database
        $uploadedFile = new UploadedFile();
        $uploadedFile->filename = $fileName;
        $uploadedFile->original_name = $file->getClientOriginalName();
        $uploadedFile->file_path = $filePath;
        $uploadedFile->uploadFor = $request->uploadFor;
        $uploadedFile->user_id = Auth::user()->id;
        $uploadedFile->save();

        return redirect()->route('donations')
            ->with('success', "File `{$uploadedFile->original_name}` uploaded successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UploadedFile  $uploadedFile
     * @return \Illuminate\Http\Response
     */
    public function show(UploadedFile $uploadedFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UploadedFile  $uploadedFile
     * @return \Illuminate\Http\Response
     */
    public function edit(UploadedFile $uploadedFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUploadedFileRequest  $request
     * @param  \App\Models\UploadedFile  $uploadedFile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUploadedFileRequest $request, UploadedFile $uploadedFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UploadedFile  $uploadedFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UploadedFile $uploadedFile)
    {
        //
    }
}
