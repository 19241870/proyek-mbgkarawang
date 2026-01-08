<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemerintahController;

/*
|--------------------------------------------------------------------------
| Web Routes – Pemerintah
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Semua route pemerintah pakai dummy auth middleware
Route::middleware('pemerintah.dummy')->group(function () {

    // Dashboard
    Route::get('/dashboard-pemerintah', [PemerintahController::class, 'dashboard'])
        ->name('pemerintah.dashboard');

    // Monitoring sekolah
    Route::get('/monitoring-pemerintah', [PemerintahController::class, 'monitoring'])
        ->name('pemerintah.monitoring');

    // Laporan harian
    Route::get('/laporan-pemerintah', [PemerintahController::class, 'laporan'])
        ->name('pemerintah.laporan');

    // Keluhan
    Route::get('/keluhan-pemerintah', [PemerintahController::class, 'keluhan'])
        ->name('pemerintah.keluhan');

    // Kelola menu
    Route::get('/menu-pemerintah', [PemerintahController::class, 'menu'])
        ->name('pemerintah.menu');

    // Manajemen sekolah
    Route::get('/manajemen-sekolah', [PemerintahController::class, 'manajemenSekolah'])
        ->name('pemerintah.sekolah');

});
    