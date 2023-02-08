@extends('laravolt::layout.app2')

@section('content')

<style type="text/css">
	input[type=file]::-webkit-file-upload-button 
	{
		visibility: hidden;
	}
/*	.file 
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
	}*/
</style>

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
				Notis
			</h3>
		</div>
		<div class="column right aligned middle aligned">
			<a class="ui button" href="{!! URL::to('site/notis/index') !!}" id="backbutton">
				<b>Kembali</b>
			</a>
		</div>
	</div>

	<br/>

	<h4 class="ui top attached header">
		Kemaskini Notis
	</h4>

	<div class="ui attached segment">

		{!! form()->open()->post()->action(route('site::frontendmanage.postNotisSaveEdit'))->attribute('id', 'formeditbanner')->multipart()->horizontal() !!}
		 <!-- Form::open()->url('/site/notis/saveedit/'.data_get($data, 'id'))->method('POST')->class('ui form horizontal')->multipart(); !!} -->
		<input type="hidden" name="notis_id" id="notis_id" value="{{ data_get($data, 'id') }}" >

			<div class="field" id="seltitle">
				<label>Tajuk<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="title" id="idtitle" placeholder="Tajuk" 
					   value="{{ data_get($data, 'tajuk') }}"
					   onkeyup = "this.value = this.value.toUpperCase();">
			</div>

			<div class="field" id="selsummary">
				<label>Ringkasan<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="summary" id="idsummary" placeholder="Ringkasan" 
					   value="{{ data_get($data, 'ringkasan') }}"
					   onkeyup = "this.value = this.value.toUpperCase();">
			</div>

			<div class="field" id="seldesc">
				<label>Keterangan<span style="color: red">&nbsp;*</span></label>
				<textarea type="textarea"
						  name="desc"
						  id="iddesc">{{ data_get($data, 'keterangan') }}</textarea>
			</div>

			<div class="field" id="selnotisdate">
				<label>Tarikh Notis<span style="color: red">&nbsp;*</span></label>
				<div class="ui calendar">
					<div class="ui input right icon">
						<i class="calendar icon"></i>
						<input type="text" 
								name="notis_date" 
								id="idnotisdate" 
								placeholder="Tarikh Notis" 
								value="{{ date('d-M-Y', strtotime(data_get($data, 'tarikh_notis'))) }}" 
								readonly>
					</div>
				</div>
			</div>

			<div class="field" id="selstartdate">
				<label>Tarikh Mula<span style="color: red">&nbsp;*</span></label>
				<div class="ui calendar">
					<div class="ui input right icon">
						<i class="calendar icon"></i>
						<input type="text" 
								name="start_date" 
								id="idstartdate" 
								placeholder="Tarikh Mula" 
								value="{{ date('d-M-Y', strtotime(data_get($data, 'tarikh_mula'))) }}" 
								readonly>
					</div>
				</div>
			</div>

			<div class="field" id="selenddate">
				<label>Tarikh Akhir<span style="color: red">&nbsp;*</span></label>
				<div class="ui calendar">
					<div class="ui input right icon">
						<i class="calendar icon"></i>
						<input type="text" 
								name="end_date" 
								id="idenddate" 
								placeholder="Tarikh Akhir" 
								value="{{ date('d-M-Y', strtotime(data_get($data, 'tarikh_akhir'))) }}" 
								readonly>
					</div>
				</div>
			</div>

			<div class="field" id="selstatus">
				<label>Status<span style="color: red">&nbsp;*</span></label>
				<div class="ui fluid search selection dropdown">
					<input type="hidden" name="status" id="idstatus" required="required" value="{{ data_get($data, 'status') }}">
					<i class="dropdown icon"></i>
					<div class="default text">Sila Pilih</div>
					<div class="menu">
						<div class="item" data-value="">Sila Pilih</div>
						<div class="item" data-value="1">Aktif</div>
						<div class="item" data-value="0">Tidak Aktif</div>
					</div>
				</div>
			</div>

			<div class="field" id="selimage">
				<label>Gambar<span style="color: red">&nbsp;*</span></label>
				<button type="button" style="display:block; width: 20px; height:40px;" onclick="document.getElementById('idimage').click()">Pilih Fail</button>
				<input type="file" name="image" id="idimage" 
					   accept="image/gif, image/jpeg, image/jpg, image/png"
					   style="width: 700px;height: 40px;" 
					   onchange="this.setCustomValidity('')" 
					   oninvalid="this.setCustomValidity('Medan ini Wajib') ">
			</div>

			<div class="field">
				<label>&nbsp;</label>
				<b><font color="red">*&nbsp;</font>Saiz lampiran terhad kepada 3 MB.Hanya jenis fail .jpg .jpeg .png dibenarkan</b>
			</div>

			<div class="field" id="divpreview">
				<label>Preview</label>
				<a target="_blank"><img style="width:500px" id="blah"></a>
			</div>

			<div class="field">
				<label>&nbsp;</label>
				@if(data_get($data, 'path')=='')
					<a target="_blank" href="{{ asset('logo.png') }}"><img src="{{ asset('logo.png') }}" alt="{{ data_get($data, 'alt') }}" style="width: 100px"></a>
				@else
					<a target="_blank" href="{!! URL::to(data_get($data, 'path')) !!}"><img src="{!! URL::to(data_get($data, 'path')) !!}" alt="{{ data_get($data, 'alt') }}" style="width: 500px"></a>
				@endif
			</div>

			<div class="ui divider section"></div>

			<div class="ui buttons right floated">
				<button class="ui positive button" id="addbutton" type="submit" style="display: none; border-radius: 4px 4px 4px 4px"><b>Simpan</b></button>
				<a onclick="alert('Sila Isi Ruangan Bertanda *')" 
				   class="ui positive button" 
				   id="gonebutton" 
				   style="border-radius: 4px 4px 4px 4px;background-color: #432712;color: white"><b>Simpan</b></a>
			</div>

			<br/><br/><br/>

		{!! Form::close() !!}

	</div>

@endsection
@push('script')

<script>
	$(document).ready(function ()
	{
		// ck editor -----------------------
		// Replace the <textarea id="editor1"> with a CKEditor 4
		// instance, using default configuration.
		CKEDITOR.replace( 'desc' );
	});
</script>

<script type="text/javascript">

	$(document).ready(function() 
	{
		$('#seltitle').keyup(function()
		{
			var val_title	= document.getElementById("idtitle").value;
			var val_summary = document.getElementById("idsummary").value;
			var val_desc	= CKEDITOR.instances['iddesc'].getData();
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idimage").value;

			disrequired(val_title, val_summary, val_desc, val_status, val_logo);
		});

		$('#selsummary').keyup(function()
		{
			var val_title	= document.getElementById("idtitle").value;
			var val_summary = document.getElementById("idsummary").value;
			var val_desc	= CKEDITOR.instances['iddesc'].getData();
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idimage").value;

			disrequired(val_title, val_summary, val_desc, val_status, val_logo);
		});

		CKEDITOR.instances['iddesc'].on('change', function()
		{
			var val_title	= document.getElementById("idtitle").value;
			var val_summary = document.getElementById("idsummary").value;
			var val_desc	= CKEDITOR.instances['iddesc'].getData();
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idimage").value;

			disrequired(val_title, val_summary, val_desc, val_status, val_logo);
		});

		$('#sellokasi').change(function()
		{
			var val_title	= document.getElementById("idtitle").value;
			var val_summary = document.getElementById("idsummary").value;
			var val_desc	= CKEDITOR.instances['iddesc'].getData();
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idimage").value;

			disrequired(val_title, val_summary, val_desc, val_status, val_logo);
		});

		$('#selstatus').change(function()
		{
			var val_title	= document.getElementById("idtitle").value;
			var val_summary = document.getElementById("idsummary").value;
			var val_desc	= CKEDITOR.instances['iddesc'].getData();
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idimage").value;

			disrequired(val_title, val_summary, val_desc, val_status, val_logo);
		});

		$('#selimage').change(function()
		{
			var val_title	= document.getElementById("idtitle").value;
			var val_summary = document.getElementById("idsummary").value;
			var val_desc	= CKEDITOR.instances['iddesc'].getData();
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idimage").value;

			disrequired(val_title, val_summary, val_desc, val_status, val_logo);
		});

		var val_title	= document.getElementById("idtitle").value;
		var val_summary = document.getElementById("idsummary").value;
		var val_desc	= CKEDITOR.instances['iddesc'].getData();
		var val_status	= document.getElementById("idstatus").value;
		var val_logo	= document.getElementById("idimage").value;

		disrequired(val_title, val_summary, val_desc, val_status, val_logo);

	});

	function disrequired(f_title, f_summary, f_desc, f_status, f_logo)
	{
		if( f_title		!= "" &&
			f_summary	!= "" &&
			f_desc		!= "" &&
			f_status	!= "" )
			{
				document.getElementById("addbutton").disabled = false;
				document.getElementById("addbutton").style.display = "block";
				document.getElementById("gonebutton").style.display = "none";
			}
			else
			{
				document.getElementById("addbutton").disabled = true;
				document.getElementById("addbutton").style.display = "none";
				document.getElementById("gonebutton").style.display = "block";
			}
	}

</script>

<script type="text/javascript">

	$(document).ready(function() 
	{
		$("#divpreview").hide();

		$("input[id=idimage]").change(function() 
		{
			filename = this.files[0].name;

			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

			if (!allowedExtensions.exec(filename)) 
			{
				alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')

				var icon = "error";
				$("#divpreview").hide();
				$("input[id=idimage]").val("");

				return false;
			}
			
			const fileSize = this.files[0].size / 1024 / 1024; // in MiB

			if (fileSize > 3) 
			{
				alert('Saiz fail melebihi 3 MB')

				var icon = "error";

				$("#divpreview").hide();
				$("input[id=idimage]").val("");

				return false;
			}
		});

		idimage.onchange = evt => 
		{
			$("#divpreview").show();
			const [file] = idimage.files

			if (file) 
			{
				blah.src = URL.createObjectURL(file)
			}
		}
	});

</script>

<script type="text/javascript">
	$(document).ready(function()
	{
		$('#selnotisdate').calendar({
			type: 'date',
			formatter: 
			{
				date: function (date, settings) 
				{
					if (!date) return '';
					var day = date.getDate();
					var month = date.getMonth() + 1;
					var year = date.getFullYear();

					return  day + '-' + month + '-' + year;
				}
			}
		});
		$('#selstartdate').calendar({
			type: 'date',
			formatter: 
			{
				date: function (date, settings) 
				{
					if (!date) return '';
					var day = date.getDate();
					var month = date.getMonth() + 1;
					var year = date.getFullYear();

					return  day + '-' + month + '-' + year;
				}
			}
		});

		$('#selenddate').calendar({
			type: 'date',
			formatter: 
			{
				date: function (date, settings) 
				{
					if (!date) return '';
					var day = date.getDate();
					var month = date.getMonth() + 1;
					var year = date.getFullYear();

					return  day + '-' + month + '-' + year;
				}
			}
		});
	});
</script>

@endpush