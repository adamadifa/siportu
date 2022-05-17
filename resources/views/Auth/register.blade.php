@extends('layouts.fimobile')
@section('titlepage','Register')
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
    <form class="form-signin mt-3" method="POST" action="/storeregister" id="frmRegister">

        @csrf
        <div class="row no-gutters login-row">
            <div class="col align-self-center px-3 text-center">
                <br>
                <img src="{{ asset('assets/img/logopesantren.png') }}" alt="logo" class="logo-small mb-4">

                <div class="form-group">
                    <input type="hidden" id="ceknik">
                    <input type="text" id="nik" name="nik" class="form-control form-control-lg text-center" placeholder="NIK" autofocus>
                </div>
                <div class="form-group">
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control form-control-lg text-center" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                    <input type="text" id="no_hp" name="no_hp" class="form-control form-control-lg text-center" placeholder="No. HP">
                </div>
                <div class="form-group">
                    <input type="password" id="password" class="form-control form-control-lg text-center" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" id="confirmpassword" class="form-control form-control-lg text-center" name="confirmpassword" placeholder="Confirm Password">
                </div>
            </div>
        </div>

        <!-- login buttons -->
        <div class="row mx-0 bottom-button-container">
            <div class="col">
                <button type="submit" name="submit" class="btn btn-default btn-lg btn-rounded shadow btn-block">Daftar</button>
            </div>
        </div>
    </form>
    <!-- login buttons -->
</div>
@endsection

@push('myscript')
<script>
    $(function() {

        function ceknik(nik) {
            $.ajax({
                type: 'POST'
                , url: '/ceknik'
                , data: {
                    _token: "{{ csrf_token() }}"
                    , nik: nik
                }
                , cache: false
                , success: function(respond) {
                    $("#ceknik").val(respond);
                    console.log(respond);
                }
            });
        }
        $("#nik").keyup(function() {
            ceknik($(this).val());
        });
        $("#frmRegister").submit(function() {
            var nik = $("#nik").val();
            var nama_lengkap = $("#nama_lengkap").val();
            var no_hp = $("#no_hp").val();
            var password = $("#password").val();
            var confirmpassword = $("#confirmpassword").val();
            var cek_nik = $("#ceknik").val();
            if (nik == "") {
                swal({
                    title: 'Oops'
                    , text: 'Nik Harus Diisi !'
                    , icon: 'warning'
                    , showConfirmButton: false
                }).then(function() {
                    $("#nik").focus();
                });

                return false;
            } else if (cek_nik == "" || cek_nik == 0) {
                swal({
                    title: 'Oops'
                    , text: 'Nik Tidak Terdaftar, Silahkan Hubungi Bagain Pesantren !'
                    , icon: 'warning'
                    , showConfirmButton: false
                }).then(function() {
                    $("#nik").focus();
                });

                return false;
            } else if (nama_lengkap == "") {
                swal({
                    title: 'Oops'
                    , text: 'Nama Harus Diisi !'
                    , icon: 'warning'
                    , showConfirmButton: false
                }).then(function() {
                    $("#nama_lengkap").focus();
                });

                return false;
            } else if (no_hp == "") {
                swal({
                    title: 'Oops'
                    , text: 'No. HP Harus Diisi !'
                    , icon: 'warning'
                    , showConfirmButton: false
                }).then(function() {
                    $("#no_hp").focus();
                });

                return false;
            } else if (password == "") {
                swal({
                    title: 'Oops'
                    , text: 'Password Harus Diisi !'
                    , icon: 'warning'
                    , showConfirmButton: false
                }).then(function() {
                    $("#password").focus();
                });

                return false;
            } else if (confirmpassword == "") {
                swal({
                    title: 'Oops'
                    , text: 'Konfirmasi Password Harus Diisi !'
                    , icon: 'warning'
                    , showConfirmButton: false
                }).then(function() {
                    $("#confirmpassword").focus();
                });

                return false;
            } else if (password != confirmpassword) {
                swal({
                    title: 'Oops'
                    , text: 'Password Tidak Match !'
                    , icon: 'warning'
                    , showConfirmButton: false
                }).then(function() {
                    $("#password").focus();
                });

                return false;
            }
        });
    });

</script>
@endpush
