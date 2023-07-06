<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class AuthController extends Controller
{
    function index()
    {
        return view('login.login');
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
            ]);
        }
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
