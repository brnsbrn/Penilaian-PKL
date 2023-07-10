<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AdminController;
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
Route::get('/homeadmin', [AdminController::class, 'index'])->name('admin');

Route::get('/tambahmahasiswa', [AdminController::class, 'tambahmahasiswa'])->name('tambahmahasiswa');

Route::post('/insertmahasiswa', [AdminController::class, 'insertmahasiswa'])->name('insertmahasiswa');

Route::get('/tampildata/{id_mahasiswa}', [AdminController::class, 'tampildata'])->name('tampildata');

Route::post('/updatedata/{id_mahasiswa}', [AdminController::class, 'updatedata'])->name('updatedata');

Route::get('/deletedata/{id_mahasiswa}', [AdminController::class, 'deletedata'])->name('deletedata');

Route::get('/showmahasiswa/{id_mahasiswa}', [AdminController::class, 'showmahasiswa'])->name('showmahasiswa');

// route login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'login']);
// Route Logout
Route::get('/logout', [AuthController::class, 'logout']);
// Route Register
Route::get('/register', [AuthController::class, 'regis']);
Route::post('/regis', [AuthController::class, 'register'])->name('register');

// route karyawan
Route::get('/homekaryawan', [KaryawanController::class, 'index'])->name('homekaryawan');

Route::get('/nilaimahasiswa/{id}', [KaryawanController::class, 'nilaimahasiswa'])->name('nilaimahasiswa');

Route::get('/berinilai/{id}', [KaryawanController::class, 'berinilai'])->name('berinilai');

Route::post('/simpannilai/{id}', [KaryawanController::class, 'storepenilaian'])->name('simpannilai');

Route::get('/hasilpenilaian/{id}', [KaryawanController::class, 'hasilPenilaian'])->name('hasilpenilaian');
