<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $nik = Auth::guard('orangtua')->user()->nik;
        $hariini = date("Y-m-d");


        $saldo = DB::table('koperasi_tabungan')
            ->selectRaw("SUM(saldo) as totalsaldo")
            ->join('koperasi_anggota', 'koperasi_tabungan.no_anggota', '=', 'koperasi_anggota.no_anggota')
            ->join('siswa', 'koperasi_anggota.id_siswa', '=', 'siswa.id_siswa')
            ->where('nik_ayah', $nik)->orWhere('nik_ibu', $nik)->first();
        $siswa = DB::table('siswa')->where('nik_ayah', $nik)->orWhere('nik_ibu', $nik)->get();
        // $absensi = DB::table('presensi_siswa')
        //     ->join('siswa', 'presensi_siswa.id_siswa', '=', 'siswa.id_siswa')
        //     ->where('nik_ayah', $nik)
        //     ->where('presence_date', $hariini)
        //     ->orWhere('nik_ibu', $nik)
        //     ->where('presence_date', $hariini)
        //     ->get();
        return view('home.index', compact('siswa', 'saldo', 'nik'));
    }
}
