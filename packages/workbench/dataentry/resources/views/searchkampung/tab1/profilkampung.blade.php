
 <h4 class="ui top attached header">
  Kemaskini Profil Kampung
</h4>
<div class="ui attached segment">
  {!! form()->open()->post()->action(route('dataentry::searchkampung.savekampung'))->horizontal() !!}
           <input type="hidden" name="tabmain"  required="required" value="{{$tabmain}}">
           <input type="hidden" name="tabdetail"  required="required" value="{{$tabdetail}}">
           <input type="hidden" name="idkampung"  required="required" value="{{$id}}">
          <div class="field">
            <label>Nama Kampung</label>
            <input type="text" name="name" id="name" readonly="readonly" value="{{ data_get($kampung,'NamaKampung') }}">
          </div>
          <div class="field">
            <label>Daerah</label>
            <input type="text" name="daerah" id="daerah" readonly="readonly"  value="{{ data_get($kampung,'daerah.NamaDaerah') }}">
          </div>
          <div class="field">
            <label>Mukim</label>
            <input type="text" name="mukim" id="mukim" readonly="readonly"  value="{{ data_get($kampung,'mukim.NamaMukim') }}">
          </div>
          <div class="field">
            <label>Dun</label>
            <input type="text" name="dun" id="dun" readonly="readonly"  value="{{ data_get($kampung,'dun.NamaDun') }}">
          </div>
          <div class="field">
            <label>Parlimen</label>
            <input type="text" name="parlimen" id="parlimen" readonly="readonly"  value="{{ data_get($kampung,'parlimen.NamaParlimen') }}">
          </div>
          <div class="field">
            <label>Nama JPKK<font color="red">*</font></label>
            <input type="text" name="namejpkk" id="namejpkk" readonly="readonly"  value="{{ data_get($kampung,'NamaJPKK')}}">
          </div>
          <div class="field">
            <label>Nama Pengerusi<font color="red">*</font></label>
            <input type="text" name="namepengerusi" id="namepengerusi" required="required"  value="{{ data_get($namapengerusi,'NamaAhli')}}">
          </div>
           <div class="field">
            <label>No. Telefon Pengerusi<font color="red">*</font>(Sila masukkan format nombor sahaja. Tanpa "-" atau jarak. Contoh: 0123456789))</label>
            <input type="text" name="telpengerusi" id="telpengerusi" required="required" onkeyup="this.value=this.value.replace(/[^\d]/,'')" onKeyPress="if(this.value.length==12) return false;" value="{{ data_get($namapengerusi,'NoTel')}}">
          </div>
          <div class="field">
            <label>Alamat Surat Menyurat<font color="red">*</font></label>
            <input type="text" name="alamtsurat" id="alamtsurat" required="required"  value="{{ data_get($kampung,'AlamatJPKK')}}">
          </div>
         
          <div class="field">
            <label>Sejarah Kampung</label>
           <textarea id="sejarah" name="sejarah">{{data_get($kampung,'Sejarah')}}</textarea>
          </div>
        

      <div class="ui divider section"></div>
        <div align="right">
                    <button type="submit" class="ui button primary" id="addbutton">
                        Simpan
                    </button>
                   <!--  <button class="ui button"><a href="{!! URL::to('dataentry/searchkampung/mainmenu/'.$id.'/'.$tabmain.'/'.$tabdetail.'/'.$iddetail) !!}">Kembali</a></button>  -->   
                </div>
        {!! form()->close() !!}
</div>



