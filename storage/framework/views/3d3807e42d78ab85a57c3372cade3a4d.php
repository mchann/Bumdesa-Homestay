<head>
   <style>
        :root {
            --primary: #10B981;
            --primary-dark: #059669;
            --secondary: #3B82F6;
            --danger: #EF4444;
            --warning: #F59E0B;
            --info: #8B5CF6;
            --light: #F9FAFB;
            --dark: #1F2937;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        body {
            background-color: #F3F4F6;
            color: #374151;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.5rem;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .header h1 {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .header-actions {
            display: flex;
            gap: 0.75rem;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            color: white;
            border: none;
        }
        
        .btn-secondary:hover {
            background-color: #2563EB;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }
        
        @media (min-width: 640px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        .stat-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .stat-title {
            font-size: 0.875rem;
            color: #6B7280;
            font-weight: 500;
        }
        
        .stat-icon {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .bg-green-100 {
            background-color: #D1FAE5;
            color: var(--primary);
        }
        
        .bg-blue-100 {
            background-color: #DBEAFE;
            color: var(--secondary);
        }
        
        .bg-yellow-100 {
            background-color: #FEF3C7;
            color: var(--warning);
        }
        
        .bg-purple-100 {
            background-color: #EDE9FE;
            color: var(--info);
        }
        
        .stat-value {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--dark);
        }
        
        .stat-change {
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .positive {
            color: var(--primary);
        }
        
        .negative {
            color: var(--danger);
        }
        
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr; /* grafik bulanan lebih lebar dari status */
            gap: 1.5rem;
        }

        .chart-card {
            background: #fff;
            border-radius: 12px;
            padding: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
        }

        .chart-header {
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .chart-container {
            flex: 1;
            height: 350px;   /* atur tinggi sesuai kebutuhan */
            position: relative;
        }

        .chart-container canvas {
            width: 100% !important;
            height: 100% !important;
        }
        
        .table-card {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .table-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .filter-select {
            padding: 0.5rem 2rem 0.5rem 0.75rem;
            border-radius: 0.375rem;
            border: 1px solid #D1D5DB;
            background-color: white;
            color: #374151;
            font-size: 0.875rem;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 1.5em 1.5em;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: #6B7280;
            text-transform: uppercase;
            border-bottom: 1px solid #E5E7EB;
        }
        
        td {
            padding: 1rem;
            border-bottom: 1px solid #E5E7EB;
            font-size: 0.875rem;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-success {
            background-color: #D1FAE5;
            color: #065F46;
        }
        
        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }
        
        .status-cancelled {
            background-color: #FEE2E2;
            color: #B91C1C;
        }
        
        .status-progress {
            background-color: #DBEAFE;
            color: #1E40AF;
        }
        
        .action-btn {
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }
        
        .btn-detail {
            background-color: #EFF6FF;
            color: #1E40AF;
        }
        
        .btn-detail:hover {
            background-color: #DBEAFE;
        }
        
        .view-all {
            display: block;
            text-align: center;
            padding: 0.75rem;
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            border-top: 1px solid #E5E7EB;
            margin-top: 1rem;
        }
        
        .view-all:hover {
            background-color: #F9FAFB;
        }
    </style>
</head>
<body>
    

    <?php $__env->startSection('content'); ?>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>
                <i class="fas fa-home"></i>
                Dashboard Pemilik Homestay
            </h1>
            <div class="header-actions">
                <a href="<?php echo e(route('pemilik.kamar.create')); ?>"  class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Kamar
                </a>
                <a href="#" class="btn btn-secondary">
                    <i class="fas fa-download"></i>
                    Export Laporan
                </a>
            </div>
        </div>
        
       <!-- Stats Grid -->
<div class="stats-grid">
    <!-- Total Kamar -->
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">TOTAL KAMAR</div>
            <div class="stat-icon bg-green-100">
                <i class="fas fa-bed"></i>
            </div>
        </div>
        <div class="stat-value"><?php echo e($totalKamar ?? 0); ?></div>
        <div class="stat-change positive">
            <i class="fas fa-arrow-up"></i>
            <span><?php echo e($kamarBaruBulanIni ?? 0); ?> kamar ditambahkan bulan ini</span>
        </div>
    </div>
    
    <!-- Kamar Tersedia -->
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">KAMAR TERSEDIA</div>
            <div class="stat-icon bg-blue-100">
                <i class="fas fa-door-open"></i>
            </div>
        </div>
        <div class="stat-value"><?php echo e($kamarTersedia ?? 0); ?></div>
        <div class="stat-change positive">
            <i class="fas fa-arrow-up"></i>
            <span>
                <?php if(($totalKamar ?? 0) > 0): ?>
                    <?php echo e(round(($kamarTersedia / $totalKamar) * 100, 1)); ?>% tersedia
                <?php else: ?>
                    0% tersedia
                <?php endif; ?>
            </span>
        </div>
    </div>
    
    <!-- Total Pemesanan -->
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">TOTAL PEMESANAN</div>
            <div class="stat-icon bg-yellow-100">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
        <div class="stat-value"><?php echo e($totalPemesanan ?? 0); ?></div>
        <div class="stat-change positive">
            <i class="fas fa-arrow-up"></i>
            <span><?php echo e($persenPemesananBulanIni ?? 0); ?>% dari bulan lalu</span>
        </div>
    </div>
    
    <!-- Total Pendapatan -->
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-title">TOTAL PENDAPATAN</div>
            <div class="stat-icon bg-purple-100">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
        <div class="stat-value">Rp<?php echo e(number_format($totalPendapatan ?? 0, 0, ',', '.')); ?></div>
        <div class="stat-change positive">
            <i class="fas fa-arrow-up"></i>
            <span><?php echo e($persenPendapatanBulanIni ?? 0); ?>% dari bulan lalu</span>
        </div>
    </div>
</div>

        
        <!-- Charts Grid -->
        <div class="charts-grid">
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">Statistik Pemesanan Bulanan</div>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-md">
                    <div style="height: 350px;">
                        <canvas id="ordersChart"></canvas>
                    </div>
                </div>
            </div>
            
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title">Status Pemesanan</div>
                </div>
                    <div style="height: 350px; width: 350px;">
                        <canvas id="statusChart"></canvas>
                    </div>
            </div>
        </div>
        
        <!-- Daftar Pemesanan Terbaru -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mt-6">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800">Pemesanan Terbaru</h3>
                <a href="<?php echo e(route('pemilik.pemesanan.index')); ?>" 
                class="text-sm text-blue-600 hover:text-blue-800">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-max">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600 text-sm font-medium">
                            <th class="px-6 py-4">ID Pesanan</th>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Kamar</th>
                            <th class="px-6 py-4">Check-in</th>
                            <th class="px-6 py-4">Check-out</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $pemesananTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-6 py-4 font-mono text-sm text-blue-600">
                                    <?php echo e($p->pemesanan_id); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900"><?php echo e($p->pelanggan->name ?? '-'); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo e($p->pelanggan->email ?? '-'); ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-800"><?php echo e($p->kamar->nama_kamar ?? '-'); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo e($p->kamar->homestay->nama_homestay ?? '-'); ?></div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    <?php echo e(date('d-m-Y', strtotime($p->tgl_check_in))); ?>

                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    <?php echo e(date('d-m-Y', strtotime($p->tgl_check_out))); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <?php
                                        $statusClasses = [
                                            'berhasil' => 'bg-green-50 text-green-700',
                                            'menunggu_konfirmasi' => 'bg-yellow-50 text-yellow-700',
                                            'dibatalkan' => 'bg-red-50 text-red-700',
                                            'selesai' => 'bg-blue-50 text-blue-700',
                                            'pending' => 'bg-gray-50 text-gray-700'
                                        ];
                                        $statusText = [
                                            'berhasil' => 'Berhasil',
                                            'menunggu_konfirmasi' => 'Diproses',
                                            'dibatalkan' => 'Dibatalkan',
                                            'selesai' => 'Selesai',
                                            'pending' => 'Pending'
                                        ];
                                    ?>
                                    <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($statusClasses[$p->status] ?? 'bg-gray-50 text-gray-700'); ?>">
                                        <?php echo e($statusText[$p->status] ?? $p->status); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    Rp<?php echo e(number_format($p->total_harga, 0, ',', '.')); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Belum ada pemesanan terbaru
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <script>
    // Orders Chart (statistik bulanan per status)
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ordersCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Berhasil',
                    data: <?php echo json_encode(array_values($dataBulananLengkap['berhasil']), 15, 512) ?>,
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16,185,129,0.2)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: false,
                    pointBackgroundColor: '#10B981'
                },
                {
                    label: 'Pending',
                    data: <?php echo json_encode(array_values($dataBulananLengkap['pending']), 15, 512) ?>,
                    borderColor: '#F59E0B', 
                    backgroundColor: 'rgba(245,158,11,0.2)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: false,
                    pointBackgroundColor: '#F59E0B'
                },
                {
                    label: 'Dibatalkan',
                    data: <?php echo json_encode(array_values($dataBulananLengkap['dibatalkan']), 15, 512) ?>,
                    borderColor: '#EF4444',
                    backgroundColor: 'rgba(239,68,68,0.2)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: false,
                    pointBackgroundColor: '#EF4444'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: {
                        boxWidth: 20,
                        padding: 15
                    }
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    grid: { drawBorder: false } 
                },
                x: { 
                    grid: { display: false } 
                }
            }
        }
    });

    // Status Chart (doughnut)
    const statusData = <?php echo json_encode($statusPemesanan, 15, 512) ?>;

    // Mapping warna status
    const statusColors = {
        berhasil: '#28a745',   // hijau
        pending: '#F59E0B',    // oranye
        gagal: '#dc3545',      // merah
        dibatalkan: '#dc3545'  // kalau ada status dibatalkan, juga merah
    };

    const statusLabels = Object.keys(statusData);
    const statusValues = Object.values(statusData);

    // Ambil warna sesuai label
    const statusBackgroundColors = statusLabels.map(label => statusColors[label.toLowerCase()] || '#999');

    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusValues,
                backgroundColor: statusBackgroundColors,
                borderWidth: 0,
                hoverOffset: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { 
                        boxWidth: 12, 
                        padding: 20 
                    }
                }
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>
</body>
<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\PEBEL\new before pull\tamansari tourism\resources\views/pemilik/dashboard.blade.php ENDPATH**/ ?>