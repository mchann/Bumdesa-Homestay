@extends('layouts.pemilik')

@section('title', 'Edit Kamar')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Kamar</h2>

        <form action="{{ route('pemilik.kamar.update', $kamar->kamar_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Pilih Homestay -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Homestay</label>
                <select name="homestay_id" class="w-full border rounded py-2 px-3" required>
                    @foreach($homestays as $homestay)
                        <option value="{{ $homestay->homestay_id }}" 
                            {{ $kamar->homestay_id == $homestay->homestay_id ? 'selected' : '' }}>
                            {{ $homestay->nama_homestay }}
                        </option>
                    @endforeach
                </select>
                @error('homestay_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
            <label for="jenis_kamar_id" class="form-label">Jenis Kamar</label>
            <select name="jenis_kamar_id" id="jenis_kamar_id" class="form-control" required>
                <option value="">-- Pilih Jenis Kamar --</option>
                @foreach($jenisKamars as $jenis)
                    <option value="{{ $jenis->jenis_kamar_id }}"
                    {{ (old('jenis_kamar_id') ?? ($kamar->jenis_kamar_id ?? '')) == $jenis->jenis_kamar_id ? 'selected' : '' }}>
                    {{ $jenis->nama_jenis_kamar }}
                </option>

                @endforeach
            </select>
        </div>

            <!-- Nama Kamar -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kamar</label>
                <input type="text" name="nama_kamar" class="w-full border rounded py-2 px-3" 
                       value="{{ old('nama_kamar', $kamar->nama_kamar) }}" required>
                @error('nama_kamar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Kapasitas -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Kapasitas</label>
                <input type="text" name="kapasitas" class="w-full border rounded py-2 px-3" 
                       value="{{ old('kapasitas', $kamar->kapasitas) }}" required>
                @error('kapasitas')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Harga per Malam</label>
                <input type="number" name="harga" class="w-full border rounded py-2 px-3" 
                       value="{{ old('harga', $kamar->harga) }}" step="1000" required>
                @error('harga')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Foto Kamar -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Foto Kamar</label>
                <div class="flex items-center gap-4">
                    <img id="preview" src="{{ asset('storage/'.$kamar->foto_kamar) }}" 
                         class="w-48 h-48 object-cover rounded-lg border">
                    <input type="file" name="foto_kamar" class="w-full" accept="image/*">
                </div>
                @error('foto_kamar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

             <!-- Fasilitas (Checkbox) -->
             <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Fasilitas</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($fasilitas as $f)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="fasilitas[]" value="{{ $f->fasilitas_id }}"
                                   {{ in_array($f->fasilitas_id, old('fasilitas', [])) ? 'checked' : '' }}>
                            <span>{{ $f->nama_fasilitas }}</span>
                        </label>
                    @endforeach
                </div>
                @error('fasilitas')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end gap-2">
                <a href="{{ route('pemilik.kamar.index') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Update Kamar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview image
    document.querySelector('input[name="foto_kamar"]').addEventListener('change', function(e) {
        if(e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function() {
                document.querySelector('#preview').src = reader.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection