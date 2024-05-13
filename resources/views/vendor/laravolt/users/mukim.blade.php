 <div class="item" data-value=""  onclick="kampung(0)">Sila Pilih</div>
@foreach($mukim as $key => $value)
<div class="item" data-value="{{$value->id}}"  onclick="kampung({{$value->id}})">{{$value->NamaMukim}}</div>
@endforeach