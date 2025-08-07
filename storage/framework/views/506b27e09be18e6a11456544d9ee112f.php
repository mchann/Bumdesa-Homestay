<?php $__env->startSection('title', 'Tambah Fasilitas Baru'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Tambah Fasilitas Baru</h2>

        <form action="<?php echo e(route('admin.fasilitas.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <!-- Nama Fasilitas -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Fasilitas</label>
                <input type="text" name="nama_fasilitas" 
                       class="w-full border rounded py-2 px-3 <?php $__errorArgs = ['nama_fasilitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       value="<?php echo e(old('nama_fasilitas')); ?>"
                       placeholder="Contoh: AC, WiFi, TV"
                       required>
                
                <?php $__errorArgs = ['nama_fasilitas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-red-500 text-sm mt-1"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3 mt-6">
                <a href="<?php echo e(route('admin.fasilitas.index')); ?>" 
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Kembali
                </a>
                <button type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Simpan Fasilitas
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/admin/fasilitas/create.blade.php ENDPATH**/ ?>