@extends('laravolt::layout.app2')

@section('content')

<!-- <style type="text/css">
	input[type=file]::-webkit-file-upload-button
	{
		visibility: hidden;
	}
	.file
	{
		position: relative;
		height: 30px;
		width: 100px;
	}
	.file > input[type="file"]
	{
		position: absoulte;
		opacity: 0;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
	}
	.file > label
	{
		position: absolute;
		top: 0;
		right: 0;
		left: 0;
		bottom: 0;
		background-color: #666;
		color: #fff;
		line-height: 30px;
		text-align: center;
		cursor: pointer;
	}
</style> -->

<!-- <style>
	img
	{
		border: 1px solid #ddd;
		border-radius: 4px;
		padding: 5px;
		width: 150px;
	}
	img:hover
	{
		box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
	}
</style> -->

	<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0" >
		<div class="column middle aligned">
			<h3 class="ui header m-t-xs">
				Logo
			</h3>
		</div>
		<div class="column right aligned middle aligned">
			<a class="ui button green" href="{!! URL::to('site/logo/addlogo') !!}" id="addbutton">
				<i class="icon plus"></i><span>Tambah</span>
			</a>
		</div>
	</div>

	<br/>

	<h4 class="ui top attached header">
		Senarai Logo
	</h4>

	<div class="ui attached segment">
		<table id="listlogo" class="ui celled table" style="width:100%">
			<thead>
				<tr>
					<th style="text-align: center;">Bil</th>
					<th style="text-align: center;">Logo</th>
					<th style="text-align: center;">Info</th>
					<th style="text-align: center;">Jenis</th>
					<!-- <th style="text-align: center;">URL</th> -->
					<th style="text-align: center;">Status</th>
					<th style="text-align: center;">Tindakan</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; ?>
				@forelse($logo as $key =>$data)
					<tr  style="text-align: center;">
						<td>{{ $i }}</td>
						<td><img src="{!! URL::to(data_get($data,'path')) !!}" alt="{{ data_get($data,'alt') }}" style="width:100px"></td>
						<td>{{ data_get($data,'alt') }}</td>
						<td>
							@if($data->type == '1')
								Logo
							@elseif($data->type == '2')
								Jata
							@else
								-
							@endif
						</td>
						<!-- <td>{{ data_get($data,'path') }}</td> -->
						<td>
							@if($data->status == '1')
								Aktif
							@elseif($data->status == '0')
								Tidak Aktif
							@else
								-
							@endif
						</td>
						<td>
							<a href="{!! URL::to('/site/logo/editlogo/'.data_get($data,'id')) !!}" data-tooltip="Kemaskini">
								<i class="edit icon"></i>
							</a>
                            <a href="{!! URL::to('/site/logo/deletelogo/'.data_get($data,'id')) !!}" data-tooltip="Padam">
                                <i class="trash icon" style="color:red"></i>
							</a>
						</td>
					</tr>
					<?php $i++; ?>
				@empty
					<tr>
						<td colspan='7' class="center aligned">Tiada Data</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>

@endsection
@push('script')

<script type="text/javascript">

	$(document).ready(function()
	{
		$('#listlogo').DataTable(
		{
			"lengthChange" : false,
			"language" :
			{
				"search" 	: "Carian:",
				"info"		: "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
				"infoEmpty" : "Paparan 0 hingga 0 daripada 0 jumlah data",
				"paginate"  :
				{
					"first" 	: "Pertama",
					"last" 		: "Terakhir",
					"next" 		: "Seterusnya",
					"previous" 	: "Sebelumnya"
				},
			}
		});
	});

</script>

@endpush
