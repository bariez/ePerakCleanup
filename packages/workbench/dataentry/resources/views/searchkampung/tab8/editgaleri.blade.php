
 <h4 class="ui top attached header">
  Kemaskini Galeri
</h4>
<div class="ui attached segment">

	 {!! form()->open()->post()->action(route('dataentry::searchkampung.editgaleri'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">

              
              <div class="field">
                <label>Tajuk<font color="red">*</font></label>
                <input type="text"  name="tajuk" id="tajuk" required="required" value="{{ data_get($data_galeri,'Tajuk') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
              </div>
             <div class="field">
              <label>Keterangan<font color="red">*</font></label>
               <textarea id="keterangan" name="keterangan" required="required" value="{{ old('tajuk') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">{{ data_get($data_galeri,'Keterangan') }}</textarea>
             </div>
              <div class="field">
              <label>Gambar</label>  
               <button type="button" style="display:block;width:20px; height:40px;" onclick="document.getElementById('getFile_tgeleri_edit').click()">Pilih Fail</button>
                 <input type='file' id="getFile_tgeleri_edit" name="gambar" value="{{ old('gambar') }}" style="width: 700px;height: 40px;">
              </div>
               <div class="field">
                 <label>&nbsp;</label>
                 <b><font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan</b>
              </div>
              <div class="field" id="divpreviewmain_edit">
                <label>Preview</label>
                 <a target="_blank"><img style="width:200px" id="preview_tgeleri_edit">
              </a>
                 
              </div>
              <div class="field">
              <label>&nbsp;</label>
             @if(data_get($data_galeri,'Gambar_path')=='')
               <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
              </a>
              @elseif(file_exists(public_path (data_get($data_galeri,'Gambar_path'))))
               <a target="_blank" href="{!! URL::to(data_get($data_galeri,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($data_galeri,'Gambar_path')) !!}" alt="ePerak" style="width:200px">
              </a>
              @else
              <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
              </a>                  
              @endif
             
              </div>
             <div class="field">
              <label>Status<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="status"  id="status" required="required" value="{{ data_get($data_galeri,'Status') }}">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      <div class="item" data-value="1">Aktif</div>
                      <div class="item" data-value="0">Tidak Aktif</div>
                    </div>
                  </div>
              </div>

 		     	<div class="ui divider section"></div>
		        <div align="right">
		                    <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validategalerimain();">
		                        Simpan
		                    </button>
		                <a class="ui button" href="#" onclick="gettab({{$id}},8,1,0)" id="buttonbackdown">Kembali</a>    
		                </div>


 {!! form()->close() !!}
</div>



