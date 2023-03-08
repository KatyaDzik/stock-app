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

//Route::resource('categories', \App\Http\Controllers\CategoryController::class)->only([
//    'store',
//    'show',
//    'update',
//    'destroy'
//]);
//
//Route::resource('users', \App\Http\Controllers\UserController::class)->only([
//    'show',
//    'update',
//    'destroy'
//]);


Route::post('/users/register', [\App\Http\Controllers\AuthController::class, 'register']);

Route::post('/users/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::post('/users/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [\App\Http\Controllers\Api\ProductController::class, 'getAll'])->name('products');
    Route::resource('products', \App\Http\Controllers\Api\ProductController::class)->only([
        'store',
        'show',
        'update',
        'destroy'
    ]);
});
