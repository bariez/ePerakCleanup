
<!-- 	<div class="modal-header">
		<h5 class="modal-title" id="aktivitiModalLabel">{{ data_get($data, 'NamaAktiviti') }}</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div> -->
	<div class="modal-body p-30">
		<center>
			<img class="" alt="{{ data_get($data, 'NamaAktiviti') }}" src="{{ data_get($data, 'Gambar_path') }}" />
		</center>
	</div>
	<div class="modal-footer">
		<button class="btn btn-secondary" data-bs-target="#aktivitiModal" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
	</div>