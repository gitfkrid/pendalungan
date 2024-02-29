<?php

use App\Http\Controllers\API\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\PenyewaanController;

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('profile', [UserController::class, 'profile']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('barang', [BarangController::class, 'dataBarang']);
    Route::post('editprofile/{uuid}', [UserController::class, 'editprofile']);
    Route::post('editpassword/{uuid}', [UserController::class, 'editpassword']);
    Route::post('riwayat/event', [EventController::class, 'riwayat']);
    Route::post('riwayat/event/detail', [EventController::class, 'detailRiwayat']);
    Route::post('event', [EventController::class, 'showEvent']);
    Route::post('event/home', [EventController::class, 'showEventHome']);
    Route::post('penyewaan', [PenyewaanController::class, 'penyewaan']);
    Route::post('riwayat/penyewaan', [PenyewaanController::class, 'riwayatPenyewaan']);
    Route::post('riwayat/penyewaan/detail', [PenyewaanController::class, 'detailRiwayatPenyewaan']);
    Route::post('penyewaan/store', [PenyewaanController::class, 'store']);
});
