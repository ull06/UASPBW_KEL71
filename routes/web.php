<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;

use Illuminate\Support\Facades\Route;

// Halaman dashboard default bawaan Breeze
Route::get('/', function () {
    return view('welcome');
});

// Semua rute di bawah ini wajib LOGIN dulu baru bisa diakses
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// RUTE UTAMA JALUR LOGIN
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Foods (Donor)
    Route::resource('foods', FoodController::class);

    // Claims (Receiver)
    Route::get('/claim-history',[ClaimController::class, 'history'])
    ->name('claims.history');
    Route::resource('claims', ClaimController::class);

    // Admin
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/claims', [AdminController::class, 'claims'])->name('admin.claims');
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('admin.analytics');
        });

});
require __DIR__.'/auth.php';