@extends('laravolt::layout.app2')

@section('page.title', __('laravolt::label.permissions'))

@section('content')

<style>
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

    .ui.attached.segment,
    .ui.table,
    .ui.table thead th,
    .ui.input input,
    .ui.form label {
        color: #2b2b2b !important;
    }

    /* Kad (Segments) ikut gaya modern */
    .ui.attached.segment {
        border: none !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
        border-radius: 12px !important;
        margin-top: 20px !important;
    }

    /* Butang Simpan ikut warna hijau dalam gambar */
    .ui.button.primary, .ui.button[type="submit"] {
        background-color: #28a745 !important;
        color: white !important;
        border-radius: 8px !important;
    }
</style>

<div id="actionbar" class="ui two column grid content__body p-x-2 p-y-1 m-b-0" >
    <div class="column middle aligned">
        <div class="header-icon-container">
            <i class="key icon"></i> 
        </div>
        <div style="display: inline-block; vertical-align: middle;">
            <h3 class="ui header m-t-xs">
              Kebenaran Pengguna
            </h3>
            <span class="header-subtext">Pengurusan kebenaran akses dan fungsi sistem</span>
        </div>
    </div> 
</div>

<div class="ui attached segment">
    {!! form()->open(route('epicentrum::permissions.update'))->put() !!}

    {!! Suitable::source($permissions)->columns([
        \Laravolt\Suitable\Columns\Numbering::make('No')->setHeaderAttributes(['width' => '50px']),
        \Laravolt\Suitable\Columns\Text::make('name', __('Nama Kebenaran'))
            ->setHeaderAttributes(['width' => '250px']),
        \Laravolt\Suitable\Columns\Raw::make(function($item) {
            return SemanticForm::text('permission['.$item->getKey().']')->value($item->description);
        }, __('Diskripsi Kebenaran'))
    ])->render() !!}

    <div class="p-y-1">
        {!! form()->submit(__('Simpan')) !!}
    </div>
    {!! form()->close() !!}
</div>

@endsection