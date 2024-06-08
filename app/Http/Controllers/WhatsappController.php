<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Support\Facades\File; 

class WhatsappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Whatsapp/Index');
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
        $message = $request->message;
        $link = env('WHATSAPP_API');
        if ($request->number === 'penerangan') {
            $link = $link . "3000";
        } elseif ($request->number === 'mfast') {
            $link = $link . "3001";
        } elseif (!isset($request->number)) {
            $link = $link . '3000';
        }
        $linkGroup = $link . '/user/my/groups';
        if ($request->option === 'message') {
            $link = $link . '/send/message';
            $passObject["message"] = $request->message;
        } elseif ($request->option === 'photo') {
            $link = $link . '/send/image';
            $passObject["caption"] = $request->message;
            $passObject["compress"] = true;
        } elseif ($request->option === 'video') {
            $link = $link . '/send/video';
            $passObject["caption"] = $request->message;
            $passObject["compress"] = true;
        }
        // $phoneString = env('WHATSAPP_BLASTING');
        // $phoneString = "";
        // $phones = explode(',', $phoneString);
        $getGroupsResponse = Http::get($linkGroup);
        // $groups = json_decode($getGroupsResponse->body(), true);
        $data = $getGroupsResponse->json();
        if (strtolower($data['code']) === 'success') {
            $groups = $data['results']['data'];
        }
        $phone = '601110100119@s.whatsapp.net';
        // $testObject = new \stdClass;
        $api = Http::post($link, $passObject);
        $checkCaption = isset($passObject['caption']);
        $file = $request->file('file_upload');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('uploads', 'public');
        $file = public_path() . '\\storage\\' . $filePath;
        $fileTest = storage_path($file);
        dd($fileTest);
        foreach ($groups as $group) {
            $passObject['phone'] = $group['JID'];
            if ($checkCaption) {
                $api = Http::attach('image', file_get_contents($file), 'image.png')
                    ->post($link, $passObject);
            } else {
                $api = Http::post($link, $passObject);
            }
            $apiResponse[] = $api->json();
        }
        File::delete($file);
        return redirect()
            ->route('whatsapp')
            ->with('success', 'Message sent successfully', $api);
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
