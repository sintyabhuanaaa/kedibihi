<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Product;

Route::prefix('admin')->group(function () {

    // Login & Register
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::get('/register', [AdminController::class, 'showRegister'])->name('admin.register');
    Route::post('/register', [AdminController::class, 'register'])->name('admin.register.submit');

    // Halaman admin (butuh login)
    Route::middleware('auth:admin')->group(function () {
        Route::get('/index', [AdminController::class, 'dashboard'])->name('admin.index');
        // Route::get('/produk', [AdminController::class, 'produk'])->name('admin.produk');
        Route::resource('products', ProductController::class);
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });

});
