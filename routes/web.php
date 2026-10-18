<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\DestinasiController as AdminDestinasi;
use App\Http\Controllers\Admin\KategoriController as AdminKategori;
use App\Http\Controllers\Admin\LaporanController as AdminLaporan;
use App\Http\Controllers\Admin\LaporanDestinasiController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\GeminiController;

// Auth Routes (Login, Register, Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public / Landing Page 
Route::get('/', [AuthController::class, 'showLogin'])->name('home');

// Authenticated User Routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/ai/chat', [GeminiController::class, 'chat'])->name('ai.chat');
    Route::get('/destinasi', [UserController::class, 'destinasi'])->name('destinasi');
    Route::get('/destinasi/{id}', [UserController::class, 'detail'])->name('destinasi.detail');
    Route::get('/kategori', [UserController::class, 'kategori'])->name('kategori');
    Route::get('/wishlist', [UserController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/toggle/{id}', [UserController::class, 'toggleWishlist'])->name('wishlist.toggle');
    Route::post('/destinasi/{id}/review', [UserController::class, 'storeReview'])->name('review.store');
    
    // Rute Upload Galeri Foto & Video
    Route::post('/destinasi/{id}/galeri', [UserController::class, 'storeGaleri'])->name('galeri.store');
    
    // Rute Laporan Destinasi
    Route::post('/destinasi/{id}/report', [UserController::class, 'storeReport'])->name('destinasi.report');
    
    Route::get('/pengaturan', [UserController::class, 'pengaturan'])->name('pengaturan');
    Route::put('/pengaturan/profile', [UserController::class, 'updateProfile'])->name('pengaturan.profile');
    Route::post('/pengaturan/bug', [UserController::class, 'storeBug'])->name('pengaturan.bug');
});

// Admin Routes Panel
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    Route::get('/users', [AdminDashboard::class, 'usersIndex'])->name('users.index');
    Route::get('/reviews', [AdminDashboard::class, 'reviewsIndex'])->name('reviews.index');
    Route::get('/laporan-pending', [AdminDashboard::class, 'laporanPendingIndex'])->name('laporan.pending');

    Route::resource('/destinasi', AdminDestinasi::class);
    
    Route::get('/kategori', [AdminKategori::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [AdminKategori::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [AdminKategori::class, 'store'])->name('kategori.store');

    // Route Laporan User (Detail & Update Konfirmasi)
    Route::get('/laporan', [AdminLaporan::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{id}', [AdminLaporan::class, 'show'])->name('laporan.show');
    Route::put('/laporan/{id}', [AdminLaporan::class, 'update'])->name('laporan.update');

    Route::get('/laporan-destinasi', [LaporanDestinasiController::class, 'index'])->name('laporan-destinasi.index');
    Route::delete('/laporan-destinasi/{id}', [LaporanDestinasiController::class, 'destroy'])->name('laporan-destinasi.destroy');

    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan/profile', [PengaturanController::class, 'updateProfile'])->name('pengaturan.profile');
    Route::put('/pengaturan/password', [PengaturanController::class, 'updatePassword'])->name('pengaturan.password');
    Route::put('/pengaturan/theme', [PengaturanController::class, 'updateTheme'])->name('pengaturan.theme');
});