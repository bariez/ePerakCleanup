@extends('laravolt::layout.app2')

@section('content')

<style type="text/css">
	
	input[type=file]::-webkit-file-upload-button {
    visibility: hidden;
	}

	.file { position: relative; height: 30px; width: 100px; }
.file > input[type="file"] { position: absoulte; opacity: 0; top: 0; left: 0; right: 0; bottom: 0 }
.file > label { position: absolute; top: 0; right: 0; left: 0; bottom: 0; background-color: #666; color: #fff; line-height: 30px; text-align: center; cursor: pointer; }
s
}

</style>

<style>
img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}

img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
.noHover{
    pointer-events: none;
}
#spanlabel{
	color:black !important;
}

</style>
<div id="actionbar" class="ui two column grid p-2" >
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs">
          Paparan Makumat Ketua Isi Rumah
        </h3>
    </div> 
    <div class="column right aligned middle aligned">

        <a class="ui button" href="{!! URL::to('dataentry/searchkampung/isirumah/ketuaisirumah/'.$idkampung) !!}" id="backbutton"><i class="material-icons left"></i><span>Kembali</span></a>
    </div>
</div>
<br>

<div class="ui container-fluid p-2">
    	<div class="ui raised segment">
    		<h4 class="ui dividing header" style="color:black" align="middle">{{data_get($infokampung,'NamaKampung')}}</h4>
      		<a class="ui black ribbon label noHover" style="background-color: yellow;font-size: 18px"><i class="user icon"></i>Profil Ketua Isi Rumah</a>
      			
      		<br>
      		
      		<div class="ui stackable grid">
  				<div class="six teen wide column">
				<table class="ui very basic collapsing celled table" style="width:100% !important">
				   <tbody>
				    <tr>
				      <td width="25%">
				        <h5 class="ui image header">
				          <div class="content">
				            <span id="spanlabel"><i class="user icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px";><b>Nama Pemilik / Ketua Rumah</b></span>
				        </div>
				      </h5></td>
				      <td>{{data_get($ketuaisirumah,'Nama')}}</td>
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
				      </h5></td><td width="25%">{{data_get($ketuaisirumah,'NoKP')}}</td>
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
				      </h5></td><td>{{ date('d/m/Y', strtotime(data_get($ketuaisirumah,'TarikhLahir')))}}</td>
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
				      </h5></td><td>{{data_get($ketuaisirumah,'Pekerjaan')}}</td>
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
				      </h5></td><td>{{data_get($ketuaisirumah,'BantuanLain')}}</td>
				    </tr>
				     <tr>
				      <td>
				        <h5 class="ui image header">
				          <div class="content" style="font-style: unset">
				             <span id="spanlabel"><i class="home icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Id Rumah</b></span>
				        </div>
				      </h5></td><td>{{data_get($ketuaisirumah,'rumah.IdRumah')}}</td>
				      <td>
				        <h5 class="ui image header">
				          <div class="content" style="font-style: unset">
				             <span id="spanlabel"><i class="dollar sign icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Pendapatan Isi Rumah</b></span>
				        </div>
				      </h5></td><td>{{number_format(data_get($ketuaisirumah,'Pendapatan'), 2) }}</td>
				    </tr>
				     <tr>
				      <td>
				        <h5 class="ui image header">
				          <div class="content" style="font-style: unset">
				             <span id="spanlabel"><i class="envelope open icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Alamat 1</b></span>
				        </div>
				      </h5></td><td>{{ data_get($ketuaisirumah,'rumah.AlamatRumah1') }}</td>
				      <td>
				        <h5 class="ui image header">
				          <div class="content" style="font-style: unset">
				             <span id="spanlabel"><i class="envelope open icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Alamat 2</b></span>
				        </div>
				      </h5></td><td>{{data_get($ketuaisirumah,'rumah.AlamatRumah2')}}</td>
				    </tr>
				     <tr>
				      <td >
				        <h5 class="ui image header">
				          <div class="content" style="font-style: unset">
				             <span id="spanlabel"><i class="map marker alternate icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Poskod</b></span>
				        </div>
				      </h5></td><td>{{data_get($ketuaisirumah,'rumah.Poskod')}}</td>
				      <td>
				        <h5 class="ui image header">
				          <div class="content" style="font-style: unset">
				             <span style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>&nbsp;</b></span>
				        </div>
				      </h5></td><td></td>
				    </tr>
				    
				     
				  </tbody>
				</table>
				</div>
				
		    </div>
  	</div>
  </div>
<div class="ui container-fluid p-2">
    	<div class="ui raised segment">
      		<a class="ui black ribbon label noHover" style="background-color: yellow;font-size: 18px"><i class="phone icon"></i>Maklumat Untuk Dihubungi</a>
      			
      		<br><br>
      		<div class="ui stackable grid">
  				<div class="six teen wide column">
				<table class="ui very basic collapsing celled table" style="width:100% !important">
				   <tbody>
				    <tr>
				      <td width="25%">
				        <h5 class="ui image header">
				          <div class="content">
				            <span id="spanlabel"><i class="user icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Emel</b></span>
				        </div>
				      </h5></td>
				      <td>{{data_get($ketuaisirumah,'Email')}}</td>
				      <td  width="25%">
				        <h5 class="ui image header">
				          <div class="content">
				            <span id="spanlabel"><i class="id card outline icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>No. Telefon</b></span>
				        </div>
				      </h5></td><td  width="25%">{{data_get($ketuaisirumah,'TelNo')}}</td>
				    </tr>
				  </tbody>
				</table>
				</div>
				
		    </div>
  	</div>
  </div>

  <div class="ui container-fluid  p-2">
    	<div class="ui raised segment">
      		<a class="ui black ribbon label noHover" style="background-color: yellow;font-size: 18px"><i class="home icon"></i>Maklumat Rumah</a>
      			
      		<br><br>
      		<div class="ui stackable grid">
  				<div class="six teen wide column">
  					<table  style="width:100% !important">
				   <tbody>
				   	<tr><td align="center"> @if(data_get($ketuaisirumah,'rumah.Gambar_path')=='')
			               <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:200px">
			              </a>
			              @elseif(file_exists(public_path (data_get($ketuaisirumah,'rumah.Gambar_path'))))
			               <a target="_blank" href="{!! URL::to(data_get($ketuaisirumah,'rumah.Gambar_path')) !!}"><img src="{!! URL::to(data_get($ketuaisirumah,'rumah.Gambar_path')) !!}" alt="ePerak" style="width:200px">
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
				            <span id="spanlabel"><i class="file alternate icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Status Pemilikan Rumah</b></span>
				        </div>
				      </h5></td>
				      <td>{{data_get($statusmilik,'description')}}</td>
				      <td  width="25%">
				        <h5 class="ui image header">
				          <div class="content">
				            <span id="spanlabel"><i class="home icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Jenis Rumah</b></span>
				        </div>
				      </h5></td><td  width="25%">{{data_get($jenisrumah,'description')}}</td>
				    </tr>
				     <tr>
				      <td width="25%">
				        <h5 class="ui image header">
				          <div class="content">
				            <span id="spanlabel"><i class="drafting compass icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Binaan Rumah</b></span>
				        </div>
				      </h5></td>
				      <td>{{data_get($binaanrumah,'description')}}</td>
				      <td  width="25%">
				        <h5 class="ui image header">
				          <div class="content">
				            <span id="spanlabel"><i class="building icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Bilangan Tingkat</b></span>
				        </div>
				      </h5></td><td  width="25%">{{data_get($biltingkat,'description')}}</td>
				    </tr>
				     <tr>
				      <td width="25%">
				        <h5 class="ui image header">
				          <div class="content">
				            <span id="spanlabel"><i class="map marker alternate icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Latitud</b></span>
				        </div>
				      </h5></td>
				      <td>{{data_get($ketuaisirumah,'rumah.Latitud')}}</td>
				      <td  width="25%">
				        <h5 class="ui image header">
				          <div class="content">
				            <span id="spanlabel"><i class="map marker alternate icon"></i></span><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Longitud</b></span>
				        </div>
				      </h5></td><td  width="25%">{{data_get($ketuaisirumah,'rumah.Longitud')}}</td>
				    </tr>
				     <tr>
				      <td width="25%">
				        <h5 class="ui image header">
				          <div class="content">
				            <span id="spanlabel"><i class="door closed icon"></i><span id="spanlabel" style="font-size: 14px !important;font-weight: normal !important;padding-left:10px"><b>Bilangan Bilik</b></span>
				        </div>
				      </h5></td>
				      <td>{{data_get($bilbilik,'description')}}</td>
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



@endsection

@push('script')

<script type="text/javascript">

  $(document).ready(function() 
  {


       var type="{{data_get($ketuaisirumah,'JenisPengenalan')}}";

 

  if(type==152){//paspport


    $("#warga").text('Bukan Warganegara');

  }else{

	$("#warga").text('Warganegara');


  }


  	 var lahir="{{ date('d/m/Y', strtotime(data_get($ketuaisirumah,'TarikhLahir')))}}"

      var date = lahir;
      var tahun = date.slice(-4);

       const d = new Date();
     let curyear = d.getFullYear();

     var umur = curyear-parseInt(tahun)


     $("#umur").text(umur);


if(type==150){//kad pengenalan
     $('#divnopengenalan').hide();
     $('#divnoic').show();

     $('#tlahirauto').show();
     
     $('#jantinaauto').show();
     $('#jantinapilih').hide();

     if(jantina==114){
      $("#jauto").val('Perempuan');

     }else{
      $("#jauto").val('Lelaki');

     }

        $('#tlahirauto').show();
        $('#tlahircal').hide();

        $("#labellahirauto").html("Tarikh Lahir<font color='red'>*</font>");

  }else{
    $('#divnoic').hide();
    $('#divnopengenalan').show();
    $('#tlahirauto').hide();
    $('#jantinaauto').hide();
    $('#jantinapilih').show();

    $('#tlahirauto').hide();
    $('#tlahircal').show();

    $("#labellahir").html("Tarikh Lahir<font color='red'>*</font>");


  }







        $("#pendapat").on("keyup", function(){
                     var valid = /^\d{0,20}(\.\d{0,2})?$/.test(this.value),
                      val = this.value;

                    if(!valid){
                        console.log("Invalid input!");
                        this.value = val.substring(0, val.length - 1);
                    }
                   });


        $("#Latitud").on("keyup", function(){
                     var valid = /^\d{0,20}(\.\d{0,5})?$/.test(this.value),
                      val = this.value;

                    if(!valid){
                        console.log("Invalid input!");
                        this.value = val.substring(0, val.length - 1);
                    }
                   });

        $("#Longitud").on("keyup", function(){
                     var valid = /^\d{0,20}(\.\d{0,5})?$/.test(this.value),
                      val = this.value;

                    if(!valid){
                        console.log("Invalid input!");
                        this.value = val.substring(0, val.length - 1);
                    }
                   });


         $("#bantuanbulan").change(function(e) {

         	var jenis=this.value;
          var lain="{{data_get($ketuaisirumah,'BantuanLain')}}"

         	if(jenis==138){
         		
         		$('#bantuanlain').prop('readonly', false);
         		$('#bantuanlain').attr('required', false)

         	}else{

         		$('#bantuanlain').prop('readonly', true);
         		$('#bantuanlain').attr('required', true);



         	}


         });
  });

</script>

@endpush


