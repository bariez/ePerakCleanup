 <table class="ui very basic collapsing celled table" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th colspan="12">
                                    <center>
                                        <span style="font-family: Helvetica; font-size: 18px; letter-spacing: 0px;">KEMUDAHAN ASAS RUMAH</span>
                                    </center>
                                </th>
                            </tr>
                            <tr>
                              <th style="text-align: center;" colspan="2">Daerah</th>
                              <th style="text-align: center;" colspan="2">AIR</th>
                              <th style="text-align: center;" colspan="2">ELEKTRIK</th>
                              <th style="text-align: center;" colspan="2">ASTRO</th>
                              <th style="text-align: center;" colspan="2">INTERNET</th>
                              <th style="text-align: center;" colspan="2">TELEFON</th>
                            </tr>
                            <tr>
                              <th colspan="2"></th>
                              <th style="text-align: center;">YA</th>
                              <th style="text-align: center;">TIDAK</th>
                              <th style="text-align: center;">YA</th>
                              <th style="text-align: center;">TIDAK</th>
                              <th style="text-align: center;">YA</th>
                              <th style="text-align: center;">TIDAK</th>
                              <th style="text-align: center;">YA</th>
                              <th style="text-align: center;">TIDAK</th>
                              <th style="text-align: center;">YA</th>
                              <th style="text-align: center;">TIDAK</th>
                            </tr>
                        </thead>
                         <tbody>
         
                           <?php $i=1; ?>
                           @forelse($kemudahanasas as $key =>$data)
                             <tr style="text-align: center;">
                                 <td colspan="2">
                                  @if(data_get($data,'yesAir')==0 && data_get($data,'noAir')==0)
                                  {{data_get($data,'NamaDaerah')}}
                                  @else
                                  <a onclick="detailkemudahanasas('{{data_get($data,'daerah_id')}}',0,0)" style="color: black">{{data_get($data,'NamaDaerah')}}</a>
                                  @endif
                                 </td>
                                 <td>
                                  @if(data_get($data,'yesAir')==0)
                                  0
                                  @else
                                  <a onclick="detailkemudahanasas('{{data_get($data,'daerah_id')}}','a1','air')" style="color: black">{{data_get($data,'yesAir')}}</a>
                                  @endif
                                  
                                 </td>
                                 <td>
                                  @if(data_get($data,'noAir')==0)
                                  0
                                  @else
                                  <a onclick="detailkemudahanasas('{{data_get($data,'daerah_id')}}','a0','air')" style="color: black">{{data_get($data,'noAir')}}</a>
                                  @endif
                                  
                                 </td>
                                  <td>
                                   @if(data_get($data,'yesElektrik')==0)
                                   0
                                   @else
                                   <a onclick="detailkemudahanasas('{{data_get($data,'daerah_id')}}','e1','elektrik')" style="color: black">{{data_get($data,'yesElektrik')}}</a>
                                   @endif
                                    
                                 </td>
                                 <td>
                                   @if(data_get($data,'noElektrik')==0)
                                   0
                                   @else
                                    <a onclick="detailkemudahanasas('{{data_get($data,'daerah_id')}}','e0','elektrik')" style="color: black">{{data_get($data,'noElektrik')}}</a>
                                   @endif
                                 
                                 </td>
                                  <td>
                                   @if(data_get($data,'yesAstro')==0)
                                   0
                                   @else
                                   <a onclick="detailkemudahanasas('{{data_get($data,'daerah_id')}}','s1','astro')" style="color: black">{{data_get($data,'yesAstro')}}</a>
                                   @endif
                                 </td>
                                 <td>
                                   @if(data_get($data,'noAstro')==0)
                                   0
                                   @else
                                   <a onclick="detailkemudahanasas('{{data_get($data,'daerah_id')}}','s0','astro')" style="color: black"> {{data_get($data,'noAstro')}}</a>
                                   @endif
                                 </td>
                                  <td>
                                   @if(data_get($data,'yesInternet')==0)
                                   0
                                   @else
                                   <a onclick="detailkemudahanasas('{{data_get($data,'daerah_id')}}','y1','internet')" style="color:black">{{data_get($data,'yesInternet')}}</a>
                                   @endif
                                     
                                 </td>
                                 <td>
                                   @if(data_get($data,'noInternet')==0)
                                   0
                                   @else
                                   <a onclick="detailkemudahanasas('{{data_get($data,'daerah_id')}}','y0','internet')" style="color:black">{{data_get($data,'noInternet')}}</a>
                                   @endif
                                 </td>
                                  <td>
                                   @if(data_get($data,'yesTelefon')==0)
                                   0
                                   @else
                                   <a onclick="detailkemudahanasas('{{data_get($data,'daerah_id')}}','t1','telefon')" style="color:black">{{data_get($data,'yesTelefon')}}</a>
                                   @endif
                                  
                                 </td>
                                 <td>
                                   @if(data_get($data,'noTelefon')==0)
                                   0
                                   @else
                                   <a onclick="detailkemudahanasas('{{data_get($data,'daerah_id')}}','t0','telefon')" style="color:black">{{data_get($data,'noTelefon')}}</a>
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
  <div class="ui large modal" id="detailkemudahanasas">
   <i class="close icon"></i>
   <div class="header" style="">
        <h4>MAKLUMAT KEMUDAHAN ASAS RUMAH</h4>
    </div>
       <div class="scrolling content" id="datadetailallkemudahanasas">


       </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {


  });
  function detailkemudahanasas(fk_daerah,types,kemudahan){





   var daerah=fk_daerah;
   var types=types;
   var kemudahan=kemudahan;


     $.ajax({
      type: "GET",


      url: "{{ URL::to('/dashboard/detailkemudahanasas/')}}?fk_daerah=" + daerah+ "&types=" + types+ "&kemudahan=" +kemudahan,

      beforeSend: function() {

        block("tab-content");

          $('#listdetailkemudahanasas').DataTable().destroy();///before send ajax

      },

      success: function(data) {
        unblock("tab-content");

      $("#datadetailallkemudahanasas").html(data);



     $('#listdetailkemudahanasas').DataTable( {
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



     $('#detailkemudahanasas').modal({
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