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
				Hubungi Kami
			</h3>
		</div>
		<div class="column right aligned middle aligned">
			<a class="ui button" href="{!! URL::to('site/hubungi/index') !!}" id="backbutton">
				<b>Kembali</b>
			</a>
		</div>
	</div>

	<br/>

	<h4 class="ui top attached header">
		Kemaskini Hubungi Kami
	</h4>

	<div class="ui attached segment">

		{!! form()->open()->post()->action(route('site::frontendmanage.postHubungiSaveEdit'))->attribute('id', 'formeditcontactus')->multipart()->horizontal() !!}
		 <!-- Form::open()->url('/site/hubungi/saveedit/'.data_get($data, 'id'))->method('POST')->class('ui form horizontal')->multipart(); !!} -->
		<input type="hidden" name="hubungi_id" id="hubungi_id" value="{{ data_get($data, 'id') }}" >

			<div class="field" id="selnama">
				<label>Nama<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="nama" id="idnama" 
					   placeholder="Nama" 
					   value="{{ data_get($data, 'nama') }}">
			</div>

			<div class="field" id="seladdress">
				<label>Alamat<span style="color: red">&nbsp;*</span></label>
				<textarea type="textarea"
						  rows="3" 
						  name="address" 
						  placeholder="Keterangan" 
						  id="idaddress" >{{ data_get($data, 'alamat') }}</textarea>
			</div>

			<div class="field" id="selphone">
				<label>No Telefon<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="phone" id="idphone"  minlength="10" maxlength="12"
					   placeholder="No Telefon" 
					   value="{{ data_get($data, 'no_tel') }}"
					   onkeypress="onlynumber(event)">
			</div>

			<div class="field" id="selfaks">
				<label>No Faksimili<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="faks" id="idfaks"  minlength="10" maxlength="12"
					   placeholder="No Faks" 
					   value="{{ data_get($data, 'no_faks') }}"
					   onkeypress="onlynumber(event)">
			</div>

			<div class="field" id="selemel">
				<label>Emel<span style="color: red">&nbsp;*</span></label>
				<input type="email" name="emel" id="idemel" 
					   placeholder="Emel" 
					   value="{{ data_get($data, 'email') }}">
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

			<!-- <div class="field" id="selstatus">
				<label>Peta</label>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.5982826947693!2d101.07120711523103!3d4.665491543259772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31ca936188a5de05%3A0xe8ee21bd65c10ee7!2sPerakGIS!5e0!3m2!1sen!2smy!4v1663662757322!5m2!1sen!2smy" width="100%" height="450" style="border: 2;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div> -->

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

		$('#selnama').keyup(function()
		{
			var val_nama	= document.getElementById("idnama").value;
			var val_address	= document.getElementById("idaddress").value;
			var val_phone	= document.getElementById("idphone").value;
			var val_faks	= document.getElementById("idfaks").value;
			var val_emel	= document.getElementById("idemel").value;
			var val_status	= document.getElementById("idstatus").value;

			disrequired(val_nama, val_address, val_phone, val_faks, val_emel, val_status);
		});

		$('#seladdress').keyup(function()
		{
			var val_nama	= document.getElementById("idnama").value;
			var val_address	= document.getElementById("idaddress").value;
			var val_phone	= document.getElementById("idphone").value;
			var val_faks	= document.getElementById("idfaks").value;
			var val_emel	= document.getElementById("idemel").value;
			var val_status	= document.getElementById("idstatus").value;

			disrequired(val_nama, val_address, val_phone, val_faks, val_emel, val_status);
		});

		$('#selphone').keyup(function()
		{
			var val_nama	= document.getElementById("idnama").value;
			var val_address	= document.getElementById("idaddress").value;
			var val_phone	= document.getElementById("idphone").value;
			var val_faks	= document.getElementById("idfaks").value;
			var val_emel	= document.getElementById("idemel").value;
			var val_status	= document.getElementById("idstatus").value;

			disrequired(val_nama, val_address, val_phone, val_faks, val_emel, val_status);
		});

		$('#selfaks').keyup(function()
		{
			var val_nama	= document.getElementById("idnama").value;
			var val_address	= document.getElementById("idaddress").value;
			var val_phone	= document.getElementById("idphone").value;
			var val_faks	= document.getElementById("idfaks").value;
			var val_emel	= document.getElementById("idemel").value;
			var val_status	= document.getElementById("idstatus").value;

			disrequired(val_nama, val_address, val_phone, val_faks, val_emel, val_status);
		});

		$('#selemel').keyup(function()
		{
			var val_nama	= document.getElementById("idnama").value;
			var val_address	= document.getElementById("idaddress").value;
			var val_phone	= document.getElementById("idphone").value;
			var val_faks	= document.getElementById("idfaks").value;
			var val_emel	= document.getElementById("idemel").value;
			var val_status	= document.getElementById("idstatus").value;

			disrequired(val_nama, val_address, val_phone, val_faks, val_emel, val_status);
		});

		$('#selstatus').change(function()
		{
			var val_nama	= document.getElementById("idnama").value;
			var val_address	= document.getElementById("idaddress").value;
			var val_phone	= document.getElementById("idphone").value;
			var val_faks	= document.getElementById("idfaks").value;
			var val_emel	= document.getElementById("idemel").value;
			var val_status	= document.getElementById("idstatus").value;

			disrequired(val_nama, val_address, val_phone, val_faks, val_emel, val_status);
		});

		var val_nama	= document.getElementById("idnama").value;
		var val_address	= document.getElementById("idaddress").value;
		var val_phone	= document.getElementById("idphone").value;
		var val_faks	= document.getElementById("idfaks").value;
		var val_emel	= document.getElementById("idemel").value;
		var val_status	= document.getElementById("idstatus").value;

		disrequired(val_nama, val_address, val_phone, val_faks, val_emel, val_status);

	});

	function disrequired(f_nama, f_address, f_phone, f_faks, f_emel, f_status)
	{
		if( f_nama	  != "" &&
			f_address != "" &&
			f_phone	  != "" &&
			f_faks	  != "" &&
			f_emel	  != "" &&
			f_status  != ""  )
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
function onlynumber(evt) 
{
    var theEvent = evt || window.event;

    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);

    var regex = /[0-9]|\-/;

    if( !regex.test(key) ) 
    {
        theEvent.returnValue = false;

        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
</script>
@endpush