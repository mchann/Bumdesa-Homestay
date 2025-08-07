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
    @if(isset($tanggalAwal) && isset($tanggalAkhir))
        <p class="periode">Periode: {{ $tanggalAwal }} s/d {{ $tanggalAkhir }}</p>
    @endif

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
                    <td colspan="10" style="text-align: center; font-style: italic; color: #999;">
                        Tidak ada data pemesanan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>
</body>
</html>