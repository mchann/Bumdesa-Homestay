@extends('layouts.admin')

@section('title', 'Tambah Jenis Kamar Baru')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Tambah Jenis Kamar Baru</h2>

        <form action="{{ route('admin.jenis-kamar.store') }}" method="POST">
            @csrf

            <!-- Nama Jenis Kamar (UBAH: name, old, error ke 'nama_jenis') -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Jenis Kamar</label>
                <input type="text" name="nama_jenis" 
                       class="w-full border rounded py-2 px-3 @error('nama_jenis') border-red-500 @enderror" 
                       value="{{ old('nama_jenis') }}"
                       placeholder="Contoh: Standard, Deluxe, Suite"
                       required>
                
                @error('nama_jenis')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol (tetap sama) -->
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('admin.jenis-kamar.index') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Kembali
                </a>
                <button type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Simpan Jenis Kamar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection