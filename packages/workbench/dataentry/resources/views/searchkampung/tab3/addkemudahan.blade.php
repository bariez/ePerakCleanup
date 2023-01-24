
 <h4 class="ui top attached header">
  Tambah Kemudahan Awam dan Infrastruktur
</h4>
<div class="ui attached segment">

	 {!! form()->open()->post()->action(route('dataentry::searchkampung.savekemudahan'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="0">

          <div class="field">
              <label>Kategori Kemudahan<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="catkemudahan" id="catkemudahan" value="{{ old('catkemudahan') }}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" >Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($catkemudahan as $key => $value)
                       <div class="item" data-value="{{$value->id}}" onclick="jeniskemudahan({{$value->id}})">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
               <div class="field">
              <label>Jenis Kemudahan<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="jeniskemudahan" id="jeniskemudahan" value="{{ old('jeniskemudahan') }}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" id="pilihjeniskemudahan">Sila Pilih</div>
                    <div class="menu" id="selectjeniskemudahan">

                    </div>
                  </div>
              </div>
                <div class="field">
                <label>Nama Kemudahan<font color="red">*</font></label>
                <input type="text"  name="nama" id="nama" required="required" value="{{ old('bil') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
              </div>
              <div class="field">
                <label>Bilangan<font color="red">*</font></label>
                <input type="text"  name="bil" id="bil" required="required" value="{{ old('bil') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value=this.value.replace(/[^\d]/,'')">
              </div>
            <div class="field">
              <label>Penjodoh Bilangan/unit<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="unit" id="unit" value="{{ old('unit') }}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" >Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($unit as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>

	           <div class="field">
      	            <label>Gambar<font color="red">*</font></label>
      	             <button type="button" style="display:block;width:20px; height:40px;" onclick="document.getElementById('getFile_tkemudahan').click()">Pilih Fail</button>
      					<input type='file' id="getFile_tkemudahan" name="gambar" value="{{ old('gambar') }}" style="width: 700px;height: 40px;">
	          	</div>
               <div class="field">
                 <label>&nbsp;</label>
                 <b><font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan</b>
              </div>
              <div class="field" id="divpreview_tkemudahan">
                <label>Preview</label>
                 <a target="_blank"><img style="width:200px" id="preview_tkemudahan">
              </a>

              </div>
              <div class="field">
                <label>Latitud<font color="red">*</font></label>
                <input type="text"  name="latitud" id="latitud" required="required" value="{{ old('latitud') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
              </div>
              <div class="field">
                <label>Longitud<font color="red">*</font></label>
                <input type="text"  name="longitud" id="longitud" required="required" value="{{ old('longitud') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
              </div>


 			<div class="ui divider section"></div>
		        <div align="right">
		                    <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validatekemudahan();">
		                        Simpan
		                    </button>
		                    <a href="#" onclick="gettab({{$id}},3,1,0)" class="ui button" id="backbuttondown">Kembali</a>
		                </div>


 {!! form()->close() !!}
</div>



