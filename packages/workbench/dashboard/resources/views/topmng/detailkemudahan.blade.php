<div class="ui buttons right floated">
 <a href="{!! URL::to('dashboard/exportdetailkemudahan/1/'.data_get($daerah,'id').'/'.$type) !!}" class="ui red button" >Muat Turun</a>
</div>
   <h4>DAERAH: {{data_get($daerah,'NamaDaerah')}}</h4>
   @if($type!=0)
   <h4>KATEGORI KEMUDAHAN: {{data_get($status,'description')}}</h4>
   @endif
          <table class="ui unstackable celled striped table" style="width:100%; font-size: 12px; padding-top: 10px" id="listkemudahan">
                        <thead>
                            <tr>
                                <th style="text-align: center;">BIL</th>
                                <th style="text-align: center;">NAMA KEMUDAHAN</th>
                                @if($type==0)
                                <th style="text-align: center;">KATEGORI KEMUDAHAN</th>
                                @endif
                                <th style="text-align: center;">JENIS KEMUDAHAN</th>
                                <th style="text-align: center;">BILANGAN</th>
                                <th style="text-align: center;">UNIT</th>
                                <th style="text-align: center;">PARLIMEN</th>
                                <th style="text-align: center;">DUN</th>
                                <th style="text-align: center;">DAERAH</th>
                                <th style="text-align: center;">MUKIM</th>
                                <th style="text-align: center;">KAMPUNG</th>
                          
                            </tr>
                        </thead>
                        <tbody >

                      <?php $i=1; ?>
                     @forelse($detailkemudahan as $key =>$data)
                     <tr  style="text-align: center;">
                         <td>{{$i}}</a></td>
                         <td>{{data_get($data,'NamaKemudahan')}}</a></td>
                          @if($type==0)
                         <td>{{data_get($data,'kat_kemudahan')}}</a></td>
                          @endif
                         <td>{{data_get($data,'jenis_kemudahan')}}</a></td>
                         <td>{{data_get($data,'Bilangan')}}</a></td>
                         <td>{{data_get($data,'unit')}}</a></td>
                         <td>{{data_get($data,'NamaParlimen')}}</a></td>
                         <td>{{data_get($data,'NamaDun')}}</a></td>
                         <td>{{data_get($data,'NamaDaerah')}}</a></td>
                         <td>{{data_get($data,'NamaMukim')}}</a></td>
                         <td>{{data_get($data,'NamaKampung')}}</a></td>


                     </tr>

                     <?php $i++;?>
                    @empty
                         <tr><td colspan='6' class="center aligned">Tiada Data</td></tr>
                    @endforelse
                

                        </tbody>
                    </table>




<script type="text/javascript">
  $(document).ready(function() {


  });

</script>