

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Pemesanan</h1>
        
        
        
    </div>

    
    <div class="flex overflow-x-auto mb-8 scrollbar-hide">
        <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg">
            <a href="<?php echo e(route('admin.pemesanan.index', ['status' => 'semua'])); ?>" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                      <?php echo e(request('status') == 'semua' ? 'bg-white shadow text-blue-600' : 'text-gray-600 hover:text-gray-800'); ?>">
                Semua
            </a>
            <a href="<?php echo e(route('admin.pemesanan.index', ['status' => 'berhasil'])); ?>" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                      <?php echo e(request('status') == 'berhasil' ? 'bg-white shadow text-green-600' : 'text-gray-600 hover:text-gray-800'); ?>">
                Berhasil
            </a>
            <a href="<?php echo e(route('admin.pemesanan.index', ['status' => 'menunggu_konfirmasi'])); ?>" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                      <?php echo e(request('status') == 'menunggu_konfirmasi' ? 'bg-white shadow text-yellow-600' : 'text-gray-600 hover:text-gray-800'); ?>">
                Diproses
            </a>
            <a href="<?php echo e(route('admin.pemesanan.index', ['status' => 'gagal'])); ?>" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                      <?php echo e(request('status') == 'gagal' ? 'bg-white shadow text-red-600' : 'text-gray-600 hover:text-gray-800'); ?>">
                Gagal
            </a>
            <a href="<?php echo e(route('admin.pemesanan.index', ['status' => 'selesai'])); ?>" 
               class="px-6 py-2 text-sm font-medium rounded-md whitespace-nowrap transition-colors duration-200 
                      <?php echo e(request('status') == 'selesai' ? 'bg-white shadow text-blue-600' : 'text-gray-600 hover:text-gray-800'); ?>">
                Selesai
            </a>
        </div>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-max">
                <thead class="bg-gray-50">
                    <tr class="text-left text-gray-600 text-sm font-medium">
                        <th class="px-6 py-4">Tgl Pesan</th>
                        <th class="px-6 py-4">Homestay</th>
                        <th class="px-6 py-4">ID Pesanan</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Check-in</th>
                        <th class="px-6 py-4">Check-out</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Bukti</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__empty_1 = true; $__currentLoopData = $pemesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pemesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-800 font-medium"><?php echo e(date('d.m.Y', strtotime($pemesanan->created_at))); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800"><?php echo e($pemesanan->kamar->homestay->nama_homestay ?? '-'); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-mono text-blue-600"><?php echo e($pemesanan->pemesanan_id); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800"><?php echo e($pemesanan->pelanggan->name ?? '-'); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-800"><?php echo e(date('d-m-Y h:ia', strtotime($pemesanan->tgl_check_in))); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-800"><?php echo e(date('d-m-Y h:ia', strtotime($pemesanan->tgl_check_out))); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <?php
                                    $statusClasses = [
                                        'berhasil' => 'bg-green-50 text-green-700',
                                        'menunggu_konfirmasi' => 'bg-yellow-50 text-yellow-700',
                                        'gagal' => 'bg-red-50 text-red-700',
                                        'selesai' => 'bg-blue-50 text-blue-700',
                                        'pending' => 'bg-gray-50 text-gray-700'
                                    ];
                                    $statusText = [
                                        'berhasil' => 'Berhasil',
                                        'menunggu_konfirmasi' => 'Diproses',
                                        'gagal' => 'Gagal',
                                        'selesai' => 'Selesai',
                                        'pending' => 'Pending'
                                    ];
                                ?>
                                <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($statusClasses[$pemesanan->status] ?? 'bg-gray-50 text-gray-700'); ?>">
                                    <?php echo e($statusText[$pemesanan->status] ?? $pemesanan->status); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($pemesanan->bukti_pembayaran): ?>
                                    <a href="<?php echo e(asset('storage/' . $pemesanan->bukti_pembayaran)); ?>" target="_blank" 
                                       class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat
                                    </a>
                                <?php else: ?>
                                    <span class="text-sm text-gray-500">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end space-x-3">
                                    <a href="<?php echo e(route('admin.pemesanan.show', $pemesanan->pemesanan_id)); ?>" 
                                       class="text-blue-600 hover:text-blue-800 transition-colors duration-200"
                                       title="Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>
                                    <form action="<?php echo e(route('admin.pemesanan.updateStatus', $pemesanan->pemesanan_id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <input type="hidden" name="status" value="<?php echo e($pemesanan->status == 'berhasil' ? 'gagal' : 'berhasil'); ?>">
                                        <button type="submit" 
                                                class="text-green-600 hover:text-green-800 transition-colors duration-200"
                                                title="<?php echo e($pemesanan->status == 'berhasil' ? 'Tolak' : 'Terima'); ?>">
                                            <?php if($pemesanan->status == 'berhasil'): ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                            <?php else: ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            <?php endif; ?>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <p class="text-lg">Tidak ada data pemesanan</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        
        
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\homestay-bumdes\resources\views/admin/pemesanan/index.blade.php ENDPATH**/ ?>