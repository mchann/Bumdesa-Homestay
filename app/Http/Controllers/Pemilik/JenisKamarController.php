<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\JenisKamar;
use Illuminate\Http\Request;

class JenisKamarController extends Controller
{
    public function index()
    {
        $jenisKamar = JenisKamar::all();
        return view('admin.jenis_kamar.index', compact('jenisKamar'));
    }

    public function create()
    {
        return view('admin.jenis_kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:100|unique:jenis_kamar,nama_jenis' // UBAH: field 'nama_jenis', table 'jenis_kamar' (singular)
        ]);

        JenisKamar::create([
            'nama_jenis' => $request->nama_jenis, // UBAH: ambil dari 'nama_jenis'
        ]);

        return redirect()->route('admin.jenis-kamar.index')->with('success', 'Jenis kamar berhasil ditambahkan.');
    }

    public function show(JenisKamar $jenis_kamar) // TAMBAH: Untuk resource lengkap (bisa kosong jika tidak digunakan)
    {
        return view('admin.jenis-kamar.show', compact('jenis_kamar'));
    }

    public function destroy(JenisKamar $jenis_kamar)
    {
        $jenis_kamar->delete();
        return redirect()->route('admin.jenis-kamar.index')->with('success', 'Jenis kamar berhasil dihapus.');
    }
}