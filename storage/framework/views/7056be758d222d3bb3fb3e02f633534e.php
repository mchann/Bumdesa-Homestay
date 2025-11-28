

<?php $__env->startSection('content'); ?>
<style>
    .table-container {
        background: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        padding: 0; 
    }
    .card-header {
        border-radius: 1rem 1rem 0 0 !important;
    }
    .table-custom {
        border-collapse: separate;
        border-spacing: 0 0.75rem; 
        margin-top: 0.5rem;
    }
    .table-custom thead th {
        font-weight: 600;
        background-color: transparent;
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 0.75rem;
        padding-top: 0;
    }
    .table-custom tbody tr {
        background-color: #f8f9fa;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
    }
    .table-custom tbody tr:hover {
        background-color: #f0f0f0;
        transform: translateY(-1px);
    }
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        justify-content: flex-start;
    }
    .btn-sm {
        padding: 0.4rem 0.6rem;
        font-size: 0.85rem;
        border-radius: 0.5rem;
    }
    .text-warning { color: #ffc107 !important; }
    .text-muted { color: #6c757d !important; }
    .text-info-custom { color: #0dcaf0 !important; } 
    .table-custom td {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    .table-custom td:nth-child(2) { 
         padding-left: 1rem;
    }
    .badge-status {
        font-size: 0.75rem;
        padding: 0.35rem 0.7rem;
    }
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            
            
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card shadow-lg border-0 rounded-4 table-container">
                
                <div class="card-header bg-success text-white rounded-top-4 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1"><i class="fas fa-home me-2"></i> Ulasan Homestay Saya</h4>
                            <p class="text-white-50 mb-0">Kelola dan balas ulasan untuk homestay yang Anda miliki</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-light text-success fs-6 px-3 py-2">
                                <i class="fas fa-comments me-1"></i>
                                Total: <?php echo e($ulasans->total()); ?> Ulasan
                            </span>
                        </div>
                    </div>
                </div>
                
                
                <div class="card-body p-4">
                    <?php if($ulasans->count() > 0): ?>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="d-flex gap-2 align-items-center">
                                    <span class="fw-bold text-dark">Filter:</span>
                                    <span class="badge bg-primary bg-opacity-10 text-primary">Semua</span>
                                    <span class="badge bg-success bg-opacity-10 text-success">Sudah Dibalas</span>
                                    <span class="badge bg-warning bg-opacity-10 text-warning">Belum Dibalas</span>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <small class="text-muted">
                                    Menampilkan <?php echo e($ulasans->count()); ?> dari <?php echo e($ulasans->total()); ?> ulasan
                                </small>
                            </div>
                        </div>

                        
                        <div class="table-responsive">
                            <table class="table table-custom align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 15%;">Rating & Waktu</th>
                                        <th style="width: 20%;">Homestay</th>
                                        <th style="width: 15%;">Pelanggan</th>
                                        <th style="width: 30%;">Komentar & Balasan</th>
                                        <th style="width: 10%;">Status</th>
                                        <th style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $ulasans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulasan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="border-bottom">
                                        
                                        <td>
                                            <div class="d-flex align-items-center mb-1">
                                                <div class="fw-bold text-dark fs-5 me-2"><?php echo e($ulasan->rating); ?>/5</div>
                                                <div class="rating-stars">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <i class="fas fa-star <?php echo e($i <= $ulasan->rating ? 'text-warning' : 'text-muted'); ?> small"></i>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                            <small class="text-muted">
                                                <i class="fas fa-clock me-1"></i>
                                                <?php echo e($ulasan->created_at->format('d M Y H:i')); ?>

                                            </small>
                                        </td>

                                        
                                        <td>
                                            <div class="fw-medium text-dark mb-1">
                                                <i class="fas fa-home me-1 text-success"></i>
                                                <?php echo e($ulasan->homestay->nama_homestay ?? 'Homestay Dihapus'); ?>

                                            </div>
                                            <small class="text-muted">
                                                <i class="fas fa-hashtag me-1"></i>
                                                ID: #<?php echo e($ulasan->homestay_id); ?>

                                            </small>
                                        </td>

                                        
                                        <td>
                                            <div class="fw-medium text-info-custom mb-1">
                                                <i class="fas fa-user me-1"></i>
                                                <?php echo e($ulasan->pelanggan->name ?? 'Pengguna Dihapus'); ?>

                                            </div>
                                            <small class="text-muted">
                                                ID: #<?php echo e($ulasan->pemesanan_id); ?>

                                            </small>
                                        </td>

                                        
                                        <td>
                                            <p class="mb-2 text-dark">
                                                <i class="fas fa-comment me-1 text-muted"></i>
                                                "<?php echo e(\Illuminate\Support\Str::limit($ulasan->komentar, 60, '...') ?? 'Tanpa Komentar'); ?>"
                                            </p>
                                            <div class="balasan-status">
                                                <?php if($ulasan->balasan_pemilik): ?>
                                                    <span class="badge bg-success badge-status">
                                                        <i class="fas fa-check me-1"></i>Anda sudah membalas
                                                    </span>
                                                <?php elseif($ulasan->balasan_admin): ?>
                                                    <span class="badge bg-info badge-status">
                                                        <i class="fas fa-shield-alt me-1"></i>Dibalas Admin
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning badge-status">
                                                        <i class="fas fa-clock me-1"></i>Belum dibalas
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </td>

                                        
                                        <td>
                                            <span class="badge bg-<?php echo e($ulasan->disembunyikan ? 'danger' : 'success'); ?> rounded-pill px-3 py-2">
                                                <i class="fas fa-<?php echo e($ulasan->disembunyikan ? 'eye-slash' : 'eye'); ?> me-1"></i>
                                                <?php echo e($ulasan->disembunyikan ? 'Sembunyi' : 'Tampil'); ?>

                                            </span>
                                        </td>

                                        
                                        <td>
                                            <div class="action-buttons">
                                                <a href="<?php echo e(route('pemilik.ulasan.show', $ulasan->ulasan_id)); ?>" 
                                                   class="btn btn-sm btn-info text-white" 
                                                   title="Lihat & Balas"
                                                   data-bs-toggle="tooltip">
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                                
                                                <form action="<?php echo e(route('pemilik.ulasan.toggle_hide', $ulasan->ulasan_id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-<?php echo e($ulasan->disembunyikan ? 'success' : 'warning'); ?>" 
                                                            title="<?php echo e($ulasan->disembunyikan ? 'Tampilkan' : 'Sembunyikan'); ?>"
                                                            data-bs-toggle="tooltip">
                                                        <i class="fas fa-<?php echo e($ulasan->disembunyikan ? 'eye' : 'eye-slash'); ?>"></i>
                                                    </button>
                                                </form>
                                                
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal<?php echo e($ulasan->ulasan_id); ?>" 
                                                        title="Hapus Permanen"
                                                        data-bs-toggle="tooltip">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        
                        
                        <div class="mt-4 d-flex justify-content-center">
                            <?php echo e($ulasans->links()); ?>

                        </div>

                    <?php else: ?>
                        
                        <div class="text-center py-5">
                            <div class="empty-state-icon mb-4">
                                <i class="fas fa-inbox fa-4x text-muted opacity-50"></i>
                            </div>
                            <h5 class="text-muted mb-3">Belum ada ulasan untuk Homestay Anda</h5>
                            <p class="text-muted mb-4">Dorong pelanggan untuk memberikan rating setelah check-out selesai</p>
                            <a href="<?php echo e(route('pemilik.dashboard')); ?>" class="btn btn-success rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__currentLoopData = $ulasans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulasan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="deleteModal<?php echo e($ulasan->ulasan_id); ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Hapus Ulasan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-3">
                    <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                    <h6 class="fw-bold">Apakah Anda yakin ingin menghapus ulasan ini?</h6>
                </div>
                <div class="alert alert-warning bg-warning bg-opacity-10 border-warning">
                    <small>
                        <i class="fas fa-info-circle me-2"></i>
                        Ulasan dari <strong><?php echo e($ulasan->pelanggan->name ?? 'Pengguna'); ?></strong> untuk 
                        <strong><?php echo e($ulasan->homestay->nama_homestay ?? 'Homestay'); ?></strong> akan dihapus permanen.
                        Tindakan ini tidak dapat dibatalkan.
                    </small>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                <form action="<?php echo e(route('pemilik.ulasan.destroy', $ulasan->ulasan_id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                        <i class="fas fa-trash-alt me-2"></i>Hapus Permanen
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/pemilik/ulasan/index.blade.php ENDPATH**/ ?>