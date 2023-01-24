
<style type="text/css">
    .graph_container {
        display: block;
        width: 600px;
    }

    .wrapper {
        height: 200px;
        width: 400px;
    }
</style>

<div class="tab-content p-3 raised">
    <div class="ui styled fluid accordion">
        <div class="title">
            <i class="dropdown icon"></i> CARIAN STATISTIK
        </div>
        <div class="content">
            <div class="ui segment p-3">
                <form class="ui form">
                    <div class="two fields">

                        @if(data_get($roleuser,'role_id')==2) 

                            <div class="field">
                                <label>Daerah</label>
                                <input type="text" readonly="readonly" value="{{data_get($daerah,'NamaDaerah')}}">
                                <input type="hidden" name="daerah" id="daerah" readonly="readonly" value="{{data_get($daerah,'id')}}">
                            </div>
                            <div class="field">
                                <label>Mukim</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="mukim" id="mukim" value="">
                                    <i class="dropdown icon"></i>
                                    <div class="default text" id="pilihmukim">Sila Pilih</div>
                                    <div class="menu" id="selectmukim"></div>
                                </div>
                            </div>

                        @elseif(data_get($roleuser,'role_id')==3) 

                            <div class="field">
                                <label>Daerah</label>
                                <input type="text" name="daerah" id="daerah" readonly="readonly" value="{{data_get($daerah,'NamaDaerah')}}">
                            </div>
                            <div class="field">
                                <label>Mukim</label>
                                <input type="text" name="mukim" id="mukim" readonly="readonly" value="{{data_get($mukim,'NamaMukim')}}">
                            </div>

                        @else 

                            <div class="field">
                                <label>Daerah</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="daerah" id="daerah" value="">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Sila Pilih</div>
                                    <div class="menu">
                                        <div class="item" data-value="" onclick="mukim(0)">Sila Pilih</div> 
                                            @foreach($daerah as $key => $value) 
                                                <div class="item" data-value="{{$value->id}}" onclick="mukim({{$value->id}})">{{$value->NamaDaerah}}</div> 
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>Mukim</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="mukim" id="mukim" value="">
                                    <i class="dropdown icon"></i>
                                    <div class="default text" id="pilihmukim">Sila Pilih</div>
                                    <div class="menu" id="selectmukim"></div>
                                </div>
                            </div>

                        @endif

                    </div>

                    <div class="two fields">
                        <div class="field">
                            <label>Parlimen</label>
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="parlimen" id="parlimen" value="">
                                <i class="dropdown icon"></i>
                                <div class="default text" id="pilihparlimen">Sila Pilih</div>
                                <div class="menu" id="selectparlimen"></div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Dun</label>
                            <div class="ui fluid search selection dropdown">
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
                            <div class="ui fluid search selection dropdown">
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
                            <div class="ui fluid search selection dropdown">
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
                </div>
        
                <br/><br/><br/>
            </div>
        </div>
    </div>

    <div class="ui container-fluid content__body" id="result3" style="display: none; padding: 2rem 0rem">
        <div class="ui segments panel">
            <div class="ui segment p-3" id="resultcountpetempatan"></div>
        </div>
    </div>

    <div class="ui container-fluid content__body" id="result4" style="padding: 2rem 0rem">

        <!-- chart 1 ------------------------------- -->
        <div class="ui two stackable cards raised">
            <div class="card">
                <div class="ui active loader" id="loader1"></div>
                <div class="content" id="resultchart1" style="display: none"></div>
            </div>
            <div class="card" id="modalchart1">
                <div class="ui active loader" id="explainloader1"></div>
                <div class="content" id="explainchart1">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">Ringkasan Status Pemilikan Rumah</span>
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
        <div class="ui two stackable cards raised">
            <div class="card">
                <div class="ui active loader" id="loader2"></div>
                <div class="content" id="resultchart2" style="display: none"></div>
            </div>
            <div class="card">
                <div class="ui active loader" id="explainloader2"></div>
                <div class="content" id="explainchart2">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">Ringkasan Jenis Rumah</span>
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
        <div class="ui two stackable cards raised">
            <div class="card">
                <div class="ui active loader" id="loader3"></div>
                <div class="content" id="resultchart3" style="display: none"></div>
            </div>
            <div class="card ">
                <div class="ui active loader" id="explainloader3"></div>
                <div class="content" id="explainchart3">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">Ringkasan Kemudahan Awam & Infrastruktur</span>
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
        <div class="ui two stackable cards raised">
        <div class="card">
            <div class="ui active loader" id="loader4"></div>
            <div class="content" id="resultchart4" style="display: none"></div>
        </div>
            <div class="card">
                <div class="ui active loader" id="explainloader4"></div>
                <div class="content" id="explainchart4">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">Ringkasan Kemudahan Asas Rumah</span>
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
        <div class="ui two stackable cards raised">
            <div class="card">
                <div class="ui active loader" id="loader5"></div>
                <div class="content" id="resultchart5" style="display: none"></div>
            </div>
            <div class="card ">
                <div class="ui active loader" id="explainloader5"></div>
                <div class="content" id="explainchart5">
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
        </div>
        <!-- end chart 5 ------------------------------- -->

        <!-- chart 6 ------------------------------- -->
        <div class="ui two stackable cards raised">
            <div class="card">
                <div class="ui active loader" id="loader6"></div>
                <div class="content" id="resultchart6" style="display: none"></div>
            </div>
            <div class="card">
                <div class="ui active loader" id="explainloader6"></div>
                <div class="content" id="explainchart6">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">Ringkasan Taraf Perkahwinan</span>
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
        <div class="ui two stackable cards raised link">
            <div class="card">
                <div class="ui active loader" id="loader7"></div>
                <div class="content" id="resultchart7" style="display: none"></div>
            </div>
            <div class="card">
                <div class="ui active loader" id="explainloader7"></div>
                <div class="content" id="explainchart7">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">Ringkasan Umur Penduduk</span>
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
        <div class="ui two stackable cards raised link" id="modalchart8">
            <div class="card">
                <div class="ui active loader" id="loader8"></div>
                <div class="content" id="resultchart8" style="display: none"></div>
            </div>
            <div class="card">
                <div class="ui active loader" id="explainloader8"></div>
                <div class="content" id="explainchart8">
                    <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">Ringkasan Pendapatan Penduduk</span>
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

<!-- -------------------------- start modal chart 8 add -->
<div id="modalcharteighth" class="ui modal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Maklumat Pendapatan Penduduk</h2>
            </div>
            <!-- END: Modal Header -->

            <!-- BEGIN: Modal Body -->
            <div class="modal-body">

                <div class="col s12" id="ajaxlistchart8" style="">
                    <div class="container">
                        <div class="overflow-x-auto p-5">
                            <table id="data-table-dalaman" 
                                   class="display" 
                                   style="width:100%;font-size: 12px;background-color:#87b0fb">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Bil</th>
                                        <th style="text-align: center;">Mukim</th>
                                        <th style="text-align: center;">Kampung</th>
                                        <th style="text-align: center;">Nama</th>
                                        <th style="text-align: center;">No Pengenalan</th>
                                        <th style="text-align: center;">No Tel</th>
                                        <th style="text-align: center;">Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-chart8">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="ajaxpleasewaitchart8" class="intro-y grid grid-cols-6 sm:gap-6 gap-y-6 box px-5 py-8 mt-5 mb-5" 
                     style="display: none">
                    <div class="col-span-6 sm:col-span-3 xl:col-span-10 flex flex-col items-center">
                        <i data-loading-icon="bars" class="w-8 h-8"></i> 
                        <div class="text-center text-xs mt-2">Sila Tunggu Sebentar</div>
                    </div>
                </div>
            </div>
            <!-- END: Modal Body -->

        </div>
    </div>
</div>
<!-- -------------------------- end modal chart 8 add -->

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
                            $('#loading').show();
                            $('#result2').hide();
                        },
                        success: function(data) 
                        {
                            unblock("tab-content");
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

                $("#resultchart1").html('<canvas id="myBarChart" height="300" width="580"></canvas></div>');
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
                        htc1 +=  "<td style='text-align: center; font-size: 9px'>"+paparan[i]+"</td>";
                        htc1 +=  "<td style='text-align: center; font-size: 9px'>"+arr_data[i]+"</td>";
                        htc1 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc1 += '<tr>';
                    htc1 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</b></td>";
                    htc1 +=  "<td style='text-align: center; font-size: 9px'><b>"+sum+"</b></td>";
                    htc1 += '</tr>';
                }
                else
                {
                    htc1 += '<tr>';
                    htc1 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc1 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc1 += '</tr>';

                    htc1 += '<tr>';
                    htc1 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc1 +=  "<td style='text-align: center; font-size: 9px'><b>0</b></td>";
                    htc1 += '</tr>';
                }

                $("#table-chart1").html(htc1);
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

                $("#resultchart2").html('<canvas id="myPieChart" height="300" width="580"></canvas></div>');
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
                        htc2 +=  "<td style='text-align: center; font-size: 9px'>"+paparan[i]+"</td>";
                        htc2 +=  "<td style='text-align: center; font-size: 9px'>"+arr_data[i]+"</td>";
                        htc2 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc2 += '<tr>';
                    htc2 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc2 +=  "<td style='text-align: center; font-size: 9px'><b>"+sum+"</b></td>";
                    htc2 += '</tr>';
                }
                else
                {
                    htc2 += '<tr>';
                    htc2 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc2 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc2 += '</tr>';

                    htc2 += '<tr>';
                    htc2 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc2 +=  "<td style='text-align: center; font-size: 9px'><b>0</b></td>";
                    htc2 += '</tr>';
                }

                $("#table-chart2").html(htc2);
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

                $("#resultchart3").html('<canvas id="myPieKemudahan" height="350" width="580"></canvas></div>');
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
                        htc3 +=  "<td style='text-align: center; font-size: 9px'>"+paparan[i]+"</td>";
                        htc3 +=  "<td style='text-align: center; font-size: 9px'>"+arr_data[i]+"</td>";
                        htc3 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc3 += '<tr>';
                    htc3 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc3 +=  "<td style='text-align: center; font-size: 9px'><b>"+sum+"</b></td>";
                    htc3 += '</tr>';
                }
                else
                {
                    htc3 += '<tr>';
                    htc3 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc3 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc3 += '</tr>';

                    htc3 += '<tr>';
                    htc3 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc3 +=  "<td style='text-align: center; font-size: 9px'><b>0</b></td>";
                    htc3 += '</tr>';
                }

                $("#table-chart3").html(htc3);
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

                $("#resultchart4").html('<canvas id="myBarChart2" height="330" width="580"></canvas></div>');
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
                        htc4 +=  "<td style='text-align: center; font-size: 9px'>"+paparan[i]+"</td>";
                        htc4 +=  "<td style='text-align: center; font-size: 9px'>"+arr_ya[i]+"</td>";
                        htc4 +=  "<td style='text-align: center; font-size: 9px'>"+arr_tidak[i]+"</td>";
                        htc4 += '</tr>';

                        sumya += Number(arr_ya[i]);
                        sumno += Number(arr_tidak[i]);
                    }

                    htc4 += '<tr>';
                    htc4 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc4 +=  "<td style='text-align: center; font-size: 9px'><b>"+sumya+"</b></td>";
                    htc4 +=  "<td style='text-align: center; font-size: 9px'><b>"+sumno+"</b></td>";
                    htc4 += '</tr>';
                }
                else
                {
                    htc4 += '<tr>';
                    htc4 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc4 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc4 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc4 += '</tr>';

                    htc4 += '<tr>';
                    htc4 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc4 +=  "<td style='text-align: center; font-size: 9px'><b>0</b></td>";
                    htc4 +=  "<td style='text-align: center; font-size: 9px'><b>0</b></td>";
                    htc4 += '</tr>';
                }

                $("#table-chart4").html(htc4);
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

                $("#resultchart5").html('<canvas id="myPieKerja" height="350" width="580"></canvas></div>');
                getPieKerja(arr_jenis, arr_data, lengthdata, jumjeniskerja);

                $('#explainloader5').hide();
                $('#explainchart5').show();

                var paparan = arr_jenis.toString().split(",");
                var sum = 0;

                if(lengthdata != 0)
                {
                    for(var i=0; i<paparan.length; i++)
                    {
                        htc5 += '<tr>';
                        htc5 +=  "<td style='text-align: center; font-size: 9px'>"+paparan[i]+"</td>";
                        htc5 +=  "<td style='text-align: center; font-size: 9px'>"+arr_data[i]+"</td>";
                        htc5 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 9px'><b>"+sum+"</b></td>";
                    htc5 += '</tr>';
                }
                else
                {
                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc5 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc5 += '</tr>';

                    htc5 += '<tr>';
                    htc5 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc5 +=  "<td style='text-align: center; font-size: 9px'><b>0</b></td>";
                    htc5 += '</tr>';
                }

                $("#table-chart5").html(htc5);
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

                $("#resultchart6").html('<canvas id="myPieKahwin" height="350" width="580"></canvas>');
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
                        htc6 +=  "<td style='text-align: center; font-size: 9px'>"+paparan[i]+"</td>";
                        htc6 +=  "<td style='text-align: center; font-size: 9px'>"+arr_data[i]+"</td>";
                        htc6 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc6 += '<tr>';
                    htc6 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc6 +=  "<td style='text-align: center; font-size: 9px'><b>"+sum+"</b></td>";
                    htc6 += '</tr>';
                }
                else
                {
                    htc6 += '<tr>';
                    htc6 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc6 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc6 += '</tr>';

                    htc6 += '<tr>';
                    htc6 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc6 +=  "<td style='text-align: center; font-size: 9px'><b>0</b></td>";
                    htc6 += '</tr>';
                }

                $("#table-chart6").html(htc6);
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
                        htc7 +=  "<td style='text-align: center; font-size: 9px'>"+paparan[i]+"</td>";
                        htc7 +=  "<td style='text-align: center; font-size: 9px'>"+arr_data[i]+"</td>";
                        htc7 += '</tr>';

                        sum += Number(arr_data[i]);
                    }

                    htc7 += '<tr>';
                    htc7 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc7 +=  "<td style='text-align: center; font-size: 9px'><b>"+sum+"</b></td>";
                    htc7 += '</tr>';
                }
                else
                {
                    htc7 += '<tr>';
                    htc7 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc7 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc7 += '</tr>';

                    htc7 += '<tr>';
                    htc7 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc7 +=  "<td style='text-align: center; font-size: 9px'><b>0</b></td>";
                    htc7 += '</tr>';
                }

                $("#table-chart7").html(htc7);
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

                $("#resultchart8").html('<canvas id="myBarPendapatan" height="350" width="580"></canvas></div>');
                getBarPendapatan(arr_data, arr_status, lengthdata);

                $('#explainloader8').hide();
                $('#explainchart8').show();

                var paparan = arr_status.toString().split(",");
                var sum = 0;

                if(lengthdata != 0)
                {
                    for(var i=0; i<paparan.length; i++)
                    {
                        htc8 += '<tr>';
                        htc8 +=  "<td style='text-align: center; font-size: 9px'>"+paparan[i]+"</td>";
                        htc8 +=  "<td style='text-align: center; font-size: 9px'>"+arr_data[i]+"</td>";
                        htc8 += '</tr>';
                        
                        sum += Number(arr_data[i]);
                    }

                    htc8 += '<tr>';
                    htc8 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc8 +=  "<td style='text-align: center; font-size: 9px'><b>"+sum+"</b></td>";
                    htc8 += '</tr>';
                }
                else
                {
                    htc8 += '<tr>';
                    htc8 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc8 +=  "<td style='text-align: center; font-size: 9px'> - </td>";
                    htc8 += '</tr>';

                    htc8 += '<tr>';
                    htc8 +=  "<td style='text-align: center; font-size: 9px'><b>JUMLAH</></td>";
                    htc8 +=  "<td style='text-align: center; font-size: 9px'><b>0</b></td>";
                    htc8 += '</tr>';
                }

                $("#table-chart8").html(htc8);
            }
        });
        // end getchart8 -------------------------------------------------------------------
    }

    function getBarStatusMilik(arr_data, arr_status, lengthdata) 
    {
        var ctx = $("#myBarChart");

        function getRandomColorEachDatamyBarChart(count) 
        {
            var data = [];
            var arr_color = [ 
                 ["#16747E", "#97AB38"
                    ],

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
                     overBackgroundColor:"rgb(177, 182, 42)",
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
    };

    function mukim(id) 
    {
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
    };
</script> 

<script type="text/javascript">
    
    $('#modalchart8').click(function() {
        $('#modalcharteighth').modal(
        {
            blurring: true
        }).modal('show')
    });


</script>