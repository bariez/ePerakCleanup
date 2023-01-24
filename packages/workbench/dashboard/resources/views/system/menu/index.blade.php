@extends('laravolt::tnb.layouts.base')

@section('content')
<div class="container">
    <div class="contact-overlay"></div>
    <div class="sidebar-left sidebar-fixed">
        <div class="sidebar">
            <div class="sidebar-content">

                <div class="sidebar-header">
                    <div class="sidebar-details">
                        <h5 class="m-0 sidebar-title" style="color:purple"><i class="material-icons app-header-icon text-top">settings</i> Menu Setting<a class="ml-6 btn-floating waves-effect waves-light blue accent-2 btn-small" href="/admin/menusegment"><i class="material-icons">add_circle</i>ADD </a>
                        </h5>
                        <div class="mt-10 pt-2" >
                            <p class="m-0 subtitle font-weight-700" style="color:purple">Total number of Menu Segment</p>
                            <p class="m-0 text-muted " style="color:purple">{{$segment->count()}} Segments</p>
                        </div>
                    </div>


                </div>
                @if($segment->count() > 0)
                <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1 tabs-vertical" style="overflow: hidden; ">
                    <div class="sidebar-list-padding app-sidebar sidenav " id="contact-sidenav">
                        <ul class="contact-list display-grid tabs">
                            <li class="sidebar-title" style="cursor: none">Menu Segment
                            </li>
                            @foreach($segment as $key => $list)             
                            <li class="tab">
                                <a href="#{{$key}}" class="active text-sub">
                                    {{$list->name}}
                                </a>
                            </li>
                            @endforeach
                                        
                        </ul>
                    </div>
                </div>
                @endif
                <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only" >
                    <i class="material-icons" style="color:blue">menu</i>
                </a>
            </div>
        </div>
    </div>
    <div class="content-area content-right">
        <div class="app-wrapper">
            @forelse($segment as $key => $list)             
                <div id="{{$key}}">

                    <div class="card-panel">
                        <div class="row">
                            <div class="col s12 m7">
                                <div class="display-flex media">
                                    
                                    <div class="media-body">
                                        <h6 class="media-heading">
                                            <span class="users-view-name">{{$list->name}} - (status : @if($list->status == 0) INACTIVE @else ACTIVE @endif)</span>
                                            
                                        </h6>
                                        <span>Number of menu:</span>
                                        <span class="users-view-id">{{$list->child->count()}}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                                <a href="/admin/editsegment/{{$list->id}}" class="btn-small indigo">Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-panel">

                          <ul class="collection with-header">
                           
                            @foreach($list->child as $keys =>$menu)
                             <li class="collection-item">
                                <div>
                                    {{$menu->name}}
                                    <a href="/admin/editmenu/{{$menu->id}}" class="secondary-content tooltipped " data-position="top" data-tooltip="Edit this menu">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a href="#!" class="secondary-content tooltipped mr-5" data-position="bottom" data-tooltip="Add Sub Menu" onclick="addSubModal('{{$menu->id}}','{{$menu->name}}');return false;">
                                        <i class="material-icons">library_add</i>
                                    </a>
                                </div>
                                
                            </li>
                            @if($menu->submenu->count() > 0)
                            <ul class="collection with-header ml-5">
                           
                                    @foreach($menu->submenu as $keys =>$sub)
                                     <li class="collection-item">
                                        <div>
                                        <i class="material-icons">subdirectory_arrow_right</i>
                                            {{$sub->name}}
                                            <a href="/admin/editmenu/{{$sub->id}}" class="secondary-content tooltipped " data-position="top" data-tooltip="Edit this submenu" style="color:blue">
                                                <i class="material-icons">edit</i>
                                            </a>
                                             
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                            @endforeach


                            
                           
                          </ul>
                          
                        <a class="waves-effect waves-light modal-trigger btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1" data-parent="{{$list->id}}" data-name="{{$list->name}}" onclick="addModal('{{$list->id}}','{{$list->name}}');return false;">Add New Menu</a>

                    </div>
                </div>
            @empty
            <div class="card horizontal">
                <div class="card-image"><img src="{{asset('theme/assets/images/gallery/11.png')}}" alt=""></div>
                <div class="card-stacked">
                    <div class="card-content">
                        <p>No Segment and menu created.</p>
                    </div>
                    <div class="card-action"><a href="/admin/menusegment">Add new segment</a></div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
    <div id="modal2" class="modal">
      <div class="modal-content">
        <div class="col s12">
          <div id="basic-form" >
              <h4 class="card-title" id="mod-title"></h4>
              {!! SemanticForm::open()->post()->action(route('site::menu.addsegment')) !!}
              <input type="hidden" name="parent_id" id="parent_id" value="" >

                  <div class="row">
                      <div class="input-field col s12">
                          <input id="name" name="name" type="text" required>
                          <label for="name3">Menu Name</label>
                      </div>
                  </div>

                  <div class="row">
                      <div class="input-field col s12">
                          <select name="permission">
                              <option value="" disabled selected>Choose your option</option>
                              @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->description }}</option>
                              @endforeach
                          </select>
                          <label>Menu Permission</label>
                      </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                        <label for="contactNum" class="">Order<span class="red-text">*</span></label>
                        <input type="number" class="validate invalid" name="order" id="contactNum" value="1" required="">
                    </div>
                  </div>
                  <div class="row">
                      <div class="input-field col s12">
                          <button class="btn cyan waves-effect waves-light right" type="submit" name="action">@lang('laravolt::action.save')
                              <i class="material-icons right">send</i>
                          </button>
                      </div>
                  </div>
                  
                {!! SemanticForm::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="modalsub" class="modal">
      <div class="modal-content">
        <div class="col s12">
          <div id="basic-form" >
              <h4 class="card-title" id="mod-title-sub"></h4>
              {!! SemanticForm::open()->post()->action(route('site::menu.addsegment')) !!}
              <input type="hidden" name="menu_parent_id" id="menu_parent_id" value="" >

                  <div class="row">
                      <div class="input-field col s12">
                          <input id="name" name="name" type="text" required>
                          <label for="name3">Menu Name</label>
                      </div>
                  </div>

                  <div class="row">
                      <div class="input-field col s12">
                          <select name="permission">
                              <option value="" disabled selected>Choose your option</option>
                              @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->description }}</option>
                              @endforeach
                          </select>
                          <label>Menu Permission</label>
                      </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                        <label for="contactNum" class="">Order<span class="red-text">*</span></label>
                        <input type="number" class="validate invalid" name="order" id="contactNum" value="1" required="">
                    </div>
                  </div>
                  <div class="row">
                      <div class="input-field col s12">
                          <button class="btn cyan waves-effect waves-light right" type="submit" name="action">@lang('laravolt::action.save')
                              <i class="material-icons right">send</i>
                          </button>
                      </div>
                  </div>
                  
                {!! SemanticForm::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">


$(document).ready(function () {


});

function addModal(parent,name){


    // alert(name);
   $("#parent_id").val(parent);
   $("#mod-title").html("Add new menu for : "+ name);
   $('#modal2').modal('open');

   
}

function addSubModal(parent,name){


    // alert(name);
   $("#menu_parent_id").val(parent);
   $("#mod-title-sub").html("Add new submenu for : "+ name);
   $('#modalsub').modal('open');

   
}
  
  
</script>
@endpush