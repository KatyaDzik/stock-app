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

//Route::get('/test', [App\Http\Controllers\TestController::class, 'index']);
//
//
//Route::resource('users', \App\Http\Controllers\UserController::class)->only([
//    'show', 'update', 'destroy'
//]);
//
//Route::resource('products', \App\Http\Controllers\ProductController::class)->only([
//    'store', 'show', 'update', 'destroy'
//]);
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
//    Route::get('/product/{id}', [\App\Http\Controllers\ProductController::class, 'show']);
    Route::get('/products', [\App\Http\Controllers\ProductController::class, 'getAll'])->name('products');
    Route::resource('products', \App\Http\Controllers\ProductController::class)->only([
        'store',
        'show',
        'update',
        'destroy'
    ]);
    Route::resource('/invoices', \App\Http\Controllers\InvoiceController::class)->only([
        'store',
        'show',
        'update',
        'destroy'
    ]);

    Route::get('/invoices', [\App\Http\Controllers\InvoiceController::class, 'getAll'])->name('invoices');
    Route::post('/add/product/to/invoice', [\App\Http\Controllers\InvoiceController::class, 'addProduct'])->name('add.product.to.invoice');

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

Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'getOne']);
