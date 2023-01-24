@extends('laravolt::tnb.layouts.base')

@section('content')
<div class="container">

<div class="contact-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title" style="color:purple"><i class="material-icons app-header-icon text-top">perm_identity</i> Add new User
          </h5>
          <div class="mt-10 pt-2" >
            <a class="btn forward mb-1" href="/admin/user"><i class="material-icons left">reply</i><span>Back</span></a>
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
       <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s6"><a class="active" href="#test1">User</a></li>
        <li class="tab col s6"><a href="#test2">State Information</a></li>
      </ul>
    </div>
    <div id="test1" class="col s12">
    <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
        <div id="prefixes" class="card card card-default scrollspy">
          <div class="card-content">
            <h4 class="card-title">Add new user</h4>
             {!! SemanticForm::post(route('site::system.createuser'))->attribute('id', 'createuser') !!}
              <input type="hidden" name="password" value="secret"/>


              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">account_circle</i>
                  <input id="name" name="name" type="text">
                  <label for="name">Name</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">email</i>
                  <input id="email" name="email" type="email">
                  <label for="email">Email</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">account_box</i>
                  <input id="staff_id" name="staff_id" type="text" value="">
                  <label for="staff_id">Staff ID</label>
                </div>
              </div>
              <br>
              <br>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">developer_mode</i>
                  <select name="status" id="status">
                      <option value="" disabled selected>Choose your option</option>
                      <option value="ACTIVE" >ACTIVE</option>
                      <option value="PENDING">INACTIVE</option>
                  </select>
                  <label for="status">Status</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">accessibility</i>
                  <br><br>
                  @foreach($acl_role as $key => $role)
                  <p>
                    <label>
                      <input name="roles[]" type="radio" value="{{$role->id}}"  />
                      <span>{{$role->name}}</span>
                    </label>
                  </p>
                 @endforeach

                  <label for="message3">Role</label>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">@lang('laravolt::action.save')
                      <i class="material-icons right">send</i>
                    </button>
                  </div>
                </div>
              </div>
           
          </div>
        </div>
    </div>


    </div>
    <div id="test2" class="col s12">
          <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
        <div id="prefixes" class="card card card-default scrollspy">
          <div class="card-content">
            <h4 class="card-title">Select State for this user</h4>


              <div class="row">
                  <div class="input-field col s12">
                        <br><br>
                        @foreach($states as $states)
                            <p>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $states->id }}"  />
                                    <span>{{ $states->name ?? "No description" }}</span>
                                </label>
                            </p>
                        @endforeach
                        <label for="message3">State</label>
                  </div>
              </div>
             
           
            <div class="row">
                  <div class="input-field col s12">
                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action">@lang('laravolt::action.save')
                      <i class="material-icons right">send</i>
                    </button>
                  </div>
                </div>
              </div>
            {!! Form::close() !!}
          </div>
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