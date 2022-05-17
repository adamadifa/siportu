@extends('layouts.fimobile')
@section('titlepage','Register')
@section('content')
@include('layouts.sidebar')
<div class="wrapper">
    @include('layouts.header')
    <div class="container">
        <!-- page content here -->
        <h6 class="subtitle">Data Tagihan</h6>
        <div class="row">
            <div class="col-12 px-0">
                <ul class="list-group list-group-flush border-top border-bottom">
                    @foreach ($jenjang as $d)
                    @php
                    if ($d->jenjang == "TK") {
                    $image = "tk.png";
                    $label = "TK Calisa Rabbani";
                    } else if ($d->jenjang == "SDIT") {
                    $image = "sdit.png";
                    $label = "SDIT Al Amin";
                    } else if ($d->jenjang == "MTS") {
                    $image = "mts.png";
                    $label = "Madrasah Tsanawiyyah";
                    } else if ($d->jenjang == "MA") {
                    $image = "ma.png";
                    $label = "Madrasah Aliyah";
                    }
                    @endphp
                    <a href="/tagihan/{{ Crypt::encrypt($d->no_pendaftaran) }}/show" style="text-decoration: none">
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-auto pr-0">
                                    <div class="avatar avatar-50 no-shadow border-0">
                                        <img src="{{ asset('assets/img/logo/'.$image) }}" alt="">
                                    </div>
                                </div>
                                <div class="col align-self-center pr-0">
                                    <h6 class="font-weight-normal mb-1">{{ $d->jenjang }}</h6>
                                    <p class="text-mute small text-secondary">{{ $label }}</p>
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
