@extends('layouts.fimobile')
@section('titlepage','Register')
@section('content')
@include('layouts.sidebar')

<div class="wrapper homepage">
    @include('layouts.header')
    <!-- End Header -->
    <div class="container">
        <div class="card bg-template shadow mt-4 h-190">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto">
                        <figure class="avatar avatar-60"><img src="{{ asset('assets/img/user1.png') }}" alt=""></figure>
                    </div>
                    <div class="col pl-0 align-self-center">
                        <h5 class="mb-1">{{ Auth::guard('orangtua')->user()->nama_lengkap }}</h5>
                        <p class="text-mute small">{{ Auth::guard('orangtua')->user()->nik }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container top-100">
        <div class="card mb-4 shadow">
            <div class="card-body border-bottom">
                <div class="row">
                    <div class="col">
                        <h3 class="mb-0 font-weight-normal">{{ rupiah($saldo->totalsaldo) }}</h3>
                        <p class="text-mute">Saldo Tabungan</p>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-default btn-rounded-54 shadow" href="/tabungan/{{ Crypt::encrypt($nik) }}/list"><i class="material-icons">dehaze</i></a>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-none">
                <div class="row">
                    <div class="swiper-container icon-slide mb-4">
                        <div class="swiper-wrapper">
                            <a href="#" class="swiper-slide text-center" data-toggle="modal" data-target="#paymodal">
                                <div class="avatar avatar-60 no-shadow border-0">
                                    <div class="overlay bg-template"></div>
                                    <i class="material-icons text-template">local_atm</i>
                                </div>
                                <p class="small mt-2">Bayar<br> <span class="badge bg-danger text-white">Segera</span></p>
                            </a>
                            <a href="#" class="swiper-slide text-center" data-toggle="modal" data-target="#sendmoney">
                                <div class="avatar avatar-60 no-shadow border-0">
                                    <div class="overlay bg-template"></div>
                                    <i class="fa fa-donate" style="font-size: 1.5rem"></i>
                                </div>
                                <p class="small mt-2">Infaq<br> <span class="badge bg-danger text-white">Segera</span></p>

                            </a>
                            <a href="#" class="swiper-slide text-center" data-toggle="modal" data-target="#bookmodal">
                                <div class="avatar avatar-60 no-shadow border-0">
                                    <div class="overlay bg-template"></div>
                                    <i class="fa fa-hand-holding-dollar" style="font-size: 1.5rem"></i>
                                </div>
                                <p class="small mt-2">Donasi<br> <span class="badge bg-danger text-white">Segera</span></p>
                            </a>
                            <a href="#" class="swiper-slide text-center">
                                <div class="avatar avatar-60 no-shadow border-0">
                                    <div class="overlay bg-template"></div>
                                    <i class="material-icons text-template">assignment</i>
                                </div>
                                <p class="small mt-2">Berita</p>
                            </a>

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h6 class="subtitle">Daftar Santri</h6>
        @foreach ($siswa as $d)
        <a href="/tagihan/{{ Crypt::encrypt($d->id_siswa) }}/list" style="text-decoration: none; font-weight:bold">
            <div class="card shadow border-0 mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto pr-0">
                            <div class="avatar avatar-60 no-shadow border-0">
                                <img src="{{ asset('assets/img/user2.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col">
                            <h6 class="font-weight-bold mb-1">{{ strtoupper($d->nama_lengkap) }}</h6>
                            <p class="text-mute small text-secondary"></p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@include('layouts.footer_home');
@endsection
