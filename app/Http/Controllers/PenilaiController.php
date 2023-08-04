<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\FormPenilaian;
use App\Models\HasilPenilaian;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dompdf\Dompdf;
use Dompdf\Options;


class PenilaiController extends Controller
{
    public function index()
    {
        // Menghitung total data mahasiswa
        $totaldata = Siswa::count();

        // Menghitung jumlah mahasiswa yang baru memulai PKL dalam 7 hari terakhir
        $today = date('Y-m-d');
        $jumlahMasihPKL = Siswa::where('tanggal_berakhir', '>', $today)->count();

        // Menghitung jumlah mahasiswa yang telah lama memulai PKL sebelum 7 hari terakhir
        $jumlahSelesaiPKL = Siswa::where('tanggal_berakhir', '<=', $today)->count();

        // Menghitung jumlah asal instansi yang berbeda
        $totalsekolah = Sekolah::count();

        // Menghitung jumlah mahasiswa berdasarkan asal instansi
        $dataAsalInstansi = Siswa::select('id_sekolah', DB::raw('COUNT(*) as total'))
            ->groupBy('id_sekolah')
            ->paginate(5, ['*'], 'page_instansi') // Add pagination with 5 records per page, 'page_instansi' is the query parameter for the page number.
            ->appends(request()->query()); // Append any existing query parameters to the pagination links.

        // Menghitung jumlah mahasiswa berdasarkan divisi PKL
        $dataDivisiPKL = Siswa::select('divisi_pkl', DB::raw('COUNT(*) as total'))
            ->groupBy('divisi_pkl')
            ->paginate(5, ['*'], 'page_divisi') // Add pagination with 5 records per page, 'page_divisi' is the query parameter for the page number.
            ->appends(request()->query());

        if (request()->has('page_total')) {
            Paginator::currentPageResolver(function () {
                return request()->query('page_total');
            });
        }

        return view('penilai.dashboard', compact('totaldata', 'jumlahMasihPKL', 'jumlahSelesaiPKL', 'totalsekolah', 'dataAsalInstansi', 'dataDivisiPKL'));
    }

    public function datasiswa(Request $request)
    {
        $siswaQuery = Siswa::query();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $siswaQuery->where(function (Builder $query) use ($search) {
                $query->where('nama_siswa', 'like', '%' . $search . '%');
            });
        }

        // Mengurutkan data siswa sesuai abjad berdasarkan nama siswa
        $siswaQuery->orderBy('nama_siswa');

        // Menampilkan data siswa dengan pagination
        $data = $siswaQuery->paginate(5)->appends($request->query());

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
            'komentar' => 'required|string',
        ]);

        $siswa = Siswa::findOrFail($id);
        $idSekolahSiswa = $siswa->id_sekolah;

        $formPenilaian = FormPenilaian::where('id_sekolah', $idSekolahSiswa)->firstOrFail();
        $kriteriaPenilaian = json_decode($formPenilaian->data_form);

        // Check if the user has already submitted an evaluation for this student
        $existingEvaluation = HasilPenilaian::where('id_user', Auth::id())
        ->where('id_siswa', $id)
        ->exists();

        if ($existingEvaluation) {
        return redirect()->route('penilai.datasiswa')->with('error', 'Anda sudah melakukan penilaian terhadap siswa ini sebelumnya.');
        }

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

    public function cetakPDF($idHasilPenilaian)
    {
        $hasilPenilaian = HasilPenilaian::findOrFail($idHasilPenilaian);

        // Buat objek Dompdf dan set defaultFont
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);

        // Load view dengan menggunakan $dompdf->loadHtml() dan sertakan data yang diperlukan
        $pdfView = view('penilai.hasilnilai_pdf', [
            'siswa' => $hasilPenilaian->siswa,
            'dataPenilaian' => json_decode($hasilPenilaian->data_penilaian, true),
            'kriteriaPenilaian' => json_decode($hasilPenilaian->formPenilaian->data_form, true),
            'hasilPenilaian' => $hasilPenilaian,
        ]);

        $dompdf->loadHtml($pdfView);

        // Render PDF
        $dompdf->render();

        // Menggunakan $dompdf->stream() untuk menampilkan PDF atau $dompdf->output() untuk menyimpannya dalam variabel
        return $dompdf->stream('hasil_penilaian_'.$hasilPenilaian->siswa->nama_siswa.'.pdf');
    }
}


