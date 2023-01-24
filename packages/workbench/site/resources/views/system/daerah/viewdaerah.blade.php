@extends('laravolt::layout.app2')

@section('content')
<style>
  .noHover{
    pointer-events: none;
}
  #spanlabel{
  color:black !important;
}
  </style>
<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0" >
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs">
          Paparan Daerah
        </h3>
    </div> 
    <div class="column right aligned middle aligned">

           <a class="ui button" href="{!! URL::to('site/daerah/index') !!}" id="backbutton">Kembali</a>
    </div>
</div>
  <div class="ui container-fluid content__body p-3">
      <div class="ui raised segment">
          <a class="ui black ribbon label noHover" style="background-color: yellow;font-size: 18px"><i class="archway icon"></i>Maklumat Daerah</a>
            
          <br><br>
          <div class="ui stackable grid">
          <div class="six teen wide column">
        <table class="ui very basic collapsing celled table" style="width:100% !important">
           <tbody>
            <tr>
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="bookmark icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Kod Daerah</b></span>
                </div>
              </h5></td>
              <td>{{ data_get($daerah,'KodDaerah') }}</td>
            </tr>
            <tr>
             <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="flag outline icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Nama Daerah</b></span>
                </div>
              </h5></td>
              <td>{{ data_get($daerah,'NamaDaerah') }}</td>
            </tr>
             <tr>
              <td  width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="user icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Nama Pegawai Daerah</b></span>
                </div>
              </h5></td><td  width="25%">{{ data_get($daerah,'NamaPegawaiDaerah') }}</td>
            </tr>
            <tr>
               <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="star icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Status</b></span>
                </div>
              </h5></td>
              <td>@if(data_get($daerah,'Status')==1 )
                AKTIF
                 @else
                 TIDAK AKTIF
                @endif
              </td>
            </tr>
              <tr>
              <td  width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="map marker icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Url GIS</b></span>
                </div>
              </h5></td><td  width="25%">{{ data_get($daerah,'url_gis') }}</td>
            </tr>

             
          </tbody>
        </table>
        </div>
        
        </div>
    </div>
  </div>

 {!! form()->close() !!}
@endsection

@push('script')

<script type="text/javascript">

  

</script>
@endpush