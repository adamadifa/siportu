<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class TagihanController extends Controller
{
    public function list($id_siswa)
    {
        $id_siswa = Crypt::decrypt($id_siswa);
        $jenjang = DB::table('pendaftaran')->where('id_siswa', $id_siswa)->get();
        return view('tagihan.list', compact('jenjang'));
    }

    public function show($no_pendaftaran)
    {
        $no_pendaftaran = Crypt::decrypt($no_pendaftaran);
        $pembayaran = DB::table('pendaftaran')
            ->select(
                'pendaftaran.*',
                'nisn',
                'nama_lengkap',
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'anak_ke',
                'jml_saudara',
                'alamat',
                'id_propinsi',
                'prov_name',
                'id_kota',
                'regc_name',
                'id_kecamatan',
                'dist_name',
                'id_kelurahan',
                'vill_name',
                'kodepos',
                'no_kk',
                'nik_ayah',
                'nama_ayah',
                'pendidikan_ayah',
                'pekerjaan_ayah',
                'nik_ibu',
                'nama_ibu',
                'pendidikan_ibu',
                'pekerjaan_ibu',
                'no_hp_ortu'
            )
            ->join('siswa', 'pendaftaran.id_siswa', '=', 'siswa.id_siswa')
            ->leftjoin('pekerjaan as pa', 'siswa.pekerjaan_ayah', '=', 'pa.id')
            ->leftjoin('pekerjaan as pi', 'siswa.pekerjaan_ibu', '=', 'pi.id')
            ->leftjoin('provinces', 'siswa.id_propinsi', '=', 'provinces.id')
            ->leftjoin('regencies', 'siswa.id_kota', '=', 'regencies.id')
            ->leftjoin('districts', 'siswa.id_kecamatan', '=', 'districts.id')
            ->leftjoin('villages', 'siswa.id_kelurahan', '=', 'villages.id')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->first();

        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $ta_aktif = DB::table('tahunakademik')->where('status', 1)->first();
        $tahunakademik = DB::table('rincian_biaya_siswa')
            ->select('tahunakademik')
            ->join('biaya', 'rincian_biaya_siswa.kodebiaya', '=', 'biaya.kodebiaya')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->groupBy('tahunakademik')
            ->get();
        $databiaya = DB::table('detailbiaya as db')
            ->select(
                'rincian_biaya_siswa.no_pendaftaran',
                'db.kodebiaya',
                'db.id_jenisbayar',
                'jenisbayar',
                'tahunakademik',
                'jenjang',
                'tingkat',
                'jumlah_biaya',
                'totalbayar',
                'jumlah_potongan',
                'jumlah_mutasi',
                'no_rencana_spp',
                'jml_rencana_spp',
                'jml_mutasi_spp',
                'no_rencana_um',
                'jml_rencana_um',
                'jml_mutasi_um'
            )
            ->join('biaya', 'db.kodebiaya', '=', 'biaya.kodebiaya')
            ->join('jenisbayar', 'db.id_jenisbayar', '=', 'jenisbayar.id')
            ->join('rincian_biaya_siswa', 'db.kodebiaya', '=', 'rincian_biaya_siswa.kodebiaya')
            ->leftJoin('potongan', function ($join) {
                $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'potongan.no_pendaftaran')
                    ->on('db.kodebiaya', '=', 'potongan.kodebiaya')
                    ->on('db.id_jenisbayar', '=', 'potongan.id_jenisbayar');
            })

            ->leftJoin('mutasi', function ($join) {
                $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'mutasi.no_pendaftaran')
                    ->on('db.kodebiaya', '=', 'mutasi.kodebiaya')
                    ->on('db.id_jenisbayar', '=', 'mutasi.id_jenisbayar');
            })
            ->leftJoin('rencana_spp', function ($join) {
                $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'rencana_spp.no_pendaftaran')
                    ->on('db.kodebiaya', '=', 'rencana_spp.kodebiaya');
            })

            ->leftJoin('rencana_uangmakan', function ($join) {
                $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'rencana_uangmakan.no_pendaftaran')
                    ->on('db.kodebiaya', '=', 'rencana_uangmakan.kodebiaya');
            })

            ->leftJoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,id_jenisbayar,SUM(jumlah_bayar) as totalbayar
            FROM historibayar_detail
            INNER JOIN historibayar ON historibayar_detail.no_transaksi = historibayar.no_transaksi
            GROUP BY no_pendaftaran,kodebiaya,id_jenisbayar) bayar'),
                function ($join) {
                    $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'bayar.no_pendaftaran');
                    $join->on('db.kodebiaya', '=', 'bayar.kodebiaya');
                    $join->on('db.id_jenisbayar', '=', 'bayar.id_jenisbayar');
                }
            )

            ->leftJoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,SUM(jumlah) as jml_rencana_spp,SUM(jumlah_mutasi) as jml_mutasi_spp
                FROM rencana_spp_detail rsd
                INNER JOIN rencana_spp rs ON rsd.no_rencana_spp = rs.no_rencana_spp
                GROUP BY no_pendaftaran,kodebiaya) rs'),
                function ($join) {
                    $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'rs.no_pendaftaran');
                    $join->on('db.kodebiaya', '=', 'rs.kodebiaya');
                }
            )

            ->leftJoin(
                DB::raw('(SELECT no_pendaftaran,kodebiaya,SUM(jumlah) as jml_rencana_um,SUM(jumlah_mutasi) as jml_mutasi_um
                FROM rencana_uangmakan_detail rmd
                INNER JOIN rencana_uangmakan rm ON rmd.no_rencana_um = rm.no_rencana_um
                GROUP BY no_pendaftaran,kodebiaya) rm'),
                function ($join) {
                    $join->on('rincian_biaya_siswa.no_pendaftaran', '=', 'rm.no_pendaftaran');
                    $join->on('db.kodebiaya', '=', 'rm.kodebiaya');
                }
            )

            ->where('rincian_biaya_siswa.no_pendaftaran', $no_pendaftaran)
            ->orderBy('tahunakademik', 'asc')
            ->orderBy('biaya.jenjang', 'desc')
            ->orderBy('db.id_jenisbayar', 'asc')
            ->get();

        $historibayar = DB::table('historibayar')
            ->select('historibayar.no_transaksi', 'tgl_transaksi', 'totalbayar', 'name', 'status_transaksi', 'historibayar.created_at')
            ->join('users', 'historibayar.id_user', '=', 'users.id')
            ->leftjoin(
                DB::raw('(SELECT no_transaksi, SUM(jumlah_bayar) as totalbayar
                FROM historibayar_detail
                GROUP BY no_transaksi) hb_detail'),
                function ($join) {
                    $join->on('historibayar.no_transaksi', '=', 'hb_detail.no_transaksi');
                }
            )
            ->where('no_pendaftaran', $no_pendaftaran)
            ->get();

        return view('tagihan.show', compact('namabulan', 'ta_aktif', 'tahunakademik', 'databiaya', 'pembayaran', 'historibayar'));
    }


    function getsppta(Request $request)
    {
        $tahunakademik = $request->tahunakademik;

        $no_pendaftaran = $request->no_pendaftaran;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $databiaya = DB::table('rencana_spp_detail')
            ->select('rencana_spp.no_pendaftaran', 'rencana_spp.kodebiaya', 'bulan', 'jumlah', 'jumlah_mutasi')
            ->join('rencana_spp', 'rencana_spp_detail.no_rencana_spp', '=', 'rencana_spp.no_rencana_spp')
            ->join('biaya', 'rencana_spp.kodebiaya', 'biaya.kodebiaya')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('tahunakademik', $tahunakademik)
            ->where('jenjang', '!=', 'ASRAMA')
            ->get();

        //dd($databiaya);
        return view('tagihan.getspp', compact('databiaya', 'namabulan', 'no_pendaftaran'));
    }

    function getspptaasrama(Request $request)
    {
        $tahunakademik = $request->tahunakademik;
        $no_pendaftaran = $request->no_pendaftaran;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $databiaya = DB::table('rencana_spp_detail')
            ->select('rencana_spp.no_pendaftaran', 'rencana_spp.kodebiaya', 'bulan', 'jumlah')
            ->join('rencana_spp', 'rencana_spp_detail.no_rencana_spp', '=', 'rencana_spp.no_rencana_spp')
            ->join('biaya', 'rencana_spp.kodebiaya', 'biaya.kodebiaya')
            ->where('no_pendaftaran', $no_pendaftaran)
            ->where('tahunakademik', $tahunakademik)
            ->where('jenjang', 'ASRAMA')
            ->get();


        return view('tagihan.getsppasrama', compact('databiaya', 'namabulan', 'no_pendaftaran'));
    }


    function getdetailtransaksi(Request $request)
    {
        $namabulan = ["", "Januari", "Februaru", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $detail = DB::table('historibayar_detail')
            ->join('biaya', 'historibayar_detail.kodebiaya', '=', 'biaya.kodebiaya')
            ->join('jenisbayar', 'historibayar_detail.id_jenisbayar', '=', 'jenisbayar.id')
            ->where('no_transaksi', $request->notransaksi)
            ->get();
        return view('tagihan.getdetailtransaksi', compact('detail', 'namabulan'));
    }
}
