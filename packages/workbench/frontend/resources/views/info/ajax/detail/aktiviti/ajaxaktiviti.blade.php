
<style type="text/css">
	.swiper-slide 
	{ 
		height: auto; 
	}
</style>


	@if( count($data) >= 3)
		<a href="/info/{{ data_get($request, 'idkampung') }}/listaktiviti" class="btn btn-default btn-find mb-25" style="float: right">Senarai Aktiviti</a>
		<br><br><br><br>
		<center>
			<div class="box-swiper" style="width: 75%; margin-top: -20px">
				<div class="swiper-container swiper-group-3">
					<div class="swiper-wrapper pb-70 pt-5">

						<!-- --------------------------------------------- -->
						@foreach($data as $key => $value)
							<div class="swiper-slide">
								<div class="card-grid-2 hover-up h-100">
									<div class="text-center card-grid-2-image">
										<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#aktivitiModal" data-idaktiviti="{{ data_get($value, 'id') }}" onclick="forwardid(this)">
											<figure class="" style="background-color: white;">
												@if( data_get($value, 'Gambar_path') )
													@if( file_exists( public_path( data_get($value, 'Gambar_path') ) ) )
														<img class="" alt="{{ data_get($value, 'NamaAktiviti') }}" src="{{ data_get($value, 'Gambar_path') }}" style="height: 230px" />
													@else
														<img class="p-30" alt="{{ data_get($value, 'NamaAktiviti') }}" src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" style="max-width: 200px" />
													@endif
												@else
													<img class="p-30" alt="{{ data_get($value, 'NamaAktiviti') }}" src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" style="max-width: 200px" />
												@endif
											</figure>
										</a>
									</div>
									<div class="card-block-info">
										<h6 class="mt-5 heading-md" style="min-height: 70px;">
											<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#aktivitiModal" data-idaktiviti="{{ data_get($value, 'id') }}" onclick="forwardid(this)">{{ data_get($value, 'NamaAktiviti') }}</a>
										</h6>
										<div class="card-2-bottom mt-50">
											<div class="row">
												<div class="col-lg-12 col-12 text-center">
													<a href="javascript:;" onclick="forwardid(this)" class="btn btn-default hover-up mb-25" style="color: white"
													   data-bs-toggle="modal" data-bs-target="#aktivitiModal" data-idaktiviti="{{ data_get($value, 'id') }}" >Teruskan Membaca</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endforeach
						<!-- --------------------------------------------- -->

					</div>
				</div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</center>
	@else
		<!-- --------------------------------------------- -->
			<div class="container">
				<a href="/info/{{ data_get($request, 'idkampung') }}/listaktiviti" class="btn btn-default btn-find mb-25" style="float: right">Senarai Aktiviti</a>
				<div class="row mt-10">

					@foreach($data as $key => $value)
						<div class="col-lg-3 col-md-6 col-sm-12 col-12">
							<div class="card-grid-2 hover-up h-100" >
								<div class="text-center card-grid-2-image">
									<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#aktivitiModal" data-idaktiviti="{{ data_get($value, 'id') }}" onclick="forwardid(this)">
										<figure class="" style="background-color: white;">
											@if( data_get($value, 'Gambar_path') )
												@if( file_exists( public_path( data_get($value, 'Gambar_path') ) ) )
													<img class="" alt="{{ data_get($value, 'NamaAktiviti') }}" src="{{ data_get($value, 'Gambar_path') }}" style="height: 230px" />
												@else
													<img class="p-30" alt="{{ data_get($value, 'NamaAktiviti') }}" src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" style="max-width: 200px" />
												@endif
											@else
												<img class="p-30" alt="{{ data_get($value, 'NamaAktiviti') }}" src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" style="max-width: 200px" />
											@endif
										</figure>
									</a>
								</div>
								<div class="card-block-info">
									<h6 class="mt-5 heading-md text-center" style="min-height: 70px;">
										<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#aktivitiModal" data-idaktiviti="{{ data_get($value, 'id') }}" onclick="forwardid(this)">{{ data_get($value, 'NamaAktiviti') }}</a>
									</h6>
									<div class="card-2-bottom mt-50">
										<div class="row">
											<div class="col-lg-12 col-12 text-center">
												<a href="javascript:;" onclick="forwardid(this)" class="btn btn-default hover-up mb-25" style="color: white"
												   data-bs-toggle="modal" data-bs-target="#aktivitiModal" data-idaktiviti="{{ data_get($value, 'id') }}">Teruskan Membaca</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach

				</div>
			</div>
		<!-- --------------------------------------------- -->
	@endif

<!-- Modal Start -->
<div class="modal fade" id="aktivitiModal" tabindex="-1" aria-labelledby="aktivitiModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable"> <!-- modal-lg -->
		<div class="modal-content" id="modalpapar">
			<!-- <div class="modal-header">
				<h5 class="modal-title" id="aktivitiModalLabel">Modal title</h5>
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

		<div class="modal-content p-30" id="modalloadingpapar">
			<center>
				<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
			</center>
		</div>
	</div>
</div>

<div class="modal fade" id="modalimageaktiviti" tabindex="-1" aria-labelledby="modalimageaktivitiLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content" id="modalimage">
			<!-- <div class="modal-header">
				<h5 class="modal-title" id="aktivitiModalLabel">{{ data_get($data, 'NamaAktiviti') }}</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-content p-30" id="modalloadingpapar">
				<center>
					<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
				</center>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-target="#aktivitiModal" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
			</div> -->
		</div>

		<div class="modal-content p-30" id="modalimageloadingpapar">
			<center>
				<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
			</center>
		</div>
	</div>
</div>
<!-- Modal End -->

<script type="text/javascript">

	// --------- function
	function forwardid(data)
	{
		var idaktiviti = $(data).data('idaktiviti');
		
		// alert(idaktiviti);

		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/detail/aktiviti/modal/')}}"+"/"+idaktiviti,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#modalpapar').html('');
				$('#modalpapar').hide();
				$('#modalloadingpapar').show();
			},
			success: function(data)
			{
				$('#modalpapar').html(data);
				$('#modalloadingpapar').hide();
				$('#modalpapar').show();
			}
		});
	}

	function gambarid(data)
	{
		var idgambar = $(data).data('idgambar');
		
		// alert(idgambar);

		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/detail/aktiviti/modalimage/')}}"+"/"+idgambar,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#modalimage').html('');
				$('#modalimage').hide();
				$('#modalimageloadingpapar').show();
			},
			success: function(data)
			{
				$('#modalimage').html(data);
				$('#modalimageloadingpapar').hide();
				$('#modalimage').show();
			}
		});
	}

</script>
