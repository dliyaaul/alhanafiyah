<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaldoWakafController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\TimeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\EventListener\ProfilerListener;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('index');
Route::get('/view_kegiatan/{id}', [App\Http\Controllers\WelcomeController::class, 'show'])->name('welcome.show');


Auth::routes();

Route::resource('/dashboard', DashboardController::class);
Route::resource('/struktur', StrukturController::class);
Route::resource('/gallery', GalleryController::class);
Route::resource('/gambar', GambarController::class);
Route::resource('/saldoWakaf', SaldoWakafController::class);

//dashboard
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::delete('/delete/data/{id}', [DashboardController::class, 'delete'])->name('delete.data');

//profile
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('dataProfile', [ProfileController::class, 'getData']);
Route::post('/addProfile', [ProfileController::class, 'store']);
Route::put('/updateProfile/{id}', [ProfileController::class, 'update']);
Route::delete('/deleteProfile/{id}', [ProfileController::class, 'delete']);

//kegiatan
Route::get('/kegiatan', [KegiatanController::class, 'index']);
Route::get('dataKegiatan', [KegiatanController::class, 'getData']);
Route::post('/addKegiatan', [KegiatanController::class, 'store'])->name('addKegiatan');
Route::put('/updateKegiatan/{id}', [KegiatanController::class, 'update']);
Route::delete('/deleteKegiatan/{id}', [KegiatanController::class, 'delete']);

//pengumuman
Route::get('/pengumuman', [PengumumanController::class, 'index']);
Route::get('dataPengumuman', [PengumumanController::class, 'getData']);
Route::post('/addPengumuman', [PengumumanController::class, 'store'])->name('addPengumuman');
Route::put('/updatePengumuman/{id}', [PengumumanController::class, 'update']);
Route::delete('/deletePengumuman/{id}', [PengumumanController::class, 'delete']);

//SaldoMusholla
Route::get('gallery/{id}/delete', [GalleryController::class, 'delete'])->name('gallery.delete');
Route::get('gambar/{id}/delete', [GambarController::class, 'delete'])->name('gambar.delete');

//SaldoWakaf
Route::get('/saldoWakaf', [SaldoWakafController::class, 'index']);
Route::get('dataSaldo', [SaldoWakafController::class, 'getData']);
Route::post('/addSaldoWakaf', [SaldoWakafController::class, 'store']);
Route::put('/updateSaldoWakaf/{id}', [SaldoWakafController::class, 'update']);
Route::delete('/deleteSaldoWakaf/{id}', [SaldoWakafController::class, 'delete']);

// routes/web.php
Route::get('/server-time', [TimeController::class, 'getServerTime']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
