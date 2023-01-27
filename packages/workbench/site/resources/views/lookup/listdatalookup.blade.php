@extends('laravolt::layout.app2')

@section('content')



<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0" >
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs">
          Senarai Kamus Data
        </h3 >
    </div>

      <div class="column right aligned middle aligned">
        <a href="/site/lkpdetail/create/{{$lkpmaster}}" class="ui button" id="addbutton" themed="">
            <i class="icon plus"></i>
            Tambah
        </a>
       <!--  <button class="ui yellow button" id="reset" onclick="window.location.href='/site/lkpmaster/listdatalookup/{{$lkpmaster}}'; return false;" type="button">
            <i class="icon redo"></i>Reset
        </button> -->
        <a class="ui button" id="backbutton" href="/site/lookup/index"><i class="material-icons left"></i><span>Kembali</span></a>


    </div>
 
</div>


<br>
 <h4 class="ui top attached header">
Senarai Kamus Data
</h4>
    <div class="ui container-fluid content__body p-2">
<div class="ui attached segment raised">

                <table id="listdetail" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Bil</th>
                                <th style="text-align: center;">Kamus Data</th>
                                <th style="text-align: center;">Diskrpsi</th>
                                <th style="text-align: center;">Kategori</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Tindakan</th>
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($data as $key =>$data)
                             <tr style="text-align: center;">
                                 <td>{{$i}}</td>
                                 <td>{{data_get($data,'name')}}</td>
                                 <td>{{data_get($data,'description')}}</td>
                                 <td>{{data_get($data,'catname')}}</td>
                                 <td>{{data_get($data,'status')}}</td>
                                  <td><a href="{!! URL::to('/site/lkpdetail/edit/'.data_get($data,'id')) !!}" data-tooltip="Kemaskini" data-position="bottom center"><i class="edit icon"></i>
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

                $('#listdetail').DataTable( {
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


