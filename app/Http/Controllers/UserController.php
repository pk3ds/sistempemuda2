<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
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
      'password' => Hash::make($username),
    ])->assignRole('User');

    DB::commit();
    return redirect()
      ->route('users')
      ->with(
        'success',
        'User "' .
          $user->username .
          '" created, default password is "' .
          $user->username .
          '"'
      );
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
    try {
      DB::beginTransaction();
      $validated = Request::validate([
        'username' => [
          'required',
          'max:50',
          Rule::unique('users')->ignore($user->id),
        ],
        'name' => ['required', 'max:50'],
        'email' => [
          'required',
          'max:50',
          'email',
          Rule::unique('users')->ignore($user->id),
        ],
        'phone' => [
          'required',
          'max:50',
          Rule::unique('users')->ignore($user->id),
        ],
      ]);

      if (Request::get('role_id')) {
        $role = Role::find(Request::get('role_id'));
        $user->syncRoles($role);
        if ($role->name != 'User') {
          $user->update($validated);
          $user->is_committee = true;
          $user->save();
          DB::commit();
          return redirect()
            ->route('committees')
            ->with(
              'success',
              'User "' . $user->username . '" role changed to committee'
            );
        }
      }

      $user->update($validated);

      DB::commit();
      return redirect()
        ->back()
        ->with('success', 'User "' . $user->username . '" updated');
    } catch (\Throwable $e) {
      dd($e);
      return redirect()
        ->back()
        ->with('error', 'Error updating user "' . $user->username . '"');
    }
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
      ->with('error', 'User "' . $user->username . '" deleted');
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
      'status' => 'User password reset successful',
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
      ->with('success', 'User "' . $user->username . '" updated');
  }
}
