@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold text-success">💳 Konfirmasi Pembayaran</h2>
                <p class="text-muted">Lengkapi pembayaran Anda sebelum batas waktu yang ditentukan</p>
            </div>

            <!-- Success Alert -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Detail Pemesanan -->
            <div class="card shadow-sm mb-4 border-0 rounded-4">
                <div class="card-header bg-success text-white rounded-top-4">
                    <h5 class="mb-0"><i class="bi bi-house-door me-2"></i>Detail Pemesanan</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Left -->
                        <div class="col-md-6">
                            <h5 class="text-success">{{ $pemesanan->kamar->homestay->nama_homestay }}</h5>
                            <p class="text-muted mb-3">
                                <i class="bi bi-geo-alt-fill text-success me-2"></i>
                                {{ $pemesanan->kamar->homestay->alamat_homestay }}
                            </p>

                            <div class="mb-3">
                                <h6 class="fw-bold"><i class="bi bi-door-open me-2 text-success"></i>Kamar</h6>
                                <p class="ms-4 mb-0">{{ $pemesanan->kamar->nama_kamar }}</p>
                            </div>

                            <div>
                                <h6 class="fw-bold"><i class="bi bi-people-fill me-2 text-success"></i>Detail Tamu</h6>
                                <ul class="list-unstyled ms-4 text-muted mb-0">
                                    <li>Jumlah Tamu: {{ $pemesanan->jumlah_tamu }}</li>
                                    <li>Jumlah Kamar: {{ $pemesanan->jumlah_kamar }}</li>
                                    <li>Catatan: {{ $pemesanan->catatan ?? '-' }}</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Right -->
                        <div class="col-md-6">
                            <h6 class="fw-bold"><i class="bi bi-calendar-event me-2 text-success"></i>Tanggal Menginap</h6>
                            <ul class="list-unstyled ms-4 text-muted mb-4">
                                <li>Check-in: {{ $pemesanan->tgl_check_in }}</li>
                                <li>Check-out: {{ $pemesanan->tgl_check_out }}</li>
                            </ul>

                            <!-- Rincian Biaya -->
                            <div class="bg-light p-4 rounded-3 border">
                                <h6 class="text-success mb-3 fw-bold">Rincian Biaya</h6>
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal Kamar</span>
                                    <span>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="d-flex justify-content-between mb-2">
                                    <span>
                                        Biaya Layanan Sistem
                                        <br>
                                        <small class="text-muted">Pemeliharaan platform</small>
                                    </span>
                                    <span>Rp 4.500</span>
                                </div>
                                
                                <hr class="my-3">
                                <div class="d-flex justify-content-between fw-bold fs-5">
                                    <span class="text-success">Total Pembayaran</span>
                                    <span class="text-success">Rp {{ number_format($pemesanan->total_harga + 4500, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="mt-2 p-2 bg-white rounded-2 border">
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Total sudah termasuk biaya layanan sistem
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instruksi Pembayaran -->
            <div class="card shadow-sm mb-4 border-0 rounded-4">
                <div class="card-header bg-success text-white rounded-top-4">
                    <h5 class="mb-0"><i class="bi bi-credit-card me-2"></i>Instruksi Pembayaran</h5>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-light border rounded-3 shadow-sm">
                        <i class="bi bi-info-circle-fill me-2 text-success"></i>
                        Harap selesaikan pembayaran sebelum:
                        <strong>{{ \Carbon\Carbon::parse($pemesanan->batas_pembayaran)->format('d M Y H:i') }}</strong>
                        <div id="countdown" class="fw-bold mt-2 text-success"></div>
                    </div>
                </div>
            </div>

            <!-- Aksi Pembayaran -->
            @if (now()->lessThan($pemesanan->batas_pembayaran))
                <div class="card shadow-sm border-0 rounded-4 mb-3">
                    <div class="card-body">
                        <h6 class="fw-bold text-success mb-3">Pilih Metode Pembayaran</h6>
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="pm_qris" value="qris" checked>
                                    <label class="form-check-label" for="pm_qris">QRIS</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="payment_method" id="pm_bri" value="bri">
                                    <label class="form-check-label" for="pm_bri">BRI</label>
                                </div>
                            </div>

                            <div class="col-md-6" id="bankDetails">
                                <!-- Default show QRIS info -->
                                <div data-method="qris" class="method-detail">
                                    <p class="mb-1"><strong>QRIS</strong></p>
                                    <p class="text-muted small mb-0">Scan QRIS melalui aplikasi mobile banking atau dompet digital Anda.</p>
                                </div>

                                <div data-method="bri" class="method-detail d-none">
                                    <p class="mb-1"><strong>BRI - Rekening Virtual</strong></p>
                                    <div class="d-flex align-items-center mb-2">
                                        <code id="briAccount" class="me-2">1234 5678 9012 3456</code>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" id="copyAccount">Salin</button>
                                    </div>
                                    <p class="text-muted small mb-0">Atas Nama: <strong>PT. Contoh Homestay</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload bukti transfer -->
                <div class="card shadow-sm border-0 rounded-4 mb-3">
                    <div class="card-body">
                        <h6 class="fw-bold text-success mb-3">Upload Bukti Pembayaran</h6>

                        <form id="uploadForm" action="{{ route('pelanggan.pemesanan.uploadBukti', ['id' => $pemesanan->pemesanan_id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="payment_method" id="payment_method_input" value="qris">

                            <div class="mb-3">
                                <label for="bukti_transfer" class="form-label">Pilih File Bukti Transfer (JPG, PNG | max 2MB)</label>
                                <input class="form-control" type="file" id="bukti_transfer" name="bukti_transfer" accept="image/*" required>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success" id="uploadButton">
                                    <i class="bi bi-upload me-2"></i>Upload & Selesaikan Pembayaran
                                </button>
                                <a href="{{ route('simulasi.pembayaran', ['id' => $pemesanan->pemesanan_id]) }}" class="btn btn-outline-success">
                                    <i class="bi bi-wallet2 me-2"></i>Bayar Sekarang (Metode Online)
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-danger shadow-sm rounded-3">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i>
                    <strong>Waktu pembayaran telah habis!</strong> Silakan lakukan pemesanan ulang jika masih berminat.
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    const deadline = new Date("{{ $pemesanan->batas_pembayaran }}").getTime();
    const x = setInterval(function() {
        const now = new Date().getTime();
        const distance = deadline - now;

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "<span class='text-danger'>Waktu pembayaran telah habis!</span>";
            return;
        }

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML = ⏳ Sisa waktu: <strong>${hours} jam ${minutes} menit ${seconds} detik</strong>;
    }, 1000);
</script>

<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-3px);
    }
    .btn-success {
        background-color: #25D366;
        border: none;
    }
    .btn-success:hover {
        background-color: #1ebe5d;
    }
</style>
@endsection