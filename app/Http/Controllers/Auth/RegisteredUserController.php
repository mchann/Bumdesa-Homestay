<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\PemilikProfile;
use App\Models\Homestay;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan', // role default
        ]);

        event(new Registered($user));

        // Hapus otomatis login dan arahkan ke halaman login
        return redirect()->route('login')->with('status', 'Registration successful! Please log in.');
    }

    public function createPemilik()
{
    return view('admin.pendaftaran-pemilik');
}


public function storePemilik(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|ends_with:@gmail.com|unique:users,email',
        'password' => 'required|min:6',
        'nomor_telepon' => 'required|string|max:20',
        'alamat' => 'required|string|max:255',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'pemilik',
    ]);

    PemilikProfile::create([
        'user_id' => $user->id,
        'nama_lengkap' => $request->name,
        'nomor_telepon' => $request->nomor_telepon,
        'alamat' => $request->alamat,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Pemilik Homestay berhasil didaftarkan.');
}

public function daftarPemilik() 
{
    $pemilikList = User::where('role', 'pemilik')
        ->with(['pemilikProfile.homestays']) // chained eager loading
        ->get();

    return view('admin.pemilikhomestay', compact('pemilikList'));
}



}
