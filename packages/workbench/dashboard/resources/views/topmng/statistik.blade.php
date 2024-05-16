<style type="text/css">
    @media print
    {
        @page
        {
            size: auto;
            /*width: 75%;*/
            margin: 0;
            margin-bottom: -100px;
        }
        body
        {
            transform: scale(0.9);
            -webkit-transform:scale(0.9);
            /*min-width: 75% !important;*/
        }
    }

</style>


<div class="ui one column grid" id="divtitle" style="margin-top: -150px; display: none">
    <div class="column middle aligned">
        <center>
            <h1 class="">
                LAPORAN STATISTIK PETEMPATAN
            </h1>
        </center>
    </div>
</div>

<div class="tab-content raised">

    <div class="ui container-fluid" id="result3" style="display: none; padding: 0rem 2rem">
        <div class="ui buttons right floated" id="divaccordion2">
            <a href="javascript:;"  class="ui red button" onclick="document.title='LAPORAN STATISTIK PETEMPATAN {{ date('d-M-Y') }}'; window.print();" title="PDF"><b>&nbsp;Cetak&nbsp;</b></a>
        </div>
        <div id="divaccordion2">
            <br><br><br>
        </div>
        <div id="resultcountpetempatan">

        </div>
    </div>

    <!-- start print statistik ----------------------------------------------------------------------------------------------------- -->
    <div class="ui container-fluid p-1" style="">

        <!-- chart n detail kemudahan asas print -->
            <div class="ui one stackable cards raised" id="divasas">
                <div class="card">
                    <div class="ui active loader loader4_2" id=""></div>
                    <div class="content resultchart4_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader18_2" id=""></div>
                    <div class="content resultchart18_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail kemudahan asas -->

        <div id="divtitle" style="page-break-before:always; display: none; padding-top: 1rem !important">
        </div>

        <!-- chart n detail pemilikan rumah mengikut daerah print -->
            <div class="ui one stackable cards raised" id="divownerrumah">
                <div class="card ">
                    <div class="ui active loader loader25_2" id=""></div>
                    <div class="content resultchart25_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader21_2" id=""></div>
                    <div class="content resultchart21_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail pemilikan rumah mengikut daerah -->

        <div id="divtitle" style="page-break-before:always; display: none; padding-top: 1rem !important">
        </div>

        <!-- chart n detail pendapatan penduduk mengikut daerah print -->
            <div class="ui one stackable cards raised" id="divincome">
                <div class="card">
                    <div class="ui active loader loader8_2" id=""></div>
                    <div class="content resultchart8_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader10_2" id=""></div>
                    <div class="content resultchart10_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail pendapatan penduduk mengikut daerah -->

        <div id="divtitle" style="page-break-before:always; display: none; padding-top: 1rem !important">
        </div>

        <!-- chart n detail umur mengikut daerah print -->
            <div class="ui one stackable cards raised" id="divumur">
                <div class="card">
                    <div class="ui active loader loader26_2" id=""></div>
                    <div class="content resultchart26_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader27_2" id=""></div>
                    <div class="content resultchart27_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail umur mengikut daerah -->

        <div id="divtitle" style="page-break-before:always; display: none; padding-top: 1rem !important">
        </div>

        <!-- chart n detail jenis rumah print -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;" id="divrumahtype">
                <div class="card ">
                    <div class="ui active loader loader2_2" id=""></div>
                    <div class="content resultchart2_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader22" id=""></div>
                    <div class="content resultchart22_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail jenis rumah -->

        <!-- chart n detail jenis rumah mengikut daerah print -->
            <div class="ui one stackable cards raised" id="divrumahtypedaerah">
                <div class="card ">
                    <div class="ui active loader loader23_2" id=""></div>
                    <div class="content resultchart23_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader24_2" id=""></div>
                    <div class="content resultchart24_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail jenis rumah mengikut daerah -->

        <div id="divtitle" style="page-break-before:always; display: none; padding-top: 1rem !important">
        </div>

        <!-- chart n detail kemudahan awam n infra print -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;" id="divinfra">
                <div class="card">
                    <div class="ui active loader loader3_2" id=""></div>
                    <div class="content resultchart3_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader17_2" id=""></div>
                    <div class="content resultchart17_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail kemudahan awam n infra -->

        <!-- chart n detail kemudahan awam n infra mengikut daerah print -->
            <div class="ui one stackable cards raised" id="divinfradaerah">
                <div class="card">
                    <div class="ui active loader loader19_2" id=""></div>
                    <div class="content resultchart19_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader20_2" id=""></div>
                    <div class="content resultchart20_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail kemudahan awam n infra mengikut daerah -->

        <div id="divtitle" style="page-break-before:always; display: none; padding-top: 1rem !important">
        </div>

        <!-- chart n detail status kerja print -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;" id="divkerja">
                <div class="card">
                    <div class="ui active loader loader5_2" id=""></div>
                    <div class="content resultchart5_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader11_2" id=""></div>
                    <div class="content resultchart11_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail status kerja -->

        <!-- chart n detail status kerja mengikut daerah print -->
            <div class="ui one stackable cards raised" id="divkerjadaerah">
                <div class="card">
                    <div class="ui active loader loader9_2" id=""></div>
                    <div class="content resultchart9_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader12_2" id=""></div>
                    <div class="content resultchart12_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail status kerja mengikut daerah -->

        <div id="divtitle" style="page-break-before:always; display: none; padding-top: 1rem !important">
        </div>

        <!-- chart n detail taraf perkahwinan print -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;" id="divkahwin">
                <div class="card">
                    <div class="ui active loader loader6_2" id=""></div>
                    <div class="content resultchart6_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader13_2" id=""></div>
                    <div class="content resultchart13_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail taraf perkahwinan -->

        <!-- chart n detail taraf perkahwinan mengikut daerah print -->
            <div class="ui one stackable cards raised" id="divkahwindaerah">
                <div class="card">
                    <div class="ui active loader loader15_2" id=""></div>
                    <div class="content resultchart15_2" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader16_2" id=""></div>
                    <div class="content resultchart16_2" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail taraf perkahwinan mengikut daerah -->

        <!-- <div id="divtitle" style="page-break-before:always; display: none; padding-top: 1rem !important">  -->
        <!-- </div> -->

    </div>
    <!-- end print statistik ----------------------------------------------------------------------------------------------------- -->

    <!-- start show statistik ----------------------------------------------------------------------------------------------------- -->
    <div class="ui container-fluid p-2" id="divaccordion2">

        <!-- chart n detail jenis rumah -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;">
                <div class="card ">
                    <div class="ui active loader loader2_1" id=""></div>
                    <div class="content resultchart2_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader22" id=""></div>
                    <div class="content resultchart22_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail jenis rumah -->

        <!-- chart n detail jenis rumah mengikut daerah -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;">
                <div class="card ">
                    <div class="ui active loader loader23_1" id=""></div>
                    <div class="content resultchart23_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader24_1" id=""></div>
                    <div class="content resultchart24_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail jenis rumah mengikut daerah -->

        <!-- chart n detail kemudahan awam n infra -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;">
                <div class="card">
                    <div class="ui active loader loader3_1" id=""></div>
                    <div class="content resultchart3_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader17_1" id=""></div>
                    <div class="content resultchart17_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail kemudahan awam n infra -->

        <!-- chart n detail kemudahan awam n infra mengikut daerah -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;">
                <div class="card">
                    <div class="ui active loader loader19_1" id=""></div>
                    <div class="content resultchart19_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader20_1" id=""></div>
                    <div class="content resultchart20_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail kemudahan awam n infra mengikut daerah -->

        <!-- chart n detail status kerja -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;">
                <div class="card">
                    <div class="ui active loader loader5_1" id=""></div>
                    <div class="content resultchart5_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader11_1" id=""></div>
                    <div class="content resultchart11_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail status kerja -->

        <!-- chart n detail status kerja mengikut daerah -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;">
                <div class="card">
                    <div class="ui active loader loader9_1" id=""></div>
                    <div class="content resultchart9_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader12_1" id=""></div>
                    <div class="content resultchart12_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail status kerja mengikut daerah -->

        <!-- chart n detail taraf perkahwinan -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;">
                <div class="card">
                    <div class="ui active loader loader6_1" id=""></div>
                    <div class="content resultchart6_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader13_1" id=""></div>
                    <div class="content resultchart13_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail taraf perkahwinan -->

        <!-- chart n detail taraf perkahwinan mengikut daerah -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;">
                <div class="card">
                    <div class="ui active loader loader15_1" id=""></div>
                    <div class="content resultchart15_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader16_1" id=""></div>
                    <div class="content resultchart16_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail taraf perkahwinan mengikut daerah -->

        <!-- chart n detail kemudahan asas -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;" id="divaccordion2">
                <div class="card">
                    <div class="ui active loader loader4_1" id=""></div>
                    <div class="content resultchart4_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader18_1" id=""></div>
                    <div class="content resultchart18_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail kemudahan asas -->

        <!-- chart n detail pemilikan rumah -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;">
                <div class="card ">
                    <div class="ui active loader loader25_1" id=""></div>
                    <div class="content resultchart25_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader21_1" id=""></div>
                    <div class="content resultchart21_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail pemilikan rumah -->

        <!-- chart n detail pendapatan penduduk mengikut daerah -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;">
                <div class="card">
                    <div class="ui active loader loader8_1" id=""></div>
                    <div class="content resultchart8_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader10_1" id=""></div>
                    <div class="content resultchart10_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail pendapatan penduduk mengikut daerah -->

        <!-- chart n detail umur mengikut daerah -->
            <div class="ui two stackable cards raised" style="margin-top: 0px;">
                <div class="card">
                    <div class="ui active loader loader26_1" id=""></div>
                    <div class="content resultchart26_1" id="" style="display: none">

                    </div>
                </div>
                <div class="card">
                    <div class="ui active loader loader27_1" id=""></div>
                    <div class="content resultchart27_1" id="" style="display: none">

                    </div>
                </div>
            </div>
        <!-- end chart n detail umur mengikut daerah -->

    </div>
    <!-- end show statistik ----------------------------------------------------------------------------------------------------- -->
</div>

<!-- start modal view-->
<div class="ui modal" id="detailStatusKerja">
    <i class="close icon"></i>
    <div class="content">
        <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">
            <thead>
                <tr>
                    <th colspan="2">
                        <center>
                            <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">Status Pekerjaan</span>
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

<script type="text/javascript">

    $(document).ready(function()
    {
        $("#printpie").click(function()
        {
            print_pie();
        });

        $('.ui.accordion').accordion();

        valparlimen = 0;
        valdun = 0;
        valdaerah = 0;
        valmukim = 0;
        valcat_petempatan = 0;
        valkampung = 0;

        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
            datatype: 'json',

            beforeSend: function()
            {
                // block("tab-content");
                // //document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
                $('#selectkampung').html('');
                $('#loading').show();
            },

            success: function(data)
            {
                // unblock("tab-content");
                $('#loading').hide();
                $('#selectkampung').html(data);
            }
        });

        search();
    });

    function showdetailkerja()
    {
        $('#detailStatusKerja').modal(
        {
            blurring: true
        }).modal('show');
    }

    function search()
    {
        valparlimen = 0;
        valdun = 0;
        valdaerah = 0;
        valmukim = 0;
        valcat_petempatan = 0;
        valkampung = 0;

        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/countpetempatan/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

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

        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/countdata/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

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

        //-------------------------------------------getchart1------------------------//
        // $.ajax({
        //   type: "GET",
        //   url: "{{ URL::to('/dashboard/chart1/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

        //   beforeSend: function() {

        //     $('#loader1').show();
        //     $('#result4').show();

        //     document.getElementById('resultchart1').style.display = "none";

        //   },

        //   success: function(data) {

        //     var arr_data = "";
        //     var arr_status = "";
        //     var lengthdata = "";

        //     if (data.arr_status.length == 0) {
        //       $('#result4').hide();
        //     } else {
        //       $('#result4').show();
        //     }


        //     $('#loader1').hide();

        //     $('#resultchart1').show();

        //     arr_data = data.arr_data;
        //     arr_status = data.arr_status;
        //     lengthdata = data.arr_status.length;

        //     $("#resultchart1").html('<div><canvas id="myBarChart" height="300" width="580"></canvas></div>');
        //     getBarStatusMilik(arr_data, arr_status, lengthdata);
        //   } //end sucsess chart1


        // }); //end ajax chart1

        //-------------------------------------------end getchart1-------------------------//

        //-------------------------------------------getchart1------------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart25/')}}",

            beforeSend: function()
            {
                $('.loader25').show();
                $('#result4').show();

                // document.getElementById('resultchart25').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_jenis = "";
                var lengthdata = "";

                if (data.arr_jenis.length == 0)
                {
                    $('#result4').hide();
                }
                else
                {
                    $('#result4').show();
                }

                $(".resultchart25_1").html('<div><canvas id="myBarChart_1" height="550" width="580"></canvas></div>');
                $(".resultchart25_2").html('<div><canvas id="myBarChart_2" height="550" width="580"></canvas></div>');
                $('.loader25_1').hide();
                $('.loader25_2').hide();
                $('.resultchart25_1').show();
                $('.resultchart25_2').show();

                arr_data = data.arr_data;
                arr_label = data.arr_label;
                arr_jenis = data.arr_jenis;
                length=data.arr_jenis.length;
                arr_all_data= data.arr_all_data;

                getBarStatusMilik(arr_data, arr_label, arr_jenis,arr_all_data);

                $('#divownerrumah').hide();
            } //end sucsess chart1
        }); //end ajax chart1
        //-------------------------------------------end getchart1-------------------------//

        //-------------------------------------------start getchart2-----------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart2/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

            beforeSend: function()
            {
                $('.loader2').show();

                // document.getElementById('resultchart2').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var htc5="";

                $(".resultchart2_1").html('<div><canvas class="myPieChart2_1" height="500" width="580"></canvas></div>');
                $(".resultchart2_2").html('<div><canvas class="myPieChart2_2" height="500" width="580"></canvas></div>');
                $('.loader2_1').hide();
                $('.loader2_2').hide();
                $('.loader22').hide();
                //document.getElementById('result3').style.display = "show";
                $('.resultchart2_1').show();
                $('.resultchart2_2').show();
                $('.resultchart22_1').show();
                $('.resultchart22_2').show();
                //document.getElementById('resultchart1').innerHTML = data;

                //

                arr_jenis = data.arr_jenis;
                arr_data = data.arr_data;
                lengthdata = data.arr_jenis.length;
                jumjenisrumah = data.jumjenisrumah;

                getPieJenisRumah(arr_jenis, arr_data, lengthdata, jumjenisrumah);

                var paparan = arr_jenis.toString().split(",");
                var sum = 0;

                htc5 += '<table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">';
                htc5 +='<thead>'
                htc5 +='<tr>'
                htc5 +='<th colspan="3">'
                htc5 +='<center>'
                htc5 +='<span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">'
                htc5 +='JENIS RUMAH</span>'
                htc5 +='</center>'
                htc5 +='</th>'
                htc5 +='</tr>'
                htc5 +='<tr>'
                htc5 +='<th style="text-align: center;">'
                htc5 +='Kategori</th>'
                htc5 +='<th style="text-align: center;">'
                htc5 +='%</th>'
                htc5 +='<th style="text-align: center;">'
                htc5 +='Jumlah</th>'
                htc5 +='</tr>'
                htc5 +='</thead>'
                htc5 +='<tbody id="table-chart5">'

                if(lengthdata != 0)
                {
                    for(var i=0; i<paparan.length; i++)
                    {
                        var precent=((arr_data[i])/jumjenisrumah)*100;

                        htc5 += '<tr>';
                        htc5 +=  "<td style='text-align: center; font-size: 13px'>"+paparan[i]+"</td>";
                        htc5 +=  "<td style='text-align: center; font-size: 13px'>"+precent.toFixed(2)+"</td>";
                        htc5 +=  "<td style='text-align: center; font-size: 13px'>"+arr_data[i]+"</td>";
                        htc5 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>100</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
                    htc5 += '</tr>';

                    htc5 +='</tbody>'
                    htc5 += '</table>';
                }
                else
                {
                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'> - </td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'> - </td>";
                    htc5 += '</tr>';

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc5 += '</tr>';
                }

                $(".resultchart22_1").html(htc5);
                $(".resultchart22_2").html(htc5);

                $('#divrumahtype').hide();

            } //end sucsess chart1
        }); //end ajax chart1
        //--------------------------------------------end getchart2-------------------//

        //-------------------------------------------start getchart3----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart3/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

            beforeSend: function()
            {
                $('.loader3').show();
                // document.getElementById('resultchart3').style.display = "none";
            },
            success: function(data)
            {

                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var htc5 = "";

                $(".resultchart3_1").html('<canvas id="myPieKemudahan_1" height="500" width="580"></canvas></div>');
                $(".resultchart3_2").html('<canvas id="myPieKemudahan_2" height="500" width="580"></canvas></div>');
                $('.loader3_1').hide();
                $('.loader3_2').hide();
                $('.loader17_1').hide();
                $('.loader17_2').hide();
                $('.resultchart3_1').show();
                $('.resultchart3_2').show();
                $('.resultchart17_1').show();
                $('.resultchart17_2').show();
                //

                arr_jenis = data.arr_jenis;
                arr_data = data.arr_data;
                lengthdata = data.arr_jenis.length;
                jumkemudahan = data.jumkemudahan;

                getPieKemudahan(arr_jenis, arr_data, lengthdata, jumkemudahan);

                var paparan = arr_jenis.toString().split(",");
                var sum = 0;


                htc5 += '<table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">';
                htc5 +='<thead>'
                htc5 +='<tr>'
                htc5 +='<th colspan="3">'
                htc5 +='<center>'
                htc5 +='<span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">'
                htc5 +='KEMUDAHAN AWAM & INFRASTRUKTUR</span>'
                htc5 +='</center>'
                htc5 +='</th>'
                htc5 +='</tr>'
                htc5 +='<tr>'
                htc5 +='<th style="text-align: center;">'
                htc5 +='Kategori</th>'
                htc5 +='<th style="text-align: center;">'
                htc5 +='%</th>'
                htc5 +='<th style="text-align: center;">'
                htc5 +='Jumlah</th>'
                htc5 +='</tr>'
                htc5 +='</thead>'
                htc5 +='<tbody id="table-chart5">'

                if(lengthdata != 0)
                {
                    for(var i=0; i<paparan.length; i++)
                    {
                        var precent=((arr_data[i])/jumkemudahan)*100;

                        htc5 += '<tr>';
                        htc5 +=  "<td style='text-align: center; font-size: 13px'>"+paparan[i]+"</td>";
                        htc5 +=  "<td style='text-align: center; font-size: 13px'>"+precent.toFixed(2)+"</td>";
                        htc5 +=  "<td style='text-align: center; font-size: 13px'>"+arr_data[i]+"</td>";
                        htc5 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>100</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
                    htc5 += '</tr>';

                    htc5 +='</tbody>'
                    htc5 += '</table>';
                }
                else
                {
                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'> - </td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'> - </td>";
                    htc5 += '</tr>';

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc5 += '</tr>';
                }

                $(".resultchart17_1").html(htc5);
                $(".resultchart17_2").html(htc5);

                $('#divinfra').hide();

            } //end sucsess chart1
        }); //end ajax chart1
        //--------------------------------------------end getchart3----------------//

        //-------------------------------------------start getchart4---------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart4/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

            beforeSend: function()
            {
                $('.loader4').show();
                // document.getElementsByClassName('resultchart4').style.display = "none";
            },
            success: function(data)
            {

                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var arr_ya = "";
                var arr_tidak = "";

                $(".resultchart4_1").html('<canvas class="myBarChart2_1" height="350" width="580"></canvas></div>');
                $(".resultchart4_2").html('<canvas class="myBarChart2_2" height="350" width="580"></canvas></div>');
                $('.loader4_1').hide();
                $('.loader4_2').hide();
                $('.resultchart4_1').show();
                $('.resultchart4_2').show();

                arr_jenis = data.arr_status;
                arr_data = data.arr_data;
                lengthdata = data.arr_status.length;
                arr_label = data.arr_label;
                arr_ya = data.arr_ya;
                arr_tidak = data.arr_tidak;

                getBarKemudahan2(arr_jenis, arr_data, lengthdata, arr_label, arr_ya, arr_tidak);

                $('#divasas').hide();
            } //end sucsess chart1
        }); //end ajax chart1
        //--------------------------------------------end getchart4-----------------//

        //-------------------------------------------start getchart5---------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart5/')}}",

            beforeSend: function()
            {
                $('.loader5').show();
                $('.loader11').show();
                // document.getElementById('resultchart5').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var htc5 = "";

                $(".resultchart5_1").html('<canvas id="myPieKerja_1" height="500" width="580"></canvas></div>');
                $(".resultchart5_2").html('<canvas id="myPieKerja_2" height="500" width="580"></canvas></div>');
                $('.loader5_1').hide();
                $('.loader5_2').hide();
                $('.loader11_1').hide();
                $('.loader11_2').hide();
                $('.resultchart5_1').show();
                $('.resultchart5_2').show();
                $('.resultchart11_1').show();
                $('.resultchart11_2').show();

                arr_jenis = data.arr_jenis;
                arr_data = data.arr_data;
                lengthdata = data.arr_jenis.length;
                jumjeniskerja = data.jumjeniskerja;

                getPieKerja(arr_jenis, arr_data, lengthdata, jumjeniskerja);

                var paparan = arr_jenis.toString().split(",");
                var sum = 0;

                htc5 += '<table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">';
                htc5 +='<thead>'
                htc5 +='<tr>'
                htc5 +='<th colspan="2">'
                htc5 +='<center>'
                htc5 +='<span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">'
                htc5 +='Status Pekerjaan</span>'
                htc5 +='</center>'
                htc5 +='</th>'
                htc5 +='</tr>'
                htc5 +='<tr>'
                htc5 +='<th style="text-align: center;">'
                htc5 +='Kategori</th>'
                htc5 +='<th style="text-align: center;">'
                htc5 +='Jumlah</th>'
                htc5 +='</tr>'
                htc5 +='</thead>'
                htc5 +='<tbody id="table-chart5">'

                if(lengthdata != 0)
                {
                    for(var i=0; i<paparan.length; i++)
                    {
                        htc5 += '<tr>';
                        htc5 +=  "<td style='text-align: center; font-size: 13px'>"+paparan[i]+"</td>";
                        htc5 +=  "<td style='text-align: center; font-size: 13px'>"+arr_data[i]+"</td>";
                        htc5 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
                    htc5 += '</tr>';

                    htc5 +='</tbody>'
                    htc5 += '</table>';
                }
                else
                {
                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'> - </td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'> - </td>";
                    htc5 += '</tr>';

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc5 += '</tr>';
                }

                $(".resultchart11_1").html(htc5);
                $(".resultchart11_2").html(htc5);

                $('#divkerja').hide();
            } //end sucsess chart5
        }); //end ajax chart5
        //--------------------------------------------end getchart5-----------------//

        //-------------------------------------------start getchart9---------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart5all/')}}",

            beforeSend: function()
            {
                $('.loader9').show();
                // document.getElementById('resultchart9').style.display = "none";
            },
            success: function(data)
            {

                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart9_1").html('<canvas id="myBarKerja_1" height="500" width="580"></canvas></div>');
                $(".resultchart9_2").html('<canvas id="myBarKerja_2" height="500" width="580"></canvas></div>');
                $('.loader9_1').hide();
                $('.loader9_2').hide();
                $('.resultchart9_1').show();
                $('.resultchart9_2').show();

                arr_data = data.arr_data;
                arr_label = data.arr_label;
                arr_jenis = data.arr_jenis;
                jumjeniskerja=data.jumjeniskerja;
                length=data.arr_jenis.length;
                arr_all_data= data.arr_all_data;

                getBarKerja(arr_data, arr_label, arr_jenis,jumjeniskerja,arr_all_data);

                $('#divkerjadaerah').hide();
            } //end sucsess chart9
        }); //end ajax chart9
        //--------------------------------------------end getchart9-----------------//

        //-------------------------------------------start getchart6----------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart6/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

            beforeSend: function()
            {
                $('.loader6').show();
                $('.loader13').show();
                // document.getElementById('resultchart6').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";
                var htc5 = "";

                $(".resultchart6_1").html('<canvas id="myPieKahwin_1" height="500" width="580"></canvas>');
                $(".resultchart6_2").html('<canvas id="myPieKahwin_2" height="500" width="580"></canvas>');
                $('.loader6_1').hide();
                $('.loader6_2').hide();
                $('.loader13_1').hide();
                $('.loader13_2').hide();
                $('.resultchart6_1').show();
                $('.resultchart6_2').show();
                $('.resultchart13_1').show();
                $('.resultchart13_2').show();

                arr_jenis = data.arr_jenis;
                arr_data = data.arr_data;
                lengthdata = data.arr_jenis.length;
                jumjeniskawin = data.jumjeniskawin;

                getPieKahwin(arr_jenis, arr_data, lengthdata, jumjeniskawin);

                var paparan = arr_jenis.toString().split(",");
                var sum = 0;

                htc5 += '<table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">';
                htc5 +='<thead>'
                htc5 +='<tr>'
                htc5 +='<th colspan="3">'
                htc5 +='<center>'
                htc5 +='<span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">'
                htc5 +='TARAF PERKAHWINAN</span>'
                htc5 +='</center>'
                htc5 +='</th>'
                htc5 +='</tr>'
                htc5 +='<tr>'
                htc5 +='<th style="text-align: center;">'
                htc5 +='Kategori</th>'
                htc5 +='<th style="text-align: center;">'
                htc5 +='%</th>'
                htc5 +='<th style="text-align: center;">'
                htc5 +='Jumlah</th>'
                htc5 +='</tr>'
                htc5 +='</thead>'
                htc5 +='<tbody id="table-chart5">'

                if(lengthdata != 0)
                {

                    for(var i=0; i<paparan.length; i++)
                    {
                        var precent=((arr_data[i])/jumjeniskawin)*100;

                        htc5 += '<tr>';
                        htc5 +=  "<td style='text-align: center; font-size: 13px'>"+paparan[i]+"</td>";
                        htc5 +=  "<td style='text-align: center; font-size: 13px'>"+precent.toFixed(2)+"</td>";
                        htc5 +=  "<td style='text-align: center; font-size: 13px'>"+arr_data[i]+"</td>";
                        htc5 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>100</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
                    htc5 += '</tr>';

                    htc5 +='</tbody>'
                    htc5 += '</table>';
                }
                else
                {
                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'> - </td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'> - </td>";
                    htc5 += '</tr>';

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                    htc5 += '</tr>';
                }

                $(".resultchart13_1").html(htc5);
                $(".resultchart13_2").html(htc5);

                $('#divkahwin').hide();
            } //end sucsess chart5
        }); //end ajax chart5
        //--------------------------------------------end getchart6-----------------//

    //-------------------------------------------getchart7------------------------//
    // $.ajax({
    //   type: "GET",
    //   url: "{{ URL::to('/dashboard/chart7/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

    //   beforeSend: function() {

    //     $('#loader7').show();
    //     $('#loader14').show();

    //     document.getElementById('resultchart7').style.display = "none";

    //   },

    //   success: function(data) {

    //     var arr_data = "";
    //     var arr_status = "";
    //     var lengthdata = "";
    //     var htc5="";

    //     $('#loader7').hide();
    //     $('#loader14').hide();

    //     //document.getElementById('result3').style.display = "show";
    //     $('#resultchart7').show();
    //     $('#resultchart14').show();
    //     //document.getElementById('resultchart1').innerHTML = data;

    //     console.log(data.arr_status.length);

    //     arr_data = data.arr_data;
    //     arr_status = data.arr_status;
    //     lengthdata = data.arr_status.length;

    //     $("#resultchart7").html('<canvas id="myBarUmur" height="350" width="580"></canvas></div>');
    //     getBarUmur(arr_data, arr_status, lengthdata);

    //        var paparan = arr_status.toString().split(",");
    //             var sum = 0;


    //                htc5 += '<table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">';
    //                 htc5 +='<thead>'
    //                 htc5 +='<tr>'
    //                 htc5 +='<th colspan="2">'
    //                 htc5 +='<center>'
    //                 htc5 +='<span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">'
    //                 htc5 +='UMUR PENDUDUK</span>'
    //                 htc5 +='</center>'
    //                 htc5 +='</th>'
    //                 htc5 +='</tr>'
    //                 htc5 +='<tr>'
    //                 htc5 +='<th style="text-align: center;">'
    //                 htc5 +='Kategori</th>'
    //                 htc5 +='<th style="text-align: center;">'
    //                 htc5 +='Jumlah</th>'
    //                 htc5 +='</tr>'
    //                 htc5 +='</thead>'
    //                 htc5 +='<tbody id="table-chart5">'
    //                  if(lengthdata != 0)
    //                  {

    //                 for(var i=0; i<paparan.length; i++)
    //                 {
    //                     htc5 += '<tr>';
    //                     htc5 +=  "<td style='text-align: center; font-size: 13px'>"+paparan[i]+"</td>";
    //                     htc5 +=  "<td style='text-align: center; font-size: 13px'>"+arr_data[i]+"</td>";
    //                     htc5 += '</tr>';

    //                     sum += Number(arr_data[i]);
    //                 }

    //                 htc5 += '<tr>';
    //                 htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
    //                 htc5 +=  "<td style='text-align: center; font-size: 13px'><b>"+sum+"</b></td>";
    //                 htc5 += '</tr>';

    //                 htc5 +='</tbody>'
    //                 htc5 += '</table>';



    //             }
    //             else
    //             {
    //                 htc5 += '<tr>';
    //                 htc5 +=  "<td style='text-align: center; font-size: 13px'> - </td>";
    //                 htc5 +=  "<td style='text-align: center; font-size: 13px'> - </td>";
    //                 htc5 += '</tr>';

    //                 htc5 += '<tr>';
    //                 htc5 +=  "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
    //                 htc5 +=  "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
    //                 htc5 += '</tr>';
    //             }

    //             $("#resultchart14").html(htc5);

    //   } //end sucsess chart1


    // }); //end ajax chart1

    //-------------------------------------------end getchart7-----------------//

        //-------------------------------------------getchart26-----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart26/')}}",

            beforeSend: function()
            {
                $('#loader26').show();
                // document.getElementById('resultchart26').style.display = "none";
            },
            success: function(data)
            {

                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart26_1").html('<canvas id="myBarUmurDaerah_1" height="350" width="580"></canvas></div>');
                $(".resultchart26_2").html('<canvas id="myBarUmurDaerah_2" height="350" width="580"></canvas></div>');
                $('.loader26_1').hide();
                $('.loader26_2').hide();
                $('.resultchart26_1').show();
                $('.resultchart26_2').show();

                arr_data = data.arr_data;
                arr_label = data.arr_label;
                arr_jenis = data.arr_jenis;
                jumgaji=data.jumgaji;
                length=data.arr_jenis.length;
                arr_all_data= data.arr_all_data;

                myBarUmurDaerah(arr_data, arr_label, arr_jenis,arr_all_data);

                $('#divumur').hide();
            } //end sucsess chart26
        }); //end ajax chart26
        //-------------------------------------------end getchar26----------------//

        //-------------------------------------------getchart27-----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart27/')}}",

            beforeSend: function()
            {
                $('.loader27').show();
                // document.getElementById('resultchart27').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart27_1").html(data);
                $(".resultchart27_2").html(data);
                $('.loader27_1').hide();
                $('.loader27_2').hide();
                $('.resultchart27_1').show();
                $('.resultchart27_2').show();
            } //end sucsess chart1
        }); //end ajax chart1

    //-------------------------------------------end getchart27----------------//
    //-------------------------------------------getchart8-----------------------//
    // $.ajax({
    //   type: "GET",
    //   url: "{{ URL::to('/dashboard/chart8/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

    //   beforeSend: function() {

    //     $('#loader8').show();

    //     document.getElementById('resultchart8').style.display = "none";

    //   },

    //   success: function(data) {

    //     var arr_data = "";
    //     var arr_status = "";
    //     var lengthdata = "";

    //     $('#loader8').hide();

    //     //document.getElementById('result3').style.display = "show";
    //     $('#resultchart8').show();
    //     //document.getElementById('resultchart1').innerHTML = data;

    //     console.log(data.arr_status.length);

    //     arr_data = data.arr_data;
    //     arr_status = data.arr_status;
    //     lengthdata = data.arr_status.length;

    //     $("#resultchart8").html('<canvas id="myBarPendapatan" height="350" width="580"></canvas></div>');
    //     getBarPendapatan(arr_data, arr_status, lengthdata);
    //   } //end sucsess chart1


    // }); //end ajax chart1

    //-------------------------------------------end getchar8----------------//

        //-------------------------------------------getchart8-----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart8all/')}}",

            beforeSend: function()
            {
                $('.loader8').show();
                // document.getElementById('resultchart8').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart8_1").html('<canvas id="myBarPendapatan_1" height="350" width="580"></canvas></div>');
                $(".resultchart8_2").html('<canvas id="myBarPendapatan_2" height="350" width="580"></canvas></div>');
                $('.loader8_1').hide();
                $('.loader8_2').hide();
                $('.resultchart8_1').show();
                $('.resultchart8_2').show();

                arr_data = data.arr_data;
                arr_label = data.arr_label;
                arr_jenis = data.arr_jenis;
                jumgaji=data.jumgaji;
                length=data.arr_jenis.length;
                arr_all_data= data.arr_all_data;

                getBarPendapatan(arr_data, arr_label, arr_jenis,jumgaji,arr_all_data);

                $('#divincome').hide();
            } //end sucsess chart1
        }); //end ajax chart1
        //-------------------------------------------end getchar8----------------//

        //-------------------------------------------getchart10-----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart10/')}}",

            beforeSend: function()
            {
                $('.loader10').show();
                // document.getElementById('resultchart10').style.display = "none";
            },
            success: function(data)
            {

                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart10_1").html(data);
                $(".resultchart10_2").html(data);
                $('.loader10_1').hide();
                $('.loader10_2').hide();
                $('.resultchart10_1').show();
                $('.resultchart10_2').show();
            } //end sucsess chart1
        }); //end ajax chart1

    //-------------------------------------------end getchart10----------------//

        //-------------------------------------------getchart12-----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart12/')}}",

            beforeSend: function()
            {
                $('.loader12').show();
                // document.getElementById('resultchart10').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart12_1").html(data);
                $(".resultchart12_2").html(data);
                $('.loader12_1').hide();
                $('.loader12_2').hide();
                $('.resultchart12_1').show();
                $('.resultchart12_2').show();
            } //end sucsess chart12
        }); //end ajax chart12
        //-------------------------------------------end getchart12----------------//

        //-------------------------------------------getchart15-----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart15/')}}",

            beforeSend: function()
            {
                $('.loader15').show();
                // document.getElementById('resultchart15').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart15_1").html('<canvas id="myBarTarafKahwin_1" height="350" width="580"></canvas></div>');
                $(".resultchart15_2").html('<canvas id="myBarTarafKahwin_2" height="350" width="580"></canvas></div>');
                $('.loader15_1').hide();
                $('.loader15_2').hide();
                $('.resultchart15_1').show();
                $('.resultchart15_2').show();

                arr_data = data.arr_data;
                arr_label = data.arr_label;
                arr_jenis = data.arr_jenis;
                arr_all_data= data.arr_all_data;

                getBarTarafKahwin(arr_data, arr_label, arr_jenis,arr_all_data);

                $('#divkahwindaerah').hide();
            } //end sucsess chart1
        }); //end ajax chart1
        //-------------------------------------------end getchart15----------------//


        //-------------------------------------------getchart16-----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart16/')}}",

            beforeSend: function()
            {
                $('.loader16').show();
                // document.getElementById('resultchart16').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart16_1").html(data);
                $(".resultchart16_2").html(data);
                $('.loader16_1').hide();
                $('.loader16_2').hide();
                $('.resultchart16_1').show();
                $('.resultchart16_2').show();

            } //end sucsess chart16
        }); //end ajax chart16
        //-------------------------------------------end getchart16----------------//

        //-------------------------------------------start getchart19---------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart19/')}}",

            beforeSend: function()
            {
                $('.loader19').show();

                // document.getElementById('resultchart19').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart19_1").html('<canvas id="myBarKemudahanAwam_1" height="350" width="580"></canvas></div>');
                $(".resultchart19_2").html('<canvas id="myBarKemudahanAwam_2" height="350" width="580"></canvas></div>');
                $('.loader19_1').hide();
                $('.loader19_2').hide();
                $('.resultchart19_1').show();
                $('.resultchart19_2').show();

                arr_data = data.arr_data;
                arr_label = data.arr_label;
                arr_jenis = data.arr_jenis;
                length=data.arr_jenis.length;
                arr_all_data= data.arr_all_data;

                getBarKemudahanAwam(arr_data, arr_label, arr_jenis,arr_all_data);

                $('#divinfradaerah').hide();
            } //end sucsess chart9
        }); //end ajax chart9
        //--------------------------------------------end getchart19-----------------//

        //-------------------------------------------getchart20-----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart20/')}}",

            beforeSend: function()
            {
                $('.loader20').show();
                // document.getElementById('resultchart20').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart20_1").html(data);
                $(".resultchart20_2").html(data);
                $('.loader20_1').hide();
                $('.loader20_2').hide();
                $('.resultchart20_1').show();
                $('.resultchart20_2').show();

            } //end sucsess chart12

        }); //end ajax chart12
        //-------------------------------------------end getchart20----------------//

        //-------------------------------------------start getchart23---------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart23/')}}",

            beforeSend: function()
            {
                $('.loader23').show();

                // document.getElementById('resultchart23').style.display = "none";
            },
            success: function(data)
            {
                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart23_2").html('<canvas id="myBarJenisRumah_2" height="350" width="580"></canvas></div>');
                $(".resultchart23_1").html('<canvas id="myBarJenisRumah_1" height="350" width="580"></canvas></div>');
                $('.loader23_1').hide();
                $('.loader23_2').hide();
                $('.resultchart23_1').show();
                $('.resultchart23_2').show();

                arr_data = data.arr_data;
                arr_label = data.arr_label;
                arr_jenis = data.arr_jenis;
                length=data.arr_jenis.length;
                arr_all_data= data.arr_all_data;

                getBarJenisRumah(arr_data, arr_label, arr_jenis,arr_all_data);

                $('#divrumahtypedaerah').hide();
            } //end sucsess chart23
        }); //end ajax chart23
        //--------------------------------------------end getchart23-----------------//

        //-------------------------------------------getchart24-----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart24/')}}",

            beforeSend: function()
            {
                $('.loader24').show();

                // document.getElementById('resultchart24').style.display = "none";
            },
            success: function(data)
            {

                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart24_1").html(data);
                $(".resultchart24_2").html(data);
                $('.loader24_1').hide();
                $('.loader24_2').hide();
                $('.resultchart24_1').show();
                $('.resultchart24_2').show();
            } //end sucsess chart24
        }); //end ajax chart24

    //-------------------------------------------end getchart24----------------//

        //-------------------------------------------getchart21-----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart21/')}}",

            beforeSend: function()
            {
                $('.loader21').show();
                // document.getElementById('resultchart21').style.display = "none";
            },
            success: function(data)
            {

                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart21_1").html(data);
                $(".resultchart21_2").html(data);
                $('.loader21_1').hide();
                $('.loader21_2').hide();
                $('.resultchart21_1').show();
                $('.resultchart21_2').show();
            } //end sucsess chart21
        }); //end ajax chart21
        //-------------------------------------------end getchart21----------------//

        //-------------------------------------------getchart18-----------------------//
        $.ajax(
        {
            type: "GET",
            url: "{{ URL::to('/dashboard/chart18/')}}",

            beforeSend: function()
            {
                $('.loader18').show();
                // document.getElementById('resultchart18_1').style.display = "none";
            },
            success: function(data)
            {

                var arr_data = "";
                var arr_status = "";
                var lengthdata = "";

                $(".resultchart18_1").html(data);
                $(".resultchart18_2").html(data);
                $('.loader18_1').hide();
                $('.loader18_2').hide();
                $('.resultchart18_1').show();
                $('.resultchart18_2').show();
            } //end sucsess chart18
        }); //end ajax chart18
        //-------------------------------------------end getchart18----------------//





  }//end search()



  // function getBarStatusMilik(arr_data, arr_status, lengthdata) {

  //   var ctx = $("#myBarChart");


  //   function getRandomColorEachDatamyBarChart(count) {
  //     var data = [];
  //  var arr_color = [

  //       ["#d69fbf", "#467680"
  //       ],
  //       // [
  //       //   "#EDE0D4", "#E6CCB2", "#DDB892", "#B08968", "#7F5539", "#9C6644", "#A57455", "#AD8164", "#B48C72", "#BB967F"
  //       // ],
  //       // [
  //       //   "#99735F", "#A87E69", "#B98B73", "#CB997E", "#DDBEA9", "#FFE8D6", "#A5A58D", "#6B705C", "#787D6B", "#264501"
  //       // ],
  //       //  [
  //       //   "#6A7384", "#757F91", "#818C9F", "#8E9AAF", "#CBC0D3", "#EFD3D7", "#FEEAFA", "#DEE2FF", "#E1E5FF", "#E4E7FF"
  //       // ],
  //       //  [
  //       //   "#A8B090", "#B9C29E", "#CCD5AE", "#E9EDC9", "#FEFAE0", "#FAEDCD", "#D4A373", "#D8AB80", "#DCB38C", "#DFBA96"
  //       // ],
  //       //  [
  //       //   "#582F0E", "#7f4f24", "#936639", "#A68A64", "#B6AD90", "#C2C5AA", "#A4AC86", "#656D4A", "#414833", "#333D29"
  //       // ],
  //       //  [
  //       //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#11F79A", "#17970E", "#F25E5E", "#264501"
  //       // ],
  //       // [
  //       //   "#9ACB34", "#FF0000", "#833D85", "#FE8A01", "#81D1B6", "#FECE02", "#4F2550", "#D40104", "#5C7A1F", "#FFC681"
  //       // ],
  //       // [
  //       //   "#FC3924", "#2EBC86", "#F2DC13", "#B81423", "#637589", "#6EC135", "#7030A0", "#1B7E00", "#256DBD", "#F3A58D"
  //       // ],
  //       // [
  //       //   "#A8234C", "#92D565", "#E3534C", "#6F3B55", "#FFA874", "#005828", "#F33F21", "#DF678C", "#4C91DC", "#F3A58D"
  //       // ],
  //       // [
  //       //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#F33F21", "#11F79A", "#1D9A00", "#F25E5E"
  //       // ],
  //       // [
  //       //   "#4B9ABB", "#9ACB34", "#EC5923", "#833D85", "#FDDA02", "#637589", "#4DA17F", "#001A9A", "#D01232", "#FFC681"
  //       // ]


  //     ];

  //     var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
  //     for (var i = 0; i < count; i++) {
  //       // data.push(getRandomColor());
  //       data.push(colors[i]);
  //     }

  //     return data;
  //   }

  //   var chartOptions = {
  //     tooltips: {
  //       callbacks: {
  //         label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
  //         title: () => null,
  //       }
  //     },

  //     indexAxis: 'y',
  //     responsive: true,
  //     maintainAspectRatio: false,
  //     plugins: {
  //       title: {
  //         display: true,
  //         text: 'STATUS PEMILIKAN RUMAH',
  //         padding: {
  //           top: 10,
  //           bottom: 30
  //         },
  //         font:
  //         {
  //             family: "Helvetica",
  //             size: "18",
  //         }

  //       },
  //       legend: {
  //         display: false,
  //       },
  //       hover: {mode: null},

  //     }
  //   };

  //   if (lengthdata == 0) {

  //     var chartData = '';

  //   } else {

  //     var chartData = {
  //       labels: arr_status,
  //       datasets: [{
  //         label: 'STATUS PEMILIKAN RUMAH',
  //         data: arr_data,
  //         backgroundColor: getRandomColorEachDatamyBarChart(lengthdata),
  //         hoverBackgroundColor: getRandomColorEachDatamyBarChart(lengthdata),
  //         borderColor: "transparent",

  //       }]
  //     };

  //   }



  //   var config = {
  //     type: "bar",

  //     // Chart Options
  //     options: chartOptions,


  //     data: chartData
  //   };

  //   var barChart = new Chart(ctx, config);

  // }

        function getBarStatusMilik(arr_data, arr_label, arr_jenis,arr_all_data)
        {
            for(var ii = 1; ii < 3; ii++)
            {
                var ctx = document.getElementById("myBarChart_"+ii).getContext('2d');

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

                var barChartData = {
                    labels: arr_label,
                    datasets: []
                };

                for (var i = 0; i < arr_all_data.length; i++)
                {
                    // console.log(arr_all_data[i][1]['background']);
                    barChartData.datasets.push(
                    {
                        label: arr_all_data[i][0]['label'],
                        backgroundColor: arr_all_data[i][1]['background'],
                        data: Object.values(arr_all_data[i][2]['data'])
                    })
                }

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        },
                        // indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'STATUS PEMILIKAN RUMAH MENGIKUT DAERAH',
                                padding: {
                                    top: 10,
                                    bottom: 30
                                },
                                font:
                                {
                                    family: "Helvetica",
                                    size: "18",
                                }
                            },
                            legend: {
                                display: true,
                            },
                        }
                    }
                });
            }
        }


        function getPieJenisRumah(arr_jenis, arr_data, lengthdata, jumjenisrumah)
        {
            for(var i = 1; i < 3; i++)
            {
                var ctxpie = $(".myPieChart2_"+i);

                function getRandomColorEachData(count)
                {
                    var data = [];
                    var arr_color = [
                        ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A"],
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
                    plugins: {
                        title: {
                            display: true,
                            text: 'JENIS RUMAH',
                            padding: {
                                top: 10,
                                bottom: 30
                            },
                            font:
                            {
                                family: "Helvetica",
                                size: "18",
                            }
                        },
                        legend: {
                            display: true,
                            position: "bottom"
                        },
                        datalabels: {
                            formatter: (value, ctxpie) => {
                                let sum = 0;
                                let dataArr = ctxpie.chart.data.datasets[0].data;
                                dataArr.map(data => {
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

                var chartDatapie = {
                    labels: arr_jenis,
                    datasets: [{
                        label: 'JENIS RUMAH',
                        data: arr_data,
                        backgroundColor: getRandomColorEachData(lengthdata),
                        hoverBackgroundColor: getRandomColorEachData(lengthdata),
                        borderColor:'#ffff',
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label;
                                    let value = context.raw;
                                    let valueformat = context.formattedValue;

                                    if (!label)
                                        label = 'Unknown'

                                    let sum = 0;
                                    let dataArr = context.chart.data.datasets[0].data;
                                    dataArr.map(data => {
                                        sum += Number(data);
                                    });

                                    let percentage =  value / sum * 100;

                                    return label + ": " + valueformat;
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
        }

        function getPieKemudahan(arr_jenis, arr_data, lengthdata, jumkemudahan)
        {
            for(var ii = 1; ii < 3; ii++)
            {
                var ctxpie = $("#myPieKemudahan_"+ii);

                function getRandomColorEachData(count)
                {
                    var data = [];
                    var arr_color = [
                        ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",],
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
                    plugins: {
                        title: {
                            display: true,
                            text: 'KEMUDAHAN AWAM & INFRASTRUKTUR',
                            padding: {
                                top: 10,
                                bottom: 30
                            },
                            font:
                            {
                                family: "Helvetica",
                                size: "18",
                            }
                        },
                        legend: {
                            display: true,
                            position: "bottom"
                        },
                        datalabels: {
                            formatter: (value, ctxpie) => {
                                // const datapoints = ctxpie.chart.data.datasets[0].data
                                // const total = jumkemudahan
                                // const percentage = value / total * 100
                                let sum = 0;
                                let dataArr = ctxpie.chart.data.datasets[0].data;

                                dataArr.map(data => {
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

                var chartDatapie = {
                    labels: arr_jenis,
                    datasets: [{
                        label: 'KEMUDAHAN AWAM & INFRASTRUKTUR',
                        data: arr_data,
                        backgroundColor: getRandomColorEachData(lengthdata),
                        hoverBackgroundColor: getRandomColorEachData(lengthdata),
                        borderColor:'#ffff',
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label;
                                    let valueformat = context.formattedValue;
                                    let value = context.raw;

                                    if (!label)
                                        label = 'Unknown'

                                    let sum = 0;
                                    let dataArr = context.chart.data.datasets[0].data;

                                    dataArr.map(data => {
                                        sum += Number(data);
                                    });

                                    let percentage =  value / sum * 100;

                                    return label + ": " + valueformat;
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
        }

        function getBarKemudahan2(arr_jenis, arr_data, lengthdata, arr_label, arr_ya, arr_tidak)
        {
            for(var zz = 1; zz < 3; zz++)
            {
                var ctxBarChart = $(".myBarChart2_"+zz);

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
                        plugins: {
                            title: {
                                display: true,
                                text: 'KEMUDAHAN ASAS RUMAH',
                                padding: {
                                    top: 10,
                                    bottom: 30
                                },
                                font:
                                {
                                    family: "Helvetica",
                                    size: "18",
                                }
                            },
                            legend: {
                                display: true,
                            },
                        }
                    };

                    var barChartData = '';
                }
                else
                {
                    var optionsBar = {
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        },
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'KEMUDAHAN ASAS RUMAH',
                                padding: {
                                    top: 10,
                                    bottom: 30
                                },
                                font:
                                {
                                    family: "Helvetica",
                                    size: "18",
                                }
                            },
                            legend: {
                                display: true,
                            },
                        }
                    };

                    var barChartData = {
                        labels: arr_jenis,
                        datasets: [{
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
        }


        function getPieKerja(arr_jenis, arr_data, lengthdata, jumjeniskerja)
        {
            for(var ii = 1; ii < 3; ii++)
            {
                var ctxpie = $("#myPieKerja_"+ii);

                function getRandomColorEachData(count)
                {
                    var data = [];
                    var arr_color = [
                        ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",],
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
                    plugins: {
                        title: {
                            display: true,
                            text: 'STATUS PEKERJAAN',
                            padding: {
                                top: 10,
                                bottom: 30
                            },
                            font:
                            {
                                family: "Helvetica",
                                size: "18",
                            }
                        },
                        legend: {
                            display: true,
                            position: "bottom"
                        },
                        datalabels: {
                            formatter: (value, ctxpie) => {
                                let sum = 0;
                                let dataArr = ctxpie.chart.data.datasets[0].data
                                dataArr.map(data => {
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
                        datasets: [{
                            label: 'STATUS PEKERJAAN',
                            data: arr_data,
                            backgroundColor: getRandomColorEachData(lengthdata),
                            hoverBackgroundColor: getRandomColorEachData(lengthdata),
                            borderColor:'#ffff',
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label;
                                        let valueformat = context.formattedValue;
                                        let value = context.raw;

                                        if (!label)
                                            label = 'Unknown'

                                        let sum = 0;
                                        let dataArr = context.chart.data.datasets[0].data;
                                        dataArr.map(data => {
                                          sum += Number(data);
                                        });

                                        let percentage =  value / sum * 100;

                                        return label + ": " + valueformat;
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
        }

        function getPieKahwin(arr_jenis, arr_data, lengthdata, jumjeniskerja)
        {
            for(var ii = 1; ii < 3; ii++)
            {
                var ctxpie = $("#myPieKahwin_"+ii);

                function getRandomColorEachData(count)
                {
                    var data = [];
                    var arr_color = [
                        ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A"],
                    ];
                    var colors = arr_color[Math.floor(Math.random() * arr_color.length)];

                    for (var i = 0; i < count; i++)
                    {
                        data.push(colors[i]);
                    }

                    return data;
                }

                var chartOptionspie = {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'TARAF PERKAHWINAN',
                            padding: {
                                top: 10,
                                bottom: 30
                            },
                            font:
                            {
                                family: "Helvetica",
                                size: "18",
                            }
                        },
                        legend: {
                            display: true,
                            position: "bottom"
                        },
                        datalabels: {
                            formatter: (value, ctxpie) => {
                                let sum = 0;
                                let dataArr = ctxpie.chart.data.datasets[0].data;
                                dataArr.map(data => {
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

                var chartDatapie = {
                    labels: arr_jenis,
                    datasets: [{
                        label: 'TARAF PERKAHWINAN',
                        data: arr_data,
                        backgroundColor: getRandomColorEachData(lengthdata),
                        hoverBackgroundColor: getRandomColorEachData(lengthdata),
                        borderColor:'#ffff',
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label;
                                    let valueformat = context.formattedValue;
                                    let value = context.raw;

                                    if (!label)
                                        label = 'Unknown'

                                    let sum = 0;
                                    let dataArr = context.chart.data.datasets[0].data;
                                    dataArr.map(data => {
                                        sum += Number(data);
                                    });

                                    let percentage =  value / sum * 100;

                                    return label + ": " + valueformat;
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
        }

  function getBarUmur(arr_data, arr_status, lengthdata) {

    var ctx = $("#myBarUmur");

    function getRandomColorEachData(count) {
      var data = [];
      var arr_color = [

      ["#d69fbf", "#5b285c", "#486eab", "#6badd5", "#7e637a", "#324a80", "#c52b49", "#467680", "#5c4547", "#ab7277"
        ],
         ["#ab7277", "#324a80", "#467680", "#6badd5", "#7e637a", "#5b285c", "#c52b49", "#486eab", "#5c4547", "#d69fbf"
        ],

      ];

      var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
      for (var i = 0; i < count; i++) {
        // data.push(getRandomColor());
        data.push(colors[i]);
      }

      return data;
    }
    var chartOptions = {
      tooltips: {
        callbacks: {
          label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
          title: () => null,
        }
      },
      indexAxis: 'y',
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: 'UMUR PENDUDUK',
          padding: {
            top: 10,
            bottom: 30
          },
         font:
          {
              family: "Helvetica",
              size: "18",
          }

        },
        legend: {
          display: false,
        },

      }
    };

    if (lengthdata == 0) {
      var chartData = ''

    } else {
      var chartData = {
        labels: arr_status,
        datasets: [{
          label: 'UMUR PENDUDUK',
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


  // function getBarPendapatan(arr_data, arr_status, lengthdata) {

  //   var ctx = $("#myBarPendapatan");

  //   function getRandomColorEachData(count) {
  //     var data = [];
  //     var arr_color = [

  //        ["#d69fbf", "#5b285c", "#486eab", "#6badd5", "#7e637a", "#324a80", "#c52b49", "#467680", "#5c4547", "#ab7277"
  //       ],
  //        ["#ab7277", "#324a80", "#467680", "#6badd5", "#7e637a", "#5b285c", "#c52b49", "#486eab", "#5c4547", "#d69fbf"
  //       ],

  //     ];

  //     var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
  //     for (var i = 0; i < count; i++) {
  //       // data.push(getRandomColor());
  //       data.push(colors[i]);
  //     }

  //     return data;
  //   }

  //   var chartOptions = {
  //     tooltips: {
  //       callbacks: {
  //         label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
  //         title: () => null,
  //       }
  //     },
  //     //indexAxis: 'y',
  //     responsive: true,
  //     maintainAspectRatio: false,
  //     plugins: {
  //       title: {
  //         display: true,
  //         text: 'Pendapatan Penduduk',
  //         padding: {
  //           top: 10,
  //           bottom: 30
  //         },
  //          font:
  //         {
  //             family: "Helvetica",
  //             size: "18",
  //         }

  //       },
  //       legend: {
  //         display: false,
  //       },

  //     }
  //   };

  //   if (lengthdata == 0) {
  //     var chartData = '';

  //   } else {

  //     var chartData = {
  //       labels: arr_status,
  //       datasets: [{
  //         label: 'Pendapatan Penduduk',
  //         data: arr_data,
  //         backgroundColor: getRandomColorEachData(lengthdata),
  //         hoverBackgroundColor: getRandomColorEachData(lengthdata),
  //         borderColor: "transparent",

  //       }]
  //     };


  //   }

  //   var config = {
  //     type: "bar",

  //     // Chart Options
  //     options: chartOptions,

  //     data: chartData
  //   };

  //   var barChart = new Chart(ctx, config);

  // }

        function getBarPendapatan(arr_data, arr_label, arr_jenis,jumgaji,arr_all_data)
        {
            for(var ii = 1; ii < 3; ii++)
            {
                var ctx = document.getElementById("myBarPendapatan_"+ii).getContext('2d');

                var barChartData = {
                    labels: arr_label,
                    datasets: []
                };

                for (var i = 0; i < arr_all_data.length; i++)
                {
                    // console.log(arr_all_data[i][1]['background']);
                    barChartData.datasets.push(
                    {
                        label: arr_all_data[i][0]['label'],
                        backgroundColor: arr_all_data[i][1]['background'],
                        data: Object.values(arr_all_data[i][2]['data'])
                    })
                }

                var myChart = new Chart(ctx,
                {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        },
                        // indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'PENDAPATAN PENDUDUK MENGIKUT DAERAH',
                                padding: {
                                    top: 10,
                                    bottom: 30
                                },
                                font:
                                {
                                    family: "Helvetica",
                                    size: "18",
                                }
                            },
                            legend: {
                                display: true,
                            },
                        }
                    }
                });
            }
        }

        function getBarKerja(arr_data, arr_label, arr_jenis,jumjeniskerja,arr_all_data)
        {
            for(var ii = 1; ii < 3; ii++)
            {
                var ctx = document.getElementById("myBarKerja_"+ii).getContext('2d');

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

                var barChartData = {
                    labels: arr_label,
                    datasets: []
                };

                for (var i = 0; i < arr_all_data.length; i++)
                {
                    // console.log(arr_all_data[i][1]['background']);
                    barChartData.datasets.push(
                    {
                        label: arr_all_data[i][0]['label'],
                        backgroundColor: arr_all_data[i][1]['background'],
                        data: Object.values(arr_all_data[i][2]['data'])
                    })
                }

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'STATUS PEKERJAAN MENGIKUT DAERAH',
                                padding: {
                                    top: 10,
                                    bottom: 30
                                },
                                font:
                                {
                                    family: "Helvetica",
                                    size: "18",
                                }
                            },
                            legend: {
                                display: true,
                            },
                        }
                    }
                });
            }
        }

        function getBarTarafKahwin(arr_data, arr_label, arr_jenis, arr_all_data)
        {
            for(var ii = 1; ii < 3; ii++)
            {
                var ctx = document.getElementById("myBarTarafKahwin_"+ii).getContext('2d');
                var barChartData = {
                    labels: arr_label,
                    datasets: []
                };

                for (var i = 0; i < arr_all_data.length; i++)
                {
                    // console.log(arr_all_data[i][1]['background']);
                    barChartData.datasets.push(
                    {
                        label: arr_all_data[i][0]['label'],
                        backgroundColor: arr_all_data[i][1]['background'],
                        data: Object.values(arr_all_data[i][2]['data'])
                    }
                )}

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        },
                        // indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'TARAF PERKAHWINAN MENGIKUT DAERAH',
                                padding: {
                                    top: 10,
                                    bottom: 30
                                },
                                font:
                                {
                                    family: "Helvetica",
                                    size: "18",
                                }
                            },
                            legend: {
                                display: true,
                            },
                        }
                    }
                });
            }
        }

        function getBarKemudahanAwam(arr_data, arr_label, arr_jenis,arr_all_data)
        {
            for(var ii = 1; ii < 3; ii++)
            {
                var ctx = document.getElementById("myBarKemudahanAwam_"+ii).getContext('2d');

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

                var barChartData =
                {
                    labels: arr_label,
                    datasets: []
                };

                for (var i = 0; i < arr_all_data.length; i++)
                {
                    // console.log(arr_all_data[i][1]['background']);
                    barChartData.datasets.push(
                    {
                        label: arr_all_data[i][0]['label'],
                        backgroundColor: arr_all_data[i][1]['background'],
                        data: Object.values(arr_all_data[i][2]['data'])
                    })
                }

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        },
                        // indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'KEMUDAHAN AWAM & INFRASTRUKTUR MENGIKUT DAERAH',
                                padding: {
                                    top: 10,
                                    bottom: 30
                                },
                                font:
                                {
                                    family: "Helvetica",
                                    size: "18",
                                }
                            },
                            legend: {
                                display: true,
                            },
                        }
                    }
                });
            }
        }

        function getBarJenisRumah(arr_data, arr_label, arr_jenis,arr_all_data)
        {
            for(var ii = 1; ii < 3; ii++)
            {
                // var ctx = document.getElementsByClassName("myBarJenisRumah_"+i)[0].getContext('2d');
                var ctx = document.getElementById("myBarJenisRumah_"+ii).getContext('2d');
                // var ctx = $(".myBarJenisRumah"+i).getContext('2d');

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

                var barChartData =
                {
                    labels: arr_label,
                    datasets: []
                };

                for (var i = 0; i < arr_all_data.length; i++)
                {
                    // console.log(arr_all_data[i][1]['background']);
                    barChartData.datasets.push(
                    {
                        label: arr_all_data[i][0]['label'],
                        backgroundColor: arr_all_data[i][1]['background'],
                        data: Object.values(arr_all_data[i][2]['data'])
                    })
                }

                var myChart = new Chart(ctx,
                {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        },
                        // indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'JENIS RUMAH MENGIKUT DAERAH',
                                padding: {
                                    top: 10,
                                    bottom: 30
                                },
                                font:
                                {
                                    family: "Helvetica",
                                    size: "18",
                                }
                            },
                            legend: {
                                display: true,
                            },
                        }
                    }
                });
            }
        }


        function myBarUmurDaerah(arr_data, arr_label, arr_jenis,arr_all_data)
        {
            for(var ii = 1; ii < 3; ii++)
            {
                var ctx = document.getElementById("myBarUmurDaerah_"+ii).getContext('2d');

                var barChartData = {
                    labels: arr_label,
                    datasets: []
                };

                for (var i = 0; i < arr_all_data.length; i++)
                {
                    // console.log(arr_all_data[i][1]['background']);
                    barChartData.datasets.push(
                    {
                        label: arr_all_data[i][0]['label'],
                        backgroundColor: arr_all_data[i][1]['background'],
                        data: Object.values(arr_all_data[i][2]['data'])
                    })
                }

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        scales: {
                            x: {
                                stacked: true
                            },
                            y: {
                                stacked: true
                            }
                        },
                        // indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            title: {
                                display: true,
                                text: 'UMUR PENDUDUK MENGIKUT DAERAH',
                                padding: {
                                    top: 10,
                                    bottom: 30
                                },
                                font:
                                {
                                    family: "Helvetica",
                                    size: "18",
                                }
                            },
                            legend: {
                                display: true,
                            },
                        }
                    }
                });
            }
        }



  function dun(id) {

    var role = "{{data_get($roleuser,'role_id')}}";



    $('#kampung').val(0);



    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/dun/')}}" + "/" + id,
      datatype: 'json',

      beforeSend: function() {
         block("tab-content");
        document.getElementById("pilihdun").innerHTML = "Sila Pilih";
        $('#selectdun').html('');
        $('#loading').show();
        $('#result2').hide();
        $('#result3').hide();
        $('#result4').hide();


      },

      success: function(data) {

         unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectdun').html(data);


      }


    });


    var parlimen = id;


    var dun = $('#dun').val();

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }

    var daerah = $('#daerah').val();
    var mukim = $('#mukim').val();


    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }


    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }

    var cat_petempatan = $('#cat_petempatan').val();

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }

    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }


    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/kampung/')}}" + "/" + parlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
      datatype: 'json',

      beforeSend: function() {
        document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
        $('#selectkampung').html('');
        $('#kampung').val(0);
        $('#result3').hide();
        $('#result4').hide();
        //$('#loading').show();


      },

      success: function(data) {

        // $('#loading').hide();

        $('#result3').hide();
        $('#result4').hide();
        $('#selectkampung').html(data);


      }


    });


  };

  function mukim(id) {


    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/mukim/')}}" + "/" + id,
      datatype: 'json',

      beforeSend: function() {
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

      success: function(data) {
         unblock("tab-content");

        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectmukim').html(data);



      }


    });

    var mukim = $('#mukim').val();


    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }

    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/parlimenKampung/')}}" + "/" + id + "/" + valmukim,
      datatype: 'json',

      beforeSend: function() {
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

      success: function(data) {

         unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectparlimen').html(data);




      }


    });


    var parlimen = $('#parlimen').val();
    if (parlimen == '') {
      valparlimen = 0;
    } else {
      valparlimen = parlimen;

    }

    var dun = $('#dun').val();

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }
    var daerah = id;

    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }

    var cat_petempatan = $('#cat_petempatan').val();

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }


    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }





    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
      datatype: 'json',

      beforeSend: function() {
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

      success: function(data) {

        // $('#loading').hide();

        $('#result3').hide();
        $('#result4').hide();
        $('#selectkampung').html(data);


      }


    });





  };

  function kampungdun(id) {

    $('#kampung').val(0);

    var daerah = $('#daerah').val();
    var mukim = $('#mukim').val();


    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }


    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }


    var parlimen = $('#parlimen').val();

    if (parlimen == '') {
      valparlimen = 0;
    } else {
      valparlimen = parlimen;

    }

    var dun = id;

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }


    var cat_petempatan = $('#cat_petempatan').val();

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }

    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }



    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
      datatype: 'json',

      beforeSend: function() {
         block("tab-content");
        document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
        $('#selectkampung').html('');
        $('#loading').show();
        $('#result2').hide();
        $('#kampung').val(0);
        $('#result3').hide();
        $('#result4').hide();


      },

      success: function(data) {

         unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectkampung').html(data);


      }


    });
  };


  function kampungmukim(id) {

    $('#kampung').val(0);
    $('#parlimen').val(0);
    $('#dun').val(0);


    var parlimen = $('#parlimen').val();
    var daerah = $('#daerah').val();
    var mukim = id;


    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }


    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }


    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/parlimenKampung/')}}" + "/" + valdaerah + "/" + valmukim,
      datatype: 'json',

      beforeSend: function() {
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

      success: function(data) {

        unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectparlimen').html(data);



      }


    });



    if (parlimen == '') {
      valparlimen = 0;
    } else {
      valparlimen = parlimen;

    }

    var dun = $('#dun').val();

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }




    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }


    var cat_petempatan = $('#cat_petempatan').val();

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }




    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
      datatype: 'json',

      beforeSend: function() {
         block("tab-content");
        document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
        $('#selectkampung').html('');
        $('#loading').show();
        $('#result2').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#kampung').val(0);


      },

      success: function(data) {

        unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectkampung').html(data);


      }


    });
  };

  function kampungpenempatan(id) {


    var parlimen = $('#parlimen').val();
    $('#kampung').val(0);


    if (parlimen == '') {
      valparlimen = 0;
    } else {
      valparlimen = parlimen;

    }

    var dun = $('#dun').val();

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }

    var daerah = $('#daerah').val();
    var mukim = $('#mukim').val();


    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }


    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }
    var cat_petempatan = id;

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }

    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }

    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
      datatype: 'json',

      beforeSend: function() {
         block("tab-content");
        document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
        $('#selectkampung').html('');
        $('#loading').show();
        $('#result2').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#kampung').val(0);

      },

      success: function(data) {

         unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectkampung').html(data);


      }


    });
  };
  function print_pie(){
        window.print();
        setTimeout(function () { window.close(); }, 100);
    }



</script>
