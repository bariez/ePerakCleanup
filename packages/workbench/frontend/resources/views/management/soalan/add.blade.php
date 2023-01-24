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
				Soalan Lazim
			</h3>
		</div>
		<div class="column right aligned middle aligned">
			<a class="ui button" href="{!! URL::to('site/soalan/index') !!}" id="backbutton">
				Kembali
			</a>
		</div>
	</div>

	<br/>

	<h4 class="ui top attached header">
		Tambah Soalan Lazim
	</h4>

	<div class="ui attached segment">

		{!! form()->open()->post()->action(route('site::frontendmanage.postSoalanSaveAdd'))->attribute('id', 'formaddsoalan')->multipart()->horizontal() !!}
		 <!-- Form::open()->url('/site/soalan/save')->method('POST')->class('ui form horizontal')->multipart(); !!} -->

			<div class="field" id="selquestion">
				<label>Soalan<span style="color: red">&nbsp;*</span></label>
				<textarea type="textarea"
						  rows="3" 
						  name="question" 
						  placeholder="Soalan" 
						  id="idquestion" ></textarea>
			</div>

			<div class="field" id="selanswer">
				<label>Jawapan<span style="color: red">&nbsp;*</span></label>
				<textarea type="textarea"
						  rows="3" 
						  name="answer" 
						  placeholder="Jawapan" 
						  id="idanswer" ></textarea>
			</div>

			<div class="field" id="selqueue">
				<label>Susunan<span style="color: red">&nbsp;*</span></label>
				<input type="text" name="queue" id="idqueue" 
					   placeholder="Susunan" >
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

		$('#selquestion').keyup(function()
		{
			var val_question = document.getElementById("idquestion").value;
			var val_answer 	 = document.getElementById("idanswer").value;
			var val_queue 	 = document.getElementById("idqueue").value;
			var val_status   = document.getElementById("idstatus").value;

			disrequired(val_question, val_answer, val_queue, val_status);
		});

		$('#selanswer').keyup(function()
		{
			var val_question = document.getElementById("idquestion").value;
			var val_answer 	 = document.getElementById("idanswer").value;
			var val_queue 	 = document.getElementById("idqueue").value;
			var val_status   = document.getElementById("idstatus").value;

			disrequired(val_question, val_answer, val_queue, val_status);
		});

		$('#selqueue').keyup(function()
		{
			var val_question = document.getElementById("idquestion").value;
			var val_answer 	 = document.getElementById("idanswer").value;
			var val_queue 	 = document.getElementById("idqueue").value;
			var val_status   = document.getElementById("idstatus").value;

			disrequired(val_question, val_answer, val_queue, val_status);
		});

		$('#selstatus').change(function()
		{
			var val_question = document.getElementById("idquestion").value;
			var val_answer 	 = document.getElementById("idanswer").value;
			var val_queue 	 = document.getElementById("idqueue").value;
			var val_status   = document.getElementById("idstatus").value;

			disrequired(val_question, val_answer, val_queue, val_status);
		});

	});

	function disrequired(f_question, f_answer, f_queue, f_status)
	{
		if( f_question 	!= "" &&
			f_answer 	!= "" &&
			f_queue 	!= "" &&
			f_status 	!= "" )
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
@endpush