

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold">Pemesanan #<?php echo e($pemesanan->pemesanan_id); ?></h2>
                    <p class="text-green-100"><?php echo e(date('d M Y, H:i', strtotime($pemesanan->created_at))); ?></p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                    <?php if($pemesanan->status === 'berhasil'): ?> bg-green-100 text-green-800 
                    <?php elseif($pemesanan->status === 'menunggu_konfirmasi'): ?> bg-yellow-100 text-yellow-800 
                    <?php elseif($pemesanan->status === 'gagal'): ?> bg-red-100 text-red-800 
                    <?php elseif($pemesanan->status === 'selesai'): ?> bg-blue-100 text-blue-800 
                    <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                    <?php echo e(ucfirst(str_replace('_', ' ', $pemesanan->status))); ?>

                </span>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="p-6 space-y-8">
            <!-- Customer Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-5 rounded-lg border border-green-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        Data Pelanggan
                    </h3>
                    <div class="space-y-2">
                        <p class="flex items-start">
                            <span class="text-gray-600 w-24 flex-shrink-0">Nama</span>
                            <span class="text-gray-800 font-medium"><?php echo e($pemesanan->pelanggan->name ?? '-'); ?></span>
                        </p>
                        <p class="flex items-start">
                            <span class="text-gray-600 w-24 flex-shrink-0">Email</span>
                            <span class="text-gray-800 font-medium"><?php echo e($pemesanan->pelanggan->email ?? '-'); ?></span>
                        </p>
                    </div>
                </div>

                <!-- Booking Information -->
                <div class="bg-gray-50 p-5 rounded-lg border border-green-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        Data Homestay
                    </h3>
                    <div class="space-y-2">
                        <p class="flex items-start">
                            <span class="text-gray-600 w-24 flex-shrink-0">Homestay</span>
                            <span class="text-gray-800 font-medium"><?php echo e($pemesanan->kamar->homestay->nama_homestay ?? '-'); ?></span>
                        </p>
                        <p class="flex items-start">
                            <span class="text-gray-600 w-24 flex-shrink-0">Kamar</span>
                            <span class="text-gray-800 font-medium"><?php echo e($pemesanan->kamar->nama_kamar ?? '-'); ?></span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Date Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-5 rounded-lg border border-green-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        Tanggal Check-in
                    </h3>
                    <p class="text-xl font-medium text-gray-800">
                        <?php echo e(date('d M Y, H:i', strtotime($pemesanan->tgl_check_in))); ?>

                    </p>
                </div>

                <div class="bg-gray-50 p-5 rounded-lg border border-green-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        Tanggal Check-out
                    </h3>
                    <p class="text-xl font-medium text-gray-800">
                        <?php echo e(date('d M Y, H:i', strtotime($pemesanan->tgl_check_out))); ?>

                    </p>
                </div>
            </div>

            <!-- Payment Proof -->
            <div class="bg-gray-50 p-5 rounded-lg border border-green-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                    </svg>
                    Bukti Pembayaran
                </h3>
                <?php if($pemesanan->bukti_transfer): ?>
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                        <div class="w-full md:w-auto">
                            <img src="<?php echo e(asset('storage/' . $pemesanan->bukti_transfer)); ?>" alt="Bukti Transfer"
                                class="w-full md:w-64 rounded-lg shadow-md border border-green-200 hover:shadow-lg transition-shadow">
                        </div>
                        <div>
                            <a href="<?php echo e(asset('storage/' . $pemesanan->bukti_transfer)); ?>" target="_blank"
                               class="inline-flex items-center text-green-600 hover:text-green-800 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Download Bukti Pembayaran
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Belum ada bukti pembayaran diunggah.
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/pemilik/pemesanan/show.blade.php ENDPATH**/ ?>