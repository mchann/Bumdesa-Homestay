<?php $__env->startSection('title', 'Tambah Homestay'); ?>

<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Informasi Dasar</h1>

        <?php if($errors->any()): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('pemilik.homestay.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?php echo csrf_field(); ?>

            <!-- Nama Homestay Section -->
            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-gray-700">Nama Homestay</h2>
                <input type="text" name="nama_homestay" required 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Masukkan Nama Homestay"
                       value="<?php echo e(old('nama_homestay')); ?>">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Foto Homestay</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                            <input type="file" name="foto_homestay" accept="image/*" class="hidden" id="fileInput" required>
                            <label for="fileInput" class="cursor-pointer">
                                <span class="text-gray-500">Tambahkan Foto Homestay</span>
                                <div id="fileName" class="text-sm mt-1 text-blue-600"></div>
                            </label>
                        </div>
                        <?php $__errorArgs = ['foto_homestay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Link Google Maps</label>
                        <input type="url" name="link_google_maps" required 
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Kukungkan dengan Google Maps"
                               value="<?php echo e(old('link_google_maps')); ?>">
                    </div>
                </div>
            </div>

            <!-- Deskripsi Section -->
            <div class="space-y-2">
                <h2 class="text-xl font-semibold text-gray-700">Deskripsi</h2>
                <textarea name="deskripsi" 
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Masukkan Deskripti Homestay" rows="4"><?php echo e(old('deskripsi')); ?></textarea>
            </div>

            <!-- Alamat Section -->
            <div class="space-y-2">
                <h2 class="text-xl font-semibold text-gray-700">Alamat Homestay</h2>
                <textarea name="alamat_homestay" required 
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Masukkan Alemat Homestay" rows="3"><?php echo e(old('alamat_homestay')); ?></textarea>
            </div>

         <!-- Peraturan Section (Checkbox version) -->
         <div class="space-y-3">
            <h2 class="text-xl font-semibold text-gray-700">Peraturan Menginap</h2>
            <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                    <?php $__currentLoopData = $peraturan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex items-start opacity-75 cursor-not-allowed">
                            <div class="flex items-center h-5">
                                <input 
                                    type="checkbox" 
                                    name="peraturan[]" 
                                    value="<?php echo e($p->peraturan_id); ?>"
                                    checked
                                    disabled
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded bg-gray-100"
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

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Simpan Homestay
                </button>
            </div>
        </form>
    </div>

    <script>
        // Show selected file name
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Belum ada file dipilih';
            document.getElementById('fileName').textContent = fileName;
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/pemilik/homestay/create.blade.php ENDPATH**/ ?>