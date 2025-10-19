<?php if($pemesanans->count() > 0): ?>
    <?php $__currentLoopData = $pemesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pemesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <div class="text-sm text-gray-800">
                    Rp<?php echo e(number_format($pemesanan->total_harga, 0, ',', '.')); ?>

                </div>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <tr>
        <td colspan="9" class="px-6 py-8 text-center">
            <div class="flex flex-col items-center justify-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p class="text-lg">Tidak ada data pemesanan</p>
                <p class="text-sm mt-1">Coba ubah filter untuk melihat lebih banyak data</p>
            </div>
        </td>
    </tr>
<?php endif; ?><?php /**PATH E:\tamansari tourism\resources\views/admin/pemesanan/partials/table_rows.blade.php ENDPATH**/ ?>