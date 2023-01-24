
 <h4 class="ui top attached header">
  Tambah Galeri
</h4>
<div class="ui attached segment">

	 {!! form()->open()->post()->action(route('dataentry::searchkampung.savegaleri'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="0">

              
              <div class="field">
                <label>Tajuk<font color="red">*</font></label>
                <input type="text"  name="tajuk" id="tajuk" required="required" value="{{ old('tajuk') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
              </div>
             <div class="field">
              <label>Keterangan<font color="red">*</font></label>
               <textarea id="keterangan" name="keterangan" required="required" value="{{ old('tajuk') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') "
               onkeyup="this.value = this.value.toUpperCase();"></textarea>
             </div>
           <div class="field">
              <label>Gambar</label>
               <button type="button" style="display:block;width:20px; height:40px;" onclick="document.getElementById('getFile_tgeleri').click()">Pilih Fail</button>
                   <input type='file' id="getFile_tgeleri" name="gambar" value="{{ old('gambar') }}" style="width: 700px;height: 40px;">
                </div>
             <div class="field">
                 <label>&nbsp;</label>
                 <b><font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan</b>
              </div>
             <div class="field" id="divpreviewmain">
                <label>Preview</label>
                 <a target="_blank"><img style="width:200px" id="preview_tgeleri">
              </a>
                 
              </div>
             <div class="field">
              <label>Status<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="status"  id="status" required="required" value="{{ old('status') }}">
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



