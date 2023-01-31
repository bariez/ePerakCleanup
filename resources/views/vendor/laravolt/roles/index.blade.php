@extends('laravolt::layout.app2')




@section('content')
<div id="actionbar" class="ui two column grid content__body p-x-2 p-y-1 m-b-0" >
    <div class="column middle aligned">
        <h3 class="ui header m-t-xs">
          Kategori Pengguna
        </h3>
    </div> 
    <div class="column right aligned middle aligned">

           <a class="ui button green" href="{{ route('epicentrum::roles.create') }}" id="addbutton"><i class="icon plus"></i><span>Tambah</span></a>


    </div>
</div>
<br>


<div class="ui attached segment raised">
    <div class="ui grid">
        <div class="column sixteen wide">
            <div class="ui cards three doubling">
                @foreach($roles as $role)
                    <a href="{{ route('epicentrum::roles.edit', $role['id']) }}" class="ui card">
                        <div class="content">
                            <h3 class="header link">{{ $role['name'] }}</h3>
                        </div>
                        <div class="extra content">
                            <i class="icon users"></i>{{ $role->users->count() }}
                            <span class="right floated"><i class="icon options"></i> {{ $role->permissions()->count() }}</span>
                        </div>
                        {{--<div class="extra content">--}}
                        {{--<a href="{{ route('epicentrum::roles.edit', $role['id']) }}" class="ui button fluid"><i class="icon setting"></i> @lang('laravolt::action.manage')</a>--}}
                        {{--</div>--}}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection
