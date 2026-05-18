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
    #preview_images_grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }
</style>

<h3 class="ui top attached center aligned header">
    <i class="edit icon"></i> Kemaskini Maklumat Aktiviti
</h3>

<div class="ui attached segment">
    {!! form()->open()->post()->action(route('dataentry::searchkampung.editaktiviti'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}

    <input type="hidden" name="tabmain" value="{{$tabmain}}">
    <input type="hidden" name="tabdetail" value="{{$tabdetail}}">
    <input type="hidden" name="idkampung" value="{{$id}}">
    <input type="hidden" name="iddetail" value="{{$iddetail}}">

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
            <input type="text" name="aktiviti" id="aktiviti" required value="{{ data_get($data_aktiviti,'NamaAktiviti') }}" onkeyup="this.value = this.value.toUpperCase();">
        </div>
        <div class="field">
            <label>Penganjur <span style="color:red">*</span></label>
            <input type="text" name="penganjur" id="penganjur" required value="{{ data_get($data_aktiviti,'Penganjur') }}" onkeyup="this.value = this.value.toUpperCase();">
        </div>
    </div>

    <div class="field">
        <label>Keterangan Ringkas</label>
        <textarea id="keterangan" name="keterangan" rows="3" onkeyup="this.value = this.value.toUpperCase();">{{ data_get($data_aktiviti,'Keterangan') }}</textarea>
    </div>

    <h4 class="ui dividing header">Gambar</h4>
    <div class="field">
        <label>Pilih Gambar Baru (Jika Ingin Tukar)</label>
        <button type="button" class="ui button" onclick="document.getElementById('getFile_taktiviti_edit').click()">Pilih Fail</button>
        <input type="file" id="getFile_taktiviti_edit" name="gambar" accept=".jpg,.jpeg,.png" style="display:none">
        <p><small><b>* Saiz had: 3MB. Format: .jpg, .jpeg, .png</b></small></p>
    </div>

    <div class="field" id="divpreview_taktiviti_edit" style="display:none">
        <label>Preview Gambar Baru</label>
        <img style="width:200px" id="preview_taktiviti_edit" class="ui rounded image">
    </div>

    <div class="field">
        <label>Gambar Sedia Ada</label>
        @php $currentImg = data_get($data_aktiviti,'Gambar_path'); @endphp
        @if(!$currentImg || !file_exists(public_path(ltrim($currentImg, '/'))))
            <a target="_blank" href="{{ URL::asset('logo.png') }}">
                <img src="{{ URL::asset('logo.png') }}" alt="Default" style="width:200px" class="ui rounded image">
            </a>
        @else
            <a target="_blank" href="{{ URL::to($currentImg) }}">
                <img src="{{ URL::to($currentImg) }}" alt="Semasa" style="width:200px" class="ui rounded image">
            </a>
        @endif
    </div>

    <div class="ui divider section"></div>
    <div align="right">
        <button type="submit" class="ui primary button" id="btnSubmitEdit" onclick="return validateaktiviti();">
            <i class="save icon"></i> Kemaskini
        </button>
        <a href="#" class="ui button" onclick="gettab({{$id}},5,1,0)">Kembali</a>
    </div>

    {!! form()->close() !!}
</div>

<script>
    $(document).ready(function() {
        $('.ui.dropdown').dropdown();

        // Fungsi Preview Gambar (Sama logik dengan editprojek)
        $('#getFile_taktiviti_edit').on('change', function() {
            var file = this.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview_taktiviti_edit').attr('src', e.target.result);
                $('#divpreview_taktiviti_edit').show();
            }

            if (file) {
                if (file.size > 3 * 1024 * 1024) {
                    alert('Saiz fail melebihi 3MB!');
                    $(this).val('');
                    $('#divpreview_taktiviti_edit').hide();
                } else {
                    reader.readAsDataURL(file);
                }
            }
        });
    });

    function validateaktiviti() {
        var tahun = $("#tahun").val();
        var peringkat = $("#peringkat").val();
        var jenis = $("#jenisaktiviti").val();
        var aktiviti = $("#aktiviti").val();
        var penganjur = $("#penganjur").val();

        if(!tahun || !peringkat || !jenis || !aktiviti || !penganjur) {
            alert("Sila pastikan semua medan bertanda * diisi.");
            return false;
        }
        return true;
    }
</script>