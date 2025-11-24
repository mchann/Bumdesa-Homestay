@extends('layouts.admin')

@section('content')
<style>
    .card {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border: none;
    }
    .border-warning {
        border-left-color: #ffc107 !important;
    }
    .border-primary {
        border-left-color: #0d6efd !important;
    }
    .btn {
        border-radius: 50px;
    }
    .form-control {
        border-radius: 0.5rem;
    }
    .alert-light {
        background-color: #f8f9fa;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Tombol Kembali -->
            <a href="{{ route('admin.ulasan.index') }}" class="btn btn-sm btn-secondary mb-3 rounded-pill">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Ulasan
            </a>

            <div class="card shadow-lg border-0 rounded-4">
                <!-- Header Card -->
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h4 class="mb-0"><i class="fas fa-envelope-open-text me-2"></i> Detail & Balas Ulasan</h4>
                </div>
                
                <div class="card-body p-4">
                    <!-- Informasi Ulasan -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h5 class="text-primary mb-2">{{ $ulasan->homestay->nama_homestay ?? 'Homestay Dihapus' }}</h5>
                            <p class="mb-1 text-muted small">
                                <i class="fas fa-user me-1"></i> Dari: <strong>{{ $ulasan->pelanggan->name ?? 'Pengguna Dihapus' }}</strong>
                            </p>
                            <p class="mb-2 text-muted small">
                                <i class="fas fa-receipt me-1"></i> ID Pemesanan: <strong>#{{ $ulasan->pemesanan_id }}</strong>
                            </p>
                            <p class="mb-2 text-muted small">
                                <i class="fas fa-clock me-1"></i> Tanggal: {{ $ulasan->created_at->format('d M Y H:i') }}
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="rating-section mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star fa-lg {{ $i <= $ulasan->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                                <span class="fw-bold ms-2 fs-5">{{ $ulasan->rating }}/5</span>
                            </div>
                            <span class="badge bg-{{ $ulasan->disembunyikan ? 'danger' : 'success' }} rounded-pill px-3 py-2">
                                <i class="fas fa-{{ $ulasan->disembunyikan ? 'eye-slash' : 'eye' }} me-1"></i>
                                {{ $ulasan->disembunyikan ? 'Disembunyikan' : 'Ditampilkan' }}
                            </span>
                        </div>
                    </div>

                    <!-- Komentar Pelanggan -->
                    <div class="alert alert-light border-start border-4 border-warning p-4 mb-4">
                        <h6 class="text-dark mb-2"><i class="fas fa-comment me-2"></i>Komentar Pelanggan:</h6>
                        <p class="mb-0 fst-italic fs-6">"{{ $ulasan->komentar ?? 'Pelanggan tidak meninggalkan komentar tertulis.' }}"</p>
                    </div>

                    <!-- Form Balasan -->
                    <div class="form-section">
                        <h5 class="mb-3 text-dark">
                            <i class="fas fa-reply me-2 text-primary"></i> Balasan Admin
                        </h5>
                        <form action="{{ route('admin.ulasan.reply', $ulasan->ulasan_id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="balasan_admin" class="form-control" rows="6" 
                                    placeholder="Tulis balasan resmi Anda di sini...">{{ old('balasan_admin', $ulasan->balasan_admin) }}</textarea>
                                @error('balasan_admin')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted mt-2">
                                    <i class="fas fa-info-circle me-1"></i> Balasan ini akan ditampilkan publik di bawah ulasan pelanggan.
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Tombol Aksi Tambahan -->
                                <div>
                                    <a href="{{ route('admin.ulasan.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                        <i class="fas fa-times me-2"></i> Batal
                                    </a>
                                </div>
                                
                                <!-- Tombol Submit -->
                                <div>
                                    @if($ulasan->balasan_admin)
                                        <button type="submit" class="btn btn-warning rounded-pill px-4">
                                            <i class="fas fa-sync-alt me-2"></i> Perbarui Balasan
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                                            <i class="fas fa-paper-plane me-2"></i> Kirim Balasan
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Preview Balasan Saat Ini -->
                    @if($ulasan->balasan_admin)
                    <div class="mt-5 pt-4 border-top">
                        <h6 class="text-dark mb-3">
                            <i class="fas fa-bullhorn me-2 text-success"></i> Balasan Saat Ini:
                        </h6>
                        <div class="alert alert-primary bg-primary bg-opacity-10 border-start border-4 border-primary p-4">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-shield-alt text-primary mt-1 me-3"></i>
                                <div>
                                    <p class="mb-0 fw-medium">{{ $ulasan->balasan_admin }}</p>
                                    <small class="text-muted mt-2 d-block">
                                        <i class="fas fa-clock me-1"></i>
                                        Terakhir diperbarui: {{ $ulasan->updated_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection