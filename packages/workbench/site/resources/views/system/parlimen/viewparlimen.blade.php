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
          Paparan Ahli Parlimen
        </h3>
    </div> 
    <div class="column right aligned middle aligned">

           <a class="ui button" href="{!! URL::to('site/parlimen/index') !!}" id="backbutton">Kembali</a>
    </div>
</div>
  <div class="ui container-fluid content__body p-3">
      <div class="ui raised segment">
          <a class="ui black ribbon label noHover" style="background-color: yellow;font-size: 18px"><i class="user icon"></i>Maklumat Ahli Parlimen</a>
            
          <br><br>
          <div class="ui stackable grid">
          <div class="six teen wide column">
            <table  style="width:100% !important">
           <tbody>
            <tr><td align="center">  @if(data_get($parlimen,'Gambar_path')=='')
               <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
              </a>
              @elseif(file_exists(public_path (data_get($parlimen,'Gambar_path'))))
               <a target="_blank" href="{!! URL::to(data_get($parlimen,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($parlimen,'Gambar_path')) !!}" alt="ePerak" style="width:200px" >
              </a>
              @else
              <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
              </a>                  
              @endif</td></tr>
           </tbody>
        </table>
        <br>
        <table class="ui very basic collapsing celled table" style="width:100% !important">
           <tbody>
           
            <tr>
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="calendar icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Tahun</b></span>
                </div>
              </h5></td>
              <td>{{ data_get($parlimen,'tahun') }}</td>
              <td  width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="award icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Kod Parlimen</b></span>
                </div>
              </h5></td><td  width="25%">{{ data_get($parlimen,'KodParlimen') }}</td>
            </tr>
             <tr>
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="landmark icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Nama Parlimen</b></span>
                </div>
              </h5></td>
              <td>{{ data_get($parlimen,'NamaParlimen') }}</td>
              <td  width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="landmark icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Parti</b></span>
                </div>
              </h5></td><td  width="25%">{{ data_get($parlimen,'Parti') }}</td>
            </tr>
             <tr>
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="user icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Ahli Parlimen</b></span>
                </div>
              </h5></td>
              <td>{{ data_get($parlimen,'AhliParlimen') }}</td>
              <td  width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="id badge icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Jawatan</b></span>
                </div>
              </h5></td><td  width="25%">{{ data_get($parlimen,'Jawatan') }}</td>
            </tr>
             <tr>
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="envelope open icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Alamat Pejabat</b></span>
                </div>
              </h5></td>
              <td>{{ data_get($parlimen,'AlamatPejabat') }}</td>
              <td  width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="phone icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>No Tel. Pejabat</b></span>
                </div>
              </h5></td><td  width="25%">{{ data_get($parlimen,'TelNo') }}</td>
            </tr>
            <tr>
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="fax icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Faksimili</b></span>
                </div>
              </h5></td>
              <td>{{ data_get($parlimen,'Faks') }}</td>
              <td  width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>&nbsp;</b></span>
                </div>
              </h5></td><td  width="25%"></td>
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