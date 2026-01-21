@extends('laravolt::layout.app2')

@section('content')

<style>
    #actionbar h3.ui.header {
        color: #1a3352 !important; 
        font-weight: 800 !important; /* Font lebih tebal */
        font-size: 1.8rem !important;
        margin-bottom: 0px !important;
    }

    /* Sub-teks di bawah tajuk */
    .header-subtext {
        color: #777 !important;
        font-size: 0.95rem;
        margin-top: -5px;
        display: block;
    }

    /* Ikon Header (Ikut gaya ikon group dalam gambar) */
    .header-icon-container {
        display: inline-block;
        vertical-align: middle;
        margin-right: 15px;
    }

    .header-icon-container i.icon {
        color: #1a3352 !important;
        font-size: 2.2rem !important;
        margin: 0 !important;
    }

    .ui.form label, 
    .ui.segments.panel, 
    .default.text,
    .ui.table,
    .ui.input input,
    .ui.dropdown .menu .item {
        color: #2b2b2b !important;
    }

    .ui.segments.panel {
        border: none !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
        border-radius: 12px !important;
    }
</style>

<div id="actionbar" class="ui grid p-1">
  <div class="column middle aligned">
    <div class="header-icon-container">
        <i class="history icon"></i> 
    </div>
    <div style="display: inline-block; vertical-align: middle;">
        <h3 class="ui header">
          Audit Log
        </h3>
        <span class="header-subtext">Paparan rekod aktiviti dan log sistem</span>
    </div>
  </div>
</div>

<div class="tab-content mt-5">
  <div class="ui container-fluid p-3">
    <div class="ui segments panel">
      <div class="ui segment p-4">
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
            <button class="ui button primary" onclick="search()" id="addbutton" style="background-color: #28a745 !important;">
                Carian
            </button>
        </div>
        <br/><br/><br/>
      </div>
    </div>
  </div>
</div>

<div class="ui container-fluid p-1" id="loading" style="display: none;">
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

<div class="ui container-fluid p-2" id="result2" style="display: none">
  <div class="ui segments panel">
    <div class="ui segment p-1" id="result"></div>
  </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
  $(document).ready(function() {
    $('#date_calendar_mula').calendar({
      monthFirst: false,
      type: 'date',
      formatter: {
        date: function (date, settings) {
          if (!date) return '';
          return date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
        }
      }
    });

    $('#date_calendar_akhir').calendar({
      monthFirst: false,
      type: 'date',
      formatter: {
        date: function (date, settings) {
          if (!date) return '';
          return date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
        }
      }
    });
  });

  function search(){
    var user=$('#pengguna').val();
    var datefrom=$('#datefrom').val();
    var dateto=$('#dateto').val();
    var kat=$('#katpengguna').val();

    var valuser = user == '' ? 0 : user;
    var valdatefrom = datefrom == '' ? 0 : datefrom;
    var valdateto = dateto == '' ? 0 : dateto;
    var valkat = kat == '' ? 0 : kat;

    $.ajax({ 
      type: "GET", 
      url: "{{ URL::to('/site/auditlog/searchlog/')}}?user="+valuser+"&dateform="+valdatefrom+"&dateto="+valdateto+"&kat="+valkat,
      beforeSend: function () {
        $('#loading').show();
        document.getElementById('result2').style.display = "none";
      },
      success: function(data){ 
        $('#loading').hide();
        document.getElementById('result2').style.display = "show";
        $('#result2').show();
        document.getElementById('result').innerHTML = data;
        
        $('#searchlogdata').DataTable({
          "lengthChange": false,
          "searching": false,
          "language": {
            "info": "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
            "infoEmpty": "Tiada data",
            "paginate": { "next": "Seterusnya", "previous": "Sebelumnya" }
          }
        });
      }
    });
  }

  function user(id){
    $.ajax({ 
      type: "GET", 
      url: "{{ URL::to('site/auditlog/users/')}}/"+id,
      datatype : 'json',
      beforeSend: function () {
        document.getElementById("pilihpengguna").innerHTML = "Sila Pilih";
        $('#selectpengguna').html('');
      },
      success: function(data){ 
        $('#selectpengguna').html(data);
      }
    });
  }
</script>
@endpush