@extends('laravolt::layout.app2')

@section('content')



<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0" >
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs" style="color:black">
            Kelulusan Pengguna
        </h3>
    </div>
     <div class="column right aligned middle aligned">
        <!-- <button class="ui yellow button" id="reset" onclick="window.location.href='/site/approveindex'; return false;" type="button"><i class="icon redo"></i>Set Semula
        </button> -->


    </div>
 
</div>



<br>
 <h4 class="ui top attached header">
Senarai Kelulusan Pengguna
</h4>
    <div class="ui container-fluid content__body p-1">
<div class="ui attached segment raised">

                <table id="listuser" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Bil</th>
                                <th style="text-align: center;">Nama</th>
                                <th style="text-align: center;">Emel</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Tarikh Daftar</th>
                                <th style="text-align: center;">Tindakan</th>
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($data as $key =>$data)
                             <tr style="text-align: center;">
                                 <td>{{$i}}</td>
                                 <td>{{data_get($data,'name')}}</td>
                                 <td>{{data_get($data,'email')}}</td>
                                 <td>{{data_get($data,'status')}}</td>
                                  <td>{{data_get($data,'created_at')}}</td>
                                  <td><a href="{!! URL::to('/site/users/approve/'.data_get($data,'id')) !!}" data-tooltip="Kelulusan" data-position="bottom center"><i class="edit icon"></i>
                                  </a>
                                  </td>
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='8' class="center aligned">Tiada Data</td></tr>
                            @endforelse
                          </tbody>
                 
                    </table>
                
                </div>
              </div>

 
@endsection
@push('script')
<script type="text/javascript">

  $(document).ready(function() 
  {

                $('#listuser').DataTable( {
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


