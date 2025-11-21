<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-font-size="{{ config('laravolt.ui.font_size') }}" style="font-size: 13px">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="turbolinks-enabled" content="{{ config('laravolt.platform.features.turbolinks') }}">

    <style>
        :root {
            --app-accent-color: var(--{{ config('laravolt.ui.color') }});
            --app-login-background: url('{{ url(config('laravolt.ui.login_background')) }}');
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{env('BASEFOLDER')}}{{ mix('semantic/semantic.min.css', 'laravolt') }}"/>
    <link rel="stylesheet" type="text/css" href="{{env('BASEFOLDER')}}{{ mix('css/all.css', 'laravolt') }}"/>
    <link rel="stylesheet" type="text/css" href="{{env('BASEFOLDER')}}{{ mix('css/app.css') }}"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    {!! Asset::group('laravolt')->css() !!}
    {!! Asset::css() !!}
    <script src="{{ mix('js/vendor.js', 'laravolt') }}"></script>
    <script defer src="{{ mix('js/platform.js', 'laravolt') }}"></script>
    {!! Asset::group('laravolt')->js() !!}
    <script defer src="{{ mix('js/app.js') }}"></script>
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
/* CUSTOM CSS YANG TIDAK DIPERLUKAN LAGI UNTUK IKON, TETAPI DIKEKALKAN UNTUK LAYOUT LAIN */
.input-icons i {
    position: absolute;
}
.icon {
    padding: 10px;
    min-width: 40px;
}
.input-field {
    width: 100%;
    /* Kelas input-field tidak diperlukan jika menggunakan .ui.fluid.input */
    /* Padding bawah juga mungkin menyebabkan isu, lebih baik menggunakan Semantic UI padding */
    margin-bottom: 3px;
}
/* PEMBETULAN UNTUK MEMASTIKAN ICON BETUL-BETUL DI SEBELAH KANAN INPUT */
.ui.input.icon i.icon {
    pointer-events: auto; /* Memastikan ikon boleh diklik */
    cursor: pointer;
}
</style>

<body data-theme="{{ config('laravolt.ui.theme') }}" style="background-image: url('{{ asset('kuning2.png') }}');background-size:100% 100%;">
<div class="layout--auth is-{!! config('laravolt.ui.login_layout') !!}" style="padding-top: 1vh;">
    <div class="x-auth" style="width: 50%">
        <div class="x-auth__content" style="padding-right: 2vh; padding-left: 2vh;">

            <div data-role="x-brand-image" class="ui image centered" style="width: 100%;">
                <img src="{{ asset('logo.png') }}" alt="" class="ui image tiny centered">
            </div>

            <h3 style="text-align: center;">e-Perak</h3>
            <h3 class="ui header horizontal divider section">Tetapkan Kata Laluan Baharu</h3>

            @if (session('status'))
                <div class="ui positive message">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="ui negative message">
                    <ul class="list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="ui form" method="POST" action="{{ route('auth::reset.password.post') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email ?? old('email', request('email')) }}">

                <div class="field">
                    <label><b>Kata Laluan Baharu</b></label>
                    {{-- KOD DIBETULKAN: Menggunakan div.ui.fluid.input.icon untuk Semantic UI alignment --}}
                    <div class="ui fluid input icon">
                        <input type="password" id="password" name="password" placeholder="Kata Laluan Baharu" required>
                        {{-- Menggunakan class link pada ikon untuk pointer kursor --}}
                        <i onclick="show('password')" class="eye slash link icon"></i>
                    </div>
                </div>

                <div class="field">
                    <label><b>Pengesahan Kata Laluan</b></label>
                    {{-- KOD DIBETULKAN: Menggunakan div.ui.fluid.input.icon untuk Semantic UI alignment --}}
                    <div class="ui fluid input icon">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Pengesahan Kata Laluan" required>
                        {{-- Menggunakan class link pada ikon untuk pointer kursor --}}
                        <i onclick="show('password_confirmation')" class="eye slash link icon"></i>
                    </div>
                </div>

                <div class="field action">
                    <button class="ui fluid button" style="background: #ffc33d;color: #000" type="submit">
                        <b>Tetapkan Kata Laluan</b>
                    </button>
                </div>

                <div class="ui field m-b-2">
                    <div class="ui equal width grid">
                        <div class="column left aligned">
                            <a themed href="{{ route('auth::login.show') }}" class="link">
                                <font color="#000"><b>Kembali ke Log Masuk <i class="arrow left icon"></i></b></font>
                            </a>
                        </div>
                        <div class="column right aligned">
                            <a themed href="/eperak" class="link">
                                <font color="#000"><b>Laman Utama <i class="home icon"></i></b></font>
                            </a>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                // FUNGSI JAVASCRIPT DIKEKALKAN DAN MASIH BERFUNGSI
                function show(id) {
                    var x = document.getElementById(id);
                    // Dalam struktur Semantic UI baru, ikon adalah sibling kepada input, jadi nextElementSibling masih betul.
                    var icon = x.nextElementSibling; 
                    if (x.type === "password") {
                        x.type = "text";
                        icon.className = "eye icon link"; // Pastikan kelas link dikekalkan
                    } else {
                        x.type = "password";
                        icon.className = "eye slash icon link"; // Pastikan kelas link dikekalkan
                    }
                }
            </script>

        </div>
    </div>
</div>
{!! Asset::js() !!}
@stack('script')
@stack('body')
</body>
</html>