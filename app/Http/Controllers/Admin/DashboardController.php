<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Homestay;
use App\Models\User;
use App\Models\Kamar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik untuk kartu dashboard
        $totalPemesanan = Pemesanan::count();
        $totalPemesananBerhasil = Pemesanan::where('status', 'berhasil')->count();
        $totalPendapatan = Pemesanan::where('status', 'berhasil')->sum('total_harga');

        // Data untuk daftar pemilik homestay
        $pemilikList = User::where('role', 'pemilik')->with('pemilikProfile')->get();

        // Data untuk daftar pemesanan terbaru di dashboard
        $pemesanans = Pemesanan::with(['kamar.homestay', 'pelanggan'])
                                ->latest()
                                ->take(5)
                                ->get();
        
        // Data untuk grafik
        $chartData = $this->getChartData();
        
        // Statistik Homestay berdasarkan data pemilik
        $homestayStats = $this->getHomestayStats();
        
        // Aktivitas terbaru
        $recentActivities = $this->getRecentActivities();

        // Statistik pemesanan
        $pemesananStats = $this->getPemesananStats();

        // Statistik pendapatan
        $revenueStats = $this->getRevenueStats();

        return view('admin.dashboard', compact(
            'totalPemesanan',
            'totalPemesananBerhasil',
            'totalPendapatan',
            'pemilikList',
            'pemesanans',
            'chartData',
            'homestayStats',
            'recentActivities',
            'pemesananStats',
            'revenueStats'
        ));
    }
    
    /**
     * Mendapatkan data untuk semua grafik
     */
    private function getChartData()
    {
        $currentYear = Carbon::now()->year;
        
        // Data pendapatan bulanan
        $revenueData = Pemesanan::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_harga) as total')
            )
            ->where('status', 'berhasil')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();
        
        // Data pemesanan bulanan
        $ordersData = Pemesanan::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();
        
        // Inisialisasi array dengan 12 bulan (nilai 0)
        $monthlyRevenue = array_fill(0, 12, 0);
        $monthlyOrders = array_fill(0, 12, 0);
        
        // Label bulan
        $monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        
        // Mengisi array dengan data dari database
        foreach ($revenueData as $data) {
            $monthIndex = $data->month - 1;
            $monthlyRevenue[$monthIndex] = $data->total / 1000000; // Konversi ke juta
        }
        
        foreach ($ordersData as $data) {
            $monthIndex = $data->month - 1;
            $monthlyOrders[$monthIndex] = $data->count;
        }
        
        return [
            'monthlyRevenue' => $monthlyRevenue,
            'monthlyOrders' => $monthlyOrders,
            'monthLabels' => $monthLabels
        ];
    }

    /**
     * Mendapatkan statistik homestay berdasarkan data pemilik
     */
    private function getHomestayStats()
    {
        // Total homestay dari semua pemilik
        $totalHomestay = Homestay::count();
        
        // Hitung homestay yang memiliki kamar
        $homestayDenganKamar = Homestay::has('kamar')->count();
        
        // Homestay tanpa kamar (tidak memiliki kamar)
        $homestayTanpaKamar = Homestay::doesntHave('kamar')->count();

        // Hitung total kamar
        $totalKamar = Kamar::count();

        // Hitung kamar yang tersedia (tidak memiliki pemesanan aktif)
        $kamarTersedia = Kamar::whereDoesntHave('pemesanan', function($query) {
            $query->whereIn('status', ['menunggu_konfirmasi', 'berhasil'])
                  ->where('tgl_check_in', '<=', now())
                  ->where('tgl_check_out', '>=', now());
        })->count();

        // Hitung kamar yang sedang dipesan
        $kamarDipesan = $totalKamar - $kamarTersedia;

        // Hitung pemesanan aktif untuk menentukan homestay yang sedang dipakai
        $pemesananAktif = Pemesanan::whereIn('status', ['menunggu_konfirmasi', 'berhasil'])
            ->where('tgl_check_in', '<=', now())
            ->where('tgl_check_out', '>=', now())
            ->get();

        // Hitung homestay unik yang memiliki pemesanan aktif
        $homestayIdsDipakai = $pemesananAktif->pluck('homestay_id')->unique()->toArray();
        $homestayDipakai = count($homestayIdsDipakai);

        // Homestay tersedia = total homestay dengan kamar - homestay yang dipakai
        $homestayTersedia = $homestayDenganKamar - $homestayDipakai;

        // Hitung homestay berdasarkan status pemilik
        $homestayPemilikAktif = Homestay::whereHas('pemilik', function($query) {
            $query->where('status', 'aktif');
        })->count();

        $homestayPemilikNonaktif = Homestay::whereHas('pemilik', function($query) {
            $query->where('status', 'nonaktif');
        })->count();

        // Statistik jenis kamar
        $jenisKamarStats = DB::table('kamar')
            ->join('jenis_kamar', 'kamar.jenis_kamar_id', '=', 'jenis_kamar.jenis_kamar_id')
            ->select('jenis_kamar.nama_jenis', DB::raw('COUNT(*) as total'))
            ->groupBy('jenis_kamar.nama_jenis')
            ->get();

        return [
            'total' => $totalHomestay,
            'tersedia' => max(0, $homestayTersedia), // Pastikan tidak negatif
            'dipakai' => $homestayDipakai,
            'dengan_kamar' => $homestayDenganKamar,
            'tanpa_kamar' => $homestayTanpaKamar,
            'total_kamar' => $totalKamar,
            'kamar_tersedia' => $kamarTersedia,
            'kamar_dipesan' => $kamarDipesan,
            'pemilik_aktif' => $homestayPemilikAktif,
            'pemilik_nonaktif' => $homestayPemilikNonaktif,
            'total_pemilik' => User::where('role', 'pemilik')->count(),
            'pemilik_aktif_count' => User::where('role', 'pemilik')->where('status', 'aktif')->count(),
            'pemilik_nonaktif_count' => User::where('role', 'pemilik')->where('status', 'nonaktif')->count(),
            'jenis_kamar_stats' => $jenisKamarStats,
        ];
    }

    /**
     * Mendapatkan statistik pemesanan berdasarkan status
     */
    private function getPemesananStats()
    {
        return [
            'menunggu_konfirmasi' => Pemesanan::where('status', 'menunggu_konfirmasi')->count(),
            'berhasil' => Pemesanan::where('status', 'berhasil')->count(),
            'gagal' => Pemesanan::where('status', 'gagal')->count(),
            'selesai' => Pemesanan::where('status', 'selesai')->count(),
            'dibatalkan' => Pemesanan::where('status', 'dibatalkan')->count(),
        ];
    }

    /**
     * Mendapatkan statistik pendapatan
     */
    private function getRevenueStats()
    {
        $today = Carbon::today();
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        return [
            'hari_ini' => Pemesanan::where('status', 'berhasil')
                        ->whereDate('created_at', $today)
                        ->sum('total_harga'),
            'bulan_ini' => Pemesanan::where('status', 'berhasil')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->sum('total_harga'),
            'tahun_ini' => Pemesanan::where('status', 'berhasil')
                        ->whereYear('created_at', $year)
                        ->sum('total_harga'),
        ];
    }

    /**
     * Mendapatkan aktivitas terbaru untuk dashboard
     */
    private function getRecentActivities()
    {
        $activities = [];

        // 1. Pemesanan terbaru yang berhasil
        $recentBookings = Pemesanan::with(['pelanggan', 'homestay'])
            ->where('status', 'berhasil')
            ->latest()
            ->take(3)
            ->get();

        foreach ($recentBookings as $booking) {
            $activities[] = [
                'type' => 'pemesanan',
                'title' => 'Pemesanan Berhasil',
                'description' => 'Pemesanan #' . $booking->pemesanan_id . ' - ' . ($booking->homestay->nama_homestay ?? 'Homestay'),
                'time' => $booking->created_at->diffForHumans(),
                'created_at' => $booking->created_at
            ];
        }

        // 2. Homestay baru terdaftar
        $newHomestays = Homestay::with('pemilik')
            ->latest()
            ->take(2)
            ->get();

        foreach ($newHomestays as $homestay) {
            $activities[] = [
                'type' => 'homestay',
                'title' => 'Homestay Baru Terdaftar',
                'description' => $homestay->nama_homestay . ' oleh ' . ($homestay->pemilik->name ?? 'Pemilik'),
                'time' => $homestay->created_at->diffForHumans(),
                'created_at' => $homestay->created_at
            ];
        }

        // 3. Pemilik baru bergabung
        $newOwners = User::where('role', 'pemilik')
            ->latest()
            ->take(2)
            ->get();

        foreach ($newOwners as $owner) {
            $activities[] = [
                'type' => 'pemilik',
                'title' => 'Pemilik Baru Bergabung',
                'description' => $owner->name . ' terdaftar sebagai pemilik homestay',
                'time' => $owner->created_at->diffForHumans(),
                'created_at' => $owner->created_at
            ];
        }

        // 4. Pembayaran dikonfirmasi
        $confirmedPayments = Pemesanan::where('status', 'berhasil')
            ->latest()
            ->take(2)
            ->get();

        foreach ($confirmedPayments as $payment) {
            $activities[] = [
                'type' => 'pembayaran',
                'title' => 'Pembayaran Dikonfirmasi',
                'description' => 'Pemesanan #' . $payment->pemesanan_id . ' - Rp ' . number_format($payment->total_harga, 0, ',', '.'),
                'time' => $payment->updated_at->diffForHumans(),
                'created_at' => $payment->updated_at
            ];
        }

        // 5. Pemesanan menunggu konfirmasi
        $pendingConfirmations = Pemesanan::with(['homestay'])
            ->where('status', 'menunggu_konfirmasi')
            ->latest()
            ->take(2)
            ->get();

        foreach ($pendingConfirmations as $pending) {
            $activities[] = [
                'type' => 'pembayaran',
                'title' => 'Pembayaran Menunggu Konfirmasi',
                'description' => 'Pemesanan #' . $pending->pemesanan_id . ' - ' . ($pending->homestay->nama_homestay ?? 'Homestay'),
                'time' => $pending->created_at->diffForHumans(),
                'created_at' => $pending->created_at
            ];
        }

        // Urutkan berdasarkan waktu terbaru dan ambil 6 aktivitas terbaru
        usort($activities, function($a, $b) {
            return $b['created_at'] <=> $a['created_at'];
        });

        return array_slice($activities, 0, 6);
    }

    /**
     * Alternatif: Mendapatkan aktivitas dengan query yang lebih efisien
     */
    private function getRecentActivitiesAlternative()
    {
        // Gabungkan semua aktivitas dari berbagai sumber
        $activities = [];

        // Pemesanan dengan berbagai status
        $recentPemesanans = Pemesanan::with(['homestay', 'pelanggan'])
            ->select('pemesanan_id', 'status', 'total_harga', 'homestay_id', 'created_at', 'updated_at')
            ->whereIn('status', ['berhasil', 'menunggu_konfirmasi'])
            ->latest()
            ->take(8)
            ->get();

        foreach ($recentPemesanans as $pemesanan) {
            if ($pemesanan->status === 'berhasil') {
                $activities[] = [
                    'type' => 'pembayaran',
                    'title' => 'Pembayaran Dikonfirmasi',
                    'description' => 'Pemesanan #' . $pemesanan->pemesanan_id . ' - ' . ($pemesanan->homestay->nama_homestay ?? 'Homestay'),
                    'time' => $pemesanan->updated_at->diffForHumans(),
                    'created_at' => $pemesanan->updated_at
                ];
            } else {
                $activities[] = [
                    'type' => 'pemesanan',
                    'title' => 'Pemesanan Baru',
                    'description' => 'Pemesanan #' . $pemesanan->pemesanan_id . ' menunggu konfirmasi',
                    'time' => $pemesanan->created_at->diffForHumans(),
                    'created_at' => $pemesanan->created_at
                ];
            }
        }

        // Homestay baru
        $newHomestays = Homestay::with('pemilik')
            ->select('homestay_id', 'nama_homestay', 'pemilik_id', 'created_at')
            ->latest()
            ->take(3)
            ->get();

        foreach ($newHomestays as $homestay) {
            $activities[] = [
                'type' => 'homestay',
                'title' => 'Homestay Baru Terdaftar',
                'description' => $homestay->nama_homestay . ' oleh ' . ($homestay->pemilik->name ?? 'Pemilik'),
                'time' => $homestay->created_at->diffForHumans(),
                'created_at' => $homestay->created_at
            ];
        }

        // Pemilik baru
        $newOwners = User::where('role', 'pemilik')
            ->select('id', 'name', 'created_at')
            ->latest()
            ->take(2)
            ->get();

        foreach ($newOwners as $owner) {
            $activities[] = [
                'type' => 'pemilik',
                'title' => 'Pemilik Baru Bergabung',
                'description' => $owner->name . ' terdaftar sebagai pemilik homestay',
                'time' => $owner->created_at->diffForHumans(),
                'created_at' => $owner->created_at
            ];
        }

        // Urutkan berdasarkan waktu terbaru dan ambil 6 aktivitas terbaru
        usort($activities, function($a, $b) {
            return $b['created_at'] <=> $a['created_at'];
        });

        return array_slice($activities, 0, 6);
    }
}