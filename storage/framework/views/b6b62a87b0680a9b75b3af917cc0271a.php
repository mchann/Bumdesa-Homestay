<?php $__env->startSection('title', 'Profil Pemilik'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900">Profil Pemilik Homestay</h1>
            <p class="mt-2 text-lg text-gray-600">Kelola informasi profil Anda</p>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <div class="flex items-center">
                    <div class="mr-4">
                        <div class="h-16 w-16 rounded-full bg-white flex items-center justify-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white"><?php echo e($profile->nama_lengkap ?? 'Nama Belum Diisi'); ?></h2>
                        <p class="text-blue-100">Pemilik Homestay</p>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="p-6 sm:p-8">
                <?php if($profile): ?>
                    <div class="space-y-6">
                        <!-- Profile Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900">
                                    <?php echo e($profile->nama_lengkap ?? 'Belum diisi'); ?>

                                </p>
                            </div>

                            <!-- Phone -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm font-medium text-gray-500">Nomor Telepon</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900">
                                    <?php echo e($profile->nomor_telepon ?? 'Belum diisi'); ?>

                                </p>
                            </div>

                            <!-- Address -->
                            <div class="bg-gray-50 p-4 rounded-lg col-span-2">
                                <p class="text-sm font-medium text-gray-500">Alamat</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900">
                                    <?php echo e($profile->alamat ?? 'Belum diisi'); ?>

                                </p>
                            </div>
                        </div>

                        <!-- Warning Alert if incomplete -->
                        <?php if(!$profile->nama_lengkap || !$profile->nomor_telepon || !$profile->alamat): ?>
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">Profil Belum Lengkap</h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>Lengkapi profil Anda untuk pengalaman yang lebih baik.</p>
                                        </div>
                                        <div class="mt-4">
                                            <a href="<?php echo e(route('pemilik.profile.edit')); ?>" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                Lengkapi Profil
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <!-- No Profile Warning -->
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Profil Belum Ada</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p>Anda belum membuat profil. Silakan lengkapi profil Anda.</p>
                                </div>
                                <div class="mt-4">
                                    <a href="<?php echo e(route('pemilik.profile.create')); ?>" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                        Buat Profil
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                    <?php if($profile): ?>
                        <a href="<?php echo e(route('pemilik.profile.edit')); ?>" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                            <svg class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit Profil
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/pemilik/profile/show.blade.php ENDPATH**/ ?>