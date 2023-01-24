@extends('laravolt::layout.app_top')

@section('content')
<style type="text/css">
    @media print 
    {
        @page 
        { 
            size: landscape;
            margin: 0; 
        }
        
        body
        {
            transform: scale(0.9);
        }

        header#topbartop 
        {
            display: none;
        }

        .divaccordion 
        {
            display: none;
        }

        #divaccordion 
        {
            display: none;
        }

        #divtitle
        {
            display: block !important;
        }
    }
</style>

    <div class="divaccordion">
        <div class="column middle aligned">
            <center>
                <h2 class="ui header m-t-xs" style="text-shadow: rgb(0 0 0) 4px 4px;font-size: 40px"> DASHBOARD PENTADBIR DAERAH {{data_get($daerah,'NamaDaerah')}} </h2>

            </center>
        </div>
        <div class="ui container-fluid content__body p-3">
            <div class="ui four stackable link cards">

                <div class="card">
                    <div class="content" style="text-align: center;background-image: linear-gradient(to top, #ffca41 , #4a4747);">
                        <div class="ui statistic">
                            <div class="label" style="font-size: 20px;color:white"> 
                                PETA LOKASI
                            </div>
                            <br>
                            <div class="value" style="color:white">
                                <i class="map marker icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card" onclick="showstat()">
                    <div class="content" style="text-align: center;background-image: linear-gradient(to top, #ffca41 , #4a4747);">
                        <div class="ui statistic">
                            <div class="label" style="font-size: 20px;color:white"> 
                                STATISTIK
                            </div>
                            <br>
                            <div class="value" style="color:white">
                                <i class="signal icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" onclick="showcarian()">
                    <div class="content" style="text-align: center;background-image: linear-gradient(to top, #ffca41 , #4a4747);">
                        <div class="ui statistic">
                            <div class="label" style="font-size: 20px;color:white">
                                CARIAN KAMPUNG
                            </div>
                            <br>
                            <div class="value" style="color:white">
                                <i class="home icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" onclick="showportal()">
                   <div class="content" style="text-align: center;background-image: linear-gradient(to top, #ffca41 , #4a4747);">
                        <div class="ui statistic">
                            <div class="label" style="font-size: 20px; color:white"> 
                                PORTAL <span style="text-transform: lowercase">e</span>-PERAK
                            </div>
                            <br>
                            <div class="value" style="color:white">
                                <i class="clone icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="ui container-fluid content__body p-3" id="loading" style="display: none;">
            <div class="ui segment p-3">
                <div class="ui blue sliding indeterminate progress">
                    <div class="bar">
                        <div class="progress">Sila Tunggu Sebentar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ui one column grid content__body" id="divtitle" style="margin-top: -80px; display: none">
        <div class="column middle aligned">
            <center>
                <h1 class="">
                    PETA LOKASI DAERAH {{data_get($daerah,'NamaDaerah')}}
                </h1>
            </center>
        </div>
    </div>

    <div class="tab-content p-3 raised" style="page-break-after: avoid !important">
        <div class="ui one stackable cards raised">
            <div class="card" style="margin-right: 0px !important; margin-left: 0px !important">
                
                <div class="p-3" id="contentgis"></div>

            </div>
        </div>
    </div>

@endsection

@push('script')
<script type="text/javascript">
    $( document ).ready(function() 
    {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/location/ajaxindex')}}",
            datatype : 'json',

            beforeSend: function ()
            {
                $('#loading').show();
                $('#contentgis').hide();
            },
            success: function(data)
            {
                $('#loading').hide();
                $("#contentgis").html(data);
                $('#contentgis').show();
            }
        });

    });

    function showcarian()
    {
        $('#loading').show();
        $('#contentgis').hide();
                
        window.location.href = "/dashboard/admindaerah/2";
    }

    function showstat() 
    {
        $('#loading').show();
        $('#contentgis').hide();
                
        window.location.href = "/dashboard/admindaerah/1";
    }

    function showportal() 
    {
        $('#loading').show();
        $('#contentgis').hide();

        window.location.href = "/";
    }
</script>
@endpush