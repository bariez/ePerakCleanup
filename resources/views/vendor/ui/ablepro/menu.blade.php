<?php 
use App\Models\MngAnnouncement;
use App\Models\MngService;
use App\Models\Aclpermission;
$now = date('Y-m-d');


if(env('DB_CONNECTION') == 'mysql')
{

    $anouncement = MngAnnouncement::where('status','=',1)
              ->whereRaw('start_date <= "'.$now.'" AND end_date >= "'.$now.'"')
             ->orderBy('created_at','DESC')->limit('5')->get();
}else{

     try{

         $anouncement = MngAnnouncement::where('status','=',1)
                 ->whereRaw('start_date <= GETDATE() AND end_date >= GETDATE()')
                 ->orderBy('created_at','DESC')
                 ->limit(5)
                 ->get();


      }catch(\Illuminate\Database\QueryException $ex){ 

            $anouncement = MngAnnouncement::where('status','=',1)
              ->whereRaw('start_date <= "'.$now.'" AND end_date >= "'.$now.'"')
             ->orderBy('created_at','DESC')->limit('5')->get();
      }



    
}

$users= auth()->user();

// $keys = $users->access;

$checkrole = Aclpermission::where('name','=',$users->reference_id)->first();

$service = MngService::where('status','=',1)->orderBy('order','ASC')->get();
$servicecount = $service->count();

$keys = $users->reference_id;
$values = $users->tax_no;
$type = $users->reference_type;
$access = $users->access;

$urlkeys = env('API_DOMAIN').'/SSOService.svc/user/encrypt2?Key='.$keys.'&Value='.$values;
$urltype = env('API_DOMAIN').'/SSOService.svc/user/encrypt2?Key='.$keys.'&Value='.$type;
$urlaccess = env('API_DOMAIN').'/SSOService.svc/user/encrypt2?Key='.$keys.'&Value='.$access;



?>


    <nav class="pcoded-navbar menu-light " style="z-index: 1040;"> 

        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label> @lang('homepage.main_menu')</label>

                    </li>

                    <li class="nav-item"><a href="/" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
                    
                    @if($servicecount > 0)
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">@lang('homepage.service')</span></a>
                        <ul class="pcoded-submenu">

                            
                                @foreach($service as $key => $list)

                                    <?php 

                                          $check = json_decode($list->acl);
                                          if($check == null)
                                          {
                                              $check = [];
                                          }

                                    ?>


                                    @if(($access == '2') OR ($access == '6')) 

                                        @if(in_array($access, $check))


                                            @if($list->id == 8)
                                                <li><a id="eoflejar" href="/app/view/{{$list->id}}" >@if($users->language == 'en') {{$list->service_en}} @else {{$list->service_bm}} @endif</a></li>
                                            @else
                                                <li><a href="/app/view/{{$list->id}}" >{{$list->service_en}}</a></li>
                                            @endif

                                        @endif


                                    @else

                                        @if(in_array($access, $check))
                                            <li><a href="/app/view/{{$list->id}}" >@if($users->language == 'en') {{$list->service_en}} @else {{$list->service_bm}} @endif</a></li>
                                        @endif


                                    @endif
                                    
                                @endforeach
                            

                        </ul>
                    </li>
                    @endif

                     <!-- <li class="nav-item">
                        <a href="/borang/index" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">@lang('form.titleborang')</span></a></li> -->

                    <li class="nav-item">
                        <a href="/dashboard/brochure" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">@lang('form.titlebrosure')</span></a></li>
                    <li class="nav-item">
                        <a href="/dashboard/ebook" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">@lang('form.titleebook')</span></a></li>
                    <li class="nav-item">
                        <a href="/dashboard/help" class="nav-link "><span class="pcoded-micon"><i class="feather icon-activity"></i></span><span class="pcoded-mtext">@lang('homepage.help')</span></a></li>
                    <li class="nav-item">
                        <a onclick="document.querySelector('.cx-search-button').click();" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">@lang('homepage.faqmenu')</span></a>
                        
                    </li>
                    @if($checkrole)
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">@lang('homepage.management')</span></a>
                        <ul class="pcoded-submenu">
                            
                            <li><a href="/admin/listannounce" >@lang('homepage.announcement')</a></li>
                            <li><a href="/admin/banner" >@lang('form.titlebanner')</a></li>
                            <li><a href="/admin/listservice">@lang('homepage.service')</a></li>
                            <li><a href="/admin/listmobile">@lang('homepage.mobile')</a></li>
                             <li class="pcoded-hasmenu">
                                <a href="#">@lang('homepage.feedback')</a>
                                <ul class="pcoded-submenu">
                                    <li><a href="/admin/feedback">@lang('homepage.feedback')</a></li>
                                    <li><a href="/feedback/form">@lang('homepage.feedbackform')</a></li>
                                </ul>
                            </li>

                            <li><a href="/admin/listfaq" >@lang('homepage.faq')</a></li>
                            <li><a href="/admin/listhelp">@lang('homepage.help')</a></li>
                            <li class="pcoded-hasmenu">
                                <a href="#">@lang('homepage.template-management')</a>
                                <ul class="pcoded-submenu">
                                    <li><a href="/mail/template">@lang('homepage.template-manage')</a></li>
                                    <li><a href="/mail/templatetype">@lang('homepage.template-lookup')</a></li>
                                </ul>
                            </li>
                  

                             
                            
                        </ul>
                    </li>
                    
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">@lang('homepage.reporttitle')</span></a>
                        <ul class="pcoded-submenu">
                            
                            <li><a href="/admin/reportapp">@lang('homepage.reportapp')</a></li>
                            <li><a href="/admin/reportfeedback">@lang('homepage.reportmk')</a></li>
                            <li><a href="/admin/reportcomment">@lang('homepage.reportcomment')</a></li>
                            <li><a href="/admin/reportapi">Api Report</a></li>
                            
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/userman" class="nav-link ">
                            <span class="pcoded-micon"><i class="feather icon-user-plus"></i></span>
                            <span class="pcoded-mtext">@lang('homepage.userman')</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/search/index" class="nav-link ">
                            <span class="pcoded-micon"><i class="feather icon-search"></i></span>
                            <span class="pcoded-mtext">@lang('homepage.search-button')</span>
                        </a>
                    </li>
                    @endif

                         
                </ul>
                <div class="card text-center">
                  
                   
                </div>

                <div class="card text-center p-1">    
                    <b>@lang('homepage.lastupdate')</b> <br> 
                    <?php  $locale = Session::get('locale'); ?>
                     @if($locale == 'ms')
                        <?php 

                            $month = '';
                            $cmonth = date('m',(strtotime ( '-1 day' , strtotime ( date("Y-m-d")) ) ));
                            if($cmonth == '01'){$month = "Januari";} 
                            elseif($cmonth == '02'){$month = "Februari";} 
                            elseif($cmonth == '03'){$month = "Mac";} 
                            elseif($cmonth == '04'){$month = "April";} 
                            elseif($cmonth == '05'){$month = "Mei";} 
                            elseif($cmonth == '06'){$month = "Jun";} 
                            elseif($cmonth == '07'){$month = "Julai";} 
                            elseif($cmonth == '08'){$month = "Ogos";} 
                            elseif($cmonth == '09'){$month = "September";} 
                            elseif($cmonth == '10'){$month = "Oktober";} 
                            elseif($cmonth == '11'){$month = "November";} 
                            else {$month = "Disember";} 

                       ?>
                        {{ date('d ',(strtotime ( '-1 day' , strtotime ( date("Y-m-d")) ) )) }}{{$month}}{{ date(' Y',(strtotime ( '-1 day' , strtotime ( date("Y-m-d")) ) )) }}
                    @else
                        <?php 

                            $month = '';
                            $cmonth = date('m',(strtotime ( '-1 day' , strtotime ( date("Y-m-d")) ) ));
                            if($cmonth == '01'){$month = "January";} 
                            elseif($cmonth == '02'){$month = "February";} 
                            elseif($cmonth == '03'){$month = "March";} 
                            elseif($cmonth == '04'){$month = "April";} 
                            elseif($cmonth == '05'){$month = "May";} 
                            elseif($cmonth == '06'){$month = "June";} 
                            elseif($cmonth == '07'){$month = "July";} 
                            elseif($cmonth == '08'){$month = "August";} 
                            elseif($cmonth == '09'){$month = "September";} 
                            elseif($cmonth == '10'){$month = "October";} 
                            elseif($cmonth == '11'){$month = "November";} 
                            else {$month = "December";} 

                       ?>
                        {{ date('d ',(strtotime ( '-1 day' , strtotime ( date("Y-m-d")) ) )) }}{{$month}}{{ date(' Y',(strtotime ( '-1 day' , strtotime ( date("Y-m-d")) ) )) }}
                    @endif
                </div>
                
            </div>
        </div>
    </nav>

    
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>

                     <div class="dropdown">
                     <span class="langdisp">
                     <?php 
                         $locale = Session::get('locale');
                         $activems = '';
                         $activeen = '';

                         if($locale == 'ms')
                         {
                            $activems = 'text-shadow: 2px 2px 4px white;font-weight: bolder;text-decoration: underline';
                         }else{
                            $activeen = 'text-shadow: 2px 2px 4px white;font-weight: bolder;text-decoration: underline';
                         }


                     ?>
                        <a href="/home/ms" style="{{$activems}}"><span class="flag-icon flag-icon-it"> </span>BM</a> | 
                        <a href="/home/en" style="{{$activeen}}"><span class="flag-icon flag-icon-fr"> </span>EN</a>


                    </span>

                    <span class="langdisp" style="background-color: orange">
                    <a href="/feedback/form" ><span class="feather icon-lock"> </span>@lang('homepage.logout')</a>

                    </span>

                        
                        <button type="button" data-toggle="dropdown" class="btn btn-icon btn-success has-ripple"><i class="feather icon-bell"></i><span class="ripple ripple-animate" style="height: 45px; width: 45px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255) none repeat scroll 0% 0%; opacity: 0.4; top: -4.7px; left: -1.76666px;"></span></button>

                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0" >@lang('homepage.announcement')</h6>
                                <div class="float-right">
                                    
                                </div>
                            </div>
                            <ul class="noti-body">




                                <li class="n-title">
                                    <p class="m-b-0">@lang('homepage.new')</p>
                                </li>

                                 @forelse($anouncement as $key => $data)

                                <li class="notification">
                                    <div class="media" style="cursor: pointer;" onclick="location.href='/dashboard/announcement/{{$data->id}}'">
                                        <img class="img-radius" src="{{asset('themes/ablepro/assets/images/logo1.jpg')}}" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <p><strong>{{date("d/m/Y", strtotime($data->start_date))}}</strong></p>
                                            @if($locale == 'ms')
                                                <p>{{$data->announcement_bm}}</p>
                                            @else
                                                <p>{{$data->announcement_en}}</p>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </li>

                                @empty
                                <form class="text-center">
                                    <i class="feather icon-check-circle display-3 text-success"></i>
                                    <h5 class="mt-3">@lang('inbox.empty')</h5>
                                    <p>@lang('inbox.nodata')</p>
                                </form>
                                @endforelse



                            </ul>
                            <div class="noti-footer">
                                <a href="/dashboard/announcement/0">@lang('homepage.all')</a>
                            </div>
                        </div>
                    </div>


                </li>
            </ul>
        </div>
    </header>
    @push('script')
<!--     <script type="text/javascript">

    $(document).ready(function () 
    {

             $.get('{!! $urlkeys !!}', {}, function(ssodata) 
             {

                  var datas = JSON.stringify(ssodata);
                  var myObj = JSON.parse(datas);

                  console.log(myObj.Encrypt_ExtResult);

                 if (myObj.Encrypt_ExtResult !=="") 
                 {
                         $.get('{!! $urltype !!}', {}, function(ssodatatype) 
                         {

                              var datastype = JSON.stringify(ssodatatype);
                              var myObjtype = JSON.parse(datastype);

                              console.log(myObjtype.Encrypt_ExtResult);

                             if (myObjtype.Encrypt_ExtResult !=="") 
                             {
                                     $.get('{!! $urlaccess !!}', {}, function(ssodataaccess) 
                                     {

                                          var datasaccess = JSON.stringify(ssodataaccess);
                                          var myObjaccess = JSON.parse(datasaccess);

                                          console.log(myObjaccess.Encrypt_ExtResult);

                                         if (myObjaccess.Encrypt_ExtResult !=="") 
                                         {

                                            // alert('loaded');

                                               // document.getElementById("eoflejar").href("https://hasilevent.hasil.gov.my/eLejar/LandingPage.aspx?refNo=" + myObj.Encrypt_ExtResult + "&jpe=" + myObjtype.Encrypt_ExtResult + "&acc=" + myObjaccess.Encrypt_ExtResult);


                                               $('#eoflejar').attr('href', "https://hasilevent.hasil.gov.my/eLejar/LandingPage.aspx?refNo=" + myObj.Encrypt_ExtResult + "&jpe=" + myObjtype.Encrypt_ExtResult + "&acc=" + myObjaccess.Encrypt_ExtResult);
                                         }
                                         else 
                                         {
                                            console.log('error');

                                         }


                                        }, 'jsonp');

                             }
                             else 
                             {
                                console.log('error');

                             }


                            }, 'jsonp');


                 }
                 else 
                 {
                    console.log('error');

                 }


                }, 'jsonp');





    });

</script> -->
@endpush


