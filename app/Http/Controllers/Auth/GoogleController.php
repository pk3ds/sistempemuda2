<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class GoogleController extends Controller
{
    public function signInWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackToGoogle()
    {
        try {
            try {
                $user = Socialite::driver('google')->user();
            } catch (Exception $e) {
                $user = Socialite::driver('google')->stateless()->user();
                dd($e);
            }
           

            $finduser = User::where('gauth_id', $user->id)->first();

            if ($finduser) {
                if (!$finduser->name) {
                    $user = $finduser;
                    return Redirect::route('registerGoogle.edit', $user);
                }
                Auth::login($finduser);
                return redirect()->intended(RouteServiceProvider::HOME);
            } else {
                //FIXME add if empty redirect to registration page
                $newUser = User::create([
                    'gauth_name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => Hash::make('password'),
                    'is_active' => true,
                    'activated_at' => now(),
                ]);

                return Redirect::route('registerGoogle.edit', $newUser);
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function create(User $user)
    {
        return Inertia::render('Auth/RegisterGoogle', [
            'user' => $user
        ]);
    }

    public function store(Request $request, User $user)
    {
        DB::beginTransaction();
        $phone = $request->get('phone');
        $phone = str_replace(' ', '-', $phone);
        $phone = preg_replace('/[^A-Za-z0-9\-]/', '', $phone);

        $request->validate([
            'name' => ['required', 'max:50'],
            'phone' => 'required|string|min:11|unique:users',
            'ic_number' => ['nullable', 'min:12']
        ]);
        
        $user->phone = $phone;
        $user->name = $request->name;
        $user->ic_number = $request->ic_number;
        $user->alamat = $request->alamat;
        $user->save();

        event(new Registered($user));

        Auth::login($user);
        DB::commit();
        return redirect()->intended(RouteServiceProvider::HOME);

        // return Inertia::location('/dashboard');
    }
}
