@extends('laravolt::layout.app2')

@section('content')



<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0" >
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs">
          Kamus Data
        </h3>
    </div>

      <div class="column right aligned middle aligned">
        <a href="/site/lkpmaster/create" class="ui button" themed="" style="background-color: #432712;color: white">
            <i class="icon plus" style="color: #15f915"></i>
            Tambah
        </a>
        <!-- <button class="ui yellow button" id="reset" onclick="window.location.href='/site/lookup/index'; return false;" type="button">
            <i class="icon redo"></i>Reset
        </button> -->
    </div>
 
</div>

<br>
 <h4 class="ui top attached header">
Senarai Kamus Data
</h4>
    <div class="ui container-fluid content__body p-3">
<div class="ui attached segment raised">

                <table id="listmaster" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Bil</th>
                                <th style="text-align: center;">Nama</th>
                                <th style="text-align: center;">Kamus Data Utama</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Tindakan</th>
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($datamaster as $key =>$data)
                             <tr style="text-align: center;">
                                 <td>{{$i}}</td>
                                 <td>{{data_get($data,'name')}}</td>
                                 <td>{{data_get($data,'parent_name')}}</td>
                                 <td>{{data_get($data,'status')}}</td>
                                  <td><a href="{!! URL::to('/site/lkpmaster/edit/'.data_get($data,'id')) !!}" data-tooltip="Kemaskini" data-position="bottom center"><i class="edit icon"></i>
                                  </a>
                                  <a href="{!! URL::to('/site/lkpmaster/listdatalookup/'.data_get($data,'id')) !!}" data-tooltip="Paparan" data-position="bottom center"><i class="eye icon"></i></a> 
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

                $('#listmaster').DataTable( {
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
