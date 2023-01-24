 <div class="item" data-value="">Sila Pilih</div>
@foreach($getinduk as $key => $value)
<div class="item" data-value="{{$value->id}}">{{$value->NamaKampung}}</div>
@endforeach