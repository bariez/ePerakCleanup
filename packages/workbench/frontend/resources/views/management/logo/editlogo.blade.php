@extends('laravolt::layout.app2')

@section('content')

<style type="text/css">
	input[type=file]::-webkit-file-upload-button 
	{
		visibility: hidden;
	}
	/*.file 
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
				Logo
			</h3>
		</div>
		<div class="column right aligned middle aligned">
			<a class="ui button" href="{!! URL::to('site/logo/index') !!}"  id="backbutton">
				Kembali
			</a>
		</div>
	</div>

	<br/>

	<h4 class="ui top attached header">
		Kemaskini Logo
	</h4>

	<div class="ui attached segment">

		{!! form()->open()->post()->action(route('site::frontendmanage.postLogoSaveEdit'))->attribute('id', 'formeditlogo')->multipart()->horizontal() !!}
		 <!-- Form::open()->url('/site/logo/saveeditlogo/'.data_get($data, 'id'))->method('POST')->class('ui form horizontal')->multipart(); !!} -->
		<input type="hidden" name="logo_id" id="logo_id" value="{{ data_get($data, 'id') }}" >

			<div class="field" id="selinfo">
				<label>Informasi<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="info" id="idinfo" 
					   value="{{ data_get($data, 'alt') }}" 
					   onkeyup = "this.value = this.value.toUpperCase();">
			</div>

			<div class="field" id="seltype">
				<label>Jenis<span style="color: red">&nbsp;*</span></label>
				<div class="ui fluid search selection dropdown">
					<input type="hidden" name="type" id="idtype" required="required" value="{{ data_get($data, 'type') }}">
					<i class="dropdown icon"></i>
					<div class="default text">Sila Pilih</div>
					<div class="menu">
						<div class="item" data-value="">Sila Pilih</div>
						<div class="item" data-value="1">Logo</div>
						<div class="item" data-value="2">Jata</div>
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

			<div class="field" id="sellogo">
				<label>Logo<span style="color: red">&nbsp;*</span></label>
				<button type="button" style="display:block; width: 20px; height:40px;" onclick="document.getElementById('idlogo').click()">Pilih Fail</button>
				<input type="file" name="logo" id="idlogo" 
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
				<a target="_blank"><img style="width:200px" id="blah"></a>
			</div>

			<div class="field">
				<label>&nbsp;</label>
				@if(data_get($data, 'path')=='')
					<a target="_blank" href="{{ asset('logo.png') }}"><img src="{{ asset('logo.png') }}" alt="{{ data_get($data, 'alt') }}" style="width:100px"></a>
				@else
					<a target="_blank" href="{!! URL::to(data_get($data, 'path')) !!}"><img src="{!! URL::to(data_get($data, 'path')) !!}" alt="{{ data_get($data, 'alt') }}" style="width:200px"></a>
				@endif
			</div>

			<div class="ui divider section"></div>

			<div class="ui buttons right floated">
				<button class="ui positive button" id="addbutton" type="submit" style="display: none; border-radius: 4px 4px 4px 4px">Simpan</button>
				<a onclick="alert('Sila Isi Ruangan Bertanda *')" 
				   class="ui positive button" 
				   id="gonebutton" 
				   style="border-radius: 4px 4px 4px 4px;background-color: #432712;color: white">Simpan</a>
			</div>

			<br/><br/><br/>

		{!! Form::close() !!}

	</div>

@endsection
@push('script')

<script type="text/javascript">

	$(document).ready(function() 
	{  
		// document.getElementById("submit").disabled = true;

		$('#selinfo').keyup(function()
		{
			var val_info	= document.getElementById("idinfo").value;
			var val_type	= document.getElementById("idtype").value;
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idlogo").value;

			disrequired(val_info, val_type, val_status, val_logo);
		});

		$('#seltype').change(function()
		{
			var val_info	= document.getElementById("idinfo").value;
			var val_type	= document.getElementById("idtype").value;
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idlogo").value;

			disrequired(val_info, val_type, val_status, val_logo);
		});

		$('#selstatus').change(function()
		{
			var val_info	= document.getElementById("idinfo").value;
			var val_type	= document.getElementById("idtype").value;
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idlogo").value;

			disrequired(val_info, val_type, val_status, val_logo);;
		});

		$('#sellogo').change(function()
		{
			var val_info	= document.getElementById("idinfo").value;
			var val_type	= document.getElementById("idtype").value;
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idlogo").value;

			disrequired(val_info, val_type, val_status, val_logo);;
		});

		var val_info	= document.getElementById("idinfo").value;
		var val_type	= document.getElementById("idtype").value;
		var val_status	= document.getElementById("idstatus").value;
		var val_logo	= document.getElementById("idlogo").value;

		disrequired(val_info, val_type, val_status, val_logo);
	});


	function disrequired(f_info, f_type, f_status, f_logo)
	{
		if( f_info		!= "" &&
			f_type		!= "" &&
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
				// document.getElementById("gonebutton").style.display = "none";
			}

	}

</script>

<script type="text/javascript">

	$(document).ready(function() 
	{
		$("#divpreview").hide();

		$("input[id=idlogo]").change(function()
		{
			filename = this.files[0].name;
			
			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

			if (!allowedExtensions.exec(filename)) 
			{
				alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')

				var icon = "error";
				$("#divpreview").hide();
				$("input[id=idlogo]").val("");

				return false;
			}

			const fileSize = this.files[0].size / 1024 / 1024; // in MiB

			if (fileSize > 3) 
			{
				alert('Saiz fail melebihi 3 MB')

				var icon = "error";

				$("#divpreview").hide();
				$("input[id=idlogo]").val("");

				return false;
			}
		});

		idlogo.onchange = evt => 
		{
			$("#divpreview").show();
			const [file] = idlogo.files

			if (file) 
			{
				blah.src = URL.createObjectURL(file)
			}
		}
	});
	
</script>

@endpush