@extends('laravolt::layout.app2')
@section('content')
<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0" >
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs" style="color:black">
       {{data_get($data_kampung,'NamaKampung')}}
        </h3>
    </div> 
    <div class="column right aligned middle aligned">
       <a class="ui button" href="/dataentry/searchkampung/index" id="backbutton"><i class="material-icons left"></i><span>Kembali</span></a>
    </div>
</div>
<div class="ui container-fluid content__body p-3">
<div class="ui two stackable cards raised">
  <div class="card">
   <div class="image" align="center" style="background-color: white">
        <a class="header" href="/eperak/dataentry/searchkampung/editkampung/{{$id}}/{{$tabmain}}/{{$tabdetail}}/{{$iddetail}}"><img src="/rumah.png" style="width:300px;height:300px"></a>
      </div>
      <div class="content" align="center">
        <a class="header" href="/dataentry/searchkampung/editkampung/{{$id}}/{{$tabmain}}/{{$tabdetail}}/{{$iddetail}}">Maklumat Asas</a>
      </div>
  </div>
  <div class="card">
          <div class="image" align="center" style="background-color: white">
            <a class="header" href="/eperak/dataentry/searchkampung/isirumah/ketuaisirumah/{{$id}}"><img src="/isirumah.png" style="width:300px;height:300px"></a>
        
      </div>
      <div class="content" align="center">
        <a class="header" href="/dataentry/searchkampung/isirumah/ketuaisirumah/{{$id}}">Maklumat Ketua Isi Rumah & Ahli Isi Rumah</a>
      </div>
  </div>
  </div>
</div>

@endsection


@push('script')



<script type="text/javascript">

</script>

@endpush
