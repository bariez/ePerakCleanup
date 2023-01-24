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
                            <h4 class="card-title">Users Utilization</h4>
                            
                            <hr>
                            <br>
                            <div class="row">
                                <div class="col s12">
                                    <table id="page-length-option" class="display">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Month-Year</th> 
                                                <th>Total Users</th>
                                                <th>Action</th>                                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php $i = 1;?>
	                                            @foreach($data as $key =>$data_list)
									            	<tr>
									            		<td>{{$i}}</td>
									            		<td>{{date("F-Y", strtotime($data_list->date))}}</td>
									            		<td>{{$data_list->total_user}}</td>
									            		<td><a href="#" class="invoice-action-edit mod-edit" onclick="addModal('{{$data_list->date}}');return false;">
												                <i class="material-icons">visibility</i>
												            </a>
												        </td>
									            	</tr>
									            	<?php $i = $i + 1;?>
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
            <div id="modal2" class="modal" style="height:90vh">
		      	<div class="modal-content">
			        <div class="col s12">
	                    <div class="card">
	                        <div class="card-content">
	                            <h4 class="card-title">Detail</h4>
	                            
	                            <hr>
	                            <br>
	                            <div class="row">
	                                <div class="col s12">
                                        <h3 id="title"></h3>
	                                    <table id="page-length-option" class="display">
	                                        <thead>
	                                            <tr>
	                                                <th>No</th>
	                                                <th>Name</th> 
	                                                <th>Role</th>
                                                    <th>Date</th>
	                                            </tr>
	                                        </thead>
	                                        <tbody id="detail">

	                                        </tbody>
	                                    </table>
	                                </div>
	                            </div>
	                            <br>
	                            <br>
	                            <br>
                                <div class="row">
                                        <button class="btn mb-1 waves-effect waves-light gradient-45deg-light-blue-cyan z-depth-4 right" type="button" name="back" id="back" onclick="closeModal();return false;">Close
                                            <i class="material-icons right">close</i>
                                        </button>
                                    </div>
                                </div>
	                            <br>

	                        </div>
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

	function addModal(date){
		console.log(date);

		jQuery.ajax({
            type : "get",
            url : "/utilization/detail/"+convertShortDate(date),
            async: false,
            success:function(data){
                console.log(data.data);
                console.log(data.data.length);
                var detail = data.data;

                var html = "";
                var title = "";
                var j = 1;

                for(var i = 0; i < detail.length; i++){
                    title = convertDate(detail[i].date_login);
                    
                	html += "<tr>";
                	html += "<td>"+j;
                	html += "</td>";
                	html += "<td>"+detail[i].user_id;
                	html += "</td>";
                	html += "<td>"+detail[i].user_role;
                	html += "</td>";
                    html += "<td>"+convertDate(detail[i].date_login);
                    html += "</td>";
                	html += "</tr>";

                	j++;
                }

                console.log(html);

                $("#detail").html(html);

            },
            error: function(msg) {
            }
        });

	   $('#modal2').modal('open');
	  
	}

    function convertShortDate(date){
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        var formattedDate = new Date(date);
        var d = formattedDate.getDate();
        var m =  formattedDate.getMonth();
        var y = formattedDate.getFullYear();
        console.log(date);
        console.log(monthNames[m]+"-"+y);

        return monthNames[m]+"-"+y;
    }

    function convertDate(date){
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        var formattedDate = new Date(date);
        var d = formattedDate.getDate();
        var m =  formattedDate.getMonth();
        var y = formattedDate.getFullYear();

        return d+"-"+monthNames[m]+"-"+y;
    }

    function closeModal(){
        $('#modal2').modal('close');
    }

</script>

@endpush