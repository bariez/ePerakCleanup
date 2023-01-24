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
          Paparan Kampung
        </h3>
    </div> 
    <div class="column right aligned middle aligned">

           <a class="ui button" href="{!! URL::to('site/kampung/index') !!}" id="backbutton">Kembali</a>
    </div>
</div>
  <div class="ui container-fluid content__body p-3">
      <div class="ui raised segment">
          <a class="ui black ribbon label noHover" style="background-color: yellow;font-size: 18px"><i class="home icon"></i>Maklumat Kampung</a>
            
          <br><br>
          <div class="ui stackable grid">
          <div class="six teen wide column">
        <table class="ui very basic collapsing celled table" style="width:100% !important">
           <tbody>
            <tr>
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="bookmark icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Daerah</b></span>
                </div>
              </h5></td>
              <td>{{data_get($daerah,'NamaDaerah') }}</td>
            </tr>
            <tr>
             <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="flag outline icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Mukim</b></span>
                </div>
              </h5></td>
              <td>{{data_get($mukimedit,'NamaMukim') }}</td>
            </tr>
             <tr>
              <td  width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="archway icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Parlimen</b></span>
                </div>
              </h5></td><td  width="25%">{{data_get($parlimen,'NamaParlimen') }}</td>
            </tr>
            <tr>
               <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="university icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Dun</b></span>
                </div>
              </h5></td>
              <td>{{data_get($dunedit,'NamaDun') }}
              </td>
            </tr>
              <tr>
               <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="star icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Kategori Petempatan</b></span>
                </div>
              </h5></td>
              <td>{{data_get($catpenempatan,'description') }}
              </td>
             </tr>
             <tr id="divkgtradisional">
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="map pin icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Jenis Kampung Tradisional</b></span>
                </div>
              </h5></td>
              <td>{{data_get($jeniskampung,'description') }}
              </td>
            </tr>
             <tr id="induk">
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="house icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Nama Kampung Induk</b></span>
                </div>
              </h5></td>
              <td>{{data_get($kampunginduk,'NamaKampung') }}
              </td>
            </tr>
             <tr id="divnamakampung">
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="map marker icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Nama Kampung</b></span>
                </div>
              </h5></td>
              <td>{{data_get($kampung,'NamaKampung') }}
              </td>
            </tr>
            <tr id="divnamataman">
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="map marker icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Nama Taman</b></span>
                </div>
              </h5></td>
              <td>{{data_get($kampunginduk,'NamaKampung') }}
              </td>
            </tr>
             <tr id="divnamaserata">
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="map marker icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Nama Serata</b></span>
                </div>
              </h5></td>
              <td>{{data_get($kampunginduk,'NamaKampung') }}
              </td>
            </tr>
              <tr id="divnamaserata">
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="bookmark outline icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Nama JPKK</b></span>
                </div>
              </h5></td>
              <td>{{data_get($kampung,'NamaJPKK') }}
              </td>
            </tr>
             <tr id="divnamaserata">
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="envelope icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Alamat Surat Menyurat JPKK</b></span>
                </div>
              </h5></td>
              <td>{{data_get($kampung,'AlamatJPKK') }}
              </td>
            </tr>
            <tr>
               <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="star icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Status</b></span>
                </div>
              </h5></td>
              <td>@if(data_get($kampung,'status')==1 )
                AKTIF
                 @else
                 TIDAK AKTIF
                @endif
              </td>
            </tr>
            <tr id="divnamaserata">
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="map marker icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Url GIS</b></span>
                </div>
              </h5></td>
              <td>{{data_get($kampung,'url_gis') }}
              </td>
            </tr>
            <tr>
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>&nbsp;</b></span>
                </div>
              </h5></td>
              <td>&nbsp;
              </td>
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


  $(document).ready(function() {

  var jeiniskgtradisional="{{ data_get($kampung,'kgtradisonal.id') }}";

  if (jeiniskgtradisional == 148) {

    $('#induk').show();

  }else{

    $('#induk').hide();


  }

   var katpetempatan="{{ data_get($kampung,'KategoriPetempatan') }}";


    if (katpetempatan == 4) { //kampung tradisional
      $('#divkgtradisional').show();
      $('#divnamakampung').show();
      $('#divnamaserata').hide();
      $('#divnamataman').hide();

    } else {

      if (id == 0) {

        $('#divnamakampung').hide();
        $('#divnamaserata').hide();
        $('#divnamataman').hide();
        $('#divkgtradisional').hide();

      } else {

        if (id == 5 || id == 6 || id == 9) { //tersusun baru orang asli
          $('#divnamakampung').show();
          $('#divnamaserata').hide();
          $('#divnamataman').hide();

        } else {

          if (id == 8) { //serata
            $('#divnamaserata').show();
            $('#divnamataman').hide();
           



          } else { //taman
            $('#divnamataman').show();
            $('#divnamaserata').hide();
           

          }
          $('#divnamakampung').hide();



        }

        $('#divkgtradisional').hide();
        $('#induk').hide();
       



      }



    }



  });

  

</script>
@endpush