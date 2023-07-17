<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Group;
use App\Models\CheckIn;
use App\Models\History;
use App\Models\Meeting;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function create(Meeting $meeting)
    {
        $checkIn = CheckIn::where('user_id', Auth::user()->id)
            ->where('meeting_id', $meeting->id)
            ->first();
        if ($checkIn) {
            return redirect()
                ->route('checkins.show', ['meeting' => $meeting, 'checkIn' => $checkIn])
                ->with('status', 'Already checked in! Sit back and enjoy the session.');
        }

        return Inertia::render('CheckIns/Create', [
            'meeting' => $meeting,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function store(Meeting $meeting)
    {
        DB::beginTransaction();
        if (strtotime(now()) > strtotime($meeting->end_at)) {
            // Disable check in, past sessions
            DB::rollBack();
            return redirect()
                ->back()
                ->with([
                    'status' => 'The session has finished. Please scan the QR code for the latest session link.',
                    'error' => 'The session has finished',
                ]);
        } elseif (strtotime(now()) > strtotime($meeting->start_at . '+15 minutes')) {
            // Late check in, 0 merit points
            $points = 0;
            $flash = [
                'status' => 'Check in successful! Sit back and enjoy the session.',
                'warn' => 'The session has started for more than 15 minutes',
            ];
        } elseif (strtotime(now()) > strtotime($meeting->start_at)) {
            // Normal check in, 10 merit points
            $points = 10;
            $flash = [
                'status' => 'Check in successful! Sit back and enjoy the session.',
                'warn' => 'The session has started less than 15 minutes ago',
            ];
        } elseif (strtotime(now()) > strtotime($meeting->start_at . '-15 minutes')) {
            // Early check in, 100 merit points
            $points = 100;
            $flash = [
                'status' => 'Check in successful! Sit back and enjoy the session.',
                'success' => 'The session will start in 15 minutes',
            ];
        } elseif (strtotime(now()) > strtotime($meeting->start_at . '-1 hour')) {
            // Early check in, 100 merit points
            $points = 100;
            $flash = [
                'status' => 'Wow! You are here early. Sit back and wait for the session to start.',
                'success' => 'The session will start in 1 hour',
            ];
        } elseif (strtotime(now()) < strtotime($meeting->start_at . '-61 minutes')) {
            // Disable check in, future sessions
            DB::rollBack();
            return redirect()
                ->back()
                ->with([
                    'status' => 'The session starts in more than an hour. Please scan the QR code for current session link.',
                    'error' => 'The session starts in more than an hour',
                ]);
        }

        Auth::user()->points = Auth::user()->points + $points;
        Auth::user()->save();

        $userHistory = History::create([
            'remark' => $points . ' points adjustment from check in to ' . $meeting->name,
            'points' => Auth::user()->points,
        ]);
        Auth::user()
            ->histories()
            ->save($userHistory);

        if (Auth::user()->group) {
            Auth::user()->group->points = Auth::user()->group->points + $points;
            Auth::user()->group->save();

            $groupHistory = History::create([
                'link' => env('APP_URL', 'localhost') . '/users/' . Auth::user()->id . '/edit',
                'remark' => $points . ' points adjustment from ' . Auth::user()->name,
                'points' => Auth::user()->group->points,
            ]);
            Auth::user()
                ->group->histories()
                ->save($groupHistory);

            $checkIn = CheckIn::create([
                'user_id' => Auth::user()->id,
                'group_id' => Auth::user()->group->id,
                'meeting_id' => $meeting->id,
                'points' => $points,
            ]);
        } else {
            $checkIn = CheckIn::create([
                'user_id' => Auth::user()->id,
                'meeting_id' => $meeting->id,
                'points' => $points,
            ]);
        }

        DB::commit();
        return redirect()
            ->route('checkins.show', ['meeting' => $meeting, 'checkIn' => $checkIn])
            ->with($flash);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting, CheckIn $checkIn)
    {
        return Inertia::render('CheckIns/Show', [
            'meeting' => $meeting,
            'checkIn' => $checkIn,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckIn $checkIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckIn $checkIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckIn $checkIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function calculate(Meeting $meeting)
    {
        $groups = Group::all();
        $checkInGroup = [];

        foreach ($groups as $group) {
            $checkIns = CheckIn::where('meeting_id', $meeting->id)
                ->where('group_id', $group->id)
                ->get();
            $presentUsers = $checkIns->pluck('user_id');
            $absentUsers = $group->users->whereNotIn('id', $presentUsers)->count();
            $points = 0;
            $absentPoints = $absentUsers * -10;
            foreach ($checkIns as $checkIn) {
                $points += $checkIn->points;
            }
            $points += $absentPoints;
            Score::create([
                'meeting_id' => $meeting->id,
                'group_id' => $group->id,
                'points' => $points,
            ]);
            $group->points = $group->points + $absentPoints;
            $group->save();
            $history = History::create([
                'remark' => $points . ' points adjustment by ' . $meeting->name . ' users attendance',
                'points' => $group->points,
            ]);
            $group->histories()->save($history);
        }

        return redirect()->back()->with('success', 'Session scores table generated');
    }
}
