    <!-- jquery, popper and bootstrap js -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-4.4.1/js/bootstrap.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- swiper js -->
    <script src="{{ asset('assets/vendor/swiper/js/swiper.min.js')}}"></script>

    <!-- cookie js -->
    <script src="{{ asset('assets/vendor/cookie/jquery.cookie.js')}}"></script>

    <!-- template custom js -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- page level script -->
    <script>
        $(window).on('load', function() {
            var swiper = new Swiper('.introduction', {
                pagination: {
                    el: '.swiper-pagination'
                , }
            , });
        });

    </script>
    @stack('myscript')
