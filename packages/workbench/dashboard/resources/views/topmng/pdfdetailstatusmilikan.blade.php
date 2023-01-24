
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
     <td><b>DAERAH</b></td><td width="2%">:</td><td  colspan="4">{{$daerah}}</td>
      @if($type!=0)
     <td><b>STATUS PEMILIKAN RUMAH</b></td><td width="2%">:</td><td    colspan="4">{{$status}}</td>
     @endif
</tr>
  </table>
  <br>


<table width="100%" class="tabledata"  cellpadding="2" cellspacing="0">
    <thead style="background-color: lightgray;" style="page-break-inside: avoid;">
      <tr>
      <th width="5%" align="center"><b>BIL</b></th>
                  <th width="20%" align="center"><b>NAMA</b></th>
                  <th width="20%" align="center"><b>NO PENGENALAN</b></th>
                  <th width="20%" align="center"><b>NO TEL</b></th>
                  @if($type==0)
                  <th width="20%" style="text-align: center;">STATUS MILIKAN</th>
                  @endif
                  <th width="20%" align="center"><b>PARLIMEN</b></th>
                  <th width="20%" align="center"><b>DUN</b></th>
                  <th width="20%" align="center"><b>DAERAH</b></th>
                  <th width="20%" align="center"><b>MUKIM</b></th>
                  <th width="20%" align="center"><b>KAMPUNG</b></th>
     
      </tr>
    </thead>
        <tbody>
            <?php $i=1;?>
                @forelse($detailstatusmilikan as $key =>$value)
                  <tr style="vertical-align:top;">
                         <td>{{$i}}</a></td>
                         <td>{{data_get($value,'Nama')}}</a></td>
                         <td>{{data_get($value,'NoKP')}}</a></td>
                         <td>{{data_get($value,'TelNo')}}</a></td>
                         @if($type==0)
                         <td>{{data_get($value,'status_milikan')}}</a></td>
                         @endif
                         <td>{{data_get($value,'NamaParlimen')}}</a></td>
                         <td>{{data_get($value,'NamaDun')}}</a></td>
                         <td>{{data_get($value,'NamaDaerah')}}</a></td>
                         <td>{{data_get($value,'NamaMukim')}}</a></td>
                         <td>{{data_get($value,'NamaKampung')}}</a></td>

  
                                      
                  </tr>
                        <?php $i++;?>     
                  @empty
                     <tr><td align="center" colspan="3">No Data</td></tr>
                   @endforelse
        
          
        </tbody>
  </table>

</body>
</html>