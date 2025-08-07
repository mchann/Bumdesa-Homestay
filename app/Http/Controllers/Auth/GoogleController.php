<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleController extends Controller
{
    // Redirect ke Google
   public function redirect()
{
    return Socialite::driver('google')
        ->redirectUrl(env('GOOGLE_REDIRECT_URI')) // paksa ambil ulang dari .env
        ->redirect();
}
    public function callback()
    {
        try {
         
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cari user berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            // Jika user belum ada, buat user baru
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('password-google'), // Password default
                ]);
            } elseif (!$user->google_id) {
                // Jika user ada tapi belum memiliki google_id, tambahkan
                $user->update(['google_id' => $googleUser->getId()]);
            }

            // Login user
            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google: ' . $e->getMessage());
        }
    }
}
