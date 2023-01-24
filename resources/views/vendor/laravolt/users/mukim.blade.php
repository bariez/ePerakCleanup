 <div class="item" data-value="">Sila Pilih</div>
@foreach($mukim as $key => $value)
<div class="item" data-value="{{$value->id}}">{{$value->NamaMukim}}</div>
@endforeach