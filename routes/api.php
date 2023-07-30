<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelaporController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\KelurahanController;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\SuperadminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'pelapor'])->group(function () {
    Route::get('profile-pelapor', [PelaporController::class, 'profile']);
    Route::post('updateprofile-pelapor', [PelaporController::class, 'updateProfile']);
    Route::get('data-lapor', [LaporanController::class, 'create']);
    Route::get('riwayat-lapor', [LaporanController::class, 'riwayat']);
    Route::get('show-laporan/{id}', [LaporanController::class, 'show']);
    Route::post('post-lapor', [LaporanController::class, 'store']);
    Route::get('dashboard-lapor', [LaporanController::class, 'index']);

});

Route::middleware(['auth:sanctum', 'lurah'])->group(function () {
    Route::get('dashboard-lurah', [KelurahanController::class, 'index']);
    Route::get('profile-lurah', [KelurahanController::class, 'profile']);
    Route::get('get-dinas', [KelurahanController::class, 'getDinas']);
    Route::get('detail-pelapor-lurah/{id}', [KelurahanController::class, 'cekUserPelapor']);
    Route::post('updateprofile-lurah', [KelurahanController::class, 'updateProfile']);
    Route::post('update-status/{id}', [KelurahanController::class, 'updateStatusLapor']);
    Route::post('ajuan-ke-dinas/{id}', [KelurahanController::class, 'ajuanKeDinas']);
    Route::get('show-laporan-lurah/{id}', [KelurahanController::class, 'show']);

    
});

Route::middleware(['auth:sanctum', 'dinas'])->group(function () {
    Route::get('dashboard-dinas', [DinasController::class, 'index']);
    Route::get('profile-dinas', [DinasController::class, 'profile']);
    Route::post('updateprofile-dinas', [DInasController::class, 'updateProfile']);
    Route::get('show-laporan-dinas/{id}', [DinasController::class, 'show']);
    Route::get('detail-pelapor-dinas/{id}', [DinasController::class, 'cekUserPelapor']);
    Route::post('update-status-lapor/{id}', [DinasController::class, 'updateStatusLapor']);
    Route::post('konfirmasi-ajuan/{id}', [DinasController::class, 'confirm']);

    
});

Route::middleware(['auth:sanctum', 'superadmin'])->group(function () {
    Route::get('dashboard-superadmin', [SuperadminController::class, 'index']);
    Route::get('profile-superadmin', [SuperadminController::class, 'profile']);
    Route::get('all-laporan', [SuperadminController::class, 'getAllLaporan']);
    Route::post('create-user', [SuperadminController::class, 'storeUser']);
    Route::post('updateprofile-superadmin', [SuperadminController::class, 'updateProfile']);
    Route::get('show-laporan-superadmin/{id}', [SuperadminController::class, 'show']);
    Route::get('detail-pelapor-superadmin/{id}', [SuperadminController::class, 'cekUserPelapor']);
    Route::delete('delete-user/{id}', [SuperadminController::class, 'deleteUser']);
    
});

Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'registerUser']);
Route::post('post-lapor-guest', [LaporanController::class, 'store']);
Route::post('forgot-password ', [AuthController::class, 'forgotPassword']);
Route::get('email/verify/{id}/{hash}', [VerifyEmailController::class, 'verifyEmail'])->name('verification.verify');