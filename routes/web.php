<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenispembiayaanController;
use App\Http\Controllers\JenissimpananController;
use App\Http\Controllers\LoaddataController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembiayaanController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\TagihanController;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('introduction.index');
});

Route::get('/login', function () {
    return view('Auth.login');
})->name('login');


Route::get('/register', [AuthController::class, 'register']);
Route::post('/storeregister', [AuthController::class, 'storeregister']);
Route::post('/ceknik', [AuthController::class, 'ceknik']);


Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::post('/postlogout', [AuthController::class, 'postlogout']);

Route::middleware(['auth:orangtua', 'ceklevel:orangtua'])->group(function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/tagihan/{id_siswa}/list', [TagihanController::class, 'list']);
    Route::get('/tagihan/{no_pendaftaran}/show', [TagihanController::class, 'show']);
    Route::post('/tagihan/getsppta', [TagihanController::class, 'getsppta']);
    Route::post('/tagihan/getspptaasrama', [TagihanController::class, 'getspptaasrama']);
    Route::post('/tagihan/getdetailtransaksi', [TagihanController::class, 'getdetailtransaksi']);

    //Tabungan
    Route::get('/tabungan/{nik}/list', [TabunganController::class, 'list']);
    Route::get('/tabungan/{id_siswa}/detail', [TabunganController::class, 'detail']);
    Route::get('/tabungan/{kode_tabungan}/{id_siswa}/histori', [TabunganController::class, 'histori']);
});
