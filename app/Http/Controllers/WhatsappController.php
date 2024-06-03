<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

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
        $phoneString = env('WHATSAPP_BLASTING');
        $phones = explode(',', $phoneString);

        $file = $request->file('file_upload');
        if ($request->option === 'message') {
            foreach ($phones as $phone) {
                $api = Http::post($link . '/send/message', [
                    'message' => $message,
                    'phone' => $phone,
                ]);
                $apiResponse[] = $api->json();
            }
        } else if ($request->option === 'photo') {
            foreach ($phones as $phone) {
                $api = Http::attach('image', file_get_contents($file), 'image.png')
                    ->post($link . '/send/image', [
                        'caption' => $message,
                        'phone' => $phone,
                        'view_once' => false,
                        'compress' => false,
                ]);
                $apiResponse[] = $api->json();
            }
        } else if ($request->option === 'video') {
            foreach ($phones as $phone) {
                $api = Http::attach('image', file_get_contents($file), 'image.png')
                    ->post($link . '/send/image', [
                        'caption' => $message,
                        'phone' => $phone,
                        'view_once' => false,
                        'compress' => false,
                ]);
                $apiResponse[] = $api->json();
            }
        }
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
