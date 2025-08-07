

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

    <!-- Button Add Jenis Kamar -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Jenis Kamar</h1>
        <a href="<?php echo e(route('pemilik.jenis-kamar.create')); ?>" 
           class="inline-block bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-green-700 transition duration-200 ease-in-out transform hover:scale-105">
            + Tambah Jenis Kamar
        </a>
    </div>

    <!-- Jenis Kamar Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__currentLoopData = $jenis_kamar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4">
                <h3 class="text-lg font-semibold text-gray-800"><?php echo e($jenis->nama_jenis); ?></h3>
                
                <!-- Action Buttons -->
                <div class="mt-4 flex space-x-2">
                    <a href="<?php echo e(route('pemilik.jenis-kamar.edit', $jenis->jenis_kamar_id)); ?>" 
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-200 ease-in-out transform hover:scale-105">
                        Edit
                    </a>
                    <form action="<?php echo e(route('pemilik.jenis-kamar.destroy', $jenis->jenis_kamar_id)); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" 
                                class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-700 transition duration-200 ease-in-out transform hover:scale-105"
                                onclick="return confirm('Hapus jenis kamar ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/pemilik/jenis_kamar/index.blade.php ENDPATH**/ ?>