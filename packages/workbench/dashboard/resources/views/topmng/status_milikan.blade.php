 <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th colspan="7">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">STATUS PEMILIKAN RUMAH MENGIKUT DAERAH</span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Daerah</th>
                                 @foreach($status_jenis_milikan as $key2 =>$data2)
                                 <th style="text-align: center;">{{data_get($data2,'description')}}</th>
                                 @endforeach
                                
                               
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($status_milikan as $key =>$data)
                             <tr style="text-align: center;">
                                 <td><a onclick="detailstatusmilikan('{{data_get($data,'daerah_id')}}',0)" style="color: black">{{data_get($data,'namadaerah')}}</a></td>
                                 <td>@if(data_get($data,'SENDIRI')==NULL)
                                  0
                                  @else
                                  <a onclick="detailstatusmilikan('{{data_get($data,'daerah_id')}}',79)" style="color: black">{{data_get($data,'SENDIRI')}}</a>
                                  @endif
                                 </td>
                                 <td>
                                  @if(data_get($data,'SEWA')==NULL)
                                  0
                                  @else
                                  <a onclick="detailstatusmilikan('{{data_get($data,'daerah_id')}}',80)" style="color: black">{{data_get($data,'SEWA')}}</a>
                                  @endif
                                 </td>
                                
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='7' class="center aligned">Tiada Data</td></tr>
                            @endforelse

                 </tbody>
                    </table>

<!-- start modal view-->
  <div class="ui large modal" id="detailstatusmilikan">
   <i class="close icon"></i>
   <div class="header" style="">
        <h4>MAKLUMAT STATUS PEMILIKAN RUMAH</h4>
    </div>
       <div class="scrolling content" id="datadetailallstatusmilikan">


       </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {


               



  });
  function detailstatusmilikan(fk_daerah,types){


   var daerah=fk_daerah;
   var types=types;


     $.ajax({
      type: "GET",


      url: "{{ URL::to('/dashboard/detailstatusmilikan/')}}?fk_daerah=" + daerah+ "&types=" + types,

      beforeSend: function() {

        block("tab-content");

          $('#liststatusmilikan').DataTable().destroy();///before send ajax

      },

      success: function(data) {
        unblock("tab-content");

      $("#datadetailallstatusmilikan").html(data);


     $('#liststatusmilikan').DataTable( {
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



     $('#detailstatusmilikan').modal({
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