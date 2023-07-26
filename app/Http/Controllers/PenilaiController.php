<?php

namespace App\Http\Controllers;

use App\Models\FormPenilaian;
use App\Models\HasilPenilaian;
use App\Models\Siswa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PenilaiController extends Controller
{
    public function index()
    {
        return view('penilai.dashboard');
    }

    public function datasiswa()
    {
        $data = Siswa::all();
        return view('penilai.datasiswa', compact('data'));
    }

    public function formPenilaian($id)
    {
        $siswa = Siswa::findOrFail($id);
        $idSekolahSiswa = $siswa->id_sekolah;

        $formPenilaian = FormPenilaian::where('id_sekolah', $idSekolahSiswa)->firstOrFail();

        $kriteriaPenilaian = json_decode($formPenilaian->data_form);

        return view('penilai.formpenilaian', compact('siswa', 'kriteriaPenilaian'));
    }

    public function simpanNilai(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string|max:255',
        ]);

        $siswa = Siswa::findOrFail($id);
        $idSekolahSiswa = $siswa->id_sekolah;

        $formPenilaian = FormPenilaian::where('id_sekolah', $idSekolahSiswa)->firstOrFail();
        $kriteriaPenilaian = json_decode($formPenilaian->data_form);

        $data_penilaian = [];
        foreach ($kriteriaPenilaian as $kriteria) {
            // Ambil nama kriteria dari database, hilangkan spasi untuk memastikan sesuai dengan nama dari form
            $nama_kriteria = str_replace(' ', '', $kriteria->kriteria);
            
            // Ambil nilai kriteria dari request form berdasarkan nama kriteria yang sesuai
            $kriteria_value = $request->{$nama_kriteria};
            
            // Konversi nilai angka jika tipe kriteria adalah 'angka'
            if ($kriteria->tipe_kriteria == 'angka') {
                // Pastikan nilai berada di antara batas min dan max
                $kriteria_value = max($kriteria->min, min($kriteria_value, $kriteria->max));
            }

            // Simpan nilai kriteria ke dalam array $data_penilaian
            $data_penilaian[$kriteria->kriteria] = $kriteria_value;
        }

        // Cek apakah data penilaian sudah sesuai
        // Ini bisa digunakan untuk debugging jika nilai tidak tersimpan dengan benar
        // dd($data_penilaian);

        // Simpan data penilaian ke dalam database
        $hasil_penilaian = new HasilPenilaian();
        $hasil_penilaian->id_user = Auth::id();
        $hasil_penilaian->id_siswa = $id;
        $hasil_penilaian->id_form = $formPenilaian->id_form;
        $hasil_penilaian->data_penilaian = json_encode($data_penilaian);
        $hasil_penilaian->komentar = $request->komentar;
        $hasil_penilaian->save();

        return redirect()->route('penilai.datasiswa')->with('success', 'Hasil penilaian berhasil disimpan.');
    }


    public function showHasilPenilaianSiswa($idSiswa)
    {
        // Ambil data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($idSiswa);

        // Dapatkan ID user (penilai) yang terautentikasi
        $idUser = Auth::id();

        // Cari hasil penilaian berdasarkan ID siswa dan ID user (penilai)
        $hasilPenilaian = HasilPenilaian::where('id_siswa', $idSiswa)
            ->where('id_user', $idUser)
            ->first();

        // Jika hasil penilaian tidak ditemukan, redirect atau tampilkan pesan error
        if (!$hasilPenilaian) {
            return redirect()->route('penilai.datasiswa')->with('error', 'Hasil penilaian untuk siswa ini tidak ditemukan');
        }

        // Dekode data penilaian dari hasil penilaian
        $dataPenilaian = json_decode($hasilPenilaian->data_penilaian, true);

        // Dapatkan form penilaian berdasarkan ID form pada hasil penilaian
        $formPenilaian = FormPenilaian::findOrFail($hasilPenilaian->id_form);

        // Dekode data kriteria penilaian dari form penilaian
        $kriteriaPenilaian = json_decode($formPenilaian->data_form, true);

        return view('penilai.hasilnilai', [
            'siswa' => $siswa,
            'dataPenilaian' => $dataPenilaian,
            'kriteriaPenilaian' => $kriteriaPenilaian,
            'hasilPenilaian' => $hasilPenilaian, // Kirim data hasil penilaian ke view
        ]);
    }
    
    public function editHasilPenilaian($idHasilPenilaian)
    {
        // Dapatkan data hasil penilaian yang sudah ada
        $hasilPenilaian = HasilPenilaian::findOrFail($idHasilPenilaian);

        // Jika pengguna yang sedang login bukan pembuat hasil penilaian ini, redirect dengan pesan error
        if (Auth::id() !== $hasilPenilaian->id_user) {
            return redirect()->route('penilai.datasiswa')->with('error', 'Anda tidak diizinkan untuk mengedit hasil penilaian ini.');
        }

        // Dekode data penilaian dari hasil penilaian
        $dataPenilaian = json_decode($hasilPenilaian->data_penilaian, true);

        // Dapatkan form penilaian berdasarkan ID pada hasil penilaian
        $formPenilaian = FormPenilaian::findOrFail($hasilPenilaian->id_form);

        // Dekode data kriteria penilaian dari form penilaian
        $kriteriaPenilaian = json_decode($formPenilaian->data_form); // Kode sebelumnya: json_decode($formPenilaian->data_form, true);

        return view('penilai.edithasilpenilaian', [
            'siswa' => $hasilPenilaian->siswa,
            'dataPenilaian' => $dataPenilaian,
            'kriteriaPenilaian' => $kriteriaPenilaian,
            'hasilPenilaian' => $hasilPenilaian,
        ]);
    }

    public function updateHasilPenilaian(Request $request, $idHasilPenilaian)
    {
        $request->validate([
            'komentar' => 'required|string|max:255',
        ]);

        // Dapatkan data hasil penilaian yang sudah ada
        $hasilPenilaian = HasilPenilaian::findOrFail($idHasilPenilaian);

        // Jika pengguna yang sedang login bukan pembuat hasil penilaian ini, redirect dengan pesan error
        if (Auth::id() !== $hasilPenilaian->id_user) {
            return redirect()->route('penilai.datasiswa')->with('error', 'Anda tidak diizinkan untuk memperbarui hasil penilaian ini.');
        }

        // Dapatkan ID siswa untuk pengalihan kembali setelah memperbarui
        $idSiswa = $hasilPenilaian->id_siswa;

        // Dapatkan form penilaian berdasarkan ID pada hasil penilaian
        $formPenilaian = FormPenilaian::find($hasilPenilaian->id_form);

        // Jika form penilaian tidak ditemukan atau bernilai null
        if (!$formPenilaian) {
            return redirect()->route('penilai.showhasilpenilaian', ['idSiswa' => $hasilPenilaian->id_siswa])
                ->with('error', 'Form penilaian tidak ditemukan atau telah dihapus.');
        }

        $kriteriaPenilaian = json_decode($formPenilaian->data_form);

        $data_penilaian = [];
        foreach ($kriteriaPenilaian as $kriteria) {
            $nama_kriteria = str_replace(' ', '', $kriteria->kriteria);
            $kriteria_value = $request->{$nama_kriteria};
            if ($kriteria->tipe_kriteria == 'angka') {
                $kriteria_value = max($kriteria->min, min($kriteria_value, $kriteria->max));
            }
            $data_penilaian[$kriteria->kriteria] = $kriteria_value;
        }

        // Perbarui data hasil penilaian dengan data baru
        $hasilPenilaian->data_penilaian = json_encode($data_penilaian);
        $hasilPenilaian->komentar = $request->komentar;
        $hasilPenilaian->save();

        return redirect()->route('penilai.hasilpenilaian', ['id' => $hasilPenilaian->id_siswa])
            ->with('success', 'Hasil penilaian berhasil diperbarui.');
    }
}


