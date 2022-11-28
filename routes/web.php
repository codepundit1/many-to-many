<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
// Products
Route::resource('products', ProductController::class);
Route::get('products/{product}/assign-supplier', [ProductController::class, 'assignSupplierForm'])->name('products.assign-supplier.form');
Route::post('products/{product}/assign-supplier', [ProductController::class, 'assignSupplier'])->name('products.assign-supplier');

// Suppliers
Route::resource('suppliers', SupplierController::class);
Route::get('suppliers/{supplier}/assign-product', [SupplierController::class, 'assignProductForm'])->name('suppliers.assign-product.form');
Route::post('suppliers/{supplier}/assign-product', [SupplierController::class, 'assignProduct'])->name('suppliers.assign-product');
