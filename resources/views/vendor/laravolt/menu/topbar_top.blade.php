<?php


use App\Models\User;
use Workbench\Site\Model\Lookup\AclRoleUser;

 $pendding  = User::where('status','PENDING')->count();

 $user = auth()->user();
 $roleuser=AclRoleUser::where('user_id',data_get($user,'id'))->first();

$id=5;
?>
<style>
    .layout--app header.ui.menu {
    border: 0 !important;
    left: 0px !important;
    width: 100% !important;
    max-width: unset !important;
}
    </style>

<header class="ui menu fixed top borderless" id="topbartop" style="background-image: url('{{ asset('theme/assets/imgs/theme/perak/headerbgfive.jpeg') }}') !important;height: 110px;">
<!--     <div class="item mobile only tablet only" data-role="sidebar-visibility-switcher"><i class="icon sidebar"></i></div> -->

    <div class="menu p-l-2" id="titlebar">
        <div class="left menu">
            <div class="item" style="color: white; font-size: 50px; font-family: Cambria, Perpetua, Times New Roman;font-weight: 400;">
                <a href="/"> <img src="{{ asset('logo.png') }}" title="Logo" style="height: 60px">&nbsp;
                </a> PORTAL RASMI e-PERAK 
            </div>
        </div>
    </div>

    <div class="menu right p-r-1" id="userbar" data-turbolinks-permanent>
        @auth
            <div class="item">

                <div class="ui compact b-0">
                    <div class="ui simple dropdown basic button top right pointing b-0 p-x-volt-0" style="padding: 6px 0px;background: transparent;">
                         <a class="ui button" style="background-color: #000;color: white;font-size:12px;height: 40px;"><i class="user icon" style="margin: auto;"></i></a>
                    
                        <div class="menu">
                            <div class="header"><span class="ui text {{ config('laravolt.ui.color') }}">{{ auth()->user()->name }}</span></div>

                            <div class="divider"></div>

                            <a href="{{ route('my::profile.edit') }}" class="item">@lang('KEMASKINI PROFIL')</a>
                            <a href="{{ route('my::password.edit') }}" class="item">@lang('KEMASKINI KATA LALUAN')</a>

                            <div class="divider"></div>

                            
                        </div>
                    </div>

                </div>
                 <a class="ui button" href="{!! URL::to('auth/addlog/'.auth()->user()->id) !!}" data-tooltip="Logout" style="height: 40px;background-color: #000;color: white;font-size:12px;padding-top: 1.1em;"><i style="margin: auto;" class="sign in alternate icon"></i></a>
            </div>
        @endauth


    </div>
</header>
