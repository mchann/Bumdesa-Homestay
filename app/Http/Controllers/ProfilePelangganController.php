<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfilePelangganController extends Controller
{
    /**
     * Menampilkan profil pelanggan
     */
    public function show()
    {
        try {
            $profile = Auth::user()->pelangganProfile;

            if (!$profile) {
                return redirect()->route('pelanggan.profile.edit')
                    ->with('info', 'Silakan lengkapi profil Anda terlebih dahulu.');
            }

            return view('pelanggan.profile', compact('profile'));

        } catch (\Exception $e) {
            Log::error('Error showing profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menampilkan profil.');
        }
    }

    /**
     * Menampilkan form edit profil
     */
    public function edit()
    {
        try {
            $profile = Auth::user()->pelangganProfile ?? new PelangganProfile();
            return view('pelanggan.edit-profile', compact('profile'));

        } catch (\Exception $e) {
            Log::error('Error editing profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuka form edit profil.');
        }
    }

    /**
     * Memperbarui profil pelanggan
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:20|regex:/^[0-9]+$/',
            'kewarganegaraan' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Male,Female',
            'tgl_lahir' => 'required|date|before_or_equal:today|after:1900-01-01',
        ], [
            'nomor_telepon.regex' => 'Nomor telepon hanya boleh mengandung angka',
            'tgl_lahir.before_or_equal' => 'Tanggal lahir tidak boleh melebihi hari ini',
            'tgl_lahir.after' => 'Tanggal lahir tidak boleh terlalu lama',
        ]);

        try {
            PelangganProfile::updateOrCreate(
                ['user_id' => Auth::id()],
                array_merge($validatedData, ['user_id' => Auth::id()])
            );

            return redirect()->route('pelanggan.profile')
                ->with('success', 'Profil berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui profil. Silakan coba lagi.');
        }
    }
}
