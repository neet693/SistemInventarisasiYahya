<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisPengadaanController;
use App\Http\Controllers\JenisRuanganController;
use App\Http\Controllers\KategorialController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenempatanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\StatusPerbaikanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('barangs', BarangController::class);
Route::resource('kategorials', KategorialController::class);
Route::resource('ruangans', RuanganController::class);
Route::resource('penempatans', PenempatanController::class);
Route::resource('perbaikans', PerbaikanController::class);
Route::resource('status_perbaikans', StatusPerbaikanController::class);
Route::resource('jenis_pengadaans', JenisPengadaanController::class);
Route::resource('jenis_ruangans', JenisRuanganController::class);
Route::resource('levels', LevelController::class);

Route::post('barang/import/', [BarangController::class, 'import'])->name('import-barang');
// Route::get('/import', [BarangController::class, 'importView'])->name('import.view');
// Route::post('/import', [BarangController::class, 'import'])->name('import');
Route::get('barang/export/', [BarangController::class, 'export'])->name('export-barang');
