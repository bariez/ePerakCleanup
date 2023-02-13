@extends('laravolt::layout.app2')

@section('content')



<div id="actionbar" class="ui two column grid  p-x-3 p-y-1 m-b-0" >
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs">
          Maklumat Akses Pengguna
        </h3>
    </div> 
    <div class="column right aligned middle aligned">

           <a class="ui button" href="{!! URL::to('/site/users/index') !!}" id="backbutton"><i class="material-icons left"></i><span>Kembali</span></a>
    </div>
</div>
<br>
<div class="ui segment">
<div class="ui form">  
    <div class="two fields">
              <div class="inline field">
                <label style="width:20%;">Nama</label>
                <input class="twelve wide field" type="text" readonly name="id_tuntutan" id="id_tuntutan"  value="{{data_get($user,'name')}}">
              </div>
              <div class="inline field">
                <label style="width:20%;">Jawatan</label>
                <input class="twelve wide field" type="text" readonly name="jenis" id="jenis" value="{{data_get($user,'jawatan')}}">
              </div>
          </div>
            <div class="two fields">
               <div class="inline field">
                <label style="width:20%;">Emel</label>
                <input class="twelve wide field" type="text" readonly name="claim_month" id="claim_month"  value="{{data_get($user,'email')}}">
              </div>
               <div class="inline field">
                <label style="width:20%;">Jabatan/Agensi</label>
                <input class="twelve wide field" type="text" readonly name="status" id="status"  value="{{data_get($user,'jabatan')}}">
              </div>
            </div>
             <div class="two fields">
               <div class="inline field">
                <label style="width:20%;">Kategori Pengguna</label>
                <input class="twelve wide field" type="text" readonly name="claim_month" id="claim_month"  value="{{data_get($role,'role')}}">
              </div>
               <div class="inline field">
                <label style="width:20%;">Status</label>
                <input class="twelve wide field" type="text" readonly name="status" id="status"  value="{{$status}}">
              </div>
            </div>
        </div>
</div>
<h4 class="ui top attached header">
Senarai Akses Pengguna
</h4>
<div class="ui attached segment">
            
            	<table id="listaccesslog" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Bil</th>
                                <th style="text-align: center;">Nama</th>
                                <th style="text-align: center;">Time Log In</th>
                                <th style="text-align: center;">Time Log Out</th>
                                <th style="text-align: center;">Lokasi</th>
                                
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($data as $key =>$data)
                             <tr  style="text-align: center;">
                                 <td>{{$i}}</td>
                                 <td>{{data_get($data,'users.name')}}</td>
                                 <td>{{data_get($data,'login_at')}}</td>
                                 <td>{{data_get($data,'login_out')}}</td>
                                  <td>{{data_get($data,'IP_Address')}}</td>
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='8' class="center aligned">Tiada Data</td></tr>
                            @endforelse

                 
                    </table>
                
                </div>
@endsection
@push('script')

<script type="text/javascript">

  $(document).ready(function() 
  {

                $('#listaccesslog').DataTable( {
                   "lengthChange": false,
                    "language": {
                   "search":  "Carian:",
                    "info":     "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                    "infoEmpty": "Paparan 0 hingga 0 daripada 0 jumlah data",
                     "paginate": {
                        "first":      "Pertama",
                        "last":       "Terakhir",
                        "next":       "Seterusnya",
                        "previous":   "Sebelumnya"
                    },
                 }
             });
                

  });
</script>
@endpush