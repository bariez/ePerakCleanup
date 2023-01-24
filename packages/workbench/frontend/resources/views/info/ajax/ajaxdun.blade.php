

	<select class="form-input mr-10 select-active" id="iddun">
		<option value="0" disabled="true" selected="true">Dun</option>
		@foreach($dun as $key => $value)
			<option value="{{ $value->id }}" >{{ $value->NamaDun }}</option>
		@endforeach

	</select>



<script type="text/javascript">
	$('select').select2();
</script>