<div class="content-area" style="width: 100%;margin:unset">
<div class="app-wrapper">

        <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
            <div class="card-content p-5">
	            <div class="card-title">
	            	<div class="row">
		                <div class="ml-1" tabindex="0"><i class="material-icons"> wrap_text </i> Search Result
		                	<button class="btn mb-1 waves-effect waves-light mr-1 btn-small" type="submit" onclick="calltable(0)" style="float:right"><i class="material-icons left">backspace</i> Back</button></div>
		                
            <div class="list-content"></div>

	                 </div>
	            </div>
	            <table id="data-table-contact" class="display" style="width:90%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>System</th>
                  <th>Modules</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Monitoring</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                 <?php $i=1; ?>
                @if(!empty(count($listapi)))

                @forelse($listapi as $key =>$data)
               
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$data->system_name}}</td>
                    <td>{{$data->modules_name}}</td>
                    <td>{{$data->api_name}}</td>
                    @if($data->api_status==1)
                    <td>Active</td>
                    @elseif($data->api_status==2)
                    <td>Inactive</td>
                     @elseif($data->api_status==3)
                    <td>Maintenance</td>
                    @else
                    <td></td>
                    @endif
                    
                  <td><a href="/developer/dashboard/dataapi/{{$typelist}}/{{$data->api_id}}/1">
                    <i class="material-icons">edit</i>
                  </a></td>
                  <td><a href="/developer/dashboard/dataapi/{{$typelist}}/{{$data->api_id}}/1">
                    <i class="material-icons">edit</i>
                  </a></td>
                   
                  </tr>
                  <?php $i++;?>
                @endforeach
                 @else
                  <tr>
                    <td colspan="6" class="text-center"> No Data </td>
                  </tr>
                  @endif
              </tbody>
            </table>
	        </div>
        </div>  


</div>
</div>

