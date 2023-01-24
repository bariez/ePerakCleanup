

	<select class="form-input mr-10 select-active" id="idparlimen">
		<option value="0" disabled="true" selected="true">Parlimen</option>
		@foreach($parlimen as $key => $value)
			<option value="{{ $value->id }}" >{{ $value->NamaParlimen }}</option>
		@endforeach

	</select>



<script type="text/javascript">
	$('select').select2();
</script>