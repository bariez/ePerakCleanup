
 <h4 class="ui top attached header">
  Tambah Maklumat Pencapaian
</h4>
<div class="ui attached segment">

	 {!! form()->open()->post()->action(route('dataentry::searchkampung.savepencapaian'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

	       <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
            <input type="hidden" name="iddetail"  required="required" value="0">

            <?php $this_year = date("Y"); // Run this only once?>


           <div class="field">
            <label>Tahun<font color="red">*</font></label>
             <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="tahun" id="tahun" value="{{ old('tahun') }}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" >Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      <?php for ($year =  $this_year - 20; $year <= $this_year; $year++) {?>
                        <?php echo  '<div class="item" data-value="' . $year . '">' . $year . '</div>';?>
                       
                      <?php }?>
                    </div>
                  </div>
          </div>
             <div class="field">
              <label>Peringkat<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="peringkat" id="peringkat" value="{{ old('peringkat') }}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" >Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($peringkat as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
              <div class="field">
                <label>Aktiviti<font color="red">*</font></label>
                <input type="text"  name="aktiviti" id="aktiviti" required="required" value="{{ old('aktiviti') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib')" onkeyup="this.value = this.value.toUpperCase();">
              </div>
              <div class="field">
                <label>Pencapaian<font color="red">*</font></label>
                <input type="text"  name="pencapaian" id="pencapaian" required="required" value="{{ old('latitud') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
              </div>
              <div class="field">
                <label>Penganjur<font color="red">*</font></label>
                <input type="text"  name="penganjur" id="penganjur" required="required" value="{{ old('penganjur') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
              </div>
              <div class="field">
              <label>Keterangan Ringkas</label>
               <textarea id="keterangan" name="keterangan" onkeyup="this.value = this.value.toUpperCase();"></textarea>
             </div>

    

 			<div class="ui divider section"></div>
		        <div align="right">
		                    <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validatepencapaian();">
		                        Simpan
		                    </button>
		               <a class="ui button" href="#" onclick="gettab({{$id}},4,1,0)" id="buttonbackdown">Kembali</a>   
		                </div>


 {!! form()->close() !!}
</div>



