<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisCutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanCutiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk pengguna yang telah login
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard user
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Riwayat cuti user
    Route::get('/cuti/riwayat', [DashboardController::class, 'riwayatCuti'])->name('cuti.riwayat');

    // Pengajuan cuti user
    Route::get('/cuti/pengajuan', [DashboardController::class, 'pengajuanCuti'])->name('cuti.pengajuan');
    Route::post('/cuti/ajukan', [DashboardController::class, 'ajukanCuti'])->name('cuti.ajukan');

    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute khusus untuk admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Manajemen cuti
    Route::get('/cuti', [DashboardController::class, 'adminCuti'])->name('cuti.index');
    Route::get('/cuti/{status}', [DashboardController::class, 'adminCuti'])->name('cuti.status');
    Route::put('/cuti/{id}/update-status', [DashboardController::class, 'updateCuti'])->name('cuti.update-status');

    // Manajemen user
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/export', [UserController::class, 'export'])->name('user.export');

    // Manajemen departemen
    Route::resource('departemen', DepartemenController::class);

    // Manajemen jabatan
    Route::resource('jabatan', JabatanController::class);

    // Manajemen jenis cuti
    Route::resource('jenis_cuti', JenisCutiController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/laporan-cuti', [LaporanCutiController::class, 'index'])->name('admin.laporan.cuti');
    Route::get('/admin/laporan-cuti/export', [LaporanCutiController::class, 'export'])->name('admin.laporan.cuti.export');
});

require __DIR__ . '/auth.php';
