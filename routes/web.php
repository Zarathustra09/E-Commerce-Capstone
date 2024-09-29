<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingPageController::class, 'index']);

Route::get('/shop', [ShopController::class, 'index']);
Route::post('/shop/filter', [ShopController::class, 'filter'])->name('shop.filter');

Auth::routes();


Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/checkout', [CartController::class, 'index'])->name('checkout');

Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/datatable', [ProductController::class, 'dataTable'])->name('product.datatable');
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::post('/product', [ProductController::class, 'store']);
Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
Route::put('/product/{id}', [ProductController::class, 'update']);
Route::delete('/product/{id}', [ProductController::class, 'destroy']);
Route::get('/categories', [ProductController::class, 'getCategories']);


Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/datatable', [CategoryController::class, 'dataTable'])->name('category.datatable');
Route::post('/category', [CategoryController::class, 'store']);
Route::get('/category/{id}/edit', [CategoryController::class, 'edit']);
Route::put('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);




Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
Route::get('/invoice/{invoiceId}', [PaymentController::class, 'getInvoiceDetails'])->name('invoice.details');

