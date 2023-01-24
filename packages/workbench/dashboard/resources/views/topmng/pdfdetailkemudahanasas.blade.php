
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
        <td valign="top"><img src="{{ public_path('logo3.jpg') }}"alt="" width="150"/></td>
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
     <td width="10%"><b>DAERAH</b></td><td width="2%">:</td><td  colspan="2"  width="10%">{{$daerah}}</td>

       @if($type!=0)
       @if($type=='a1')
       <h4>KEMUDAHAN ASAS RUMAH - AIR : YA</h4>
       @endif
       @if($type=='a0')
       <h4>KEMUDAHAN ASAS RUMAH - AIR : TIDAK</h4>
       @endif
        @if($type=='e1')
       <h4>KEMUDAHAN ASAS RUMAH - ELEKTRIK : YA</h4>
       @endif
       @if($type=='e0')
       <h4>KEMUDAHAN ASAS RUMAH - ELEKTRIK : TIDAK</h4>
       @endif
        @if($type=='s1')
       <h4>KEMUDAHAN ASAS RUMAH - ASTRO : YA</h4>
       @endif
       @if($type=='s0')
       <h4>KEMUDAHAN ASAS RUMAH - ASTRO : TIDAK</h4>
       @endif
        @if($type=='y1')
       <h4>KEMUDAHAN ASAS RUMAH - INTERNET : YA</h4>
       @endif
       @if($type=='y0')
       <h4>KEMUDAHAN ASAS RUMAH - INTERNET : TIDAK</h4>
       @endif
        @if($type=='t1')
       <h4>KEMUDAHAN ASAS RUMAH - TELEFON : YA</h4>
       @endif
       @if($type=='t0')
       <h4>KEMUDAHAN ASAS RUMAH - TELEFON : TIDAK</h4>
       @endif
       
       @endif
</tr>
  </table>
  <br>


<table width="100%" class="tabledata"  cellpadding="2" cellspacing="0">
    <thead style="background-color: lightgray;" style="page-break-inside: avoid;">

       <tr>
              <th width="5%" align="center">BIL</th>
              <th align="center" width="20%">NAMA</th>
              <th align="center" width="20%">NO PENGENALAN</th>
              <th align="center" width="20%">NO TEL</th>
              <th align="center" width="20%">PARLIMEN</th>
              <th align="center" width="20%">DUN</th>
              <th align="center" width="20%">DAERAH</th>
              <th align="center" width="20%">MUKIM</th>
              <th align="center" width="20%">KAMPUNG</th>
              @if($kemudahan==0)
              <th align="center" width="20%">AIR</th>
              <th align="center" width="20%">ELEKTRIK</th>
              <th align="center" width="20%">ASTRO</th>
              <th align="center" width="20%">INTERNET</th>
              <th align="center" width="20%">TELEFON</th>
              @endif
          </tr>
    </thead>
        <tbody>
            <?php $i=1;?>
                @forelse($result as $key =>$data)
                     <tr  style="text-align: center;">
                         <td>{{$i}}</a></td>
                         <td>{{data_get($data,'Nama')}}</a></td>
                         <td>{{data_get($data,'NoKP')}}</a></td>
                         <td>{{data_get($data,'TelNo')}}</a></td>
                         <td>{{data_get($data,'NamaParlimen')}}</a></td>
                         <td>{{data_get($data,'NamaDun')}}</a></td>
                         <td>{{data_get($data,'NamaDaerah')}}</a></td>
                         <td>{{data_get($data,'NamaMukim')}}</a></td>
                         <td>{{data_get($data,'NamaKampung')}}</a></td>
                         @if($kemudahan==0)
                         @if(data_get($data,'KAir')==0)
                         <td>TIDAK</td>
                         @else
                         <td>YA</td>
                         @endif
                         @if(data_get($data,'KElektrik')==0)
                         <td>TIDAK</td>
                         @else
                         <td>TIDAK</td>
                         @endif
                         @if(data_get($data,'KAstro')==0)
                         <td>YA</td>
                         @else
                         <td>TIDAK</td>
                         @endif
                         @if(data_get($data,'KInternet')==0)
                         <td>YA</td>
                         @else
                         <td>TIDAK</td>
                         @endif
                         @if(data_get($data,'KTelefon')==0)
                         <td>YA</td>
                         @else
                         <td>TIDAK</td>
                         @endif
                         @endif

                     </tr>

                     <?php $i++;?>
                    @empty
                         <tr><td colspan='9' class="center aligned">Tiada Data</td></tr>
                    @endforelse
        
          
        </tbody>
  </table>

</body>
</html>