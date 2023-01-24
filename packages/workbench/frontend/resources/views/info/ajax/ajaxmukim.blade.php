

	<select class="form-input mr-10 select-active" id="idmukim">
		<option value="0" disabled="true" selected="true">Mukim</option>

			@if( data_get($roleuser, 'role_id') == 3 ) 

				<option value="{{ $mukim->id }}" selected="true">{{ $mukim->NamaMukim }}</option>
				
			@else

				@foreach($mukim as $key => $value)
					<option value="{{ $value->id }}" >{{ $value->NamaMukim }}</option>
				@endforeach

			@endif

	</select>



<script type="text/javascript">
	$('select').select2();
</script>