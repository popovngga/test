<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'validate.token'], 'prefix' => '{user:token}'], function () {
    Route::get('/', [LinkController::class, 'showLinkPage'])->name('link');
    Route::get('/history', [LinkController::class, 'showHistoryPage'])->name('link.history');
    Route::post('/lucky', [LinkController::class, 'lucky'])->name('link.lucky');
    Route::delete('/invalidate', [LinkController::class, 'invalidate'])->name('link.invalidate');
    Route::patch('/renew', [LinkController::class, 'renew'])->name('link.renew');
});
