@extends('laravolt::layout.base3')

@section('body')



    <div class="layout--app">

        @include('laravolt::menu.topbar_top_0')

         <div class="content" style="background-image: url('{{ asset('theme/assets/imgs/theme/perak/bgsix2.jpg') }}') !important; 
                                    background-attachment: fixed;
                                    background-repeat: no-repeat; 
                                    background-size: cover;
                                    ">

            <div class="content__inner">

                <div class="ui container-fluid content__body p-12">


                        <br>
                        <br>
                        <br>
                        <br>
                        
                     @yield('content')
                </div>

            </div>
        </div>
    </div>
@endsection




