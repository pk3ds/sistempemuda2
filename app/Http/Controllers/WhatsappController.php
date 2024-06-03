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
        $phones = array(
            '601110100119@s.whatsapp.net',
            '60125414160@s.whatsapp.net',
        );
        // $phones = array(
        //     '60139918200-1629602413@g.us',
        //     '120363143420852936@g.us',
        //     '120363123118401353@g.us',
        //     '60125426750-1415003941@g.us',
        //     '60132662976-1584994757@g.us',
        //     '60199804007-1361451982@g.us',
        //     '601110857754-1536378649@g.us',
        //     '60192975298-1629273143@g.us',
        //     '60108484914-1475113037@g.us',
        //     '60192975298-1380608799@g.us',
        //     '601111912769-1631302624@g.us',
        //     '120363040784124776@g.us',
        //     '601133338302-1561389934@g.us',
        //     '120363162862991169@g.us',
        //     '120363165706812773@g.us',
        // );

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
