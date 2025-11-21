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
    <h3 class="ui header m-t-xs" style="color:black">
      Kemaskini Ahli Parlimen
    </h3>
  </div>
  <div class="column right aligned middle aligned">

    <a class="ui button" href="{!! URL::to('site/parlimen/index') !!}" id="backbutton">Kembali</a>


  </div>
</div>
<br>
<h4 class="ui top attached header">
  Kemaskini Ahli Parlimen
</h4>
<div class="ui attached segment">
  {!! form()->open()->post()->action(route('site::parlimen.saveeditparlimen'))->attribute('id', 'formstruk')->multipart()->horizontal() !!}
  <input type="hidden" name="idparlimen" id="idparlimen" value="{{$id}}">

  <?php $this_year = date("Y");
// Run this only once
?>

  <div class="field">
    <label>Tahun<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown">
      <input type="hidden" name="tahun" id="tahun" value="{{ data_get($parlimen,'tahun') }}">
      <i class="dropdown icon"></i>
      <div class="default text">Sila Pilih</div>
      <div class="menu">
        <div class="item" data-value="">Sila Pilih</div>
        <?php for ($year = $this_year - 20; $year <= $this_year; $year++) { ?>
        <?php echo '<div class="item" data-value="' .
        $year .
        '">' .
        $year .
        "</div>"; ?>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="field">
    <label>Kod Parlimen<font color="red">*</font></label>
    <input type="text" name="kod" id="kod" required="required" value="{{ data_get($parlimen,'KodParlimen') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Nama Parlimen<font color="red">*</font></label>
    <input type="text" name="nama" id="nama" required="required" value="{{ data_get($parlimen,'NamaParlimen') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Parti<font color="red">*</font></label>
    <input type="text" name="parti" id="parti" required="required" value="{{ data_get($parlimen,'Parti') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Ahli Parlimen<font color="red">*</font></label>
    <input type="text" name="ahli" id="ahli" required="required" value="{{ data_get($parlimen,'AhliParlimen') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Jawatan<font color="red">*</font></label>
    <input type="text" name="jawatan" id="jawatan" required="required" value="{{ data_get($parlimen,'Jawatan') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
  </div>
  <div class="field">
    <label>Alamat Pejabat<font color="red">*</font></label>
    <input type="text" name="alamat" id="alamat" required="required" value="{{ data_get($parlimen,'AlamatPejabat') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>No Tel. Pejabat<font color="red">*</font>(Sila masukkan format nombor sahaja. Tanpa "-" atau jarak. Contoh: 0123456789))</label>
    <input type="text" name="notel" id="notel" required="required" value="{{ data_get($parlimen,'TelNo') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value=this.value.replace(/[^\d]/,'')" onKeyPress="if(this.value.length==12) return false;">
  </div>
  <div class="field">
    <label>Faksimili<font color="red">*</font>(Sila masukkan format nombor sahaja. Tanpa "-" atau jarak. Contoh: 0123456789))</label>
    <input type="text" name="faks" id="faks" required="required" value="{{ data_get($parlimen,'Faks') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value=this.value.replace(/[^\d]/,'')" onKeyPress="if(this.value.length==12) return false;">
  </div>
  <div class="field">
    <label>Emel<font color="red">*</font></label>
    <input type="text" name="email" id="email" required="required" value="{{ data_get($parlimen,'Email') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
  </div>
  <div class="field">
    <label>Status<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown">
      <input type="hidden" name="status" id="status" required="required" value="{{ data_get($parlimen,'Status') }}">
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
    <label>Gambar<font color="red">*</font></label>
    <button type="button" style="display:block;width:20px; height:40px;" onclick="document.getElementById('getFile_tstrukorg').click()">Pilih Fail</button>
    <input type='file' id="getFile_tstrukorg" name="gambar" value="{{ old('gambar') }}" style="width: 700px;height: 40px;">

  </div>
  <div class="field">
    <label>&nbsp;</label>
    <b>
      <font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan
    </b>
  </div>
  <div class="field" id="divpreview">
    <label>Preview</label>
    <a target="_blank"><img style="width:200px" id="blah">
    </a>

  </div>

  <div class="field">
    <label>&nbsp;</label>
    @if(data_get($parlimen,'Gambar_path')=='')
    <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
    </a>
    @elseif(file_exists(public_path (data_get($parlimen,'Gambar_path'))))
    <a target="_blank" href="{!! URL::to(data_get($parlimen,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($parlimen,'Gambar_path')) !!}" alt="ePerak" style="width:200px">
    </a>
    @else
    <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
    </a>
    @endif
  </div>
  <div class="ui divider section"></div>
  <div align="right">
    <button type="submit" class="ui button primary" id="addbutton" name="addbutton" onclick="return validateparlimen();">
      Simpan
    </button>
    <a onclick="return confirm('Adakah anda pasti untuk hapus?');" href="{!! URL::to('site/parlimen/deleteparlimen/'.data_get($parlimen,'id')) !!}" data-tooltip="Padam" data-position="bottom center">
    <button class="ui red button" type="button">Padam</button></a>
  </div>


  {!! form()->close() !!}
</div>

@endsection
@push('script')
<script type="text/javascript">
  $(document).ready(function()

    {


      $("#divpreview").hide();
      $("input[id=getFile_tstrukorg]").change(function() {

        filename = this.files[0].name;


        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        if (!allowedExtensions.exec(filename)) {



          alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')


          var icon = "error";
          $("#divpreview").hide();
          $("input[id=getFile_tstrukorg]").val("");
          return false;
        }


        const fileSize = this.files[0].size / 1024 / 1024; // in MiB

        if (fileSize > 3) {
          alert('Saiz fail melebihi 3 MB')

          var icon = "error";
          //alertSwal(text,icon);
          // alert('File size exceeds 10 MiB');
          $("#divpreview").hide();
          $("input[id=getFile_tstrukorg]").val("");
          return false;

        }


      });

      getFile_tstrukorg.onchange = evt => {

        const [file] = getFile_tstrukorg.files
        if (file) {
          $("#divpreview").show();
          blah.src = URL.createObjectURL(file)
        }
      }


    });

  function validateparlimen() {

    var tahun = document.getElementById("tahun").value; // added .value
    var status = document.getElementById("status").value; // added .value
    var gambar = document.getElementById("getFile").value; // 

    if (tahun === '' || tahun === null) {

      //alert('yyy');
      alert('Sila masukan Tahun');
      return false;

    } else {

      if (status === '' || status === null) {
        alert('Sila masukan Status');
        return false;

      } else {


        var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        var emel = document.getElementById("email").value;
        if (email_reg.test(emel) == false) {

          alert('Sila Masukan alamat Emel yang betul');
          return false;
        } else {

          // if (gambar === '' || gambar === null) {
          //   alert('Sila masukan Gambar');
          //   return false;
          // } else {

            return true;
          //}
        }


      }

    }


  }
</script>

@endpush