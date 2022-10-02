<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function postlogin(Request $request)
    {
        if (Auth::guard('orangtua')->attempt(['nik' => $request->nik, 'password' => $request->password])) {
            return redirect('/home');
        } else {
            return redirect('/login')->with(['warning' => 'Username / Password Salah']);
        }
    }

    public function postlogout(Request $request)
    {
        Auth::guard('orangtua')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register()
    {
        return view('Auth.register');
    }

    public function storeregister(Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);

        $data = [
            'nik' => $nik,
            'nama_lengkap' => $nama_lengkap,
            'no_hp' => $no_hp,
            'password' => $password,
            'level' => 'orangtua'
        ];

        $simpan = DB::table('user_orangtua')->insert($data);

        if ($simpan) {
            return redirect('/login')->with(['success' => 'Akun Berhasil Dibuat']);
        } else {
            return redirect('/register')->with(['warning' => 'Akun Gagal Dibuat, Hubungi Bagian Pesantren']);
        }
    }

    public function ceknik(Request $request)
    {
        $nik = $request->nik;
        $ceknik = DB::table('siswa')->where('nik_ayah', $nik)->orWhere('nik_ibu', $nik)->count();
        echo $ceknik;
    }
}
