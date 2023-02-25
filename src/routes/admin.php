<?php

use Illuminate\Support\Facades\Route;


Route::middleware(["guest:web", "guest:admin"])->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login-page');
    Route::post('/login', [\App\Http\Controllers\AdminAuthController::class, 'login'])->name('login');
});


Route::middleware("auth:admin")->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/home', [\App\Http\Controllers\UserController::class, 'getAll'])->name('main-panel-page');
    Route::get('/settings', function () {
        return view('admin/settings');
    })->name('settings');
    Route::post('/create/user', [\App\Http\Controllers\AuthController::class, 'register'])->name('create-user');
});



