@extends('laravolt::layout.base3')

@section('body')
    <div class="layout--app">

        @include('laravolt::menu.topbar')
        @include('laravolt::menu.sidebar')
        <div class="content"
            style="background-image: url('{{ asset('theme/assets/imgs/theme/perak/bgone.png') }}') !important;">
            <div class="content__inner">

                <div class="ui container-fluid content__body p-10">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>
@endsection
