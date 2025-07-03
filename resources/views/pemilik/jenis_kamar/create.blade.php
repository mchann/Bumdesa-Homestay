@extends('layouts.pemilik')



@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Notifikasi Flash Message -->
    @if (session('success'))
        <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Jenis Kamar</h2>

        <form action="{{ route('pemilik.jenis-kamar.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="nama_jenis" class="block text-sm font-medium text-gray-700 mb-2">Nama Jenis Kamar</label>
                <input type="text" name="nama_jenis" id="nama_jenis" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                       required>
                @error('nama_jenis')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('pemilik.jenis-kamar.index') }}" 
                   class="inline-block bg-gray-500 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-gray-600 transition duration-200 ease-in-out transform hover:scale-105">
                    Batal
                </a>
                <button type="submit" 
                        class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-green-700 transition duration-200 ease-in-out transform hover:scale-105">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection