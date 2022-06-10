@extends('layouts.fimobile')
@section('titlepage','Register')
@section('content')
@include('layouts.sidebar')
<div class="wrapper">
    @include('layouts.header')
    <div class="container">
        <!-- page content here -->
        <h6 class="subtitle">Histori Transaksi</h6>
        <div class="row">
            <div class="col-12 px-0">
                <ul class="list-group list-group-flush border-top border-bottom">
                    @foreach ($histori as $d)
                    <li class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto pr-0">
                                <div class="avatar avatar-50 no-shadow border-0">
                                    <i class="material-icons text-template">credit_card</i>
                                </div>
                            </div>
                            <div class="col align-self-center pr-0">
                                <h6 class="font-weight-normal mb-1">{{ $d->jenis_transaksi=="S" ?'Setoran' :'Penarikan' }}</h6>
                                <p class="text-mute small text-secondary">{{ date("d-m-Y",strtotime($d->tgl_transaksi)) }}</p>
                            </div>
                            <div class="col-auto">
                                @if ($d->jenis_transaksi=="S")
                                <h6 class="text-success">{{ rupiah($d->jumlah) }}</h6>
                                @else
                                <h6 class="text-danger">{{ rupiah($d->jumlah) }}</h6>
                                @endif
                            </div>
                            <div class="col-auto">
                                <h6 class="text" style="font-weight: bold">{{ rupiah($d->saldo) }}</h6>
                            </div>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
        <!-- page content ends -->
    </div>
</div>
@include('layouts.footer_home');
@endsection
