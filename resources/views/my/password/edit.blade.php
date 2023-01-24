@extends('laravolt::layout.app2')

@section('content')
<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0">
    <div class="column middle aligned">
        <h3 class="ui header m-t-xs">
           Kemaskini Kata Laluan
        </h3>
    </div>
</div>
<div class="ui container-fluid content__body p-3">
        <div class="ui segments panel">
   <div class="ui segment p-3">
  {!! form()->open()->action(route('my::password.update'))->horizontal() !!}
        {!! form()->password('password_current')->label(__('Kata Laluan Asal')) !!}
        {!! form()->password('password')->label(__('Kata Laluan Baru')) !!}
        {!! form()->password('password_confirmation')->label(__('Pengesahan Kata Laluan Baru')) !!}
           <div class="ui divider section"></div>
            <div align="right">
             <button type="submit" class="ui button primary" id="hantar" name="hantar"> Simpan</button>
            <a class="ui button" href="{!! URL::to('/home') !!}"><i class="material-icons left"></i><span>Kembali</span></a>   
            </div>

         {!! form()->close() !!}

  </div>
</div>
</div>

@endsection
@push('script')