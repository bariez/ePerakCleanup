
 <h4 class="ui top attached header">
Senarai Pencapaian
</h4>
<div class="ui attached segment">
                <div align="right">
                    <button class="ui green button" onclick="gettab({{$id}},4,2,0)" id="addbutton"><i class="icon plus"></i>Tambah</button> 
                </div>
                <br>
                <table id="listpencapaian" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Bil</th>
                                <th>Tahun</th>
                                <th>Peringkat</th>
                                <th>Aktiviti</th>
                                <th>Pencapaian</th>
                                <th>Penganjur</th>
                                <th>Tindakan</th>
                                
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
                                 <td>{{data_get($data,'Pencapaian')}}</td>
                                  <td>{{data_get($data,'Penganjur')}}</td>
                                  <td><a href="#" onclick="gettab({{$id}},4,4,{{data_get($data,'id')}})" data-tooltip="Paparan" data-position="bottom center"><i class="eye icon"></i></a>
                                      <a href="#" onclick="gettab({{$id}},4,3,{{data_get($data,'id')}})" data-tooltip="Kemaskini" data-position="bottom center"><i class="edit icon"></i></a>
                                      <a onclick="return confirm('Adakah anda pasti untuk hapus?');" href="{!! URL::to('dataentry/searchkampung/deletepencapaian/'.data_get($data,'id').'/'.$id) !!}" data-tooltip="Padam" data-position="bottom center"><i class="trash alternate icon" style="color:red"></i></a>

                                  </td>
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='8' class="center aligned">Tiada Data</td></tr>
                            @endforelse

                 
                    </table>
                
                </div>
