<h4 class="ui top attached header">
  Tambah Projek
</h4>
<div class="ui attached segment">

  {!! form()->open()->post()->action(route('dataentry::searchkampung.saveprojek'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

  <input type="hidden" name="tabmain" required="required" value="{{$tabmain}}">
  <input type="hidden" name="tabdetail" required="required" value="{{$tabdetail}}">
  <input type="hidden" name="idkampung" required="required" value="{{$id}}">
  <input type="hidden" name="iddetail" required="required" value="0">

  <?php $this_year = date("Y");
// Run this only once
?>

  <div class="field">
    <label>Tahun<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown">
      <input type="hidden" name="tahun" id="tahun" value="{{ old('tahun') }}">
      <i class="dropdown icon"></i>
      <div class="default text">Sila Pilih</div>
      <div class="menu">
        <div class="item" data-value="">Sila Pilih</div>
        <?php for ($year = $this_year - 20; $year <= $this_year; $year++) { ?>
        <?php echo '<div class="item" data-value="' .
        $year .
        '">' .
        $year .
        "</div>"; ?>

        <?php } ?>
      </div>
    </div>
  </div>
  <div class="field">
    <label>Jenis Projek<font color="red">*</font></label>
    <div class="ui fluid search selection dropdown">
      <input type="hidden" name="jenisprojek" id="jenisprojek" value="{{ old('jenisprojek') }}">
      <i class="dropdown icon"></i>
      <div class="default text">Sila Pilih</div>
      <div class="menu">
        <div class="item" data-value="">Sila Pilih</div>
        @foreach($jenisprojek as $key => $value)
        <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="field">
    <label>Nama Projek<font color="red">*</font></label>
    <input type="text" name="namaprojek" id="namaprojek" required="required" value="{{ old('namaprojek') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Lokasi Projek<font color="red">*</font></label>
    <input type="text" name="lokasi" id="lokasi" required="required" value="{{ old('lokasi') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Sumber Kewangan<font color="red">*</font></label>
    <input type="text" name="sumber" id="sumber" required="required" value="{{ old('sumber') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " onkeyup="this.value = this.value.toUpperCase();">
  </div>
  <div class="field">
    <label>Objektif Projek<font color="red">*</font></label>
    <textarea id="objektif" name="objektif" onkeyup="this.value = this.value.toUpperCase();"></textarea>
  </div>
  <div class="field">
    <label>Penerangan Projek<font color="red">*</font></label>
    <textarea id="keterangan" name="keterangan" onkeyup="this.value = this.value.toUpperCase();"></textarea>
  </div>
  <div class="field">
    <label>Agensi Perlaksana<font color="red">*</font></label>
    <textarea id="agensi" name="agensi" onkeyup="this.value = this.value.toUpperCase();"></textarea>
  </div>
  <div class="field">
    <label>Gambar</label>
    <button type="button" style="display:block;width:20px; height:40px;" onclick="document.getElementById('getFile_tprojek').click()">Pilih Fail</button>
    <input type='file' id="getFile_tprojek" name="gambar" value="{{ old('gambar') }}" style="width: 700px;height: 40px;">
  </div>
 <div class="field">
   <label>&nbsp;</label>
   <b><font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan</b>
</div>
  <div class="field" id="divpreview_tprojek">
    <label>Preview</label>
    <a target="_blank"><img style="width:200px" id="preview_tprojek">
    </a>

  </div>

  <div class="ui divider section"></div>
  <div align="right">
    <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validateprojek();">
      Simpan
    </button>
   <a class="ui button" href="#" onclick="gettab({{$id}},7,1,0)" id="buttonbackdown">Kembali</a>
  </div>


  {!! form()->close() !!}
</div>