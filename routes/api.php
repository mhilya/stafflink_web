<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PredictionController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\AbsensiKaryawanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public authentication routes
Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    // Token refresh can be public as it requires a valid refresh token
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

// Authenticated routes
Route::middleware('auth:api')->group(function() {
    // Authentication related routes
    Route::prefix('auth')->group(function() {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });

    // Profile routes - RESTful design
    Route::apiResource('profiles', ProfileController::class)->only([
        'show', 'update'
    ]);
    Route::post('/profile/complete', [ProfileController::class, 'completeProfile']);
});

    // Prediction routes
    Route::prefix('predictions')->group(function() {
        Route::post('/', [PredictionController::class, 'predict'])->name('predictions.predict');
        Route::get('/stats', [PredictionController::class, 'getPromotionStats']);
    });

Route::prefix('absensi')->group(function () {
    Route::post('/', [AbsensiKaryawanController::class, 'store']);
    Route::get('/', [AbsensiKaryawanController::class, 'index']);
    Route::get('/check', [AbsensiKaryawanController::class, 'checkAbsen']);
    Route::get('/bulanan', [AbsensiKaryawanController::class, 'getAbsensiBulanan'])->middleware('auth:api');
});
