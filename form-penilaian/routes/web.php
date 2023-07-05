<?php

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

Route::get('/', function () {
    return view('mahasiswa');
});

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');

Route::get('/tambahmahasiswa', [MahasiswaController::class, 'tambahmahasiswa'])->name('tambahmahasiswa');

Route::post('/insertmahasiswa', [MahasiswaController::class, 'insertmahasiswa'])->name('insertmahasiswa');

Route::get('/tampildata/{id_mahasiswa}', [MahasiswaController::class, 'tampildata'])->name('tampildata');

Route::post('/updatedata/{id_mahasiswa}', [MahasiswaController::class, 'updatedata'])->name('updatedata');

Route::get('/deletedata/{id_mahasiswa}', [MahasiswaController::class, 'deletedata'])->name('deletedata');