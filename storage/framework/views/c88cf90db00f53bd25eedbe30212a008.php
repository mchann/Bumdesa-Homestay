<?php $__env->startSection('content'); ?>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #16a34a;
            --primary-dark: #15803d;
            --primary-light: #dcfce7;
            --secondary: #2563eb;
            --accent: #f59e0b;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #e2e8f0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fb;
            min-height: 100vh;
            color: var(--dark);
        }

        .dashboard-container {
            padding: 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            padding: 1.8rem;
            border-radius: 1.2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(22, 163, 74, 0.2);
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0h20L0 20z' fill='%23ffffff' fill-opacity='0.05'/%3E%3C/svg%3E");
            transform: rotate(-15deg);
        }

        .dashboard-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            position: relative;
        }

        .dashboard-header p {
            opacity: 0.9;
            font-weight: 300;
            position: relative;
        }

        /* Stat Cards */
        .stat-card {
            border-radius: 1.2rem;
            background: #fff;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stat-card:hover::after {
            opacity: 1;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background: var(--primary-light);
            color: var(--primary);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin: 0.5rem 0;
            color: var(--dark);
        }

        .stat-title {
            font-size: 0.9rem;
            color: var(--gray);
            font-weight: 500;
        }

        /* Progress bar */
        .progress-container {
            margin-top: 1.2rem;
        }

        .progress-info {
            display: flex;
            justify-content: between;
            margin-bottom: 0.4rem;
        }

        .progress-label {
            font-size: 0.8rem;
            color: var(--gray);
        }

        .progress-percentage {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
        }

        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background: var(--gray-light);
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            transition: width 1s ease-in-out;
            box-shadow: 0 0 10px rgba(22, 163, 74, 0.3);
        }

        /* Cards container */
        .card {
            background: #fff;
            border-radius: 1.2rem;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            height: 100%;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }

        .card-action {
            color: var(--primary);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
        }

        /* Activity */
        .activity-item {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            padding: 1rem 0;
            border-bottom: 1px solid var(--gray-light);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-light);
            color: var(--primary);
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 500;
            margin-bottom: 0.2rem;
        }

        .activity-desc {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 0.3rem;
        }

        .activity-time {
            font-size: 0.75rem;
            color: var(--gray);
        }

        /* Status items */
        .status-item {
            margin-bottom: 1.5rem;
        }

        .status-item:last-child {
            margin-bottom: 0;
        }

        .status-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .status-name {
            font-size: 0.9rem;
            color: var(--dark);
        }

        .status-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--primary);
        }

        /* Quick actions */
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .quick-action {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.2rem 0.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: var(--primary-light);
            color: var(--primary);
            text-align: center;
            cursor: pointer;
        }

        .quick-action:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(22, 163, 74, 0.2);
            background: var(--primary);
            color: white;
        }

        .quick-action i {
            font-size: 1.5rem;
            margin-bottom: 0.7rem;
        }

        .quick-action span {
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Notification */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            z-index: 1000;
            display: flex;
            align-items: center;
            animation: slideIn 0.3s forwards, fadeOut 0.5s forwards 3.5s;
        }

        .notification-success {
            background: #f0fdf4;
            color: #15803d;
            border-left: 4px solid #15803d;
        }

        .notification-warning {
            background: #fffbeb;
            color: #f59e0b;
            border-left: 4px solid #f59e0b;
        }

        .notification i {
            margin-right: 0.7rem;
            font-size: 1.2rem;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
                visibility: hidden;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .dashboard-header {
                padding: 1.5rem;
            }
            
            .stat-value {
                font-size: 1.7rem;
            }
            
            .quick-actions-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Chart container khusus */
        .chart-wrapper {
            position: relative;
            height: 280px;
            width: 100%;
        }
    </style>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h1>Selamat Datang, Admin!</h1>
            <p>Pantau dan kelola aktivitas homestay dengan mudah</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Pemesanan -->
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="stat-title">Total Pemesanan</p>
                        <h3 class="stat-value"><?php echo e($totalPemesanan); ?></h3>
                        <div class="progress-container">
                            <div class="progress-info">
                                <span class="progress-label"></span>
                                <span class="progress-percentage"></span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="stat-title">Total Pendapatan</p>
                        <h3 class="stat-value">Rp<?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></h3>
                        <div class="progress-container">
                            <div class="progress-info">
                                <span class="progress-label"></span>
                                <span class="progress-percentage"></span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 85%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>

             <!-- Pemilik Aktif - FIXED -->
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="stat-title">Pemilik Homestay Aktif</p>
                        <h3 class="stat-value"><?php echo e($pemilikAktif = $pemilikList->where('status', 'aktif')->count()); ?></h3>
                        <div class="progress-container">
                            <div class="progress-info">
                                <span class="progress-label">Dari total <?php echo e($totalPemilik = $pemilikList->count()); ?> pemilik</span>
                                <span class="progress-percentage">
                                    <?php echo e($percentage = $totalPemilik > 0 ? round(($pemilikAktif / $totalPemilik) * 100) : 0); ?>%
                                </span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?php echo e($percentage); ?>%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="stat-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Charts & Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Chart -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Pendapatan Bulanan</h2>
                    <span class="card-action">Lihat Laporan</span>
                </div>
                <div class="chart-wrapper">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

          <!-- Activity -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Aktivitas Terbaru</h2>
        <a href="<?php echo e(route('admin.pemesanan.index')); ?>" class="card-action">Lihat Semua</a>
    </div>
    <div class="activity-list">
        <?php $__empty_1 = true; $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="activity-item">
                <div class="activity-icon 
                    <?php if($activity['type'] === 'pemesanan'): ?> bg-blue-100 text-blue-600
                    <?php elseif($activity['type'] === 'homestay'): ?> bg-green-100 text-green-600
                    <?php elseif($activity['type'] === 'pemilik'): ?> bg-purple-100 text-purple-600
                    <?php elseif($activity['type'] === 'pembayaran'): ?> bg-yellow-100 text-yellow-600
                    <?php else: ?> bg-gray-100 text-gray-600 <?php endif; ?>">
                    <?php if($activity['type'] === 'pemesanan'): ?>
                        <i class="fas fa-calendar-check"></i>
                    <?php elseif($activity['type'] === 'homestay'): ?>
                        <i class="fas fa-home"></i>
                    <?php elseif($activity['type'] === 'pemilik'): ?>
                        <i class="fas fa-user-plus"></i>
                    <?php elseif($activity['type'] === 'pembayaran'): ?>
                        <i class="fas fa-check-circle"></i>
                    <?php else: ?>
                        <i class="fas fa-bell"></i>
                    <?php endif; ?>
                </div>
                <div class="activity-content">
                    <p class="activity-title"><?php echo e($activity['title']); ?></p>
                    <p class="activity-desc"><?php echo e($activity['description']); ?></p>
                    <p class="activity-time"><?php echo e($activity['time']); ?></p>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="activity-item">
                <div class="activity-content text-center py-4">
                    <p class="text-gray-500">Tidak ada aktivitas terbaru</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

        <!-- Status & Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Status Homestay -->
    <div class="bg-white rounded-xl shadow-xs p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Status Homestay</h2>
            <span class="text-sm text-blue-600 font-medium">Real-time</span>
        </div>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <span class="text-sm font-medium text-gray-700">Homestay Tersedia</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-900"><?php echo e($homestayStats['tersedia']); ?></span>
                    <div class="w-24 h-2 bg-gray-200 rounded-full mt-1">
                        <div class="h-2 bg-green-500 rounded-full" 
                             style="width: <?php echo e($homestayStats['dengan_kamar'] > 0 ? ($homestayStats['tersedia'] / $homestayStats['dengan_kamar'] * 100) : 0); ?>%">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                    <span class="text-sm font-medium text-gray-700">Sedang Dipakai</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-900"><?php echo e($homestayStats['dipakai']); ?></span>
                    <div class="w-24 h-2 bg-gray-200 rounded-full mt-1">
                        <div class="h-2 bg-blue-500 rounded-full" 
                             style="width: <?php echo e($homestayStats['dengan_kamar'] > 0 ? ($homestayStats['dipakai'] / $homestayStats['dengan_kamar'] * 100) : 0); ?>%">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                    <span class="text-sm font-medium text-gray-700">Total Kamar</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-900"><?php echo e($homestayStats['total_kamar']); ?></span>
                    <div class="w-24 h-2 bg-gray-200 rounded-full mt-1">
                        <div class="h-2 bg-purple-500 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    <span class="text-sm font-medium text-gray-700">Kamar Tersedia</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-900"><?php echo e($homestayStats['kamar_tersedia']); ?></span>
                    <div class="w-24 h-2 bg-gray-200 rounded-full mt-1">
                        <div class="h-2 bg-green-400 rounded-full" 
                             style="width: <?php echo e($homestayStats['total_kamar'] > 0 ? ($homestayStats['kamar_tersedia'] / $homestayStats['total_kamar'] * 100) : 0); ?>%">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-blue-400"></div>
                    <span class="text-sm font-medium text-gray-700">Kamar Dipesan</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-900"><?php echo e($homestayStats['kamar_dipesan']); ?></span>
                    <div class="w-24 h-2 bg-gray-200 rounded-full mt-1">
                        <div class="h-2 bg-blue-400 rounded-full" 
                             style="width: <?php echo e($homestayStats['total_kamar'] > 0 ? ($homestayStats['kamar_dipesan'] / $homestayStats['total_kamar'] * 100) : 0); ?>%">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-gray-500"></div>
                    <span class="text-sm font-medium text-gray-700">Total Homestay</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-900"><?php echo e($homestayStats['total']); ?></span>
                    <div class="w-24 h-2 bg-gray-200 rounded-full mt-1">
                        <div class="h-2 bg-gray-500 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Pemilik & Distribusi -->
    <div class="bg-white rounded-xl shadow-xs p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Distribusi Pemilik</h2>
            <span class="text-sm text-blue-600 font-medium">Manajemen</span>
        </div>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <span class="text-sm font-medium text-gray-700">Pemilik Aktif</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-900"><?php echo e($homestayStats['pemilik_aktif_count']); ?></span>
                    <div class="w-24 h-2 bg-gray-200 rounded-full mt-1">
                        <div class="h-2 bg-green-500 rounded-full" 
                             style="width: <?php echo e($homestayStats['total_pemilik'] > 0 ? ($homestayStats['pemilik_aktif_count'] / $homestayStats['total_pemilik'] * 100) : 0); ?>%">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <span class="text-sm font-medium text-gray-700">Pemilik Nonaktif</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-900"><?php echo e($homestayStats['pemilik_nonaktif_count']); ?></span>
                    <div class="w-24 h-2 bg-gray-200 rounded-full mt-1">
                        <div class="h-2 bg-red-500 rounded-full" 
                             style="width: <?php echo e($homestayStats['total_pemilik'] > 0 ? ($homestayStats['pemilik_nonaktif_count'] / $homestayStats['total_pemilik'] * 100) : 0); ?>%">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    <span class="text-sm font-medium text-gray-700">Homestay Aktif</span>
                    <span class="text-xs text-gray-500">(milik pemilik aktif)</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-900"><?php echo e($homestayStats['pemilik_aktif']); ?></span>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-red-400"></div>
                    <span class="text-sm font-medium text-gray-700">Homestay Nonaktif</span>
                    <span class="text-xs text-gray-500">(milik pemilik nonaktif)</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-900"><?php echo e($homestayStats['pemilik_nonaktif']); ?></span>
                </div>
            </div>

            <!-- Statistik Jenis Kamar -->
            <div class="pt-4 border-t border-gray-100">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Distribusi Jenis Kamar</h3>
                <div class="space-y-2">
                    <?php $__empty_1 = true; $__currentLoopData = $homestayStats['jenis_kamar_stats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-600"><?php echo e($jenis->nama_jenis); ?></span> <!-- Diperbaiki -->
                        <span class="text-xs font-bold text-gray-900"><?php echo e($jenis->total); ?> kamar</span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-xs text-gray-500 text-center">Tidak ada data jenis kamar</div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-gray-500"></div>
                    <span class="text-sm font-medium text-gray-700">Total Pemilik</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-bold text-gray-900"><?php echo e($homestayStats['total_pemilik']); ?></span>
                    <div class="w-24 h-2 bg-gray-200 rounded-full mt-1">
                        <div class="h-2 bg-gray-500 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            <!-- Quick Actions -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Aksi Cepat</h2>
        <a href="#" class="card-action">Semua Aksi</a>
    </div>
    <div class="quick-actions-grid">
        <a href="<?php echo e(route('admin.peraturan.index')); ?>" class="quick-action">
            <i class="fas fa-clipboard-list"></i>
            <span>Tambah Peraturan</span>
        </a>
        <a href="<?php echo e(route('admin.fasilitas.index')); ?>" class="quick-action">
            <i class="fas fa-concierge-bell"></i>
            <span>Fasilitas</span>
        </a>
        <a href="<?php echo e(route('admin.pemilik.list')); ?>" class="quick-action">
            <i class="fas fa-user-tie"></i>
            <span>Tambah Pemilik</span>
        </a>
        <a href="<?php echo e(route('admin.pemesanan.index')); ?>" class="quick-action">
            <i class="fas fa-calendar-check"></i>
            <span>Pemesanan</span>
        </a>
    </div>
</div>
</div>
</div>

    <!-- Notifications -->
    <?php if(session('success')): ?>
    <div class="notification notification-success">
        <i class="fas fa-check-circle"></i>
        <span><?php echo e(session('success')); ?></span>
    </div>
    <?php endif; ?>
    <?php if(session('warning')): ?>
    <div class="notification notification-warning">
        <i class="fas fa-exclamation-triangle"></i>
        <span><?php echo e(session('warning')); ?></span>
    </div>
    <?php endif; ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data untuk grafik pendapatan
        const monthlyRevenueData = {
            labels: <?php echo json_encode($chartData['monthLabels'], 15, 512) ?>,
            datasets: [{
                label: 'Pendapatan (Juta Rupiah)',
                data: <?php echo json_encode($chartData['monthlyRevenue'], 15, 512) ?>,
                backgroundColor: 'rgba(22, 163, 74, 0.1)',
                borderColor: 'rgba(22, 163, 74, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        };

        // Konfigurasi grafik pendapatan
        const revenueConfig = {
            type: 'line',
            data: monthlyRevenueData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Rp${context.raw}jt`;
                            }
                        },
                        backgroundColor: 'rgba(22, 163, 74, 0.9)',
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + value + 'jt';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        };

        // Inisialisasi grafik pendapatan
        const revenueChart = new Chart(
            document.getElementById('revenueChart'),
            revenueConfig
        );

        // Animasi progress bars
        document.querySelectorAll('.progress-fill').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => {
                bar.style.width = width;
            }, 500);
        });
    });
    </script>
</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\US3R\Downloads\new before pull\tamansari tourism\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>