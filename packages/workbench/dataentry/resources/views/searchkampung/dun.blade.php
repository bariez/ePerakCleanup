
<div class="item" data-value="" onclick="kampungdun(0)">Sila Pilih</div>
@foreach($dun as $key => $value)
<div class="item" data-value="{{$value->id}}" onclick="kampungdun({{$value->id}})" data-text="{{$value->NamaDun}}">
    {{$value->NamaDun}}
</div>
@endforeach

