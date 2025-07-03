<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;

class SocialiteController extends Controller
{
    // Redirect ke penyedia (Google/Facebook)
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Callback dari penyedia (Google/Facebook)
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Login gagal, coba lagi.');
        }

        $user = $this->findOrCreateUser($socialUser, $provider);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Login berhasil!');
    }

    // Cari user berdasarkan email atau buat baru
    private function findOrCreateUser($socialUser, $provider)
    {
        return User::updateOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => bcrypt(uniqid()), // Password random biar aman
            ]
        );
    }
}
