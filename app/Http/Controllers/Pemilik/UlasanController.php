<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use App\Models\PemilikProfile; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Helper private untuk mendapatkan ID Pemilik dari User yang login
    private function getPemilikId()
    {
        // Asumsi: Tabel pemilik_profiles punya kolom 'user_id' yang berelasi ke tabel users
        $profile = PemilikProfile::where('user_id', Auth::id())->first();
        
        // Jika profil tidak ada, kembalikan null atau handle error
        return $profile ? $profile->pemilik_id : null;
    }

    public function index()
    {
        $pemilikId = $this->getPemilikId();

        if (!$pemilikId) {
            // Opsional: Redirect jika user belum melengkapi profil pemilik
            return redirect()->back()->with('error', 'Profil Pemilik tidak ditemukan.');
        }

        // Query diperbarui menggunakan $pemilikId dari profil, bukan Auth::id()
        $ulasans = Ulasan::with(['homestay', 'pelanggan'])
                         ->whereHas('homestay', function ($query) use ($pemilikId) {
                             $query->where('pemilik_id', $pemilikId);
                         })
                         ->latest()
                         ->paginate(20);

        return view('pemilik.ulasan.index', compact('ulasans'));
    }

    public function show(Ulasan $ulasan)
    {
        $pemilikId = $this->getPemilikId();

        // Validasi kepemilikan diperbaiki
        if ($ulasan->homestay->pemilik_id !== $pemilikId) {
            abort(403, 'Akses ditolak. Ulasan ini bukan untuk homestay Anda.');
        }

        return view('pemilik.ulasan.show', compact('ulasan'));
    }

    public function reply(Request $request, Ulasan $ulasan)
    {
        $pemilikId = $this->getPemilikId();

        // Validasi kepemilikan diperbaiki
        if ($ulasan->homestay->pemilik_id !== $pemilikId) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'balasan_pemilik' => 'nullable|string|max:1000',
        ]);

        $ulasan->update([
            'balasan_pemilik' => $request->balasan_pemilik,
        ]);

        return redirect()->route('pemilik.ulasan.show', $ulasan->ulasan_id)
                         ->with('success', 'Balasan ulasan berhasil disimpan.');
    }

    public function toggleHide(Ulasan $ulasan)
    {
        $pemilikId = $this->getPemilikId();

        // Validasi kepemilikan diperbaiki
        if ($ulasan->homestay->pemilik_id !== $pemilikId) {
            abort(403, 'Akses ditolak.');
        }

        $ulasan->update([
            'disembunyikan' => !$ulasan->disembunyikan,
        ]);

        $status = $ulasan->disembunyikan ? 'disembunyikan' : 'ditampilkan';
        return redirect()->route('pemilik.ulasan.index')->with('success', "Ulasan berhasil $status.");
    }
    
    public function destroy(Ulasan $ulasan)
    {
        $pemilikId = $this->getPemilikId();

        // Validasi kepemilikan diperbaiki
        if ($ulasan->homestay->pemilik_id !== $pemilikId) {
            abort(403, 'Akses ditolak.');
        }

        $ulasan->delete();
        return redirect()->route('pemilik.ulasan.index')->with('success', 'Ulasan berhasil dihapus permanen.');
    }
}