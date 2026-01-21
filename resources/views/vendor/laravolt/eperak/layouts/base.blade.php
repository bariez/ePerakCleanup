<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-font-size="{{ config('laravolt.ui.font_size') }}">

<head>
    <meta charset="utf-8">
    <title>e-Perak | Portal Rasmi PerakGIS Negeri Perak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="e-Perak">
    <meta name="keywords" content="e-Perak">
    <meta name="author" content="e-Perak">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('theme/assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/cdn/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/cdn/dataTables.bootstrap.min.css') }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/assets/imgs/theme/perak/favicon-perak.png') }}" />

    <link type="text/css" rel="stylesheet" href="{{ asset('theme/assets/js/lightGallery-master/dist/css/lightgallery.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('theme/assets/js/lightGallery-master/dist/css/lightgallery-bundle.css') }}" />

    <link rel="stylesheet" href="https://js.arcgis.com/4.24/esri/themes/light/main.css" />

    <style type="text/css">
        <style type="text/css">
        /* Set Global Font to Poppins */
        body, html {
            font-family: 'Poppins', sans-serif !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Video Background Styling - DIPAKSA UNTUK SENTIASA COVER */
        #bg-video {
            position: fixed !important;
            top: 50% !important;
            left: 50% !important;
            min-width: 100% !important;
            min-height: 100% !important;
            width: auto !important;
            height: auto !important;
            z-index: -2 !important;
            transform: translate(-50%, -50%) !important;
            object-fit: cover !important;
            background-attachment: fixed !important;
        }

        /* Overlay */
        .video-overlay {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background: rgba(0, 0, 0, 0.3) !important;
            z-index: -1 !important;
        }

        main.main {
            position: relative !important;
            background: transparent !important;
            display: block !important;
            width: 100% !important;
        }

        /* --- FORM SIZING UNTUK MOBILE (SHRINK) --- */
        @media only screen and (max-width: 768px) {
            /* Kecilkan teks keseluruhan supaya muat skrin phone */
            body, html {
                font-size: 11px !important;
            }

            /* Pastikan video tak lari sizing */
            #bg-video {
                width: 100vw !important;
                height: 100vh !important;
                object-position: center !important;
            }

            /* Paksa semua elemen container supaya tidak lebih lebar dari skrin phone */
            .container, .container-fluid, main.main {
                padding-left: 10px !important;
                padding-right: 10px !important;
                width: 100% !important;
                overflow-x: hidden !important;
            }

            /* Kecilkan input box & butang pada phone */
            input, select, textarea, .ui.button {
                font-size: 12px !important;
                padding: 8px !important;
                height: auto !important;
            }

            /* Toolbar dikecilkan */
            .sticky-toolbar-container {
                transform: scale(0.7) !important;
                right: -10px !important;
                bottom: 10px !important;
                top: auto !important;
            }
        }
    </style>
</head>

@stack('style')

<body>

    <video autoplay muted loop playsinline id="bg-video">
        <source src="{{ asset('theme/assets/imgs/theme/perak/eperakvid.mp4') }}" type="video/mp4">
        <img src="{{ asset('theme/assets/imgs/theme/perak/bgtwo.png') }}" title="Your browser does not support the video tag.">
    </video>
    <div class="video-overlay"></div>
    @include('laravolt::eperak.layouts.header')
    @include('laravolt::eperak.layouts.mobilemenu')
    <main class="main">
        @yield('content')
    </main>
    @include('laravolt::eperak.layouts.footer')
    <script src="{{ asset('theme/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('theme/assets/js/cdn/jquery-3.5.1.js') }}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('theme/assets/js/cdn/jquery.dataTables.min.js') }}"></script>
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
    <script src="{{ asset('theme/assets/js/cdn/raphael-min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/jQuery-Mapael-2.2.0/js/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/jQuery-Mapael-2.2.0/js/maps/perak.js') }}"></script>
    <script src="{{ asset('theme/assets/js/lightGallery-master/dist/lightgallery.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/lightGallery-master/dist/plugins/thumbnail/lg-thumbnail.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/lightGallery-master/dist/plugins/zoom/lg-zoom.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('theme/assets/js/main.js') }}"></script>
    <script src="{{ asset('theme/assets/js/cdn/chart.js') }}"></script>

    <script src="https://js.arcgis.com/4.24/"></script>

    <script>
        // Font Size Logic
        var mainmenu  = document.getElementById("mainmenu");
        var infomenu  = document.getElementById("infomenu");
        var contactus = document.getElementById("contactus");
        var faq       = document.getElementById("faq");
        var pagemenu  = document.getElementsByClassName("pagemenuc");

        var defot = localStorage.getItem("karenfont") || 16;
        var size  = localStorage.getItem("sizefont") || 2;

        onLoadFont(defot, size);

        function onLoadFont(karen, size) {
            if(mainmenu) mainmenu.style.fontSize = karen + 'px';
            if(infomenu) infomenu.style.fontSize = karen + 'px';
            if(faq) faq.style.fontSize = karen + 'px';
            if(contactus) contactus.style.fontSize = karen + 'px';

            for (var i = 0; i < pagemenu.length; i++) {
                pagemenu[i].style.fontSize = karen + 'px';
            }
        }

        function changeSizeByBtn(size) {
            if (size == '3') {
                karen = parseInt(defot) + 2;
                if (karen <= 24) updateStyles(karen, size);
            } else if (size == '2') {
                updateStyles(16, size);
            } else if (size == '1') {
                karen = parseInt(defot) - 2;
                if (karen >= 8) updateStyles(karen, size);
            }
        }

        function updateStyles(karen, size) {
            defot = karen;
            onLoadFont(karen, size);
            localStorage.setItem("karenfont", karen);
            localStorage.setItem("sizefont", size);
        }

        const toggleToolbar = document.querySelectorAll(".toggle-toolbar");
        const stickyToolbarContainer = document.querySelector(".sticky-toolbar-container");
        toggleToolbar.forEach(function(element) {
            element.addEventListener("click", function() {
                stickyToolbarContainer.classList.toggle("show-toolbar");
            });
        });
    </script>

    @stack('script')

</body>
</html>