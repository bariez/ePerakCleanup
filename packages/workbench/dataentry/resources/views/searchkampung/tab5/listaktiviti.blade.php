
 <h4 class="ui top attached header">
Senarai Aktiviti
</h4>
<div class="ui attached segment">
                <div align="right">
                    <button class="ui green button" onclick="gettab({{$id}},5,2,0)" id="addbutton"><i class="icon plus"></i>Tambah</button> 
                </div>
                <br>
                <table id="listpencapaian" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Bil</th>
                                <th>Tahun</th>
                                <th>Jenis Aktviti</th>
                                <th>Aktiviti</th>
                                <th>Penganjur</th>
                                <th>Gambar</th>
                                <th>Tindakan</th>
                                
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($aktiviti as $key =>$data)
                             <tr  style="text-align: center;">
                                 <td>{{$i}}</td>
                                 <td>{{data_get($data,'Tahun')}}</td>
                                 <td>{{data_get($data,'kategori.description')}}</td>
                                 <td style="width: 300px">{{data_get($data,'NamaAktiviti')}}</td>
                                  <td>{{data_get($data,'Penganjur')}}</td>
                                  <td>
                                    @if(data_get($data,'Gambar_path')=='')
                                     <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
                                    </a>
                                    @elseif(file_exists(public_path (data_get($data,'Gambar_path'))))
                                     <a target="_blank" href="{!! URL::to(data_get($data,'Gambar_path')) !!}"><img src="{!! URL::to(data_get($data,'Gambar_path')) !!}" alt="ePerak" style="width:100px">
                                    </a>
                                    @else
                                       <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
                                    </a>
                                    
                                    @endif
                                   
                                 </td>
                                  <td><a href="#" onclick="gettab({{$id}},5,4,{{data_get($data,'id')}})" data-tooltip="Paparan" data-position="bottom center"><i class="eye icon"></i></a>
                                      <a href="#" onclick="gettab({{$id}},5,3,{{data_get($data,'id')}})" data-tooltip="Kemaskini" data-position="bottom center"><i class="edit icon"  ></i></a>
                                      <a onclick="return confirm('Adakah anda pasti untuk hapus?');" href="{!! URL::to('dataentry/searchkampung/deleteaktiviti/'.data_get($data,'id').'/'.$id) !!}" data-tooltip="Padam" data-position="bottom center"><i class="trash alternate icon" style="color:red"></i></a>

                                  </td>
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='8' class="center aligned">Tiada Data</td></tr>
                            @endforelse

                 
                    </table>
                
                </div>
