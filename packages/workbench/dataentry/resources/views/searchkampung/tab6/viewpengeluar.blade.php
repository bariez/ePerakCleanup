
 <h4 class="ui top attached header">
  Paparan Maklumat Pengusaha/Pengeluar Produk
</h4>
<div class="ui attached segment">

	 {!! form()->open()->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">

           <div class="field">
            <label>Nama Syarikat<font color="red">*</font></label>
            <input type="text" name="nama" id="nama" readonly="readonly" value="{{data_get($data_pengeluar,'NamaSyarikat')}}">
          </div>
           <div class="field">
            <label>Nama Wakil (Contact Person)<font color="red">*</font></label>
            <input type="text" name="namawakil" id="namawakil" readonly="readonly" value="{{data_get($data_pengeluar,'NamaWakil')}}">
          </div>
            <div class="field">
            <label>No Telefon Pejabat<font color="red">*</font></label>
            <input type="text" name="notelpejabat" id="notelpejabat"  readonly="readonly" value="{{data_get($data_pengeluar,'TelNoPejabat')}}">
          </div>
             <div class="field">
            <label>No Telefon Bimbit<font color="red">*</font></label>
            <input type="text" name="notelbimbit" id="notelbimbit"  readonly="readonly" value="{{data_get($data_pengeluar,'TelNoBimbit')}}"
           >
          </div>
             <div class="field">
            <label>Faksimili<font color="red">*</font></label>
            <input type="text" name="faks" id="faks"  readonly="readonly" value="{{data_get($data_pengeluar,'Faks')}}">
          </div>
              <div class="field">
            <label>Emel<font color="red">*</font></label>
            <input type="text" name="emel" id="emel"  readonly="readonly" value="{{data_get($data_pengeluar,'Email')}}"
           >
          </div>
             <div class="field">
              <label>Media Sosial<font color="red">*</font></label>
                 <input type="text" name="emel" id="emel"  readonly="readonly" value="{{data_get($data_pengeluar,'mediasosial.description')}}">
              </div>
               <div class="field">
            <label>Link Media Sosial<font color="red">*</font></label>
            <input type="text" name="linkmedia" id="linkmedia" required="required" value="{{data_get($data_pengeluar,'LinkMediaSosial')}}"  readonly="readonly" 
            onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
          </div>
                 
    

 			<div class="ui divider section"></div>
		        <div align="right">
		                    <a class="ui button" href="#" onclick="gettab({{$id}},6,1,0)" id="buttonbackdown">Kembali</a>    
		                </div>


 {!! form()->close() !!}
</div>



