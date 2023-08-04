<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class AdminController extends Controller
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

        return view('admin.dashboardlte', compact('totaldata', 'jumlahMasihPKL', 'jumlahSelesaiPKL', 'totalsekolah', 'dataAsalInstansi', 'dataDivisiPKL'));
    }

    // public function index()
    // {
    //     return view('admin.dashboardlte');
    // }

    public function datauser(Request $request)
    {
        $users = User::query();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = Str::lower($request->search);
            $users->whereRaw('LOWER(username) LIKE ?', ["%{$searchTerm}%"]);
        }

        // Tambahkan kode pagination di sini
        $users = $users->paginate(5);

        // Panggil metode simplePaginate() untuk menghilangkan query string selain halaman
        Paginator::useBootstrap();

        return view('admin.datauser', compact('users', 'request'));
    }

    public function simpanUser(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'peran' => 'required|in:admin,sekolah,penilai',
        ]);

        // Cek apakah username sudah terdaftar di tabel 'users'
        $existingUser = User::where('username', $request->input('username'))->first();
        if ($existingUser) {
            return redirect()->route('admin.datauser')->with('error', 'Username sudah terdaftar. Silakan pilih username lain.');
        }

        $user = new User();
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        $user->peran = $request->input('peran');

        // Jika peran adalah "sekolah", cari id sekolah berdasarkan nama sekolah yang diinputkan oleh user
        if ($request->input('peran') == 'sekolah') {
            $namaSekolah = $request->input('nama'); // Ambil nama sekolah dari input user
            $sekolah = DB::table('sekolah')->where('nama_sekolah', $namaSekolah)->first();
            if ($sekolah) {
                $user->id_sekolah = $sekolah->id_sekolah;
            } else {
                // Jika sekolah tidak ditemukan, Anda dapat menentukan aksi yang sesuai, misalnya:
                return redirect()->route('admin.datauser')->with('error', 'Sekolah dengan nama ' . $namaSekolah . ' belum terdaftar.');
            }
        }

        $user->password = Hash::make('bpdkaltim123');
        $user->save();

        return redirect()->route('admin.datauser')->with('success', 'Data user berhasil ditambahkan.');
    }

    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'peran' => 'required|in:admin,sekolah,penilai',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        $user->peran = $request->input('peran');
        $user->save();

        return redirect()->route('admin.datauser')->with('success', 'Data user berhasil diupdate.');
    }

    public function hapusUser($id)
    {
        // Cari data user berdasarkan ID
        $user = User::find($id);

        // Jika data user ditemukan, hapus data
        if ($user) {
            $user->delete();
            return redirect()->route('admin.datauser')->with('success', 'Data user berhasil dihapus.');
        }

        // Jika data user tidak ditemukan, redirect kembali ke halaman data user dengan pesan error
        return redirect()->route('admin.datauser')->with('error', 'Data user tidak ditemukan.');
    }

    public function dataSekolah(Request $request)
    {
        $query = Sekolah::query();
    
        // Proses pencarian berdasarkan nama sekolah jika ada
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('nama_sekolah', 'LIKE', '%' . $searchTerm . '%');
        }
    
        // Lakukan pagination dengan 5 data per halaman
        $sekolahan = $query->paginate(5);
        
        // Panggil metode simplePaginate() untuk menghilangkan query string selain halaman
        Paginator::useBootstrap();
    
        return view('admin.datasekolah', compact('sekolahan', 'request'));
    }

    public function simpanSekolah(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:sekolah,nama_sekolah', // Menambahkan validasi unique untuk kolom 'nama_sekolah' di tabel 'sekolah'
        ]);

        $sekolah = Sekolah::create([
            'nama_sekolah' => $request->nama,
        ]);

        if ($sekolah) {
            return redirect()->route('admin.datasekolah')->with('success', 'Data sekolah berhasil ditambahkan.');
        } else {
            return redirect()->route('admin.datasekolah')->with('error', 'Sekolah Sudah Didaftarkan Sebelumnya.');
        }
    }

    public function updateSekolah(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $sekolah = Sekolah::find($id);
        if (!$sekolah) {
            return redirect()->route('admin.datasekolah')->with('error', 'Data sekolah tidak ditemukan.');
        }

        $sekolah->update([
            'nama_sekolah' => $request->nama,
        ]);

        return redirect()->route('admin.datasekolah')->with('success', 'Data sekolah berhasil diperbarui.');
    }

    public function hapusSekolah($id)
    {
        $sekolah = Sekolah::find($id);
        if (!$sekolah) {
            return redirect()->route('admin.datasekolah')->with('error', 'Data sekolah tidak ditemukan.');
        }

        $sekolah->delete();

        return redirect()->route('admin.datasekolah')->with('success', 'Data sekolah berhasil dihapus.');
    }

}
