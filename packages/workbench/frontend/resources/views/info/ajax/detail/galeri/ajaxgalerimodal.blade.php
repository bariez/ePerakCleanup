	
<style type="text/css">
	#modalgaleri
	{ 
		height: auto; 
	}
</style>

	<div class="modal-header">
		@foreach($data->take(1) as $key => $value)
			<h5 class="modal-title" id="aktivitiModalLabel">{{ data_get($value, 'galerimast.Tajuk') }}</h5>
		@endforeach
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>
	<div class="modal-body">
		<!-- <center> -->
			<div class="container">
				<div class="row">
					<div id="lightgallery">
						@foreach($data->where('kategori', 145) as $key => $value)
							@if( data_get($value, 'Gambar_path') )
								@if( file_exists( public_path( data_get($value, 'gambar_path') ) ) )
									<a href="{{ data_get($value, 'gambar_path') }}" data-bs-dismiss="modal">
										<img class="" src="{{ data_get($value, 'gambar_path') }}" style="max-width: 30%" />
									</a>
								@else
									<a href="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" data-bs-dismiss="modal">
										<img class="p-30" src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" style="max-width: 30%" />
									</a>
								@endif
							@else
								<a href="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" data-bs-dismiss="modal">
									<img class="p-30" src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" style="max-width: 30%" />
								</a>
							@endif
						@endforeach
					</div>

					@foreach($data->where('kategori', 146) as $key => $value)
						<div class="col-lg-6 col-md-6 col-sm-12" id="modalgaleri" style="padding: 2px 2px 2px 2px;">
							<div class="card-grid-2 hover-up h-100" style="min-height: 450px" >
								<iframe width="100%" height="100%" src="{{ data_get($value, 'url') }}" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		<!-- </center> -->
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
	</div>


<script type="text/javascript">

	$(document).ready(function() 
	{
		lightGallery(document.getElementById('lightgallery'), 
		{
			plugins: [lgZoom, lgThumbnail],
			speed: 500,
			licenseKey: "0000-0000-000-0000",
		});
	});
</script>