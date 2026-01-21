@extends('laravolt::layout.app2')

@section('content')
    <style type="text/css">
        /* 1. LATAR BELAKANG */
        body {
            background-color: #f0f2f5;
        }

        /* 2. PEMBUNGKUS UTAMA (WRAPPER) */
        .form-layout-wrapper {
            max-width: 1200px;
            margin: 25px auto;
            /* Penting: Benarkan dropdown melimpah keluar dari wrapper */
            overflow: visible !important; 
        }

        /* 3. HEADER ATAS (ACTION BAR) */
        #actionbar {
            background: #fff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            border-bottom: 2px solid #f0f0f0;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        }

        /* 4. KONTAINER BORANG */
        .main-form-container {
            background: white;
            padding: 30px 30px 150px 30px !important;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            min-height: 800px;
            /* Pastikan dropdown tidak terpotong di sini */
            overflow: visible !important; 
        }

        .ui.segment.raised {
            overflow: visible !important; /* Wajib visible */
            position: relative;
            z-index: 10;
            margin-bottom: 2rem !important;
        }

        /* Layering Fix: Seksyen atas mesti lebih "Tinggi" (Z-index) dari bawah */
        .ui.segment.raised:nth-of-type(1) { z-index: 50 !important; }
        .ui.segment.raised:nth-of-type(2) { z-index: 40 !important; }
        .ui.segment.raised:nth-of-type(3) { z-index: 30 !important; }
        .ui.segment.raised:nth-of-type(4) { z-index: 20 !important; }
        .ui.segment.raised:nth-of-type(5) { z-index: 10 !important; }

        .ui.selection.dropdown .menu {
            z-index: 99999 !important;
            position: absolute !important;
            background: white !important;
            border: 1px solid #ccc !important;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19) !important;
        }

        /* 6. WARNA & STYLE SEKSYEN */
        .segment-header-blue { border-left: 5px solid #2185d0; background-color: #f0f9ff !important; padding: 15px !important; }
        .segment-header-teal { border-left: 5px solid #00b5ad; background-color: #f0fffe !important; padding: 15px !important; }
        .segment-header-green { border-left: 5px solid #21ba45; background-color: #f0fff4 !important; padding: 15px !important; }
        .segment-header-purple { border-left: 5px solid #a333c8; background-color: #fbf0ff !important; padding: 15px !important; }
        .segment-header-orange { border-left: 5px solid #f2711c; background-color: #fffaf0 !important; padding: 15px !important; }

        .ui.header { margin: 0 !important; font-weight: 700; }
        
        label { font-weight: 600 !important; color: #444; }
        label span.required { color: #db2828; }
        .ui.form .field { margin-bottom: 1.5em; overflow: visible !important; }

        /* File Upload */
        .file-upload-box {
            border: 2px dashed #d4d4d5;
            background: #f9fafb;
            padding: 25px;
            text-align: center;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .file-upload-box:hover { background: #e8f4fd; border-color: #2185d0; transform: translateY(-2px); }
        
        .field { overflow: visible !important; }
    </style>

    <div class="form-layout-wrapper">

        {{-- 1. HEADER ATAS --}}
        <div id="actionbar" class="ui grid middle aligned m-b-0">
            <div class="eight wide column">
                <h2 class="ui header blue">
                    <i class="edit icon"></i>
                    <div class="content">
                        Kemaskini Maklumat Ahli Isi Rumah
                        <div class="sub header" style="font-size: 1.1rem;"> <b>{{ data_get($infokampung, 'NamaKampung') }}</b></div>
                    </div>
                </h2>
            </div>
            <div class="eight wide column right aligned">
                <a class="ui button basic small" href="{!! URL::to('dataentry/searchkampung/isirumah/ahliisirumah/'.$idkampung.'/'.$idrumah) !!}">
                    <i class="arrow left icon"></i> Kembali
                </a>
            </div>
        </div>

        {{-- 2. BORANG UTAMA --}}
        <div class="main-form-container">
            {!! form()->open()->post()->action(route('dataentry::searchkampung.editahlirumah'))->attribute('id', 'formstruk')->multipart()->horizontal() !!}
            
            <input type="hidden" name="idkampung" value="{{$idkampung}}">
            <input type="hidden" name="idrumah" value="{{$idrumah}}">
            <input type="hidden" name="idahli" value="{{$idahli}}">
            <input type="hidden" name="wn" id="wn" value="">

            {{-- SEKSYEN 1: PROFIL AHLI (BIRU) - FUNGSI DISELARASKAN --}}
            <div class="ui segment raised p-0 m-b-2 overflow-hidden">
                <div class="ui secondary segment segment-header-blue">
                    <h4 class="ui header blue"><i class="user icon"></i> Profil Ahli Isi Rumah</h4>
                </div>
                <div class="ui form p-4">
                    
                    {{-- Id Isi Rumah (Readonly) --}}
                    <div class="field">
                        <label>ID Ahli Isi Rumah</label>
                        <input type="text" name="IdIsirumah" id="IdIsirumah" readonly="readonly" value="{{ data_get($ahliisirumah, 'IdIsiRumah') }}" style="background-color: #f9f9f9;">
                    </div>

                    {{-- Nama & Jenis Pengenalan --}}
                    <div class="two fields">
                        <div class="field">
                            <label>Nama Ahli Isi Rumah <span class="required">*</span></label>
                            <input type="text" name="name" id="name" required placeholder="NAMA PENUH" 
                                value="{{ data_get($ahliisirumah, 'Nama') }}"> 
                        </div>
                        <div class="field">
                            <label>Jenis Pengenalan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="typepengenalan" id="typepengenalan" value="{{ data_get($ahliisirumah, 'JenisPengenalan') }}">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    <div class="item" data-value="">Pilih</div>
                                    @foreach($jenispengenalan as $value)
                                        <div class="item" data-value="{{$value->id}}" onclick="warga({{$value->id}})">{{$value->description}}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Hybrid Input (IC/Manual) - SAMA MACAM KETUA RUMAH --}}
                    <div class="ui visible message blue mini">
                        <p><i class="info circle icon"></i> Masukkan <b>No. KP</b> untuk auto-isi (Tarikh Lahir, Jantina, Umur).</p>
                    </div>

                    <div class="two fields">
                        <div class="field" id="divnoic">
                            <label>No. Kad Pengenalan</label>
                            <div class="ui left icon input">
                                <i class="address card outline icon"></i>
                                <input max="14" name="noic" id="noic" type="text" placeholder="Contoh: 88010101xxxx"
                                    value="{{ data_get($ahliisirumah, 'NoKP') }}"
                                    onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" 
                                    onKeyPress="if(this.value.length==12) return false;">
                            </div>
                        </div>
                        <div class="field" id="divnopengenalan">
                            <label>No. Tentera/Polis/Passport <span class="required">*</span></label>
                            <input max="14" name="nopengenalan" id="nopengenalan" type="text" value="{{ data_get($ahliisirumah, 'NoKP') }}">
                        </div>

                        {{-- Jantina Logic Split --}}
                        <div class="field" id="jantinapilih">
                            <label>Jantina <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="jantina" id="jantina" value="{{ data_get($ahliisirumah, 'Jantina') }}">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($jantina as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field" id="jantinaauto">
                            <label>Jantina (Auto) <span class="required">*</span></label>
                            <input type="text" id="jauto" name="jauto" readonly class="disabled-input" style="background: #eee;">
                        </div>
                    </div>

                    <div class="three fields">
                        {{-- Calendar Auto (Readonly) --}}
                        <div class="field" id="tlahirauto">
                            <label>Tarikh Lahir (Auto) <span class="required">*</span></label>
                            <input type="text" id="tarikhlahirauto" name="tarikhlahirauto" readonly style="background: #eee;" 
                            value="{{ date('d/m/Y', strtotime(data_get($ahliisirumah, 'TarikhLahir'))) }}">
                        </div>

                        {{-- Calendar Manual (Editable) --}}
                        <div class="field" id="tlahircaledit">
                            <label>Tarikh Lahir <span class="required">*</span></label>
                            <div class="ui calendar" id="standard_calendaredit">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" id="tarikhlahiredit" name="tarikhlahiredit" readonly placeholder="DD/MM/YYYY" 
                                    value="{{ date('d/m/Y', strtotime(data_get($ahliisirumah, 'TarikhLahir'))) }}">
                                </div>
                            </div>
                        </div>
                        
                        {{-- Field Hidden untuk Sync --}}
                        <div class="field" id="tlahircal" style="display:none;">
                             <label>Tarikh Lahir</label>
                             <input type="text" id="tarikhlahir" name="tarikhlahir">
                        </div>

                        <div class="field">
                            <label>Umur (Tahun) <span class="required">*</span></label>
                            <input type="text" name="umur" id="umur" required readonly> 
                        </div>
                        
                        {{-- Warganegara Group --}}
                        <div class="field">
                            <label>Warganegara <span class="required">*</span></label>
                            <div style="border: 1px solid rgba(34,36,38,.15); border-radius: .28571429rem; height: 38px; display: flex; align-items: center; padding-left: 1em; background: #fff;">
                                <div class="inline fields" style="margin: 0;">
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="warga" id="warga" value="1" disabled> <label>Ya</label>
                                        </div>
                                    </div>
                                    <div class="field" style="padding-left: 15px;">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="warga" id="nonewarga" value="0" disabled> <label>Bukan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="three fields">
                        <div class="field">
                            <label>Bangsa <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="bangsa" id="bangsa" value="{{ data_get($ahliisirumah, 'Bangsa') }}">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($bangsa as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Agama <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="agama" id="agama" value="{{ data_get($ahliisirumah, 'Agama') }}">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($agama as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Taraf Perkahwinan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="taraf" id="taraf" value="{{ data_get($ahliisirumah, 'TarafKahwin') }}">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($taraf as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEKSYEN 2: PEKERJAAN (TEAL) --}}
            <div class="ui segment raised p-0 m-b-2 overflow-hidden">
                <div class="ui secondary segment segment-header-teal">
                    <h4 class="ui header teal"><i class="briefcase icon"></i> Maklumat Pekerjaan & Pendapatan</h4>
                </div>
                <div class="ui form p-4">
                    <div class="three fields">
                        <div class="field">
                            <label>Status Pekerjaan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="statuskerja" id="statuskerja" value="{{ data_get($ahliisirumah, 'StatusPekerjaan') }}">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($statuskerja as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Pekerjaan <span class="required">*</span></label>
                            <input type="text" name="kerja" id="kerja" required value="{{ data_get($ahliisirumah, 'Pekerjaan') }}">
                        </div>
                        <div class="field">
                            <label>Pendapatan (RM) <span class="required">*</span></label>
                            <input type="text" name="pendapat" id="pendapat" placeholder="0.00" required value="{{ number_format(data_get($ahliisirumah, 'Pendapatan'), 2, '.', '') }}">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Penerima Bantuan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="bantuanbulan" id="bantuanbulan" value="{{ data_get($ahliisirumah, 'PenerimaBantuan') }}">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($bantuanbulanan as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Bantuan Lain-Lain <span id="wajib" class="required">*</span></label>
                            <input type="text" name="bantuanlain" id="bantuanlain" readonly value="{{ data_get($ahliisirumah, 'BantuanLain') }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui center aligned basic segment">
                <button type="submit" class="ui big primary button" id="addbutton" name="hantar" onclick="return validateahli();" style="width: 200px;">
                    <i class="save icon"></i> KEMASKINI
                </button>
            </div>

            {!! form()->close() !!}
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        // Fix untuk Dropdown dalam Card (supaya tak kena potong/hidden)
        $('.ui.dropdown').dropdown({
            direction: 'auto',
            context: 'body', 
            keepOnScreen: true
        });

        $('#wajib').hide();

        // Uppercase conversion
        $('#name, #kerja, #bantuanlain').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });

        // Initialize Calendar (Manual Input)
        $('#standard_calendaredit').calendar({
            monthFirst: false, type: 'date',
            formatter: {
                date: function(date, settings) {
                    if (!date) return '';
                    var day = date.getDate(); var month = date.getMonth() + 1; var year = date.getFullYear();
                    return day + '-' + month + '-' + year;
                }
            },
            onChange: function(date, text) {
                if(date) {
                    const d = new Date(); let curyear = d.getFullYear(); var year = date.getFullYear();
                    $('#umur').val(curyear - parseInt(year));
                }
            },
        });

        // Input Formatting
        $("#pendapat").change(function() { $(this).val(parseFloat($(this).val()).toFixed(2)); });
        $("#pendapat").on("keyup keypress", function() {
            var valid = /^\d{0,20}(\.\d{0,8})?$/.test(this.value);
            if (!valid) this.value = this.value.substring(0, this.value.length - 1);
        });

        // IC Input Logic
        $("#noic").on("keyup", function() {
            var type = $("#typepengenalan").val();
            if (type == '') { alert('Sila Pilih Jenis Pengenalan'); $("#noic").val(''); }
            checkICLogic(this.value);
        });

        // Bantuan Logic
        var jenisBantuanAwal = "{{ data_get($ahliisirumah, 'PenerimaBantuan') }}";
        if(jenisBantuanAwal == 138) { $('#wajib').show(); $('#bantuanlain').prop('readonly', false).attr('required', true); }

        $("#bantuanbulan").change(function(e) {
            var jenis = this.value;
            if (jenis == 138) {
                $('#bantuanlain').prop('readonly', false); $('#wajib').show(); $('#bantuanlain').attr('required', true);
            } else {
                $('#bantuanlain').prop('readonly', true); $('#bantuanlain').val(''); $('#wajib').hide(); $('#bantuanlain').attr('required', false);
            }
        });

        // --- INITIAL DATA LOAD & SETUP ---
        var savedType = "{{ data_get($ahliisirumah, 'JenisPengenalan') }}";
        var savedLahir = "{{ date('d/m/Y', strtotime(data_get($ahliisirumah, 'TarikhLahir'))) }}";
        
        // Calculate Initial Age
        if(savedLahir) {
            var parts = savedLahir.split('/'); var tahunLahir = parts[2];
            const d = new Date(); let curyear = d.getFullYear();
            $('#umur').val(curyear - parseInt(tahunLahir));
        }

        // Set Paparan Awal (Logic Hybrid)
        warga(savedType); 
        
        // Jika IC Baru, setkan semula logic auto supaya field auto diisi
        if(savedType == 150) {
             $('#noic').val("{{ data_get($ahliisirumah, 'NoKP') }}");
             checkICLogic($('#noic').val());
        }
    });

    // --- LOGIC FUNCTIONS (Auto vs Manual) ---
    function checkICLogic(icValue) {
        var type = $("#typepengenalan").val();
        if(type == 150) {
            if (icValue.length == 12) {
                // Auto Mode Active
                $('#tlahirauto').show(); $('#tlahircal').hide(); $('#tlahircaledit').hide();
                $('#jantinaauto').show(); $('#jantinapilih').hide();
                $('#umur').prop('readonly', true);
                $('input[name="warga"]').prop('disabled', true);
                $("#warga").prop("checked", true); $("#wn").val(1);

                const str = icValue;
                let year = str.substring(0, 2); let month = str.substring(2, 4); let day = str.substring(4, 6); let startyear = str.substring(0, 1);
                var pangkal = (startyear == 0 || startyear == 1 || startyear == 2) ? '20' : '19';
                var lahir = day + '/' + month + '/' + pangkal + year; var tahun = pangkal + year;

                $('#tarikhlahirauto').val(lahir);
                $('#tarikhlahir').val(lahir); 

                const d = new Date(); let curyear = d.getFullYear();
                $('#umur').val(curyear - parseInt(tahun));

                let last = str.substring(11, 12);
                if (last % 2 == 0) { $('#jauto').val('Perempuan'); $('#jantina').dropdown('set selected', '2'); }
                else { $('#jauto').val('Lelaki'); $('#jantina').dropdown('set selected', '1'); }
            } else {
                // Fallback Manual (jika IC tak lengkap)
                if(icValue.length == 0) {
                     $("#warga").prop("checked", false); $("#nonewarga").prop("checked", false); $("#wn").val('');
                }
            }
        }
    }

    function warga(type) {
        var id_tidak_berkenaan = 169; 

        // Reset display state
        $('#tarikhlahirauto').val(''); $('#tarikhlahiredit').val('');
        $('#jauto').val('');

        if (type == 150) { // NEW IC
            $('#tlahirauto').show(); $('#tlahircal').hide(); $('#tlahircaledit').hide();
            $('#jantinaauto').show(); $('#jantinapilih').hide();
            $('#divnopengenalan').hide(); $('#divnoic').show();
            $('#noic').attr('required', true);
            $('#umur').prop('readonly', true);
            $('input[name="warga"]').prop('disabled', true);
            
            $("#noic").off("keyup").on("keyup", function() { checkICLogic(this.value); });

        } else if (type == id_tidak_berkenaan) { // TIDAK BERKENAAN
            $('#tlahirauto').hide(); $('#tlahircal').hide(); $('#tlahircaledit').show();
            $('#jantinaauto').hide(); $('#jantinapilih').show();
            $('#divnopengenalan').hide(); $('#divnoic').hide();
            $('#noic').attr('required', false); $('#nopengenalan').attr('required', false);
            $('#umur').prop('readonly', false);
            $('input[name="warga"]').prop('disabled', false);
            $('input[name="warga"]').change(function(){ $("#wn").val($(this).val()); });

        } else { // LAIN-LAIN
            $('#tlahirauto').hide(); $('#tlahircal').hide(); $('#tlahircaledit').show();
            $('#jantinaauto').hide(); $('#jantinapilih').show();
            $('#divnopengenalan').show(); $('#divnoic').hide();
            $('#noic').attr('required', false); $('#nopengenalan').attr('required', true);
            $('#umur').prop('readonly', false);
            
            if (type == 152) { 
                $("#nonewarga").prop("checked", true); $("#wn").val(0); $('input[name="warga"]').prop('disabled', true);
            } else { 
                $("#warga").prop("checked", true); $("#wn").val(1); $('input[name="warga"]').prop('disabled', true);
            }
        }
    }

    function validateahli() {
        var typepengenalan = document.getElementById("typepengenalan").value;
        if (typepengenalan == '') { alert('Sila Pilih Jenis Pengenalan'); return false; }
        
        var ic = $('#noic').val();
        if (typepengenalan == 150 && ic.length < 12) { alert('Sila Masukan 12 digit No. Kad Pengenalan'); return false; }

        return true;
    }
</script>
@endpush