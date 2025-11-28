

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center rounded-top-4">
                    <h4 class="mb-0"><i class="fas fa-history me-2"></i>History Pemesanan Saya</h4>
                    <div>
                        <a href="<?php echo e(route('pelanggan.cek-status')); ?>" class="btn btn-light btn-sm rounded-pill me-2">
                            <i class="fas fa-search me-1"></i>Cek Status Terbaru
                        </a>
                        <a href="<?php echo e(url('/')); ?>" class="btn btn-outline-light btn-sm rounded-pill">
                            <i class="fas fa-plus me-1"></i>Pesan Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo e(session('error')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($pemesanan->count() > 0): ?>
                        <!-- Statistics Cards -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card bg-primary bg-opacity-10 border-0 rounded-3">
                                    <div class="card-body text-center p-3">
                                        <h5 class="text-primary mb-1"><?php echo e($pemesanan->total()); ?></h5>
                                        <small class="text-muted">Total Pemesanan</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success bg-opacity-10 border-0 rounded-3">
                                    <div class="card-body text-center p-3">
                                        <h5 class="text-success mb-1"><?php echo e($pemesanan->where('status', 'selesai')->count()); ?></h5>
                                        <small class="text-muted">Selesai</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning bg-opacity-10 border-0 rounded-3">
                                    <div class="card-body text-center p-3">
                                        <h5 class="text-warning mb-1"><?php echo e($pemesanan->whereIn('status', ['pending', 'menunggu_konfirmasi'])->count()); ?></h5>
                                        <small class="text-muted">Dalam Proses</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-danger bg-opacity-10 border-0 rounded-3">
                                    <div class="card-body text-center p-3">
                                        <h5 class="text-danger mb-1"><?php echo e($pemesanan->where('status', 'dibatalkan')->count()); ?></h5>
                                        <small class="text-muted">Dibatalkan</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Info Pagination -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="text-muted">
                                Menampilkan <strong><?php echo e($pemesanan->firstItem() ?? 0); ?></strong> - 
                                <strong><?php echo e($pemesanan->lastItem() ?? 0); ?></strong> dari 
                                <strong><?php echo e($pemesanan->total()); ?></strong> pemesanan
                            </div>
                            <div class="text-muted">
                                Halaman <strong><?php echo e($pemesanan->currentPage()); ?></strong> dari 
                                <strong><?php echo e($pemesanan->lastPage()); ?></strong>
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
                                    <?php $__currentLoopData = $pemesanan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="border-bottom">
                                            <td>
                                                <div>
                                                    <strong class="text-success"><?php echo e($item->invoice_number); ?></strong>
                                                    <br>
                                                    <small class="text-muted">#<?php echo e($item->pemesanan_id); ?></small>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <small class="fw-medium"><?php echo e($item->created_at->format('d M Y')); ?></small>
                                                    <br>
                                                    <small class="text-muted"><?php echo e($item->created_at->format('H:i')); ?></small>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong class="text-dark"><?php echo e($item->kamar->nama_kamar ?? 'N/A'); ?></strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fas fa-home me-1"></i>
                                                        <?php echo e($item->kamar->homestay->nama_homestay ?? 'N/A'); ?>

                                                    </small>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fas fa-door-closed me-1"></i>
                                                        <?php echo e($item->jumlah_kamar); ?> kamar
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="fw-medium text-success">
                                                        <?php echo e(\Carbon\Carbon::parse($item->tgl_check_in)->format('d M')); ?>

                                                    </div>
                                                    <div class="text-muted small">→</div>
                                                    <div class="fw-medium text-dark">
                                                        <?php echo e(\Carbon\Carbon::parse($item->tgl_check_out)->format('d M Y')); ?>

                                                    </div>
                                                    <div class="text-muted small">
                                                        <?php echo e($item->lama_menginap); ?> malam
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-end">
                                                    <strong class="text-success">Rp <?php echo e($item->total_akhir_formatted); ?></strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        + Biaya sistem: Rp <?php echo e($item->biaya_tambahan_formatted); ?>

                                                    </small>
                                                    <br>
                                                    <small class="text-muted">
                                                        <?php echo e($item->jumlah_tamu); ?> tamu
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?php echo e($item->status_badge_class); ?> rounded-pill px-3 py-2">
                                                    <i class="fas fa-<?php echo e($item->status == 'selesai' ? 'check' : ($item->status == 'gagal' ? 'times' : 'clock')); ?> me-1"></i>
                                                    <?php echo e($item->status_label); ?>

                                                </span>
                                                <?php if($item->status == 'pending' && isset($item->batas_pembayaran)): ?>
                                                    <br>
                                                    <small class="text-muted d-block mt-1">
                                                        <i class="fas fa-clock me-1"></i>
                                                        <?php echo e(\Carbon\Carbon::parse($item->batas_pembayaran)->format('H:i')); ?>

                                                    </small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="d-grid gap-2">
                                                    <a href="<?php echo e(route('pelanggan.pemesanan.detail', $item->pemesanan_id)); ?>" 
                                                        class="btn btn-outline-success btn-sm rounded-pill" 
                                                        title="Detail Pemesanan">
                                                        <i class="fas fa-eye me-1"></i>Detail
                                                    </a>
                                                    
                                                    <?php if($item->status == 'pending'): ?>
                                                        <a href="<?php echo e(route('pelanggan.pemesanan.bayar', $item->pemesanan_id)); ?>" 
                                                            class="btn btn-success btn-sm rounded-pill" 
                                                            title="Bayar Sekarang">
                                                            <i class="fas fa-credit-card me-1"></i>Bayar
                                                        </a>
                                                    <?php endif; ?>

                                                    
                                                    <?php if($item->ulasan || $item->bisa_beri_ulasan): ?>
                                                        <?php
                                                            $isEdit = $item->ulasan;
                                                            $btnClass = $isEdit ? 'btn-warning' : 'btn-primary';
                                                            $btnText = $isEdit ? 'Edit Ulasan' : 'Beri Ulasan';
                                                        ?>
                                                        <a href="<?php echo e(route('ulasan.create_edit', $item->pemesanan_id)); ?>" 
                                                            class="btn <?php echo e($btnClass); ?> btn-sm rounded-pill" 
                                                            title="<?php echo e($btnText); ?>">
                                                            <i class="fas fa-star me-1"></i> <?php echo e($btnText); ?>

                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination dengan styling yang lebih baik -->
                        <?php if($pemesanan->hasPages()): ?>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Menampilkan <strong><?php echo e($pemesanan->firstItem()); ?></strong> - 
                                <strong><?php echo e($pemesanan->lastItem()); ?></strong> dari 
                                <strong><?php echo e($pemesanan->total()); ?></strong> hasil
                            </div>
                            
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm mb-0">
                                    
                                    <?php if($pemesanan->onFirstPage()): ?>
                                        <li class="page-item disabled">
                                            <span class="page-link">‹ Previous</span>
                                        </li>
                                    <?php else: ?>
                                        <li class="page-item">
                                            <a class="page-link text-success" href="<?php echo e($pemesanan->previousPageUrl()); ?>" rel="prev">‹ Previous</a>
                                        </li>
                                    <?php endif; ?>

                                    
                                    <?php
                                        $current = $pemesanan->currentPage();
                                        $last = $pemesanan->lastPage();
                                        $start = max(1, $current - 2);
                                        $end = min($last, $current + 2);
                                    ?>

                                    
                                    <?php if($start > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link text-success" href="<?php echo e($pemesanan->url(1)); ?>">1</a>
                                        </li>
                                        <?php if($start > 2): ?>
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    
                                    <?php for($page = $start; $page <= $end; $page++): ?>
                                        <?php if($page == $current): ?>
                                            <li class="page-item active">
                                                <span class="page-link bg-success border-success"><?php echo e($page); ?></span>
                                            </li>
                                        <?php else: ?>
                                            <li class="page-item">
                                                <a class="page-link text-success" href="<?php echo e($pemesanan->url($page)); ?>"><?php echo e($page); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endfor; ?>

                                    
                                    <?php if($end < $last): ?>
                                        <?php if($end < $last - 1): ?>
                                            <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                            </li>
                                        <?php endif; ?>
                                        <li class="page-item">
                                            <a class="page-link text-success" href="<?php echo e($pemesanan->url($last)); ?>"><?php echo e($last); ?></a>
                                        </li>
                                    <?php endif; ?>

                                    
                                    <?php if($pemesanan->hasMorePages()): ?>
                                        <li class="page-item">
                                            <a class="page-link text-success" href="<?php echo e($pemesanan->nextPageUrl()); ?>" rel="next">Next ›</a>
                                        </li>
                                    <?php else: ?>
                                        <li class="page-item disabled">
                                            <span class="page-link">Next ›</span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                        <?php endif; ?>

                    <?php else: ?>
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-history fa-4x text-muted mb-3"></i>
                            </div>
                            <h5 class="text-muted">Belum Ada History Pemesanan</h5>
                            <p class="text-muted mb-4">Anda belum melakukan pemesanan apapun.</p>
                            <a href="<?php echo e(url('/')); ?>" class="btn btn-success btn-lg rounded-pill px-4">
                                <i class="fas fa-plus me-2"></i>Pesan Sekarang
                            </a>
                        </div>
                    <?php endif; ?>
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/pelanggan/pemesanan/history.blade.php ENDPATH**/ ?>