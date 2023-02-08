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

        /*#divtitle2
        {
            display: none;
        }*/

        @media print 
        {
            @page 
            { 
                size: auto; 
                margin: 0; 
            }
            /*body
            {
                transform:scale(.9);
            }*/

            #print_hide{
                display: none;
            }

            #print_show{
                display: block !important;
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

            #myBarJenisRumah_2, #myBarKemudahanAwam_2, #myBarKerja_2, #myBarTarafKahwin_2, .myBarChart2_2, #myBarChart_2, #myBarPendapatan_2, #myBarUmurDaerah_2
            {
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:100% !important;
            }

            #myBarChart, #myBarChart_1
            {
                /* position: absolute !important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myBarUmurDaerah, #myBarUmurDaerah_1
            {
                /* position: absolute !important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }
            
            #myBarTarafKahwin, #myBarTarafKahwin_1
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }
            
            #myBarKemudahanAwam, #myBarKemudahanAwam_1
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }
            
            #myBarJenisRumah, #myBarJenisRumah_1
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }
            
            #myPieChart, .myPieChart2_1, .myPieChart2_2
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myPieKemudahan, #myPieKemudahan_1, #myPieKemudahan_2
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myBarChart2, .myBarChart2_1
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myPieKerja, #myPieKerja_1, #myPieKerja_2
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myPieKahwin, #myPieKahwin_1, #myPieKahwin_2
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

            #myBarPendapatan, #myBarPendapatan_1
            {
                /*position: absolute!important;*/
                left: 0 !important;
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width:100% !important;
                height:85% !important;
            }

            #myBarKerja, #myBarKerja_1
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

            #divasas, #divrumahtype, #divrumahtypedaerah, #divinfra, #divinfradaerah, #divkerja, #divkerjadaerah, #divkahwin, #divkahwindaerah, #divownerrumah, #divincome, #divumur
            {
                display: flex !important;
            }
        }
    </style>

    <div id="divaccordion">
        <div class="column middle aligned">
            <center>
                <h2 class="ui header m-t-xs" style="text-shadow: rgb(3 3 3) 4px 4px;font-size: 40px">DASHBOARD PENGURUSAN TERTINGGI</h2>
            </center>
        </div>
        <div class="ui container-fluid p-2">
            <div class="ui four stackable link cards">
                <div class="card" onclick="showmap()">
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
                   <div class="content" style="text-align: center;background-image: linear-gradient(to top, #ffca41 , #4a4747);">
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
                            <div class="label" style="font-size: 20px;color:white"> PORTAL <span style="text-transform: lowercase">e</span>-PERAK </div>
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
        <div class="ui container-fluid p-2" id="loading" style="display: none;">
            <div class="ui segment p-2">
                <div class="ui blue sliding indeterminate progress">
                    <div class="bar">
                        <div class="progress">Sila Tunggu Sebentar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="contentdashboard"></div>

@endsection


@push('script')

<script type="text/javascript">
    $(document).ready(function() 
    {
        var type="{{$type}}";

        if(type==1)
        {
            showstat()
        }
        else
        {
            showcarian()
        }
    });

    function showstat()
    {
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('dashboard/showcardstat')}}",
            datatype: 'json',

            beforeSend: function() 
            {
                $('#loading').show();
                $('#contentdashboard').html('');
            },
            success: function(data) 
            {
                $('#loading').hide();
                $('#contentdashboard').html(data);
            }
        });
    }

    function showcarian()
    {
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('dashboard/showcarian')}}",
            datatype: 'json',

            beforeSend: function() 
            {
                $('#loading').show();
                $('#contentdashboard').html('');
            },
            success: function(data) 
            {
                $('#loading').hide();
                $('#contentdashboard').html(data);
            },
            complete:  function(data)
            {
                select2('daerahselect');
                select2('mukimselect');
                select2('parlimenselect');
                select2('dunselect');
                select2('katselect');
                select2('kampungselect');
            }
        });
    }

    function select2(idselect)
    {
        $('#'+idselect).dropdown(
        {
            sortSelect: true,
            fullTextSearch:'exact'
        });
    }

    function showmap() 
    {
        $('#loading').show();
        $('#contentdashboard').hide();

        window.location.href = "/location/topmanage";
    }

</script>

@endpush