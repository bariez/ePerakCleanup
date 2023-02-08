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
				Banner
			</h3>
		</div>
		<div class="column right aligned middle aligned">
			<a class="ui button" href="{!! URL::to('site/banner/index') !!}" id="backbutton">
				<b>Kembali</b>
			</a>
		</div>
	</div>

	<br/>

	<h4 class="ui top attached header">
		Tambah banner
	</h4>

	<div class="ui attached segment">

		{!! form()->open()->post()->action(route('site::frontendmanage.postBannerSaveAdd'))->attribute('id', 'formaddbanner')->multipart()->horizontal() !!}
		 <!-- Form::open()->url('/site/banner/save')->method('POST')->class('ui form horizontal')->multipart(); !!} -->

			<div class="field" id="seltitle">
				<label>Tajuk<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="title" id="idtitle" 
					   placeholder="Tajuk" 
					   onkeyup = "this.value = this.value.toUpperCase();">
			</div>

			<div class="field" id="seldesc">
				<label>Keterangan<span style="color: red">&nbsp;*</span></label>
				<textarea type="textarea"
						  rows="3" 
						  name="desc" 
						  placeholder="Keterangan" 
						  id="iddesc"
						  onkeyup = "this.value = this.value.toUpperCase();"></textarea>
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
								value="{{ date('Y-m-d') }}" 
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
								value="{{ date('Y-m-d') }}" 
								readonly>
					</div>
				</div>
			</div>

			<div class="field" id="selstatus">
				<label>Status<span style="color: red">&nbsp;*</span></label>
				<div class="ui fluid search selection dropdown">
					<input type="hidden" name="status" id="idstatus">
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
				<label>Banner<span style="color: red">&nbsp;*</span></label>
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

<script type="text/javascript">

	$(document).ready(function() 
	{  
		// document.getElementById("submit").disabled = true;

		$('#seltitle').keyup(function()
		{
			var val_title	= document.getElementById("idtitle").value;
			var val_desc	= document.getElementById("iddesc").value;
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idimage").value;

			disrequired(val_title, val_desc, val_status, val_logo);
		});

		$('#seldesc').keyup(function()
		{
			var val_title	= document.getElementById("idtitle").value;
			var val_desc	= document.getElementById("iddesc").value;
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idimage").value;

			disrequired(val_title, val_desc, val_status, val_logo);
		});

		$('#selstatus').change(function()
		{
			var val_title	= document.getElementById("idtitle").value;
			var val_desc	= document.getElementById("iddesc").value;
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idimage").value;

			disrequired(val_title, val_desc, val_status, val_logo);
		});

		$('#selimage').change(function()
		{
			var val_title	= document.getElementById("idtitle").value;
			var val_desc	= document.getElementById("iddesc").value;
			var val_status	= document.getElementById("idstatus").value;
			var val_logo	= document.getElementById("idimage").value;

			disrequired(val_title, val_desc, val_status, val_logo);
		});
	});

	function disrequired(f_title, f_desc, f_status, f_logo)
	{
		if( f_title		!= "" &&
			f_desc		!= "" &&
			f_status	!= "" &&
			f_logo		!= ""  )
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