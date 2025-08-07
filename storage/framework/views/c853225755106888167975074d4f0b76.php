

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">Konfirmasi Pembayaran</h2>
                <p class="text-muted">Lengkapi pembayaran Anda sebelum batas waktu yang ditentukan</p>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Booking Info Card -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-house-door me-2"></i>Detail Pemesanan</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="text-primary"><?php echo e($pemesanan->kamar->homestay->nama_homestay); ?></h5>
                                <p class="text-muted mb-1">
                                    <i class="bi bi-geo-alt-fill text-secondary me-2"></i>
                                    <?php echo e($pemesanan->kamar->homestay->alamat_homestay); ?>

                                </p>
                            </div>
                            
                            <div class="mb-3">
                                <h6><i class="bi bi-door-open me-2 text-secondary"></i>Kamar</h6>
                                <p class="ms-4"><?php echo e($pemesanan->kamar->nama_kamar); ?></p>
                            </div>
                            
                            <div class="mb-3">
                                <h6><i class="bi bi-people-fill me-2 text-secondary"></i>Detail Tamu</h6>
                                <div class="ms-4">
                                    <p class="mb-1">Jumlah Tamu: <?php echo e($pemesanan->jumlah_tamu); ?></p>
                                    <p class="mb-1">Jumlah Kamar: <?php echo e($pemesanan->jumlah_kamar); ?></p>
                                    <p class="mb-0">Catatan: <?php echo e($pemesanan->catatan ?? '-'); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6><i class="bi bi-calendar-event me-2 text-secondary"></i>Tanggal Menginap</h6>
                                <div class="ms-4">
                                    <p class="mb-1">Check-in: <?php echo e($pemesanan->tgl_check_in); ?></p>
                                    <p class="mb-1">Check-out: <?php echo e($pemesanan->tgl_check_out); ?></p>
                                </div>
                            </div>
                            
                            <div class="bg-light p-3 rounded">
                                <h6 class="text-end text-primary">Total Pembayaran</h6>
                                <h3 class="text-end fw-bold">Rp <?php echo e(number_format($pemesanan->total_harga, 0, ',', '.')); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Instructions Card -->
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-credit-card me-2"></i>Instruksi Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Harap selesaikan pembayaran sebelum:
                        <strong><?php echo e(\Carbon\Carbon::parse($pemesanan->batas_pembayaran)->format('d M Y H:i')); ?></strong>
                        <div id="countdown" class="fw-bold mt-2"></div>
                    </div>
                    
                    
                    
                    
                </div>
            </div>

            <?php if(now()->lessThan($pemesanan->batas_pembayaran)): ?>
                <!-- Upload Form Card -->
                <div class="card shadow-sm border-0">
                    
                    <div class="card-body">
                        
                           
                            
                            <!-- Bayar Sekarang (Form VTWeb) -->
<div class="text-center mb-4">
    <form action="<?php echo e(route('pemesanan.bayar', ['id' => $pemesanan->pemesanan_id])); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="bi bi-wallet2 me-2"></i>Bayar Sekarang
        </button>
    </form>
</div>

                        
                    </div>
                </div>
            <?php else: ?>
                <!-- Expired Payment Alert -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex">
                        <div>
                            <i class="bi bi-exclamation-octagon-fill me-3"></i>
                        </div>
                        <div>
                            <h5 class="alert-heading">Waktu pembayaran telah habis!</h5>
                            <p class="mb-0">Silakan lakukan pemesanan ulang jika masih berminat.</p>
                        </div>
                    </div>
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

        document.getElementById("countdown").innerHTML = `⏳ Sisa waktu: <span class="text-primary">${hours} jam ${minutes} menit ${seconds} detik</span>`;
    }, 1000);
</script>






<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card-header {
        font-weight: 600;
    }
    .text-primary {
        color: #0d6efd !important;
    }
    .bg-primary {
        background-color: #0d6efd !important;
    }
    .border-primary {
        border-color: #0d6efd !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\homestay-bumdes\resources\views/pelanggan/pemesanan/pembayaran.blade.php ENDPATH**/ ?>