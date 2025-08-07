

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h4>Tutup Kamar: <?php echo e($kamar->nama_kamar); ?></h4>

    <form action="<?php echo e(route('pemilik.room_close.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="kamar_id" value="<?php echo e($kamar->kamar_id); ?>">

        <div class="form-group mb-3">
            <label for="start_date">Tanggal Mulai Tutup</label>
            <input type="date" class="form-control" name="start_date" required>
        </div>

        <div class="form-group mb-3">
            <label for="end_date">Tanggal Selesai Tutup</label>
            <input type="date" class="form-control" name="end_date" required>
        </div>

        <div class="form-group mb-3">
        <label for="alasan" class="form-label">Alasan Penutupan</label>
        <input type="text" name="alasan" id="alasan" class="form-control">

    </div>

        <button type="submit" class="btn btn-danger">Tutup Kamar</button>
        <a href="<?php echo e(route('pemilik.kamar.index')); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\homestay-bumdes\resources\views/pemilik/room_close/create.blade.php ENDPATH**/ ?>