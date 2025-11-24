

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-success text-white rounded-top-4">
                    <h4 class="mb-0"><i class="fas fa-search me-2"></i>Status Pemesanan Terbaru</h4>
                </div>
                <div class="card-body p-4">
                    <?php if($pemesanan): ?>
                        <!-- Info Pemesanan -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light">
                                    <h6 class="text-muted mb-2">Nomor Pemesanan</h6>
                                    <p class="h5 text-success fw-bold"><?php echo e($pemesanan->invoice_number); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light">
                                    <h6 class="text-muted mb-2">Tanggal Pemesanan</h6>
                                    <p class="h5 text-dark"><?php echo e($pemesanan->created_at->format('d M Y, H:i')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Status Pemesanan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="border rounded-3 p-4 bg-light">
                                    <h6 class="text-muted mb-3">Status Pemesanan</h6>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-<?php echo e($pemesanan->status_badge_class); ?> fs-6 px-4 py-2 me-3 rounded-pill">
                                            <i class="fas fa-<?php echo e($pemesanan->status == 'selesai' ? 'check' : ($pemesanan->status == 'dibatalkan' ? 'times' : 'clock')); ?> me-2"></i>
                                            <?php echo e($pemesanan->status_label); ?>

                                        </span>
                                        <?php if($pemesanan->status == 'pending' && $pemesanan->batas_pembayaran): ?>
                                            <div class="flex-grow-1">
                                                <small class="text-muted d-block">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Batas pembayaran: <?php echo e(\Carbon\Carbon::parse($pemesanan->batas_pembayaran)->format('d M Y, H:i')); ?>

                                                </small>
                                                <?php if($pemesanan->sudah_kadaluarsa): ?>
                                                    <small class="text-danger d-block mt-1">
                                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                                        Waktu pembayaran telah habis
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Kamar -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="border rounded-3 p-4 bg-light">
                                    <h6 class="text-muted mb-3">Detail Pemesanan</h6>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="text-dark mb-3"><?php echo e($pemesanan->kamar->nama_kamar ?? 'N/A'); ?></h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-2">
                                                        <i class="fas fa-home me-2 text-success"></i>
                                                        <strong>Homestay:</strong> <?php echo e($pemesanan->kamar->homestay->nama_homestay ?? 'N/A'); ?>

                                                    </p>
                                                    <p class="mb-2">
                                                        <i class="fas fa-calendar-check me-2 text-success"></i>
                                                        <strong>Check-in:</strong> <?php echo e(\Carbon\Carbon::parse($pemesanan->tgl_check_in)->format('d M Y')); ?>

                                                    </p>
                                                    <p class="mb-0">
                                                        <i class="fas fa-users me-2 text-success"></i>
                                                        <strong>Tamu:</strong> <?php echo e($pemesanan->jumlah_tamu); ?> orang
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-2">
                                                        <i class="fas fa-door-closed me-2 text-success"></i>
                                                        <strong>Kamar:</strong> <?php echo e($pemesanan->jumlah_kamar); ?> unit
                                                    </p>
                                                    <p class="mb-2">
                                                        <i class="fas fa-calendar-times me-2 text-success"></i>
                                                        <strong>Check-out:</strong> <?php echo e(\Carbon\Carbon::parse($pemesanan->tgl_check_out)->format('d M Y')); ?>

                                                    </p>
                                                    <p class="mb-0">
                                                        <i class="fas fa-moon me-2 text-success"></i>
                                                        <strong>Durasi:</strong> <?php echo e($pemesanan->lama_menginap); ?> malam
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-md-end">
                                            <!-- Rincian Biaya -->
                                            <div class="bg-white border rounded-3 p-3">
                                                <h6 class="text-success mb-3 text-center">Rincian Biaya</h6>
                                                
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="small">Subtotal Kamar</span>
                                                    <span class="small">Rp <?php echo e($pemesanan->total_harga_formatted); ?></span>
                                                </div>
                                                
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="small">
                                                        Biaya Sistem
                                                        <br>
                                                        <small class="text-muted">Layanan platform</small>
                                                    </span>
                                                    <span class="small">Rp <?php echo e($pemesanan->biaya_tambahan_formatted); ?></span>
                                                </div>
                                                
                                                <hr class="my-2">
                                                <div class="d-flex justify-content-between fw-bold">
                                                    <span class="text-success">Total</span>
                                                    <span class="text-success">Rp <?php echo e($pemesanan->total_akhir_formatted); ?></span>
                                                </div>
                                                
                                                <div class="mt-2 p-2 bg-light rounded-2">
                                                    <small class="text-muted">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Termasuk biaya sistem
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Proses -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="border rounded-3 p-4 bg-light">
                                    <h6 class="text-muted mb-3">Proses Pemesanan</h6>
                                    <div class="timeline">
                                        <?php
                                            $steps = [
                                                'pending' => [
                                                    'icon' => 'clock',
                                                    'title' => 'Menunggu Pembayaran',
                                                    'desc' => 'Silakan lakukan pembayaran sebelum batas waktu'
                                                ],
                                                'menunggu_konfirmasi' => [
                                                    'icon' => 'hourglass-half',
                                                    'title' => 'Menunggu Konfirmasi',
                                                    'desc' => 'Pembayaran sedang diverifikasi admin'
                                                ],
                                                'dikonfirmasi' => [
                                                    'icon' => 'check-circle',
                                                    'title' => 'Terkonfirmasi',
                                                    'desc' => 'Pemesanan telah dikonfirmasi'
                                                ],
                                                'selesai' => [
                                                    'icon' => 'star',
                                                    'title' => 'Selesai',
                                                    'desc' => 'Pemesanan telah selesai'
                                                ]
                                            ];
                                            
                                            $currentStatus = $pemesanan->status;
                                            $stepKeys = array_keys($steps);
                                            $currentIndex = array_search($currentStatus, $stepKeys);
                                        ?>

                                        <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statusKey => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $isActive = $currentIndex >= array_search($statusKey, $stepKeys);
                                                $isCurrent = $statusKey === $currentStatus;
                                            ?>
                                            <div class="timeline-item <?php echo e($isActive ? 'active' : ''); ?> <?php echo e($isCurrent ? 'current' : ''); ?>">
                                                <div class="timeline-marker">
                                                    <i class="fas fa-<?php echo e($step['icon']); ?>"></i>
                                                </div>
                                                <div class="timeline-content">
                                                    <h6 class="<?php echo e($isActive ? 'text-success' : 'text-muted'); ?>">
                                                        <?php echo e($step['title']); ?>

                                                        <?php if($isCurrent): ?>
                                                            <span class="badge bg-success ms-2">Saat Ini</span>
                                                        <?php endif; ?>
                                                    </h6>
                                                    <p class="mb-0 small text-muted"><?php echo e($step['desc']); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?php echo e(route('pelanggan.history')); ?>" class="btn btn-outline-success rounded-pill px-4">
                                        <i class="fas fa-history me-2"></i>Lihat Semua History
                                    </a>
                                    <div>
                                        <?php if($pemesanan->status == 'pending' && !$pemesanan->sudah_kadaluarsa): ?>
                                            <a href="<?php echo e(route('pelanggan.pemesanan.bayar', $pemesanan->pemesanan_id)); ?>" 
                                               class="btn btn-success rounded-pill px-4 me-2">
                                                <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('pelanggan.pemesanan.detail', $pemesanan->pemesanan_id)); ?>" 
                                           class="btn btn-outline-primary rounded-pill px-4">
                                            <i class="fas fa-eye me-2"></i>Detail Lengkap
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Tidak ada pemesanan -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-search fa-4x text-muted mb-3"></i>
                            </div>
                            <h5 class="text-muted">Belum Ada Pemesanan</h5>
                            <p class="text-muted mb-4">Anda belum melakukan pemesanan apapun.</p>
                            <a href="<?php echo e(url('/')); ?>" class="btn btn-success rounded-pill px-4">
                                <i class="fas fa-plus me-2"></i>Pesan Sekarang
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 1rem;
    }
    .rounded-4 {
        border-radius: 1rem !important;
    }
    .rounded-top-4 {
        border-top-left-radius: 1rem !important;
        border-top-right-radius: 1rem !important;
    }
    .rounded-pill {
        border-radius: 50rem !important;
    }
    .btn-success {
        background-color: #25D366;
        border: none;
    }
    .btn-success:hover {
        background-color: #1ebe5d;
        transform: translateY(-1px);
    }
    
    /* Timeline Styles */
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 25px;
    }
    .timeline-item:last-child {
        margin-bottom: 0;
    }
    .timeline-marker {
        position: absolute;
        left: -45px;
        top: 0;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid white;
        z-index: 2;
    }
    .timeline-item.active .timeline-marker {
        background-color: #25D366;
        color: white;
    }
    .timeline-item.current .timeline-marker {
        background-color: #25D366;
        color: white;
        box-shadow: 0 0 0 5px rgba(37, 211, 102, 0.2);
    }
    .timeline-content {
        padding: 15px;
        border-radius: 8px;
        background-color: #f8f9fa;
    }
    .timeline-item.active .timeline-content {
        background-color: #e7f7ed;
        border-left: 4px solid #25D366;
    }
    .timeline::before {
        content: '';
        position: absolute;
        left: -27px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #e9ecef;
    }
    .timeline-item.active::before {
        background-color: #25D366;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects to buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
            });
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\PEBEL\tamansari tourism\resources\views/pelanggan/pemesanan/cek-status.blade.php ENDPATH**/ ?>