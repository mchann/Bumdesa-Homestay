@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-green-700 mb-4">Detail Pemesanan</h2>

    <div class="space-y-2">
        <p><strong>Kode Pemesanan:</strong> {{ $pemesanan->pemesanan_id }}</p>
        <p><strong>Tanggal Check-in:</strong> {{ $pemesanan->tgl_check_in }}</p>
        <p><strong>Tanggal Check-out:</strong> {{ $pemesanan->tgl_check_out }}</p>
        <p><strong>Jumlah Tamu:</strong> {{ $pemesanan->jumlah_tamu }}</p>
        <p><strong>Jumlah Kamar:</strong> {{ $pemesanan->jumlah_kamar }}</p>
        <p><strong>Homestay:</strong> {{ $pemesanan->kamar->homestay->nama_homestay ?? '-' }}</p>
        <p><strong>Kamar:</strong> {{ $pemesanan->kamar->nama_kamar ?? '-' }}</p>
        <p><strong>Catatan:</strong> {{ $pemesanan->catatan ?? '-' }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('pelanggan.pemesanan.index') }}" 
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
           Kembali
        </a>
    </div>
</div>
@endsection