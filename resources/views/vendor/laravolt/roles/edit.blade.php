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

    /* Penggayaan Ikon Header */
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

    /* Memastikan teks label dan table nampak jelas (hitam/gelap) */
    .ui.form label, 
    .ui.table, 
    .ui.table thead th,
    .ui.checkbox label,
    .ui.segment p {
        color: #2b2b2b !important;
    }

    /* Kekemasan segment */
    .ui.attached.segment {
        border: none !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
        border-radius: 12px !important;
        margin-top: 15px !important;
    }

    /* Gaya untuk Danger Zone (Padam) */
    .ui.segment.red {
        border-radius: 12px !important;
        box-shadow: 0 4px 15px rgba(219, 40, 40, 0.1) !important;
    }
</style>

<div id="actionbar" class="ui two column grid content__body p-x-2 p-y-1 m-b-0" >
    <div class="column middle aligned">
        <div class="header-icon-container">
            <i class="edit outline icon"></i> 
        </div>
        <div style="display: inline-block; vertical-align: middle;">
            <h3 class="ui header m-t-xs">
              Kemaskini Kategori Pengguna
            </h3>
            <span class="header-subtext">Ubah maklumat peranan dan kebenaran akses sistem</span>
        </div>
    </div> 
    <div class="column right aligned middle aligned">
        <a class="ui button basic grey" href="{{ route('epicentrum::roles.index') }}" id="addbutton">
            <i class="icon arrow left"></i><span><b>Kembali</b></span>
        </a>
    </div>
</div>

<div class="ui attached segment">

    {!! form()->open()->post()->action(route('site::roles.update'))!!}
    <div class="field">
        <label>Nama Kategori Pengguna<font color="red">*</font></label>
        <input type="text" name="name" id="name" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required" value="{{ old('name', $role['name'])}}" style="color: #000 !important;">
    </div>

    <input type="hidden" name="idrole" id="idrole" value="{{$id}}" >
    
    <table class="ui table selectable celled">
        <thead>
            <tr>
                <th>
                    <div class="ui checkbox" data-toggle="checkall" data-selector=".checkbox[data-type='check-all-child']">
                        <input type="checkbox">
                        <label><b>Kategori Pengguna (Pilih Semua)</b></label>
                        <input type="hidden" name="permissions[]" value="0">
                    </div>
                </th>
                <th>Diskripsi Kebenaran Pengguna</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td style="width: 300px">
                        <div class="ui checkbox" data-type="check-all-child">
                            <input type="checkbox" name="permissions[]"
                                   value="{{ $permission->id }}" {{ (in_array($permission->id, $assignedPermissions))?'checked=checked':'' }}>
                            <label><b>{{ $permission->name }}</b></label>
                        </div>
                    </td>
                    <td>{{ $permission->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ui divider hidden"></div>

    <div class="p-y-1">
        <button class="ui button primary" type="submit" name="submit" value="1">
            <i class="save icon"></i> Simpan Kemaskini
        </button>
        <a href="{{ route('epicentrum::roles.index') }}" class="ui button">Batal</a>
    </div>
    {!! form()->close() !!}
</div>

<div class="ui divider section hidden"></div>

<div class="ui segment very padded red">
    <h3 class="ui header red"><i class="trash alternate outline icon"></i> Padam Kategori</h3>
    <p><strong>Amaran:</strong> {{$role->users->count()}} orang pengguna akan terlibat jika kategori ini dipadamkan.</p>

    {!! Form::open()->post()->action(route('site::roles.destroy')) !!}
        <input type="hidden" name="idrole" id="idrole" value="{{$id}}" >
        <button class="ui button red" type="submit" name="submit" value="1"
                onclick="return confirm('Adakah anda pasti untuk padam?')">
            <i class="trash icon"></i> Padam Kategori Ini
        </button>
    {!! Form::close() !!}
</div>

@endsection