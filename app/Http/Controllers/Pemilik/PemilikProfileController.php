<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\PemilikProfile;
use Illuminate\Http\Request;

class PemilikProfileController extends Controller
{
    public function show()
    {
  
        $profile = PemilikProfile::where('user_id', auth()->id())->first();
        // dd($profile);
        return view('pemilik.profile.show', compact('profile'));

    }

    public function create()
    {

        return view('pemilik.profile.create');
    }

    public function store(Request $request)
    {
 
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        PemilikProfile::create([
            'user_id' => auth()->id(),
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pemilik.profile.show');
    }

    public function edit()
    {
        // Ambil data profil yang ada
        $profile = PemilikProfile::where('user_id', auth()->id())->first();

        return view('pemilik.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        // Validasi dan update data profil
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $profile = PemilikProfile::where('user_id', auth()->id())->first();
        $profile->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pemilik.profile.show');
    }
}
