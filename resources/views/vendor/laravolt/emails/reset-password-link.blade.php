@component('laravolt::mail.body')
    @component('laravolt::mail.headline')
        Reset Kata Laluan
    @endcomponent

    @component('laravolt::mail.message')
        Anda baru saja memohon reset kata laluan di <strong>{{ config('app.url') }}</strong>.
        <br> Sila Klik dibawah untuk meneruskan prosess reset kata laluan:
    @endcomponent

    @component('laravolt::mail.button', ['url' => route('auth::reset.show', compact('token', 'email'))])
        Reset Kata Laluan
    @endcomponent

    @component('laravolt::mail.info')
        Jika Anda tidak memohon reset kata laluan, sila abaikan emel ini.
    @endcomponent

@endcomponent
