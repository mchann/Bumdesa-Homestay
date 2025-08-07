<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Homestay;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PemilikProfile;
use App\Models\Fasilitas;
use App\Models\JenisKamar; 

class KamarController extends Controller
{
    // Mendapatkan homestay milik pemilik
    private function getPemilikHomestays()
    {
        $profile = PemilikProfile::where('user_id', Auth::id())->firstOrFail();
        return Homestay::where('pemilik_id', $profile->pemilik_id)->get();
    }

    // Menampilkan daftar kamar
   // Menampilkan daftar kamar
public function index()
{
    $homestays = $this->getPemilikHomestays();

    $kamars = Kamar::whereIn('homestay_id', $homestays->pluck('homestay_id'))
        ->with(['homestay', 'fasilitas', 'jenisKamar', 'penutupanTerbaru'])
        ->get();

    return view('pemilik.kamar.index', compact('kamars'));
}


    // Menampilkan form untuk menambah kamar
   public function create()
{
    $homestays = $this->getPemilikHomestays();
    $fasilitas = Fasilitas::all();
    $jenisKamars = JenisKamar::all();

    return view('pemilik.kamar.create', compact('homestays', 'fasilitas', 'jenisKamars'));
}

    // Menyimpan data kamar yang baru ditambahkan
    public function store(Request $request)
    {
        // dd($request->jenis_kamar_id);

        //  dd($request->all());
        $validated = $request->validate([
            'homestay_id' => 'required|exists:homestays,homestay_id,pemilik_id,'.Auth::user()->pemilikProfile->pemilik_id,
            'jenis_kamar_id' => 'required|exists:jenis_kamar,jenis_kamar_id',
            'nama_kamar' => 'required|max:100',
            'kapasitas' => 'required|max:10',
            'harga' => 'required|numeric',
            'foto_kamar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            
        ]);
    
        // Menyimpan foto kamar
        $imagePath = $request->file('foto_kamar')->store('kamar', 'public');
    
        // Menyimpan data kamar
        $kamar = Kamar::create([
            'homestay_id' => $validated['homestay_id'],
            'jenis_kamar_id' => $validated['jenis_kamar_id'],
            'nama_kamar' => $validated['nama_kamar'],
            'kapasitas' => $validated['kapasitas'],
            'harga' => $validated['harga'],
            'foto_kamar' => $imagePath
        ]);
    
        // Menyimpan fasilitas yang dipilih ke dalam tabel pivot
        if ($request->has('fasilitas')) {
            $kamar->fasilitas()->sync($request->fasilitas); // Menyimpan relasi ke kamar_fasilitas
        }
    
        return redirect()->route('pemilik.kamar.index')->with('success', 'Kamar berhasil ditambahkan');
    }
    
    // Menampilkan form untuk mengedit kamar
    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        $homestays = $this->getPemilikHomestays();
        $fasilitas = Fasilitas::all();
        $jenisKamars = JenisKamar::all(); // Ambil jenis kamar juga

        return view('pemilik.kamar.edit', compact('kamar', 'homestays', 'fasilitas', 'jenisKamars'));
    }

    // Mengupdate data kamar yang sudah ada
    public function update(Request $request, $id)
    {
        $kamar = Kamar::whereIn('homestay_id', $this->getPemilikHomestays()->pluck('homestay_id'))
                    ->findOrFail($id);

        $validated = $request->validate([
            'homestay_id' => 'required|exists:homestays,homestay_id,pemilik_id,'.Auth::user()->pemilikProfile->pemilik_id,
            'nama_kamar' => 'required|max:100',
            'kapasitas' => 'required|max:10',
            'harga' => 'required|numeric',
            'foto_kamar' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'jenis_kamar_id' => 'required|exists:jenis_kamar,jenis_kamar_id'
        ]);

        // Update foto kamar jika ada
        if($request->hasFile('foto_kamar')){
            Storage::delete('public/'.$kamar->foto_kamar); // Menghapus foto lama
            $validated['foto_kamar'] = $request->file('foto_kamar')->store('kamar', 'public'); // Menyimpan foto baru
        }

        $kamar->update($validated);
        $kamar->fasilitas()->sync($request->fasilitas); // Sinkronisasi fasilitas

        return redirect()->route('pemilik.kamar.index')->with('success', 'Kamar berhasil diupdate');
    }

    // Menghapus kamar
    public function destroy($id)
    {
        $kamar = Kamar::whereIn('homestay_id', $this->getPemilikHomestays()->pluck('homestay_id'))
                    ->findOrFail($id);
                    
        Storage::delete('public/'.$kamar->foto_kamar); // Menghapus foto
        $kamar->delete(); // Menghapus data kamar

        return redirect()->back()->with('success', 'Kamar berhasil dihapus');
    }
}
