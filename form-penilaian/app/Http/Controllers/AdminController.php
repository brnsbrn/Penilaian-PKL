<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;
            $data = Mahasiswa::where('nama_mahasiswa', 'LIKE', '%' . $search . '%')->get();
        } else {
            $data = Mahasiswa::all();
        }
        
        return view('admin.dashboard', compact('data'));
    }
    

    public function tambahmahasiswa() {
        return view('admin.tambahmahasiswa');
    }

    public function insertmahasiswa(Request $request) {
        Mahasiswa::create($request->all());
        return redirect()->route('admin')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampildata($id_mahasiswa) {
        $data = Mahasiswa::find($id_mahasiswa);
        return view('admin.tampildata', compact('data'));
    }

    public function updatedata(Request $request, $id_mahasiswa) {
        $data = Mahasiswa::find($id_mahasiswa);
        $data->update($request->all());
        return redirect()->route('admin')->with('success', 'Data Berhasil Diubah');
    }

    public function deletedata($id_mahasiswa) {
        $data = Mahasiswa::find($id_mahasiswa);
        $data -> delete();
        return redirect()->route('admin')->with('success', 'Data Berhasil Dihapus');
    }

    public function showmahasiswa($id_mahasiswa) {
        $data = Mahasiswa::find($id_mahasiswa);
        return view('admin.showmahasiswa', compact('data'));
    }
}
