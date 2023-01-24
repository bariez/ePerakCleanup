 <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th colspan="7">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">KEMUDAHAN AWAM & INFRASTRUKTUR MENGIKUT DAERAH</span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Daerah</th>
                                 @foreach($status_kemudahan_awam as $key2 =>$data2)
                                 <th style="text-align: center;">{{data_get($data2,'description')}}</th>
                                 @endforeach
                                
                               
                            </tr>
                        </thead>
                         <tbody>
                           <?php $i=1; ?>
                           @forelse($kemudahan_awam as $key =>$data)
                             <tr style="text-align: center;">
                                 <td><a onclick="detailkemudahan('{{data_get($data,'daerah_id')}}',0)" style="color: black">{{data_get($data,'namadaerah')}}</a></td>
                                 <td>@if(data_get($data,'KEMUDAHAN KESIHATAN')==NULL)
                                  0
                                  @else
                                  <a onclick="detailkemudahan('{{data_get($data,'daerah_id')}}',11)" style="color: black">{{data_get($data,'KEMUDAHAN KESIHATAN')}}</a>
                                  @endif
                                 </td>
                                 <td>
                                  @if(data_get($data,'KEMUDAHAN MASYARAKAT')==NULL)
                                  0
                                  @else
                                  <a onclick="detailkemudahan('{{data_get($data,'daerah_id')}}',10)" style="color: black">{{data_get($data,'KEMUDAHAN MASYARAKAT')}}</a>
                                  @endif
                                 </td>
                                 <td>
                                  @if(data_get($data,'KEMUDAHAN PENDIDIKAN')==NULL)
                                  0
                                  @else
                                  <a onclick="detailkemudahan('{{data_get($data,'daerah_id')}}',12)" style="color: black">{{data_get($data,'KEMUDAHAN PENDIDIKAN')}}</a>
                                  @endif
                                  </td>
                                 <td>
                                  @if(data_get($data,'KEMUDAHAN PERNIAGAAN')==NULL)
                                  0
                                  @else
                                  <a onclick="detailkemudahan('{{data_get($data,'daerah_id')}}',13)" style="color: black">{{data_get($data,'KEMUDAHAN PERNIAGAAN')}}
                                  @endif</a>
                                  </td>
                                 <td>
                                  @if(data_get($data,'KEMUDAHAN UTILITI')==NULL)
                                  0
                                  @else
                                  <a onclick="detailkemudahan('{{data_get($data,'daerah_id')}}',14)" style="color: black">{{data_get($data,'KEMUDAHAN UTILITI')}}
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
  <div class="ui large modal" id="detailkemudahan">
   <i class="close icon"></i>
   <div class="header" style="">
        <h4>MAKLUMAT KEMUDAHAN AWAM & INFRASTRUKTUR</h4>
    </div>
       <div class="scrolling content" id="datadetailallkemudahan">


       </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {


               



  });
  function detailkemudahan(fk_daerah,types){


   var daerah=fk_daerah;
   var types=types;


     $.ajax({
      type: "GET",


      url: "{{ URL::to('/dashboard/detailkemudahan/')}}?fk_daerah=" + daerah+ "&types=" + types,

      beforeSend: function() {

        block("tab-content");

          $('#listkemudahan').DataTable().destroy();///before send ajax

      },

      success: function(data) {
        unblock("tab-content");

      $("#datadetailallkemudahan").html(data);


     $('#listkemudahan').DataTable( {
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



     $('#detailkemudahan').modal({
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