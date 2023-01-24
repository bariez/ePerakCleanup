@extends('laravolt::layout.app_top_0')

@section('content')

<br>

<div class="ui container-fluid content__body p-3">
  <h4 class="ui top attached header">
Senarai Ketua Isi Rumah - {{data_get($infokampung,'NamaKampung')}}
</h4>
<div class="ui attached segment raised">
              <div align="right">
                  @if(data_get($roleuser,'role_id')!=2 && data_get($roleuser,'role_id')!=4)
                    <a class="ui green button" href="{!! URL::to('dataentry/searchkampung/isirumah/addketua/'.$idkampung) !!}"><i class="icon plus"></i><span>Tambah</span></a>
                    @endif
                    @if(data_get($roleuser,'role_id')=='1')
                      <a  href='#' data-idkampung='{{$idkampung}}'  class='ui blue button btnimport'><i class="upload icon"></i><span>Import data</span></a>
                      @endif
                       <a  href="{!! URL::to('dataentry/searchkampung/cetakkirAll/1/'.$idkampung) !!}"class='ui yellow button'><i class="print icon"></i><span>Cetakan KIR</span></a>
                      
       
                </div>
             <br>
              <table id="listketuaisirumah" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Bil</th>
                                <th style="text-align: center;">ID Rumah</th>
                                <th style="text-align: center;">Ketua Isi Rumah</th>
                                <th style="text-align: center;">Tindakan</th>
                                
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($ketuaisirumah as $key =>$data)
                             <tr  style="text-align: center;">
                                 <td>{{$i}}</td>
                                 <td>{{data_get($data,'rumah.IdRumah')}}</td>
                                 <td>{{data_get($data,'Nama')}}</td>
                                  <td><a href="{!! URL::to('/dashboard/searchkampung/isirumah/viewketua/'.data_get($data,'id').'/'.$idkampung) !!}" data-tooltip="Paparan" data-position="bottom center"><i class="eye icon"></i></a>
                                     <a href="{!! URL::to('/dashboard/searchkampung/isirumah/ahliisirumah/'.$idkampung.'/'.data_get($data,'rumah.id')) !!}" data-tooltip="Ahli Isi Rumah" data-position="bottom center"><i class="user plus icon"></i></a>
                             
                                       <a  href="{!! URL::to('dataentry/searchkampung/cetakkir/1/'.$idkampung.'/'.data_get($data,'rumah.IdRumah')) !!}" data-tooltip="Cetakan" data-position="bottom center"><i class="print icon"></i></a>

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

                $('#listketuaisirumah').DataTable( {
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

                $('#listkamus').DataTable( {
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

                           $('.btnimport').click(function() {

                             var idkampung = $(this).data('idkampung');

                             document.getElementById("idkampung").value =idkampung;

                             $('#import')
                            .modal({
                            blurring: true
                            })
                            .modal('show')
                            ;



                        });
                           $('.btnkamus').click(function() {


                             $('#kamus')
                            .modal({
                            blurring: true
                            })
                            .modal('show')
                            ;



                        });
                

  });
</script>
@endpush