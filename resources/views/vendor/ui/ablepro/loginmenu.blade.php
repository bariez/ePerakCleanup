<?php 
use App\Models\MngAnnouncement;
use App\Models\MngService;

$locale = App::getLocale();
\App::setLocale($locale);

$service = MngService::where('status','=',1)->orderBy('order','ASC')->get();

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


?>


    <nav class="pcoded-navbar menu-light " style="z-index:1040">

        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label> @lang('homepage.main_menu')</label>

                    </li>
<!-- 56 -->
                    <li class="nav-item"><a href="/" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
                    
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">@lang('homepage.service')</span></a>
                        <ul class="pcoded-submenu">
                          <?php 
                             
                             $activems = '';
                             $activeen = '';
                          ?>

                           

                            
                          
                                @foreach($service as $key => $list)
                                    <?php 

                                          $check = json_decode($list->acl);
                                          if($check == null)
                                          {
                                              $check = [];
                                          }

                                    ?>

                                    @if(in_array("9", $check))
                                     <li><a onclick="javascript:loadapp({{$list->id}})" >@if($locale == 'ms'){{$list->service_bm}}@else{{$list->service_en}}@endif</a></li>

                                    @else
                                     <!-- <li><a onclick="openlogin();" >@if($locale == 'ms'){{$list->service_bm}}@else{{$list->service_en}}@endif</a></li> -->
                                      
                                    @endif

                                @endforeach
                             

                            
                            

                        </ul>
                    </li>
          <li class="nav-item"><a href="https://janjitemu.hasil.gov.my/" class="nav-link "><span class="pcoded-micon"><i class="feather icon-calendar"></i></span><span class="pcoded-mtext">e-Janji Temu Hasil</span></a></li>
                    <li class="nav-item"><a onclick="javascript:loadbrochure()" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">@lang('form.titlebrosure')</span></a></li>
                    <li class="nav-item"><a onclick="javascript:loadebook()" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">@lang('form.titleebook')</span></a></li>
                    <li class="nav-item"><a href="https://www.hasil.gov.my/en/eduzone/" target="_blank" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">eduZONE</span></a></li>
          <li class="nav-item"><a onclick="javascript:loadhelp()" class="nav-link "><span class="pcoded-micon"><i class="feather icon-activity"></i></span><span class="pcoded-mtext">@lang('homepage.help')</span></a></li>
                    <li class="nav-item">
                        <a onclick="document.querySelector('.cx-search-button').click();" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">@lang('homepage.faqmenu')</span></a>
                        
                    </li>
                    

                </ul>
                <div class="card text-center">
                    


                </div>
                 <div class="card text-center p-1">    
                    <b>@lang('homepage.lastupdate')</b> <br> 

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

                    <a onclick="openlogin();" class="langdisp" style="background-color: orange;cursor: pointer;"><span data-toggle="dropdown" class="feather icon-lock"> </span>@lang('homepage.login')</a>

                    <button type="button" data-toggle="dropdown" class="btn btn-icon btn-success has-ripple"><i class="feather icon-bell"></i><span class="ripple ripple-animate" style="height: 45px; width: 45px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255) none repeat scroll 0% 0%; opacity: 0.4; top: -4.7px; left: -1.76666px;"></span></button>

                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">@lang('homepage.announcement')</h6>
                                <div class="float-right">
                                    
                                </div>
                            </div>
                            <ul class="noti-body">




                                <li class="n-title">
                                    <p class="m-b-0">@lang('homepage.new')</p>
                                </li>

                                 @forelse($anouncement as $key => $data)

                                <li class="notification shadow" style="background-color: #EDEDEE;margin:10px">
                                    <div class="media">
                                        <div class="media-body">
                                            <p><strong>{{date("d/m/Y", strtotime($data->start_date))}}</strong></p>
                                            @if($locale == 'ms')
                                                <p>{{$data->announcement_bm}}</p>
                                            @else
                                                <p>{{$data->announcement_en}}</p>
                                            @endif

                                            <br>
                                            <br>
                                            @if($locale == 'ms')
                                                <p><?php echo $data->body_bm ?></p>
                                            @else
                                                <p><?php echo $data->body_en ?></p>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </li>
                                <br>


                                @empty
                                <form class="text-center">
                                    <i class="feather icon-check-circle display-3 text-success"></i>
                                    <h5 class="mt-3">@lang('inbox.empty')</h5>
                                    <p>@lang('inbox.nodata')</p>
                                </form>
                                @endforelse



                            </ul>
                            
                        </div>

           

                        

                     <div class="dropdown-menu dropdown-menu-right notification">
                      <div class="noti-head">
                          <h6 class="d-inline-block m-b-0">@lang('homepage.logintitle')</h6>
                          <div class="float-right">
                              
                          </div>
                      </div>
                      <ul class="noti-body">


                          <li class="notification">
                              <div class="media" style="cursor: pointer;" onclick="location.href='/user/login/1'">
                                  <div class="media-body">
                                      @lang('homepage.loginsinput1')
                                  </div>
                              </div>
                          </li>

                           <li class="notification">
                              <div class="media" style="cursor: pointer;" onclick="location.href='/user/login/2'">
                                  <div class="media-body">
                                      @lang('homepage.loginsinput2')
                                  </div>
                              </div>
                          </li>

                           <li class="notification">
                              <div class="media" style="cursor: pointer;" onclick="location.href='/user/login/3'">
                                  <div class="media-body">
                                      @lang('homepage.loginsinput3')
                                  </div>
                              </div>
                          </li>

                           <li class="notification">
                              <div class="media" style="cursor: pointer;" onclick="location.href='/user/login/4'">
                                  <div class="media-body">
                                      @lang('homepage.loginsinput4')
                                  </div>
                              </div>
                          </li>
                        

                      </ul>
                    </div>

                    </div>


                </li>
            </ul>
        </div>
       
    </header>
    


