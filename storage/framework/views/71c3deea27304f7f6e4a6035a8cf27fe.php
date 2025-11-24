

<?php $__env->startSection('content'); ?>
<?php
    use Carbon\Carbon;

    try {
        $checkInDate = Carbon::parse($checkIn);
        $checkOutDate = Carbon::parse($checkOut);
        $jumlahMalam = max(1, $checkOutDate->diffInDays($checkInDate));
    } catch (Exception $e) {
        $jumlahMalam = 1;
    }

    $hargaPerMalam = $kamar->harga;
    $subtotal = $hargaPerMalam * $jumlahMalam;
    $jumlahKamar = old('jumlah_kamar', 1);
    $biayaSistem = 4500; // Biaya sistem yang ditambahkan
    $totalHarga = ($subtotal * $jumlahKamar) + $biayaSistem;
    $totalTamu = ($dewasa ?? 0) + ($anak ?? 0);
?>

<div class="container py-5">
    <div class="row g-4">
        <!-- Left Content -->
        <div class="col-lg-8">
            <div class="card border-0 shadow rounded-4 mb-4">
                <div class="card-header bg-white border-0 py-4">
                    <h3 class="fw-bold text-success mb-1">Data Pemesanan</h3>
                    <p class="text-muted mb-0">Isi data dengan benar agar pemesanan Anda dapat diproses.</p>
                </div>
                
                <div class="card-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger d-flex rounded-3 mb-4">
                            <i class="fas fa-exclamation-circle fa-lg me-3 mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Perhatian!</h6>
                                <ul class="mb-0 ps-3 small">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('pelanggan.pemesanan.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <!-- Nama -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-success">Identitas Pemesan</h5>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    
                                    <input type="text" class="form-control" 
                                           name="full_name" 
                                           value="<?php echo e(old('full_name', auth()->user()->pelangganProfile?->nama_lengkap ?? auth()->user()->name ?? '')); ?>" 
                                           required>
                                    
                                    <?php if(!auth()->user()->pelangganProfile): ?>
                                        <small class="text-muted">Lengkapi profil Anda di <a href="<?php echo e(route('pelanggan.profile.edit')); ?>">halaman profil</a> untuk auto-fill.</small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-success">Kontak</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="<?php echo e(old('email', auth()->user()->email ?? '')); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="phone" value="<?php echo e(old('phone', auth()->user()->pelangganProfile?->nomor_telepon ?? '')); ?>" required>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-success">Permintaan Khusus</h5>
                            <p class="text-muted small mb-2">Tidak dijamin, namun pihak homestay akan berusaha memenuhinya. Maksimal 1000 karakter.</p>
                            <textarea class="form-control" 
                                    name="special_requests" 
                                    rows="3" 
                                    placeholder="Contoh: Kamar bebas rokok, dekat kolam renang, atau permintaan sarapan khusus." 
                                    maxlength="1000"  
                                    ><?php echo e(old('special_requests')); ?></textarea>
                            <small class="text-muted">Opsional – Tulis permintaan Anda.</small>
                        </div>

                        <!-- Invoice -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-success">Rincian Pembayaran</h5>
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr><td>Harga Kamar / Malam</td><td class="text-end">Rp <?php echo e(number_format($hargaPerMalam, 0, ',', '.')); ?></td></tr>
                                    <tr><td>Durasi</td><td class="text-end"><?php echo e($jumlahMalam); ?> malam</td></tr>
                                    <tr><td>Subtotal</td><td class="text-end">Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></td></tr>
                                    <tr><td>Jumlah Kamar</td><td class="text-end"><?php echo e($jumlahKamar); ?></td></tr>
                                    <tr><td>Biaya Sistem</td><td class="text-end">Rp <?php echo e(number_format($biayaSistem, 0, ',', '.')); ?></td></tr>
                                    <tr class="border-top fw-bold">
                                        <td>Total</td>
                                        <td class="text-end text-success">Rp <?php echo e(number_format($totalHarga, 0, ',', '.')); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Checkin & Checkout -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3 text-success">Detail Menginap</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded-3">
                                        <h6 class="fw-bold mb-1">Check-in</h6>
                                        <p class="mb-0"><?php echo e($checkIn); ?></p>
                                        <small class="text-muted">Setelah 13:00</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded-3">
                                        <h6 class="fw-bold mb-1">Check-out</h6>
                                        <p class="mb-0"><?php echo e($checkOut); ?></p>
                                        <small class="text-muted">Sebelum 12:00</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden Inputs -->
                        <input type="hidden" name="kamar_id" value="<?php echo e($kamar->kamar_id ?? ''); ?>">
                        <input type="hidden" name="tgl_check_in" value="<?php echo e(old('tgl_check_in', $checkIn)); ?>">
                        <input type="hidden" name="tgl_check_out" value="<?php echo e(old('tgl_check_out', $checkOut)); ?>">
                        <input type="hidden" name="jumlah_kamar" value="<?php echo e($jumlahKamar); ?>">
                        <input type="hidden" name="jumlah_tamu" value="<?php echo e($totalTamu); ?>">
                        <input type="hidden" name="jumlah_dewasa" value="<?php echo e($dewasa ?? 0); ?>">
                        <input type="hidden" name="jumlah_anak" value="<?php echo e($anak ?? 0); ?>">

                        <button type="submit" class="btn btn-success btn-lg w-100 py-3 fw-bold">
                            <i class="fas fa-check-circle me-2"></i>LANJUTKAN PEMBAYARAN
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Content -->
        <div class="col-lg-4">
            <div class="card border-0 shadow rounded-4 sticky-top" style="top: 20px;">
                <div class="card-header bg-white border-0 py-4">
                    <h4 class="fw-bold mb-1 text-success"><i class="fas fa-home me-2"></i><?php echo e($homestay->nama_homestay ?? 'Homestay'); ?></h4>
                    <p class="text-muted mb-0"><i class="fas fa-map-marker-alt me-1"></i> <?php echo e($homestay->alamat_homestay ?? '-'); ?></p>
                </div>
                <?php if($kamar): ?>
                <div class="card-body">
                    <div class="d-flex mb-4">
                        <div class="flex-shrink-0 me-3">
                            <?php if($kamar->foto_kamar): ?>
                                <img src="<?php echo e(asset('storage/'.$kamar->foto_kamar)); ?>" class="rounded-3" style="width: 100px; height: 75px; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 100px; height: 75px;">
                                    <i class="fas fa-image text-muted fa-2x"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1"><?php echo e($kamar->nama_kamar ?? '-'); ?></h5>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                <?php echo e($kamar->jenisKamar->nama_jenis ?? 'Standard'); ?>

                            </span>
                        </div>
                    </div>
                    
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="fas fa-user-friends text-muted me-2"></i> Kapasitas: <?php echo e($kamar->kapasitas ?? '-'); ?> tamu</li>
                        <?php if($kamar->ukuran_kamar): ?>
                            <li class="mb-2"><i class="fas fa-arrows-alt text-muted me-2"></i> Ukuran: <?php echo e($kamar->ukuran_kamar); ?> m²</li>
                        <?php endif; ?>
                        <li class="mb-2"><i class="fas fa-calendar-day text-muted me-2"></i> Check-in: <?php echo e($checkIn); ?></li>
                        <li class="mb-2"><i class="fas fa-calendar-times text-muted me-2"></i> Check-out: <?php echo e($checkOut); ?></li>
                        <li class="mb-2"><i class="fas fa-door-closed text-muted me-2"></i> Kamar: <?php echo e($jumlahKamar); ?></li>
                        <li class="mb-2"><i class="fas fa-user text-muted me-2"></i> Dewasa: <?php echo e($dewasa ?? 0); ?></li>
                        <li class="mb-2"><i class="fas fa-child text-muted me-2"></i> Anak: <?php echo e($anak ?? 0); ?></li>
                    </ul>
                    
                    <div class="border-top pt-3 mt-3">
                        <h5 class="fw-bold mb-3">Ringkasan Pembayaran</h5>
                        <table class="table table-sm table-borderless">
                            <tr><td>Harga Kamar</td><td class="text-end">Rp <?php echo e(number_format($hargaPerMalam, 0, ',', '.')); ?></td></tr>
                            <tr><td>Malam</td><td class="text-end"><?php echo e($jumlahMalam); ?></td></tr>
                            <tr><td>Subtotal</td><td class="text-end">Rp <?php echo e(number_format($subtotal, 0, ',', '.')); ?></td></tr>
                            <tr><td>Kamar</td><td class="text-end"><?php echo e($jumlahKamar); ?></td></tr>
                            <tr><td>Biaya Sistem</td><td class="text-end">Rp <?php echo e(number_format($biayaSistem, 0, ',', '.')); ?></td></tr>
                            <tr class="border-top fw-bold">
                                <td>Total</td>
                                <td class="text-end text-success">Rp <?php echo e(number_format($totalHarga, 0, ',', '.')); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


<style>
    .card { border-radius: 1rem; }
    .form-control { border-radius: 0.6rem; padding: 12px 14px; }
    .btn-success { background-color: #25D366; border: none; border-radius: 0.6rem; }
    .btn-success:hover { background-color: #1DA955; }
    .badge { font-size: 0.75rem; padding: 6px 10px; }
    .alert { border-radius: 0.8rem; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\PEBEL\tamansari tourism\resources\views/pelanggan/pemesanan/create.blade.php ENDPATH**/ ?>