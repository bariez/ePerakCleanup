<div class="item" data-value="">Sila Pilih</div>
@foreach($dun as $key => $value)
<div class="item" data-value="{{$value->id}}" data-text="{{$value->NamaDun}}" onclick="sdun()">
    {{$value->NamaDun}}
</div>
@endforeach

