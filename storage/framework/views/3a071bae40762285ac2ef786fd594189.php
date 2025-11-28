<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100">
    <!-- Main Content -->
    <div class="flex flex-col">
        <!-- Header -->
        <header class="bg-white/80 backdrop-blur-md shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-10">
            <div>
                <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600">
                    Daftarkan Pemilik Baru
                </h1>
                <p class="text-sm text-gray-500 mt-1">Tambahkan akun baru untuk pemilik homestay</p>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-soft-xl overflow-hidden border border-white/50">

            <!-- Header -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-6 text-white">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold">Informasi Akun Pemilik</h2>
                        <p class="text-green-100 text-sm">Lengkapi data dibawah untuk mendaftarkan akun baru</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="<?php echo e(route('admin.store.pemilik')); ?>" method="POST" class="p-8 space-y-6">
                <?php echo csrf_field(); ?>

                <!-- Nama & Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Nama Lengkap -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                </svg>
                            </span>
                            <input type="text" name="name" required
                                class="w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Masukkan Nama Lengkap">
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Email (Gmail) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </span>
                            <input type="email" name="email" required pattern=".+@gmail\.com"
                                class="w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="example@gmail.com">
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" />
                            </svg>
                        </span>
                        <input type="password" name="password" id="password" required
                            class="w-full pl-10 pr-10 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            placeholder="Masukkan Password">

                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg id="eyeIcon" class="h-5 w-5 text-gray-400 hover:text-gray-600"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Telepon & Alamat -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Telepon -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                            </span>
                            <input type="tel" name="nomor_telepon" required
                                class="w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="0812-3456-7890">
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute top-3 left-3 flex items-center">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </span>
                            <textarea name="alamat" rows="3" required
                                class="w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Masukkan Alamat"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-8 border-t border-gray-100">
                    <a href="<?php echo e(route('admin.pemilik.list')); ?>"
                        class="px-6 py-3 border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 flex items-center space-x-2">
                        <svg class="h-5 w-5" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" />
                        </svg>
                        <span>Kembali</span>
                    </a>

                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:scale-[1.02] flex items-center space-x-2">
                        <svg class="h-5 w-5" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                        </svg>
                        <span>Daftarkan Akun</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="mt-6 bg-green-50/50 border border-green-100 rounded-lg p-4 flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-500" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">Informasi Penting</h3>
                <div class="mt-2 text-sm text-green-700">
                    <p>• Pastikan semua field bertanda <span class="text-red-500">*</span> telah terisi</p>
                    <p>• Password minimal 8 karakter</p>
                    <p>• Email harus diakhiri <b>@gmail.com</b></p>
                </div>
            </div>
        </div>
    </div>
</main>

    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    togglePassword.addEventListener('click', function() {
        // Toggle password visibility
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Toggle eye icon
        if (type === 'text') {
            // Change to eye-off icon
            eyeIcon.innerHTML = `
                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
            `;
        } else {
            // Change back to eye icon
            eyeIcon.innerHTML = `
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
            `;
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/admin/daftarpemilik.blade.php ENDPATH**/ ?>