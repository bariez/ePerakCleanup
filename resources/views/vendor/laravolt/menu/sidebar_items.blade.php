<?php


use App\Models\User;

$pendding  = User::where('status','PENDING')->count();

$id=5;
?>

<div class="ui accordion sidebar__accordion m-b-1" data-role="sidebar-accordion">
    @foreach($items->sortBy(fn($item) => $item->data('order')) as $item)
        @if($item->hasChildren())
            <div class="title {{ \Laravolt\Platform\Services\SidebarMenu::setActiveParent($item->children(), $item->isActive) }}">

                <!-- aku delete icon  -->
    
                <span>{{ $item->title }}</span>
                <i class="angle down icon"></i>
            </div>
            <div class="content {{ \Laravolt\Platform\Services\SidebarMenu::setActiveParent($item->children(), $item->isActive) }} ">
                @if($item->hasChildren())
                    <div class="ui list">
                        @foreach($item->children()->sortBy(fn($item) => $item->data('order')) as $child)
                            <a href="{{ $child->url() }}" data-parent="{{ $child->parent()->title }}"
                               class="item {{ ($child->isActive)?'selected':'' }} ">{{ $child->title }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        @else
            <a class="title empty {{ \Laravolt\Platform\Services\SidebarMenu::setActiveParent($item->children(), $item->isActive) }}"
               href="{{ $item->url() }}"
               data-parent="{{ $item->parent()->title }}">
  <!-- aku delete icon  -->

                @if($item->title == 'KELULUSAN PENGGUNA')
                <span>{{ $item->title }} <span> <div class="ui primary inverted basic label">{{$pendding}}</div>
                @else
                <span>{{ $item->title }}</span> 
                @endif
                
            </a>
            <div class="content"></div>
        @endif

    @endforeach
</div>
