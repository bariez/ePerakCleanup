
 <h4 class="ui top attached header">
Senarai Galeri {{data_get($data_galeri,'Tajuk')}}
</h4>
<div class="ui attached segment">
              <div align="right">
                    <a  href='#' data-idgalerimast='{{data_get($data_galeri,'id')}}' 
                    data-idkampung='{{data_get($data_galeri,'fk_kampung')}}' 
                    class='ui green button btnadd' id="addbutton"><i class="icon plus" ></i>Tambah</a>
                     <a class="ui button" href="#" onclick="gettab({{$id}},8,1,0)" id="buttonbackdown">Kembali</a>
                </div>
                <br>
              <table id="listpencapaian" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Bil</th>
                                <th>Kategori</th>
                                <th>Gambar</th>
                                <th>Url</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                                
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($galeri_detail as $key =>$data)
                             <tr  style="text-align: center;">
                                 <td>{{$i}}</td>
                                 <td>{{data_get($data,'type.description')}}</td>
                                    <td>
                                    @if(data_get($data,'gambar_path')=='')
                                     <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
                                    </a>
                                    @elseif(file_exists(public_path (data_get($data,'gambar_path'))))
                                     <a target="_blank" href="{!! URL::to(data_get($data,'gambar_path')) !!}"><img src="{!! URL::to(data_get($data,'gambar_path')) !!}" alt="ePerak" style="width:100px">
                                    </a>
                                    @else
                                    <a target="_blank" href="{{ URL::asset('logo.png') }}"><img src="{{ URL::asset('logo.png') }}" alt="ePerak" style="width:100px">
                                    </a>
                                    
                                    @endif
                                   
                                 </td>
                                 <td style="width: 100px"><a href="{{data_get($data,'url')}}" target="_blank" >{{data_get($data,'url')}}</a></td>
                                 <td>@if(data_get($data,'status')==1)
                                    Aktif
                                    @else
                                    Tidak Aktif
                                    @endif</td>
                   
                                  <td>
                                     
                                       <a  href='#' data-idgalerimastedit='{{data_get($data_galeri,'id')}}' 
                                        data-idkampungedit='{{data_get($data_galeri,'fk_kampung')}}' 
                                        data-idgaleridetailedit='{{data_get($data,'id')}}'
                                        data-typeedit='{{data_get($data,'kategori')}}'
                                        data-status='{{data_get($data,'status')}}'
                                        data-filename='{{data_get($data,'filename')}}'
                                        data-url='{{data_get($data,'url')}}'
                                        data-action='edit'
                                       class='ui icon button btnedit' data-tooltip="Kemaskini" data-position="bottom center"><i class="edit icon"></i></a>
                                      <a onclick="return confirm('Adakah anda pasti untuk hapus?');" href="{!! URL::to('dataentry/searchkampung/deletegaleridetail/'.data_get($data,'id').'/'.$id.'/'.data_get($data_galeri,'id')) !!}"  class='ui icon button' data-tooltip="Padam" data-position="bottom center"><i class="trash alternate icon"></i></a>

                                  </td>
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='8' class="center aligned">Tiada Data</td></tr>
                            @endforelse

                 
                    </table>
                
                </div>
<!-- start modal view-->
      <div class="ui modal" id="view">
         <i class="close icon"></i>
        <div class="header" id="headers">
          Tambah Gambar
        </div>
           <div class="content">
           {!! form()->open()->post()->action(route('dataentry::searchkampung.addgaleridetail'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}
           <input type="hidden" id="idgalerimast" name="idgalerimast">
            <input type="hidden" id="idkampung" name="idkampung">

             <div class="field">
              <label>Jenis<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="type" id="type">
                    <i class="dropdown icon"></i>
                    <div class="default text" >Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($typefile as $key => $value)
                       <div class="item" data-value="{{$value->id}}" onclick="typefile({{$value->id}},'add')">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
               <div class="field" id="typefile">

              </div>
              <div class="field" id="notesgambar">
                <label>&nbsp;</label>
                 <b><font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan</b>
              </div>
               <div class="field" id="notesdiv">
                <label>&nbsp;</label>
                *Hanya link embed sahaja dibenarkan.Contoh: https://www.youtube.com/embed/pwkVjKQbkrA

              </div>
                 <div class="field" id="divpreview">
                <label>Preview</label>
                 <a target="_blank"><img style="width:200px" id="blah">
              </a>
                 
              </div>
            <div class="field">
              <label>Status<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="status"  id="status" required="required" value="{{ old('status') }}">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      <div class="item" data-value="1">Aktif</div>
                      <div class="item" data-value="0">Tidak Aktif</div>
                    </div>
                  </div>
              </div>   


                 <div class="ui divider section"></div>
                <div align="right">
                <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validategaleri();">
                    Simpan
                </button>
                <button class="ui button btnclose"><a href="#" style="color: #4e2e13">Kembali</a></button>
                </div>    
                              
            </div>

         

               

         {!! Form::close() !!}

</div>

         <!-- start modal edit-->
      <div class="ui modal" id="edit">
         <i class="close icon"></i>
        <div class="header" id="headers">
          Kemaskini Gambar
        </div>
           <div class="content">
           {!! form()->open()->post()->action(route('dataentry::searchkampung.editgaleridetail'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}
           <input type="hidden" id="idgalerimastedit" name="idgalerimastedit">
           <input type="hidden" id="idkampungedit" name="idkampungedit">
           <input type="hidden" id="idgaleridetailedit" name="idgaleridetailedit">
        

             <div class="field">
              <label>Jenis<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown typeedit2">
                    <input type="hidden" name="typeedit" id="typeedit">
                    <i class="dropdown icon"></i>
                    <div class="default text" >Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($typefile as $key => $value)
                       <div class="item" data-value="{{$value->id}}" onclick="typefile({{$value->id}},'edit')">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
               <div class="field" id="typefileedit">
             
                </div>
                 <div class="field" id="notesgambaredit">
                <label>&nbsp;</label>
                 <b><font color="red">*</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan</b>
              </div>
               <div class="field" id="notesdivedit">
                <label>&nbsp;</label>
                *Hanya link embed sahaja dibenarkan.Contoh: https://www.youtube.com/embed/pwkVjKQbkrA

              </div>
                <div class="field" id="divpreviewedit">
                <label>Preview</label>
                 <a target="_blank"><img style="width:200px" id="blahedit">
              </a>
                 
              </div>
               <div class="field" id="gambaredit">
               </div>
                  <div class="field">
              <label>Status<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown statusedit2">
                    <input type="hidden" name="statusedit"  id="statusedit" required="required" value="">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      <div class="item" data-value="1">Aktif</div>
                      <div class="item" data-value="0">Tidak Aktif</div>
                    </div>
                  </div>
              </div>   


              <div class="ui divider section"></div>
                <div align="right">
                            <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validateeditgaleri();">
                                Simpan
                            </button>
                            <button class="ui button btncloseedit"><a href="#" style="color: #4e2e13">Kembali</a></button>
                                
                        </div>    
                              
            </div>


               

         {!! Form::close() !!}



    </div>