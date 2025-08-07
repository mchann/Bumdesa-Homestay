<?php $__env->startSection('title', 'Edit Homestay'); ?>

<?php $__env->startSection('content'); ?>
    <h1 class="text-xl font-bold mb-4">Edit Informasi Homestay</h1>

    <form action="<?php echo e(route('pemilik.homestay.update', $homestay->homestay_id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div>
            <label for="nama_homestay" class="block font-medium">Nama Homestay</label>
            <input type="text" name="nama_homestay" id="nama_homestay" value="<?php echo e(old('nama_homestay', $homestay->nama_homestay)); ?>" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label for="alamat_homestay" class="block font-medium">Alamat Homestay</label>
            <textarea name="alamat_homestay" id="alamat_homestay" class="w-full border rounded px-3 py-2"><?php echo e(old('alamat_homestay', $homestay->alamat_homestay)); ?></textarea>
        </div>

        <div>
            <label for="link_google_maps" class="block font-medium">Link Google Maps</label>
            <input type="text" name="link_google_maps" id="link_google_maps" value="<?php echo e(old('link_google_maps', $homestay->link_google_maps)); ?>" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label for="deskripsi" class="block font-medium">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="w-full border rounded px-3 py-2"><?php echo e(old('deskripsi', $homestay->deskripsi)); ?></textarea>
        </div>
        <div class="space-y-3">
            <h2 class="text-xl font-semibold text-gray-700">Peraturan Menginap</h2>
            <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                    <?php $__currentLoopData = $peraturan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="flex items-start">
                        <div class="flex items-center h-5">
                            <input 
                                type="checkbox" 
                                name="peraturan[]" 
                                value="<?php echo e($p->peraturan_id); ?>"
                                <?php echo e(in_array($p->peraturan_id, $homestay->peraturan->pluck('peraturan_id')->toArray()) ? 'checked' : ''); ?>

                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            >
                        </div>
                        <div class="ml-3 text-sm">
                            <span class="text-gray-700"><?php echo e($p->isi_peraturan); ?></span>
                        </div>
                    </label>
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div>
            <label for="foto_homestay" class="block font-medium">Foto Homestay</label>
            <input type="file" name="foto_homestay" id="foto_homestay" class="w-full border rounded px-3 py-2">

            <?php if($homestay->foto_homestay): ?>
                <p class="mt-2">Foto saat ini:</p>
                <img src="<?php echo e(asset('storage/' . $homestay->foto_homestay)); ?>" alt="Foto Homestay" class="w-40 mt-2 rounded">
            <?php endif; ?>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/pemilik/homestay/edit.blade.php ENDPATH**/ ?>