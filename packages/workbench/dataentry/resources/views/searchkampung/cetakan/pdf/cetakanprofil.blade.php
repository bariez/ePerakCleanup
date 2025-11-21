
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
         font-size:12px;
    }
    div{
          font-size:12px;
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
<div align="center"><b>PROFIL PENTADBIRAN</b></div>
<div align="center"><b>{{data_get($data,'NamaKampung')}}</b></div>
<br>
<div align="center"><b>MAKLUMAT ASAS KAMPUNG</b></div>
<br>
<table width="100%" id="table2" cellpadding="1">
  <tbody>
 <tr><td align="left" width="30%"><b>NAMA KAMPUNG</b></td><td align="left">{{data_get($data,'NamaKampung')}}</td></tr>
 <tr><td align="left" width="30%"><b>NAMA MUKIM</b></td><td align="left">{{data_get($data,'mukim.NamaMukim')}}</td></tr>
 <tr><td align="left" width="30%"><b>NAMA DAERAH</b></td><td align="left">{{data_get($data,'daerah.NamaDaerah')}}</td></tr>
 <tr><td align="left" width="30%"><b>NAMA DUN</b></td><td align="left">{{data_get($data,'dun.NamaDun')}}</td></tr>
 <tr><td align="left" width="30%"><b>NAMA PARLIMEN</b></td><td align="left">{{data_get($data,'parlimen.NamaParlimen')}}</td></tr>
 <tr><td align="left" width="30%"><b>ALAMAT SURAT MENYURAT</b></td><td align="left">{{data_get($data,'AlamatJPKK')}}</td></tr>
 <tr><td align="left" width="30%"><b>SEJARAH KAMPUNG</b></td><td align="left">{{data_get($data,'Sejarah')}}</td></tr>
</tbody>
</table>
<br>
<div align="center"><b>POPULASI PENDUDUK KAMPUNG</b></div>
<br>
<table width="100%" id="table2" cellpadding="1">
<tbody>
@forelse($jantina as $key =>$datajantina)
<tr><td align="left" width="30%"><b>BILANGAN {{data_get($datajantina,'label')}}</b></td><td align="left">{{data_get($datajantina,'value')}}</td></tr>
@empty
 <tr><td colspan='2' class="center aligned">Tiada Data</td></tr>
@endforelse
</tbody>
</table>
<br>
<div align="center"><b>TABURAN MENGIKUT BANGSA</b></div>
<br>
<table width="100%" id="table2" cellpadding="1">
    <tbody>
@forelse($bangsa as $key =>$databangsa)
<tr><td align="left" width="30%"><b>{{data_get($databangsa,'rownum')}} ) {{data_get($databangsa,'description')}}</b></td><td align="left">{{data_get($databangsa,'bil')}}</td></tr>
@empty
 <tr><td colspan='2' class="center aligned">Tiada Data</td></tr>
@endforelse
</table>
<br>
<div align="center"><b>STRUKTUR PENTADBIRAN KAMPUNG</b></div>
<br>
<table width="100%" id="table2" cellpadding="1">
    <tbody>
 <tr>
  <td align="left" width="30%"><b>NAMA KETUA KAMPUNG</b></td><td align="left">{{ data_get($namapengerusi,'NamaAhli')}}</td>
 </tr>
 <tr>
  <td align="left" width="30%"><b>NAMA PENGHULU MUKIM</b></td><td align="left">{{data_get($penghulumukim,'NamaPenghuluMukim')}}</td>
 </tr>
 <tr>
  <td align="left" width="30%"><b>NAMA PEGAWAI DAERAH</b></td><td align="left">{{data_get($pegawaidaerah,'NamaPegawaiDaerah')}}</td>
 </tr>
 <tr>
  <td align="left" width="30%"><b>NAMA ADUN</b></td><td align="left">{{data_get($data,'dun.AhliDun')}}</td>
 </tr>
 <tr>
  <td align="left" width="30%"><b>NAMA AHLI PARLIMEN</b></td><td align="left">{{data_get($data,'parlimen.AhliParlimen')}}</td>
 </tr>
</table>
<br>
<div align="center"><b>KEMUDAHAN INFRASTRUKTUR KAMPUNG</b></div>
<br>
<table width="100%" id="table2" cellpadding="1">
    <thead style="text-align: center;">
    <tr>
        <th>BIL.</th>
        <th>KATEGORI KEMUDAHAN</th>
        <th>JENIS KEMUDAHAN</th>
        <th>BILANGAN</th>
        <th>UNIT</th>
    </tr>
</thead>
    <tbody>
     <?php $i=1; ?>
   @forelse($kemudahan as $key =>$data)
     <tr  style="text-align: center;">
         <td>{{$i}}</td>
         <td>{{data_get($data,'katkemudahan.description')}}</td>
         <td>{{data_get($data,'jeniskemudahan.description')}}</td>
         <td>{{data_get($data,'Bilangan')}}</td>
         <td>{{data_get($data,'unit.description')}}</td>
          
     </tr>

     <?php $i++;?>
    @empty
         <tr><td colspan='5' class="center aligned">Tiada Data</td></tr>
    @endforelse
</tbody>
</table>
<br>
<div align="center"><b>PENCAPAIAN KAMPUNG</b></div>
<br>
<table width="100%" id="table2" cellpadding="1">
    <thead style="text-align: center;">
    <tr>
        <th>BIL.</th>
        <th>TAHUN</th>
        <th>PERINGKAT</th>
        <th>AKTIVITI</th>
        <th>KETERANGAN</th>
        <th>PENCAPAIAN</th>
        <th>PENGANJUR</th>
        
    </tr>
</thead>
    <tbody>
     <?php $i=1; ?>
   @forelse($pencapaian as $key =>$data)
     <tr  style="text-align: center;">
         <td>{{$i}}</td>
         <td>{{data_get($data,'Tahun')}}</td>
         <td>{{data_get($data,'peringkat.description')}}</td>
         <td>{{data_get($data,'Aktiviti')}}</td>
         <td>{{data_get($data,'Keterangan')}}</td>
         <td>{{data_get($data,'Pencapaian')}}</td>
         <td>{{data_get($data,'Penganjur')}}</td>
          
     </tr>

     <?php $i++;?>
    @empty
         <tr><td colspan='7' class="center aligned">Tiada Data</td></tr>
    @endforelse
</tbody>
</table>
<br>
<div align="center"><b>AKTIVITI KAMPUNG</b></div>
<br>
<table width="100%" id="table2" cellpadding="1">
    <thead style="text-align: center;">
    <tr>
        <th>BIL.</th>
        <th>JENIS AKTIVITI</th>
        <th>AKTIVITI</th>
        <th>TAHUN</th>
        <th>KETERANGAN</th>
        <th>PENGANJUR</th>
        
    </tr>
</thead>
    <tbody>
     <?php $i=1; ?>
   @forelse($aktiviti as $key =>$data)
     <tr  style="text-align: center;">
         <td>{{$i}}</td>
         <td>{{data_get($data,'kategori.description')}}</td>
         <td>{{data_get($data,'NamaAktiviti')}}</td>
         <td>{{data_get($data,'Tahun')}}</td>
         <td>{{data_get($data,'Keterangan')}}</td>
         <td>{{data_get($data,'Penganjur')}}</td>
          
     </tr>

     <?php $i++;?>
    @empty
         <tr><td colspan='6' class="center aligned">Tiada Data</td></tr>
    @endforelse
</tbody>
</table>
<br>
<div align="center"><b>PROJEK KAMPUNG</b></div>
<br>
<table width="100%" id="table2" cellpadding="1">
    <thead style="text-align: center;">
    <tr>
        <th>BIL.</th>
        <th>NAMA PROJEK</th>
        <th>STATUS</th>
        <th>TAHUN</th>
        <th>LOKASI</th>
    </tr>
</thead>
    <tbody>
     <?php $i=1; ?>
   @forelse($projek as $key =>$data)
     <tr  style="text-align: center;">
         <td>{{$i}}</td>
         <td>{{data_get($data,'NamaProjek')}}</td>
         <td>{{data_get($data,'jenisprojek.description')}}</td>
         <td>{{data_get($data,'Tahun')}}</td>
         <td>{{data_get($data,'Lokasi')}}</td>
          
     </tr>

     <?php $i++;?>
    @empty
         <tr><td colspan='6' class="center aligned">Tiada Data</td></tr>
    @endforelse
</tbody>
</table>
</tbody>
</body>