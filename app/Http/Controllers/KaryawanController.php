<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class KaryawanController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');

        $data = Mahasiswa::where('nama_mahasiswa', 'LIKE', "%$search%")
            ->paginate(5);

        return view('karyawan.dashboard', compact('data', 'search'));
    }

    public function depan()
    {
        // Menghitung total data mahasiswa
        $totaldata = Mahasiswa::count();

        // Menghitung jumlah mahasiswa yang baru memulai PKL dalam 7 hari terakhir
        $tanggalTujuhHariSebelumnya = Carbon::now()->subDays(7);
        $jumlahMahasiswaBaru = Mahasiswa::where('tanggal_mulai', '>=', $tanggalTujuhHariSebelumnya)->count();

        // Menghitung jumlah mahasiswa yang telah lama memulai PKL sebelum 7 hari terakhir
        $jumlahMahasiswaLama = Mahasiswa::where('tanggal_mulai', '<', $tanggalTujuhHariSebelumnya)->count();

        // Menghitung jumlah asal instansi yang berbeda
        $totalAsalInstansi = DB::table('mahasiswas')->distinct('asal_instansi')->count('asal_instansi');

        // Menghitung jumlah mahasiswa berdasarkan asal instansi
        $dataAsalInstansi = Mahasiswa::select('asal_instansi', DB::raw('COUNT(*) as total'))
            ->groupBy('asal_instansi')
            ->paginate(5, ['*'], 'page_instansi') // Add pagination with 5 records per page, 'page_instansi' is the query parameter for the page number.
            ->appends(request()->query()); // Append any existing query parameters to the pagination links.

        // Menghitung jumlah mahasiswa berdasarkan divisi PKL
        $dataDivisiPKL = Mahasiswa::select('divisi_pkl', DB::raw('COUNT(*) as total'))
            ->groupBy('divisi_pkl')
            ->paginate(5, ['*'], 'page_divisi') // Add pagination with 5 records per page, 'page_divisi' is the query parameter for the page number.
            ->appends(request()->query());

        return view('karyawan.dashboardlte', compact('totaldata', 'jumlahMahasiswaBaru', 'jumlahMahasiswaLama', 'totalAsalInstansi', 'dataAsalInstansi', 'dataDivisiPKL'));
    }

    
    public function index(){

        $data = Mahasiswa::paginate(5);
        
        // Ambil ID mahasiswa yang ditampilkan
        $studentIds = $data->pluck('id_mahasiswa')->toArray();

        // Ambil ID mahasiswa yang sudah dinilai oleh pengguna yang sedang login
        $ratedStudentIds = Penilaian::where('user_id', session('id'))
                                    ->whereIn('id_mahasiswa', $studentIds)
                                    ->pluck('id_mahasiswa')
                                    ->toArray();

        // Siapkan array asosiatif untuk menyimpan status untuk setiap mahasiswa
        $studentStatus = [];
        foreach ($studentIds as $id) {
            if (in_array($id, $ratedStudentIds)) {
                $studentStatus[$id] = 'Sudah Dinilai';
            } else {
                $studentStatus[$id] = 'Belum Dinilai';
            }
        }

        return view('karyawan.dashboard', compact('data', 'studentStatus'));
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
            'sopansantun' => 'required|integer|min:1|max:10'
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

        $nilai_rata = ($request->disiplin + $request->kinerja + $request->rapi + $request->sopansantun) / 4;

        // Jika nilai rata-rata tidak mencapai batas yang diinginkan, minta pengguna untuk menuliskan komentar
        if ($nilai_rata < 7) {
            $request->validate([
                'komentar' => 'required|string',
            ], [
                'komentar.required' => 'Mohon masukkan komentar',
                'komentar.string' => 'Komentar harus berupa teks',
            ]);
        } else {
            // Jika nilai rata-rata tercapai, buat kolom komentar opsional
            $request->validate([
                'komentar' => 'nullable|string',
            ], [
                'komentar.string' => 'Komentar harus berupa teks',
            ]);
        }

        // Dapatkan ID pengguna yang sedang login dari session
        $userId = session('id');
        $id = $id;

        

        // Periksa apakah penilaian sudah dilakukan sebelumnya
        $existingPenilaian = Penilaian::where('user_id', $userId)
        ->where('id_mahasiswa', $id)
        ->first();

        if ($existingPenilaian) {
        // Jika penilaian sudah ada, karyawan tidak diizinkan untuk menilai lagi
        return redirect()->route('homekaryawan')->withErrors(['penilaian' => 'Anda telah memberikan penilaian untuk mahasiswa ini.']);
        }
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
        return redirect()->route('homekaryawan')->with('success', 'Penilaian berhasil disimpan.');



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
    
        return view('karyawan.hasilnilai', compact('hasilPenilaian', 'id'));
    }

    public function ubahNilai($id_penilaian) {
        $penilaian = Penilaian::find($id_penilaian);
    
        return view('karyawan.ubahnilai', compact('penilaian'));
    }

    public function simpanUbahNilai(Request $request, $id_penilaian) {
        $request->validate([
            'kedisiplinan' => 'required|integer|min:1|max:10',
            'kinerja' => 'required|integer|min:1|max:10',
            'rapi' => 'required|integer|min:1|max:10',
            'sopansantun' => 'required|integer|min:1|max:10'
        ], [
            'kedisiplinan.required' => 'Mohon masukkan nilai kedisiplinan',
            'kedisiplinan.integer' => 'Nilai kedisiplinan harus berupa angka',
            'kedisiplinan.min' => 'Nilai kedisiplinan harus di antara 1 hingga 10',
            'kedisiplinan.max' => 'Nilai kedisiplinan harus di antara 1 hingga 10',
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
            'komentar.string' => 'Komentar harus berupa teks',
        ]);
    
        // Temukan penilaian berdasarkan ID
        $penilaian = Penilaian::find($id_penilaian);
    
        // Update nilai penilaian
        $penilaian->kedisiplinan = $request->kedisiplinan;
        $penilaian->kinerja_kerja = $request->kinerja;
        $penilaian->kerapian = $request->rapi;
        $penilaian->kesopanan = $request->sopansantun;
        $penilaian->komentar = $request->komentar;
        $penilaian->save();
    
        return redirect()->route('homekaryawan')->with('success', 'Nilai berhasil diubah.');
    }      

}
