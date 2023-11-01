<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

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
                ]);

                event(new Registered($newUser));

                Auth::login($newUser);
                

                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
