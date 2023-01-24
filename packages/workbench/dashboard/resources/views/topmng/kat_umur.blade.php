 <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px; padding-top: 10px">
                        <thead>
                            <tr>
                                <th colspan="8">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">UMUR PENDUDUK MENGIKUT DAERAH</span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Daerah</th>
                                <th style="text-align: center;">Kanak-kanak & Remaja Awal 0-14</th>
                                <th style="text-align: center;">Belia Awal 15-18</th>
                                <th style="text-align: center;">Belia Petengahan 19-24</th>
                                <th style="text-align: center;">Belia Akhir 25-30</th>
                                <th style="text-align: center;">Belia Dewasa 31-40</th>
                                <th style="text-align: center;">Dewasa 41-64</th>
                                <th style="text-align: center;">Warga Emas 65 ++</th>
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                            @forelse($umur as $key =>$data)
                             <tr style="text-align: center;">
                                 <td><a onclick="detailage('{{data_get($data,'daerah_id')}}',0)" style="color: black">{{data_get($data,'NamaDaerah')}}</a></td>
                                 <td>@if(data_get($data,'Kanak-kanak & Remaja Awal 0-14')==NULL)
                                  0
                                  @else
                                  <a onclick="detailage('{{data_get($data,'daerah_id')}}',1)" style="color: black">{{data_get($data,'Kanak-kanak & Remaja Awal 0-14')}}</a>
                                  @endif
                                 </td>
                                  <td>
                                  @if(data_get($data,'Belia Awal 15-18')==NULL)
                                  0
                                  @else
                                  <a onclick="detailage('{{data_get($data,'daerah_id')}}',2)" style="color: black">{{data_get($data,'Belia Awal 15-18')}}</a>
                                  @endif
                                 </td>
                                 <td>
                                  @if(data_get($data,'Belia Petengahan 19-24')==NULL)
                                  0
                                  @else
                                  <a onclick="detailage('{{data_get($data,'daerah_id')}}',3)" style="color: black">{{data_get($data,'Belia Petengahan 19-24')}}</a>
                                  @endif
                                 </td>
                                 <td>
                                  @if(data_get($data,'Belia Akhir 25-30')==NULL)
                                  0
                                  @else
                                  <a onclick="detailage('{{data_get($data,'daerah_id')}}',4)" style="color: black">{{data_get($data,'Belia Akhir 25-30')}}</a>
                                  @endif
                                  </td>
                                 <td>
                                  @if(data_get($data,'Belia Dewasa 31-40')==NULL)
                                  0
                                  @else
                                  <a onclick="detailage('{{data_get($data,'daerah_id')}}',5)" style="color: black">{{data_get($data,'Belia Dewasa 31-40')}}
                                  @endif</a>
                                  </td>
                                 <td>
                                  @if(data_get($data,'Dewasa 41-64')==NULL)
                                  0
                                  @else
                                  <a onclick="detailage('{{data_get($data,'daerah_id')}}',6)" style="color: black">{{data_get($data,'Dewasa 41-64')}}
                                  @endif</a>
                                  </td>
                                 <td>
                                  @if(data_get($data,'Warga Emas 65 ++')==NULL)
                                  0
                                  @else
                                  <a onclick="detailage('{{data_get($data,'daerah_id')}}',7)" style="color: black">{{data_get($data,'Warga Emas 65 ++')}}
                                  @endif</a>
                                  </td>
                             </tr>

                             <?php $i++;?>
                            @empty
                                 <tr><td colspan='8' class="center aligned">Tiada Data</td></tr>
                            @endforelse


                 </tbody>
                    </table>

<!-- start modal view-->
<div class="ui large modal" id="detailage">
   <i class="close icon"></i>
   <div class="header" style="">
        <h4>MAKLUMAT UMUR PENDUDUK</h4>
    </div>
       <div class="scrolling content" id="datadetailage">


       </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {



  });
  function detailage(fk_daerah,types){

   var daerah=fk_daerah;
   var types=types;


     $.ajax({
      type: "GET",


        url: "{{ URL::to('/dashboard/detailage/')}}?fk_daerah=" + daerah+ "&types=" + types,

      beforeSend: function() {

        block("tab-content");

       $('#listage').DataTable().destroy();///before send ajax

      },

      success: function(data) {
        unblock("tab-content");

      $("#datadetailage").html(data);


     $('#listage').DataTable( {
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


    
     $('#detailage').modal({
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