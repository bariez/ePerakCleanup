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

    
      <div class="pcoded-main-container " style="margin-left: unset !important;background-color:  #e8eaec;border-radius:5px">
        <div class="pcoded-content" style="margin-top: 150px">
          <div style="display: none" id="logins"></div>
        
            @include('ui::ablepro.mobilemaskhead')
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
<script type="text/javascript">

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
  $url=env('API_DOMAIN')."/SSOService.svc/user/login?username=".$username."&password=".$pass."&IdType=".$type."&nocp=undefined";  

  
}else{

  $url = env('API_DOMAIN')."/SSOService.svc/user/Logout";
}
?>



$(document).ready(function () {

  localStorage.name =<?php echo "'".$user->name."'" ?>;
  localStorage.devid =<?php echo "'".$user->id."'" ?>;

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

$('#logins').html('<img src="{{$url}}" style="dislpay:none">');
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