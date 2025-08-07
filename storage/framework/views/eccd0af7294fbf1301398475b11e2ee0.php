<?php $__env->startSection('content'); ?>

<div class="px-6 py-4">
    
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl shadow text-center">
            <h3 class="text-sm text-gray-600">Total Kamar</h3>
            <p class="text-2xl font-bold text-green-600">120</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow text-center">
            <h3 class="text-sm text-gray-600">Kamar Tersedia</h3>
            <p class="text-2xl font-bold text-green-600">65</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow text-center">
            <h3 class="text-sm text-gray-600">Total Pemesanan</h3>
            <p class="text-2xl font-bold text-green-600">200</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow text-center">
            <h3 class="text-sm text-gray-600">Total Pendapatan</h3>
            <p class="text-2xl font-bold text-green-600">280.000.000.00</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-4 rounded-xl shadow">
            <h2 class="text-lg font-semibold mb-2">Jumlah Pemesanan</h2>
            <canvas id="orderChart" width="600" height="400"></canvas>
        </div>
        <div class="bg-white p-4 rounded-xl shadow">
            <h2 class="text-lg font-semibold mb-2">Status Pemesanan</h2>
            <canvas id="statusChart" width="600" height="400"></canvas>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-xl p-4 shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Daftar Pemesanan</h2>
            <select class="border rounded px-2 py-1 text-sm">
                <option>Terbaru</option>
            </select>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="text-gray-500">
                    <tr>
                        <th class="py-2">Tgl Pesan</th>
                        <th class="py-2">ID Pesanan</th>
                        <th class="py-2">Pelanggan</th>
                        <th class="py-2">Jumlah</th>
                        <th class="py-2">Check-in</th>
                        <th class="py-2">Check-out</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="py-2">23.02.2025</td>
                        <td class="py-2">RNJ005</td>
                        <td class="py-2">Virda Febriyanti</td>
                        <td class="py-2">2 dewasa x 1 child</td>
                        <td class="py-2">23-02-2024 00:01am</td>
                        <td class="py-2">29-02-2024 12:00pm</td>
                        <td class="py-2 text-green-600 font-semibold">Lunas</td>
                        <td class="py-2"><button class="bg-green-100 text-green-700 px-3 py-1 rounded">Detail</button></td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2">24.02.2025</td>
                        <td class="py-2">RNJ005</td>
                        <td class="py-2">Virda Febriyanti</td>
                        <td class="py-2">2 dewasa x 1 child</td>
                        <td class="py-2">23-02-2024 00:01am</td>
                        <td class="py-2">29-02-2024 12:00pm</td>
                        <td class="py-2 text-yellow-600 font-semibold">Pending</td>
                        <td class="py-2"><button class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">Detail</button></td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2">23.02.2025</td>
                        <td class="py-2">RNJ005</td>
                        <td class="py-2">Virda Febriyanti</td>
                        <td class="py-2">2 dewasa x 1 child</td>
                        <td class="py-2">23-02-2024 00:01am</td>
                        <td class="py-2">29-02-2024 12:00pm</td>
                        <td class="py-2 text-red-600 font-semibold">Dibatalkan</td>
                        <td class="py-2"><button class="bg-red-100 text-red-700 px-3 py-1 rounded">Detail</button></td>
                    </tr>
                    <tr class="border-t">
                        <td class="py-2">23.02.2025</td>
                        <td class="py-2">RNJ005</td>
                        <td class="py-2">Virda Febriyanti</td>
                        <td class="py-2">2 dewasa x 1 child</td>
                        <td class="py-2">23-02-2024 00:01am</td>
                        <td class="py-2">29-02-2024 12:00pm</td>
                        <td class="py-2 text-blue-600 font-semibold">In Progress</td>
                        <td class="py-2"><button class="bg-blue-100 text-blue-700 px-3 py-1 rounded">Detail</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.pemilik', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\pengabdian\homestay-bumdes\resources\views/pemilik/dashboard.blade.php ENDPATH**/ ?>