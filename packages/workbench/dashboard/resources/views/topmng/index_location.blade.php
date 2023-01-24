@extends('laravolt::layout.app_top')

@section('content')
<style type="text/css">
        .graph_container 
        {
            display: block;
            width: 600px;
        }

        .wrapper 
        {
            height: 200px;
            width: 400px;
        }

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

            #topbar
            {
                display: none;
            }

            #actionbar
            {
                display: none;
            }

            #divaccordion 
            {
                display: none;
            }

            #divaccordion2
            {
                display: none;
            }

            #sidebar
            {
                display: none;
            }

            #myBarChart
            {
                /* position: absolute !important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }
            
            #myPieChart
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myPieKemudahan
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myBarChart2
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myPieKerja
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myPieKahwin
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myBarUmur
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myBarPendapatan
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myBarKerja
            {
                /* position: absolute !important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            /*.page-break 
            { 
              display: block; page-break-before: always;
            }*/

            #break
            {
                height:50px !important;
            }

            ul.breadcrumb
            {
                display: none;
            }
            ul#slide-out
            {
                display: none;
            }
            ul#headtab
            {
                display: none;
            }
            a.print-button
            {
                display: none;
            }
            div#footer-message
            {
                display: none;
            }
            footer
            {
                display: none;
            }
            button#printpie
            {
                display: none;
            }
            header#header
            {
                display: none;
            }

            div.sidebar__menu
            {
                display: none;
            }
            
            aside
            {
                display: none;
            }

            #breadcrumbs {display:none;}

            header#topbartop 
            {
                display: none;
            }

            #divtitle
            {
                display: block !important;
            }
        }
</style>

    <div id="divaccordion">
        <div class="column middle aligned">
            <center>
                <h2 class="ui header m-t-xs" style="text-shadow: rgb(3 3 3) 4px 4px;font-size: 40px">DASHBOARD PENGURUSAN TERTINGGI</h2>
            </center>
        </div>
        <div class="ui container-fluid content__body p-3">
            <div class="ui four stackable link cards">
                <div class="card">
                    <div class="content" style="text-align: center;background-image: linear-gradient(to top, #ffca41 , #4a4747);">
                        <div class="ui statistic">
                            <div class="label" style="font-size: 20px;color:white"> PETA LOKASI </div>
                            <br>
                            <div class="value" style="color:white">
                                <i class="map marker icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" onclick="showstat()">
                    <div class="content" style="text-align: center; background-image: linear-gradient(to top, #ffca41 , #4a4747);">
                        <div class="ui statistic">
                            <div class="label" style="font-size: 20px;color:white"> STATISTIK </div>
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
                            <div class="label" style="font-size: 20px;color:white"> Carian Kampung </div>
                            <br>
                            <div class="value" style="color:white">
                                <i class="home icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="content" style="text-align: center;background-image: linear-gradient(to top, #ffca41 , #4a4747);">
                        <div class="ui statistic">
                            <div class="label" style="font-size: 20px; color:white"> PORTAL <span style="text-transform: lowercase">e</span>-PERAK</div>
                            <br>
                            <div class="value" style="color:white">
                                <a href="/" style="color: white">
                                    <i class="clone icon"></i>
                                </a>
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


    <div class="ui one column grid content__body" id="divtitle" style="margin-top: -130px; display: none">
        <div class="column middle aligned">
            <center>
                <h1 class="">
                    PETA LOKASI
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
                // block("tab-content");
                $('#loading').show();
                $('#contentgis').hide();
                $('#contentstatistic').hide();
                // $('#contentgis').hide();
            },
            success: function(data)
            {
                // unblock("tab-content");
                $('#loading').hide();
                $("#contentgis").html(data);
                $('#contentgis').show();
            }
        });

    });

    // function showmap() 
    // {
    //     $.ajax({
    //         type: "GET",
    //         url: "{{ URL::to('/location/ajaxindex')}}",
    //         datatype : 'json',

    //         beforeSend: function ()
    //         {
    //             // block("tab-content");
    //             $('#loading').show();
    //             $('#contentgis').hide();
    //             $('#contentstatistic').hide();
    //             // $('#contentgis').hide();
    //         },
    //         success: function(data)
    //         {
    //             // unblock("tab-content");
    //             $('#loading').hide();
    //             $("#contentgis").html(data);
    //             $('#contentgis').show();
    //         }
    //     });
    // }

    function showstat() 
    {
        // $.ajax({
        //     type: "GET",
        //     url: "{{ URL::to('/location/ajaxindex')}}",
        //     datatype : 'json',

        //     beforeSend: function ()
        //     {
                $('#loading').show();
                $('#contentgis').hide();
                $('#contentstatistic').hide();
                $('#contentstatistic').html('');
            // },
        //     success: function(data)
        //     {
        //         $('#loading').hide();
        //         $("#contentstatistic").html(data);
        //         $('#contentstatistic').show();
        //     }
        // });
                
        window.location.href = "/dashboard/topmanage/1";
    }
     function showcarian() 
    {
        // $.ajax({
        //     type: "GET",
        //     url: "{{ URL::to('/location/ajaxindex')}}",
        //     datatype : 'json',

        //     beforeSend: function ()
        //     {
                $('#loading').show();
                $('#contentgis').hide();
                $('#contentstatistic').hide();
                $('#contentstatistic').html('');
            // },
        //     success: function(data)
        //     {
        //         $('#loading').hide();
        //         $("#contentstatistic").html(data);
        //         $('#contentstatistic').show();
        //     }
        // });
                
        window.location.href = "/dashboard/topmanage/2";
    }
</script>
@endpush