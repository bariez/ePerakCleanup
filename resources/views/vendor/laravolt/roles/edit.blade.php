@extends('laravolt::layout.app2')


@section('content')
<div id="actionbar" class="ui two column grid content__body p-x-2 p-y-1 m-b-0" >
    <div class="column middle aligned">
        <h3 class="ui header m-t-xs">
          Kemaskini Kategori Pengguna
        </h3>
    </div> 
    <div class="column right aligned middle aligned">

           <a class="ui button green" href="{{ route('epicentrum::roles.index') }}" id="addbutton"><i class="icon arrow left"></i><span><b>Kembali</b></span></a>


    </div>
</div>

<div class="ui attached segment">

      {!! SemanticForm::open()->put()->action(route('epicentrum::roles.update', $role['id'])) !!}

        {!! SemanticForm::text('name', old('name', $role['name']))->label('Nama Kategori Pengguna')->required() !!}

        <table class="ui table">
            <thead>
            <tr>
                <th>
                    <div class="ui checkbox" data-toggle="checkall"
                         data-selector=".checkbox[data-type='check-all-child']">
                        <input type="checkbox">
                        <label>Kategori Pengguna</label>
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
                            <label>{{ $permission->name }}</label>
                        </div>
                    </td>
                    <td>{{ $permission->description }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="ui divider hidden"></div>

        <button class="ui button primary" type="submit" name="submit" value="1">Simpan</button>
        <a href="{{ route('epicentrum::roles.index') }}" class="ui button">Batal</a>
        {!! SemanticForm::close() !!}
    </div>



    <div class="ui divider section hidden"></div>

    <div class="ui segment very padded red">
        <h3 class="">Padam Kategori</h3>
        <p>{{$role->users->count()}} Pengguna akan terlibat</p>

        {!! SemanticForm::open()->delete()->action(route('epicentrum::roles.destroy', $role['id'])) !!}
        <button class="ui button red" type="submit" name="submit" value="1"
                onclick="return confirm('Adakah anda pasti untuk padam?')">Padam
        </button>
        {!! SemanticForm::close() !!}
    </div>

@endsection
