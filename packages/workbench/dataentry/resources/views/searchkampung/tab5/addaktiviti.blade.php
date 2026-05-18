<h3 class="ui top attached center aligned header">
    <i class="edit icon"></i> Tambah Maklumat Aktiviti
</h3>

<div class="ui attached segment">

    {!! form()->open()->post()->action(route('dataentry::searchkampung.saveaktiviti'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

    <input type="hidden" name="tabmain" required="required" value="{{$tabmain}}">
    <input type="hidden" name="tabdetail" required="required" value="{{$tabdetail}}">
    <input type="hidden" name="idkampung" required="required" value="{{$id}}">
    <input type="hidden" name="iddetail" required="required" value="0">

    <h4 class="ui dividing header">Maklumat Asas</h4>
    <div class="three fields">
        <div class="field">
            <label>Tahun <span style="color:red">*</span></label>
            <div class="ui fluid search selection dropdown">
                <input type="hidden" name="tahun" id="tahun" value="{{ old('tahun') }}">
                <i class="dropdown icon"></i>
                <div class="default text">Sila Pilih</div>
                <div class="menu">
                    @php $this_year = date("Y"); @endphp
                    @for ($year = $this_year - 20; $year <= $this_year; $year++)
                        <div class="item" data-value="{{ $year }}">{{ $year }}</div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="field">
            <label>Peringkat <span style="color:red">*</span></label>
            <div class="ui fluid search selection dropdown">
                <input type="hidden" name="peringkat" id="peringkat" value="{{ old('peringkat') }}">
                <i class="dropdown icon"></i>
                <div class="default text">Sila Pilih</div>
                <div class="menu">
                    @foreach($peringkat as $key => $value)
                        <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="field">
            <label>Jenis Aktiviti <span style="color:red">*</span></label>
            <div class="ui fluid search selection dropdown">
                <input type="hidden" name="jenisaktiviti" id="jenisaktiviti" value="{{ old('jenisaktiviti') }}">
                <i class="dropdown icon"></i>
                <div class="default text">Sila Pilih</div>
                <div class="menu">
                    @foreach($kategori as $key => $value)
                        <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <h4 class="ui dividing header">Perincian Program</h4>
    <div class="two fields">
        <div class="field">
            <label>Nama Aktiviti <span style="color:red">*</span></label>
            <div class="ui input left icon">
                <i class="font icon"></i>
                <input type="text" name="aktiviti" id="aktiviti" placeholder="Contoh: Gotong Royong Perdana" required="required" value="{{ old('aktiviti') }}" onkeyup="this.value = this.value.toUpperCase();">
            </div>
        </div>
        <div class="field">
            <label>Penganjur <span style="color:red">*</span></label>
            <div class="ui input left icon">
                <i class="users icon"></i>
                <input type="text" name="penganjur" id="penganjur" placeholder="Contoh: JPKK Kampung Beng" required="required" value="{{ old('penganjur') }}" onkeyup="this.value = this.value.toUpperCase();">
            </div>
        </div>
    </div>

    <div class="field">
        <label>Keterangan Ringkas</label>
        <textarea id="keterangan" name="keterangan" rows="3" placeholder="Masukkan butiran ringkas aktiviti..." onkeyup="this.value = this.value.toUpperCase();"></textarea>
    </div>

    <h4 class="ui dividing header">Muat Naik Gambar</h4>
    <div class="field">
    <label>Gambar Aktiviti (Maksimum 3)</label>
    <button type="button" class="ui button" onclick="document.getElementById('getFile_taktiviti').click()">
        <i class="image icon"></i> Pilih Fail
    </button>
    <input type="file" id="getFile_taktiviti" name="gambar[]" multiple accept=".jpg,.jpeg,.png" style="display:none">
</div>

<div class="field" id="divpreview_taktiviti" style="display:none;">
    <label>Preview</label>
    <div id="preview_grid_aktiviti" class="ui small images"></div>
</div>

    <div class="field" id="preview_container" style="display:none; text-align: center;">
        <label>Pratonton Gambar:</label>
        <div class="ui small images" id="preview_images_grid">
            </div>
    </div>

    <div class="ui divider section"></div>
    
    <div style="text-align: right;">
        <a href="#" class="ui button" onclick="gettab({{$id}},5,1,0)" id="buttonbackdown">
            <i class="arrow left icon"></i> Kembali
        </a>
        <button type="submit" class="ui primary button" id="addbutton" name="hantar" onclick="return validateaktiviti();">
            <i class="save icon"></i> Simpan
        </button>
    </div>

    {!! form()->close() !!}
</div>

<script>
    $('#getFile_taktiviti').on('change', function() {
    var file = this.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        // Pastikan ID 'preview_taktiviti_kemaskini' wujud dalam HTML anda
        $('#preview_taktiviti_kemaskini').attr('src', e.target.result);
        $('#preview_container').show(); // Paparkan container preview
    }

    if (file) {
        reader.readAsDataURL(file);
    }
});
    });

    function validateaktiviti() {
        var tahun = document.getElementById("tahun").value;
        var peringkat = document.getElementById("peringkat").value;
        var jenis = document.getElementById("jenisaktiviti").value;
        var aktiviti = document.getElementById("aktiviti").value;
        var penganjur = document.getElementById("penganjur").value;

        if(tahun == "" || peringkat == "" || jenis == "" || aktiviti == "" || penganjur == "") {
            alert("Sila pastikan semua medan bertanda * diisi.");
            return false;
        }
        return true;
    }
</script>