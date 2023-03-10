<?php

use Illuminate\Support\Facades\Route;


Route::middleware(["guest:web", "guest:admin"])->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login-page');
    Route::post('/login', [\App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('login');
});


Route::middleware("auth:admin")->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/home', [\App\Http\Controllers\Admin\UserController::class, 'getAll'])->name('main-panel-page');
    Route::get('/settings', function () {
        return view('admin/settings');
    })->name('settings');
    Route::post('/user', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('create-user');
    Route::get('/user/{id}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('read-user');
    Route::put('/user/{id}/permissions',
        [\App\Http\Controllers\Admin\UserController::class, 'changePermissions'])->name('update-user-permissions');
});
