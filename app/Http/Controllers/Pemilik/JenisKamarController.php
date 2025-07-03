<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\JenisKamar;
use Illuminate\Http\Request;

class JenisKamarController extends Controller
{
    public function index()
    {
        $jenis_kamar = JenisKamar::all();
        return view('pemilik.jenis_kamar.index', compact('jenis_kamar'));
    }

    public function create()
    {
        return view('pemilik.jenis_kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:100'
        ]);

        JenisKamar::create($request->all());

        return redirect()->route('pemilik.jenis-kamar.index')->with('success', 'Jenis kamar berhasil ditambahkan.');
    }

    public function edit(JenisKamar $jenis_kamar)
    {
        return view('pemilik.jenis_kamar.edit', compact('jenis_kamar'));
    }

    public function update(Request $request, JenisKamar $jenis_kamar)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:100'
        ]);

        $jenis_kamar->update($request->all());

        return redirect()->route('pemilik.jenis-kamar.index')->with('success', 'Jenis kamar berhasil diperbarui.');
    }

    public function destroy(JenisKamar $jenis_kamar)
    {
        $jenis_kamar->delete();
        return redirect()->route('pemilik.jenis-kamar.index')->with('success', 'Jenis kamar berhasil dihapus.');
    }
}
