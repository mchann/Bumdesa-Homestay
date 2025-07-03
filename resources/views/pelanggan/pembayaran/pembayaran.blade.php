@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pembayaran Pemesanan</h2>

    <div class="mb-3">
        <h4>{{ $pemesanan->kamar->homestay->nama_homestay }}</h4>
        <p>Alamat: {{ $pemesanan->kamar->homestay->alamat_homestay }}</p>
    </div>

    <div class="mb-3">
        <h5>Detail Kamar</h5>
        <p>Nama Kamar: {{ $pemesanan->kamar->nama_kamar }}</p>
        <p>Harga per malam: Rp {{ number_format($pemesanan->kamar->harga_per_malam, 0, ',', '.') }}</p>
    </div>

    <div class="mb-3">
        <h5>Durasi Menginap</h5>
        <p>Tanggal Check-in: {{ $pemesanan->tgl_check_in }}</p>
        <p>Tanggal Check-out: {{ $pemesanan->tgl_check_out }}</p>
        @php
            $lamaInap = \Carbon\Carbon::parse($pemesanan->tgl_check_in)
                        ->diffInDays(\Carbon\Carbon::parse($pemesanan->tgl_check_out));
        @endphp
        <p>Lama menginap: {{ $lamaInap }} malam</p>
        <p>Jumlah Kamar: {{ $pemesanan->jumlah_kamar }}</p>
    </div>

    <div class="mb-3">
        <h5>Total Harga:</h5>
        <h4>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</h4>
    </div>

    <div class="mb-3">
        <h5>Pembayaran via Transfer</h5>
        <p>Silakan transfer ke rekening berikut:</p>
        <ul>
            <li><strong>Bank:</strong> BRI</li>
            <li><strong>No. Rekening:</strong> 1234 5678 9012 3456</li>
            <li><strong>Atas Nama:</strong> Admin Homestay</li>
        </ul>
        <p>Setelah transfer, silakan konfirmasi ke admin.</p>
    </div>

    <form action="{{ route('pelanggan.selesai') }}" method="POST">
        @csrf
        <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
        <button type="submit" class="btn btn-success">Selesaikan Pembayaran</button>
    </form>
</div>
@endsection
