<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|unique:fasilitas|max:100'
        ]);

        Fasilitas::create($request->all());

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required|max:100|unique:fasilitas,nama_fasilitas,'.$id.',fasilitas_id'
        ]);

        Fasilitas::find($id)->update($request->all());

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diupdate');
    }

    public function destroy($id)
    {
        Fasilitas::find($id)->delete();
        return redirect()->back()->with('success', 'Fasilitas berhasil dihapus');
    }
}