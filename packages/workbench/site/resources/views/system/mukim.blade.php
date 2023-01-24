 <div class="item" data-value="" onclick="pilihmukim(0)">Sila Pilih</div>
@foreach($mukim as $key => $value)
<div class="item" data-value="{{$value->id}}" onclick="pilihmukim({{$value->id}})">{{$value->NamaMukim}}</div>
@endforeach