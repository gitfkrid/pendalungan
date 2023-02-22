<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\StatusSewaController;
use App\Http\Controllers\JaminanController;
use App\Http\Controllers\StatusEventController;
use App\Http\Controllers\JobdescEventController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ShortlinkController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PaketEventController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'cekuser:1,2']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/kategori/data', [KategoriController::class, 'dataKategori'])->name('kategori.data');
    Route::resource('kategori', KategoriController::class);
    Route::get('/jaminan/data', [JaminanController::class, 'dataJaminan'])->name('jaminan.data');
    Route::resource('jaminan', JaminanController::class);
    Route::get('/status_sewa/data', [StatusSewaController::class, 'dataStatusSewa'])->name('status_sewa.data');
    Route::resource('status_sewa', StatusSewaController::class);
    Route::get('/status_event/data', [StatusEventController::class, 'dataStatusEvent'])->name('status_event.data');
    Route::resource('status_event', StatusEventController::class);
    Route::get('/jobdesc_event/data', [JobdescEventController::class, 'dataJobdescEvent'])->name('jobdesc_event.data');
    Route::resource('jobdesc_event', JobdescEventController::class);
    Route::get('level/data', [LevelController::class, 'dataLevel'])->name('level.data');
    Route::resource('level', LevelController::class);
    Route::get('/shortlink/data', [ShortlinkController::class, 'dataShortlink'])->name('shortlink.data');
    Route::resource('shortlink', ShortlinkController::class);
    Route::get('/barang/data', [BarangController::class, 'dataBarang'])->name('barang.data');
    Route::resource('barang', BarangController::class);
    Route::get('/paket_event/data', [PaketEventController::class, 'dataPaketEvent'])->name('paket_event.data');
    Route::resource('paket_event', PaketEventController::class);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/kategori/data', [KategoriController::class, 'dataKategori'])->name('kategori.data');
    Route::resource('kategori', KategoriController::class);
    Route::get('/jaminan/data', [JaminanController::class, 'dataJaminan'])->name('jaminan.data');
    Route::resource('jaminan', JaminanController::class);
    Route::get('/status_sewa/data', [StatusSewaController::class, 'dataStatusSewa'])->name('status_sewa.data');
    Route::resource('status_sewa', StatusSewaController::class);
    Route::get('/status_event/data', [StatusEventController::class, 'dataStatusEvent'])->name('status_event.data');
    Route::resource('status_event', StatusEventController::class);
    Route::get('/jobdesc_event/data', [JobdescEventController::class, 'dataJobdescEvent'])->name('jobdesc_event.data');
    Route::resource('jobdesc_event', JobdescEventController::class);
    Route::get('level/data', [LevelController::class, 'dataLevel'])->name('level.data');
    Route::resource('level', LevelController::class);
    Route::get('/shortlink/data', [ShortlinkController::class, 'dataShortlink'])->name('shortlink.data');
    Route::resource('shortlink', ShortlinkController::class);
    Route::get('/barang/data', [BarangController::class, 'dataBarang'])->name('barang.data');
    Route::resource('barang', BarangController::class);
    Route::get('/paket_event/data', [PaketEventController::class, 'dataPaketEvent'])->name('paket_event.data');
    Route::resource('paket_event', PaketEventController::class);
});

Route::get('/{kode}', [App\Http\Controllers\ShortlinkController::class, 'shortenLink'])->name('shorten.link');