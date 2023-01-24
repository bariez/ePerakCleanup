@extends('laravolt::tnb.layouts.base')

@section('content')
<div class="container">

<div class="contact-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title" style="color:purple"><i class="material-icons app-header-icon text-top">brightness_high</i> Edit Permission
          </h5>
          <div class="mt-10 pt-2" >
            <a class="btn forward mb-1" href="/admin/permission"><i class="material-icons left">reply</i><span>Back</span></a>
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
         <div id="prefixes" class="card card card-default scrollspy">
        <div class="card-content">
          <h4 class="card-title">Permission Name : {{$permission->name}}</h4>
           {!! SemanticForm::post(route('site::system.updatepermission'))->attribute('id', 'saveuser') !!}


            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">assessment</i>
                <input id="name" name="name" type="text" value="{{$permission->name}}">
                <label for="name3">Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">assignment</i>
                <input id="email" name="description" type="text" value="{{$permission->description}}">
                <label for="email3">Description</label>
              </div>
            </div>
            
            
          <input type="hidden" name="id" value="{{data_get($permission,'id')}}"/>
          <div class="row">
                <div class="input-field col s12">
                  <button class="btn cyan waves-effect waves-light right" type="submit" name="action">@lang('laravolt::action.save')
                    <i class="material-icons right">send</i>
                  </button>
                </div>
              </div>
          {!! Form::close() !!}
        </div>
        <div class="ui divider section hidden"></div>
         <div class="card red darken-1">
              <div class="card-content white-text">
                  <span class="card-title">Delete Permission</span>
                  <p>
                    Make sure permission is not use in roles
                  </p>
                  <br>
                  <br>
                  {!! SemanticForm::open()->get()->action(route('site::system.deletepermission', $permission['id'])) !!}
                      <button class="btn waves-effect waves-light red accent-2" type="submit" name="submit" value="1"
                          onclick="return confirm('Are you sure want to delete this permission')">@lang('laravolt::action.delete')
                      </button>
                  {!! SemanticForm::close() !!}
              </div>
              
          </div>
      </div>
    </div>
  </div>
</div>
</div>
   

@endsection
@push('script')
@endpush