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
                      <h4 class="card-title">EDIT ANNOUNCEMENT</h4>
                    </div>
                    <div class="col s12 m6 l2"></div>
                </div>
            </div>
            <div id="html-view-validations">
{!! SemanticForm::open()->post()->action(route('site::announcement.save'))->multipart() !!}
<input type="hidden" name="mode" id="mode" value="_edit" >
<input type="hidden" name="id" id="id" value="{{$data->id}}" >

    <div class="row">
        <div class="input-field col s12">
            <input id="name" name="name" type="text" value="{{$data->title}}" required>
            <label for="name3">Title</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col m4 s12">
      <label for="announcement_date" id="announcement_label">Announcement Date <span class="req">*</span></label>
  <input type="text" class="datepicker" id="announcement_date" name="announcement_date" value="{{date('d/m/Y', strtotime($data->post_date))}}" required>
        </div>
        <div class="input-field col m4 s12">
      <label for="start_date" id="start_label">Start publish Date <span class="req">*</span></label>
  <input type="text" class="datepicker" id="start_date" name="start_date" value="{{date('d/m/Y', strtotime($data->start_date))}}" required>
        </div>
        <div class="input-field col m4 s12">
      <label for="end_date" id="end_label">End publish Date <span class="req">*</span></label>
  <input type="text" class="datepicker" id="end_date" name="end_date" value="{{date('d/m/Y', strtotime($data->end_date))}}" required>
        </div>
    </div>
    <div class="row">
    <div class="input-field col s12">
        <p>Status <span class="req">*</span></p>
        <p>
          <label>
            <input class="validate" required name="status" value="1" type="radio"  @if ($data->status == '1') checked @else @endif />
            <span>ACTIVE</span>
          </label>
          <lable>&nbsp;&nbsp;</lable>
        <label>
          <input class="validate" required name="status" value="0" type="radio" @if ($data->status == '0') checked @else @endif/>
          <span>INACTIVE</span>
        </label>
        </p>
        <div class="input-field">
        </div>
    </div>
    </div>
    <div class="row">
    <div class="input-field col s12">
      <textarea id="content" name="content" class="materialize-textarea validate" >{{$data->content}}</textarea>
      <!-- <label for="content_label">Plant Address</label> -->
    </div>
  </div>
<div class="col s12 file-field input-field">
      <div class="btn float-right">
        <span>File</span>
        <input type="file" name="lampiran[]">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="field" id="lampiran">
</div>
    <!-- <button type="button" class="mb-3 btn waves-effect waves-light green darken-1" id="add_lampiran()_1" onclick="addlampiran()" >Tambah lampiran</button> -->

  @foreach($lampiran as $key=>$files)
      @if($files->file_name) 
        <div  class="col s12">
          <a href="{{$files->full_path}}{{$files->file_name}}" target="_blank">{{$files->file_name}}</a><div class="mb-1 ml-1 btn-small waves-effect waves-light red darken-1 right" onclick="deleteAttachment('{{$files->id}}')" data-lid="{{$files->id}}">Padam</div><a href="{{$files->full_path}}{{$files->file_name}}" class="mb-1 btn-small waves-effect waves-light green darken-1 right" target="_blank">Download</a>
        </div>
        @endif
@endforeach

    <div class="row">
        <div class="input-field col s12">
          <br><br><br>
            <button class="btn mb-1 ml-1 cyan waves-effect waves-light right" type="submit" name="action">@lang('laravolt::action.save')
                <i class="material-icons left">send</i>
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


    $( document ).ready(function() {
        // console.log("{{$data->post_date}}");
        $( "input.datepicker#announcement_date").datepicker( "setDate", convertDatePicker("{{$data->announcement_date}}"));
        $( "input.datepicker#start_date").datepicker( "setDate", convertDatePicker("{{$data->start_date}}"));
        $( "input.datepicker#end_date").datepicker( "setDate", convertDatePicker("{{$data->end_date}}"));
    });

    function convertDatePicker(date){
        var date_arr = date.split("-");
        return date_arr[1]+"/"+date_arr[2]+"/"+date_arr[0];
    }
    function deleteAttachment(id){
    var result = confirm("Are u sure?");
        console.log(result);

        if(result){
            jQuery.ajax({
          type : "get",
          url : "/project/delete/"+id,
          async: false,
          success:function(data){
            if(data["result"]){
              swal({
                  title: 'Success delete attachement',
                  icon: 'success'
              })
              location.reload(true);
            }else{
              swal({
                  title: 'Failed delete attachement',
                  icon: 'error'
              })
            }
          },
          error: function(msg) {
          }
        });
        }

    
  }
    
</script>

@endpush

