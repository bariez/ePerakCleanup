@extends('laravolt::layout.app2')
{{-- extends('laravolt::layout.base3') --}}

@section('content')
<style type="text/css">
    @media print 
    {
        @page 
        { 
            size: landscape;
            margin: 0; 
        }

        header#topbar
        {
            display: none;
        }

        #actionbar
        {
            display: none;
        }

        .divaccordion 
        {
            display: none;
        }

        #divtitle
        {
            display: block !important;
        }

        #sidebar
        {
            display: none;
        }
    }
</style>

    <div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0">
        <div class="column middle aligned">
            <h3 class="ui header m-t-xs">
                Lokasi
            </h3>
        </div>
    </div>

    <div class="ui container-fluid content__body p-2 tab-content">
    
        <div class="ui one column grid content__body" id="divtitle" style="margin-top: -50px; padding-bottom: 20px; display: none">
            <div class="column middle aligned">
                <center>
                    <h1 class="">
                        PETA LOKASI 
                        @if( data_get($roleuser, 'role_id') == 3 )
                            MUKIM {{ data_get($user, 'mukim.NamaMukim') }}
                        @endif
                    </h1>
                </center>
            </div>
        </div>

        <div class="ui attached segment raised">

            <div class="sidebar-list-job">
                <div class="section-box wow animate__animated animate__fadeIn mt-10">
                    <div class="container">
                        <div id="body-arcgis" style="display: none">

                        </div>
                        <div id="loadinggis" style="display: blocks; text-align: center;">
                            <img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection

@push('script')



<script>
    $( document ).ready(function() {

        $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('/location/ajaxindex')}}",
                datatype : 'json',

                beforeSend: function ()
                {
                    // alert('lolo');
                    // block("tab-content");

                    $('#loadinggis').show();
                    $('#body-arcgis').hide();
                },
                success: function(data)
                {
                    // alert('lolouygggyugyuygu');
                    // unblock("tab-content");
                    $("#body-arcgis").html(data);
                    $('#body-arcgis').show();
                    $('#loadinggis').hide();


                }

            });
    });
</script>



@endpush
