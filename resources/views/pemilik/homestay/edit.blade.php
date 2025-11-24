<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Homestay</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Main Content -->
        <main class="p-6">
            <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
                <h1 class="text-2xl font-bold mb-6 text-gray-800">Informasi Dasar</h1>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pemilik.homestay.update', $homestay->homestay_id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Homestay Section -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-700">Nama Homestay</h2>
                        <input type="text" name="nama_homestay" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Masukkan Nama Homestay"
                               value="{{ old('nama_homestay', $homestay->nama_homestay) }}">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Homestay</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                    <input type="file" name="foto_homestay" accept="image/*" class="hidden" id="fileInput">
                                    <label for="fileInput" class="cursor-pointer">
                                        <span class="text-gray-500">Ubah Foto Homestay</span>
                                        <div id="fileName" class="text-sm mt-1 text-blue-600"></div>
                                    </label>
                                </div>
                                @error('foto_homestay')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                                
                                @if ($homestay->foto_homestay)
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-600">Foto saat ini:</p>
                                        <img src="{{ asset('storage/' . $homestay->foto_homestay) }}" 
                                             alt="Foto Homestay" 
                                             class="w-40 h-32 object-cover mt-1 rounded-lg border">
                                    </div>
                                @endif
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Link Google Maps</label>
                                <input type="url" name="link_google_maps" required 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Kukungkan dengan Google Maps"
                                       value="{{ old('link_google_maps', $homestay->link_google_maps) }}">
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Section -->
                    <div class="space-y-2">
                        <h2 class="text-xl font-semibold text-gray-700">Deskripsi</h2>
                        <textarea name="deskripsi" 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Masukkan Deskripsi Homestay" rows="4">{{ old('deskripsi', $homestay->deskripsi) }}</textarea>
                    </div>

                    <!-- Alamat Section -->
                    <div class="space-y-2">
                        <h2 class="text-xl font-semibold text-gray-700">Alamat Homestay</h2>
                        <textarea name="alamat_homestay" required 
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Masukkan Alamat Homestay" rows="3">{{ old('alamat_homestay', $homestay->alamat_homestay) }}</textarea>
                    </div>

                    <!-- Peraturan Section -->
                    <div class="space-y-3">
                        <h2 class="text-xl font-semibold text-gray-700">Peraturan Menginap</h2>
                        <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach($peraturan as $p)
                                    <label class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input 
                                                type="checkbox" 
                                                name="peraturan[]" 
                                                value="{{ $p->peraturan_id }}"
                                                {{ in_array($p->peraturan_id, $homestay->peraturan->pluck('peraturan_id')->toArray()) ? 'checked' : '' }}
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                            >
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <span class="text-gray-700">{{ $p->isi_peraturan }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Show selected file name
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Belum ada file dipilih';
            document.getElementById('fileName').textContent = fileName;
        });
    </script>
</body>
</html>