@extends('laravolt::tnb.layouts.base')

@section('content')
<div class="container">

<div class="contact-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">

          <h5 class="m-0 sidebar-title" style="color:purple"><i class="material-icons app-header-icon text-top">brightness_high</i> Permissions   <a class="ml-6 btn-floating waves-effect waves-light blue accent-2 btn-small" href="/admin/permissionadd"><i class="material-icons">add_circle</i>ADD </a>
          </h5>




          <div class="mt-10 pt-2" >
            <p class="m-0 subtitle font-weight-700" style="color:purple">Total number of permission</p>
            <p class="m-0 text-muted " style="color:purple">{{$permission->count()}} Permissions</p>

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
   
          @foreach($permission as $key => $perm)
              <div class="col s12 m6  l4 card-width h-100" onclick="location.href='/admin/permissionedit/{{$perm->id}}'" style="cursor: pointer;">
                  <div class="card row gradient-45deg-indigo-light-blue gradient-shadow white-text padding-4 mt-5 " style="min-height: 258px; !important">
                    <div class="col s7 m7">
                      <i class="material-icons background-round mt-5 mb-5">brightness_high</i>
                      
                    </div>
                    <div class="col s5 m5 right-align">
                      <h5 class="mb-0 white-text"></h5>
                      <p class="no-margin" style="overflow-wrap: break-word;">{{$perm->name}}</p>
                    </div>
                    <div class="col s12 m12">
                    <p>{{ $perm->description ?? "No description" }}</p>
                    </div>
                  </div>
              </div>
          @endforeach
      </div>
  
  </div>
</div>
</div>
   

@endsection