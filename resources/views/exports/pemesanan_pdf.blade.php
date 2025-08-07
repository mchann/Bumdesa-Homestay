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
        <p class="period">Periode: {{ $tanggalAwal }} sampai {{ $tanggalAkhir }}</p>
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
            @forelse ($pemesanans as $index => $pemesanan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pemesanan->pelanggan->name ?? '-' }}</td>
                    <td>{{ $pemesanan->kamar->homestay->nama_homestay ?? '-' }}</td>
                    <td>{{ $pemesanan->kamar->nama_kamar ?? '-' }}</td>
                    <td>{{ $pemesanan->tgl_check_in }}</td>
                    <td>{{ $pemesanan->tgl_check_out }}</td>
                    <td>{{ $pemesanan->jumlah_tamu }}</td>
                    <td>{{ $pemesanan->jumlah_kamar ?? 1 }}</td>
                    <td>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $pemesanan->catatan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="no-data">Tidak ada data pemesanan untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>