        <div class="page-header " style="font-size: 14px;position: sticky;margin-top: -110px;">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12" style="padding: 10px;margin-top: -50px;">
                    <div class="position-relative d-inline-block" style="margin-top: 0px;float:left">
                            <img onclick="location.href='/mobile'" class="img-radius img-fluid wid-70" src="{{asset('themes/ablepro/assets/images/logo2.jpg')}}" alt="User image" style="cursor:pointer;box-shadow: 0 2px 10px -1px rgba(69, 90, 100, 0.3);border: 3px #7fbff7 solid;">
                            
                        </div>
                        <div class="page-header-title" style="text-align: right">
                            <h5 class="m-b-10 " style="font-size: 14px;color:#0f1111;font-weight: 200">@lang('homepage.wellcome'),<br><b style="text-shadow: 2px 2px 4px white;">{{$user->name}}</b></h5>

                        </div>

                        <ul class="breadcrumb" style="float:right">
                     <?php 
                         $locale = Session::get('locale');
                         $activems = 'color:#00867b;';
                         $activeen = 'color:#00867b;';

                         if($locale == 'ms')
                         {
                            $activems = 'text-shadow: 2px 2px 4px white;font-weight: bolder;text-decoration: underline;color:#00867b;';
                         }else{
                            $activeen = 'text-shadow: 2px 2px 4px white;font-weight: bolder;text-decoration: underline;color:#00867b;';
                         }


                     ?> 
                             <li class="breadcrumb-item"><a href="/mobile/logout" style="font-size: 14px;color:#0f1111;font-weight: 200;text-shadow: 2px 2px 4px white" ><span class="flag-icon flag-icon-it"></span>@lang('homepage.logout')</a></li>
                            <li class="breadcrumb-item"><a href="/home/ms" style="{{$activems}}"><span class="flag-icon flag-icon-it"></span>BM</a></li>
                            <li class="breadcrumb-item"><a href="/home/en" style="{{$activeen}}"><span class="flag-icon flag-icon-fr"></span>EN</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>