@extends('laravolt::layout.app2')

@section('content')

<style>
    /* Warna Biru Gelap dan Font Bold untuk Tajuk */
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

    /* Ikon Header (Ikut gaya ikon group dalam gambar) */
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

    /* SOLUSI FONT TAK NAMPAK: Paksa teks dalam card dan segment jadi gelap */
    .ui.card .header, 
    .ui.card .extra.content,
    .ui.attached.segment {
        color: #2b2b2b !important;
    }

    /* Card Styling (Efek bayangan halus) */
    .ui.card {
        box-shadow: 0 4px 15px rgba(0,0,0,0.05) !important;
        border: none !important;
        transition: transform 0.2s ease !important;
    }

    .ui.card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }

    /* Segment Modern Styling */
    .ui.attached.segment.raised {
        border: none !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
        border-radius: 12px !important;
        padding: 2rem !important;
    }

    /* Warna Butang Tambah (Hijau ikut gambar) */
    .ui.button.green {
        background-color: #28a745 !important;
        border-radius: 8px !important;
        padding: 12px 20px !important;
    }
</style>

<div id="actionbar" class="ui two column grid content__body p-x-2 p-y-1 m-b-0" >
    <div class="column middle aligned">
        <div class="header-icon-container">
            <i class="users icon"></i> 
        </div>
        <div style="display: inline-block; vertical-align: middle;">
            <h3 class="ui header m-t-xs">
              Kategori Pengguna
            </h3>
            <span class="header-subtext">Pengurusan peranan dan tahap capaian pengguna</span>
        </div>
    </div> 
    <div class="column right aligned middle aligned">
        <a class="ui button green" href="{{ route('site::roles.create') }}" id="addbutton">
            <i class="icon plus"></i><span>Tambah Kategori</span>
        </a>
    </div>
</div>
<br>

<div class="ui attached segment raised">
    <div class="ui grid">
        <div class="column sixteen wide">
            <div class="ui cards three doubling">
                @foreach($roles as $role)
                    <a href="{{ route('site::roles.edit', $role['id']) }}" class="ui card">
                        <div class="content">
                            <h3 class="header link" style="color: #1a3352 !important;">{{ $role['name'] }}</h3>
                        </div>
                        <div class="extra content">
                            <i class="icon users"></i> {{ $role->users->count() }} Orang Pengguna
                            <span class="right floated">
                                <i class="icon options"></i> {{ $role->permissions()->count() }} Kebenaran
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection