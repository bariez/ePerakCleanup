
 <h4 class="ui top attached header">
 Paparan Projek
</h4>
<div class="ui attached segment">

	 {!! form()->open()->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">

              <?php $this_year = date("Y"); // Run this only once?>

             <div class="field">
            <label>Tahun<font color="red">*</font></label>
             <input type="text"  name="namaprojek" id="namaprojek" readonly="readonly" value="{{ data_get($data_projek,'Tahun') }}" >
          </div>
             <div class="field">
              <label>Jenis Projek<font color="red">*</font></label>
                 <input type="text"  name="namaprojek" id="namaprojek" readonly="readonly" value="{{ data_get($data_projek,'jenisprojek.description') }}" >
              </div>
              
              <div class="field">
                <label>Nama Projek<font color="red">*</font></label>
                <input type="text"  name="namaprojek" id="namaprojek" readonly="readonly" value="{{ data_get($data_projek,'NamaProjek') }}" >
              </div>
              <div class="field">
                <label>Lokasi Projek<font color="red">*</font></label>
                <input type="text"  name="lokasi" id="lokasi" readonly="readonly" value="{{ data_get($data_projek,'Lokasi') }}" >
              </div>
              <div class="field">
                <label>Sumber Kewangan<font color="red">*</font></label>
                <input type="text"  name="sumber" id="sumber" readonly="readonly" value="{{ data_get($data_projek,'Sumber') }}" >
              </div>
              <div class="field">
              <label>Objektif Projek<font color="red">*</font></label>
               <textarea id="objektif" name="objektif" disabled="disabled">{{ data_get($data_projek,'objektif') }}</textarea>
             </div>
             <div class="field">
              <label>Penerangan Projek<font color="red">*</font></label>
               <textarea id="keterangan" name="keterangan"  disabled="disabled">{{data_get($data_projek,'keterangan') }}</textarea>
             </div>
             <div class="field">
              <label>Agensi Perlaksana<font color="red">*</font></label>
               <textarea id="agensi" name="agensi"  disabled="disabled">{{ data_get($data_projek,'Agensi') }}</textarea>
             </div>
              <div class="field">
              <label>Gambar</label>
             @if(data_get($data_projek,'Gambar_path')=='')
             <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>
            @elseif(file_exists(public_path (data_get($data_projek,'Gambar_path'))))
             <a target="_blank" href="{!! URL::to(data_get($data_projek,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($data_projek,'Gambar_path')) !!}" alt="ePerak" style="width:100px">
            </a>
            @else
            <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>
            
            @endif
                                   
              </div>
                

    

 			<div class="ui divider section"></div>
		        <div align="right">
		                   
		                    <a class="ui button" href="#" onclick="gettab({{$id}},7,1,0)" id="buttonbackdown">Kembali</a></button> 
		                </div>


 {!! form()->close() !!}
</div>



