@extends('laravolt::tnb.layouts.base')

@section('content')
<div class="container">

<div class="contact-overlay"></div>
<div class="sidebar-left sidebar-fixed">
  <div class="sidebar">
    <div class="sidebar-content">
      <div class="sidebar-header">
        <div class="sidebar-details">
          <h5 class="m-0 sidebar-title" style="color:purple"><i class="material-icons app-header-icon text-top">add_to_photos</i> Edit Menu
          </h5>
          <div class="mt-10 pt-2" >
            <a class="btn forward mb-1" href="/admin/menu"><i class="material-icons left">reply</i><span>Back</span></a>
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
          {!! SemanticForm::open()->post()->action(route('site::menu.addsegment')) !!}

          <input type="hidden" name="edit_menu" value="{{$segment->id}}" >

          <div class="row">
              <div class="input-field col s12">
                  <input id="name" name="name" type="text" value="{{$segment->name}}" required>
                  <label for="name3">@if($segment->type == 'MAIN') Menu Name @else Sub Menu Name @endif</label>
              </div>
          </div>

          <div class="row">
              <div class="input-field col s12">
                  <select name="permission">
                      <option value="" disabled>Choose your option</option>
                      @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}" @if($permission->id == $segment->permission) selected @endif>{{ $permission->description }}</option>
                      @endforeach
                  </select>
                  <label>Menu Permission</label>
              </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
                <label for="contactNum" class="">Order<span class="red-text">*</span></label>
                <input type="number" class="validate invalid" name="order" id="contactNum" value="{{$segment->order}}" required="">
            </div>
          </div>
          <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">developer_mode</i>
                <select name="status">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1" @if($segment->status == 1) selected @endif>ACTIVE</option>
                    <option value="0" @if($segment->status == 0) selected @endif>INACTIVE</option>
                </select>
                <label>Status</label>
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
<script type="text/javascript">


$(document).ready(function () {

    $(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%'
});

});
  
  
</script>
@endpush