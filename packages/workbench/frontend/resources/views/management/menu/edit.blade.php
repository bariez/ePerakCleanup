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
				Menu Laman Utama
			</h3>
		</div>
		<div class="column right aligned middle aligned">
			<a class="ui button" href="{!! URL::to('site/menu/index') !!}">
				Kembali
			</a>
		</div>
	</div>

	<br/>

	<h4 class="ui top attached header">
		Kemaskini Menu Laman Utama
	</h4>

	<div class="ui attached segment">

		{!! form()->open()->post()->action(route('site::frontendmanage.postMenuSaveEdit'))->attribute('id', 'formeditmenu')->multipart()->horizontal() !!}
		 <!-- Form::open()->url('/site/menu/saveedit/'.data_get($data, 'id'))->method('POST')->class('ui form horizontal')->multipart(); !!} -->
		<input type="hidden" name="menu_id" id="menu_id" value="{{ data_get($data, 'id') }}" >

			<div class="field" id="selname">
				<label>Nama Menu<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="name" id="idname" value="{{ data_get($data, 'nama') }}"
					   placeholder="Nama menu" 
					   onkeyup = "this.value = this.value.toUpperCase();">
			</div>

			<!-- <div class="field" id="sellink">
				<label>Link<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="link" id="idlink" 
					   placeholder="Link" >
			</div> -->

			<div class="field" id="selqueue">
				<label>Susunan<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="queue" id="idqueue" value="{{ data_get($data, 'susunan') }}"
					   placeholder="Susunan" >
			</div>

			<div class="field" id="selstatus">
				<label>Status<span style="color: red">&nbsp;*</span></label>
				<div class="ui fluid search selection dropdown">
					<input type="hidden" name="status" id="idstatus" value="{{ data_get($data, 'status') }}">
					<i class="dropdown icon"></i>
					<div class="default text">Sila Pilih</div>
					<div class="menu">
						<div class="item" data-value="">Sila Pilih</div>
						<div class="item" data-value="1">Aktif</div>
						<div class="item" data-value="0">Tidak Aktif</div>
					</div>
				</div>
			</div>

			<div class="ui divider section"></div>

			<div class="ui buttons right floated">
				<button class="ui positive button" id="submit" type="submit" style="display: none; border-radius: 4px 4px 4px 4px">Simpan</button>
				<a onclick="alert('Sila Isi Ruangan Bertanda *')" 
				   class="ui positive button" 
				   id="gonebutton" 
				   style="border-radius: 4px 4px 4px 4px">Simpan</a>
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

		$('#selname').keyup(function()
		{
			document.getElementById("idname").style.textTransform = "capitalize";

			var val_name	= document.getElementById("idname").value;
			// var val_link	= document.getElementById("idlink").value;
			var val_queue	= document.getElementById("idqueue").value;
			var val_status	= document.getElementById("idstatus").value;

			disrequired(val_name, val_queue, val_status);
			// disrequired(val_name, val_link, val_queue, val_status);
		});

		// $('#sellink').keyup(function()
		// {
		// 	var val_name	= document.getElementById("idname").value;
		// 	var val_link	= document.getElementById("idlink").value;
		// 	var val_queue	= document.getElementById("idqueue").value;
		// 	var val_status	= document.getElementById("idstatus").value;

		// 	disrequired(val_name, val_queue, val_status);
		// 	// disrequired(val_name, val_link, val_queue, val_status);
		// });

		$('#selqueue').keyup(function()
		{
			var val_name	= document.getElementById("idname").value;
			// var val_link	= document.getElementById("idlink").value;
			var val_queue	= document.getElementById("idqueue").value;
			var val_status	= document.getElementById("idstatus").value;

			disrequired(val_name, val_queue, val_status);
			// disrequired(val_name, val_link, val_queue, val_status);
		});

		$('#selstatus').change(function()
		{
			var val_name	= document.getElementById("idname").value;
			// var val_link	= document.getElementById("idlink").value;
			var val_queue	= document.getElementById("idqueue").value;
			var val_status	= document.getElementById("idstatus").value;

			disrequired(val_name, val_queue, val_status);
			// disrequired(val_name, val_link, val_queue, val_status);
		});
		
		var val_name	= document.getElementById("idname").value;
		// var val_link	= document.getElementById("idlink").value;
		var val_queue	= document.getElementById("idqueue").value;
		var val_status	= document.getElementById("idstatus").value;

		disrequired(val_name, val_queue, val_status);
		// disrequired(val_name, val_link, val_queue, val_status);

	});

	// function disrequired(f_name, f_link, f_queue, f_status)
	function disrequired(f_name, f_queue, f_status)
	{
		if( f_name	!= "" &&
			// f_link	!= "" &&
			f_queue	!= "" &&
			f_status!= ""  )
			{
				document.getElementById("submit").disabled = false;
				document.getElementById("submit").style.display = "block";
				document.getElementById("gonebutton").style.display = "none";
			}
			else
			{
				document.getElementById("submit").disabled = true;
				document.getElementById("submit").style.display = "none";
				document.getElementById("gonebutton").style.display = "block";
				// document.getElementById("gonebutton").style.display = "none";
			}

	}

</script>

@endpush