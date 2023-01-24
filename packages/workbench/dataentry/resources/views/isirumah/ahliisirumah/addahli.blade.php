@extends('laravolt::layout.app2')

@section('content')
<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0" >
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs">
          Maklumat Ahli Isi Rumah
        </h3>
    </div> 
    <div class="column right aligned middle aligned">

           <a class="ui button" href="{!! URL::to('dataentry/searchkampung/isirumah/ahliisirumah/'.$idkampung.'/'.$idrumah) !!}" id="backbutton"><i class="material-icons left"></i><span>Kembali</span></a>
    </div>
</div>
<br>
 <h4 class="ui top attached header">
  Tambah Maklumat Ahli Isi Rumah - {{data_get($infokampung,'NamaKampung')}}
</h4>
<div class="ui attached segment">

	 {!! form()->open()->post()->action(route('dataentry::searchkampung.saveahli'))->attribute('id', 'formstruk')->multipart()->horizontal() !!}
           <input type="hidden" name="idkampung"  required="required" value="{{$idkampung}}">
           <input type="hidden" name="idrumah"  required="required" value="{{$idrumah}}">
           <input type="hidden" name="wn" id="wn" value="" >

        <div class="field">
		            <label>Nama Ahli Isi Rumah<font color="red">*</font></label>
		            <input type="text" name="name" id="name" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required">
			</div>
            <div class="field">
              <label>Jenis Pengenalan<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="typepengenalan" id="typepengenalan" value="{{ old('jantina') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="" value="0">Sila Pilih</div>
                      @foreach($jenispengenalan as $key => $value)
                       <div class="item" data-value="{{$value->id}}" onclick="warga({{$value->id}})">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
         <div class="field" id="divnoic">
                <label>No. Kad Pengenalan<font color="red">*</font></label>
                <input max="14" name="noic" id="noic"  type="text" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" onKeyPress="if(this.value.length==12) return false;" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required">
          </div>
          <div class="field" id="divnoicnotes">
                <label>&nbsp;</label>
               (Sila masukkan No. Kad Pengenalan (cth: 98xxxxxxxxxx). (Tanpa "-" atau jarak))
          </div>
          <div class="field" id="divnopengenalan">
                <label>No. Tentera/No. Polis/Passport<font color="red">*</font></label>
                <input max="14" name="nopengenalan" id="nopengenalan"  type="text" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') " required="required">
          </div>
           <div class="field" id="divnopengenalannotes">
                <label>&nbsp;</label>
               (Sila masukkan No. Kad Pengenalan (cth: 98xxxxxxxxxx)/<br>No. Perkhidmatan Tentera (cth: Txxxxx) / No. Perkhidmatan Polis (cth: RFxxxxx/RFSxxxxx/Gxxxxx))
          </div>
        <div class="field" id="tlahircal">
                <label id="labellahir">Tarikh Lahir<font color="red">*</font></label>
               <div class="ui calendar" id="standard_calendar">
                <div class="ui input left icon">
                  <i class="calendar icon"></i>
                  <input type="text" id="tarikhlahir" name="tarikhlahir" readonly="readonly" required="required">
                </div>
            </div>
      </div>
      <div class="field" id="tlahirauto">
                <label id="labellahirauto">Tarikh Lahir<font color="red">*</font></label>
                  <input type="text" id="tarikhlahirauto" name="tarikhlahirauto" readonly="readonly" required="required">
      </div>
        <div class="field">
                <label>Umur<font color="red">*</font></label>
                <input type="text" name="umur" id="umur" readonly="readonly" required="required">
        </div>
	
 		   <div class="field" id="jantinapilih">
              <label id="labeljantina">Jantina<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="jantina" id="jantina" value="{{ old('jantina') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($jantina as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>

            <div class="field" id="jantinaauto">
                <label id="labeljantinaauto">Jantina<font color="red">*</font></label>
                <input type="text" id="jauto" name="jauto" readonly="readonly">
          </div>
         <div class="field">
               <label>Warganegara<font color="red">*</font></label>
	      <div class="inline fields">
        
        <div class="field">
          <div class="ui radio checkbox">
            <input type="radio" name="warga" id="warga" tabindex="0" class="hidden" value="1" required="required" disabled="disabled">
            <label>Warganegara</label>
          </div>
        </div>
        <div class="field">
          <div class="ui radio checkbox">
            <input type="radio" name="warga" id="nonewarga" tabindex="0" class="hidden" value="0" disabled="disabled">
            <label>Bukan Warganegara</label>
          </div>
        </div>
      </div>
    </div>
               <div class="field">
              <label>Bangsa<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="bangsa" id="bangsa" value="{{ old('bangsa') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($bangsa as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
				  <div class="field">
              <label>Agama<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="agama" id="agama" value="{{ old('agama') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($agama as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
              <div class="field">
              <label>Taraf Perkahwinan<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="taraf" id="taraf" value="{{ old('taraf') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($taraf as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
              <div class="field">
              <label>Status Pekerjaan<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="statuskerja" id="statuskerja" value="{{ old('statuskerja') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($statuskerja as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
   
             <div class="field">
		            <label>Pekerjaan<font color="red">*</font></label>
		            <input type="text" name="kerja" id="kerja" required="required">
			</div>
				<div class="field">
		            <label>Pendapatan Isi Rumah<font color="red">*</font></label>
		            <input type="text" name="pendapat" id="pendapat" required="required">
				</div>

		 <div class="field">
              <label>Penerima Bantuan (Bulanan)<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="bantuanbulan" id="bantuanbulan" value="{{ old('bantuanbulan') }}" onchange="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Medan ini Wajib') ">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($bantuanbulanan as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->description}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
				 <div class="field">
		            <label>Bantuan Lain-Lain<font color="red" id="wajib">*</font></label>
		            <input type="text" name="bantuanlain" id="bantuanlain" readonly="readonly" required="required">
			</div>

 				<div class="ui divider section"></div>
		        <div align="right">
		                    <button type="submit" class="ui button primary" id="addbutton" name="hantar" onclick="return validateahli();">
		                        Simpan
		                    </button>
		                   <!--  <button class="ui button"><a href="#">Kembali</a></button>    --> 
		                </div>



</div>
 {!! form()->close() !!}
@endsection

@push('script')

<script type="text/javascript">

  $(document).ready(function() 
  {

     $('#wajib').hide();

     $('#name').keyup(function()
    {
        $(this).val($(this).val().toUpperCase());
    });

  $('#kerja').keyup(function()
    {
        $(this).val($(this).val().toUpperCase());
    });
    $('#bantuanlain').keyup(function()
    {
        $(this).val($(this).val().toUpperCase());
    });
   

    $('#standard_calendar')
  .calendar({
    monthFirst: false,
    type: 'date',
    formatter: {
      date: function (date, settings) {
        if (!date) return '';
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        return day + '/' + month + '/' + year;
      }
    },
    onChange: function (date, text) {
     var newValue = text;

      const d = new Date();
      let curyear = d.getFullYear();
      var year = date.getFullYear();

       var umur = curyear-parseInt(year)

     $('#umur').val(umur);

   
    },
  })
;



$("#pendapat").change(function() {
    var $this = $(this);
    $this.val(parseFloat($this.val()).toFixed(2));        
});


$('#tlahirauto').hide();
$('#jantinaauto').hide();


$('#divnopengenalan').hide();
$('#divnopengenalannotes').hide();
$('#divnoic').show();
$('#divnoicnotes').show();


$("#noic").on("keyup", function(){

var type=$("#typepengenalan").val();

   if(type==''){
    alert('Sila Pilih Jenis Pengenalan');
    $("#noic").val('');

   }

 });



 // $("#noic").on("keyup", function(){

 //      var noic=this.value;

 //      const str = this.value;
	//   const substr = str.slice(0, 6);

	  

	//   let str2 = substr;

	//   let year = str2.substring(0, 2);

	//   let month = str2.substring(2, 4);

	//   let day = str2.substring(4, 6);

	  

	//   let startyear=str2.substring(0, 1);

	//   if(startyear==0 || startyear==1 || startyear==2){

	//   	var pangkal='20';

	//   }else{

	//   	var pangkal='19'


	//   }

	//   var lahir=day+'-'+month+'-'+pangkal+year;

	//   var tahun=pangkal+year;

	//   $('#tarikhlahir').val(lahir);

	  

	//    const d = new Date();
	//    let curyear = d.getFullYear();

	//    var umur = curyear-parseInt(tahun)

	//    $('#umur').val(umur);

	 

 //     });

    $("#pendapat").on("keyup", function(){
                     var valid = /^\d{0,20}(\.\d{0,2})?$/.test(this.value),
                      val = this.value;

                    if(!valid){
                        console.log("Invalid input!");
                        this.value = val.substring(0, val.length - 1);
                    }
                   });

	      $("#bantuanbulan").change(function(e) {

          var jenis=this.value;

          if(jenis==138){
            
            $('#bantuanlain').prop('readonly', false);
            $('#wajib').show();
            //$('#bantuanlain').attr('required', false)

          }else{

            $('#bantuanlain').prop('readonly', true);
            $('#wajib').hide();
            //$('#bantuanlain').attr('required', true);

          }


         });



    });
 function validateahli() {

  	var typepengenalan = document.getElementById("typepengenalan").value; // added .value
    var pjgic=$('#noic').val();
    var jantina = document.getElementById("jantina").value; // added .value
    var warga = document.getElementById("warga").value; // added .value
    var bangsa = document.getElementById("bangsa").value; // added .value
    var agama = document.getElementById("agama").value; // added .value
    var taraf = document.getElementById("taraf").value; // added .value
    var statuskerja = document.getElementById("statuskerja").value; // added .value
    var bantuanbulan = document.getElementById("bantuanbulan").value; // added .value
    var umur = document.getElementById("umur").value; // added .value
   
     
   	


  	 if(typepengenalan==''){

      alert('Sila Pilih Jenis Pengenalan');

      return false;

     }else{

      if(typepengenalan==150){//kad pengenalan baru

        $('#noic').attr('required', true);
        $('#nopengenalan').attr('required', false)
      }else{

        $('#noic').attr('required', false);
        $('#nopengenalan').attr('required', true)

          }

        if(jantina=='' && typepengenalan!=150){
          alert('Sila Pilih Jantina');
            return false;

        }else{

          if(bangsa==''){
             alert('Sila Pilih Bangsa');
             return false;
          }else{

            if(umur=='' && typepengenalan==150){


              alert('Sila Masukan Kad Pengenalan');
                return false;

            }else{

              if(umur==''){
                alert('Sila Masukan Tarikh Lahir');
                 return false;
              }else{

                  if(agama==''){

                  alert('Sila Pilih Agama')
                    return false;

                    }else{

                       if(taraf==''){

                        alert('Sila Pilih Taraf Perkahwinan')
                          return false;

                          }else{

                             if(statuskerja==''){

                            alert('Sila Pilih Status Perkerjaan')
                              return false;

                              }else{

                                if(bantuanbulan==''){

                                  alert('Sila Pilih Penerima Bantuan (Bulanan)')
                                  return false;

                                  }else{

                                  if(bantuanbulan==138){//
                                    
                                    //$('#bantuanlain').prop('readonly', false);
                                    $('#bantuanlain').attr('required', true)

                                  }else{

                                    //$('#bantuanlain').prop('readonly', true);
                                    $('#bantuanlain').attr('required', false);

                                  }
                                  
                                  } 

                                  return true;
                                }
                              }
                            }  
                          }
                        } 
                      }
                    }
                }
             }
 function warga($type) {

  var warga=106;
  var bukanwarga=107;


$('#tarikhlahirauto').val('');
$('#tarikhlahir').val('');
$('#noic').val('');
$('#umur').val('');
$('#nopengenalan').val('');

if($type==150){//kad pengenalan baru

        $('#tlahirauto').show();
        $('#tlahircal').hide();

        $('#jantinaauto').show();
        $('#jantinapilih').hide();

        $('#divnopengenalan').hide();
        $('#divnopengenalannotes').hide();
        $('#divnoic').show();
        $('#divnoicnotes').show();

        $('#noic').attr('required', true)



        

  //$("#labellahirauto").html("Tarikh Lahir<font color='red'>*</font>");

   $("#labellahirauto").append("");
   $("#labeljantinaauto").append("");


   

 $("#noic").on("keyup", function(){


    var noic=this.value;

    const str = this.value;
    const substr = str.slice(0, 6);

    

    let str2 = substr;

    let year = str2.substring(0, 2);

    let month = str2.substring(2, 4);

    let day = str2.substring(4, 6);

    let startyear=str2.substring(0, 1);



    if(startyear==0 || startyear==1 || startyear==2){

      var pangkal='20';

    }else{
       var pangkal='19'


    }

    var lahir=day+'-'+month+'-'+pangkal+year;

    var tahun=pangkal+year;

    if(day==''){
        $('#tarikhlahirauto').val('');

    }else{
        $('#tarikhlahirauto').val(lahir);

    }

  

    

     const d = new Date();
     let curyear = d.getFullYear();

     var umur = curyear-parseInt(tahun)



    if(day==''){
        $('#umur').val('');

    }else{
        $('#umur').val(umur);

    }


    const subst3 = str.slice(0, 12);

    

    let str3 = subst3;

    let last = str3.substring(11, 12);

    

    var number=last;


    if(number==''){

       $('#jauto').val('');

    }else{

    if(number % 2 == 0){

      
      $('#jauto').val('Perempuan');

    }else{
       $('#jauto').val('Lelaki');

    }
    

    }


     });
        

      }else{

        $('#tlahirauto').hide();
        $('#tlahircal').show();
        $("#labellahir").html("Tarikh Lahir<font color='red'>*</font>");
         $('#jantinaauto').hide();
        $('#jantinapilih').show();
         $("#labeljantina").html("Jantina<font color='red'>*</font>")

        $('#divnopengenalan').show();
        $('#divnopengenalannotes').show();
        $('#divnoic').hide();
        $('#divnoicnotes').hide();

        $('#noic').attr('required', false)

      }


  if($type==152){//paspport

    $("#nonewarga").prop("checked", true);
     $("#wn").val(0);

  }else{

      $("#warga").prop("checked", true);
      $("#wn").val(1);


  }


  }
</script>
@endpush