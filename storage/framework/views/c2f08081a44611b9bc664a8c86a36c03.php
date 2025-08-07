<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        text-align: center;
    }
    .card-title {
        font-size: 14px;
        color: gray;
    }
    .card-value {
        font-size: 24px;
        font-weight: bold;
        margin-top: 4px;
    }
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .status-badge {
        border-radius: 12px;
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 600;
    }
    .bg-success { background-color: #dcfce7; color: #16a34a; }
    .bg-warning { background-color: #fef9c3; color: #ca8a04; }
    .bg-danger { background-color: #fee2e2; color: #dc2626; }
    .bg-info { background-color: #e0f2fe; color: #0284c7; }
</style>

<p class="text-gray-600 mb-4">Selamat datang di Dashboard Admin!</p>

<div class="dashboard-grid">
    <div class="card">
        <div class="card-title">Total Homestay</div>
        <div class="card-value text-green-600">23</div>
    </div>
    <div class="card">
        <div class="card-title">Total Kamar</div>
        <div class="card-value text-green-600">100</div>
    </div>
    <div class="card">
        <div class="card-title">Kamar Tersedia</div>
        <div class="card-value text-green-600">50</div>
    </div>
    <div class="card">
        <div class="card-title">Total Pemesanan</div>
        <div class="card-value text-green-600">50</div>
    </div>
    <div class="card">
        <div class="card-title">Total Pendapatan</div>
        <div class="card-value text-green-600">Rp23.000.000</div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div class="card">
        <h2 class="font-semibold mb-2">Jumlah Pemesanan</h2>
        <canvas id="chartPemesanan" height="200"></canvas> <!-- Ukuran diperbesar -->
    </div>
    <div class="card">
        <h2 class="font-semibold mb-2">Status Pemesanan</h2>
        <canvas id="chartStatus" height="200"></canvas>
    </div>
</div>

<div class="card">
    <h2 class="font-semibold mb-4">Daftar Pemesanan</h2>
    <div class="mb-2 text-right">
        <select class="border px-2 py-1 rounded">
            <option>Terbaru</option>
        </select>
    </div>
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Tgl Pesan</th>
                <th class="px-4 py-2 text-left">Homestay</th>
                <th class="px-4 py-2 text-left">ID Pesanan</th>
                <th class="px-4 py-2 text-left">Pelanggan</th>
                <th class="px-4 py-2 text-left">Check-in</th>
                <th class="px-4 py-2 text-left">Check-out</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="px-4 py-2">23.02.2025</td>
                <td class="px-4 py-2">RNU Homestay</td>
                <td class="px-4 py-2">RNJ005</td>
                <td class="px-4 py-2">Princess Virda</td>
                <td class="px-4 py-2">23-02-2024 00:01am</td>
                <td class="px-4 py-2">24-02-2024 12:00pm</td>
                <td class="px-4 py-2"><span class="status-badge bg-success">Lunas</span></td>
                <td class="px-4 py-2"><a href="#" class="text-green-600 font-semibold">Detail</a></td>
            </tr>
            <tr class="border-t">
                <td class="px-4 py-2">23.02.2025</td>
                <td class="px-4 py-2">Berlian Homestay</td>
                <td class="px-4 py-2">BR005</td>
                <td class="px-4 py-2">Princess Echa</td>
                <td class="px-4 py-2">23-02-2024 00:01am</td>
                <td class="px-4 py-2">24-02-2024 12:00pm</td>
                <td class="px-4 py-2"><span class="status-badge bg-warning">Pending</span></td>
                <td class="px-4 py-2"><a href="#" class="text-green-600 font-semibold">Detail</a></td>
            </tr>
            <tr class="border-t">
                <td class="px-4 py-2">23.02.2025</td>
                <td class="px-4 py-2">Mamat Homestay</td>
                <td class="px-4 py-2">MT005</td>
                <td class="px-4 py-2">Princess Dina</td>
                <td class="px-4 py-2">23-02-2024 00:01am</td>
                <td class="px-4 py-2">24-02-2024 12:00pm</td>
                <td class="px-4 py-2"><span class="status-badge bg-danger">Dibatalkan</span></td>
                <td class="px-4 py-2"><a href="#" class="text-green-600 font-semibold">Detail</a></td>
            </tr>
            <tr class="border-t">
                <td class="px-4 py-2">23.02.2025</td>
                <td class="px-4 py-2">Kayangan Homestay</td>
                <td class="px-4 py-2">KY005</td>
                <td class="px-4 py-2">Princess Irfan</td>
                <td class="px-4 py-2">23-02-2024 00:01am</td>
                <td class="px-4 py-2">24-02-2024 12:00pm</td>
                <td class="px-4 py-2"><span class="status-badge bg-info">In Progress</span></td>
                <td class="px-4 py-2"><a href="#" class="text-green-600 font-semibold">Detail</a></td>
            </tr>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const customColors = ['#024B7A', '#44B7C2', '#FFAE49'];

    const ctx = document.getElementById('chartPemesanan').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['23 Feb', '24 Feb', '25 Feb', '26 Feb'],
            datasets: [
                { label: 'Berhasil', backgroundColor: customColors[0], data: [100, 60, 40, 30] },
                { label: 'Dibatalkan', backgroundColor: customColors[1], data: [30, 20, 15, 10] },
                { label: 'Pending', backgroundColor: customColors[2], data: [20, 15, 10, 5] },
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const statusChart = document.getElementById('chartStatus').getContext('2d');
    new Chart(statusChart, {
        type: 'doughnut',
        data: {
            labels: ['Lunas', 'Pending', 'Gagal'],
            datasets: [{
                data: [65, 20, 15],
                backgroundColor: customColors
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'right' } }
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\homestay-bumdes\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>