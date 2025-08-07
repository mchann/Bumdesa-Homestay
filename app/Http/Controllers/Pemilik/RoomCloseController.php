<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\RoomClose;

class RoomCloseController extends Controller
{
    // Tampilkan form tutup kamar
    public function create($kamar_id)
    {
        $kamar = Kamar::findOrFail($kamar_id);
        return view('pemilik.room_close.create', compact('kamar'));
    }

    // Simpan data tutup kamar
    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamar,kamar_id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'alasan' => 'nullable|string|max:255',
        ]);

        RoomClose::create([
        'kamar_id' => $request->kamar_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'alasan' => $request->alasan,
    ]);


        return redirect()->route('pemilik.kamar.index')->with('success', 'Kamar berhasil ditutup pada tanggal yang dipilih.');
    }
}
