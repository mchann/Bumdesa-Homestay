@extends('layouts.admin')

@section('title', 'Daftar Pemilik Homestay')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Notification Section -->
    @if(session('success'))
        <div id="success-notification" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 opacity-100">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('success-notification').style.opacity = '0';
                setTimeout(function() {
                    document.getElementById('success-notification').style.display = 'none';
                }, 500);
            }, 3000);
        </script>
    @endif

    @if(session('warning'))
        <div id="warning-notification" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500 opacity-100">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('warning') }}</span>
            </div>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('warning-notification').style.opacity = '0';
                setTimeout(function() {
                    document.getElementById('warning-notification').style.display = 'none';
                }, 500);
            }, 3000);
        </script>
    @endif

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div class="mb-4 md:mb-0">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manajemen Pemilik Homestay</h1>
            <p class="text-gray-500 mt-1 text-sm">Kelola data pemilik dan status akun mereka</p>
        </div>
        <a href="{{ route('admin.pendaftaran.pemilik') }}" 
           class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-4 py-2.5 md:px-6 md:py-3 rounded-lg shadow-sm flex items-center text-sm md:text-base transition-all duration-200">
            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Pemilik Baru
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-xs">
            <p class="text-xs md:text-sm text-gray-500 font-medium">Total Pemilik</p>
            <h3 class="text-xl md:text-2xl font-bold text-gray-800 mt-1">{{ count($pemilikList) }}</h3>
        </div>
        
        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-xs">
            <p class="text-xs md:text-sm text-gray-500 font-medium">Aktif</p>
            <h3 class="text-xl md:text-2xl font-bold text-green-600 mt-1">{{ $pemilikList->where('status', 'aktif')->count() }}</h3>
        </div>
        
        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-xs">
            <p class="text-xs md:text-sm text-gray-500 font-medium">Nonaktif</p>
            <h3 class="text-xl md:text-2xl font-bold text-red-600 mt-1">{{ $pemilikList->where('status', 'nonaktif')->count() }}</h3>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl shadow-xs overflow-hidden border border-gray-100">
        <!-- Table Header with Search -->
        <div class="px-4 py-3 md:px-6 md:py-4 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-3 bg-gray-50">
            <h2 class="font-semibold text-gray-800 text-sm md:text-base">Daftar Pemilik Homestay</h2>
            <div class="relative w-full md:w-auto">
                <input type="text" placeholder="Cari pemilik..." class="w-full md:w-64 pl-9 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all text-sm">
                <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
        
        <!-- Responsive Table Container -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Homestay</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bergabung</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($pemilikList as $index => $pemilik)
                    <tr class="hover:bg-gray-50 transition-colors duration-100">
                        <!-- No -->
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 font-medium">
                            {{ $index + 1 }}
                        </td>
                        
                        <!-- Pemilik -->
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-medium text-sm">
                                    {{ substr($pemilik->name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $pemilik->name }}</div>
                                    <div class="text-xs text-gray-400">ID: {{ $pemilik->id }}</div>
                                </div>
                            </div>
                        </td>
                        
                        <!-- Kontak -->
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $pemilik->email }}</div>
                            <div class="text-xs text-gray-400">{{ $pemilik->pemilikProfile->no_telepon ?? '-' }}</div>
                        </td>
                        
                        <!-- Homestay -->
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-1 max-w-[180px]">
                                @forelse($pemilik->pemilikProfile->homestays ?? [] as $homestay)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium  text-blue-700">
                                        {{ $homestay->nama_homestay }}
                                    </span>
                                @empty
                                    <span class="text-gray-400 italic text-xs">Belum terdaftar</span>
                                @endforelse
                            </div>
                        </td>
                        
                        <!-- Bergabung -->
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-700">{{ $pemilik->created_at->translatedFormat('d M Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $pemilik->created_at->diffForHumans() }}</div>
                        </td>
                        
                        <!-- Status -->
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($pemilik->status == 'aktif')
                                <span class="px-2 py-1 inline-flex text-xs leading-4 font-medium rounded-full bg-green-50 text-green-700">
                                    <svg class="w-3 h-3 mr-1 mt-0.5" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Aktif
                                </span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-4 font-medium rounded-full bg-red-50 text-red-700">
                                    <svg class="w-3 h-3 mr-1 mt-0.5" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        
                        <!-- Aksi -->
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                @if ($pemilik->status == 'aktif')
                                    <form action="{{ route('admin.admin.nonaktifkan', $pemilik->id) }}" method="POST" onsubmit="return confirmNonaktifkan()">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-xs px-2.5 py-1.5 rounded-md border border-red-100 bg-red-50 text-red-600 hover:bg-red-100 transition-colors duration-150 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728"></path>
                                            </svg>
                                            Nonaktif
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.admin.aktifkan', $pemilik->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="text-xs px-2.5 py-1.5 rounded-md border border-green-100 bg-green-50 text-green-600 hover:bg-green-100 transition-colors duration-150 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Aktifkan
                                        </button>
                                    </form>
                                @endif
                                
                                <button class="text-xs px-2.5 py-1.5 rounded-md border border-gray-100 bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors duration-150 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Detail
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-4 py-3 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-3">
            <div class="text-xs text-gray-500">
                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">{{ count($pemilikList) }}</span> hasil
            </div>
            <div class="flex items-center space-x-1">
                <button class="px-3 py-1.5 border border-gray-200 rounded-md text-xs font-medium text-gray-600 bg-white hover:bg-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="px-3 py-1.5 border border-gray-200 rounded-md text-xs font-medium text-gray-600 bg-white hover:bg-gray-50">
                    1
                </button>
                <button class="px-3 py-1.5 border border-gray-200 rounded-md text-xs font-medium text-gray-600 bg-white hover:bg-gray-50">
                    2
                </button>
                <button class="px-3 py-1.5 border border-gray-200 rounded-md text-xs font-medium text-gray-600 bg-white hover:bg-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmNonaktifkan() {
        return confirm('Apakah Anda yakin ingin menonaktifkan akun ini?');
    }
</script>
@endsection