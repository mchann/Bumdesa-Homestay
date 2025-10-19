@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center">
        <!-- Success Icon -->
        <div class="mb-4">
            <div class="success-animation">
                <svg class="mx-auto" width="80" height="80" fill="none" viewBox="0 0 24 24" stroke="#25D366">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2l4 -4m5 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Success Message -->
        <h2 class="mb-3 fw-bold text-success">Pemesanan Berhasil! 🎉</h2>
        
        <!-- Invoice Details -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 mx-auto" style="max-width: 500px;">
            <div class="card-body p-4">
                <div class="row text-start">
                    <div class="col-12 mb-3">
                        <label class="text-muted small mb-1">Nomor Pemesanan</label>
                        <p class="fw-bold text-dark mb-0 fs-5">{{ $invoice ?? 'INV-XXXXXX' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small mb-1">Tanggal Pemesanan</label>
                        <p class="fw-bold text-dark mb-0">{{ $tanggal ?? now()->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted small mb-1">Status</label>
                        <p class="fw-bold text-success mb-0">
                            <i class="fas fa-check-circle me-1"></i>Berhasil
                        </p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small mb-1">Total Pembayaran</label>
                        <p class="fw-bold text-success mb-0 fs-4">Rp {{ $total ?? '0' }}</p>
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Sudah termasuk biaya layanan sistem Rp 4.500
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Confirmation -->
        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4 mx-auto" style="max-width: 600px;">
            <div class="d-flex">
                <i class="fas fa-shield-check fa-2x text-success me-3 mt-1"></i>
                <div>
                    <h5 class="alert-heading text-success mb-2">Status Verifikasi Admin</h5>
                    <p class="mb-2 fw-medium">Pembayaran Anda telah berhasil dan sedang diverifikasi oleh admin.</p>
                    <small class="text-muted">
                        <i class="fas fa-bell me-1"></i>
                        Anda akan mendapat notifikasi ketika pemesanan kamar sudah dikonfirmasi.
                    </small>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="card border-0 bg-light rounded-4 mb-5 mx-auto" style="max-width: 600px;">
            <div class="card-body p-4">
                <p class="text-gray-700 mb-3 text-center">
                    <i class="fas fa-clock me-2 text-warning"></i>
                    <strong>Proses verifikasi biasanya memakan waktu 1-2 jam.</strong>
                </p>
                <p class="text-gray-600 mb-0 text-center small">
                    Terima kasih telah mempercayai layanan kami. Tim admin akan segera memverifikasi pembayaran Anda.
                </p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="/" class="btn btn-success btn-lg px-4 rounded-pill shadow-sm">
                <i class="fas fa-home me-2"></i>Kembali ke Beranda
            </a>
            <a href="{{ route('pelanggan.cek-status') }}" class="btn btn-outline-success btn-lg px-4 rounded-pill">
                <i class="fas fa-search me-2"></i>Cek Status
            </a>
            <a href="{{ route('pelanggan.history') }}" class="btn btn-outline-primary btn-lg px-4 rounded-pill">
                <i class="fas fa-history me-2"></i>Lihat History
            </a>
            @isset($pemesanan_id)
            <a href="{{ route('pelanggan.pemesanan.detail', $pemesanan_id) }}" class="btn btn-outline-info btn-lg px-4 rounded-pill">
                <i class="fas fa-eye me-2"></i>Detail Pemesanan
            </a>
            @endisset
        </div>

        <!-- Support Info -->
        <div class="mt-5 pt-4 border-top mx-auto" style="max-width: 600px;">
            <h6 class="text-muted mb-3 text-center">Butuh Bantuan?</h6>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="https://wa.me/6281234567890" class="btn btn-success btn-sm rounded-pill" target="_blank">
                    <i class="fab fa-whatsapp me-1"></i>Chat WhatsApp
                </a>
                <a href="tel:+6281234567890" class="btn btn-outline-dark btn-sm rounded-pill">
                    <i class="fas fa-phone me-1"></i>Hubungi Kami
                </a>
                <a href="mailto:info@homestay.com" class="btn btn-outline-danger btn-sm rounded-pill">
                    <i class="fas fa-envelope me-1"></i>Email Support
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .success-animation {
        animation: bounceIn 0.6s ease-in-out;
    }
    
    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .btn-success {
        background-color: #25D366;
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-success:hover {
        background-color: #1ebe5d;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
    }
    
    .btn-outline-success {
        color: #25D366;
        border-color: #25D366;
        transition: all 0.3s ease;
    }
    
    .btn-outline-success:hover {
        background-color: #25D366;
        color: white;
        transform: translateY(-2px);
    }
    
    .card {
        transition: transform 0.2s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .rounded-4 {
        border-radius: 1rem !important;
    }
    
    .rounded-pill {
        border-radius: 50rem !important;
    }
</style>

<script>
    // Add some interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endsection