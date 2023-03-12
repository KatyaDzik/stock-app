<?php

use App\Repositories\InvoiceRepository;
use App\Repositories\ProductRepository;
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
});

Route::middleware(['auth:web', 'access.products'])->group(function () {
    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'getAll'])->name('products');
    Route::resource('products', \App\Http\Controllers\ProductController::class)->only([
        'store',
        'show',
        'update',
        'destroy'
    ]);
});

Route::middleware(['auth:web', 'access.invoices'])->group(function () {
    Route::get('/invoices', [\App\Http\Controllers\InvoiceController::class, 'getAll'])->name('invoices');
    Route::resource('/invoices', \App\Http\Controllers\InvoiceController::class)->only([
        'store',
        'show',
        'update',
        'destroy'
    ]);
    Route::get('/invoices/{id}/manage/incoming/products', [\App\Http\Controllers\ProductHasInvoicesController::class, 'getAllIncomingProducts'])->name('manage.incoming.products');
    Route::post('/invoices/{id}/manage/incoming/products', [\App\Http\Controllers\ProductHasInvoicesController::class, 'storeIncomingProducts'])->name('manage.incoming.products.store');


//    Route::delete('/product/has/invoices/{id}',
//        [\App\Http\Controllers\ProductHasInvoicesController::class, 'destroy'])->name('delete.product.from.invoice');
//    Route::post('/product/has/invoices/{id}',
//        [\App\Http\Controllers\ProductHasInvoicesController::class, 'store'])->name('add.products.to.invoice');
//    Route::put('/product/has/invoices/{id}',
//        [\App\Http\Controllers\ProductHasInvoicesController::class, 'update'])->name('update.product.from.invoice');
});

Route::middleware(['auth:web', 'access.stocks'])->group(function () {
    Route::get('/stocks', [\App\Http\Controllers\StockController::class, 'getAll'])->name('stocks');
    Route::resource('/stocks', \App\Http\Controllers\StockController::class)->only([
        'store',
        'update',
        'destroy'
    ]);

    Route::get('/providers', [\App\Http\Controllers\ProviderController::class, 'getAll'])->name('providers');
    Route::resource('/providers', \App\Http\Controllers\ProviderController::class)->only([
        'store',
        'show',
        'update',
        'destroy'
    ]);

    Route::get('/product/has/stocks/{id}',
        [\App\Http\Controllers\ProductHasStocksController::class, 'getAllFromStock'])->name('get.product.from.stock');
    Route::post('/product/has/stocks',
        [\App\Http\Controllers\ProductHasStocksController::class, 'store'])->name('add.product.to.stock');
    Route::post('/product/has/stocks/from/received/goods/{id}',
        [
            \App\Http\Controllers\ProductHasStocksController::class,
            'storeReceivedGoods'
        ])->name('add.product.to.stock.from.received.goods');
    Route::put('/product/has/stocks/{id}',
        [\App\Http\Controllers\ProductHasStocksController::class, 'update'])->name('update.product.from.stock');
    Route::delete('/product/has/stocks/{id}',
        [\App\Http\Controllers\ProductHasStocksController::class, 'destroy'])->name('delete.product.from.stock');

    Route::get('/received/goods',
        [\App\Http\Controllers\ReceiptOfProductsController::class, 'getAll'])->name('get.product.for.stock');
    Route::delete('/received/goods/{id}',
        [\App\Http\Controllers\ReceiptOfProductsController::class, 'destroy'])->name('delete.product.for.stock');
});


Route::get('/create', function () {
    dd(\App\Models\Product::where('provider_id', 2)->where('name', 'эд вуд')->first());
});




