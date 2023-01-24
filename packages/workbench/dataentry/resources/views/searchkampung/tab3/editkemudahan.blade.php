
 <h4 class="ui top attached header">
  Kemaskini Kemudahan Awam dan Infrastruktur
</h4>
<div class="ui attached segment">

	 {!! form()->open()->post()->action(route('dataentry::searchkampung.editkemudahan'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">

          <div class="field">
              <label>Kategori Kemudahan<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="catkemudahan" id="catkemudahan" value="{{data_get($data_kemudahan,'KatKemudahan') }}" >
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
                    <input type="hidden" name="jeniskemudahan" id="jeniskemudahan" value="{{data_get($data_kemudahan,'JenisKemudahan') }}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" id="pilihjeniskemudahan">Sila Pilih</div>
                    <div class="menu" id="selectjeniskemudahan">
                      <div class="item" data-value="" id="edit">Sila Pilih</div>
                        @foreach($jeniskemudahan as $key => $value)
                        <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
                <div class="field">
                <label>Nama Kemudahan<font color="red">*</font></label>
                <input type="text"  name="nama" id="nama" required="required" value="{{data_get($data_kemudahan,'NamaKemudahan') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
              </div>
              <div class="field">
                <label>Bilangan<font color="red">*</font></label>
                <input type="text"  name="bil" id="bil" required="required" value="{{data_get($data_kemudahan,'Bilangan') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value=this.value.replace(/[^\d]/,'')">
              </div>
            <div class="field">
              <label>Penjodoh Bilangan/unit<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="unit" id="unit" value="{{data_get($data_kemudahan,'Unit') }}" >
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
              <label>Gambar</label>
               <button type="button" style="display:block;width:20px; height:40px;" onclick="document.getElementById('getFile_tkemudahan_edit').click()">Pilih Fail</button>
                 <input type='file' id="getFile_tkemudahan_edit" name="gambar" value="{{ old('gambar') }}" style="width: 700px;height: 40px;">
              </div>
                <div class="field">
                 <label>&nbsp;</label>
                 <b><font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan</b>
              </div>
              <div class="field" id="divpreview_tkemudahan_edit">
                <label>Preview</label>
                 <a target="_blank"><img style="width:200px" id="preview_tkemudahan_edit">
              </a>

              </div>
              <div class="field">
              <label>&nbsp;</label>
           @if(data_get($data_kemudahan,'Gambar_path')=='')
             <a target="_blank" href="{{ URL::asset('noimage.png') }}"><img src="{{ URL::asset('noimage.png') }}" alt="Paris" style="width:200px">
            </a>
            @else
             <a target="_blank" href="{!! URL::to(data_get($data_kemudahan,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($data_kemudahan,'Gambar_path')) !!}" alt="Paris" style="width:200px">
            </a>
            @endif
              </div>
              <div class="field">
                <label>Latitud<font color="red">*</font></label>
                <input type="text"  name="latitud" id="latitud" required="required" value="{{data_get($data_kemudahan,'Latitud') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
              </div>
              <div class="field">
                <label>Longitud<font color="red">*</font></label>
                <input type="text"  name="longitud" id="longitud" required="required" value="{{data_get($data_kemudahan,'Longitud') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
              </div>


 			<div class="ui divider section"></div>
		        <div align="right">
		                    <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validatekemudahan();">
		                        Simpan
		                    </button>
		                    <a href="#" class="ui button" onclick="gettab({{$id}},3,1,0)" id="backbuttondown">Kembali</a>
		                </div>


 {!! form()->close() !!}
</div>


