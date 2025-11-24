<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\PemilikProfile;
use Illuminate\Http\Request;

class PemilikProfileController extends Controller
{
    /** 🧩 Tampilkan profil pemilik homestay */
    public function show()
    {
        $profile = PemilikProfile::where('user_id', auth()->id())->first();

        // Jika belum ada profil, tetap tampilkan view show dengan tombol "Buat Profil"
        return view('pemilik.profile.show', compact('profile'));
    }

    /** 🧩 Form untuk membuat profil baru */
    public function create()
    {
        return view('pemilik.profile.create');
    }

    /** 🧩 Simpan data profil baru */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'nomor_telepon'  => [
                'required',
                'regex:/^[0-9]+$/', // hanya angka
                'digits_between:10,15', // panjang 10–15 digit
            ],
            'alamat'         => 'required|string|max:255',
        ], [
            'nama_lengkap.required'  => 'Nama lengkap wajib diisi.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.regex'    => 'Nomor telepon hanya boleh berisi angka.',
            'nomor_telepon.digits_between' => 'Nomor telepon harus antara 10–15 digit.',
            'alamat.required'        => 'Alamat wajib diisi.',
        ]);

        PemilikProfile::create([
            'user_id'       => auth()->id(),
            'nama_lengkap'  => $request->nama_lengkap,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat'        => $request->alamat,
        ]);

        return redirect()->route('pemilik.profile.show');
    }

    /** 🧩 Form untuk mengedit profil */
    public function edit()
    {
        $profile = PemilikProfile::where('user_id', auth()->id())->first();

        return view('pemilik.profile.edit', compact('profile'));
    }

    /** 🧩 Update data profil */
    public function update(Request $request)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'nomor_telepon'  => [
                'required',
                'regex:/^[0-9]+$/',
                'digits_between:10,15',
            ],
            'alamat'         => 'required|string|max:255',
        ], [
            'nama_lengkap.required'  => 'Nama lengkap wajib diisi.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.regex'    => 'Nomor telepon hanya boleh berisi angka.',
            'nomor_telepon.digits_between' => 'Nomor telepon harus antara 10–15 digit.',
            'alamat.required'        => 'Alamat wajib diisi.',
        ]);

        $profile = PemilikProfile::where('user_id', auth()->id())->first();

        if ($profile) {
            $profile->update([
                'nama_lengkap'  => $request->nama_lengkap,
                'nomor_telepon' => $request->nomor_telepon,
                'alamat'        => $request->alamat,
            ]);
        }

        return redirect()->route('pemilik.profile.show');
    }
}
