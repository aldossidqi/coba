<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\CustomerModel;

class LoginController extends Controller
{
     public function login(){
        return view('login');
    }
    public function loginCheck(Request $Request){
        
        $validator = $this->validate($Request,[
                    'username' => 'required',
                    'password' => 'required'
                ],[
                    'username.required' => "Username tidak boleh kosong",
                    'password.required' => "Password tidak boleh kosong"
                ]);

        if(auth()->guard('pemilik')->attempt([
                "username" => $Request->username,
                "password" => $Request->password,
                "pekerjaan" => "pemilik"
        ])){
            return redirect('/pemilik')->with('success', 'Selamat Datang pemilik');
        } else if (auth()->guard('pegawai')->attempt([
                "username" => $Request->username,
                "password" => $Request->password,
                "pekerjaan" => "pegawai" 
        ])){
            return redirect('/pegawai/')->with('success', 'Selamat Datang pegawai');

        } else if (auth()->guard('customer')->attempt([
                "username" => $Request->username,
                "password" => $Request->password,
                "pekerjaan" => "customer" 
        ])){
            return redirect('/situs_online/'.$Request->username)->with('success', 'Selamat Datang customer');

        }  
        else{
            return redirect('/login')->with('danger', 'Username atau Sandi salah');
        }
    }
    public function logout(){
        if(auth()->guard('pemilik')->check()){
            auth()->guard('pemilik')->logout();
            return redirect(url('/'));
        } else if (auth()->guard('pegawai')->check()){
            auth()->guard('pegawai')->logout();
            return redirect(url('/'));
        } else if (auth()->guard('customer')->check()){
            auth()->guard('customer')->logout();
            return redirect(url('/'));
        } else{
            return redirect(url('/login'));
        }
    }
    public function register(){
        return view('register');
    }
    public function store(Request $Request){
        $this->validate($Request, [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.confirmed' => 'Password tidak cocok'
        ]
    );

        User::create([
            'nama' => $Request['nama'],
            'username' => $Request['username'],
            'pekerjaan' => "pemilik",
            'password' => bcrypt($Request['password']),
        ]);
        CustomerModel::create([
            'user_id' => $Request['username'],
            'nama_customer' => $Request['nama'],
            'alamat' => "-",
            'email' => "-",
            'no_hp' => "-"
            
        ]);
        return redirect('/login')->with('success', 'Akun berhasil didaftarkan!');
    }

}
