@extends('laravolt::layout.app2')

@section('content')


<style type="text/css">
  
  input[type=file]::-webkit-file-upload-button {
    visibility: hidden;
  }

  .file { position: relative; height: 30px; width: 100px; }
.file > input[type="file"] { position: absoulte; opacity: 0; top: 0; left: 0; right: 0; bottom: 0 }
.file > label { position: absolute; top: 0; right: 0; left: 0; bottom: 0; background-color: #666; color: #fff; line-height: 30px; text-align: center; cursor: pointer; }
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



<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0" >
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs">
          Kemaskini Ahli Dun
        </h3>
    </div> 
    <div class="column right aligned middle aligned">

           <a class="ui button" href="{!! URL::to('site/dun/index') !!}" id="backbutton">Kembali</a>


    </div>
</div>
<br>
 <h4 class="ui top attached header">
Kemaskini Ahli Dun
</h4>
<div class="ui attached segment">
{!! form()->open()->post()->action(route('site::dun.saveeditdun'))->attribute('id', 'formstruk')->multipart()->horizontal() !!}
<input type="hidden" name="iddun" id="iddun" value="{{$id}}" >

    <?php $this_year = date("Y"); // Run this only once?>

         <div class="field">
            <label>Tahun<font color="red">*</font></label>
             <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="tahun" id="tahun" value="{{ data_get($dun,'tahun') }}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" >Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      <?php for ($year =  $this_year - 20; $year <= $this_year; $year++) {?>
                        <?php echo  '<div class="item" data-value="' . $year . '">' . $year . '</div>';?>
                      <?php }?>
                    </div>
                  </div>
          </div>
           <div class="field">
              <label>Nama Parlimen<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="parlimen" id="parlimen" value="{{ data_get($dun,'fk_parlimen') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($parlimen as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->NamaParlimen}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
           <div class="field">
            <label>Kod Dun<font color="red">*</font></label>
            <input type="text"  name="kod" id="kod" required="required" value="{{ data_get($dun,'KodDun') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
          </div>
          <div class="field">
            <label>Nama Dun<font color="red">*</font></label>
            <input type="text"  name="nama" id="nama" required="required" value="{{ data_get($dun,'NamaDun') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
          </div>
          <div class="field">
            <label>Parti<font color="red">*</font></label>
            <input type="text"  name="parti" id="parti" required="required" value="{{ data_get($dun,'Parti') }}"  onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
          </div>
           <div class="field">
            <label>Ahli Dun<font color="red">*</font></label>
            <input type="text"  name="ahli" id="ahli" required="required" value="{{ data_get($dun,'AhliDun') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
          </div>
          <div class="field">
            <label>Jawatan<font color="red">*</font></label>
            <input type="text"  name="jawatan" id="jawatan" value="{{ data_get($dun,'Jawatan') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();" required="required">
          </div>
           <div class="field">
            <label>Alamat Pejabat<font color="red">*</font></label>
            <input type="text"  name="alamat" id="alamat" value="{{ data_get($dun,'AlamatPejabat') }}" onkeyup="this.value = this.value.toUpperCase();" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required">
          </div>
          <div class="field">
            <label>No Tel. Pejabat<font color="red">*</font>(Sila masukkan format nombor sahaja. Tanpa "-" atau jarak. Contoh: 0123456789))</label>
            <input type="text"  name="notel" id="notel" value="{{ data_get($dun,'TelNo') }}" onkeyup="this.value=this.value.replace(/[^\d]/,'')" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required" onKeyPress="if(this.value.length==12) return false;">
          </div>
          <!--  <div class="field">
            <label>Faksimili</label>
            <input type="text"  name="faks" id="faks" value="{{ old('faks') }}"onkeyup="this.value=this.value.replace(/[^\d]/,'')">
          </div> -->
          <!-- <div class="field">
            <label>Email</label>
            <input type="text"  name="email" id="email"  value="{{ old('nama') }}">
          </div> -->
          <div class="field">
              <label>Status<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="status"  id="status" required="required" value="{{ data_get($dun,'status') }}">
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
              <label>Gambar</label>  
               <button type="button" style="display:block;width:20px; height:40px;" onclick="document.getElementById('getFile_tstrukorg').click()">Pilih Fail</button>
                 <input type='file' id="getFile_tstrukorg" name="gambar" value="{{ old('gambar') }}" style="width: 700px;height: 40px;">
              </div>
              <div class="field">
                 <label>&nbsp;</label>
                 <b><font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan</b>
              </div>
               <div class="field" id="divpreview">
                <label>Preview</label>
                 <a target="_blank"><img style="width:200px" id="blah">
              </a>
              </div>
              <div class="field">
              <label>&nbsp;</label>
             @if(data_get($dun,'Gambar_path')=='')
               <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
              </a>
              @elseif(file_exists(public_path (data_get($dun,'Gambar_path'))))
               <a target="_blank" href="{!! URL::to(data_get($dun,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($dun,'Gambar_path')) !!}" alt="ePerak" style="width:200px">
              </a>
              @else
              <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
              </a>                  
              @endif
    </div>
      <div class="ui divider section"></div>
            <div align="right">
                <button type="submit" class="ui button primary" id="addbutton" name="addbutton" onclick="return validatedun();">
                    Simpan
                </button>
                <a onclick="return confirm('Adakah anda pasti untuk hapus?');" href="{!! URL::to('site/dun/deletedun/'.data_get($dun,'id')) !!}" data-tooltip="Padam" data-position="bottom center">
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

  function validatedun() {

   var tahun = document.getElementById("tahun").value; // added .value
   var parlimen = document.getElementById("parlimen").value; // added .value
   var status = document.getElementById("status").value; // added .value

   if(tahun === '' || tahun=== null){

     //alert('yyy');
     alert('Sila masukan Tahun');
      return false;

   }else{

     if(parlimen === '' || parlimen=== null){
       alert('Sila masukan Parlimen');
      return false;

     }else{

      if(status === '' || status=== null){
       alert('Sila masukan Status');
      return false;

     }else{
      return true;

    }

     }

    
   
   }
   

}
  </script>

@endpush