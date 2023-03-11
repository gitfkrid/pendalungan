<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PelangganController;

Route::post('register', [PelangganController::class, 'register']);
Route::post('login', [PelangganController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('profile', [PelangganController::class, 'profile']);
    Route::post('logout', [PelangganController::class, 'logout']);
});
