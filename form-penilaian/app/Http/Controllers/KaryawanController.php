<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


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

    public function berinilai($id) {
        
        $id = $id;
        return view('karyawan.berinilai', ['id' => $id]);
    }

    public function storepenilaian(Request $request, $id) {
        
        $request->validate([
            'disiplin' => 'required|integer|min:1|max:10',
            'kinerja' => 'required|integer|min:1|max:10',
            'rapi' => 'required|integer|min:1|max:10',
            'sopansantun' => 'required|integer|min:1|max:10',
            'komentar' => 'required|string',
        ], [
            'disiplin.required' => 'Mohon masukkan nilai kedisiplinan',
            'disiplin.integer' => 'Nilai kedisiplinan harus berupa angka',
            'disiplin.min' => 'Nilai kedisiplinan harus di antara 1 hingga 10',
            'disiplin.max' => 'Nilai kedisiplinan harus di antara 1 hingga 10',
            'kinerja.required' => 'Mohon masukkan nilai kinerja kerja',
            'kinerja.integer' => 'Nilai kinerja kerja harus berupa angka',
            'kinerja.min' => 'Nilai kinerja kerja harus di antara 1 hingga 10',
            'kinerja.max' => 'Nilai kinerja kerja harus di antara 1 hingga 10',
            'rapi.required' => 'Mohon masukkan nilai kerapian',
            'rapi.integer' => 'Nilai kerapian harus berupa angka',
            'rapi.min' => 'Nilai kerapian harus di antara 1 hingga 10',
            'rapi.max' => 'Nilai kerapian harus di antara 1 hingga 10',
            'sopansantun.required' => 'Mohon masukkan nilai kesopanan',
            'sopansantun.integer' => 'Nilai kesopanan harus berupa angka',
            'sopansantun.min' => 'Nilai kesopanan harus di antara 1 hingga 10',
            'sopansantun.max' => 'Nilai kesopanan harus di antara 1 hingga 10',
            'komentar.required' => 'Mohon masukkan komentar',
            'komentar.string' => 'Komentar harus berupa teks',
        ]);

        // Dapatkan ID pengguna yang sedang login dari session
        $userId = session('id');
        $id = $id;
   
        

        // Simpan data penilaian ke dalam tabel "penilaian"
        $penilaian = new Penilaian();
        $penilaian->user_id = $userId;
        $penilaian->id_mahasiswa = $id;
        $penilaian->kedisiplinan = $request->disiplin;
        $penilaian->kinerja_kerja = $request->kinerja;
        $penilaian->kerapian = $request->rapi;
        $penilaian->kesopanan = $request->sopansantun;
        $penilaian->komentar = $request->komentar;
        $penilaian->save();
        return redirect()->route('nilaimahasiswa', ['id' => $id])->with('success', 'Penilaian berhasil disimpan.');

        // Setelah berhasil menyimpan penilaian, Anda dapat melakukan redirect atau menampilkan pesan sukses, sesuai dengan kebutuhan aplikasi Anda.
    }

    public function hasilPenilaian($id)
    {
        $id_user = session('id');
        $id = $id;

        $hasilPenilaian = Penilaian::where('penilaian.user_id', $id_user)
            ->where('penilaian.id_mahasiswa', $id)
            ->join('mahasiswas', 'penilaian.id_mahasiswa', '=', 'mahasiswas.id_mahasiswa')
            ->select('penilaian.*', 'mahasiswas.nama_mahasiswa')
            ->get();

        return view('karyawan.hasilnilai', ['hasilPenilaian' => $hasilPenilaian], ['id' => $id]);
    }

}
