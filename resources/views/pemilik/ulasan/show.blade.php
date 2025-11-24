@extends('layouts.pemilik')

@section('content')
<style>
    .card {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border: none;
    }
    .border-warning {
        border-left-color: #ffc107 !important;
    }
    .border-info {
        border-left-color: #0dcaf0 !important;
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
    .rating-stars {
        display: flex;
        gap: 2px;
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            {{-- NOTIFIKASI --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-times-circle me-2"></i>
                    <strong>Gagal menyimpan balasan.</strong> Mohon periksa kembali input Anda.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-4">
                {{-- HEADER --}}
                <div class="card-header bg-info text-white rounded-top-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1"><i class="fas fa-reply me-2"></i> Balas Ulasan Pelanggan</h4>
                            <p class="text-white-50 mb-0">Berikan respon profesional terhadap ulasan pelanggan</p>
                        </div>
                        <a href="{{ route('pemilik.ulasan.index') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- INFORMASI PELANGGAN & HOMESTAY --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-card p-3 border rounded-3">
                                <h6 class="text-muted mb-2"><i class="fas fa-user me-2"></i>Data Pelanggan</h6>
                                <div class="fw-bold text-dark fs-5 mb-1">{{ $ulasan->pelanggan->name ?? 'Pengguna Dihapus' }}</div>
                                <small class="text-muted">
                                    <i class="fas fa-receipt me-1"></i>ID Pemesanan: #{{ $ulasan->pemesanan_id }}
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card p-3 border rounded-3">
                                <h6 class="text-muted mb-2"><i class="fas fa-home me-2"></i>Homestay</h6>
                                <div class="fw-bold text-dark fs-5 mb-1">{{ $ulasan->homestay->nama_homestay ?? 'Homestay Dihapus' }}</div>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>{{ $ulasan->created_at->format('d M Y, H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- DETAIL ULASAN PELANGGAN --}}
                    <div class="ulasan-section mb-4">
                        <h5 class="text-dark mb-3">
                            <i class="fas fa-comment-dots me-2 text-warning"></i>Ulasan Pelanggan
                        </h5>
                        <div class="bg-light p-4 rounded-3 border-start border-4 border-warning">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="rating-display">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="rating-stars me-3">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $ulasan->rating ? 'text-warning' : 'text-muted' }} fs-5"></i>
                                            @endfor
                                        </div>
                                        <span class="fw-bold text-dark fs-4">{{ $ulasan->rating }}/5</span>
                                    </div>
                                </div>
                                <div class="status-badge">
                                    <span class="badge bg-{{ $ulasan->disembunyikan ? 'danger' : 'success' }} rounded-pill">
                                        <i class="fas fa-{{ $ulasan->disembunyikan ? 'eye-slash' : 'eye' }} me-1"></i>
                                        {{ $ulasan->disembunyikan ? 'Disembunyikan' : 'Ditampilkan' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="komentar-content">
                                <p class="mb-0 fst-italic text-dark fs-6 lh-base">
                                    "{{ $ulasan->komentar ?? 'Pelanggan tidak meninggalkan komentar tertulis.' }}"
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- FORM BALASAN PEMILIK --}}
                    <div class="form-section">
                        <h5 class="text-dark mb-3">
                            <i class="fas fa-edit me-2 text-primary"></i>Form Balasan
                        </h5>
                        
                        @if($ulasan->balasan_pemilik)
                        <div class="alert alert-info bg-info bg-opacity-10 border-info mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-info me-2 fs-5"></i>
                                <div>
                                    <strong>Anda sudah memberikan balasan sebelumnya.</strong> 
                                    Anda dapat memperbarui balasan di bawah ini.
                                </div>
                            </div>
                        </div>
                        @endif

                        <form action="{{ route('pemilik.ulasan.reply', $ulasan->ulasan_id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="balasan_pemilik" class="form-label fw-medium text-dark">
                                    Balasan Anda <span class="text-danger">*</span>
                                </label>
                                <textarea name="balasan_pemilik" 
                                        id="balasan_pemilik" 
                                        class="form-control @error('balasan_pemilik') is-invalid @enderror" 
                                        rows="6" 
                                        placeholder="Tulis balasan profesional Anda di sini. Balasan akan ditampilkan publik..."
                                >{{ old('balasan_pemilik', $ulasan->balasan_pemilik) }}</textarea>
                                
                                @error('balasan_pemilik')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                
                                <div class="form-text text-muted mt-2">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    Tips: Gunakan bahasa yang sopan dan profesional. Ucapan terima kasih dan komitmen untuk meningkatkan pelayanan sangat disarankan.
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center border-top pt-4">
                                <div>
                                    <a href="{{ route('pemilik.ulasan.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                        <i class="fas fa-times me-2"></i> Batal
                                    </a>
                                </div>
                                <div>
                                    @if($ulasan->balasan_pemilik)
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

                    {{-- PREVIEW BALASAN SAAT INI --}}
                    @if($ulasan->balasan_pemilik)
                    <div class="current-reply mt-5 pt-4 border-top">
                        <h5 class="text-dark mb-3">
                            <i class="fas fa-eye me-2 text-success"></i>Pratinjau Balasan Saat Ini
                        </h5>
                        <div class="bg-success bg-opacity-10 p-4 rounded-3 border-start border-4 border-success">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-user-check text-success mt-1 me-3 fs-5"></i>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold text-success">Balasan Pemilik Homestay</span>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            Terakhir diperbarui: {{ $ulasan->updated_at->format('d M Y, H:i') }}
                                        </small>
                                    </div>
                                    <p class="mb-0 text-dark lh-base">{{ $ulasan->balasan_pemilik }}</p>
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

{{-- SCRIPT UNTUK AUTO-RESIZE TEXTAREA --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('balasan_pemilik');
    
    if (textarea) {
        // Auto-resize
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        
        // Trigger initial resize
        textarea.dispatchEvent(new Event('input'));
    }
});
</script>
@endsection