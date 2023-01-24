@php($items = app('laravolt.menu.sidebar')->all())
<!-- {{$items}} -->
<nav class="sidebar" data-role="sidebar" id="sidebar" data-turbolinks-permanent>
    <div class="sidebar__scroller" style="background-color: #000;">

        <div class="sidebar__menu" style="background-color: #000;" id="divsidemenu">
            


            @auth
                <div class="sidebar__profile m-b-0 p-0 p-t-2 ui basic segment text-center" style="background-color: #fed000;">
                    <img src="{{asset('logo.png') }}" alt="" class="ui image tiny centered avatar">
                    <br>
                <div align="text-center" align="text-center" style="
                        font-size: 22px;
                        font-style: initial;
                        font-weight: 700;
                        color: #000;">e-Perak</div>
                    <h4 class="ui header m-b-3">
                        <?php echo strtoupper(auth()->user()->name);?> 
                        
                    </h4>
                    <a class="ui button" data-tooltip="Logout" href="{!! URL::to('auth/addlog/'.auth()->user()->id) !!}" style="height: 40px;background-color: #000;color: white;font-size:11px;padding-top: 1.1em;"><i class="sign in alternate icon" style="margin: auto;"></i></a>
                      <div class="ui simple dropdown basic button top right pointing b-0 p-x-volt-0" style="padding: 6px 0px;background: transparent;">
                     <a class="ui button" style="background-color: #000;color: white;font-size:11px;height: 40px;"><i class="user icon" style="margin: auto;"></i></a>
                    
                        <div class="menu">
                            <div class="header"><span class="ui text {{ config('laravolt.ui.color') }}">{{ auth()->user()->name }}</span></div>

                            <div class="divider"></div>

                            <a href="{{ route('my::profile.edit') }}" class="item">@lang('KEMASKINI PROFIL')</a>
                            <a href="{{ route('my::password.edit') }}" class="item">@lang('KEMASKINI KATA LALUAN')</a>
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
