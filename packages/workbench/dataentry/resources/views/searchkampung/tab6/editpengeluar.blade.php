
 <h4 class="ui top attached header">
  Kemaskini Maklumat Pengusaha/Pengeluar Produk
</h4>
<div class="ui attached segment">

	 {!! form()->open()->post()->action(route('dataentry::searchkampung.editpengeluar'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">

           <div class="field">
            <label>Nama Syarikat<font color="red">*</font></label>
            <input type="text" name="nama" id="nama" required="required" value="{{data_get($data_pengeluar,'NamaSyarikat')}}"
            onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
          </div>
           <div class="field">
            <label>Nama Wakil (Contact Person)<font color="red">*</font></label>
            <input type="text" name="namawakil" id="namawakil" required="required" value="{{data_get($data_pengeluar,'NamaWakil')}}"
            onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
          </div>
            <div class="field">
            <label>No Telefon Pejabat<font color="red">*</font>(Sila masukkan format nombor sahaja. Tanpa "-" atau jarak. Contoh: 0123456789))</label>
            <input type="text" name="notelpejabat" id="notelpejabat" required="required" value="{{data_get($data_pengeluar,'TelNoPejabat')}}"
            onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value=this.value.replace(/[^\d]/,'')" onKeyPress="if(this.value.length==12) return false;">
          </div>
             <div class="field">
            <label>No Telefon Bimbit<font color="red">*</font>(Sila masukkan format nombor sahaja. Tanpa "-" atau jarak. Contoh: 0123456789))</label>
            <input type="text" name="notelbimbit" id="notelbimbit" required="required" value="{{data_get($data_pengeluar,'TelNoBimbit')}}"
            onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value=this.value.replace(/[^\d]/,'')" onKeyPress="if(this.value.length==12) return false;">
          </div>
             <div class="field">
            <label>Faksimili (Sila masukkan format nombor sahaja. Tanpa "-" atau jarak. Contoh: 0123456789))</label>
            <input type="text" name="faks" id="faks" value="{{data_get($data_pengeluar,'Faks')}}"
           onkeyup="this.value=this.value.replace(/[^\d]/,'')" onKeyPress="if(this.value.length==12) return false;">
          </div>
              <div class="field">
            <label>Emel</label>
            <input type="text" name="emel" id="emel" value="{{data_get($data_pengeluar,'Email')}}"
            >
          </div>
             <div class="field">
              <label>Media Sosial</label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="mediasosial" id="mediasosial" value="{{data_get($data_pengeluar,'MediaSosial')}}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" >Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($mediasosial as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
               <div class="field">
            <label>Link Media Sosial</label>
            <input type="text" name="linkmedia" id="linkmedia" value="{{data_get($data_pengeluar,'LinkMediaSosial')}}">
          </div>
            <div class="field">
                <label>&nbsp;</label>
                 Contoh: www.facebook.com/username
          </div>
                 
    

 			<div class="ui divider section"></div>
		        <div align="right">
		                    <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validatepengeluar();">
		                        Simpan
		                    </button>
		                    <a href="#" class="ui button" onclick="gettab({{$id}},6,1,0)" id="buttonbackdown">Kembali</a>  
		                </div>


 {!! form()->close() !!}
</div>



