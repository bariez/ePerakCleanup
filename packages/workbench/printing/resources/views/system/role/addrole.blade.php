@extends('laravolt::tnb.layouts.base')

@section('content')
<div class="container">

<div class="contact-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title" style="color:purple"><i class="material-icons app-header-icon text-top">history</i> Add Role
          </h5>
          <div class="mt-10 pt-2" >
            <a class="btn forward mb-1" href="/admin/role"><i class="material-icons left">reply</i><span>Back</span></a>
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
          <h4 class="card-title">Create New Role</h4>
          {!! SemanticForm::open()->post()->action(route('site::system.saverole')) !!}

          <div class="row">
              <div class="input-field col s12">
                  <input id="name" name="name" type="text" required>
                  <label for="name3">Name</label>
              </div>
          </div>

          <div class="row">
              <div class="input-field col s12">
                  <br><br>
                  @foreach($permissions as $permission)
                  <p>
                      <label>
                          <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ (false)?'checked=checked':'' }} />
                          <span>{{ $permission->description ?? "No description" }}</span>
                      </label>
                  </p>
                  @endforeach
                  <label for="message3">Permissions</label>
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




    <div class="ui divider section hidden"></div>


        </div>
      </div>
    </div>
  </div>
</div>
</div>
   

@endsection
@push('script')
@endpush