<?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\DepartemenController;
// use App\Http\Controllers\JabatanController;
// use App\Http\Controllers\JenisCutiController;
// use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('users.dashboard');
//     })->name('dashboard');

//     Route::get('/history', function () {
//         return view('users.history');
//     })->name('history');

//     Route::get('/pengajuan', function () {
//         return view('users.pengajuan');
//     })->name('pengajuan');
// });

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
// });



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';


// Route::prefix('admin')->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
//     Route::get('/users/create', [UserController::class, 'create'])->name('admin.user.create');
//     Route::post('/users', [UserController::class, 'store'])->name('admin.user.store');
//     Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
//     Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.user.update');
//     Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
// });

// Route::get('/admin/users/export', [UserController::class, 'export'])->name('admin.users.export');

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('departemen', DepartemenController::class);
// });
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('jabatan', JabatanController::class);
// });

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('jenis_cuti', JenisCutiController::class);
// });

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/cuti/pengajuan', [DashboardController::class, 'pengajuanCuti'])->name('cuti.pengajuan');

// // Rute untuk mengajukan cuti
// Route::post('/cuti/ajukan', [DashboardController::class, 'ajukanCuti'])->name('cuti.ajukan');

// Route::get('/cuti/riwayat', [DashboardController::class, 'riwayatCuti'])->name('cuti.riwayat');

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisCutiController;
use App\Http\Controllers\DashboardController;
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

    // Manajemen user
    Route::resource('users', UserController::class);
    Route::get('/users/export', [UserController::class, 'export'])->name('users.export');

    // Manajemen departemen
    Route::resource('departemen', DepartemenController::class);

    // Manajemen jabatan
    Route::resource('jabatan', JabatanController::class);

    // Manajemen jenis cuti
    Route::resource('jenis_cuti', JenisCutiController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
});

Route::patch('/admin/cuti/{id}', [DashboardController::class, 'updateCuti'])->name('admin.cuti.update');
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/cuti/{status}', [DashboardController::class, 'adminCuti'])->name('cuti');
});

Route::patch('/admin/cuti/{id}', [DashboardController::class, 'updateCuti'])->name('admin.cuti.update');

require __DIR__ . '/auth.php';
