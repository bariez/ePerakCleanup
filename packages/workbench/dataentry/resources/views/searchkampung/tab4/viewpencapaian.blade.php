
 <h4 class="ui top attached header">
  Kemaskini Maklumat Pencapaian
</h4>
<div class="ui attached segment">

	 {!! form()->open()->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="{{$iddetail}}">

             <?php $this_year = date("Y"); // Run this only once?>

            <div class="field">
            <label>Tahun</label>
            <input type="text" name="tahun" id="tahun"value="{{data_get($data_pencapaian,'Tahun')}}" readonly="readonly">
          </div>
             <div class="field">
              <label>Kategori Kemudahan<font color="red">*</font></label>
                <input type="text"  name="bil" id="bil" value="{{data_get($data_pencapaian,'peringkat.description') }}" readonly="readonly">
              </div>
              <div class="field">
                <label>Aktiviti<font color="red">*</font></label>
                <input type="text"  name="bil" id="bil" value="{{data_get($data_pencapaian,'Aktiviti') }}" readonly="readonly">

              </div>
              <div class="field">
                <label>Pencapaian<font color="red">*</font></label>
                <input type="text"  name="bil" id="bil" value="{{data_get($data_pencapaian,'Pencapaian') }}" readonly="readonly">
              </div>
              <div class="field">
                <label>Penganjur<font color="red">*</font></label>
               <input type="text"  name="bil" id="bil" value="{{data_get($data_pencapaian,'Penganjur') }}" readonly="readonly">
              </div>
              <div class="field">
              <label>Keterangan Ringkas</label>
               <textarea id="keterangan" name="keterangan" disabled="disabled">{{data_get($data_pencapaian,'Keterangan')}}</textarea>
             </div>

    

 			<div class="ui divider section"></div>
		        <div align="right">
		                  <a href="#" class="ui button" onclick="gettab({{$id}},4,1,0)" id="buttonbackdown">Kembali</a>    
		                </div>


 {!! form()->close() !!}
</div>



