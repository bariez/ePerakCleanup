
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">


<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: lightgray
    }
    .tabledata, .tabledata th, .tabledata td
    {
        border: 1px solid black; border-collapse: collapse;
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>

        <td valign="top"></td>
        <td colspan="5" align="left">
            <b>&nbsp;</b>   
        </td>
    </tr>
     <tr>
        <td valign="top"></td>
        <td colspan="5" align="left">
               <b>{{$title}}</b>
        </td>
    </tr>
      <tr>
        <td valign="top"></td>
        <td colspan="5" align="left">  
                {{$date}}
        </td>
    </tr>
  </table>

<br>
<table width="100%">
            <tr>
              <td><b>Kategori Pengguna</b></td>
              <td>: {{$filter["jenis_kat"]}}</td>
              <td><b>Nama</b></td>
              <td>: {{$filter["user_p"]}}</td>
            </tr>
            <tr>
              <td><b>Tarikh Mula</b></td>
              <td>: {{$filter["datefrom_p"]}}</td>
              <td><b>Tarikh Akhir</b></td>
              <td>: {{$filter["dateto_p"]}}</td>
            </tr>
           
          </table>
          <br>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
          <th style="background-color:#E1DFDE" align="center"><b>Bil</b></th>
          <th style="background-color:#E1DFDE"align="center"><b>Nama</b></th>
          <th style="background-color:#E1DFDE"align="center"><b>Aktiviti</b></th>
          <th style="background-color:#E1DFDE"align="center"><b>Nilai Lama</b></th>
          <th style="background-color:#E1DFDE"align="center"><b>Nilai Baru</b></th>
          <th style="background-color:#E1DFDE"align="center"><b>Tarikh</b></th>
      </tr>
    </thead>
    <tbody>
               <?php $i=1; ?>
                @foreach($data as $key =>$data)
               
                  <tr>
                   <td  align="center">{{$i}}</td>
                    <td align="center">{{data_get($data,'users.name')}}</td>
                    <td >{{data_get($data,'Activities')}}</td>
                    <td width="550px">{{data_get($data,'Old_Value')}}</td>
                    <td width="550px">{{data_get($data,'New_Value')}}</td>
                    <td>{{date('d-m-Y H:i:s',strtotime(data_get($data,'created_at')))}}</td>
      
                  </tr>
                  <?php $i++;?>
                @endforeach
                 
              </tbody>
  </table>
</body>