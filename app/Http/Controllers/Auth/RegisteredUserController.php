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
    public function store(Request $request): RedirectResponse
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln($request);
        $username = $request->get('username');
        $phone = $request->get('phone');
        $phone = str_replace(' ', '-', $phone);
        $phone = preg_replace('/[^A-Za-z0-9\-]/', '', $phone);

        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'ic_number' => 'nullable|string|min:12',
            'phone' => 'required|string|min:11'
        ]);

        $user = User::create([
            'username' => $username,
            'name' => $request->name,
            'phone' => $phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'ic_number' => $request->ic_number,
            'alamat' => $request->alamat,
            'no_ahli' => $request->no_ahli,
            'is_active' => true,
            'activated_at' => now(),
        ])->assignRole('User');

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);

        // return Inertia::location('/dashboard');
    }
}
