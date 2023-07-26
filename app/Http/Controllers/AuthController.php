<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index() {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Mohon Masukkan Username Anda',
            'password.required' => 'Mohon Masukkan Password Anda'
        ]);

        $credentials = $request->only('username', 'password');

        // Cari pengguna berdasarkan kolom "username"
        $user = User::where('username', $credentials['username'])->first();

        // Verifikasi apakah pengguna ditemukan dan password yang dimasukkan benar
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            session(['peran' => $user->peran]);
            session(['id' => $user->id]);
            session(['nama' => $user->nama]);
            session(['id_sekolah' => $user->id_sekolah]);


            return view('index'); // Alihkan ke halaman "index" setelah login berhasil
        } else {
            return back()->withErrors([
                'gagal' => 'Username atau Password salah'
            ])->withInput();
        }
    }

    public function logout() {
        Auth::logout();
        session()->flush();

        return redirect()->route('login');
    }
}
