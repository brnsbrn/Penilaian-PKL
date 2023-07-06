<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\MahasiswaController;
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

// route admin
Route::get('/admin', [MahasiswaController::class, 'index'])->name('admin');

Route::get('/tambahmahasiswa', [MahasiswaController::class, 'tambahmahasiswa'])->name('tambahmahasiswa');

Route::post('/insertmahasiswa', [MahasiswaController::class, 'insertmahasiswa'])->name('insertmahasiswa');

Route::get('/tampildata/{id_mahasiswa}', [MahasiswaController::class, 'tampildata'])->name('tampildata');

Route::post('/updatedata/{id_mahasiswa}', [MahasiswaController::class, 'updatedata'])->name('updatedata');

Route::get('/deletedata/{id_mahasiswa}', [MahasiswaController::class, 'deletedata'])->name('deletedata');

Route::get('/showmahasiswa/{id_mahasiswa}', [MahasiswaController::class, 'showmahasiswa'])->name('showmahasiswa');

// route login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'login']);

// route karyawan
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');

Route::get('/nilaimahasiswa/{id_mahasiswa}', [KaryawanController::class, 'nilaimahasiswa'])->name('nilaimahasiswa');
