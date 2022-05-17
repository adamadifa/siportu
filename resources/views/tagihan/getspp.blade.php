@php
$totalspp = 0;
@endphp

@foreach ($databiaya as $d)
@php
$bayar = DB::table('historibayar_detail')
->join('historibayar', 'historibayar_detail.no_transaksi', '=', 'historibayar.no_transaksi')
->where('no_pendaftaran', $no_pendaftaran)
->where('kodebiaya',$d->kodebiaya)
->where('id_jenisbayar','11')
->where('ket',$d->bulan)
->first();
@endphp
<tr>
    <td>{{$namabulan[$d->bulan]}}</td>
    <td align="right" style="font-weight: 700">{{number_format($d->jumlah,'0','','.')}}</td>
    <td align="right" style="color: green; font-weight:bold">
        @if (!empty($bayar->jumlah_bayar))
        @php
        $bayar = $bayar->jumlah_bayar;
        @endphp
        @else
        @php
        $bayar = 0;
        @endphp
        @endif

        @php
        $totalbayar = $d->jumlah_mutasi + $bayar;
        @endphp
        {{number_format($totalbayar,'0','','.')}}
    </td>
    <td align="right" style="color: red; font-weight:bold">
        @php
        $sisa = $d->jumlah - $totalbayar;
        @endphp
        {{number_format($sisa,'0','','.')}}
    </td>
</tr>
@endforeach
