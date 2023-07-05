<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(){
        $data = Mahasiswa::all();
        return view('admin.mahasiswa', compact('data'));
    }

    public function tambahmahasiswa() {
        return view('admin.tambahmahasiswa');
    }

    public function insertmahasiswa(Request $request) {
        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampildata($id_mahasiswa) {
        $data = Mahasiswa::find($id_mahasiswa);
        return view('admin.tampildata', compact('data'));
    }

    public function updatedata(Request $request, $id_mahasiswa) {
        $data = Mahasiswa::find($id_mahasiswa);
        $data->update($request->all());
        return redirect()->route('mahasiswa')->with('success', 'Data Berhasil Diubah');
    }

    public function deletedata($id_mahasiswa) {
        $data = Mahasiswa::find($id_mahasiswa);
        $data -> delete();
        return redirect()->route('mahasiswa')->with('success', 'Data Berhasil Dihapus');
    }
}
