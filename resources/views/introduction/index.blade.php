@extends('layouts.fimobile')
@section('titlepage', 'Introduction')
@section('content')
    <div class="wrapper">
        <!-- Swiper intro -->
        <div class="swiper-container introduction pt-5">
            <div class="swiper-wrapper">
                <div class="swiper-slide overflow-hidden text-center">
                    <div class="row no-gutters">
                        <div class="col align-self-center px-3">
                            <img src="{{ asset('assets/img/infomarmation-graphics3.png') }}" alt="" class="mx-100 my-5">
                            <div class="row">
                                <div class="container mb-5">
                                    <h4>Cek Tagihan</h4>
                                    <p>Sebagai Orang tua dapat Melihat Rincian Tagihan & Histori Pembayaran Santri</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="swiper-slide overflow-hidden text-center">
                    <div class="row no-gutters">
                        <div class="col align-self-center px-3">
                            <img src="{{ asset('assets/img/infomarmation-graphics2.png') }}" alt="" class="mx-100 my-5">
                            <div class="row">
                                <div class="container mb-5">
                                    <h4>Cek Tabungan</h4>
                                    <p>Sebagai Orangtua Dapat Melihat Saldo & Histori Mutasi Tarnsaksi Tabungan Santri</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide overflow-hidden text-center">
                    <div class="row no-gutters">
                        <div class="col align-self-center px-3">
                            <img src="{{ asset('assets/img/information-graphics-congratulation.png') }}" alt="" class="mx-100 my-5">
                            <div class="row">
                                <div class="container mb-5">
                                    <h4>Cek Kehadiran</h4>
                                    <p>Sebagai Orangtua Dapat Melihat Kehadiran Santri Secara Realtime, Baik itu Jam Kedatangan ataupun Jam Kepulangan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
        <!-- Swiper intro ends -->

        <!-- login buttons -->
        <div class="row mx-0 bottom-button-container">
            <div class="col">
                <a href="/login" class="btn btn-default btn-lg btn-rounded shadow btn-block">Login</a>
            </div>
            <div class="col">
                <a href="/register" class="btn btn-white bg-white btn-lg btn-rounded shadow btn-block">Register</a>
            </div>
        </div>
        <!-- login buttons -->
    </div>
@endsection
