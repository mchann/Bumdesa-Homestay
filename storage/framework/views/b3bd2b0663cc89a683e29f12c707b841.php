

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Detail Pemesanan</h1>

    <div class="bg-white rounded-lg shadow p-6 space-y-6">
        <div>
            <h2 class="text-xl font-semibold mb-2">Informasi Pemesanan</h2>
            <p><strong>ID Pemesanan:</strong> <?php echo e($pemesanan->pemesanan_id); ?></p>
            <p><strong>Tanggal Pesan:</strong> <?php echo e(date('d M Y, H:i', strtotime($pemesanan->created_at))); ?></p>
            <p><strong>Status:</strong>
                <span class="inline-block px-2 py-1 rounded 
                    <?php if($pemesanan->status === 'berhasil'): ?> bg-green-100 text-green-800 
                    <?php elseif($pemesanan->status === 'menunggu_konfirmasi'): ?> bg-yellow-100 text-yellow-800 
                    <?php elseif($pemesanan->status === 'gagal'): ?> bg-red-100 text-red-800 
                    <?php elseif($pemesanan->status === 'selesai'): ?> bg-blue-100 text-blue-800 
                    <?php else: ?> bg-gray-100 text-gray-800 <?php endif; ?>">
                    <?php echo e(ucfirst($pemesanan->status)); ?>

                </span>
            </p>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-2">Data Pelanggan</h2>
            <p><strong>Nama:</strong> <?php echo e($pemesanan->pelanggan->name ?? '-'); ?></p>
            <p><strong>Email:</strong> <?php echo e($pemesanan->pelanggan->email ?? '-'); ?></p>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-2">Data Homestay & Kamar</h2>
            <p><strong>Homestay:</strong> <?php echo e($pemesanan->kamar->homestay->nama_homestay ?? '-'); ?></p>
            <p><strong>Kamar:</strong> <?php echo e($pemesanan->kamar->nama_kamar ?? '-'); ?></p>
            <p><strong>Check-in:</strong> <?php echo e(date('d M Y, H:i', strtotime($pemesanan->tgl_check_in))); ?></p>
            <p><strong>Check-out:</strong> <?php echo e(date('d M Y, H:i', strtotime($pemesanan->tgl_check_out))); ?></p>
        </div>

        <div>
    <h2 class="text-xl font-semibold mb-2">Bukti Pembayaran</h2>
    <?php if($pemesanan->bukti_transfer): ?>
        <a href="<?php echo e(asset('storage/' . $pemesanan->bukti_transfer)); ?>" target="_blank"
           class="text-blue-600 underline hover:text-blue-800">
            Lihat File Bukti Pembayaran
        </a>
        <div class="mt-2">
            <img src="<?php echo e(asset('storage/' . $pemesanan->bukti_transfer)); ?>" alt="Bukti Transfer"
                 class="w-64 rounded shadow border">
        </div>
    <?php else: ?>
        <p class="text-gray-500">Belum ada bukti pembayaran diunggah.</p>
    <?php endif; ?>
</div>


        <div>
            <a href="<?php echo e(route('admin.pemesanan.index')); ?>"
               class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/admin/pemesanan/show.blade.php ENDPATH**/ ?>