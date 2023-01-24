
 <h4 class="ui top attached header">
  Paparan Maklumat Organisasi
</h4>
<div class="ui attached segment">

   {!! form()->open()->attribute('id', 'editformstruk')->multipart()->horizontal() !!}

         <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">

           <div class="field">
            <label>Tahun</label>
            <input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="tahun" id="tahun"value="{{data_get($data_pentadbiran,'Sesi')}}" readonly="readonly">
          </div>
          <div class="field">
            <label>Nama Ahli</label>
            <input type="text"  name="nama" id="nama" readonly="readonly" value="{{data_get($data_pentadbiran,'NamaAhli')}}">
          </div>
           <div class="field">
            <label>No.Kad Pengenalan</label>
            <input type="text"  name="nokp" id="nokp" readonly="readonly" value="{{data_get($data_pentadbiran,'NoKP')}}">
          </div>
           <div class="field">
              <label>Jawatan</label>
              <input type="text"  name="nokp" id="nokp" readonly="readonly" value="{{data_get($data_pentadbiran,'jawatan.description')}}">
              </div>
               <div class="field">
              <label>Biro</label>
              <input type="text"  name="biro" id="biro" readonly="readonly" value="{{data_get($data_pentadbiran,'Biro')}}">
            </div>
             <div class="field">
              <label>No Telefon</label>
              <input type="text"  name="notel" id="notel" readonly="readonly" value="{{data_get($data_pentadbiran,'NoTel')}}">
            </div>
             <div class="field">
              <label>Gambar</label>
               @if(data_get($data_pentadbiran,'Gambar_path')=='')
             <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>
            @elseif(file_exists(public_path (data_get($data_pentadbiran,'Gambar_path'))))
             <a target="_blank" href="{!! URL::to(data_get($data_pentadbiran,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($data_pentadbiran,'Gambar_path')) !!}" alt="ePerak" style="width:100px">
            </a>
            @else
            <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
            </a>
            
            @endif
                                   
              </div>
       
              <div class="field">
              <label>Status</label>
              @if(data_get($data_pentadbiran,'Status')==1)
              <input type="text"  name="status" id="status" readonly="readonly" value="Aktif">
              @else
              <input type="text"  name="status" id="status" readonly="readonly" value="Tidak Aktif">
              @endif
               
              </div>

      <div class="ui divider section"></div>
            <div align="right">
                        <button class="ui button"><a href="#" onclick="gettab({{$id}},2,1,0)" id="backbuttondown">Kembali</a></button>    
                    </div>


 {!! form()->close() !!}
</div>



