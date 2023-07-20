<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{   
    public function halbaru()
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

        return view('admin.dashboardlte', compact('totaldata', 'jumlahMahasiswaBaru', 'jumlahMahasiswaLama', 'totalAsalInstansi', 'dataAsalInstansi', 'dataDivisiPKL'));
    }
    
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;
            $data = Mahasiswa::where('nama_mahasiswa', 'LIKE', '%' . $search . '%')->get();
        } else {
            $data = Mahasiswa::paginate(5);
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
