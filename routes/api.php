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
    Route::post('data-lapor', [LaporanController::class, 'create']);
    Route::post('post-lapor', [LaporanController::class, 'store']);

});
Route::get('dashboard-lapor', [LaporanController::class, 'index']);

Route::middleware(['auth:sanctum', 'kelurahan'])->group(function () {
    
});

Route::middleware(['auth:sanctum', 'dinas'])->group(function () {
    
});

Route::middleware(['auth:sanctum', 'superadmin'])->group(function () {
    
});

Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('email/verify/{id}', [AuthController::class, 'verify'])->name('verification.verify');
Route::post('post-lapor-guest', [LaporanController::class, 'store']);