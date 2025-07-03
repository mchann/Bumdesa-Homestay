
@extends('layouts.admin')

@section('title', 'Tambah Fasilitas Baru')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Tambah Fasilitas Baru</h2>

        <form action="{{ route('admin.fasilitas.store') }}" method="POST">
            @csrf

            <!-- Nama Fasilitas -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Fasilitas</label>
                <input type="text" name="nama_fasilitas" 
                       class="w-full border rounded py-2 px-3 @error('nama_fasilitas') border-red-500 @enderror" 
                       value="{{ old('nama_fasilitas') }}"
                       placeholder="Contoh: AC, WiFi, TV"
                       required>
                
                @error('nama_fasilitas')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('admin.fasilitas.index') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Kembali
                </a>
                <button type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Simpan Fasilitas
                </button>
            </div>
        </form>
    </div>
</div>
@endsection