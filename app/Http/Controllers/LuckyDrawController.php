<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\LuckyDraw;
use Illuminate\Support\Facades\Request;

class LuckyDrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('LuckyDraws/Winner', [
            'winners' => LuckyDraw::all()->load('user'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('LuckyDraws/LuckyDraw');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSingle()
    {
        return Inertia::render('LuckyDraws/SingleDraw');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSingle(Request $request)
    {
        $winners = LuckyDraw::all()->pluck('user_id');
        $users = User::where('is_active', true)->whereNotIn('id', $winners)->get();

        if ($users->count() == 0) {
            return ['name' => 'No more users'];
        }

        $winner = $users->random();

        LuckyDraw::create([
            'user_id' => $winner->id,
        ]);

        return $winner;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMultiple()
    {
        return Inertia::render('LuckyDraws/MultipleDraw');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMultiple(Request $request)
    {
        $number = Request::get('numbers');
        $winners = LuckyDraw::all()->pluck('user_id');
        $users = User::where('is_active', true)->whereNotIn('id', $winners)->get();

        if ($users->count() == 0) {
            return [['name' => 'No more users']];
        }

        $winners = $users->random($number);

        foreach ($winners as $winner) {
            LuckyDraw::create([
                'user_id' => $winner->id,
            ]);
        }

        return $winners;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LuckyDraw  $luckyDraw
     * @return \Illuminate\Http\Response
     */
    public function show(LuckyDraw $luckyDraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LuckyDraw  $luckyDraw
     * @return \Illuminate\Http\Response
     */
    public function edit(LuckyDraw $luckyDraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LuckyDraw  $luckyDraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LuckyDraw $luckyDraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LuckyDraw  $luckyDraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(LuckyDraw $luckyDraw)
    {
        //
    }
}
