<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/users/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/users/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'access.products'])->group(function () {
    Route::get('/products', [\App\Http\Controllers\Api\ProductController::class, 'getAll'])->name('products');
    Route::resource('products', \App\Http\Controllers\Api\ProductController::class)->only([
        'store',
        'show',
        'update',
        'destroy'
    ]);
});

Route::middleware(['auth:sanctum', 'access.invoices'])->group(function () {
    Route::get('/invoices', [\App\Http\Controllers\Api\InvoiceController::class, 'getAll'])->name('invoices');
    Route::get('invoices/{invoice}', [\App\Http\Controllers\Api\InvoiceController::class, 'show'])->name('invoices.show');
    Route::post('invoices', [\App\Http\Controllers\Api\InvoiceController::class, 'store'])->name('invoices.store');
    Route::put('invoices/{invoice}', [\App\Http\Controllers\Api\InvoiceController::class, 'update'])->name('invoices.update')->middleware('open.invoice');
    Route::delete('invoices/{invoice}', [\App\Http\Controllers\Api\InvoiceController::class, 'destroy'])->name('invoices.destroy')->middleware('open.invoice');
//
//    Route::get('/invoices/{invoice}/manage/incoming/products', [\App\Http\Controllers\ProductsToIncomingInvoiceController::class, 'getAll'])->name('manage.incoming.products');
//    Route::post('/invoices/{invoice}/manage/incoming/products', [\App\Http\Controllers\ProductsToIncomingInvoiceController::class, 'store'])->name('manage.incoming.products.store')->middleware(['invoice.status.packed', 'open.invoice']);
//    Route::put('/invoices/{invoice}/manage/incoming/products/{product_id}', [\App\Http\Controllers\ProductsToIncomingInvoiceController::class, 'update'])->name('manage.incoming.products.update')->middleware(['invoice.status.packed', 'open.invoice']);
//    Route::delete('/invoices/{invoice}/manage/incoming/products/{product_id}', [\App\Http\Controllers\ProductsToIncomingInvoiceController::class, 'destroy'])->name('manage.incoming.products.destroy')->middleware(['invoice.status.packed', 'open.invoice']);
});
