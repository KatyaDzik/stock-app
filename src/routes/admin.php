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

    Route::get('/home', function () {
        return view('main-admin-panel');
    })->name('main-panel-page');
});

