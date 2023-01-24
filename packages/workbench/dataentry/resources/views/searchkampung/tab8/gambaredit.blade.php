 <label>&nbsp;</label>
 @if(data_get($data_galeri,'gambar_path')=='')
   <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
  </a>
  @elseif(file_exists(public_path (data_get($data_galeri,'gambar_path'))))
   <a target="_blank" href="{!! URL::to(data_get($data_galeri,'gambar_path')) !!}"><img src="{!! URL::to(data_get($data_galeri,'gambar_path')) !!}" alt="ePerak" style="width:200px">
  </a>
  @else
  <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
  </a>                  
  @endif