

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Header -->
            <div class="text-center mb-5">
                <h2 class="fw-bold text-success">💳 Konfirmasi Pembayaran</h2>
                <p class="text-muted">Lengkapi pembayaran Anda sebelum batas waktu yang ditentukan</p>
            </div>

            <!-- Success Alert -->
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Detail Pemesanan -->
            <div class="card shadow-sm mb-4 border-0 rounded-4">
                <div class="card-header bg-success text-white rounded-top-4">
                    <h5 class="mb-0"><i class="bi bi-house-door me-2"></i>Detail Pemesanan</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <!-- Left -->
                        <div class="col-md-6">
                            <h5 class="text-success"><?php echo e($pemesanan->kamar->homestay->nama_homestay); ?></h5>
                            <p class="text-muted mb-3">
                                <i class="bi bi-geo-alt-fill text-success me-2"></i>
                                <?php echo e($pemesanan->kamar->homestay->alamat_homestay); ?>

                            </p>

                            <div class="mb-3">
                                <h6 class="fw-bold"><i class="bi bi-door-open me-2 text-success"></i>Kamar</h6>
                                <p class="ms-4 mb-0"><?php echo e($pemesanan->kamar->nama_kamar); ?></p>
                            </div>

                            <div>
                                <h6 class="fw-bold"><i class="bi bi-people-fill me-2 text-success"></i>Detail Tamu</h6>
                                <ul class="list-unstyled ms-4 text-muted mb-0">
                                    <li>Jumlah Tamu: <?php echo e($pemesanan->jumlah_tamu); ?></li>
                                    <li>Jumlah Kamar: <?php echo e($pemesanan->jumlah_kamar); ?></li>
                                    <li>Catatan: <?php echo e($pemesanan->catatan ?? '-'); ?></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Right -->
                        <div class="col-md-6">
                            <h6 class="fw-bold"><i class="bi bi-calendar-event me-2 text-success"></i>Tanggal Menginap</h6>
                            <ul class="list-unstyled ms-4 text-muted mb-4">
                                <li>Check-in: <?php echo e($pemesanan->tgl_check_in); ?></li>
                                <li>Check-out: <?php echo e($pemesanan->tgl_check_out); ?></li>
                            </ul>

                            <div class="bg-light p-3 rounded-3">
                                <h6 class="text-end text-success">Total Pembayaran</h6>
                                <h3 class="text-end fw-bold text-dark">
                                    Rp <?php echo e(number_format($pemesanan->total_harga, 0, ',', '.')); ?>

                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instruksi Pembayaran -->
            <div class="card shadow-sm mb-4 border-0 rounded-4">
                <div class="card-header bg-success text-white rounded-top-4">
                    <h5 class="mb-0"><i class="bi bi-credit-card me-2"></i>Instruksi Pembayaran</h5>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-light border rounded-3 shadow-sm">
                        <i class="bi bi-info-circle-fill me-2 text-success"></i>
                        Harap selesaikan pembayaran sebelum:
                        <strong><?php echo e(\Carbon\Carbon::parse($pemesanan->batas_pembayaran)->format('d M Y H:i')); ?></strong>
                        <div id="countdown" class="fw-bold mt-2 text-success"></div>
                    </div>
                </div>
            </div>

            <!-- Aksi Pembayaran -->
            <?php if(now()->lessThan($pemesanan->batas_pembayaran)): ?>
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body text-center py-4">
                        <a href="<?php echo e(route('simulasi.pembayaran', ['id' => $pemesanan->pemesanan_id])); ?>" 
                           class="btn btn-success btn-lg px-5 rounded-pill shadow-sm">
                            <i class="bi bi-wallet2 me-2"></i>Bayar Sekarang
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger shadow-sm rounded-3">
                    <i class="bi bi-exclamation-octagon-fill me-2"></i>
                    <strong>Waktu pembayaran telah habis!</strong> Silakan lakukan pemesanan ulang jika masih berminat.
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script>
    const deadline = new Date("<?php echo e($pemesanan->batas_pembayaran); ?>").getTime();
    const x = setInterval(function() {
        const now = new Date().getTime();
        const distance = deadline - now;

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "<span class='text-danger'>Waktu pembayaran telah habis!</span>";
            return;
        }

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML = `⏳ Sisa waktu: <strong>${hours} jam ${minutes} menit ${seconds} detik</strong>`;
    }, 1000);
</script>

<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-3px);
    }
    .btn-success {
        background-color: #25D366;
        border: none;
    }
    .btn-success:hover {
        background-color: #1ebe5d;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\File Tugas Dinaaaaaa\Tugas Smt 5\PAL\tamansari tourism\resources\views/pelanggan/pemesanan/pembayaran.blade.php ENDPATH**/ ?>