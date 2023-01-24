<div class="ui buttons right floated">
 <a href="{!! URL::to('dashboard/exportdetailkemudahanasas/1/'.data_get($daerah,'id').'/'.$type.'/'.$kemudahan) !!}" class="ui red button" >Muat Turun</a>
</div>
   <h4>DAERAH: {{data_get($daerah,'NamaDaerah')}}</h4>
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
           <table class="ui unstackable celled striped table" style="width:100%; font-size: 12px; padding-top: 10px" id="listdetailkemudahanasas">
                        <thead>
                              <tr>
                              <th style="text-align: center;">BIL</th>
                              <th style="text-align: center;">NAMA</th>
                              <th style="text-align: center;">NO PENGENALAN</th>
                              <th style="text-align: center;">NO TEL</th>
                              <th style="text-align: center;">PARLIMEN</th>
                              <th style="text-align: center;">DUN</th>
                              <th style="text-align: center;">DAERAH</th>
                              <th style="text-align: center;">MUKIM</th>
                              <th style="text-align: center;">KAMPUNG</th>
                              @if($kemudahan==0)
                              <th style="text-align: center;">AIR</th>
                              <th style="text-align: center;">ELEKTRIK</th>
                              <th style="text-align: center;">ASTRO</th>
                              <th style="text-align: center;">INTERNET</th>
                              <th style="text-align: center;">TELEFON</th>
                              @endif
                            </tr>
                        
                        </thead>
                        <tbody >

                      <?php $i=1; ?>
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
                         <td>YA</td>
                         @endif
                         @if(data_get($data,'KAstro')==0)
                         <td>TIDAK</td>
                         @else
                         <td>YA</td>
                         @endif
                         @if(data_get($data,'KInternet')==0)
                         <td>TIDAK</td>
                         @else
                         <td>YA</td>
                         @endif
                         @if(data_get($data,'KTelefon')==0)
                         <td>TIDAK</td>
                         @else
                         <td>YA</td>
                         @endif
                         @endif

                     </tr>

                     <?php $i++;?>
                    @empty
                         <tr><td colspan='9' class="center aligned">Tiada Data</td></tr>
                    @endforelse
                

                        </tbody>
                    </table>




<script type="text/javascript">
  $(document).ready(function() {


  });

</script>