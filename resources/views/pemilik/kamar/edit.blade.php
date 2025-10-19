@extends('layouts.pemilik')

@section('title', 'Edit Kamar')

@section('content')
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --primary-light: #d1fae5;
            --secondary: #3b82f6;
            --accent: #f59e0b;
            --dark: #1f2937;
            --light: #f8fafc;
            --gray: #6b7280;
            --gray-light: #e5e7eb;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            min-height: 100vh;
        }
    </style>
</head>

<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-lg mb-4 ring-2 ring-green-100">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Kamar</h1>
            <p class="text-lg text-gray-600 max-w-md mx-auto">Perbarui detail kamar untuk meningkatkan pengalaman tamu Anda</p>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-green-100">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">Informasi Kamar</h2>
                <p class="text-green-100 text-sm">Lengkapi data kamar dengan informasi yang akurat</p>
            </div>
            
            <div class="p-6 sm:p-8">
                <form action="{{ route('pemilik.kamar.update', $kamar->kamar_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Homestay Selection -->
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-800 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Pilih Homestay
                            </label>
                            <div class="relative">
                                <select name="homestay_id" class="w-full pl-4 pr-10 py-3 text-base border-2 border-green-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 rounded-xl transition-all duration-200 bg-white text-gray-800 hover:border-green-300" required>
                                    @foreach($homestays as $homestay)
                                        <option value="{{ $homestay->homestay_id }}" 
                                            {{ $kamar->homestay_id == $homestay->homestay_id ? 'selected' : '' }}
                                            class="text-gray-800 py-2">
                                            {{ $homestay->nama_homestay }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                            @error('homestay_id')
                                <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Jenis Kamar Selection -->
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-800 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                Jenis Kamar
                            </label>
                            <div class="relative">
                                <select name="jenis_kamar_id" id="jenis_kamar_id" class="w-full pl-4 pr-10 py-3 border-2 border-green-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white text-gray-800 hover:border-green-300" required>
                                    <option value="" class="text-gray-500">-- Pilih Jenis Kamar --</option>
                                    @foreach ($jenisKamars as $jenis)
                                        <option value="{{ $jenis->jenis_kamar_id }}" 
                                            {{ $kamar->jenis_kamar_id == $jenis->jenis_kamar_id ? 'selected' : '' }}
                                            class="text-gray-800">
                                            {{ $jenis->nama_jenis }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                            @error('jenis_kamar_id')
                                <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Room Name -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                                Nama Kamar
                            </label>
                            <input type="text" name="nama_kamar" 
                                class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white text-gray-800 hover:border-green-300 placeholder-gray-400" 
                                value="{{ old('nama_kamar', $kamar->nama_kamar) }}" 
                                placeholder="Masukkan nama kamar" required>
                            @error('nama_kamar')
                                <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Kapasitas (orang)
                            </label>
                            <input type="number" name="kapasitas" 
                                class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white text-gray-800 hover:border-green-300" 
                                value="{{ old('kapasitas', $kamar->kapasitas) }}" min="1" required>
                            @error('kapasitas')
                                <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                                Harga per Malam
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-green-600 font-medium">Rp</span>
                                </div>
                                <input type="number" name="harga" 
                                    class="w-full pl-12 pr-4 py-3 border-2 border-green-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-white text-gray-800 hover:border-green-300" 
                                    value="{{ old('harga', $kamar->harga) }}" step="1000" required>
                            </div>
                            @error('harga')
                                <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Room Photo -->
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-800 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Foto Kamar
                            </label>
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 p-4 border-2 border-dashed border-green-200 rounded-xl bg-green-50 hover:bg-green-100 transition-all duration-200">
                                <div class="flex-shrink-0">
                                    <div class="relative w-32 h-32 rounded-lg overflow-hidden border-2 border-white shadow-md">
                                        <img id="preview" src="{{ asset('storage/'.$kamar->foto_kamar) }}" alt="Preview" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-10 transition-all duration-200"></div>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="text-center sm:text-left">
                                        <p class="text-sm font-medium text-gray-700 mb-2">Upload foto kamar terbaru</p>
                                        <label class="cursor-pointer">
                                            <div class="inline-flex items-center px-4 py-2 bg-white border border-green-300 rounded-lg shadow-sm text-sm font-medium text-green-700 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                </svg>
                                                Pilih File
                                            </div>
                                            <input type="file" name="foto_kamar" class="hidden" accept="image/*">
                                        </label>
                                        <p class="text-xs text-green-600 mt-2">Format: PNG, JPG, JPEG (Maks. 5MB)</p>
                                    </div>
                                </div>
                            </div>
                            @error('foto_kamar')
                                <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Facilities -->
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                Fasilitas Kamar
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-4 bg-green-50 rounded-xl border border-green-200">
                                @foreach($fasilitas as $f)
                                    <label class="flex items-center p-3 bg-white rounded-lg border border-green-200 hover:border-green-300 hover:shadow-sm transition-all duration-200 cursor-pointer">
                                        <input type="checkbox" name="fasilitas[]" value="{{ $f->fasilitas_id }}" 
                                            {{ in_array($f->fasilitas_id, old('fasilitas', $kamar->fasilitas->pluck('fasilitas_id')->toArray())) ? 'checked' : '' }}
                                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-green-300 rounded transition-all duration-200">
                                        <span class="ml-3 text-sm font-medium text-gray-700">{{ $f->nama_fasilitas }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('fasilitas')
                                <p class="mt-2 text-sm text-red-600 font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 pt-6 border-t border-green-200 flex flex-col sm:flex-row justify-end gap-4">
                        <a href="{{ route('pemilik.kamar.index') }}" 
                            class="inline-flex items-center justify-center px-6 py-3 border-2 border-green-300 text-base font-semibold rounded-xl text-green-700 bg-white hover:bg-green-50 hover:border-green-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" 
                            class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-semibold rounded-xl shadow-lg text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Kamar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview image functionality
    document.querySelector('input[name="foto_kamar"]').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Add hover effects
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-green-200');
            });
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-green-200');
            });
        });
    });
</script>
@endsection