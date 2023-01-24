
 <h4 class="ui top attached header">
  Paparan Kemudahan Awam dan Infrastruktur
</h4>
<div class="ui attached segment">

	 {!! form()->open()->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">

          <div class="field">
              <label>Kategori Kemudahan<font color="red">*</font></label>
                <input type="text"  name="bil" id="bil" value="{{data_get($data_kemudahan,'katkemudahan.description') }}" readonly="readonly">
              </div>

               <div class="field">
              <label>Jenis Kemudahan<font color="red">*</font></label>
                <input type="text"  name="bil" id="bil" value="{{data_get($data_kemudahan,'jeniskemudahan.description') }}" readonly="readonly">
              </div>
              <div class="field">
                <label>Bilangan<font color="red">*</font></label>
                <input type="text"  name="bil" id="bil" value="{{data_get($data_kemudahan,'Bilangan') }}" readonly="readonly">
              </div>
            <div class="field">
              <label>Penjodoh Bilangan/unit<font color="red">*</font></label>
                <input type="text"  name="bil" id="bil" value="{{data_get($data_kemudahan,'unit.description') }}" readonly="readonly">
              </div>

              <div class="field">
              <label>Gambar</label>
             @if(data_get($data_kemudahan,'Gambar_path')=='')
             <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>
            @elseif(file_exists(public_path (data_get($data_kemudahan,'Gambar_path'))))
             <a target="_blank" href="{!! URL::to(data_get($data_kemudahan,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($data_kemudahan,'Gambar_path')) !!}" alt="ePerak" style="width:100px">
            </a>
            @else
            <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>

            @endif

              </div>
              <div class="field">
                <label>Latitud<font color="red">*</font></label>
                <input type="text"  name="latitud" id="latitud" value="{{data_get($data_kemudahan,'Latitud') }}" readonly="readonly">
              </div>
              <div class="field">
                <label>Longitud<font color="red">*</font></label>
                <input type="text"  name="longitud" id="longitud" value="{{data_get($data_kemudahan,'Longitud') }}" readonly="readonly">
              </div>


 			<div class="ui divider section"></div>
		        <div align="right">

		                 <a class="ui button" href="#" onclick="gettab({{$id}},3,1,0)" id="backbuttondown">Kembali</a>
		                </div>


 {!! form()->close() !!}
</div>


