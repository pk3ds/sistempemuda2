<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Meeting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Meetings/Index', [
            'filters' => Request::all('search'),
            'meetings' => Meeting::select('*')
                ->orderBy('start_at')
                ->filter(Request::only('search'))
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
        return Inertia::render('Meetings/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Request::validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255|',
            'start_at' => 'required|string|max:255|',
            'end_at' => 'required|string|max:255|',
        ]);

        Request::merge(['uuid' => Str::uuid()->toString()]);
        $meeting = Meeting::create(Request::only('uuid', 'name', 'description', 'start_at', 'end_at'));

        return redirect()
            ->route('sessions')
            ->with('success', 'Session "' . $meeting->name . ' "created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        return Inertia::render('Meetings/Edit', [
            'meeting' => $meeting->load('scores.group'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        $validated = Request::validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255|',
            'start_at' => 'required|string|max:255|',
            'end_at' => 'required|string|max:255|',
        ]);

        $meeting->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Session "' . $meeting->name . '" updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();

        return redirect()
            ->route('sessions')
            ->with('error', 'Session "' . $meeting->name . ' (' . date_format($meeting->start_at, 'd M Y, H:i a') . ')" deleted');
    }
}
