<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-font-size="{{ config('laravolt.ui.font_size') }}" style="font-size: 13px">
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
            --app-login-background: url('{{ url(config('laravolt.ui.login_background')) }}');
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
    {!! Asset::group('laravolt')->js() !!}

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
.layout--auth.is-modern {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
    width: 100%;
    max-width: 100%;
    min-height: 100vh;
    align-items: center;
    padding-top: 10vh;

}
</style>

<body data-theme="{{ config('laravolt.ui.theme') }}" class="{{ $bodyClass ?? '' }} @yield('body.class')">

<div class="layout--auth is-{!! config('laravolt.ui.login_layout') !!}" style="background-image: url('{{ asset('kuning2.png') }}');background-size:100% 100%; padding-top: 2vh;padding-bottom: 1vh">
     <!--    <div class="layout--auth__container" > -->
        <div class="x-auth" style="width: 50%">
           
                <div class="x-auth__content" style="padding-right: 2vh;padding-left: 2vh;">

                    
                     <div data-role="x-brand-image" class="ui image centered" style="width: 100%;">
                        <img src="{{asset('logo.png')}}" alt="" class="ui image tiny centered">
                    
                      
                </div>


    @if (session('status'))
        <?php flash()->success(session('status')); ?>
    @endif
    <h3 style="text-align: center; font-size: 30px;">e-Perak</h3>
    <h3 class="ui header horizontal divider section">Lupa Kata Laluan</h3>

    {!! form()->open() !!}
        {!! form()->email('email')->label(__('Emel')) !!}

        <div class="field action">
            <button class="ui fluid button" style="background: #ffc33d;color: #000" type="submit"><b>Hantar pautan tetapan kata laluan</b></button>

        </div>

        @if(config('laravolt.platform.features.registration'))
            <div class="ui divider section"></div>
                <div class="ui field m-b-2">
                    <div class="ui equal width grid">
                        <div class="column left aligned">
            <font  color="#000"><b>Tiada Akaun e-Perak? </b></font><a themed href="{{ route('auth::registration.show') }}" class="link"><font   color="#000" style="font-size: small"><b>Daftar disini <i class="pen icon"></i></b></font></a>
        </div>
             <div class="column right aligned">
             <a themed href="/" class="link"><font  color="#000" style="font-size: small"><b>Laman Utama <i class="home icon"></i></b></font></a>
        </div>
    </div>
</div>
        @endif
    {!! form()->close() !!}

                </div>
        </div>
    </div>

{!! Asset::js() !!}
@stack('script')
@stack('body')
</body>
</html>
