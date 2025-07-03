<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            $user = User::where('facebook_id', $facebookUser->getId())
                ->orWhere('email', $facebookUser->getEmail())
                ->first();

            if (!$user) {
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'facebook_id' => $facebookUser->getId(),
                    'password' => bcrypt('password-facebook'),
                ]);
            } elseif (!$user->facebook_id) {
                $user->update(['facebook_id' => $facebookUser->getId()]);
            }

            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Login berhasil dengan Facebook!');
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
