<?php

namespace App\Http\Controllers\Pelanggan;

use Illuminate\Http\Request;
use App\Models\PelangganProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

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
            Log::error('Error showing profile: ' . $e->getMessage(), ['user_id' => Auth::id()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menampilkan profil.');
        }
    }

    /**
     * Menampilkan form edit profil
     */
    public function edit()
    {
        try {
            $profile = Auth::user()->pelangganProfile;
            return view('pelanggan.edit-profile', compact('profile'));

        } catch (\Exception $e) {
            Log::error('Error editing profile: ' . $e->getMessage(), ['user_id' => Auth::id()]);
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
            'jenis_kelamin' => ['required', Rule::in(['Male', 'Female'])],
            'tgl_lahir' => 'required|date|before_or_equal:today|after:1900-01-01',
        ], [
            'nomor_telepon.regex' => 'Nomor telepon hanya boleh mengandung angka',
            'tgl_lahir.before_or_equal' => 'Tanggal lahir tidak boleh melebihi hari ini',
            'tgl_lahir.after' => 'Tanggal lahir tidak boleh terlalu lama',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
        ]);

        // Custom validation untuk umur minimal 17 tahun (server-side)
        $birthDate = new \DateTime($validatedData['tgl_lahir']);
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y;
        if ($age < 17) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['tgl_lahir' => 'Umur minimal 17 tahun.']);
        }

        try {
            // Gunakan updateOrCreate berdasarkan user_id (aman untuk primary key standar)
            // Ini akan create jika belum ada (auto-set id), update jika ada
            $profile = PelangganProfile::updateOrCreate(
                ['user_id' => Auth::id()],  // Cari berdasarkan user_id (harus unique)
                $validatedData  // Data untuk create/update (user_id sudah di-set di kondisi pertama)
            );

            Log::info('Profile updated/created successfully', [
                'user_id' => Auth::id(), 
                'profile_id' => $profile->id,  // Akan log ID primary key
                'data' => $validatedData
            ]);

            return redirect()->route('pelanggan.profile')
                ->with('success', 'Profil berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'validated_data' => $validatedData,
                'sql' => $e->getSql(),  // Log query SQL untuk debug
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui profil: ' . $e->getMessage());
        }
    }
}