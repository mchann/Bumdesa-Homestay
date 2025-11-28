

<?php $__env->startSection('content'); ?>
<style>
    /* CUSTOM STYLES */
    .ulasan-content {
        padding: 0;
    }
    .table-container {
        background: #ffffff;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-top: 1.5rem;
        padding: 1.5rem;
    }
    .table-custom {
        border-collapse: separate;
        border-spacing: 0 0.5rem; 
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
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.2s ease;
    }
    .table-custom tbody tr:hover {
        background-color: #f0f0f0;
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
    .text-info-custom { color: #0dcaf0 !important; } 
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            
            
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white rounded-top-4">
                    <h4 class="mb-0"><i class="fas fa-comments me-2"></i> Moderasi Ulasan Global</h4>
                    <p class="text-white-50 mb-0">Kelola dan moderasi semua ulasan yang masuk ke sistem.</p>
                </div>
                
                <div class="card-body ulasan-content p-4">

                    <?php if($ulasans->count() > 0): ?>
                        <div class="total-info fw-bold mb-3">Total: <?php echo e($ulasans->total()); ?> ulasan</div>
                        
                        <div class="table-responsive">
                            <table class="table table-custom align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 15%;">Rating & Waktu</th>
                                        <th style="width: 25%;">Homestay & Pemesanan</th>
                                        <th style="width: 15%;">Pelanggan</th>
                                        <th style="width: 30%;">Komentar & Balasan</th>
                                        <th style="width: 5%;">Status</th>
                                        <th style="width: 10%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $ulasans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulasan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="border-bottom">
                                        <td>
                                            <div class="fw-bold text-dark fs-5"><?php echo e($ulasan->rating); ?>/5</div>
                                            <div>
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star <?php echo e($i <= $ulasan->rating ? 'text-warning' : 'text-muted'); ?> small"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <small class="text-muted d-block mt-1"><?php echo e($ulasan->created_at->format('d M Y H:i')); ?></small>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark"><?php echo e($ulasan->homestay->nama_homestay ?? 'Homestay Dihapus'); ?></div>
                                            <small class="text-muted">ID Pemesanan: #<?php echo e($ulasan->pemesanan_id); ?></small>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-info-custom"><?php echo e($ulasan->pelanggan->name ?? 'Pengguna Dihapus'); ?></div>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-dark" style="max-width: 300px;">
                                                "<?php echo e(\Illuminate\Support\Str::limit($ulasan->komentar, 50, '...') ?? 'Tanpa Komentar'); ?>"
                                            </p>
                                            <?php if($ulasan->balasan_admin): ?>
                                                <span class="badge bg-success bg-opacity-75 mt-1">Dibalas Admin</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?php echo e($ulasan->disembunyikan ? 'danger' : 'success'); ?> rounded-pill px-3 py-2">
                                                <?php echo e($ulasan->disembunyikan ? 'Sembunyi' : 'Tampil'); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                
                                                <a href="<?php echo e(route('admin.ulasan.show', $ulasan->ulasan_id)); ?>" class="btn btn-sm btn-info text-white" title="Lihat & Balas">
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                                
                                                
                                                <form action="<?php echo e(route('admin.ulasan.toggle_hide', $ulasan->ulasan_id)); ?>" method="POST" class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-sm btn-<?php echo e($ulasan->disembunyikan ? 'success' : 'warning'); ?>" title="<?php echo e($ulasan->disembunyikan ? 'Tampilkan' : 'Sembunyikan'); ?>">
                                                        <i class="fas fa-<?php echo e($ulasan->disembunyikan ? 'eye' : 'eye-slash'); ?>"></i>
                                                    </button>
                                                </form>
                                                
                                                
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($ulasan->ulasan_id); ?>" title="Hapus Permanen">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                                            <h5 class="text-muted">Tidak Ada Ulasan Saat Ini</h5>
                                            <p class="text-muted">Semua ulasan yang masuk akan muncul di sini untuk dimoderasi.</p>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4 d-flex justify-content-center">
                            <?php echo e($ulasans->links()); ?>

                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__currentLoopData = $ulasans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulasan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade" id="deleteModal<?php echo e($ulasan->ulasan_id); ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Ulasan Permanen</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin **menghapus permanen** ulasan dari **<?php echo e($ulasan->pelanggan->name ?? 'Pengguna'); ?>** untuk homestay *<?php echo e($ulasan->homestay->nama_homestay ?? 'N/A'); ?>*? Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="<?php echo e(route('admin.ulasan.destroy', $ulasan->ulasan_id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\PEBEL\new before pull\tamansari tourism\resources\views/admin/ulasan/index.blade.php ENDPATH**/ ?>