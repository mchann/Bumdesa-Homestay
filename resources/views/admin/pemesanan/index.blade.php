@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Pemesanan</h1>
        
        {{-- Search box --}}
        <div class="mt-4 md:mt-0">
            <input type="text" placeholder="Cari pemesanan..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>

    <!-- Statistik - MENGGUNAKAN VARIABEL FILTERED -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Pemesanan Filtered -->
        <div class="bg-white p-5 rounded-xl shadow-md">
            <div class="text-gray-600 text-sm mb-1">
                Total Pemesanan 
                {{-- Menampilkan label yang dinamis --}}
                @if(request('homestay')) 
                    (Homestay Terpilih) 
                @else
                    (Semua)
                @endif
            </div>
            <div class="text-2xl font-bold text-green-600">
                {{ $totalPemesananFilter }}
            </div>
        </div>

        <!-- Total Pemesanan Berhasil Filtered -->
        <div class="bg-white p-5 rounded-xl shadow-md">
            <div class="text-gray-600 text-sm mb-1">
                Pemesanan Berhasil
                {{-- Menampilkan label yang dinamis --}}
                @if(request('homestay')) 
                    (Homestay Terpilih) 
                @else
                    (Semua)
                @endif
            </div>
            <div class="text-2xl font-bold text-green-600">
                {{ $totalPemesananBerhasilFilter }}
            </div>
        </div>

        <!-- Total Pendapatan Filtered -->
        <div class="bg-white p-5 rounded-xl shadow-md">
            <div class="text-gray-600 text-sm mb-1">
                Total Pendapatan
                {{-- Menampilkan label yang dinamis --}}
                @if(request('homestay')) 
                    (Homestay Terpilih) 
                @else
                    (Semua)
                @endif
            </div>
            <div class="text-2xl font-bold text-green-600">
                Rp{{ number_format($totalPendapatanFilter, 0, ',', '.') }}
            </div>
        </div>
    </div>

    {{-- Filter Tabs --}}
    {{-- Ambil filter homestay yang aktif untuk dipertahankan saat status tab diubah --}}
    @php
        $currentHomestayId = request('homestay');
        $queryHomestay = $currentHomestayId ? ['homestay' => $currentHomestayId] : [];
    @endphp

    <div class="flex overflow-x-auto mb-8 scrollbar-hide">
        <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg">
            <a href="{{ route('admin.pemesanan.index', array_merge(request()->except('status', 'page'), ['status' => 'semua'], $queryHomestay)) }}" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                     {{ request('status') == 'semua' || !request('status') ? 'bg-white shadow text-blue-600' : 'text-gray-600 hover:text-gray-800' }}">
                Semua
            </a>
            <a href="{{ route('admin.pemesanan.index', array_merge(request()->except('status', 'page'), ['status' => 'berhasil'], $queryHomestay)) }}" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                     {{ request('status') == 'berhasil' ? 'bg-white shadow text-green-600' : 'text-gray-600 hover:text-gray-800' }}">
                Berhasil
            </a>
            <a href="{{ route('admin.pemesanan.index', array_merge(request()->except('status', 'page'), ['status' => 'menunggu_konfirmasi'], $queryHomestay)) }}" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                     {{ request('status') == 'menunggu_konfirmasi' ? 'bg-white shadow text-yellow-600' : 'text-gray-600 hover:text-gray-800' }}">
                Diproses
            </a>
            <a href="{{ route('admin.pemesanan.index', array_merge(request()->except('status', 'page'), ['status' => 'gagal'], $queryHomestay)) }}" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                     {{ request('status') == 'gagal' ? 'bg-white shadow text-red-600' : 'text-gray-600 hover:text-gray-800' }}">
                Gagal
            </a>
            <a href="{{ route('admin.pemesanan.index', array_merge(request()->except('status', 'page'), ['status' => 'selesai'], $queryHomestay)) }}" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                     {{ request('status') == 'selesai' ? 'bg-white shadow text-blue-600' : 'text-gray-600 hover:text-gray-800' }}">
                Selesai
            </a>
        </div>
    </div>

    {{-- Export Section --}}
    <div class="flex flex-wrap gap-6 mb-6">
        {{-- Form Export Excel --}}
        <form action="{{ route('admin.export.excel') }}" method="GET" class="flex items-end gap-2 bg-green-50 p-4 rounded-md border border-green-200">
            {{-- Tambahkan hidden input untuk mempertahankan filter homestay dan status saat export --}}
            @if(request('homestay'))
                <input type="hidden" name="homestay_id" value="{{ request('homestay') }}">
            @endif
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            
            <div>
                <label for="excel_tanggal_awal" class="block text-sm text-gray-600 mb-1">Tanggal Awal</label>
                <input type="date" id="excel_tanggal_awal" name="tanggal_awal" required class="border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>
            <div>
                <label for="excel_tanggal_akhir" class="block text-sm text-gray-600 mb-1">Tanggal Akhir</label>
                <input type="date" id="excel_tanggal_akhir" name="tanggal_akhir" required class="border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm transition duration-200">
                Export Excel
            </button>
        </form>

        {{-- Form Export PDF --}}
        <form action="{{ route('admin.export.pdf') }}" method="GET" class="flex items-end gap-2 bg-red-50 p-4 rounded-md border border-red-200">
            {{-- Tambahkan hidden input untuk mempertahankan filter homestay dan status saat export --}}
            @if(request('homestay'))
                <input type="hidden" name="homestay_id" value="{{ request('homestay') }}">
            @endif
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif

            <div>
                <label for="pdf_tanggal_awal" class="block text-sm text-gray-600 mb-1">Tanggal Awal</label>
                <input type="date" id="pdf_tanggal_awal" name="tanggal_awal" required class="border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
            <div>
                <label for="pdf_tanggal_akhir" class="block text-sm text-gray-600 mb-1">Tanggal Akhir</label>
                <input type="date" id="pdf_tanggal_akhir" name="tanggal_akhir" required class="border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm transition duration-200">
                Export PDF
            </button>
        </form>
    </div>

    {{-- Filter Homestay Section --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h3 class="text-lg font-semibold text-gray-800">Filter Homestay</h3>
            
            <div class="flex flex-wrap gap-4">
                {{-- Filter berdasarkan Homestay --}}
                <div class="flex items-center gap-2">
                    <label for="homestay" class="text-sm text-gray-600 whitespace-nowrap">Pilih Homestay:</label>
                    <select id="homestay" name="homestay" onchange="filterByHomestay(this.value)" 
                            class="border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        {{-- Nilai kosong ('') merepresentasikan 'Semua Homestay' --}}
                        <option value="" {{ request('homestay') == '' ? 'selected' : '' }}>Semua Homestay</option>
                        @foreach($homestays as $homestay)
                            <option value="{{ $homestay->homestay_id }}" 
                                {{ request('homestay') == $homestay->homestay_id ? 'selected' : '' }}>
                                {{ $homestay->nama_homestay }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Reset Filter --}}
                @if(request('homestay') || (request('status') && request('status') !== 'semua'))
                <a href="{{ route('admin.pemesanan.index') }}" 
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-1.5 rounded-md text-sm transition duration-200 whitespace-nowrap">
                    Reset Semua Filter
                </a>
                @endif
            </div>
        </div>

        {{-- Info Filter Aktif --}}
        @if(request('homestay') || (request('status') && request('status') !== 'semua'))
        <div class="mt-4 p-3 bg-blue-50 rounded-lg">
            <div class="flex flex-wrap items-center gap-2 text-sm text-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z" />
                </svg>
                <span class="font-medium">Filter Aktif:</span>
                
                @if(request('homestay'))
                @php
                    $selectedHomestay = $homestays->firstWhere('homestay_id', request('homestay'));
                @endphp
                <span class="bg-blue-100 px-2 py-1 rounded">Homestay: {{ $selectedHomestay->nama_homestay ?? 'Semua' }}</span>
                @endif
                
                @if(request('status') && request('status') !== 'semua')
                @php
                    $statusLabels = [
                        'berhasil' => 'Berhasil',
                        'menunggu_konfirmasi' => 'Diproses', 
                        'gagal' => 'Gagal',
                        'selesai' => 'Selesai',
                        'pending' => 'Pending'
                    ];
                @endphp
                <span class="bg-blue-100 px-2 py-1 rounded">Status: {{ $statusLabels[request('status')] ?? request('status') }}</span>
                @endif
            </div>
        </div>
        @endif
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-max">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-600 text-sm font-medium">
                        <th class="px-6 py-4">Tgl Pesan</th>
                        <th class="px-6 py-4">Homestay</th>
                        <th class="px-6 py-4">ID Pesanan</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Check-in</th>
                        <th class="px-6 py-4">Check-out</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Total Harga</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($pemesanans as $pemesanan)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-800 font-medium">{{ date('d.m.Y', strtotime($pemesanan->created_at)) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800 font-medium">{{ $pemesanan->homestay->nama_homestay ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $pemesanan->kamar->nama_kamar ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-mono text-blue-600">{{ $pemesanan->pemesanan_id }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800">{{ $pemesanan->pelanggan->name ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $pemesanan->pelanggan->email ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-800">{{ date('d-m-Y h:ia', strtotime($pemesanan->tgl_check_in)) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-800">{{ date('d-m-Y h:ia', strtotime($pemesanan->tgl_check_out)) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusClasses = [
                                        'berhasil' => 'bg-green-50 text-green-700',
                                        'menunggu_konfirmasi' => 'bg-yellow-50 text-yellow-700',
                                        'gagal' => 'bg-red-50 text-red-700',
                                        'selesai' => 'bg-blue-50 text-blue-700',
                                        'pending' => 'bg-gray-50 text-gray-700'
                                    ];
                                    $statusText = [
                                        'berhasil' => 'Berhasil',
                                        'menunggu_konfirmasi' => 'Diproses',
                                        'gagal' => 'Gagal',
                                        'selesai' => 'Selesai',
                                        'pending' => 'Pending'
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusClasses[$pemesanan->status] ?? 'bg-gray-50 text-gray-700' }}">
                                    {{ $statusText[$pemesanan->status] ?? $pemesanan->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800 font-medium">
                                    Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end space-x-3">
                                    <a href="{{ route('admin.pemesanan.show', $pemesanan->pemesanan_id) }}" 
                                       class="text-blue-600 hover:text-blue-800 transition-colors duration-200 p-1 rounded hover:bg-blue-50"
                                       title="Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.pemesanan.updateStatus', $pemesanan->pemesanan_id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        {{-- Logika tombol: Jika status saat ini berhasil, tombol akan mengubahnya menjadi gagal. Jika tidak, tombol mengubahnya menjadi berhasil. --}}
                                        <input type="hidden" name="status" value="{{ $pemesanan->status == 'berhasil' ? 'gagal' : 'berhasil' }}">
                                        <button type="submit" 
                                                class="text-green-600 hover:text-green-800 transition-colors duration-200 p-1 rounded hover:bg-green-50"
                                                title="{{ $pemesanan->status == 'berhasil' ? 'Tolak (Ubah ke Gagal)' : 'Terima (Ubah ke Berhasil)' }}">
                                            @if($pemesanan->status == 'berhasil')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <p class="text-lg">Tidak ada data pemesanan</p>
                                    @if(request('homestay') || (request('status') && request('status') !== 'semua'))
                                    <p class="text-sm mt-2">Coba ubah filter atau <a href="{{ route('admin.pemesanan.index') }}" class="text-blue-600 hover:underline">reset semua filter</a></p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($pemesanans->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $pemesanans->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

<script>
// Filter berdasarkan Homestay
function filterByHomestay(homestayId) {
    const url = new URL(window.location.href);
    
    // Hapus parameter 'page' agar pagination dimulai dari awal saat filter berubah
    url.searchParams.delete('page');

    if (homestayId) {
        // Jika ada ID homestay, set parameter 'homestay'
        url.searchParams.set('homestay', homestayId);
    } else {
        // Jika tidak ada ID homestay (memilih 'Semua Homestay'), hapus parameter 'homestay'
        url.searchParams.delete('homestay');
    }
    
    window.location.href = url.toString();
}
</script>
@endsection
