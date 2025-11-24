<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKamar;
use App\Http\Requests\StoreJenisKamarRequest; 
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

    /**
     * Menggunakan StoreJenisKamarRequest yang memiliki:
     * 1. Rule 'required' dan 'unique' (untuk TC-JK-002 & TC-JK-003)
     * 2. Rule 'regex' keamanan (untuk TC-JK-006 & TC-JK-007)
     */
    public function store(StoreJenisKamarRequest $request)
    {
        // Validasi otomatis dijalankan oleh StoreJenisKamarRequest.
        // Jika input XSS/SQLI masuk, validasi gagal, dan assertSessionHasErrors() di test akan terpenuhi.
        
        JenisKamar::create($request->validated());

        return redirect()->route('admin.jenis-kamar.index')->with('success', 'Jenis kamar berhasil ditambahkan.');
    }

    public function show(JenisKamar $jenis_kamar)
    {
        return view('admin.jenis-kamar.show', compact('jenis_kamar'));
    }

    public function destroy(JenisKamar $jenis_kamar)
    {
        $jenis_kamar->delete();
        return redirect()->route('admin.jenis-kamar.index')->with('success', 'Jenis kamar berhasil dihapus.');
    }
}
