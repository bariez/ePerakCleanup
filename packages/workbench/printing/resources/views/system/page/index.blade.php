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
				                <a  class="waves-effect waves-light modal-trigger btn gradient-45deg-light-blue-cyan box-shadow-none border-round mr-1 mb-1 right" href="#" onclick="addModal();return false;"> Add New Page</a>
				              </div>
                            <h4 class="card-title">Pages</h4>
                            
                            <hr>
                            <br>
                            <div class="row">
                                <div class="col s12">
                                    <table id="page-length-option" class="display">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Menu Assigned</th> 
                                                <th>Action</th>                                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $key =>$data)
								            	<tr>
								            		<td>{{$data->name}}</td>
								            		<td>{{data_get($data, 'menu.name','Not Assigned')}}</td>
								            		<td>
								            			<a href="/admin/page/edit/{{$data->id}}" class="invoice-action-edit mod-edit">
									                		<i class="material-icons">edit</i>
									              		</a>
								              		</td>
								            	</tr>
								            @endforeach
                                        </tbody>
                                    </table>
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
				              <h4 class="card-title" id="">Add New Page</h4>
				              {!! SemanticForm::open()->post()->action(route('site::page.add')) !!}
				              <input type="hidden" name="parent_id" id="parent_id" value="" >

				                  <div class="row">
				                      <div class="input-field col s12">
				                          <input id="name" name="name" type="text" required>
				                          <label for="name3">Page Name</label>
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

function addModal(){

   $('#modal2').modal('open');
  
}

</script>

@endpush