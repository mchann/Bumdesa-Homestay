@extends('layouts.pemilik')

@section('title', 'Edit Kamar')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Edit Kamar</h1>
            <p class="mt-2 text-lg text-gray-700">Perbarui detail kamar untuk homestay Anda</p>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('pemilik.kamar.update', $kamar->kamar_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Homestay Selection -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-800 mb-1">Pilih Homestay</label>
                            <div class="relative">
                                <select name="homestay_id" class="w-full pl-3 pr-10 py-3 text-base border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 rounded-lg transition duration-150 bg-white text-gray-800" required>
                                    @foreach($homestays as $homestay)
                                        <option value="{{ $homestay->homestay_id }}" 
                                            {{ $kamar->homestay_id == $homestay->homestay_id ? 'selected' : '' }}
                                            class="text-gray-800">
                                            {{ $homestay->nama_homestay }}
                                        </option>
                                    @endforeach
                                </select>
                                
                               <!-- Jenis Kamar Selection -->
                                <div class="mt-4">
                                    <label class="block text-sm font-bold text-gray-800 mb-1" for="jenis_kamar_id">Jenis Kamar</label>
                                    <div class="relative">
                                        <select 
                                            name="jenis_kamar_id" 
                                            id="jenis_kamar_id" 
                                            class="w-full pl-3 pr-10 py-3 border-2 border-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 bg-white text-gray-800 font-medium"
                                            required>
                                            <option value="" class="text-gray-600">-- Pilih Jenis Kamar --</option>
                                            @foreach ($jenisKamars as $jenis)
                                                <option value="{{ $jenis->jenis_kamar_id }}" class="text-gray-800">{{ $jenis->nama_jenis }}</option>
                                            @endforeach
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    @error('jenis_kamar_id')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            @error('homestay_id')
                                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Room Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-800 mb-1">Nama Kamar</label>
                            <input type="text" name="nama_kamar" 
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 bg-white text-gray-800" 
                                value="{{ old('nama_kamar', $kamar->nama_kamar) }}" required>
                            @error('nama_kamar')
                                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label class="block text-sm font-medium text-gray-800 mb-1">Kapasitas (orang)</label>
                            <input type="number" name="kapasitas" 
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 bg-white text-gray-800" 
                                value="{{ old('kapasitas', $kamar->kapasitas) }}" min="1" required>
                            @error('kapasitas')
                                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="block text-sm font-medium text-gray-800 mb-1">Harga per Malam (Rp)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-600">Rp</span>
                                </div>
                                <input type="number" name="harga" 
                                    class="w-full pl-10 pr-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 bg-white text-gray-800" 
                                    value="{{ old('harga', $kamar->harga) }}" step="1000" required>
                            </div>
                            @error('harga')
                                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Room Photo -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-800 mb-1">Foto Kamar</label>
                            <div class="mt-1 flex items-center space-x-4">
                                <div class="relative">
                                    <div class="flex items-center justify-center w-32 h-32 rounded-lg border-2 border-gray-300 bg-gray-100 overflow-hidden">
                                        <img id="preview" src="{{ asset('storage/'.$kamar->foto_kamar) }}" alt="Preview" class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-center w-full">
                                        <label class="flex flex-col w-full max-w-xs border-2 border-gray-400 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 transition duration-150">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4">
                                                <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-700 text-center">
                                                    <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                                </p>
                                                <p class="text-xs text-gray-600">PNG, JPG, JPEG (Max. 5MB)</p>
                                            </div>
                                            <input type="file" name="foto_kamar" class="hidden" accept="image/*">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('foto_kamar')
                                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Facilities -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-800 mb-2">Fasilitas Kamar</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach($fasilitas as $f)
                                    <label class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" name="fasilitas[]" value="{{ $f->fasilitas_id }}" 
                                                {{ in_array($f->fasilitas_id, old('fasilitas', $kamar->fasilitas->pluck('fasilitas_id')->toArray())) ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-400 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <span class="text-gray-800">{{ $f->nama_fasilitas }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('fasilitas')
                                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('pemilik.kamar.index') }}" 
                            class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                            <svg class="-ml-1 mr-3 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </a>
                        <button type="submit" 
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                            <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
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
</script>
@endsection