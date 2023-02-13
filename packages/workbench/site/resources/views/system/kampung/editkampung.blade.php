@extends('laravolt::layout.app2')

@section('content')


<style type="text/css">
  input[type=file]::-webkit-file-upload-button {
    visibility: hidden;
  }

  .file {
    position: relative;
    height: 30px;
    width: 100px;
  }

  .file > input[type="file"] {
    position: absoulte;
    opacity: 0;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0
  }

  .file > label {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    background-color: #666;
    color: #fff;
    line-height: 30px;
    text-align: center;
    cursor: pointer;
  }
</style>

<style>
  img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 150px;
  }

  img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
  }
</style>



<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0">
  <div class="column middle aligned">
    <h3 class="ui header m-t-xs">
      Kemaskini Kampung
    </h3>
  </div>
  <div class="column right aligned middle aligned">

    <a class="ui button" href="{!! URL::to('site/kampung/index') !!}" id="backbutton">Kembali</a>


  </div>
</div>
<br>
<div class="ui attached segment" id="loading" style="display: none;">
  <div class="ui blue sliding indeterminate progress">
    <div class="bar">
      <div class="progress">Sila Tunggu Sebentar</div>
    </div>
  </div>
</div>

<br>
<h4 class="ui top attached header">
  Kemaskini Kampung
</h4>
<div class="ui attached segment">
  {!! form()->open()->post()->action(route('site::kampung.saveeditkampung'))->attribute('id', 'formstruk')->multipart()->horizontal() !!}

  <input type="hidden" name="idkampung" id="idkampung" value="{{$id}}">


  <div class="field">
    <label>Daerah<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown pilihdaerah">
      <input type="hidden" name="daerah" id="daerah" value="{{ data_get($kampung,'daerah.id') }}">
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

  <div class="field" id="diveditmukim">
    <label>Mukim<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown">
      <input type="hidden" name="mukimedit" id="mukimedit" value="{{ data_get($kampung,'mukim.id') }}">
      <i class="dropdown icon"></i>
      <div class="default text" id="pilihmukimedit">Sila Pilih</div>
      <div class="menu" id="selectmukimedit">
        <div class="item" data-value="" onclick="pilihmukim(0)">Sila Pilih</div>
        @foreach($mukimedit as $key => $value)
        <div class="item" data-value="{{$value->id}}" onclick="pilihmukim({{$value->id}})">{{$value->NamaMukim}}</div>
        @endforeach

      </div>
    </div>
  </div>
  <div class="field" id="divmukim">
    <label>Mukim<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown pilihmukim">
      <input type="hidden" name="mukim" id="mukim" value="">
      <i class="dropdown icon"></i>
      <div class="default text" id="pilihmukim">Sila Pilih</div>
      <div class="menu" id="selectmukim">

      </div>
    </div>
  </div>
  <div class="field">
    <label>Parlimen<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown pilihparlimen">
      <input type="hidden" name="parlimen" id="parlimen" value="{{ data_get($kampung,'parlimen.id') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
      <i class="dropdown icon"></i>
      <div class="default text" id="pilihparlimen">Sila Pilih</div>
      <div class="menu" id="selectparlimen">
        <div class="item" data-value="" onclick="dun(0)" >Sila Pilih</div>
        @foreach($parlimen as $key => $value)
        <div class="item" data-value="{{$value->id}}" onclick="dun({{$value->id}})">{{$value->NamaParlimen}}</div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="field" id="diveditdun">
    <label>Dun<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown pilihdunedit">
      <input type="hidden" name="dunedit" id="dunedit" value="{{ data_get($kampung,'dun.id') }}">
      <i class="dropdown icon"></i>
      <div class="default text" id="pilihdunedit">Sila Pilih</div>
      <div class="menu" id="selectdunedit">
        <div class="item" data-value="">Sila Pilih</div>
        @foreach($dunedit as $key => $value)
        <div class="item" data-value="{{$value->id}}" data-text="{{$value->NamaDun}}" onclick="sdun()">
          {{$value->NamaDun}}
        </div>
        @endforeach

      </div>

    </div>
  </div>
  <div class="field" id="divdun">
    <label>Dun<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown pilihdun2">
      <input type="hidden" name="dun" id="dun">
      <i class="dropdown icon"></i>
      <div class="default text" id="pilihdun">Sila Pilih</div>
      <div class="menu" id="selectdun">

      </div>

    </div>
  </div>
  <div class="field">
    <label>Kategori Petempatan<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown pilihcat">
      <input type="hidden" name="cat" id="cat" value="{{ data_get($kampung,'catpetempatan.id') }}">
      <i class="dropdown icon"></i>
      <div class="default text">Sila Pilih</div>
      <div class="menu">
        <div class="item" data-value="" onclick="typetradisional(0)">Sila Pilih</div>
        @foreach($catpenempatan as $key => $value)
        <div class="item" data-value="{{$value->id}}" onclick="typetradisional({{$value->id}})">{{$value->description}}</div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="field" id="divkgtradisional">
    <label>Jenis Kampung Tradisional<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown trad">
      <input type="hidden" name="kgtradisional" id="kgtradisional" value="{{ data_get($kampung,'kgtradisonal.id') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
      <i class="dropdown icon"></i>
      <div class="default text">Sila Pilih</div>
      <div class="menu">
        <div class="item" data-value="" onclick="induk(0)">Sila Pilih</div>
        @foreach($jeniskampung as $key => $value)
        <div class="item" data-value="{{$value->id}}" onclick="induk({{$value->id}})">{{$value->description}}</div>
        @endforeach
      </div>
    </div>
  </div>
   <div class="field" id="diveditinduk">
    <label>Nama Kampung Induk<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown pilihindukedit">
      <input type="hidden" name="indukedit" id="indukedit" value="{{ data_get($kampung,'IdKampungInduk') }}">
      <i class="dropdown icon"></i>
      <div class="default text" id="pilihdindukedit">Sila Pilih</div>
      <div class="menu" id="selectindukedit">
        <div class="item" data-value="">Sila Pilih</div>
        @foreach($indukedit as $key => $value)
        <div class="item" data-value="{{$value->id}}" data-text="{{$value->NamaKampung}}">
          {{$value->NamaKampung}}
        </div>
        @endforeach

      </div>

    </div>
  </div>
  <div class="field" id="divinduk">
    <label>Nama Kampung Induk<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown namainduk">
      <input type="hidden" name="kginduk" id="kginduk" value="">
      <i class="dropdown icon"></i>
      <div class="default text" id="pilihinduk">Sila Pilih</div>
      <div class="menu" id="selectinduk">
      </div>
    </div>
  </div>
  <div class="field" id="divnamakampung">
    <label>Nama Kampung<font color="red">*</font></label>
    <input type="text" name="namakampung" id="namakampung" required="required" value="{{ old('namakampung') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field" id="divnamakampungedit">
    <label>Nama Kampung<font color="red">*</font></label>
    <input type="text" name="namakampungedit" id="namakampungedit" required="required" value="{{ data_get($kampung,'NamaKampung') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field" id="divnamataman">
    <label>Nama Taman<font color="red">*</font></label>
    <input type="text" name="namataman" id="namataman" required="required" value="{{ data_get($kampung,'NamaKampung') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field" id="divnamatamanedit">
    <label>Nama Taman<font color="red">*</font></label>
    <input type="text" name="namatamanedit" id="namatamanedit" required="required" value="{{ data_get($kampung,'NamaKampung') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field" id="divnamaserata">
    <label>Nama Serata<font color="red">*</font></label>
    <input type="text" name="namaserata" id="namaserata" required="required" value="{{ data_get($kampung,'NamaKampung') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field" id="divnamaserataedit">
    <label>Nama Serata<font color="red">*</font></label>
    <input type="text" name="namaserataedit" id="namaserataedit" required="required" value="{{ data_get($kampung,'NamaKampung') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Nama JPKK <font color="red">*</font></label>
    <input type="text" name="namajpkk" id="namajpkk" required="required" value="{{ data_get($kampung,'NamaJPKK') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Alamat Surat Menyurat JPKK<font color="red">*</font></label>
    <input type="text" name="alamatjpkk" id="alamatjpkk" required="required" value="{{ data_get($kampung,'AlamatJPKK') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Status<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown">
      <input type="hidden" name="status" id="status" required="required" value="{{ data_get($kampung,'status') }}">
      <i class="dropdown icon"></i>
      <div class="default text">Sila Pilih</div>
      <div class="menu">
        <div class="item" data-value="">Sila Pilih</div>
        <div class="item" data-value="1">Aktif</div>
        <div class="item" data-value="0">Tidak Aktif</div>
      </div>
    </div>
  </div>
 <div class="field">
    <label>Url GIS<font color="red">*</font></label>
    <input type="text" name="urlgis" id="urlgis" value="{{ data_get($kampung,'url_gis') }}">

  </div>
  <div class="field">
    <label>&nbsp;</label>
     Note: https://mygdispatial.perak.gov.my/server/rest/services/ePerak/*Kg_Parit_Lebai_Kadir*/MapServer   
     <br>Hanya masukkan keyword "Kg_Parit_Lebai_Kadir" sahaja
  </div>

  <!--   <div class="ui divider section"></div>
      <div align="right">
                <label>&nbsp;</label>
             
                <a class="ui button"onclick="getLocation()" >Lokasi Semasa</a>
        </div>
        <br>
        <div class="field">
                <label>Latitud<font color="red">*</font></label>
                <input type="text" name="Latitud" id="Latitud" required="required" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " value="{{ data_get($kampung,'Latitud') }}">
       </div>
        <div class="field">
                <label>Longitud<font color="red">*</font></label>
                <input type="text" name="Longitud" id="Longitud" required="required" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " value="{{ data_get($kampung,'Longitud') }}">
        </div>
 -->


  <div class="ui divider section"></div>
  <div align="right">
    <button type="submit" class="ui button primary" id="addbutton" name="addbutton" onclick="return validatekampung();">
      Simpan
    </button>
  </div>


  {!! form()->close() !!}
</div>

@endsection
@push('script')
<script type="text/javascript">
  $(document).ready(function() {

   // $('#induk').hide();
    $('#divkgtradisional').hide();
    $('#divnamakampung').hide();
    $('#divnamaserata').hide();
    $('#divnamataman').hide();
    $('#divdun').hide();
    $('#divmukim').hide();
    $('#divinduk').hide();

    $('#namakampung').prop('required', false);
    $('#namaserata').prop('required', false);
    $('#namataman').prop('required', false);

    var cat = "{{data_get($kampung,'catpetempatan.id')}}";

    typetradisionaledit(cat);


    var jeiniskgtradisional="{{ data_get($kampung,'kgtradisonal.id') }}";
    var katpetempatan="{{ data_get($kampung,'KategoriPetempatan') }}";

      if (jeiniskgtradisional == 148) {


       $('#induk').show();
       // $('#divnamakampungedit').hide();
       // $('#namakampungedit').prop('required', false);
      var parlimen = "{{ data_get($kampung,'fk_parlimen') }}";
      var dun = "{{ data_get($kampung,'fk_dun') }}";
      var daerah = "{{ data_get($kampung,'fk_daerah') }}";
      var mukim = "{{ data_get($kampung,'fk_mukim') }}";





      if (parlimen == '') {
        valparlimen = 0;
      } else {
        valparlimen = parlimen;
      }

      var dun = dun;

      if (dun == '') {
        valdun = 0;
      } else {
        valdun = dun;

      }
      var daerah = daerah;

      if (daerah == '') {
        valdaerah = 0;
      } else {
        valdaerah = daerah;

      }
      var mukim = mukim;

      if (mukim == '') {
        valmukim = 0;
      } else {
        valmukim = mukim;

      }


      $.ajax({
        type: "GET",
        url: "{{ URL::to('site/induk/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim,
        datatype: 'json',

        beforeSend: function() {
          //$('div.text').html('Sila Pilih');
          document.getElementById("pilihinduk").innerHTML = "Sila Pilih";
          $('#selectinduk').html('');
          $('#loading').show();
          $('#result2').hide();


        },

        success: function(data) {



          $('#loading').hide();
          $('#selectinduk').html(data);







        }


      });




    } else {
      $('#induk').hide();

      if(katpetempatan==7){//taman
      $('#divnamatamanedit').show();
      $('#namatamanedit').prop('required', true);

      }else if(katpetempatan==8){//serata

      $('#divnamaserataedit').show();
      $('#namaserataedit').prop('required', true);

      }else{
      $('#divnamakampungedit').show();
      $('#namakampungedit').prop('required', true);
      }

    }



  });

  function validatekampung() {


    var parlimen = document.getElementById("parlimen").value; // added .value

    if ($('#divdun').is(':visible') == true) {
      var dun = document.getElementById("dun").value; // added .value

    } else {
      var dun = document.getElementById("dunedit").value; // added .value

    }


    var daerah = document.getElementById("daerah").value; // added .value

    if ($('#divmukim').is(':visible') == true) {
      var mukim = document.getElementById("mukim").value; // added .value
    } else {
      var mukim = document.getElementById("mukimedit").value; // added .value

    }

    if ($('#divinduk').is(':visible') == true) {
      var kginduk = document.getElementById("kginduk").value; // added .value

    } else {
      var kginduk = document.getElementById("indukedit").value; // added .value

    }

    var cat = document.getElementById("cat").value; // added .value
    var kgtradisional = document.getElementById("kgtradisional").value; // added .value
    //var kginduk = document.getElementById("kginduk").value; // added .value
    var status = document.getElementById("status").value; // added .value





    if (parlimen === '' || parlimen === null) {
      alert('Sila masukan Parlimen');
      return false;

    } else {

      if (dun === '' || dun === null) {
        alert('Sila masukan Dun');
        return false;

      } else {

        if (daerah === '' || daerah === null) {
          alert('Sila masukan Daerah');
          return false;

        } else {

          if (mukim === '' || mukim === null) {
            alert('Sila masukan Mukim');
            return false;

          } else {

            if (cat === '' || cat === null) {
              alert('Sila masukan Kategori Penempatan');
              return false;

            } else {



              if (cat == 4) { //kampung tradisonal

                if (kgtradisional === '' || kgtradisional === null) {

                  alert('Sila masukan Jenis Kampung Tradisional');
                  return false;

                } else {

                  if (kgtradisional == 148) { //kmapung rangkain

                    if (kginduk === '' || kginduk === null) {

                      alert('Sila masukan Induk');

                      return false
                    } else {

                      if (status === '' || status === null) {
                        alert('Sila masukan Status');
                        return false;

                      } else {


                        return true;

                      }

                    }


                  } else {
                    if (status === '' || status === null) {
                      alert('Sila masukan Status');
                      return false;

                    } else {


                      return true;

                    }


                  }

                  if (status === '' || status === null) {
                    alert('Sila masukan Status');
                    return false;

                  } else {


                    return true;

                  }


                }

              } else {


                if (cat == 7 || cat == 8) {

                  $('#namakampungedit').prop('required', false);
                  $('#namakampung').prop('required', false);

                } else {

                  if (status === '' || status === null) {
                    alert('Sila masukan Status');
                    return false;

                  } else {


                    return true;

                  }

                }


              }




            }



          }

        }

      }

    }







  }

  function dun(id) {


    $('.pilihdun2').dropdown('set selected', '');
    // $('.pilihdaerah').dropdown('set selected', '');
    // $('.pilihmukim').dropdown('set selected', '');
    $('.pilihcat').dropdown('set selected', '');
    $('#divkgtradisional').hide();
    $('#divnamakampung').hide();
    $('#divnamakampungedit').hide();

    $('#induk').hide();
    $('.trad').dropdown('set selected', '');
    $('#diveditdun').hide();
    $('#divdun').show();
    // $('#divmukim').show();
    // $('#diveditmukim').hide();

    $.ajax({
      type: "GET",
      url: "{{ URL::to('site/dun/')}}" + "/" + id,
      datatype: 'json',

      beforeSend: function() {
        document.getElementById("pilihdun").innerHTML = "Sila Pilih";
        $('#selectdun').html('');
        $('#loading').show();
        $('#result2').hide();


      },

      success: function(data) {

        $('#loading').hide();
        $('#selectdun').html(data);
        $('.pilihdun2').dropdown('set selected', '34');


      }


    });
  };

  function mukim(id) {

    $('.pilihdaerah').dropdown('set selected', '');
    $('.pilihmukim').dropdown('set selected', '');
    $('.pilihparlimen').dropdown('set selected', '');
    $('.pilihdun').dropdown('set selected', '');
    $('.pilihcat').dropdown('set selected', '');
    $('#divkgtradisional').hide();
    $('#divnamakampung').hide();
    $('#divnamakampungedit').hide();
    $('#induk').hide();
    $('.trad').dropdown('set selected', '');
    $('#divmukim').show();
    $('#diveditmukim').hide();
    $('.pilihdun2').dropdown('set selected', '');
    $('#selectdun').html('');
    $('.pilihdunedit').dropdown('set selected', '');
    $('#selectdunedit').html('');



    $.ajax({
      type: "GET",
      url: "{{ URL::to('site/mukim/')}}" + "/" + id,
      datatype: 'json',

      beforeSend: function() {
        //$('div.text').html('Sila Pilih');
        document.getElementById("pilihmukim").innerHTML = "Sila Pilih";
        $('#selectmukim').html('');
        $('#loading').show();
        $('#result2').hide();


      },

      success: function(data) {

        $('#loading').hide();
        $('#selectmukim').html(data);


      }


    });







  };

  function pilihmukim(id) {

    $('.pilihcat').dropdown('set selected', '');
    $('#divkgtradisional').hide();
    $('#induk').hide();
    $('.trad').dropdown('set selected', '');
    $('.pilihparlimen').dropdown('set selected', '');
    $('.pilihdun2').dropdown('set selected', '');
    $('#selectdun').html('');
    $('.pilihdunedit').dropdown('set selected', '');
    $('#selectdunedit').html('');


  }

  function typetradisional(id) {

    $('#divnamakampungedit').hide();
    $('#divnamaserataedit').hide();
    $('#divnamatamanedit').hide();
    $('#divkgtradisional').hide();

    $('#namaserataedit').prop('required', false);
    $('#namatamanedit').prop('required', false);
    $('#namakampungedit').prop('required', false);


    if (id == 4) { //kampung tradisional
      $('#divkgtradisional').show();
      $('#divnamakampung').show();
      $('#divnamaserata').hide();
      $('#divnamataman').hide();

      $('#namaserata').prop('required', false);
      $('#namataman').prop('required', false);
      $('#namakampung').prop('required', true);



    } else {

      if (id == 0) {

        $('#divnamakampung').hide();
        $('#divnamaserata').hide();
        $('#divnamataman').hide();
        $('#divkgtradisional').hide();

        $('#namaserata').prop('required', false);
        $('#namataman').prop('required', false);
        $('#namakampung').prop('required', false);




      } else {

        if (id == 5 || id == 6 || id == 9) { //tersusun baru orang asli
          $('#divnamakampung').show();
          $('#divnamaserata').hide();
          $('#divnamataman').hide();
          $('#namaserata').prop('required', false);
          $('#namataman').prop('required', false);
          $('#namakampung').prop('required', true);
        } else {

          if (id == 8) { //serata
            $('#divnamaserata').show();
            $('#divnamataman').hide();
            $('#namataman').prop('required', false);
            $('#namakampung').prop('required', false);



          } else { //taman
            $('#divnamataman').show();
            $('#divnamaserata').hide();
            $('#namakampung').prop('required', false);
            $('#namaserata').prop('required', false);

          }
          $('#divnamakampung').hide();



        }

        $('#divkgtradisional').hide();
        $('#induk').hide();
        $('.trad').dropdown('set selected', '');



      }



    }


    var parlimen = $('#parlimen').val();


  };

  function typetradisionaledit(id) {



    if (id == 4) { //kampung tradisional
      $('#divkgtradisional').show();
      $('#divnamakampung').hide();
      $('#divnamakampungedit').show();

      $('#divnamaserataedit').hide();
      $('#divnamatamanedit').hide();

      $('#namaserataedit').prop('required', false);
      $('#namatamanedit').prop('required', false);
      $('#namakampungedit').prop('required', true);


    } else {

      if (id == 0) {

        $('#divnamakampungedit').hide();
        $('#divnamaserataedit').hide();
        $('#divnamatamanedit').hide();
        $('#divkgtradisionaledit').hide();

        $('#namaserataedit').prop('required', false);
        $('#namatamanedit').prop('required', false);
        $('#namakampungedit').prop('required', false);


      } else {

        if (id == 5 || id == 6 || id == 9) { //tersusun baru orang asli

          $('#divnamakampungedit').show();
          $('#divnamaserataedit').hide();
          $('#divnamatamanedit').hide();
          $('#namaserataedit').prop('required', false);
          $('#namatamanedit').prop('required', false);
          $('#namakampungedit').prop('required', true);

        } else {



          if (id == 8) { //serata
            $('#divnamaserataedit').show();
            $('#divnamatamanedit').hide();
            $('#divnamakampungedit').hide();
            $('#namatamanedit').prop('required', false);
            $('#namakampungedit').prop('required', false);


          } else { //taman
            $('#divnamatamanedit').show();
            $('#divnamaserataedit').hide();
            $('#namakampungedit').prop('required', false);
            $('#divnamakampungedit').hide();
            $('#namaserataedit').prop('required', false);

          }
          $('#divnamakampung').hide();
          $('#divnamakampungedit').hide();



        }

        $('#divkgtradisional').hide();
        // $('#induk').hide();
        $('.trad').dropdown('set selected', '');



      }



    }




    var parlimen = $('#parlimen').val();


  };
  function sdun(){

    $('#divkgtradisional').hide();
    $('#divnamakampung').hide();
    $('#divnamakampungedit').hide();
    $('.pilihcat').dropdown('set selected', '');

    $('#induk').hide();
    $('.trad').dropdown('set selected', '');


  };


  function induk(id) {


    if (id == 148) {
      $('#induk').show();
     


      var parlimen = $('#parlimen').val();
      //var dun = $('#dun').val();
      var daerah = $('#daerah').val();
     // var mukim = $('#mukim').val();
      var catpenempatan = $('#mukim').val();

      if ($('#divdun').is(':visible') == true) {
      var dun = document.getElementById("dun").value; // added .value

    } else {
      var dun = document.getElementById("dunedit").value; // added .value

    }


   
    if ($('#divmukim').is(':visible') == true) {
      var mukim = document.getElementById("mukim").value; // added .value
    } else {
      var mukim = document.getElementById("mukimedit").value; // added .value

    }




      if (parlimen == '') {
        valparlimen = 0;
      } else {
        valparlimen = parlimen;
      }

      var dun = dun;

      if (dun == '') {
        valdun = 0;
      } else {
        valdun = dun;

      }
      var daerah = $('#daerah').val();

      if (daerah == '') {
        valdaerah = 0;
      } else {
        valdaerah = daerah;

      }
      var mukim = mukim;

      if (mukim == '') {
        valmukim = 0;
      } else {
        valmukim = mukim;

      }


      $.ajax({
        type: "GET",
        url: "{{ URL::to('site/induk/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim,
        datatype: 'json',

        beforeSend: function() {
          //$('div.text').html('Sila Pilih');
          document.getElementById("pilihinduk").innerHTML = "Sila Pilih";
          $('#selectinduk').html('');
          $('#loading').show();
          $('#result2').hide();


        },

        success: function(data) {

          $('#loading').hide();
          $('#selectinduk').html(data);






        }


      });




    } else {
      $('#induk').hide();
     

    }



  };
</script>

@endpush