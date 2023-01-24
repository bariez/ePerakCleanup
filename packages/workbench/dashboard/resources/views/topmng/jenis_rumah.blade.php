 <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th colspan="7">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">JENIS RUMAH MENGIKUT DAERAH</span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Daerah</th>
                                 @foreach($status_jenis_rumah as $key2 =>$data2)
                                 <th style="text-align: center;">{{data_get($data2,'description')}}</th>
                                 @endforeach
                                
                               
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($jenis_rumah as $key =>$data)
                             <tr style="text-align: center;">
                                 <td><a onclick="detailjenisrumah('{{data_get($data,'daerah_id')}}',0)" style="color: black">{{data_get($data,'namadaerah')}}</a></td>
                                 <td>@if(data_get($data,'SESEBUAH')==NULL)
                                  0
                                  @else
                                  <a onclick="detailjenisrumah('{{data_get($data,'daerah_id')}}',81)" style="color: black">{{data_get($data,'SESEBUAH')}}</a>
                                  @endif
                                 </td>
                                 <td>
                                  @if(data_get($data,'TERES')==NULL)
                                  0
                                  @else
                                  <a onclick="detailjenisrumah('{{data_get($data,'daerah_id')}}',82)" style="color: black">{{data_get($data,'TERES')}}</a>
                                  @endif
                                 </td>
                                 <td>
                                  @if(data_get($data,'BERKEMBAR')==NULL)
                                  0
                                  @else
                                  <a onclick="detailjenisrumah('{{data_get($data,'daerah_id')}}',83)" style="color: black">{{data_get($data,'BERKEMBAR')}}</a>
                                  @endif
                                  </td>
                                 <td>
                                  @if(data_get($data,'FLAT')==NULL)
                                  0
                                  @else
                                  <a onclick="detailjenisrumah('{{data_get($data,'daerah_id')}}',84)" style="color: black">{{data_get($data,'FLAT')}}
                                  @endif</a>
                                  </td>
                                 <td>
                                  @if(data_get($data,'APARTMENT')==NULL)
                                  0
                                  @else
                                  <a onclick="detailjenisrumah('{{data_get($data,'daerah_id')}}',85)" style="color: black">{{data_get($data,'APARTMENT')}}
                                  @endif</a>
                                  </td>
                                   <td>
                                  @if(data_get($data,'KONDOMINIUM')==NULL)
                                  0
                                  @else
                                  <a onclick="detailjenisrumah('{{data_get($data,'daerah_id')}}',86)" style="color: black">{{data_get($data,'KONDOMINIUM')}}
                                  @endif</a>
                                  </td>
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='7' class="center aligned">Tiada Data</td></tr>
                            @endforelse

                 </tbody>
                    </table>

<!-- start modal view-->
  <div class="ui large modal" id="detailjenisrumah">
   <i class="close icon"></i>
   <div class="header" style="">
        <h4>MAKLUMAT JENIS RUMAH</h4>
    </div>
       <div class="scrolling content" id="datadetailalljenisrumah">


       </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {


               



  });
  function detailjenisrumah(fk_daerah,types){


   var daerah=fk_daerah;
   var types=types;


     $.ajax({
      type: "GET",


      url: "{{ URL::to('/dashboard/detailjenisrumah/')}}?fk_daerah=" + daerah+ "&types=" + types,

      beforeSend: function() {

        block("tab-content");

          $('#listjenisrumah').DataTable().destroy();///before send ajax

      },

      success: function(data) {
        unblock("tab-content");

      $("#datadetailalljenisrumah").html(data);


     $('#listjenisrumah').DataTable( {
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



     $('#detailjenisrumah').modal({
            blurring: true
        }).modal(
            'setting',
            'transition', 
            'horizontal flip'
        ).modal('show');


      } //end sucsess chart12


    }); //end ajax chart12





  }

</script>