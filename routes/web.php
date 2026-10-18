<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

// Halaman Publik
Route::get('/', [MenuController::class, 'index'])->name('home');
Route::post('/checkout', [MenuController::class, 'checkout'])->name('checkout');
Route::get('/riwayat', [MenuController::class, 'riwayat'])->name('riwayat');

// Halaman Auth Login Admin
Route::get('/login', [MenuController::class, 'showLoginForm'])->name('login');
Route::post('/login', [MenuController::class, 'login'])->name('login.post');

// Halaman Khusus Admin (Wajib Login, jika belum login otomatis diarahkan ke /login)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [MenuController::class, 'admin'])->name('admin');
    Route::post('/admin/order/{id}/status', [MenuController::class, 'updateStatus'])->name('admin.updateStatus');
});