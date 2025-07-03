<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Homestay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PemilikProfile;
use App\Models\Peraturan;
use App\Models\Kamar;
use App\Models\Pemesanan;


class HomestayController extends Controller
{
    public function index()
    {
        $profile = PemilikProfile::where('user_id', Auth::id())->firstOrFail();
        $homestays = Homestay::where('pemilik_id', $profile->pemilik_id)->get();
    
        return view('pemilik.homestay.index', [
            'homestays' => $homestays,
            'canAdd' => $homestays->isEmpty(), 
        ]);
    }
    
    
    public function create()
    {
        $peraturan = Peraturan::all();
         return view('pemilik.homestay.create', compact('peraturan'));
        
    }

   
public function store(Request $request)
{
    $request->validate([
        'nama_homestay' => 'required|string|max:255',
        'foto_homestay' => 'required|image|max:5120',
        'link_google_maps' => 'required|url',
        'deskripsi' => 'nullable|string',
        'alamat_homestay' => 'required|string',
        'peraturan' => 'nullable|array',
    ]);

    // ambilprofil pemilik
    $profile = PemilikProfile::where('user_id', Auth::id())->firstOrFail();

    // Upload foto
    $path = $request->file('foto_homestay')->store('foto_homestay', 'public');

    // bkin hmstay 
    $homestay = Homestay::create([
        'nama_homestay' => $request->nama_homestay,
        'foto_homestay' => $path,
        'link_google_maps' => $request->link_google_maps, 
        'deskripsi' => $request->deskripsi,
        'alamat_homestay' => $request->alamat_homestay,
        'pemilik_id' => $profile->pemilik_id, 
    ]);

    // Sinkronisasi peraturan
    if ($request->filled('peraturan')) {
        $homestay->peraturan()->sync($request->peraturan);
    }

    return redirect()->route('pemilik.homestay.index')->with('success', 'Homestay berhasil ditambahkan!');
}
    

    public function edit($id)
    {
    $profile = PemilikProfile::where('user_id', Auth::id())->firstOrFail();
    $homestay = Homestay::where('pemilik_id', $profile->pemilik_id)->findOrFail($id);

        // $homestay = Homestay::where('pemilik_id', Auth::id())->findOrFail($id);
        $peraturan = Peraturan::all();
        return view('pemilik.homestay.edit', compact('homestay', 'peraturan'));
    }

    public function update(Request $request, $id)
    {
        $profile = PemilikProfile::where('user_id', Auth::id())->firstOrFail();
        $homestay = Homestay::where('pemilik_id', $profile->pemilik_id)->findOrFail($id);
        // $homestay = Homestay::where('pemilik_id', Auth::id())->findOrFail($id);

        $request->validate([
            'nama_homestay'     => 'required|string|max:100',
            'link_google_maps'  => 'required|string',
            'alamat_homestay'   => 'required|string',
            'deskripsi'         => 'nullable|string',
            'peraturan'         => 'required|array',
            'foto_homestay'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only([
            'nama_homestay', 'link_google_maps', 'alamat_homestay',
            'deskripsi'
        ]);
        
        if ($request->hasFile('foto_homestay')) {
            $data['foto_homestay'] = $request->file('foto_homestay')->store('homestay', 'public');
        }
        
        $homestay->update($data);
        $homestay = Homestay::with('peraturan')->where('pemilik_id', $profile->pemilik_id)->findOrFail($id);

        $homestay->peraturan()->sync($request->peraturan);
        return redirect()->route('pemilik.homestay.index')->with('success', 'Homestay berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $homestay = Homestay::where('pemilik_id', Auth::id())->findOrFail($id);
        $homestay->delete();

        return redirect()->route('pemilik.homestay.index')->with('success', 'Homestay berhasil dihapus!');
    }


// public function show($id) {
//     $homestay = Homestay::where('id', $id)->with('kamar')->firstOrFail();

//     $kamarGroup = $homestay->kamar->groupBy('nama_kamar')->map(function ($group) {
//         return [
//             'nama_kamar' => $group->first()->nama_kamar,
//             'harga' => $group->first()->harga,
//             'foto_kamar' => $group->first()->foto_kamar,
//             'kapasitas' => $group->first()->kapasitas,
//             'tipe_tempat_tidur' => $group->first()->tipe_tempat_tidur,
//             'ukuran_kamar' => $group->first()->ukuran_kamar,
//             'deskripsi_kamar' => $group->first()->deskripsi_kamar,
//             'stok' => $group->count(),
//         ];
//     });

//     return view('page.homestay_detail', [
//         'title' => 'Detail Homestay',
//         'homestay' => $homestay,
//         'kamarGroup' => $kamarGroup,
//     ]);
// }


}