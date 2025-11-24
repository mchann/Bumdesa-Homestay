<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UmkmProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminUmkmController extends Controller
{
    public function index(Request $request)
    {
        $query = UmkmProduct::query();

        // Filter pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_produk', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
                  ->orWhere('no_telepon_owner', 'like', '%' . $request->search . '%');
        }

        // Filter kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $products = $query->latest()->paginate(10);
        $categories = UmkmProduct::distinct()->pluck('kategori');

        return view('admin.umkm.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = [
            'Makanan & Minuman',
            'Kerajinan Tangan',
            'Fashion',
            'Kecantikan',
            'Pertanian',
            'Lainnya'
        ];

        return view('admin.umkm.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_telepon_owner' => 'required|string|max:15|regex:/^62[0-9]{9,12}$/',
            'stok' => 'required|integer|min:0',
            'berat' => 'required|numeric|min:0',
            'satuan_berat' => 'required|string|in:gr,kg,ml',
            'tags' => 'nullable|string',
            'badge' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        // Format nomor telepon untuk WhatsApp
        $validated['no_telepon_owner'] = $this->formatPhoneNumber($validated['no_telepon_owner']);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('umkm-products', 'public');
            $validated['gambar'] = $imagePath;
        }

        // Generate slug
        $validated['slug'] = Str::slug($validated['nama_produk']) . '-' . time();

        // Convert tags to array
        if ($request->tags) {
            $validated['tags'] = array_map('trim', explode(',', $request->tags));
        }

        // Set default values
        $validated['rating'] = 0;
        $validated['terjual'] = 0;

        UmkmProduct::create($validated);

        return redirect()->route('admin.umkm.index')
                        ->with('success', 'Produk UMKM berhasil ditambahkan!');
    }

    public function edit(UmkmProduct $umkm)
    {
        $categories = [
            'Makanan & Minuman',
            'Kerajinan Tangan',
            'Fashion',
            'Kecantikan',
            'Pertanian',
            'Lainnya'
        ];

        return view('admin.umkm.edit', compact('umkm', 'categories'));
    }

    public function update(Request $request, UmkmProduct $umkm)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_telepon_owner' => 'required|string|max:15|regex:/^62[0-9]{9,12}$/',
            'stok' => 'required|integer|min:0',
            'berat' => 'required|numeric|min:0',
            'satuan_berat' => 'required|string|in:gr,kg,ml',
            'tags' => 'nullable|string',
            'badge' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        // Format nomor telepon untuk WhatsApp
        $validated['no_telepon_owner'] = $this->formatPhoneNumber($validated['no_telepon_owner']);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($umkm->gambar) {
                Storage::disk('public')->delete($umkm->gambar);
            }
            
            $imagePath = $request->file('gambar')->store('umkm-products', 'public');
            $validated['gambar'] = $imagePath;
        } else {
            // Pertahankan gambar lama jika tidak ada gambar baru
            unset($validated['gambar']);
        }

        // Update slug jika nama produk berubah
        if ($umkm->nama_produk != $validated['nama_produk']) {
            $validated['slug'] = Str::slug($validated['nama_produk']) . '-' . time();
        }

        // Convert tags to array
        if ($request->tags) {
            $validated['tags'] = array_map('trim', explode(',', $request->tags));
        } else {
            $validated['tags'] = null;
        }

        $umkm->update($validated);

        return redirect()->route('admin.umkm.index')
                        ->with('success', 'Produk UMKM berhasil diperbarui!');
    }

    public function destroy(UmkmProduct $umkm)
    {
        // Hapus gambar
        if ($umkm->gambar) {
            Storage::disk('public')->delete($umkm->gambar);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index')
                        ->with('success', 'Produk UMKM berhasil dihapus!');
    }

    public function updateStatus(Request $request, UmkmProduct $umkm)
    {
        $request->validate([
            'status' => 'required|in:active,inactive'
        ]);

        $umkm->update(['status' => $request->status]);

        return response()->json(['message' => 'Status berhasil diperbarui!']);
    }

    // Method untuk bulk actions
    public function bulkAction(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'action' => 'required|in:activate,deactivate,delete'
        ]);

        $ids = $request->ids;

        switch ($request->action) {
            case 'activate':
                UmkmProduct::whereIn('id', $ids)->update(['status' => 'active']);
                $message = 'Produk berhasil diaktifkan!';
                break;

            case 'deactivate':
                UmkmProduct::whereIn('id', $ids)->update(['status' => 'inactive']);
                $message = 'Produk berhasil dinonaktifkan!';
                break;

            case 'delete':
                $products = UmkmProduct::whereIn('id', $ids)->get();
                foreach ($products as $product) {
                    if ($product->gambar) {
                        Storage::disk('public')->delete($product->gambar);
                    }
                    $product->delete();
                }
                $message = 'Produk berhasil dihapus!';
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    // Method untuk export data (placeholder)
    public function export(Request $request)
    {
        // Implementasi export data bisa ditambahkan di sini
        return redirect()->back()->with('info', 'Fitur export akan segera tersedia.');
    }

    /**
     * Format nomor telepon untuk WhatsApp
     * Mengubah format: 08xxx, +628xxx, 628xxx menjadi 62xxxxxxxxxx
     */
    private function formatPhoneNumber($phoneNumber)
    {
        // Hapus semua karakter non-digit
        $cleanNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // Jika diawali dengan 0, ganti dengan 62
        if (substr($cleanNumber, 0, 1) === '0') {
            $cleanNumber = '62' . substr($cleanNumber, 1);
        }
        
        // Jika diawali dengan 620, perbaiki (harusnya 62)
        if (substr($cleanNumber, 0, 3) === '620') {
            $cleanNumber = '62' . substr($cleanNumber, 3);
        }
        
        return $cleanNumber;
    }

    /**
     * Bulk update untuk memperbaiki format nomor telepon yang sudah ada
     */
    public function fixPhoneNumbers()
    {
        $products = UmkmProduct::all();
        $updatedCount = 0;

        foreach ($products as $product) {
            $originalNumber = $product->no_telepon_owner;
            $formattedNumber = $this->formatPhoneNumber($originalNumber);
            
            if ($originalNumber !== $formattedNumber) {
                $product->update(['no_telepon_owner' => $formattedNumber]);
                $updatedCount++;
            }
        }

        return redirect()->back()->with('success', "Berhasil memperbaiki format {$updatedCount} nomor telepon!");
    }
}