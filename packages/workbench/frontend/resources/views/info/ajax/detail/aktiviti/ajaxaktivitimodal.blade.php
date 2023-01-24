	
	<div class="modal-header">
		<h5 class="modal-title" id="aktivitiModalLabel">{{ data_get($data, 'NamaAktiviti') }}</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<center>
			<figure class="" style="background-color: white;">
				@if( data_get($data, 'Gambar_path') )
					@if( file_exists( public_path( data_get($data, 'Gambar_path') ) ) )
						<button style="border: 0px white" 
								data-bs-target="#modalimageaktiviti" 
								data-bs-toggle="modal" 
								data-bs-dismiss="modal" 
								data-idgambar="{{ data_get($data, 'id') }}" 
								onclick="gambarid(this)">
							<img class="" alt="{{ data_get($data, 'NamaAktiviti') }}" src="{{ data_get($data, 'Gambar_path') }}" />
						</button>
					@else
						<img style="max-height: 250px" class="p-30" alt="{{ data_get($data, 'NamaAktiviti') }}" src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" />
					@endif
				@else
					<img style="max-height: 250px" class="p-30" alt="{{ data_get($data, 'NamaAktiviti') }}" src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" />
				@endif
			</figure>
		</center>
		<br><br>
		<div class="form-group">
			<label for="jenisaktiviti">Jenis Aktiviti</label>
			<input type="text" readonly class="form-control-plaintext" id="jenisaktiviti" value="{{ data_get($data, 'kategori.description') }}">
		</div>
		<div class="form-group">
			<label for="tahun">Tahun</label>
			<input type="text" readonly class="form-control-plaintext" id="tahun" value="{{ data_get($data, 'Tahun') }}">
		</div>
		<div class="form-group">
			<label for="penganjur">Penganjur</label>
			<input type="text" readonly class="form-control-plaintext" id="penganjur" value="{{ data_get($data, 'Penganjur') }}">
		</div>
		<div class="form-group">
			<label for="keterangan">Keterangan</label>
			<textarea class="form-group" readonly id="keterangan" rows="3">{{ data_get($data, 'Keterangan') }}</textarea>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
	</div>
