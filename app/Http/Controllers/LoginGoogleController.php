<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class LoginGoogleController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user(); //mạng xã hội là google
            // return response()->json($user); 

            $finduser = User::where('google_id', $user->google_id)->first(); 

            if ($finduser) { 

                Auth::login($finduser);

                return redirect()->route('/');
            } else { 
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'avatar' => $user->avatar,
                    'google_id' => $user->id,
                    'password' => encrypt('123456789')
                ]);

                Auth::login($newUser);

                return redirect()->route('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
