@extends('laravolt::layout.app2')

@section('content')

<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0">
  <div class="column middle aligned">
    <h3 class="ui header m-t-xs">
      Kelulusan Pengguna
    </h3>
  </div>
  <!--     <div class="column right aligned middle aligned">
        <div class="item">
    <a themed="" href="/site/users/index" class="ui basic button b-0">
        <i class="icon long alternate left arrow"></i>
        Kembali
    </a>
</div>
    </div> -->

</div>

<!-- <div class="ui tabular secondary pointing menu left attached">
            <a class="item {{ ($tab == 'account')?'active':'' }}"
               href="{{ route('site::users.edit', $user['id']) }}">@lang('laravolt::menu.account')</a>
            <a class="item {{ ($tab == 'password')?'active':'' }}"
               href="{{ route('site::passwordedit', $user['id']) }}">@lang('laravolt::menu.password')</a>
</div> -->
<div class="ui container-fluid content__body p-3">
  <div class="ui segments panel">
    <div class="ui segment p-3">
      {!! form()->bind($user)->open()->post()->action(route('site::users.approveusers', $user['id']))->horizontal() !!}

      {!! form()->text('name')->label(__('Username'))->readonly() !!}
      {!! form()->text('email')->label(__('Email'))->readonly() !!}
      {!! form()->text('jabatan')->label('Jabatan / Agensi')->readonly() !!}
      {!! form()->text('jawatan')->label('Jawatan')->readonly() !!}
      {!! form()->text('notel')->label(__('No.Tel'))->readonly() !!}

      <!--  {!! form()->dropdown('status', $statuses)->label(__('laravolt::users.status')) !!} -->

      <div class="field">
        <label>Status<font color="red">*</font></label>
        <div class="ui fluid search selection dropdown">
          <input type="hidden" name="status" id="status" required="required" value="{{ data_get($user,'status') }}">
          <i class="dropdown icon"></i>
          <div class="default text">Sila Pilih</div>
          <div class="menu">
            <div class="item" data-value="">Sila Pilih</div>
            <div class="item" data-value="PENDING">DALAM PROSES</div>
            <div class="item" data-value="ACTIVE">AKTIF</div>
            <!--  <div class="item" data-value="INACTIVE">Tidak Aktif</div> -->
            <div class="item" data-value="BLOCKED">TIDAK LULUS</div>

          </div>
        </div>
      </div>

      <div class="field">
        <label>Ulasan<font color="red" id="wajib">*</font></label>
        <textarea id="ulasan" name="ulasan" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required"></textarea>
      </div>


      <div class="field" id="divcategori">
        <label>Kategori Pengguna<font color="red">*</font></label>
        <div class="ui fluid search selection dropdown">
          <input type="hidden" name="role" id="role" value="{{ old('role') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
          <i class="dropdown icon"></i>
          <div class="default text">Sila Pilih</div>
          <div class="menu">
            <div class="item" data-value="">Sila Pilih</div>
            @foreach($role as $key => $value)
            <div class="item" data-value="{{$value->id}}">{{$value->name}}</div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="field" id="divpgdaerah">
        <label>Daerah<font color="red">*</font></label>
        <div class="ui fluid search selection dropdown">
          <input type="hidden" name="daerah01" id="daerah01" value="{{ old('daerah01') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
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


      <div class="field" id="divpgmukim">
        <label>Daerah<font color="red">*</font></label>
        <div class="ui fluid search selection dropdown">
          <input type="hidden" name="daerah02" id="daerah02" value="{{ old('daerah02') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
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



      <div class="field" id="divmukim">
        <label>Mukim</label>
        <div class="ui fluid search selection dropdown">
          <input type="hidden" name="mukim" id="mukim" value="">
          <i class="dropdown icon"></i>
          <div class="default text" id="pilihmukim">Sila Pilih</div>
          <div class="menu" id="selectmukim">

          </div>
        </div>
      </div>

      <div class="ui container-fluid content__body p-3" id="loading" style="display: none;">
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

      <!--             @if($multipleRole)
                {!! form()->checkboxGroup('roles', $roles)->label('Kategori Pengguna<font color="red">*</font>')->addClassIf(!$roleEditable, 'disabled') !!}
            @else
                {!! form()->radioGroup('roles', $roles)->label('Kategori Pengguna <font color="red">*</font>')->addClassIf(!$roleEditable, 'disabled') !!}
            @endif


            @unless($roleEditable)
                <div class="field">
                    <label for="">&nbsp;</label>
                    <div class="ui message m-t-0">Editing role are disabled by system configuration.</div>
                </div>
            @endif -->


      <!--  {!! form()->action(form()->submit(__('Simpan')), form()->link(__('Kembali'), route('site::users.approveindex'))) !!}

 -->
      <div class="ui divider section"></div>
      <div align="right">
        <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validateuser();">
          Simpan
        </button>
        <a class="ui button" href="{!! URL::to('/site/approveindex') !!}" id="backbuttondown"><i class="material-icons left"></i><span>Kembali</span></a>
      </div>




    </div>
  </div>
</div>
{!! form()->close() !!}
@endsection

@push('script')
<script>
  $(document).ready(function() {

    $("#divpgdaerah").hide();
    $("#divpgmukim").hide();
    $("#divmukim").hide();
    $('#wajib').hide();
    $("#divcategori").hide();

    $('#ulasan').keyup(function() {
      $(this).val($(this).val().toUpperCase());
    });



    $("#role").change(function(e) {

      $role = this.value;

      if ($role == 2) { //daerah
        $("#divpgdaerah").show();
        $("#divpgmukim").hide();
        $("#divmukim").hide();
      } else if ($role == 3) { //mukim
        $("#divpgmukim").show();
        $("#divmukim").show();
        $("#divpgdaerah").hide();

      } else {
        $("#divpgdaerah").hide();
        $("#divpgmukim").hide();
        $("#divmukim").hide();
      }


    });

    $("#status").change(function(e) {
      var status = this.value;

       $("#divpgdaerah").hide();
        $("#divpgmukim").hide();
        $("#divmukim").hide();

      if (status == 'BLOCKED') {

        $('#wajib').show();
      } else {
        $('#wajib').hide();


      }

      if (status == 'ACTIVE') {
        $("#divcategori").show();

      } else {
        $("#divcategori").hide();

      }

    });

  });

  function mukim(id) {

    $('#daerahmukim').show();

    $('#parlimendun').hide();


    $.ajax({
      type: "GET",
      url: "{{ URL::to('site/getmukim/')}}" + "/" + id,
      datatype: 'json',

      beforeSend: function() {
        //$('div.text').html('Sila Pilih');
        document.getElementById("pilihmukim").innerHTML = "Sila Pilih";
        $('#selectmukim').html('');
        $('#loading').show();
        // $('#result2').hide();


      },

      success: function(data) {
        $('#loading').hide();


        $('#selectmukim').html(data);


      }


    });


  }

  function validateuser() {

    var status = document.getElementById("status").value; // added .value
    var role = document.getElementById("role").value; // added .value
    var ulasan = document.getElementById("ulasan").value; // added .value
    var daerah01 = document.getElementById("daerah01").value;
    var daerah02 = document.getElementById("daerah02").value;
    var mukim = document.getElementById("mukim").value;


    if (status == '') {
      alert('Sila Masukan Status');
      return false;

    } else {

      if (status === 'BLOCKED') {

        $('#ulasan').attr('required', true)

      } else {
        $('#ulasan').attr('required', false)

      }

      if (status === 'ACTIVE') {

        if (role == '') {
          alert('Sila Pilih Kategori Pengguna');
          return false;

        } else {

          if (role == '2') { //pentadbir daerah

            if (daerah01 == '') {
              alert('Sila Pilih Daerah');
              return false;
            } else {

              return true;

            }

          } else {

            if (role == '3') { //pegawai mukim

              if (daerah02 == '') {
                alert('Sila Pilih Daerah');
                return false;
              } else {

                if (mukim == '') {

                  alert('Sila Pilih Mukim');
                  return false;

                } else {
                  return true;

                }



              }

            } else {
              return true;

            }


          }


        }


      } else {

        return true;
      }




    }

  }
</script>
@endpush