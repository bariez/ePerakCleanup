@extends('laravolt::tnb.layouts.base')

@push('style')
<style>
.dataTables_info{
    display: none !important;
}
</style>

@endpush
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
				                <a  class="waves-effect waves-light modal-trigger btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1 right" href="/admin/announcement/add"> Add New Announcement</a>
				              </div>
                            <h4 class="card-title">Announcements</h4>
                            
                            <hr>
                            <br>
                            <div class="row">
                                <div class="col s12">
                                    <table id="page-length-option" class="display">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Announcement Date</th> 
                                                <th>Start publish Date</th> 
                                                <th>End publish Date</th> 
                                                <th>Action</th>                                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($data_announcement as $key =>$data)
                                                <tr>
                                                    <td>{{$data->title}}</td>
                                                    <td>{{date('m/d/Y', strtotime($data->post_date))}}</td>
                                                    <td>{{date('m/d/Y', strtotime($data->start_date))}}</td>
                                                    <td>{{date('m/d/Y', strtotime($data->end_date))}}</td>
                                                    <td>
                                                        <a href="/admin/announcement/edit/{{$data->id}}" class="invoice-action-edit mod-edit">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="dataTables_wrapper no-footer">
                                        <div class="dataTables_paginate paging_simple_numbers" id="page-length-option_paginate">
                                            {!! str_replace('/?', '?', 
                                                $data_announcement->render()) 
                                            !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

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

</script>

@endpush