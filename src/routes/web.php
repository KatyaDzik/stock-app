<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(["guest:web", "guest:admin"])->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login-page');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
});

Route::middleware("auth:web")->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/home', function () {
        return view('user/home');
    })->name('home');

    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'getAll'])->name('products');
    Route::resource('products', \App\Http\Controllers\ProductController::class)->only([
        'store',
        'show',
        'update',
        'destroy'
    ]);

    Route::get('/invoices', [\App\Http\Controllers\InvoiceController::class, 'getAll'])->name('invoices');
    Route::resource('/invoices', \App\Http\Controllers\InvoiceController::class)->only([
        'store',
        'show',
        'update',
        'destroy'
    ]);

    Route::delete('/product/has/invoices/{id}',
        [\App\Http\Controllers\ProductHasInvoicesController::class, 'destroy'])->name('delete.product.from.invoice');
    Route::post('/product/has/invoices',
        [\App\Http\Controllers\ProductHasInvoicesController::class, 'store'])->name('add.product.to.invoice');
    Route::put('/product/has/invoices/{id}',
        [\App\Http\Controllers\ProductHasInvoicesController::class, 'update'])->name('update.product.from.invoice');

    Route::get('/stocks', [\App\Http\Controllers\StockController::class, 'getAll'])->name('stocks');
    Route::resource('/stocks', \App\Http\Controllers\StockController::class)->only([
        'store',
        'update',
        'destroy'
    ]);

    Route::get('/product/has/stocks/{id}',
        [\App\Http\Controllers\ProductHasStocksController::class, 'getAll'])->name('get.product.from.stock');
    Route::post('/product/has/stocks',
        [\App\Http\Controllers\ProductHasStocksController::class, 'store'])->name('add.product.to.stock');
    Route::put('/product/has/stocks/{id}',
        [\App\Http\Controllers\ProductHasStocksController::class, 'update'])->name('update.product.from.stock');
    Route::delete('/product/has/stocks/{id}',
        [\App\Http\Controllers\ProductHasStocksController::class, 'destroy'])->name('delete.product.from.stock');
});
Route::get('/create', function () {

});
//    \App\Models\ProductHasInvoices::create([
//        'count' => 600,
//        'price' => 14.00,
//        'nds' => 0.2,
//        'product_id' => 1,
//        'invoice_id' => 1
//
//    ]);
//
//    \App\Models\ProductHasInvoices::create([
//        'count' => 200,
//        'price' => 8.00,
//        'nds' => 0.2,
//        'product_id' => 7,
//        'invoice_id' => 1
//    ]);
//});
