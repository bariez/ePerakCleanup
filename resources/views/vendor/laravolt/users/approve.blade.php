@extends('laravolt::layout.app2')



@section('content')

<style type="text/css">

    /* 1. PENETAPAN WARNA & KONSEP MODEN */

    :root {

        --primary-dark-blue: #0d214a; 

        --primary-blue: #1e3a8a; 

        --soft-bg: #f8fafc;

        --border-color: #e2e8f0;

    }



    /* FIX: Kedudukan bawah Top Bar & Latar Belakang */

    .layout--app .layout__content {

        padding-top: 85px !important; 

        background-color: var(--soft-bg);

    }



    /* 2. PENETAPAN FONT TAJUK (BIRU GELAP) */

    .page-main-title {

        color: var(--primary-dark-blue) !important;

        font-weight: 800 !important;

        font-size: 2.2rem !important;

        margin: 0 !important;

    }



    .sub.header {

        color: #64748b !important;

        margin-top: 2px !important;

    }



    /* 3. KAWALAN ACTION BAR */

    #actionbar {

        margin-top: -10px !important;

        margin-bottom: 25px !important;

        padding: 0 1.5rem;

        width: 100%;

    }



    /* 4. DESIGN KAD BORANG (PANEL) */

    .ui.segments.panel {

        border: none !important;

        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05) !important;

        border-radius: 12px !important;

        overflow: hidden;

    }



    .ui.segment.custom-form-header {

        background: #ffffff !important;

        border-bottom: 1px solid var(--border-color) !important;

        padding: 18px !important;

        display: flex;

        align-items: center;

    }



    .ui.segment.custom-form-header i.icon { 

        color: #fecb3a !important; /* Ikon kuning e-Perak */

        margin-right: 12px !important; 

    }



    .ui.segment.custom-form-header h4 {

        color: var(--primary-blue) !important;

        margin: 0 !important;

        font-weight: 700;

    }



    /* 5. GAYA MEDAN INPUT & LABEL */

    .ui.form .field > label {

        color: var(--primary-dark-blue) !important;

        font-weight: 700 !important;

        text-transform: uppercase;

        font-size: 0.85rem;

        margin-bottom: 8px !important;

    }



    .ui.form input[readonly], .ui.form textarea[readonly] {

        background-color: #f1f5f9 !important;

        border-color: #e2e8f0 !important;

        color: #475569 !important;

    }



    /* 6. PENYELESAIAN JAWATAN PANJANG (WRAP TEXT) */

    .jawatan-box {

        min-height: 45px !important;

        height: auto !important;

        line-height: 1.4 !important;

        resize: none !important;

        padding: 10px !important;

        white-space: normal !important;

        word-wrap: break-word !important;

    }



    /* 7. BUTTON CUSTOM */

    .btn-save {

        background-color: #16a34a !important;

        color: white !important;

        border-radius: 8px !important;

        padding: 12px 25px !important;

        font-weight: bold !important;

        box-shadow: 0 4px 6px rgba(22, 163, 74, 0.2);

        transition: 0.3s;

    }



    .btn-save:hover {

        background-color: #15803d !important;

        transform: translateY(-1px);

    }

</style>



<div id="actionbar" class="ui grid">

    <div class="row">

        <div class="eight wide column middle aligned">

            <h1 class="ui header page-main-title">

                <i class="user check icon" style="color: var(--primary-dark-blue);"></i>

                <div class="content">

                    Kelulusan Pengguna

                    <div class="sub header">Semakan profil dan penetapan akses sistem</div>

                </div>

            </h1>

        </div>

    </div>

</div>



<div class="ui container-fluid content__body p-x-3">

    <div class="ui segments panel">

        <div class="ui segment custom-form-header">

            <i class="address card outline icon"></i>

            <h4>Maklumat Permohonan Pengguna</h4>

        </div>



        <div class="ui segment p-5">

            {!! form()->bind($user)->open()->post()->action(route('site::users.approveusers', $user['id']))->horizontal() !!}



            <div class="ui grid stackable form">

                <div class="eight wide column">

                    {!! form()->text('name')->label(__('Username'))->readonly() !!}

                    {!! form()->text('email')->label(__('Email'))->readonly() !!}

                    {!! form()->text('notel')->label(__('No. Telefon'))->readonly() !!}

                </div>

                <div class="eight wide column">

                    {!! form()->text('jabatan')->label('Jabatan / Agensi')->readonly() !!}

                    

                    <div class="field">

                        <label>Jawatan</label>

                        <textarea name="jawatan" readonly class="jawatan-box" rows="2">{{ $user->jawatan }}</textarea>

                    </div>



                    {!! form()->text('Tujuan')->label(__('Tujuan Akses'))->readonly() !!}

                </div>

            </div>



            <div class="ui divider section"></div>



            <div class="field">

                <label>Status Kelulusan <font color="red">*</font></label>

                <div class="ui fluid search selection dropdown">

                    <input type="hidden" name="status" id="status" required="required" value="{{ data_get($user,'status') }}">

                    <i class="dropdown icon"></i>

                    <div class="default text">Sila Pilih Status</div>

                    <div class="menu">

                        <div class="item" data-value="PENDING">DALAM PROSES</div>

                        <div class="item" data-value="ACTIVE">AKTIF (LULUS)</div>

                        <div class="item" data-value="BLOCKED">TIDAK LULUS</div>

                    </div>

                </div>

            </div>



            <div class="field">

                <label>Ulasan Pentadbir <font color="red" id="wajib">*</font></label>

                <textarea id="ulasan" name="ulasan" rows="3" placeholder="Sila masukkan ulasan di sini..." required="required"></textarea>

            </div>



            <div class="field" id="divcategori">

                <label>Kategori Pengguna <font color="red">*</font></label>

                <div class="ui fluid search selection dropdown">

                    <input type="hidden" name="role" id="role">

                    <i class="dropdown icon"></i>

                    <div class="default text">Sila Pilih Peranan</div>

                    <div class="menu">

                        @foreach($role as $value)

                            <div class="item" data-value="{{$value->id}}">{{$value->name}}</div>

                        @endforeach

                    </div>

                </div>

            </div>



            <div class="ui two column grid stackable">

                <div class="column" id="divpgdaerah">

                    <div class="field">

                        <label>Daerah <font color="red">*</font></label>

                        <div class="ui fluid search selection dropdown">

                            <input type="hidden" name="daerah01" id="daerah01">

                            <i class="dropdown icon"></i>

                            <div class="default text">Pilih Daerah</div>

                            <div class="menu">

                                @foreach($daerah as $value)

                                    <div class="item" data-value="{{$value->id}}" onclick="mukim({{$value->id}})">{{$value->NamaDaerah}}</div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>



                <div class="column" id="divpgmukim">

                    <div class="field">

                        <label>Daerah <font color="red">*</font></label>

                        <div class="ui fluid search selection dropdown">

                            <input type="hidden" name="daerah02" id="daerah02">

                            <i class="dropdown icon"></i>

                            <div class="default text">Pilih Daerah</div>

                            <div class="menu">

                                @foreach($daerah as $value)

                                    <div class="item" data-value="{{$value->id}}" onclick="mukim({{$value->id}})">{{$value->NamaDaerah}}</div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>



                <div class="column" id="divmukim">

                    <div class="field">

                        <label>Mukim</label>

                        <div class="ui fluid search selection dropdown">

                            <input type="hidden" name="mukim" id="mukim">

                            <i class="dropdown icon"></i>

                            <div class="default text" id="pilihmukim">Pilih Mukim</div>

                            <div class="menu" id="selectmukim"></div>

                        </div>

                    </div>

                </div>

                

                <div class="column" id="divkampung">

                    <div class="field">

                        <label>Nama Kampung <font color="red">*</font></label>

                        <div class="ui fluid search selection dropdown">

                            <input type="hidden" name="kampung" id="kampung">

                            <i class="dropdown icon"></i>

                            <div class="default text" id="pilihkampung">Pilih Kampung</div>

                            <div class="menu" id="selectkampung"></div>

                        </div>

                    </div>

                </div>

            </div>



            <div id="loading" style="display: none; margin: 20px 0;">

                <div class="ui active centered inline loader"></div>

                <div class="text-center" style="color: var(--primary-blue); font-size: 0.9rem; margin-top: 5px;">Memproses data...</div>

            </div>



            <div class="ui divider section"></div>



            <div align="right">

                <button type="submit" class="ui button btn-save" id="addbutton" onclick="return validateuser();">

                    <i class="save icon"></i> Simpan Kelulusan

                </button>

                <a class="ui button basic" href="{!! URL::to('/site/approveindex') !!}" style="border-radius: 8px; padding: 12px 25px;">

                    <i class="arrow left icon"></i> Kembali

                </a>

            </div>



            {!! form()->close() !!}

        </div>

    </div>

</div>

@endsection



@push('script')

<script>

    $(document).ready(function() {

        // Initials hide

        $("#divpgdaerah, #divpgmukim, #divmukim, #divkampung, #divcategori, #wajib").hide();



        // UpperCase for Ulasan

        $('#ulasan').keyup(function() {

            $(this).val($(this).val().toUpperCase());

        });



        // Role Logic

        $("#role").change(function() {

            let role = this.value;

            $("#divpgdaerah, #divpgmukim, #divmukim, #divkampung").hide();



            if (role == 2) { 

                $("#divpgdaerah").show();

            } else if (role == 3) { 

                $("#divpgmukim, #divmukim").show();

            } else if(role == 10) { 

                $("#divpgmukim, #divmukim, #divkampung").show();

            }

        });



        // Status Logic

        $("#status").change(function() {

            let status = this.value;

            $("#wajib").toggle(status === 'BLOCKED');

            $("#divcategori").toggle(status === 'ACTIVE');

            

            if(status !== 'ACTIVE') {

                $("#divpgdaerah, #divpgmukim, #divmukim, #divkampung").hide();

            }

        });

    });



    function mukim(id) {

        document.getElementById("pilihmukim").innerHTML = "Sila Pilih";

        $('#selectmukim').html('');

        $('#loading').show();



        $.ajax({

            type: "GET",

            url: "{{ URL::to('site/getmukim/')}}" + "/" + id,

            success: function(data) {

                $('#loading').hide();

                $('#selectmukim').html(data);

            }

        });

    }



    function kampung(id) {

        document.getElementById("pilihkampung").innerHTML = "Sila Pilih";

        $('#selectkampung').html('');

        $('#loading').show();



        $.ajax({

            type: "GET",

            url: "{{ URL::to('site/getkampung/')}}"+"/"+id,

            success: function(data) {

                $('#loading').hide();

                $('#selectkampung').html(data);

            }

        });

    }



    function validateuser() {

        var status = document.getElementById("status").value;

        var role = document.getElementById("role").value;

        var ulasan = document.getElementById("ulasan").value;



        if (status == '') {

            alert('Sila Masukkan Status Kelulusan');

            return false;

        }



        if (status === 'BLOCKED' && ulasan == '') {

            alert('Sila Masukkan Ulasan untuk Status Tidak Lulus');

            return false;

        }



        if (status === 'ACTIVE' && role == '') {

            alert('Sila Pilih Kategori Pengguna');

            return false;

        }



        return true;

    }

</script>

@endpush