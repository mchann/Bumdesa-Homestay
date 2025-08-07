<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Data Pemesanan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 2px;
        }

        .periode {
            text-align: center;
            margin-bottom: 15px;
            font-size: 11px;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #bbb;
            padding: 8px 6px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #dcedc8;
            color: #2e7d32;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        tbody tr:hover {
            background-color: #e0f2f1;
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: right;
            color: #888;
        }
    </style>
</head>
<body>
    <h2>Data Pemesanan Homestay</h2>
    <?php if(isset($tanggalAwal) && isset($tanggalAkhir)): ?>
        <p class="periode">Periode: <?php echo e($tanggalAwal); ?> s/d <?php echo e($tanggalAkhir); ?></p>
    <?php endif; ?>

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
                    <td colspan="10" style="text-align: center; font-style: italic; color: #999;">
                        Tidak ada data pemesanan.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: <?php echo e(\Carbon\Carbon::now()->format('d-m-Y H:i')); ?>

    </div>
</body>
</html><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/exports/pemesanan.blade.php ENDPATH**/ ?>