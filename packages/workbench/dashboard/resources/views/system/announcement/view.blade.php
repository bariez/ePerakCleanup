@extends('laravolt::tnb.layouts.base')

@section('content')

<div class="col s12">
    <div class="container">
        <div class="section section-data-tables">
            
            <!-- Page Length Options -->
            <div class="row">

                <div class="col s12">
                    <div class="card">
                        <div class="card-content">
							<div class="col s12">
				                <a  class="waves-effect waves-light modal-trigger btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1 right" href="/admin/announcement/viewall"> View All Announcements</a>
				            </div>
                             <div class="row">
                                <div class="col s12">
                                    <span style="color: #00bcd4!important;">Date : {{date('d-m-Y', strtotime($data->post_date))}}</span>
                                    <h4>{{$data->title}}</h4>
                                    {!! $data->content !!}
                                    <br><br><br>
                                    @foreach($lampiran as $key=>$files)
                                      @if($files->file_name) 

                                        <div  class="col s12">
                                          <a href="{{$files->full_path}}{{$files->file_name}}" target="_blank"><i class="material-icons">cloud_download</i> {{$files->file_name}}</a>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div id="modal2" class="modal">
		      	<div class="modal-content">
			        	<div class="col s12">
			          	<div id="basic-form" >
		            	</div>
		          	</div>
		        </div>
	      	</div>
       
        </div><!-- START RIGHT SIDEBAR NAV -->
        
    <!-- </div> -->
    <div class="content-overlay"></div>
</div>
</div>
@endsection


@push('script')

<script type="text/javascript">

    function convertDatePicker(date){
        var date_arr = date.split("-");
        return date_arr[1]+"/"+date_arr[2]+"/"+date_arr[0];
    }
    
</script>

@endpush