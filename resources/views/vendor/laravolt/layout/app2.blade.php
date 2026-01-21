@extends('laravolt::layout.base3')

@section('body')
    <div class="layout--app">

        @include('laravolt::menu.topbar')
        @include('laravolt::menu.sidebar')
        
        {{-- Tukar background-image kepada background-color mengikut tema imej yang diberikan --}}
        <div class="content"
            style="background-color: #fdfaf0 !important; background-image: none !important; min-height: 100vh;">
            <div class="content__inner">

                <div class="ui container-fluid content__body p-10">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>
@endsection