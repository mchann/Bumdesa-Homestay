@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-store text-success me-2"></i>Kelola Produk UMKM
            </h1>
            <p class="text-muted mt-1">Kelola dan pantau semua produk UMKM dalam sistem</p>
        </div>
        <a href="{{ route('admin.umkm.create') }}" class="btn btn-success shadow-sm px-4 py-2">
            <i class="fas fa-plus-circle me-2"></i>Tambah Produk
        </a>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm mb-4 border-0" style="border-left: 4px solid #28a745;">
        <div class="card-header bg-light py-3">
            <h6 class="m-0 font-weight-bold text-success">
                <i class="fas fa-filter me-2"></i>Filter & Pencarian
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.umkm.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-success">Pencarian</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-success">
                                <i class="fas fa-search text-success"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-success" 
                                   placeholder="Cari produk..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold text-success">Kategori</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-success">
                                <i class="fas fa-tags text-success"></i>
                            </span>
                            <select name="kategori" class="form-control border-success">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold text-success">Status</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-success">
                                <i class="fas fa-power-off text-success"></i>
                            </span>
                            <select name="status" class="form-control border-success">
                                <option value="">Semua Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-success flex-fill">
                            <i class="fas fa-filter me-2"></i>Terapkan Filter
                        </button>
                        <a href="{{ route('admin.umkm.index') }}" class="btn btn-outline-success">
                            <i class="fas fa-refresh me-2"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Produk
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Produk Aktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $products->where('status', 'active')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Stok Menipis
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $products->where('stok', '<', 10)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-sm h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Kategori
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($categories) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Produk -->
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-header bg-gradient-success text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-table me-2"></i>Daftar Produk UMKM
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light-success">
                        <tr>
                            <th class="px-4">Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>No. Telepon Owner</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr class="align-middle">
                            <td class="px-4">
                                <div class="product-image-container">
                                    @if($product->gambar)
                                        <img src="{{ asset('storage/' . $product->gambar) }}" 
                                             alt="{{ $product->nama_produk }}" 
                                             class="product-image rounded shadow-sm">
                                    @else
                                        <div class="no-image-placeholder rounded">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $product->nama_produk }}</div>
                                @if($product->badge)
                                    <span class="badge badge-custom mt-1">{{ $product->badge }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $product->kategori }}</span>
                            </td>
                            <td>
                                <span class="fw-bold text-success">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                @if($product->stok > 20)
                                    <span class="badge bg-success">{{ $product->stok }}</span>
                                @elseif($product->stok > 5)
                                    <span class="badge bg-warning text-dark">{{ $product->stok }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $product->stok }}</span>
                                @endif
                            </td>
                            <td>
                                <select class="form-select status-select border-0 shadow-sm {{ $product->status == 'active' ? 'bg-success-light text-success' : 'bg-danger-light text-danger' }}" 
                                        data-id="{{ $product->id }}">
                                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone text-muted me-2"></i>
                                    <span class="text-muted">{{ $product->no_telepon_owner ?? '-' }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.umkm.edit', $product->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                       data-bs-toggle="tooltip" title="Edit Produk">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.umkm.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                                data-bs-toggle="tooltip" title="Hapus Produk">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada produk</h5>
                                    <p class="text-muted">Mulai dengan menambahkan produk pertama Anda</p>
                                    <a href="{{ route('admin.umkm.create') }}" class="btn btn-success mt-2">
                                        <i class="fas fa-plus me-2"></i>Tambah Produk Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($products->hasPages())
            <div class="card-footer bg-light py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari {{ $products->total() }} produk
                    </div>
                    <nav aria-label="Page navigation">
                        {{ $products->links() }}
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.bg-light-success {
    background-color: rgba(40, 167, 69, 0.1) !important;
}
.bg-success-light {
    background-color: rgba(40, 167, 69, 0.15) !important;
}
.bg-danger-light {
    background-color: rgba(220, 53, 69, 0.15) !important;
}
.product-image-container {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.product-image:hover {
    transform: scale(1.1);
}
.no-image-placeholder {
    width: 60px;
    height: 60px;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px dashed #dee2e6;
}
.badge-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-size: 0.7em;
    padding: 0.25em 0.6em;
}
.border-left-success {
    border-left: 4px solid #28a745 !important;
}
.border-left-info {
    border-left: 4px solid #17a2b8 !important;
}
.border-left-warning {
    border-left: 4px solid #ffc107 !important;
}
.border-left-primary {
    border-left: 4px solid #007bff !important;
}
.empty-state {
    padding: 2rem 0;
}
.table-hover tbody tr:hover {
    background-color: rgba(40, 167, 69, 0.05);
    transform: translateY(-1px);
    transition: all 0.3s ease;
}
.status-select {
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 600;
    border-radius: 20px;
    padding: 0.375rem 1rem;
}
.status-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}
.btn-outline-success:hover {
    transform: translateY(-1px);
}
.card {
    box-shadow: 0 0.5rem 1rem rgba(40, 167, 69, 0.1);
    transition: box-shadow 0.3s ease;
}
.card:hover {
    box-shadow: 0 0.5rem 1.5rem rgba(40, 167, 69, 0.15);
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    // Status change handler
    $('.status-select').change(function() {
        const productId = $(this).data('id');
        const status = $(this).val();
        const select = $(this);
        
        // Update visual appearance immediately
        if (status === 'active') {
            select.removeClass('bg-danger-light text-danger').addClass('bg-success-light text-success');
        } else {
            select.removeClass('bg-success-light text-success').addClass('bg-danger-light text-danger');
        }
        
        // Send AJAX request
        $.ajax({
            url: `/admin/umkm/${productId}/status`,
            method: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                // Show success notification
                showNotification('Status berhasil diperbarui!', 'success');
            },
            error: function() {
                // Revert visual changes on error
                const originalStatus = status === 'active' ? 'inactive' : 'active';
                select.val(originalStatus);
                if (originalStatus === 'active') {
                    select.removeClass('bg-danger-light text-danger').addClass('bg-success-light text-success');
                } else {
                    select.removeClass('bg-success-light text-success').addClass('bg-danger-light text-danger');
                }
                
                showNotification('Terjadi kesalahan saat memperbarui status!', 'error');
            }
        });
    });

    // Search input debounce
    let searchTimeout;
    $('input[name="search"]').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            $(this).closest('form').submit();
        }, 500);
    });

    // Notification function
    function showNotification(message, type) {
        // You can integrate with toastr or any notification library
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        
        const notification = $(`
            <div class="alert ${alertClass} alert-dismissible fade show position-fixed" 
                 style="top: 20px; right: 20px; z-index: 1050; min-width: 300px;">
                <i class="fas ${icon} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);
        
        $('body').append(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.alert('close');
        }, 3000);
    }

    // Add smooth animations
    $('.card').addClass('animate__animated animate__fadeInUp');
});
</script>
@endpush