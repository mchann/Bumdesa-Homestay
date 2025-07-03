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

    <!-- Button Add Jenis Kamar -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Jenis Kamar</h1>
        <a href="{{ route('pemilik.jenis-kamar.create') }}" 
           class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-green-700 transition duration-200 ease-in-out transform hover:scale-105">
            + Tambah Jenis Kamar
        </a>
    </div>

    <!-- Jenis Kamar Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($jenis_kamar as $jenis)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $jenis->nama_jenis }}</h3>
                
                <!-- Action Buttons -->
                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('pemilik.jenis-kamar.edit', $jenis->jenis_kamar_id) }}" 
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-200 ease-in-out transform hover:scale-105">
                        Edit
                    </a>
                    <form action="{{ route('pemilik.jenis-kamar.destroy', $jenis->jenis_kamar_id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-700 transition duration-200 ease-in-out transform hover:scale-105"
                                onclick="return confirm('Hapus jenis kamar ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection