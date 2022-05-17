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
        $siswa = DB::table('siswa')->where('nik_ayah', $nik)->orWhere('nik_ibu', $nik)->get();
        return view('home.index', compact('siswa'));
    }
}
