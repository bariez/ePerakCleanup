@extends('laravolt::tnb.layouts.base')

@section('content')
<style>
.dataTables_scrollHeadInner{
  width: 100% !important;
}
table.dataTable.no-footer{
  width: 100% !important;
}
</style>
<div class="container">

<div class="contact-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title" style="color:purple"><i class="material-icons app-header-icon text-top">perm_identity</i> User <a class="ml-6 btn-floating waves-effect waves-light blue accent-2 btn-small" href="/admin/useradd"><i class="material-icons">add_circle</i>ADD </a>
          </h5>
          </h5>
          <div class="mt-10 pt-2" >
            <p class="m-0 subtitle font-weight-700" style="color:purple">Total number of user</p>
            <p class="m-0 text-muted " style="color:purple">{{$useractive->count() + $userinactive->count()}} Users</p>
          </div>
        </div>
      </div>
      <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1 tabs-vertical" style="overflow: hidden; ">
                    <div class="sidebar-list-padding app-sidebar sidenav " id="contact-sidenav">
              <ul class="contact-list display-grid tabs">
                  <li class="sidebar-title" style="cursor: none">Filtering
                  </li>
                           
                  <li class="tab">
                      <a href="#activeuser" class="active text-sub">
                          Active User List
                      </a>
                  </li>
                  <li class="tab">
                      <a href="#inactiveuser" class="text-sub">
                          Inactive User List
                      </a>
                  </li>
                  
                              
              </ul>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- Sidebar Area Ends -->

<!-- Content Area Starts -->
<div class="content-area content-right">
  <div class="app-wrapper">

     <div id="activeuser">
        <div class="datatable-search">
              <i class="material-icons mr-2 search-icon">search</i>
              <input type="text" placeholder="Search User" class="app-filter" id="global_filter">
        </div>
        <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
          <div class="card-content p-5">
            <table id="data-table-contact" class="display" style="width:100%">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Staff Id</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($useractive as $key =>$data)
                  <tr>
                    <td>{{$data->name}}</td>
                    <td>{{$data->staff_id}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->roles->implode('name', ', ')}}</td>
                    <td><a href="/admin/useredit/{{$data->id}}" class="invoice-action-edit">
                    <i class="material-icons">edit</i>
                  </a></td>
                  </tr>
                  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
     </div>

     <div id="inactiveuser">
        <div class="datatable-search">
              <i class="material-icons mr-2 search-icon">search</i>
              <input type="text" placeholder="Search User" class="app-filter" id="global_filter2">
        </div>
        <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
          <div class="card-content p-5">
            <table id="data-table-contact2" class="display" style="width:100% !important">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Staff Id</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($userinactive as $key =>$data)
                  <tr>
                    <td>{{$data->name}}</td>
                    <td>{{$data->staff_id}}</td>
                    <td>{{$data->email}}</td>
                    <td>{{$data->roles->implode('name', ', ')}}</td>
                    <td><a href="/admin/useredit/{{$data->id}}" class="invoice-action-edit">
                    <i class="material-icons">edit</i>
                  </a></td>
                  </tr>
                  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
     </div>

  </div>
</div>
</div>
   

@endsection
