@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0">
                        @if($ulasan->exists)
                            <i class="fas fa-pencil-alt me-2"></i> Edit Ulasan Anda
                        @else
                            <i class="fas fa-star me-2"></i> Beri Ulasan & Rating
                        @endif
                    </h4>
                </div>
                <div class="card-body p-4">

                    <!-- Detail Pemesanan Singkat -->
                    <div class="alert alert-info bg-info bg-opacity-10 border-info border-start border-4 mb-4">
                        <p class="mb-1 fw-medium">Homestay: {{ $pemesanan->homestay->nama_homestay ?? 'N/A' }}</p>
                        <p class="mb-1 small">Check-out: {{ \Carbon\Carbon::parse($pemesanan->tgl_check_out)->format('d F Y') }}</p>
                        <p class="mb-0 small">Nomor Pemesanan: **{{ $pemesanan->invoice_number }}**</p>
                    </div>

                    <!-- Form Ulasan -->
                    <form action="{{ route('ulasan.store_update', $pemesanan->pemesanan_id) }}" method="POST">
                        @csrf
                        
                        @if ($ulasan->exists)
                            <!-- Mengganti metode ke POST untuk Store/Update sesuai Controller -->
                            @method('POST') 
                        @endif

                        <div class="mb-4">
                            <label for="rating" class="form-label fw-bold">1. Rating Anda (Wajib)</label>
                            
                            <!-- Bintang Rating menggunakan CSS dan Radio Input Tersembunyi -->
                            <div class="rating-stars">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star-{{ $i }}-{{ $pemesanan->pemesanan_id }}" name="rating" value="{{ $i }}" 
                                           class="d-none" {{ old('rating', $ulasan->rating) == $i ? 'checked' : '' }} required>
                                    <label for="star-{{ $i }}-{{ $pemesanan->pemesanan_id }}" title="{{ $i }} stars">
                                        <i class="fas fa-star"></i>
                                    </label>
                                @endfor
                            </div>
                            
                            @error('rating')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="komentar" class="form-label fw-bold">2. Komentar/Ulasan (Opsional)</label>
                            <textarea name="komentar" id="komentar" class="form-control" rows="5" maxlength="1000" placeholder="Berikan pengalaman Anda menginap di sini...">{{ old('komentar', $ulasan->komentar ?? '') }}</textarea>
                            <small class="form-text text-muted">Maksimal 1000 karakter.</small>
                            @error('komentar')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('pelanggan.history') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i> Kembali ke Riwayat
                            </a>
                            <div class="btn-group">
                                @if ($ulasan->exists)
                                    <!-- Tombol Hapus (Targeting destroy route) -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill px-4 me-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus Ulasan
                                    </button>
                                    <!-- Tombol Update -->
                                    <button type="submit" class="btn btn-warning rounded-pill px-4">
                                        <i class="fas fa-save me-2"></i> Update Ulasan
                                    </button>
                                @else
                                    <!-- Tombol Simpan -->
                                    <button type="submit" class="btn btn-success rounded-pill px-4">
                                        <i class="fas fa-paper-plane me-2"></i> Kirim Ulasan
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus (Hanya muncul jika ulasan sudah ada) -->
@if ($ulasan->exists)
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Ulasan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus ulasan ini? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('ulasan.destroy', $pemesanan->pemesanan_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus Permanen</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<style>
    .card {
        border-radius: 1rem;
    }
    .rating-stars {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end; 
        font-size: 2rem; 
        line-height: 1;
    }
    .rating-stars > input {
        display: none;
    }
    .rating-stars > label {
        color: #ccc; /* Warna default abu-abu */
        cursor: pointer;
        margin-right: 2px;
        transition: color 0.2s;
    }
    /* Pewarnaan: Bintang yang sudah dipilih dan bintang di belakangnya */
    .rating-stars > input:checked ~ label {
        color: gold;
    }
    /* Pewarnaan: Efek hover */
    .rating-stars > label:hover,
    .rating-stars > label:hover ~ label {
        color: gold;
    }
</style>

@endsection
