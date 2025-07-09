<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/filter-siswa', [App\Http\Controllers\HomeController::class, 'filterSiswa'])->name('filter.siswa');
Route::get('/filter-guru', [App\Http\Controllers\HomeController::class, 'filterGuru'])->name('filter.guru');

Route::middleware(['auth'])->group(function () {
    Route::resource('siswa', SiswaController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('kelas', KelasController::class);
    Route::get('/guruList', [GuruController::class, 'guruList'])->name('guru.guruList');
});
