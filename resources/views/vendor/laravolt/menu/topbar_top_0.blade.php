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


</header>
