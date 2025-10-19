@extends('layouts.pemilik')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Enhanced Flash Notifications -->
    @if (session('success'))
        <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border-l-4 border-green-500 text-green-700 px-6 py-3 rounded-lg shadow-lg animate-fade-in-out">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border-l-4 border-red-500 text-red-700 px-6 py-3 rounded-lg shadow-lg animate-fade-in-out">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Kamar Homestay</h1>
            <p class="text-gray-600">Kelola semua kamar yang tersedia di homestay Anda</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('pemilik.kamar.create') }}" 
               class="flex items-center bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Kamar
            </a>
        </div>
    </div>

    <!-- Room Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($kamars as $kamar)
        <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            <!-- Room Image with Overlay -->
            <div class="relative h-64 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent z-10"></div>
                <img src="{{ $kamar->foto_kamar ? asset('storage/'.$kamar->foto_kamar) : 'https://via.placeholder.com/600x400' }}" 
                     alt="{{ $kamar->nama_kamar }}" 
                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                
                <!-- Price Tag -->
                <div class="absolute bottom-4 left-4 z-20 bg-white/90 px-3 py-1 rounded-full shadow">
                    <span class="font-bold text-indigo-600">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                </div>
                
                <!-- Action Buttons -->
                <div class="absolute top-4 right-4 z-20 flex space-x-2">
                    <a href="{{ url('pemilik/kamar/' . $kamar->kamar_id . '/tutup') }}"
                        class="bg-white/90 text-yellow-600 p-2 rounded-full shadow-md hover:bg-yellow-500 hover:text-white transition-all duration-200"
                        title="Tutup Kamar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </a>

                    <a href="{{ route('pemilik.kamar.edit', $kamar->kamar_id) }}" 
                       class="bg-white/90 text-blue-600 p-2 rounded-full shadow-md hover:bg-blue-600 hover:text-white transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                    <form action="{{ route('pemilik.kamar.destroy', $kamar->kamar_id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="bg-white/90 text-red-600 p-2 rounded-full shadow-md hover:bg-red-600 hover:text-white transition-all duration-200"
                                onclick="return confirm('Yakin menghapus kamar?')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Room Details -->
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $kamar->nama_kamar }}</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            {{ $kamar->homestay->nama_homestay }}
                        </p>
                    </div>
                    <span class="bg-indigo-100 text-indigo-800 text-xs px-3 py-1 rounded-full font-medium">
                        {{ $kamar->jenisKamar->nama_jenis ?? '-' }}
                    </span>
                </div>


                 <!-- Penutupan Kamar -->
    @if($kamar->penutupanTerbaru)
        <div class="mt-4 bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded-lg text-sm text-yellow-800">
            <strong>Kamar Ditutup:</strong><br>
            {{ \Carbon\Carbon::parse($kamar->penutupanTerbaru->start_date)->format('d M Y') }} - 
            {{ \Carbon\Carbon::parse($kamar->penutupanTerbaru->end_date)->format('d M Y') }}<br>
            <span class="italic">Alasan: {{ $kamar->penutupanTerbaru->alasan }}</span>
        </div>
    @endif
                
                <!-- Room Info -->
                <div class="mt-4 flex items-center space-x-4 text-sm">
                    <span class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        {{ $kamar->kapasitas }} orang
                    </span>
                </div>
                
                <!-- Facilities -->
                <div class="mt-5 pt-4 border-t border-gray-100">
                    <h4 class="text-sm font-semibold text-gray-600 mb-2">Fasilitas:</h4>
                    <div class="flex flex-wrap gap-2">
                        @forelse($kamar->fasilitas as $fasilitas)
                            <span class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full flex items-center">
                                <svg class="w-3 h-3 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ $fasilitas->nama_fasilitas }}
                            </span>
                        @empty
                            <span class="text-gray-400 italic text-xs">Belum ada fasilitas</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .animate-fade-in-out {
        animation: fadeInOut 3s ease-in-out forwards;
    }
    @keyframes fadeInOut {
        0% { opacity: 0; transform: translateY(-20px) translateX(-50%); }
        10% { opacity: 1; transform: translateY(0) translateX(-50%); }
        90% { opacity: 1; transform: translateY(0) translateX(-50%); }
        100% { opacity: 0; transform: translateY(-20px) translateX(-50%); }
    }
</style>
@endsection