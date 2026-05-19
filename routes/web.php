<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Warga\LaporanController as WargaLaporanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\Admin\KategoriController as AdminKategoriController;
use App\Http\Controllers\Admin\PetugasController as AdminPetugasController;
use App\Http\Controllers\Petugas\LaporanController as PetugasLaporanController;

Route::get('/', function () {
    return view('welcome');
});

// WARGA
Route::middleware(['auth', 'role:warga'])->prefix('warga')->name('warga.')->group(function () {
    Route::resource('laporan', WargaLaporanController::class)->only(['index', 'create', 'store', 'show']);
});

// PETUGAS
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::resource('laporan', PetugasLaporanController::class)->only(['index', 'show']);
    Route::post('laporan/{laporan}/respons', [PetugasLaporanController::class, 'respons'])->name('laporan.respons');
});

// ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', AdminDashboardController::class)->name('dashboard');
    Route::resource('laporan', AdminLaporanController::class)->only(['index', 'show']);
    Route::post('laporan/{laporan}/respons', [AdminLaporanController::class, 'respons'])->name('laporan.respons');
    Route::resource('kategori', AdminKategoriController::class);
    Route::resource('petugas', AdminPetugasController::class);
});

require __DIR__.'/auth.php';