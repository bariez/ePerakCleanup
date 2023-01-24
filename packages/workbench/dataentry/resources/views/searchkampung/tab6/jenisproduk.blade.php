<div class="item" data-value="" id="add">Sila Pilih</div>
@foreach($jenisproduk as $key => $value)
<div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
@endforeach