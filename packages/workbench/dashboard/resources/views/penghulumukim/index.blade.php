@extends('laravolt::layout.app2')

@section('content')

@section('content')
<style type="text/css">
.graph_container{
  display:block;
  width:600px;
}
  .wrapper {
      height: 200px;
      width: 400px;
  }
</style>

<div id="actionbar" class="ui two column grid content__body p-3" >
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs">
          DASHBOARD PENGHULU MUKIM - {{data_get($mukim,'NamaMukim')}}
        </h3>
    </div>

</div>
<br>

<br>
<div class="tab-content p-3 raised">
<div class="ui styled fluid accordion">
  <div class="title">
    <i class="dropdown icon"></i>
    CARIAN STATISTIK
  </div>
    <div class="content">
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

                 <div class="ui divider section"></div>
                     <div class="ui buttons right floated">
                        <a class="ui button" href="{!! URL::to('dashboard/admin') !!}">Set Semula</a>
                        <div class="or" data-text="@"></div>
                        <button class="ui button primary" onclick="search()" id="addbutton">
                                      Carian
                        </button>
                    </div>
                    <br/><br/><br/>

        </div>
      </div>
    </div>

<!--     <div class="ui container-fluid content__body p-3" id="loading" style="display: none;">
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
    <br>
<div class="ui container-fluid content__body" id="result3" style="display: none; padding: 0rem 2rem">
    <div id="resultcountpetempatan">
    </div>
</div>


<div class="ui container-fluid content__body p-3" id="result4">

      <div class="ui two stackable cards raised">
        <div class="card">
          <div class="ui active loader" id="loader1"></div>
          <div class="content" id="resultchart1" style="display: none">

          </div>

        </div>
        <div class="card">
          <div class="ui active loader" id="loader2"></div>
          <div class="content" id="resultchart2" style="display: none">
          </div>

        </div>

      </div>

      <div class="ui two stackable cards raised">
        <div class="card">
          <div class="ui active loader" id="loader3"></div>
          <div class="content" id="resultchart3" style="display: none">
          </div>


        </div>
        <div class="card">
          <div class="ui active loader" id="loader4"></div>
          <div class="content" id="resultchart4" style="display: none">

          </div>

        </div>

      </div>



      <div class="ui two stackable cards raised">
        <div class="card">
          <div class="ui active loader" id="loader5"></div>
          <div class="content" id="resultchart5" style="display: none">
          </div>


        </div>
        <div class="card">
          <div class="ui active loader" id="loader6"></div>
          <div class="content" id="resultchart6" style="display: none">

          </div>

        </div>

      </div>



      <div class="ui two stackable cards raised">
        <div class="card">
          <div class="ui active loader" id="loader7"></div>
          <div class="content" id="resultchart7" style="display: none">
          </div>


        </div>
        <div class="card">
          <div class="ui active loader" id="loader8"></div>
          <div class="content" id="resultchart8" style="display: none">

          </div>

        </div>

      </div>
    </div>
  </div>
@endsection


@push('script')

<script type="text/javascript">

  $(document).ready(function()
  {

    $('.ui.accordion')
      .accordion()
    ;


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
               block("tab-content");
               document.getElementById("pilihmukim").innerHTML = "Sila Pilih";
               $('#selectmukim').html('');
               $('#loading').show();
               $('#result2').hide();


            },

            success: function(data){

             unblock("tab-content");
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
               if(role==2){
               $('#mukim').val(0);
               }
               $('#kampung').val(0);



            },

            success: function(data){

             unblock("tab-content");
             $('#loading').hide();
             $('#selectparlimen').html(data);


           }


          });


    }

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
               $('#result2').hide();
               $('#kampung').val(0);


            },

            success: function(data){

             unblock("tab-content");
             $('#loading').hide();
             $('#selectkampung').html(data);


           }


          });


    search();

  });

function search(){


        valparlimen=0;
        valdun=0;

       var daerah="{{$daerahuser}}";

       if(daerah==''){
        valdaerah=0;
       }else{
         valdaerah=daerah;

       }
       var mukim="{{$mukimuser}}";

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
             url: "{{ URL::to('/dashboard/countpetempatan/')}}?parlimen="+valparlimen+"&dun="+valdun+"&daerah="+valdaerah+"&mukim="+valmukim+"&catpetempatan="+valcat_petempatan+"&kampung="+valkampung,

            beforeSend: function ()
            {
              block("tab-content");
              $('#loading').show();

               document.getElementById('result3').style.display = "none";


            },

            success: function(data){

             unblock("tab-content");
             $('#loading').hide();
             document.getElementById('result3').style.display = "show";
             $('#result3').show();
             document.getElementById('resultcountpetempatan').innerHTML = data;

           }


          });


         $.ajax({
            type: "GET",
             url: "{{ URL::to('/dashboard/countdata/')}}?parlimen="+valparlimen+"&dun="+valdun+"&daerah="+valdaerah+"&mukim="+valmukim+"&catpetempatan="+valcat_petempatan+"&kampung="+valkampung,

            beforeSend: function ()
            {


            },

            success: function(data){

                if(data==0){
                  $('#result4').hide();
                }else{

                  $('#result4').show();
                }
           }


          });


//-------------------------------------------getchart1----------------------------//
      $.ajax({
            type: "GET",
             url: "{{ URL::to('/dashboard/chart1/')}}?parlimen="+valparlimen+"&dun="+valdun+"&daerah="+valdaerah+"&mukim="+valmukim+"&catpetempatan="+valcat_petempatan+"&kampung="+valkampung,

            beforeSend: function ()
            {

              $('#loader1').show();
              $('#result4').show();



               document.getElementById('resultchart1').style.display = "none";



            },

            success: function(data){

              var arr_data="";
              var arr_status="";
              var lengthdata="";

              $('#result4').show();

             $('#loader1').hide();

             //document.getElementById('result3').style.display = "show";
             $('#resultchart1').show();
             //document.getElementById('resultchart1').innerHTML = data;



              arr_data = data.arr_data;
              arr_status = data.arr_status;
              lengthdata= data.arr_status.length;

              $("#resultchart1").html('<canvas id="myBarChart" height="300" width="580"></canvas></div>');
               getBarStatusMilik(arr_data,arr_status,lengthdata);
         }//end sucsess chart1


          });//end ajax chart1

//-------------------------------------------end getchart1-------------------------//
//-------------------------------------------start getchart2-----------------//
     $.ajax({
            type: "GET",
             url: "{{ URL::to('/dashboard/chart2/')}}?parlimen="+valparlimen+"&dun="+valdun+"&daerah="+valdaerah+"&mukim="+valmukim+"&catpetempatan="+valcat_petempatan+"&kampung="+valkampung,

            beforeSend: function ()
            {
              $('#loader2').show();

               document.getElementById('resultchart2').style.display = "none";


            },

            success: function(data){

              var arr_data="";
              var arr_status="";
              var lengthdata="";

             $('#loader2').hide();
             //document.getElementById('result3').style.display = "show";
             $('#resultchart2').show();
             //document.getElementById('resultchart1').innerHTML = data;



              arr_jenis = data.arr_jenis;
              arr_data = data.arr_data;
              lengthdata= data.arr_jenis.length;
              jumjenisrumah=data.jumjenisrumah;

              $("#resultchart2").html('<canvas id="myPieChart" height="300" width="580"></canvas></div>');
               getPieJenisRumah(arr_jenis,arr_data,lengthdata,jumjenisrumah);
         }//end sucsess chart1


          });//end ajax chart1
//--------------------------------------------end getchart2-------------------//
//-------------------------------------------start getchart3----------------------//
     $.ajax({
            type: "GET",
             url: "{{ URL::to('/dashboard/chart3/')}}?parlimen="+valparlimen+"&dun="+valdun+"&daerah="+valdaerah+"&mukim="+valmukim+"&catpetempatan="+valcat_petempatan+"&kampung="+valkampung,

            beforeSend: function ()
            {
              $('#loader3').show();

               document.getElementById('resultchart3').style.display = "none";


            },

            success: function(data){

              var arr_data="";
              var arr_status="";
              var lengthdata="";

             $('#loader3').hide();
             //document.getElementById('result3').style.display = "show";
             $('#resultchart3').show();
             //document.getElementById('resultchart1').innerHTML = data;



              arr_jenis = data.arr_jenis;
              arr_data = data.arr_data;
              lengthdata= data.arr_jenis.length;
              jumkemudahan=data.jumkemudahan;

              $("#resultchart3").html('<canvas id="myPieKemudahan" height="350" width="580"></canvas></div>');
               getPieKemudahan(arr_jenis,arr_data,lengthdata,jumkemudahan);
         }//end sucsess chart1


          });//end ajax chart1
//--------------------------------------------end getchart3-------------------//
//-------------------------------------------start getchart4-----------------//
     $.ajax({
            type: "GET",
             url: "{{ URL::to('/dashboard/chart4/')}}?parlimen="+valparlimen+"&dun="+valdun+"&daerah="+valdaerah+"&mukim="+valmukim+"&catpetempatan="+valcat_petempatan+"&kampung="+valkampung,

            beforeSend: function ()
            {
              $('#loader4').show();

               document.getElementById('resultchart4').style.display = "none";


            },

            success: function(data){

              var arr_data="";
              var arr_status="";
              var lengthdata="";
              var arr_ya="";
              var arr_tidak="";

             $('#loader4').hide();
             //document.getElementById('result3').style.display = "show";
             $('#resultchart4').show();
             //document.getElementById('resultchart1').innerHTML = data;



              arr_jenis = data.arr_status;
              arr_data = data.arr_data;
              lengthdata= data.arr_status.length;
              arr_label=data.arr_label;
              arr_ya=data.arr_ya;
              arr_tidak=data.arr_tidak;


              $("#resultchart4").html('<canvas id="myBarChart2" height="330" width="580"></canvas></div>');
               getBarKemudahan2(arr_jenis,arr_data,lengthdata,arr_label,arr_ya,arr_tidak);
         }//end sucsess chart1


          });//end ajax chart1
//--------------------------------------------end getchart4-------------------//
//-------------------------------------------start getchart5-----------------//
     $.ajax({
            type: "GET",
             url: "{{ URL::to('/dashboard/chart5/')}}?parlimen="+valparlimen+"&dun="+valdun+"&daerah="+valdaerah+"&mukim="+valmukim+"&catpetempatan="+valcat_petempatan+"&kampung="+valkampung,

            beforeSend: function ()
            {
              $('#loader5').show();

               document.getElementById('resultchart5').style.display = "none";


            },

            success: function(data){

              var arr_data="";
              var arr_status="";
              var lengthdata="";

             $('#loader5').hide();
             //document.getElementById('result3').style.display = "show";
             $('#resultchart5').show();
             //document.getElementById('resultchart1').innerHTML = data;



              arr_jenis = data.arr_jenis;
              arr_data = data.arr_data;
              lengthdata= data.arr_jenis.length;
              jumjeniskerja=data.jumjeniskerja;

              $("#resultchart5").html('<canvas id="myPieKerja" height="350" width="580"></canvas></div>');
               getPieKerja(arr_jenis,arr_data,lengthdata,jumjeniskerja);
         }//end sucsess chart5


          });//end ajax chart5
//--------------------------------------------end getchart5-------------------//
//-------------------------------------------start getchart6-----------------//
     $.ajax({
            type: "GET",
             url: "{{ URL::to('/dashboard/chart6/')}}?parlimen="+valparlimen+"&dun="+valdun+"&daerah="+valdaerah+"&mukim="+valmukim+"&catpetempatan="+valcat_petempatan+"&kampung="+valkampung,

            beforeSend: function ()
            {
              $('#loader6').show();

               document.getElementById('resultchart6').style.display = "none";


            },

            success: function(data){

              var arr_data="";
              var arr_status="";
              var lengthdata="";

             $('#loader6').hide();
             //document.getElementById('result3').style.display = "show";
             $('#resultchart6').show();
             //document.getElementById('resultchart1').innerHTML = data;



              arr_jenis = data.arr_jenis;
              arr_data = data.arr_data;
              lengthdata= data.arr_jenis.length;
              jumjeniskawin=data.jumjeniskawin;

              $("#resultchart6").html('<canvas id="myPieKahwin" height="350" width="580"></canvas>');
               getPieKahwin(arr_jenis,arr_data,lengthdata,jumjeniskawin);
         }//end sucsess chart6


          });//end ajax chart6
//--------------------------------------------end getchart6-------------------//

//-------------------------------------------getchart7------------------------//
      $.ajax({
            type: "GET",
             url: "{{ URL::to('/dashboard/chart7/')}}?parlimen="+valparlimen+"&dun="+valdun+"&daerah="+valdaerah+"&mukim="+valmukim+"&catpetempatan="+valcat_petempatan+"&kampung="+valkampung,

            beforeSend: function ()
            {

              $('#loader7').show();

               document.getElementById('resultchart7').style.display = "none";

            },

            success: function(data){

              var arr_data="";
              var arr_status="";
              var lengthdata="";

             $('#loader7').hide();

             //document.getElementById('result3').style.display = "show";
             $('#resultchart7').show();
             //document.getElementById('resultchart1').innerHTML = data;



              arr_data = data.arr_data;
              arr_status = data.arr_status;
              lengthdata= data.arr_status.length;

              $("#resultchart7").html('<canvas id="myBarUmur" height="350" width="580"></canvas></div>');
               getBarUmur(arr_data,arr_status,lengthdata);
         }//end sucsess chart1


          });//end ajax chart7

//-------------------------------------------end getchart7-----------------//
//-------------------------------------------getchart8-----------------------//
      $.ajax({
            type: "GET",
             url: "{{ URL::to('/dashboard/chart8/')}}?parlimen="+valparlimen+"&dun="+valdun+"&daerah="+valdaerah+"&mukim="+valmukim+"&catpetempatan="+valcat_petempatan+"&kampung="+valkampung,

            beforeSend: function ()
            {

              $('#loader8').show();

               document.getElementById('resultchart8').style.display = "none";

            },

            success: function(data){

              var arr_data="";
              var arr_status="";
              var lengthdata="";

             $('#loader8').hide();

             //document.getElementById('result3').style.display = "show";
             $('#resultchart8').show();
             //document.getElementById('resultchart1').innerHTML = data;



              arr_data = data.arr_data;
              arr_status = data.arr_status;
              lengthdata= data.arr_status.length;

              $("#resultchart8").html('<canvas id="myBarPendapatan" height="350" width="580"></canvas></div>');
               getBarPendapatan(arr_data,arr_status,lengthdata);
         }//end sucsess chart8


          });//end ajax chart8

//-------------------------------------------end getchar8----------------//

   }

   function getBarStatusMilik(arr_data,arr_status,lengthdata){

     var ctx = $("#myBarChart");


      function getRandomColorEachDatamyBarChart(count) {
            var data =[];
                      var arr_color = [
                            ["#16747E", "#97AB38"
                            ],
                          ];

     var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
            for (var i = 0; i < count; i++) {
               // data.push(getRandomColor());
                data.push(colors[i]);
            }

            return data;
            }

       var chartOptions = {
                   tooltips: {
                              callbacks: {
                                  label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
                                  title: () => null,
                              }
                          },
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                title: {
                display: true,
                text: 'STATUS PEMILIKAN RUMAH',
                padding: {
                    top: 10,
                    bottom: 30
                      },

                  },
                legend: {
                    display: false,
                },

            }
      };

      if(lengthdata==0){

         var chartData='';

      }else{

       var chartData = {
                   labels: arr_status,
                  datasets: [{
                      label: 'STATUS PEMILIKAN RUMAH',
                      data: arr_data,
                      backgroundColor: getRandomColorEachDatamyBarChart(lengthdata),
                      borderColor: "transparent",

                  }]
        };

      }



         var config = {
         type: "bar",

         // Chart Options
         options: chartOptions,


         data: chartData
      };

       var barChart = new Chart(ctx, config);

   }


  function getPieJenisRumah(arr_jenis,arr_data,lengthdata,jumjenisrumah){

     var ctxpie = $("#myPieChart");

         function getRandomColorEachData(count) {
            var data =[];
                      var arr_color = [
                              ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                              ],
                          ];

     var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
            for (var i = 0; i < count; i++) {
               // data.push(getRandomColor());
                data.push(colors[i]);
            }

            return data;
            }


       var chartOptionspie = {

                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                title: {
                display: true,
                text:  'JENIS RUMAH',
                padding: {
                    top: 10,
                    bottom: 30
                      },

                  },
                  //  datalabels: {
                  // color: '#fff',
                  //  display: 'auto',
                  //   },
                  datalabels: {

                      formatter: (value, ctxpie) => {
                        // const datapoints = ctxpie.chart.data.datasets[0].data
                        //  const total = jumjenisrumah
                        // const percentage = value / total * 100
                        // return percentage.toFixed(2) + "%";

                         let sum = 0;
                          let dataArr = ctxpie.chart.data.datasets[0].data;
                          dataArr.map(data => {
                            sum += Number(data);
                          });
                          let percentage =  value / sum * 100;
                        return percentage.toFixed(2) + "%";
                      },
                          color: '#fff',
                          display: 'auto',
                    }

            },


      };

         var chartDatapie = {
                       labels:arr_jenis,
                      datasets: [{
                          label: 'JENIS RUMAH',
                          data: arr_data,
                          backgroundColor: getRandomColorEachData(lengthdata),
                           borderColor:'#ffff',
                          tooltip: {
                              callbacks: {
                                  label: function(context) {


                                      let label = context.label;
                                      let value = context.raw;
                                       let valueformat = context.formattedValue;

                                      if (!label)
                                          label = 'Unknown'

                                      let sum = 0;
                                      let dataArr = context.chart.data.datasets[0].data;
                                      dataArr.map(data => {
                                          sum += Number(data);
                                      });

                                      let percentage =  value / sum * 100;
                                       return label + ": " + valueformat;
                                  }
                              }
                           }

                      }]
        };

         var configpie = {
        type: 'doughnut',

         // Chart Options
         options: chartOptionspie,

         data: chartDatapie,
          plugins: [ChartDataLabels],
      };

       var pieChart = new Chart(ctxpie, configpie);

   }

function getPieKemudahan(arr_jenis,arr_data,lengthdata,jumkemudahan)
{

          var ctxpie = $("#myPieKemudahan");

        function getRandomColorEachData(count) {
            var data =[];
                      var arr_color = [
                               ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                               ],
                          ];

     var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
            for (var i = 0; i < count; i++) {
               // data.push(getRandomColor());
                data.push(colors[i]);
            }

            return data;
            }

       var chartOptionspie = {

                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                title: {
                display: true,
                text: 'KEMUDAHAN AWAM & INFRASTRUKTUR',
                padding: {
                    top: 10,
                    bottom: 30
                      },

                  },
                  //    datalabels: {
                  // color: '#fff',
                  //  display: 'auto',
                  //   },
                  datalabels: {
                      formatter: (value, ctxpie) => {
                        // const datapoints = ctxpie.chart.data.datasets[0].data
                        //  const total = jumkemudahan
                        // const percentage = value / total * 100
                        // return percentage.toFixed(2) + "%";

                        let sum = 0;
                        let dataArr = ctxpie.chart.data.datasets[0].data;
                        dataArr.map(data => {
                          sum += Number(data);
                        });
                        let percentage =  value / sum * 100;
                        return percentage.toFixed(2) + "%";
                      },
                          color: '#fff',
                          display: 'auto',
                    }

            },


      };

         var chartDatapie = {
                       labels:arr_jenis,
                      datasets: [{
                          label: 'KEMUDAHAN AWAM & INFRASTRUKTUR',
                          data: arr_data,
                          backgroundColor: getRandomColorEachData(lengthdata),
                          borderColor:'#ffff',
                              tooltip: {
                              callbacks: {
                                  label: function(context) {
                                      let label = context.label;
                                      let valueformat = context.formattedValue;
                                      let value = context.raw;


                                      if (!label)
                                          label = 'Unknown'

                                      let sum = 0;
                                      let dataArr = context.chart.data.datasets[0].data;
                                      dataArr.map(data => {
                                          sum += Number(data);
                                      });

                                       let percentage =  value / sum * 100;
                                    return label + ": " + valueformat;
                                  }
                              }
                           }

                      }]
        };

         var configpie = {
         type: 'doughnut',

         // Chart Options
         options: chartOptionspie,

         data: chartDatapie,
          plugins: [ChartDataLabels],
      };

       var pieChart = new Chart(ctxpie, configpie);
   }

  function getBarKemudahan2(arr_jenis,arr_data,lengthdata,arr_label,arr_ya,arr_tidak)

   {

    var ctxBarChart = $("#myBarChart2");

     function getRandomColor() {
                var letters = '0123456789ABCDEF'.split('');
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }

      function getRandomColorEachData(count) {
            var data =[];
            for (var i = 0; i < count; i++) {
                data.push(getRandomColor());
            }
            return data;
            }

        if(lengthdata==0){
           var optionsBar = {
                plugins: {
                title: {
                display: true,
                text:'KEMUDAHAN ASAS RUMAH',
                padding: {
                    top: 10,
                    bottom: 30
                      },

                  },
                legend: {
                    display: true,
                },

            }

           };


           var barChartData='';

          }else{

            var optionsBar = {
               scales: {
                      x: {
                          stacked: true
                      },
                      y: {
                          stacked: true
                      }
                  },
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                title: {
                display: true,
                text: 'KEMUDAHAN ASAS RUMAH',
                padding: {
                    top: 10,
                    bottom: 30
                      },

                  },
                legend: {
                    display: true,
                },

            }
      };

      var barChartData = {
        labels: arr_jenis,
        datasets: [{
            label: "Ya",
            //backgroundColor: getRandomColorEachData(1),
            backgroundColor: "rgb(22, 116, 126)",
            hoverBackgroundColor: "rgb(22, 116, 126)",
            data: arr_ya
          },
          {
            label: "Tidak",
            //backgroundColor: getRandomColorEachData(1),
            backgroundColor: "rgb(177, 182, 42)",
            hoverBackgroundColor:"rgb(177, 182, 42)",
            data: arr_tidak
          }
        ]
      };


          }



       var config = {
         type: "bar",

         // Chart Options
         options: optionsBar,

         data: barChartData
      };

       var priceBarChart = new Chart(ctxBarChart, config);




   }
function getPieKerja(arr_jenis,arr_data,lengthdata,jumjeniskerja){

     var ctxpie = $("#myPieKerja");

        function getRandomColorEachData(count) {
            var data =[];
                      var arr_color = [
                         ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                         ],
                          ];

     var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
            for (var i = 0; i < count; i++) {
               // data.push(getRandomColor());
                data.push(colors[i]);
            }

            return data;
            }

       var chartOptionspie = {

                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                title: {
                display: true,
                text: 'STATUS PEKERJAAN',
                padding: {
                    top: 10,
                    bottom: 30
                      },

                  },
                  //  datalabels: {
                  // color: '#fff',
                  // display: 'auto',
                  //   },
                    legend: {
                      display: true,
                      position: "bottom"
                    },

                  datalabels: {
                     //color: 'black',
                      formatter: (value, ctxpie) => {
                        // const datapoints = ctxpie.chart.data.datasets[0].data
                        //  const total = jumjeniskerja
                        // const percentage = value / total * 100
                        // return percentage.toFixed(2) + "%";
                        let sum = 0;
                        let dataArr = ctxpie.chart.data.datasets[0].data
                        dataArr.map(data => {
                          sum += Number(data);
                        });


                      let percentage =  value / sum * 100;
                      return percentage.toFixed(2) + "%";
                      },
                          color: '#fff',
                          display: 'auto',
                    }

            },

      };

      if(lengthdata==0){
        var chartDatapie=''

      }else{

             var chartDatapie = {
               labels:arr_jenis,
                datasets: [{
                label: 'STATUS PEKERJAAN',
                data: arr_data,
                 backgroundColor: getRandomColorEachData(lengthdata),
                borderColor:'#ffff',
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label;
                            let valueformat = context.formattedValue;
                            let value = context.raw;

                            if (!label)
                                label = 'Unknown'

                            let sum = 0;
                            let dataArr = context.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += Number(data);
                            });

                             let percentage =  value / sum * 100;
                            return label + ": " + valueformat;
                        }
                    }
                }
            }]
        };


      }


         var configpie = {
         type: 'pie',

         // Chart Options
         options: chartOptionspie,

         data: chartDatapie,
          plugins: [ChartDataLabels],
      };

       var pieChart = new Chart(ctxpie, configpie);

   }
   function getPieKahwin(arr_jenis,arr_data,lengthdata,jumjeniskerja){

     var ctxpie = $("#myPieKahwin");

        function getRandomColorEachData(count) {
            var data =[];
                      var arr_color = [
                     ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                      ],
                          ];

     var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
            for (var i = 0; i < count; i++) {
               // data.push(getRandomColor());
                data.push(colors[i]);
            }

            return data;
            }
       var chartOptionspie = {

                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                title: {
                display: true,
                text: 'TARAF PERKAHWINAN',
                padding: {
                    top: 10,
                    bottom: 30
                      },

                  },
                  //  datalabels: {
                  // color: '#fff',
                  //  display: 'auto',
                  //   },
                    legend: {
                      display: true,
                      position: "bottom"
                    },

                  datalabels: {
                     //color: 'black',
                      formatter: (value, ctxpie) => {
                        // const datapoints = ctxpie.chart.data.datasets[0].data
                        //  const total = jumjeniskerja
                        // const percentage = value / total * 100
                        // return percentage.toFixed(2) + "%";

                        let sum = 0;
                        let dataArr = ctxpie.chart.data.datasets[0].data;
                        dataArr.map(data => {
                          sum += Number(data);
                        });

                         let percentage =  value / sum * 100;
                      return percentage.toFixed(2) + "%";
                      },
                          color: '#fff',
                          display: 'auto',
                    }

            },

      };

         var chartDatapie = {
               labels:arr_jenis,
                datasets: [{
                label: 'TARAF PERKAHWINAN',
                data: arr_data,
                 backgroundColor: getRandomColorEachData(lengthdata),
                 borderColor:'#ffff',
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label;
                            let valueformat = context.formattedValue;
                            let value = context.raw;

                            if (!label)
                                label = 'Unknown'

                            let sum = 0;
                            let dataArr = context.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += Number(data);
                            });

                            let percentage =  value / sum * 100;
                            return label + ": " + valueformat;
                        }
                    }
                }
            }]
        };

         var configpie = {
         type: 'pie',

         // Chart Options
         options: chartOptionspie,

         data: chartDatapie,
          plugins: [ChartDataLabels],
      };

       var pieChart = new Chart(ctxpie, configpie);

   }

   function getBarUmur(arr_data,arr_status,lengthdata){


     var ctx = $("#myBarUmur");

         function getRandomColorEachData(count) {
            var data =[];
                      var arr_color = [
                                ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                                 ],
                          ];

     var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
            for (var i = 0; i < count; i++) {
               // data.push(getRandomColor());
                data.push(colors[i]);
            }

            return data;
            }
       var chartOptions = {
                   tooltips: {
                              callbacks: {
                                  label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
                                  title: () => null,
                              }
                          },
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                title: {
                display: true,
                text:'UMUR PENDUDUK',
                padding: {
                    top: 10,
                    bottom: 30
                      },

                  },
                legend: {
                    display: false,
                },

            }
      };

      if(lengthdata==0){
        var chartData=''

      }else{
         var chartData = {
                       labels: arr_status,
                      datasets: [{
                          label: 'UMUR PENDUDUK',
                          data: arr_data,
                          backgroundColor: getRandomColorEachData(lengthdata),
                          borderColor: "transparent",

                      }]
        };

      }


         var config = {
         type: "bar",

         // Chart Options
         options: chartOptions,

         data: chartData
      };

       var barChart = new Chart(ctx, config);

   }

   function getBarPendapatan(arr_data,arr_status,lengthdata){

     var ctx = $("#myBarPendapatan");

        function getRandomColorEachData(count) {
            var data =[];
                      var arr_color = [
                                 ["#16747E", "#307F70", "#4A8A62", "#649554", "#7EA046", "#97AB38", "#B1B62A", "#B1B62A",
                                  ],
                          ];

     var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
            for (var i = 0; i < count; i++) {
               // data.push(getRandomColor());
                data.push(colors[i]);
            }

            return data;
            }

       var chartOptions = {
                   tooltips: {
                              callbacks: {
                                  label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
                                  title: () => null,
                              }
                          },
                //indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                title: {
                display: true,
                text: 'PENDAPATAN PENDUDUK',
                padding: {
                    top: 10,
                    bottom: 30
                      },

                  },
                legend: {
                    display: false,
                },

            }
      };

     if(lengthdata==0){
      var chartData='';

     }else{

      var chartData = {
                           labels: arr_status,
                          datasets: [{
                              label:'PENDAPATAN PENDUDUK',
                              data: arr_data,
                              backgroundColor: getRandomColorEachData(lengthdata),
                              borderColor: "transparent",

                          }]
            };


     }

         var config = {
         type: "bar",

         // Chart Options
         options: chartOptions,

         data: chartData
      };

       var barChart = new Chart(ctx, config);

   }




// function getPieKahwin(arr_jenis,arr_data,lengthdata,jumjeniskerja){

//     var ctx = document.getElementById("myPieKahwin");

//       function getRandomColor() {
//                 var letters = '0123456789ABCDEF'.split('');
//                 var color = '#';
//                 for (var i = 0; i < 6; i++) {
//                     color += letters[Math.floor(Math.random() * 16)];
//                 }
//                 return color;
//             }

//       function getRandomColorEachData(count) {
//             var data =[];
//             for (var i = 0; i < count; i++) {
//                 data.push(getRandomColor());
//             }
//             return data;
//             }

//   var data = [61, 10, 28];
//   const getSuitableY = (y, yArray = [], direction) => {
//     let result = y;
//     yArray.forEach((existedY) => {
//       if (existedY - 14 < result && existedY + 14 > result) {
//         if (direction === "right") {
//           result = existedY + 14;
//         } else {
//           result = existedY - 14;
//         }
//       }
//     });
//     return result;
//   };

//   const getOriginPoints = (source, center, l) => {
//     // console.log(source, center, l)

//     let a = {x: 0, y: 0};
//     var dx = (center.x - source.x) / l
//     var dy = (center.y - source.y) / l
//     a.x = center.x + l * dx
//     a.y = center.y + l * dy
//     return a
//   };
//   const options = {
//     plugins: {
//       legend: {
//         display: true,
//         position: "bottom"
//       },
//     },

//     layout: {
//       padding: {
//         top: 30,
//         left: 0,
//         right: 0,
//         bottom: 30
//       }
//     },
//      datalabels: {
//                   color: '#fff',
//                     }
//   };
//   const plugins = [
//     {
//       afterDraw: (chart) => {
//         const ctx = chart.ctx;
//         ctx.save();
//         ctx.font = "10px 'Averta Std CY'";
//         const leftLabelCoordinates = [];
//         const rightLabelCoordinates = [];
//         const chartCenterPoint = {
//           x:
//             (chart.chartArea.right - chart.chartArea.left) / 2 +
//             chart.chartArea.left,
//           y:
//             (chart.chartArea.bottom - chart.chartArea.top) / 2 +
//             chart.chartArea.top
//         };
//         chart.config.data.labels.forEach((label, i) => {
//           const meta = chart.getDatasetMeta(0);
//           const arc = meta.data[i];
//           const dataset = chart.config.data.datasets[0];

//           // Prepare data to draw
//           // important point 1
//           const centerPoint = arc.getCenterPoint();
//           let color = chart.config._config.data.datasets[0].backgroundColor[i];
//           let labelColor = chart.config._config.data.datasets[0].backgroundColor[i];


//           const angle = Math.atan2(
//             centerPoint.y - chartCenterPoint.y,
//             centerPoint.x - chartCenterPoint.x
//           );
//           // important point 2, this point overlapsed with existed points
//           // so we will reduce y by 14 if it's on the right
//           // or add by 14 if it's on the left
//           let originPoint = getOriginPoints(chartCenterPoint, centerPoint, arc.outerRadius)
//           const point2X =
//             chartCenterPoint.x + Math.cos(angle) * (centerPoint.x < chartCenterPoint.x ? arc.outerRadius + 10 : arc.outerRadius + 10);
//           let point2Y =
//             chartCenterPoint.y + Math.sin(angle) * (centerPoint.y < chartCenterPoint.y ? arc.outerRadius + 15 : arc.outerRadius + 15);

//           let suitableY;
//           if (point2X < chartCenterPoint.x) {
//             // on the left
//             suitableY = getSuitableY(point2Y, leftLabelCoordinates, "left");
//           } else {
//             // on the right

//             suitableY = getSuitableY(point2Y, rightLabelCoordinates, "right");
//           }

//           point2Y = suitableY;

//           let value = dataset.data[i];
//           // if (dataset.polyline && dataset.polyline.formatter) {
//           //   value = dataset.polyline.formatter(value);
//           // }
//           let edgePointX = point2X < chartCenterPoint.x ? chartCenterPoint.x - arc.outerRadius - 10 : chartCenterPoint.x + arc.outerRadius + 10;

//           if (point2X < chartCenterPoint.x) {
//             leftLabelCoordinates.push(point2Y);
//           } else {
//             rightLabelCoordinates.push(point2Y);
//           }

//           //DRAW CODE
//           // first line: connect between arc's center point and outside point
//           ctx.lineWidth = 2;
//           ctx.strokeStyle = color;
//           ctx.beginPath();
//           ctx.moveTo(originPoint.x, originPoint.y);
//           ctx.lineTo(point2X, point2Y);
//           ctx.stroke();
//           // second line: connect between outside point and chart's edge
//           ctx.beginPath();
//           ctx.moveTo(point2X, point2Y);
//           ctx.lineTo(edgePointX, point2Y);
//           ctx.stroke();
//           //fill custom label
//           const labelAlignStyle =
//             edgePointX < chartCenterPoint.x ? "right" : "left";
//           const labelX = edgePointX < chartCenterPoint.x ? edgePointX : edgePointX + 0;
//           const labelY = point2Y + 7;
//           ctx.textAlign = labelAlignStyle;
//           ctx.textBaseline = "bottom";
//           ctx.font = "bold 12px Lato";
//           // ctx.fillStyle = labelColor;
//           ctx.fillText(value, labelX, labelY);
//         });
//         ctx.restore();
//       }
//     }
//   ];

//   var myChart = new Chart(ctx, {
//     type: 'pie',
//     plugins: plugins,
//     options: options,
//     data: {
//       labels: arr_jenis,
//       datasets: [{
//     label: 'Status Pekerjaan',
//     data: arr_data,
//      backgroundColor: getRandomColorEachData(lengthdata),
//     borderColor: "transparent",
//     tooltip: {
//         callbacks: {
//             label: function(context) {
//                 let label = context.label;
//                 let value = context.formattedValue;

//                 if (!label)
//                     label = 'Unknown'

//                 let sum = 0;
//                 let dataArr = context.chart.data.datasets[0].data;
//                 dataArr.map(data => {
//                     sum += Number(data);
//                 });

//                 let percentage = (value * 100 / sum).toFixed(2) + '%';
//                 return label + ": " + percentage;
//             }
//         }
//     }
// }]
//     }
//   });

//    }


///////////////////////--------------------------------/////////////////////////


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
               $('#result3').hide();
               $('#result4').hide();


            },

            success: function(data){

            unblock("tab-content");
             $('#loading').hide();
             $('#result3').hide();
             $('#result4').hide();
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

                 block("tab-content");
                document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
               $('#selectkampung').html('');
               $('#kampung').val(0);
               //$('#loading').show();


            },

            success: function(data){

            // $('#loading').hide();

             unblock("tab-content");
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
               $('#result3').hide();
               $('#result4').hide();
               $('#parlimen').val(0);
               $('#dun').val(0);
               $('#mukim').val(0);
               $('#kampung').val(0);


            },

            success: function(data){

            unblock("tab-content");
             $('#loading').hide();
             $('#result3').hide();
             $('#result4').hide();
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
               block("tab-content");
               document.getElementById("pilihparlimen").innerHTML = "Sila Pilih";
               document.getElementById("pilihdun").innerHTML = "Sila Pilih";
               $('#selectparlimen').html('');
               $('#selectdun').html('');
               $('#loading').show();
               $('#result2').hide();
               $('#result3').hide();
               $('#result4').hide();
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
               $('#result3').hide();
               $('#result4').hide();
               $('#kampung').val(0);


            },

            success: function(data){

             unblock("tab-content");
             $('#loading').hide();
             $('#result3').hide();
             $('#result4').hide();
             $('#selectkampung').html(data);


           }


          });
    };

    function kampungmukim(id){


        $('#parlimen').val(0);
        $('#dun').val(0);
        $('#kampung').val(0);


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
               $('#result3').hide();
               $('#result4').hide();
               //kena reset balik parlimen
               $('#parlimen').val(0);
               $('#dun').val(0);
               $('#mukim').val(0);
               $('#kampung').val(0);



            },

            success: function(data){

             unblock("tab-content");
             $('#loading').hide();
             $('#result3').hide();
             $('#result4').hide();
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

                block("tab-content");
                document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
               $('#selectkampung').html('');
               $('#loading').show();
               $('#result2').hide();
               $('#result3').hide();
               $('#result4').hide();
               $('#kampung').val(0);


            },

            success: function(data){

               unblock("tab-content");
               $('#loading').hide();
               $('#result3').hide();
               $('#result4').hide();


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
               $('#result3').hide();
               $('#result4').hide();
               $('#kampung').val(0);

            },

            success: function(data){

             unblock("tab-content");
             $('#loading').hide();
             $('#result3').hide();
             $('#result4').hide();
             $('#selectkampung').html(data);


           }


          });
};

</script>
@endpush
