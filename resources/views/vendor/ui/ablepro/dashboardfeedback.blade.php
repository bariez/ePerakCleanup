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

</head>
<style scoped>

.on-the-fly-behavior {
    background-image: url('{{ asset('assets/images/bg.png') }}');
    background-repeat:no-repeat;
    background-size: contain;
}

@media (max-width: 1200px) { 
    .on-the-fly-behavior {   
        background-image: url('{{ asset('assets/images/bg.png') }}');
        background-repeat:no-repeat;
        background-size: unset;
    }
}
</style>
<body class="on-the-fly-behavior" >
<img src="{{env('API_DOMAIN')}}/SSOService.svc/user/Logout" style="display:none">
    <div>
        <div >       
            @yield('content')
        </div>
    </div>



<script src="{{asset('themes/ablepro/assets/js/vendor-all.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/ripple.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pcoded.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/swiper.min.js')}}"></script>

<script src="{{asset('themes/ablepro/assets/js/plugins/apexcharts.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pages/chart-apex.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pages/dashboard-main.js')}}"></script>

<script src="{{asset('themes/ablepro/assets/js/plugins/jquery.validate.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pages/form-validation.js')}}"></script>


<script src="{{asset('themes/ablepro/assets/js/plugins/moment.min.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/plugins/daterangepicker.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pages/ac-datepicker.js')}}"></script>

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
@stack('script')
</body>
</html>