@extends('laravolt::layout.app2')

@section('content')
    <style type="text/css">
        /* 1. LATAR BELAKANG */
        body {
            background-color: #f0f2f5; /* Warna kelabu lembut, moden */
        }

        /* 2. PEMBUNGKUS UTAMA (WRAPPER) - INI YANG FIX ISU LOPONG */
        .form-layout-wrapper {
            max-width: 950px; /* Hadkan lebar supaya tak terlalu besar */
            margin: 20px auto; /* Tengahkan di skrin */
        }

        /* 3. HEADER ATAS (ACTION BAR) */
        #actionbar {
            background: #fff;
            padding: 20px;
            border-radius: 8px 8px 0 0; /* Bucu bulat atas sahaja */
            border-bottom: 2px solid #f0f0f0;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        }

        /* 4. KONTAINER BORANG */
        .main-form-container {
            background: white;
            padding: 30px;
            border-radius: 0 0 8px 8px; /* Bucu bulat bawah sahaja */
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            min-height: 500px;
        }

        /* 5. WARNA & STYLE SEKSYEN */
        .segment-header-blue { border-left: 5px solid #2185d0; background-color: #f0f9ff !important; padding: 15px !important; }
        .segment-header-teal { border-left: 5px solid #00b5ad; background-color: #f0fffe !important; padding: 15px !important; }
        .segment-header-green { border-left: 5px solid #21ba45; background-color: #f0fff4 !important; padding: 15px !important; }
        .segment-header-purple { border-left: 5px solid #a333c8; background-color: #fbf0ff !important; padding: 15px !important; }
        .segment-header-orange { border-left: 5px solid #f2711c; background-color: #fffaf0 !important; padding: 15px !important; }

        .ui.header { margin: 0 !important; font-weight: 700; }
        
        /* Label & Input tweaks */
        label { font-weight: 600 !important; color: #444; }
        label span.required { color: #db2828; }
        .ui.form .field { margin-bottom: 1.5em; } /* Jarak antara field lebih kemas */

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
        
        /* Preview Image */
        #divpreview img {
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-radius: 6px;
            max-width: 100%;
            max-height: 250px;
        }
    </style>

    {{-- WRAPPER UTAMA (Tengah & Limit Size) --}}
    <div class="form-layout-wrapper">

        {{-- 1. ACTION BAR --}}
        <div id="actionbar" class="ui grid middle aligned m-b-0">
            <div class="eight wide column">
                <h2 class="ui header blue">
                    <i class="user plus icon"></i>
                    <div class="content">
                        Tambah Maklumat KIR
                        <div class="sub header" style="font-size: 1.3rem;"> <b>{{ data_get($infokampung, 'NamaKampung') }}</b></div>
                    </div>
                </h2>
            </div>
            <div class="eight wide column right aligned">
                <a class="ui button basic small" href="{!! URL::to('dataentry/searchkampung/isirumah/ketuaisirumah/' . $idkampung) !!}">
                    <i class="arrow left icon"></i> Kembali
                </a>
            </div>
        </div>

        {{-- 2. BORANG UTAMA --}}
        <div class="main-form-container">
            
            {!! form()->open()->post()->action(route('dataentry::searchkampung.saveketuarumah'))->attribute('id', 'formstruk')->multipart()->horizontal() !!}
            <input type="hidden" name="idkampung" id="idkampung" value="{{$idkampung}}">
            <input type="hidden" name="wn" id="wn" value="">

            {{-- SEKSYEN 1: PROFIL (BIRU) --}}
            <div class="ui segment raised p-0 m-b-2 overflow-hidden">
                <div class="ui secondary segment segment-header-blue">
                    <h4 class="ui header blue"><i class="id card icon"></i> Profil Ketua Isi Rumah</h4>
                </div>
                <div class="ui form p-4">
                    <div class="two fields">
                        <div class="field">
                            <label>Nama Penuh <span class="required">*</span></label>
                            <input type="text" name="name" id="name" placeholder="NAMA PENUH (HURUF BESAR)" required>
                        </div>
                        <div class="field">
                            <label>Jenis Pengenalan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="typepengenalan" id="typepengenalan">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih Jenis</div>
                                <div class="menu">
                                    <div class="item" data-value="">Pilih</div>
                                    @foreach($jenispengenalan as $value)
                                        <div class="item" data-value="{{$value->id}}" onclick="warga({{$value->id}})">{{$value->description}}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- HYBRID INPUT --}}
                    <div class="ui visible message blue mini">
                        <p><i class="info circle icon"></i> Masukkan <b>No. Kad Pengenalan</b> untuk auto-isi (Tarikh Lahir, Jantina, Umur).</p>
                    </div>

                    <div class="two fields">
                        <div class="field" id="divnoic">
                            <label>No. Kad Pengenalan</label>
                            <div class="ui left icon input">
                                <i class="address card outline icon"></i>
                                <input max="14" name="noic" id="noic" type="text" placeholder="Contoh: 88010101xxxx" 
                                    onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" 
                                    onKeyPress="if(this.value.length==12) return false;">
                            </div>
                        </div>
                        <div class="field" id="divnopengenalan">
                            <label>No. Tentera/Polis/Passport <span class="required">*</span></label>
                            <input max="14" name="nopengenalan" id="nopengenalan" type="text">
                        </div>

                        <div class="field" id="jantinapilih">
                            <label>Jantina <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="jantina" id="jantina">
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
                        <div class="field" id="tlahircal">
                            <label>Tarikh Lahir <span class="required">*</span></label>
                            <div class="ui calendar" id="standard_calendar">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="text" id="tarikhlahir" name="tarikhlahir" readonly placeholder="DD/MM/YYYY">
                                </div>
                            </div>
                        </div>
                        <div class="field" id="tlahirauto">
                            <label>Tarikh Lahir (Auto) <span class="required">*</span></label>
                            <input type="text" id="tarikhlahirauto" name="tarikhlahirauto" readonly style="background: #eee;">
                        </div>

                        <div class="field">
                            <label>Umur (Tahun) <span class="required">*</span></label>
                            <input type="text" name="umur" id="umur" required>
                        </div>
                        
                        <div class="field">
                            <label>Bangsa <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="bangsa" id="bangsa">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($bangsa as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="three fields">
    
    <div class="field">
        <label>Warganegara <span class="required">*</span></label>
        
        <div style="border: 1px solid rgba(34,36,38,.15); border-radius: .28571429rem; height: 38px; display: flex; align-items: center; padding-left: 1em; background: #fff;">
            
            <div class="inline fields" style="margin: 0;">
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="warga" id="warga" value="1" disabled> 
                        <label>Ya</label>
                    </div>
                </div>
                <div class="field" style="padding-left: 15px;">
                    <div class="ui radio checkbox">
                        <input type="radio" name="warga" id="nonewarga" value="0" disabled> 
                        <label>Bukan</label>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="field">
        <label>Agama <span class="required">*</span></label>
        <div class="ui selection dropdown fluid">
            <input type="hidden" name="agama" id="agama">
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
            <input type="hidden" name="taraf" id="taraf">
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

             {{-- SEKSYEN 3: ALAMAT (HIJAU) --}}
            <div class="ui segment raised p-0 m-b-2 overflow-hidden">
                <div class="ui secondary segment segment-header-green">
                    <h4 class="ui header green"><i class="map marked icon"></i> Alamat Rumah</h4>
                </div>
                <div class="ui form p-4">
                    <div class="two fields">
                        <div class="field">
                            <label>Kategori Penempatan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="kategoripenempatan" id="kategoripenempatan">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($kategoripenempatan as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                       </div>
                    <div class="field">
                        <label>Alamat 1 <span class="required">*</span></label>
                        <input type="text" name="alamat1" id="alamat1" required>
                    </div>
                    <div class="field">
                        <label>Alamat 2</label>
                        <input type="text" name="alamat2" id="alamat2">
                    </div>
                    <div class="three fields">
                        <div class="field">
                            <label>Poskod <span class="required">*</span></label>
                            <input type="text" name="poskod" id="poskod" maxlength="5" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required>
                        </div>
                        <div class="field">
                            <label>No. Telefon </label>
                            <input type="text" name="notel" id="notel" placeholder="012xxxxxxx">
                        </div>
                        <div class="field">
                            <label>Emel</label>
                            <input type="text" name="emel" id="emel" placeholder="xxx@gmail.com">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field"><label>Latitud</label><input type="text" name="Latitud" id="Latitud"></div>
                        <div class="field"><label>Longitud</label><input type="text" name="Longitud" id="Longitud"></div>
                    </div>
                </div>
            </div>

            {{-- SEKSYEN 2: EKONOMI (TEAL) --}}
            <div class="ui segment raised p-0 m-b-2 overflow-hidden">
                <div class="ui secondary segment segment-header-teal">
                    <h4 class="ui header teal"><i class="money bill alternate icon"></i> Status Pekerjaan</h4>
                </div>
                <div class="ui form p-4">
                    <div class="two fields">
                        <div class="field">
                            <label>Status Pekerjaan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="statuskerja" id="statuskerja">
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
                            <input type="text" name="kerja" id="kerja" required>
                        </div>
                    </div>
                    <div class="three fields">
                        <div class="field">
                            <label>Pendapatan (RM) <span class="required">*</span></label>
                            <input type="text" name="pendapat" id="pendapat" placeholder="0.00" required>
                        </div>
                        <div class="field">
                            <label>Penerima Bantuan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="bantuanbulan" id="bantuanbulan">
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
                            <input type="text" name="bantuanlain" id="bantuanlain" readonly>
                        </div>
                    </div>
                </div>
            </div>

           
            {{-- SEKSYEN 4: MAKLUMAT FIZIKAL RUMAH (OREN) --}}
            <div class="ui segment raised p-0 m-b-2 overflow-hidden">
                <div class="ui secondary segment segment-header-orange">
                    <h4 class="ui header orange"><i class="home icon"></i> Maklumat Rumah</h4>
                </div>
                <div class="ui form p-4">
                    <div class="two fields">
                         <div class="field">
                            <label>Status Rumah <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="kependudukanrumah" id="kependudukanrumah">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($kependudukanrumah as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                         <div class="field">
                            <label>Keadaan Rumah <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="keadaanrumah" id="keadaanrumah">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($keadaanrumah as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="three fields">
                        <div class="field">
                            <label>Pemilikan Rumah <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="statusmilik" id="statusmilik">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($statusmilik as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Jenis Rumah <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="jenisrumah" id="jenisrumah">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($jenisrumah as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Jenis Binaan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="binaanrumah" id="binaanrumah">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($binaanrumah as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="two fields">
                         <div class="field">
                            <label>Bil. Tingkat <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="biltingkat" id="biltingkat">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($biltingkat as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                         <div class="field">
                            <label>Bil. Bilik <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="bilbilik" id="bilbilik">
                                <i class="dropdown icon"></i>
                                <div class="default text">Pilih</div>
                                <div class="menu">
                                    @foreach ($bilbilik as $value)
                                        <div class="item" data-value="{{ $value->id }}">{{ $value->description }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Upload Gambar --}}
                    <div class="field m-t-2">
                        <label>Muat Naik Gambar Rumah <span class="required">*</span></label>
                        <div class="ui grid">
                            <div class="eight wide column">
                                <div class="file-upload-box" onclick="document.getElementById('getFile').click()">
                                    <i class="cloud upload icon blue huge"></i>
                                    <p class="m-t-2"><b>Klik Di Sini</b> untuk memilih gambar<br><span class="text-muted small">(Format .jpg/.png, Max 3MB)</span></p>
                                    <input type='file' id="getFile" name="gambar" style="display:none">
                                </div>
                            </div>
                            <div class="eight wide column center aligned" id="divpreview" style="display:none">
                                <label class="d-block m-b-1">Pratonton:</label>
                                <img id="blah" src="#">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEKSYEN 5: KEMUDAHAN (UNGU) --}}
            <div class="ui segment raised p-0 m-b-2 overflow-hidden">
                <div class="ui secondary segment segment-header-purple">
                    <h4 class="ui header purple"><i class="plug icon"></i> Kemudahan Asas</h4>
                </div>
                <div class="ui form p-4">
                     <div class="ui stackable five column grid">
                        <div class="column">
                            <label class="d-block m-b-1"><b>Elektrik <span class="required">*</span></b></label>
                            <div class="ui radio checkbox m-r-2"><input type="radio" name="elektirk" value="1" required><label>Ada</label></div>
                            <div class="ui radio checkbox"><input type="radio" name="elektirk" value="0"><label>Tiada</label></div>
                        </div>
                        <div class="column">
                            <label class="d-block m-b-1"><b>Air Paip <span class="required">*</span></b></label>
                            <div class="ui radio checkbox m-r-2"><input type="radio" name="paip" value="1" required><label>Ada</label></div>
                            <div class="ui radio checkbox"><input type="radio" name="paip" value="0"><label>Tiada</label></div>
                        </div>
                        <!--div class="column">
                            <label class="d-block m-b-1"><b>Telefon <span class="required">*</span></b></label>
                            <div class="ui radio checkbox m-r-2"><input type="radio" name="ktel" value="1" required><label>Ada</label></div>
                            <div class="ui radio checkbox"><input type="radio" name="ktel" value="0"><label>Tiada</label></div>
                        </div>-->
                        <div class="column">
                            <label class="d-block m-b-1"><b>Internet <span class="required">*</span></b></label>
                            <div class="ui radio checkbox m-r-2"><input type="radio" name="internet" value="1" required><label>Ada</label></div>
                            <div class="ui radio checkbox"><input type="radio" name="internet" value="0"><label>Tiada</label></div>
                        </div>
                        <!--div class="column">
                            <label class="d-block m-b-1"><b>Astro <span class="required">*</span></b></label>
                            <div class="ui radio checkbox m-r-2"><input type="radio" name="astro" value="1" required><label>Ada</label></div>
                            <div class="ui radio checkbox"><input type="radio" name="astro" value="0"><label>Tiada</label></div>
                        </div> -->
                     </div>
                </div>
            </div>

            <div class="ui divider m-y-3"></div>

            {{-- SUBMIT AREA --}}
            <div class="ui center aligned basic segment p-b-4">
                 <div class="inline fields justify-center m-b-3">
                    <label><b>Status Semakan:</b> &nbsp;</label>
                    <div class="ui radio checkbox m-r-3">
                        <input type="radio" name="Status1" value="1"> <label>Telah Disemak</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="Status1" value="0" checked> <label>Belum Disemak</label>
                    </div>
                </div>
                
                <button type="submit" class="ui big primary button" id="addbutton" name="hantar" onclick="return validateketua();" style="width: 200px;">
                    <i class="save icon"></i> SIMPAN
                </button>
            </div>

            {!! form()->close() !!}
        </div>
    </div>
@endsection

{{-- JANGAN LUPA MASUKKAN KOD JAVASCRIPT HYBRID (AUTO/MANUAL) YANG SAYA BERIKAN SEBELUM INI DI BAWAH --}}
@push('script')
<script type="text/javascript">
    $(document).ready(function() {

        $('#wajib').hide();

        // --- UPPERCASE CONVERSION ---
        $('#name, #kerja, #bantuanlain, #alamat1, #alamat2').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });

        // --- CALENDAR CONFIG ---
        $('#standard_calendar').calendar({
            monthFirst: false,
            type: 'date',
            formatter: {
                date: function(date, settings) {
                    if (!date) return '';
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    return day + '/' + month + '/' + year;
                }
            },
            onChange: function(date, text) {
                if(date) {
                    const d = new Date();
                    let curyear = d.getFullYear();
                    var year = date.getFullYear();
                    var umur = curyear - parseInt(year);
                    $('#umur').val(umur);
                }
            },
        });

        // --- INITIAL HIDE/SHOW ---
        $('#tlahirauto').hide();
        $('#jantinaauto').hide();
        $('#divnopengenalan').hide();
        $('#divnopengenalannotes').hide();
        $('#divnoic').show();
        $('#divnoicnotes').show();

        // --- INPUT FORMATTING ---
        $("#pendapat").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });

        $("#pendapat, #Latitud, #Longitud").on("keyup keypress", function() {
            var valid = /^\d{0,20}(\.\d{0,8})?$/.test(this.value);
            if (!valid) {
                this.value = this.value.substring(0, this.value.length - 1);
            }
        });

        $("#noic").on("keyup", function() {
            var type = $("#typepengenalan").val();
            if (type == '') {
                alert('Sila Pilih Jenis Pengenalan');
                $("#noic").val('');
            }
             // Panggil logik auto-fill setiap kali user taip IC
             checkICLogic(this.value);
        });

        // --- BANTUAN LOGIC ---
        $("#bantuanbulan").change(function(e) {
            var jenis = this.value;
            if (jenis == 138) {
                $('#bantuanlain').prop('readonly', false);
                $('#wajib').show();
                $('#bantuanlain').attr('required', true);
            } else {
                $('#bantuanlain').prop('readonly', true);
                $('#bantuanlain').val(''); // Clear value jika bukan lain-lain
                $('#wajib').hide();
                $('#bantuanlain').attr('required', false);
            }
        });

        // --- FILE UPLOAD LOGIC ---
        $("input[id=getFile]").change(function() {
            var filename = this.files[0].name;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

            if (!allowedExtensions.exec(filename)) {
                alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                $("input[id=getFile]").val("");
                return false;
            }

            const fileSize = this.files[0].size / 1024 / 1024; // in MiB
            if (fileSize > 3) {
                alert('Saiz fail melebihi 3 MB')
                $("input[id=getFile]").val("");
                return false;
            }
        });

        $("#divpreview").hide();
        getFile.onchange = evt => {
            $("#divpreview").show();
            const [file] = getFile.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    });

    // --- FUNGSI UTAMA LOGIK IC (Hybrid Auto/Manual) ---
    function checkICLogic(icValue) {
        var type = $("#typepengenalan").val();
        
        // Hanya proses jika jenis pengenalan adalah 150 (IC Baru)
        if(type == 150) {
            
            // Jika IC Lengkap (12 digit) -> AUTO MODE
            if (icValue.length == 12) {
                // 1. Set Paparan Auto
                $('#tlahirauto').show();
                $('#tlahircal').hide();
                $('#jantinaauto').show();
                $('#jantinapilih').hide();
                
                // 2. Kunci Field
                $('#umur').prop('readonly', true);
                $('input[name="warga"]').prop('disabled', true);
                
                // 3. Set Warganegara Auto YA
                $("#warga").prop("checked", true);
                $("#wn").val(1);

                // 4. Logik Pengiraan
                const str = icValue;
                const substr = str.slice(0, 6);
                let year = substr.substring(0, 2);
                let month = substr.substring(2, 4);
                let day = substr.substring(4, 6);
                let startyear = substr.substring(0, 1);

                // Tentukan Tahun (19xx atau 20xx)
                var pangkal = (startyear == 0 || startyear == 1 || startyear == 2) ? '20' : '19';
                var lahir = day + '/' + month + '/' + pangkal + year;
                var tahun = pangkal + year;

                // Masukkan data ke field Auto
                $('#tarikhlahirauto').val(lahir);
                
                // Masukkan juga ke field hidden/manual supaya backend dapat data jika perlu
                $('#tarikhlahir').val(lahir); // Field manual hidden

                // Kira Umur
                const d = new Date();
                let curyear = d.getFullYear();
                var umur = curyear - parseInt(tahun);
                $('#umur').val(umur);

                // Tentukan Jantina
                let last = str.substring(11, 12);
                if (last % 2 == 0) {
                    $('#jauto').val('Perempuan');
                    $('#jantina').dropdown('set selected', '2'); // Set dropdown value (hidden)
                } else {
                    $('#jauto').val('Lelaki');
                    $('#jantina').dropdown('set selected', '1'); // Set dropdown value (hidden)
                }

            } 
            // Jika IC Tidak Lengkap atau Kosong -> MANUAL MODE
            else {
                // 1. Set Paparan Manual
                $('#tlahirauto').hide();
                $('#tlahircal').show();
                $('#jantinaauto').hide();
                $('#jantinapilih').show();

                // 2. Buka Kunci Field (Benarkan edit)
                $('#umur').prop('readonly', false); // Boleh edit umur jika perlu
                $('input[name="warga"]').prop('disabled', false); // Boleh pilih warganegara

                // Nota: Kita tak clear data serta merta supaya user tak hilang data kalau tersalah padam 1 digit
                // Tapi kalau kosong terus, mungkin boleh reset warganegara
                if(icValue.length == 0) {
                     $("#warga").prop("checked", false);
                     $("#nonewarga").prop("checked", false);
                     $("#wn").val('');
                     $('#umur').val('');
                     $('#tarikhlahir').val('');
                     $('#jantina').dropdown('clear');
                }
            }
        }
    }

    function warga(type) {
        var id_tidak_berkenaan = 169; // Pastikan ID ini betul

        // Reset Fields
        $('#noic').val('');
        $('#nopengenalan').val('');
        
        // --- SENARIO 1: KAD PENGENALAN BARU (150) ---
        if (type == 150) {
            // Default: Mode Manual (Sehingga user isi IC)
            $('#tlahirauto').hide();
            $('#tlahircal').show();
            $('#jantinaauto').hide();
            $('#jantinapilih').show();

            // Show IC Input
            $('#divnopengenalan').hide();
            $('#divnopengenalannotes').hide();
            $('#divnoic').show();
            $('#divnoicnotes').show();

            // IC TIDAK WAJIB (Mengikut request)
            $('#noic').attr('required', false);

            // Benarkan manual entry
            $('#umur').prop('readonly', false); 
            $('input[name="warga"]').prop('disabled', false);

            // Label
            $("#labellahir").html("Tarikh Lahir<font color='red'>*</font>");
            $("#labeljantina").html("Jantina<font color='red'>*</font>");
        }
        // --- SENARIO 2: TIDAK BERKENAAN ---
        else if (type == id_tidak_berkenaan) {
            $('#tlahirauto').hide();
            $('#tlahircal').show();
            $('#jantinaauto').hide();
            $('#jantinapilih').show();

            $('#divnopengenalan').hide();
            $('#divnopengenalannotes').hide();
            $('#divnoic').hide();
            $('#divnoicnotes').hide();

            $('#noic').attr('required', false);
            $('#nopengenalan').attr('required', false);

            $('#umur').prop('readonly', false);
            $('input[name="warga"]').prop('disabled', false);
            
             // Listener untuk update hidden wn
             $('input[name="warga"]').change(function(){
                $("#wn").val($(this).val());
            });
        }
        // --- SENARIO 3: LAIN-LAIN (Polis/Tentera/Passport) ---
        else {
            $('#tlahirauto').hide();
            $('#tlahircal').show();
            $('#jantinaauto').hide();
            $('#jantinapilih').show();

            $('#divnopengenalan').show();
            $('#divnopengenalannotes').show();
            $('#divnoic').hide();
            $('#divnoicnotes').hide();

            $('#noic').attr('required', false);
            $('#nopengenalan').attr('required', true); // No Pengenalan Lain wajib

            $('#umur').prop('readonly', false); // Boleh edit umur
            
            // Auto set warganegara ikut jenis (Boleh diubah jika nak manual)
            if (type == 152) { // PASSPORT
                $("#nonewarga").prop("checked", true);
                $("#wn").val(0);
                $('input[name="warga"]').prop('disabled', true);
            } else { 
                $("#warga").prop("checked", true);
                $("#wn").val(1);
                $('input[name="warga"]').prop('disabled', true);
            }
        }
    }

    function validateketua() {
        var typepengenalan = document.getElementById("typepengenalan").value;
        var jantina = document.getElementById("jantina").value;
        var bangsa = document.getElementById("bangsa").value;
        var agama = document.getElementById("agama").value;
        var taraf = document.getElementById("taraf").value;
        var statuskerja = document.getElementById("statuskerja").value;
        var bantuanbulan = document.getElementById("bantuanbulan").value;
        var kependudukanrumah = document.getElementById("kependudukanrumah").value;
        var keadaanrumah = document.getElementById("keadaanrumah").value;
        var statusmilik = document.getElementById("statusmilik").value;
        var binaanrumah = document.getElementById("binaanrumah").value;
        var biltingkat = document.getElementById("biltingkat").value;
        var jenisrumah = document.getElementById("jenisrumah").value;
        var bilbilik = document.getElementById("bilbilik").value;
        var umur = document.getElementById("umur").value;
        var gambar = document.getElementById("getFile").value;
        var emel = document.getElementById("emel").value;
        var tarikhlahir = $('#tarikhlahir').val(); // Ambil dari input manual (hidden/shown)
        
        // Logik Tambahan untuk tarikhlahir Auto
        if($('#tarikhlahirauto').is(":visible") && $('#tarikhlahirauto').val() != ""){
             tarikhlahir = $('#tarikhlahirauto').val();
        }

        var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

        if (typepengenalan == '') {
            alert('Sila Pilih Jenis Pengenalan');
            return false;
        }
        
        // Validation Flexible untuk IC
        // Kita tak check IC wajib, tapi kita check data peribadi wajib ada
        
        if (jantina == '') {
            alert('Sila Pilih Jantina');
            return false;
        }
        if (bangsa == '') {
            alert('Sila Pilih Bangsa');
            return false;
        }
        if (umur == '') {
            alert('Sila Masukan Umur atau Tarikh Lahir');
            return false;
        }
        if (tarikhlahir == '') { // Check variable tarikhlahir yang dah disatukan tadi
             alert('Sila Masukan Tarikh Lahir');
             return false;
        }
        if (agama == '') {
            alert('Sila Pilih Agama');
            return false;
        }
        if (taraf == '') {
            alert('Sila Pilih Taraf Perkahwinan');
            return false;
        }
        if (statuskerja == '') {
            alert('Sila Pilih Status Perkerjaan');
            return false;
        }
        if (bantuanbulan == '') {
            alert('Sila Pilih Penerima Bantuan (Bulanan)');
            return false;
        }
        if (bantuanbulan == 138 && $('#bantuanlain').val() == '') {
             alert('Sila Masukkan Bantuan Lain-lain');
             return false;
        }
        if (kependudukanrumah == '') {
            alert('Sila Pilih Status Rumah');
            return false;

        }
        if (keadaanrumah == '') {
            alert('Sila Pilih Keadaan Rumah');
            return false;
        }
        if (statusmilik == '') {
            alert('Sila Pilih Status Pemilikan Rumah');
            return false;
        }
        if (jenisrumah == '') {
            alert('Sila Pilih Jenis Rumah');
            return false;
        }
        if (binaanrumah == '') {
            alert('Sila Pilih Binaan Rumah');
            return false;
        }
        if (biltingkat == '') {
            alert('Sila Pilih Bilangan Tingkat');
            return false;
        }
        if (bilbilik == '') {
            alert('Sila Pilih Bilangan Bilik');
            return false;
        }
        if (gambar === '' || gambar === null) {
            alert('Sila masukan Gambar');
            return false;
        }
        if (emel != '' && email_reg.test(emel) == false) {
             alert('Sila Masukan alamat Emel yang betul');
             return false;
        }

        return true;
    }
</script>
@endpush