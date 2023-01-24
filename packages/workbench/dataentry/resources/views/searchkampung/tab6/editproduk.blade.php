
 <h4 class="ui top attached header">
  Kemaksini Maklumat Produk yang dikelurkan oleh {{data_get($data_pengeluar2,'NamaSyarikat')}}
</h4>
<div class="ui attached segment">

   {!! form()->open()->post()->action(route('dataentry::searchkampung.editproduk'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

         <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">
             <input type="hidden" name="pengeluar"  required="required" value="{{data_get($data_pengeluar2,'id')}}">

           <div class="field">
              <label>Kategori Produk<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="catproduk" id="catproduk" value="{{ data_get($data_produk,'KategoriProduk') }}" >
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
                    <input type="hidden" name="jenisproduk" id="jenisproduk" value="{{ data_get($data_produk,'JenisProduk') }}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" id="pilihjenisproduk">Sila Pilih</div>
                    <div class="menu" id="selectjenisproduk">
                      <div class="item" data-value="" id="add">Sila Pilih</div>
                        @foreach($jenisproduk as $key => $value)
                        <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
            <div class="field">
            <label>Nama Produk<font color="red">*</font></label>
            <input type="text" name="namaproduk" id="namaproduk" required="required" value="{{data_get($data_produk,'NamaProduk')}}"
            onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
          </div>
             <div class="field">
              <label>Keterangan Ringkas Mengenai Produk</label>
               <textarea id="keterangan" name="keterangan" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">{{data_get($data_produk,'Keterangan')}}</textarea>
             </div>
               <div class="field">
              <label>Gambar<font color="red">*</font></label>
              <button type="button" style="display:block;width:20px; height:40px;" onclick="document.getElementById('getFile_tproduk_edit').click()">Pilih Fail</button>
              <input type='file' id="getFile_tproduk_edit" name="gambar" value="{{ old('gambar') }}" style="width: 700px;height: 40px;">
            </div>
           <div class="field">
               <label>&nbsp;</label>
               <b><font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan</b>
            </div>
            <div class="field" id="divpreview_tproduk_edit">
              <label>Preview</label>
              <a target="_blank"><img style="width:200px" id="preview_tproduk_edit">
              </a>

            </div>
            <div class="field">
              <label>&nbsp;</label>
              @if(data_get($data_produk,'Gambar_path')=='')
              <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
              </a>
              @elseif(file_exists(public_path (data_get($data_produk,'Gambar_path'))))
              <a target="_blank" href="{!! URL::to(data_get($data_produk,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($data_produk,'Gambar_path')) !!}" alt="ePerak" style="width:200px">
              </a>
              @else
              <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
              </a>
              @endif


            </div>


      <div class="ui divider section"></div>
            <div align="right">
                        <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validateproduk();">
                            Simpan
                        </button>
                        <a class="ui button" onclick="gettab({{$id}},6,5,{{data_get($data_pengeluar2,'id')}})" id="buttonbackdown">Kembali</a>    
                    </div>


 {!! form()->close() !!}
</div>



