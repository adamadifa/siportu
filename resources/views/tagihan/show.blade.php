@extends('layouts.fimobile')
@section('titlepage','Register')
@section('content')
@include('layouts.sidebar')
<div class="wrapper">
    @include('layouts.header')
    <div class="container">
        <!-- page content here -->
        <h6 class="subtitle">Detail Tagihan</h6>
        <div class="card shadow-sm border-0 mb-3 wizard">
            <div class="card-header p-0">
                <ul class="nav nav-tabs tabs-md nav-justified" role="tablist">
                    <li role="presentation" class="nav-item">
                        <a href="#step13" class="nav-link border-primary active" data-toggle="tab" aria-controls="step13" role="tab" title="Step 1" aria-selected="true">Tagihan</a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a href="#step23" class="nav-link border-primary" data-toggle="tab" aria-controls="step23" role="tab" title="Step 2" aria-selected="false">Rincian SPP</a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a href="#step33" class="nav-link border-primary" data-toggle="tab" aria-controls="step33" role="tab" title="Step 3" aria-selected="false">Histori Bayar</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step13">
                        <p class="mb-0 text-secondary f-sm">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" style="font-size:10px; font-family:Poppins">
                                    <thead style="background-color:#004c2d; color:white">
                                        <tr>
                                            <th>Jenis Biaya</th>
                                            <th>Tagihan</th>
                                            <th>Bayar</th>
                                            <th>Sisa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $grandtotaltagihan = 0;
                                        $grandtotalpotongan = 0;
                                        $grandtotalalltagihan = 0;

                                        $grandtotalmutasi = 0;
                                        $grandtotalbayar = 0;
                                        $grandtotalallbayar = 0;
                                        $grandtotalsisa =0;
                                        $tahun_akademik = "";

                                        $totaltagihanperjenjang = 0;
                                        $totalpotonganperjenjang = 0;
                                        $grandtotaltagihanperjenjang = 0;

                                        $totalmutasiperjenjang = 0;
                                        $totalbayarperjenjang = 0;
                                        $grandtotalbayarperjenjang = 0;
                                        $totalsisaperjenjang = 0;

                                        $totaltagihanperta = 0;
                                        $totalpotonganperta = 0;
                                        $grandtotaltagihanperta = 0;

                                        $totalmutasiperta = 0;
                                        $totalbayarperta = 0;
                                        $grandtotalbayarperta = 0;
                                        $totalsisaperta = 0;
                                        $jj = 0;
                                        @endphp
                                        @foreach ($databiaya as $key => $d)
                                        @php
                                        if ($tahun_akademik != $d->tahunakademik) {

                                        echo "<tr style='background-color:#ffb500;'>
                                            <th colspan='8'>BIAYA TAHUN AJARAN ".$d->tahunakademik."</th>
                                        </tr>";
                                        }
                                        $t_akademik = @$databiaya[$key + 1]->tahunakademik;
                                        $j = @$databiaya[$key + 1]->jenjang;
                                        @endphp
                                        @if ($d->jenisbayar=='Pendaftaran' || $d->jenisbayar=='SPP' || $d->jenisbayar=='PAS' || $d->jenisbayar=='PAT' || $d->jenisbayar=='Registrasi Ulang')
                                        @php
                                        $ta = $d->tahunakademik;
                                        @endphp
                                        @else
                                        @php
                                        $ta = "";
                                        @endphp
                                        @endif

                                        @if ($d->jenjang=='ASRAMA')
                                        @php
                                        $jenjang = $d->jenjang;
                                        @endphp
                                        @else
                                        @php
                                        $jenjang = "";
                                        @endphp
                                        @endif

                                        @if ($d->jenisbayar=='SPP')
                                        @php
                                        $jmlbulan = "( x 12)";
                                        $jmlbiaya = $d->jml_rencana_spp;
                                        $jmlmutasi = $d->jml_mutasi_spp;
                                        @endphp
                                        @elseif($d->jenisbayar=="Uang Lauk")
                                        @php
                                        $jmlbulan = "( x 12)";
                                        $jmlbiaya = $d->jml_rencana_um;
                                        $jmlmutasi = $d->jml_mutasi_um;
                                        @endphp
                                        @else
                                        @php
                                        $jmlbulan = "";
                                        $jmlbiaya = $d->jumlah_biaya;
                                        $jmlmutasi = $d->jumlah_mutasi;
                                        @endphp
                                        @endif

                                        @php
                                        $sisa = $jmlbiaya - $d->jumlah_potongan - $d->totalbayar - $jmlmutasi;
                                        $totaltagihan = $jmlbiaya - $d->jumlah_potongan;
                                        // $totalpotongan = $totalpotongan+= $d->jumlah_potongan;
                                        $totalbayar = $d->totalbayar + $jmlmutasi;
                                        // $totalsisa = $totalsisa+= $sisa;

                                        $totaltagihanperjenjang +=$jmlbiaya;
                                        $totalpotonganperjenjang +=$d->jumlah_potongan;
                                        $grandtotaltagihanperjenjang+= $totaltagihan;

                                        $totalmutasiperjenjang += $jmlmutasi;
                                        $totalbayarperjenjang += $d->totalbayar;
                                        $grandtotalbayarperjenjang += $totalbayar;
                                        $totalsisaperjenjang += $sisa;

                                        $totaltagihanperta +=$jmlbiaya;
                                        $totalpotonganperta +=$d->jumlah_potongan;
                                        $grandtotaltagihanperta += $totaltagihan;


                                        $totalmutasiperta += $jmlmutasi;
                                        $totalbayarperta += $d->totalbayar;
                                        $grandtotalbayarperta += $totalbayar;
                                        $totalsisaperta += $sisa;

                                        $grandtotaltagihan += $jmlbiaya;
                                        $grandtotalpotongan += $d->jumlah_potongan;
                                        $grandtotalalltagihan += $totaltagihan;

                                        $grandtotalmutasi += $jmlmutasi;
                                        $grandtotalbayar += $d->totalbayar;
                                        $grandtotalallbayar += $totalbayar;
                                        $grandtotalsisa += $sisa;
                                        @endphp
                                        <tr>
                                            <td>{{$d->jenisbayar}} {{$jenjang}} <b>{{$ta}}</b> {{$jmlbulan}}</td>
                                            <td class="text-right" style="font-weight:bold; color:red">
                                                @php
                                                $totaltagihan = $jmlbiaya + $d->jumlah_potongan;
                                                @endphp
                                                {{ number_format($totaltagihan,'0','','.') }}
                                            </td>
                                            <td class="text-right" style="font-weight:bold; color:green">
                                                @php
                                                $totalbayar = $jmlmutasi + $d->totalbayar;
                                                @endphp
                                                {{!empty($totalbayar) ?  number_format($totalbayar,'0','','.') : '' }}
                                            </td>
                                            <td align="right" style="font-weight: bold;color:red">
                                                {{number_format($totaltagihan - $totalbayar,'0','','.')}}
                                            </td>
                                        </tr>
                                        @php
                                        if ($j != $d->jenjang) {

                                        echo "<tr class='thead-dark'>
                                            <th>TOTAL ".$d->jenjang."</th>
                                            <th style='text-align:right'>".number_format($grandtotaltagihanperjenjang,'0','','.')."</th>
                                            <th style='text-align:right'>".number_format($grandtotalbayarperjenjang,'0','','.')."</th>
                                            <th style='text-align:right'>".number_format($totalsisaperjenjang,'0','','.')."</th>
                                        </tr>";
                                        $totaltagihanperjenjang = 0;
                                        $totalpotonganperjenjang = 0;
                                        $grandtotaltagihanperjenjang = 0;

                                        $totalmutasiperjenjang = 0;
                                        $totalbayarperjenjang = 0;
                                        $grandtotalbayarperjenjang = 0;
                                        $totalsisaperjenjang = 0;
                                        }
                                        if ($t_akademik != $d->tahunakademik) {

                                        echo "<tr style='background-color:#ffb500'>
                                            <th>TOTAL ".$d->tahunakademik."</th>
                                            <th style='text-align:right'>".number_format($totaltagihanperta,'0','','.')."</th>
                                            <th style='text-align:right'>".number_format($grandtotalbayarperta,'0','','.')."</th>
                                            <th style='text-align:right'>".number_format($totalsisaperta,'0','','.')."</th>
                                        </tr>";
                                        $totaltagihanperta = 0;
                                        $totalpotonganperta = 0;
                                        $grandtotaltagihanperta = 0;

                                        $totalmutasiperta = 0;
                                        $totalbayarperta = 0;
                                        $grandtotalbayarperta = 0;
                                        $totalsisaperta = 0;
                                        }
                                        $tahun_akademik = $d->tahunakademik;
                                        $jj = $d->jenjang;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </p>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step23">
                        <div class="form-group">
                            <select class="form-control" id="exampleFormControlSelect1">
                                @foreach ($tahunakademik as $t)
                                <option @if ($t->tahunakademik == $ta_aktif->tahunakademik)
                                    selected
                                    @endif
                                    value="{{$t->tahunakademik}}">{{$t->tahunakademik}}</option>
                                @endforeach
                            </select>
                        </div>
                        <table class="table table-striped table-hover mb-3" style="font-size:11px">
                            <thead style="background-color:#004c2d; color:white">
                                <tr>
                                    <th colspan="4">SPP BULANAN</th>
                                </tr>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Tagihan</th>
                                    <th>Bayar</th>
                                    <th>Tunggakan</th>
                                </tr>
                            </thead>
                            <tbody id="loadspp"></tbody>

                        </table>
                        <table class="table table-striped table-hover mb-3" style="font-size:11px">
                            <thead class="thead-dark">
                                <tr>
                                    <th colspan="4">SPP ASRAMA</th>
                                </tr>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Tagihan</th>
                                    <th>Bayar</th>
                                    <th>Tunggakan</th>
                                </tr>
                            </thead>
                            <tbody id="loadsppasrama"></tbody>
                        </table>

                    </div>
                    <div class="tab-pane" role="tabpanel" id="step33">
                        <table class="table" style="font-size:11px">
                            <thead style="background-color:#004c2d; color:white">
                                <tr>
                                    <th colspan="4">Histori Pembayaran</th>
                                </tr>
                                <tr>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal Bayar</th>
                                    <th style="text-align: right">Jumlah Bayar</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historibayar as $d)
                                <tr>
                                    <td>{{$d->no_transaksi}}</td>
                                    <td>{{ date("d-m-Y", strtotime($d->tgl_transaksi)) }}</td>
                                    <td style="text-align: right">{{ number_format($d->totalbayar,'0','','.')}}</td>
                                    <td>
                                        <a href="#" class="detail" data-notransaksi="{{$d->no_transaksi}}"><i class="fa fa-file-text info"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

        </div>
        <div class="jumbotron mb-3 bg-white">

        </div>
    </div>
</div>
@include('layouts.footer_home');
<div class="modal modal-blur fade" id="modal-detailtransaksi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Detail Transaksi <span style="font-weight:bold" id="notransaksi"></span></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loaddetailtransaksi">
            </div>
        </div>
    </div>
</div>
@endsection
@push('myscript')
<script>
    $(function() {
        function loadsppta() {
            var no_pendaftaran = "{{$pembayaran->no_pendaftaran}}";
            var tahunakademik = $("#exampleFormControlSelect1").val();
            $.ajax({
                type: 'POST'
                , url: '/tagihan/getsppta'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , no_pendaftaran: no_pendaftaran
                    , tahunakademik: tahunakademik
                }
                , cache: false
                , success: function(respond) {
                    $("#loadspp").html(respond);
                }
            });
        }

        function loadspptaasrama() {
            var no_pendaftaran = "{{$pembayaran->no_pendaftaran}}";
            var tahunakademik = $("#exampleFormControlSelect1").val();
            $.ajax({
                type: 'POST'
                , url: '/tagihan/getspptaasrama'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , no_pendaftaran: no_pendaftaran
                    , tahunakademik: tahunakademik
                }
                , cache: false
                , success: function(respond) {
                    $("#loadsppasrama").html(respond);
                }
            });
        }

        loadsppta();
        loadspptaasrama();

        $("#exampleFormControlSelect1").change(function(e) {
            e.preventDefault();
            loadspptaasrama();
            loadsppta();
        });

        $(".detail").click(function(e) {
            e.preventDefault();
            var notransaksi = $(this).attr("data-notransaksi");
            $("#notransaksi").text(notransaksi);
            $("#modal-detailtransaksi").modal("show");
            $.ajax({
                type: 'post'
                , url: '/tagihan/getdetailtransaksi'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , notransaksi: notransaksi
                }
                , cache: false
                , success: function(respond) {
                    $("#loaddetailtransaksi").html(respond);
                }
            });
        });
    });

</script>
@endpush
