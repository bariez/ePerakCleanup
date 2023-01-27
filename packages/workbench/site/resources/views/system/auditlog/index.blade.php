@extends('laravolt::layout.app2')

@section('content')



<div id="actionbar" class="ui two column grid content__body p-1">
  <div class="column middle aligned">
    <h3 class="ui header m-t-xs">
      Audit Log
    </h3>
  </div>
</div>
 <div class="tab-content mt-5">
<div class="ui container-fluid content__body p-3">
  <div class="ui segments panel">
    <div class="ui segment p-3">
      <form class="ui form">
         <div class="two fields">
          <div class="field">
            <label>Kategori Pengguna</label>
            <div class="ui fluid search selection dropdown">
              <input type="hidden" name="katpengguna" id="katpengguna" value="">
              <i class="dropdown icon"></i>
              <div class="default text" id="pilihkatpengguna">Sila Pilih</div>
              <div class="menu" id="pilihkatpengguna">
                <div class="item" data-value="" onclick="user(0)">Sila Pilih</div>
                @foreach($role as $key => $value)
                <div class="item" data-value="{{$value->id}}" onclick="user({{$value->id}})">{{$value->name}}</div>
                @endforeach
              </div>
          </div>
        </div>
           <div class="field">
            <label>Nama</label>
            <div class="ui fluid search selection dropdown">
              <input type="hidden" name="pengguna" id="pengguna" value="">
              <i class="dropdown icon"></i>
              <div class="default text" id="pilihpengguna">Sila Pilih</div>
              <div class="menu" id="selectpengguna">
                <div class="item" data-value="">Sila Pilih</div>
                @foreach($user as $key => $value)
                <div class="item" data-value="{{$value->id}}">{{$value->name}}</div>
                @endforeach
              </div>
          </div>
        </div>

      </div>
        <div class="two fields">
          <div class="field">
            <label>Tarikh Mula</label>
            <div class="ui calendar" id="date_calendar_mula">
            <div class="ui input left icon">
              <i class="calendar icon"></i>
              <input type="text" placeholder="Tarikh Mula" id="datefrom">
            </div>
          </div>
          </div>
          <div class="field">
            <label>Tarikh Akhir</label>
            <div class="ui calendar" id="date_calendar_akhir">
            <div class="ui input left icon">
              <i class="calendar icon"></i>
              <input type="text" placeholder="Tarikh Akhir" id="dateto">
            </div>
          </div>
            
          </div>
        </div>


      </form>

      <div class="ui divider section"></div>
     <div class="ui buttons right floated">
            <a class="ui button" href="{!! URL::to('site/auditlog/index') !!}">Set Semula</a>
            <div class="or" data-text="@"></div>
            <button class="ui button primary" onclick="search()" id="addbutton">
                          Carian
            </button>
        </div>
      <br/><br/><br/>

      


    </div>



  </div>
</div>
</div>

<div class="ui container-fluid content__body p-1" id="loading" style="display: none;">
  <div class="ui segments panel">
    <div class="ui segment p-3">
      <div class="ui blue sliding indeterminate progress">
        <div class="bar">
          <div class="progress">Sila Tunggu Sebentar</div>
        </div>

      </div>
    </div>
  </div>

</div>
<div class="ui container-fluid content__body p-2" id="result2" style="display: none">
  <div class="ui segments panel">
    <div class="ui segment p-1" id="result">

    </div>
  </div>
</div>
@endsection



@push('script')



<script type="text/javascript">
  $(document).ready(function() {


$('#date_calendar_mula')
  .calendar({
    monthFirst: false,
    type: 'date',
    formatter: {
      date: function (date, settings) {
        if (!date) return '';
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        return day + '-' + month + '-' + year;
      }
    }
  })
;
$('#date_calendar_akhir')
  .calendar({
    monthFirst: false,
    type: 'date',
    formatter: {
      date: function (date, settings) {
        if (!date) return '';
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        return day + '-' + month + '-' + year;
      }
    }
  })
;


  });
 function search(){

   var user=$('#pengguna').val();
   var datefrom=$('#datefrom').val();
   var dateto=$('#dateto').val();
   var kat=$('#katpengguna').val();

   if(user==''){
    var valuser=0;

   }else{
    var valuser =user
   }


  if(datefrom==''){
    var valdatefrom=0;

   }else{
    var valdatefrom =datefrom
   }

   if(dateto==''){
    var valdateto=0;

   }else{
    var valdateto =dateto
   }
    if(kat==''){
    var valkat=0;

   }else{
    var valkat =kat;
   }


    $.ajax({ 
            type: "GET", 
             url: "{{ URL::to('/site/auditlog/searchlog/')}}?user="+valuser+"&dateform="+valdatefrom+"&dateto="+valdateto+"&kat="+valkat,

            beforeSend: function ()
            {
              $('#loading').show();

               document.getElementById('result2').style.display = "none";
               

            },
            
            success: function(data){ 

                $(document).ready(function() 
                {

                $('#searchlogdata').DataTable( {
                   "lengthChange": false,
                   "searching": false,
                    "language": {
                   // "search":  "Carian:",
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

             $('#loading').hide();
             document.getElementById('result2').style.display = "show";
             $('#result2').show();
             document.getElementById('result').innerHTML = data;
  

           }


          });

   }
  function user(id){

       $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('site/auditlog/users/')}}"+"/"+id,
            datatype : 'json',

            beforeSend: function ()
            {
               //$('div.text').html('Sila Pilih');
               block("tab-content");
               document.getElementById("pilihpengguna").innerHTML = "Sila Pilih";
               $('#selectpengguna').html('');
              
               

            },
            
            success: function(data){ 

             unblock("tab-content");
             $('#loading').hide();
             $('#selectpengguna').html(data);
           

           }


          });

    
};
</script>

@endpush