<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Pelanggan\ProfilePelangganController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Pemilik\PemilikProfileController;
use App\Http\Controllers\Pemilik\HomestayController;
use App\Http\Controllers\Pemilik\KamarController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\JenisKamarController;
use App\Http\Controllers\Admin\PeraturanController;
use App\Http\Controllers\Pelanggan\PemesananController;
use App\Http\Controllers\Pelanggan\PaymentController;
use App\Http\Controllers\Admin\DaftarPemesananController;
use App\Http\Controllers\Pemilik\PemilikPemesananController;
use App\Http\Controllers\Pemilik\RoomCloseController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\Admin\ExportExcelController;
use App\Http\Controllers\Pemilik\ExportExcelPemilikController;
use App\Http\Controllers\Admin\ExportPdfController;
use App\Http\Controllers\Pemilik\ExportPdfPemilikController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Pelanggan\UlasanController as PelangganUlasanController; 
use App\Http\Controllers\Admin\UlasanController as AdminUlasanController;
use App\Http\Controllers\Pemilik\UlasanController as PemilikUlasanController;
use App\Http\Controllers\Admin\AdminUmkmController;

// HALAMAN UMUM
Route::get('/', [PostController::class, 'show_home'])->name('home');

// Destinations Routes
Route::prefix('destinations')->group(function () {
    Route::get('/', [PostController::class, 'show_destinations'])->name('destinations');
    Route::get('/ijencrater', [PostController::class, 'ijenCrater'])->name('destinations.ijencrater');
    Route::get('/gandrung', [PostController::class, 'gandrungPark'])->name('destinations.gandrung');
    Route::get('/sendang', [PostController::class, 'sendangSeruni'])->name('destinations.sendang');
    Route::get('/packages', [PostController::class, 'show_packages'])->name('packages');
});

// Route untuk UMKM
Route::get('/umkm', [PostController::class, 'show_umkm'])->name('umkm');
Route::get('/umkm/{slug}', [PostController::class, 'show_umkm_detail'])->name('umkm.detail');

// Homestays Routes
Route::prefix('homestays')->group(function () {
    Route::get('/', [PostController::class, 'show_homestays'])->name('homestay.index');
    Route::get('/{id}', [PostController::class, 'show_homestay_details'])->name('homestay.details');
});

// LOGIN & REGISTER
Route::get('/login', fn () => Auth::check() ? redirect()->route('home') : view('auth.login'))->name('login');
Route::get('/register', fn () => Auth::check() ? redirect()->route('home') : view('auth.register'))->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

// SOSIAL LOGIN
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
Route::get('/auth/facebook', [FacebookController::class, 'redirect'])->name('facebook.redirect');
Route::get('/auth/facebook/callback', [FacebookController::class, 'callback'])->name('facebook.callback');

// LOGOUT
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// REDIRECT DASHBOARD (Role-Based)
Route::match(['get', 'post'], '/dashboard', function () {
    $user = auth()->user();
    return match ($user->role) {
        'admin' => redirect()->route('home'),
        'pemilik' => redirect()->route('home'),
        default => redirect()->route('home'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// PELANGGAN (User Biasa)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/booking', [PostController::class, 'show_booking'])->name('booking');
    Route::get('/pelanggan/profile', [ProfilePelangganController::class, 'show'])->name('pelanggan.profile');
    Route::get('/pelanggan/profile/edit', [ProfilePelangganController::class, 'edit'])->name('pelanggan.profile.edit');
    Route::put('/pelanggan/profile', [ProfilePelangganController::class, 'update'])->name('pelanggan.profile.update');
});

// DOWNLOAD INVOICE ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/pelanggan/invoice/{id}/download/{type?}', [PemesananController::class, 'downloadInvoice'])
        ->name('pelanggan.invoice.download');
});

Route::get('/bayar/{id}', [MidtransController::class, 'bayar'])->name('midtrans.bayar');
// Snap token endpoint (moved to dedicated PaymentController)
Route::get('/snap/token/{id}', [PaymentController::class, 'getSnapToken']);
Route::get('/pemesanan/bayar/{id}', [PemesananController::class, 'bayar'])->name('pelanggan.pemesanan.bayar');
Route::post('/pemesanan/{id}/bayar', [PemesananController::class, 'bayar'])->name('pemesanan.bayar');

// Midtrans server-to-server notification (webhook) - CSRF must be disabled for this route
Route::post('/midtrans/notification', [PaymentController::class, 'notification'])->name('midtrans.notification');
// Endpoint for client to ask server to verify transaction status immediately
Route::post('/snap/verify/{id}', [PaymentController::class, 'verifyStatus'])->name('midtrans.verify');

Route::get('/simulasi-pembayaran/{id}', function ($id) {
    $pemesanan = \App\Models\Pemesanan::findOrFail($id);
    return view('pelanggan.pembayaran.simulasi', compact('pemesanan'));
})->name('simulasi.pembayaran');

Route::get('/pemesanan/{id}/success', [PemesananController::class, 'pembayaranSukses'])->name('pemesanan.success');

// CORRECTED ROUTES (FIX TYPO)
Route::middleware(['auth'])->group(function () {
    Route::get('/history-pemesanan', [PemesananController::class, 'history'])->name('pelanggan.history');
    Route::get('/cek-status-pemesanan', [PemesananController::class, 'cekStatus'])->name('pelanggan.cek-status');
    Route::get('/detail-pemesanan/{id}', [PemesananController::class, 'detail'])->name('pelanggan.pemesanan.detail'); // ✅ FIXED
}); 

// ADMIN BUMDES
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Rute yang benar untuk dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pemilik Homestay
    Route::get('/pemilik-homestay', [RegisteredUserController::class, 'daftarPemilik'])->name('pemilik.list');
    Route::get('/daftarpemilik', fn () => view('admin.daftarpemilik'))->name('pendaftaran.pemilik');
    Route::post('/daftarpemilik', [RegisteredUserController::class, 'storePemilik'])->name('store.pemilik');

    // Profile Admin
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::get('/create', [ProfileController::class, 'create'])->name('create');
        Route::post('/store', [ProfileController::class, 'store'])->name('store');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    });

    // Ulasan
    Route::prefix('ulasan')->name('ulasan.')->group(function () {
        Route::get('/', [AdminUlasanController::class, 'index'])->name('index');
        Route::get('/{ulasan}', [AdminUlasanController::class, 'show'])->name('show');
        Route::post('/{ulasan}/balas', [AdminUlasanController::class, 'reply'])->name('reply');
        Route::post('/{ulasan}/toggle-sembunyi', [AdminUlasanController::class, 'toggleHide'])->name('toggle_hide');
        Route::delete('/{ulasan}', [AdminUlasanController::class, 'destroy'])->name('destroy');
    }); 

    // Aktif/Nonaktif Pemilik
    Route::put('/pemilik/{id}/nonaktifkan', [ProfileController::class, 'nonaktifkan'])->name('admin.nonaktifkan');
    Route::put('/pemilik/{id}/aktifkan', [ProfileController::class, 'aktifkan'])->name('admin.aktifkan');

    // Export
    Route::get('/pemesanan/export-excel', [ExportExcelController::class, 'export'])->name('export.excel');
    Route::get('/pemesanan/export-pdf', [ExportPdfController::class, 'export'])->name('export.pdf');

    // Pemesanan
    Route::get('/pemesanan', [DaftarPemesananController::class, 'index'])->name('pemesanan.index');
    Route::patch('/pemesanan/{id}/update-status', [DaftarPemesananController::class, 'updateStatus'])->name('pemesanan.updateStatus');
    Route::get('/pemesanan/{id}', [DaftarPemesananController::class, 'show'])->name('pemesanan.show');

    // Fasilitas
    Route::resource('admin/fasilitas', FasilitasController::class)->only([
        'index', 'create', 'store', 'destroy'
    ]);

    // Jenis Kamar
    Route::resource('jenis-kamar', JenisKamarController::class)->names([
        'index' => 'jenis-kamar.index',
        'create' => 'jenis-kamar.create',
        'store' => 'jenis-kamar.store',
        'destroy' => 'jenis-kamar.destroy'
    ]);

    // Peraturan
    Route::resource('peraturan', PeraturanController::class);
     // UMKM Products - Admin Routes
    Route::prefix('umkm')->name('umkm.')->group(function () {
        Route::get('/', [AdminUmkmController::class, 'index'])->name('index');
        Route::get('/create', [AdminUmkmController::class, 'create'])->name('create');
        Route::post('/', [AdminUmkmController::class, 'store'])->name('store');
        Route::get('/{umkm}/edit', [AdminUmkmController::class, 'edit'])->name('edit');
        Route::put('/{umkm}', [AdminUmkmController::class, 'update'])->name('update');
        Route::delete('/{umkm}', [AdminUmkmController::class, 'destroy'])->name('destroy');
        Route::put('/{umkm}/status', [AdminUmkmController::class, 'updateStatus'])->name('status');
    });
});

// PEMILIK HOMESTAY
Route::middleware(['auth', 'verified', 'role:pemilik'])
    ->prefix('pemilik')
    ->name('pemilik.')
    ->group(function () {
        Route::get('/dashboard', [DashboardPemilikController::class, 'index'])
            ->name('dashboard');
// Profile Pemilik
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [PemilikProfileController::class, 'show'])->name('show');
        Route::get('/edit', [PemilikProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [PemilikProfileController::class, 'update'])->name('update');
        Route::get('/create', [PemilikProfileController::class, 'create'])->name('create');
        Route::post('/store', [PemilikProfileController::class, 'store'])->name('store');
    });

    // Ulasan
    Route::prefix('ulasan')->name('ulasan.')->group(function () {
        Route::get('/', [PemilikUlasanController::class, 'index'])->name('index');
        Route::get('/{ulasan}', [PemilikUlasanController::class, 'show'])->name('show');
        Route::post('/{ulasan}/balas', [PemilikUlasanController::class, 'reply'])->name('reply');
        Route::post('/{ulasan}/toggle-sembunyi', [PemilikUlasanController::class, 'toggleHide'])->name('toggle_hide');
        Route::delete('/{ulasan}', [PemilikUlasanController::class, 'destroy'])->name('destroy'); 
    });

    // Homestay
    Route::resource('homestay', HomestayController::class)->names([
        'index' => 'homestay.index',
        'create' => 'homestay.create',
        'store' => 'homestay.store',
        'edit' => 'homestay.edit',
        'update' => 'homestay.update',
        'destroy' => 'homestay.destroy'
    ]);

    // Tutup Kamar
    Route::prefix('kamar')->name('room_close.')->group(function () {
        Route::get('{id}/tutup', [RoomCloseController::class, 'create'])->name('create');
        Route::post('tutup', [RoomCloseController::class, 'store'])->name('store');
    });

    // Export
    Route::get('/export-excel', [ExportExcelPemilikController::class, 'export'])->name('export.excel');
    Route::get('/export-pdf', [ExportPdfPemilikController::class, 'export'])->name('export.pdf');

    // Pemesanan
    Route::prefix('pemesanan')->name('pemesanan.')->group(function () {
        Route::get('/', [PemilikPemesananController::class, 'index'])->name('index');
        Route::get('/{id}', [PemilikPemesananController::class, 'show'])->name('show');
        Route::patch('/{id}/status', [PemilikPemesananController::class, 'updateStatus'])->name('updateStatus');
    });

    // Kamar
    Route::resource('kamar', KamarController::class)->names([
        'index' => 'kamar.index',
        'create' => 'kamar.create',
        'store' => 'kamar.store',
        'edit' => 'kamar.edit',
        'update' => 'kamar.update',
        'destroy' => 'kamar.destroy'
    ]);
});

// PELANGGAN (PEMESANAN)
Route::middleware(['auth'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('pemesanan/store', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('pemesanan/success', [PemesananController::class, 'success'])->name('pemesanan.success');
    Route::get('pemesanan/{id}/pembayaran', [PemesananController::class, 'showPembayaranForm'])->name('pemesanan.pembayaran');
    Route::post('pemesanan/{id}/upload-bukti', [PemesananController::class, 'uploadBuktiTransfer'])->name('pemesanan.uploadBukti');
});

// PELANGGAN (History)
Route::middleware(['auth'])->group(function () {
    Route::get('/history-pemesanan', [PemesananController::class, 'history'])->name('pelanggan.history'); 
    Route::get('/cek-status-pemesanan', [PemesananController::class, 'cekStatus'])->name('pelanggan.cek-status');
    Route::get('/detail-pemesanan/{id}', [PemesananController::class, 'detail'])->name('pelanggan.pemesanan.detail'); 
});

// Pelanggan Ulasan
Route::middleware(['auth'])->prefix('ulasan')->name('ulasan.')->group(function () {
    Route::get('/buat-atau-edit/{pemesanan}', [PelangganUlasanController::class, 'createEdit'])->name('create_edit');
    Route::post('/simpan-atau-update/{pemesanan}', [PelangganUlasanController::class, 'storeUpdate'])->name('store_update');
    Route::delete('/hapus/{pemesanan}', [PelangganUlasanController::class, 'destroy'])->name('destroy');
});

require __DIR__ . '/auth.php';
