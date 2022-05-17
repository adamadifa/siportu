<table class="table" style="font-size:11px">
    <thead style="background-color:#004c2d; color:white">
        <tr>
            <th>#</th>
            <th>Jenis Biaya</th>
            <th>Jumlah Bayar</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total = 0;
        @endphp
        @foreach ($detail as $d)
        @php
        $total += $d->jumlah_bayar;
        @endphp
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$d->jenisbayar}} @if ($d->jenisbayar=="SPP")
                ({{$namabulan[$d->ket]}})
                @endif <b>{{$d->jenjang}} {{ $d->tahunakademik}}</b></td>
            <td align="right">{{number_format($d->jumlah_bayar,'0','','.')}}</td>
        </tr>
        @endforeach
        <tr style="font-weight: bold">
            <td colspan="2">TOTAL</td>
            <td align="right">{{number_format($total,'0','','.')}}</td>
        </tr>
    </tbody>
</table>
