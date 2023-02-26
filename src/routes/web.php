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
});
