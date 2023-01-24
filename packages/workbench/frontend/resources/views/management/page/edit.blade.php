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
				Page
			</h3>
		</div>
		<div class="column right aligned middle aligned">
			<a class="ui button" href="{!! URL::to('site/page/index') !!}">
				Kembali
			</a>
		</div>
	</div>

	<br/>

	<h4 class="ui top attached header">
		Kemaskini Page
	</h4>

	<div class="ui attached segment">

		{!! form()->open()->post()->action(route('site::frontendmanage.postPageSaveEdit'))->attribute('id', 'formeditpage')->multipart()->horizontal() !!}
		 <!-- Form::open()->url('/site/page/saveedit/'.data_get($data, 'id'))->method('POST')->class('ui form horizontal')->multipart(); !!} -->
		<input type="hidden" name="page_id" id="page_id" value="{{ data_get($data, 'id') }}" >

			<div class="field" id="selfkmenu">
				<label>Menu<span style="color: red">&nbsp;*</span></label>
				<div class="ui fluid search selection dropdown">
					<input type="hidden" name="fkmenu" id="idfkmenu" required="required" value="{{ data_get($data, 'fk_menum') }}">
					<i class="dropdown icon"></i>
					<div class="default text">Sila Pilih</div>
					<div class="menu">
							<div class="item" 
								 data-value="{{ data_get($menumedit, 'id') }}" 
								 data-text="{{ data_get($menumedit, 'nama') }}">
								 {{ data_get($menumedit, 'nama') }}
							</div>
						@foreach($menum as $key => $value)
							<div class="item" 
								 data-value="{{ data_get($value, 'id') }}" 
								 data-text="{{ data_get($value, 'nama') }}">
								 {{ data_get($value, 'nama') }}
							</div>
						@endforeach
					</div>
				</div>
			</div>

			<div class="field" id="seltitle">
				<label>Tajuk<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="title" id="idtitle" 
					   placeholder="Tajuk" value="{{ data_get($data, 'nama') }}"
					   onkeyup = "this.value = this.value.toUpperCase();">
			</div>

			<div class="field" id="selpagecontent">
				<label>Isi Kandungan<span style="color: red">&nbsp;*</span></label>
				<textarea type="textarea"
						  name="pagecontent"
						  id="idpagecontent">{{ data_get($data, 'content') }}</textarea>
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
				@if(data_get($data, 'path')=='')
					<a target="_blank" href="{{ asset('logo.png') }}"><img src="{{ asset('logo.png') }}" alt="{{ data_get($data, 'alt') }}" style="width: 100px"></a>
				@else
					<a target="_blank" href="{!! URL::to(data_get($data, 'path')) !!}"><img src="{!! URL::to(data_get($data, 'path')) !!}" alt="{{ data_get($data, 'alt') }}" style="width: 500px"></a>
				@endif
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

<script>
	$(document).ready(function ()
	{
		// ck editor -----------------------
		// Replace the <textarea id="editor1"> with a CKEditor 4
		// instance, using default configuration.
		CKEDITOR.replace( 'pagecontent' );
	});
</script>

<script type="text/javascript">

	$(document).ready(function() 
	{
		$("input[id=idimage]").change(function() 
		{
			filename = this.files[0].name;

			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

			if (!allowedExtensions.exec(filename)) 
			{
				alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')

				var icon = "error";
				$("input[id=idimage]").val("");
				return false;
			}
			
			const fileSize = this.files[0].size / 1024 / 1024; // in MiB
			if (fileSize > 3) 
			{
				alert('Saiz fail melebihi 3 MB')

				var icon = "error";
				// alertSwal(text,icon);
				// alert('File size exceeds 10 MiB');
				$("input[id=idimage]").val("");

				return false;
			}
		});
	});

</script>

<script type="text/javascript">

	$(document).ready(function() 
	{
		$('#selfkmenu').change(function()
		{
			var val_fkmenu 		= document.getElementById("idfkmenu").value;
			var val_title 		= document.getElementById("idtitle").value;
			var val_pagecontent = CKEDITOR.instances['idpagecontent'].getData();
			var val_status 		= document.getElementById("idstatus").value;
			var val_image 		= document.getElementById("idimage").value;

			disrequired(val_fkmenu, val_title, val_pagecontent, val_status, val_image);
		});

		$('#seltitle').keyup(function()
		{
			var val_fkmenu 		= document.getElementById("idfkmenu").value;
			var val_title 		= document.getElementById("idtitle").value;
			var val_pagecontent = CKEDITOR.instances['idpagecontent'].getData();
			var val_status 		= document.getElementById("idstatus").value;
			var val_image 		= document.getElementById("idimage").value;

			disrequired(val_fkmenu, val_title, val_pagecontent, val_status, val_image);
		});

		CKEDITOR.instances['idpagecontent'].on('change', function()
		{
			var val_fkmenu 		= document.getElementById("idfkmenu").value;
			var val_title 		= document.getElementById("idtitle").value;
			var val_pagecontent = CKEDITOR.instances['idpagecontent'].getData();
			var val_status 		= document.getElementById("idstatus").value;
			var val_image 		= document.getElementById("idimage").value;

			disrequired(val_fkmenu, val_title, val_pagecontent, val_status, val_image);
		});

		$('#selstatus').change(function()
		{
			var val_fkmenu 		= document.getElementById("idfkmenu").value;
			var val_title 		= document.getElementById("idtitle").value;
			var val_pagecontent = CKEDITOR.instances['idpagecontent'].getData();
			var val_status 		= document.getElementById("idstatus").value;
			var val_image 		= document.getElementById("idimage").value;

			disrequired(val_fkmenu, val_title, val_pagecontent, val_status, val_image);
		});

		$('#selimage').change(function()
		{
			var val_fkmenu 		= document.getElementById("idfkmenu").value;
			var val_title 		= document.getElementById("idtitle").value;
			var val_pagecontent = CKEDITOR.instances['idpagecontent'].getData();
			var val_status 		= document.getElementById("idstatus").value;
			var val_image 		= document.getElementById("idimage").value;

			disrequired(val_fkmenu, val_title, val_pagecontent, val_status, val_image);
		});

		var val_fkmenu 		= document.getElementById("idfkmenu").value;
		var val_title 		= document.getElementById("idtitle").value;
		var val_pagecontent = CKEDITOR.instances['idpagecontent'].getData();
		var val_status 		= document.getElementById("idstatus").value;
		var val_image 		= document.getElementById("idimage").value;

		disrequired(val_fkmenu, val_title, val_pagecontent, val_status, val_image);

	});

	function disrequired(f_fkmenu, f_title, f_pagecontent, f_status, f_image)
	{
		if( f_fkmenu	 != "" &&
			f_title		 != "" &&
			f_pagecontent!= "" &&
			f_status	 != "" )
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