<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice <?php echo e($pemesanan->invoice_number); ?></title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #25D366;
            padding-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .text-success {
            color: #25D366;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .info-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1 style="color: #25D366; margin-bottom: 5px;">INVOICE PEMESANAN</h1>
        <h3 style="margin: 0; color: #333;"><?php echo e($pemesanan->invoice_number); ?></h3>
        <p style="margin: 5px 0; color: #666;">Tanggal: <?php echo e($pemesanan->created_at->format('d M Y, H:i')); ?></p>
    </div>

    <div style="margin-bottom: 20px;">
        <table width="100%">
            <tr>
                <td width="50%" style="vertical-align: top;">
                    <div class="info-box">
                        <strong>Informasi Pemesan:</strong><br>
                        <?php echo e($pemesanan->pelanggan->nama_lengkap ?? $pemesanan->pelanggan->name); ?><br>
                        <?php echo e($pemesanan->pelanggan->email); ?><br>
                        <?php echo e($pemesanan->pelanggan->telepon ?? '-'); ?>

                    </div>
                </td>
                <td width="50%" style="vertical-align: top;">
                    <div class="info-box">
                        <strong>Status Pemesanan:</strong><br>
                        <span style="color: <?php echo e($pemesanan->status == 'selesai' ? '#25D366' : ($pemesanan->status == 'dibatalkan' ? '#dc3545' : '#ffc107')); ?>;">
                            <?php echo e($pemesanan->status_label); ?>

                        </span>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div style="margin-bottom: 20px;">
        <h3 style="color: #25D366; border-bottom: 1px solid #eee; padding-bottom: 5px;">Detail Homestay</h3>
        <table width="100%">
            <tr>
                <td width="60%" style="vertical-align: top;">
                    <strong><?php echo e($pemesanan->kamar->nama_kamar ?? 'N/A'); ?></strong><br>
                    <?php echo e($pemesanan->kamar->homestay->nama_homestay ?? 'N/A'); ?><br>
                    <?php echo e($pemesanan->kamar->homestay->alamat ?? 'N/A'); ?><br>
                    Telp: <?php echo e($pemesanan->kamar->homestay->telepon ?? 'N/A'); ?>

                </td>
                <td width="40%" style="vertical-align: top;">
                    <strong>Detail Menginap:</strong><br>
                    Check-in: <?php echo e(\Carbon\Carbon::parse($pemesanan->tgl_check_in)->format('d M Y')); ?><br>
                    Check-out: <?php echo e(\Carbon\Carbon::parse($pemesanan->tgl_check_out)->format('d M Y')); ?><br>
                    Durasi: <?php echo e($pemesanan->lama_menginap); ?> Malam<br>
                    Tamu: <?php echo e($pemesanan->jumlah_tamu); ?> Orang<br>
                    Kamar: <?php echo e($pemesanan->jumlah_kamar); ?> Unit
                </td>
            </tr>
        </table>
    </div>

    <?php if($pemesanan->catatan): ?>
    <div style="margin-bottom: 20px;">
        <h3 style="color: #25D366; border-bottom: 1px solid #eee; padding-bottom: 5px;">Catatan Khusus</h3>
        <div class="info-box">
            <p style="margin: 0;"><?php echo e($pemesanan->catatan); ?></p>
        </div>
    </div>
    <?php endif; ?>

    <div>
        <h3 style="color: #25D366; border-bottom: 1px solid #eee; padding-bottom: 5px;">Rincian Biaya</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th width="20%" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>Kamar <?php echo e($pemesanan->kamar->nama_kamar ?? 'N/A'); ?></strong><br>
                        <small><?php echo e($pemesanan->lama_menginap); ?> Malam × <?php echo e($pemesanan->jumlah_kamar); ?> Kamar</small>
                    </td>
                    <td class="text-right">Rp <?php echo e(number_format($pemesanan->total_harga, 0, ',', '.')); ?></td>
                </tr>
                <tr>
                    <td>
                        <strong>Biaya Layanan Sistem</strong><br>
                        <small>Pemeliharaan platform</small>
                    </td>
                    <td class="text-right">Rp <?php echo e(number_format($pemesanan->biaya_tambahan, 0, ',', '.')); ?></td>
                </tr>
                <tr style="background-color: #f8f9fa;">
                    <td class="text-right"><strong>TOTAL PEMBAYARAN</strong></td>
                    <td class="text-right"><strong>Rp <?php echo e(number_format($pemesanan->total_akhir, 0, ',', '.')); ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Invoice ini dibuat secara otomatis pada <?php echo e(now()->format('d M Y H:i')); ?></p>
        <p>Terima kasih telah memesan melalui layanan kami.</p>
    </div>
</body>
</html><?php /**PATH C:\Users\US3R\Downloads\tamansari tourism\resources\views/pdf/invoice.blade.php ENDPATH**/ ?>