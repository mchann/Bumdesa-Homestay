

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Manajemen Pemesanan</h1>
        
        
        <div class="mt-4 md:mt-0">
            <input type="text" placeholder="Cari pemesanan..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
    </div>

    <!-- Export PDF atauuu Excel -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Total Pemesanan -->
        <div class="bg-white p-5 rounded-xl shadow-md">
            <div class="text-gray-600 text-sm mb-1">Total Pemesanan</div>
            <div class="text-2xl font-bold text-green-600">
                <?php echo e($totalPemesanan); ?>

            </div>
        </div>

        <!-- Total Pemesanan Berhasil -->
        <div class="bg-white p-5 rounded-xl shadow-md">
            <div class="text-gray-600 text-sm mb-1">Pemesanan Berhasil</div>
            <div class="text-2xl font-bold text-green-600">
                <?php echo e($totalPemesananBerhasil); ?>

            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-white p-5 rounded-xl shadow-md">
            <div class="text-gray-600 text-sm mb-1">Total Pendapatan</div>
            <div class="text-2xl font-bold text-green-600">
                Rp<?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?>

            </div>
        </div>
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

    <div class="flex flex-wrap gap-6">
        
        <form action="<?php echo e(route('admin.export.excel')); ?>" method="GET" class="flex items-end gap-2 bg-green-50 p-4 rounded-md border border-green-200">
            <div>
                <label for="excel_tanggal_awal" class="block text-sm text-gray-600 mb-1">Tanggal Awal</label>
                <input type="date" id="excel_tanggal_awal" name="tanggal_awal" required class="border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>
            <div>
                <label for="excel_tanggal_akhir" class="block text-sm text-gray-600 mb-1">Tanggal Akhir</label>
                <input type="date" id="excel_tanggal_akhir" name="tanggal_akhir" required class="border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm transition duration-200">
                Export Excel
            </button>
        </form>

        Form Export PDF
        <form action="<?php echo e(route('admin.export.pdf')); ?>" method="GET" class="flex items-end gap-2 bg-red-50 p-4 rounded-md border border-red-200">
            <div>
                <label for="pdf_tanggal_awal" class="block text-sm text-gray-600 mb-1">Tanggal Awal</label>
                <input type="date" id="pdf_tanggal_awal" name="tanggal_awal" required class="border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
            <div>
                <label for="pdf_tanggal_akhir" class="block text-sm text-gray-600 mb-1">Tanggal Akhir</label>
                <input type="date" id="pdf_tanggal_akhir" name="tanggal_akhir" required class="border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm transition duration-200">
                Export PDF
            </button>
        </form>
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
                        <th class="px-6 py-4">Total Harga</th>
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
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/admin/pemesanan/index.blade.php ENDPATH**/ ?>