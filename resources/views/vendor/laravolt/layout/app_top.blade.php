@extends('laravolt::layout.base3')

@section('body')

    <div class="layout--app">
        
        @include('laravolt::menu.topbar_top')

        <div class="content" style="background-image: url('{{ asset('theme/assets/imgs/theme/perak/bgsix.jpg') }}') !important; 
                                    background-attachment: fixed;
                                    background-repeat: no-repeat; 
                                    background-size: cover;
                                    ">
            <div class="content__inner" style="min-height: 700px !important">

                <div class="ui container-fluid content__body p-12">
                    <!-- <div id="divaccordion"> -->
                        <br><br><br><br>
                    <!-- </div> -->

                    @yield('content')

                </div>
            </div>
        </div>
    </div>
    
@endsection




