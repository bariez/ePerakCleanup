
 <h4 class="ui top attached header">
  Tambah Organisasi
</h4>
<div class="ui attached segment">

	 {!! form()->open()->post()->action(route('dataentry::searchkampung.savestruktur'))->attribute('id', 'formstruk')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
         <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
         <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
         <input type="hidden" name="iddetail"  required="required" value="0">

             <?php $this_year = date("Y"); // Run this only once?>

         <div class="field">
            <label>Tahun<font color="red">*</font></label>
             <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="tahun" id="tahun" value="{{ old('tahun') }}" >
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
            <label>Nama Ahli<font color="red">*</font></label>
            <input type="text"  name="nama" id="nama" required="required" value="{{ old('nama') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
          </div>
           <div class="field">
            <label>No.Kad Pengenalan<font color="red">*</font></label>
            <input type="text"  name="nokp" id="nokp" required="required" value="{{ old('nokp') }}" onkeyup="this.value=this.value.replace(/[^\d]/,'')" onKeyPress="if(this.value.length==12) return false;" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
          </div>
           <div class="field">
              <label>Jawatan<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="jawatan" id="jawatan" value="{{ old('jawatan') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($jawatan as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
               <div class="field">
	            <label>Biro<font color="red">*</font></label>
	            <input type="text"  name="biro" id="biro" required="required" value="{{ old('biro') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
	          </div>
             <div class="field">
            <label>No. Telefon<font color="red">*</font>(Sila masukkan format nombor sahaja. Tanpa "-" atau jarak. Contoh: 0123456789))</label>
            <input type="text" name="telefon" id="telefon" required="required"  value="" onkeyup="this.value=this.value.replace(/[^\d]/,'')" onKeyPress="if(this.value.length==12) return false;">
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
	           <div class="field">
	            <label>Gambar<font color="red">*</font></label>
	             <button type="button" style="display:block;width:20px; height:40px;" onclick="document.getElementById('getFile_tstrukorg').click()">Pilih Fail</button>
				    	<input type='file' id="getFile_tstrukorg" name="gambar" value="{{ old('gambar') }}" style="width: 700px;height: 40px;">
	          	</div>
              <div class="field">
                 <label>&nbsp;</label>
                 <b><font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan</b>
              </div>
               <div class="field" id="divpreview_tstrukorg">
                <label>Preview</label>
                 <a target="_blank"><img style="width:200px" id="preview_tstrukorg">
              </a>
                 
              </div>
 

 			<div class="ui divider section"></div>
		        <div align="right">
		                    <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return foo();">
		                        Simpan
		                    </button>
		                    <a href="#" onclick="gettab({{$id}},2,1,0)" class="ui button" id="backbuttondown">Kembali</a>   
		                </div>


 {!! form()->close() !!}
</div>



