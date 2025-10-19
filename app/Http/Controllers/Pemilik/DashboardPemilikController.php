<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Pemesanan;
use App\Models\PemilikProfile;
use App\Models\Homestay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = PemilikProfile::where('user_id', $user->id)->firstOrFail();

        // Ambil semua homestay milik pemilik ini
        $homestayIds = Homestay::where('pemilik_id', $profile->pemilik_id)->pluck('homestay_id');

        // Total kamar
        $totalKamar = Kamar::whereIn('homestay_id', $homestayIds)->count();
        $kamarTersedia = Kamar::whereIn('homestay_id', $homestayIds)->where('status', 'tersedia')->count();

        // Kamar baru bulan ini
        $kamarBaruBulanIni = Kamar::whereIn('homestay_id', $homestayIds)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Total pemesanan
        $totalPemesanan = Pemesanan::whereIn('homestay_id', $homestayIds)->count();

        // Pemesanan bulan ini & bulan lalu
        $pemesananBulanIni = Pemesanan::whereIn('homestay_id', $homestayIds)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $pemesananBulanLalu = Pemesanan::whereIn('homestay_id', $homestayIds)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $persenPemesananBulanIni = $pemesananBulanLalu > 0
            ? round((($pemesananBulanIni - $pemesananBulanLalu) / $pemesananBulanLalu) * 100, 1)
            : 0;

        // Total pendapatan
        $totalPendapatan = Pemesanan::whereIn('homestay_id', $homestayIds)
            ->where('status', 'berhasil')
            ->sum('total_harga');

        $pendapatanBulanIni = Pemesanan::whereIn('homestay_id', $homestayIds)
            ->where('status', 'berhasil')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_harga');

        $pendapatanBulanLalu = Pemesanan::whereIn('homestay_id', $homestayIds)
            ->where('status', 'berhasil')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('total_harga');

        $persenPendapatanBulanIni = $pendapatanBulanLalu > 0
            ? round((($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100, 1)
            : 0;

        // Statistik pemesanan bulanan (per status, 1 tahun)
        $dataBulanan = Pemesanan::select(
                DB::raw('MONTH(created_at) as bulan'),
                'status',
                DB::raw('COUNT(*) as jumlah')
            )
            ->whereIn('homestay_id', $homestayIds)
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan', 'status')
            ->get();

        $dataBulananLengkap = [
            'berhasil' => array_fill(1, 12, 0),
            'pending' => array_fill(1, 12, 0),
            'dibatalkan' => array_fill(1, 12, 0),
        ];

        foreach ($dataBulanan as $row) {
            if (isset($dataBulananLengkap[$row->status])) {
                $dataBulananLengkap[$row->status][$row->bulan] = $row->jumlah;
            }
        }

        // Status pemesanan
        $statusPemesanan = Pemesanan::whereIn('homestay_id', $homestayIds)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // Pemesanan terbaru
        $pemesananTerbaru = Pemesanan::with(['pelanggan', 'kamar.homestay'])
            ->whereIn('homestay_id', $homestayIds)
            ->latest()
            ->take(5)
            ->get();

        return view('pemilik.dashboard', compact(
            'totalKamar',
            'kamarTersedia',
            'kamarBaruBulanIni',
            'totalPemesanan',
            'persenPemesananBulanIni',
            'totalPendapatan',
            'persenPendapatanBulanIni',
            'dataBulananLengkap',
            'statusPemesanan',
            'pemesananTerbaru'
        ));
    }
}