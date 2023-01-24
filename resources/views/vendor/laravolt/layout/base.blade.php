<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-font-size="{{ config('laravolt.ui.font_size') }}">
<head>
    <title>{{ $title ?? '' }} | {{ config('app.name') }}</title>

    <meta charset="UTF-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="turbolinks-enabled" content="{{ config('laravolt.platform.features.turbolinks') }}">

    @stack('meta')

    <style>
        :root {
            --app-accent-color: var(--{{ config('laravolt.ui.color') }});
        app-login-background: url('{{ url(config('laravolt.ui.login_background')) }}');
        }

       
    </style>
    <link rel="stylesheet" type="text/css" data-turbolinks-track="reload"
          href="{{ mix('semantic/semantic.min.css', 'laravolt') }}"/>
    <link rel="stylesheet" type="text/css" data-turbolinks-track="reload" href="{{ mix('css/all.css', 'laravolt') }}"/>
    <link rel="stylesheet" type="text/css" data-turbolinks-track="reload" href="{{ mix('css/app.css') }}"/>
    <link rel="icon" href="{{ URL::asset('logo.png') }}" type="image/x-icon"/>

    @stack('style')
    @stack('head')
    {!! Asset::group('laravolt')->css() !!}
    {!! Asset::css() !!}
    <script data-turbolinks-track="reload" src="{{ mix('js/vendor.js', 'laravolt') }}"></script>

    <script>
        $.fn.calendar.settings.text = @json(form_calendar_text());
    </script>

    <script defer data-turbolinks-track="reload" src="{{ mix('js/platform.js', 'laravolt') }}"></script>
<!--     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script type="text/javascript">

$(function(){

  setInterval(function(){ grecaptcha.reset(); }, 5 * 60 * 1000 ); 
  
  function rescaleCaptcha(){
    var width = $('.g-recaptcha').parent().width();
    var scale;
    if (width < 302) {
      scale = width / 302;
    } else{
      scale = 1.0; 
    }

    $('.g-recaptcha').css('transform', 'scale(' + scale + ')');
    $('.g-recaptcha').css('-webkit-transform', 'scale(' + scale + ')');
    $('.g-recaptcha').css('transform-origin', '0 0');
    $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
  }

  rescaleCaptcha();
  $( window ).resize(function() { rescaleCaptcha(); });

});

 
</script>
    {!! Asset::group('laravolt')->js() !!}

    @livewireStyles
    <script defer data-turbolinks-track="reload" src="{{ mix('js/app.js') }}"></script>
</head>
<style type="text/css">
 .layout--auth.is-modern .x-auth {
    background: #ffffffde;

}
@media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
 .x-auth {

    width:100% !important;
}
    
}
</style>

<body data-theme="{{ config('laravolt.ui.theme') }}" class="{{ $bodyClass ?? '' }} @yield('body.class')">

{{ $slot }}

{!! Asset::js() !!}
@livewireScripts
@stack('script')
@stack('body')
</body>
</html>
