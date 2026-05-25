<?php

use App\Http\Controllers\ClaimController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Utama / Landing Page (Sebelum Login)
Route::get('/', function () {
    return view('welcome');
});

// 2. Kelompok Halaman Dashboard (Setelah Login)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// 3. Kelompok Route untuk Manajemen Makanan (Foods)
Route::prefix('foods')->name('foods.')->group(function () {
    Route::get('/', [FoodController::class, 'index'])->name('index');          // Tampil semua makanan
    Route::get('/create', [FoodController::class, 'create'])->name('create');    // Form tambah makanan
    Route::post('/', [FoodController::class, 'store'])->name('store');         // Proses simpan makanan baru
    Route::get('/{food}/edit', [FoodController::class, 'edit'])->name('edit');   // Form edit makanan
    Route::put('/{food}', [FoodController::class, 'update'])->name('update');    // Proses simpan perubahan
    Route::delete('/{food}', [FoodController::class, 'destroy'])->name('destroy'); // Proses hapus makanan
});

// 4. Kelompok Route untuk Klaim Makanan (Claims)
Route::prefix('claims')->name('claims.')->group(function () {
    Route::get('/', [ClaimController::class, 'index'])->name('index');          // Tampil riwayat klaim
    Route::post('/{food}', [ClaimController::class, 'store'])->name('store');    // Proses melakukan klaim makanan
    Route::put('/{claim}/status', [ClaimController::class, 'updateStatus'])->name('updateStatus'); // Donor menyetujui/menolak klaim
}); 