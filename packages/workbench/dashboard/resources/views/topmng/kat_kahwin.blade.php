 <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th colspan="7">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">TARAF PERKAHWINAN MENGIKUT DAERAH</span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Daerah</th>
                                 @foreach($statuskahwin as $key2 =>$data2)
                                 <th style="text-align: center;">{{data_get($data2,'description')}}</th>
                                 @endforeach
                                
                               
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($taraf_kahwin as $key =>$data)
                             <tr style="text-align: center;">
                                 <td><a onclick="detailkahwin('{{data_get($data,'daerah_id')}}',0)" style="color: black">{{data_get($data,'namadaerah')}}</a></td>
                                 <td>@if(data_get($data,'BERKAHWIN')==NULL)
                                  0
                                  @else
                                  <a onclick="detailkahwin('{{data_get($data,'daerah_id')}}',130)" style="color: black">{{data_get($data,'BERKAHWIN')}}</a>
                                  @endif
                                 </td>
                                 <td>
                                  @if(data_get($data,'BUJANG')==NULL)
                                  0
                                  @else
                                  <a onclick="detailkahwin('{{data_get($data,'daerah_id')}}',129)" style="color: black">{{data_get($data,'BUJANG')}}</a>
                                  @endif
                                 </td>
                                 <td>
                                  @if(data_get($data,'BALU')==NULL)
                                  0
                                  @else
                                  <a onclick="detailkahwin('{{data_get($data,'daerah_id')}}',131)" style="color: black">{{data_get($data,'BALU')}}</a>
                                  @endif
                                  </td>
                                 <td>
                                  @if(data_get($data,'DUDA')==NULL)
                                  0
                                  @else
                                  <a onclick="detailkahwin('{{data_get($data,'daerah_id')}}',132)" style="color: black">{{data_get($data,'DUDA')}}
                                  @endif</a>
                                  </td>
                                 <td>
                                  @if(data_get($data,'IBU TUNGGAL')==NULL)
                                  0
                                  @else
                                  <a onclick="detailkahwin('{{data_get($data,'daerah_id')}}',133)" style="color: black">{{data_get($data,'IBU TUNGGAL')}}
                                  @endif</a>
                                  </td>
                                 <td>
                                  @if(data_get($data,'BAPA TUNGGAL')==NULL)
                                  0
                                  @else
                                  <a onclick="detailkahwin('{{data_get($data,'daerah_id')}}',134)" style="color: black">{{data_get($data,'BAPA TUNGGAL')}}
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
  <div class="ui large modal" id="detailkahwin">
   <i class="close icon"></i>
   <div class="header" style="">
        <h4>MAKLUMAT TARAF PERKAHWINAN PENDUDUK</h4>
    </div>
       <div class="scrolling content" id="datadetailallkahwin">


       </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {


               



  });
  function detailkahwin(fk_daerah,types){


   var daerah=fk_daerah;
   var types=types;


     $.ajax({
      type: "GET",


      url: "{{ URL::to('/dashboard/detailallkahwin/')}}?fk_daerah=" + daerah+ "&types=" + types,

      beforeSend: function() {

        block("tab-content");

          $('#listkahwin').DataTable().destroy();///before send ajax

      },

      success: function(data) {
        unblock("tab-content");

      $("#datadetailallkahwin").html(data);


     $('#listkahwin').DataTable( {
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



     $('#detailkahwin').modal({
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