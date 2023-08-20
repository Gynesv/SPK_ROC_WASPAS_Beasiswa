<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

/* =================== SEKOLAH =================== */

use App\Http\Controllers\SPKPeriodeController;
use App\Http\Controllers\SistemComboController;
use App\Http\Controllers\SistemUsersController;
use App\Http\Controllers\SPKKriteriaController;

/* ==================== SPK ===================== */

use App\Http\Controllers\SekolahKelasController;
use App\Http\Controllers\SekolahSiswaController;
use App\Http\Controllers\SekolahTahunController;
use App\Http\Controllers\SPKPenilaianController;

/* ==================== SISTEM ===================== */

use App\Http\Controllers\SekolahDaftarController;
use App\Http\Controllers\SekolahPesertaController;
use App\Http\Controllers\SPKKuantitatifController;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* ==================================== SEKOLAH ======================================= */

Route::group(['prefix' => 'tahun', 'as' => 'tahun.'], function () {
    Route::get('/', [SekolahTahunController::class, 'index'])->name('index');
    Route::get('/view', [SekolahTahunController::class, 'view'])->name('view');
    Route::post('/save', [SekolahTahunController::class, 'save'])->name('save');
    Route::get('/edit', [SekolahTahunController::class, 'edit'])->name('edit');
    Route::post('/update', [SekolahTahunController::class, 'update'])->name('update');
    Route::get('/delete', [SekolahTahunController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'daftar', 'as' => 'daftar.'], function () {
    Route::get('/', [SekolahDaftarController::class, 'index'])->name('index');
    Route::get('/view', [SekolahDaftarController::class, 'view'])->name('view');
    Route::post('/save', [SekolahDaftarController::class, 'save'])->name('save');
    Route::get('/edit', [SekolahDaftarController::class, 'edit'])->name('edit');
    Route::post('/update', [SekolahDaftarController::class, 'update'])->name('update');
    Route::get('/delete', [SekolahDaftarController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'siswa', 'as' => 'siswa.'], function () {
    Route::get('/', [SekolahSiswaController::class, 'index'])->name('index');
    Route::get('/view', [SekolahSiswaController::class, 'view'])->name('view');
    Route::post('/save', [SekolahSiswaController::class, 'save'])->name('save');
    Route::get('/edit', [SekolahSiswaController::class, 'edit'])->name('edit');
    Route::post('/update', [SekolahSiswaController::class, 'update'])->name('update');
    Route::get('/delete', [SekolahSiswaController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'kelas', 'as' => 'kelas.'], function () {
    Route::get('/', [SekolahKelasController::class, 'index'])->name('index');
    Route::get('/view', [SekolahKelasController::class, 'view'])->name('view');
    Route::post('/save', [SekolahKelasController::class, 'save'])->name('save');
    Route::get('/edit', [SekolahKelasController::class, 'edit'])->name('edit');
    Route::post('/update', [SekolahKelasController::class, 'update'])->name('update');
    Route::get('/delete', [SekolahKelasController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'peserta', 'as' => 'peserta.'], function () {
    Route::get('/', [SekolahPesertaController::class, 'index'])->name('index');
    Route::get('/view', [SekolahPesertaController::class, 'view'])->name('view');
    Route::post('/save', [SekolahPesertaController::class, 'save'])->name('save');
    Route::get('/edit', [SekolahPesertaController::class, 'edit'])->name('edit');
    Route::post('/update', [SekolahPesertaController::class, 'update'])->name('update');
    Route::get('/delete', [SekolahPesertaController::class, 'delete'])->name('delete');
});

/* ==================================== SPK ======================================= */

Route::group(['prefix' => 'periode', 'as' => 'periode.'], function () {
    Route::get('/', [SPKPeriodeController::class, 'index'])->name('index');
    Route::get('/view', [SPKPeriodeController::class, 'view'])->name('view');
    Route::post('/save', [SPKPeriodeController::class, 'save'])->name('save');
    Route::get('/edit', [SPKPeriodeController::class, 'edit'])->name('edit');
    Route::post('/update', [SPKPeriodeController::class, 'update'])->name('update');
    Route::get('/delete', [SPKPeriodeController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'kriteria', 'as' => 'kriteria.'], function () {
    Route::get('/', [SPKKriteriaController::class, 'index'])->name('index');
    Route::get('/view', [SPKKriteriaController::class, 'view'])->name('view');
    Route::post('/save', [SPKKriteriaController::class, 'save'])->name('save');
    Route::get('/edit', [SPKKriteriaController::class, 'edit'])->name('edit');
    Route::post('/update', [SPKKriteriaController::class, 'update'])->name('update');
    Route::get('/delete', [SPKKriteriaController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'kuantitatif', 'as' => 'kuantitatif.'], function () {
    Route::get('/', [SPKKuantitatifController::class, 'index'])->name('index');
    Route::get('/view', [SPKKuantitatifController::class, 'view'])->name('view');
    Route::post('/save', [SPKKuantitatifController::class, 'save'])->name('save');
    Route::get('/edit', [SPKKuantitatifController::class, 'edit'])->name('edit');
    Route::post('/update', [SPKKuantitatifController::class, 'update'])->name('update');
    Route::get('/delete', [SPKKuantitatifController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'penilaian', 'as' => 'penilaian.'], function () {
    Route::get('/', [SPKPenilaianController::class, 'index'])->name('index');
    Route::get('/view', [SPKPenilaianController::class, 'view'])->name('view');
    Route::post('/save', [SPKPenilaianController::class, 'save'])->name('save');
    Route::get('/delete', [SPKPenilaianController::class, 'delete'])->name('delete');
    Route::get('/cetak_pdf', [SPKPenilaianController::class, 'cetak_pdf'])->name('cetak_pdf');
    Route::get('/cetak_excel', [SPKPenilaianController::class, 'cetak_excel'])->name('cetak_excel');
});

/* ==================================== SISTEM ======================================= */

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('/', [SistemUsersController::class, 'index'])->name('index');
    Route::get('/view', [SistemUsersController::class, 'view'])->name('view');
    Route::post('/save', [SistemUsersController::class, 'save'])->name('save');
    Route::get('/edit', [SistemUsersController::class, 'edit'])->name('edit');
    Route::post('/update', [SistemUsersController::class, 'update'])->name('update');
    Route::get('/delete', [SistemUsersController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'combo', 'as' => 'combo.'], function () {
    Route::get('/tahun', [SistemComboController::class, 'tahun'])->name('tahun');
    Route::get('/daftar', [SistemComboController::class, 'daftar'])->name('daftar');
    Route::get('/filter_peserta', [SistemComboController::class, 'filter_peserta'])->name('filter_peserta');

    Route::get('/siswa', [SistemComboController::class, 'siswa'])->name('siswa');
    Route::get('/peserta', [SistemComboController::class, 'peserta'])->name('peserta');

    Route::get('/kelas', [SistemComboController::class, 'kelas'])->name('kelas');

    Route::get('/periode', [SistemComboController::class, 'periode'])->name('periode');
    Route::get('/kriteria', [SistemComboController::class, 'kriteria'])->name('kriteria');
    Route::get('/filter_kriteria', [SistemComboController::class, 'filter_kriteria'])->name('filter_kriteria');
    Route::get('/filter_periode_kriteria', [SistemComboController::class, 'filter_periode_kriteria'])->name('filter_periode_kriteria');
    Route::get('/kuantitatif', [SistemComboController::class, 'kuantitatif'])->name('kuantitatif');
});
