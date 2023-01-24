<?php 
$user= auth()->user();
use App\Models\TaxInbox;

$inboxcount = TaxInbox::where('NoId','=',$user->reference_id)->where('Unread','=','true')->count();

?>



<div class="page-header" >

            <div class="page-block">
                <div class="row align-items-center" style="margin-top: -210px !important;">
                    <div class="col-md-12">

                        <div class="card" style="">
                       
                            <img onclick="location.href='/'" class="img-radius shadows img-fluid wid-80" style="cursor:pointer;position: absolute;margin-left:20px;margin-top:-40px;box-shadow: 0 2px 10px -1px rgba(69, 90, 100, 0.3);z-index:1030" src="{{asset('themes/ablepro/assets/images/logo3.jpg')}}" alt="User image">
                  
                            <div class="card-header" style="border-radius:3px">
                                <div class="page-header-title" style="padding-left:90px">
                                    <h5 class="" style="font-weight: unset">@lang('homepage.wellcome'), <span>
                                    <b>{{$user->name}} 
                                            @if($user->access == 1) (INDIVIDU) @endif
                                            @if($user->access == 2) (ORGANISASI) @endif
                                            @if($user->access == 3) (INDIVIDU & ORGANISASI) @endif
                                            @if($user->access == 4) (PENTADBIR) @endif
                                            @if($user->access == 5) (INDIVIDU & PENTADBIR) @endif
                                            @if($user->access == 6) (ORGANISASI & PENTADBIR) @endif 
                                            @if($user->access == 7) (INDIVIDU & ORGANISASI & PENTADBIR) @else (INDIVIDU) @endif

                                     
                                    </b></span>@if(\Request::is('/')) <p style="margin-top: 10px;font-size:12px;margin-bottom: unset;color: #6161ce;font-weight: bold;font-style: italic;"><span>@lang('homepage.maskhead')</span></p> @endif</h5>


                                    <div class="page-header-title" style="float:right;">
                                         <a href="/user/inbox" class="btn btn-icon btn-success has-ripple" style="background-color: white !important;margin-right:10px" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="@lang('homepage.header-inbox')">
                                         <i class="feather icon-mail text-c-red" style=""> {{$inboxcount}} </i>

                                         </a>
                                         <a href="/user/profile" class="btn btn-icon btn-success has-ripple" style="background-color: white !important;;margin-right:10px" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="@lang('homepage.header-profile')">
                                         <i class="feather icon-user text-c-blue" style=""></i>

                                         </a>
                                         <a href="/dashboard/taxstatus" class="btn btn-icon btn-success has-ripple" style="background-color: white !important;margin-right:10px" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="@lang('homepage.header-tax')">
                                         <i class="feather icon-pocket text-c-green" style=""></i>

                                         </a>
                                        
                                    
                                    </div>
                                   
                                </div>



                                
                            </div>


                            
                        </div>
   
                    </div>
                </div>
            </div>
        </div>
