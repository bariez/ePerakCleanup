@extends('laravolt::layout.app2')

@section('page.title', __('laravolt::label.permissions'))



@section('content')

<div id="actionbar" class="ui two column grid content__body p-x-2 p-y-1 m-b-0" >
    <div class="column middle aligned">
        <h3 class="ui header m-t-xs">
          Kebenaran Pengguna
        </h3>
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
