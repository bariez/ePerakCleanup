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
      Tambah Kampung
    </h3>
  </div>
  <div class="column right aligned middle aligned">

    <a class="ui button" onclick="getLocation()" href="{!! URL::to('site/kampung/index') !!}" id="backbutton">Kembali</a>


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
  Tambah Kampung
</h4>

<div class="ui attached segment">
  {!! form()->open()->post()->action(route('site::kampung.savekampung'))->attribute('id', 'formstruk')->multipart()->horizontal() !!}


  <div class="field">
    <label>Daerah<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown pilihdaerah">
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
      <input type="hidden" name="parlimen" id="parlimen" value="{{ old('parlimen') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
      <i class="dropdown icon"></i>
      <div class="default text">Sila Pilih</div>
      <div class="menu" id="selectparlimen">
        <div class="item" data-value="" onclick="dun(0)">Sila Pilih</div>
        @foreach($parlimen as $key => $value)
        <div class="item" data-value="{{$value->id}}" onclick="dun({{$value->id}})">{{$value->NamaParlimen}}</div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="field">
    <label>Dun<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown pilihdun">
      <input type="hidden" name="dun" id="dun" value="">
      <i class="dropdown icon"></i>
      <div class="default text" id="pilihdun">Sila Pilih</div>
      <div class="menu" id="selectdun">
      </div>

    </div>
  </div>

  <div class="field">
    <label>Kategori Petempatan<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown pilihcat">
      <input type="hidden" name="cat" id="cat" value="" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
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
      <input type="hidden" name="kgtradisional" id="kgtradisional" value="" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
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
  <div class="field" id="induk">
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
  <div class="field" id="divnamataman">
    <label>Nama Taman<font color="red">*</font></label>
    <input type="text" name="namataman" id="namataman" required="required" value="{{ old('namataman') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field" id="divnamaserata">
    <label>Nama Serata<font color="red">*</font></label>
    <input type="text" name="namaserata" id="namaserata" required="required" value="{{ old('namaserata') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Nama JPKK <font color="red">*</font></label>
    <input type="text" name="namajpkk" id="namajpkk" required="required" value="{{ old('namajpkk') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Alamat Surat Menyurat JPKK<font color="red">*</font></label>
    <input type="text" name="alamatjpkk" id="alamatjpkk" required="required" value="{{ old('alamatjpkk') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Status<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown">
      <input type="hidden" name="status" id="status" required="required" value="{{ old('status') }}">
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
    <input type="text" name="urlgis" id="urlgis" value="{{ old('urlgis') }}">

  </div>
  <div class="field">
    <label>&nbsp;</label>
     Note: https://mygdispatial.perak.gov.my/server/rest/services/ePerak/*Kg_Parit_Lebai_Kadir*/MapServer   
     <br>Hanya masukkan keyword "Kg_Parit_Lebai_Kadir" sahaja
   
  </div>
  <!--             </div>
     <div class="ui divider section"></div>
      <div align="right">
                <label>&nbsp;</label>
              
                <a class="ui button"onclick="getLocation()" >Lokasi Semasa</a>
        </div>
        <br>
        <div class="field">
                <label>Latitud<font color="red">*</font></label>
                <input type="text" name="Latitud" id="Latitud" required="required" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
      </div>

        <div class="field">
                <label>Longitud<font color="red">*</font></label>
                <input type="text" name="Longitud" id="Longitud" required="required" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
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

    $('#induk').hide();
    $('#divkgtradisional').hide();
    $('#divnamakampung').hide();
    $('#divnamaserata').hide();
    $('#divnamataman').hide();


    $("input[id=getFile]").change(function() {

      filename = this.files[0].name;


      var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

      if (!allowedExtensions.exec(filename)) {



        alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')


        var icon = "error";
        $("input[id=getFile]").val("");
        return false;
      }


      const fileSize = this.files[0].size / 1024 / 1024; // in MiB

      if (fileSize > 3) {
        alert('Saiz fail melebihi 3 MB')

        var icon = "error";
        //alertSwal(text,icon);
        // alert('File size exceeds 10 MiB');
        $("input[id=getFile]").val("");
        return false;

      }


    });


  });

  function validatekampung() {


    var parlimen = document.getElementById("parlimen").value; // added .value
    var dun = document.getElementById("dun").value; // added .value
    var daerah = document.getElementById("daerah").value; // added .value
    var mukim = document.getElementById("mukim").value; // added .value
    var cat = document.getElementById("cat").value; // added .value
    var kgtradisional = document.getElementById("kgtradisional").value; // added .value
    var kginduk = document.getElementById("kginduk").value; // added .value
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

                      return false;
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

  function dun(id) {


    $('.pilihdun').dropdown('set selected', '');
    // $('.pilihdaerah').dropdown('set selected', '');
    // $('.pilihmukim').dropdown('set selected', '');
    $('.pilihcat').dropdown('set selected', '');
    $('#divkgtradisional').hide();
    $('#divnamakampung').hide();

    $('#induk').hide();
    $('.trad').dropdown('set selected', '');

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
    $('#induk').hide();
    $('.trad').dropdown('set selected', '');



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
    $('.pilihdun').dropdown('set selected', '');
     $('#selectdun').html('');


  }

  function typetradisional(id) {


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

          $('#divnamakampung').hide();

          if (id == 8) { //serata
            $('#divnamaserata').show();
            $('#divnamataman').hide();
            $('#namataman').prop('required', false);
            $('#namakampung').prop('required', false);
            $('#namaserata').prop('required', true);



          } else { //taman
            $('#divnamataman').show();
            $('#divnamaserata').hide();
            $('#namakampung').prop('required', false);
            $('#namaserata').prop('required', false);
            $('#namataman').prop('required', true);

          }
          



        }

        $('#divkgtradisional').hide();
        $('#induk').hide();
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
      var dun = $('#dun').val();
      var daerah = $('#daerah').val();
      var mukim = $('#mukim').val();
      var catpenempatan = $('#cat').val();



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
      var mukim = $('#mukim').val();

      if (mukim == '') {
        valmukim = 0;
      } else {
        valmukim = mukim;

      }

      var catpenempatan = $('#cat').val();

      if (catpenempatan == '') {
        valcatpenempatan = 0;
      } else {
        valcatpenempatan = catpenempatan;

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

  function getLocation() {


    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);

    } else {
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }

  function showPosition(position) {



    $('#Latitud').val(position.coords.latitude);
    $('#Longitud').val(position.coords.longitude);
    // x.innerHTML = "Latitude: " + position.coords.latitude + 
    // "<br>Longitude: " + position.coords.longitude;
  }
</script>

@endpush