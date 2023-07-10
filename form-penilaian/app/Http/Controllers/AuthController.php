<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function index()
    {
        return view('login.login');
    }

    public function regis() {
        return view('login.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 'karyawan'; // Set role default
        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login dengan akun Anda.');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Mohon Masukkan Email Anda',
            'password.required' => 'Mohon Masukkan Password Anda'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            session(['role' => $user->role]);
            session(['id' => $user->id]);
            session(['name' => $user->name]);

            return view('index');
        } else {
            return back()->withErrors([
                'email' => 'Email atau Password salah'
            ])->withInput();
        }
    }

    public function logout() {
        Auth::logout();
        session()->flush();

        return redirect()->route('login');
    }


    // function login(Request $request)
    // {
    //     $inp = $request->all();
    //     $request->validate([
    //         'email'=>'required',
    //         'password'=>'required'
    //     ],[
    //         'email.required'=>'Mohon Masukkan Email Anda',
    //         'password.required'=>'Mohon Masukkan Password Anda'
    //     ]);

    //     $infologin = [
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         "name" => $request->name,
    //     ];

    //     $userdata = UserData::DataUser($inp);
        
    //     session(['role' => $userdata[0]->role]);
    //     session(['id' => $userdata[0]->id]);
    //     session(['name' => $userdata[0]->name]);

        
    //     return view('index');
    // }
}
