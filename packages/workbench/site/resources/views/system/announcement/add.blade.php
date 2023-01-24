@extends('laravolt::tnb.layouts.base')

@push('style')

<style>
    .modal{
        width: 60% !important;   
    }
</style>

@endpush


@section('content')

<div class="row">
    <div class="col s12 m12 l12">
        <div id="html-validations" class="card card-tabs">
          <div class="card-content">
              <div class="card-title">
                <div class="row">
                <div class="col s12 m6 l10">
                      <h4 class="card-title">ADD ANNOUNCEMENT</h4>
                    </div>
                    <div class="col s12 m6 l2"></div>
                </div>
            </div>
            <div id="html-view-validations">
{!! SemanticForm::open()->post()->action(route('site::announcement.save'))->multipart() !!}
<input type="hidden" name="mode" id="mode" value="_add" >

    <div class="row">
        <div class="input-field col s12">
            <input id="name" name="name" type="text" required>
            <label for="name3">Title</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col m4 s12">
      <label for="announcement_date" id="announcement_label">Announcement Date <span class="req">*</span></label>
  <input type="text" class="datepicker" id="announcement_date" name="announcement_date" required>
        </div>
        <div class="input-field col m4 s12">
      <label for="start_date" id="start_label">Start publish Date <span class="req">*</span></label>
  <input type="text" class="datepicker" id="start_date" name="start_date" required>
        </div>
        <div class="input-field col m4 s12">
      <label for="end_date" id="end_label">End publish Date <span class="req">*</span></label>
  <input type="text" class="datepicker" id="end_date" name="end_date" required>
        </div>
    </div>
    <div class="row">
    <div class="input-field col s12">
        <p>Status <span class="req">*</span></p>
        <p>
          <label>
            <input class="validate" required name="status" value="1" type="radio" checked />
            <span>ACTIVE</span>
          </label>
          <lable>&nbsp;&nbsp;</lable>
        <label>
          <input class="validate" required name="status" value="0" type="radio" />
          <span>INACTIVE</span>
        </label>
        </p>
        <div class="input-field">
        </div>
    </div>
    </div>
    <div class="row">
    <div class="input-field col s12">
      <textarea id="content" name="content" class="materialize-textarea validate" ></textarea>
    </div>
  </div>

  <div class="row">
    <div class="col s12 file-field input-field">
      <div class="btn float-right">
        <span>Attachement (If Any)</span>
        <input type="file" name="lampiran[]">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
  </div>

    <div class="row">
        <div class="input-field col s12">
            <button class="btn mb-1 ml-1 cyan waves-effect waves-light right" type="submit" name="action">@lang('laravolt::action.save')
                <i class="material-icons right">send</i>
            </button>
            <button class="btn mb-1 waves-effect waves-light gradient-45deg-light-blue-cyan z-depth-4 right" type="button" name="back" id="back" onclick="window.location.href='/admin/announcement'; return false;">Back
              <i class="material-icons right">reply</i>
            </button>
        </div>
    </div>
    
  {!! SemanticForm::close() !!}
            </div>
        </div>
    </div>        
  </div>
</div>
    <!-- </div> -->
    <!-- <div class="content-overlay"></div> -->

@endsection

@push('script')
<script type="text/javascript">
  // $('#content').redactor({
  //     plugins : ['source','table','video','alignment','fontcolor','fontsize'],
  //     minHeight: '300px',
  //     maxHeight: '800px'
  // });

</script>
@endpush