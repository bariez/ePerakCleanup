
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
         font-size:10px;
    }
    div{
          font-size:10px;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: lightgray
    }

table, td, th {
  border: 1px solid black;
}

#table1 {
  border-collapse: separate;
}

#table2 {
  border-collapse: collapse;
}
</style>

</head>
<body>
<div align="center"><img src="{{ public_path('logo3.jpg') }}" alt="" width="100"/></div>
<br>
<div align="center"><b>MAKLUMAT KETUA ISI RUMAH & AHLI ISI RUMAH </b></div>
<br>
<div align="center"><b>{{$namakmapung}}</b></div>
<br>
<div align="center"><b>MAKLUMAT RUMAH</b></div>
<br>


<table width="100%" id="table2" cellpadding="1">
<tr>
    <td colspan="3" style="text-align: center;"><b>MAKLUMAT RUMAH</b></td>
    <td colspan="4" style="text-align: center;"><b>JENIS RUMAH</b></td>
    <td colspan="5" style="text-align: center;"><b>KEMUDAHAN</b></td>
    <td colspan="7" style="text-align: center;"><b>MAKLUMAT ISI RUMAH</b></td>
</tr>
<tr>
    <td style="text-align: center;" width="30%"><b>NAMA KETUA RUMAH</b></td>
    <td style="text-align: center;" width="30%"><b>ID RUMAH</b></td>
    <td style="text-align: center;" width="30%"><b>ALAMAT</b></td>
    <td style="text-align: center;" width="30%"><b>STATUS PEMILIKAN RUMAH</b></td>
    <td style="text-align: center;" width="30%"><b>JENIS RUMAH</b></td>
    <td style="text-align: center;" width="30%"><b>JENIS BINAAN</b></td>
    <td style="text-align: center;" width="30%"><b>BIL. TINGKAT</b></td>
    <td width="30%" style="text-align: center;"><b>BIL BILIK</b></td>
    <td width="30%" style="text-align: center;"><b>API</b></td>
    <td width="30%" style="text-align: center;"><b>AIR</b></td>
    <td width="30%" style="text-align: center;"><b>ASTRO</b></td>
    <td style="text-align: center;" width="30%"><b>INTERNET</b></td>
    <td style="text-align: center;" width="30%"><b>BIL</b></td>
    <td width="30%" style="text-align: center;"><b>NAMA</b></td>
    <td style="text-align: center;" width="30%"><b>NO. PENGENALAN</b></td>
    <td style="text-align: center;" width="30%"><b>UMUR</b></td>
    <td style="text-align: center;" width="30%"><b>PEKERJAAN</b></b></td>
    <td style="text-align: center;" width="30%"><b>BANTUAN</b></td>
    <td style="text-align: center;" width="30%"><b>PENDAPATAN</b></td>
</tr>
  <?php $i=1; ?>
 @forelse($data as $key =>$data)
           @if(data_get($data,'flag_ketua_rumah')==1)
          <tr>
          <td style="text-align: center;" width="30%">
          {{data_get($data,'Nama')}}
          </td>
           <td style="text-align: center;" width="30%">
          {{data_get($data,'IdRumah')}}
          </td>
          <td style="text-align: center;" width="30%">
          {{data_get($data,'alamat')}}
          </td>
          <td style="text-align: center;" width="30%">
          {{data_get($data,'StatusMilikan')}}
          </td>
          <td style="text-align: center;" width="30%">
          {{data_get($data,'JenisRumah')}}
          </td>
          <td style="text-align: center;" width="30%">
          {{data_get($data,'JenisBinaan')}}
          </td>
          <td style="text-align: center;" width="30%">
          {{data_get($data,'BilTingkat')}}
          </td>
           <td style="text-align: center;" width="30%">
          {{data_get($data,'BilBilik')}}
          </td>
          <td style="text-align: center;" width="30%">
           {{data_get($data,'KElektrikt')}}
          </td>
          <td style="text-align: center;" width="30%">
           {{data_get($data,'KAir')}}
          </td>
          <td style="text-align: center;" width="30%">
           {{data_get($data,'KAstro')}}
          </td>
          <td style="text-align: center;" width="30%">
           {{data_get($data,'KInternet')}}
          </td>
          <td style="text-align: center;" width="30%">
          {{data_get($data,'susunan')}}
         </td>
         <td style="text-align: center;" width="30%">
          {{data_get($data,'Nama')}}
         </td>
         <td style="text-align: center;" width="30%">
          {{data_get($data,'NoKP')}}
         </td>
         <td style="text-align: center;" width="30%">
          {{data_get($data,'Umur')}}
         </td>
         <td style="text-align: center;" width="30%">
          {{data_get($data,'Pekerjaan')}}
         </td>
          <td style="text-align: center;" width="30%">
          {{data_get($data,'Bantuan')}}
         </td>
         <td style="text-align: center;" width="30%">
          {{number_format(data_get($data,'Pendapatan'),2)}}
         </td>
       </tr>
       @else
         <tr>
          <td colspan="12">
           &nbsp;
          </td>
         <td style="text-align: center;" width="30%">
          {{data_get($data,'susunan')}}
         </td>
         <td style="text-align: center;" width="30%">
          {{data_get($data,'Nama')}}
         </td>
         <td style="text-align: center;" width="30%">
          {{data_get($data,'NoKP')}}
         </td>
         <td style="text-align: center;" width="30%">
          {{data_get($data,'Umur')}}
         </td>
          <td style="text-align: center;" width="30%">
          {{data_get($data,'Pekerjaan')}}
         </td>
         <td style="text-align: center;" width="30%">
          {{data_get($data,'Bantuan')}}
         </td>
         <td style="text-align: center;" width="30%">
          {{number_format(data_get($data,'Pendapatan'),2)}}
         </td>
          @endif
        
        
          
     </tr>

     <?php $i++;?>
    @empty
         <tr><td colspan='18' style="text-align: center;">Tiada Data</td></tr>
    @endforelse
</table>

</body>