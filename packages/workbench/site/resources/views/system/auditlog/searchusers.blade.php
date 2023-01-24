<div class="item" data-value="">Sila Pilih</div>
@foreach($result as $key => $value)
<div class="item" data-value="{{$value->id}}" >{{$value->name}}</div>
@endforeach
</div>