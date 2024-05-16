<?php

use App\Models\User;
use Workbench\Site\Model\Lookup\AclRoleUser;

$pendding = User::where('status', 'PENDING')->count();

$user = auth()->user();
$roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

$id = 5;
?>

<header class="ui menu fixed top borderless" id="topbar">
    <div class="item mobile only tablet only" data-role="sidebar-visibility-switcher"><i class="icon sidebar"></i></div>

    <!--     <div class="menu p-l-2" id="titlebar">
        <div class="left menu">
            <div class="item" style="
    font-size: 25px;
    font-style: italic;
">
                {{ config('laravolt.ui.brand_name') }}
            </div>
        </div>
    </div> -->

    <div class="menu right p-r-1" id="userbar" data-turbolinks-permanent>
        @auth
            <div class="item">

                <div class="ui compact b-0">
                    @if (data_get($roleuser, 'role_id') == 1)
                        @if ($pendding == 0)
                            <div class="ui simple dropdown basic button top right pointing b-0 p-x-volt-0"
                                style="padding: 3px 12px;">
                                <i class="big bell outline icon"></i><span id="notis"><b>{{ $pendding }}</b></span>

                            </div>
                        @else
                            <div class="ui simple dropdown basic button top right pointing b-0 p-x-volt-0"
                                style="padding: 3px 12px;">
                                <i class="big bell outline icon" style="color: #fecb3a;"></i><span id="notis">
                                    <font color="red"><b>{{ $pendding }}</b></font>
                                </span>
                                <i class="dropdown icon m-l-0 {{ config('laravolt.ui.color') }}"></i>
                                <div class="menu">
                                    <div class="header"><span class="ui text {{ config('laravolt.ui.color') }}">Kelulusan
                                            Pengguna</span></div>

                                    <div class="divider"></div>

                                    <a href="{{ route('site::users.approveindex') }}" class="item"><b>Perlu Kelulusan
                                            Pengguna </b>
                                        <div class="ui primary inverted basic label">{{ $pendding }}</div>
                                    </a>

                                </div>
                            </div>
                        @endif
                    @endif
                    <!--          <div class="ui simple dropdown basic button top right pointing b-0 p-x-volt-0" style="padding: 6px 0px;background: transparent;">
                            <button class="ui labeled icon button" style="background-color: #ce89b5;color: white">
                              <i class="user icon"></i>
                              Profil
                            </button>


                            <div class="menu">
                                <div class="header"><span class="ui text {{ config('laravolt.ui.color') }}">{{ auth()->user()->name }}</span></div>

                                <div class="divider"></div>

                                <a href="{{ route('my::profile.edit') }}" class="item">@lang('Kemaskini Profil')</a>
                                <a href="{{ route('my::password.edit') }}" class="item">@lang('Kemaskini Kata Laluan')</a>

                                <div class="divider"></div>


                            </div>
                        </div> -->

                </div>
                <!--  <a href="{!! URL::to('auth/addlog/' . auth()->user()->id) !!}" style="color: white">
                        <button class="ui labeled icon button" style="background-color: #ce89b5;color: white">
                             <i class="sign in alternate icon"></i>
                              Log Keluar
                            </button></a> -->


            </div>
        @endauth


    </div>
</header>
