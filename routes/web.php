<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StrukturController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

Route::resource('/dashboard', DashboardController::class);
Route::resource('/profile', ProfileController::class);
Route::resource('/struktur', StrukturController::class);
Route::resource('/kegiatan', KegiatanController::class);
Route::resource('/pengumuman', PengumumanController::class);
Route::resource('/gallery', GalleryController::class);
Route::resource('/gambar', GambarController::class);

Route::get('dashboard/{id}/delete', [DashboardController::class, 'delete'])->name('dashboard.delete');
Route::get('profile/{id}/delete', [ProfileController::class, 'delete'])->name('profile.delete');
Route::get('kegiatan/{id}/delete', [KegiatanController::class, 'delete'])->name('kegiatan.delete');
Route::get('pengumuman/{id}/delete', [PengumumanController::class, 'delete'])->name('pengumuman.delete');
Route::get('gallery/{id}/delete', [GalleryController::class, 'delete'])->name('gallery.delete');
Route::get('gambar/{id}/delete', [GambarController::class, 'delete'])->name('gambar.delete');
