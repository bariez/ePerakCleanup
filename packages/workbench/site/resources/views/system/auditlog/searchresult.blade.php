 <div class="ui buttons right floated">
 <a href="{!! URL::to('site/exportauditlog/1/'.$user.'/'.$datefrom.'/'.$dateto.'/'.$kat) !!}" class="ui red button" >PDF</a>
 <div class="or" data-text="@"></div>
 <a href="{!! URL::to('site/exportauditlog/2/'.$user.'/'.$datefrom.'/'.$dateto.'/'.$kat) !!}" class="ui green button">Excel</a>
</div><br></br>

<div>&nbsp;&nbsp;</div>
<table id="searchlogdata" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Bil</th>
                                <th style="text-align: center;">Nama</th>
                                <th style="text-align: center;">Kategori Pengguna</th>
                                <th style="text-align: center;">Aktiviti</th>
                                <th style="text-align: center;">Nilai Lama</th>
                                <th style="text-align: center;">Nilai Baru</th>
                                <th style="text-align: center;">Tarikh</th>
                                
                               
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($result as $key =>$data)
                             <tr  style="text-align: center;">
                                 <td style="vertical-align: top;">{{$i}}</td>
                                 <td style="vertical-align: top;">{{data_get($data,'users.name')}}</td>
                                 <td style="vertical-align: top;">{{data_get($data,'users.user_role.acl_roles.name')}}</td>
                                 <td style="vertical-align: top;">{{data_get($data,'Activities')}}</td>
                                 <td style="vertical-align: top;text-align: left;word-break:break-all" width="200px">{{data_get($data,'Old_Value')}}</td>
                                 <td style="vertical-align: top;text-align: left;word-break:break-all" width="200px">{{data_get($data,'New_Value')}}</td>
                                 <td style="vertical-align: top;">{{date('d-m-Y H:i:s',strtotime(data_get($data,'created_at')))}}</td>
                                
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='8' class="center aligned">Tiada Data</td></tr>
                            @endforelse


                 
                    </table>