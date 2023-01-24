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
      Kemaskini Daerah
    </h3>
  </div>
  <div class="column right aligned middle aligned">

    <a class="ui button" href="{!! URL::to('site/daerah/index') !!}" id="backbutton">Kembali</a>


  </div>
</div>
<br>
<h4 class="ui top attached header">
  Kemaskini Daerah
</h4>
<div class="ui attached segment">
  {!! form()->open()->post()->action(route('site::daerah.saveeditdaerah'))->attribute('id', 'formstruk')->multipart()->horizontal() !!}
  <input type="hidden" name="iddaerah" id="iddaerah" value="{{$id}}">

  <div class="field">
    <label>Kod Daerah<font color="red">*</font></label>
    <input type="text" name="kod" id="kod" required="required" value="{{ data_get($daerah,'KodDaerah') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Nama Daerah<font color="red">*</font></label>
    <input type="text" name="nama" id="nama" required="required" value="{{ data_get($daerah,'NamaDaerah') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Nama Pegawai Daerah<font color="red">*</font></label>
    <input type="text" name="namapegawai" id="namapegawai" required="required" value="{{ data_get($daerah,'NamaPegawaiDaerah') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>

  <div class="field">
    <label>Status<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown">
      <input type="hidden" name="status" id="status" required="required" value="{{ data_get($daerah,'Status') }}">
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
    <input type="text" name="urlgis" id="urlgis" value="{{ data_get($daerah,'url_gis') }}">
  </div>
   <div class="field">
    <label>&nbsp;</label>
    https://mygdispatial.perak.gov.my/server/rest/services/ePerak/*Kerian*/MapServer
    Hanya masukkan keyword "Kerian" sahaja
  </div>
  <div class="ui divider section"></div>
  <div align="right">
    <button type="submit" class="ui button primary" id="addbutton" name="addbutton" onclick="return validatedaerah();">
      Simpan
    </button>
  </div>


  {!! form()->close() !!}
</div>

@endsection
@push('script')
<script type="text/javascript">
  $(document).ready(function() {



  });

  function validatedaerah() {

    var status = document.getElementById("status").value; // added .value

    if (status === '' || status === null) {
      alert('Sila masukan Status');
      return false;

    } else {
      return true;

    }


  }
</script>

@endpush