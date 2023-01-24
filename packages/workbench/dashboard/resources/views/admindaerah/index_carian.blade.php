@extends('laravolt::layout.app_top')

@section('content')
<style type="text/css">
    /*canvas{
    width:480px !important;
    height:200px !important;
    }*/
    .graph_container {
        display: block;
        width: 600px;
    }

    .wrapper {
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

</style>

<div id="divaccordion">
    <div class="column middle aligned">
        <center>
            <h2 class="ui header m-t-xs" style="text-shadow: rgb(0 0 0) 2px 2px;font-size: 40px"> DASHBOARD PENTADBIR DAERAH {{data_get($daerah,'NamaDaerah')}} </h2>
        </center>
    </div>
    <div class="ui container-fluid content__body p-3">
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
            
            <div class="card" onclick="javascript:;">
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

    <div class="ui container-fluid content__body p-3" id="loading" style="display: none;">
        <div class="ui segments panel">
            <div class="ui segment p-3">
                <div class="ui blue sliding indeterminate progress">
                    <div class="bar">
                        <div class="progress">Sila Tunggu Sebentar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ui one column grid content__body" id="divtitle" style="margin-top: -80px; display: none">
    <div class="column middle aligned">
        <center>
            <h3 class="">
                LAPORAN STATISTIK PENDUDUK DAERAH {{ $daerah->NamaDaerah }}
            </h3>
        </center>
    </div>
</div>

<div class="tab-content p-3 raised" id="contentstatistic">
    <div class="ui styled fluid accordion">
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
                            <div class="ui fluid search selection dropdown">
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

                <div class="ui divider section" id="divaccordion"></div>

                <div class="ui buttons right floated" id="divaccordion">
                    <a class="ui button" href="{!! URL::to('dashboard/admin') !!}">SET SEMULA</a>
                    <div class="or" data-text="@"></div>
                    <button class="ui button primary" onclick="search()" id="addbutton"> CARIAN </button>
                    <div class="or" data-text="@"></div>
                    <a href="javascript:;"  class="ui red button"  onclick="pdfclick()"   title="PDF">&nbsp;CETAK&nbsp;</a>
                </div>

                <div id="divaccordion">
                    <br/><br/>
                </div>
            
        </div>
    </div>

    <div class="ui container-fluid content__body" id="result3" style="display: none; padding: 2rem 0rem">
        <!-- <div class="ui segments panel"> -->
            <div class="" id="resultcountpetempatan"></div>
        <!-- </div> -->
    </div>

    <div class="ui container-fluid content__body" id="result4" style="padding: 1rem 0rem">

    </div>
</div>

@endsection

@push('script')
<script type="text/javascript">

    function showmap() 
    {
        $('#loading').show();
        $('#contentstatistic').hide();

        window.location.href = "/location/admindaerah";
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
@endpush