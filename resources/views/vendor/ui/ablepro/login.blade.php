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
    <script src="{{asset('chat/widgets.config_chat.js')}}"></script>


</head>
<style scoped>

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
<body class="on-the-fly-behavior" >

    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <img src="" style="display:none">

    @include('ui::ablepro.loginmenu')

    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header" >
                <div class="page-block">
                    <div class="row align-items-center" style="margin-top: -210px !important;">
                        <div class="col-md-12">

                            <div class="card" >
                                <img onclick="location.href='/'" class="img-radius shadows img-fluid wid-80" style="position: absolute;margin-left:20px;margin-top:-40px;box-shadow: 0 2px 10px -1px rgba(69, 90, 100, 0.3);z-index:1030;cursor: pointer;" src="{{asset('themes/ablepro/assets/images/logo3.jpg')}}" alt="User image">
                                <div class="card-header" style="background-color: #4680ff;color:white;border-bottom:0px solid rgba(0, 0, 0, 0.125);border-radius:3px">
                                    <div class="page-header-title" style="padding-left:90px">
                                        <h5 class="" style="font-weight: unset;color:white">@lang('homepage.wellcome')</b></span></h5>
                                    </div>
                                </div>
                            </div>
       
                        </div>
                    </div>
                </div>
            </div>
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




<script src="{{asset('themes/ablepro/assets/js/vendor-all.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/ripple.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/swiper.min.js')}}"></script>

<script src="{{asset('themes/ablepro/assets/js/plugins/apexcharts.min.js')}}"></script>

<script src="{{asset('themes/ablepro/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pages/form-validation.js')}}"></script>


<script src="{{asset('themes/ablepro/assets/js/plugins/moment.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/daterangepicker.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pages/ac-datepicker.js')}}"></script>

<script src="{{asset('themes/ablepro/assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('themes/ablepro/assets/js/plugins/trumbowyg.min.js')}}"></script>

<!-- {{asset('themes/ablepro/assets/js/plugins/dataTables.bootstrap4.min.js')}} -->

<link href="{{ asset('dflip/css/dflip.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('dflip/css/themify-icons.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('dflip/js/dflip.min.js') }}" type="text/javascript"></script>
<!-- <script type="text/javascript">
  $(document).ready(function (){checksession();});
</script> -->
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

<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=G-5C7ZN3EV45"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());

 

  gtag('config', 'G-5C7ZN3EV45');

</script>

<script src="{{asset('chat/widgets.config_chat.js')}}"></script>


<script type="text/javascript">


$(document).ready(function () {

  var event = ('ontouchstart' in window) ? 'click' : 'mouseenter';

$('.animation-toggle').on(event, function () {
    var anim = $(this).attr('data-animate');
      $(this).addClass('animated');
      $(this).addClass(anim);
      setTimeout(function() {
        $('.animation-toggle').removeClass(anim);
      }, 500);
});
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

<script type="text/javascript">
  
  function loadbrochure() {

    
    $.ajax({

            type: "GET", 
            url: "{{ URL::to('dashboard/brochures')}}",
                   
            beforeSend: function () 
            {
                  $('#home').html('');
            },
            success: function(data)
            {       
                  $('#home').html(data);
            }


        });




  };  


</script>

<script type="text/javascript">
  
  function loadebook() {

    
    $.ajax({

            type: "GET", 
            url: "{{ URL::to('dashboard/ebooks')}}",
                   
            beforeSend: function () 
            {
                  $('#home').html('');
            },
            success: function(data)
            {       
                  $('#home').html(data);
            }


        });




  };  


</script>

<script type="text/javascript">
  
  function loadcontact() {

    
    $.ajax({

            type: "GET", 
            url: "{{ URL::to('dashboard/contacts')}}",
                   
            beforeSend: function () 
            {
                  $('#home').html('');
            },
            success: function(data)
            {       
                  $('#home').html(data);
                 
            }


        });




  };  


</script>

<script type="text/javascript">
  
  function loadhelp() {

    
    $.ajax({

            type: "GET", 
            url: "{{ URL::to('dashboard/helps')}}",
                   
            beforeSend: function () 
            {
                  $('#home').html('');
            },
            success: function(data)
            {       
                  $('#home').html(data);
            }


        });




  };  


</script>

<script type="text/javascript">
  
  function loadapp(id) {

    
    $.ajax({

            type: "GET", 
            url: "{{ URL::to('app/views')}}"+"/"+id,
                   
            beforeSend: function () 
            {
                  $('#home').html('');
            },
            success: function(data)
            {       
                  $('#home').html(data);
                 
            }


        });




  };  


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
  
  // setInterval(checksession, 10000);

  function checksession(){
     
     $.get('{{env("API_TOKEN")}}', {}, function(ssodata) {

          var datas = JSON.stringify(ssodata.RequestTokenMyTaxResult);
          var myObj = JSON.parse(datas);

          console.log(datas);

         if (myObj.Status == 'Success') {

             $.ajax({

                        type: "GET", 
                        url: "{{ URL::to('ssologin?')}}"+"token="+myObj.IdNo+"&access="+myObj.Access,
                               
                        beforeSend: function () 
                        {
                              
                        },
                        success: function(data)
                        {       

                            if(data == 1){

                                window.location.replace("/");
                                
                            }else{

                                
                            }
                             
                        }


                    });
                
          }

    }, 'jsonp');

      
  }

</script>


@stack('script')
</body>
</html>