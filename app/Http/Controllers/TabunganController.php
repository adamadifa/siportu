<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class TabunganController extends Controller
{
    public function list($nik)
    {
        $nik = Crypt::decrypt($nik);
        $list = DB::table('koperasi_tabungan')
            ->selectRaw("koperasi_anggota.id_siswa,koperasi_anggota.nama_lengkap,SUM(saldo) as totalsaldo")
            ->join('koperasi_anggota', 'koperasi_tabungan.no_anggota', '=', 'koperasi_anggota.no_anggota')
            ->join('siswa', 'koperasi_anggota.id_siswa', '=', 'siswa.id_siswa')
            ->where('nik_ayah', $nik)->orWhere('nik_ibu', $nik)
            ->groupBy('koperasi_anggota.id_siswa', 'koperasi_anggota.nama_lengkap')
            ->get();

        return view('tabungan.list', compact('list'));
    }

    public function detail($id_siswa)
    {
        $id_siswa = Crypt::decrypt($id_siswa);
        $detail = DB::table('koperasi_tabungan')
            ->selectRaw("koperasi_tabungan.kode_tabungan,nama_tabungan,no_rekening,saldo")
            ->join('koperasi_anggota', 'koperasi_tabungan.no_anggota', '=', 'koperasi_anggota.no_anggota')
            ->join('koperasi_jenistabungan', 'koperasi_tabungan.kode_tabungan', '=', 'koperasi_jenistabungan.kode_tabungan')
            ->where('koperasi_anggota.id_siswa', $id_siswa)
            ->get();
        return view('tabungan.detail', compact('detail', 'id_siswa'));
    }

    public function histori($no_rekening, $id_siswa)
    {
        $no_rekening = Crypt::decrypt($no_rekening);
        $id_siswa = Crypt::decrypt($id_siswa);
        $histori = DB::table('koperasi_tabungan_histori')->where('no_rekening', $no_rekening)
            ->orderBy('tgl_transaksi')
            ->get();

        return view('tabungan.histori', compact('histori'));
    }
}
