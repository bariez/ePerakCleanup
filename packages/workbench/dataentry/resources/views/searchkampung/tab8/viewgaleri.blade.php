
 <h4 class="ui top attached header">
  Paparan Galeri
</h4>
<div class="ui attached segment">

	 {!! form()->open()->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">

              
              <div class="field">
                <label>Tajuk<font color="red">*</font></label>
                <input type="text"  name="tajuk" id="tajuk" readonly="readonly" value="{{ data_get($data_galeri,'Tajuk') }}" >
              </div>
             <div class="field">
              <label>Keterangan<font color="red">*</font></label>
               <textarea id="keterangan" name="keterangan" disabled="disabled">{{ data_get($data_galeri,'Keterangan') }}</textarea>
             </div>
              <div class="field">
              <label>Gambar</label>
             @if(data_get($data_galeri,'Gambar_path')=='')
             <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>
            @elseif(file_exists(public_path (data_get($data_galeri,'Gambar_path'))))
             <a target="_blank" href="{!! URL::to(data_get($data_galeri,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($data_galeri,'Gambar_path')) !!}" alt="ePerak" style="width:100px">
            </a>
            @else
            <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>
            
            @endif
                                   
              </div>
             <div class="field">
              <label>Status<font color="red">*</font></label>
              @if(data_get($data_galeri,'Status')==1)
              <input type="text"  name="tajuk" id="tajuk" readonly="readonly" value="Aktif" >
              @else
              <input type="text"  name="tajuk" id="tajuk" readonly="readonly" value="Tidak Aktif" >
              @endif
              
              </div>

 		     	<div class="ui divider section"></div>
		        <div align="right">
            
             
            <a href="#" class="ui button" onclick="gettab({{$id}},8,1,0)" id="buttonbackdown">Kembali</a>  
          </div>


 {!! form()->close() !!}
</div>



