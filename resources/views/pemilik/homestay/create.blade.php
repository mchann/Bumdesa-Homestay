@extends('layouts.pemilik')

@section('content')
<head>
<script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #f0fdf4 0%, #dcfce7 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .section-title {
            position: relative;
            padding-left: 16px;
        }
        
        .section-title::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 24px;
            width: 4px;
            background-color: #16a34a;
            border-radius: 2px;
        }
        
        .file-upload-area {
            transition: all 0.3s ease;
        }
        
        .file-upload-area:hover {
            border-color: #16a34a;
            background-color: #f9fafb;
        }
        
        .checkbox-item {
            transition: all 0.2s ease;
        }
        
        .checkbox-item:hover {
            background-color: #f0fdf4;
            border-radius: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(to right, #16a34a, #22c55e);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, #15803d, #16a34a);
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
        }
    </style>
</head>
<body class="min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-primary-800 mb-2">
                <i class="fas fa-home text-primary-600 mr-2"></i>Kelola Homestay
            </h1>
            <p class="text-gray-600">Lengkapi informasi homestay Anda untuk pengalaman terbaik tamu</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
            <div class="bg-primary-600 py-3 px-6">
                <h2 class="text-xl font-semibold text-white">
                    <i class="fas fa-info-circle mr-2"></i>Informasi Dasar Homestay
                </h2>
            </div>
            
            <div class="p-6">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terdapat {{ $errors->count() }} kesalahan yang perlu diperbaiki</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('pemilik.homestay.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <!-- Nama Homestay Section -->
                    <div class="space-y-5">
                        <h2 class="text-lg font-semibold text-gray-800 section-title">Nama Homestay</h2>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-signature text-primary-500"></i>
                            </div>
                            <input type="text" name="nama_homestay" required 
                                   class="pl-10 w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                   placeholder="Masukkan Nama Homestay"
                                   value="{{ old('nama_homestay') }}">
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Homestay</label>
                                <div class="file-upload-area border-2 border-dashed border-gray-300 rounded-xl p-5 text-center transition-colors duration-200">
                                    <input type="file" name="foto_homestay" accept="image/*" class="hidden" id="fileInput" required>
                                    <label for="fileInput" class="cursor-pointer flex flex-col items-center">
                                        <div class="p-3 rounded-full bg-primary-50 text-primary-600 mb-3">
                                            <i class="fas fa-cloud-upload-alt text-xl"></i>
                                        </div>
                                        <span class="text-sm text-gray-500">Klik untuk mengunggah foto</span>
                                        <span class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Maks. 5MB)</span>
                                        <div id="fileName" class="text-sm mt-2 text-primary-600 font-medium"></div>
                                    </label>
                                </div>
                                @error('foto_homestay')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Link Google Maps</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-primary-500"></i>
                                    </div>
                                    <input type="url" name="link_google_maps" required 
                                           class="pl-10 w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                           placeholder="https://goo.gl/maps/..."
                                           value="{{ old('link_google_maps') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Section -->
                    <div class="space-y-5">
                        <h2 class="text-lg font-semibold text-gray-800 section-title">Deskripsi Homestay</h2>
                        <div class="relative">
                            <div class="absolute top-3 left-3 text-primary-500">
                                <i class="fas fa-align-left"></i>
                            </div>
                            <textarea name="deskripsi" 
                                      class="pl-10 w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                      placeholder="Jelaskan keunikan dan fasilitas homestay Anda..." rows="4">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>

                    <!-- Alamat Section -->
                    <div class="space-y-5">
                        <h2 class="text-lg font-semibold text-gray-800 section-title">Alamat Lengkap</h2>
                        <div class="relative">
                            <div class="absolute top-3 left-3 text-primary-500">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <textarea name="alamat_homestay" required 
                                      class="pl-10 w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                      placeholder="Masukkan alamat lengkap homestay..." rows="3">{{ old('alamat_homestay') }}</textarea>
                        </div>
                    </div>

                    <!-- Peraturan Section -->
                    <div class="space-y-5">
                        <h2 class="text-lg font-semibold text-gray-800 section-title">Peraturan Menginap</h2>
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-5">
                            <p class="text-sm text-gray-600 mb-4 flex items-center">
                                <i class="fas fa-info-circle text-primary-500 mr-2"></i>
                                Semua peraturan berikut wajib diterapkan untuk homestay Anda
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($peraturan as $p)
                                    <div class="checkbox-item flex items-start p-2">
                                        <div class="flex items-center h-5 mt-1">
                                            <input 
                                                type="checkbox" 
                                                name="peraturan[]" 
                                                value="{{ $p->peraturan_id }}"
                                                checked
                                                disabled
                                                class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"
                                            >
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <span class="text-gray-700">{{ $p->isi_peraturan }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-5 flex justify-end">
                        <button type="submit" class="btn-primary text-white px-8 py-3 rounded-lg font-medium flex items-center">
                            <i class="fas fa-save mr-2"></i> Simpan Homestay
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-6 text-center text-sm text-gray-500">
            <p>© 2025 Homestay BUMDES. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Show selected file name
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Belum ada file dipilih';
            document.getElementById('fileName').textContent = fileName;
            
            // Preview image if available
            if (e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    // Remove existing preview if any
                    const existingPreview = document.getElementById('imagePreview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Create preview element
                    const preview = document.createElement('div');
                    preview.id = 'imagePreview';
                    preview.className = 'mt-3';
                    preview.innerHTML = `
                        <img src="${event.target.result}" class="h-40 w-full object-cover rounded-lg border" alt="Preview">
                    `;
                    
                    // Insert preview
                    document.querySelector('.file-upload-area label').appendChild(preview);
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
</body>
@endsection