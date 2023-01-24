
 <h4 class="ui top attached header">
Senarai Produk yang dikeluarkan oleh {{data_get($data_pengeluar,'NamaSyarikat')}}
</h4>
<div class="ui attached segment">
              <div align="right">
                    <button class="ui green button" onclick="gettab({{$id}},6,6,{{data_get($data_pengeluar,'id')}})" id="addbutton"><i class="icon plus"></i>Tambah</button> 
                     <a class="ui button" id="backbuttondown" href="#" onclick="gettab({{$id}},6,1,0)">Kembali</a>    
                </div>
                <br>
              <table id="listpencapaian" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th align="center">Bil</th>
                                <th align="center">Kategori Produk</th>
                                <th align="center">Jenis Produk</th>
                                <th align="center">Nama Produk</th>
                                <th align="center">Tindakan</th>
                                
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($produk as $key =>$data)
                             <tr  style="text-align: center;">
                                 <td>{{$i}}</td>
                                 <td>{{data_get($data,'kategori.description')}}</td>
                                  <td>{{data_get($data,'jenisproduk.description')}}</td>
                                   <td>{{data_get($data,'NamaProduk')}}</td>
                                  <td><a href="#" onclick="gettab({{$id}},6,7,{{data_get($data,'id')}})" data-tooltip="Paparan" data-position="bottom center"><i class="eye icon"></i></a>
                                      <a href="#" onclick="gettab({{$id}},6,8,{{data_get($data,'id')}})" data-tooltip="Kemaskini" data-position="bottom center"><i class="edit icon" ></i></a>
                                      <a onclick="return confirm('Adakah anda pasti untuk hapus?');" href="{!! URL::to('dataentry/searchkampung/deleteproduk/'.data_get($data,'id').'/'.$id.'/'.data_get($data_pengeluar,'id')) !!}" data-tooltip="Padam" data-position="bottom center"><i class="trash alternate icon" style="color:red"></i></a>
                                      

                                  </td>
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='8' class="center aligned">Tiada Data</td></tr>
                            @endforelse

                 
                    </table>
                
                </div>
