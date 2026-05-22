<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\FireTruckController;
use App\Http\Controllers\IncidentController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('stations', StationController::class);
Route::resource('fire-trucks', FireTruckController::class);
Route::resource('incidents', IncidentController::class);
