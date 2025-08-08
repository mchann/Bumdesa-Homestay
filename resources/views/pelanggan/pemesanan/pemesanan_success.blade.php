@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <svg class="mx-auto mb-4" width="80" height="80" fill="none" viewBox="0 0 24 24" stroke="green">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2l4 -4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
        </svg>
        <h2 class="mb-3 text-xl font-bold text-gray-800">Pemesanan Berhasil!</h2>
        <p class="text-gray-600 mb-2">
            Nomor Pemesanan: <strong>{{ $invoice ?? 'DWT-XXXXX' }}</strong><br>
            Tanggal: <strong>{{ $tanggal ?? now()->format('d M Y, H:i') }}</strong><br>
            Total: <strong>Rp {{ $total ?? '0' }}</strong>
        </p>

        <!-- Tambahan konfirmasi admin (tanpa mengubah variabel yang ada) -->
        <div class="alert alert-info mb-4">
            <h4 class="alert-heading">Status Verifikasi Admin</h4>
            <p class="mb-1">Pembayaran telah berhasil</p>
            <small class="text-muted">Anda akan mendapat notifikasi pemesanan kamar anda.</small>
        </div>

        <p class="text-gray-700 mb-4">
            Pembayaran Anda telah berhasil dibayar dan sedang kami verifikasi. <br>
            Mohon tunggu konfirmasi dari admin sebelum melanjutkan.
        </p>
        <div class="d-flex justify-content-center gap-2">
            <a href="/" class="btn btn-primary mt-3">Kembali ke Beranda</a>
            <a href="#" class="btn btn-outline-secondary mt-3">Cek Status</a>
        </div>
    </div>
</div>
@endsection