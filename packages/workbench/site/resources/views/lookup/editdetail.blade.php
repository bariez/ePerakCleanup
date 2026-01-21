@extends('laravolt::layout.app2')

@section('content')

<style>
    /* Warna Biru Gelap dan Font Bold untuk Tajuk Utama */
    #actionbar h3.ui.header {
        color: #1a3352 !important; 
        font-weight: 800 !important;
        font-size: 1.8rem !important;
        margin-bottom: 0px !important;
    }

    /* Sub-teks di bawah tajuk */
    .header-subtext {
        color: #777 !important;
        font-size: 0.95rem;
        margin-top: -5px;
        display: block;
    }

    /* Penggayaan Ikon Header (Kamus Data/Database) */
    .header-icon-container {
        display: inline-block;
        vertical-align: middle;
        margin-right: 15px;
    }

    .header-icon-container i.icon {
        color: #1a3352 !important;
        font-size: 2.2rem !important;
        margin: 0 !important;
    }

    /* Solusi Font Tak Nampak: Paksa semua teks dalam form jadi gelap */
    .ui.form label, 
    .ui.segments.panel, 
    .default.text,
    .ui.input input,
    .ui.dropdown .menu .item,
    .field input[readonly] {
        color: #2b2b2b !important;
    }

    /* Kad (Segments) ikut gaya modern */
    .ui.segments.panel {
        border: none !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
        border-radius: 12px !important;
    }

    /* Warna Butang Kemaskini (Warna Tema Laravolt/Biru) */
    #editbutton {
        background-color: #2185d0 !important;
        color: white !important;
        border-radius: 8px !important;
    }

    #backbutton {
        border-radius: 8px !important;
    }
</style>

<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0">
    <div class="column middle aligned">
        <div class="header-icon-container">
            <i class="database icon"></i> 
        </div>
        <div style="display: inline-block; vertical-align: middle;">
            <h3 class="ui header m-t-xs">
                Kemaskini Kamus Data
            </h3>
            <span class="header-subtext">Menguruskan perincian kod dan rujukan maklumat sistem</span>
        </div>
    </div>

    <div class="column right aligned middle aligned">
        <a class="ui button basic grey" href="/eperak/site/lkpmaster/listdatalookup/{{data_get($datadetail,'fk_lkp_master')}}" id="backbutton">
            <i class="arrow left icon"></i><span>Kembali</span>
        </a>
    </div>
</div>

<div class="ui container-fluid content__body p-3">
    <div class="ui segments panel">
        <div class="ui segment panel__header ">
            <div class="ui menu secondary borderless m-0 p-0" style="min-height: 0">
                <div class="item p-0 m-0">
                    <h4 class="panel__title ui header p-x-sm p-y-0" style="color: #1a3352 !important;">
                        <i class="pencil alternate icon"></i> Borang Kemaskini
                    </h4>
                </div>
            </div>
        </div>

        <div class="ui segment p-4">
            {!! form()->open()->post()->action(route('site::lkpdetail.editdetail',data_get($datadetail,'id')))->horizontal() !!}
            
            <input type="hidden" name="masterid" required="required" value="{{data_get($mainlookup,'id')}}">
            <input type="hidden" name="parentid" required="required" value="{{data_get($mainlookup,'parent_id')}}">
            
            <div class="field">
                <label>Kamus Data</label>
                <input type="text" name="mastername" value="{{data_get($mainlookup,'name')}}" readonly="readonly">
            </div>

            <div class="field">
                <label>Kamus Data Utama</label>
                <input type="text" name="parentname" required="required" value="{{data_get($mainlookup,'parent_name')}}" readonly="readonly">
            </div>

            <div class="field">
                <label>Kategori</label>
                @if(data_get($mainlookup,'parent_name')=='')
                    <input type="text" name="kategori" value="" readonly="readonly">
                @else
                    <div class="ui fluid search selection dropdown">
                        <input type="hidden" name="kategori" value="{{ data_get($datadetail,'category_detail') }}">
                        <i class="dropdown icon"></i>
                        <div class="default text">Sila Pilih</div>
                        <div class="menu">
                            <div class="item" data-value="">Sila Pilih</div>
                            @foreach($kategoridetail as $key => $value)
                                <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="field">
                <label>Deskripsi <font color="red">*</font></label>
                <input type="text" name="description" id="description" required="required" value="{{ data_get($datadetail,'description') }}">
            </div>

            <div class="field">
                <label>Status <font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="status" required="required" value="{{ data_get($datadetail,'status') }}">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                        <div class="item" data-value="">Sila Pilih</div>
                        <div class="item" data-value="1">Aktif</div>
                        <div class="item" data-value="0">Tidak Aktif</div>
                    </div> 
                </div>
            </div>

            <div class="ui divider section"></div>
            
            <div align="right">
                <button type="submit" class="ui button primary" id="editbutton">
                    <i class="save icon"></i> Kemaskini
                </button>
            </div>

            {!! form()->close() !!}
        </div>
    </div>
</div>

@endsection

@push('script')
<script type="text/javascript">
  $(document).ready(function() {  
    $('#description').keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });
    
    // Inisialisasi dropdown Semantic UI
    $('.ui.dropdown').dropdown();
  });
</script>
@endpush