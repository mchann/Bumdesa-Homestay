

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center rounded-top-4">
                    <h4 class="mb-0"><i class="fas fa-file-alt me-2"></i>Detail Pemesanan</h4>
                    <div>
                        <!-- Tombol Download Invoice -->
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-light btn-sm rounded-pill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-download me-1"></i>Download Invoice
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('pelanggan.invoice.download', ['id' => $pemesanan->pemesanan_id, 'type' => 'pdf'])); ?>">
                                        <i class="fas fa-file-pdf text-danger me-2"></i>Download PDF
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="printInvoice()">
                                        <i class="fas fa-print text-primary me-2"></i>Print Invoice
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="<?php echo e(route('pelanggan.cek-status')); ?>" class="btn btn-light btn-sm rounded-pill me-2">
                            <i class="fas fa-search me-1"></i>Cek Status
                        </a>
                        <a href="<?php echo e(route('pelanggan.history')); ?>" class="btn btn-outline-light btn-sm rounded-pill">
                            <i class="fas fa-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <?php if($pemesanan): ?>
                        <!-- Header Info -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light">
                                    <h6 class="text-muted mb-2">Nomor Invoice</h6>
                                    <p class="h4 text-success fw-bold"><?php echo e($pemesanan->invoice_number); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 bg-light">
                                    <h6 class="text-muted mb-2">Tanggal Pemesanan</h6>
                                    <p class="h5 text-dark"><?php echo e($pemesanan->created_at->format('d M Y, H:i')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
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

                        <!-- Detail Homestay -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="border rounded-3 p-4 bg-light">
                                    <h6 class="text-muted mb-3">Detail Homestay</h6>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="text-success mb-3"><?php echo e($pemesanan->kamar->nama_kamar ?? 'N/A'); ?></h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-2">
                                                        <i class="fas fa-home me-2 text-success"></i>
                                                        <strong>Homestay:</strong> <?php echo e($pemesanan->kamar->homestay->nama_homestay ?? 'N/A'); ?>

                                                    </p>
                                                    <p class="mb-2">
                                                        <i class="fas fa-map-marker-alt me-2 text-success"></i>
                                                        <strong>Alamat:</strong> <?php echo e($pemesanan->kamar->homestay->alamat ?? 'N/A'); ?>

                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-2">
                                                        <i class="fas fa-phone me-2 text-success"></i>
                                                        <strong>Telepon:</strong> <?php echo e($pemesanan->kamar->homestay->telepon ?? 'N/A'); ?>

                                                    </p>
                                                    <p class="mb-0">
                                                        <i class="fas fa-door-closed me-2 text-success"></i>
                                                        <strong>Tipe Kamar:</strong> <?php echo e($pemesanan->kamar->jenisKamar->nama_jenis ?? 'Standard'); ?>

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <?php if($pemesanan->kamar->foto_kamar): ?>
                                                <img src="<?php echo e(asset('storage/'.$pemesanan->kamar->foto_kamar)); ?>" 
                                                     class="img-fluid rounded-3 shadow-sm" 
                                                     style="max-height: 120px; object-fit: cover;"
                                                     alt="<?php echo e($pemesanan->kamar->nama_kamar); ?>">
                                            <?php else: ?>
                                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" 
                                                     style="height: 120px;">
                                                    <i class="fas fa-image text-muted fa-2x"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Menginap -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="border rounded-3 p-4 bg-light h-100">
                                    <h6 class="text-muted mb-3">Detail Menginap</h6>
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-calendar-check fa-2x text-success mb-2"></i>
                                            <h5 class="text-success">Check-in</h5>
                                            <p class="h6 mb-1"><?php echo e(\Carbon\Carbon::parse($pemesanan->tgl_check_in)->format('d M Y')); ?></p>
                                            <small class="text-muted">Setelah 13:00</small>
                                        </div>
                                        <div class="mb-3">
                                            <i class="fas fa-calendar-times fa-2x text-success mb-2"></i>
                                            <h5 class="text-success">Check-out</h5>
                                            <p class="h6 mb-1"><?php echo e(\Carbon\Carbon::parse($pemesanan->tgl_check_out)->format('d M Y')); ?></p>
                                            <small class="text-muted">Sebelum 12:00</small>
                                        </div>
                                        <div>
                                            <i class="fas fa-moon fa-2x text-success mb-2"></i>
                                            <h5 class="text-success">Durasi</h5>
                                            <p class="h6 mb-1"><?php echo e($pemesanan->lama_menginap); ?> Malam</p>
                                            <small class="text-muted">Lama menginap</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded-3 p-4 bg-light h-100">
                                    <h6 class="text-muted mb-3">Detail Tamu</h6>
                                    <div class="text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-users fa-2x text-success mb-2"></i>
                                            <h5 class="text-success">Jumlah Tamu</h5>
                                            <p class="h6 mb-1"><?php echo e($pemesanan->jumlah_tamu); ?> Orang</p>
                                            <small class="text-muted">Total tamu</small>
                                        </div>
                                        <div class="mb-3">
                                            <i class="fas fa-door-closed fa-2x text-success mb-2"></i>
                                            <h5 class="text-success">Jumlah Kamar</h5>
                                            <p class="h6 mb-1"><?php echo e($pemesanan->jumlah_kamar); ?> Kamar</p>
                                            <small class="text-muted">Unit kamar</small>
                                        </div>
                                        <div>
                                            <i class="fas fa-bed fa-2x text-success mb-2"></i>
                                            <h5 class="text-success">Kapasitas</h5>
                                            <p class="h6 mb-1"><?php echo e($pemesanan->kamar->kapasitas ?? '-'); ?> Orang</p>
                                            <small class="text-muted">Per kamar</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan Khusus -->
                        <?php if($pemesanan->catatan): ?>
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="border rounded-3 p-4 bg-light">
                                    <h6 class="text-muted mb-3">
                                        <i class="fas fa-sticky-note me-2 text-success"></i>Catatan Khusus
                                    </h6>
                                    <div class="bg-white rounded-3 p-3 border">
                                        <p class="mb-0 text-dark"><?php echo e($pemesanan->catatan); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Rincian Biaya -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="border rounded-3 p-4 bg-light">
                                    <h6 class="text-muted mb-3">Rincian Biaya</h6>
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="bg-white rounded-3 p-4 border">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="fw-medium">Subtotal Kamar</span>
                                                    <span class="fw-medium">Rp <?php echo e($pemesanan->total_harga_formatted); ?></span>
                                                </div>
                                                
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <span class="fw-medium">Biaya Layanan Sistem</span>
                                                        <br>
                                                        <small class="text-muted">Pemeliharaan platform</small>
                                                    </div>
                                                    <span class="fw-medium">Rp <?php echo e($pemesanan->biaya_tambahan_formatted); ?></span>
                                                </div>
                                                
                                                <hr class="my-3">
                                                
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h5 class="text-success mb-0">Total Pembayaran</h5>
                                                    <h4 class="text-success mb-0">Rp <?php echo e($pemesanan->total_akhir_formatted); ?></h4>
                                                </div>
                                                
                                                <div class="mt-3 p-3 bg-light rounded-3 border">
                                                    <small class="text-muted">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Total pembayaran sudah termasuk biaya layanan sistem sebesar Rp 4.500
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-center gap-3 flex-wrap">
                                    <?php if($pemesanan->status == 'pending' && !$pemesanan->sudah_kadaluarsa): ?>
                                        <a href="<?php echo e(route('pelanggan.pemesanan.bayar', $pemesanan->pemesanan_id)); ?>" 
                                           class="btn btn-success btn-lg rounded-pill px-4">
                                            <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('pelanggan.history')); ?>" class="btn btn-outline-secondary rounded-pill px-4">
                                        <i class="fas fa-history me-2"></i>Kembali ke History
                                    </a>
                                    <a href="<?php echo e(route('pelanggan.cek-status')); ?>" class="btn btn-outline-primary rounded-pill px-4">
                                        <i class="fas fa-search me-2"></i>Cek Status Terbaru
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-exclamation-circle fa-4x text-muted mb-3"></i>
                            </div>
                            <h5 class="text-muted">Data Pemesanan Tidak Ditemukan</h5>
                            <p class="text-muted mb-4">Pemesanan yang Anda cari tidak ditemukan atau tidak dapat diakses.</p>
                            <div class="d-flex justify-content-center gap-3">
                                <a href="<?php echo e(route('pelanggan.history')); ?>" class="btn btn-success rounded-pill px-4">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke History
                                </a>
                                <a href="<?php echo e(route('pelanggan.cek-status')); ?>" class="btn btn-outline-primary rounded-pill px-4">
                                    <i class="fas fa-search me-2"></i>Cek Status Terbaru
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Loading -->
<div class="modal fade" id="loadingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body text-center py-5">
                <div class="spinner-border text-success mb-3" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h5 class="text-success">Mempersiapkan Invoice...</h5>
                <p class="text-muted">Sedang membuat file invoice, harap tunggu sebentar.</p>
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
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    /* Print Styles */
    @media print {
        body * {
            visibility: hidden;
        }
        #invoice-print, #invoice-print * {
            visibility: visible;
        }
        #invoice-print {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none !important;
        }
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

        // Show loading modal when downloading PDF
        const downloadLinks = document.querySelectorAll('a[href*="invoice.download"]');
        downloadLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
                loadingModal.show();
                
                // Hide modal after download starts
                setTimeout(() => {
                    loadingModal.hide();
                }, 2000);
            });
        });
    });

    function printInvoice() {
        // Create print-friendly version
        const printContent = `
            <div id="invoice-print" class="p-4" style="font-family: Arial, sans-serif;">
                <div class="text-center mb-4 border-bottom pb-3">
                    <h2 class="text-success mb-1">INVOICE PEMESANAN</h2>
                    <h4 class="text-muted mb-0">${document.querySelector('.h4.text-success').textContent}</h4>
                    <p class="text-muted mt-2">Tanggal: ${document.querySelector('.col-md-6 .h5').textContent}</p>
                </div>
                
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="border p-3 mb-3">
                            <h6 class="text-muted mb-2">Status Pemesanan</h6>
                            <p class="h5 mb-0">${document.querySelector('.badge').textContent.trim()}</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border p-3 mb-3">
                            <h6 class="text-muted mb-2">Homestay</h6>
                            <p class="mb-0">${document.querySelector('.text-success.mb-3').textContent}</p>
                        </div>
                    </div>
                </div>
                
                <div class="border p-4 mb-4">
                    <h5 class="text-success mb-3">Detail Menginap</h5>
                    <div class="row text-center">
                        <div class="col-4">
                            <p class="mb-1"><strong>Check-in</strong></p>
                            <p class="mb-0">${document.querySelectorAll('.text-center .h6')[0].textContent}</p>
                            <small class="text-muted">Setelah 13:00</small>
                        </div>
                        <div class="col-4">
                            <p class="mb-1"><strong>Check-out</strong></p>
                            <p class="mb-0">${document.querySelectorAll('.text-center .h6')[1].textContent}</p>
                            <small class="text-muted">Sebelum 12:00</small>
                        </div>
                        <div class="col-4">
                            <p class="mb-1"><strong>Durasi</strong></p>
                            <p class="mb-0">${document.querySelectorAll('.text-center .h6')[2].textContent}</p>
                            <small class="text-muted">Lama menginap</small>
                        </div>
                    </div>
                </div>
                
                <div class="border p-4">
                    <h5 class="text-success mb-3">Rincian Biaya</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><strong>Subtotal Kamar</strong></td>
                                    <td class="text-end">${document.querySelectorAll('.fw-medium')[1].textContent}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Biaya Layanan Sistem</strong><br>
                                        <small class="text-muted">Pemeliharaan platform</small>
                                    </td>
                                    <td class="text-end">${document.querySelectorAll('.fw-medium')[3].textContent}</td>
                                </tr>
                                <tr class="table-success">
                                    <td><strong>TOTAL PEMBAYARAN</strong></td>
                                    <td class="text-end"><strong>${document.querySelector('.h4.text-success').textContent}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="text-center mt-4 text-muted border-top pt-3">
                    <p>Invoice ini dicetak pada ${new Date().toLocaleString('id-ID')}</p>
                    <p>Terima kasih telah memesan melalui layanan kami.</p>
                </div>
            </div>
        `;
        
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>Invoice ${document.querySelector('.h4.text-success').textContent}</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body { 
                        font-family: Arial, sans-serif; 
                        margin: 20px;
                    }
                    @media print { 
                        body { margin: 0; }
                        .no-print { display: none !important; }
                    }
                    .table-success {
                        background-color: #d1e7dd !important;
                    }
                </style>
            </head>
            <body>
                ${printContent}
                <div class="text-center mt-3 no-print">
                    <button class="btn btn-success me-2" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Print Invoice
                    </button>
                    <button class="btn btn-secondary" onclick="window.close()">
                        <i class="fas fa-times me-1"></i>Tutup
                    </button>
                </div>
                <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"><\/script>
            </body>
            </html>
        `);
        printWindow.document.close();
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\tamansari tourism\resources\views/pelanggan/pemesanan/detail.blade.php ENDPATH**/ ?>