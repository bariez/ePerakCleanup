@php($items = app('laravolt.menu.sidebar')->all())
<!-- {{$items}} -->

    <?php

 
        use Workbench\Site\Model\Lookup\AclRoleUser;

        $user     = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))
                               ->with('acl_roles')
                               ->first();


        ?>
<nav class="sidebar" data-role="sidebar" id="sidebar" data-turbolinks-permanent>
    <div class="sidebar__scroller" style="background-color: #000;">

        <div class="sidebar__menu" style="background-color: #000;" id="divsidemenu">
            


            @auth
                <div class="sidebar__profile m-b-0 p-0 p-t-2 ui basic segment text-center" style="background-color: #fed000;">
                    <img src="{{asset('logo.png') }}" alt="" class="ui image tiny centered avatar">
                    <br>
                <div align="text-center" align="text-center" style="
                        font-size: 18px;
                        font-style: initial;
                        font-weight: 700;
                        color: #000;">e-Perak</div>
                    <h4 class="ui header m-b-2">
                        <?php echo strtoupper(auth()->user()->name);?> 
                    </h4>
                    <a class="ui button" data-tooltip="Logout" href="{!! URL::to('auth/addlog/'.auth()->user()->id) !!}" style="height: 35px;background-color: #000;color: white;font-size:14px;"><i class="sign in alternate icon" style="margin: auto;"></i></a>
                @if(data_get($roleuser, 'acl_roles.id')==1)
                 <a class="ui button" data-tooltip="Panduan Pengguna" target="_blank" href="{{  asset('Manual Pengguna - Pentadbir Sistem.pdf')}}" style="height: 35px;background-color: #000;color: white;font-size:14px;"><i class="address book outline icon" style="margin: auto;"></i></a>
                @elseif(data_get($roleuser, 'acl_roles.id')==3)
                <a class="ui button" data-tooltip="Panduan Pengguna" target="_blank" href="{{  asset('Manual Pengguna - Penghulu Mukim.pdf')}}" style="height: 35px;background-color: #000;color: white;font-size:14px;"><i class="address book outline icon" style="margin: auto;"></i></a>
                @else
                <a class="ui button" data-tooltip="Panduan Pengguna" target="_blank" href="{{ asset('Manual Pengguna - Data Entry.pdf')}}" style="height: 35px;background-color: #000;color: white;font-size:14px;"><i class="address book outline icon" style="margin: auto;"></i></a>
                @endif
                      <div class="ui simple dropdown basic button top right pointing b-0 p-x-volt-0" style="padding: 6px 0px;background: transparent;">
                     <a class="ui button" style="background-color: #000;color: white;font-size:14px;height: 35px;"><i class="user icon" style="margin: auto;"></i></a>
                    
                        <div class="menu" style="width: 180px">
                            <div class="header"><span class="ui text {{ config('laravolt.ui.color') }}">{{ auth()->user()->name }}</span></div>

                            <div class="divider"></div>

                            <a href="{{ route('my::profile.edit') }}" class="item" style="font-size: 12px">@lang('KEMASKINI PROFIL')</a>
                            <a href="{{ route('my::password.edit') }}" class="item" style="font-size: 12px">@lang('KEMASKINI KATA LALUAN')</a>
                        </div>
                </div>
               
                

                </div>
                <div>
                 </div>
           
            @endauth


            @if(!$items->isEmpty())
                @if(config('laravolt.platform.features.quick_switcher'))
                    @include('laravolt::quick-switcher.modal')
                @endif

                <div class="ui attached vertical menu fluid" data-role="original-menu">

                    @foreach($items as $item)
                        @if($item->hasChildren())
                            <div class="item">
                                @if($item->title=='System')
                                <div class="header">Sistem</div>
                                @else
                                <div class="header">{{ $item->title }}</div>
                                @endif
                                
                            </div>
                            @include('laravolt::menu.sidebar_items', ['items' => $item->children()])
                        @else
                            <div class="ui accordion sidebar__accordion">
                                <a class="title empty {{ \Laravolt\Platform\Services\SidebarMenu::setActiveParent($item->children(), $item->isActive) }}"
                                   href="{{ $item->url() }}">
                                    <i class="left icon {{ $item->data('icon') }}"></i>
                                    <span>{{ $item->title }}</span>
                                </a>
                                <div class="content"></div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</nav>
