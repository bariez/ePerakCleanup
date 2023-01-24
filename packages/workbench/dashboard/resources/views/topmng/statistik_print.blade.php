
<div class="ui one column grid content__body" id="divtitle" style="margin-top: -80px; display: none">
    <div class="column middle aligned">
        <center>
            <h1 class="">
                LAPORAN STATISTIK PETEMPATAN
            </h1>
        </center>
    </div>
</div>

<div class="tab-content raised">

    <div class="ui container-fluid content__body" id="result3" style="display: none; padding: 0rem 2rem">
        <div class="ui buttons right floated" id="divaccordion2">
            <a href="javascript:;"  class="ui red button" onclick="document.title='LAPORAN STATISTIK PETEMPATAN'; window.print();" title="PDF">&nbsp;Cetak&nbsp;</a>
        </div> 
        <div id="divaccordion2">
            <br><br><br>
        </div>
        <div id="resultcountpetempatan">
          
        </div>
    </div>

    <div class="ui container-fluid content__body p-3" id="result4">
        
        <!-- chart 1 + chart 2 ------------------------------- -->
            <div class="ui two stackable cards raised">
                
                <div class="card ">
                    <div class="ui active loader" id="loader1"></div>
                    <div class="content" id="resultchart1" style="display: none">
                      
                    </div>
                </div>

                <div class="card">
                    <div class="ui active loader" id="loader2"></div>
                    <div class="content" id="resultchart2" style="display: none">
                      
                    </div>
                </div>

            </div>
        <!-- end chart 1 + chart 2 ------------------------------- -->

        <!-- chart 3 + chart 4 ------------------------------- -->
            <div class="ui two stackable cards raised">
                
                <div class="card">
                    <div class="ui active loader" id="loader3"></div>
                    <div class="content" id="resultchart3" style="display: none">
                      
                    </div>
                </div>

                <div class="card">
                    <div class="ui active loader" id="loader4"></div>
                    <div class="content" id="resultchart4" style="display: none">
                      
                    </div>
                </div>

            </div>
        <!-- end chart 3 + chart 4 ------------------------------- -->

        <div id="divtitle" style="page-break-before:always; display: none; padding-top: 4rem !important"> 

        </div>

        <!-- chart 5 ------------------------------- -->
            <div class="ui two stackable cards raised">

                <div class="card">
                    <div class="ui active loader" id="loader5"></div>
                    <div class="content" id="resultchart5" style="display: none">
                      
                    </div>
                </div>

                <div class="card">
                    <div class="ui active loader" id="loader11"></div>
                    <div class="content" id="resultchart11" style="display: none">
                      
                    </div>
                </div> 

            </div>
        <!-- end chart 5 ------------------------------- -->

        <!-- chart 6 ------------------------------- -->
            <div class="ui two stackable cards raised">

                <div class="card">
                    <div class="ui active loader" id="loader9"></div>
                    <div class="content" id="resultchart9" style="display: none">
                      
                    </div>
                </div> 

                <div class="card">
                    <div class="ui active loader" id="loader12"></div>
                    <div class="content" id="resultchart12" style="display: none">
                      
                    </div>

                </div> 

            </div>
        <!-- end chart 6 ------------------------------- -->
        
        <div id="divtitle" style="page-break-before:always; display: none; padding-top: 4rem !important"> 

        </div>

        <!-- chart 7 ------------------------------- -->
            <div class="ui two stackable cards raised">

                <div class="card">
                    <div class="ui active loader" id="loader6"></div>
                    <div class="content" id="resultchart6" style="display: none">
                      
                    </div>
                </div>

                <div class="card">
                    <div class="ui active loader" id="loader13"></div>
                    <div class="content" id="resultchart13" style="display: none">
                      
                    </div>
                </div>

            </div>
        <!-- end chart 7 ------------------------------- -->

        <!-- chart 8 ------------------------------- -->
            <div class="ui two stackable cards raised">
                
                <div class="card">
                    <div class="ui active loader" id="loader7"></div>
                    <div class="content" id="resultchart7" style="display: none">
                      
                    </div>
                </div>

                <div class="card">
                    <div class="ui active loader" id="loader14"></div>
                    <div class="content" id="resultchart14" style="display: none">
                      
                    </div>
                </div>

            </div>
        <!-- end chart 8 ------------------------------- -->
        
        <div id="divtitle" style="page-break-before:always; display: none; padding-top: 4rem !important"> 

        </div>

        <!-- chart 9 ------------------------------- -->
            <div class="ui two stackable cards raised">

                <div class="card">
                    <div class="ui active loader" id="loader8"></div>
                    <div class="content" id="resultchart8" style="display: none">
                      
                    </div>
                </div>

                <div class="card">
                    <div class="ui active loader" id="loader10"></div>
                    <div class="content" id="resultchart10" style="display: none">
                      
                    </div>
                </div>

            </div>
        <!-- end chart 9 ------------------------------- -->

    </div>
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
                                <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">Ringkasan Status Pekerjaan</span>
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
                $('#loading').show();document.getElementById('result3').style.display = "none";
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

        // -------------------------------------------getchart1------------------------//
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('/dashboard/chart1/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,
                beforeSend: function() 
                {
                    $('#loader1').show();
                    $('#result4').show();
                    document.getElementById('resultchart1').style.display = "none";
                },
                success: function(data) 
                {
                    var arr_data = "";
                    var arr_status = "";
                    var lengthdata = "";

                    if (data.arr_status.length == 0) 
                    {
                        $('#result4').hide();
                    } 
                    else 
                    {
                        $('#result4').show();
                    }

                    $('#loader1').hide();
                    $('#resultchart1').show();

                    arr_data = data.arr_data;
                    arr_status = data.arr_status;
                    lengthdata = data.arr_status.length;

                    $("#resultchart1").html('<div><canvas id="myBarChart" height="350" width="580"></canvas></div>');
                    getBarStatusMilik(arr_data, arr_status, lengthdata);
                } // end sucsess chart1
            }); // end ajax chart1
        // -------------------------------------------end getchart1-------------------------//

        //-------------------------------------------start getchart2-----------------//
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('/dashboard/chart2/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

                beforeSend: function() 
                {
                    $('#loader2').show();
                    document.getElementById('resultchart2').style.display = "none";
                },
                success: function(data) 
                {
                    var arr_data = "";
                    var arr_status = "";
                    var lengthdata = "";

                    $('#loader2').hide();
                    // document.getElementById('result3').style.display = "show";
                    $('#resultchart2').show();
                    // document.getElementById('resultchart1').innerHTML = data;
                

                    arr_jenis = data.arr_jenis;
                    arr_data = data.arr_data;
                    lengthdata = data.arr_jenis.length;
                    jumjenisrumah = data.jumjenisrumah;

                    $("#resultchart2").html('<div><canvas id="myPieChart" height="500" width="580"></canvas></div>');
                    getPieJenisRumah(arr_jenis, arr_data, lengthdata, jumjenisrumah);
                } // end sucsess chart1
            }); // end ajax chart1
        //--------------------------------------------end getchart2-------------------//
    
        //-------------------------------------------start getchart3----------------------//
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('/dashboard/chart3/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

                beforeSend: function() 
                {
                    $('#loader3').show();
                    document.getElementById('resultchart3').style.display = "none";
                },
                success: function(data) 
                {
                    var arr_data = "";
                    var arr_status = "";
                    var lengthdata = "";

                    $('#loader3').hide();
                    //document.getElementById('result3').style.display = "show";
                    $('#resultchart3').show();
                    //document.getElementById('resultchart1').innerHTML = data;

                    arr_jenis = data.arr_jenis;
                    arr_data = data.arr_data;
                    lengthdata = data.arr_jenis.length;
                    jumkemudahan = data.jumkemudahan;

                    $("#resultchart3").html('<canvas id="myPieKemudahan" height="500" width="580"></canvas></div>');
                    getPieKemudahan(arr_jenis, arr_data, lengthdata, jumkemudahan);
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
                    $('#loader4').show();
                    document.getElementById('resultchart4').style.display = "none";
                },
                success: function(data) 
                {
                    var arr_data = "";
                    var arr_status = "";
                    var lengthdata = "";
                    var arr_ya = "";
                    var arr_tidak = "";

                    $('#loader4').hide();
                    // document.getElementById('result3').style.display = "show";
                    $('#resultchart4').show();
                    // document.getElementById('resultchart1').innerHTML = data;

                    arr_jenis = data.arr_status;
                    arr_data = data.arr_data;
                    lengthdata = data.arr_status.length;
                    arr_label = data.arr_label;
                    arr_ya = data.arr_ya;
                    arr_tidak = data.arr_tidak;

                    $("#resultchart4").html('<canvas id="myBarChart2" height="350" width="580"></canvas></div>');
                    getBarKemudahan2(arr_jenis, arr_data, lengthdata, arr_label, arr_ya, arr_tidak);
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
                    $('#loader5').show();
                    $('#loader11').show();
                    document.getElementById('resultchart5').style.display = "none";
                },
                success: function(data) 
                {
                    var arr_data = "";
                    var arr_status = "";
                    var lengthdata = "";
                    var htc5 = "";

                    $('#loader5').hide();
                    $('#loader11').hide();
                    // document.getElementById('result3').style.display = "show";
                    $('#resultchart5').show();
                    $('#resultchart11').show();
                    // document.getElementById('resultchart1').innerHTML = data;

                    arr_jenis = data.arr_jenis;
                    arr_data = data.arr_data;
                    lengthdata = data.arr_jenis.length;
                    jumjeniskerja = data.jumjeniskerja;

                    $("#resultchart5").html('<canvas id="myPieKerja" height="500" width="580"></canvas></div>');
                    getPieKerja(arr_jenis, arr_data, lengthdata, jumjeniskerja);

                    var paparan = arr_jenis.toString().split(",");
                    var sum = 0;

                    htc5 += '<table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">';
                    htc5 +='<thead>'
                    htc5 +='<tr>'
                    htc5 +='<th colspan="2">'
                    htc5 +='<center>'
                    htc5 +='<span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">'
                    htc5 +='Ringkasan Status Pekerjaan</span>'
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

                    $("#resultchart11").html(htc5);
                } // end sucsess chart5
            }); //end ajax chart5
        //--------------------------------------------end getchart5-----------------//

        //-------------------------------------------start getchart9---------------//
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('/dashboard/chart5all/')}}",

                beforeSend: function() 
                {
                    $('#loader9').show();
                    document.getElementById('resultchart9').style.display = "none";
                },
                success: function(data) 
                {
                    var arr_data = "";
                    var arr_status = "";
                    var lengthdata = "";

                    $('#loader9').hide();
                    //document.getElementById('result3').style.display = "show";
                    $('#resultchart9').show();
                    //document.getElementById('resultchart1').innerHTML = data;

                    arr_data = data.arr_data;
                    arr_label = data.arr_label;
                    arr_jenis = data.arr_jenis;
                    jumjeniskerja=data.jumjeniskerja;
                    length=data.arr_jenis.length;
                    arr_all_data= data.arr_all_data;

                    $("#resultchart9").html('<canvas id="myBarKerja" height="500" width="580"></canvas></div>');
                    getBarKerja(arr_data, arr_label, arr_jenis,jumjeniskerja,arr_all_data);
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
                    $('#loader6').show();
                    $('#loader13').show();

                    document.getElementById('resultchart6').style.display = "none";
                },
                success: function(data) 
                {
                    var arr_data = "";
                    var arr_status = "";
                    var lengthdata = "";
                    var htc5 = "";

                    $('#loader6').hide();
                    $('#loader13').hide();
                    // document.getElementById('result3').style.display = "show";
                    $('#resultchart6').show();
                    $('#resultchart13').show();
                    // document.getElementById('resultchart1').innerHTML = data;

                    arr_jenis = data.arr_jenis;
                    arr_data = data.arr_data;
                    lengthdata = data.arr_jenis.length;
                    jumjeniskawin = data.jumjeniskawin;

                    $("#resultchart6").html('<canvas id="myPieKahwin" height="500" width="580"></canvas>');
                    getPieKahwin(arr_jenis, arr_data, lengthdata, jumjeniskawin);

                    var paparan = arr_jenis.toString().split(",");
                    var sum = 0;

                    htc5 += '<table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">';
                    htc5 += '<thead>'
                    htc5 += '<tr>'
                    htc5 += '<th colspan="2">'
                    htc5 += '<center>'
                    htc5 += '<span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">'
                    htc5 += 'TARAF PERKAHWINAN</span>'
                    htc5 += '</center>'
                    htc5 += '</th>'
                    htc5 += '</tr>'
                    htc5 += '<tr>'
                    htc5 += '<th style="text-align: center;">'
                    htc5 += 'Kategori</th>'
                    htc5 += '<th style="text-align: center;">'
                    htc5 += 'Jumlah</th>'
                    htc5 += '</tr>'
                    htc5 += '</thead>'

                    htc5 += '<tbody id="table-chart5">'

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

                    $("#resultchart13").html(htc5);
                } //end sucsess chart6
            }); //end ajax chart6
        //--------------------------------------------end getchart6-----------------//

        //-------------------------------------------getchart7------------------------//
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('/dashboard/chart7/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

                beforeSend: function() 
                {
                    $('#loader7').show();
                    $('#loader14').show();

                    document.getElementById('resultchart7').style.display = "none";
                },
                success: function(data) 
                {
                    var arr_data = "";
                    var arr_status = "";
                    var lengthdata = "";
                    var htc5 = "";

                    $('#loader7').hide();
                    $('#loader14').hide();
                    //document.getElementById('result3').style.display = "show";
                    $('#resultchart7').show();
                    $('#resultchart14').show();
                    //document.getElementById('resultchart1').innerHTML = data;

                    arr_data = data.arr_data;
                    arr_status = data.arr_status;
                    lengthdata = data.arr_status.length;

                    $("#resultchart7").html('<canvas id="myBarUmur" height="350" width="580"></canvas></div>');
                    getBarUmur(arr_data, arr_status, lengthdata);

                    var paparan = arr_status.toString().split(",");
                    var sum = 0;


                    htc5 += '<table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">';
                    htc5 += '<thead>';
                    htc5 += '<tr>';
                    htc5 += '<th colspan="2">';
                    htc5 += '<center>';
                    htc5 += '<span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">';
                    htc5 += 'UMUR PENDUDUK</span>';
                    htc5 += '</center>';
                    htc5 += '</th>';
                    htc5 += '</tr>';
                    htc5 += '<tr>';
                    htc5 += '<th style="text-align: center;">';
                    htc5 += 'Kategori</th>';
                    htc5 += '<th style="text-align: center;">';
                    htc5 += 'Jumlah</th>';
                    htc5 += '</tr>';
                    htc5 += '</thead>';
                    htc5 += '<tbody id="table-chart5">';

                    if (lengthdata != 0) 
                    {
                        for (var i = 0; i < paparan.length; i++) 
                        {
                            htc5 += '<tr>';
                            htc5 += "<td style='text-align: center; font-size: 13px'>" + paparan[i] + "</td>";
                            htc5 += "<td style='text-align: center; font-size: 13px'>" + arr_data[i] + "</td>";
                            htc5 += '</tr>';

                            sum += Number(arr_data[i]);
                        }

                        htc5 += '<tr>';
                        htc5 += "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                        htc5 += "<td style='text-align: center; font-size: 13px'><b>" + sum + "</b></td>";
                        htc5 += '</tr>';
                        htc5 += '</tbody>'
                        htc5 += '</table>';
                    } 
                    else 
                    {
                        htc5 += '<tr>';
                        htc5 += "<td style='text-align: center; font-size: 13px'> - </td>";
                        htc5 += "<td style='text-align: center; font-size: 13px'> - </td>";
                        htc5 += '</tr>';

                        htc5 += '<tr>';
                        htc5 += "<td style='text-align: center; font-size: 13px'><b>JUMLAH</></td>";
                        htc5 += "<td style='text-align: center; font-size: 13px'><b>0</b></td>";
                        htc5 += '</tr>';
                    }

                    $("#resultchart14").html(htc5);

                } //end sucsess chart1
            }); //end ajax chart1
        //-------------------------------------------end getchart7-----------------//
     
        //-------------------------------------------getchart8-----------------------//
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('/dashboard/chart8all/')}}",

                beforeSend: function() 
                {
                    $('#loader8').show();
                    document.getElementById('resultchart8').style.display = "none";
                },
                success: function(data) 
                {
                    var arr_data = "";
                    var arr_status = "";
                    var lengthdata = "";

                    $('#loader8').hide();
                    //document.getElementById('result3').style.display = "show";
                    $('#resultchart8').show();
                    //document.getElementById('resultchart1').innerHTML = data;

                    arr_data = data.arr_data;
                    arr_label = data.arr_label;
                    arr_jenis = data.arr_jenis;
                    jumgaji = data.jumgaji;
                    length = data.arr_jenis.length;
                    arr_all_data = data.arr_all_data;

                    $("#resultchart8").html('<canvas id="myBarPendapatan" height="350" width="580"></canvas></div>');
                    getBarPendapatan(arr_data, arr_label, arr_jenis, jumgaji, arr_all_data);
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
                    $('#loader10').show();
                    document.getElementById('resultchart10').style.display = "none";
                },
                success: function(data) 
                {
                    var arr_data = "";
                    var arr_status = "";
                    var lengthdata = "";

                    $('#loader10').hide();
                    //document.getElementById('result3').style.display = "show";
                    $('#resultchart10').show();
                    //document.getElementById('resultchart1').innerHTML = data;
                    $("#resultchart10").html(data);
                } // end sucsess chart1
            }); //end ajax chart1
        //-------------------------------------------end getchart10----------------//

        //-------------------------------------------getchart12-----------------------//
            $.ajax(
            {
                type: "GET",
                url: "{{ URL::to('/dashboard/chart12/')}}",

                beforeSend: function() 
                {
                    $('#loader12').show();
                    document.getElementById('resultchart10').style.display = "none";
                },
                success: function(data) 
                {
                    var arr_data = "";
                    var arr_status = "";
                    var lengthdata = "";

                    $('#loader12').hide();
                    //document.getElementById('result3').style.display = "show";
                    $('#resultchart12').show();
                    //document.getElementById('resultchart1').innerHTML = data;
                    $("#resultchart12").html(data);
                } //end sucsess chart12
            }); //end ajax chart12
        //-------------------------------------------end getchart12----------------//

    } //end search()

    function getBarStatusMilik(arr_data, arr_status, lengthdata) 
    {
        var ctx = $("#myBarChart");

        function getRandomColorEachDatamyBarChart(count) 
        {
            var data = [];
            var arr_color = [
                ["#d69fbf", "#467680"],
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
                    text: 'STATUS PEMILIKAN RUMAH',
                    padding: {
                        top: 10,
                        bottom: 30
                    },
                    font: {
                        family: "Helvetica",
                        size: "18",
                    },
                },
                legend: {
                    display: false,
                },
                hover: {
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
                datasets: [{
                    label: 'STATUS PEMILIKAN RUMAH',
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
                    font: {
                        family: "Helvetica",
                        size: "18",
                    },
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
                        let percentage = value / sum * 100;
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
                borderColor: '#ffff',
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
                            let percentage = value / sum * 100;
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

    function getPieKemudahan(arr_jenis, arr_data, lengthdata, jumkemudahan) 
    {
        var ctxpie = $("#myPieKemudahan");

        function getRandomColorEachData(count) {
            var data = [];
            var arr_color = [
                ["#d69fbf", "#5b285c", "#486eab", "#6badd5", "#7e637a", "#324a80", "#c52b49", "#467680", "#5c4547", "#ab7277"],
                ["#ab7277", "#324a80", "#467680", "#6badd5", "#7e637a", "#5b285c", "#c52b49", "#486eab", "#5c4547", "#d69fbf"],
            ];

            var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
            for (var i = 0; i < count; i++) {
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
                    font: {
                        family: "Helvetica",
                        size: "18",
                    },
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
                        let percentage = value / sum * 100;

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
                borderColor: '#ffff',
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
                            let percentage = value / sum * 100;
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
                plugins: {
                    title: {
                        display: true,
                        text: 'KEMUDAHAN ASAS RUMAH',
                        padding: {
                            top: 10,
                            bottom: 30
                        },
                        font: {
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
                        font: {
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
                        backgroundColor: "rgb(126, 99, 122)",
                        hoverBackgroundColor: "rgb(126, 99, 122)",
                        data: arr_ya
                    },
                    {
                        label: "Tidak",
                        //backgroundColor: getRandomColorEachData(1),
                        backgroundColor: "rgb(197, 43, 73)",
                        hoverBackgroundColor: "rgb(197, 43, 73)",
                        data: arr_tidak
                    }
                ]
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
                    font: {
                        family: "Helvetica",
                        size: "18",
                    },
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
                        let percentage = value / sum * 100;
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
                    borderColor: '#ffff',
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
                                let percentage = value / sum * 100;
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

    function getPieKahwin(arr_jenis, arr_data, lengthdata, jumjeniskerja) 
    {
        var ctxpie = $("#myPieKahwin");

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
                    font: {
                        family: "Helvetica",
                        size: "18",
                    },
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
                        let percentage = value / sum * 100;
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
                borderColor: '#ffff',
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
                            let percentage = value / sum * 100;
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

    function getBarUmur(arr_data, arr_status, lengthdata) 
    {
        var ctx = $("#myBarUmur");

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
                    font: {
                        family: "Helvetica",
                        size: "18",
                    },
                },
                legend: {
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

    function getBarPendapatan(arr_data, arr_label, arr_jenis, jumgaji, arr_all_data) 
    {
        var ctx = document.getElementById("myBarPendapatan").getContext('2d');
        var barChartData = {
            labels: arr_label,
            datasets: []
        };

        for (var i = 0; i < arr_all_data.length; i++) 
        {
            barChartData.datasets.push({
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
                        text: 'PENDAPATAN PENDUDUK MENGIKUT DAERAH',
                        padding: {
                            top: 10,
                            bottom: 30
                        },
                        font: {
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

    function getBarKerja(arr_data, arr_label, arr_jenis, jumjeniskerja, arr_all_data) 
    {
        var ctx = document.getElementById("myBarKerja").getContext('2d');

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
            barChartData.datasets.push({
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
                        font: {
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

    function dun(id) 
    {
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
                $('#result3').hide();
                $('#result4').hide();
                $('#selectkampung').html(data);
            }
        });
    };

    function mukim(id) 
    {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('dataentry/mukim/')}}" + "/" + id,
            datatype: 'json',

            beforeSend: function() {
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
                block("tab-content");
                document.getElementById("pilihparlimen").innerHTML = "Sila Pilih";
                document.getElementById("pilihdun").innerHTML = "Sila Pilih";
                $('#selectparlimen').html('');
                $('#selectdun').html('');
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

    function kampungmukim(id) 
    {
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

    function kampungpenempatan(id) 
    {
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

    function print_pie() 
    {
        window.print();
        setTimeout(function() 
        {
            window.close();
        }, 100);
    }

</script>