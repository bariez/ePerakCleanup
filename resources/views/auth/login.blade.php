<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-font-size="{{ config('laravolt.ui.font_size') }}" style="font-size: 13px">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
          href="{{env('BASEFOLDER')}}{{ mix('semantic/semantic.min.css', 'laravolt') }}"/>
    <link rel="stylesheet" type="text/css" data-turbolinks-track="reload" href="{{env('BASEFOLDER')}}{{ mix('css/all.css', 'laravolt') }}"/>
    <link rel="stylesheet" type="text/css" data-turbolinks-track="reload" href="{{env('BASEFOLDER')}}{{ mix('css/app.css') }}"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    @stack('style')
    @stack('head')
    {!! Asset::group('laravolt')->css() !!}
    {!! Asset::js() !!}

    <script>
        $.fn.calendar.settings.text = @json(form_calendar_text());
    </script>

    <script defer data-turbolinks-track="reload" src="{{ mix('js/platform.js', 'laravolt') }}"></script>
    {!! Asset::group('laravolt')->js() !!}

    <script defer data-turbolinks-track="reload" src="{{ mix('js/app.js') }}"></script>

    <style type="text/css">
        /* --- Gaya Latar Belakang dan Floating Card --- */
        .layout--auth.is-modern {
            background-image: url('{{ asset('kuning2.png') }}');
            background-size: cover; 
            background-repeat: no-repeat;
            background-position: center;
            
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px; 
            box-sizing: border-box;
        }

        .x-auth {
            width: 100%;
            max-width: 480px;
            background: #ffffff; 
            border-radius: 12px; 
            padding: 40px; 
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            margin: 0; 
            padding-top: 20px; 
        }

        /* --- Gaya Header (Logo dan Tajuk) --- */
        .x-auth__header {
            text-align: center;
            margin-bottom: 25px;
        }
        .x-auth__header img {
            width: 85px; 
            margin-bottom: 5px;
        }
        .x-auth__title {
            background-color: #ffc33d;
            color: #000;
            padding: 12px 10px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            font-size: 1.2em;
            margin-top: 15px;
            margin-bottom: 30px;
        }

        /* --- Gaya Input dan Butang --- */
        .ui.form .field > input {
            padding: 15px 14px !important; 
            border-radius: 8px !important;
            border: 1px solid #ccc !important;
            font-size: 1em !important;
            margin-top: 5px;
        }
        .ui.fluid.button {
            background-color: #ffc33d !important; 
            color: #000 !important;
            font-weight: bold !important;
            padding: 15px 0 !important;
            border-radius: 8px !important;
            font-size: 1.1em !important;
            margin-top: 25px !important;
            margin-bottom: 20px !important;
            box-shadow: 0 5px 10px rgba(255, 195, 61, 0.4);
        }
        .ui.form label {
            font-weight: bold !important;
            font-size: 0.95em;
        }
        .field {
            margin-bottom: 25px; 
        }

       /* --- Gaya Kata Laluan/Ikon Mata --- */
        .input-icons {
            position: relative;
            width: 100%;
        }
        
        .ui.form .field .input-icons input {
            width: 100%;
            padding-right: 45px !important; 
            box-sizing: border-box;
            margin-top: 5px;
        }
        
        .input-icons > i.icon {
            position: absolute;
            right: 15px;      
            top: 50%;         
            transform: translateY(-35%); 
            cursor: pointer;
            color: #aaa;
            z-index: 5;
            margin: 0 !important; 
            height: auto !important;
            line-height: 1 !important;
        }
        
        .forgot-password-link {
            text-align: right; 
            margin-top: 5px; 
            margin-bottom: 15px;
        }
        .forgot-password-link a {
            color: #000 !important; 
            font-weight: bold;
        }

        .slider-captcha-container {
            margin-top: 15px;
            margin-bottom: 15px;
        }
        
        .slider-wrapper {
            background-color: #f0f0f0;
            border-radius: 8px;
            padding: 5px;
            height: 50px;
            display: flex;
            align-items: center;
            position: relative;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
            user-select: none;
        }
        
        .slider-progress {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 5px;
            background-color: #a7e0a7;
            border-radius: 8px;
            transition: width 0.1s ease;
            z-index: 1;
        }
        
        .slider-text {
            position: absolute;
            width: 100%;
            text-align: center;
            color: #999;
            font-weight: bold;
            font-size: 0.95em;
            pointer-events: none;
            z-index: 2;
        }

        .slider-wrapper.success .slider-text {
            color: #387838;
        }
        
        .slider-button {
            width: 40px;
            height: 40px;
            background-color: #ffffff;
            border-radius: 6px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: grab;
            box-shadow: 0 1px 5px rgba(0,0,0,0.2);
            position: relative;
            left: 0;
            z-index: 3;
        }

        .slider-button i {
            color: #ffc33d; 
            font-size: 1.2em;
        }

        .slider-wrapper.success .slider-button i {
             color: #387838;
             font-size: 1.5em;
        }
        
        .slider-percentage {
            position: absolute;
            right: 5px;
            font-size: 0.9em;
            color: #999;
            z-index: 2;
        }

        .captcha-label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
        }

        /* --- Gaya Baru: Back to Main Menu --- */
        .back-to-menu {
            text-align: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        .back-to-menu a {
            color: #777 !important;
            font-weight: 500;
            font-size: 0.95em;
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-to-menu a:hover {
            color: #000 !important;
            text-decoration: underline;
        }

    </style>
</head>

<body data-theme="{{ config('laravolt.ui.theme') }}" class="{{ $bodyClass ?? '' }} @yield('body.class')">

<div class="layout--auth is-modern">

    <div class="x-auth">
        <div class="x-auth__content">

            <div class="x-auth__header">
                <div data-role="x-brand-image" class="ui image centered">
                    <img src="{{asset('logo.png')}}" alt="Logo Perak" class="ui image tiny centered">
                </div>
            </div>
            
            <div class="x-auth__title">
                e-Perak
            </div>

            <form class="ui form" method="POST" action="{{ route('auth::login.store') }}" id="myForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="field">
                    <label>Emel</label>
                    <input type="text" name="email" placeholder="Sila masukkan emel anda" required="required" value="{{ old('email') }}">
                </div>

                <div class="field">
                    <label>Kata Laluan</label>
                    <div class="input-icons"> 
                        <input type="password" id="upass" name="password" placeholder="Sila masukkan kata laluan anda" required="required">
                        <i onclick="show('upass')" class="eye slash icon" id="display"></i>
                    </div>
                </div>
                
                <div class="forgot-password-link">
                     <a themed href="{{ route('auth::forgot.show') }}" class="link">Lupa kata laluan?</a>
                </div>
                
                
                <div class="slider-captcha-container">
                    <label class="captcha-label">Sahkan Anda Bukan Robot</label>
                    <div class="slider-wrapper" id="sliderWrapper">
                        <div class="slider-progress" id="sliderProgress"></div>
                        <div class="slider-button" id="sliderButton">
                            <i class="angle right icon"></i>
                        </div>
                        <div class="slider-text" id="sliderText">Sila seret ke kanan untuk sahkan</div>
                        <div class="slider-percentage" id="sliderPercentage">0%</div>
                    </div>
                </div>
                
                <input type="hidden" name="g-recaptcha-response" id="captchaToken" value="">
                
                @if ($errors->has('g-recaptcha-response'))
                     <div class="field action">
                        <span class="help-block">
                             <strong><font color="red">Sila sahkan anda bukan robot</font></strong>
                        </span>
                     </div>
                @endif
                
                <div class="ui field">
                     <button class="ui fluid button" type="submit" id="loginButton" disabled>Log Masuk</button>
                </div>
                
                <div class="register-link">
                    @if(config('laravolt.platform.features.registration'))
                        <a themed href="{{ route('auth::registration.show') }}" class="link">Daftar Pengguna Baru</a>
                    @endif
                </div>

                <div class="back-to-menu">
                    <a href="{{ url('/') }}">
                        <i class="left arrow icon"></i> Kembali ke Menu Utama
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@push('script')
    <script>
        // FUNGSI KATA LALUAN HIDE/UNHIDE
        function show(a) {
            var x = document.getElementById(a);
            var c = x.nextElementSibling;

            if (x.getAttribute('type') === "password") {
                x.setAttribute("type", "text");
                c.className = "eye icon"; 
            } else {
                x.setAttribute('type', 'password');
                c.className = "eye slash icon";
            }
        }

        // FUNGSI SLIDER CAPTCHA
        document.addEventListener('DOMContentLoaded', function () {
            const sliderWrapper = document.getElementById('sliderWrapper');
            const sliderButton = document.getElementById('sliderButton');
            const sliderProgress = document.getElementById('sliderProgress');
            const sliderText = document.getElementById('sliderText');
            const sliderPercentage = document.getElementById('sliderPercentage');
            const captchaToken = document.getElementById('captchaToken');
            const loginButton = document.getElementById('loginButton');

            let isDragging = false;
            let isVerified = false;
            const buttonWidth = sliderButton.offsetWidth;

            loginButton.disabled = true;

            sliderButton.addEventListener('mousedown', startDrag);
            sliderButton.addEventListener('touchstart', startDragTouch);

            function startDrag(e) {
                if (isVerified) return;
                isDragging = true;
                sliderButton.style.cursor = 'grabbing';
                document.addEventListener('mousemove', onDrag);
                document.addEventListener('mouseup', stopDrag);
            }

            function startDragTouch(e) {
                 if (isVerified) return;
                isDragging = true;
                document.addEventListener('touchmove', onDragTouch);
                document.addEventListener('touchend', stopDragTouch);
            }

            function onDrag(e) {
                if (!isDragging) return;
                performDrag(e.clientX);
            }

            function onDragTouch(e) {
                 if (!isDragging) return;
                performDrag(e.touches[0].clientX);
            }

            function performDrag(clientX) {
                const wrapperRect = sliderWrapper.getBoundingClientRect();
                let newLeft = clientX - wrapperRect.left - (buttonWidth / 2);
                const maxLeft = wrapperRect.width - buttonWidth - 10;
                newLeft = Math.max(5, Math.min(newLeft, maxLeft)); 

                sliderButton.style.left = newLeft + 'px';
                sliderProgress.style.width = (newLeft + buttonWidth) + 'px';
                const percentage = Math.floor((newLeft / maxLeft) * 100);
                sliderPercentage.textContent = percentage + '%';
                
                if (newLeft >= maxLeft) {
                    verifyCaptcha();
                }
            }

            function stopDrag() {
                if (!isDragging) return;
                isDragging = false;
                sliderButton.style.cursor = 'grab';
                document.removeEventListener('mousemove', onDrag);
                document.removeEventListener('mouseup', stopDrag);
                if (!isVerified) resetSlider();
            }

            function stopDragTouch() {
                if (!isDragging) return;
                isDragging = false;
                document.removeEventListener('touchmove', onDragTouch);
                document.removeEventListener('touchend', stopDragTouch);
                 if (!isVerified) resetSlider();
            }

            function verifyCaptcha() {
                isVerified = true;
                sliderWrapper.classList.add('success');
                sliderText.textContent = 'Selesai. Anda bukan robot.';
                sliderPercentage.textContent = '100%';
                sliderButton.innerHTML = '<i class="check icon"></i>';
                sliderButton.style.left = (sliderWrapper.offsetWidth - buttonWidth - 5) + 'px';
                sliderButton.style.cursor = 'default';
                captchaToken.value = 'VERIFIED_SLIDER_TOKEN';
                loginButton.disabled = false;
            }

            function resetSlider() {
                sliderButton.style.left = '0px';
                sliderProgress.style.width = '5px';
                sliderPercentage.textContent = '0%';
                isVerified = false;
                sliderWrapper.classList.remove('success');
                sliderText.textContent = 'Sila seret ke kanan untuk sahkan';
            }
            
            const style = document.createElement('style');
            style.innerHTML = `
                .slider-wrapper.success { background-color: #d4edda; }
                .slider-wrapper.success .slider-progress { background-color: #387838; }
            `;
            document.head.appendChild(style);
        });
    </script>
@endpush

{!! Asset::js() !!}
@stack('script')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('status'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Berjaya!',
            text: "{{ session('status') }}",
            icon: 'success',
            confirmButtonColor: '#ffc33d',
            confirmButtonText: '<b style="color: #000;">OK</b>',
            background: '#fff',
            width: '400px'
        });
    });
</script>
@endif

@stack('body')
</body>
</html>