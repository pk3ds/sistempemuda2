<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Group;
use Inertia\Response;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln($request);
        $groups = Group::all()->loadCount('users');
        $groupId = $groups->sortBy('users_count')->first()->id;
        // $staffId = strtoupper($request->get('staff_id'));

        $request->validate([
            // 'staff_id' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            // 'staff_id' => $staffId,
            'name' => $request->name,
            'phone' => $request->phone,
            // 'email' => $request->email,
            'division' => $request->division,
            'password' => Hash::make($request->password),
            'group_id' => $groupId,
            'is_active' => true,
            'activated_at' => now(),
        ])->assignRole('User');

        $history = History::create([
            'remark' => 'User default',
            'points' => 0,
        ]);
        $user->histories()->save($history);

        event(new Registered($user));

        Auth::login($user);

        return Inertia::location('/dashboard');
    }
}
