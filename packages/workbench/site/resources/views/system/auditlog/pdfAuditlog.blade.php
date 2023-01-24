
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{config('app.name')}}</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td th{
        font-weight: bold;
        font-size: 8px;
    }

    .gray {
        background-color: lightgray
    }
    .tabledata, .tabledata th, .tabledata td
    {
        border: 1px solid black; border-collapse: collapse;
        
    }

.cell-breakWord {
   word-wrap: break-word;  
    max-width: 1px;
}
    
</style>

</head>
<body>


  <table width="100%" border="0">
    <tr>
        <td valign="top"><img src="{{asset('logo.png')}}"alt="" width="150"/></td>
        <td align="right">
            <h3>{{config('app.name')}}</h3>
            <pre>
    
                <b>{{$title}}
                 

                </b>
              
               
                {{$date}}
                
            </pre>
        </td>
    </tr>
  </table>
   <table width="100%" border="0">
    
<tr>
     <td><b>Kategori Pengguna</b></td><td width="2%">:</td><td  colspan="4">{{$jenis_kat}}</td>
     <td><b>Nama</b></td><td width="2%">:</td><td    colspan="4">{{$user_p}}</td>
</tr>

<tr>
     <td><b>Tarikh Mula</b></td><td width="2%">:</td><td  colspan="4">{{$datefrom_p}}</td>
     <td><b>Tarikh Akhir</b></td><td width="2%">:</td><td colspan="4">{{$dateto_p}}</td>
</tr>



  </table>
  <br>


<table width="100%" class="tabledata"  cellpadding="2" cellspacing="0">
    <thead style="background-color: lightgray;" style="page-break-inside: avoid;">
      <tr>
      <th width="5%" align="center"><b>Bil</b></th>
                  <th width="20%" align="center"><b>Nama</b></th>
                  <th width="20%" align="center"><b>Aktiviti</b></th>
                  <th width="50%" align="center"><b>Nilai Lama</b></th>
                  <th  width="50%" align="center"><b>Nilai Baru</b></th>
                  <th width="20%" align="center"><b>Tarikh</b></th>
     
      </tr>
    </thead>
        <tbody>
            <?php $i=1;?>
                @forelse($data as $key =>$value)
                  <tr style="vertical-align:top;">
                    <td  align="center">{{$i}}</td>
                    <td class="cell-breakWord" style="font-size: 10px !important;">{{data_get($value,'users.name')}}</td>
                    <td class="cell-breakWord" style="font-size: 10px !important;">{{data_get($value,'Activities')}}</td>
                    <td  class="cell-breakWord" style="font-size: 10px !important;">{{data_get($value,'Old_Value')}}</td>
                    <td  class="cell-breakWord" style="font-size: 10px !important;" >{{data_get($value,'New_Value')}}</td>
                    <td  class="cell-breakWord" style="font-size: 10px !important;">{{date('d-m-Y H:i:s',strtotime(data_get($value,'created_at')))}}</td>
            
                   
                                      
                  </tr>
                        <?php $i++;?>     
                  @empty
                     <tr><td align="center" colspan="3">No Data</td></tr>
                   @endforelse
        
          
        </tbody>
  </table>

</body>
</html>