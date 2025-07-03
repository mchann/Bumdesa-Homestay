@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Detail Pemesanan</h1>

    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <h2 class="text-xl font-semibold mb-2">Informasi Pemesanan</h2>
            <p><strong>ID Pemesanan:</strong> {{ $pemesanan->pemesanan_id }}</p>
            <p><strong>Tanggal Pesan:</strong> {{ date('d M Y, H:i', strtotime($pemesanan->created_at)) }}</p>
            <p><strong>Status:</strong>
                <span class="inline-block px-2 py-1 rounded 
                    @if($pemesanan->status === 'berhasil') bg-green-100 text-green-800 
                    @elseif($pemesanan->status === 'menunggu_konfirmasi') bg-yellow-100 text-yellow-800 
                    @elseif($pemesanan->status === 'gagal') bg-red-100 text-red-800 
                    @elseif($pemesanan->status === 'selesai') bg-blue-100 text-blue-800 
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst($pemesanan->status) }}
                </span>
            </p>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-2">Data Pelanggan</h2>
            <p><strong>Nama:</strong> {{ $pemesanan->pelanggan->name ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $pemesanan->pelanggan->email ?? '-' }}</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-2">Data Homestay & Kamar</h2>
            <p><strong>Homestay:</strong> {{ $pemesanan->kamar->homestay->nama_homestay ?? '-' }}</p>
            <p><strong>Kamar:</strong> {{ $pemesanan->kamar->nama_kamar ?? '-' }}</p>
            <p><strong>Check-in:</strong> {{ date('d M Y, H:i', strtotime($pemesanan->tgl_check_in)) }}</p>
            <p><strong>Check-out:</strong> {{ date('d M Y, H:i', strtotime($pemesanan->tgl_check_out)) }}</p>
        </div>

        <div>
    <h2 class="text-xl font-semibold mb-2">Bukti Pembayaran</h2>
    @if ($pemesanan->bukti_transfer)
        <a href="{{ asset('storage/' . $pemesanan->bukti_transfer) }}" target="_blank"
           class="text-blue-600 underline hover:text-blue-800">
            Lihat File Bukti Pembayaran
        </a>
        <div class="mt-2">
            <img src="{{ asset('storage/' . $pemesanan->bukti_transfer) }}" alt="Bukti Transfer"
                 class="w-64 rounded shadow border">
        </div>
    @else
        <p class="text-gray-500">Belum ada bukti pembayaran diunggah.</p>
    @endif
</div>


        <div>
            <a href="{{ route('admin.pemesanan.index') }}"
               class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
