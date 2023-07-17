<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\LuckyDraw;
use Illuminate\Support\Facades\Request;

class WinnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Winners/Index', [
            'winners' => LuckyDraw::select('*')
                ->with('user')->get(),
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
        //
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
        return Inertia::render('Winners/Edit', [
            'winner' => LuckyDraw::find($id)->load('user'),
        ]);
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
        $winner = LuckyDraw::find($id);

        $validated = Request::validate([
            'prize' => ['required', 'max:50'],
            'remark' => ['nullable', 'max:50'],
            'is_claimed' => ['required'],
        ]);

        if ($winner->is_claimed) {
            $winner->claimed_at = now();
        }
        $winner->prize = Request::get('prize');
        $winner->remark = Request::get('remark');
        $winner->is_claimed = Request::get('is_claimed');
        $winner->save();

        return redirect()
            ->route('winners.index')
            ->with('success', 'Winner ' . $winner->user->name . ' updated');
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

    public function claim(Request $request, $id)
    {
        $winner = LuckyDraw::find($id);

        $winner->is_claimed = true;
        $winner->claimed_at = now();
        $winner->save();

        return redirect()
            ->back()
            ->with('success', 'Winner ' . $winner->user->name . ' prize claimed');
    }
}
