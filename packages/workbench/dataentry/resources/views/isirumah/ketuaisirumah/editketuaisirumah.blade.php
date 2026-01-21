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
            margin-bottom: 80px !important;
        }

        .ui.selection.dropdown .menu {
            z-index: 9999 !important;
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
        .ui.form .field { margin-bottom: 1.5em; }

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
        
        #divpreview img {
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-radius: 6px;
            max-width: 100%;
            max-height: 250px;
        }

        .field {
        overflow: visible !important;
    }


    </style>

    {{-- WRAPPER UTAMA --}}
    <div class="form-layout-wrapper">

        {{-- 1. ACTION BAR --}}
        <div id="actionbar" class="ui grid middle aligned m-b-0">
            <div class="eight wide column">
                <h2 class="ui header blue">
                    <i class="edit icon"></i>
                    <div class="content">
                        Kemaskini Maklumat KIR
                        <div class="sub header" style="font-size: 1.1rem;"> <b>{{ data_get($infokampung, 'NamaKampung') }}</b></div>
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
            
            {!! form()->open()->post()->action(route('dataentry::searchkampung.editketuarumah'))->attribute('id', 'formstruk')->multipart()->horizontal() !!}
            <input type="hidden" name="idkampung" id="idkampung" value="{{ $idkampung }}">
            <input type="hidden" name="idisirumah" id="idisirumah" value="{{ $idisirumah }}">
            <input type="hidden" name="ketuaisirumah" id="ketuaisirumah" value="{{ data_get($ketuaisirumah, 'rumah.id') }}">
            <input type="hidden" name="wn" id="wn" value=""> {{-- Auto populated via JS --}}

            {{-- SEKSYEN 1: PROFIL (BIRU) --}}
            <div class="ui segment raised p-0 m-b-2 overflow-hidden">
                <div class="ui secondary segment segment-header-blue">
                    <h4 class="ui header blue"><i class="id card icon"></i> Profil Ketua Isi Rumah</h4>
                </div>
                <div class="ui form p-4">
                    <div class="two fields">
                        <div class="field">
                            <label>Nama Penuh <span class="required">*</span></label>
                            <input type="text" name="name" id="name" placeholder="NAMA PENUH (HURUF BESAR)" required value="{{ data_get($ketuaisirumah, 'Nama') }}">
                        </div>
                        <div class="field">
                            <label>Jenis Pengenalan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="typepengenalan" id="typepengenalan" value="{{ data_get($ketuaisirumah, 'JenisPengenalan') }}">
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
                                    value="{{ data_get($ketuaisirumah, 'NoKP') }}"
                                    onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" 
                                    onKeyPress="if(this.value.length==12) return false;">
                            </div>
                        </div>
                        <div class="field" id="divnopengenalan">
                            <label>No. Tentera/Polis/Passport <span class="required">*</span></label>
                            <input max="14" name="nopengenalan" id="nopengenalan" type="text" value="{{ data_get($ketuaisirumah, 'NoKP') }}">
                        </div>

                        <div class="field" id="jantinapilih">
                            <label>Jantina <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="jantina" id="jantina" value="{{ data_get($ketuaisirumah, 'Jantina') }}">
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
                                    <input type="text" id="tarikhlahir" name="tarikhlahir" readonly placeholder="DD/MM/YYYY" 
                                    value="{{ date('d/m/Y', strtotime(data_get($ketuaisirumah, 'TarikhLahir'))) }}">
                                </div>
                            </div>
                        </div>
                        <div class="field" id="tlahirauto">
                            <label>Tarikh Lahir (Auto) <span class="required">*</span></label>
                            <input type="text" id="tarikhlahirauto" name="tarikhlahirauto" readonly style="background: #eee;" 
                            value="{{ date('d/m/Y', strtotime(data_get($ketuaisirumah, 'TarikhLahir'))) }}">
                        </div>

                        <div class="field">
                            <label>Umur (Tahun) <span class="required">*</span></label>
                            <input type="text" name="umur" id="umur" required> {{-- Value set by JS on load --}}
                        </div>
                        
                        <div class="field">
                            <label>Bangsa <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="bangsa" id="bangsa" value="{{ data_get($ketuaisirumah, 'Bangsa') }}">
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

                    <div class="two fields">
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
                        <div class="field">
                            <label>Agama <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="agama" id="agama" value="{{ data_get($ketuaisirumah, 'Agama') }}">
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
                                <input type="hidden" name="taraf" id="taraf" value="{{ data_get($ketuaisirumah, 'TarafKahwin') }}">
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
                                <input type="hidden" name="kategoripenempatan" id="kategoripenempatan" value="{{ data_get($ketuaisirumah, 'kategoripenempatan') }}">
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
                        <input type="text" name="alamat1" id="alamat1" required value="{{ data_get($ketuaisirumah, 'rumah.AlamatRumah1') }}">
                    </div>
                    <div class="field">
                        <label>Alamat 2</label>
                        <input type="text" name="alamat2" id="alamat2" value="{{ data_get($ketuaisirumah, 'rumah.AlamatRumah2') }}">
                    </div>
                    <div class="three fields">
                        <div class="field">
                            <label>Poskod <span class="required">*</span></label>
                            <input type="text" name="poskod" id="poskod" maxlength="5" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required value="{{ data_get($ketuaisirumah, 'rumah.Poskod') }}">
                        </div>
                        <div class="field">
                            <label>No. Telefon <span class="required">*</span></label>
                            <input type="text" name="notel" id="notel" placeholder="012xxxxxxx" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required value="{{ data_get($ketuaisirumah, 'TelNo') }}">
                        </div>
                        <div class="field">
                            <label>Emel</label>
                            <input type="text" name="emel" id="emel" value="{{ data_get($ketuaisirumah, 'Email') }}">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field"><label>Latitud</label><input type="text" name="Latitud" id="Latitud" value="{{ data_get($ketuaisirumah, 'rumah.Latitud') }}"></div>
                        <div class="field"><label>Longitud</label><input type="text" name="Longitud" id="Longitud" value="{{ data_get($ketuaisirumah, 'rumah.Longitud') }}"></div>
                    </div>

                        <div class="field">
                        <label>Pin Lokasi Rumah (Sila klik pada peta untuk set koordinat)</label>
                        <div id="map"></div>
                        <small class="text-muted">* Seret penanda (marker) atau klik pada peta untuk mengemaskini koordinat.</small>
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
                                <input type="hidden" name="statuskerja" id="statuskerja" value="{{ data_get($ketuaisirumah, 'StatusPekerjaan') }}">
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
                            <input type="text" name="kerja" id="kerja" required value="{{ data_get($ketuaisirumah, 'Pekerjaan') }}">
                        </div>
                    </div>
                    <div class="three fields">
                        <div class="field">
                            <label>Pendapatan (RM) <span class="required">*</span></label>
                            <input type="text" name="pendapat" id="pendapat" placeholder="0.00" required value="{{ data_get($ketuaisirumah, 'Pendapatan') }}">
                        </div>
                        <div class="field">
                            <label>Penerima Bantuan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="bantuanbulan" id="bantuanbulan" value="{{ data_get($ketuaisirumah, 'PenerimaBantuan') }}">
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
                            <input type="text" name="bantuanlain" id="bantuanlain" readonly value="{{ data_get($ketuaisirumah, 'BantuanLain') }}">
                        </div>
                    </div>
                </div>
            </div>

           

            {{-- SEKSYEN 4: FIZIKAL RUMAH (OREN) --}}
            <div class="ui segment raised p-0 m-b-2 overflow-hidden">
                <div class="ui secondary segment segment-header-orange">
                    <h4 class="ui header orange"><i class="home icon"></i> Maklumat Rumah</h4>
                </div>
                <div class="ui form p-4">
                    <div class="two fields">
                         <div class="field">
                            <label>Status Rumah <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="kependudukanrumah" id="kependudukanrumah" value="{{ data_get($ketuaisirumah, 'rumah.kependudukanrumah') }}">
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
                            <label>Keadaan Ruman <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="keadaanrumah" id="keadaanrumah" value="{{ data_get($ketuaisirumah, 'rumah.keadaanrumah') }}">
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
                            <label>Status Pemilikan <span class="required">*</span></label>
                            <div class="ui selection dropdown fluid">
                                <input type="hidden" name="statusmilik" id="statusmilik" value="{{ data_get($ketuaisirumah, 'rumah.StatusMilikan') }}">
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
                                <input type="hidden" name="jenisrumah" id="jenisrumah" value="{{ data_get($ketuaisirumah, 'rumah.JenisRumah') }}">
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
                                <input type="hidden" name="binaanrumah" id="binaanrumah" value="{{ data_get($ketuaisirumah, 'rumah.JenisBinaan') }}">
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
                                <input type="hidden" name="biltingkat" id="biltingkat" value="{{ data_get($ketuaisirumah, 'rumah.BilTingkat') }}">
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
                                <input type="hidden" name="bilbilik" id="bilbilik" value="{{ data_get($ketuaisirumah, 'rumah.BilBilik') }}">
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
                        <label>Muat Naik Gambar Rumah (Biarkan kosong jika tidak mahu ubah)</label>
                        <div class="ui grid">
                            <div class="eight wide column">
                                <div class="file-upload-box" onclick="document.getElementById('getFile').click()">
                                    <i class="cloud upload icon blue huge"></i>
                                    <p class="m-t-2"><b>Klik Di Sini</b> untuk menukar gambar<br><span class="text-muted small">(Format .jpg/.png, Max 3MB)</span></p>
                                    <input type='file' id="getFile" name="gambar" style="display:none">
                                </div>
                            </div>
                            <div class="eight wide column center aligned" id="divpreview">
                                <label class="d-block m-b-1">Gambar Semasa / Pratonton:</label>
                                @php
                                    $gambarPath = data_get($ketuaisirumah, 'rumah.Gambar_path');
                                    if ($gambarPath && strpos($gambarPath, 'storage/') === 0) { $gambarPath = substr($gambarPath, 8); }
                                    if ($gambarPath && strpos($gambarPath, '/uploads/') === 0) { $urlGambar = asset($gambarPath); } 
                                    else { $urlGambar = URL::asset('logo.png'); }
                                @endphp
                                <img id="blah" src="{{ $urlGambar }}" alt="Preview">
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
                            <div class="ui radio checkbox m-r-2"><input type="radio" name="elektirk" value="1" required {{ data_get($ketuaisirumah, 'rumah.KElektrik') == 1 ? 'checked' : '' }}><label>Ada</label></div>
                            <div class="ui radio checkbox"><input type="radio" name="elektirk" value="0" {{ data_get($ketuaisirumah, 'rumah.KElektrik') == 0 ? 'checked' : '' }}><label>Tiada</label></div>
                        </div>
                        <div class="column">
                            <label class="d-block m-b-1"><b>Air Paip <span class="required">*</span></b></label>
                            <div class="ui radio checkbox m-r-2"><input type="radio" name="paip" value="1" required {{ data_get($ketuaisirumah, 'rumah.KAir') == 1 ? 'checked' : '' }}><label>Ada</label></div>
                            <div class="ui radio checkbox"><input type="radio" name="paip" value="0" {{ data_get($ketuaisirumah, 'rumah.KAir') == 0 ? 'checked' : '' }}><label>Tiada</label></div>
                        </div>
                        <!--div class="column">
                            <label class="d-block m-b-1"><b>Telefon <span class="required">*</span></b></label>
                            <div class="ui radio checkbox m-r-2"><input type="radio" name="ktel" value="1" required {{ data_get($ketuaisirumah, 'rumah.KTelefon') == 1 ? 'checked' : '' }}><label>Ada</label></div>
                            <div class="ui radio checkbox"><input type="radio" name="ktel" value="0" {{ data_get($ketuaisirumah, 'rumah.KTelefon') == 0 ? 'checked' : '' }}><label>Tiada</label></div>
                        </div>-->
                        <div class="column">
                            <label class="d-block m-b-1"><b>Internet <span class="required">*</span></b></label>
                            <div class="ui radio checkbox m-r-2"><input type="radio" name="internet" value="1" required {{ data_get($ketuaisirumah, 'rumah.KInternet') == 1 ? 'checked' : '' }}><label>Ada</label></div>
                            <div class="ui radio checkbox"><input type="radio" name="internet" value="0" {{ data_get($ketuaisirumah, 'rumah.KInternet') == 0 ? 'checked' : '' }}><label>Tiada</label></div>
                        </div>
                        <!--div class="column">
                            <label class="d-block m-b-1"><b>Astro <span class="required">*</span></b></label>
                            <div class="ui radio checkbox m-r-2"><input type="radio" name="astro" value="1" required {{ data_get($ketuaisirumah, 'rumah.KAstro') == 1 ? 'checked' : '' }}><label>Ada</label></div>
                            <div class="ui radio checkbox"><input type="radio" name="astro" value="0" {{ data_get($ketuaisirumah, 'rumah.KAstro') == 0 ? 'checked' : '' }}><label>Tiada</label></div>
                        </div>-->
                     </div>
                </div>
            </div>

            <div class="ui divider m-y-3"></div>

            {{-- SUBMIT AREA --}}
            <div class="ui center aligned basic segment p-b-4">
                 <div class="inline fields justify-center m-b-3">
                    <label><b>Status Semakan:</b> &nbsp;</label>
                    <div class="ui radio checkbox m-r-3">
                        <input type="radio" name="StatusSemak" value="1" {{ data_get($ketuaisirumah, 'rumah.StatusSemak') == 1 ? 'checked' : '' }}> <label>Telah Disemak</label>
                    </div>
                    <div class="ui radio checkbox">
                        <input type="radio" name="StatusSemak" value="0" {{ data_get($ketuaisirumah, 'rumah.StatusSemak') == 0 ? 'checked' : '' }}> <label>Belum Disemak</label>
                    </div>
                </div>
                
                <button type="submit" class="ui big primary button" id="addbutton" name="hantar" onclick="return validateketua();" style="width: 200px;">
                    <i class="save icon"></i> KEMASKINI
                </button>
            </div>

            {!! form()->close() !!}
        </div>
    </div>
@endsection

@push('style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map {
        height: 400px;
        width: 100%;
        border-radius: 8px;
        border: 2px solid #ddd;
        margin-top: 10px;
        z-index: 1; /* Pastikan tidak menutup dropdown */
    }
</style>

@push('script')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        
        // --- 1. INISIALISASI DROPDOWN (PENTING: Sekali sahaja) ---
        $('.ui.dropdown').dropdown({
            context: 'body',
            direction: 'auto',
            keepOnScreen: true
        });

        $('#wajib').hide();

        // --- 2. INISIALISASI PETA (LEAFLET) ---
        var latInput = $('#Latitud');
        var lngInput = $('#Longitud');
        
        var initialLat = parseFloat(latInput.val()) || 4.5921; // Default Perak
        var initialLng = parseFloat(lngInput.val()) || 101.0901;

        var map = L.map('map').setView([initialLat, initialLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([initialLat, initialLng], {
            draggable: true
        }).addTo(map);

        function updateMarkerAndInputs(lat, lng) {
            marker.setLatLng([lat, lng]);
            latInput.val(lat.toFixed(8));
            lngInput.val(lng.toFixed(8));
        }

        map.on('click', function(e) {
            updateMarkerAndInputs(e.latlng.lat, e.latlng.lng);
        });

        marker.on('dragend', function(e) {
            var position = marker.getLatLng();
            updateMarkerAndInputs(position.lat, position.lng);
        });

        // Pastikan saiz peta betul jika dalam segment
        setTimeout(function(){ map.invalidateSize(); }, 500);


        // --- 3. LOGIK FORM (UPPERCASE & CALENDAR) ---
        $('#name, #kerja, #bantuanlain, #alamat1, #alamat2').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });

        $('#standard_calendar').calendar({
            monthFirst: false,
            type: 'date',
            formatter: {
                date: function(date, settings) {
                    if (!date) return '';
                    return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
                }
            },
            onChange: function(date, text) {
                if(date) {
                    var curyear = new Date().getFullYear();
                    $('#umur').val(curyear - date.getFullYear());
                }
            },
        });

        // --- 4. FORMATTING INPUT & IC LOGIC ---
        $("#pendapat").change(function() {
            $(this).val(parseFloat($(this).val()).toFixed(2));
        });

        $("#noic").on("keyup", function() {
            if ($("#typepengenalan").val() == '') {
                alert('Sila Pilih Jenis Pengenalan');
                $(this).val('');
            }
            checkICLogic(this.value);
        });

        // --- 5. LOGIK BANTUAN ---
        $("#bantuanbulan").change(function() {
            if (this.value == 138) {
                $('#wajib').show();
                $('#bantuanlain').prop('readonly', false).attr('required', true);
            } else {
                $('#wajib').hide();
                $('#bantuanlain').prop('readonly', true).val('').attr('required', false);
            }
        });

        // --- 6. PREVIEW GAMBAR ---
        $("#getFile").change(function() {
            const [file] = this.files;
            if (file) {
                if (file.size > 3 * 1024 * 1024) {
                    alert('Saiz fail melebihi 3 MB');
                    $(this).val("");
                } else {
                    $('#blah').attr('src', URL.createObjectURL(file));
                }
            }
        });

        // --- 7. LOAD INITIAL DATA ---
        var savedType = "{{ data_get($ketuaisirumah, 'JenisPengenalan') }}";
        if(savedType) warga(savedType);
        if(savedType == 150) checkICLogic($('#noic').val());
    });

    // --- FUNGSI LUAR (PANGGILAN ONCLICK) ---
    function checkICLogic(icValue) {
        if($("#typepengenalan").val() == 150 && icValue.length == 12) {
            $('#tlahirauto, #jantinaauto').show();
            $('#tlahircal, #jantinapilih').hide();
            $('#umur').prop('readonly', true);
            
            let year = icValue.substring(0, 2);
            let month = icValue.substring(2, 4);
            let day = icValue.substring(4, 6);
            let pangkal = (icValue.substring(0, 1) <= 2) ? '20' : '19';
            
            $('#tarikhlahirauto').val(day + '/' + month + '/' + pangkal + year);
            $('#umur').val(new Date().getFullYear() - parseInt(pangkal + year));

            let jantinaVal = (icValue.substring(11, 12) % 2 == 0) ? '2' : '1';
            $('#jauto').val(jantinaVal == '2' ? 'PEREMPUAN' : 'LELAKI');
            $('#jantina').dropdown('set selected', jantinaVal);
            $("#warga").prop("checked", true);
            $("#wn").val(1);
        }
    }

    function warga(type) {
        if (type == 150) { // IC Baru
            $('#tlahirauto, #jantinaauto').show();
            $('#tlahircal, #jantinapilih, #divnopengenalan').hide();
            $('#divnoic').show();
            $('#umur').prop('readonly', true);
        } else {
            $('#tlahirauto, #jantinaauto').hide();
            $('#tlahircal, #jantinapilih, #divnopengenalan').show();
            $('#divnoic').hide();
            $('#umur').prop('readonly', false);
        }
    }

    function validateketua() {
        // Tambah logik validation anda di sini
        return true;
    }
</script>
@endpush