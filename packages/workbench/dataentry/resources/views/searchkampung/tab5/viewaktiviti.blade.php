
 <h4 class="ui top attached header">
  Paparan Maklumat Aktiviti
</h4>
<div class="ui attached segment">

	 {!! form()->open()->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">

           <div class="field">
            <label>Tahun<font color="red">*</font></label>
            <input type="text" name="tahun" id="tahun"value="{{data_get($data_aktiviti,'Tahun')}}" readonly="readonly">
          </div>
             <div class="field">
              <label>Peringkat<font color="red">*</font></label>
                 <input type="text" name="peringkat" id="peringkat"value="{{data_get($data_aktiviti,'peringkat.description')}}" readonly="readonly">
              </div>
               <div class="field">
              <label>Jenis Aktiviti<font color="red">*</font></label>
                <input type="text" name="peringkat" id="peringkat"value="{{data_get($data_aktiviti,'kategori.description')}}" readonly="readonly">
              </div>
              <div class="field">
                <label>Aktiviti<font color="red">*</font></label>
                <input type="text"  name="aktiviti" id="aktiviti" readonly="readonly" value="{{ data_get($data_aktiviti,'NamaAktiviti') }}">
              </div>
              <div class="field">
                <label>Penganjur<font color="red">*</font></label>
                <input type="text"  name="penganjur" id="penganjur" readonly="readonly" value="{{ data_get($data_aktiviti,'Penganjur') }}">
              </div>
              <div class="field">
              <label>Keterangan Ringkas<font color="red">*</font></label>
               <textarea id="keterangan" name="keterangan" disabled="disabled">{{data_get($data_aktiviti,'Keterangan')}}</textarea>
             </div>
             <div class="field">
              <label>Gambar</label>
             @if(data_get($data_aktiviti,'Gambar_path')=='')
             <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>
            @elseif(file_exists(public_path (data_get($data_aktiviti,'Gambar_path'))))
             <a target="_blank" href="{!! URL::to(data_get($data_aktiviti,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($data_aktiviti,'Gambar_path')) !!}" alt="ePerak" style="width:100px">
            </a>
            @else
            <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>
            
            @endif
                                   
              </div>

 			<div class="ui divider section"></div>
		        <div align="right">
              <a href="#" class="ui button" onclick="gettab({{$id}},5,1,0)" id="buttonbackdown">Kembali</a>    
          </div>


 {!! form()->close() !!}
</div>



