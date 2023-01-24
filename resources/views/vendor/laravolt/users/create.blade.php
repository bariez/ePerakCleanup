@extends('laravolt::layout.app2')

@section('content')

<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0">
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs">
           Tambah Pengguna
        </h3>
    </div>
<!--     <div class="column right aligned middle aligned">
        <div class="item">
    <a themed="" href="http://eperak.devs/epicentrum/users" class="ui basic button b-0">
        <i class="icon long alternate left arrow"></i>
        Kembali
    </a>
</div>
    </div> -->
</div>


<div class="ui container-fluid content__body p-3">
        <div class="ui segments panel">
<!--             <div class="ui segment panel__header ">
                <div class="ui menu secondary borderless m-0 p-0" style="min-height: 0">
                    <div class="item p-0 m-0">
                        <h4 class="panel__title ui header p-x-sm p-y-0">
                            <i class="plus icon"></i> Tambah Pengguna
                        </h4>
                    </div>
                
                
            </div>
        </div> -->

        <div class="ui segment p-3">
        {!! form()->open()->post()->action(route('site::users.store'))->horizontal() !!}


      <div class="field">
        <label>Nama<font color="red">*</font></label>
        <input type="text" name="name" id="name" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required" value="{{ old('name') }}">
    </div>
    <div class="field">
        <label>Emel Rasmi<font color="red">*</font></label>
        <input type="text" name="email" id="email" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required" value="{{ old('email') }}">
    </div>
    <div class="field">
        <label>Kata Laluan<font color="red">*</font></label>
        <input type="text" name="password" id="password">
        <button type="button" class="ui button randomize" themed="">Kata Laluan</button>
    </div>
    <div class="field">
        <label>&nbsp;</label>
        (*Sila masukkan gabungan abjad, nombor & aksara khas.Panjang kata laluan 8 karakter.)
    </div>

    <div class="field">
        <label>Jabatan / Agensi<font color="red">*</font></label>
        <input type="text" name="jabatan" id="jabatan" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required" value="{{ old('jabatan') }}">
    </div>
     <div class="field">
        <label>Jawatan<font color="red">*</font></label>
        <input type="text" name="jawatan" id="jawatan" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required" value="{{ old('jawatan') }}">
    </div>
    <div class="field">
        <label>No.Tel<font color="red">*</font></label>
        <input type="text" name="notel" id="notel" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required="required" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " value="{{ old('notel') }}" required="required" onKeyPress="if(this.value.length==12) return false;">
    </div>
         <div class="field">
              <label>Status<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="status" id="status"  required="required" value="{{ old('status') }}">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      <div class="item" data-value="ACTIVE">Aktif</div>
                      <div class="item" data-value="INACTIVE">Tidak Aktif</div>
                     
                    </div>
                  </div>
              </div>

           <div class="field">
              <label>Kategori Pengguna<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="role" id="role" value="" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
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
                    <div class="default text" id="pilihdaerah01">Sila Pilih</div>
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
                    <div class="default text" id="pilihdaerah02">Sila Pilih</div>
                    <div class="menu" id="selectdaerah">
                      <div class="item" data-value="" onclick="mukim(0)">Sila Pilih</div>
                      @foreach($daerah as $key => $value)
                       <div class="item" data-value="{{$value->id}}" onclick="mukim({{$value->id}})">{{$value->NamaDaerah}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
                <div class="field" id="divmukim">
                          <label>Mukim<font color="red">*</font></label>
                               <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="mukim" id="mukim" value="" >
                                <i class="dropdown icon"></i>
                                <div class="default text" id="pilihmukim">Sila Pilih</div>
                                <div class="menu" id="selectmukim">
                                 
                                </div>
                            </div>
                     </div>

 <div class="ui container-fluid content__body p-3" id="loading" style="display: none;">
        <div class="ui segments panel">
            <div class="ui segment p-3">
                  <div class="ui blue sliding indeterminate progress" >
                        <div class="bar">
                            <div class="progress">Sila Tunggu Sebentar</div>
                        </div>
                </div>
            </div>
        </div>
  
    </div>

 <!--        {!! form()->select('status', $statuses)->label(__('Status')) !!} -->
       <!--  {!! form()->select('timezone', $timezones, config('app.timezone'))->label(__('laravolt::users.timezone')) !!} -->



   <!--      <div class="field">

            <label for="">Opsi Tambahan</label>
            <div class="field">
                {!! form()->checkbox('send_account_information', 1)->label(__('laravolt::users.send_account_information_via_email')) !!}
                {!! form()->checkbox('must_change_password', 1)->label(__('laravolt::users.change_password_on_first_login')) !!}
            </div>
        </div> -->


   

           <div class="ui divider section"></div>
            <div align="right">
                        <button type="submit" class="ui button primary" id="hantar" name="hantar" onclick="return validateuser();">
                            Simpan
                        </button>
                        <a class="ui button" href="{!! URL::to('/site/users/index') !!}"><i class="material-icons left"></i><span>Kembali</span></a>   
                    </div>
        </div>

        
    </div>
</div>




@endsection
@push('script')
  <script>
            $(function () {
                $('.randomize').on('click', function (e) {

                   var length = 8,
                      charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%^&*()<>.?!~+=",
                      retVal = "";
                  for (var i = 0, n = charset.length; i < length; ++i) {
                      retVal += charset.charAt(Math.floor(Math.random() * n));
                  }
                 

                    $('#password').val(retVal);
                     // $('#password').attr('required', false);
                     $('#password').removeAttr('required')
                     $('#password').removeAttr('onchange',this.setCustomValidity(""));
                     $('#password').removeAttr('oninvalid',this.setCustomValidity("Medan ini Wajib"));

                    // $(e.currentTarget).prev().val(Math.random().toString(36).substr(2, 8));
                });
            });

$(document).ready(function() 
  {  
     
     $("#divpgdaerah").hide();
     $("#divpgmukim").hide();
     $("#divmukim").hide();

   
     $("#role").change(function(e){

        
       document.getElementById("pilihdaerah01").innerHTML = "Sila Pilih";
       document.getElementById("pilihdaerah02").innerHTML = "Sila Pilih";
        document.getElementById("pilihmukim").innerHTML = "Sila Pilih";

        $role=this.value;

        if($role==2){//daerah
           $("#divpgdaerah").show();
           $("#divpgmukim").hide();
           $("#divmukim").hide();
        }else if($role==3){//mukim
          $("#divpgmukim").show();
          $("#divmukim").show();
           $("#divpgdaerah").hide();

        }else{
           $("#divpgdaerah").hide();
           $("#divpgmukim").hide();
           $("#divmukim").hide();
        }


     });


     $('#name').keyup(function() {
      $(this).val($(this).val().toUpperCase());
    });
     $('#jabatan').keyup(function() {
      $(this).val($(this).val().toUpperCase());
    });
     $('#jawatan').keyup(function() {
      $(this).val($(this).val().toUpperCase());
    });
     
  });

     function mukim(id){

     $('#daerahmukim').show();

     $('#parlimendun').hide();

      var role = document.getElementById("role").value; // added .value
    
         
       $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('site/getmukim/')}}"+"/"+id,
            datatype : 'json',

            beforeSend: function ()
            {
         
               document.getElementById("pilihdaerah02").innerHTML = "Sila Pilih";
               $('#selectmukim').html('');

               if(role==3){
                $('#loading').show();
               }
               
              // $('#result2').hide();
               

            },
            
            success: function(data){ 
              $('#loading').hide();

        
             $('#selectmukim').html(data);
           

           }


          });


     }
      function validateuser() {

        var status = document.getElementById("status").value; // added .value
         var role = document.getElementById("role").value; // added .value
          var daerah01=document.getElementById("daerah01").value;
          var daerah02=document.getElementById("daerah02").value;
          var mukim=document.getElementById("mukim").value;
          var password=document.getElementById("password").value;


  

       if(password==''){

          alert('Sila Masukan Kata Laluan');
           return false;

       }else{

        if(status==''){
          alert('Sila Masukan Status');
           return false;

        }else{

            

        if(role==''){
            alert('Sila Pilih Kategori Pengguna');
           return false;

         }else{

          if(role=='2'){//pentadbir daerah

            if(daerah01==''){
              alert('Sila Pilih Daerah');
              return false;
            }else{

              return true;

            }

          }else{

            if(role=='3'){//pegawai mukim

            if(daerah02==''){
              alert('Sila Pilih Daerah');
              return false;
            }else{

              if(mukim==''){

             alert('Sila Pilih Daerah');
              return false;

              }else{
                  return true;

              }

            

            }

            }else{
                    return true;

             

            }


          }

     
         }

        }


       }

}


        </script>
@endpush
