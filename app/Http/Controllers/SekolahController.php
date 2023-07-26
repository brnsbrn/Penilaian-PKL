<?php

namespace App\Http\Controllers;

use App\Models\FormPenilaian;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SekolahController extends Controller
{
    public function index() 
    {
        return view('sekolah.dashboard');
    }

    public function datasiswa()
    {
        // Ambil id_sekolah dari session user yang sedang login
        $idSekolah = Auth::user()->id_sekolah;

        // Ambil data siswa yang memiliki id_sekolah yang sama dengan id_sekolah user yang login
        $siswa = Siswa::where('id_sekolah', $idSekolah)->get();

        return view('sekolah.datasiswa', compact('siswa'));
    }

    public function simpanSiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'divisi_pkl' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Ambil id_sekolah dari sesi login
        $id_sekolah = Auth::user()->id_sekolah;

        // Simpan data siswa
        Siswa::create([
            'id_sekolah' => $id_sekolah,
            'nama_siswa' => $request->nama,
            'divisi_pkl' => $request->divisi_pkl,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
        ]);

        return redirect()->route('sekolah.datasiswa')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function updateSiswa(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'divisi_pkl' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Ambil id_sekolah dari sesi login
        $id_sekolah = Auth::user()->id_sekolah;

        $siswa = Siswa::where('id_sekolah', $id_sekolah)->find($id);

        if (!$siswa) {
            return redirect()->route('sekolah.datasiswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        $siswa->nama_siswa = $request->input('nama');
        $siswa->divisi_pkl = $request->input('divisi_pkl');
        $siswa->tanggal_mulai = $request->input('tanggal_mulai');
        $siswa->tanggal_berakhir = $request->input('tanggal_berakhir');
        $siswa->save();

        return redirect()->route('sekolah.datasiswa')->with('success', 'Data siswa berhasil diupdate.');
    }

    public function deleteSiswa($id)
    {
        // Ambil id_sekolah dari sesi login
        $id_sekolah = Auth::user()->id_sekolah;

        $siswa = Siswa::where('id_sekolah', $id_sekolah)->find($id);

        if (!$siswa) {
            return redirect()->route('sekolah.datasiswa')->with('error', 'Data siswa tidak ditemukan.');
        }

        $siswa->delete();

        return redirect()->route('sekolah.datasiswa')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function dataform()
    {
        return view('sekolah.dataform');
    }

    public function simpanFormPenilaian(Request $request)
    {
        $request->validate([
            'kriteria1' => 'required',
            'tipe_kriteria1' => 'required',
        ]);

        // Ambil ID sekolah dari user yang sedang login
        $id_sekolah = Auth::user()->id_sekolah;

        // Inisialisasi array untuk menyimpan data form penilaian
        $dataForm = [];

        $counter = 1;

        // Perulangan untuk membaca data kriteria dari request dan menyimpannya dalam array
        while ($request->has("kriteria$counter")) {
            $kriteria = $request->input("kriteria$counter");
            $tipe_kriteria = $request->input("tipe_kriteria$counter");

            // Jika kriteria berupa angka, ambil juga nilai min dan max
            $min = null;
            $max = null;
            if ($tipe_kriteria === 'angka') {
                $min = $request->input("min_kriteria$counter");
                $max = $request->input("max_kriteria$counter");
            }

            // Tambahkan data kriteria ke dalam array $dataForm
            $dataForm[] = [
                'kriteria' => $kriteria,
                'tipe_kriteria' => $tipe_kriteria,
                'min' => $min,
                'max' => $max,
            ];

            $counter++;
        }

        // Simpan data ke tabel form_penilaian
        $formPenilaian = new FormPenilaian();
        $formPenilaian->id_sekolah = $id_sekolah;
        $formPenilaian->data_form = json_encode($dataForm);
        $formPenilaian->save();

        return redirect()->route('sekolah.dataform')->with('success', 'Data kriteria penilaian berhasil disimpan');
    }

    public function tampilkan_form()
    {
        // Ambil ID sekolah dari user yang sedang login
        $id_sekolah = Auth::user()->id_sekolah;
    
        // Ambil data form penilaian dari database berdasarkan ID sekolah
        $formPenilaian = FormPenilaian::where('id_sekolah', $id_sekolah)->first();
    
        // Tampilkan halaman lain dengan data yang telah diinput sebelumnya
        return view('sekolah.showdataform', compact('formPenilaian'));
    }    
    
    // SekolahController.php

    public function editFormPenilaian($id)
    {
        $formPenilaian = FormPenilaian::find($id);

        if (!$formPenilaian) {
            return redirect()->route('sekolah.dataform')->with('error', 'Data form penilaian tidak ditemukan.');
        }

        return view('sekolah.editform', compact('formPenilaian'));
    }

    public function updateFormPenilaian(Request $request, $id)
    {
        $formPenilaian = FormPenilaian::find($id);

        if (!$formPenilaian) {
            return redirect()->route('sekolah.tampilform')->with('error', 'Data form penilaian tidak ditemukan.');
        }

        // Validasi data yang diinputkan
        $request->validate([
            'kriteria1' => 'required',
            'tipe_kriteria1' => 'required',
            'kriteria2' => 'required',
            'tipe_kriteria2' => 'required',
            'kriteria3' => 'required',
            'tipe_kriteria3' => 'required',
        ]);

        // Inisialisasi array untuk menyimpan data form penilaian
        $dataForm = [];

        // Proses update data kriteria
        for ($i = 1; $i <= 3; $i++) {
            $kriteria = $request->input("kriteria$i");
            $tipe_kriteria = $request->input("tipe_kriteria$i");

            // Jika kriteria berupa angka, ambil juga nilai min dan max
            $min = null;
            $max = null;
            if ($tipe_kriteria === 'angka') {
                $min = $request->input("min_kriteria$i");
                $max = $request->input("max_kriteria$i");
            }

            // Tambahkan data kriteria ke dalam array $dataForm
            $dataForm[] = [
                'kriteria' => $kriteria,
                'tipe_kriteria' => $tipe_kriteria,
                'min' => $min,
                'max' => $max,
            ];
        }

        // Lakukan pengecekan jika ada kriteria baru ditambahkan (dalam contoh ini ada 3 kriteria)
        for ($i = 4; $request->has("kriteria$i"); $i++) {
            $kriteria = $request->input("kriteria$i");
            $tipe_kriteria = $request->input("tipe_kriteria$i");

            // Jika kriteria berupa angka, ambil juga nilai min dan max
            $min = null;
            $max = null;
            if ($tipe_kriteria === 'angka') {
                $min = $request->input("min_kriteria$i");
                $max = $request->input("max_kriteria$i");
            }

            // Tambahkan data kriteria baru ke dalam array $dataForm
            $dataForm[] = [
                'kriteria' => $kriteria,
                'tipe_kriteria' => $tipe_kriteria,
                'min' => $min,
                'max' => $max,
            ];
        }

        // Hapus kriteria yang tidak diperlukan lagi (jika ada)
        for ($i = 1; $i <= 10; $i++) {
            if ($request->has("hapus_kriteria$i")) {
                unset($dataForm[$i - 1]);
            }
        }

        // Urutkan ulang array $dataForm setelah menghapus kriteria
        $dataForm = array_values($dataForm);

        // Update data form penilaian
        $formPenilaian->data_form = json_encode($dataForm);
        $formPenilaian->save();

        return redirect()->route('sekolah.tampilform')->with('success', 'Data form penilaian berhasil diupdate.');
    }


   

}
