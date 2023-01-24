<table id="searchkampung" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Bil</th>
                                <th>Daerah</th>
                                <th>Mukim</th>
                                <th>Parlimen</th>
                                <th>DUN</th>
                                <th>Kategori Petempatan</th>
                                <th>Nama Kampung</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($result as $key =>$data)
                             <tr>
                                 <td style="text-align: center; vertical-align: top;">{{$i}}</td>
                                  <td style="text-align: center; vertical-align: top;">{{data_get($data,'daerah.NamaDaerah')}}</td>
                                 <td style="text-align: center; vertical-align: top;">{{data_get($data,'mukim.NamaMukim')}}</td>
                                 <td style="text-align: center; vertical-align: top;">{{data_get($data,'parlimen.NamaParlimen')}}</td>
                                 <td style="text-align: center; vertical-align: top;">{{data_get($data,'dun.NamaDun')}}</td>
                                 <td style="text-align: center; vertical-align: top;">{{data_get($data,'catpetempatan.description')}}</td>
                                 <td style="text-align: left; vertical-align: top;"><b>{{data_get($data,'NamaKampung')}}</b>

                                    @forelse($data->kampung_rangkaian as $key2 => $resultrangkai)
                                     <ul>
                                      <li>{{ $resultrangkai->NamaKampung }}</li>
                                     </ul>
                                     @empty
                                     @endforelse
                                     
                                 </td>
                                 @if(data_get($roleuser,'role_id')==2 || data_get($roleuser,'role_id')==4)
                                 <td style="text-align: left; vertical-align: top;">
                                    <a target="_blank" href="{!! URL::to('dataentry/searchkampung/cetakprofil/1/'.data_get($data,'id')) !!}"data-tooltip="Cetakan" data-position="bottom center"><i class="print icon"></i>
                                    </a>
                                    <!--  <a href="{!! URL::to('/dataentry/searchkampung/isirumah/ketuaisirumah/'.data_get($data,'id')) !!}"data-tooltip="Maklumat KIR" data-position="bottom center"><i class="user icon"></i></a>
                                     <a target="_blank" href="{!! URL::to('/info/'.data_get($data,'id')) !!}"data-tooltip="Info Petempatan" data-position="bottom center"><i class="file alternate outline icon"></i>
                                    </a> -->
                                     <a target="_blank" href="{!! URL::to('/dashboard/searchkampung/isirumah/ketuaisirumah/'.data_get($data,'id')) !!}"data-tooltip="Maklumat KIR" data-position="bottom center"><i class="user icon"></i></a>
                                     <a target="_blank" href="{!! URL::to('/info/'.data_get($data,'id')) !!}"data-tooltip="Info Petempatan" data-position="bottom center"><i class="file alternate outline icon"></i>
                                    </a>
                                   
                                   </td>
                                   @else
                                    <td style="text-align: left; vertical-align: top;">
                                    <a target="_blank" href="{!! URL::to('dataentry/searchkampung/cetakprofil/1/'.data_get($data,'id')) !!}"data-tooltip="Cetakan" data-position="bottom center"><i class="print icon"></i>
                                    </a>
                                    <a target="_blank" href="{!! URL::to('dataentry/searchkampung/mainmenu/ '.data_get($data,'id').'/1/1/0') !!}" data-tooltip="Kemaskini" data-position="bottom center"><i class="edit icon"></i></a>
                                    <a onclick="return confirm('Adakah anda pasti untuk hapus?');" href="{!! URL::to('dataentry/searchkampung/deletekampung/'.data_get($data,'id')) !!}" data-tooltip="Padam" data-position="bottom center"><i class="trash alternate icon" style="color:red"></i>
                                    </a>
                                     <a target="_blank" href="{!! URL::to('/info/'.data_get($data,'id')) !!}"data-tooltip="Info Petempatan" data-position="bottom center"><i class="file alternate outline icon"></i>
                                    </a>
                                   </td>

                                   @endif
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='8' class="center aligned">Tiada Data</td></tr>
                            @endforelse

                 
                    </table>