<?php

use App\Models\User;
use Workbench\Site\Model\Lookup\AclRoleUser;

$pendding = User::where('status', 'PENDING')->count();

$user = auth()->user();
$roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

$id = 5;
?>

<style>
    /* Style untuk Role Account agar nampak premium macam butang Tambah Pengguna */
    .role-label-container {
        background-color: #16a34a !important; /* Hijau butang Tambah Pengguna */
        color: white !important;
        border-radius: 8px !important;
        font-weight: bold !important;
        padding: 8px 12px !important;
        display: flex;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-right: 10px;
    }

    .role-label-container i.icon {
        margin-right: 8px !important;
        margin-left: 0 !important;
        color: white !important;
    }
</style>

<header class="ui menu fixed top borderless" id="topbar">
    <div class="item mobile only tablet only" data-role="sidebar-visibility-switcher"><i class="icon sidebar"></i></div>

    <div class="menu right p-r-1" id="userbar" data-turbolinks-permanent>
        @auth
            <div class="item">
                
                <div class="role-label-container">
                    <i class="icon user shield"></i> 
                    {{ data_get($roleuser, 'acl_roles.name') }}
                </div>

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
                                <i class="big bell outline icon" style="color: #fecb3a;"></i>
                                <span id="notis">
                                    <font color="red"><b>{{ $pendding }}</b></font>
                                </span>
                                <i class="dropdown icon m-l-0 {{ config('laravolt.ui.color') }}"></i>
                                <div class="menu">
                                    <div class="header">
                                        <span class="ui text {{ config('laravolt.ui.color') }}">Kelulusan Pengguna</span>
                                    </div>
                                    <div class="divider"></div>
                                    <a href="{{ route('site::users.approveindex') }}" class="item">
                                        <b>Perlu Kelulusan Pengguna </b>
                                        <div class="ui primary inverted basic label">{{ $pendding }}</div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endauth
    </div>
</header>