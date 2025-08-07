

<?php $__env->startSection('title', 'Kelola Peraturan'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .table-container {
        background: #ffffff;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .section-header h4 {
        font-weight: 600;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
    }

    .search-action {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .search-input {
        border: 1px solid #ced4da;
        border-radius: 50px;
        padding: 0.5rem 1.2rem;
        width: 260px;
        font-size: 0.95rem;
    }

    .btn-tambah {
        background-color: #28c76f;
        color: #ffffff;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        text-decoration: none;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.3s ease;
    }

    .btn-tambah:hover {
        background-color: #22b861;
    }

    .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 0.75rem;
    }

    .table-custom th,
    .table-custom td {
        text-align: center;
        vertical-align: middle;
        padding: 1rem;
    }

    .table-custom thead th {
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        background-color: transparent;
    }

    .table-custom tbody tr {
        background-color: #f8f9fa;
        border-radius: 0.75rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    }

    .table-custom td:nth-child(2) {
        text-align: left;
    }

    .btn-edit,
    .btn-hapus {
        font-weight: 500;
        border-radius: 0.5rem;
        padding: 0.4rem 0.9rem;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.9rem;
        cursor: pointer;
    }

    .btn-edit {
        background-color: #e3f0ff;
        color: #007bff;
    }

    .btn-hapus {
        background-color: #ffe3e3;
        color: #dc3545;
    }

    .text-truncate-ellipsis {
        max-width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    /* Notification styles */
    .notification-container {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 9999;
        max-width: 400px;
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .alert {
        border-radius: 0.5rem;
        padding: 1rem 1.5rem;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        font-size: 1.2rem;
    }

    .alert i {
        font-size: 1.5rem;
    }

    /* Success Notification */
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    /* Update Notification */
    .alert-info {
        background-color: #cce5ff;
        color: #004085;
        border: 1px solid #b8daff;
    }

    /* Delete Notification */
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Animation */
    .alert {
        animation: slideIn 0.5s ease-out forwards;
    }

    /* New styles to match the image */
    .total-info {
        font-weight: bold;
        margin-bottom: 1rem;
    }
    
    .pagination-info {
        margin-top: 1rem;
        text-align: right;
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    .action-separator {
        color: #6c757d;
        padding: 0 0.5rem;
    }

    /* Align buttons horizontally */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .action-buttons form {
        margin: 0;
    }
</style>

<!-- Notification Container -->
<div class="notification-container">
    <?php if(session('create_success')): ?>
    <div class="alert alert-success">
        <i class="bi bi-check-circle-fill"></i>
        <?php echo e(session('create_success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('update_success')): ?>
    <div class="alert alert-info">
        <i class="bi bi-pencil-fill"></i>
        <?php echo e(session('update_success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('delete_success')): ?>
    <div class="alert alert-danger">
        <i class="bi bi-trash-fill"></i>
        <?php echo e(session('delete_success')); ?>

    </div>
    <?php endif; ?>
</div>

<div class="container py-4">
    <div class="table-container">
        <div class="section-header">
            <h4>
                <i class="bi bi-house-door-fill text-success"></i> Kelola Peraturan
            </h4>
            <div class="search-action">
                <a href="<?php echo e(route('admin.peraturan.create')); ?>" class="btn-tambah">
                    <i class="bi bi-plus-circle"></i> Tambah Peraturan
                </a>
            </div>
        </div>

        <div class="total-info">Total: <?php echo e($peraturan->count()); ?> peraturan</div>
        
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th style="width: 10%;">NO</th>
                        <th style="width: 70%;">ISI PERATURAN</th>
                        <th style="width: 20%;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $peraturan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td class="text-truncate-ellipsis"><?php echo e($item->isi_peraturan); ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?php echo e(route('admin.peraturan.edit', $item->peraturan_id)); ?>" class="btn-edit">
                                    Edit
                                </a>
                                <span class="action-separator"></span>
                                <form action="<?php echo e(route('admin.peraturan.destroy', $item->peraturan_id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-hapus">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada peraturan ditambahkan.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="pagination-info">
            Menampilkan 1 sampai <?php echo e($peraturan->count()); ?> dari <?php echo e($peraturan->count()); ?> hasil
        </div>
    </div>
</div>

<script>
    // Auto-hide notifications after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const notifications = document.querySelectorAll('.alert');
        
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.style.animation = 'slideIn 0.3s ease-out reverse forwards';
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/admin/peraturan/index.blade.php ENDPATH**/ ?>