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
				Ikon Kategori Produk
			</h3>
		</div>
		<div class="column right aligned middle aligned">
			<a class="ui button" href="{!! URL::to('site/katprod/index') !!}" id="backbutton">
				Kembali
			</a>
		</div>
	</div>

	<br/>

	<h4 class="ui top attached header">
		Kemaskini Ikon Kategori Produk
	</h4>

	<div class="ui attached segment">

		{!! form()->open()->post()->action(route('site::frontendmanage.postProductIconSaveEdit'))->attribute('id', 'formeditproducticon')->multipart()->horizontal() !!}
		 <!-- Form::open()->url('/site/katprod/saveedit/'.data_get($data, 'id'))->method('POST')->class('ui form horizontal')->multipart(); !!} -->
		<input type="hidden" name="katprod_id" id="katprod_id" value="{{ data_get($data, 'id') }}" >

			<div class="field" id="selkatprod">
				<label>Kategori Produk<span style="color: red">&nbsp;*</span></label>
				<div class="ui fluid search selection dropdown">
					<input type="hidden" name="katprod" id="idkatprod" required="required" value="{{ data_get($data, 'fk_lkp_detail') }}">
					<i class="dropdown icon"></i>
					<div class="default text">Sila Pilih</div>
					<div class="menu">
						@foreach($lkpKategoriProduk as $key => $value)
							<div class="item" 
								 data-value="{{ data_get($value, 'id') }}" 
								 data-text="{{ data_get($value, 'description') }}">
								 {{ data_get($value, 'description') }}
							</div>
						@endforeach
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

			<div class="field" id="selicon">
				<label>Ikon<span style="color: red">&nbsp;*</span></label>
				<button type="button" style="display:block; width: 20px; height:40px;" onclick="document.getElementById('idicon').click()">Pilih Fail</button>
				<input type="file" name="icon" id="idicon" 
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
				<a target="_blank"><img style="width: 200px" id="blah"></a>
			</div>

			<div class="field">
				<label>&nbsp;</label>
				@if(data_get($data, 'path')=='')
					<a target="_blank" href="{{ asset('logo.png') }}"><img src="{{ asset('logo.png') }}" alt="{{ data_get($data, 'alt') }}" style="width: 100px"></a>
				@else
					<a target="_blank" href="{!! URL::to(data_get($data, 'path')) !!}"><img src="{!! URL::to(data_get($data, 'path')) !!}" alt="{{ data_get($data, 'alt') }}" style="width: 200px"></a>
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

		$('#selkatprod').change(function()
		{
			var val_katprod	= document.getElementById("idkatprod").value;
			var val_status	= document.getElementById("idstatus").value;
			var val_icon	= document.getElementById("idicon").value;

			disrequired(val_katprod, val_status, val_icon);
		});

		$('#selstatus').change(function()
		{
			var val_katprod	= document.getElementById("idkatprod").value;
			var val_status	= document.getElementById("idstatus").value;
			var val_icon	= document.getElementById("idicon").value;

			disrequired(val_katprod, val_status, val_icon);
		});

		$('#selicon').change(function()
		{
			var val_katprod	= document.getElementById("idkatprod").value;
			var val_status	= document.getElementById("idstatus").value;
			var val_icon	= document.getElementById("idicon").value;

			disrequired(val_katprod, val_status, val_icon);
		});

		var val_katprod	= document.getElementById("idkatprod").value;
		var val_status	= document.getElementById("idstatus").value;
		var val_icon	= document.getElementById("idicon").value;

		disrequired(val_katprod, val_status, val_icon);
	});


	function disrequired(f_katprod, f_status, f_icon)
	{
		if( f_katprod	!= "" &&
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

		$("input[id=idicon]").change(function() 
		{
			filename = this.files[0].name;

			var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

			if (!allowedExtensions.exec(filename)) 
			{
				alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')

				var icon = "error";
				$("#divpreview").hide();
				$("input[id=idicon]").val("");
				
				return false;
			}
			
			const fileSize = this.files[0].size / 1024 / 1024; // in MiB

			if (fileSize > 3) 
			{
				alert('Saiz fail melebihi 3 MB')

				var icon = "error";

				$("#divpreview").hide();
				$("input[id=idicon]").val("");

				return false;
			}
		});

		idicon.onchange = evt => 
		{
			$("#divpreview").show();
			const [file] = idicon.files

			if (file) 
			{
				blah.src = URL.createObjectURL(file)
			}
		}
	});

</script>

@endpush