<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-font-size="{{ config('laravolt.ui.font_size') }}" style="font-size: 13px">
<head>
   
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
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
     <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

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

<body data-theme="{{ config('laravolt.ui.theme') }}" class="{{ $bodyClass ?? '' }} @yield('body.class')" style="background-image: url('{{ asset('kuning2.png') }}');background-size:100% 100%;">

<div class="layout--auth is-{!! config('laravolt.ui.login_layout') !!}" style="
    padding-top: 1vh;">

     <!--    <div class="layout--auth__container" > -->
        <div class="x-auth" style="width: 50%" >
           
                <div class="x-auth__content" style="padding-right: 2vh;padding-left: 2vh;">

                    <div data-role="x-brand-image" class="ui image centered" style="width: 100%;">
                        <img src="{{asset('logo.png')}}" alt="" class="ui image tiny centered">
                    
                      
                </div>



<style type="text/css">

#g-recaptcha-response {
    display: block !important;
    position: absolute;
    margin: -78px 0 0 0 !important;
    width: 302px !important;
    height: 76px !important;
    z-index: -999999;
    opacity: 0;

    }
/*    #g-recaptcha-response {
    display: block !important;
    position: absolute;
    margin: -78px 0 0 0 !important;
    width: 302px !important;
    height: 76px !important;
    z-index: -999999;
    opacity: 0;
}
*/    .g-recaptcha{

        background-color: #ff000000;

    }

    .input-icons i {
        position: absolute;
    }

    .icon {
        padding: 10px;
        min-width: 40px;
    }

    .input-field {
        width: 100%;
        padding: 10px;
        margin-bottom: 3px;
    }

</style>
    <h3 style="text-align: center;">e-Perak</h3>
    <h3 class="ui header horizontal divider section">Log Masuk</h3>


   <form class="ui form" method="POST" action="{{ route('auth::login.store') }}"  id="myForm">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="field">
            <label><b>Emel</b></label>
            <input type="email" name="email" placeholder="Emel" required="required">
        </div>

        <div class="input-icons">
            <label><b>Kata Laluan</b></label>
            <input class="input-field" type="password" id="upass" name="password" placeholder="Kata Laluan" required="required">
            <i onclick="show('upass')" class="eye slash icon" id="display" style="margin-left: -40px; padding-top: 14px;"></i>
            {{-- <i type="button" id="toggleBtn" value="Show the password" onclick="togglePassword()" class="eye icon"></i> --}}
            {{-- <input type="button" id="toggleBtn" value="Show the password" onclick="togglePassword()"> --}}
            {{-- <i class="eye slash icon"></i> --}}
        </div>



     
  <div class="field action">
         {!! Captcha::display( ['data-theme' => 'dark',]) !!}
     </div>
      @if ($errors->has('g-recaptcha-response'))
       <div class="field action">
    <span class="help-block">
        <strong><font color="red">Captcha Wajib diisi</font></strong>
    </span>
</div>
    @endif
    <br>

        <div class="ui field m-b-1">
            <div class="ui equal width grid">
                <div class="column left aligned">
                    <div class="ui checkbox">
                        <input type="checkbox" name="remember" {{ request()->old('remember')?'checked':'' }}>
                        <label>Kekal Log Masuk</label>
                    </div>
                </div>
                <div class="column right aligned">
                    <a themed href="{{ route('auth::forgot.show') }}" class="link"><font color="#000"><b>Lupa Kata Laluan <i class="user lock icon"></i></b></font></a>
                </div>
            </div>
        </div>

        <div class="ui field">
             <button class="ui fluid button" style="background: #ffc33d;color: #000" type="submit"><b>Log Masuk</b></button>

             <div class="ui field m-b-2">
                        <div class="ui equal width grid">
                            <div class="column left aligned">
                                @if(config('laravolt.platform.features.registration'))
                                   <div>
                                        <font color="#000" ><b>Tiada Akaun e-Perak? </b></font><a themed href="{{ route('auth::registration.show') }}" class="link"><font color="#000" style="font-size: larger"><b>Daftar disini <i class="pen icon"></i></b></font></a>
                                    </div>
                             @endif
                            </div>
                            <div class="column right aligned">
                                 <a themed href="/" class="link"><font color="#000"><b>Laman Utama <i class="home icon"></i></b></font></a>
                            </div>
                        </div>
                    </div>
            
        </div>

   </form>

    @push('script')
    <!--
        {{-- @if(config('laravolt.auth.captcha'))
            {!! app('captcha')->renderJs() !!}
        @endif --}}
     -->

        <script>
            function show(a) {
                var x=document.getElementById(a);
                var c=x.nextElementSibling

                if (x.getAttribute('type') == "password") {
                    c.removeAttribute("class");
                    c.setAttribute("class","eye icon");
                    x.removeAttribute("type");
                    x.setAttribute("type","text");
                } else {
                    x.removeAttribute("type");
                    x.setAttribute('type','password');
                    c.removeAttribute("class");
                    c.setAttribute("class","eye slash icon");
                }
            }
        </script>
    @endpush



                </div>
        </div>
    </div>
</body>

{!! Asset::js() !!}
@stack('script')
@stack('body')
</body>
</html>
