<?php

namespace App\Http\Controllers\Pelanggan;

use App\Models\Pemesanan;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log; // Tambahkan ini

class UlasanController extends Controller
{
    // Cek apakah user sudah login
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan form untuk membuat atau mengedit ulasan.
     */
    public function createEdit(Pemesanan $pemesanan)
    {
        // Validasi kepemilikan
        if ($pemesanan->pelanggan_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Ini bukan pemesanan Anda.');
        }

        // Cek kriteria ulasan
        if (!$pemesanan->bisa_beri_ulasan && is_null($pemesanan->ulasan)) {
            return redirect()->route('pelanggan.pemesanan.detail', $pemesanan->pemesanan_id)
                             ->with('error', 'Pemesanan ini belum memenuhi syarat untuk diulas.');
        }

        $ulasan = $pemesanan->ulasan ?? new Ulasan(); // Jika sudah ada, tampilkan. Jika belum, buat baru.
        // Halaman ini sekarang menjadi tujuan redirect langsung
        return view('pelanggan.ulasan.form', compact('pemesanan', 'ulasan'));
    }

    /**
     * Simpan (Store/Update) ulasan.
     */
    public function storeUpdate(Request $request, Pemesanan $pemesanan)
    {
        // Validasi kepemilikan
        if ($pemesanan->pelanggan_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Ini bukan pemesanan Anda.');
        }

        $isUpdate = $pemesanan->ulasan()->exists();

        // Jika mode buat baru, cek kriteria ulasan
        if (!$isUpdate && !$pemesanan->bisa_beri_ulasan) {
            return redirect()->route('pelanggan.pemesanan.detail', $pemesanan->pemesanan_id)
                             ->with('error', 'Pemesanan ini belum memenuhi syarat untuk diulas.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
        ]);

        try {
            // Data ulasan
            $data = [
                'rating' => $request->rating,
                'komentar' => $request->komentar,
                'homestay_id' => $pemesanan->homestay_id,
                'pelanggan_id' => Auth::id(),
            ];

            if ($isUpdate) {
                // Update ulasan
                $pemesanan->ulasan->update($data);
                $message = 'Ulasan berhasil diubah.';
            } else {
                // Buat ulasan baru
                $pemesanan->ulasan()->create($data);
                $message = 'Ulasan berhasil disimpan.';
            }

            // KEMBALI KE FLOW REDIRECT STANDAR
            return redirect()->route('pelanggan.history')
                             ->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error simpan ulasan: ' . $e->getMessage(), $request->all());
            return back()->with('error', 'Gagal menyimpan ulasan. Pastikan Anda hanya memberi ulasan satu kali.')->withInput();
        }
    }

    /**
     * Hapus ulasan.
     */
    public function destroy(Pemesanan $pemesanan)
    {
        // Validasi kepemilikan dan keberadaan ulasan
        if ($pemesanan->pelanggan_id !== Auth::id() || is_null($pemesanan->ulasan)) {
            abort(403, 'Akses ditolak atau ulasan tidak ditemukan.');
        }

        $pemesanan->ulasan->delete();

        return redirect()->route('pelanggan.pemesanan.detail', $pemesanan->pemesanan_id)
                         ->with('success', 'Ulasan berhasil dihapus.');
    }
}
