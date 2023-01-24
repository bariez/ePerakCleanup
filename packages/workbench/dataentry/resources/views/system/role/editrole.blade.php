@extends('laravolt::tnb.layouts.base')

@section('content')
<div class="container">

<div class="contact-overlay"></div>
    <div class="sidebar-left sidebar-fixed">
        <div class="sidebar">
            <div class="sidebar-content">
                <div class="sidebar-header">
                    <div class="sidebar-details">
                        <h5 class="m-0 sidebar-title" style="color:purple"><i class="material-icons app-header-icon text-top">history</i> Edit Role</h5>
                        <div class="mt-10 pt-2" >
                            <a class="btn forward mb-1" href="/admin/role"><i class="material-icons left">reply</i><span>Back</span></a>
                        </div>
                    </div>
                </div>
                <!-- @include('laravolt::tnb.layouts.adminmenu') -->
              </div>
          </div>
    </div>
    <div class="content-area content-right">
        <div class="app-wrapper">
            <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
                <div id="prefixes" class="card card card-default scrollspy">
                    <div class="card-content">
                        <h4 class="card-title">Role Name : {{$role->name}}</h4>
                        {!! SemanticForm::open()->put()->action(route('site::system.roleupdate', $role['id'])) !!}
                            <input type="hidden" name="id" value="{{data_get($role,'id')}}"/>
                            <div class="field required">
                            @if($role->name == 'admin')
                                <input type="text" name="name" value="{{data_get($role,'name')}}" readonly="" />
                            @else
                                {!! SemanticForm::text('name', old('name', $role['name']))->label(trans('laravolt::roles.name')) !!}
                            @endif
                            </div>


                            <div class="row">
                                <div class="input-field col s12">
                                      <br><br>
                                      @foreach($permissions as $permission)
                                          <p>
                                              <label>
                                                  <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ (in_array($permission->id, $assignedPermissions))?'checked=checked':'' }} />
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
                        @if($role->name !== 'admin')
                        <div class="card red darken-1">
                            <div class="card-content white-text">
                                <span class="card-title">@lang('laravolt::label.delete_role')</span>
                                <p>
                                  @lang('laravolt::message.delete_role_intro', ['count' => $role->users->count()])
                                </p>
                                <br>
                                <br>
                                {!! SemanticForm::open()->get()->action(route('site::system.deleterole', $role['id'])) !!}
                                    <button class="btn waves-effect waves-light red accent-2" type="submit" name="submit" value="1"
                                        onclick="return confirm('@lang('laravolt::message.role_deletion_confirmation')')">@lang('laravolt::action.delete')
                                    </button>
                                {!! SemanticForm::close() !!}
                            </div>
                            
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   

@endsection
@push('script')
@endpush