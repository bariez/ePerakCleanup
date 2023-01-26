@extends('laravolt::layout.app2')

@section('content')

<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0">
    <div class="column middle aligned">
        <h3 class="ui header m-t-xs">
           Kemaskini Pengguna
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
          {!! form()->bind($user)->open()->post()->action(route('site::users.update', $user['id']))->horizontal() !!}

     <div class="field">
        <label>Nama<font color="red">*</font></label>
        <input type="text" name="name" id="name" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required" value="{{ data_get($user,'name') }}">
    </div>
    <div class="field">
        <label>Emel Rasmi<font color="red">*</font></label>
        <input type="text" name="email" id="email" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required" value="{{ data_get($user,'email') }}">
    </div>
     <div class="field">
        <label>Jabatan / Agensi<font color="red">*</font></label>
        <input type="text" name="jabatan" id="jabatan" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required" value="{{ data_get($user,'jabatan') }}">
    </div>
     <div class="field">
        <label>Jawatan<font color="red">*</font></label>
        <input type="text" name="jawatan" id="jawatan" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required" value="{{ data_get($user,'jawatan') }}">
    </div>
    <div class="field">
        <label>No.Tel<font color="red">*</font></label>
        <input type="text" name="notel" id="notel" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required="required" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " value="{{data_get($user,'notel') }}" required="required" onKeyPress="if(this.value.length==12) return false;">
    </div>
     
     <div class="field">
              <label>Status<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="status"  required="required" value="{{ data_get($user,'status') }}">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      <div class="item" data-value="ACTIVE">Aktif</div>
                      <div class="item" data-value="INACTIVE">Tidak Aktif</div>
                  <!--      <div class="item" data-value="BLOCKED">Tidak Lulus</div> -->
                     
                    </div>
                  </div>
              </div>
                <div class="field">
              <label>Kategori Pengguna<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="role" id="role" value="{{ data_get($roleuser,'role_id') }}">
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

        <div class="field" id="divpgdaerahedit">
              <label>Daerah<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown" id="selected01">
                    <input type="hidden" name="daerah01edit" id="daerah01edit" value="{{ data_get($user,'Daerah') }}" >
                    <i class="dropdown icon"></i>
                    <div class="default text" id="pilihdaerah01edit">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($daerah as $key => $value)
                       <div class="item" data-value="{{$value->id}}" >{{$value->NamaDaerah}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>

               <div class="field" id="divpgdaerah">
              <label>Daerah<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown" id="selected01">
                    <input type="hidden" name="daerah01" id="daerah01" value="" >
                    <i class="dropdown icon"></i>
                    <div class="default text" id="pilihdaerah01">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($daerah as $key => $value)
                       <div class="item" data-value="{{$value->id}}" >{{$value->NamaDaerah}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>


   <div class="field" id="divpgmukim">
              <label>Daerah<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown selected02">
                    <input type="hidden" name="daerah02" id="daerah02" value="{{ data_get($user,'Daerah') }}">
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

 <div class="field" id="diveditmukim">
                          <label>Mukim<font color="red">*</font></label>
                               <div class="ui fluid search selection dropdown selectedmukim">
                                <input type="hidden" name="mukimedit" id="mukimedit" value="{{data_get($user,'Mukim')}}" >
                                <i class="dropdown icon"></i>
                                <div class="default text" id="pilihmukimedit">Sila Pilih</div>
                                <div class="menu" id="selectmukimedit">
                                  <div class="item" data-value="">Sila Pilih</div>
                                  @foreach($mukim as $key => $value)
                                   <div class="item" data-value="{{$value->id}}">{{$value->NamaMukim}}</div>
                                    @endforeach
                                </div>
                                 
                                </div>
                            </div>



                <div class="field" id="divmukim">
                          <label>Mukim<font color="red">*</font></label>
                               <div class="ui fluid search selection dropdown selectedmukim">
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


   <div class="ui divider section"></div>
            <div align="right">
                        <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validateuser();">
                            Simpan
                        </button>
                        <a class="ui button" href="{!! URL::to('/site/users/index') !!}" id="bacbuttondown"><i class="material-icons left"></i><span>Kembali</span></a>   
                    </div>


</div>
</div>
</div>

@endsection
@push('script')
  <script>

$(document).ready(function() 
  {  
     var role="{{data_get($roleuser,'role_id')}}";
     var daerah="{{data_get($user,'Daerah')}}";



    if(role==2){//daerah
           $("#divpgdaerah").hide();
           $("#divpgdaerahedit").show();
           $("#divpgmukim").hide();
           $("#divmukim").hide();
           $("#diveditmukim").hide();
           
        }else if(role==3){//mukim
          $("#divpgmukim").show();
          $("#divmukim").hide();
           $("#divpgdaerah").hide();
           $("#divpgdaerahedit").hide();

        }else{
           $("#divpgdaerah").hide();
           $("#divpgdaerahedit").hide();
           $("#divpgmukim").hide();
           $("#divmukim").hide();
             $("#diveditmukim").hide();
        }

         

       $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('site/getmukim/')}}"+"/"+daerah,
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

              var daerah="{{data_get($user,'Daerah')}}";
              var mukim="{{data_get($user,'Mukim')}}";

             $('.selected02') .dropdown('set selected', daerah);
              $('.selectedmukim') .dropdown('set selected', mukim);
             


           

           }


          });

   
     $("#role").change(function(e){

        
       document.getElementById("pilihdaerah01").innerHTML = "Sila Pilih";
       document.getElementById("pilihdaerah02").innerHTML = "Sila Pilih";
        document.getElementById("pilihmukim").innerHTML = "Sila Pilih";

        $role=this.value;

        if($role==2){//daerah
           $("#divpgdaerah").show();
           $("#divpgdaerahedit").hide();
           $("#divpgmukim").hide();
           $("#divmukim").hide();
           $("#diveditmukim").hide();
        }else if($role==3){//mukim
          $("#divpgmukim").show();
          $("#divmukim").show();
          $("#diveditmukim").hide();
          $("#divpgdaerah").hide();
          $("#divpgdaerahedit").hide();

///reset balik dropdown mukim & daearah
       $.ajax({ 
            type: "GET", 
            url: "{{ URL::to('site/getmukim/')}}"+"/"+0,
            datatype : 'json',

            beforeSend: function ()
            {
         
               document.getElementById("pilihdaerah02").innerHTML = "Sila Pilih";
               $('#selectmukim').html('');

               if(role==3){
                $('#loading').show();
               }
   
            },
            
            success: function(data){ 
              $('#loading').hide();

        
             $('#selectmukim').html(data);

              var daerah="{{data_get($user,'Daerah')}}";
              var mukim="{{data_get($user,'Mukim')}}";

             $('.selected02') .dropdown('set selected', '');
              $('.selectedmukim') .dropdown('set selected', '');

           }


          });
//////////////////////////////////////////////////////////////

        }else{
           $("#divpgdaerah").hide();
            $("#divpgdaerahedit").hide();
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
                $("#diveditmukim").hide();
                 $("#divmukim").show();
               
              // $('#result2').hide();
               

            },
            
            success: function(data){ 
              $('#loading').hide();
              $("#diveditmukim").hide();
              $("#divmukim").show();

        
             $('#selectmukim').html(data);

           

           }


          });


     }
      function validateuser() {

        //var status = document.getElementById("status").value; // added .value
          var role = document.getElementById("role").value; // added .value
         
          var daerah02=document.getElementById("daerah02").value;


 if($('#divpgdaerah').is(':visible')==true){
       var daerah01=document.getElementById("daerah01").value;

   }else{
       var daerah01=document.getElementById("daerah01edit").value;

   }
    if($('#divmukim').is(':visible')==true){
      var mukim=document.getElementById("mukim").value;

   }else{
      var mukim=document.getElementById("mukimedit").value;

   }


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

                if(daerah02!=''){

                alert('Sila Pilih Mukim');
              return false;

                }else{

                alert('Sila Pilih Daerah');
              return false;

                }


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


        </script>
@endpush
