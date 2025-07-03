<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peraturan;
use Illuminate\Http\Request;

class PeraturanController extends Controller
{
    public function index()
    {
        $peraturan = Peraturan::latest()->get();
        return view('admin.peraturan.index', compact('peraturan'));
    }

    public function create()
    {
        return view('admin.peraturan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'isi_peraturan' => 'required|string|max:1000', // Increased max length
        ]);

        Peraturan::create($validated);
        
        return redirect()
            ->route('admin.peraturan.index')
            ->with('create_success', 'Peraturan baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $peraturan = Peraturan::findOrFail($id);
        return view('admin.peraturan.edit', compact('peraturan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'isi_peraturan' => 'required|string|max:1000', // Increased max length
        ]);

        $peraturan = Peraturan::findOrFail($id);
        $peraturan->update($validated);

        return redirect()
            ->route('admin.peraturan.index')
            ->with('update_success', 'Peraturan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $peraturan = Peraturan::findOrFail($id);
        $peraturan->delete();

        return redirect()
            ->route('admin.peraturan.index')
            ->with('delete_success', 'Peraturan berhasil dihapus!');
    }
}