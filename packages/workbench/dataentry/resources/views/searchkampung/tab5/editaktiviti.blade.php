<style>
    .gallery-thumb {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 5px;
        border: 1px solid #ddd;
        margin: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
</style>

<h3 class="ui top attached center aligned header">
    <i class="edit icon"></i> Kemaskini Maklumat Aktiviti
</h3>

<div class="ui attached segment">

    {!! form()->open()->post()->action(route('dataentry::searchkampung.editaktiviti'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

    <input type="hidden" name="tabmain" required="required" value="{{$tabmain}}">
    <input type="hidden" name="tabdetail" required="required" value="{{$tabdetail}}">
    <input type="hidden" name="idkampung" required="required" value="{{$id}}">
    <input type="hidden" name="iddetail" required="required" value="{{$iddetail}}">

    <h4 class="ui dividing header">Maklumat Asas</h4>
    <div class="three fields">
        <div class="field">
            <label>Tahun <span style="color:red">*</span></label>
            <div class="ui fluid search selection dropdown">
                <input type="hidden" name="tahun" id="tahun" value="{{ data_get($data_aktiviti,'Tahun') }}">
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
                <input type="hidden" name="peringkat" id="peringkat" value="{{ data_get($data_aktiviti,'Peringkat') }}">
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
                <input type="hidden" name="jenisaktiviti" id="jenisaktiviti" value="{{ data_get($data_aktiviti,'Kategori') }}">
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
                <input type="text" name="aktiviti" id="aktiviti" required="required" value="{{ data_get($data_aktiviti,'NamaAktiviti') }}" onkeyup="this.value = this.value.toUpperCase();">
            </div>
        </div>
        <div class="field">
            <label>Penganjur <span style="color:red">*</span></label>
            <div class="ui input left icon">
                <i class="users icon"></i>
                <input type="text" name="penganjur" id="penganjur" required="required" value="{{ data_get($data_aktiviti,'Penganjur') }}" onkeyup="this.value = this.value.toUpperCase();">
            </div>
        </div>
    </div>

    <div class="field">
        <label>Keterangan Ringkas</label>
        <textarea id="keterangan" name="keterangan" rows="3" onkeyup="this.value = this.value.toUpperCase();">{{ data_get($data_aktiviti,'Keterangan') }}</textarea>
    </div>

    <h4 class="ui dividing header">Gambar Sedia Ada</h4>
    <div class="field">
        <div class="ui segment">
            <div class="ui small images">
                @if(data_get($data_aktiviti,'Gambar_path') == '' || !file_exists(public_path(data_get($data_aktiviti,'Gambar_path'))))
                    <div class="ui label basic">Tiada gambar utama</div>
                @else
                    <a target="_blank" href="{!! URL::to(data_get($data_aktiviti,'Gambar_path')) !!}">
                        <img src="{!! URL::to(data_get($data_aktiviti,'Gambar_path')) !!}" class="gallery-thumb" alt="Gambar Utama">
                    </a>
                @endif

                {{-- @foreach($gambar_tambahan as $g)
                    <a target="_blank" href="{{ URL::to($g->path_gambar) }}">
                        <img src="{{ URL::to($g->path_gambar) }}" class="gallery-thumb">
                    </a>
                @endforeach --}}
            </div>
        </div>
    </div>

    <h4 class="ui dividing header">Tambah Gambar Baru</h4>
    <div class="field">
        <div class="ui placeholder segment">
            <div class="ui icon header">
                <i class="images outline icon"></i>
                Muat Naik Gambar Tambahan (Maksimum 3 Keping Sekali Muat Naik)
            </div>
            
            <input type="file" id="getFile_taktiviti_edit" name="gambar[]" multiple accept=".jpg,.jpeg,.png" style="display:none">
            
            <div class="ui primary button" onclick="document.getElementById('getFile_taktiviti_edit').click()">
                <i class="upload icon"></i> Pilih Fail
            </div>
            <div class="ui hidden divider"></div>
            <div style="color: gray; font-size: 0.9em;">
                <i class="info circle icon"></i> Saiz had: 3MB/fail. Format: .jpg, .jpeg, .png
            </div>
        </div>
    </div>

    <div class="field" id="preview_container" style="display:none; text-align: center;">
        <label>Pratonton Gambar Baru:</label>
        <div class="ui small images" id="preview_images_grid"></div>
    </div>

    <div class="ui divider section"></div>
    <div align="right">
        <a href="#" class="ui button" onclick="gettab({{$id}},5,1,0)" id="buttonbackdown">
            <i class="arrow left icon"></i> Kembali
        </a>
        <button type="submit" class="ui primary button" id="addbutton" name="hantar" onclick="return validateaktiviti();">
            <i class="save icon"></i> Kemaskini
        </button>
    </div>

    {!! form()->close() !!}
</div>

<script>
    $(document).ready(function() {
        $('.ui.dropdown').dropdown();

        // Logic Preview Gambar Baru
        $('#getFile_taktiviti_edit').on('change', function() {
            var files = this.files;
            var maxFiles = 3;
            var maxSize = 3 * 1024 * 1024; // 3MB
            var previewGrid = $('#preview_images_grid');
            var container = $('#preview_container');

            previewGrid.empty();
            
            if (files.length > maxFiles) {
                alert('Harap maaf, anda hanya boleh memuat naik maksimum ' + maxFiles + ' gambar pada satu masa.');
                this.value = ''; 
                container.hide();
                return;
            }

            if (files.length > 0) {
                container.show();
                $.each(files, function(i, file) {
                    if (file.size > maxSize) {
                        alert('Fail ' + file.name + ' terlalu besar (Melebihi 3MB).');
                        $('#getFile_taktiviti_edit').val(''); 
                        container.hide();
                        return false; 
                    }
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imgHtml = '<img class="ui image rounded bordered gallery-thumb" src="' + e.target.result + '">';
                        previewGrid.append(imgHtml);
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                container.hide();
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