<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PoskoController;
use App\Http\Controllers\ArmadaMobilController;
use App\Http\Controllers\LaporanKejadianController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('poskos', PoskoController::class);
    Route::resource('armada_mobils', ArmadaMobilController::class);
    Route::resource('laporan_kejadians', LaporanKejadianController::class);
});
