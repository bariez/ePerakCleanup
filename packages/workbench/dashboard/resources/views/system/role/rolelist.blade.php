@extends('laravolt::tnb.layouts.base')

@section('content')
<div class="container">

<div class="contact-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">

          <h5 class="m-0 sidebar-title" style="color:purple"><i class="material-icons app-header-icon text-top">history</i> Roles   <a class="ml-6 btn-floating waves-effect waves-light blue accent-2 btn-small" href="/admin/roleadd"><i class="material-icons">add_circle</i>ADD </a>
          </h5>




          <div class="mt-10 pt-2" >
            <p class="m-0 subtitle font-weight-700" style="color:purple">Total number of roles</p>
            <p class="m-0 text-muted " style="color:purple">{{$role->count()}} Roles</p>

          </div>
        </div>
      </div>
      <!-- @include('laravolt::tnb.layouts.adminmenu') -->
      
    </div>
  </div>
</div>
<!-- Sidebar Area Ends -->

<!-- Content Area Starts -->

<div class="content-area content-right">

  <div class="app-wrapper">
    
    <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
   
          @foreach($role as $key => $roles)
              <div class="col s12 m6 l4 card-width" onclick="location.href='/admin/roleedit/{{$roles->id}}'" style="cursor: pointer;">
                  <div class="card row gradient-45deg-blue-indigo gradient-shadow white-text padding-4 mt-5" style="min-height: 258px; !important">
                    <div class="col s7 m7">
                      <i class="material-icons background-round mt-5 mb-5">history</i>
                      <p>{{$roles->name}}</p>
                    </div>
                    <div class="col s5 m5 right-align">
                      <h5 class="mb-0 white-text">{{$roles->permission->count()}}</h5>
                      <p class="no-margin" style="overflow-wrap: break-word;">Permissions</p>
                    </div>
                  </div>
              </div>
              
          @endforeach
      </div>
  
  </div>
</div>
</div>
   

@endsection