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
          Paparan Maklumat Ahli Isi Rumah
        </h3>
    </div> 
    <div class="column right aligned middle aligned">

           <a class="ui button" href="{!! URL::to('dataentry/searchkampung/isirumah/ahliisirumah/'.$idkampung.'/'.$idrumah) !!}" id="backbutton"><i class="material-icons left"></i><span>Kembali</span></a>
    </div>
</div>
<div class="ui container-fluid content__body p-3">
      <div class="ui raised segment">
        <h4 class="ui dividing header" style="color:black" align="middle">{{data_get($infokampung,'NamaKampung')}}</h4>
          <a class="ui black ribbon label noHover" style="background-color: yellow;font-size: 18px"><i class="user icon"></i>Maklumat Ahli Isi Rumah</a>
            
          <br><br>
          <div class="ui stackable grid">
          <div class="six teen wide column">
        <table class="ui very basic collapsing celled table" style="width:100% !important">
           <tbody>
            <tr>
              <td width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="user icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px";><b>Nama Ahli Isi Rumah</b></span>
                </div>
              </h5></td>
              <td>{{data_get($ahliisirumah,'Nama')}}</td>
              <td  width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel"><i class="id card outline icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Jenis Pengenalan</b></span>
                </div>
              </h5></td><td  width="25%">{{data_get($jenispengenalan,'description')}}</td>
            </tr>
            <tr>
              <td  width="25%">
                <h5 class="ui image header">
                  <div class="content" id="divnoic" style="display:none; ">
                    <span id="spanlabel"><i class="fingerprint icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>No. Kad Pengenalan</b></span>
                </div>
                 <div class="content" id="divnopengenalan" style="display: none;">
                     <span id="spanlabel"><i class="fingerprint icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>No. Tentera/No. Polis/Passport</b></span>
                </div>
              </h5></td><td width="25%">{{data_get($ahliisirumah,'NoKP')}}</td>
              <td>
                <h5 class="ui image header">
                  
                  <div class="content">
                     <span id="spanlabel"><i class="restroom icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Jantina</b></span>
                </div>
              </h5></td><td>{{data_get($jantina,'description')}}</td>
            </tr>
            <tr>
              <td>
                <h5 class="ui image header">
                 
                  <div class="content" style="font-style: unset">
                     <span id="spanlabel"><i class="calendar alternate outline icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Tarikh Lahir</b></span>
                </div>
              </h5></td><td>{{ date('d/m/Y', strtotime(data_get($ahliisirumah,'TarikhLahir')))}}</td>
              <td>
                <h5 class="ui image header">
                  <div class="content" style="font-style: unset">
                      <span id="spanlabel"><i class="heartbeat icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Umur</b></span>
                </div>
              </h5></td><td><span id="umur"></span></td>
            </tr>
            <tr>
              <td>
                <h5 class="ui image header">
                  <div class="content" style="font-style: unset">
                     <span id="spanlabel"><i class="id badge icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Warganegara</b></span>
                </div>
              </h5></td><td><span id="warga"></span></td>
              <td>
                <h5 class="ui image header">
                  <div class="content" style="font-style: unset">
                     <span id="spanlabel"><i class="user outline icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Bangsa</b></span>
                </div>
              </h5></td><td>{{data_get($bangsa,'description')}}</td>
            </tr>
             <tr>
              <td>
                <h5 class="ui image header">
                  <div class="content" style="font-style: unset">
                     <span id="spanlabel"><i class="bookmark outline icon"></i></span><span  id="spanlabel"style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Agama</b></span>
                </div>
              </h5></td><td>{{data_get($agama,'description')}}</td>
              <td>
                <h5 class="ui image header">
                  <div class="content" style="font-style: unset">
                     <span id="spanlabel"><i class="asterisk icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Taraf Perkahwinan</b></span>
                </div>
              </h5></td><td>{{data_get($taraf,'description')}}</td>
            </tr>
             <tr>
              <td>
                <h5 class="ui image header">
                  <div class="content" style="font-style: unset">
                     <span id="spanlabel"><i class="toolbox icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Status Pekerjaan</b></span>
                </div>
              </h5></td><td>{{data_get($statuskerja,'description')}}</td>
              <td>
                <h5 class="ui image header">
                  <div class="content" style="font-style: unset">
                     <span id="spanlabel"><i class="hand holding usd icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Pekerjaan</b></span>
                </div>
              </h5></td><td>{{data_get($ahliisirumah,'Pekerjaan')}}</td>
            </tr>
             <tr>
              <td>
                <h5 class="ui image header">
                  <div class="content" style="font-style: unset">
                     <span id="spanlabel"><i class="handshake outline icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Penerima Bantuan (Bulanan)</b></span>
                </div>
              </h5></td><td>{{data_get($bantuanbulanan,'description')}}</td>
              <td>
                <h5 class="ui image header">
                  <div class="content" style="font-style: unset">
                     <span id="spanlabel"><i class="handshake outline icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Bantuan Lain-Lain</b></span>
                </div>
              </h5></td><td>{{data_get($ahliisirumah,'BantuanLain')}}</td>
            </tr>
             <tr>
              <td>
                <h5 class="ui image header">
                  <div class="content" style="font-style: unset">
                     <span id="spanlabel"><i class="dollar sign icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Pendapatan Isi Rumah</b></span>
                </div>
              </h5></td><td>{{number_format(data_get($ahliisirumah,'Pendapatan'), 2) }}</td>
               <td  width="25%">
                <h5 class="ui image header">
                  <div class="content">
                    <span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>&nbsp;</b></span>
                </div>
              </h5></td><td  width="25%"> </td>
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

  $(document).ready(function() 
  {

    var type="{{data_get($ahliisirumah,'JenisPengenalan')}}";

 
  if(type==152){//paspport


  $("#warga").text('Bukan Warganegara');

  }else{

  $("#warga").text('Warganegara');


  }


     var lahir="{{ date('d/m/Y', strtotime(data_get($ahliisirumah,'TarikhLahir')))}}"

      var date = lahir;
      var tahun = date.slice(-4);

       const d = new Date();
     let curyear = d.getFullYear();

     var umur = curyear-parseInt(tahun)


     $("#umur").text(umur);



if(type==150){//kad pengenalan
  $('#divnoic').show();
     $('#divnopengenalan').hide();
 
  }else{
    $('#divnoic').hide();
    $('#divnopengenalan').show();

  }


 $('#standard_calendar')
  .calendar({
    monthFirst: false,
    type: 'date',
    formatter: {
      date: function (date, settings) {
        if (!date) return '';
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        return day + '/' + month + '/' + year;
      }
    },
    onChange: function (date, text) {
     var newValue = text;

      const d = new Date();
      let curyear = d.getFullYear();
      var year = date.getFullYear();

       var umur = curyear-parseInt(year)

     $('#umur').val(umur);

   
    },
  })
;



});

</script>
@endpush