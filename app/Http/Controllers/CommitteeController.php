<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Committees/Index', [
            'filters' => Request::all('search'),
            'committees' => User::select('*')
                ->where('is_committee', true)
                ->orderBy('name')
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
        return Inertia::render('Committees/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = Request::get('username');

        Request::validate([
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'phone' => 'required|string|unique:users',
        ]);

        $user = User::create([
            'username' => $username,
            'name' => Request::get('name'),
            'email' => Request::get('email'),
            'phone' => Request::get('phone'),
            'division' => Request::get('division'),
            'password' => Hash::make($username),
            'is_committee' => true,
        ])->assignRole('Committee');

        return redirect()
            ->route('committees')
            ->with('success', 'Committee "' . $user->username . '" created, default password is "' . $user->username . '"');
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
        return Inertia::render('Committees/Edit', [
            'user' => $user->load('roles'),
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
        $validated = Request::validate([
            'username' => ['required', 'max:50', Rule::unique('users')->ignore($user->id)],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'max:50', Rule::unique('users')->ignore($user->id)],
        ]);

        if (Request::get('role_id')) {
            $role = Role::find(Request::get('role_id'));
            $user->syncRoles($role);
            if ($role->name == 'User') {
                $user->is_committee = false;
                $user->save();
                $user->update($validated);
                DB::commit();
                return redirect()->route('users')->with('success', 'User "' . $user->username . '" role changed to user');
            }
        }

        $user->update($validated);
        DB::commit();
        return redirect()->back()->with('success', 'Committee "' . $user->username . '" updated');
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
            ->route('committees')
            ->with('error', 'Committee "' . $user->username . '" deleted');
    }
}
