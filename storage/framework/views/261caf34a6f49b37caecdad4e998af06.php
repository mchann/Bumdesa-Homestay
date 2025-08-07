<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Pemesanan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .company-info {
            color: #2e7d32;
        }

        .period {
            text-align: center;
            margin-top: -10px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #666;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #c8e6c9;
            color: #2e7d32;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #999;
        }
    </style>
</head>
<body>
    <header>
        <h2 class="company-info">Laporan Pemesanan Homestay</h2>
        <p class="period">Periode: <?php echo e($tanggalAwal); ?> sampai <?php echo e($tanggalAkhir); ?></p>
    </header>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tamu</th>
                <th>Homestay</th>
                <th>Kamar</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Jumlah Tamu</th>
                <th>Jumlah Kamar</th>
                <th>Total Harga</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $pemesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pemesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($pemesanan->pelanggan->name ?? '-'); ?></td>
                    <td><?php echo e($pemesanan->kamar->homestay->nama_homestay ?? '-'); ?></td>
                    <td><?php echo e($pemesanan->kamar->nama_kamar ?? '-'); ?></td>
                    <td><?php echo e($pemesanan->tgl_check_in); ?></td>
                    <td><?php echo e($pemesanan->tgl_check_out); ?></td>
                    <td><?php echo e($pemesanan->jumlah_tamu); ?></td>
                    <td><?php echo e($pemesanan->jumlah_kamar ?? 1); ?></td>
                    <td>Rp <?php echo e(number_format($pemesanan->total_harga, 0, ',', '.')); ?></td>
                    <td><?php echo e($pemesanan->catatan ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="10" class="no-data">Tidak ada data pemesanan untuk periode ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/exports/pemesanan_pdf.blade.php ENDPATH**/ ?>