@extends('laravolt::eperak.layouts.base')

@section('content')

<!-- start-------------------------------------------------------------------------------------------------------- -->

@push('style')
<style type="text/css">

    html,
    body,
    #viewDiv {
      padding: 0;
      margin: 0;
      height: 100%;
      width: 100%;
    }

    .dropdown:hover>.dropdown-menu {
        display: block;
    }

    .dropdown>.dropdown-toggle:active {
    /*Without this, clicking will make it sticky*/
        pointer-events: none;
    }

	table
	{
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th
	{
		border: 0px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	tr:nth-child(even)
	{
		background-color: #dddddd;
	}
	.capitalall
	{
		text-transform: uppercase;
	}

	/*.ayat
	{
		text-transform: uppercase;
	}
	.ayat:first-letter
	{
		text-transform: uppercase;
	}*/
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
								{{ data_get($data, 'NamaKampung') }}<br/>
							</h4></b>
							<h6 style="">
								&nbsp;{{ data_get($data, 'mukim.NamaMukim') }}, {{ data_get($data, 'daerah.NamaDaerah') }}
							</h6>

							<!-- <br><br> -->
							<!-- <a href="#" class="btn btn-secondary btn-shadow ml-10 hover-up">Lihat Terperinci</a> -->

						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- banner end   -->

	<!-- Map and download start -->
		@auth
		    <section class="section-box">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="sidebar-shadow">

								<div class="sidebar-heading">
									<div class="avatar-sidebar" style="vertical-align: middle;">
										<div style="float: right !important" class="mr-10 ml-10">
											<center>
												<a href="/dataentry/searchkampung/cetakprofil/1/{{ data_get($data, 'id') }}" target="_blank">
													<img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/download.png') }}" style="height: 50px !important" /><br>
													<span class="sidebar-website-text">Muat Turun</span>
												</a>
											</center>
										</div>
										<div style="float: right !important" class="mr-10 ml-10">
											<center>
												<a id="clickmap" href="#">
													<img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/search_map.png') }}" style="height: 50px !important" /><br>
													<span class="sidebar-website-text">Lihat Peta</span>
												</a>
											</center>
										</div>
										<div class="sidebar-info">
											<span class="sidebar-company capitalall" style="">Mengenai {{ data_get($data, 'NamaKampung') }}</span>
											<!-- <span class="sidebar-website-text">&nbsp;</span> -->
										</div>
									</div>
								</div>

								<div id="searchpapar" style="">

								</div>

								<div class="row" id="loadingpapar" style="display: none">
									<center>
										<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
									</center>
								</div>

							</div>
						</div>
					</div>
				</div>
			</section>
		@else

		@endauth
	<!-- Map and download end   -->

	<!-- accordion start -->
	    <section class="section-box">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="sidebar-shadow">
						<!-- accordion start -->
							<div class="accordion accordion-flush" id="accordionFlushExample">
								<!-- 1st accordion start -->
									<div class="accordion-item">
										<h2 class="accordion-header" id="flush-headingOne">
											<button class="accordion-button collapsed capitalall" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
												Sejarah
											</button>
										</h2>
										<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
											<div class="accordion-body">
												<div class="content-single">
													<p class="capitalall" id ="ayat" style="text-align: justify;"> 
														{{ data_get($data, 'Sejarah') }}
													</p><br/><br/>
													<h4 class="capitalall" style="margin-top: 20px; margin-left: 20px">Populasi dan Statistik Penduduk</h4>
													<span style="margin-top: 20px; margin-left: 20px; margin-bottom: 10px; margin-right: 20px">
														<div class="row mr-20 ml-20" style="">
															<center>
																<div class="row mt-0" style="">
																	<div class="col-lg-4 col-md-12 col-sm-12 col-12">
																		<div class="sidebar-shadow">
																			<div class="sidebar-heading">
																				<div class="avatar-sidebar">
																					<div class="sidebar-info" style="padding-left: 0px;">
																						<span class="sidebar-company capitalall">Taburan Bangsa</span>
																					</div>
																				</div>
																			</div>
																			<div class="sidebar-list-job" style="min-height: 430px; max-height: 430px; overflow: auto; margin-top: 5px">
																				<canvas id="bangsa-chart" height="400">
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-4 col-md-12 col-sm-12 col-12">
																		<div class="sidebar-shadow">
																			<div class="sidebar-heading">
																				<div class="avatar-sidebar">
																					<div class="sidebar-info" style="padding-left: 0px;">
																						<span class="sidebar-company capitalall">Taburan Jantina</span>
																					</div>
																				</div>
																			</div>
																			<div class="sidebar-list-job" style="min-height: 430px; max-height: 430px; overflow: auto; margin-top: 5px">
																				<canvas id="jantina-chart" height="400">
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-4 col-md-12 col-sm-12 col-12">
																		<div class="sidebar-shadow">
																			<div class="sidebar-heading">
																				<div class="avatar-sidebar">
																					<div class="sidebar-info" style="padding-left: 0px;">
																						<span class="sidebar-company capitalall">Statistik Taraf Perkahwinan</span>
																					</div>
																				</div>
																			</div>
																			<div class="sidebar-list-job" style="min-height: 430px; max-height: 430px; overflow: auto; margin-top: 5px">
																				<canvas id="taraf-chart" height="400">
																			</div>
																		</div>
																	</div>
																</div>
															</center>

															<br/><br/>

															<h4 class="capitalall" style="margin-top: 20px; margin-left: 20px">Perihal Kampung</h4>
															<table class=" capitalall" style="margin: 30px;">
																<tbody>
																	<tr>
																		<td style="text-align: left; width: 50%">Pegawai Daerah</td>
																		<td style="text-align: left; width: 50%">{{ data_get($data, 'daerah.NamaPegawaiDaerah') }}</td>
																	</tr>
																	<tr>
																		<td style="text-align: left">Penghulu Mukim</td>
																		<td style="text-align: left">{{ data_get($data, 'mukim.NamaPenghuluMukim') }}</td>
																	</tr>
																	<tr>
																		<td style="text-align: left">Nama Kampung</td>
																		<td style="text-align: left">{{ data_get($data, 'NamaKampung') }}</td>
																	</tr>
																	<tr>
																		<td style="text-align: left">Daerah dan Mukim</td>
																		<td style="text-align: left">{{ data_get($data, 'daerah.NamaDaerah') }} / {{ data_get($data, 'mukim.NamaMukim') }}</td>
																	</tr>
																	<tr>
																		<td style="text-align: left">Parlimen / DUN</td>
																		<td style="text-align: left">{{ data_get($data, 'parlimen.NamaParlimen') }} / {{ data_get($data, 'dun.NamaDun') }}</td>
																	</tr>
																	<tr>
																		<td style="text-align: left">Pengerusi JPKK</td>
																		<td style="text-align: left">{{ data_get($jpkk, 'NamaAhli') }}</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</span><br/><br/>
												</div>
											</div>
										</div>
									</div>
								<!-- 1st accordion end   -->

								<!-- 2nd accordion start -->
									@if( count( $data->profil_aktiviti ) != 0 )
										<div class="accordion-item">
											<h2 class="accordion-header" id="flush-headingTwo">
												<button class="accordion-button collapsed capitalall" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
													Aktiviti
												</button>
											</h2>
											<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample" style="">
												<div class="accordion-body">

													<div class="content-single" id="ajordion-aktiviti">

													</div>
													<div class="row mtb-30" id="loadingpapar-aktiviti" style="display: none">
														<center>
															<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
														</center>
													</div>

												</div>
											</div>
										</div>
									@else
									@endif
								<!-- 2nd accordion end -->

								<!-- 3rd accordion start -->
									@if( count( $data->profil_pencapaian ) != 0 )
										<div class="accordion-item">
											<h2 class="accordion-header" id="flush-headingThree">
												<button class="accordion-button collapsed capitalall" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
													Pencapaian
												</button>
											</h2>
											<div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample" style="">
												<div class="accordion-body">

													<div class="content-single" id="ajordion-pencapaian">

													</div>
													<div class="row mtb-30" id="loadingpapar-pencapaian" style="display: none">
														<center>
															<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
														</center>
													</div>

												</div>
											</div>
										</div>
									@else
									@endif
								<!-- 3rd accordion end -->

								<!-- 4th accordion start -->
									@if( count( $data->profil_infra ) != 0 )
										<div class="accordion-item">
											<h2 class="accordion-header" id="flush-headingFour">
												<button class="accordion-button collapsed capitalall" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
													Kemudahan Awam & Infrastruktur
												</button>
											</h2>
											<div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample" style="">
												<div class="accordion-body">

													<div class="content-single" id="ajordion-infra">

													</div>
													<div class="row mtb-30" id="loadingpapar-infra" style="display: none">
														<center>
															<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
														</center>
													</div>

												</div>
											</div>
										</div>
									@else
									@endif
								<!-- 4th accordion end -->

								<!-- 5th accordion start -->
									@if( count( $data->profil_produk ) != 0 )
										<div class="accordion-item">
											<h2 class="accordion-header" id="flush-headingFive">
												<button class="accordion-button collapsed capitalall" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
													Produk
												</button>
											</h2>
											<div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample" style="">
												<div class="accordion-body">

													<div class="content-single" id="ajordion-produk">

													</div>
													<div class="row mtb-30" id="loadingpapar-produk" style="display: none">
														<center>
															<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
														</center>
													</div>
												</div>
											</div>
										</div>
									@else
									@endif
								<!-- 5th accordion end -->

								<!-- 6th accordion start -->
									@auth
										@if( count( $data->profil_projek ) != 0 )
											<div class="accordion-item">
												<h2 class="accordion-header" id="flush-headingSix">
													<button class="accordion-button collapsed capitalall" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
														Projek
													</button>
												</h2>
												<div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample" style="">
													<div class="accordion-body">

														<div class="content-single" id="ajordion-projek">

														</div>
														<div class="row mtb-30" id="loadingpapar-projek" style="display: none">
															<center>
																<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
															</center>
														</div>
													</div>
												</div>
											</div>
										@else
										@endif
									@else

									@endauth
								<!-- 6th accordion end -->

								<!-- 7th accordion start -->
									@if( count( $data->profil_galeri ) != 0 )
										<div class="accordion-item">
											<h2 class="accordion-header" id="flush-headingSeven">
												<button class="accordion-button collapsed capitalall" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
													Galeri
												</button>
											</h2>
											<div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample" style="">
												<div class="accordion-body">

													<div class="content-single" id="ajordion-galeri">

													</div>
													<div class="row mtb-30" id="loadingpapar-galeri" style="display: none">
														<center>
															<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
														</center>
													</div>
												</div>
											</div>
										</div>
									@else
									@endif
								<!-- 7th accordion end -->

							</div>

							<hr>

							<!-- button kembali -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="btn-group" style="float: right;">
                                            <div class="block-banner">
                                                <button type="btn" class="btn btn-default btn-shadow hover-up" onclick="back()"
                                                        style="color: white; background-color: #9777fa; height: 50px ">
                                                    Kembali
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- button kembali -->
						<!-- accordion end   -->
						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- accordion end   -->




<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')

<script type="text/javascript">

    function back() 
    {
        window.location.href = "/info";
    }

	$(document).ready(function()
	{
		var clickaktiviti = '0';
		var clickpencapaian = '0';
		var clickinfra = '0';
		var clickproduk = '0';
		var clickprojek = '0';
		var clickgaleri = '0';

		$('#flush-headingTwo').click(function()
		{
			if(clickaktiviti == '0')
			{
				clickaktiviti = '1';
				var id = "{{ $request->segment(2) }}";
				// onload accordion ------------ ajordion-aktiviti
				$.ajax(
				{
					type: "GET",
					url: "{{ URL::to('/info/ajax/detail/aktiviti/')}}"+"/"+id,
					datatype : 'json',

					beforeSend: function ()
					{
						$('#ajordion-aktiviti').hide();
						$('#loadingpapar-aktiviti').show();
					},
					success: function(data)
					{
						$('#ajordion-aktiviti').html(data);
					    $('#loadingpapar-aktiviti').hide();
						$('#ajordion-aktiviti').show();

					},
					complete: function()
					{
					    $(".swiper-group-3").each(function () {
					        var swiper_3_items = new Swiper(this, {
					            spaceBetween: 30,
					            slidesPerView: 3,
					            spaceBetween: 30,
					            slidesPerGroup: 1,
					            loop: true,
					            navigation: {
					                nextEl: ".swiper-button-next",
					                prevEl: ".swiper-button-prev"
					            },
					            pagination: {
					                el: ".swiper-pagination",
					                type: "custom",
					                renderCustom: function (swiper, current, total) {
					                    var customPaginationHtml = "";
					                    for (var i = 0; i < total; i++) {
					                        //Determine which pager should be activated at this time
					                        if (i == current - 1) {
					                            customPaginationHtml += '<span class="swiper-pagination-customs swiper-pagination-customs-active"></span>';
					                        } else {
					                            customPaginationHtml += '<span class="swiper-pagination-customs"></span>';
					                        }
					                    }
					                    return customPaginationHtml;
					                }
					            },
					            autoplay: {
					                delay: 10000
					            },
					            breakpoints: {
					                1199: {
					                    slidesPerView: 3
					                },
					                800: {
					                    slidesPerView: 2
					                },
					                400: {
					                    slidesPerView: 1
					                },
					                350: {
					                    slidesPerView: 1
					                }
					            }
					        });
					    });
					}

				});
			}

		});

		$('#flush-headingThree').click(function()
		{
			if(clickpencapaian == '0')
			{
				clickpencapaian = '1';
				var id = "{{ $request->segment(2) }}";
				// onload accordion ------------ ajordion-pencapaian
				$.ajax(
				{
					type: "GET",
					url: "{{ URL::to('/info/ajax/detail/pencapaian/')}}"+"/"+id,
					datatype : 'json',

					beforeSend: function ()
					{
						$('#ajordion-pencapaian').hide();
						$('#loadingpapar-pencapaian').show();
					},
					success: function(data)
					{
						$('#ajordion-pencapaian').html(data);
					    $('#loadingpapar-pencapaian').hide();
						$('#ajordion-pencapaian').show();

					},
					complete: function()
					{
					}

				});
			}

		});

		$('#flush-headingFour').click(function()
		{
			if(clickinfra == '0')
			{
				clickinfra = '1';
				var id = "{{ $request->segment(2) }}";
				// onload accordion ------------ ajordion-infra
				$.ajax(
				{
					type: "GET",
					url: "{{ URL::to('/info/ajax/detail/infra/')}}"+"/"+id,
					datatype : 'json',

					beforeSend: function ()
					{
						$('#ajordion-infra').hide();
						$('#loadingpapar-infra').show();
					},
					success: function(data)
					{
						$('#ajordion-infra').html(data);
					    $('#loadingpapar-infra').hide();
						$('#ajordion-infra').show();

					},
					complete: function()
					{
					}

				});
			}

		});

		$('#flush-headingFive').click(function()
		{
			if(clickproduk == '0')
			{
				clickproduk = '1';
				var id = "{{ $request->segment(2) }}";
				// onload accordion ------------ ajordion-produk
				$.ajax(
				{
					type: "GET",
					url: "{{ URL::to('/info/ajax/detail/produk/')}}"+"/"+id,
					datatype : 'json',

					beforeSend: function ()
					{
						$('#ajordion-produk').hide();
						$('#loadingpapar-produk').show();
					},
					success: function(data)
					{
						$('#ajordion-produk').html(data);
					    $('#loadingpapar-produk').hide();
						$('#ajordion-produk').show();

					},
					complete: function()
					{
					}

				});
			}

		});

		$('#flush-headingSix').click(function()
		{
			if(clickprojek == '0')
			{
				clickprojek = '1';
				var id = "{{ $request->segment(2) }}";
				// onload accordion ------------ ajordion-projek
				$.ajax(
				{
					type: "GET",
					url: "{{ URL::to('/info/ajax/detail/projek/')}}"+"/"+id,
					datatype : 'json',

					beforeSend: function ()
					{
						$('#ajordion-projek').hide();
						$('#loadingpapar-projek').show();
					},
					success: function(data)
					{
						$('#ajordion-projek').html(data);
					    $('#loadingpapar-projek').hide();
						$('#ajordion-projek').show();

					},
					complete: function()
					{
					}

				});
			}

		});

		$('#flush-headingSeven').click(function()
		{
			if(clickgaleri == '0')
			{
				clickgaleri = '1';
				var id = "{{ $request->segment(2) }}";
				// onload accordion ------------ ajordion-galeri
				$.ajax(
				{
					type: "GET",
					url: "{{ URL::to('/info/ajax/detail/galeri/')}}"+"/"+id,
					datatype : 'json',

					beforeSend: function ()
					{
						$('#ajordion-galeri').hide();
						$('#loadingpapar-galeri').show();
					},
					success: function(data)
					{
						$('#ajordion-galeri').html(data);
					    $('#loadingpapar-galeri').hide();
						$('#ajordion-galeri').show();

					},
					complete: function()
					{
					}

				});
			}

		});


		// submit button here -------------------------------------------------------------
		$('#clickmap').click(function()
		{
			// var val_parlimen = document.getElementById("idparlimen").value;
			var val_parlimen = {{ $request->idkampung }};
			// console.log("val_parlimen= "+val_parlimen);

			$.ajax({
				type: "GET",
				url: "{{ URL::to('/info/ajax/detail/map/')}}"+"/"+val_parlimen,
				datatype : 'json',

				beforeSend: function ()
				{
					$('#searchpapar').hide();
					$('#loadingpapar').show();
				},
				success: function(data)
				{
					$('#loadingpapar').hide();
					$('#searchpapar').html(data);
					$('#searchpapar').show();

				}
			});

		});

	});
</script>

<script type="text/javascript">
	$(document).ready(function ()
	{
		var bangsachart = $("#bangsa-chart");

		var arr_color = [
			[
				"#02C39A", "#FFC000", "#FF0000","#057047","#27E4FC","#F26426","#11F79A","#17970E","#F25E5E","#264501"
			],
			[
				"#9ACB34", "#FF0000", "#833D85","#FE8A01","#81D1B6","#FECE02","#4F2550","#D40104","#5C7A1F","#FFC681"
			],
			[
				"#FC3924", "#2EBC86", "#F2DC13","#B81423","#637589","#6EC135","#7030A0","#1B7E00","#256DBD","#F3A58D"
			],
			[
				"#A8234C", "#92D565", "#E3534C","#6F3B55","#FFA874","#005828","#F33F21","#DF678C","#4C91DC","#F3A58D"
			],
			[
				"#02C39A", "#FFC000", "#FF0000","#057047","#27E4FC","#F26426","#F33F21","#11F79A","#1D9A00","#F25E5E"
			],
			[
				"#4B9ABB", "#9ACB34", "#EC5923","#833D85","#FDDA02","#637589","#4DA17F","#001A9A","#D01232","#FFC681"
			]
		];

		var color = arr_color[Math.floor(Math.random() * arr_color.length)];

		// Chart Options
		var chartOptions =
		{
			responsive: true,
			maintainAspectRatio: false,
			responsiveAnimationDuration: 500,
			legend:
			{
				position: 'bottom',
				fullWidth: false,
				labels:
				{
					boxWidth: 20
				}
			},
			plugins:
			{
				labels:
				{
					render: 'value',
					fontColor: 'white',
					precision: 2
				}
			},
		};

		// Chart Data
		var chartData =
		{
			labels: [
				{!! $bangsa['bangsalabel'] !!}
			],
			datasets: [
			{
				label: 'Carta Bangsa',
				data: [{!! $bangsa['bangsa'] !!}],
				backgroundColor: color,
				hoverOffset: 4
			}]
		};

		var config =
		{
			type: "pie",

			// Chart Options
			options: chartOptions,
			data: chartData
		};

		// Create the chart
		var barChart1 = new Chart(bangsachart, config);
	});
</script>
<script type="text/javascript">
	$(document).ready(function ()
	{
		var jantinachart = $("#jantina-chart");

		var arr_color = [
			[
				"#02C39A", "#FFC000", "#FF0000","#057047","#27E4FC","#F26426","#11F79A","#17970E","#F25E5E","#264501"
			],
			[
				"#9ACB34", "#FF0000", "#833D85","#FE8A01","#81D1B6","#FECE02","#4F2550","#D40104","#5C7A1F","#FFC681"
			],
			[
				"#FC3924", "#2EBC86", "#F2DC13","#B81423","#637589","#6EC135","#7030A0","#1B7E00","#256DBD","#F3A58D"
			],
			[
				"#A8234C", "#92D565", "#E3534C","#6F3B55","#FFA874","#005828","#F33F21","#DF678C","#4C91DC","#F3A58D"
			],
			[
				"#02C39A", "#FFC000", "#FF0000","#057047","#27E4FC","#F26426","#F33F21","#11F79A","#1D9A00","#F25E5E"
			],
			[
				"#4B9ABB", "#9ACB34", "#EC5923","#833D85","#FDDA02","#637589","#4DA17F","#001A9A","#D01232","#FFC681"
			]
		];

		var color = arr_color[Math.floor(Math.random() * arr_color.length)];

		// Chart Options
		var chartOptions =
		{
			responsive: true,
			maintainAspectRatio: false,
			responsiveAnimationDuration: 500,
			legend:
			{
				position: 'bottom',
				fullWidth: false,
				labels:
				{
					boxWidth: 20
				}
			},
			plugins:
			{
				labels:
				{
					render: 'value',
					fontColor: 'white',
					precision: 2
				}
			},
		};

		// Chart Data
		var chartData =
		{
			labels: [
				'LELAKI',
				'PEREMPUAN',
			],
			datasets: [
			{
				label: 'Carta Jantina',
				data: [{!! $jantina !!}],
				backgroundColor: color,
					hoverOffset: 4
			}]
		};

		var config =
		{
			type: "pie",

			// Chart Options
			options: chartOptions,
			data: chartData
		};

		// Create the chart
		var barChart2 = new Chart(jantinachart, config);
	});
</script>
<script type="text/javascript">
	$(document).ready(function ()
	{
		var tarafchart = $("#taraf-chart");

		var arr_color = [
			[
				"#02C39A", "#FFC000", "#FF0000","#057047","#27E4FC","#F26426","#11F79A","#17970E","#F25E5E","#264501"
			],
			[
				"#9ACB34", "#FF0000", "#833D85","#FE8A01","#81D1B6","#FECE02","#4F2550","#D40104","#5C7A1F","#FFC681"
			],
			[
				"#FC3924", "#2EBC86", "#F2DC13","#B81423","#637589","#6EC135","#7030A0","#1B7E00","#256DBD","#F3A58D"
			],
			[
				"#A8234C", "#92D565", "#E3534C","#6F3B55","#FFA874","#005828","#F33F21","#DF678C","#4C91DC","#F3A58D"
			],
			[
				"#02C39A", "#FFC000", "#FF0000","#057047","#27E4FC","#F26426","#F33F21","#11F79A","#1D9A00","#F25E5E"
			],
			[
				"#4B9ABB", "#9ACB34", "#EC5923","#833D85","#FDDA02","#637589","#4DA17F","#001A9A","#D01232","#FFC681"
			]
		];

		var color = arr_color[Math.floor(Math.random() * arr_color.length)];

		// Chart Options
		var chartOptions =
		{
			responsive: true,
			maintainAspectRatio: false,
			responsiveAnimationDuration: 500,
			legend:
			{
				position: 'bottom',
				fullWidth: false,
				labels:
				{
					boxWidth: 20
				}
			},
			plugins:
			{
				labels:
				{
					render: 'value',
					fontColor: 'white',
					precision: 2
				}
			},
		};

		// Chart Data
		var chartData =
		{
			labels: [
				{!! $taraf['taraflabel'] !!}
			],
			datasets: [
			{
				label: 'Carta Taraf Perkahwinan',
				data: [{!! $taraf['taraf'] !!}],
				backgroundColor: color,
				hoverOffset: 4
			}]
		};

		var config =
		{
			type: "pie",

			// Chart Options
			options: chartOptions,
			data: chartData
		};

		// Create the chart
		var barChart3 = new Chart(tarafchart, config);
	});
</script>

<script language="javascript">
	$(document).ready(function(){
		var div_ayat = document.getElementById('ayat');

		var bueaty = fixCapitalsNode (div_ayat);

		document.getElementById('ayat').text(bueaty);
	});

	function fixCapitalsText (text)
	{
		result = "";

		sentenceStart = true;
		for (i = 0; i < text.length; i++)
		{
			ch = text.charAt (i);

			if (sentenceStart && ch.match (/^\S$/))
			{
				ch = ch.toUpperCase ();
				sentenceStart = false;
			}
			else
			{
				ch = ch.toLowerCase ();
			}

			if (ch.match (/^[.!?]$/))
			{
				sentenceStart = true;
			}
		
			result += ch;
		}

		return result;
	}

	function fixCapitalsNode (node)
	{	
		// console.log(node);
		// console.log(node.nodeType);
		if (node.nodeType == 3 || node.nodeType == 4) // Text or CDATA
		{
			node.textContent = fixCapitalsText (node.textContent);
		}


		if (node.nodeType == 1){
			for (i = 0; i < node.childNodes.length; i++){
				fixCapitalsNode (node.childNodes.item (i));
			}
		}
	}
</script>
@endpush
