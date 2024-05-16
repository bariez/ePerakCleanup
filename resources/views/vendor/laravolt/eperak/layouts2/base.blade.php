<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-font-size="{{ config('laravolt.ui.font_size') }}">

<head>
    <meta charset="utf-8">
    <title>e-Perak | Portal Rasmi PerakGIS Negeri Perak</title>
    <!-- <title>{{ env('APP_ENV_TITLE') }} | {{ config('app.name') }}</title> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="e-Perak">
    <meta name="keywords" content="e-Perak">
    <meta name="author" content="e-Perak">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('theme/assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/assets/css/plugins/animate.min.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('theme/assets/css/vendor/bootstrap.min.css') }}" /> -->

    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css">


    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('theme/assets/imgs/theme/perak/favicon-perak.png') }}" />

    <link type="text/css" rel="stylesheet"
        href="{{ asset('theme/assets/js/lightGallery-master/dist/css/lightgallery.css') }}" />
    <link type="text/css" rel="stylesheet"
        href="{{ asset('theme/assets/js/lightGallery-master/dist/css/lightgallery-bundle.css') }}" />

    <!-- GIS CSS -->
    <!-- {{-- <link rel="stylesheet" href="{{ asset('theme/assets/css/plugins/esri.css') }}" /> --}} -->
    <link rel="stylesheet" href="https://js.arcgis.com/4.24/esri/themes/light/main.css" />


</head>

@stack('style')

<body>

    <!-- Preloader Start -->
    <!-- <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
     <div class="preloader-inner position-relative">
      <div class="text-center">
       <img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="jobhub" />
      </div>
     </div>
    </div>
   </div> -->
    <!-- Preloader End   -->

    <!-- Header Start -->
    @include('laravolt::eperak.layouts2.header')
    <!-- Header End   -->

    <!-- Mobile Menu Start -->
    @include('laravolt::eperak.layouts2.mobilemenu')
    <!-- Mobile Menu End   -->

    <!-- Content/Body Start -->
    <div>
        <main class="main"
            style="background-image: url('{{ asset('theme/assets/imgs/theme/perak/bgtwo.png') }}') !important;">

            @yield('content')

        </main>
    </div>
    <!-- Content/Body END   -->

    <!-- Footer Start -->
    @include('laravolt::eperak.layouts2.footer')
    <!-- Footer End   -->


    <!-- Vendor JS-->
    <script src="{{ asset('theme/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>

    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->

    <script src="{{ asset('theme/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('theme/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('theme/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('theme/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('theme/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('theme/assets/js/plugins/swiper-bundle.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <!-- <script src="{{ asset('theme/assets/js/plugins/raphael-min.js') }}"></script> -->
    <script src="{{ asset('theme/assets/js/jQuery-Mapael-2.2.0/js/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/jQuery-Mapael-2.2.0/js/maps/perak.js') }}"></script>


    <script src="{{ asset('theme/assets/js/lightGallery-master/dist/lightgallery.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/lightGallery-master/dist/plugins/thumbnail/lg-thumbnail.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/lightGallery-master/dist/plugins/zoom/lg-zoom.min.js') }}"></script>

    <script src="{{ asset('theme/assets/js/ckeditor/ckeditor.js') }}"></script>

    <!-- Template  JS -->
    <script src="{{ asset('theme/assets/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- GIS JS -->
    <!-- {{-- <script src="{{ asset('theme/assets/js/plugins/locator.js') }}"></script> --}}
        {{-- <script src="{{ asset('theme/assets/js/plugins/MapView.js') }}"></script>
        <script src="{{ asset('theme/assets/js/plugins/Expand.js') }}"></script>
        <script src="{{ asset('theme/assets/js/plugins/BasemapGallery.js') }}"></script> --}}
        {{-- <script src="{{ asset('theme/assets/js/plugins/arcgis.js') }}"></script> --}} -->
    <script src="https://js.arcgis.com/4.24/"></script>

    <script>
        var mainmenu = document.getElementById("mainmenu");
        var infomenu = document.getElementById("infomenu");
        var pagemenu = document.getElementsByClassName("pagemenuc");

        var defot = 16;
        var karen;

        function changeSizeByBtn(size) {
            if (size == '3') {
                karen = defot + 2;

                mainmenu.style.fontSize = karen + 'px';
                infomenu.style.fontSize = karen + 'px';

                for (i = 0; i < pagemenu.length; i++) {
                    pagemenu[i].style.fontSize = karen + 'px';
                }

                defot = karen;
            } else if (size == '2') {
                mainmenu.style.fontSize = '16px';
                infomenu.style.fontSize = '16px';

                for (i = 0; i < pagemenu.length; i++) {
                    pagemenu[i].style.fontSize = '16px';
                }

                defot = 16;
                karen = 16;
            } else if (size == '1') {
                karen = defot - 2;

                mainmenu.style.fontSize = karen + 'px';
                infomenu.style.fontSize = karen + 'px';

                for (i = 0; i < pagemenu.length; i++) {
                    pagemenu[i].style.fontSize = karen + 'px';
                }

                defot = karen;
            }
        }
    </script>

    @stack('script')

</body>

</html>
