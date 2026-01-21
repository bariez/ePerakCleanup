@extends('laravolt::layout.app2')

@section('content')

<style>
    /* CSS Tambahan untuk kacakkan UI */
    .custom-form label {
        color: #555 !important;
        font-weight: 600 !important;
        margin-bottom: 8px !important;
        display: block !important;
    }
    .ui.selection.dropdown {
        border-radius: 10px !important;
        border: 1px solid #ddd !important;
        padding: 12px !important;
    }
    .ui.form input:not([type]), .ui.form input[type="text"] {
        border-radius: 10px !important;
        padding: 12px !important;
    }
    .shadow-lg {
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
    .p-x-3 { padding-left: 2rem !important; padding-right: 2rem !important; }
    .circular { border-radius: 50px !important; }
    .bg-light { background-color: #f9f9f9 !important; }
</style>

<div id="actionbar" class="ui container-fluid p-x-3 p-y-2" style="background: linear-gradient(135deg, #1a3352 0%, #2c5282 100%); border-radius: 0 0 20px 20px; margin-bottom: 25px;">
    <div class="ui grid stackable align-items-center">
        <div class="column middle aligned">
            <h2 class="ui header inverted m-0">
                <i class="map marked alternate icon"></i>
                <div class="content">
                    CARIAN KAMPUNG
                    <div class="sub header inverted" style="opacity: 0.8; letter-spacing: 1px;">Sila tapis maklumat mengikut keperluan statistik anda</div>
                </div>
            </h2>
        </div>
    </div> 
</div>

<div class="ui container-fluid p-x-3">
    <div class="ui segment p-0 shadow-lg" style="border-radius: 20px; border: none; overflow: hidden; background: rgba(255, 255, 255, 0.9);">
        
        <div class="ui segment p-3 border-0" style="background: #f8f9fa; border-bottom: 1px solid #eee !important;">
            <h4 class="ui header" style="color: #1a3352;">
                <i class="filter icon"></i> Penapis Carian
            </h4>
        </div>

        <div class="ui segment p-4 border-0">
            <form class="ui form custom-form">
                <div class="two fields">
                    @if(data_get($roleuser,'role_id')==2)
                        <div class="field">
                            <label><i class="building icon"></i> Daerah</label>
                            <input type="text" name="daerah" id="daerah" readonly class="bg-light" value="{{data_get($daerah,'NamaDaerah')}}">
                        </div>
                        <div class="field">
                            <label><i class="map icon"></i> Mukim</label>
                            <div class="ui fluid search selection dropdown shadow-sm">
                                <input type="hidden" name="mukim" id="mukim">
                                <i class="dropdown icon"></i>
                                <div class="default text" id="pilihmukim">Sila Pilih Mukim</div>
                                <div class="menu" id="selectmukim"></div>
                            </div>
                        </div>
                    @elseif(data_get($roleuser,'role_id')==3)
                        <div class="field">
                            <label><i class="building icon"></i> Daerah</label>
                            <input type="text" name="daerah" id="daerah" readonly class="bg-light" value="{{data_get($daerah,'NamaDaerah')}}">
                        </div>
                        <div class="field">
                            <label><i class="map icon"></i> Mukim</label>
                            <input type="text" name="mukim" id="mukim" readonly class="bg-light" value="{{data_get($mukim,'NamaMukim')}}">
                        </div>
                    @else
                        <div class="field">
                            <label><i class="building icon"></i> Daerah</label>
                            <div class="ui fluid search selection dropdown shadow-sm">
                                <input type="hidden" name="daerah" id="daerah">
                                <i class="dropdown icon"></i>
                                <div class="default text">Sila Pilih Daerah</div>
                                <div class="menu">
                                    <div class="item" data-value="" onclick="mukim(0)">Semua Daerah</div>
                                    @foreach($daerah as $value)
                                        <div class="item" data-value="{{$value->id}}" onclick="mukim({{$value->id}})">{{$value->NamaDaerah}}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label><i class="map icon"></i> Mukim</label>
                            <div class="ui fluid search selection dropdown shadow-sm">
                                <input type="hidden" name="mukim" id="mukim">
                                <i class="dropdown icon"></i>
                                <div class="default text" id="pilihmukim">Sila Pilih Mukim</div>
                                <div class="menu" id="selectmukim"></div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="two fields">
                    <div class="field">
                        <label><i class="university icon"></i> Parlimen</label>
                        <div class="ui fluid search selection dropdown shadow-sm">
                            <input type="hidden" name="parlimen" id="parlimen">
                            <i class="dropdown icon"></i>
                            <div class="default text" id="pilihparlimen">Sila Pilih Parlimen</div>
                            <div class="menu" id="selectparlimen"></div>
                        </div>
                    </div>
                    <div class="field">
                        <label><i class="landmark icon"></i> Dun</label>
                        <div class="ui fluid search selection dropdown shadow-sm">
                            <input type="hidden" name="dun" id="dun">
                            <i class="dropdown icon"></i>
                            <div class="default text" id="pilihdun">Sila Pilih Dun</div>
                            <div class="menu" id="selectdun"></div>
                        </div>
                    </div>
                </div>

                <div class="two fields">
                    <div class="field">
                        <label><i class="tags icon"></i> Kategori Petempatan</label>
                        <div class="ui fluid search selection dropdown shadow-sm">
                            <input type="hidden" name="cat_petempatan" id="cat_petempatan">
                            <i class="dropdown icon"></i>
                            <div class="default text">Sila Pilih Kategori</div>
                            <div class="menu" id="pilihcat">
                                <div class="item" data-value="" onclick="kampungpenempatan(0)">Semua Kategori</div>
                                @foreach($catpenempatan as $value)
                                    <div class="item" data-value="{{$value->id}}" onclick="kampungpenempatan({{$value->id}})">{{$value->description}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label><i class="home icon"></i> Nama Kampung</label>
                        <div class="ui fluid search selection dropdown shadow-sm">
                            <input type="hidden" name="kampung" id="kampung">
                            <i class="dropdown icon"></i>
                            <div class="default text" id="pilihkampung">Sila Pilih Kampung</div>
                            <div class="menu" id="selectkampung"></div>
                        </div>
                    </div>
                </div>

                <div class="ui divider section"></div>

                <div class="ui grid">
                    <div class="column right aligned">
                        <a class="ui button basic grey circular shadow-sm" href="{!! URL::to('dataentry/searchkampung/index') !!}">
                            <i class="undo icon"></i> Set Semula
                        </a>
                        <button type="button" class="ui button primary circular shadow-sm p-x-3" onclick="search()" id="addbutton" style="background: #1a3352 !important;">
                            <i class="search icon"></i> Mulakan Carian
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

      

    </div>
</div>


        <div class="ui container-fluid  p-2" id="result2" style="display: none">
        <div class="ui segments panel" >
            <div class="ui segment p-2" id="result">
                
                </div>
            </div>
        </div>
@endsection



@push('script')



<script type="text/javascript">

  $(document).ready(function() 
  {  

     var role="{{data_get($roleuser,'role_id')}}";
     var daerahuser="{{$daerahuser}}";
     var mukimuser="{{$mukimuser}}";


    if(daerahuser==''){
      var valdaerahuser=0;
    }else{
      var valdaerahuser=daerahuser;
    }

    if(mukimuser==''){
      var valmukimuser=0;
    }else{
      var valmukimuser=mukimuser;
    }


    if(role==2 || role==3){//
      //$('#parlimendun').hide();

        if(role==2){


         $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/mukim/')}}"+"/"+valdaerahuser,
            datatype : 'json',

            beforeSend: function ()
            {
               //$('div.text').html('Sila Pilih');
               
               document.getElementById("pilihmukim").innerHTML = "Sila Pilih";
               $('#selectmukim').html('');
               $('#loading').show();
               $('#result2').hide();
               

            },
            
            success: function(data){ 
             $('#loading').hide();
             $('#selectmukim').html(data);
           

           }


          });

           }


         $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/parlimenKampung/')}}"+"/"+valdaerahuser+"/"+valmukimuser,
            datatype : 'json',

            beforeSend: function ()
            {
               //$('div.text').html('Sila Pilih');
               document.getElementById("pilihparlimen").innerHTML = "Sila Pilih";
               document.getElementById("pilihdun").innerHTML = "Sila Pilih";
               $('#selectparlimen').html('');
                $('#selectdun').html('');
               $('#loading').show();
               $('#result2').hide();
               //kena reset balik parlimen
               $('#parlimen').val(0);
               $('#dun').val(0);
               if(role==2){
               $('#mukim').val(0);
               }
               $('#kampung').val(0);

               

            },
            
            success: function(data){ 

             $('#loading').hide();
             $('#selectparlimen').html(data);
           

           }


          });


    }
      

        $('#searchkampung').DataTable( {
            "searching": false,
             "lengthChange": false
        });



      var parlimen=$('#parlimen').val();

       if(parlimen==''){
        valparlimen=0;
       }else{
         valparlimen=parlimen;

       }

       var dun=$('#dun').val();

       if(dun==''){
        valdun=0;
       }else{
         valdun=dun;

       }

    if(role==2){//
      var daerah=valdaerahuser;
      var mukim=$('#mukim').val();
    }else if( role==3){
       var daerah=valdaerahuser;
       var mukim=valmukimuser;
    }else{
       var daerah=$('#daerah').val();
       var mukim=$('#mukim').val();
    }
       

       if(daerah==''){
        valdaerah=0;
       }else{
         valdaerah=daerah;

       }
      

      if(mukim==''){
        valmukim=0;
       }else{
         valmukim=mukim;

       }

        var cat_petempatan=$('#cat_petempatan').val();

      if(cat_petempatan==''){
        valcat_petempatan=0;
       }else{
         valcat_petempatan=cat_petempatan;

       }


       var kampung=$('#kampung').val();

      if(kampung==''){
        valkampung=0;
       }else{
         valkampung=kampung;

       }





        $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/kampung/')}}"+"/"+valparlimen+"/"+valdun+"/"+valdaerah+"/"+valmukim+"/"+valcat_petempatan+'/'+valkampung,
            datatype : 'json',

            beforeSend: function ()
            {
                block("tab-content");
                document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
               $('#selectkampung').html('');
               $('#loading').show();
               

            },
            
            success: function(data){ 
              unblock("tab-content");

            $('#loading').hide();


             $('#selectkampung').html(data);
           

           }


          });


   
     
  });

   function search(){


     var parlimen=$('#parlimen').val();
     var role="{{data_get($roleuser,'role_id')}}";
     var daerahuser="{{$daerahuser}}";
     var mukimuser="{{$mukimuser}}";

      if(daerahuser==''){
        var valdaerahuser=0;
      }else{
        var valdaerahuser=daerahuser;
      }

      if(mukimuser==''){
        var valmukimuser=0;
      }else{
        var valmukimuser=mukimuser;
      }

       if(parlimen==''){
        valparlimen=0;
       }else{
         valparlimen=parlimen;

       }

       var dun=$('#dun').val();

       if(dun==''){
        valdun=0;
       }else{
         valdun=dun;

       }

        if(role==2 ){//
        var daerah=valdaerahuser;
         var mukim=$('#mukim').val();

       }else if(role==3){
        var daerah=valdaerahuser;
        var mukim=valmukimuser;

       }else{
        var daerah=$('#daerah').val();
         var mukim=$('#mukim').val();

       }
      

       if(daerah==''){
        valdaerah=0;
       }else{
         valdaerah=daerah;

       }
     

      if(mukim==''){
        valmukim=0;
       }else{
         valmukim=mukim;

       }



         var cat_petempatan=$('#cat_petempatan').val();

      if(cat_petempatan==''){
        valcat_petempatan=0;
       }else{
         valcat_petempatan=cat_petempatan;

       }

       var kampung=$('#kampung').val();

      if(kampung==''){
        valkampung=0;
       }else{
         valkampung=kampung;

       }


      $.ajax({ 
            type: "GET", 
             url: "{{ URL::to('/dataentry/searchkampung/resultsearch/')}}?parlimen="+valparlimen+"&dun="+valdun+"&daerah="+valdaerah+"&mukim="+valmukim+"&catpetempatan="+valcat_petempatan+"&kampung="+valkampung,

            beforeSend: function ()
            {
              $('#loading').show();
               block("tab-content");
               document.getElementById('result2').style.display = "none";
               

            },
            
            success: function(data){ 

                $(document).ready(function() 
                {

                $('#searchkampung').DataTable( {
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

              });

             unblock("tab-content");

             $('#loading').hide();
             document.getElementById('result2').style.display = "show";
             $('#result2').show();
             document.getElementById('result').innerHTML = data;

             


           

           }


          });



   }

   function dun(id){

    var role="{{data_get($roleuser,'role_id')}}";

    var daerahuser="{{$daerahuser}}";
    var mukimuser="{{$mukimuser}}";

      if(daerahuser==''){
        var valdaerahuser=0;
      }else{
        var valdaerahuser=daerahuser;
      }

      if(mukimuser==''){
        var valmukimuser=0;
      }else{
        var valmukimuser=mukimuser;
      }
    //$('#daerahmukim').hide();

     $('#kampung').val(0);


         
       $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/dun/')}}"+"/"+id,
            datatype : 'json',

            beforeSend: function ()
            {
              
               block("tab-content");
               document.getElementById("pilihdun").innerHTML = "Sila Pilih";
               $('#selectdun').html('');
               $('#loading').show();
                $('#result2').hide();
               

            },
            
            success: function(data){ 

             unblock("tab-content");
             $('#loading').hide();
             $('#selectdun').html(data);
           

           }


          });


       var parlimen=id;


       var dun=$('#dun').val();

       if(dun==''){
        valdun=0;
       }else{
         valdun=dun;

       }


    if(role==2){//
      var daerah=valdaerahuser;
      var mukim=$('#mukim').val();
    }else if( role==3){
       var daerah=valdaerahuser;
       var mukim=valmukimuser;
    }else{
       var daerah=$('#daerah').val();
       var mukim=$('#mukim').val();
    }

       if(daerah==''){
        valdaerah=0;
       }else{
         valdaerah=daerah;

       }
      

      if(mukim==''){
        valmukim=0;
       }else{
         valmukim=mukim;

       }

      var cat_petempatan=$('#cat_petempatan').val();

      if(cat_petempatan==''){
        valcat_petempatan=0;
       }else{
         valcat_petempatan=cat_petempatan;

       }

      var kampung=$('#kampung').val();

      if(kampung==''){
        valkampung=0;
       }else{
         valkampung=kampung;

       }





        $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/kampung/')}}"+"/"+parlimen+"/"+valdun+"/"+valdaerah+"/"+valmukim+"/"+valcat_petempatan+'/'+valkampung,
            datatype : 'json',

            beforeSend: function ()
            {
                document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
               $('#selectkampung').html('');
               $('#kampung').val(0);
               //$('#loading').show();
               

            },
            
            success: function(data){ 

            // $('#loading').hide();


             $('#selectkampung').html(data);
           

           }


          });


};
   function mukim(id){

     //$('#daerahmukim').show();

    // $('#parlimendun').hide();

    
         
       $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/mukim/')}}"+"/"+id,
            datatype : 'json',

            beforeSend: function ()
            {
               //$('div.text').html('Sila Pilih');
               block("tab-content");
               document.getElementById("pilihmukim").innerHTML = "Sila Pilih";
               $('#selectmukim').html('');
               $('#loading').show();
               $('#result2').hide();
               $('#parlimen').val(0);
               $('#dun').val(0);
               $('#mukim').val(0);
               $('#kampung').val(0);
               

            },
            
            success: function(data){ 

             unblock("tab-content");
             $('#loading').hide();
             $('#selectmukim').html(data);
           

           }


          });

      var mukim=$('#mukim').val();


      if(mukim==''){
        valmukim=0;
       }else{
         valmukim=mukim;

       }




           $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/parlimenKampung/')}}"+"/"+id+"/"+valmukim,
            datatype : 'json',

            beforeSend: function ()
            {
               //$('div.text').html('Sila Pilih');
               document.getElementById("pilihparlimen").innerHTML = "Sila Pilih";
               document.getElementById("pilihdun").innerHTML = "Sila Pilih";
               $('#selectparlimen').html('');
                $('#selectdun').html('');
               $('#loading').show();
               $('#result2').hide();
               //kena reset balik parlimen
               $('#parlimen').val(0);
               $('#dun').val(0);
               $('#mukim').val(0);
               $('#kampung').val(0);

               

            },
            
            success: function(data){ 

             $('#loading').hide();
             $('#selectparlimen').html(data);
           

           }


          });


     var parlimen=$('#parlimen').val();
       if(parlimen==''){
        valparlimen=0;
       }else{
        valparlimen=parlimen;

       }

       var dun=$('#dun').val();

       if(dun==''){
        valdun=0;
       }else{
         valdun=dun;

       }
       var daerah=id;

       if(daerah==''){
        valdaerah=0;
       }else{
         valdaerah=daerah;

       }
      
        var cat_petempatan=$('#cat_petempatan').val();

      if(cat_petempatan==''){
        valcat_petempatan=0;
       }else{
         valcat_petempatan=cat_petempatan;

       }


       var kampung=$('#kampung').val();

      if(kampung==''){
        valkampung=0;
       }else{
         valkampung=kampung;

       }





        $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/kampung/')}}"+"/"+valparlimen+"/"+valdun+"/"+valdaerah+"/"+valmukim+"/"+valcat_petempatan+'/'+valkampung,
            datatype : 'json',

            beforeSend: function ()
            {
                document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
               $('#selectkampung').html('');
               $('#parlimen').val(0);
               $('#dun').val(0);
               $('#mukim').val(0);
               $('#kampung').val(0);
              // $('#loading').show();
               

            },
            
            success: function(data){ 

           // $('#loading').hide();


             $('#selectkampung').html(data);
           

           }


          });





};


function kampungdun(id){
    
       $('#kampung').val(0);

      var role="{{data_get($roleuser,'role_id')}}";
       var daerahuser="{{$daerahuser}}";
       var mukimuser="{{$mukimuser}}";

      if(daerahuser==''){
        var valdaerahuser=0;
      }else{
        var valdaerahuser=daerahuser;
      }

      if(mukimuser==''){
        var valmukimuser=0;
      }else{
        var valmukimuser=mukimuser;
      }




      if(role==2 ){//
        var daerah=valdaerahuser;
         var mukim=$('#mukim').val();

       }else if(role==3){
        var daerah=valdaerahuser;
        var mukim=valmukimuser;

       }else{
        var daerah=$('#daerah').val();
         var mukim=$('#mukim').val();

       }
       

       if(daerah==''){
        valdaerah=0;
       }else{
         valdaerah=daerah;

       }
      

      if(mukim==''){
        valmukim=0;
       }else{
         valmukim=mukim;

       }


       var parlimen=$('#parlimen').val();

       if(parlimen==''){
        valparlimen=0;
       }else{
         valparlimen=parlimen;

       }

       var dun=id;

       if(dun==''){
        valdun=0;
       }else{
         valdun=dun;

       }
      

     var cat_petempatan=$('#cat_petempatan').val();

      if(cat_petempatan==''){
        valcat_petempatan=0;
       }else{
         valcat_petempatan=cat_petempatan;

       }

      var kampung=$('#kampung').val();

      if(kampung==''){
        valkampung=0;
       }else{
         valkampung=kampung;

       }



        $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/kampung/')}}"+"/"+valparlimen+"/"+valdun+"/"+valdaerah+"/"+valmukim+"/"+valcat_petempatan+'/'+valkampung,
            datatype : 'json',

            beforeSend: function ()
            {
                block("tab-content");
                document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
               $('#selectkampung').html('');
               $('#loading').show();
               $('#result2').hide();
               $('#kampung').val(0);
               

            },
            
            success: function(data){ 
            unblock("tab-content");
            $('#loading').hide();


             $('#selectkampung').html(data);
           

           }


          });
    };

    function kampungmukim(id){
     
        $('#kampung').val(0);
        $('#parlimen').val(0);
        $('#dun').val(0);


       var parlimen=$('#parlimen').val();
       var role="{{data_get($roleuser,'role_id')}}";
       var daerahuser="{{$daerahuser}}";
       var mukimuser="{{$mukimuser}}";


      if(daerahuser==''){
        var valdaerahuser=0;
      }else{
        var valdaerahuser=daerahuser;
      }

      if(mukimuser==''){
        var valmukimuser=0;
      }else{
        var valmukimuser=mukimuser;
      }




       if(role==2 ){//
        var daerah=valdaerahuser;
         var mukim=id;

       }else if(role==3){
        var daerah=valdaerahuser;
        var mukim=valmukimuser;

       }else{
        var daerah=$('#daerah').val();
         var mukim=id;

       }
       

       if(daerah==''){
        valdaerah=0;
       }else{
         valdaerah=daerah;

       }
      

      if(mukim==''){
        valmukim=0;
       }else{
         valmukim=mukim;

       }


          $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/parlimenKampung/')}}"+"/"+valdaerah+"/"+valmukim,
            datatype : 'json',

            beforeSend: function ()
            {
               //$('div.text').html('Sila Pilih');
               block("tab-content");
               document.getElementById("pilihparlimen").innerHTML = "Sila Pilih";
               document.getElementById("pilihdun").innerHTML = "Sila Pilih";
               $('#selectparlimen').html('');
               $('#selectdun').html('');
               $('#loading').show();
               $('#result2').hide();
               //kena reset balik parlimen
               $('#parlimen').val(0);
               $('#dun').val(0);
               $('#mukim').val(0);
               $('#kampung').val(0);

               

            },
            
            success: function(data){ 

             unblock("tab-content");
             $('#loading').hide();
             $('#selectparlimen').html(data);
           

           }


          });



       if(parlimen==''){
        valparlimen=0;
       }else{
         valparlimen=parlimen;

       }

       var dun=$('#dun').val();

       if(dun==''){
        valdun=0;
       }else{
         valdun=dun;

       }


    

      var kampung=$('#kampung').val();

      if(kampung==''){
        valkampung=0;
       }else{
         valkampung=kampung;

       }


      var cat_petempatan=$('#cat_petempatan').val();

      if(cat_petempatan==''){
        valcat_petempatan=0;
       }else{
         valcat_petempatan=cat_petempatan;

       }




        $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/kampung/')}}"+"/"+valparlimen+"/"+valdun+"/"+valdaerah+"/"+valmukim+"/"+valcat_petempatan+'/'+valkampung,
            datatype : 'json',

            beforeSend: function ()
            {
                document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
               $('#selectkampung').html('');
               $('#loading').show();
               $('#result2').hide();
               $('#kampung').val(0);
               

            },
            
            success: function(data){ 

            $('#loading').hide();


             $('#selectkampung').html(data);
           

           }


          });
};

    function kampungpenempatan(id){
    

       var parlimen=$('#parlimen').val();
       $('#kampung').val(0);

        var role="{{data_get($roleuser,'role_id')}}";
        var daerahuser="{{$daerahuser}}";
        var mukimuser="{{$mukimuser}}";

      if(daerahuser==''){
        var valdaerahuser=0;
      }else{
        var valdaerahuser=daerahuser;
      }

      if(mukimuser==''){
        var valmukimuser=0;
      }else{
        var valmukimuser=mukimuser;
      }


       if(parlimen==''){
        valparlimen=0;
       }else{
         valparlimen=parlimen;

       }

       var dun=$('#dun').val();

       if(dun==''){
        valdun=0;
       }else{
         valdun=dun;

       }
       
         if(role==2 ){//
        var daerah=valdaerahuser;
         var mukim=$('#mukim').val();

       }else if(role==3){
        var daerah=valdaerahuser;
        var mukim=valmukimuser;

       }else{
        var daerah=$('#daerah').val();
         var mukim=$('#mukim').val();

       }
      

       if(daerah==''){
        valdaerah=0;
       }else{
         valdaerah=daerah;

       }
     

      if(mukim==''){
        valmukim=0;
       }else{
         valmukim=mukim;

       }
       var cat_petempatan=id;

      if(cat_petempatan==''){
        valcat_petempatan=0;
       }else{
         valcat_petempatan=cat_petempatan;

       }

     var kampung=$('#kampung').val();

      if(kampung==''){
        valkampung=0;
       }else{
         valkampung=kampung;

       }

        $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('dataentry/kampung/')}}"+"/"+valparlimen+"/"+valdun+"/"+valdaerah+"/"+valmukim+"/"+valcat_petempatan+'/'+valkampung,
            datatype : 'json',

            beforeSend: function ()
            {
                block("tab-content");
                document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
               $('#selectkampung').html('');
               $('#loading').show();
               $('#result2').hide();
               $('#kampung').val(0);

            },
            
            success: function(data){ 

             unblock("tab-content");
             $('#loading').hide();
             $('#selectkampung').html(data);
           

           }


          });
};

</script>

@endpush
