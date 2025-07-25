<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfilePelangganController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Pemilik\PemilikProfileController;
use App\Http\Controllers\Pemilik\HomestayController;
use App\Http\Controllers\Pemilik\KamarController;
use App\Http\Controllers\Pemilik\FasilitasController;
use App\Http\Controllers\Admin\PeraturanController;
use App\Http\Controllers\Pelanggan\PemesananController;
use App\Http\Controllers\Admin\DaftarPemesananController;
use App\Http\Controllers\Pemilik\PemilikPemesananController;

//      HALAMAN UMUM
Route::get('/', [PostController::class, 'show_home'])->name('home');
Route::get('/destinations', [PostController::class, 'show_destinations'])->name('destinations');
Route::get('/packages', [PostController::class, 'show_packages'])->name('packages');
Route::get('/homestays', [PostController::class, 'show_homestays'])->name('homestays');
// Route::get('/homestay/{id}', [PostController::class, 'show_homestay_details'])->name('homestay.details');
Route::get('/homestays', [PostController::class, 'show_homestays'])->name('homestay.index');
Route::get('/homestay/{id}', [PostController::class, 'show_homestay_details'])->name('homestay.details');




//      LOGIN & REGISTER
Route::get('/login', fn () => Auth::check() ? redirect()->route('home') : view('auth.login'))->name('login');
Route::get('/register', fn () => Auth::check() ? redirect()->route('home') : view('auth.register'))->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

//      SOSIAL LOGIN
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('/auth/facebook', [FacebookController::class, 'redirect'])->name('facebook.redirect');
Route::get('/auth/facebook/callback', [FacebookController::class, 'callback'])->name('facebook.callback');

//      LOGOUT
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


//      REDIRECT DASHBOARD (Role-Based)
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



//      ADMIN BUMDES
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
    // Di dalam group admin
Route::get('/pemilik-homestay', [RegisteredUserController::class, 'daftarPemilik'])->name('pemilik.list');

    // Pendaftaran Pemilik Homestay
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

    // nonaktif pemilik
    Route::put('/pemilik/{id}/nonaktifkan', [ProfileController::class, 'nonaktifkan'])->name('admin.nonaktifkan');
    Route::put('/pemilik/{id}/aktifkan', [ProfileController::class, 'aktifkan'])->name('admin.aktifkan');

    

     Route::get('/pemesanan', [DaftarPemesananController::class, 'index'])->name('pemesanan.index');
      Route::patch('/pemesanan/{id}/update-status', [DaftarPemesananController::class, 'updateStatus'])->name('pemesanan.updateStatus');
       Route::get('/pemesanan/{id}', [DaftarPemesananController::class, 'show'])->name('pemesanan.show');


       // Fasilitas 
       Route::resource('fasilitas', FasilitasController::class)->names([
        'index' => 'fasilitas.index',
        'create' => 'fasilitas.create',
        'store' => 'fasilitas.store',
        'edit' => 'fasilitas.edit',
        'update' => 'fasilitas.update',
        'destroy' => 'fasilitas.destroy'
    ]);
       // Peraturan
    Route::resource('peraturan', PeraturanController::class);
});

// PEMILIK HOMESTAY
Route::middleware(['auth', 'verified', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', fn () => view('pemilik.dashboard'))->name('dashboard');
    
    // Profile Pemilik
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [PemilikProfileController::class, 'show'])->name('show');
        Route::get('/edit', [PemilikProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [PemilikProfileController::class, 'update'])->name('update');
        Route::get('/create', [PemilikProfileController::class, 'create'])->name('create');
        Route::post('/store', [PemilikProfileController::class, 'store'])->name('store');
    });
 
    // homestay route
    Route::resource('homestay', HomestayController::class)->names([
        'index' => 'homestay.index',
        'create' => 'homestay.create',
        'store' => 'homestay.store',
        'edit' => 'homestay.edit',
        'update' => 'homestay.update',
        'destroy' => 'homestay.destroy'
    ]);

    // Pemesanan routes - Fixed version
    Route::prefix('pemesanan')->name('pemesanan.')->group(function() {
        Route::get('/', [PemilikPemesananController::class, 'index'])->name('index');
        Route::get('/{id}', [PemilikPemesananController::class, 'show'])->name('show');
        Route::patch('/{id}/status', [PemilikPemesananController::class, 'updateStatus'])->name('updateStatus');
    });

    // Kamar Routes
    Route::resource('kamar', KamarController::class)->names([
        'index' => 'kamar.index',
        'create' => 'kamar.create',
        'store' => 'kamar.store',
        'edit' => 'kamar.edit',
        'update' => 'kamar.update',
        'destroy' => 'kamar.destroy'
    ]);

    Route::resource('jenis-kamar', \App\Http\Controllers\Pemilik\JenisKamarController::class)->names([
        'index' => 'jenis-kamar.index',
        'create' => 'jenis-kamar.create',
        'store' => 'jenis-kamar.store',
        'edit' => 'jenis-kamar.edit',
        'update' => 'jenis-kamar.update',
        'destroy' => 'jenis-kamar.destroy'
    ]);
});


// PELANGGAN
Route::middleware(['auth'])->prefix('pelanggan')->name('pelanggan.')->group(function() {
    Route::get('pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('pemesanan/store', [PemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('pemesanan/success', [PemesananController::class, 'success'])->name('pemesanan.success');
    Route::get('pemesanan/{id}/pembayaran', [PemesananController::class, 'showPembayaranForm'])->name('pemesanan.pembayaran');
    Route::post('pemesanan/{id}/upload-bukti', [PemesananController::class, 'uploadBuktiTransfer'])->name('pemesanan.uploadBukti');
   

});
require __DIR__ . '/auth.php';
