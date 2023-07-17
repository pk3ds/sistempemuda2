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
        $staffId = strtoupper(Request::get('staff_id'));

        Request::validate([
            'staff_id' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'phone' => 'required|string|unique:users',
            'division' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'staff_id' => $staffId,
            'name' => Request::get('name'),
            'email' => Request::get('email'),
            'phone' => Request::get('phone'),
            'division' => Request::get('division'),
            'password' => Hash::make($staffId),
            'is_committee' => true,
        ])->assignRole('Committee');

        return redirect()
            ->route('committees')
            ->with('success', 'Committee "' . $user->staff_id . '" created, default password is "' . $user->staff_id . '"');
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
            'staff_id' => ['required', 'max:50', Rule::unique('users')->ignore($user->id)],
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'max:50', Rule::unique('users')->ignore($user->id)],
            'division' => ['nullable', 'max:50'],
        ]);

        if (Request::get('role_id')) {
            $role = Role::find(Request::get('role_id'));
            $user->syncRoles($role);
            if ($role->name == 'User') {
                $user->is_committee = false;
                $user->save();
                $user->update($validated);
                DB::commit();
                return redirect()->route('users')->with('success', 'User "' . $user->staff_id . '" role changed to user');
            }
        }

        $user->update($validated);
        DB::commit();
        return redirect()->back()->with('success', 'Committee "' . $user->staff_id . '" updated');
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
            ->with('error', 'Committee "' . $user->staff_id . '" deleted');
    }
}
