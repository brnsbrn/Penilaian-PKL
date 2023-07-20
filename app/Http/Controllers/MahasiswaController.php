<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Penilaian;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function showPenilaian(Request $request)
    {
        $mahasiswa = Mahasiswa::where('no_telp', $request->session()->get('no_telp'))->first();

        if (!$mahasiswa) {
            return redirect()->back()->withErrors(['message' => 'Data mahasiswa tidak ditemukan']);
        }

        $penilaian = $mahasiswa->penilaian()->with('penilai')->get();

        $nilaiKedisiplinan = DB::table('penilaian')->avg('kedisiplinan');
        $nilaiKinerja = DB::table('penilaian')->avg('kinerja_kerja');
        $nilaiKerapian = DB::table('penilaian')->avg('kerapian');
        $nilaiKesopanan = DB::table('penilaian')->avg('kesopanan');

        $rata2 = ($nilaiKedisiplinan + $nilaiKinerja + $nilaiKerapian + $nilaiKesopanan) / 4;

        if($rata2 <= 3) {
            echo 'Buruk';
        }elseif($rata2 <= 7) {
            echo 'Baik';
        }else {
            echo 'Sangat Baik';
        }

        return view('mahasiswa.nilai', compact('penilaian', 'nilaiKedisiplinan', 'nilaiKinerja', 'nilaiKerapian', 'nilaiKesopanan', 'rata2'));
    }
}
