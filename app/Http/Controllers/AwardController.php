<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Award;
use App\Models\Group;
use App\Models\History;
use App\Models\Meeting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Awards/Index', [
            'filters' => Request::all('search'),
            'awards' => Award::select('*')
                ->orderBy('created_at', 'desc')
                ->with('awardable', 'meeting')
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
        return Inertia::render('Awards/Create', [
            'meetings' => Meeting::all()->sortBy('name'),
            'groups' => Group::all()->sortBy('name'),
            'users' => User::where('is_committee', false)
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $validated = Request::validate([
            'meeting_id' => 'nullable|integer|max:255|',
            'name' => 'required|string|max:255',
            'remark' => 'nullable|string|max:255|',
            'points' => 'required|integer',
            'recipient_type' => 'required|string|max:255|',
            'recipient_id' => 'required|integer',
        ]);

        if (Request::get('recipient_type') == 'AppModelsGroup') {
            $recipient = Group::find(Request::get('recipient_id'));
        }
        if (Request::get('recipient_type') == 'AppModelsUser') {
            $recipient = User::find(Request::get('recipient_id'));
            $adjustmentPoints = Request::get('points');
            $recipient->group->points = $recipient->group->points + $adjustmentPoints;
            $recipient->group->save();

            $groupHistory = History::create([
                'link' => env('APP_URL', 'localhost') . '/users/' . $recipient->id . '/edit',
                'remark' => $adjustmentPoints . ' points adjustment from ' . $recipient->name,
                'points' => $recipient->group->points,
            ]);
            $recipient->group->histories()->save($groupHistory);
        }

        if (!$recipient) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Recipient does not exist');
        }

        $award = Award::create($validated);
        $recipient->awards()->save($award);
        $recipient->points = $recipient->points + $award->points;
        $recipient->save();

        $awardHistory = History::create([
            'remark' => 'Award default',
            'points' => $award->points,
        ]);
        $award->histories()->save($awardHistory);

        $recipientHistory = History::create([
            'link' => env('APP_URL', 'localhost') . '/awards/' . $award->id . '/edit',
            'remark' => $award->points . ' points adjustment by ' . $award->name,
            'points' => $recipient->points,
        ]);
        $recipient->histories()->save($recipientHistory);

        DB::commit();
        return redirect()
            ->route('awards')
            ->with('success', 'Award "' . $award->name . '" awarded to "' . $recipient->name . '"');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show(Award $award)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function edit(Award $award)
    {
        return Inertia::render('Awards/Edit', [
            'award' => $award->load('histories'),
            'meetings' => Meeting::all()->sortBy('name'),
            'groups' => Group::all()->sortBy('name'),
            'users' => User::where('is_committee', false)
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Award $award)
    {
        DB::beginTransaction();
        $initialPoints = $award->points;
        $validated = Request::validate([
            'meeting_id' => 'nullable|integer|max:255|',
            'name' => 'required|string|max:255',
            'remark' => 'nullable|string|max:255|',
            'points' => 'required|integer',
            'recipient_type' => 'required|string|max:255|',
            'recipient_id' => 'required|integer',
        ]);

        if (Request::get('recipient_type') == 'AppModelsGroup') {
            $recipient = Group::find(Request::get('recipient_id'));
        }
        if (Request::get('recipient_type') == 'AppModelsUser') {
            $recipient = User::find(Request::get('recipient_id'));
            $finalPoints = Request::get('points');
            $adjustmentPoints = $finalPoints - $initialPoints;
            $recipient->group->points = $recipient->group->points + $adjustmentPoints;
            $recipient->group->save();

            $groupHistory = History::create([
                'link' => env('APP_URL', 'localhost') . '/users/' . $recipient->id . '/edit',
                'remark' => $adjustmentPoints . ' points adjustment from ' . $recipient->name,
                'points' => $recipient->group->points,
            ]);
            $recipient->group->histories()->save($groupHistory);
        }

        if (!$recipient) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Recipient does not exist');
        }

        $award->update($validated);
        $award
            ->awardable()
            ->associate($recipient)
            ->save();
        $finalPoints = $award->points;

        if ($finalPoints != $initialPoints) {
            $adjustmentPoints = $finalPoints - $initialPoints;
            $recipient->points = $recipient->points + $adjustmentPoints;
            $recipient->save();

            $awardHistory = History::create([
                'remark' => $adjustmentPoints . ' points adjustment by ' . Auth::user()->name,
                'points' => $award->points,
            ]);
            $award->histories()->save($awardHistory);

            $recipientHistory = History::create([
                'link' => env('APP_URL', 'localhost') . '/awards/' . $award->id . '/edit',
                'remark' => $adjustmentPoints . ' points adjustment by ' . $award->name,
                'points' => $recipient->points,
            ]);
            $recipient->histories()->save($recipientHistory);
        }

        DB::commit();
        return redirect()
            ->back()
            ->with('success', 'Award "' . $award->name . '" updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Award $award)
    {
        DB::beginTransaction();
        $adjustmentPoints = $award->points;
        $recipient = $award->awardable;
        $award->delete();

        $recipient->points = $recipient->points - $adjustmentPoints;
        $recipient->save();

        if ($recipient->group) {
            $recipient->group->points = $recipient->group->points - $adjustmentPoints;
            $recipient->group->save();

            $groupHistory = History::create([
                'link' => env('APP_URL', 'localhost') . '/users/' . $recipient->id . '/edit',
                'remark' => -$adjustmentPoints . ' points adjustment by ' . $recipient->name,
                'points' => $recipient->group->points,
            ]);
            $recipient->group->histories()->save($groupHistory);
        }

        $recipientHistory = History::create([
            'link' => env('APP_URL', 'localhost') . '/awards/' . $award->id . '/edit',
            'remark' => -$adjustmentPoints . ' points adjustment by ' . $award->name,
            'points' => $recipient->points,
        ]);
        $recipient->histories()->save($recipientHistory);

        $awardHistory = History::create([
            'remark' => 'Award deleted',
            'points' => -$adjustmentPoints,
        ]);
        $award->histories()->save($awardHistory);

        DB::commit();
        return redirect()
            ->route('awards')
            ->with('error', 'Award "' . $award->name . '" deleted');
    }
}
