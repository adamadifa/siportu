@extends('layouts.fimobile')
@section('titlepage','Login')
@section('content')
<div class="wrapper">
    <!-- header -->
    <div class="header">
        <div class="row no-gutters">
            <div class="col-auto">
                <a href="/" class="btn  btn-link text-dark"><i class="material-icons">chevron_left</i></a>
            </div>
            <div class="col text-center"></div>
            <div class="col-auto">
            </div>
        </div>
    </div>
    <!-- header ends -->

    <form class="form-signin mt-3" method="POST" action="/postlogin" id="frmRegister">

        @csrf


        <div class="row no-gutters login-row">
            <div class="col align-self-center px-3 text-center">
                <br>
                <img src="{{ asset('assets/img/logopesantren.png') }}" alt="logo" class="logo-small mb-4">
                @if ($message = Session::get('warning'))
                <div class="form-group">

                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Oops</h4>
                        <p class="mb-0">
                            {{$message}}
                        </p>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <input type="hidden" id="ceknik">
                    <input type="text" id="nik" name="nik" class="form-control form-control-lg text-center" placeholder="NIK" autofocus>
                </div>
                <div class="form-group">
                    <input type="password" id="password" class="form-control form-control-lg text-center" name="password" placeholder="Password">
                </div>
                <input type="checkbox" name="remember_me" checked id="remember">
            </div>
        </div>

        <!-- login buttons -->
        <div class="row mx-0 bottom-button-container">
            <div class="col">
                <button type="submit" name="submit" class="btn btn-default btn-lg btn-rounded shadow btn-block">MASUK</button>
            </div>
        </div>
    </form>
    <!-- login buttons -->
</div>
@endsection
<script>
    var remember = document.getElementById('remember');
    remember.style.display = "none";

</script>
