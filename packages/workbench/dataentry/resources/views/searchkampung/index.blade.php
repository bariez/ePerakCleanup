@extends('laravolt::layout.app2')

@section('content')



<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0" >
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs">
          Carian Kampung
        </h3>
    </div> 
</div>
 <div class="tab-content mt-5">
    <div class="ui container-fluid content__body p-3">
        <div class="ui segments panel">
            <div class="ui segment p-3">
                <form class="ui form">
                       <div class="two fields">
                  @if(data_get($roleuser,'role_id')==2)
                       <div class="field">
                          <label>Daerah</label>
                             <input type="text" name="daerah" id="daerah" readonly="readonly" value="{{data_get($daerah,'NamaDaerah')}}">
                     </div>
                       <div class="field">
                          <label>Mukim</label>
                               <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="mukim" id="mukim" value="" >
                                <i class="dropdown icon"></i>
                                <div class="default text" id="pilihmukim">Sila Pilih</div>
                                <div class="menu" id="selectmukim">
                                 
                                </div>
                            </div>
                     </div>
                     @elseif(data_get($roleuser,'role_id')==3)
                      <div class="field">
                          <label>Daerah</label>
                             <input type="text" name="daerah" id="daerah" readonly="readonly" value="{{data_get($daerah,'NamaDaerah')}}">
                     </div>
                      <div class="field">
                          <label>Mukim</label>
                               <input type="text" name="mukim" id="mukim" readonly="readonly" value="{{data_get($mukim,'NamaMukim')}}">
                     </div>

                     @else
                     <div class="field">
                          <label>Daerah</label>
                              <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="daerah" id="daerah" value="" >
                                <i class="dropdown icon"></i>
                                <div class="default text">Sila Pilih</div>
                                <div class="menu" >
                                  <div class="item" data-value=""  onclick="mukim(0)">Sila Pilih</div>
                                  @foreach($daerah as $key => $value)
                                   <div class="item" data-value="{{$value->id}}" onclick="mukim({{$value->id}})">{{$value->NamaDaerah}}</div>
                                    @endforeach
                                </div>
                            </div>
                     </div>
                      <div class="field">
                          <label>Mukim</label>
                               <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="mukim" id="mukim" value="" >
                                <i class="dropdown icon"></i>
                                <div class="default text" id="pilihmukim">Sila Pilih</div>
                                <div class="menu" id="selectmukim">
                                 
                                </div>
                            </div>
                     </div>
                     @endif
                  
                    
                 </div>
               <div class="two fields">
                     <div class="field">
                          <label>Parlimen</label>
                              <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="parlimen" id="parlimen" value="" >
                                <i class="dropdown icon"></i>
                                <div class="default text" id="pilihparlimen">Sila Pilih</div>
                                <div class="menu" id="selectparlimen">
                                </div>
                            </div>
                     </div>
                     <div class="field">
                          <label>Dun</label>
                               <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="dun" id="dun" value="" >
                                <i class="dropdown icon"></i>
                                <div class="default text" id="pilihdun">Sila Pilih</div>
                                <div class="menu" id="selectdun">
                                </div>
                               
                            </div>
                     </div>
                 </div>
            

                 <div class="two fields">
                     <div class="field">
                          <label>Kategori Petempatan</label>
                              <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="cat_petempatan" id="cat_petempatan" value="" >
                                <i class="dropdown icon"></i>
                                <div class="default text">Sila Pilih</div>
                                <div class="menu"  id="pilihcat">
                                  <div class="item" data-value="" onclick="kampungpenempatan(0)">Sila Pilih</div>
                                  @foreach($catpenempatan as $key => $value)
                                   <div class="item" data-value="{{$value->id}}"  onclick="kampungpenempatan({{$value->id}})">{{$value->description}}</div>
                                    @endforeach
                    </div>
                  </div>
                     </div>
                     <div class="field">
                          <label>Nama Kampung</label>
                               <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="kampung" id="kampung" value="" >
                                <i class="dropdown icon"></i>
                                <div class="default text" id="pilihkampung">Sila Pilih</div>
                                <div class="menu" id="selectkampung">
                                  
                            </div>
                            </div>
                     </div>
                 </div>
           

               </form>  

               
         <div class="ui buttons right floated">
            <a class="ui button" href="{!! URL::to('dataentry/searchkampung/index') !!}">Set Semula</a>
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

<!-- <div class="ui container-fluid content__body p-3" id="loading" style="display: none;">
        <div class="ui segments panel">
            <div class="ui segment p-3">
                  <div class="ui blue sliding indeterminate progress" >
                        <div class="bar">
                            <div class="progress">Sila Tunggu Sebentar</div>
                        </div>
                
                </div>
            </div>
        </div>
  
    </div> -->
        <div class="ui container-fluid content__body p-3" id="result2" style="display: none">
        <div class="ui segments panel" >
            <div class="ui segment p-3" id="result">
                
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
