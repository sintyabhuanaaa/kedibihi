<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Halaman Utama Dinamis
Route::get('/', [UserController::class, 'homepage'])->name('homepage');


// Halaman Semua Produk Dinamis
Route::get('/semua-produk', [UserController::class, 'showAllProducts'])->name('show_all_products');

// Halaman kontak penjual
Route::get('/kontak-penjual', function () {
    return view('user.kontak-penjual');
});

// Halaman About Us (bisa diarahkan ke bagian tertentu di index)
// Route::get('/about-us', function () {
//     return view('user.index'); // atau buat view khusus jika ada
// });

Route::get('/produk/{product}', [UserController::class, 'showDetailProduct'])->name('user.detail_product');
Route::post('/produk/{product}/review', [UserController::class, 'storeReview'])->name('review.store');
