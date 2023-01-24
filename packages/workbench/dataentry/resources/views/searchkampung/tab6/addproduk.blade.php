
 <h4 class="ui top attached header">
  Tambah Maklumat Produk yang dikelurkan oleh {{data_get($data_pengeluar,'NamaSyarikat')}}
</h4>
<div class="ui attached segment">

   {!! form()->open()->post()->action(route('dataentry::searchkampung.saveproduk'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

         <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">

           <div class="field">
              <label>Kategori Produk<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="catproduk" id="catproduk" value="{{ old('catproduk') }}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" >Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($catproduk as $key => $value)
                       <div class="item" data-value="{{$value->id}}" onclick="jenisproduk({{$value->id}})">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
           <div class="field">
              <label>Jenis Produk<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="jenisproduk" id="jenisproduk" value="{{ old('jenisproduk') }}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" id="pilihjenisproduk">Sila Pilih</div>
                    <div class="menu" id="selectjenisproduk">

                    </div>
                  </div>
              </div>
            <div class="field">
            <label>Nama Produk<font color="red">*</font></label>
            <input type="text" name="namaproduk" id="namaproduk" required="required"
            onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
          </div>
             <div class="field">
              <label>Keterangan Ringkas Mengenai Produk</label>
               <textarea id="keterangan" name="keterangan" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();"></textarea>
             </div>

             <div class="field">
                <label>Gambar<font color="red">*</font></label>
                <button type="button" style="display:block;width:20px; height:40px;"
                    onclick="document.getElementById('getFile_tproduk').click()">Pilih Fail</button>
                <input type='file' id="getFile_tproduk" name="gambar" value="{{ old('gambar') }}"
                    style="width: 700px;height: 40px;">
            </div>
            <div class="field">
                <label>&nbsp;</label>
                <b>
                    <font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan
                </b>
            </div>
            <div class="field" id="divpreview_tproduk">
                <label>Preview</label>
                <a target="_blank"><img style="width:200px" id="preview_tproduk">
                </a>

            </div>

      <div class="ui divider section"></div>
            <div align="right">
                        <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validateproduk();">
                            Simpan
                        </button>
                        <a class="ui button" onclick="gettab({{$id}},6,5,0)" id="buttonbackdown">Kembali</a>
                    </div>


 {!! form()->close() !!}
</div>



