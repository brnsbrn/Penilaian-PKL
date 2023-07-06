<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(){
        $data = Mahasiswa::all();
        return view('karyawan.dashboard', compact('data'));
    }

    public function nilaimahasiswa($id_mahasiswa) {
        $data = Mahasiswa::find($id_mahasiswa);
        return view('karyawan.nilaimahasiswa', compact('data'));
    }
}
