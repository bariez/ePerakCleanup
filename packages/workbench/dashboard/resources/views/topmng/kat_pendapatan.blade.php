 <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">KATEGORI PENDAPATAN</span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Daerah</th>
                                <th style="text-align: center;">KURANG RM 2,500</th>
                                <th style="text-align: center;">RM 2,500 - RM 4,500</th>
                                <th style="text-align: center;">RM 4,501 - RM 9,999</th>
                                <th style="text-align: center;">LEBIH RM 10,000</th>
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($pendapatan as $key =>$data)
                             <tr  style="text-align: center;">
                                 <td><a onclick="detailallincome('{{data_get($data,'id')}}',0)" style="color: black">{{data_get($data,'NamaDaerah')}}</a></td>
                                 <td><a onclick="detailallincome('{{data_get($data,'id')}}',1)" style="color: black">{{data_get($data,'Kurang RM 2500')}}</a></td>
                                 <td><a onclick="detailallincome('{{data_get($data,'id')}}',2)" style="color: black">{{data_get($data,'RM 2500-RM 4500')}}</a></td>
                                 <td><a onclick="detailallincome('{{data_get($data,'id')}}',3)" style="color: black">{{data_get($data,'RM 4501-RM 9999')}}</a></td>
                                 <td><a onclick="detailallincome('{{data_get($data,'id')}}',4)" style="color: black">{{data_get($data,'Lebih RM 10000')}}</a></td>
                                 
                                 <!--  <td><a href="{!! URL::to('/site/daerah/viewdaerah/'.data_get($data,'id')) !!}"><i class="eye icon"></i>
                                  </a>
                                      <a href="{!! URL::to('/site/daerah/editdaerah/'.data_get($data,'id')) !!}"><i class="edit icon"></i></a>
                                     

                                  </td> -->
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='6' class="center aligned">Tiada Data</td></tr>
                            @endforelse

                 </tbody>
                    </table>

<!-- start modal view-->
<div class="ui large modal" id="detailpendapatan">
   <i class="close icon"></i>
   <div class="header" style="">
        <h4>MAKLUMAT PEKERJAAN PENDUDUK</h4>
    </div>
       <div class="scrolling content" id="datadetailpendapatan">


       </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {



  });
  function detailallincome(fk_daerah,types){

   var daerah=fk_daerah;
   var types=types;


     $.ajax({
      type: "GET",


        url: "{{ URL::to('/dashboard/detailpendapatan/')}}?fk_daerah=" + daerah+ "&types=" + types,

      beforeSend: function() {

        block("tab-content");

       $('#listincome').DataTable().destroy();///before send ajax

      },

      success: function(data) {
        unblock("tab-content");

      $("#datadetailpendapatan").html(data);


     $('#listincome').DataTable( {
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


    
     $('#detailpendapatan').modal({
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