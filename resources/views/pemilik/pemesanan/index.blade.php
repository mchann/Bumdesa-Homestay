@extends('layouts.pemilik')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Manajemen Pemesanan
            </h1>
            <p class="text-gray-600 mt-1">Kelola semua pemesanan homestay Anda</p>
        </div>
        
        <div class="mt-4 md:mt-0">
            <div class="relative">
                <input type="text" placeholder="Cari pemesanan..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div class="flex overflow-x-auto mb-8 scrollbar-hide">
        <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg">
            <a href="{{ route('pemilik.pemesanan.index', ['status' => 'semua']) }}" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                      {{ request('status') == 'semua' ? 'bg-white shadow text-green-600' : 'text-gray-600 hover:text-gray-800' }}">
                Semua
            </a>
            <a href="{{ route('pemilik.pemesanan.index', ['status' => 'berhasil']) }}" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                      {{ request('status') == 'berhasil' ? 'bg-white shadow text-green-600' : 'text-gray-600 hover:text-gray-800' }}">
                Berhasil
            </a>
            <a href="{{ route('pemilik.pemesanan.index', ['status' => 'menunggu_konfirmasi']) }}" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                      {{ request('status') == 'menunggu_konfirmasi' ? 'bg-white shadow text-yellow-600' : 'text-gray-600 hover:text-gray-800' }}">
                Diproses
            </a>
            <a href="{{ route('pemilik.pemesanan.index', ['status' => 'dibatalkan']) }}" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                      {{ request('status') == 'dibatalkan' ? 'bg-white shadow text-red-600' : 'text-gray-600 hover:text-gray-800' }}">
                Dibatalkan
            </a>
            <a href="{{ route('pemilik.pemesanan.index', ['status' => 'selesai']) }}" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                      {{ request('status') == 'selesai' ? 'bg-white shadow text-blue-600' : 'text-gray-600 hover:text-gray-800' }}">
                Selesai
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        @if($pemesanans->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full min-w-max">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 text-sm font-medium">
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">ID Pesanan</th>
                            <th class="px-6 py-4">Kamar</th>
                            <th class="px-6 py-4">Check-in</th>
                            <th class="px-6 py-4">Check-out</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Bukti</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($pemesanans as $pemesanan)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-800 font-medium">{{ $loop->iteration }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                                            <span class="text-green-600 font-medium">
                                                {{ substr($pemesanan->pelanggan->name ?? '?', 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $pemesanan->pelanggan->name ?? '-' }}</div>
                                            <div class="text-sm text-gray-500">{{ $pemesanan->pelanggan->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-mono text-blue-600">{{ $pemesanan->pemesanan_id }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-800">{{ $pemesanan->kamar->nama_kamar ?? '-' }}</div>
                                    <div class="text-xs text-gray-500">{{ $pemesanan->kamar->homestay->nama_homestay ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-800">{{ date('d-m-Y', strtotime($pemesanan->tgl_check_in)) }}</div>
                                    <div class="text-xs text-gray-500">{{ date('H:i', strtotime($pemesanan->tgl_check_in)) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-800">{{ date('d-m-Y', strtotime($pemesanan->tgl_check_out)) }}</div>
                                    <div class="text-xs text-gray-500">{{ date('H:i', strtotime($pemesanan->tgl_check_out)) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = [
                                            'berhasil' => 'bg-green-50 text-green-700',
                                            'menunggu_konfirmasi' => 'bg-yellow-50 text-yellow-700',
                                            'dibatalkan' => 'bg-red-50 text-red-700',
                                            'selesai' => 'bg-blue-50 text-blue-700',
                                            'pending' => 'bg-gray-50 text-gray-700'
                                        ];
                                        $statusText = [
                                            'berhasil' => 'Berhasil',
                                            'menunggu_konfirmasi' => 'Diproses',
                                            'dibatalkan' => 'Dibatalkan',
                                            'selesai' => 'Selesai',
                                            'pending' => 'Pending'
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusClasses[$pemesanan->status] ?? 'bg-gray-50 text-gray-700' }}">
                                        {{ $statusText[$pemesanan->status] ?? $pemesanan->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($pemesanan->bukti_pembayaran)
                                        <a href="#" onclick="showImageModal('{{ asset('storage/' . $pemesanan->bukti_pembayaran) }}')" 
                                           class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat
                                        </a>
                                    @else
                                        <span class="text-sm text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('pemilik.pemesanan.show', $pemesanan->pemesanan_id) }}" 
                                           class="text-blue-600 hover:text-blue-800 transition-colors duration-200"
                                           title="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </a>
                                        
                                        @if($pemesanan->status == 'menunggu_konfirmasi')
                                            <form action="{{ route('pemilik.pemesanan.updateStatus', $pemesanan->pemesanan_id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="berhasil">
                                                <button type="submit" 
                                                        class="text-green-600 hover:text-green-800 transition-colors duration-200"
                                                        title="Terima">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('pemilik.pemesanan.updateStatus', $pemesanan->pemesanan_id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="dibatalkan">
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-800 transition-colors duration-200"
                                                        title="Tolak">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($pemesanan->status == 'berhasil' && $pemesanan->tgl_check_in <= now())
                                            <form action="{{ route('pemilik.pemesanan.updateStatus', $pemesanan->pemesanan_id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="selesai">
                                                <button type="submit" 
                                                        class="text-blue-600 hover:text-blue-800 transition-colors duration-200"
                                                        title="Tandai Selesai">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            @if ($pemesanans->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $pemesanans->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-8 text-center">
                <div class="flex flex-col items-center justify-center text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-lg">Tidak ada data pemesanan</p>
                    <p class="text-sm mt-1">Belum ada pemesanan yang sesuai dengan filter Anda</p>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Modal for Image Preview -->
<div id="imageModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">Bukti Pembayaran</h3>
                        <div class="mt-2">
                            <img id="modalImage" src="" alt="Bukti Pembayaran" class="w-full rounded shadow border">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showImageModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
        document.getElementById('imageModal').classList.remove('hidden');
    }
    
    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
    
    // Close modal when clicking outside
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endsection