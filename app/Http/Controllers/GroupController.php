<?php

namespace App\Http\Controllers;

use Faker\Factory;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Group;
use App\Models\History;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Groups/Index', [
            'filters' => Request::all('search'),
            'groups' => Group::select('*')
                ->withCount('users')
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
        return Inertia::render('Groups/Create', [
            'leaders' => User::where('is_committee', false)->get(),
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
            'leader_id' => ['required', 'max:50', Rule::exists('users', 'id')],
            'coleader_id' => ['required', 'max:50', Rule::exists('users', 'id')],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255|',
            'remark' => 'nullable|string|max:255|',
        ]);

        $group = Group::create($validated);

        $history = History::create([
            'remark' => 'Group default',
            'points' => 0,
        ]);
        $group->histories()->save($history);

        DB::commit();
        return redirect()
            ->route('groups')
            ->with('success', 'Contingent "' . $group->name . '" created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return Inertia::render('Groups/Edit', [
            'group' => $group->load('users', 'awards', 'histories', 'scores.meeting'),
            'leaders' => User::where('is_committee', false)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        DB::beginTransaction();
        $initialPoints = $group->points;
        $validated = Request::validate([
            'leader_id' => ['nullable', 'max:50', Rule::exists('users', 'id')],
            'coleader_id' => ['nullable', 'max:50', Rule::exists('users', 'id')],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255|',
            'remark' => 'nullable|string|max:255|',
        ]);

        $group->update($validated);
        $finalPoints = $group->points;

        if ($finalPoints != $initialPoints) {
            $adjustmentPoints = $finalPoints - $initialPoints;
            $history = History::create([
                'remark' => $adjustmentPoints . ' points adjustment by ' . Auth::user()->name,
                'points' => $group->points,
            ]);
            $group->histories()->save($history);
        }

        DB::commit();
        return redirect()
            ->back()
            ->with('success', 'Contingent "' . $group->name . '" updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()
            ->route('groups')
            ->with('error', 'Contingent "' . $group->name . '" deleted');
    }

    /**
     * Store uploaded resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, Group $group)
    {
        // TODO finalize upload users
        $users = Request::all();

        DB::beginTransaction();
        foreach ($users as $user) {
            $staffEmail = $user['Email'] ?? null;
            $phone = $user['Cell No'] ?? null;
            $staffPhone = preg_replace('/\D+/', '', $phone);
            $staffId = strtoupper($user['Staff ID']);

            if ($user['Grouping'] == 'Exclude') {
                $createdUser = User::create([
                    'staff_id' => $staffId,
                    'name' => $user['Name'],
                    'email' => $staffEmail,
                    'phone' => $staffPhone,
                    'division' => $user['Division (Details)'],
                    'password' => Hash::make($staffId),
                    'is_committee' => true,
                ])->assignRole('Committee');
            } else {
                $createdUser = User::create([
                    'staff_id' => $staffId,
                    'name' => $user['Name'],
                    'email' => $staffEmail,
                    'phone' => $staffPhone,
                    'division' => $user['Division (Details)'],
                    'password' => Hash::make($staffId),
                    'group_id' => $group->id,
                ])->assignRole('User');
            }

            $history = History::create([
                'remark' => 'User default',
                'points' => 0,
            ]);
            $createdUser->histories()->save($history);
        }

        DB::commit();
        return [
            'users' => $group->users,
            'status' => 'Users uploaded to this contingent'
        ];
    }

    public function points(Request $request, Group $group)
    {
        DB::beginTransaction();
        $validated = Request::validate([
            'points' => 'required|integer',
        ]);
        $points = Request::get('points');

        $group->update([
            'points' => $group->points + $points,
        ]);

        $history = History::create([
            'remark' => $points . ' points adjustment by ' . Auth::user()->name,
            'points' => $group->points,
        ]);
        $group->histories()->save($history);

        DB::commit();
        return redirect()
            ->back()
            ->with('success', 'Contingent "' . $group->name . '" updated');
    }
}
