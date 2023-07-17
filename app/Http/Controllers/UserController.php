<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Group;
use App\Models\History;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Users/Index', [
            'filters' => Request::all('search'),
            'users' => User::select('*')
                ->whereNot('is_committee', true)
                ->orderBy('name')
                ->with('group')
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
        return Inertia::render('Users/Create', [
            'facilitators' => User::all()->where('is_committee', true),
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
        $groups = Group::all()->loadCount('users');
        $groupId = $groups->sortBy('users_count')->first()->id;
        $staffId = strtoupper(Request::get('staff_id'));

        Request::validate([
            'staff_id' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'phone' => 'required|string|unique:users',
            'division' => 'nullable|string|max:255',
            'facilitator_id' => 'nullable|exists:users'
        ]);

        $user = User::create([
            'staff_id' => $staffId,
            'name' => Request::get('name'),
            'email' => Request::get('email'),
            'phone' => Request::get('phone'),
            'division' => Request::get('division'),
            'facilitator_id' => Request::get('facilitator_id'),
            'password' => Hash::make($staffId),
            'group_id' => $groupId,
        ])->assignRole('User');

        $history = History::create([
            'remark' => 'User default',
            'points' => 0,
        ]);
        $user->histories()->save($history);

        DB::commit();
        return redirect()
            ->route('users')
            ->with('success', 'User "' . $user->staff_id . '" created, default password is "' . $user->staff_id . '"');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user->load('roles', 'awards', 'histories'),
            'facilitators' => User::all()->where('is_committee', true),
            'groups' => Group::all(),
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        DB::beginTransaction();
        $initialPoints = $user->points;
        $validated = Request::validate([
            'staff_id' => ['required', 'max:50', Rule::unique('users')->ignore($user->id)],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'max:50', Rule::unique('users')->ignore($user->id)],
            'division' => ['nullable', 'max:50'],
            'group_id' => ['required', 'max:50', Rule::exists('groups', 'id')],
            'facilitator_id' => ['nullable', 'max:50', Rule::exists('users', 'id')],
        ]);

        if (Request::get('role_id')) {
            $role = Role::find(Request::get('role_id'));
            $user->syncRoles($role);
            if ($role->name != 'User') {
                $user->group->points = $user->group->points - $user->points;
                $user->group->save();
                $groupHistory = History::create([
                    'link' => env('APP_URL', 'localhost') . '/committees/' . $user->id . '/edit',
                    'remark' => -$user->points . ' points adjustment from ' . $user->name,
                    'points' => $user->group->points,
                ]);
                $user->group->histories()->save($groupHistory);

                $userHistory = History::create([
                    'remark' => -$user->points . ' points removed by ' . Auth::user()->name . ' (role changed to committee)',
                    'points' => 0,
                ]);
                $user->histories()->save($userHistory);

                $user->update($validated);
                $user->is_committee = true;
                $user->points = 0;
                $user->save();
                DB::commit();
                return redirect()
                    ->route('committees')
                    ->with('success', 'User "' . $user->staff_id . '" role changed to committee');
            }
        }

        if (Request::get('group_id') !== $user->group->id) {
            $user->group->points = $user->group->points - $user->points;
            $user->group->save();
            $groupHistory = History::create([
                'link' => env('APP_URL', 'localhost') . '/users/' . $user->id . '/edit',
                'remark' => -$user->points . ' points adjustment from ' . $user->name . ' (user changed contingent)',
                'points' => $user->group->points,
            ]);
            $user->group->histories()->save($groupHistory);

            $newGroup = Group::find(Request::get('group_id'));
            $newGroup->points = $newGroup->points + $user->points;
            $newGroupHistory = History::create([
                'link' => env('APP_URL', 'localhost') . '/users/' . $user->id . '/edit',
                'remark' => $user->points . ' points adjustment from ' . $user->name . ' (user changed contingent)',
                'points' => $newGroup->points,
            ]);
            $newGroup->histories()->save($newGroupHistory);
        }

        $user->update($validated);
        $finalPoints = $user->points;

        if ($finalPoints != $initialPoints) {
            $adjustmentPoints = $finalPoints - $initialPoints;
            $user->group->points = $user->group->points + $adjustmentPoints;
            $user->group->save();
            $groupHistory = History::create([
                'link' => env('APP_URL', 'localhost') . '/users/' . $user->id . '/edit',
                'remark' => $adjustmentPoints . ' points adjustment from ' . $user->name,
                'points' => $user->group->points,
            ]);
            $user->group->histories()->save($groupHistory);

            $userHistory = History::create([
                'remark' => $adjustmentPoints . ' points adjustment by ' . Auth::user()->name,
                'points' => $user->points,
            ]);
            $user->histories()->save($userHistory);
        }

        DB::commit();
        return redirect()
            ->back()
            ->with('success', 'User "' . $user->staff_id . '" updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users')
            ->with('error', 'User "' . $user->staff_id . '" deleted');
    }

    public function reset(User $user)
    {
        // FIXME reset password not working
        $user->update([
            'password' => Hash::make($user->id),
        ]);

        return [
            'username' => $user->id,
            'password' => $user->password,
            'status' => 'User password reset successful'
        ];
    }

    public function points(Request $request, User $user)
    {
        DB::beginTransaction();
        $validated = Request::validate([
            'points' => ['required', 'max:50'],
        ]);
        $points = Request::get('points');

        $user->update([
            'points' => $user->points + $points,
        ]);

        $groupHistory = History::create([
            'link' => env('APP_URL', 'localhost') . '/users/' . $user->id . '/edit',
            'remark' => $points . ' points adjustment from ' . $user->name,
            'points' => $user->group->points,
        ]);
        $user->group->histories()->save($groupHistory);

        $userHistory = History::create([
            'remark' => $points . ' points adjustment by ' . Auth::user()->name,
            'points' => $user->points,
        ]);
        $user->histories()->save($userHistory);

        DB::commit();
        return redirect()
            ->back()
            ->with('success', 'User "' . $user->staff_id . '" updated');
    }
}
