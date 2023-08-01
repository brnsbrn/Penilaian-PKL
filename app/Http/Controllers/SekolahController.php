<?php

namespace App\Http\Controllers;

use App\Models\FormPenilaian;
use App\Models\HasilPenilaian;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use App\Models\Sekolah;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class SekolahController extends Controller
{
    public function index() 
    {
        {
            // Mendapatkan id_sekolah dari session
            $idsekolah = session('id_sekolah');
        
            // Menghitung total data mahasiswa berdasarkan id_sekolah
            $totalsiswa = Siswa::where('id_sekolah', $idsekolah)->count();
        
            // Menghitung jumlah mahasiswa yang baru memulai PKL dalam 7 hari terakhir berdasarkan id_sekolah
            $today = date('Y-m-d');
            $jumlahMasihPKL = Siswa::where('id_sekolah', $idsekolah)->where('tanggal_berakhir', '>', $today)->count();
        
            // Menghitung jumlah mahasiswa yang telah lama memulai PKL sebelum 7 hari terakhir berdasarkan id_sekolah
            $jumlahSelesaiPKL = Siswa::where('id_sekolah', $idsekolah)->where('tanggal_berakhir', '<=', $today)->count();

            // Menghitung jumlah mahasiswa berdasarkan divisi PKL
            $dataDivisiPKL = Siswa::where('id_sekolah', $idsekolah)
            ->selectRaw('divisi_pkl, COUNT(*) as total')
            ->groupBy('divisi_pkl')
            ->paginate(5, ['*'], 'page_divisi')
            ->appends(request()->query());
        
            return view('sekolah.dashboard', compact('totalsiswa', 'jumlahMasihPKL', 'jumlahSelesaiPKL','dataDivisiPKL'));
        }
    }

    public function datasiswa(Request $request)
    {
        // Ambil id_sekolah dari session user yang sedang login
        $idSekolah = Auth::user()->id_sekolah;

        // Mengambil data siswa berdasarkan id_sekolah
        $siswaQuery = Siswa::where('id_sekolah', $idSekolah);

        // Pencarian berdasarkan nama siswa jika ada input search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $siswaQuery->where(function (Builder $query) use ($search) {
                $query->where('nama_siswa', 'like', '%' . $search . '%');
            });
        }

        // Mengurutkan data siswa sesuai abjad berdasarkan nama siswa
        $siswaQuery->orderBy('nama_siswa');

        // Menampilkan data siswa dengan pagination
        $siswa = $siswaQuery->paginate(5)->appends(request()->query());

        return view('sekolah.datasiswa', compact('siswa'));
    }

    public function hasilPenilaianSiswa($idSiswa)
    {
        // Ambil data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($idSiswa);
    
        // Cari hasil penilaian berdasarkan ID siswa
        $hasilPenilaian = HasilPenilaian::where('id_siswa', $idSiswa)->get();
    
        // Jika hasil penilaian tidak ditemukan, redirect atau tampilkan pesan error
        if ($hasilPenilaian->isEmpty()) {
            return redirect()->route('sekolah.datasiswa')->with('error', 'Hasil penilaian untuk siswa ini tidak ditemukan');
        }
    
        // Dekode data penilaian dari hasil penilaian
        $dataPenilaian = [];
        foreach ($hasilPenilaian as $hasil) {
            $dataPenilaian[] = json_decode($hasil->data_penilaian, true);
        }
    
        // Dapatkan form penilaian berdasarkan ID form pada hasil penilaian
        $formPenilaian = FormPenilaian::findOrFail($hasilPenilaian[0]->id_form);
    
        // Dekode data kriteria penilaian dari form penilaian
        $kriteriaPenilaian = json_decode($formPenilaian->data_form, true);
    
        // Hitung nilai rata-rata tiap kriteria
        $nilaiRataRata = [];
        foreach ($kriteriaPenilaian as $kriteria) {
            $totalNilai = 0;
            $jumlahPenilai = 0;
            foreach ($dataPenilaian as $data) {
                if (isset($data[$kriteria['kriteria']])) {
                    $totalNilai += $data[$kriteria['kriteria']];
                    $jumlahPenilai++;
                }
            }
            $rataRata = $jumlahPenilai > 0 ? $totalNilai / $jumlahPenilai : 0;
            $nilaiRataRata[$kriteria['kriteria']] = $rataRata;
        }
    
        // Hitung nilai total
        $totalRataRata = array_sum($nilaiRataRata);
        $jumlahKriteria = count($kriteriaPenilaian);
        $nilaiTotal = $jumlahKriteria > 0 ? $totalRataRata / $jumlahKriteria : 0;
    
        return view('sekolah.hasilpenilaian', [
            'siswa' => $siswa,
            'dataPenilaian' => $dataPenilaian,
            'kriteriaPenilaian' => $kriteriaPenilaian,
            'nilaiRataRata' => $nilaiRataRata,
            'nilaiTotal' => $nilaiTotal,
            'hasilPenilaian' => $hasilPenilaian, // Kirim data hasil penilaian ke view
        ]);
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

        return redirect()->route('sekolah.showdataform')->with('success', 'Data kriteria penilaian berhasil disimpan');
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
