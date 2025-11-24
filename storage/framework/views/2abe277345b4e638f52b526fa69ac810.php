<?php $__env->startSection('title', 'Profil Pemilik'); ?>

<?php $__env->startSection('content'); ?>
    <h2>Edit Profil Pemilik Homestay</h2>

    <form action="<?php echo e(route('pemilik.profile.update')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" 
                value="<?php echo e(old('nama_lengkap', $profile->nama_lengkap)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control" 
                value="<?php echo e(old('nomor_telepon', $profile->nomor_telepon)); ?>" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-control" rows="4" required><?php echo e(old('alamat', $profile->alamat)); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal)): ?>
<?php $attributes = $__attributesOriginal; ?>
<?php unset($__attributesOriginal); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal)): ?>
<?php $component = $__componentOriginal; ?>
<?php unset($__componentOriginal); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\tamansari tourism\resources\views/pemilik/profile/create.blade.php ENDPATH**/ ?>