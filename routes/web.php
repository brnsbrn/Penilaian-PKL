<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

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
Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    
    Route::get('/index', [AdminController::class, 'halbaru']);

    Route::get('/homeadmin', [AdminController::class, 'index'])->name('admin');
    
    Route::get('/tambahmahasiswa', [AdminController::class, 'tambahmahasiswa'])->name('tambahmahasiswa');

    Route::post('/insertmahasiswa', [AdminController::class, 'insertmahasiswa'])->name('insertmahasiswa');

    Route::get('/tampildata/{id_mahasiswa}', [AdminController::class, 'tampildata'])->name('tampildata');

    Route::post('/updatedata/{id_mahasiswa}', [AdminController::class, 'updatedata'])->name('updatedata');

    Route::get('/deletedata/{id_mahasiswa}', [AdminController::class, 'deletedata'])->name('deletedata');

    Route::get('/showmahasiswa/{id_mahasiswa}', [AdminController::class, 'showmahasiswa'])->name('showmahasiswa');
});

// route login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/', [AuthController::class, 'login']);
// Route Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout-on-exit', [AuthController::class, 'logout'])->name('logout-on-exit');

// Route Register
Route::get('/register', [AuthController::class, 'regis']);
Route::post('/regis', [AuthController::class, 'register'])->name('register');

// route karyawan
Route::middleware(['auth', 'checkrole:karyawan'])->group(function () {

    Route::get('/depan', [KaryawanController::class, 'depan']);
    
    Route::get('/homekaryawan', [KaryawanController::class, 'index'])->name('homekaryawan');

    Route::get('/nilaimahasiswa/{id}', [KaryawanController::class, 'nilaimahasiswa'])->name('nilaimahasiswa');

    Route::get('/berinilai/{id}', [KaryawanController::class, 'berinilai'])->name('berinilai');

    Route::get('/edit/{id_penilaian}', [KaryawanController::class, 'tampilData'])->name('edit');

    Route::post('/edit-after/{id_penilaian}', [KaryawanController::class, 'updateData'])->name('edit-after');

    Route::post('/simpannilai/{id}', [KaryawanController::class, 'storepenilaian'])->name('simpannilai');

    Route::get('/hasilpenilaian/{id}', [KaryawanController::class, 'hasilPenilaian'])->name('hasilpenilaian');

    Route::get('/ubahnilai/{id_penilaian}', [KaryawanController::class, 'ubahNilai'])->name('ubahnilai');

    Route::post('/simpanubahnilai/{id_penilaian}', [KaryawanController::class, 'simpanUbahNilai'])->name('simpanubahnilai');
});

