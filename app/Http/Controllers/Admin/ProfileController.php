<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class ProfileController extends Controller
{
    public function show()
{
    $profile = auth()->user()->adminProfile;
    return view('admin.profile.show', compact('profile'));
}

public function create()
{
    return view('admin.profile.create');
}


public function edit()
{
    $profile = auth()->user()->adminProfile; 
    return view('admin.profile.edit', compact('profile'));
}

public function update(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required|string|max:100',
        'nomor_telepon' => 'required|string|max:15',
        'alamat' => 'required|string',
    ]);

    auth()->user()->adminProfile->update([
        'nama_lengkap' => $request->nama_lengkap,
        'nomor_telepon' => $request->nomor_telepon,
        'alamat' => $request->alamat,
    ]);

    return redirect()->route('admin.profile.show')->with('success', 'Profil berhasil diperbarui!');
}

public function store(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required|string|max:100',
        'nomor_telepon' => 'required|string|max:15',
        'alamat' => 'required|string',
    ]);

    // simpen ke atmin profil
    auth()->user()->adminProfile()->create([
        'nama_lengkap' => $request->nama_lengkap,
        'nomor_telepon' => $request->nomor_telepon,
        'alamat' => $request->alamat,
    ]);


    return redirect()->route('admin.profile.show')->with('success', 'Profil berhasil dilengkapi!');
}
public function nonaktifkan($id)
{
    $user = User::findOrFail($id);
    $user->status = 'nonaktif';
    $user->save();

    return redirect()->back()->with('success', 'Akun berhasil dinonaktifkan');
}

public function aktifkan($id)
{
    $user = User::findOrFail($id);
    $user->status = 'aktif';
    $user->save();

    return redirect()->back()->with('success', 'Akun berhasil diaktifkan');
}



}
