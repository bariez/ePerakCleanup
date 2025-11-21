

	<!--select class="form-input mr-10 select-active" id="idkampung">
		<option value="0" disabled="true" selected="true">Nama Kampung</option>
		@foreach($kampung as $key => $value)
			<option value="{{ $value->id }}" >{{ $value->NamaKampung }}</option>
		@endforeach

	</select>-->

<select class="form-input mr-10 select-active" id="idkampung">
	<option value="0" disabled selected>Nama Kampung</option>
	@foreach($kampung as $key => $value)
		<option value="{{ $value->id }}">{{ $value->NamaKampung }}</option>
	@endforeach
</select>

<script type="text/javascript">
	$('select').select2();
</script>