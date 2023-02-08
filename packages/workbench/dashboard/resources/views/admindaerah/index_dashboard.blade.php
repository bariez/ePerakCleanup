@extends('laravolt::layout.app_top')

@section('content')
<style type="text/css">
    
    /*canvas
    {
        width:480px !important;
        height:200px !important;
    }*/

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

    table > tbody > tr > td
    {
        padding: 5px !important;
    }

    table > thead > tr > th
    {
        padding: 10px !important;
    }

    @media print 
    {
        /*@page 
        {
            size: 330mm 427mm;
            margin: 14mm;
        }
        .container 
        {
            width: 1170px;
        }*/
        
        @page 
        {
            size: auto;
            margin: 0;
        }

        /*#myBarChart
        {
            width:250px
            height:100px;
        }*/

        #topbar {
            display: none;
        }

        #actionbar {
            display: none;
        }

        #divaccordion {
            display: none !important;
        }

        #sidebar {
            display: none;
        }
        #divtitle
        {
            display: block !important;
        }
        #divtitle2
        {
            display: block !important;
        }

        /*   .canvas_container {
        max-width: 100%;
        padding-bottom: 50%;  Canvas is 2000x1000, this will set the height to 50% of width 
        position: relative;
    }*/
        #myBarChart {
            /* position: absolute !important;*/
            left: 0 !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 90% !important;
            height: 85% !important;
        }

        #myPieChart {
            /*position: absolute!important;*/
            left: 0 !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            height: 85% !important;
        }

        #myPieKemudahan {
            /*position: absolute!important;*/
            left: 0 !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            height: 85% !important;
        }

        #myBarChart2 {
            /*position: absolute!important;*/
            left: 0 !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            height: 85% !important;
        }

        #myPieKerja {
            /*position: absolute!important;*/
            left: 0 !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            height: 85% !important;
        }

        #myPieKahwin {
            /*position: absolute!important;*/
            left: 0 !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            height: 85% !important;
        }

        #myBarUmur {
            /*position: absolute!important;*/
            left: 0 !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            height: 85% !important;
        }

        #myBarPendapatan {
            /*position: absolute!important;*/
            left: 0 !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            height: 85% !important;
        }

        .page-break {
            display: block;
            page-break-before: always;
        }

        #break {
            height: 50px !important;
        }

        ul.breadcrumb {
            display: none;
        }

        ul#slide-out {
            display: none;
        }

        ul#headtab {
            display: none;
        }

        a.print-button {
            display: none;
        }

        div#footer-message {
            display: none;
        }

        footer {
            display: none;
        }

        button#printpie {
            display: none;
        }

        header#topbartop {
            display: none;
        }

        div.sidebar__menu {
            display: none;
        }

        aside {
            display: none;
        }

        #breadcrumbs {
            display: none;
        }
    }
</style>

<div id="divaccordion">
    <div class="column middle aligned">
        <center>
            <h2 class="ui header m-t-xs" style="text-shadow: rgb(0 0 0) 4px 4px;font-size: 40px"> DASHBOARD PENTADBIR DAERAH {{data_get($daerah,'NamaDaerah')}} </h2>
        </center>
    </div>
    <div class="ui container-fluid p-2">
        <div class="ui four stackable link cards">

            <div class="card" onclick="showmap()">
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
            
            <div class="card" onclick="showstatistic()">
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

    <br>

    <div class="ui container-fluid p-2" id="loading" style="display: none;">
        <div class="ui segments panel">
            <div class="ui segment p-2">
                <div class="ui blue sliding indeterminate progress">
                    <div class="bar">
                        <div class="progress">Sila Tunggu Sebentar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ui one column grid" id="divtitle" style="margin-top: -100px; display: none">
    <div class="column middle aligned">
        <center>
            <h3 class="">
                LAPORAN STATISTIK PENDUDUK DAERAH {{ $daerah->NamaDaerah }}
            </h3>
            <table class="ui very basic collapsing celled table" style="width:75%; font-size: 12px;">
                <tbody>
                    <tr>
                        <td style="text-align: center; width: 25%">
                            Daerah
                        </td>
                        <td style="text-align: center; width: 25%">
                            <span id="showdaerah"> {{ data_get($daerah, 'NamaDaerah', ' - ') }} </span>
                        </td>
                        <td style="text-align: center; width: 25%">
                            Mukim
                        </td>
                        <td style="text-align: center; width: 25%">
                            <span id="showmukim"> - </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            Parlimen
                        </td>
                        <td style="text-align: center;">
                            <span id="showparlimen"> - </span>
                        </td>
                        <td style="text-align: center;">
                            Dun
                        </td>
                        <td style="text-align: center;">
                            <span id="showdun"> - </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            Kategori Penempatan
                        </td>
                        <td style="text-align: center;">
                            <span id="showcat"> - </span>
                        </td>
                        <td style="text-align: center;">
                            Nama Kampung
                        </td>
                        <td style="text-align: center;">
                            <span id="showkampung"> - </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
    </div>
</div>



<div class="tab-content p-2 raised" id="contentstatistic" style="">
    <div class="ui styled fluid accordion" id="divaccordion">
        <div class="title">
            <i class="dropdown icon"></i>CARIAN STATISTIK
        </div>
        <div class="content" style="padding: 1rem 2rem">
            
            <form class="ui form">

                <div class="two fields">
                    <div class="field">
                        <label>Daerah</label>
                        <input type="text" readonly="readonly" value="{{data_get($daerah,'NamaDaerah')}}">
                        <input type="hidden" name="daerah" id="daerah" readonly="readonly" value="{{data_get($daerah,'id')}}">
                    </div>
                    <div class="field">
                        <label>Mukim</label>
                        <div class="ui fluid search selection dropdown" id="sel_mukim">
                            <input type="hidden" name="mukim" id="mukim" value="">
                            <i class="dropdown icon"></i>
                            <div class="default text" id="pilihmukim">Sila Pilih</div>
                            <div class="menu" id="selectmukim"></div>
                        </div>
                    </div>
                </div>

                <div class="two fields">
                    <div class="field">
                        <label>Parlimen</label>
                        <div class="ui fluid search selection dropdown" id="sel_parlimen">
                            <input type="hidden" name="parlimen" id="parlimen" value="">
                            <i class="dropdown icon"></i>
                            <div class="default text" id="pilihparlimen">Sila Pilih</div>
                            <div class="menu" id="selectparlimen"></div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Dun</label>
                        <div class="ui fluid search selection dropdown" id="sel_dun">
                            <input type="hidden" name="dun" id="dun" value="">
                            <i class="dropdown icon"></i>
                            <div class="default text" id="pilihdun">Sila Pilih</div>
                            <div class="menu" id="selectdun"></div>
                        </div>
                    </div>
                </div>

                <div class="two fields">
                    <div class="field">
                        <label>Kategori Petempatan</label>
                        <div class="ui fluid search selection dropdown" id="sel_katpet">
                            <input type="hidden" name="cat_petempatan" id="cat_petempatan" value="">
                            <i class="dropdown icon"></i>
                            <div class="default text">Sila Pilih</div>
                            <div class="menu" id="pilihcat">
                                <div class="item" data-value="" onclick="kampungpenempatan(0)">Sila Pilih</div> 
                                    @foreach($catpenempatan as $key => $value) 
                                        <div class="item" data-value="{{$value->id}}" onclick="kampungpenempatan({{$value->id}})">{{$value->description}}</div> 
                                    @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label>Nama Kampung</label>
                        <div class="ui fluid search selection dropdown" id="sel_kampung">
                            <input type="hidden" name="kampung" id="kampung" value="">
                            <i class="dropdown icon"></i>
                            <div class="default text" id="pilihkampung">Sila Pilih</div>
                            <div class="menu" id="selectkampung"></div>
                        </div>
                    </div>
                </div>

            </form>

            <div class="ui divider section"></div>

            <div class="ui buttons right floated">
                <a class="ui button" href="{!! URL::to('dashboard/admin') !!}">SET SEMULA</a>
                <div class="or" data-text="@"></div>
                <button class="ui button primary" onclick="search()" id="addbutton"> CARIAN </button>
                <div class="or" data-text="@"></div>
                <a href="javascript:;"  class="ui red button" onclick="document.title='LAPORAN STATISTIK PETEMPATAN'; window.print();">&nbsp;CETAK&nbsp;</a>
            </div>

        
            <br/><br/><br/>
            
        </div>
    </div>

    <div class="ui container-fluid" id="result3" style="display: none; padding: 2rem 0rem">
        <!-- <div class="ui segments panel"> -->
            <div class="" id="resultcountpetempatan"></div>
        <!-- </div> -->
    </div>

    <div class="ui container-fluid" id="result4" style="padding: 1rem 0rem">

        <!-- chart 1 ------------------------------- -->
        <div class="ui two stackable cards raised" style="margin-top: 5px;">
            <div class="card">
                <div class="ui active loader" id="loader1"></div>
                <div class="content" id="resultchart1" style="display: none"></div>
            </div>
            <div class="card" id="modalchart1">
                <div class="ui active loader" id="explainloader1"></div>
                <div class="content" id="explainchart1">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 16px;">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">
                                            Ringkasan Status Pemilikan Rumah
                                        </span>
                                    </center>
                                </th>
                            </tr>
                            <tr style="height: 10px !important">
                                <th style="text-align: center;">Kategori</th>
                                <th style="text-align: center;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="table-chart1">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end chart 1 ------------------------------- -->

        <!-- chart 2 ------------------------------- -->
        <div class="ui two stackable cards raised" style="margin-top: 5px;">
            <div class="card">
                <div class="ui active loader" id="loader2"></div>
                <div class="content" id="resultchart2" style="display: none"></div>
            </div>
            <div class="card">
                <div class="ui active loader" id="explainloader2"></div>
                <div class="content" id="explainchart2">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 16px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span id="" style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">
                                            Ringkasan Jenis Rumah
                                        </span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Kategori</th>
                                <th style="text-align: center;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="table-chart2">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end chart 2 ------------------------------- -->

        <!-- chart 3 ------------------------------- -->
        <div id="divtitle2" style="page-break-before:always; display: none; padding-top: 4rem !important">
                
        </div>
        <div class="ui two stackable cards raised" style="margin-top: 5px;">
            <div class="card">
                <div class="ui active loader" id="loader3"></div>
                <div class="content" id="resultchart3" style="display: none"></div>
            </div>
            <div class="card ">
                <div class="ui active loader" id="explainloader3"></div>
                <div class="content" id="explainchart3">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 16px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span id="" style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">
                                            Ringkasan Kemudahan Awam & Infrastruktur
                                        </span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Kategori</th>
                                <th style="text-align: center;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="table-chart3">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end chart 3 ------------------------------- -->

        <!-- chart 4 ------------------------------- -->
        <div class="ui two stackable cards raised" style="margin-top: 5px;">
            <div class="card">
                <div class="ui active loader" id="loader4"></div>
                <div class="content" id="resultchart4" style="display: none"></div>
            </div>
            <div class="card">
                <div class="ui active loader" id="explainloader4"></div>
                <div class="content" id="explainchart4">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 16px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    <center>
                                        <span id="" style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">
                                            Ringkasan Kemudahan Asas Rumah
                                        </span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Kategori</th>
                                <th style="text-align: center;">Ya</th>
                                <th style="text-align: center;">Tidak</th>
                            </tr>
                        </thead>
                        <tbody id="table-chart4">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end chart 4 ------------------------------- -->

        <!-- end chart 5 ------------------------------- -->
        <div class="ui two stackable cards raised" style="margin-top: 5px;">
            <div class="card">
                <div class="ui active loader" id="loader5"></div>
                <div class="content" id="resultchart5" style="display: none"></div>
            </div>
            <div class="card ">
                <div class="ui active loader" id="explainloader5"></div>
                <div class="content" id="explainchart5">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 16px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span id="" style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">
                                            Ringkasan Status Pekerjaan
                                        </span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Kategori</th>
                                <th style="text-align: center;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="table-chart5">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end chart 5 ------------------------------- -->

        <!-- chart 6 ------------------------------- -->
        <div id="divtitle2" style="page-break-before:always; display: none; padding-top: 4rem !important">
                
        </div>
        <div class="ui two stackable cards raised" style="margin-top: 5px;">
            
            <div id="divtitle" style="display: none">
                <br/><br/><br/>
            </div>

            <div class="card">
                <div class="ui active loader" id="loader6"></div>
                <div class="content" id="resultchart6" style="display: none"></div>
            </div>
            <div class="card">
                <div class="ui active loader" id="explainloader6"></div>
                <div class="content" id="explainchart6">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 16px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span id="" style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">
                                            Ringkasan Taraf Perkahwinan
                                        </span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Kategori</th>
                                <th style="text-align: center;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="table-chart6">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end chart 6 ------------------------------- -->

        <!-- chart 7 ------------------------------- -->
        <div class="ui two stackable cards raised link" id="modalchart7" style="margin-top: 5px;">
            <div class="card">
                <div class="ui active loader" id="loader7"></div>
                <div class="content" id="resultchart7" style="display: none"></div>
            </div>
            <div class="card">
                <div class="ui active loader" id="explainloader7"></div>
                <div class="content" id="explainchart7">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 16px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span id="" style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">
                                            Ringkasan Umur Penduduk
                                        </span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Kategori</th>
                                <th style="text-align: center;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="table-chart7">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end chart 7 ------------------------------- -->

        <!-- chart 8 ------------------------------- -->
        <div class="ui two stackable cards raised" style="margin-top: 5px;">
            <div class="card">
                <div class="ui active loader" id="loader8"></div>
                <div class="content" id="resultchart8" style="display: none"></div>
            </div>
            <div class="card">
                <div class="ui active loader" id="explainloader8"></div>
                <div class="content" id="explainchart8">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 16px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span id="" style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">
                                            Ringkasan Pendapatan Penduduk
                                        </span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Kategori</th>
                                <th style="text-align: center;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="table-chart8">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end chart 8 ------------------------------- -->
    </div>
</div>

<div id="contentcarian" style="margin-top: -1rem">
    
</div>

<!-- start modal chart 1 -->
    <div class="ui large modal" id="chart1">
        <div class="header" style="height: 67px">
            <h4>MAKLUMAT STATUS PEMILIKAN RUMAH</h4>
        </div>
        <div class="scrolling content">

            <div class="ui active loader" id="loadertable1"></div>

            <div class="ui active p-2" id="divchart1">
                <table id="tablechart1" class="ui unstackable celled striped table" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">BIL</th>
                            <th style="text-align: center;">NAMA</th>
                            <th style="text-align: center;">NO KAD PENGENALAN</th>
                            <th style="text-align: center;">NO TEL</th>
                            <th style="text-align: center;">STATUS PEMILIKAN</th>
                            <th style="text-align: center;">MUKIM</th>
                            <th style="text-align: center;">KAMPUNG</th>
                        </tr>
                    </thead>
                    <tbody id="tbodychart1">

                    </tbody>
                </table>
            </div>

        </div>
        <div class="actions">
            <div class="ui inverted red button cancel">
                <i class="remove icon"></i>
                Tutup
            </div>
        </div>
    </div>
<!-- end modal chart 1 -->

<!-- start modal chart 2 -->
    <div class="ui large modal" id="chart2">
        <div class="header" style="height: 67px">
            <h4>MAKLUMAT JENIS RUMAH</h4>
        </div>
        <div class="scrolling content">

            <div class="ui active loader" id="loadertable2"></div>

            <div class="ui active p-2" id="divchart2">
                <table id="tablechart2" class="ui unstackable celled striped table" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">BIL</th>
                            <th style="text-align: center;">NAMA</th>
                            <th style="text-align: center;">NO KAD PENGENALAN</th>
                            <th style="text-align: center;">NO TEL</th>
                            <th style="text-align: center;">JENIS RUMAH</th>
                            <th style="text-align: center;">MUKIM</th>
                            <th style="text-align: center;">KAMPUNG</th>
                        </tr>
                    </thead>
                    <tbody id="tbodychart2">

                    </tbody>
                </table>
            </div>

        </div>
        <div class="actions">
            <div class="ui inverted red button cancel">
                <i class="remove icon"></i>
                Tutup
            </div>
        </div>
    </div>
<!-- end modal chart 2 -->

<!-- start modal chart 3 -->
    <div class="ui large modal" id="chart3">
        <div class="header" style="height: 67px">
            <h4>MAKLUMAT KEMUDAHAN AWAM & INFRASTRUKTUR</h4>
        </div>
        <div class="scrolling content">

            <div class="ui active loader" id="loadertable3"></div>

            <div class="ui active p-2" id="divchart3">
                <table id="tablechart3" class="ui unstackable celled striped table" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">BIL</th>
                            <th style="text-align: center;">NAMA KEMUDAHAN</th>
                            <th style="text-align: center;">KATEGORI KEMUDAHAN</th>
                            <th style="text-align: center;">JENIS KEMUDAHAN</th>
                            <th style="text-align: center;">BILANGAN</th>
                            <th style="text-align: center;">UNIT</th>
                            <th style="text-align: center;">MUKIM</th>
                            <th style="text-align: center;">KAMPUNG</th>
                        </tr>
                    </thead>
                    <tbody id="tbodychart3">

                    </tbody>
                </table>
            </div>

        </div>
        <div class="actions">
            <div class="ui inverted red button cancel">
                <i class="remove icon"></i>
                Tutup
            </div>
        </div>
    </div>
<!-- end modal chart 3 -->

<!-- start modal chart 4 -->
    <div class="ui large modal" id="chart4">
        <div class="header" style="height: 67px">
            <h4>MAKLUMAT KEMUDAHAN ASAS RUMAH</h4>
        </div>
        <div class="scrolling content">

            <div class="ui active loader" id="loadertable4"></div>

            <div class="ui active p-2" id="divchart4">
                <table id="tablechart4" class="ui unstackable celled striped table" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">BIL</th>
                            <th style="text-align: center;">NAMA</th>
                            <th style="text-align: center;">NO KAD PENGENALAN</th>
                            <th style="text-align: center;">NO TEL</th>
                            <th style="text-align: center;">AIR</th>
                            <th style="text-align: center;">ELEKTRIK</th>
                            <th style="text-align: center;">ASTRO</th>
                            <th style="text-align: center;">INTERNET</th>
                            <th style="text-align: center;">TELEFON</th>
                            <th style="text-align: center;">MUKIM</th>
                            <th style="text-align: center;">KAMPUNG</th>
                        </tr>
                    </thead>
                    <tbody id="tbodychart4">

                    </tbody>
                </table>
            </div>

        </div>
        <div class="actions">
            <div class="ui inverted red button cancel">
                <i class="remove icon"></i>
                Tutup
            </div>
        </div>
    </div>
<!-- end modal chart 4 -->

<!-- start modal chart 5 -->
    <div class="ui large modal" id="chart5">
        <div class="header" style="height: 67px">
            <h4>MAKLUMAT STATUS PEKERJAAN</h4>
        </div>
        <div class="scrolling content">

            <div class="ui active loader" id="loadertable5"></div>

            <div class="ui active p-2" id="divchart5">
                <table id="tablechart5" class="ui unstackable celled striped table" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">BIL</th>
                            <th style="text-align: center;">NAMA</th>
                            <th style="text-align: center;">NO KAD PENGENALAN</th>
                            <th style="text-align: center;">NO TEL</th>
                            <th style="text-align: center;">PEKERJAAN</th>
                            <th style="text-align: center;">MUKIM</th>
                            <th style="text-align: center;">KAMPUNG</th>
                        </tr>
                    </thead>
                    <tbody id="tbodychart5">

                    </tbody>
                </table>
            </div>

        </div>
        <div class="actions">
            <div class="ui inverted red button cancel">
                <i class="remove icon"></i>
                Tutup
            </div>
        </div>
    </div>
<!-- end modal chart 5 -->

<!-- start modal chart 6 -->
    <div class="ui large modal" id="chart6">
        <div class="header" style="height: 67px">
            <h4>MAKLUMAT TARAF PERKAHWINAN</h4>
        </div>
        <div class="scrolling content">

            <div class="ui active loader" id="loadertable6"></div>

            <div class="ui active p-2" id="divchart6">
                <table id="tablechart6" class="ui unstackable celled striped table" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">BIL</th>
                            <th style="text-align: center;">NAMA</th>
                            <th style="text-align: center;">NO KAD PENGENALAN</th>
                            <th style="text-align: center;">NO TEL</th>
                            <th style="text-align: center;">TARAF PERKAHWINAN</th>
                            <th style="text-align: center;">MUKIM</th>
                            <th style="text-align: center;">KAMPUNG</th>
                        </tr>
                    </thead>
                    <tbody id="tbodychart6">

                    </tbody>
                </table>
            </div>

        </div>
        <div class="actions">
            <div class="ui inverted red button cancel">
                <i class="remove icon"></i>
                Tutup
            </div>
        </div>
    </div>
<!-- end modal chart 6 -->

<!-- start modal chart 7 -->
    <div class="ui large modal" id="chart7">
        <div class="header" style="height: 67px">
            <h4>MAKLUMAT UMUR PENDUDUK</h4>
        </div>
        <div class="scrolling content">

            <div class="ui active loader" id="loadertable7"></div>

            <div class="ui active p-2" id="divchart7">
                <table id="tablechart7" class="ui unstackable celled striped table" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">BIL</th>
                            <th style="text-align: center;">NAMA</th>
                            <th style="text-align: center;">NO KAD PENGENALAN</th>
                            <th style="text-align: center;">NO TEL</th>
                            <th style="text-align: center;">UMUR</th>
                            <th style="text-align: center;">MUKIM</th>
                            <th style="text-align: center;">KAMPUNG</th>
                        </tr>
                    </thead>
                    <tbody id="tbodychart7">

                    </tbody>
                </table>
            </div>

        </div>
        <div class="actions">
            <div class="ui inverted red button cancel">
                <i class="remove icon"></i>
                Tutup
            </div>
        </div>
    </div>
<!-- end modal chart 7 -->

<!-- start modal chart 8 -->
    <div class="ui large modal" id="chart8">
        <div class="header" style="height: 67px">
            <h4>MAKLUMAT PENDAPATAN PENDUDUK</h4>
        </div>
        <div class="scrolling content">

            <div class="ui active loader" id="loadertable8"></div>

            <div class="ui active p-2" id="divchart8">
                <table id="tablechart8" class="ui unstackable celled striped table" style="width: 100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">BIL</th>
                            <th style="text-align: center;">NAMA</th>
                            <th style="text-align: center;">NO KAD PENGENALAN</th>
                            <th style="text-align: center;">NO TEL</th>
                            <th style="text-align: center;">PENDAPATAN</th>
                            <th style="text-align: center;">MUKIM</th>
                            <th style="text-align: center;">KAMPUNG</th>
                        </tr>
                    </thead>
                    <tbody id="tbodychart8">

                    </tbody>
                </table>
            </div>

        </div>
        <div class="actions">
            <div class="ui inverted red button cancel">
                <i class="remove icon"></i>
                Tutup
            </div>
        </div>
    </div>
<!-- end modal chart 8 -->

@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function() 
    {
        var type="{{ $request->menu }}";

        if(type==2)
        {
            showcarian();
        }
        else
        {
            
        }

        $('#sel_kampung').change(function()
        {
            var id = $('#kampung').val();
            // alert("kampung -> "+kampung)
        
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dashboard/kampungname/')}}" + "/" + id,
                datatype: 'json',

                beforeSend: function() 
                {
                    block("tab-content");
                    // $('#contentstatistic').hide();
                    $('#loading').show();
                },
                success: function(data) 
                {
                    $('#showkampung').html(data);

                    search();
                }
            });
        });

    });

    function showmap() 
    {
        $('#loading').show();
        $('#contentstatistic').hide();
        $('#contentcarian').hide();

        window.location.href = "/location/admindaerah";
    }

    function showcarian()
    {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('dashboard/showcarian')}}",
            datatype: 'json',

            beforeSend: function() 
            {
                $('#loading').show();
                $('#contentcarian').hide();
                $('#contentcarian').html('');
                $('#contentstatistic').hide();
                $('#contentstatistic').html('');
            },
            success: function(data) 
            {
                $('#loading').hide();
                $('#contentcarian').html(data);
                $('#contentcarian').show();
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

    function showstatistic()
    {
        $('#loading').show();
        $('#contentstatistic').hide();
        $('#contentcarian').hide();

        window.location.href = "/dashboard/admindaerah/1";
    }

    function select2(idselect)
    {
        $('#'+idselect).dropdown(
        {
            sortSelect: true,
            fullTextSearch:'exact'
        });
    }

    function showportal() 
    {
        $('#loading').show();
        $('#contentstatistic').hide();

        window.location.href = "/";
    }

    function pdfclick()
    {
        window.print();
    }

</script>

<script type="text/javascript">
    $(document).ready(function() 
    {
        $('.ui.accordion').accordion();

        // untuk kegunaan admin daerah -------------------------

            var role = "{{data_get($roleuser,'role_id')}}";
            var daerahuser = "{{$daerahuser}}";
            var mukimuser = "{{$mukimuser}}";

            if (daerahuser == '') 
            {
                var valdaerahuser = 0;
            } 
            else 
            {
                var valdaerahuser = daerahuser;
            }

            if (mukimuser == '') 
            {
                var valmukimuser = 0;
            } 
            else 
            {
                var valmukimuser = mukimuser;
            }

            if (role == 2 || role == 3) 
            {
            // $('#parlimendun').hide();
                if (role == 2) 
                {
                    $.ajax({
                        type: "GET",
                        url: "{{ URL::to('dataentry/mukim/')}}" + "/" + valdaerahuser,
                        datatype: 'json',

                        beforeSend: function() 
                        {
                            // $('div.text').html('Sila Pilih');
                            block("tab-content");
                            document.getElementById("pilihmukim").innerHTML = "Sila Pilih";
                            $('#selectmukim').html('');
                            $('#result2').hide();
                            $('#contentstatistic').hide();
                            $('#loading').show();
                        },
                        success: function(data) 
                        {
                            unblock("tab-content");
                            $('#contentstatistic').show();
                            $('#loading').hide();
                            $('#selectmukim').html(data);
                        }
                    });
                }

                $.ajax({
                    type: "GET",
                    url: "{{ URL::to('dataentry/parlimenKampung/')}}" + "/" + valdaerahuser + "/" + valmukimuser,
                    datatype: 'json',

                    beforeSend: function() 
                    {
                        // $('div.text').html('Sila Pilih');
                        document.getElementById("pilihparlimen").innerHTML = "Sila Pilih";
                        document.getElementById("pilihdun").innerHTML = "Sila Pilih";
                        $('#selectparlimen').html('');
                        $('#selectdun').html('');
                        $('#loading').show();
                        $('#result2').hide();
                        // kena reset balik parlimen
                        $('#parlimen').val(0);
                        $('#dun').val(0);
                        if (role == 2) 
                        {
                            $('#mukim').val(0);
                        }
                        $('#kampung').val(0);
                    },
                    success: function(data) 
                    {
                        $('#loading').hide();
                        $('#selectparlimen').html(data);
                    }
                });
            }
        
        // end - untuk kegunaan admin daerah -------------------------

        var parlimen = $('#parlimen').val();

        if (parlimen == '') 
        {
            valparlimen = 0;
        } 
        else 
        {
            valparlimen = parlimen;
        }

        var dun = $('#dun').val();

        if (dun == '') 
        {
            valdun = 0;
        } 
        else 
        {
            valdun = dun;
        }

        if (role == 2) 
        { //
            var daerah = valdaerahuser;
            var mukim = $('#mukim').val();
        } 
        else if (role == 3) 
        {
            var daerah = valdaerahuser;
            var mukim = valmukimuser;
        } 
        else 
        {
            var daerah = $('#daerah').val();
            var mukim = $('#mukim').val();
        }

        // console.log("daerah: - "+daerah);

        if (daerah == '') 
        {
            valdaerah = 0;
        } 
        else 
        {
            valdaerah = daerah;
        }

        if (mukim == '') 
        {
            valmukim = 0;
        } 
        else 
        {
            valmukim = mukim;
        }

        var cat_petempatan = $('#cat_petempatan').val();

        if (cat_petempatan == '') 
        {
            valcat_petempatan = 0;
        } 
        else 
        {
            valcat_petempatan = cat_petempatan;
        }

        var kampung = $('#kampung').val();

        if (kampung == '') 
        {
            valkampung = 0;
        } 
        else 
        {
            valkampung = kampung;
        }

        $.ajax({
            type: "GET",
            url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
            datatype: 'json',

            beforeSend: function() 
            {
                block("tab-content");
                document.getElementById("pilihkampung").innerHTML = "Sila Pilih";

                $('#selectkampung').html('');
                $('#loading').show();
            },

            success: function(data) 
            {
                unblock("tab-content");

                $('#loading').hide();
                $('#selectkampung').html(data);
            }
        });

        search();
    });

    function search() 
    {
        valparlimen = 0;
        valdun = 0;

        var daerah = "{{$daerahuser}}";

        if (daerah == '') 
        {
            valdaerah = 0;
        } 
        else 
        {
            valdaerah = daerah;
        }

        var mukim = $('#mukim').val();

        if (mukim == '') 
        {
            valmukim = 0;
        } 
        else 
        {
            valmukim = mukim;
        }

        var mukim = $('#mukim').val();
        
        if (mukim == '') 
        {
            valmukim = 0;
        } 
        else 
        {
            valmukim = mukim;
        }

        var cat_petempatan = $('#cat_petempatan').val();

        if (cat_petempatan == '') 
        {
            valcat_petempatan = 0;
        } 
        else 
        {
            valcat_petempatan = cat_petempatan;
        }

        var kampung = $('#kampung').val();

        if (kampung == '') 
        {
            valkampung = 0;
        } 
        else 
        {
            valkampung = kampung;
        }

        $.ajax({
            type: "GET",
            url: "{{ URL::to('/dashboard/countpetempatan/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,
            // datatype: 'json',

            beforeSend: function() 
            {
                block("tab-content");
                $('#loading').show();
                document.getElementById('result3').style.display = "none";
            },

            success: function(data) 
            {
                unblock("tab-content");
                $('#loading').hide();
                // document.getElementById('result3').style.display = "show";
                $('#result3').show();
                document.getElementById('resultcountpetempatan').innerHTML = data;
            }
        });

        $.ajax({
            type: "GET",
            url: "{{ URL::to('/dashboard/countdata/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,
            // datatype: 'json',

            beforeSend: function() 
            {

            },

            success: function(data) 
            {
                if (data == 0) 
                {
                    $('#result4').hide();
                } 
                else 
                {
                    $('#result4').show();
                }
            }
        });

        // start getchart1 -------------------------------------------------------------------
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/dashboard/chart1/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,
            // datatype: 'json',
            
            beforeSend: function() 
            {
                $('#loader1').show();
                $('#result4').show();
                document.getElementById('resultchart1').style.display = "none";

                $('#explainloader1').show();
                document.getElementById('explainchart1').style.display = "none";
            },
            success: function(data) 
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var htc1 = "";

                $('#result4').show();
                $('#loader1').hide();
                $('#resultchart1').show();

                arr_data = data.arr_data;
                arr_status = data.arr_status;
                lengthdata = data.arr_status.length;
                arr_idlkp = data.arr_idlkp;

                $("#resultchart1").html('<canvas id="myBarChart" height="350" width="580"></canvas></div>');
                getBarStatusMilik(arr_data, arr_status, lengthdata);

                $('#explainloader1').hide();
                $('#explainchart1').show();

                var paparan = arr_status.toString().split(",");
                var sum = 0;

                if(lengthdata != 0)
                {
                    for(var i=0; i<paparan.length; i++)
                    {
                        htc1 += '<tr>';
                        htc1 +=  "<td style='text-align: center; font-size: 13px; width: 80%'>"+paparan[i]+"</td>";
                        htc1 +=  "<td style='text-align: center; font-size: 13px; width: 20%'><a onclick='fxmodal1("+arr_idlkp[i]+")' href='javascript:;' data-inverted='' data-tooltip='Maklumat Status Pemilikan Rumah "+paparan[i]+"' data-position='top right'>"+arr_data[i]+"</a></td>";
                        htc1 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc1 += '<tr>';
                    htc1 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</b></td>";
                    htc1 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
                    htc1 += '</tr>';
                }
                else
                {
                    htc1 += '<tr>';
                    htc1 +=  "<td style='text-align: center; font-size: 13px; width: 80%'> - </td>";
                    htc1 +=  "<td style='text-align: center; font-size: 13px; width: 20%'> - </td>";
                    htc1 += '</tr>';

                    htc1 += '<tr>';
                    htc1 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc1 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc1 += '</tr>';
                }

                $("#table-chart1").html(htc1);

                var arr_temp = [];
                arr_temp["daerah"]  = valdaerah;
                arr_temp["mukim"]   = valmukim;
                arr_temp["parlimen"]= valparlimen;
                arr_temp["dun"]     = valdun;
                arr_temp["catpetempatan"]   = valcat_petempatan;
                arr_temp["kampung"]         = valkampung;

                setDataTemp(1, arr_temp);
            }
        }); 
        //end ajax chart1 -------------------------------------------------------------------

        // start getchart2 -------------------------------------------------------------------
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/dashboard/chart2/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

            beforeSend: function() 
            {
                $('#loader2').show();
                document.getElementById('resultchart2').style.display = "none";

                $('#explainloader2').show();
                document.getElementById('explainchart2').style.display = "none";
            },
            success: function(data) 
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var htc2 = "";

                $('#loader2').hide();
                $('#resultchart2').show();

                arr_jenis = data.arr_jenis;
                arr_data = data.arr_data;
                lengthdata = data.arr_jenis.length;
                jumjenisrumah = data.jumjenisrumah;
                arr_idlkp = data.arr_idlkp;

                $("#resultchart2").html('<canvas id="myPieChart" height="500" width="580"></canvas></div>');
                getPieJenisRumah(arr_jenis, arr_data, lengthdata, jumjenisrumah);

                $('#explainloader2').hide();
                $('#explainchart2').show();


                var paparan = arr_jenis.toString().split(",");
                var sum = 0;

                if(lengthdata != 0)
                {
                    for(var i=0; i<paparan.length; i++)
                    {
                        htc2 += '<tr>';
                        htc2 +=  "<td style='text-align: center; font-size: 13px; width: 80%'>"+paparan[i]+"</td>";
                        htc2 +=  "<td style='text-align: center; font-size: 13px; width: 20%'><a onclick='fxmodal2("+arr_idlkp[i]+")' href='javascript:;' data-inverted='' data-tooltip='Maklumat Jenis Rumah Kategori "+paparan[i]+"' data-position='top right'>"+arr_data[i]+"</a></td>";
                        htc2 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc2 += '<tr>';
                    htc2 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc2 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
                    htc2 += '</tr>';
                }
                else
                {
                    htc2 += '<tr>';
                    htc2 +=  "<td style='text-align: center; font-size: 13px; width: 80%'> - </td>";
                    htc2 +=  "<td style='text-align: center; font-size: 13px; width: 20%'> - </td>";
                    htc2 += '</tr>';

                    htc2 += '<tr>';
                    htc2 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc2 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc2 += '</tr>';
                }

                $("#table-chart2").html(htc2);

                var arr_temp = [];
                arr_temp["daerah"]  = valdaerah;
                arr_temp["mukim"]   = valmukim;
                arr_temp["parlimen"]= valparlimen;
                arr_temp["dun"]     = valdun;
                arr_temp["catpetempatan"]   = valcat_petempatan;
                arr_temp["kampung"]         = valkampung;

                setDataTemp(2, arr_temp);
            }
        });
        // end getchart2 -------------------------------------------------------------------

        // start getchart3 -------------------------------------------------------------------
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/dashboard/chart3/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

            beforeSend: function() 
            {
                $('#loader3').show();
                document.getElementById('resultchart3').style.display = "none";

                $('#explainloader3').show();
                document.getElementById('explainchart3').style.display = "none";
            },
            success: function(data) 
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var htc3 = "";

                $('#loader3').hide();
                $('#resultchart3').show();

                arr_jenis = data.arr_jenis;
                arr_data = data.arr_data;
                lengthdata = data.arr_jenis.length;
                jumkemudahan = data.jumkemudahan;
                arr_idlkp = data.arr_idlkp;

                $("#resultchart3").html('<canvas id="myPieKemudahan" height="500" width="580"></canvas></div>');
                getPieKemudahan(arr_jenis, arr_data, lengthdata, jumkemudahan);

                $('#explainloader3').hide();
                $('#explainchart3').show();

                var paparan = arr_jenis.toString().split(",");
                var sum = 0;

                if(lengthdata != 0)
                {
                    for(var i=0; i<paparan.length; i++)
                    {
                        htc3 += '<tr>';
                        htc3 +=  "<td style='text-align: center; font-size: 13px; width: 80%'>"+paparan[i]+"</td>";
                        htc3 +=  "<td style='text-align: center; font-size: 13px; width: 20%'><a onclick='fxmodal3("+arr_idlkp[i]+")' href='javascript:;' data-inverted='' data-tooltip='Maklumat Kemudahan Awam & Infrastruktur "+paparan[i]+"' data-position='top right'>"+arr_data[i]+"</a></td>";
                        htc3 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc3 += '<tr>';
                    htc3 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc3 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
                    htc3 += '</tr>';
                }
                else
                {
                    htc3 += '<tr>';
                    htc3 +=  "<td style='text-align: center; font-size: 13px; width: 80%'> - </td>";
                    htc3 +=  "<td style='text-align: center; font-size: 13px; width: 20%'> - </td>";
                    htc3 += '</tr>';

                    htc3 += '<tr>';
                    htc3 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc3 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc3 += '</tr>';
                }

                $("#table-chart3").html(htc3);

                var arr_temp = [];
                arr_temp["daerah"]  = valdaerah;
                arr_temp["mukim"]   = valmukim;
                arr_temp["parlimen"]= valparlimen;
                arr_temp["dun"]     = valdun;
                arr_temp["catpetempatan"]   = valcat_petempatan;
                arr_temp["kampung"]         = valkampung;

                setDataTemp(3, arr_temp);
            }
        });
        // starendt getchart3 -------------------------------------------------------------------

        // start getchart4 -------------------------------------------------------------------
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/dashboard/chart4/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

            beforeSend: function() 
            {
                $('#loader4').show();
                document.getElementById('resultchart4').style.display = "none";

                $('#explainloader4').show();
                document.getElementById('explainchart4').style.display = "none";
            },
            success: function(data) 
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var arr_ya = "";
                var arr_tidak = "";
                var htc4 = "";

                $('#loader4').hide();
                $('#resultchart4').show();

                arr_jenis = data.arr_status;
                arr_data = data.arr_data;
                lengthdata = data.arr_status.length;
                arr_label = data.arr_label;
                arr_ya = data.arr_ya;
                arr_tidak = data.arr_tidak;
                arr_idlkp = data.arr_idlkp;

                $("#resultchart4").html('<canvas id="myBarChart2" height="350" width="580"></canvas></div>');
                getBarKemudahan2(arr_jenis, arr_data, lengthdata, arr_label, arr_ya, arr_tidak);

                $('#explainloader4').hide();
                $('#explainchart4').show();

                var paparan = arr_jenis.toString().split(",");
                var sumya = 0;
                var sumno = 0;

                if(lengthdata != 0)
                {
                    for(var i=0; i<paparan.length; i++)
                    {
                        htc4 += '<tr>';
                        htc4 +=  "<td style='text-align: center; font-size: 13px; width: 60%'>"+paparan[i]+"</td>";
                        // htc4 +=  "<td style='text-align: center; font-size: 13px; width: 20%'>"+arr_ya[i]+"</td>";
                        // htc4 +=  "<td style='text-align: center; font-size: 13px; width: 20%'>"+arr_tidak[i]+"</td>";
                        htc4 +=  "<td style='text-align: center; font-size: 13px; width: 20%'><a onclick='fxmodal4("+arr_idlkp[i]+"1)' href='javascript:;' data-inverted='' data-tooltip='Maklumat Kemudahan Asas Rumah "+paparan[i]+"' data-position='top right'>"+arr_ya[i]+"</a></td>";
                        htc4 +=  "<td style='text-align: center; font-size: 13px; width: 20%'><a onclick='fxmodal4("+arr_idlkp[i]+"0)' href='javascript:;' data-inverted='' data-tooltip='Maklumat Kemudahan Asas Rumah "+paparan[i]+"' data-position='top right'>"+arr_tidak[i]+"</a></td>";
                        htc4 += '</tr>';

                        sumya += Number(arr_ya[i]);
                        sumno += Number(arr_tidak[i]);
                    }

                    htc4 += '<tr>';
                    htc4 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc4 +=  "<td style='text-align: center; font-size: 13px'><b>"+sumya+"</b></td>";
                    htc4 +=  "<td style='text-align: center; font-size: 13px'><b>"+sumno+"</b></td>";
                    htc4 += '</tr>';
                }
                else
                {
                    htc4 += '<tr>';
                    htc4 +=  "<td style='text-align: center; font-size: 13px; width: 60%'> - </td>";
                    htc4 +=  "<td style='text-align: center; font-size: 13px; width: 20%'> - </td>";
                    htc4 +=  "<td style='text-align: center; font-size: 13px; width: 20%'> - </td>";
                    htc4 += '</tr>';

                    htc4 += '<tr>';
                    htc4 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc4 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc4 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc4 += '</tr>';
                }

                $("#table-chart4").html(htc4);

                var arr_temp = [];
                arr_temp["daerah"]  = valdaerah;
                arr_temp["mukim"]   = valmukim;
                arr_temp["parlimen"]= valparlimen;
                arr_temp["dun"]     = valdun;
                arr_temp["catpetempatan"]   = valcat_petempatan;
                arr_temp["kampung"]         = valkampung;

                setDataTemp(4, arr_temp);
            }
        });
        // end getchart4 -------------------------------------------------------------------

        // start getchart5 -------------------------------------------------------------------
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/dashboard/chart5/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

            beforeSend: function() 
            {
                $('#loader5').show();
                document.getElementById('resultchart5').style.display = "none";

                $('#explainloader5').show();
                document.getElementById('explainchart5').style.display = "none";
            },
            success: function(data) 
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var htc5 = "";

                $('#loader5').hide();
                $('#resultchart5').show();
                
                arr_jenis = data.arr_jenis;
                arr_data = data.arr_data;
                lengthdata = data.arr_jenis.length;
                jumjeniskerja = data.jumjeniskerja;
                arr_idlkp = data.arr_idlkp;

                $("#resultchart5").html('<canvas id="myPieKerja" height="500" width="580"></canvas></div>');
                getPieKerja(arr_jenis, arr_data, lengthdata, jumjeniskerja);

                $('#explainloader5').hide();
                $('#explainchart5').show();

                var paparan = arr_jenis.toString().split(",");
                var sum = 0;

                if(lengthdata != 0)
                {
                    for(var i=0, j5=1; i<paparan.length; i++, j5++)
                    {
                        htc5 += '<tr>';
                        htc5 +=  "<td style='text-align: center; font-size: 13px; width: 80%'>"+paparan[i]+"</td>";
                        htc5 +=  "<td style='text-align: center; font-size: 13px; width: 20%'><a onclick='fxmodal5("+arr_idlkp[i]+")' href='javascript:;' data-inverted='' data-tooltip='Maklumat Status Pekerjaan Kategori "+paparan[i]+"' data-position='top right'>"+arr_data[i]+"</a></td>";
                        htc5 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
                    htc5 += '</tr>';
                }
                else
                {
                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px; width: 80%'> - </td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px; width: 20%'> - </td>";
                    htc5 += '</tr>';

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc5 += '</tr>';
                }

                $("#table-chart5").html(htc5);

                var arr_temp = [];
                arr_temp["daerah"]  = valdaerah;
                arr_temp["mukim"]   = valmukim;
                arr_temp["parlimen"]= valparlimen;
                arr_temp["dun"]     = valdun;
                arr_temp["catpetempatan"]   = valcat_petempatan;
                arr_temp["kampung"]         = valkampung;

                setDataTemp(5, arr_temp);
            }
        });
        // end getchart5 -------------------------------------------------------------------

        // start getchart6 -------------------------------------------------------------------
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/dashboard/chart6/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

            beforeSend: function() 
            {
                $('#loader6').show();
                document.getElementById('resultchart6').style.display = "none";

                $('#explainloader6').show();
                document.getElementById('explainchart6').style.display = "none";
            },
            success: function(data) 
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var htc6 = "";

                $('#loader6').hide();
                $('#resultchart6').show();

                arr_jenis = data.arr_jenis;
                arr_data = data.arr_data;
                lengthdata = data.arr_jenis.length;
                jumjeniskawin = data.jumjeniskawin;
                arr_idlkp = data.arr_idlkp;

                $("#resultchart6").html('<canvas id="myPieKahwin" height="500" width="580"></canvas>');
                getPieKahwin(arr_jenis, arr_data, lengthdata, jumjeniskawin);

                $('#explainloader6').hide();
                $('#explainchart6').show();

                var paparan = arr_jenis.toString().split(",");
                var sum = 0;

                if(lengthdata != 0)
                {
                    for(var i=0; i<paparan.length; i++)
                    {
                        htc6 += '<tr>';
                        htc6 +=  "<td style='text-align: center; font-size: 13px; width: 80%'>"+paparan[i]+"</td>";
                        // htc6 +=  "<td style='text-align: center; font-size: 13px; width: 20%'>"+arr_data[i]+"</td>";
                        htc6 +=  "<td style='text-align: center; font-size: 13px; width: 20%'><a onclick='fxmodal6("+arr_idlkp[i]+")' href='javascript:;' data-inverted='' data-tooltip='Maklumat Taraf Perkahwinan "+paparan[i]+"' data-position='top right'>"+arr_data[i]+"</a></td>";
                        htc6 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc6 += '<tr>';
                    htc6 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc6 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
                    htc6 += '</tr>';
                }
                else
                {
                    htc6 += '<tr>';
                    htc6 +=  "<td style='text-align: center; font-size: 13px; width: 80%'> - </td>";
                    htc6 +=  "<td style='text-align: center; font-size: 13px; width: 20%'> - </td>";
                    htc6 += '</tr>';

                    htc6 += '<tr>';
                    htc6 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc6 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc6 += '</tr>';
                }

                $("#table-chart6").html(htc6);

                var arr_temp = [];
                arr_temp["daerah"]  = valdaerah;
                arr_temp["mukim"]   = valmukim;
                arr_temp["parlimen"]= valparlimen;
                arr_temp["dun"]     = valdun;
                arr_temp["catpetempatan"]   = valcat_petempatan;
                arr_temp["kampung"]         = valkampung;

                setDataTemp(6, arr_temp);
            }
        });
        // end getchart6 -------------------------------------------------------------------

        // start getchart7 -------------------------------------------------------------------
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/dashboard/chart7/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

            beforeSend: function() 
            {
                $('#loader7').show();
                document.getElementById('resultchart7').style.display = "none";

                $('#explainloader7').show();
                document.getElementById('explainchart7').style.display = "none";
            },
            success: function(data) 
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var htc7 = "";

                $('#loader7').hide();
                $('#resultchart7').show();

                arr_data = data.arr_data;
                arr_status = data.arr_status;
                lengthdata = data.arr_status.length;
                arr_idlkp = data.arr_idlkp;

                $("#resultchart7").html('<canvas id="myBarUmur" height="350" width="580"></canvas></div>');
                getBarUmur(arr_data, arr_status, lengthdata);

                $('#explainloader7').hide();
                $('#explainchart7').show();

                var paparan = arr_status.toString().split(",");
                var sum = 0;

                if(lengthdata != 0)
                {
                    for(var i=0; i<paparan.length; i++)
                    {
                        htc7 += '<tr>';
                        htc7 +=  "<td style='text-align: center; font-size: 13px; width: 80%'>"+paparan[i]+"</td>";
                        // htc7 +=  "<td style='text-align: center; font-size: 13px; width: 20%'>"+arr_data[i]+"</td>";
                        htc7 +=  "<td style='text-align: center; font-size: 13px; width: 20%'><a onclick='fxmodal7("+arr_idlkp[i]+")' href='javascript:;' data-inverted='' data-tooltip='Maklumat Umur Penduduk Kategori "+paparan[i]+"' data-position='top right'>"+arr_data[i]+"</a></td>";
                        htc7 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc7 += '<tr>';
                    htc7 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc7 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
                    htc7 += '</tr>';
                }
                else
                {
                    htc7 += '<tr>';
                    htc7 +=  "<td style='text-align: center; font-size: 13px; width: 80%'> - </td>";
                    htc7 +=  "<td style='text-align: center; font-size: 13px; width: 20%'> - </td>";
                    htc7 += '</tr>';

                    htc7 += '<tr>';
                    htc7 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc7 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc7 += '</tr>';
                }

                $("#table-chart7").html(htc7);

                var arr_temp = [];
                arr_temp["daerah"]  = valdaerah;
                arr_temp["mukim"]   = valmukim;
                arr_temp["parlimen"]= valparlimen;
                arr_temp["dun"]     = valdun;
                arr_temp["catpetempatan"]   = valcat_petempatan;
                arr_temp["kampung"]         = valkampung;

                setDataTemp(7, arr_temp);
            }
        });
        // end getchart7 -------------------------------------------------------------------

        // start getchart8 -------------------------------------------------------------------
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/dashboard/chart8/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

            beforeSend: function() 
            {
                $('#loader8').show();
                document.getElementById('resultchart8').style.display = "none";

                $('#explainloader8').show();
                document.getElementById('explainchart8').style.display = "none";
            },
            success: function(data) 
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var htc8 = "";

                $('#loader8').hide();
                $('#resultchart8').show();

                arr_data = data.arr_data;
                arr_status = data.arr_status;
                lengthdata = data.arr_status.length;
                arr_idlkp = data.arr_idlkp;

                $("#resultchart8").html('<canvas id="myBarPendapatan" height="350" width="580"></canvas></div>');
                getBarPendapatan(arr_data, arr_status, lengthdata);

                $('#explainloader8').hide();
                $('#explainchart8').show();

                var paparan = arr_status.toString().split(",");
                var sum = 0;

                if(lengthdata != 0)
                {
                    for(var i=0, j8=1; i<paparan.length; i++, j8++)
                    {
                        htc8 += '<tr>';
                        htc8 +=  "<td style='text-align: center; font-size: 13px; width: 80%' id=''>"+paparan[i]+"</td>";
                        htc8 +=  "<td style='text-align: center; font-size: 13px; width: 20%' id=''><a onclick='fxmodal8("+arr_idlkp[i]+")' href='javascript:;' data-inverted='' data-tooltip='Maklumat Pendapatan Penduduk Kategori "+paparan[i]+"' data-position='top right'>"+arr_data[i]+"</a></td>";
                        htc8 += '</tr>';
                        
                        sum += Number(arr_data[i]);
                    }

                    htc8 += '<tr>';
                    htc8 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc8 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
                    htc8 += '</tr>';
                }
                else
                {
                    htc8 += '<tr>';
                    htc8 +=  "<td style='text-align: center; font-size: 13px; width: 80%'> - </td>";
                    htc8 +=  "<td style='text-align: center; font-size: 13px; width: 20%'> - </td>";
                    htc8 += '</tr>';

                    htc8 += '<tr>';
                    htc8 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc8 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc8 += '</tr>';
                }

                $("#table-chart8").html(htc8);

                var arr_temp = [];
                arr_temp["daerah"]  = valdaerah;
                arr_temp["mukim"]   = valmukim;
                arr_temp["parlimen"]= valparlimen;
                arr_temp["dun"]     = valdun;
                arr_temp["catpetempatan"]   = valcat_petempatan;
                arr_temp["kampung"]         = valkampung;

                setDataTemp(8, arr_temp);
            }
        });
        // end getchart8 -------------------------------------------------------------------
    }

    // start function jenis chart ---------------------------------------
        function getBarStatusMilik(arr_data, arr_status, lengthdata) 
        {
            var ctx = $("#myBarChart");

            function getRandomColorEachDatamyBarChart(count) 
            {
                var data = [];
                var arr_color = [ 
                     ["#16747E", "#97AB38"
                    ],
                ];

                var colors = arr_color[Math.floor(Math.random() * arr_color.length)];

                for (var i = 0; i < count; i++) 
                {
                    // data.push(getRandomColor());
                    data.push(colors[i]);
                }

                return data;
            }

            var chartOptions = {
                tooltips: 
                {
                    callbacks: 
                    {
                        label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
                        title: () => null,
                    }
                },

                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: 
                {
                    title: 
                    {
                        display: true,
                        text: 'STATUS PEMILIKAN RUMAH',
                        padding: 
                        {
                            top: 10,
                            bottom: 30
                        },
                        font:
                        {
                            family: "Helvetica",
                            size: "18",
                        }
                    },
                    legend: 
                    {
                        display: false,
                    },
                    hover: 
                    {
                        mode: null
                    },
                }
            };

            if (lengthdata == 0) 
            {
                var chartData = '';
            } 
            else 
            {
                var chartData = {
                    labels: arr_status,
                    datasets: [
                    {
                        label: 'Status Pemilikan Rumah',
                        data: arr_data,
                        backgroundColor: getRandomColorEachDatamyBarChart(lengthdata),
                        hoverBackgroundColor: getRandomColorEachDatamyBarChart(lengthdata),
                        borderColor: "transparent",
                    }]
                };
            }

            var config = {
                type: "bar",
                // Chart Options
                options: chartOptions,
                data: chartData
            };
            var barChart = new Chart(ctx, config);
        }

        function getPieJenisRumah(arr_jenis, arr_data, lengthdata, jumjenisrumah) 
        {
            var ctxpie = $("#myPieChart");
            
            function getRandomColorEachData(count) 
            {
                var data = [];
                var arr_color = [
                    ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                 ],
                ];
                var colors = arr_color[Math.floor(Math.random() * arr_color.length)];

                for (var i = 0; i < count; i++) 
                {
                    // data.push(getRandomColor());
                    data.push(colors[i]);
                }

                return data;
            }

            var chartOptionspie = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: 
                {
                    title: 
                    {
                        display: true,
                        text: 'JENIS RUMAH',
                        padding: 
                        {
                            top: 10,
                            bottom: 30
                        },
                        font:
                        {
                            family: "Helvetica",
                            size: "18",
                        }
                    },
                    // datalabels: 
                    // {
                    //     color: '#fff',
                    //     display: 'auto',
                    // },
                    legend: 
                    {
                        display: true,
                        position: "bottom"
                    },
                    datalabels: 
                    {
                        formatter: (value, ctxpie) => 
                        {
                            const datapoints = ctxpie.chart.data.datasets[0].data
                            const total = jumjenisrumah
                            const percentage = value / total * 100
                            return percentage.toFixed(2) + "%";
                        },
                        color: '#fff',
                        display: 'auto',
                    }
                },
            };

            var chartDatapie = {
                labels: arr_jenis,
                datasets: [
                {
                    label: 'Jenis Rumah',
                    data: arr_data,
                    backgroundColor: getRandomColorEachData(lengthdata),
                    hoverBackgroundColor: getRandomColorEachData(lengthdata),
                    borderColor: "transparent",
                    tooltip: 
                    {
                        callbacks: 
                        {
                            label: function(context) 
                            {
                                let label = context.label;
                                let value = context.raw;
                                let valueformat = context.formattedValue;

                                if (!label)
                                    label = 'Unknown'

                                let sum = 0;
                                let dataArr = context.chart.data.datasets[0].data;
                                dataArr.map(data => 
                                {
                                    sum += Number(data);
                                });

                                let percentage = (value * 100 / sum).toFixed(2) + '%';

                                return label + ": " + valueformat + ":" + percentage
                            }
                        }
                    }
                }]
            };

            var configpie = 
            {
                type: 'doughnut',
                // Chart Options
                options: chartOptionspie,
                data: chartDatapie,
                plugins: [ChartDataLabels],
            };

            var pieChart = new Chart(ctxpie, configpie);
        }

        function getPieKemudahan(arr_jenis, arr_data, lengthdata, jumkemudahan) 
        {
            var ctxpie = $("#myPieKemudahan");

            function getRandomColorEachData(count) 
            {
                var data = [];
                var arr_color = [
                    ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                    ],
                ];

                var colors = arr_color[Math.floor(Math.random() * arr_color.length)];

                for (var i = 0; i < count; i++) 
                {
                    // data.push(getRandomColor());
                    data.push(colors[i]);
                }

                return data;
            }

            var chartOptionspie = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: 
                {
                    title: 
                    {
                        display: true,
                        text: 'KEMUDAHAN AWAM & INFRASTRUKTUR',
                        padding: 
                        {
                            top: 10,
                            bottom: 30
                        },
                        font:
                        {
                            family: "Helvetica",
                            size: "18",
                        }
                    },
                    legend: 
                    {
                        display: true,
                        position: "bottom"
                    },
                    //    datalabels: {
                    // color: '#fff',
                    //  display: 'auto',
                    //   },
                    datalabels: 
                    {
                        formatter: (value, ctxpie) => 
                        {
                            const datapoints = ctxpie.chart.data.datasets[0].data
                            const total = jumkemudahan
                            const percentage = value / total * 100
                            return percentage.toFixed(2) + "%";
                        },
                        color: '#fff',
                        display: 'auto',
                    }
                },
            };

            var chartDatapie = {
                labels: arr_jenis,
                datasets: [
                {
                    label: 'Kemudahan Awam & Infrastruktur',
                    data: arr_data,
                    backgroundColor: getRandomColorEachData(lengthdata),
                    hoverBackgroundColor: getRandomColorEachData(lengthdata),
                    borderColor: "transparent",
                    tooltip: 
                    {
                        callbacks: 
                        {
                            label: function(context)
                            {
                                let label = context.label;
                                let valueformat = context.formattedValue;
                                let value = context.raw;
                                if (!label) label = 'Unknown'
                                let sum = 0;
                                let dataArr = context.chart.data.datasets[0].data;
                                dataArr.map(data => 
                                {
                                    sum += Number(data);
                                });
                                let percentage = (value * 100 / sum).toFixed(2) + '%';
                                return label + ": " + valueformat + ":" + percentage
                            }
                        }
                    }
                }]
            };

            var configpie = {
                type: 'doughnut',
                // Chart Options
                options: chartOptionspie,
                data: chartDatapie,
                plugins: [ChartDataLabels],
            };

            var pieChart = new Chart(ctxpie, configpie);
        }

        function getBarKemudahan2(arr_jenis, arr_data, lengthdata, arr_label, arr_ya, arr_tidak) 
        {
            var ctxBarChart = $("#myBarChart2");

            function getRandomColorEachData(count) 
            {
                var data = [];
                var arr_color = [
                    ["#d69fbf", "#5b285c", "#486eab", "#6badd5", "#7e637a", "#324a80", "#c52b49", "#467680", "#5c4547", "#ab7277"],
                    ["#ab7277", "#324a80", "#467680", "#6badd5", "#7e637a", "#5b285c", "#c52b49", "#486eab", "#5c4547", "#d69fbf"],
                ];

                var colors = arr_color[Math.floor(Math.random() * arr_color.length)];

                for (var i = 0; i < count; i++) 
                {
                    // data.push(getRandomColor());
                    data.push(colors[i]);
                }

                return data;
            }

            if (lengthdata == 0) 
            {
                var optionsBar = {
                    plugins: 
                    {
                        title: 
                        {
                            display: true,
                            text: 'KEMUDAHAN ASAS RUMAH',
                            padding: 
                            {
                                top: 10,
                                bottom: 30
                            },
                            font:
                            {
                                family: "Helvetica",
                                size: "18",
                            }
                        },
                        legend: 
                        {
                            display: true,
                        },
                    }
                };
                var barChartData = '';
            } 
            else 
            {
                var optionsBar = {
                    scales: 
                    {
                        x: 
                        {
                            stacked: true
                        },
                        y: 
                        {
                            stacked: true
                        }
                    },
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: 
                    {
                        title: 
                        {
                            display: true,
                            text: 'Kemudahan Asas Rumah',
                            padding: 
                            {
                                top: 10,
                                bottom: 30
                            },
                            font:
                            {
                                family: "Helvetica",
                                size: "18",
                            }
                        },
                        legend: 
                        {
                            display: true,
                        },
                    }
                };

                var barChartData = {
                    labels: arr_jenis,
                    datasets: [
                    {
                        label: "Ya",
                        //backgroundColor: getRandomColorEachData(1),
                        backgroundColor: "rgb(22, 116, 126)",
                        hoverBackgroundColor: "rgb(22, 116, 126)",
                        data: arr_ya
                    }, 
                    {
                        label: "Tidak",
                        //backgroundColor: getRandomColorEachData(1),
                         backgroundColor: "rgb(177, 182, 42)",
                         hoverBackgroundColor:"rgb(177, 182, 42)",
                        data: arr_tidak
                    }]
                };
            }

            var config = {
                type: "bar",
                // Chart Options
                options: optionsBar,
                data: barChartData
            };

            var priceBarChart = new Chart(ctxBarChart, config);
        }

        function getPieKerja(arr_jenis, arr_data, lengthdata, jumjeniskerja) 
        {
            var ctxpie = $("#myPieKerja");

            function getRandomColorEachData(count) 
            {
                var data = [];
                var arr_color = [
                    ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                ],
                ];

                var colors = arr_color[Math.floor(Math.random() * arr_color.length)];

                for (var i = 0; i < count; i++) 
                {
                    // data.push(getRandomColor());
                    data.push(colors[i]);
                }
                return data;
            }

            var chartOptionspie = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: 
                {
                    title: 
                    {
                        display: true,
                        text: 'STATUS PEKERJAAN',
                        padding: 
                        {
                            top: 10,
                            bottom: 30
                        },
                        font:
                        {
                            family: "Helvetica",
                            size: "18",
                        }
                    },
                    //  datalabels: {
                    // color: '#fff',
                    // display: 'auto',
                    //   },
                    legend: 
                    {
                        display: true,
                        position: "bottom"
                    },
                    datalabels: 
                    {
                        //color: 'black',
                        formatter: (value, ctxpie) => 
                        {
                            // const datapoints = ctxpie.chart.data.datasets[0].data
                            // const total = jumjeniskerja
                            // const percentage = value / total * 100
                            // return percentage.toFixed(2) + "%";

                            let sum = 0;
                            let dataArr = ctxpie.chart.data.datasets[0].data;
                            dataArr.map(data => 
                            {
                                sum += Number(data);
                            });

                            let percentage =  value / sum * 100;
                            return percentage.toFixed(2) + "%";
                            
                        },
                        color: '#fff',
                        display: 'auto',
                    }
                },
            };

            if (lengthdata == 0) 
            {
                var chartDatapie = ''
            } 
            else 
            {
                var chartDatapie = {
                    labels: arr_jenis,
                    datasets: [
                    {
                        label: 'Status Pekerjaan',
                        data: arr_data,
                        backgroundColor: getRandomColorEachData(lengthdata),
                        hoverBackgroundColor: getRandomColorEachData(lengthdata),
                        borderColor: "transparent",
                        tooltip: 
                        {
                            callbacks: 
                            {
                                label: function(context) 
                                {
                                    let label = context.label;
                                    let valueformat = context.formattedValue;
                                    let value = context.raw;
                                    if (!label) label = 'Unknown'
                                    let sum = 0;
                                    let dataArr = context.chart.data.datasets[0].data;
                                    dataArr.map(data => {
                                        sum += Number(data);
                                    });
                                    let percentage = (value * 100 / sum).toFixed(2) + '%';
                                    return label + ": " + valueformat + ":" + percentage
                                }
                            }
                        }
                    }]
                };
            }

            var configpie = {
                type: 'pie',
                // Chart Options
                options: chartOptionspie,
                data: chartDatapie,
                plugins: [ChartDataLabels],
            };

            var pieChart = new Chart(ctxpie, configpie);
        }

        function getPieKahwin(arr_jenis, arr_data, lengthdata, jumjeniskerja) 
        {
            var ctxpie = $("#myPieKahwin");

            function getRandomColorEachData(count) 
            {
                var data = [];
                var arr_color = [
                     ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                     ],
                ];

                var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
                
                for (var i = 0; i < count; i++) 
                {
                    // data.push(getRandomColor());
                    data.push(colors[i]);
                }
                
                return data;
            }

            var chartOptionspie = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: 
                {
                    title: 
                    {
                        display: true,
                        text: 'TARAF PERKAHWINAN',
                        padding: 
                        {
                            top: 10,
                            bottom: 30
                        },
                        font:
                        {
                            family: "Helvetica",
                            size: "18",
                        }
                    },
                    //  datalabels: {
                    // color: '#fff',
                    //  display: 'auto',
                    //   },
                    legend: 
                    {
                        display: true,
                        position: "bottom"
                    },
                    datalabels: 
                    {
                        //color: 'black',
                        formatter: (value, ctxpie) =>
                        {
                            const datapoints = ctxpie.chart.data.datasets[0].data
                            const total = jumjeniskerja
                            const percentage = value / total * 100
                            return percentage.toFixed(2) + "%";
                        },
                        color: '#fff',
                        display: 'auto',
                    }
                },
            };
            var chartDatapie = {
                labels: arr_jenis,
                datasets: [
                {
                    label: 'Taraf Perkahwinan',
                    data: arr_data,
                    backgroundColor: getRandomColorEachData(lengthdata),
                    hoverBackgroundColor: getRandomColorEachData(lengthdata),
                    borderColor: "transparent",
                    tooltip: 
                    {
                        callbacks: 
                        {
                            label: function(context) 
                            {
                                let label = context.label;
                                let valueformat = context.formattedValue;
                                let value = context.raw;
                                if (!label) label = 'Unknown'
                                let sum = 0;
                                let dataArr = context.chart.data.datasets[0].data;
                                dataArr.map(data => 
                                {
                                    sum += Number(data);
                                });
                                let percentage = (value * 100 / sum).toFixed(2) + '%';
                                return label + ": " + valueformat + ":" + percentage
                            }
                        }
                    }
                }]
            };

            var configpie = {
                type: 'pie',
                // Chart Options
                options: chartOptionspie,
                data: chartDatapie,
                plugins: [ChartDataLabels],
            };

            var pieChart = new Chart(ctxpie, configpie);
        }

        function getBarUmur(arr_data, arr_status, lengthdata) 
        {
            var ctx = $("#myBarUmur");

            function getRandomColorEachData(count) 
            {
                var data = [];
                var arr_color = [
                   ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                   ],
                ];

                var colors = arr_color[Math.floor(Math.random() * arr_color.length)];

                for (var i = 0; i < count; i++) 
                {
                    // data.push(getRandomColor());
                    data.push(colors[i]);
                }
                
                return data;
            }

            var chartOptions = {
                tooltips: 
                {
                    callbacks: 
                    {
                        label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
                        title: () => null,
                    }
                },
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: 
                {
                    title: 
                    {
                        display: true,
                        text: 'UMUR PENDUDUK',
                        padding: 
                        {
                            top: 10,
                            bottom: 30
                        },
                        font:
                        {
                            family: "Helvetica",
                            size: "18",
                        }
                    },
                    legend: 
                    {
                        display: false,
                    },
                }
            };

            if (lengthdata == 0) 
            {
                var chartData = ''
            } 
            else 
            {
                var chartData = {
                    labels: arr_status,
                    datasets: [
                    {
                        label: 'Umur Penduduk',
                        data: arr_data,
                        backgroundColor: getRandomColorEachData(lengthdata),
                        hoverBackgroundColor: getRandomColorEachData(lengthdata),
                        borderColor: "transparent",
                    }]
                };
            }

            var config = {
                type: "bar",
                // Chart Options
                options: chartOptions,
                data: chartData
            };
            
            var barChart = new Chart(ctx, config);
        }

        function getBarPendapatan(arr_data, arr_status, lengthdata) 
        {
            var ctx = $("#myBarPendapatan");

            function getRandomColorEachData(count) 
            {
                var data = [];
                var arr_color = [
                    ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                    ],
                ];

                var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
                
                for (var i = 0; i < count; i++) 
                {
                    // data.push(getRandomColor());
                    data.push(colors[i]);
                }
                
                return data;
            }

            var chartOptions = {
                tooltips: 
                {
                    callbacks: 
                    {
                        label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
                        title: () => null,
                    }
                },
                //indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: 
                {
                    title: 
                    {
                        display: true,
                        text: 'PENDAPATAN PENDUDUK',
                        padding: 
                        {
                            top: 10,
                            bottom: 30
                        },
                        font:
                        {
                            family: "Helvetica",
                            size: "18",
                        }
                    },
                    legend: 
                    {
                        display: false,
                    },
                }
            };

            if (lengthdata == 0) 
            {
                var chartData = '';
            } 
            else 
            {
                var chartData = {
                    labels: arr_status,
                    datasets: [
                    {
                        label: 'Pendapatan Penduduk',
                        data: arr_data,
                        backgroundColor: getRandomColorEachData(lengthdata),
                        hoverBackgroundColor: getRandomColorEachData(lengthdata),
                        borderColor: "transparent",
                    }]
                };
            }

            var config = {
                type: "bar",
                // Chart Options
                options: chartOptions,
                data: chartData
            };
            
            var barChart = new Chart(ctx, config);
        }
    // end function jenis chart ---------------------------------------
    
    // start function carian ---------------------------------------
        function dun(id) 
        {
            var role = "{{data_get($roleuser,'role_id')}}";
        
            $('#kampung').val(0);
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dataentry/dun/')}}" + "/" + id,
                datatype: 'json',
            
                beforeSend: function() 
                {
                    block("tab-content");
                    document.getElementById("pilihdun").innerHTML = "Sila Pilih";
                    $('#selectdun').html('');
                    $('#loading').show();
                    $('#result2').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                },
                success: function(data) 
                {
                    unblock("tab-content");
                    $('#loading').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#selectdun').html(data);
                }
            });

            var parlimen = id;
            var dun = $('#dun').val();
            
            if (dun == '') 
            {
                valdun = 0;
            } 
            else 
            {
                valdun = dun;
            }

            var daerah = $('#daerah').val();
            var mukim = $('#mukim').val();
            
            if (daerah == '') 
            {
                valdaerah = 0;
            } 
            else 
            {
                valdaerah = daerah;
            }
            
            if (mukim == '') 
            {
                valmukim = 0;
            } 
            else 
            {
                valmukim = mukim;
            }
            
            var cat_petempatan = $('#cat_petempatan').val();
            
            if (cat_petempatan == '') 
            {
                valcat_petempatan = 0;
            } 
            else 
            {
                valcat_petempatan = cat_petempatan;
            }
            
            var kampung = $('#kampung').val();
            
            if (kampung == '') 
            {
                valkampung = 0;
            } 
            else 
            {
                valkampung = kampung;
            }
            
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dataentry/kampung/')}}" + "/" + parlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
                datatype: 'json',

                beforeSend: function() 
                {
                    document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
                    $('#selectkampung').html('');
                    $('#kampung').val(0);
                    $('#result3').hide();
                    $('#result4').hide();
                    //$('#loading').show();
                },
                success: function(data) 
                {
                    // $('#loading').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#selectkampung').html(data);
                }
            });
            
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dashboard/parlimenname/')}}" + "/" + id,
                datatype: 'json',

                beforeSend: function() 
                {
                },
                success: function(data) 
                {
                    $('#showparlimen').html(data);
                }
            });
        };

        function mukim(id) 
        {
            alert('function mukim -> '+id);
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dataentry/mukim/')}}" + "/" + id,
                datatype: 'json',
                
                beforeSend: function() 
                {
                    //$('div.text').html('Sila Pilih');
                    block("tab-content");
                    document.getElementById("pilihmukim").innerHTML = "Sila Pilih";
                    $('#selectmukim').html('');
                    $('#loading').show();
                    $('#result2').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#parlimen').val(0);
                    $('#dun').val(0);
                    $('#mukim').val(0);
                    $('#kampung').val(0);
                },
                success: function(data) 
                {
                    unblock("tab-content");
                    $('#loading').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#selectmukim').html(data);
                }
            });

            var mukim = $('#mukim').val();
            
            if (mukim == '') 
            {
                valmukim = 0;
            } 
            else 
            {
                valmukim = mukim;
            }
            
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dataentry/parlimenKampung/')}}" + "/" + id + "/" + valmukim,
                datatype: 'json',
            
                beforeSend: function() 
                {
                    //$('div.text').html('Sila Pilih');
                    block("tab-content");
                    document.getElementById("pilihparlimen").innerHTML = "Sila Pilih";
                    document.getElementById("pilihdun").innerHTML = "Sila Pilih";
                    $('#selectparlimen').html('');
                    $('#selectdun').html('');
                    $('#loading').show();
                    $('#result2').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    //kena reset balik parlimen
                    $('#parlimen').val(0);
                    $('#dun').val(0);
                    $('#mukim').val(0);
                    $('#kampung').val(0);
                },
                success: function(data) 
                {
                    unblock("tab-content");
                    $('#loading').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#selectparlimen').html(data);
                }
            });

            var parlimen = $('#parlimen').val();
            
            if (parlimen == '') 
            {
                valparlimen = 0;
            } 
            else 
            {
                valparlimen = parlimen;
            }
            
            var dun = $('#dun').val();
            
            if (dun == '') 
            {
                valdun = 0;
            } 
            else 
            {
                valdun = dun;
            }
            
            var daerah = id;
            
            if (daerah == '') 
            {
                valdaerah = 0;
            } 
            else 
            {
                valdaerah = daerah;
            }
            
            var cat_petempatan = $('#cat_petempatan').val();
            
            if (cat_petempatan == '') 
            {
                valcat_petempatan = 0;
            } 
            else 
            {
                valcat_petempatan = cat_petempatan;
            }
            
            var kampung = $('#kampung').val();
            
            if (kampung == '') 
            {
                valkampung = 0;
            } 
            else 
            {
                valkampung = kampung;
            }
            
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
                datatype: 'json',
            
                beforeSend: function() 
                {
                    document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
                    $('#selectkampung').html('');
                    $('#parlimen').val(0);
                    $('#dun').val(0);
                    $('#mukim').val(0);
                    $('#kampung').val(0);
                    $('#result3').hide();
                    $('#result4').hide();
                    // $('#loading').show();
                },
                success: function(data) 
                {
                    // $('#loading').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#selectkampung').html(data);
                }
            });
        };

        function kampungdun(id) 
        {
            $('#kampung').val(0);
            var daerah = $('#daerah').val();
            var mukim = $('#mukim').val();
        
            if (daerah == '') 
            {
                valdaerah = 0;
            } 
            else 
            {
                valdaerah = daerah;
            }
            
            if (mukim == '') 
            {
                valmukim = 0;
            } 
            else 
            {
                valmukim = mukim;
            }
            
            var parlimen = $('#parlimen').val();
            
            if (parlimen == '') 
            {
                valparlimen = 0;
            } 
            else 
            {
                valparlimen = parlimen;
            }
            
            var dun = id;
            
            if (dun == '') 
            {
                valdun = 0;
            } 
            else 
            {
                valdun = dun;
            }
            
            var cat_petempatan = $('#cat_petempatan').val();
            
            if (cat_petempatan == '') 
            {
                valcat_petempatan = 0;
            } 
            else 
            {
                valcat_petempatan = cat_petempatan;
            }
            
            var kampung = $('#kampung').val();
            
            if (kampung == '') 
            {
                valkampung = 0;
            } 
            else 
            {
                valkampung = kampung;
            }
            
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
                datatype: 'json',
            
                beforeSend: function() 
                {
                    block("tab-content");
                    document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
                    $('#selectkampung').html('');
                    $('#loading').show();
                    $('#result2').hide();
                    $('#kampung').val(0);
                    $('#result3').hide();
                    $('#result4').hide();
                },
                success: function(data) 
                {
                    unblock("tab-content");
                    $('#loading').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#selectkampung').html(data);
                }
            });
            
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dashboard/dunname/')}}" + "/" + id,
                datatype: 'json',

                beforeSend: function() 
                {
                },
                success: function(data) 
                {
                    $('#showdun').html(data);
                }
            });
        };

        function kampungmukim(id) 
        {
            $('#kampung').val(0);
            $('#parlimen').val(0);
            $('#dun').val(0);
        
            var parlimen = $('#parlimen').val();
            var daerah = $('#daerah').val();
            var mukim = id;
        
            if (daerah == '') 
            {
                valdaerah = 0;
            } 
            else 
            {
                valdaerah = daerah;
            }
            
            if (mukim == '') 
            {
                valmukim = 0;
            } 
            else 
            {
                valmukim = mukim;
            }
            
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dataentry/parlimenKampung/')}}" + "/" + valdaerah + "/" + valmukim,
                datatype: 'json',
            
                beforeSend: function() 
                {
                    //$('div.text').html('Sila Pilih');
                    block("tab-content");
                    document.getElementById("pilihparlimen").innerHTML = "Sila Pilih";
                    document.getElementById("pilihdun").innerHTML = "Sila Pilih";
                    $('#selectparlimen').html('');
                    $('#selectdun').html('');
                    $('#loading').show();
                    $('#result2').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    //kena reset balik parlimen
                    $('#parlimen').val(0);
                    $('#dun').val(0);
                    $('#mukim').val(0);
                    $('#kampung').val(0);
                },
                success: function(data) 
                {
                    unblock("tab-content");
                    $('#loading').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#selectparlimen').html(data);
                }
            });

            if (parlimen == '') 
            {
                valparlimen = 0;
            } 
            else 
            {
                valparlimen = parlimen;
            }
            
            var dun = $('#dun').val();
            
            if (dun == '') 
            {
                valdun = 0;
            } 
            else 
            {
                valdun = dun;
            }
            
            var kampung = $('#kampung').val();
            
            if (kampung == '') 
            {
                valkampung = 0;
            } 
            else 
            {
                valkampung = kampung;
            }
            
            var cat_petempatan = $('#cat_petempatan').val();
            
            if (cat_petempatan == '') 
            {
                valcat_petempatan = 0;
            } 
            else 
            {
                valcat_petempatan = cat_petempatan;
            }
            
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
                datatype: 'json',

                beforeSend: function() 
                {
                    block("tab-content");
                    document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
                    $('#selectkampung').html('');
                    $('#loading').show();
                    $('#result2').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#kampung').val(0);
                },
                success: function(data) 
                {
                    unblock("tab-content");
                    $('#loading').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#selectkampung').html(data);
                }
            });
            
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dashboard/mukimname/')}}" + "/" + id,
                datatype: 'json',

                beforeSend: function() 
                {
                },
                success: function(data) 
                {
                    $('#showmukim').html(data);
                }
            });
        };

        function kampungpenempatan(id) 
        {
            var parlimen = $('#parlimen').val();
            $('#kampung').val(0);
        
            if (parlimen == '') 
            {
                valparlimen = 0;
            } 
            else 
            {
                valparlimen = parlimen;
            }
            
            var dun = $('#dun').val();
            
            if (dun == '') 
            {
                valdun = 0;
            } 
            else 
            {
                valdun = dun;
            }
            
            var daerah = $('#daerah').val();
            var mukim = $('#mukim').val();
            
            if (daerah == '') 
            {
                valdaerah = 0;
            } 
            else 
            {
                valdaerah = daerah;
            }
            
            if (mukim == '') 
            {
                valmukim = 0;
            } 
            else 
            {
                valmukim = mukim;
            }
            
            var cat_petempatan = id;
            
            if (cat_petempatan == '') 
            {
                valcat_petempatan = 0;
            } 
            else 
            {
                valcat_petempatan = cat_petempatan;
            }
            
            var kampung = $('#kampung').val();
            
            if (kampung == '') 
            {
                valkampung = 0;
            } 
            else 
            {
                valkampung = kampung;
            }
            
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
                datatype: 'json',
                beforeSend: function() 
                {
                    block("tab-content");
                    document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
                    $('#selectkampung').html('');
                    $('#loading').show();
                    $('#result2').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#kampung').val(0);
                },
                success: function(data) 
                {
                    unblock("tab-content");
                    $('#loading').hide();
                    $('#result3').hide();
                    $('#result4').hide();
                    $('#selectkampung').html(data);
                }
            });

            
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('dashboard/katpetname/')}}" + "/" + id,
                datatype: 'json',

                beforeSend: function() 
                {
                },
                success: function(data) 
                {
                    $('#showcat').html(data);
                }
            });
        };
    // end function carian ---------------------------------------

    function setDataTemp(key, data)
    {
        dataTemp[key] = data;
    }

    function getDataTemp(key)
    {
        return dataTemp[key];
    }

</script> 

<script type="text/javascript">

    const dataTemp = [];

    function fxmodal1(run_id)
    {
        var data = getDataTemp(1);

        var valdaerah        = data.daerah;
        var valmukim         = data.mukim;
        var valparlimen      = data.parlimen;
        var valdun           = data.dun;
        var valcat_petempatan= data.catpetempatan;
        var valkampung       = data.kampung;

        $.ajax(
        {
            type: "get",
            url : "{{ URL::to('/dashboard/table/1')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung + "&cattype=" + run_id,
            beforeSend: function ()
            {
                $('#divchart1').hide();
                $('#loadertable1').show();

                $('#tablechart1').DataTable().destroy();
            },
            success: function (result)
            {
                $('#loadertable1').hide();
                $('#divchart1').show();

                var datat1 = result.data;
                var htmlt1 = "";

                for(var it1 = 0, jt1 = 1; it1 < datat1.length; it1++, jt1++)
                {
                    htmlt1 += "<tr>";
                    htmlt1 +=   "<td colspan='1' style='text-align: center;'>"+jt1;
                    htmlt1 +=   "</td>";

                    if (datat1[it1].Nama) 
                    {
                        if(datat1[it1].Nama)
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'>"+datat1[it1].Nama;
                        }
                        else
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt1 +=   "</td>";

                        if(datat1[it1].NoKP)
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'>"+datat1[it1].NoKP;
                        }
                        else
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt1 +=   "</td>";

                        if(datat1[it1].TelNo)
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'>"+datat1[it1].TelNo;
                        }
                        else
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt1 +=   "</td>";

                        if(datat1[it1].status_milikan)
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'>"+datat1[it1].status_milikan;
                        }
                        else
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt1 +=   "</td>";

                        if(datat1[it1].NamaMukim)
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'>"+datat1[it1].NamaMukim;
                        }
                        else
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt1 +=   "</td>";

                        if(datat1[it1].NamaKampung)
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'>"+datat1[it1].NamaKampung;
                        }
                        else
                        {
                            htmlt1 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt1 +=   "</td>";
                    }
                    else
                    {
                        htmlt1 +=   "<td colspan='1' style=''>";
                        htmlt1 +=   "</td>";
                        htmlt1 +=   "<td colspan='1' style=''>";
                        htmlt1 +=   "</td>";
                        htmlt1 +=   "<td colspan='1' style=''>";
                        htmlt1 +=   "</td>";
                        htmlt1 +=   "<td colspan='1' style=''>";
                        htmlt1 +=   "</td>";
                        htmlt1 +=   "<td colspan='1' style=''>";
                        htmlt1 +=   "</td>";
                        htmlt1 +=   "<td colspan='1' style=''>";
                        htmlt1 +=   "</td>";
                    }

                    htmlt1 += "</tr>";

                }
                $("#tbodychart1").html(htmlt1);

                $('#tablechart1').DataTable( 
                {
                    "lengthChange" : false,
                    "language" : 
                    {
                        "search"    : "Carian:",
                        "info"      : "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                        "infoEmpty" : "Paparan 0 hingga 0 daripada 0 jumlah data",
                        "paginate"  : 
                        {
                            "first"     : "Pertama",
                            "last"      : "Terakhir",
                            "next"      : "Seterusnya",
                            "previous"  : "Sebelumnya"
                        },
                    }
                });
            }
        });



        $('#chart1').modal({
            blurring: true
        }).modal(
            'setting',
            'transition', 
            'horizontal flip'
        ).modal('show');
    }

    function fxmodal2(run_id)
    {
        var data = getDataTemp(2);

        var valdaerah        = data.daerah;
        var valmukim         = data.mukim;
        var valparlimen      = data.parlimen;
        var valdun           = data.dun;
        var valcat_petempatan= data.catpetempatan;
        var valkampung       = data.kampung;

        $.ajax(
        {
            type: "get",
            url : "{{ URL::to('/dashboard/table/2')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung + "&cattype=" + run_id,
            beforeSend: function ()
            {
                $('#divchart2').hide();
                $('#loadertable2').show();

                $('#tablechart2').DataTable().destroy();
            },
            success: function (result)
            {
                $('#loadertable2').hide();
                $('#divchart2').show();

                var datat2 = result.data;
                var htmlt2 = "";

                for(var it2 = 0, jt2 = 1; it2 < datat2.length; it2++, jt2++)
                {
                    htmlt2 += "<tr>";
                    htmlt2 +=   "<td colspan='1' style='text-align: center;'>"+jt2;
                    htmlt2 +=   "</td>";

                    if (datat2[it2].Nama) 
                    {
                        if(datat2[it2].Nama)
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'>"+datat2[it2].Nama;
                        }
                        else
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt2 +=   "</td>";

                        if(datat2[it2].NoKP)
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'>"+datat2[it2].NoKP;
                        }
                        else
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt2 +=   "</td>";

                        if(datat2[it2].TelNo)
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'>"+datat2[it2].TelNo;
                        }
                        else
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt2 +=   "</td>";

                        if(datat2[it2].jenis_rumah)
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'>"+datat2[it2].jenis_rumah;
                        }
                        else
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt2 +=   "</td>";

                        if(datat2[it2].NamaMukim)
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'>"+datat2[it2].NamaMukim;
                        }
                        else
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt2 +=   "</td>";

                        if(datat2[it2].NamaKampung)
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'>"+datat2[it2].NamaKampung;
                        }
                        else
                        {
                            htmlt2 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt2 +=   "</td>";
                    }
                    else
                    {
                        htmlt2 +=   "<td colspan='1' style=''>";
                        htmlt2 +=   "</td>";
                        htmlt2 +=   "<td colspan='1' style=''>";
                        htmlt2 +=   "</td>";
                        htmlt2 +=   "<td colspan='1' style=''>";
                        htmlt2 +=   "</td>";
                        htmlt2 +=   "<td colspan='1' style=''>";
                        htmlt2 +=   "</td>";
                        htmlt2 +=   "<td colspan='1' style=''>";
                        htmlt2 +=   "</td>";
                        htmlt2 +=   "<td colspan='1' style=''>";
                        htmlt2 +=   "</td>";
                    }

                    htmlt2 += "</tr>";

                }
                $("#tbodychart2").html(htmlt2);

                $('#tablechart2').DataTable( 
                {
                    "lengthChange" : false,
                    "language" : 
                    {
                        "search"    : "Carian:",
                        "info"      : "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                        "infoEmpty" : "Paparan 0 hingga 0 daripada 0 jumlah data",
                        "paginate"  : 
                        {
                            "first"     : "Pertama",
                            "last"      : "Terakhir",
                            "next"      : "Seterusnya",
                            "previous"  : "Sebelumnya"
                        },
                    }
                });
            }
        });

        $('#chart2').modal({
            blurring: true
        }).modal(
            'setting',
            'transition', 
            'horizontal flip'
        ).modal('show');
    }

    function fxmodal3(run_id)
    {
        var data = getDataTemp(3);

        var valdaerah        = data.daerah;
        var valmukim         = data.mukim;
        var valparlimen      = data.parlimen;
        var valdun           = data.dun;
        var valcat_petempatan= data.catpetempatan;
        var valkampung       = data.kampung;

        $.ajax(
        {
            type: "get",
            url : "{{ URL::to('/dashboard/table/3')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung + "&cattype=" + run_id,
            beforeSend: function ()
            {
                $('#divchart3').hide();
                $('#loadertable3').show();

                $('#tablechart3').DataTable().destroy();
            },
            success: function (result)
            {
                $('#loadertable3').hide();
                $('#divchart3').show();

                var datat3 = result.data;
                var htmlt3 = "";

                for(var it3 = 0, jt3 = 1; it3 < datat3.length; it3++, jt3++)
                {
                    htmlt3 += "<tr>";
                    htmlt3 +=   "<td colspan='1' style='text-align: center;'>"+jt3;
                    htmlt3 +=   "</td>";

                    if (datat3[it3].kat_kemudahan_id) 
                    {
                        if(datat3[it3].NamaKemudahan)
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'>"+datat3[it3].NamaKemudahan;
                        }
                        else
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt3 +=   "</td>";

                        if(datat3[it3].kat_kemudahan)
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'>"+datat3[it3].kat_kemudahan;
                        }
                        else
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt3 +=   "</td>";

                        if(datat3[it3].jenis_kemudahan)
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'>"+datat3[it3].jenis_kemudahan;
                        }
                        else
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt3 +=   "</td>";

                        if(datat3[it3].Bilangan)
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'>"+datat3[it3].Bilangan;
                        }
                        else
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt3 +=   "</td>";

                        if(datat3[it3].unit)
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'>"+datat3[it3].unit;
                        }
                        else
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        if(datat3[it3].NamaMukim)
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'>"+datat3[it3].NamaMukim;
                        }
                        else
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt3 +=   "</td>";

                        if(datat3[it3].NamaKampung)
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'>"+datat3[it3].NamaKampung;
                        }
                        else
                        {
                            htmlt3 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt3 +=   "</td>";
                    }
                    else
                    {
                        htmlt3 +=   "<td colspan='1' style=''>";
                        htmlt3 +=   "</td>";
                        htmlt3 +=   "<td colspan='1' style=''>";
                        htmlt3 +=   "</td>";
                        htmlt3 +=   "<td colspan='1' style=''>";
                        htmlt3 +=   "</td>";
                        htmlt3 +=   "<td colspan='1' style=''>";
                        htmlt3 +=   "</td>";
                        htmlt3 +=   "<td colspan='1' style=''>";
                        htmlt3 +=   "</td>";
                        htmlt3 +=   "<td colspan='1' style=''>";
                        htmlt3 +=   "</td>";
                        htmlt3 +=   "<td colspan='1' style=''>";
                        htmlt3 +=   "</td>";
                    }

                    htmlt3 += "</tr>";

                }
                $("#tbodychart3").html(htmlt3);

                $('#tablechart3').DataTable( 
                {
                    "lengthChange" : false,
                    "language" : 
                    {
                        "search"    : "Carian:",
                        "info"      : "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                        "infoEmpty" : "Paparan 0 hingga 0 daripada 0 jumlah data",
                        "paginate"  : 
                        {
                            "first"     : "Pertama",
                            "last"      : "Terakhir",
                            "next"      : "Seterusnya",
                            "previous"  : "Sebelumnya"
                        },
                    }
                });
            }
        });

        $('#chart3').modal({
            blurring: true
        }).modal(
            'setting',
            'transition', 
            'horizontal flip'
        ).modal('show');
    }

    function fxmodal4(run_id)
    {
        var data = getDataTemp(4);

        var valdaerah        = data.daerah;
        var valmukim         = data.mukim;
        var valparlimen      = data.parlimen;
        var valdun           = data.dun;
        var valcat_petempatan= data.catpetempatan;
        var valkampung       = data.kampung;

        $.ajax(
        {
            type: "get",
            url : "{{ URL::to('/dashboard/table/4')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung + "&cattype=" + run_id,
            beforeSend: function ()
            {
                $('#divchart4').hide();
                $('#loadertable4').show();

                $('#tablechart4').DataTable().destroy();
            },
            success: function (result)
            {
                $('#loadertable4').hide();
                $('#divchart4').show();

                var datat4 = result.data;
                var htmlt4 = "";

                for(var it4 = 0, jt4 = 1; it4 < datat4.length; it4++, jt4++)
                {
                    htmlt4 += "<tr>";
                    htmlt4 +=   "<td colspan='1' style='text-align: center;'>"+jt4;
                    htmlt4 +=   "</td>";

                    if (datat4[it4].Nama) 
                    {
                        if(datat4[it4].Nama)
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'>"+datat4[it4].Nama;
                        }
                        else
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt4 +=   "</td>";

                        if(datat4[it4].NoKP)
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'>"+datat4[it4].NoKP;
                        }
                        else
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt4 +=   "</td>";

                        if(datat4[it4].TelNo)
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'>"+datat4[it4].TelNo;
                        }
                        else
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt4 +=   "</td>";

                        if(datat4[it4].KAir == '1')
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'><i class='check icon'></i>";
                        }
                        else
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'><i class='times icon'></i>";
                        }

                        if(datat4[it4].KElektrik == '1')
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'><i class='check icon'></i>";
                        }
                        else
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'><i class='times icon'></i>";
                        }

                        if(datat4[it4].KInternet == '1')
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'><i class='check icon'></i>";
                        }
                        else
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'><i class='times icon'></i>";
                        }

                        if(datat4[it4].KAstro == '1')
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'><i class='check icon'></i>";
                        }
                        else
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'><i class='times icon'></i>";
                        }

                        if(datat4[it4].KTelefon == '1')
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'><i class='check icon'></i>";
                        }
                        else
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'><i class='times icon'></i>";
                        }

                        htmlt4 +=   "</td>";

                        if(datat4[it4].NamaMukim)
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'>"+datat4[it4].NamaMukim;
                        }
                        else
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt4 +=   "</td>";

                        if(datat4[it4].NamaKampung)
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'>"+datat4[it4].NamaKampung;
                        }
                        else
                        {
                            htmlt4 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt4 +=   "</td>";
                    }
                    else
                    {
                        htmlt4 +=   "<td colspan='1' style=''>";
                        htmlt4 +=   "</td>";
                        htmlt4 +=   "<td colspan='1' style=''>";
                        htmlt4 +=   "</td>";
                        htmlt4 +=   "<td colspan='1' style=''>";
                        htmlt4 +=   "</td>";
                        htmlt4 +=   "<td colspan='1' style=''>";
                        htmlt4 +=   "</td>";
                        htmlt4 +=   "<td colspan='1' style=''>";
                        htmlt4 +=   "</td>";
                        htmlt4 +=   "<td colspan='1' style=''>";
                        htmlt4 +=   "</td>";
                        htmlt4 +=   "<td colspan='1' style=''>";
                        htmlt4 +=   "</td>";
                        htmlt4 +=   "<td colspan='1' style=''>";
                        htmlt4 +=   "</td>";
                        htmlt4 +=   "<td colspan='1' style=''>";
                        htmlt4 +=   "</td>";
                        htmlt4 +=   "<td colspan='1' style=''>";
                        htmlt4 +=   "</td>";
                    }

                    htmlt4 += "</tr>";

                }
                $("#tbodychart4").html(htmlt4);

                $('#tablechart4').DataTable( 
                {
                    "lengthChange" : false,
                    "language" : 
                    {
                        "search"    : "Carian:",
                        "info"      : "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                        "infoEmpty" : "Paparan 0 hingga 0 daripada 0 jumlah data",
                        "paginate"  : 
                        {
                            "first"     : "Pertama",
                            "last"      : "Terakhir",
                            "next"      : "Seterusnya",
                            "previous"  : "Sebelumnya"
                        },
                    }
                });
            }
        });

        $('#chart4').modal({
            blurring: true
        }).modal(
            'setting',
            'transition', 
            'horizontal flip'
        ).modal('show');
    }

    function fxmodal5(run_id)
    {
        var data = getDataTemp(5);

        var valdaerah        = data.daerah;
        var valmukim         = data.mukim;
        var valparlimen      = data.parlimen;
        var valdun           = data.dun;
        var valcat_petempatan= data.catpetempatan;
        var valkampung       = data.kampung;

        // console.log("valdaerah ->"+valdaerah);
        // console.log("valmukim ->"+valmukim);

        $.ajax(
        {
            type: "get",
            url : "{{ URL::to('/dashboard/table/5')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung + "&cattype=" + run_id,
            beforeSend: function ()
            {
                $('#divchart5').hide();
                $('#loadertable5').show();

                $('#tablechart5').DataTable().destroy();
            },
            success: function (result)
            {
                $('#loadertable5').hide();
                $('#divchart5').show();

                var datat5 = result.data;
                var htmlt5 = "";

                for(var it5 = 0, jt5 = 1; it5 < datat5.length; it5++, jt5++)
                {
                    htmlt5 += "<tr>";
                    htmlt5 +=   "<td colspan='1' style='text-align: center;'>"+jt5;
                    htmlt5 +=   "</td>";

                    if (datat5[it5].Nama) 
                    {
                        if(datat5[it5].Nama)
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'>"+datat5[it5].Nama;
                        }
                        else
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt5 +=   "</td>";

                        if(datat5[it5].NoKP)
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'>"+datat5[it5].NoKP;
                        }
                        else
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt5 +=   "</td>";

                        if(datat5[it5].TelNo)
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'>"+datat5[it5].TelNo;
                        }
                        else
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt5 +=   "</td>";

                        if(datat5[it5].Pekerjaan)
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'>"+datat5[it5].Pekerjaan;
                        }
                        else
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt5 +=   "</td>";

                        if(datat5[it5].NamaMukim)
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'>"+datat5[it5].NamaMukim;
                        }
                        else
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt5 +=   "</td>";

                        if(datat5[it5].NamaKampung)
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'>"+datat5[it5].NamaKampung;
                        }
                        else
                        {
                            htmlt5 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt5 +=   "</td>";
                    }
                    else
                    {
                        htmlt5 +=   "<td colspan='1' style=''>";
                        htmlt5 +=   "</td>";
                        htmlt5 +=   "<td colspan='1' style=''>";
                        htmlt5 +=   "</td>";
                        htmlt5 +=   "<td colspan='1' style=''>";
                        htmlt5 +=   "</td>";
                        htmlt5 +=   "<td colspan='1' style=''>";
                        htmlt5 +=   "</td>";
                        htmlt5 +=   "<td colspan='1' style=''>";
                        htmlt5 +=   "</td>";
                        htmlt5 +=   "<td colspan='1' style=''>";
                        htmlt5 +=   "</td>";
                    }

                    htmlt5 += "</tr>";

                }
                $("#tbodychart5").html(htmlt5);

                $('#tablechart5').DataTable( 
                {
                    "lengthChange" : false,
                    "language" : 
                    {
                        "search"    : "Carian:",
                        "info"      : "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                        "infoEmpty" : "Paparan 0 hingga 0 daripada 0 jumlah data",
                        "paginate"  : 
                        {
                            "first"     : "Pertama",
                            "last"      : "Terakhir",
                            "next"      : "Seterusnya",
                            "previous"  : "Sebelumnya"
                        },
                    }
                });
            }
        });



        $('#chart5').modal({
            blurring: true
        }).modal(
            'setting',
            'transition', 
            'horizontal flip'
        ).modal('show');
    }

    function fxmodal6(run_id)
    {
        var data = getDataTemp(6);

        var valdaerah        = data.daerah;
        var valmukim         = data.mukim;
        var valparlimen      = data.parlimen;
        var valdun           = data.dun;
        var valcat_petempatan= data.catpetempatan;
        var valkampung       = data.kampung;

        // console.log("valdaerah ->"+valdaerah);
        // console.log("valmukim ->"+valmukim);

        $.ajax(
        {
            type: "get",
            url : "{{ URL::to('/dashboard/table/6')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung + "&cattype=" + run_id,
            beforeSend: function ()
            {
                $('#divchart6').hide();
                $('#loadertable6').show();

                $('#tablechart6').DataTable().destroy();
            },
            success: function (result)
            {
                $('#loadertable6').hide();
                $('#divchart6').show();

                var datat6 = result.data;
                var htmlt6 = "";

                for(var it6 = 0, jt6 = 1; it6 < datat6.length; it6++, jt6++)
                {
                    htmlt6 += "<tr>";
                    htmlt6 +=   "<td colspan='1' style='text-align: center;'>"+jt6;
                    htmlt6 +=   "</td>";

                    if (datat6[it6].Nama) 
                    {
                        if(datat6[it6].Nama)
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'>"+datat6[it6].Nama;
                        }
                        else
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt6 +=   "</td>";

                        if(datat6[it6].NoKP)
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'>"+datat6[it6].NoKP;
                        }
                        else
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt6 +=   "</td>";

                        if(datat6[it6].TelNo)
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'>"+datat6[it6].TelNo;
                        }
                        else
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt6 +=   "</td>";

                        if(datat6[it6].taraf_kahwin)
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'>"+datat6[it6].taraf_kahwin;
                        }
                        else
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt6 +=   "</td>";

                        if(datat6[it6].NamaMukim)
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'>"+datat6[it6].NamaMukim;
                        }
                        else
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt6 +=   "</td>";

                        if(datat6[it6].NamaKampung)
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'>"+datat6[it6].NamaKampung;
                        }
                        else
                        {
                            htmlt6 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt6 +=   "</td>";
                    }
                    else
                    {
                        htmlt6 +=   "<td colspan='1' style=''>";
                        htmlt6 +=   "</td>";
                        htmlt6 +=   "<td colspan='1' style=''>";
                        htmlt6 +=   "</td>";
                        htmlt6 +=   "<td colspan='1' style=''>";
                        htmlt6 +=   "</td>";
                        htmlt6 +=   "<td colspan='1' style=''>";
                        htmlt6 +=   "</td>";
                        htmlt6 +=   "<td colspan='1' style=''>";
                        htmlt6 +=   "</td>";
                        htmlt6 +=   "<td colspan='1' style=''>";
                        htmlt6 +=   "</td>";
                    }

                    htmlt6 += "</tr>";

                }
                $("#tbodychart6").html(htmlt6);

                $('#tablechart6').DataTable( 
                {
                    "lengthChange" : false,
                    "language" : 
                    {
                        "search"    : "Carian:",
                        "info"      : "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                        "infoEmpty" : "Paparan 0 hingga 0 daripada 0 jumlah data",
                        "paginate"  : 
                        {
                            "first"     : "Pertama",
                            "last"      : "Terakhir",
                            "next"      : "Seterusnya",
                            "previous"  : "Sebelumnya"
                        },
                    }
                });
            }
        });

        $('#chart6').modal({
            blurring: true
        }).modal(
            'setting',
            'transition', 
            'horizontal flip'
        ).modal('show');
    }

    function fxmodal7(run_id)
    {
        var data = getDataTemp(7);

        var valdaerah        = data.daerah;
        var valmukim         = data.mukim;
        var valparlimen      = data.parlimen;
        var valdun           = data.dun;
        var valcat_petempatan= data.catpetempatan;
        var valkampung       = data.kampung;

        // console.log("valdaerah ->"+valdaerah);
        // console.log("valmukim ->"+valmukim);

        $.ajax(
        {
            type: "get",
            url : "{{ URL::to('/dashboard/table/7')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung + "&cattype=" + run_id,
            beforeSend: function ()
            {
                $('#divchart7').hide();
                $('#loadertable7').show();

                $('#tablechart7').DataTable().destroy();
            },
            success: function (result)
            {
                $('#loadertable7').hide();
                $('#divchart7').show();

                var datat7 = result.data;
                var htmlt7 = "";

                for(var it7 = 0, jt7 = 1; it7 < datat7.length; it7++, jt7++)
                {
                    htmlt7 += "<tr>";
                    htmlt7 +=   "<td colspan='1' style='text-align: center;'>"+jt7;
                    htmlt7 +=   "</td>";

                    if (datat7[it7].Nama) 
                    {
                        if(datat7[it7].Nama)
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'>"+datat7[it7].Nama;
                        }
                        else
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt7 +=   "</td>";

                        if(datat7[it7].NoKP)
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'>"+datat7[it7].NoKP;
                        }
                        else
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt7 +=   "</td>";

                        if(datat7[it7].TelNo)
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'>"+datat7[it7].TelNo;
                        }
                        else
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt7 +=   "</td>";

                        if(datat7[it7].Umur)
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'>"+datat7[it7].Umur;
                        }
                        else
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt7 +=   "</td>";

                        if(datat7[it7].NamaMukim)
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'>"+datat7[it7].NamaMukim;
                        }
                        else
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt7 +=   "</td>";

                        if(datat7[it7].idKampung)
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'>"+datat7[it7].kampung.NamaKampung;
                        }
                        else
                        {
                            htmlt7 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt7 +=   "</td>";
                    }
                    else
                    {
                        htmlt7 +=   "<td colspan='1' style=''>";
                        htmlt7 +=   "</td>";
                        htmlt7 +=   "<td colspan='1' style=''>";
                        htmlt7 +=   "</td>";
                        htmlt7 +=   "<td colspan='1' style=''>";
                        htmlt7 +=   "</td>";
                        htmlt7 +=   "<td colspan='1' style=''>";
                        htmlt7 +=   "</td>";
                        htmlt7 +=   "<td colspan='1' style=''>";
                        htmlt7 +=   "</td>";
                        htmlt7 +=   "<td colspan='1' style=''>";
                        htmlt7 +=   "</td>";
                    }

                    htmlt7 += "</tr>";

                }
                $("#tbodychart7").html(htmlt7);

                $('#tablechart7').DataTable( 
                {
                    "lengthChange" : false,
                    "language" : 
                    {
                        "search"    : "Carian:",
                        "info"      : "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                        "infoEmpty" : "Paparan 0 hingga 0 daripada 0 jumlah data",
                        "paginate"  : 
                        {
                            "first"     : "Pertama",
                            "last"      : "Terakhir",
                            "next"      : "Seterusnya",
                            "previous"  : "Sebelumnya"
                        },
                    }
                });
            }
        });

        $('#chart7').modal({
            blurring: true
        }).modal(
            'setting',
            'transition', 
            'horizontal flip'
        ).modal('show');
    }

    function fxmodal8(run_id)
    {
        var data = getDataTemp(8);
        // console.log(data);

        var valdaerah = data.daerah;
        var valmukim = data.mukim;

        // console.log("valdaerah ->"+valdaerah);
        // console.log("valmukim ->"+valmukim);

        $.ajax(
        {
            type: "get",
            url : "{{ URL::to('/dashboard/table/8')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung + "&cattype=" + run_id,
            beforeSend: function ()
            {
                $('#divchart8').hide();
                $('#loadertable8').show();

                $('#tablechart8').DataTable().destroy();
            },
            success: function (result)
            {
                $('#loadertable8').hide();
                $('#divchart8').show();

                var datat8 = result.data;
                var htmlt8 = "";

                for(var it8 = 0, jt8 = 1; it8 < datat8.length; it8++, jt8++)
                {
                    htmlt8 += "<tr>";
                    htmlt8 +=   "<td colspan='1' style='text-align: center;'>"+jt8;
                    htmlt8 +=   "</td>";

                    if (datat8[it8].Nama) 
                    {
                        if(datat8[it8].Nama)
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'>"+datat8[it8].Nama;
                        }
                        else
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt8 +=   "</td>";

                        if(datat8[it8].NoKp)
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'>"+datat8[it8].NoKp;
                        }
                        else
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt8 +=   "</td>";

                        if(datat8[it8].TelNo)
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'>"+datat8[it8].TelNo;
                        }
                        else
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt8 +=   "</td>";

                        if(datat8[it8].Pendapatan)
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'>"+datat8[it8].Pendapatan;
                        }
                        else
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt8 +=   "</td>";

                        if(datat8[it8].fk_mukim)
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'>"+datat8[it8].mukim.NamaMukim;
                        }
                        else
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt8 +=   "</td>";

                        if(datat8[it8].NamaKampung)
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'>"+datat8[it8].NamaKampung;
                        }
                        else
                        {
                            htmlt8 +=   "<td colspan='1' style='text-align: center;'> - ";
                        }

                        htmlt8 +=   "</td>";
                    }

                    else
                    {
                        htmlt8 +=   "<td colspan='1' style=''>";
                        htmlt8 +=   "</td>";
                        htmlt8 +=   "<td colspan='1' style=''>";
                        htmlt8 +=   "</td>";
                        htmlt8 +=   "<td colspan='1' style=''>";
                        htmlt8 +=   "</td>";
                        htmlt8 +=   "<td colspan='1' style=''>";
                        htmlt8 +=   "</td>";
                        htmlt8 +=   "<td colspan='1' style=''>";
                        htmlt8 +=   "</td>";
                        htmlt8 +=   "<td colspan='1' style=''>";
                        htmlt8 +=   "</td>";
                    }

                    htmlt8 += "</tr>";

                }
                $("#tbodychart8").html(htmlt8);

                $('#tablechart8').DataTable( 
                {
                    "lengthChange" : false,
                    "language" : 
                    {
                        "search"    : "Carian:",
                        "info"      : "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                        "infoEmpty" : "Paparan 0 hingga 0 daripada 0 jumlah data",
                        "paginate"  : 
                        {
                            "first"     : "Pertama",
                            "last"      : "Terakhir",
                            "next"      : "Seterusnya",
                            "previous"  : "Sebelumnya"
                        },
                    }
                });
            }
        });



        $('#chart8').modal({
            blurring: true
        }).modal(
            'setting',
            'transition', 
            'horizontal flip'
        ).modal('show');
    }

</script>
@endpush