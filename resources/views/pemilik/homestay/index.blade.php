@extends('layouts.pemilik')

@section('title', 'Profil Pemilik')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
       <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kelola Homestay Anda</h1>
                <p class="mt-2 text-lg text-gray-600">Daftar properti homestay yang Anda miliki</p>
            </div>
            @if($canAdd)
            <a href="{{ route('pemilik.homestay.create') }}" 
            class="mt-4 sm:mt-0 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Homestay Baru
            </a>
            @endif
        </div>

        <!-- Homestay Cards Grid -->
        @if($homestays->isEmpty())
            <div class="bg-white shadow rounded-lg p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada homestay</h3>
                <p class="mt-1 text-gray-500">Mulai dengan menambahkan homestay pertama Anda</p>
                <div class="mt-6">
                    <a href="{{ route('pemilik.homestay.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Tambah Homestay
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($homestays as $homestay)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Homestay Image -->
                    @if ($homestay->foto_homestay)
                    <div class="h-48 overflow-hidden">
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $homestay->foto_homestay) }}" alt="{{ $homestay->nama_homestay }}">
                    </div>
                    @else
                    <div class="h-48 bg-gray-100 flex items-center justify-center">
                        <svg class="h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif

                    <!-- Homestay Content -->
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-gray-900">{{ $homestay->nama_homestay }}</h2>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Aktif
                            </span>
                        </div>

                        <!-- Address -->
                        <div class="mt-4 flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm text-gray-500">Alamat</p>
                                <p class="text-sm font-medium text-gray-900">{{ $homestay->alamat_homestay ?? 'Belum diisi' }}</p>
                            </div>
                        </div>

                        <!-- Google Maps Link -->
                        <div class="mt-4 flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm text-gray-500">Lokasi Google Maps</p>
                                @if ($homestay->link_google_maps)
                                    <a href="{{ $homestay->link_google_maps }}" target="_blank" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                        Lihat di Google Maps
                                    </a>
                                @else
                                    <p class="text-sm font-medium text-gray-500">Belum diisi</p>
                                @endif
                            </div>
                        </div>

                        <!-- Map Preview -->
                        @php
                            $lat = null;
                            $lng = null;
                            if ($homestay->link_google_maps && str($homestay->link_google_maps)->contains('@')) {
                                preg_match('/@([-.\d]+),([-.\d]+)/', $homestay->link_google_maps, $matches);
                                $lat = $matches[1] ?? null;
                                $lng = $matches[2] ?? null;
                            }
                        @endphp

                        @if ($lat && $lng)
                        <div class="mt-4">
                            <div class="rounded-lg overflow-hidden border border-gray-200">
                                <iframe 
                                    width="100%" 
                                    height="200" 
                                    frameborder="0" 
                                    style="border:0" 
                                    src="https://www.google.com/maps?q={{ $lat }},{{ $lng }}&hl=es;z=14&output=embed" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                        @endif

                        <!-- Description -->
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Deskripsi</p>
                            <p class="mt-1 text-sm text-gray-900 line-clamp-3">{{ $homestay->deskripsi ?? 'Belum ada deskripsi' }}</p>
                        </div>

                    <!-- Action Buttons -->
                <div class="mt-6 flex justify-between">
                    <a href="{{ route('pemilik.homestay.edit', $homestay->homestay_id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit Homestay Anda
                    </a>
                </div>
                            <form action="#" method="POST" onsubmit="return confirm('Yakin ingin menghapus homestay ini?')">
                                @csrf
                                @method('DELETE')
                                {{-- <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Hapus
                                </button> --}}
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection