<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use Illuminate\Http\Request;
use App\Models\UmkmProduct;

class PostController extends Controller
{
    // Menampilkan halaman Home
    public function show_home()
    {
        $homestays = Homestay::with('kamar')->latest()->get();

        return view('page.home', [
            'title' => 'Home',
            'homestays' => $homestays,
        ]);
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

    // Menampilkan halaman UMKM dengan filter dan pencarian
    public function show_umkm(Request $request)
    {
        $query = UmkmProduct::active();

        // Filter kategori
        if ($request->has('kategori') && $request->kategori != 'semua') {
            $query->byCategory($request->kategori);
        }

        // Pencarian
        if ($request->has('search') && $request->search != '') {
            $query->search($request->search);
        }

        $products = $query->latest()->get();
        $categories = UmkmProduct::active()->distinct()->pluck('kategori');

        return view('page.umkm', [
            'title' => 'UMKM',
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $request->kategori ?? 'semua',
            'searchQuery' => $request->search ?? ''
        ]);
    }

    // Menampilkan detail produk UMKM
    public function show_umkm_detail($slug)
    {
        $product = UmkmProduct::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        // Ambil produk terkait dari kategori yang sama
        $relatedProducts = UmkmProduct::where('kategori', $product->kategori)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->limit(4)
            ->get();

        return view('page.detail_umkm', [
            'title' => $product->nama_produk . ' - UMKM',
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }


    // Menampilkan daftar Homestays dengan pencarian
    public function show_homestays(Request $request)
    {
        $searchQuery = $request->input('search');
        $sortOption = $request->input('sort', 'recommended');

        $query = Homestay::with('kamar');

        if ($searchQuery) {
            $query->where(function ($query) use ($searchQuery) {
                $query->where('nama_homestay', 'like', '%' . $searchQuery . '%')
                      ->orWhere('alamat_homestay', 'like', '%' . $searchQuery . '%');
            });
        }

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
                $query->orderBy('rating', 'desc');
                break;

            case 'distance':
                $query->orderBy('jarak_dari_pusat', 'asc');
                break;

            default:
                $query->orderBy('created_at', 'desc');
        }

        $homestays = $query->paginate(6);

        return view('page.homestays', [
            'title' => 'Homestays',
            'homestays' => $homestays,
            'searchQuery' => $searchQuery,
            'sortOption' => $sortOption
        ]);
    }

    // Menampilkan detail Homestay dan ketersediaan kamar
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
