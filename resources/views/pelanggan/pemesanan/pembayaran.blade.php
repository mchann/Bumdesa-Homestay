@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">Konfirmasi Pembayaran</h2>
                <p class="text-muted">Lengkapi pembayaran Anda sebelum batas waktu yang ditentukan</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Booking Info Card -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-house-door me-2"></i>Detail Pemesanan</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="text-primary">{{ $pemesanan->kamar->homestay->nama_homestay }}</h5>
                                <p class="text-muted mb-1">
                                    <i class="bi bi-geo-alt-fill text-secondary me-2"></i>
                                    {{ $pemesanan->kamar->homestay->alamat_homestay }}
                                </p>
                            </div>
                            
                            <div class="mb-3">
                                <h6><i class="bi bi-door-open me-2 text-secondary"></i>Kamar</h6>
                                <p class="ms-4">{{ $pemesanan->kamar->nama_kamar }}</p>
                            </div>
                            
                            <div class="mb-3">
                                <h6><i class="bi bi-people-fill me-2 text-secondary"></i>Detail Tamu</h6>
                                <div class="ms-4">
                                    <p class="mb-1">Jumlah Tamu: {{ $pemesanan->jumlah_tamu }}</p>
                                    <p class="mb-1">Jumlah Kamar: {{ $pemesanan->jumlah_kamar }}</p>
                                    <p class="mb-0">Catatan: {{ $pemesanan->catatan ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6><i class="bi bi-calendar-event me-2 text-secondary"></i>Tanggal Menginap</h6>
                                <div class="ms-4">
                                    <p class="mb-1">Check-in: {{ $pemesanan->tgl_check_in }}</p>
                                    <p class="mb-1">Check-out: {{ $pemesanan->tgl_check_out }}</p>
                                </div>
                            </div>
                            
                            <div class="bg-light p-3 rounded">
                                <h6 class="text-end text-primary">Total Pembayaran</h6>
                                <h3 class="text-end fw-bold">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Instructions Card -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-credit-card me-2"></i>Instruksi Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Harap selesaikan pembayaran sebelum:
                        <strong>{{ \Carbon\Carbon::parse($pemesanan->batas_pembayaran)->format('d M Y H:i') }}</strong>
                        <div id="countdown" class="fw-bold mt-2"></div>
                    </div>
                    
                    <div class="border-start border-3 border-primary ps-3 mb-4">
                        <h5 class="text-primary">Transfer Bank</h5>
                        <div class="ms-2">
                            <p class="mb-1"><i class="bi bi-bank me-2"></i>Bank: BNI</p>
                            <p class="mb-1"><i class="bi bi-credit-card-2-front me-2"></i>No. Rekening: <strong>1234567890</strong></p>
                            <p class="mb-0"><i class="bi bi-person-fill me-2"></i>Atas Nama: <strong>Homestay Tamansari</strong></p>
                        </div>
                    </div>
                    
                    <div class="bg-light p-3 rounded">
                        <h6><i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Penting!</h6>
                        <ul class="mb-0">
                            <li>Transfer tepat sesuai nominal total pembayaran</li>
                            <li>Simpan bukti transfer Anda</li>
                            <li>Upload bukti transfer sebelum batas waktu</li>
                        </ul>
                    </div>
                </div>
            </div>

            @if (now()->lessThan($pemesanan->batas_pembayaran))
                <!-- Upload Form Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-upload me-2"></i>Upload Bukti Transfer</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pelanggan.pemesanan.uploadBukti', $pemesanan->pemesanan_id) }}" method="POST" enctype="multipart/form-data" class="dropzone" id="uploadForm">
                            @csrf
                            <div class="mb-3">
                                <label for="buktiTransfer" class="form-label">Pilih File Bukti Transfer</label>
                                <input class="form-control" type="file" name="bukti_transfer" id="buktiTransfer" required>
                                <div class="form-text">Format: JPG, PNG, PDF (Maks. 2MB)</div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="bi bi-send-fill me-2"></i>Kirim Bukti Transfer
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Expired Payment Alert -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex">
                        <div>
                            <i class="bi bi-exclamation-octagon-fill me-3"></i>
                        </div>
                        <div>
                            <h5 class="alert-heading">Waktu pembayaran telah habis!</h5>
                            <p class="mb-0">Silakan lakukan pemesanan ulang jika masih berminat.</p>
                        </div>
                    </div>
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

        document.getElementById("countdown").innerHTML = `⏳ Sisa waktu: <span class="text-primary">${hours} jam ${minutes} menit ${seconds} detik</span>`;
    }, 1000);
</script>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-header {
        font-weight: 600;
    }
    .text-primary {
        color: #0d6efd !important;
    }
    .bg-primary {
        background-color: #0d6efd !important;
    }
    .border-primary {
        border-color: #0d6efd !important;
    }
</style>
@endsection