
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
    @php 
        $pathGambar = data_get($data_aktiviti, 'Gambar_path');
    @endphp

    @if(empty($pathGambar))
        {{-- Jika database kosong --}}
        <a target="_blank" href="{{ URL::asset('logo.png') }}">
            <img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
        </a>
    @elseif(file_exists(public_path($pathGambar)))
        {{-- Jika fail wujud mengikut path dalam DB (Cara Projek) --}}
        <a target="_blank" href="{!! URL::to($pathGambar) !!}">
            <img src="{!! URL::to($pathGambar) !!}" alt="ePerak" style="width:200px; border: 1px solid #ddd; padding: 5px;">
        </a>
    @else
        {{-- Jika path ada dalam DB tapi fail fizikal tiada di server --}}
        <div style="margin-bottom: 5px;">
            <a target="_blank" href="{{ URL::asset('logo.png') }}">
                <img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px; opacity: 0.5;">
            </a>
        </div>
        <span style="color: red; font-size: 0.8em;">
            <i class="warning icon"></i> Fail tidak dijumpai: {{ $pathGambar }}
        </span>
    @endif
</div>

 			<div class="ui divider section"></div>
		        <div align="right">
              <a href="#" class="ui button" onclick="gettab({{$id}},5,1,0)" id="buttonbackdown">Kembali</a>    
          </div>


 {!! form()->close() !!}
</div>



