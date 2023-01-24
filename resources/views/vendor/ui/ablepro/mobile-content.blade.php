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
   
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('themes/ablepro/assets/images/favicon.ico')}}" type="image/x-icon">
    
    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('themes/ablepro/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('themes/ablepro/assets/css/plugins/swiper.min.css')}}">
           

</head>
<body class="" style="background-image: url({{asset('themes/ablepro/assets/images/banner3.jpg')}});background-size: contain;">

    
      <div class="pcoded-main-container " style="margin-left: unset !important;background-color:  #e8eaec;border-radius:5px;min-height:80vh">
        <div class="pcoded-content" style="margin-top: 150px">
          <div style="display: none" id="logins"></div>
        
            
            @yield('content')
        </div>
        </div>

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
<script src="{{asset('themes/ablepro/assets/js/pages/chart-apex.js')}}"></script>
<script src="{{asset('themes/ablepro/assets/js/pages/dashboard-main.js')}}"></script>
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

<script type="text/javascript">

    $(document).ready(function () {

        $('#logins').html('<img src="{{$urls}}" style="dislpay:none">');

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


@stack('script')
</body>
</html>