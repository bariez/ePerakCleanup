@extends('laravolt::layout.app_top_0')

@section('content')


<div class="ui one column grid p-2" >
    <div class="column right aligned middle aligned">
        <a class="ui button" href="{!! URL::to('dashboard/searchkampung/isirumah/ketuaisirumah/'.$idkampung) !!}" id="backbutton"><i class="material-icons left"></i><span>Kembali</span></a>
    </div>
    </div>


<div class="ui container-fluid p-2">
  <h4 class="ui top attached header">
Senarai Ahli Isi Rumah - {{data_get($infokampung,'NamaKampung')}}
</h4>
<div class="ui attached segment raised">
                <br>
            	<table id="listahlirumah" class="ui celled table" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Bil</th>
                                <!-- <th style="text-align: center;">ID Rumah</th> -->
                                <th style="text-align: center;">Nama Ahli Isi Rumah</th>
                                <th style="text-align: center;">Tindakan</th>
                                
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @foreach($ahliisirumah as $key =>$data)
                             <tr  style="text-align: center;">
                                 <td>{{$i}}</td>
                               <!--   <td>{{data_get($data,'rumah.IdRumah')}}</td> -->
                                 <td>{{data_get($data,'Nama')}}</td>
                                  <td><a href="{!! URL::to('/dashboard/searchkampung/isirumah/viewahli/'.data_get($data,'id').'/'.$idkampung.'/'.$idrumah) !!}" data-tooltip="Paparan" data-position="bottom center"><i class="eye icon"></i></a>
                             </tr>

                             <?php $i++;?>
                            @endforeach
                                 
                 </tbody>
                    </table>
                
                </div>
                </div>

@endsection

@push('script')

<script type="text/javascript">

  $(document).ready(function() 
  {

                $('#listahlirumah').DataTable( {
                   "lengthChange": false,
                    "language": {
                   "search":  "Carian:",
                    "info":     "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                    "infoEmpty": "Paparan 0 hingga 0 daripada 0 jumlah data",
                     "zeroRecords": "Tiada Data",
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
                              var idrumah = $(this).data('idrumah');
                             document.getElementById("idrumah").value =idrumah;


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