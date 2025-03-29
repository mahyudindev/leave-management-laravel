<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisCutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\Admin\CutiController as AdminCutiController;
use App\Http\Controllers\LaporanCutiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rute khusus untuk admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen cuti
    Route::get('/cuti', [CutiController::class, 'adminCuti'])->name('cuti.index');
    Route::get('/cuti/{status}', [CutiController::class, 'adminCuti'])->name('cuti.status');
    Route::put('/cuti/{id}/update-status', [CutiController::class, 'updateCuti'])->name('cuti.update-status');

    // Laporan cuti
    Route::get('/laporan-cuti', [LaporanCutiController::class, 'index'])->name('laporan.cuti');
    Route::get('/laporan-cuti/export', [LaporanCutiController::class, 'export'])->name('laporan.cuti.export');

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

// Rute untuk pengguna yang telah login
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard user
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Riwayat cuti user
    Route::get('/cuti/riwayat', [CutiController::class, 'riwayatCuti'])->name('cuti.riwayat');

    // Pengajuan cuti user
    Route::get('/cuti/pengajuan', [CutiController::class, 'pengajuanCuti'])->name('cuti.pengajuan');
    Route::post('/cuti/ajukan', [CutiController::class, 'ajukanCuti'])->name('cuti.ajukan');

    // Profil user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
