<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PredictionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Hrd\HrdController;
use App\Http\Controllers\Hrd\HrdKaryawanController;
use App\Http\Controllers\Hrd\HrdManajerController;
use App\Http\Controllers\Manajer\ManajerController;
use App\Http\Controllers\Manajer\ManajerKaryawanController;
use App\Http\Controllers\Penilaian\PenilaianKaryawanController;
use App\Http\Controllers\Penilaian\PenilaianManajerController;
use App\Http\Controllers\Karyawan\KaryawanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/{userId}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{userId}', [UserController::class, 'update'])->name('users.update');
        Route::post('/{userId}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::delete('/{userId}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::put('/{user}', [AdminController::class, 'update'])->name('update');
});

Route::middleware(['auth', 'role:manajer'])->group(function () {
    Route::prefix('manajer')->group(function () {
        // Rute ManajerController
        Route::get('/', [ManajerController::class, 'index'])->name('manajer.index');
        Route::get('/create', [ManajerController::class, 'create'])->name('manajer.create');
        Route::post('/', [ManajerController::class, 'store'])->name('manajer.store');
        Route::get('/{id}/edit', [ManajerController::class, 'edit'])->name('manajer.edit');
        Route::put('/{id}', [ManajerController::class, 'update'])->name('manajer.update');

        // Rute ManajerKaryawanController
        Route::prefix('karyawan')->group(function () {
            Route::get('/', [ManajerKaryawanController::class, 'index'])->name('manajer.karyawan.index');
            Route::get('/create', [ManajerKaryawanController::class, 'create'])->name('manajer.karyawan.create');
            Route::post('/', [ManajerKaryawanController::class, 'store'])->name('manajer.karyawan.store');
            Route::get('/{id}', [ManajerKaryawanController::class, 'show'])->name('manajer.karyawan.show');
            Route::get('/{id}/edit', [ManajerKaryawanController::class, 'edit'])->name('manajer.karyawan.edit');
            Route::put('/{id}', [ManajerKaryawanController::class, 'update'])->name('manajer.karyawan.update');
            Route::put('/{id}/status', [ManajerKaryawanController::class, 'updateStatus'])->name('manajer.karyawan.updateStatus');
            Route::delete('/{id}', [ManajerKaryawanController::class, 'destroy'])->name('manajer.karyawan.destroy');
        });
    });
});

// Penilaian Karyawan Routes
Route::middleware(['auth', 'role:manajer,hrd'])->group(function () {
    Route::get('/penilaian/karyawan', [PenilaianKaryawanController::class, 'index'])->name('penilaian.karyawan.index');
    Route::get('/penilaian/karyawan/show', [PenilaianKaryawanController::class, 'show'])->name('penilaian.karyawan.show');
    Route::post('/penilaian/karyawan', [PenilaianKaryawanController::class, 'store'])->name('penilaian.karyawan.store');
    Route::get('/penilaian/karyawan/create/{karyawan_id}', [PenilaianKaryawanController::class, 'create'])->name('penilaian.karyawan.create');
    Route::get('/penilaian/karyawan/{id}/edit', [PenilaianKaryawanController::class, 'edit'])->name('penilaian.karyawan.edit');
    Route::put('/penilaian/karyawan/{id}', [PenilaianKaryawanController::class, 'update'])->name('penilaian.karyawan.update');
    Route::get('/penilaian/karyawan/{id}/print', [PenilaianKaryawanController::class, 'printPdf'])->name('penilaian.karyawan.print');
    Route::delete('/penilaian/karyawan/{id}', [PenilaianKaryawanController::class, 'destroy'])->name('penilaian.karyawan.destroy');
});

// Penilaian Manajer Routes
Route::middleware(['auth', 'role:hrd'])->group(function () {
    Route::get('/penilaian/manajer', [PenilaianManajerController::class, 'index'])->name('penilaian.manajer.index');
    Route::get('/penilaian/manajer/show', [PenilaianManajerController::class, 'show'])->name('penilaian.manajer.show');
    Route::post('/penilaian/manajer', [PenilaianManajerController::class, 'store'])->name('penilaian.manajer.store');
    Route::get('/penilaian/manajer/create/{manajer_id}', [PenilaianManajerController::class, 'create'])->name('penilaian.manajer.create');
    Route::get('/penilaian/manajer/{id}/edit', [PenilaianManajerController::class, 'edit'])->name('penilaian.manajer.edit');
    Route::put('/penilaian/manajer/{id}', [PenilaianManajerController::class, 'update'])->name('penilaian.manajer.update');
    Route::get('/penilaian/manajer/{id}/print', [PenilaianManajerController::class, 'printPdf'])->name('penilaian.manajer.print');
    Route::delete('/penilaian/manajer/{id}', [PenilaianManajerController::class, 'destroy'])->name('penilaian.manajer.destroy');
});

Route::middleware(['auth', 'role:hrd'])->prefix('hrd')->name('hrd.')->group(function () {
        Route::get('/', [HrdController::class, 'index'])->name('index');
        Route::get('/create', [HrdController::class, 'create'])->name('create');
        Route::post('/', [HrdController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [HrdController::class, 'edit'])->name('edit');
        Route::put('/{id}', [HrdController::class, 'update'])->name('update');

    Route::prefix('karyawan')->group(function () {
        Route::get('/', [HrdKaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('/create', [HrdKaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('/', [HrdKaryawanController::class, 'store'])->name('karyawan.store');
        Route::get('/{id}', [HrdKaryawanController::class, 'show'])->name('karyawan.show');
        Route::get('/{id}/edit', [HrdKaryawanController::class, 'edit'])->name('karyawan.edit');
        Route::put('/{id}', [HrdKaryawanController::class, 'update'])->name('karyawan.update');
        Route::put('/{id}/status', [HrdKaryawanController::class, 'updateStatus'])->name('karyawan.updateStatus');
        Route::delete('/{id}', [HrdKaryawanController::class, 'destroy'])->name('karyawan.destroy');
    });

        Route::prefix('manajer')->group(function () {
        Route::get('/', [HrdManajerController::class, 'index'])->name('manajer.index');
        Route::get('/create', [HrdManajerController::class, 'create'])->name('manajer.create');
        Route::post('/', [HrdManajerController::class, 'store'])->name('manajer.store');
        Route::get('/{id}', [HrdManajerController::class, 'show'])->name('manajer.show');
        Route::get('/{id}/edit', [HrdManajerController::class, 'edit'])->name('manajer.edit');
        Route::put('/{id}', [HrdManajerController::class, 'update'])->name('manajer.update');
        Route::put('/{id}/status', [HrdManajerController::class, 'updateStatus'])->name('manajer.updateStatus');
        Route::delete('/{id}', [HrdManajerController::class, 'destroy'])->name('manajer.destroy');
    });
});

Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::prefix('karyawan')->group(function () {
        Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('/create', [KaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('/', [KaryawanController::class, 'store'])->name('karyawan.store');
        Route::get('/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
        Route::put('/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
    });
});

Route::get('/predictions/history', [PredictionController::class, 'history'])
    ->name('predictions.history');
Route::get('/predictions/create', [PredictionController::class, 'create'])
    ->name('predictions.create');

Route::get('/test-db', function() {
    try {
        DB::connection('stafflink_db')->getPdo();
        return "Connected successfully to: " . DB::connection('stafflink_db')->getDatabaseName();
    } catch (\Exception $e) {
        return "Connection failed: " . $e->getMessage();
    }
});
require __DIR__.'/auth.php';
