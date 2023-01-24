@extends('laravolt::tnb.layouts.base')

@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('theme/assets/css/pages/page-knowledge.css')}}">
@endpush
@section('content')
<div class="container">
    <div class="contact-overlay"></div>
    <div class="sidebar-left sidebar-fixed">
        <div class="sidebar">
            <div class="sidebar-content">

                <div class="sidebar-header">
                    <div class="sidebar-details">
                        <h5 class="m-0 sidebar-title" style="color:purple"><i class="material-icons app-header-icon text-top">import_contacts</i> Customization
                        </h5>
                        <div class="mt-10 pt-2" >
                           <!-- <a class="btn forward mb-1" href="/admin/page"><i class="material-icons left">reply</i><span>Back</span></a> -->
                        </div>

                    </div>


                </div>
                @if($pagerow->count() > 0)
                <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1 tabs-vertical" style="overflow: hidden; ">
                    <div class="sidebar-list-padding app-sidebar sidenav " id="contact-sidenav">
                        <ul class="contact-list display-grid tabs">
                            <li class="sidebar-title" style="cursor: none">Page Rows (<a href="/dashboard/addrow/1">Add new</a>)
                            </li>
                            @foreach($pagerow as $key => $list)             
                            <li class="tab">
                                <a href="#{{$key}}" class="active text-sub">
                                    Row {{$key+1}}
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

            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m7">
                        <div class="display-flex media">
                            
                            <div class="media-body">
                                <h6 class="media-heading">
                                    <span class="users-view-name">Dashboard</span>
                                    
                                </h6>
                                

                            </div>
                        </div>
                    </div>
                    <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                        <!-- <a class="btn-small indigo modal-trigger" onclick="updatepage();return false;">Edit</a> -->
                    </div>
                </div>
            </div>

            @forelse($pagerow as $key => $list)             
                <div id="{{$key}}">
                    <div class="card-panel">
                        Row {{$key+1}}
                        <a class="" class="" href="/dashboard/removerow/{{$list->id}}" onclick="return confirm('are you sure want to remove this row ?')"><i class="material-icons right tooltipped" style="font-size: 20px;margin:5px" data-position="left" data-tooltip="remove this row">delete</i></a>
                        <br>
                        Note : You can add up to four (4) Column for each row
                        <hr>
                        <div class="section" id="knowledge">
                            <div class="row knowledge-content" style="background-color: #ECEFF1">
                                @foreach($list->column as $keys =>$column)

                                    <?php

                                        $columnsize = 12/$list->column->count();

                                    ?>

                                    <div class="col s12 m{{$columnsize}}">
                                        <div class="card card-hover z-depth-0 card-border-gray">
                                        <a class="" class="" href="/dashboard/removecolumn/{{$column->id}}" onclick="return confirm('are you sure want to remove this column ?')"><i class="material-icons right tooltipped" style="font-size: 20px;margin:5px" data-position="left" data-tooltip="remove this column">delete</i></a>
                                        
                                            <a onclick="addModal('{{$column->id}}');return false;" style="cursor: pointer;">

                                              @if($column->widget)
                                                  <div class="card-content center-align">
                                                    <h6><b>{{$column->widget->name}}</b></h6>
                                                    <p class="mb-2 black-text">{{$column->widget->types->name}}</p>
                                                  </div>
                                              @else

                                                <div class="card-content center-align">
                                                <h6><b>Column {{$keys+1}}</b></h6>
                                                <i class="material-icons md-48 blue-text">aspect_ratio</i>
                                                <p class="mb-2 black-text">@if($column->widget) {{$column->widget->name}} @else Assign you widget here @endif</p>
                                              </div>

                                              @endif
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if($list->column->count() < 4)
                            <a class="waves-effect waves-light modal-trigger btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1" href="/dashboard/addcolumn/{{$list->id}}">
                                Add New column
                            </a>
                        @endif

                    </div>
                </div>
            @empty
            <div class="card horizontal">
                <div class="card-image"><img src="{{asset('theme/assets/images/gallery/11.png')}}" alt=""></div>
                <div class="card-stacked">
                    <div class="card-content">
                        <p>No Page Row created.</p>
                    </div>
                    <div class="card-action"><a href="/dashboard/addrow/1">Add new page row</a></div>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <div id="modal" class="modal modal-fixed-footer">
      <div class="modal-content">
        <div class="col s12">
          <div id="basic-form" >
              <h4 class="card-title" id="mod-title"></h4>
              {!! SemanticForm::open()->post()->action(route('site::dashboard.updatecolumn')) !!}
              <input type="hidden" name="column_id" id="parent_id" value="" >

                  
                  <div class="row">
                      <div class="input-field col s12">
                          <select name="wid">
                              @foreach($widget as $key => $widgets)
                                  <option value="{{$widgets->id}}">({{$widgets->types->name}}){{$widgets->name}}</option>
                              @endforeach
                          </select>
                          <label>Widget</label>
                      </div>
                  </div>
                                    
              
            </div>
          </div>
        </div>
        <div class="modal-footer">
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">@lang('laravolt::action.save')
                    <i class="material-icons right">send</i>
                </button>
        </div>
                    {!! SemanticForm::close() !!}
    </div>


</div>
@endsection

@push('script')
<script type="text/javascript">


$(document).ready(function () {


});

function addModal(parent){


   $("#parent_id").val(parent);
   $("#mod-title").html("Assign Widget to Column");
   $('#modal').modal('open');

   
}


function updatepage(){

   $('#modal2').modal('open');

   
}

  
</script>
@endpush