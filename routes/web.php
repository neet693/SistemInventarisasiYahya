<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisPengadaanController;
use App\Http\Controllers\JenisRuanganController;
use App\Http\Controllers\KategorialController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PemindahanBarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenempatanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SettingUser;
use App\Http\Controllers\StatusPerbaikanController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Auth;
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
// Route::resource('penempatans', PenempatanController::class);
Route::resource('pemindahan', PemindahanBarangController::class);
Route::resource('perbaikans', PerbaikanController::class);
Route::resource('status_perbaikans', StatusPerbaikanController::class);
Route::resource('jenis_pengadaans', JenisPengadaanController::class);
// Route::resource('jenis_ruangans', JenisRuanganController::class);
Route::resource('levels', LevelController::class);
Route::resource('units', UnitController::class);
Route::resource('peminjamans', PeminjamanController::class);
Route::post('/peminjaman/{peminjaman}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
Route::resource('settings', SettingUser::class)->parameters([
    'settings' => 'user',
]);

Route::get('barang/by-ruangan/{ruangan_id}', [BarangController::class, 'getBarangByRuangan'])->name('barang.by.ruangan');

Route::post('barang/import/', [BarangController::class, 'import'])->name('import-barang');
Route::get('barang/export/', [BarangController::class, 'export'])->name('export-barang');
Route::get('/barangs/{kode_barang}', [BarangController::class, 'show'])->name('barangs.show');;


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('home/unit/{unitName}', [HomeController::class, 'showUnit'])->name('home.unit');

//Print QR
Route::get('/barangs/{kode_barang}/print-qr', [BarangController::class, 'printQr'])->name('barangs.printQr');
