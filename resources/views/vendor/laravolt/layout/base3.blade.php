<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-font-size="{{ config('laravolt.ui.font_size') }}">
<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-44W08M5MYV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);} 
  gtag('js', new Date());

  gtag('config', 'G-44W08M5MYV');
</script>
    <title>@yield('site.title', "Welcome Home") | {{ config('app.name') }}</title>

    <meta charset="UTF-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="turbolinks-enabled" content="{{ config('laravolt.platform.features.turbolinks') }}">

    @stack('meta')

    <style>
        :root {
            --app-accent-color: var(--{{ config('laravolt.ui.color') }});
            --app-login-background: url('{{ url(config('laravolt.ui.login_background')) }}');
        }
    </style>
    <link rel="stylesheet" type="text/css" data-turbolinks-track="reload"
          href="{{ mix('semantic/semantic.min.css', 'laravolt') }}"/>
    <link rel="stylesheet" type="text/css" data-turbolinks-track="reload" href="{{ mix('css/all.css', 'laravolt') }}"/>
    <link rel="stylesheet" type="text/css" data-turbolinks-track="reload" href="{{ mix('css/app.css') }}"/>
    <link rel="icon" href="{{ URL::asset('logo.png') }}" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>

     <!-- GIS CSS -->
    <link rel="stylesheet" href="https://js.arcgis.com/4.24/esri/themes/light/main.css"/>

    @stack('style')
    @stack('head')
    {!! Asset::group('laravolt')->css() !!}
    {!! Asset::css() !!}

    <script data-turbolinks-track="reload" src="{{ mix('js/vendor.js', 'laravolt') }}"></script>
    <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>

    <script>
        $.fn.calendar.settings.text = @json(form_calendar_text());
    </script>

    <script defer data-turbolinks-track="reload" src="{{ mix('js/platform.js', 'laravolt') }}"></script>
<!--     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"></script> -->
  <script type="text/javascript" src="{{asset('chart.js/dist/chart.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js')}}"></script>
  <script src="{{ asset('theme/assets/js/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('jquery.blockUI.min.js') }}"></script>
  
<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script> -->
<!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"></script> -->
  <style>
    {!! Asset::group('laravolt')->js() !!}

    /*@livewireStyles*/
    <script defer data-turbolinks-track="reload" src="{{ mix('js/app.js') }}"></script>
</head>
<style type="text/css">
#actionbar {
         background: url('/action_bar2.jpg') !important;
        /*background:#8BBCCC!important;*/
        background-repeat: no-repeat !important;
        padding-top: 5px; padding-bottom: 5px; position: unset !important;
        background-size:100% !important;
}
#addbutton {
    background-color: #432712;
    color: white

}
.addbutton {
    background-color: #432712;
    color: white

}
#backbutton {
    background-color:white;
    color: #4e2e13;

}
#backbuttondown {
    color: #4e2e13;

}
#editbutton {
    background-color: #432712;
    color: white

}
.icon.plus{

    color: #15f915 !important;
}
#topbartop {
         background: url('/theme/assets/imgs/theme/perak/bgtwo.png') !important;
        /*background:#8BBCCC!important;*/
        background-repeat: no-repeat !important;
    /*    padding-top: 5px; padding-bottom: 5px; position: unset !important;*/
        background-size:100% !important;
}


.sidebar .sidebar__scroller .sidebar__profile .ui.header{

        color: #000!important;
}
.sidebar .sidebar__scroller .ui.menu.vertical .item>.header {
    color: #fbfd7a!important;
}
.ui.menu {

font-weight: 650!important;

}

.ui.attached.menu .x-icon.left{

    color: #ffffff!important;
}
.ui.header {

    color: #ffffff;

}
.sidebar .sidebar__accordion.ui.accordion .title.selected.empty, [data-theme=light] .sidebar .sidebar__accordion.ui.accordion .title:hover {
    background: #db9b2f;
}
[data-theme=light] .sidebar .sidebar__accordion.ui.accordion .title, [data-theme=light] .sidebar .sidebar__menu .brand {
    color: #ffffff;
}
[data-theme=light] .sidebar .sidebar__accordion.ui.accordion .title.selected.empty, [data-theme=light] .sidebar .sidebar__accordion.ui.accordion .title:hover {
    background: #be8e20;;
}
.ui.top.attached.header {
    color: black;
}
.ui.menu {
    font-size: 14px!important;
}
nav.sidebar {

  width: 250px!important;

}
[data-theme=light] #topbar.ui.menu {
    background: #402610;
    box-shadow: none;
    border-bottom: 0px solid #402610;
}
@media only screen and (max-width: 991px){
.layout--app header.ui.menu {left: 0px!important;}
}
.layout--app header.ui.menu {
   left: 250px;
   height: 50px;
}

.layout--app>.content .content__body {
    margin-top: 50px;
}

    </style>

<script type="text/javascript">

    function block(className){


        var message = '<div class="intro-y grid grid-cols-6 sm:gap-6 gap-y-6 box px-5 py-8 mt-5 mb-5" id="indeterminate-linear-fee">';
            message += '<div class="col-span-6 sm:col-span-3 xl:col-span-10 flex flex-col items-center">';
            message += '<svg width="20" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg" fill="rgb(30, 41, 59)" class="w-8 h-8">';
            message += '<rect y="10" width="15" height="120" rx="6">';
            message += '<animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>';
            message += '<animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>';
            message += '</rect>';
            message += '<rect x="30" y="10" width="15" height="120" rx="6">';
            message += '<animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>';
            message += '<animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>';
            message += '</rect>';
            message += '<rect x="60" width="15" height="140" rx="6">';
            message += '<animate attributeName="height" begin="0s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>';
            message += '<animate attributeName="y" begin="0s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>';
            message += '</rect>';
            message += '<rect x="90" y="10" width="15" height="120" rx="6">';
            message += '<animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>';
            message += '<animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>';
            message += '</rect>';
            message += '<rect x="120" y="10" width="15" height="120" rx="6">';
            message += '<animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>';
            message += '<animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>';
            message += '</rect>';
            message += '</svg> ';

                message += '<div class="text-center text-xs mt-2">Sila Tunggu</div>';


            message += '</div>';
            message += '</div>';


        $("." + className).block({

            message: message,
            overlayCSS: {
                backgroundColor: '#353c48',
                opacity: 0.8,
                cursor: 'wait',
                'z-index' : 10010
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'transparent',
                'z-index' : 10011
            }
        });
    }
       function unblock(className){
        $("." + className).unblock();
    }

</script>



<body data-theme="{{ config('laravolt.ui.theme') }}" class="{{ $bodyClass ?? '' }} @yield('body.class')">

@yield('body')

{!! Asset::js() !!}
@stack('script')
<!-- @livewireScripts -->
@stack('body')


    <!-- GIS JS -->
    @if (Request::segment(1) == 'location')
       <!--  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
        <script src="https://js.arcgis.com/4.24/"></script>
    @endif

</body>
</html>
