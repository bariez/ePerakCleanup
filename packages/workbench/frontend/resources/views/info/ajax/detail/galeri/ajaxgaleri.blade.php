
<style type="text/css">
	.swiper-slide 
	{ 
		height: auto; 
	}
</style>

	<div class="container">
		<!-- <a href="/galeri/ data_get($request, 'idkampung') }}/listaktiviti" class="btn btn-default btn-find mb-25" style="float: right">Senarai Aktiviti</a> -->
		<div class="row mt-10">

			@foreach($data as $key => $value)
				<div class="col-lg-3 col-md-6 col-sm-12 col-12 mt-20">
					<div class="card-grid-2 hover-up h-100" >
						<div class="text-center card-grid-2-image">
							<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#galeriModal" data-idgaleri="{{ data_get($value, 'id') }}" onclick="forwardgaleriid(this)">
								<figure class="" style="background-color: white;">
									<!-- if( file_exists( public_path( data_get($value, 'Gambar_path') ) ) ) -->
															
									@if( data_get($value, 'Gambar_path') )
										@if( file_exists( public_path( data_get($value, 'Gambar_path') ) ) )
											<img src="{!! URL::to(data_get($value, 'Gambar_path')) !!}" 
												 alt="{{ data_get($value, 'Tajuk') }}" 
												 title="{{ data_get($value, 'Tajuk') }}" >
										@else
											<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" 
												 alt="{{ data_get($value, 'Tajuk') }}" 
												 title="{{ data_get($value, 'Tajuk') }}" 
												 class="p-30"
												 style="width: 200px">
										@endif
									@else
										<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" 
											 alt="{{ data_get($value, 'Tajuk') }}" 
											 title="{{ data_get($value, 'Tajuk') }}" 
											 class="p-30"
											 style="width: 200px">
									@endif

								</figure>
							</a>
						</div>
						<div class="card-block-info">
							<h6 class="mt-5 heading-md text-center" style="min-height: 70px;">
								<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#galeriModal" data-idgaleri="{{ data_get($value, 'id') }}" onclick="forwardgaleriid(this)">{{ data_get($value, 'Tajuk') }}</a>
							</h6>
							<div class="card-2-bottom mt-50">
								<div class="row">
									<div class="col-lg-12 col-12 text-center">
										<a href="javascript:;" onclick="forwardgaleriid(this)" class="btn btn-default hover-up mb-25" style="color: white"
										   data-bs-toggle="modal" data-bs-target="#galeriModal" data-idgaleri="{{ data_get($value, 'id') }}">Lihat Keseluruhan</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endforeach

		</div>
	</div>

<!-- Modal Start -->
<div class="modal fade" id="galeriModal" tabindex="-1" aria-labelledby="galeriModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-fullscreen"> <!-- modal-lg -->
		<div class="modal-content" id="modalpapar-galeri">
			<!-- <div class="modal-header">
				<h5 class="modal-title" id="galeriModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>

		<div class="modal-content p-30" id="modalloadingpapar-galeri">
			<center>
				<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
			</center>
		</div>
	</div>
</div>

<div class="modal fade" id="modalimagegaleri" tabindex="-1" aria-labelledby="modalimagegaleriLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content" id="modalimage-galeri">
			<!-- <div class="modal-header">
				<h5 class="modal-title" id="galeriModalLabel">{{ data_get($data, 'Namagaleri') }}</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-content p-30" id="modalloadingpapar-galeri">
				<center>
					<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
				</center>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-target="#galeriModal" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
			</div> -->
		</div>

		<div class="modal-content p-30" id="modalimageloadingpapar-galeri">
			<center>
				<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
			</center>
		</div>
	</div>
</div>
<!-- Modal End -->

<script type="text/javascript">

	// --------- function
	function forwardgaleriid(data)
	{
		var idgaleri = $(data).data('idgaleri');
		
		// alert(idgaleri);

		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/detail/galeri/modal/')}}"+"/"+idgaleri,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#modalpapar-galeri').html('');
				$('#modalpapar-galeri').hide();
				$('#modalloadingpapar-galeri').show();
			},
			success: function(data)
			{
				$('#modalpapar-galeri').html(data);
				$('#modalloadingpapar-galeri').hide();
				$('#modalpapar-galeri').show();
			}
		});
	}

	function gambargaleriid(data)
	{
		var idgambargaleri = $(data).data('idgambargaleri');
		
		// alert(idgambargaleri);

		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/detail/galeri/modalimage/')}}"+"/"+idgambargaleri,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#modalimage-galeri').html('');
				$('#modalimage-galeri').hide();
				$('#modalimageloadingpapar-galeri').show();
			},
			success: function(data)
			{
				$('#modalimage-galeri').html(data);
				$('#modalimageloadingpapar-galeri').hide();
				$('#modalimage-galeri').show();
			}
		});
	}

</script>
