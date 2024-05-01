<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPasienController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('partial.main');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

#DATA PASIEN
Route::get('/pasien', [DataPasienController::class, 'index'])->name('pasien.index');
Route::get('/db', [DataPasienController::class, 'index']);
Route::get('/addpasien', [DataPasienController::class, 'add']);
Route::post('/simpan-pasien', [DataPasienController::class, 'simpan'])->name('data_pasien.simpan');
Route::get('/data-pasien/{id}/edit', [DataPasienController::class, 'edit'])->name('data_pasien.edit');
Route::put('/data-pasien/{id}', [DataPasienController::class, 'update'])->name('data_pasien.update');
Route::delete('/delete-pasien/{id}', [DataPasienController::class, 'delete'])->name('data_pasien.delete');

#transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/addtransaksi', [TransaksiController::class, 'add'])->name('transaksi.add');
Route::post('/simpan-transaksi', [TransaksiController::class, 'simpan'])->name('transaksi.simpan');
// Route::get('/search_pasien', [TransaksiController::class, 'searchPasien'])->name('search_pasien');
Route::get('/transaksi-excel', [TransaksiController::class, 'exportToExcel'])->name('export.excel');
Route::get('/transaksi-pdf', [TransaksiController::class, 'exportToPDF'])->name('export.pdf');

#json
Route::get('/getPasiens', [TransaksiController::class, 'getPasiens']);
Route::get('/getPasienDetails/{id}', [TransaksiController::class, 'getPasienDetails']);
Route::get('/getPasienBySearch', [TransaksiController::class, 'getPasienBySearch']);



