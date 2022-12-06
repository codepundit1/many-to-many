<?php

use App\Http\Controllers\PrivateImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicImageController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
// Products
Route::resource('products', ProductController::class);
Route::get('products/{product}/assign-supplier', [ProductController::class, 'assignSupplierForm'])->name('products.assign-supplier.form');
Route::post('products/{product}/assign-supplier', [ProductController::class, 'assignSupplier'])->name('products.assign-supplier');
Route::delete('products/{product}/supplier/{supplier}/remove', [ProductController::class, 'removeSupplier'])
    ->name('products.remove-supplier');

// Suppliers
Route::resource('suppliers', SupplierController::class);
Route::get('suppliers/{supplier}/assign-product', [SupplierController::class, 'assignProductForm'])->name('suppliers.assign-product.form');
Route::post('suppliers/{supplier}/assign-product', [SupplierController::class, 'assignProduct'])->name('suppliers.assign-product');
Route::delete('suppliers/{supplier}/product/{product}/remove', [SupplierController::class, 'removeProduct'])
    ->name('suppliers.remove-product');

Route::resource('public-images', PublicImageController::class)
    ->parameters(['public-images' => 'publicImage'])
    ->except('show');

Route::resource('private-images', PrivateImageController::class)
    ->parameters(['private-images' => 'privateImage'])
    ->except('show');

Route::get('private-images/{privateImage}/image', [PrivateImageController::class, 'privateImage'])->name('private.image');
