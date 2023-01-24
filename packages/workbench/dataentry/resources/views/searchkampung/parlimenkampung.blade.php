 <div class="item" data-value="" onclick="dun(0)">Sila Pilih</div>
@foreach($parlimenKampung as $key => $value)
<div class="item" data-value="{{$value->id}}" onclick="dun({{$value->id}})">{{$value->NamaParlimen}}</div>
@endforeach