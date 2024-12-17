<!doctype html>
<html lang="en" class="green-theme">


<!-- Mirrored from maxartkiller.com/website/Fimobile/Fimobile-HTML/introduction.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Apr 2021 06:30:05 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Maxartkiller">
    <title>@yield('titlepage')</title>
    @include('layouts.style')
</head>

<body>
    <!-- Loader -->
    <div class="row no-gutters vh-100 loader-screen">
        <div class="col align-self-center text-white text-center">
            <img src="{{ asset('assets/img/logo-loading.png') }}" alt="logo">
            {{-- <h1 class="mt-3"><span class="font-weight-light ">SIP</span>ORTU</h1> --}}
            <p class="text-mute text-uppercase small">Control Your Child with Mobile</p>
            <div class="laoderhorizontal">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- Loader ends -->



    @yield('content')






    @include('layouts.script')

</body>


<!-- Mirrored from maxartkiller.com/website/Fimobile/Fimobile-HTML/introduction.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Apr 2021 06:30:19 GMT -->

</html>
