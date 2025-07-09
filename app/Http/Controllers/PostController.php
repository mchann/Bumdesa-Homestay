<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Menampilkan halaman Home
    public function show_home()
    {
        return view('page.home', ['title' => 'Home']);
    }

    // Menampilkan halaman Destinations
    public function show_destinations()
    {
        return view('page.destinations', ['title' => 'Destinations']);
    }

    // Menampilkan halaman Packages
    public function show_packages()
    {
        return view('page.packages', ['title' => 'Packages']);
    }

    // Menampilkan halaman Ijen Crater
    public function ijenCrater()
    {
        return view('page.destinations.ijencrater', ['title' => 'Ijen Crater']);
    }

    // Menampilkan halaman Gandrung Park
    public function gandrungPark()
    {
        return view('page.destinations.gandrung', ['title' => 'Gandrung Park']);
    }

    // Menampilkan halaman Sendang Seruni
    public function sendangSeruni()
    {
        return view('page.destinations.sendang', ['title' => 'Sendang Seruni']);
    }

    // Menampilkan daftar Homestays dengan pencarian
    public function show_homestays(Request $request)
{
    // Mengambil query pencarian dan sorting dari input
    $searchQuery = $request->input('search');
    $sortOption = $request->input('sort', 'recommended');

    // Membuat query dasar
    $query = Homestay::with('kamar');

    // Jika ada query pencarian, filter homestay
    if ($searchQuery) {
        $query->where(function ($query) use ($searchQuery) {
            $query->where('nama_homestay', 'like', '%' . $searchQuery . '%')
                  ->orWhere('alamat_homestay', 'like', '%' . $searchQuery . '%');
        });
    }

    // Menambahkan sorting berdasarkan pilihan
    switch ($sortOption) {
        case 'price_low':
            $query->leftJoin('kamars', 'homestays.id', '=', 'kamars.homestay_id')
                 ->select('homestays.*')
                 ->orderBy('kamars.harga', 'asc')
                 ->groupBy('homestays.id');
            break;
            
        case 'price_high':
            $query->leftJoin('kamars', 'homestays.id', '=', 'kamars.homestay_id')
                 ->select('homestays.*')
                 ->orderBy('kamars.harga', 'desc')
                 ->groupBy('homestays.id');
            break;
            
        case 'top_rated':
            // Asumsi ada kolom 'rating' di tabel homestays
            $query->orderBy('rating', 'desc');
            break;
            
        case 'distance':
            // Asumsi ada kolom 'jarak_dari_pusat' di tabel homestays
            $query->orderBy('jarak_dari_pusat', 'asc');
            break;
            
        default: // recommended
            $query->orderBy('created_at', 'desc');
    }

    // Eksekusi query dengan pagination
    $homestays = $query->paginate(6);

    // Kirimkan data ke view
    return view('page.homestays', [
        'title' => 'Homestays',
        'homestays' => $homestays,
        'searchQuery' => $searchQuery,
        'sortOption' => $sortOption
    ]);
}

public function show_homestay_details($id, Request $request)
{
    abort_if(empty($id), 404, 'ID Homestay tidak valid');

    $homestay = Homestay::with('kamar')->findOrFail($id);

    $checkIn = $request->input('check_in');
    $checkOut = $request->input('check_out');
    $dewasa = $request->input('dewasa', 2);
    $anak = $request->input('anak', 0);
    $totalTamu = $dewasa + $anak;

    $kamarGrouped = collect();

    if ($checkIn && $checkOut) {
        $kamarQuery = $homestay->kamar()
            ->where('status', 'tersedia')
            ->where('kapasitas', '>=', $totalTamu)
            ->whereDoesntHave('pemesanan', function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) {
                    $q->whereIn('status', ['berhasil', 'menunggu_konfirmasi'])
                      ->orWhere(function ($q2) {
                          $q2->where('status', 'pending')
                             ->where('batas_pembayaran', '>', now());
                      });
                })
                ->where(function ($q3) use ($checkIn, $checkOut) {
                    $q3->where('tgl_check_in', '<', $checkOut)
                        ->where('tgl_check_out', '>', $checkIn);
                });
            });

        $kamarList = $kamarQuery->get();
        $kamarGrouped = $kamarList->groupBy('nama_kamar');
    } else {
        $kamarGrouped = $homestay->kamar->groupBy('nama_kamar');
    }

    return view('page.homestay_detail', [
        'homestay' => $homestay,
        'kamarGrouped' => $kamarGrouped,
        'checkIn' => $checkIn,
        'checkOut' => $checkOut,
        'dewasa' => $dewasa,
        'anak' => $anak,
    ]);
}



}