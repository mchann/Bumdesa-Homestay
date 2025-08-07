



<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <!-- Notifikasi Flash Message -->
    <?php if(session('success')): ?>
        <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-green-100 border border-green-400 text-green-700 px-6 py-3 rounded-lg shadow-lg">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-6 py-3 rounded-lg shadow-lg">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow-lg p-6 max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Jenis Kamar</h2>

        <form action="<?php echo e(route('pemilik.jenis-kamar.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-6">
                <label for="nama_jenis" class="block text-sm font-medium text-gray-700 mb-2">Nama Jenis Kamar</label>
                <input type="text" name="nama_jenis" id="nama_jenis" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                       required>
                <?php $__errorArgs = ['nama_jenis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="<?php echo e(route('pemilik.jenis-kamar.index')); ?>" 
                   class="inline-block bg-gray-500 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-gray-600 transition duration-200 ease-in-out transform hover:scale-105">
                    Batal
                </a>
                <button type="submit" 
                        class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-green-700 transition duration-200 ease-in-out transform hover:scale-105">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/pemilik/jenis_kamar/create.blade.php ENDPATH**/ ?>