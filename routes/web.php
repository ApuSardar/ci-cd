<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('products', ProductController::class);
// Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
 Route::get('/products/update-discount', [ProductController::class, 'updateAllProducts'])->name('products.update-discount');
