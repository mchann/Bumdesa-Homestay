<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    // Middleware untuk otorisasi Pemilik
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan ulasan HANYA untuk homestay milik pemilik yang login.
     */
    public function index()
    {
        $pemilikId = Auth::id();

        $ulasans = Ulasan::with(['homestay', 'pelanggan'])
                         ->whereHas('homestay', function ($query) use ($pemilikId) {
                             $query->where('pemilik_id', $pemilikId);
                         })
                         ->latest()
                         ->paginate(20);

        return view('pemilik.ulasan.index', compact('ulasans'));
    }

    /**
     * Tampilkan detail ulasan (untuk balas/moderasi).
     */
    public function show(Ulasan $ulasan)
    {
        // Otorisasi: Pastikan ulasan ini terkait dengan homestay milik pemilik yang login
        if ($ulasan->homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Ulasan ini bukan untuk homestay Anda.');
        }

        return view('pemilik.ulasan.show', compact('ulasan'));
    }

    /**
     * Balas ulasan.
     */
    public function reply(Request $request, Ulasan $ulasan)
    {
        // Otorisasi
        if ($ulasan->homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'balasan_pemilik' => 'nullable|string|max:1000', // Menggunakan balasan_pemilik
        ]);

        $ulasan->update([
            'balasan_pemilik' => $request->balasan_pemilik,
        ]);

        // Redirect kembali ke show detail ulasan setelah dibalas
        return redirect()->route('pemilik.ulasan.show', $ulasan->ulasan_id)->with('success', 'Balasan ulasan berhasil disimpan.');
    }

    /**
     * Toggle status disembunyikan.
     */
    public function toggleHide(Ulasan $ulasan)
    {
        // Otorisasi
        if ($ulasan->homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $ulasan->update([
            'disembunyikan' => !$ulasan->disembunyikan,
        ]);

        $status = $ulasan->disembunyikan ? 'disembunyikan' : 'ditampilkan';
        // Redirect kembali ke index
        return redirect()->route('pemilik.ulasan.index')->with('success', "Ulasan berhasil $status.");
    }
    
    /**
     * Hapus ulasan permanen (Hanya untuk homestay milik pemilik yang login).
     */
    public function destroy(Ulasan $ulasan)
    {
        // Otorisasi
        if ($ulasan->homestay->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $ulasan->delete();
        // Redirect kembali ke index
        return redirect()->route('pemilik.ulasan.index')->with('success', 'Ulasan berhasil dihapus permanen.');
    }
}
