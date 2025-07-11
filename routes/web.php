<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::group(['prefix' => '{token}'], function () {
    Route::get('/', [TokenController::class, 'show'])->name('token');
    Route::delete('/', [TokenController::class, 'delete'])->name('token.delete');
    Route::post('/', [TokenController::class, 'store'])->name('token.store');
    Route::get('/history', [TokenController::class, 'showHistoryPage'])->name('token.history');
    Route::get('/user-history', [TokenController::class, 'showUserHistoryPage'])->name('token.user.history');
    Route::post('/lucky', [TokenController::class, 'lucky'])->name('token.lucky');
});
