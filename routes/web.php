<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenilaiController;
use App\Http\Controllers\SekolahController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

// route login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'login']);
// Route Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout-on-exit', [AuthController::class, 'logout'])->name('logout-on-exit');

// Route Admin
Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/admin/datauser', [AdminController::class, 'datauser'])->name('admin.datauser');
    Route::post('/admin/simpanuser', [AdminController::class, 'simpanUser'])->name('admin.simpanuser');
    Route::post('/admin/updateuser/{id}', [AdminController::class, 'updateUser'])->name('admin.updateuser');
    Route::get('/admin/hapus_user/{id}', [AdminController::class, 'hapusUser'])->name('admin.hapususer');

    Route::get('/admin/datasekolah', [AdminController::class, 'dataSekolah'])->name('admin.datasekolah');
    Route::post('/admin/simpansekolah', [AdminController::class, 'simpanSekolah'])->name('admin.simpansekolah');
    Route::post('/admin/updatesekolah/{id}', [AdminController::class, 'updateSekolah'])->name('admin.updatesekolah');
    Route::get('/admin/hapussekolah/{id}', [AdminController::class, 'hapusSekolah'])->name('admin.hapussekolah');
});


// Route Sekolah
Route::middleware(['auth', 'checkrole:sekolah'])->group(function () {
    Route::get('/sekolah/dashboard', [SekolahController::class, 'index'])->name('sekolah.dashboard');
    Route::get('/sekolah/datasiswa', [SekolahController::class, 'datasiswa'])->name('sekolah.datasiswa');
    Route::post('/sekolah/simpansiswa', [SekolahController::class, 'simpanSiswa'])->name('sekolah.simpanSiswa');
    Route::post('/sekolah/updatesiswa/{id}', [SekolahController::class, 'updateSiswa'])->name('sekolah.updateSiswa');
    Route::delete('/sekolah/deletesiswa/{id}', [SekolahController::class, 'deleteSiswa'])->name('sekolah.deletesiswa');

    Route::get('/sekolah/form', [SekolahController::class, 'dataform'])->name('sekolah.dataform');
    Route::post('/sekolah/simpanform', [SekolahController::class, 'simpanFormPenilaian'])->name('sekolah.simpanForm');


    Route::get('/sekolah/editform/{id}', [SekolahController::class, 'editFormPenilaian'])->name('sekolah.editform');
    Route::put('/sekolah/updateform/{id}', [SekolahController::class, 'updateFormPenilaian'])->name('sekolah.updateform');
    Route::get('/sekolah/hasil-penilaian/{idSiswa}', [SekolahController::class, 'hasilPenilaianSiswa'])->name('sekolah.hasil_penilaian');

    Route::get('/sekolah/tampilform', [SekolahController::class, 'tampilkan_form'])->name('sekolah.tampilform');
});

// Route Penilai
Route::middleware(['auth', 'checkrole:penilai'])->group(function () {
    Route::get('/penilai/dashboard', [PenilaiController::class, 'index'])->name('penilai.dashboard');
    Route::get('/penilai/datasiswa', [PenilaiController::class, 'datasiswa'])->name('penilai.datasiswa');
    Route::get('/penilai/formnilai/{id}', [PenilaiController::class, 'formPenilaian']);
    Route::post('/penilai/simpannilai/{id}', [PenilaiController::class, 'simpanNilai'])->name('penilai.simpannilai');
    Route::get('/penilai/hasilpenilaian/{id}', [PenilaiController::class, 'showHasilPenilaianSiswa'])
    ->name('penilai.hasilpenilaian');
    Route::get('penilai/edithasilpenilaian/{idHasilPenilaian}', [PenilaiController::class,'editHasilPenilaian'])
    ->name('penilai.edithasilpenilaian');

    Route::post('penilai/updatehasilpenilaian/{idHasilPenilaian}', [PenilaiController::class, 'updateHasilPenilaian'])
    ->name('penilai.updatehasilpenilaian');

});

