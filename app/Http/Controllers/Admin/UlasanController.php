<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    // Middleware untuk otorisasi Admin
    public function __construct()
    {
        // Asumsi middleware 'admin' sudah ada
        $this->middleware('auth');
        // $this->middleware('can:manage-ulasan'); // Contoh otorisasi yang lebih spesifik
    }

    /**
     * Tampilkan semua ulasan (Global).
     */
    public function index()
    {
        // Memastikan relasi homestay dan pelanggan dimuat
        $ulasans = Ulasan::with(['homestay', 'pelanggan'])
                         ->latest()
                         ->paginate(20);

        return view('admin.ulasan.index', compact('ulasans'));
    }

    /**
     * Tampilkan detail ulasan (untuk balas/moderasi).
     */
    public function show(Ulasan $ulasan)
    {
        return view('admin.ulasan.show', compact('ulasan'));
    }

    /**
     * Balas ulasan.
     */
    public function reply(Request $request, Ulasan $ulasan)
    {
        $request->validate([
            'balasan_admin' => 'nullable|string|max:1000',
        ]);

        $ulasan->update([
            'balasan_admin' => $request->balasan_admin,
        ]);

        // Redirect kembali ke index
        return redirect()->route('admin.ulasan.index')->with('success', 'Balasan ulasan berhasil disimpan.');
    }

    /**
     * Toggle status disembunyikan.
     */
    public function toggleHide(Ulasan $ulasan)
    {
        $ulasan->update([
            'disembunyikan' => !$ulasan->disembunyikan,
        ]);

        $status = $ulasan->disembunyikan ? 'disembunyikan' : 'ditampilkan';
        // Redirect kembali ke index
        return redirect()->route('admin.ulasan.index')->with('success', "Ulasan berhasil $status.");
    }

    /**
     * Hapus ulasan permanen (Admin).
     */
    public function destroy(Ulasan $ulasan)
    {
        $ulasan->delete();
        // Redirect kembali ke index
        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil dihapus permanen.');
    }
}