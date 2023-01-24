
 <h4 class="ui top attached header">
 Maklumat Produk yang dikelurkan oleh {{data_get($data_pengeluar2,'NamaSyarikat')}}
</h4>
<div class="ui attached segment">

   {!! form()->open()->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

         <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">
             <input type="hidden" name="pengeluar"  required="required" value="{{data_get($data_pengeluar2,'id')}}">

           <div class="field">
              <label>Kategori Produk<font color="red">*</font></label>
               <input type="text"  name="produk" id="produk" value="{{data_get($data_produk,'kategori.description') }}" readonly="readonly">
              </div>
           <div class="field">
              <label>Jenis Produk<font color="red">*</font></label>
                <input type="text"  name="produk" id="produk" value="{{data_get($data_produk,'jenisproduk.description') }}" readonly="readonly">
              </div>
            <div class="field">
            <label>Nama Produk<font color="red">*</font></label>
            <input type="text" name="namaproduk" id="namaproduk" readonly="readonly" value="{{data_get($data_produk,'NamaProduk')}}">
            </div>
             <div class="field">
              <label>Keterangan Ringkas Mengenai Produk<font color="red">*</font></label>
               <textarea id="keterangan" name="keterangan" disabled="disabled">{{data_get($data_produk,'Keterangan')}}</textarea>
             </div>
              <div class="field">
              <label>Gambar</label>
             @if(data_get($data_produk,'Gambar_path')=='')
             <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>
            @elseif(file_exists(public_path (data_get($data_produk,'Gambar_path'))))
             <a target="_blank" href="{!! URL::to(data_get($data_produk,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($data_produk,'Gambar_path')) !!}" alt="ePerak" style="width:100px">
            </a>
            @else
            <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>
            
            @endif
                                   
              </div>

      <div class="ui divider section"></div>
            <div align="right">
                       
                        <a href="#" class="ui button" onclick="gettab({{$id}},6,5,{{data_get($data_pengeluar2,'id')}})" id="buttonbackdown">Kembali</a>
                    </div>


 {!! form()->close() !!}
</div>



