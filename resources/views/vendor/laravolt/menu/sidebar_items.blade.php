<?php

use App\Models\User;

$pending = User::where('status', 'PENDING')->count();

?>

<div class="ui accordion sidebar__accordion m-b-1" data-role="sidebar-accordion">
    @foreach ($items->sortBy(fn($item) => $item->data('order')) as $item)
        @if ($item->title == 'Database' || $item->title == 'Application Log' || $item->title == 'Lookup')
            &nbsp;
        @else
            <a class="title empty {{ \App\Laravolt\Platform\Services\SidebarMenu::setActiveParent($item->children(), $item->isActive) }}"
                href="{{ $item->url() }}" data-parent="{{ $item->parent()->title }}">
                <!-- aku delete icon  -->

                @if ($item->title == '- KELULUSAN PENGGUNA')
                    <span>
                        <font style="font-size:12px;">{{ $item->title }}</font>
                        <span>
                            <div class="ui primary inverted basic label">{{ $pending }}</div>
                        @else
                            <span>
                                <font style="font-size:12px;">{{ $item->title }}</font>
                            </span>
                @endif

            </a>
        @endif
        <div class="content"></div>
    @endforeach
</div>
