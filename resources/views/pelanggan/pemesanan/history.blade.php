@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center rounded-top-4">
                    <h4 class="mb-0"><i class="fas fa-history me-2"></i>History Pemesanan Saya</h4>
                    <div>
                        <a href="{{ route('pelanggan.cek-status') }}" class="btn btn-light btn-sm rounded-pill me-2">
                            <i class="fas fa-search me-1"></i>Cek Status Terbaru
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm rounded-pill">
                            <i class="fas fa-plus me-1"></i>Pesan Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if($pemesanan->count() > 0)
                        <!-- Statistics Cards -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card bg-primary bg-opacity-10 border-0 rounded-3">
                                    <div class="card-body text-center p-3">
                                        <h5 class="text-primary mb-1">{{ $pemesanan->total() }}</h5>
                                        <small class="text-muted">Total Pemesanan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success bg-opacity-10 border-0 rounded-3">
                                    <div class="card-body text-center p-3">
                                        <h5 class="text-success mb-1">{{ $pemesanan->where('status', 'selesai')->count() }}</h5>
                                        <small class="text-muted">Selesai</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning bg-opacity-10 border-0 rounded-3">
                                    <div class="card-body text-center p-3">
                                        <h5 class="text-warning mb-1">{{ $pemesanan->whereIn('status', ['pending', 'menunggu_konfirmasi'])->count() }}</h5>
                                        <small class="text-muted">Dalam Proses</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-danger bg-opacity-10 border-0 rounded-3">
                                    <div class="card-body text-center p-3">
                                        <h5 class="text-danger mb-1">{{ $pemesanan->where('status', 'dibatalkan')->count() }}</h5>
                                        <small class="text-muted">Dibatalkan</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Pagination -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="text-muted">
                                Menampilkan <strong>{{ $pemesanan->firstItem() ?? 0 }}</strong> - 
                                <strong>{{ $pemesanan->lastItem() ?? 0 }}</strong> dari 
                                <strong>{{ $pemesanan->total() }}</strong> pemesanan
                            </div>
                            <div class="text-muted">
                                Halaman <strong>{{ $pemesanan->currentPage() }}</strong> dari 
                                <strong>{{ $pemesanan->lastPage() }}</strong>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">
                                <thead class="table-success">
                                    <tr>
                                        <th class="border-0">Invoice</th>
                                        <th class="border-0">Tanggal</th>
                                        <th class="border-0">Homestay & Kamar</th>
                                        <th class="border-0">Check-in/out</th>
                                        <th class="border-0">Total</th>
                                        <th class="border-0">Status</th>
                                        <th class="border-0">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemesanan as $item)
                                        <tr class="border-bottom">
                                            <td>
                                                <div>
                                                    <strong class="text-success">{{ $item->invoice_number }}</strong>
                                                    <br>
                                                    <small class="text-muted">#{{ $item->pemesanan_id }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <small class="fw-medium">{{ $item->created_at->format('d M Y') }}</small>
                                                    <br>
                                                    <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong class="text-dark">{{ $item->kamar->nama_kamar ?? 'N/A' }}</strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fas fa-home me-1"></i>
                                                        {{ $item->kamar->homestay->nama_homestay ?? 'N/A' }}
                                                    </small>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fas fa-door-closed me-1"></i>
                                                        {{ $item->jumlah_kamar }} kamar
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="fw-medium text-success">
                                                        {{ \Carbon\Carbon::parse($item->tgl_check_in)->format('d M') }}
                                                    </div>
                                                    <div class="text-muted small">→</div>
                                                    <div class="fw-medium text-dark">
                                                        {{ \Carbon\Carbon::parse($item->tgl_check_out)->format('d M Y') }}
                                                    </div>
                                                    <div class="text-muted small">
                                                        {{ $item->lama_menginap }} malam
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-end">
                                                    <strong class="text-success">Rp {{ $item->total_akhir_formatted }}</strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        + Biaya sistem: Rp {{ $item->biaya_tambahan_formatted }}
                                                    </small>
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ $item->jumlah_tamu }} tamu
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $item->status_badge_class }} rounded-pill px-3 py-2">
                                                    <i class="fas fa-{{ $item->status == 'selesai' ? 'check' : ($item->status == 'gagal' ? 'times' : 'clock') }} me-1"></i>
                                                    {{ $item->status_label }}
                                                </span>
                                                @if($item->status == 'pending' && isset($item->batas_pembayaran))
                                                    <br>
                                                    <small class="text-muted d-block mt-1">
                                                        <i class="fas fa-clock me-1"></i>
                                                        {{ \Carbon\Carbon::parse($item->batas_pembayaran)->format('H:i') }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-grid gap-2">
                                                    <a href="{{ route('pelanggan.pemesanan.detail', $item->pemesanan_id) }}" 
                                                        class="btn btn-outline-success btn-sm rounded-pill" 
                                                        title="Detail Pemesanan">
                                                        <i class="fas fa-eye me-1"></i>Detail
                                                    </a>
                                                    
                                                    @if($item->status == 'pending')
                                                        <a href="{{ route('pelanggan.pemesanan.bayar', $item->pemesanan_id) }}" 
                                                            class="btn btn-success btn-sm rounded-pill" 
                                                            title="Bayar Sekarang">
                                                            <i class="fas fa-credit-card me-1"></i>Bayar
                                                        </a>
                                                    @endif

                                                    {{-- LOGIKA NAVIGASI LANGSUNG --}}
                                                    @if($item->ulasan || $item->bisa_beri_ulasan)
                                                        @php
                                                            $isEdit = $item->ulasan;
                                                            $btnClass = $isEdit ? 'btn-warning' : 'btn-primary';
                                                            $btnText = $isEdit ? 'Edit Ulasan' : 'Beri Ulasan';
                                                        @endphp
                                                        <a href="{{ route('ulasan.create_edit', $item->pemesanan_id) }}" 
                                                            class="btn {{ $btnClass }} btn-sm rounded-pill" 
                                                            title="{{ $btnText }}">
                                                            <i class="fas fa-star me-1"></i> {{ $btnText }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination dengan styling yang lebih baik -->
                        @if($pemesanan->hasPages())
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Menampilkan <strong>{{ $pemesanan->firstItem() }}</strong> - 
                                <strong>{{ $pemesanan->lastItem() }}</strong> dari 
                                <strong>{{ $pemesanan->total() }}</strong> hasil
                            </div>
                            
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm mb-0">
                                    {{-- Previous Page Link --}}
                                    @if($pemesanan->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link">‹ Previous</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link text-success" href="{{ $pemesanan->previousPageUrl() }}" rel="prev">‹ Previous</a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @php
                                        $current = $pemesanan->currentPage();
                                        $last = $pemesanan->lastPage();
                                        $start = max(1, $current - 2);
                                        $end = min($last, $current + 2);
                                    @endphp

                                    {{-- First Page Link --}}
                                    @if($start > 1)
                                        <li class="page-item">
                                            <a class="page-link text-success" href="{{ $pemesanan->url(1) }}">1</a>
                                        </li>
                                        @if($start > 2)
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                        @endif
                                    @endif

                                    {{-- Array Of Links --}}
                                    @for($page = $start; $page <= $end; $page++)
                                        @if($page == $current)
                                            <li class="page-item active">
                                                <span class="page-link bg-success border-success">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link text-success" href="{{ $pemesanan->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endfor

                                    {{-- Last Page Link --}}
                                    @if($end < $last)
                                        @if($end < $last - 1)
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                        @endif
                                        <li class="page-item">
                                            <a class="page-link text-success" href="{{ $pemesanan->url($last) }}">{{ $last }}</a>
                                        </li>
                                    @endif

                                    {{-- Next Page Link --}}
                                    @if($pemesanan->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link text-success" href="{{ $pemesanan->nextPageUrl() }}" rel="next">Next ›</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">Next ›</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        @endif

                    @else
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-history fa-4x text-muted mb-3"></i>
                            </div>
                            <h5 class="text-muted">Belum Ada History Pemesanan</h5>
                            <p class="text-muted mb-4">Anda belum melakukan pemesanan apapun.</p>
                            <a href="{{ url('/') }}" class="btn btn-success btn-lg rounded-pill px-4">
                                <i class="fas fa-plus me-2"></i>Pesan Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 1rem;
    }
    .rounded-4 {
        border-radius: 1rem !important;
    }
    .rounded-top-4 {
        border-top-left-radius: 1rem !important;
        border-top-right-radius: 1rem !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(37, 211, 102, 0.05);
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    .btn-success {
        background-color: #25D366;
        border: none;
    }
    .btn-success:hover {
        background-color: #1ebe5d;
        transform: translateY(-1px);
    }
    .badge {
        font-size: 0.75rem;
    }
    .bg-opacity-10 {
        background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
    }
    .pagination .page-link {
        border: 1px solid #dee2e6;
        color: #25D366;
        margin: 0 2px;
        border-radius: 0.5rem;
    }
    .pagination .page-link:hover {
        background-color: #e8f5e8;
        border-color: #25D366;
    }
    .pagination .page-item.active .page-link {
        background-color: #25D366;
        border-color: #25D366;
    }
    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #f8f9fa;
    }
</style>

@endsection