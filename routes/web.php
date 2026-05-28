<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ClaimController;

use Illuminate\Support\Facades\Route;

// Halaman dashboard default bawaan Breeze (Bisa dipakai Admin sementara waktu)
Route::get('/', function () {
    return view('welcome');
});

// Semua rute di bawah ini wajib LOGIN dulu baru bisa diakses
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// RUTE UTAMA KAMU: Kelola Makanan (Donor)
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Foods (Donor)
    Route::resource('foods', FoodController::class);

    // Claims (Receiver)
    Route::resource('claims', ClaimController::class);

});

require __DIR__.'/auth.php';