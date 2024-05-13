 <div class="item" data-value="">Sila Pilih</div>
@foreach($kampung as $key => $value)
<div class="item" data-value="{{$value->id}}">{{$value->NamaKampung}}</div>
@endforeach