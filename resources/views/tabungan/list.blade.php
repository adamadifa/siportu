@extends('layouts.fimobile')
@section('titlepage','Register')
@section('content')
@include('layouts.sidebar')
<div class="wrapper">
    @include('layouts.header')
    <div class="container">
        <!-- page content here -->
        <h6 class="subtitle">Data Tabungan</h6>
        <div class="row">
            <div class="col-12 px-0">
                <ul class="list-group list-group-flush border-top border-bottom">
                    @foreach ($list as $d)
                    <a href="/tabungan/{{ Crypt::encrypt($d->id_siswa) }}/detail" style="text-decoration: none">
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto pr-0">
                                    <div class="avatar avatar-50 no-shadow border-0">
                                        <img src="{{ asset('assets/img/user2.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col align-self-center pr-0">
                                    <h6 class="font-weight-normal mb-1">{{ $d->nama_lengkap }}</h6>
                                    <p class="text-mute small" style="font-weight: bold; color:black">{{ rupiah($d->totalsaldo) }}</p>
                                </div>
                                <div class="col-auto">
                                    <h6 class="text-success"></h6>
                                </div>
                            </div>
                        </li>
                    </a>
                    @endforeach

                </ul>
            </div>
        </div>
        <!-- page content ends -->
    </div>
</div>
@include('layouts.footer_home');
@endsection
