<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function dashboardadmin()
    {
        $no_pendaftar = Auth::guard('pendaftaronline')->user()->no_pendaftaran;
        $pendaftar = DB::table('pendaftaran_online')->where('no_pendaftaran', $no_pendaftar)->first();
        $pembayaran = DB::table('konfirmasi_pembayaran')->where('no_pendaftaran', $no_pendaftar)->first();
        return view('dashboard.administrator', compact('pendaftar', 'pembayaran'));
    }
}
