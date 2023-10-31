<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Providers\RouteServiceProvider;

class GoogleController extends Controller
{
    public function signInWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackToGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('gauth_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect()->intended(RouteServiceProvider::HOME);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'gauth_id' => $user->id,
                    'gauth_type' => 'google',
                    'password' => encrypt('password')
                ]);

                event(new Registered($newUser));

                Auth::login($newUser);

                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
