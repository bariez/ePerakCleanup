<!DOCTYPE html>
<html lang="en">

<head>
    <title>LHDNM - MyTax</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="MyTax - Gerbang Informasi Percukaian" />
    <meta name="keywords" content="lhdn,cukai,bayar cukai,ckht">
    <meta name="author" content="LHDNM" />

    <link rel="icon" href="{{asset('themes/ablepro/assets/images/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('themes/ablepro/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('themes/ablepro/assets/css/plugins/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('themes/ablepro/assets/css/plugins/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('themes/ablepro/assets/css/plugins/trumbowyg.min.css')}}">

    <link rel="stylesheet" href="{{asset('themes/ablepro/assets/css/plugins/dataTables.bootstrap4.min.css')}}">
<style scoped>

 .print-fly {   
        background-color: white;
         font-size:10px;

    }
 .print-flys {   
        background-color: white;
        width:auto;
    }



.on-the-fly-behavior {
    background-image: url('{{ asset('assets/images/bg.png') }}');
    background-repeat:no-repeat;
    background-size: contain;
}
.langdisp
{
    background-color: darkmagenta;
    border-radius: 20px;
    margin-right: 10px;
    margin-top: 20px !important;
    padding-top: 10px;
    padding-bottom: 14px;
    padding-right: 20px;
    padding-left: 20px;"

}

@media (max-width: 1200px) 
{ 
    .on-the-fly-behavior {   
        background-image: url('{{ asset('assets/images/bg.png') }}');
        background-repeat:no-repeat;
        background-size: unset;
    }

    .langdisp
{
    background-color: unset !important;
    border-radius:  unset !important;
    margin:  unset !important;
    padding:  unset !important;

}

}
</style>

</head>

<body class="on-the-fly-behavior" id="body1">



    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    @include('ui::ablepro.menu')

    <div class="pcoded-main-container" style="background-color: #E1E1E3;">
        <div class="pcoded-content">
            <div style="display: none" id="logins"></div>
            @include('ui::ablepro.header')
            @yield('content')
        </div>

    </div>

    <nav class="navbar navbar-fixed-bottom nav-bar-footer" role="navigation" style="box-shadow: 0px 3px 0px 0px rgba(69, 90, 100, 0.3);">
            <div class="container text-center">
                <p class="col-md-12 col-sm-12 col-xs-12 nav-bar-footer-text">
                    <a href="#" class="        rs-link        rs-link-inactive" style="color: #FFFFFF;" data-link-desktop="Versi Penuh" data-link-responsive="Versi Mudah Alih" data-original-title="" title=""></a>
                    <br>
                    ©
                    <span id="ctl00_Label9">Hak Cipta Terpelihara {{date('Y')}} Lembaga Hasil Dalam Negeri Malaysia</span>
                </p>
            </div>
        </nav>

<?php 

use App\User;
$users= auth()->user();
$id = $users->id;
$user= User::where('id',$id)->first();

$locale = Session::get('locale');

if($user){

  $username = base64_encode($user->reference_id); 
  $pass = $user->password; 
  $type = $user->reference_type;

   $urls=env('API_DOMAIN')."/SSOService.svc/user/login?username=".$username."&password=".$pass."&IdType=".$type."&nocp=undefined";  
   $url ="";

  
}else{

  $url = env('API_DOMAIN')."/SSOService.svc/user/Logout";
}
?>


<script src="{{asset('themes/ablepro/assets/js/vendor-all.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/ripple.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/swiper.min.js')}}"></script>

<script src="{{asset('themes/ablepro/assets/js/plugins/apexcharts.min.js')}}"></script>
    <script>
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
        )
      window.Promise ||
        document.write(
          '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
        )
    </script>
<script src="{{asset('themes/ablepro/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pages/form-validation.js')}}"></script>


<script src="{{asset('themes/ablepro/assets/js/plugins/moment.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/daterangepicker.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pages/ac-datepicker.js')}}"></script>

<script src="{{asset('themes/ablepro/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
<script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/master/dist/jquery-resizable.min.js"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/trumbowyg.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/plugins/fontsize/trumbowyg.fontsize.min.js"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/resize.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/sweetalert.min.js')}}"></script>


<link href="{{ asset('dflip/css/dflip.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('dflip/css/themify-icons.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('dflip/js/dflip.min.js') }}" type="text/javascript"></script>
<script>
  var dFlipLocation = "{{ asset('dflip') }}";
</script>

 <script>

      var langs = <?php echo "'".$locale."'" ?>;
      var lang = 1;

      if(langs == 'en')
      {
           lang = 2;

      }
     
      if (lang == 1) { var lhdn_lang = "en" } else { var lhdn_lang = "en"; }
     
      var is_populate_chat = false;
      var lhdn_kb = ["am,syarikat,cukai_keuntungan_harta_tanah,duti_setem,ez_hasil,individu,majikan,selain_individu_dan_selain_syarikat"];
      var welcome_gkc = "true";
    </script>

<script src="{{asset('chat/widgets.config_chat.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function () {

        $('#logins').html('<img src="{{$url}}" style="dislpay:none">');

    });

</script>



<script>
  $(document).ready(function() {


    $('.animation-toggle').mouseenter(function() {
     var anim = $(this).attr('data-animate');
      $(this).addClass('animated');
      $(this).addClass(anim);
      setTimeout(function() {
        $('.animation-toggle').removeClass(anim);
      }, 500);
  })


   


  });
</script>

<script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true, 
      keyboard: {
        enabled: true,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        640: {
          slidesPerView: 2,
          spaceBetween: 10,
        },
        768: {
          slidesPerView: 4,
          spaceBetween: 10,
        },
        1024: {
          slidesPerView: 4,
          spaceBetween: 10,
        },
      }
    });
</script>

<script type="text/javascript">
  

            var format = new Intl.NumberFormat('en-MYR', { 
                style: 'currency', 
                currency: 'MYR', 
                minimumFractionDigits: 2, 
            }); 

</script>

<script type="text/javascript">
  

  // var myTimer = window.setInterval(checksession, 10000);
 // var t = setTimeout(callApis, 60000*11);

  function checksession(){

     
     $.get('{{env("API_TOKEN")}}', {}, function(ssodata) {

          var datas = JSON.stringify(ssodata.RequestTokenMyTaxResult);
          var myObj = JSON.parse(datas);

          console.log(datas);

         if (myObj.Status == 'Success') {}
         else {callApis();}


    }, 'jsonp');

      
  };

  

  function callApis() {
  window.clearInterval(myTimer);

    var timeleft = 10;
    var downloadTimer = setInterval(function(){
      if(timeleft <= 0){
        clearInterval(downloadTimer);
        swal.close();
        $('.swal-title').html('Please wait...');
        
      } else {


        var langs = <?php echo "'".$locale."'" ?>;

        if(langs === 'ms')
        {
            $('.swal-title').html('<span style="font-size:16px;">Adakah anda masih ingin meneruskan sesi ini ?<br>'+timeleft+'<span>');

        }else
        {
            $('.swal-title').html('<span style="font-size:16px;">Are you want to continue this session ?<br>'+timeleft+'<span>');
        }
       
      }
      timeleft -= 1;
    }, 1000);


        var langs = <?php echo "'".$locale."'" ?>;

        if(langs === 'ms')
        {
            var titles = 'Sesi anda hampir tamat';
            var stitle = 'Sesi anda berjaya disambung';
            var etitle = 'Anda telah di log keluar';

        }else
        {
            var titles = 'Your Session is Expiring';
            var stitle = 'Session successfully extended';
            var etitle = 'You will be logged out';
        }

                swal({
                title: titles,
                content: "Are you want to continue this session ?",
                icon: "warning",
                timer: 10000,
                buttons: true,
                allowOutsideClick: false,

            }).then(function(willDelete) {
                if (willDelete) {


                   var token = '<?php echo $user->token ?>';
                    $.ajax({

                        type: "GET", 
                        url: "{{ URL::to('sso?')}}"+"token="+token,
                               
                        beforeSend: function () 
                        {
                              
                        },
                        success: function(data)
                        {       

                            if(data == 1){

                                swal(stitle, {
                                    icon: "success",
                                });


                                $('#logins').html('<img src="{{$urls}}" style="dislpay:none">');

                                window.clearInterval(myTimer);
                                myTimer = window.setInterval(checksession, 10000);
                                clearTimeout(t);
                                t = setTimeout(callApis, 60000*11);

                                $('.swal-title').html('Please wait...');

                                
                            }else{

                                window.location.replace("/feedback/form");
                            }
                             
                        }


                    });

                }else {

                    swal(etitle, {
                        icon: "error",
                    });

                    window.location.replace("/feedback/form");
                }
            });

            
        }

</script>

<script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-messaging.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>

    <script>
        $(document).ready(function(){
            const config = {
              apiKey: "AIzaSyA_55WjIA2Vu38dWIhxjA9JpRN2ed2GOQo",
              authDomain: "mytax-6a762.firebaseapp.com",
              databaseURL: "https://mytax-6a762.firebaseio.com",
              projectId: "mytax-6a762",
              storageBucket: "mytax-6a762.appspot.com",
              messagingSenderId: "525763571367",
              appId: "1:525763571367:web:aade805ee976559a02f582",
              measurementId: "G-0NE807J0YB"
            };
            firebase.initializeApp(config);
            const messaging = firebase.messaging();
            
            messaging
                .requestPermission()
                .then(function () {
                  console.log(messaging.getToken())
                    return messaging.getToken()
                })
                .then(function(token) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                  
                    $.ajax({
                        url: '{{ URL::to('/api/save-subscription/') }}',
                        type: 'POST',
                        data: {
                            user_id: {{Auth::user()->id}},
                            fcm_token: token
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            console.log(response)
                        },
                        error: function (err) {
                            console.log(" Can't do because: " + err);
                        },
                    });
                })
                .catch(function (err) {
                    console.log("Unable to get permission to notify.", err);
                });
        
            messaging.onMessage(function(payload) {
                const noteTitle = payload.notification.title;
                const noteOptions = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                };
                new Notification(noteTitle, noteOptions);
            });
        });
    </script>


@stack('script')
</body>
</html>