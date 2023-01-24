<div class="tab-content p-3 raised">
  <div class="ui styled fluid accordion " id="divaccordion">
  <div class="title">
    <i class="dropdown icon"></i>
    Carian Statistik
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
              <input type="hidden" name="mukim" id="mukim" value="">
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
              <input type="hidden" name="daerah" id="daerah" value="">
              <i class="dropdown icon"></i>
              <div class="default text">Sila Pilih</div>
              <div class="menu">
                <div class="item" data-value="" onclick="mukim(0)">Sila Pilih</div>
                @foreach($daerah as $key => $value)
                <div class="item" data-value="{{$value->id}}" onclick="mukim({{$value->id}})">{{$value->NamaDaerah}}</div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="field">
            <label>Mukim</label>
            <div class="ui fluid search selection dropdown">
              <input type="hidden" name="mukim" id="mukim" value="">
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
              <input type="hidden" name="parlimen" id="parlimen" value="">
              <i class="dropdown icon"></i>
              <div class="default text" id="pilihparlimen">Sila Pilih</div>
              <div class="menu" id="selectparlimen">
              </div>
            </div>
          </div>
          <div class="field">
            <label>Dun</label>
            <div class="ui fluid search selection dropdown">
              <input type="hidden" name="dun" id="dun" value="">
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
              <input type="hidden" name="cat_petempatan" id="cat_petempatan" value="">
              <i class="dropdown icon"></i>
              <div class="default text">Sila Pilih</div>
              <div class="menu" id="pilihcat">
                <div class="item" data-value="" onclick="kampungpenempatan(0)">Sila Pilih</div>
                @foreach($catpenempatan as $key => $value)
                <div class="item" data-value="{{$value->id}}" onclick="kampungpenempatan({{$value->id}})">{{$value->description}}</div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="field">
            <label>Nama Kampung</label>
            <div class="ui fluid search selection dropdown">
              <input type="hidden" name="kampung" id="kampung" value="">
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
            <button class="ui button primary" onclick="search()">
                          Carian
            </button>
            <!--  <button class="btn btn-success btn-sm btn-round has-ripple" id="printpie" name="printpie" type="button">Print
            </button> -->
        </div>
        <br/><br/><br/>
    </div>
  </div>
</div>

<!-- <div class="ui container-fluid content__body p-3" id="loading" style="display: none;">
  <div class="ui segments panel">
    <div class="ui segment p-3">
      <div class="ui blue sliding indeterminate progress">
        <div class="bar">
          <div class="progress">Sila Tunggu Sebentar</div>
        </div>

      </div>
    </div>
  </div>

</div> -->

<!-- <div class="ui container-fluid content__body p-3" id="result3" style="display: none">
  <div class="ui segments panel">
    <div class="ui segment p-3" id="resultcountpetempatan">

    </div>

  </div>
</div> -->

<div class="ui container-fluid content__body p-3" id="result3" style="display: none">
    <div id="resultcountpetempatan">
    </div>
</div>

<!-- <div class="ui container-fluid content__body p-3" id="result4">
  <div class="ui segments panel">
    <div class="ui segment p-3"> -->
<div class="ui container-fluid content__body p-3" id="result4">
  
      <div class="ui two stackable cards raised">
        <div class="card ">
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


<div class="page-break" style="display: none"></div>
<div id="break"></div>

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
  <script type="text/javascript">
  $(document).ready(function() {

       $("#printpie").click(function(){
    print_pie();
     
     });

    $('.ui.accordion')
      .accordion();

    var parlimen = $('#parlimen').val();

    if (parlimen == '') {
      valparlimen = 0;
    } else {
      valparlimen = parlimen;

    }

    var dun = $('#dun').val();

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }


    var daerah = $('#daerah').val();
    var mukim = $('#mukim').val();



    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }


    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }

    var cat_petempatan = $('#cat_petempatan').val();

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }


    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }

    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
      datatype: 'json',

      beforeSend: function() {
         //block("tab-content");
        document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
        $('#selectkampung').html('');
        $('#loading').show();


      },

      success: function(data) {
        // unblock("tab-content");

        $('#loading').hide();
        $('#selectkampung').html(data);


      }


    });


    search();

  });

  function search() {


    var parlimen = $('#parlimen').val();

    if (parlimen == '') {
      valparlimen = 0;
    } else {
      valparlimen = parlimen;

    }

    var dun = $('#dun').val();

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }
    var daerah = $('#daerah').val();

    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }
    var mukim = $('#mukim').val();

    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }


    var cat_petempatan = $('#cat_petempatan').val();

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }

    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }



    $.ajax({
      type: "GET",
      url: "{{ URL::to('/dashboard/countpetempatan/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

      beforeSend: function() {
         block("tab-content");
        $('#loading').show();

        document.getElementById('result3').style.display = "none";

      },

      success: function(data) {
         unblock("tab-content");

        $('#loading').hide();


        //document.getElementById('result3').style.display = "show";
        $('#result3').show();

        document.getElementById('resultcountpetempatan').innerHTML = data;

      }


    });


    $.ajax({
      type: "GET",
      url: "{{ URL::to('/dashboard/countdata/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

      beforeSend: function() {


      },

      success: function(data) {

        if (data == 0) {
          $('#result4').hide();
        } else {

          $('#result4').show();
        }
      }


    });

    //-------------------------------------------getchart1------------------------//
    $.ajax({
      type: "GET",
      url: "{{ URL::to('/dashboard/chart1/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

      beforeSend: function() {

        $('#loader1').show();
        $('#result4').show();

        document.getElementById('resultchart1').style.display = "none";

      },

      success: function(data) {

        var arr_data = "";
        var arr_status = "";
        var lengthdata = "";

        if (data.arr_status.length == 0) {
          $('#result4').hide();
        } else {
          $('#result4').show();
        }


        $('#loader1').hide();

        $('#resultchart1').show();

        arr_data = data.arr_data;
        arr_status = data.arr_status;
        lengthdata = data.arr_status.length;

        $("#resultchart1").html('<div><canvas id="myBarChart" height="300" width="580"></canvas></div>');
        getBarStatusMilik(arr_data, arr_status, lengthdata);
      } //end sucsess chart1


    }); //end ajax chart1

    //-------------------------------------------end getchart1-------------------------//
    //-------------------------------------------start getchart2-----------------//
    $.ajax({
      type: "GET",
      url: "{{ URL::to('/dashboard/chart2/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

      beforeSend: function() {
        $('#loader2').show();

        document.getElementById('resultchart2').style.display = "none";


      },

      success: function(data) {

        var arr_data = "";
        var arr_status = "";
        var lengthdata = "";

        $('#loader2').hide();
        //document.getElementById('result3').style.display = "show";
        $('#resultchart2').show();
        //document.getElementById('resultchart1').innerHTML = data;

        console.log(data.arr_jenis.length);

        arr_jenis = data.arr_jenis;
        arr_data = data.arr_data;
        lengthdata = data.arr_jenis.length;
        jumjenisrumah = data.jumjenisrumah;

        $("#resultchart2").html('<div><canvas id="myPieChart" height="300" width="580"></canvas></div>');
        getPieJenisRumah(arr_jenis, arr_data, lengthdata, jumjenisrumah);
      } //end sucsess chart1


    }); //end ajax chart1
    //--------------------------------------------end getchart2-------------------//
    //-------------------------------------------start getchart3----------------------//
    $.ajax({
      type: "GET",
      url: "{{ URL::to('/dashboard/chart3/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

      beforeSend: function() {
        $('#loader3').show();

        document.getElementById('resultchart3').style.display = "none";


      },

      success: function(data) {

        var arr_data = "";
        var arr_status = "";
        var lengthdata = "";

        $('#loader3').hide();
        //document.getElementById('result3').style.display = "show";
        $('#resultchart3').show();
        //document.getElementById('resultchart1').innerHTML = data;

        console.log(data.jumkemudahan);

        arr_jenis = data.arr_jenis;
        arr_data = data.arr_data;
        lengthdata = data.arr_jenis.length;
        jumkemudahan = data.jumkemudahan;

        $("#resultchart3").html('<canvas id="myPieKemudahan" height="350" width="580"></canvas></div>');
        getPieKemudahan(arr_jenis, arr_data, lengthdata, jumkemudahan);
      } //end sucsess chart1


    }); //end ajax chart1
    //--------------------------------------------end getchart3----------------//
    //-------------------------------------------start getchart4---------------//
    $.ajax({
      type: "GET",
      url: "{{ URL::to('/dashboard/chart4/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

      beforeSend: function() {
        $('#loader4').show();

        document.getElementById('resultchart4').style.display = "none";


      },

      success: function(data) {

        var arr_data = "";
        var arr_status = "";
        var lengthdata = "";
        var arr_ya = "";
        var arr_tidak = "";

        $('#loader4').hide();
        //document.getElementById('result3').style.display = "show";
        $('#resultchart4').show();
        //document.getElementById('resultchart1').innerHTML = data;

        console.log(data.arr_status.length);

        arr_jenis = data.arr_status;
        arr_data = data.arr_data;
        lengthdata = data.arr_status.length;
        arr_label = data.arr_label;
        arr_ya = data.arr_ya;
        arr_tidak = data.arr_tidak;


        $("#resultchart4").html('<canvas id="myBarChart2" height="330" width="580"></canvas></div>');
        getBarKemudahan2(arr_jenis, arr_data, lengthdata, arr_label, arr_ya, arr_tidak);
      } //end sucsess chart1


    }); //end ajax chart1
    //--------------------------------------------end getchart4-----------------//
    //-------------------------------------------start getchart5---------------//
    $.ajax({
      type: "GET",
      url: "{{ URL::to('/dashboard/chart5/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

      beforeSend: function() {
        $('#loader5').show();

        document.getElementById('resultchart5').style.display = "none";


      },

      success: function(data) {

        var arr_data = "";
        var arr_status = "";
        var lengthdata = "";

        $('#loader5').hide();
        //document.getElementById('result3').style.display = "show";
        $('#resultchart5').show();
        //document.getElementById('resultchart1').innerHTML = data;

        console.log(data.arr_jenis.length);

        arr_jenis = data.arr_jenis;
        arr_data = data.arr_data;
        lengthdata = data.arr_jenis.length;
        jumjeniskerja = data.jumjeniskerja;

        $("#resultchart5").html('<canvas id="myPieKerja" height="350" width="580"></canvas></div>');
        getPieKerja(arr_jenis, arr_data, lengthdata, jumjeniskerja);
      } //end sucsess chart5


    }); //end ajax chart5
    //--------------------------------------------end getchart5-----------------//
    //-------------------------------------------start getchart6----------------//
    $.ajax({
      type: "GET",
      url: "{{ URL::to('/dashboard/chart6/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

      beforeSend: function() {
        $('#loader6').show();

        document.getElementById('resultchart6').style.display = "none";


      },

      success: function(data) {

        var arr_data = "";
        var arr_status = "";
        var lengthdata = "";

        $('#loader6').hide();
        //document.getElementById('result3').style.display = "show";
        $('#resultchart6').show();
        //document.getElementById('resultchart1').innerHTML = data;

        console.log(data.arr_jenis.length);

        arr_jenis = data.arr_jenis;
        arr_data = data.arr_data;
        lengthdata = data.arr_jenis.length;
        jumjeniskawin = data.jumjeniskawin;

        $("#resultchart6").html('<canvas id="myPieKahwin" height="350" width="580"></canvas>');
        getPieKahwin(arr_jenis, arr_data, lengthdata, jumjeniskawin);
      } //end sucsess chart5


    }); //end ajax chart5
    //--------------------------------------------end getchart6-----------------//

    //-------------------------------------------getchart7------------------------//
    $.ajax({
      type: "GET",
      url: "{{ URL::to('/dashboard/chart7/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

      beforeSend: function() {

        $('#loader7').show();

        document.getElementById('resultchart7').style.display = "none";

      },

      success: function(data) {

        var arr_data = "";
        var arr_status = "";
        var lengthdata = "";

        $('#loader7').hide();

        //document.getElementById('result3').style.display = "show";
        $('#resultchart7').show();
        //document.getElementById('resultchart1').innerHTML = data;

        console.log(data.arr_status.length);

        arr_data = data.arr_data;
        arr_status = data.arr_status;
        lengthdata = data.arr_status.length;

        $("#resultchart7").html('<canvas id="myBarUmur" height="350" width="580"></canvas></div>');
        getBarUmur(arr_data, arr_status, lengthdata);
      } //end sucsess chart1


    }); //end ajax chart1

    //-------------------------------------------end getchart7-----------------//
    //-------------------------------------------getchart8-----------------------//
    $.ajax({
      type: "GET",
      url: "{{ URL::to('/dashboard/chart8/')}}?parlimen=" + valparlimen + "&dun=" + valdun + "&daerah=" + valdaerah + "&mukim=" + valmukim + "&catpetempatan=" + valcat_petempatan + "&kampung=" + valkampung,

      beforeSend: function() {

        $('#loader8').show();

        document.getElementById('resultchart8').style.display = "none";

      },

      success: function(data) {

        var arr_data = "";
        var arr_status = "";
        var lengthdata = "";

        $('#loader8').hide();

        //document.getElementById('result3').style.display = "show";
        $('#resultchart8').show();
        //document.getElementById('resultchart1').innerHTML = data;

        console.log(data.arr_status.length);

        arr_data = data.arr_data;
        arr_status = data.arr_status;
        lengthdata = data.arr_status.length;

        $("#resultchart8").html('<canvas id="myBarPendapatan" height="350" width="580"></canvas></div>');
        getBarPendapatan(arr_data, arr_status, lengthdata);
      } //end sucsess chart1


    }); //end ajax chart1

    //-------------------------------------------end getchar8----------------//

  }

  function getBarStatusMilik(arr_data, arr_status, lengthdata) {

    var ctx = $("#myBarChart");


    function getRandomColorEachDatamyBarChart(count) {
      var data = [];
   var arr_color = [

        ["#d69fbf", "#467680"
        ],
        // [
        //   "#EDE0D4", "#E6CCB2", "#DDB892", "#B08968", "#7F5539", "#9C6644", "#A57455", "#AD8164", "#B48C72", "#BB967F"
        // ],
        // [
        //   "#99735F", "#A87E69", "#B98B73", "#CB997E", "#DDBEA9", "#FFE8D6", "#A5A58D", "#6B705C", "#787D6B", "#264501"
        // ],
        //  [
        //   "#6A7384", "#757F91", "#818C9F", "#8E9AAF", "#CBC0D3", "#EFD3D7", "#FEEAFA", "#DEE2FF", "#E1E5FF", "#E4E7FF"
        // ],
        //  [
        //   "#A8B090", "#B9C29E", "#CCD5AE", "#E9EDC9", "#FEFAE0", "#FAEDCD", "#D4A373", "#D8AB80", "#DCB38C", "#DFBA96"
        // ],
        //  [
        //   "#582F0E", "#7f4f24", "#936639", "#A68A64", "#B6AD90", "#C2C5AA", "#A4AC86", "#656D4A", "#414833", "#333D29"
        // ],
        //  [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#11F79A", "#17970E", "#F25E5E", "#264501"
        // ],
        // [
        //   "#9ACB34", "#FF0000", "#833D85", "#FE8A01", "#81D1B6", "#FECE02", "#4F2550", "#D40104", "#5C7A1F", "#FFC681"
        // ],
        // [
        //   "#FC3924", "#2EBC86", "#F2DC13", "#B81423", "#637589", "#6EC135", "#7030A0", "#1B7E00", "#256DBD", "#F3A58D"
        // ],
        // [
        //   "#A8234C", "#92D565", "#E3534C", "#6F3B55", "#FFA874", "#005828", "#F33F21", "#DF678C", "#4C91DC", "#F3A58D"
        // ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#F33F21", "#11F79A", "#1D9A00", "#F25E5E"
        // ],
        // [
        //   "#4B9ABB", "#9ACB34", "#EC5923", "#833D85", "#FDDA02", "#637589", "#4DA17F", "#001A9A", "#D01232", "#FFC681"
        // ]


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
          text: 'Status Pemilikan Rumah',
          padding: {
            top: 10,
            bottom: 30
          },

        },
        legend: {
          display: false,
        },
        hover: {mode: null},

      }
    };

    if (lengthdata == 0) {

      var chartData = '';

    } else {

      var chartData = {
        labels: arr_status,
        datasets: [{
          label: 'Status Pemilikan Rumah',
          data: arr_data,
          backgroundColor: getRandomColorEachDatamyBarChart(lengthdata),
          hoverBackgroundColor: getRandomColorEachDatamyBarChart(lengthdata),
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


  function getPieJenisRumah(arr_jenis, arr_data, lengthdata, jumjenisrumah) {

    var ctxpie = $("#myPieChart");

    function getRandomColorEachData(count) {
      var data = [];
      var arr_color = [
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#11F79A", "#17970E", "#F25E5E", "#264501"
        // ],
        // [
        //   "#9ACB34", "#FF0000", "#833D85", "#FE8A01", "#81D1B6", "#FECE02", "#4F2550", "#D40104", "#5C7A1F", "#FFC681"
        // ],
        // [
        //   "#FC3924", "#2EBC86", "#F2DC13", "#B81423", "#637589", "#6EC135", "#7030A0", "#1B7E00", "#256DBD", "#F3A58D"
        // ],
        // [
        //   "#A8234C", "#92D565", "#E3534C", "#6F3B55", "#FFA874", "#005828", "#F33F21", "#DF678C", "#4C91DC", "#F3A58D"
        // ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#F33F21", "#11F79A", "#1D9A00", "#F25E5E"
        // ],
        // [
        //   "#4B9ABB", "#9ACB34", "#EC5923", "#833D85", "#FDDA02", "#637589", "#4DA17F", "#001A9A", "#D01232", "#FFC681"
        // ]
         ["#d69fbf", "#5b285c", "#486eab", "#6badd5", "#7e637a", "#324a80", "#c52b49", "#467680", "#5c4547", "#ab7277"
        ],
         ["#ab7277", "#324a80", "#467680", "#6badd5", "#7e637a", "#5b285c", "#c52b49", "#486eab", "#5c4547", "#d69fbf"
        ],
        // [
        //   "#EDE0D4", "#E6CCB2", "#DDB892", "#B08968", "#7F5539", "#9C6644", "#A57455", "#AD8164", "#B48C72", "#BB967F"
        // ],
        // [
        //   "#99735F", "#A87E69", "#B98B73", "#CB997E", "#DDBEA9", "#FFE8D6", "#A5A58D", "#6B705C", "#787D6B", "#264501"
        // ],
        //  [
        //   "#6A7384", "#757F91", "#818C9F", "#8E9AAF", "#CBC0D3", "#EFD3D7", "#FEEAFA", "#DEE2FF", "#E1E5FF", "#E4E7FF"
        // ],
        //  [
        //   "#A8B090", "#B9C29E", "#CCD5AE", "#E9EDC9", "#FEFAE0", "#FAEDCD", "#D4A373", "#D8AB80", "#DCB38C", "#DFBA96"
        // ],
        //  [
        //   "#582F0E", "#7f4f24", "#936639", "#A68A64", "#B6AD90", "#C2C5AA", "#A4AC86", "#656D4A", "#414833", "#333D29"
        // ],
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
          text: 'Jenis Rumah',
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

          formatter: (value, ctxpie) => {
            // const datapoints = ctxpie.chart.data.datasets[0].data
            // const total = jumjenisrumah
            // const percentage = value / total * 100

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
      labels: arr_jenis,
      datasets: [{
        label: 'Jenis Rumah',
        data: arr_data,
        backgroundColor: getRandomColorEachData(lengthdata),
        hoverBackgroundColor: getRandomColorEachData(lengthdata),
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
              return label + ": " + valueformat + ":" + percentage.toFixed(2) + "%";
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

  function getPieKemudahan(arr_jenis, arr_data, lengthdata, jumkemudahan) {

    var ctxpie = $("#myPieKemudahan");

    function getRandomColorEachData(count) {
      var data = [];
      var arr_color = [
        ["#d69fbf", "#5b285c", "#486eab", "#6badd5", "#7e637a", "#324a80", "#c52b49", "#467680", "#5c4547", "#ab7277"
        ],
         ["#ab7277", "#324a80", "#467680", "#6badd5", "#7e637a", "#5b285c", "#c52b49", "#486eab", "#5c4547", "#d69fbf"
        ],
        // ["#B98B73", "#CB997E", "#EDE0D4", "#DDBEA9", "#FFE8D6", "#F26426", "#B7B7A4", "#A5A58D", "#6B705C", "#787D6B"
        // ],
        // [
        //   "#EDE0D4", "#E6CCB2", "#DDB892", "#B08968", "#7F5539", "#9C6644", "#A57455", "#AD8164", "#B48C72", "#BB967F"
        // ],
        // [
        //   "#99735F", "#A87E69", "#B98B73", "#CB997E", "#DDBEA9", "#FFE8D6", "#A5A58D", "#6B705C", "#787D6B", "#264501"
        // ],
        //  [
        //   "#6A7384", "#757F91", "#818C9F", "#8E9AAF", "#CBC0D3", "#EFD3D7", "#FEEAFA", "#DEE2FF", "#E1E5FF", "#E4E7FF"
        // ],
        //  [
        //   "#A8B090", "#B9C29E", "#CCD5AE", "#E9EDC9", "#FEFAE0", "#FAEDCD", "#D4A373", "#D8AB80", "#DCB38C", "#DFBA96"
        // ],
        //  [
        //   "#582F0E", "#7f4f24", "#936639", "#A68A64", "#B6AD90", "#C2C5AA", "#A4AC86", "#656D4A", "#414833", "#333D29"
        // ],////***
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#11F79A", "#17970E", "#F25E5E", "#264501"
        // ],
        // [
        //   "#9ACB34", "#FF0000", "#833D85", "#FE8A01", "#81D1B6", "#FECE02", "#4F2550", "#D40104", "#5C7A1F", "#FFC681"
        // ],
        // [
        //   "#FC3924", "#2EBC86", "#F2DC13", "#B81423", "#637589", "#6EC135", "#7030A0", "#1B7E00", "#256DBD", "#F3A58D"
        // ],
        // [
        //   "#A8234C", "#92D565", "#E3534C", "#6F3B55", "#FFA874", "#005828", "#F33F21", "#DF678C", "#4C91DC", "#F3A58D"
        // ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#F33F21", "#11F79A", "#1D9A00", "#F25E5E"
        // ],
        // [
        //   "#4B9ABB", "#9ACB34", "#EC5923", "#833D85", "#FDDA02", "#637589", "#4DA17F", "#001A9A", "#D01232", "#FFC681"
        // ]
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
          text: 'Kemudahan Awam & Infrastruktur',
          padding: {
            top: 10,
            bottom: 30
          },

        },
         legend: {
          display: true,
          position: "bottom"
        },

        //    datalabels: {
        // color: '#fff',
        //  display: 'auto',
        //   },
        datalabels: {
          formatter: (value, ctxpie) => {
            // const datapoints = ctxpie.chart.data.datasets[0].data
            // const total = jumkemudahan

            // const percentage = value / total * 100

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
      labels: arr_jenis,
      datasets: [{
        label: 'Kemudahan Awam & Infrastruktur',
        data: arr_data,
        backgroundColor: getRandomColorEachData(lengthdata),
        hoverBackgroundColor: getRandomColorEachData(lengthdata),
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
              return label + ": " + valueformat + ":" + percentage.toFixed(2) + "%";
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

  function getBarKemudahan2(arr_jenis, arr_data, lengthdata, arr_label, arr_ya, arr_tidak)

  {

    var ctxBarChart = $("#myBarChart2");

    // function getRandomColor() {
    //   var letters = '0123456789ABCDEF'.split('');
    //   var color = '#';
    //   for (var i = 0; i < 6; i++) {
    //     color += letters[Math.floor(Math.random() * 16)];
    //   }
    //   return color;
    // }

      function getRandomColorEachData(count) {
      var data = [];
      var arr_color = [
         ["#d69fbf", "#5b285c", "#486eab", "#6badd5", "#7e637a", "#324a80", "#c52b49", "#467680", "#5c4547", "#ab7277"
        ],
         ["#ab7277", "#324a80", "#467680", "#6badd5", "#7e637a", "#5b285c", "#c52b49", "#486eab", "#5c4547", "#d69fbf"
        ],
        // ["#B98B73", "#CB997E", "#EDE0D4", "#DDBEA9", "#FFE8D6", "#F26426", "#B7B7A4", "#A5A58D", "#6B705C", "#787D6B"
        // ],
        // [
        //   "#EDE0D4", "#E6CCB2", "#DDB892", "#B08968", "#7F5539", "#9C6644", "#A57455", "#AD8164", "#B48C72", "#BB967F"
        // ],
        // [
        //   "#99735F", "#A87E69", "#B98B73", "#CB997E", "#DDBEA9", "#FFE8D6", "#A5A58D", "#6B705C", "#787D6B", "#264501"
        // ],
        //  [
        //   "#6A7384", "#757F91", "#818C9F", "#8E9AAF", "#CBC0D3", "#EFD3D7", "#FEEAFA", "#DEE2FF", "#E1E5FF", "#E4E7FF"
        // ],
        //  [
        //   "#A8B090", "#B9C29E", "#CCD5AE", "#E9EDC9", "#FEFAE0", "#FAEDCD", "#D4A373", "#D8AB80", "#DCB38C", "#DFBA96"
        // ],
        //  [
        //   "#582F0E", "#7f4f24", "#936639", "#A68A64", "#B6AD90", "#C2C5AA", "#A4AC86", "#656D4A", "#414833", "#333D29"
        // ],///*
        //  [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#11F79A", "#17970E", "#F25E5E", "#264501"
        // ],
        // [
        //   "#9ACB34", "#FF0000", "#833D85", "#FE8A01", "#81D1B6", "#FECE02", "#4F2550", "#D40104", "#5C7A1F", "#FFC681"
        // ],
        // [
        //   "#FC3924", "#2EBC86", "#F2DC13", "#B81423", "#637589", "#6EC135", "#7030A0", "#1B7E00", "#256DBD", "#F3A58D"
        // ],
        // [
        //   "#A8234C", "#92D565", "#E3534C", "#6F3B55", "#FFA874", "#005828", "#F33F21", "#DF678C", "#4C91DC", "#F3A58D"
        // ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#F33F21", "#11F79A", "#1D9A00", "#F25E5E"
        // ],
        // [
        //   "#4B9ABB", "#9ACB34", "#EC5923", "#833D85", "#FDDA02", "#637589", "#4DA17F", "#001A9A", "#D01232", "#FFC681"
        // ]


      ];

      var colors = arr_color[Math.floor(Math.random() * arr_color.length)];
      for (var i = 0; i < count; i++) {
        // data.push(getRandomColor());
        data.push(colors[i]);
      }

      return data;
    }

    // function getRandomColorEachData(count) {
    //   var data = [];
    //   for (var i = 0; i < count; i++) {
    //     data.push(getRandomColor());
    //   }
    //   return data;
    // }



    if (lengthdata == 0) {
      var optionsBar = {
        plugins: {
          title: {
            display: true,
            text: 'Kemudahan Asas Rumah',
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


      var barChartData = '';

    } else {

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
            text: 'Kemudahan Asas Rumah',
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
            backgroundColor: "rgb(126, 99, 122)",
            hoverBackgroundColor: "rgb(126, 99, 122)",
            data: arr_ya
          },
          {
            label: "Tidak",
            //backgroundColor: getRandomColorEachData(1),
            backgroundColor: "rgb(197, 43, 73)",
            hoverBackgroundColor:"rgb(197, 43, 73)",
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

  function getPieKerja(arr_jenis, arr_data, lengthdata, jumjeniskerja) {

    var ctxpie = $("#myPieKerja");

    function getRandomColorEachData(count) {
      var data = [];
      var arr_color = [
      ["#d69fbf", "#5b285c", "#486eab", "#6badd5", "#7e637a", "#324a80", "#c52b49", "#467680", "#5c4547", "#ab7277"
        ],
         ["#ab7277", "#324a80", "#467680", "#6badd5", "#7e637a", "#5b285c", "#c52b49", "#486eab", "#5c4547", "#d69fbf"
        ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#11F79A", "#17970E", "#F25E5E", "#264501"
        // ],
        // [
        //   "#9ACB34", "#FF0000", "#833D85", "#FE8A01", "#81D1B6", "#FECE02", "#4F2550", "#D40104", "#5C7A1F", "#FFC681"
        // ],
        // [
        //   "#FC3924", "#2EBC86", "#F2DC13", "#B81423", "#637589", "#6EC135", "#7030A0", "#1B7E00", "#256DBD", "#F3A58D"
        // ],
        // [
        //   "#A8234C", "#92D565", "#E3534C", "#6F3B55", "#FFA874", "#005828", "#F33F21", "#DF678C", "#4C91DC", "#F3A58D"
        // ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#F33F21", "#11F79A", "#1D9A00", "#F25E5E"
        // ],
        // [
        //   "#4B9ABB", "#9ACB34", "#EC5923", "#833D85", "#FDDA02", "#637589", "#4DA17F", "#001A9A", "#D01232", "#FFC681"
        // ]/////**
        //  ["#B98B73", "#CB997E", "#EDE0D4", "#DDBEA9", "#FFE8D6", "#F26426", "#B7B7A4", "#A5A58D", "#6B705C", "#787D6B"
        // ],
        // [
        //   "#EDE0D4", "#E6CCB2", "#DDB892", "#B08968", "#7F5539", "#9C6644", "#A57455", "#AD8164", "#B48C72", "#BB967F"
        // ],
        // [
        //   "#99735F", "#A87E69", "#B98B73", "#CB997E", "#DDBEA9", "#FFE8D6", "#A5A58D", "#6B705C", "#787D6B", "#264501"
        // ],
        //  [
        //   "#6A7384", "#757F91", "#818C9F", "#8E9AAF", "#CBC0D3", "#EFD3D7", "#FEEAFA", "#DEE2FF", "#E1E5FF", "#E4E7FF"
        // ],
        //  [
        //   "#A8B090", "#B9C29E", "#CCD5AE", "#E9EDC9", "#FEFAE0", "#FAEDCD", "#D4A373", "#D8AB80", "#DCB38C", "#DFBA96"
        // ],
        //  [
        //   "#582F0E", "#7f4f24", "#936639", "#A68A64", "#B6AD90", "#C2C5AA", "#A4AC86", "#656D4A", "#414833", "#333D29"
        // ],
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
          text: 'Status Pekerjaan',
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
            // const total = jumjeniskerja
            // const percentage = value / total * 100

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

    if (lengthdata == 0) {
      var chartDatapie = ''

    } else {

      var chartDatapie = {
        labels: arr_jenis,
        datasets: [{
          label: 'Status Pekerjaan',
          data: arr_data,
          backgroundColor: getRandomColorEachData(lengthdata),
          hoverBackgroundColor: getRandomColorEachData(lengthdata),
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
              return label + ": " + valueformat + ":" + percentage.toFixed(2) + "%";
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

  function getPieKahwin(arr_jenis, arr_data, lengthdata, jumjeniskerja) {

    var ctxpie = $("#myPieKahwin");

    function getRandomColorEachData(count) {
      var data = [];
      var arr_color = [

        ["#d69fbf", "#5b285c", "#486eab", "#6badd5", "#7e637a", "#324a80", "#c52b49", "#467680", "#5c4547", "#ab7277"
        ],
         ["#ab7277", "#324a80", "#467680", "#6badd5", "#7e637a", "#5b285c", "#c52b49", "#486eab", "#5c4547", "#d69fbf"
        ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#11F79A", "#17970E", "#F25E5E", "#264501"
        // ],
        // [
        //   "#9ACB34", "#FF0000", "#833D85", "#FE8A01", "#81D1B6", "#FECE02", "#4F2550", "#D40104", "#5C7A1F", "#FFC681"
        // ],
        // [
        //   "#FC3924", "#2EBC86", "#F2DC13", "#B81423", "#637589", "#6EC135", "#7030A0", "#1B7E00", "#256DBD", "#F3A58D"
        // ],
        // [
        //   "#A8234C", "#92D565", "#E3534C", "#6F3B55", "#FFA874", "#005828", "#F33F21", "#DF678C", "#4C91DC", "#F3A58D"
        // ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#F33F21", "#11F79A", "#1D9A00", "#F25E5E"
        // ],
        // [
        //   "#4B9ABB", "#9ACB34", "#EC5923", "#833D85", "#FDDA02", "#637589", "#4DA17F", "#001A9A", "#D01232", "#FFC681"
        // ]
        //  ["#B98B73", "#CB997E", "#EDE0D4", "#DDBEA9", "#FFE8D6", "#F26426", "#B7B7A4", "#A5A58D", "#6B705C", "#787D6B"
        // ],
        // [
        //   "#EDE0D4", "#E6CCB2", "#DDB892", "#B08968", "#7F5539", "#9C6644", "#A57455", "#AD8164", "#B48C72", "#BB967F"
        // ],
        // [
        //   "#99735F", "#A87E69", "#B98B73", "#CB997E", "#DDBEA9", "#FFE8D6", "#A5A58D", "#6B705C", "#787D6B", "#264501"
        // ],
        //  [
        //   "#6A7384", "#757F91", "#818C9F", "#8E9AAF", "#CBC0D3", "#EFD3D7", "#FEEAFA", "#DEE2FF", "#E1E5FF", "#E4E7FF"
        // ],
        //  [
        //   "#A8B090", "#B9C29E", "#CCD5AE", "#E9EDC9", "#FEFAE0", "#FAEDCD", "#D4A373", "#D8AB80", "#DCB38C", "#DFBA96"
        // ],
        //  [
        //   "#582F0E", "#7f4f24", "#936639", "#A68A64", "#B6AD90", "#C2C5AA", "#A4AC86", "#656D4A", "#414833", "#333D29"
        // ],
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
          text: 'Taraf Perkahwinan',
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
            // const total = jumjeniskerja
            // const percentage = value / total * 100

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
      labels: arr_jenis,
      datasets: [{
        label: 'Taraf Perkahwinan',
        data: arr_data,
        backgroundColor: getRandomColorEachData(lengthdata),
        hoverBackgroundColor: getRandomColorEachData(lengthdata),
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
              return label + ": " + valueformat + ":" + percentage.toFixed(2) + "%";
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

  function getBarUmur(arr_data, arr_status, lengthdata) {

    var ctx = $("#myBarUmur");

    function getRandomColorEachData(count) {
      var data = [];
      var arr_color = [

      ["#d69fbf", "#5b285c", "#486eab", "#6badd5", "#7e637a", "#324a80", "#c52b49", "#467680", "#5c4547", "#ab7277"
        ],
         ["#ab7277", "#324a80", "#467680", "#6badd5", "#7e637a", "#5b285c", "#c52b49", "#486eab", "#5c4547", "#d69fbf"
        ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#11F79A", "#17970E", "#F25E5E", "#264501"
        // ],
        // [
        //   "#9ACB34", "#FF0000", "#833D85", "#FE8A01", "#81D1B6", "#FECE02", "#4F2550", "#D40104", "#5C7A1F", "#FFC681"
        // ],
        // [
        //   "#FC3924", "#2EBC86", "#F2DC13", "#B81423", "#637589", "#6EC135", "#7030A0", "#1B7E00", "#256DBD", "#F3A58D"
        // ],
        // [
        //   "#A8234C", "#92D565", "#E3534C", "#6F3B55", "#FFA874", "#005828", "#F33F21", "#DF678C", "#4C91DC", "#F3A58D"
        // ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#F33F21", "#11F79A", "#1D9A00", "#F25E5E"
        // ],
        // [
        //   "#4B9ABB", "#9ACB34", "#EC5923", "#833D85", "#FDDA02", "#637589", "#4DA17F", "#001A9A", "#D01232", "#FFC681"
        // ]
        //  ["#B98B73", "#CB997E", "#EDE0D4", "#DDBEA9", "#FFE8D6", "#F26426", "#B7B7A4", "#A5A58D", "#6B705C", "#787D6B"
        // ],
        // [
        //   "#EDE0D4", "#E6CCB2", "#DDB892", "#B08968", "#7F5539", "#9C6644", "#A57455", "#AD8164", "#B48C72", "#BB967F"
        // ],
        // [
        //   "#99735F", "#A87E69", "#B98B73", "#CB997E", "#DDBEA9", "#FFE8D6", "#A5A58D", "#6B705C", "#787D6B", "#264501"
        // ],
        //  [
        //   "#6A7384", "#757F91", "#818C9F", "#8E9AAF", "#CBC0D3", "#EFD3D7", "#FEEAFA", "#DEE2FF", "#E1E5FF", "#E4E7FF"
        // ],
        //  [
        //   "#A8B090", "#B9C29E", "#CCD5AE", "#E9EDC9", "#FEFAE0", "#FAEDCD", "#D4A373", "#D8AB80", "#DCB38C", "#DFBA96"
        // ],
        //  [
        //   "#582F0E", "#7f4f24", "#936639", "#A68A64", "#B6AD90", "#C2C5AA", "#A4AC86", "#656D4A", "#414833", "#333D29"
        // ],
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
          text: 'Umur Penduduk',
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

    if (lengthdata == 0) {
      var chartData = ''

    } else {
      var chartData = {
        labels: arr_status,
        datasets: [{
          label: 'Umur Penduduk',
          data: arr_data,
          backgroundColor: getRandomColorEachData(lengthdata),
          hoverBackgroundColor: getRandomColorEachData(lengthdata),
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

  function getBarPendapatan(arr_data, arr_status, lengthdata) {

    var ctx = $("#myBarPendapatan");

    function getRandomColorEachData(count) {
      var data = [];
      var arr_color = [

         ["#d69fbf", "#5b285c", "#486eab", "#6badd5", "#7e637a", "#324a80", "#c52b49", "#467680", "#5c4547", "#ab7277"
        ],
         ["#ab7277", "#324a80", "#467680", "#6badd5", "#7e637a", "#5b285c", "#c52b49", "#486eab", "#5c4547", "#d69fbf"
        ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#11F79A", "#17970E", "#F25E5E", "#264501"
        // ],
        // [
        //   "#9ACB34", "#FF0000", "#833D85", "#FE8A01", "#81D1B6", "#FECE02", "#4F2550", "#D40104", "#5C7A1F", "#FFC681"
        // ],
        // [
        //   "#FC3924", "#2EBC86", "#F2DC13", "#B81423", "#637589", "#6EC135", "#7030A0", "#1B7E00", "#256DBD", "#F3A58D"
        // ],
        // [
        //   "#A8234C", "#92D565", "#E3534C", "#6F3B55", "#FFA874", "#005828", "#F33F21", "#DF678C", "#4C91DC", "#F3A58D"
        // ],
        // [
        //   "#02C39A", "#FFC000", "#FF0000", "#057047", "#27E4FC", "#F26426", "#F33F21", "#11F79A", "#1D9A00", "#F25E5E"
        // ],
        // [
        //   "#4B9ABB", "#9ACB34", "#EC5923", "#833D85", "#FDDA02", "#637589", "#4DA17F", "#001A9A", "#D01232", "#FFC681"
        // ]
        //  ["#B98B73", "#CB997E", "#EDE0D4", "#DDBEA9", "#FFE8D6", "#F26426", "#B7B7A4", "#A5A58D", "#6B705C", "#787D6B"
        // ],
        // [
        //   "#EDE0D4", "#E6CCB2", "#DDB892", "#B08968", "#7F5539", "#9C6644", "#A57455", "#AD8164", "#B48C72", "#BB967F"
        // ],
        // [
        //   "#99735F", "#A87E69", "#B98B73", "#CB997E", "#DDBEA9", "#FFE8D6", "#A5A58D", "#6B705C", "#787D6B", "#264501"
        // ],
        //  [
        //   "#6A7384", "#757F91", "#818C9F", "#8E9AAF", "#CBC0D3", "#EFD3D7", "#FEEAFA", "#DEE2FF", "#E1E5FF", "#E4E7FF"
        // ],
        //  [
        //   "#A8B090", "#B9C29E", "#CCD5AE", "#E9EDC9", "#FEFAE0", "#FAEDCD", "#D4A373", "#D8AB80", "#DCB38C", "#DFBA96"
        // ],
        //  [
        //   "#582F0E", "#7f4f24", "#936639", "#A68A64", "#B6AD90", "#C2C5AA", "#A4AC86", "#656D4A", "#414833", "#333D29"
        // ],
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
          text: 'Pendapatan Penduduk',
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

    if (lengthdata == 0) {
      var chartData = '';

    } else {

      var chartData = {
        labels: arr_status,
        datasets: [{
          label: 'Pendapatan Penduduk',
          data: arr_data,
          backgroundColor: getRandomColorEachData(lengthdata),
          hoverBackgroundColor: getRandomColorEachData(lengthdata),
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




  function dun(id) {

    var role = "{{data_get($roleuser,'role_id')}}";



    $('#kampung').val(0);



    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/dun/')}}" + "/" + id,
      datatype: 'json',

      beforeSend: function() {
         block("tab-content");
        document.getElementById("pilihdun").innerHTML = "Sila Pilih";
        $('#selectdun').html('');
        $('#loading').show();
        $('#result2').hide();
        $('#result3').hide();
        $('#result4').hide();


      },

      success: function(data) {

         unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectdun').html(data);


      }


    });


    var parlimen = id;


    var dun = $('#dun').val();

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }

    var daerah = $('#daerah').val();
    var mukim = $('#mukim').val();


    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }


    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }

    var cat_petempatan = $('#cat_petempatan').val();

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }

    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }


    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/kampung/')}}" + "/" + parlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
      datatype: 'json',

      beforeSend: function() {
        document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
        $('#selectkampung').html('');
        $('#kampung').val(0);
        $('#result3').hide();
        $('#result4').hide();
        //$('#loading').show();


      },

      success: function(data) {

        // $('#loading').hide();

        $('#result3').hide();
        $('#result4').hide();
        $('#selectkampung').html(data);


      }


    });


  };

  function mukim(id) {


    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/mukim/')}}" + "/" + id,
      datatype: 'json',

      beforeSend: function() {
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

      success: function(data) {
         unblock("tab-content");

        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectmukim').html(data);



      }


    });

    var mukim = $('#mukim').val();


    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }

    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/parlimenKampung/')}}" + "/" + id + "/" + valmukim,
      datatype: 'json',

      beforeSend: function() {
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

      success: function(data) {

         unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectparlimen').html(data);




      }


    });


    var parlimen = $('#parlimen').val();
    if (parlimen == '') {
      valparlimen = 0;
    } else {
      valparlimen = parlimen;

    }

    var dun = $('#dun').val();

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }
    var daerah = id;

    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }

    var cat_petempatan = $('#cat_petempatan').val();

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }


    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }





    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
      datatype: 'json',

      beforeSend: function() {
        document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
        $('#selectkampung').html('');
        $('#parlimen').val(0);
        $('#dun').val(0);
        $('#mukim').val(0);
        $('#kampung').val(0);
        $('#result3').hide();
        $('#result4').hide();
        // $('#loading').show();


      },

      success: function(data) {

        // $('#loading').hide();

        $('#result3').hide();
        $('#result4').hide();
        $('#selectkampung').html(data);


      }


    });





  };

  function kampungdun(id) {

    $('#kampung').val(0);

    var daerah = $('#daerah').val();
    var mukim = $('#mukim').val();


    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }


    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }


    var parlimen = $('#parlimen').val();

    if (parlimen == '') {
      valparlimen = 0;
    } else {
      valparlimen = parlimen;

    }

    var dun = id;

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }


    var cat_petempatan = $('#cat_petempatan').val();

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }

    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }



    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
      datatype: 'json',

      beforeSend: function() {
         block("tab-content");
        document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
        $('#selectkampung').html('');
        $('#loading').show();
        $('#result2').hide();
        $('#kampung').val(0);
        $('#result3').hide();
        $('#result4').hide();


      },

      success: function(data) {

         unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectkampung').html(data);


      }


    });
  };


  function kampungmukim(id) {

    $('#kampung').val(0);
    $('#parlimen').val(0);
    $('#dun').val(0);


    var parlimen = $('#parlimen').val();
    var daerah = $('#daerah').val();
    var mukim = id;


    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }


    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }


    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/parlimenKampung/')}}" + "/" + valdaerah + "/" + valmukim,
      datatype: 'json',

      beforeSend: function() {
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

      success: function(data) {

        unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectparlimen').html(data);



      }


    });



    if (parlimen == '') {
      valparlimen = 0;
    } else {
      valparlimen = parlimen;

    }

    var dun = $('#dun').val();

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }




    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }


    var cat_petempatan = $('#cat_petempatan').val();

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }




    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
      datatype: 'json',

      beforeSend: function() {
         block("tab-content");
        document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
        $('#selectkampung').html('');
        $('#loading').show();
        $('#result2').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#kampung').val(0);


      },

      success: function(data) {

        unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectkampung').html(data);


      }


    });
  };

  function kampungpenempatan(id) {


    var parlimen = $('#parlimen').val();
    $('#kampung').val(0);


    if (parlimen == '') {
      valparlimen = 0;
    } else {
      valparlimen = parlimen;

    }

    var dun = $('#dun').val();

    if (dun == '') {
      valdun = 0;
    } else {
      valdun = dun;

    }

    var daerah = $('#daerah').val();
    var mukim = $('#mukim').val();


    if (daerah == '') {
      valdaerah = 0;
    } else {
      valdaerah = daerah;

    }


    if (mukim == '') {
      valmukim = 0;
    } else {
      valmukim = mukim;

    }
    var cat_petempatan = id;

    if (cat_petempatan == '') {
      valcat_petempatan = 0;
    } else {
      valcat_petempatan = cat_petempatan;

    }

    var kampung = $('#kampung').val();

    if (kampung == '') {
      valkampung = 0;
    } else {
      valkampung = kampung;

    }

    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/kampung/')}}" + "/" + valparlimen + "/" + valdun + "/" + valdaerah + "/" + valmukim + "/" + valcat_petempatan + '/' + valkampung,
      datatype: 'json',

      beforeSend: function() {
         block("tab-content");
        document.getElementById("pilihkampung").innerHTML = "Sila Pilih";
        $('#selectkampung').html('');
        $('#loading').show();
        $('#result2').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#kampung').val(0);

      },

      success: function(data) {

         unblock("tab-content");
        $('#loading').hide();
        $('#result3').hide();
        $('#result4').hide();
        $('#selectkampung').html(data);


      }


    });
  };
  function print_pie(){
        window.print();
        setTimeout(function () { window.close(); }, 100);
    }

</script>