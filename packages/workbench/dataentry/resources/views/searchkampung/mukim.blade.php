 <div class="item" data-value="" onclick="kampungmukim(0)">Sila Pilih</div>
@foreach($mukim as $key => $value)
<div class="item" data-value="{{$value->id}}" onclick="kampungmukim({{$value->id}})">{{$value->NamaMukim}}</div>
@endforeach