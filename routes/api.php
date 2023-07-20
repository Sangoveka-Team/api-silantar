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
    Route::get('dashboard-lapor', [LaporanController::class, 'index']);
    Route::get('profile-pelapor', [PelaporController::class, 'profile']);
    Route::post('updateprofile-pelapor', [PelaporController::class, 'updateProfile']);
});

Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::post('login', [AuthController::class, 'login']);