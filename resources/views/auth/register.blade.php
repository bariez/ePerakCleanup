<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" data-font-size="{{ config('laravolt.ui.font_size') }}" style="font-size: 13px">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>{{ $title ?? '' }} | {{ config('app.name') }}</title>

    <meta charset="UTF-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="turbolinks-cache-control" content="no-cache">
    <meta name="turbolinks-enabled" content="{{ config('laravolt.platform.features.turbolinks') }}">

    @stack('meta')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Tambah Select2 CSS untuk Dropdown Carian --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        :root {
            --app-accent-color: var(--{{ config('laravolt.ui.color') }});
            --app-login-background: url('{{ url(config('laravolt.ui.login_background')) }}');
        }

        html, body {
            font-family: 'Poppins', sans-serif !important;
        }

        .layout--auth.is-modern {
            background-image: url('{{ asset('kuning2.png') }}');
            background-size: cover;  
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;  
            box-sizing: border-box;
        }

        .x-auth {
            width: 100%;
            max-width: 600px !important; 
            background: #ffffff; 
            border-radius: 12px; 
            padding: 40px; 
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            margin: 0; 
        }
        
        @media only screen and (max-width : 480px) {
            .x-auth { max-width: 100% !important; }
        }

        .x-auth__title {
            background-color: #ffc33d;
            color: #000;
            padding: 12px 10px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            font-size: 1.2em;
            margin-top: 15px;
            margin-bottom: 30px;
        }

        .ui.form .field > input, .select2-container--default .select2-selection--single {
            height: 45px !important;
            border-radius: 8px !important;
            border: 1px solid #ccc !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 45px !important;
            padding-left: 15px !important;
        }

        .ui.fluid.button {
            background-color: #ffc33d !important; 
            color: #000 !important;
            font-weight: bold !important;
            padding: 15px 0 !important;
            border-radius: 8px !important;
            box-shadow: 0 5px 10px rgba(255, 195, 61, 0.4);
        }

        .login-link-button {
            display: inline-block;
            width: 100%;
            padding: 10px 15px;
            background-color: #f7e6a0;
            color: #000 !important;
            font-weight: bold !important;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
        }

        .manual-input {
            display: none;
            margin-top: 10px;
        }

        .x-auth__header {
            text-align: center;
            display: block;
            width: 100%;
        }
    </style>

    <link rel="stylesheet" type="text/css" data-turbolinks-track="reload" href="{{ env('BASEFOLDER', '') }}{{ mix('semantic/semantic.min.css', 'laravolt') }}"/>
    <link rel="stylesheet" type="text/css" data-turbolinks-track="reload" href="{{ env('BASEFOLDER', '') }}{{ mix('css/all.css', 'laravolt') }}"/>
    <link rel="icon" href="{{ URL::asset('logo.png') }}" type="image/x-icon"/>

    @stack('style')
    <script data-turbolinks-track="reload" src="{{ mix('js/vendor.js', 'laravolt') }}"></script>
</head>

<body data-theme="{{ config('laravolt.ui.theme') }}" class="{{ $bodyClass ?? '' }}">

<div class="layout--auth is-modern">
    <div class="x-auth">
        <div class="x-auth__content">
            <div class="x-auth__header">
                <img src="{{asset('logo.png')}}" alt="Logo Perak" class="ui image tiny centered">
            </div>
            
            <div class="x-auth__title">e-Perak</div>

            <h3 class="ui header horizontal divider section">Daftar Pengguna</h3>

            {!! form()->open(route('auth::registration.store'), ['class' => 'ui form']) !!} 
                
                {{-- MULA: Hidden input untuk hantar nilai gabungan ke database --}}
                <input type="hidden" name="jabatan" id="jabatan_final" required>
                <input type="hidden" name="jawatan" id="jawatan_final" required>
                {{-- TAMAT --}}

                <div class="field">
                    <label>Nama<font color="red">*</font></label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}" placeholder="NAMA PENUH">
                </div>
                
                {!! form()->email('email')->label(__('Emel<html><font color="red">*</font></html>')) !!}
                
                <div class="field">
                    <label>Kata Laluan<html><font color="red">*</font></html></label>
                    <small>(Gabungan abjad, nombor & aksara khas. Min 8 karakter.)</small>
                    <input type="password" name="password" id="password">
                </div>

                {!! form()->password('password_confirmation')->label(__('Mengesahkan kata laluan anda<html><font color="red">*</font></html>')) !!}
                
                {{-- DROP DOWN JABATAN --}}
                <div class="field">
                    <label>Jabatan / Agensi<font color="red">*</font></label>
                    <select id="jabatan_selector" class="ui dropdown searchable" required>
                        <option value="">-- Pilih Jabatan --</option>
                        <optgroup label="PENTADBIRAN NEGERI">
                            <option value="PEJABAT SETIAUSAHA KERAJAAN NEGERI (SUK)">PEJABAT SETIAUSAHA KERAJAAN NEGERI (SUK)</option>
                            <option value="PEJABAT DAERAH DAN TANAH (PDT)">PEJABAT DAERAH DAN TANAH (PDT)</option>
                            <option value="PEJABAT TANAH DAN GALIAN (PTG)">PEJABAT TANAH DAN GALIAN (PTG)</option>
                        </optgroup>
                        <optgroup label="PIHAK BERKUASA TEMPATAN">
                            <option value="MAJLIS BANDARAYA IPOH (MBI)">MAJLIS BANDARAYA IPOH (MBI)</option>
                            <option value="MAJLIS PERBANDARAN">MAJLIS PERBANDARAN (SILA NYATAKAN)</option>
                            <option value="MAJLIS DAERAH">MAJLIS DAERAH (SILA NYATAKAN)</option>
                        </optgroup>
                        <optgroup label="PENDIDIKAN">
                            <option value="JABATAN PENDIDIKAN NEGERI (JPN)">JABATAN PENDIDIKAN NEGERI (JPN)</option>
                            <option value="PEJABAT PENDIDIKAN DAERAH (PPD)">PEJABAT PENDIDIKAN DAERAH (PPD)</option>
                        </optgroup>
                        <optgroup label="KOMUNITI">
                            <option value="JPKK / KETUA KAMPUNG">JAWATANKUASA JPKK / KAMPUNG (SILA NYATAKAN)</option>
                        </optgroup>
                        <optgroup label="LAIN-LAIN">
                            <option value="LAIN-LAIN">LAIN-LAIN (SILA NYATAKAN)</option>
                        </optgroup>
                    </select>

                    <div id="div_pdt_detail" class="manual-input">
                        <label style="margin-top:10px">Pilih Daerah (PDT)<font color="red">*</font></label>
                        <select name="pdt_daerah" id="pdt_daerah" class="ui dropdown searchable" style="width:100%">
                            <option value="">-- Pilih PDT --</option>
                            <option value="PDT KINTA">PDT KINTA</option>
                            <option value="PDT LARUT MATANG & SELAMA">PDT LARUT MATANG & SELAMA</option>
                            <option value="PDT HILIR PERAK">PDT HILIR PERAK</option>
                            <option value="PDT MANJUNG">PDT MANJUNG</option>
                            <option value="PDT BATANG PADANG">PDT BATANG PADANG</option>
                            <option value="PDT KERIAN">PDT KERIAN</option>
                            <option value="PDT KUALA KANGSAR">PDT KUALA KANGSAR</option>
                            <option value="PDT HULU PERAK">PDT HULU PERAK</option>
                            <option value="PDT PERAK TENGAH">PDT PERAK TENGAH</option>
                            <option value="PDT KAMPAR">PDT KAMPAR</option>
                            <option value="PDT MUALLIM">PDT MUALLIM</option>
                            <option value="PDT BAGAN DATUK">PDT BAGAN DATUK</option>
                        </select>
                    </div>

                    <div id="div_jabatan_manual" class="manual-input">
                        <input type="text" name="jabatan_manual" id="jabatan_manual" placeholder="SILA NYATAKAN NAMA MAJLIS / KAMPUNG / JABATAN">
                    </div>
                </div>
                
                {{-- DROP DOWN JAWATAN --}}
                <div class="field">
                    <label>Jawatan<font color="red">*</font></label>
                    {{-- ID tukar ke jawatan_selector --}}
                    <select id="jawatan_selector" class="ui dropdown searchable" required>
                        <option value="">-- Pilih Jawatan --</option>
                        <optgroup label="KOMUNITI & KAMPUNG">
                            <option value="SETIAUSAHA JPKK">SETIAUSAHA JPKK</option>
                            <option value="PENGERUSI JPKK">PENGERUSI JPKK</option>
                        </optgroup>
                        <optgroup label="PEGAWAI MUKIM">
                            <option value="PENGHULU GRED NP29">PENGHULU GRED NP29</option>
                            <option value="PENGHULU GRED NP32">PENGHULU GRED NP32</option>
                            <option value="PENGHULU GRED NP36">PENGHULU GRED NP36</option>
                            <option value="PENGHULU TERTINGGI GRED NP40/42">PENGHULU TERTINGGI GRED NP40/42</option>
                        </optgroup>
                        <optgroup label="PEJABAT DAERAH / TANAH / MAJLIS">
                            <option value="PEGAWAI DAERAH (DO)">PEGAWAI DAERAH</option>
                            <option value="PENOLONG PEGAWAI DAERAH (ADO)">PENOLONG PEGAWAI DAERAH</option>
                            <option value="PEGAWAI TADBIR (N41/44/48/52/54)">PEGAWAI TADBIR (N)</option>
                            <option value="PENOLONG PEGAWAI TANAH (JA29/36)">PENOLONG PEGAWAI TANAH</option>
                            <option value="PEMBANTU TADBIR (N19/22)">PEMBANTU TADBIR (N)</option>
                            <option value="PEMBANTU OPERASI (N11/14)">PEMBANTU OPERASI (N)</option>
                        </optgroup>
                        <optgroup label="PENDIDIKAN">
                            <option value="PEGAWAI PENDIDIKAN DAERAH">PEGAWAI PENDIDIKAN DAERAH</option>
                            <option value="PENGETUA / GURU BESAR">PENGETUA / GURU BESAR</option>
                            <option value="GURU / CIKGU (DG41/44/48/52/54)">GURU / CIKGU (DG)</option>
                        </optgroup>
                        <optgroup label="LAIN-LAIN">
                            <option value="LAIN-LAIN">LAIN-LAIN (SILA NYATAKAN)</option>
                        </optgroup>
                    </select>
                    <div id="div_jawatan_manual" class="manual-input">
                        <input type="text" name="jawatan_manual" id="jawatan_manual" placeholder="SILA NYATAKAN NAMA JAWATAN">
                    </div>
                </div>

                <div class="field">
                    <label>No.Tel<html><font color="red">*</font></html></label>
                    <small>(Format: 0123456789)</small>
                    <input type="text" name="notel" id="notel" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required value="{{ old('notel') }}">
                </div>
                
                <div class="field">
                    <label>Tujuan Permohonan ID Pengguna<font color="red">*</font></label>
                    <input type="text" name="Tujuan" id="Tujuan" required value="{{ old('Tujuan') }}">
                </div>

                <div class="field action">
                    <button class="ui fluid button" type="submit"><b>Daftar</b></button>
                </div>

                <div class="ui divider section"></div>

                <div class="login-link-container">
                    <font color="#000"><b>Sudah ada Akaun e-Perak?</b></font>
                    <a href="{{ route('auth::login.show') }}" class="login-link-button">
                        Log Masuk Disini <i class="sign in alternate icon"></i>
                    </a>
                </div>

                <div class="ui equal width grid">
                    <div class="column right aligned">
                        <a href="/eperak" class="link">
                            <font color="#000" style="font-size: small"><b>Laman Utama <i class="home icon"></i></b></font>
                        </a>
                    </div>
                </div>

            {!! form()->close() !!}
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() { 
        // Aktifkan Dropdown Searchable
        $('.searchable').select2({
            placeholder: "Sila pilih...",
            allowClear: true
        });

        // --- FUNGSI GABUNGAN JABATAN ---
        function setJabatanFinal() {
            var mainVal = $('#jabatan_selector').val();
            var pdtVal = $('#pdt_daerah').val();
            var manualVal = $('#jabatan_manual').val();
            var finalStr = "";

            if(mainVal == "PEJABAT DAERAH DAN TANAH (PDT)") {
                finalStr = mainVal + (pdtVal ? " - " + pdtVal : "");
            } else if(["MAJLIS PERBANDARAN", "MAJLIS DAERAH", "JPKK / KETUA KAMPUNG", "LAIN-LAIN"].includes(mainVal)) {
                finalStr = mainVal + (manualVal ? " (" + manualVal + ")" : "");
            } else {
                finalStr = mainVal;
            }
            $('#jabatan_final').val(finalStr.toUpperCase());
        }

        // --- FUNGSI GABUNGAN JAWATAN ---
        function setJawatanFinal() {
            var mainVal = $('#jawatan_selector').val();
            var manualVal = $('#jawatan_manual').val();
            var finalStr = "";

            if(mainVal == "LAIN-LAIN") {
                finalStr = mainVal + (manualVal ? " (" + manualVal + ")" : "");
            } else {
                finalStr = mainVal;
            }
            $('#jawatan_final').val(finalStr.toUpperCase());
        }

        // Logik Jabatan
        $('#jabatan_selector').on('change', function() {
            var val = $(this).val();
            $('#div_pdt_detail, #div_jabatan_manual').hide();
            $('#pdt_daerah, #jabatan_manual').attr('required', false);

            if(val == "PEJABAT DAERAH DAN TANAH (PDT)") {
                $('#div_pdt_detail').slideDown();
                $('#pdt_daerah').attr('required', true);
            } else if(["MAJLIS PERBANDARAN", "MAJLIS DAERAH", "JPKK / KETUA KAMPUNG", "LAIN-LAIN"].includes(val)) {
                $('#div_jabatan_manual').slideDown();
                $('#jabatan_manual').attr('required', true);
            }
            setJabatanFinal();
        });

        $('#pdt_daerah').on('change', function() { setJabatanFinal(); });
        $('#jabatan_manual').on('keyup', function() { setJabatanFinal(); });

        // Logik Jawatan
        $('#jawatan_selector').on('change', function() {
            var val = $(this).val();
            if(val == "LAIN-LAIN") {
                $('#div_jawatan_manual').slideDown();
                $('#jawatan_manual').attr('required', true);
            } else {
                $('#div_jawatan_manual').slideUp();
                $('#jawatan_manual').attr('required', false).val('');
            }
            setJawatanFinal();
        });

        $('#jawatan_manual').on('keyup', function() { setJawatanFinal(); });

        // Auto-Uppercase & Trigger Hidden Updates
        $('#name, #Tujuan, #jabatan_manual, #jawatan_manual').keyup(function() {
            $(this).val($(this).val().toUpperCase());
            setJabatanFinal();
            setJawatanFinal();
        });
    });
</script>

{!! Asset::js() !!}
@stack('script')
</body>
</html>