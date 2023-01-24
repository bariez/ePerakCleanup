@extends('laravolt::eperak.layouts.base')

@section('content')

<!-- start-------------------------------------------------------------------------------------------------------- -->

@push('style')
<style type="text/css">
	.zoomButton
	{
		text-align: right;
		/*vertical-align: text-top;*/
	}
</style>
@endpush

<!-- start -------------------------------------------------------------------------------------------------------- -->

	<!-- banner start -->
		<section class="section-box" style="padding-top: 0px">
			<div class="box-head-single" style="background-color: #f2f2f2 !important; padding-top: 0px; padding-bottom: 0px"> <!-- #9777fa -->
				<div class="container" style="min-width: 100%">
					<div class="row">
						<div class="col-md-12" style="text-align: center; padding-bottom: 25px">
							<b><h4 style="padding-top: 25px">
								INFORMASI PETEMPATAN<br/>
							</h4></b>
							<h6 style="">
								&nbsp;
							</h6>
							
							<!-- <br><br> -->
							<!-- <a href="#" class="btn btn-secondary btn-shadow ml-10 hover-up">Lihat Terperinci</a> -->

						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- banner end   -->

	<!-- map start -->
		<!-- <section class="section-box mt-30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">

						<div class="sidebar-shadow" style="">
							<div class="sidebar-heading">
								<div class="avatar-sidebar">
									<figure>
										<img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/search_map.png') }}" />
									</figure>
									<div class="sidebar-info">
										<span class="sidebar-company">&nbsp;&nbsp;&nbsp;Peta Perak Darul Ridzuan</span>
										<span class="sidebar-website-text">&nbsp;</span>
									</div>
								</div>
							</div>
							<div class="sidebar-list-job" style="" id="malaysia-map-markers">
								<div class="map" >Insert Map Here</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section> -->
	<!-- map end   -->

	<!-- carian start -->
	    <section class="section-box">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="sidebar-shadow">
							<div class="sidebar-heading">
								<div class="avatar-sidebar">
									<figure>
										<img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/search_village_3.png') }}" title="Carian Kampung" />
									</figure>
									<div class="sidebar-info">
										<span class="sidebar-company" style="padding-top: 16px;">&nbsp;CARIAN KAMPUNG</span>
										<!-- <span class="sidebar-website-text">&nbsp;</span> -->
									</div>
								</div>
							</div>

							<div class="sidebar-list-job">
								<div class="section-box wow animate__animated animate__fadeIn mt-10">
									<div class="container">
										<div class="row" id="searchpapar">
											<!-- <form> -->

												<div class="col-lg-6 col-md-12 col-sm-12 col-12">
													<div class="banner-hero hero-1">
														<div class="banner-inner">
															<div class="row">
																<div class="col-lg-12">
																	<div class="block-banner">
																		<div class="form-find wow animate__animated animate__fadeInUp" data-wow-delay=".2s" id="seldaerah">
																			<select class="form-input mr-10 select-active" id="iddaerah">
																				<option value="0" disabled="true" selected="true">Daerah</option>

																					@if( data_get($roleuser, 'role_id') == 2 ) 

																						<option value="{{ $daerah->id }}" selected="true">{{ $daerah->NamaDaerah }}</option>

																					
																					@elseif( data_get($roleuser, 'role_id') == 3 ) 

																						<option value="{{ $daerah->id }}" selected="true">{{ $daerah->NamaDaerah }}</option>
																						
																					@else

																						@foreach($daerah as $key => $value)
																							<option value="{{ $value->id }}">{{ $value->NamaDaerah }}</option>
																						@endforeach

																					@endif

																			</select>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-6 col-md-12 col-sm-12 col-12">
													<div class="banner-hero hero-1">
														<div class="banner-inner">
															<div class="row">
																<div class="col-lg-12">
																	<div class="block-banner">
																		<div class="form-find wow animate__animated animate__fadeInUp" data-wow-delay=".2s" id="selmukim">
																			<select class="form-input mr-10 select-active" id="idmukim">
																				<option value="0" disabled="true" selected="true">Mukim</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-6 col-md-12 col-sm-12 col-12">
													<div class="banner-hero hero-1">
														<div class="banner-inner">
															<div class="row">
																<div class="col-lg-12">
																	<div class="block-banner">
																		<div class="form-find wow animate__animated animate__fadeInUp" data-wow-delay=".2s" id="selparlimen">
																			<select class="form-input mr-10 select-active" id="idparlimen">
																				<option value="0" disabled="true" selected="true">Parlimen</option>
																					@foreach($parlimen as $key => $value)
																						<option value="{{ $value->id }}" >{{ $value->NamaParlimen }}</option>
																					@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-6 col-md-12 col-sm-12 col-12">
													<div class="banner-hero hero-1">
														<div class="banner-inner">
															<div class="row">
																<div class="col-lg-12">
																	<div class="block-banner">
																		<div class="form-find wow animate__animated animate__fadeInUp" data-wow-delay=".2s" id="seldun">
																			<select class="form-input mr-10 select-active" id="iddun">
																				<option value="0" disabled="true" selected="true">Dun</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-6 col-md-12 col-sm-12 col-12">
													<div class="banner-hero hero-1">
														<div class="banner-inner">
															<div class="row">
																<div class="col-lg-12">
																	<div class="block-banner">
																		<div class="form-find wow animate__animated animate__fadeInUp" data-wow-delay=".2s" id="selcat">
																			<select class="form-input mr-10 select-active" id="idcat">
																				<option value="0" disabled="true" selected="true">Kategori Petempatan</option>
																					@foreach($catpenempatan as $key => $value)
																						<option value="{{ $value->id }}">{{ $value->description }}</option>
																					@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-6 col-md-12 col-sm-12 col-12">
													<div class="banner-hero hero-1">
														<div class="banner-inner">
															<div class="row">
																<div class="col-lg-12">
																	<div class="block-banner">
																		<div class="form-find wow animate__animated animate__fadeInUp" data-wow-delay=".2s" id="selkampung">
																			<select class="form-input mr-10 select-active" id="idkampung">
																				<option value="0" disabled="true" selected="true">Nama Kampung</option>
																					@foreach($kampung as $key => $value)
																						<option value="{{ $value->id }}">{{ $value->NamaKampung }}</option>
																					@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-12 col-md-12 col-sm-12 col-12">
													<div class="banner-hero hero-1">
														<div class="banner-inner">
															<div class="row">
																<div class="col-lg-12">
																	<div class="block-banner">
																		<div class="form-find wow animate__animated animate__fadeInUp" data-wow-delay=".2s" id="selcat">

																			<div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
																				<button onclick="location.href = '/info';" class="btn btn-light btn-shadow hover-up mt-15" style="color: #432712">
																					Set Semula
																				</button>
																				<button id="clicksubmit" class="btn btn-default btn-shadow hover-up mt-15" style=" background-color: #432712">
																					&nbsp;&nbsp;Cari&nbsp;&nbsp;
																				</button>
																			</div>

																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

											<!-- </form> -->

										</div>
										<div class="row mt-30" id="loadingpapar" style="display: none">
											<center>
												<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
											</center>

										</div>
									</div>
								</div>
							</div>

							<div class="sidebar-list-job">

								<div class="section-box wow animate__animated animate__fadeIn mt-10">
									<div class="container">
										<div class="row">
											<div class="col-lg-12">
												<div class="block-banner" id="result2">

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- carian end   -->

		<!-- <div id="preloader-active">
			<div class="preloader d-flex align-items-center justify-content-center">
				<div class="preloader-inner position-relative">
					<div class="text-center">
						<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="jobhub" />
					</div>
				</div>
			</div>
		</div> -->

<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')

<script type="text/javascript">

	$(document).ready(function () 
	{
		$mymap = $("#malaysia-map-markers");
		$mymap.mapael({
			map: {
				name: "perak",
				defaultArea: {
					attrs: {
						fill: "#c0f3ff",
						stroke: "#00a1fe"
					}
				},
				zoom: {
					enabled: true,
					mousewheel: true,
					maxLevel: 20
				},
				defaultPlot: {
					width: 40,
					height: 45,
					attrs: {
						fill: "#8AD12C"
					}
				}
			},
			legend: {
				plot: {
					labelAttrs: {
						fill: "#fff"
					},
					labelAttrsHover: {
						fill: "#ddd"
					},
					titleAttrs: {
						fill: "#f4f4e8"
					},
					cssClass: 'legend-kpi',
					mode: 'horizontal',
					title: "KPI",
					marginBottomTitle: 5,
					hideElemsOnClick: {
						opacity: 0.1
					}
				}
			}
		});

		// unblock("cardMapMalaysia");
		$(".goto-location").on("click", function () 
		{
			var lat = $(this).data("lat");
			var lon = $(this).data("lon");
			var value = $(this).data("val");

			$mymap.trigger('zoom', {level: 20, latitude: lat, longitude: lon});
		});
	});

</script>
<script type="text/javascript">

	$(document).ready(function() 
	{
		$('#seldaerah').change(function()
		{
			var val_parlimen = document.getElementById("idparlimen").value;
			var val_dun      = document.getElementById("iddun").value;
			var val_daerah   = document.getElementById("iddaerah").value;
			var val_mukim    = document.getElementById("idmukim").value;
			var val_cat      = document.getElementById("idcat").value;
			var val_kampung  = document.getElementById("idkampung").value;

			$.ajax({
				type: "GET", 
				url: "{{ URL::to('/info/ajax/mukim/')}}"+"/"+val_daerah,
				datatype : 'json',

				beforeSend: function ()
				{
					$('#selmukim').html('');
					$('#loadingpapar').show();
					$('#searchpapar').hide();
				},
				success: function(data)
				{
					$('#selmukim').html(data);
				},
				complete: function(data)
				{
					$('#searchpapar').show();
					$('#loadingpapar').hide();
				}
			});

			$.ajax({
				type: "GET", 
				url: "{{ URL::to('/info/ajax/parlimen/daerah')}}"+"/"+val_daerah,
				datatype : 'json',

				beforeSend: function ()
				{
					$('#selparlimen').html('');
					$('#loadingpapar').show();
					$('#searchpapar').hide();
				},
				success: function(data)
				{
					$('#selparlimen').html(data);
				},
				complete: function(data)
				{
					$('#searchpapar').show();
					$('#loadingpapar').hide();
				}
			});

			cariankampung(val_parlimen, val_dun, val_daerah, val_mukim, val_cat, val_kampung);
		});

		$('#selmukim').change(function()
		{
			var val_parlimen = document.getElementById("idparlimen").value;
			var val_dun      = document.getElementById("iddun").value;
			var val_daerah   = document.getElementById("iddaerah").value;
			var val_mukim    = document.getElementById("idmukim").value;
			var val_cat      = document.getElementById("idcat").value;
			var val_kampung  = document.getElementById("idkampung").value;

			$.ajax({
				type: "GET", 
				url: "{{ URL::to('/info/ajax/parlimen/mukim')}}"+"/"+val_mukim,
				datatype : 'json',

				beforeSend: function ()
				{
					$('#selparlimen').html('');
					$('#loadingpapar').show();
					$('#searchpapar').hide();
				},
				success: function(data)
				{
					$('#selparlimen').html(data);
				},
				complete: function(data)
				{
					$('#searchpapar').show();
					$('#loadingpapar').hide();
				}
			});

			cariankampung(val_parlimen, val_dun, val_daerah, val_mukim, val_cat, val_kampung);

		});

		$('#selparlimen').change(function()
		{
			var val_parlimen = document.getElementById("idparlimen").value;
			var val_dun      = document.getElementById("iddun").value;
			var val_daerah   = document.getElementById("iddaerah").value;
			var val_mukim    = document.getElementById("idmukim").value;
			var val_cat      = document.getElementById("idcat").value;
			var val_kampung  = document.getElementById("idkampung").value;

			$.ajax({
				type: "GET", 
				url: "{{ URL::to('/info/ajax/dun/')}}"+"/"+val_parlimen,
				datatype : 'json',


				beforeSend: function ()
				{
					$('#seldun').html('');
					$('#loadingpapar').show();
					$('#searchpapar').hide();
				},
				success: function(data)
				{
					$('#seldun').html(data);
					$('#loadingpapar').hide();
					$('#searchpapar').show();
				}
			});

			cariankampung(val_parlimen, val_dun, val_daerah, val_mukim, val_cat, val_kampung);

		});

		$('#seldun').change(function()
		{
			var val_parlimen = document.getElementById("idparlimen").value;
			var val_dun      = document.getElementById("iddun").value;
			var val_daerah   = document.getElementById("iddaerah").value;
			var val_mukim    = document.getElementById("idmukim").value;
			var val_cat      = document.getElementById("idcat").value;
			var val_kampung  = document.getElementById("idkampung").value;

			cariankampung(val_parlimen, val_dun, val_daerah, val_mukim, val_cat, val_kampung);

		});

		$('#selcat').change(function()
		{
			var val_parlimen = document.getElementById("idparlimen").value;
			var val_dun      = document.getElementById("iddun").value;
			var val_daerah   = document.getElementById("iddaerah").value;
			var val_mukim    = document.getElementById("idmukim").value;
			var val_cat      = document.getElementById("idcat").value;
			var val_kampung  = document.getElementById("idkampung").value;

			cariankampung(val_parlimen, val_dun, val_daerah, val_mukim, val_cat, val_kampung);

		});

		$('#selkampung').change(function()
		{
			var val_parlimen = document.getElementById("idparlimen").value;
			var val_dun      = document.getElementById("iddun").value;
			var val_daerah   = document.getElementById("iddaerah").value;
			var val_mukim    = document.getElementById("idmukim").value;
			var val_cat      = document.getElementById("idcat").value;
			var val_kampung  = document.getElementById("idkampung").value;

			// cariankampung(val_parlimen, val_dun, val_daerah, val_mukim, val_cat, val_kampung);

		});

		var val_parlimen = document.getElementById("idparlimen").value;
		var val_dun      = document.getElementById("iddun").value;
		var val_daerah   = document.getElementById("iddaerah").value;
		var val_mukim    = document.getElementById("idmukim").value;
		var val_cat      = document.getElementById("idcat").value;
		var val_kampung  = document.getElementById("idkampung").value;
		var role 		 = "{{ data_get($roleuser, 'role_id') }}";
		
		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/mukim/')}}"+"/"+val_daerah,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#selmukim').html('');
				$('#loadingpapar').show();
				$('#searchpapar').hide();
			},
			success: function(data)
			{
				$('#selmukim').html(data);
			},
			complete: function(data)
			{
				$('#searchpapar').show();
				$('#loadingpapar').hide();
			}
		});

		// Pdaerah
		if (role == '2')
		{

			$.ajax({
				type: "GET", 
				url: "{{ URL::to('/info/ajax/parlimen/daerah')}}"+"/"+val_daerah,
				datatype : 'json',

				beforeSend: function ()
				{
					$('#selparlimen').html('');
					$('#loadingpapar').show();
					$('#searchpapar').hide();
				},
				success: function(data)
				{
					$('#selparlimen').html(data);
				},
				complete: function(data)
				{
					$('#searchpapar').show();
					$('#loadingpapar').hide();
				}
			});
		}

		if (role == '3')
		{
			var val_mukim_user = "{{ data_get($user, 'Mukim') }}";

			$.ajax({
				type: "GET", 
				url: "{{ URL::to('/info/ajax/parlimen/mukim')}}"+"/"+val_mukim_user,
				datatype : 'json',

				beforeSend: function ()
				{
					$('#selparlimen').html('');
					$('#loadingpapar').show();
					$('#searchpapar').hide();
				},
				success: function(data)
				{
					$('#selparlimen').html(data);
				},
				complete: function(data)
				{
					$('#searchpapar').show();
					$('#loadingpapar').hide();
				}
			});
		}

		cariankampung(val_parlimen, val_dun, val_daerah, val_mukim, val_cat, val_kampung);


		// submit button here -------------------------------------------------------------
		$('#clicksubmit').click(function()
		{
			var val_parlimen = document.getElementById("idparlimen").value;
			var val_dun      = document.getElementById("iddun").value;
			var val_daerah   = document.getElementById("iddaerah").value;
			var val_mukim    = document.getElementById("idmukim").value;
			var val_cat      = document.getElementById("idcat").value;
			var val_kampung  = document.getElementById("idkampung").value;

			// cariankampung(val_parlimen, val_dun, val_daerah, val_mukim, val_cat, val_kampung);

			$.ajax({
				type: "GET", 
				url: "{{ URL::to('/info/ajax/result/')}}"+"/"+val_parlimen+"/"+val_dun+"/"+val_daerah+"/"+val_mukim+"/"+val_cat+"/"+val_kampung,
				datatype : 'json',

				beforeSend: function ()
				{
					$('#result2').html('');
					$('#result2').hide();
					$('#loadingpapar').show();
					// $('#searchpapar').hide();
				},
				success: function(data)
				{
					$('#result2').html(data);
					$('#result2').show();
					$('#loadingpapar').hide();
					// $('#searchpapar').show();
				}
			});

		});

	});

	function cariankampung(f_parlimen, f_dun, f_daerah, f_mukim, f_cat, f_kampung)
	{
		// console.log("val_parlimen="+f_parlimen);
		// console.log("val_dun     ="+f_dun);
		// console.log("val_daerah  ="+f_daerah);
		// console.log("val_mukim   ="+f_mukim);
		// console.log("val_cat     ="+f_cat);
		// console.log("val_kampung ="+f_kampung);

		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/kampung/')}}"+"/"+f_parlimen+"/"+f_dun+"/"+f_daerah+"/"+f_mukim+"/"+f_cat+"/"+f_kampung,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#selkampung').html('');
				$('#result2').html('');
				$('#result2').hide();
				$('#loadingpapar').show();
				$('#searchpapar').hide();
			},
			success: function(data)
			{
				$('#selkampung').html(data);
			},
			complete: function(data)
			{
				$('#searchpapar').show();
				$('#loadingpapar').hide();
			}
		});

	}


</script>

@endpush