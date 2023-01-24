@extends('laravolt::eperak.layouts3.base')

@section('content')
<!-- start-------------------------------------------------------------------------------------------------------- -->

@push('style')
<style type="text/css">
	.autosizing 
	{ 
		height: auto; 
	}
	.autosizingnotis 
	{ 
		height: auto; 
	}
	.autosizingaktiviti 
	{ 
		height: auto; 
	}
	.autosizinghyperlink 
	{ 
		height: auto; 
	}
	.autosizinghyperlinktwo
	{ 
		height: auto; 
	}
	#goto
	{
		position: absolute;
		bottom: 2%;
		right: 2%;
	}
</style>
@endpush

	<!-- banner start -->
	    <section class="section-box" style="padding-top: 0px">
			<div class="row">
				<div class="col-md-12" style="padding-left: 0px; padding-right: 0px; ">
					<center>
						<div class="box-swiper" style="width: 100%">
							<div class="swiper-container swiper-group-1">
								<div class="swiper-wrapper">
									@foreach($banner as $key => $banners)
										<div class="swiper-slide">

											@if( $banners->path )
												@if( file_exists( public_path( data_get($banners, 'path') ) ) )
													<a target="_blank" href="{!! URL::to(data_get($banners, 'path')) !!}">
														<img src="{!! URL::to(data_get($banners, 'path')) !!}" alt="{{ data_get($banners, 'filename') }}" width="100%" height="100%" title="{{ data_get($banners, 'tajuk') }}">
													</a>
												@else
													<img src="{{ asset('logo.png') }}" alt="{{ data_get($banners, 'filename') }}" title="{{ data_get($banners, 'tajuk') }}">
												@endif
											@else
												<img src="{{ asset('logo.png') }}" alt="{{ data_get($banners, 'filename') }}" title="{{ data_get($banners, 'tajuk') }}">
											@endif

										</div>
									@endforeach
								</div>
							</div>
							<div class="swiper-button-next" style="margin-right: 68px; margin-top: -25px;"></div>
							<div class="swiper-button-prev" style="margin-left: 68px; margin-top: -25px;"></div>
						</div>
					</center>
				</div>
			</div>
		</section>
	<!-- banner end   -->

	<!-- notis start  -->
		@if($notis->count() != 0)
			<section class="section-box mt-40">
				<div class="container">
					<div class="row">
						<div class="col-xl-10 col-lg-12 m-auto">
							<section class="">
								<div class="row">
									<div class="col-xl-9 col-md-12 mx-auto">
										<div class="contact-from-area padding-20-row-col">
											<h2 class="section-title mt-15 mb-5 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s" 
												style="color: white; text-shadow: 2px 2px #000000;">
												<a href="news?page=1" style="color: white" class="">BERITA e-PERAK</a>
											</h2>
											<p class="mb-30 font-md text-center wow animate__ animate__fadeInUp animated" data-wow-delay=".3s" 
											   style="color: white; text-shadow: 1px 1px #000000;">
												Ketahui keseluruhan berita terkini
											</p>
										</div>
									</div>
								</div>
							</section>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="autosizingnotis">
						<div class="mt-10">
							<div class="fade show active">
								<div class="row">

									@foreach($notis->take(3) as $key => $notiss)
										<div class="col-lg-4 col-md-4 col-sm-12 col-12 hover-up wow animate__animated animate__fadeInUp" data-wow-delay=".5s"  onclick="location.href = '/news/{{ data_get($notiss, 'id') }}';" 
											 style="cursor: pointer">
											<div class="card-grid-2 hover-up h-100" style="border-top-width: 0px; border-left-width: 0px; border-right-width: 0px; border-bottom-width: 10px;">
												<div class="text-center card-grid-2-image">
													<a href="javascript:;">
														<figure>

															@if( data_get($notiss, 'path') )
																@if( file_exists( public_path( data_get($notiss, 'path') ) ) )
																	<img src="{!! URL::to(data_get($notiss, 'path')) !!}" alt="{{ data_get($notiss, 'filename') }}" title="{{ data_get($notiss, 'tajuk') }}" 
																		 style="height: 300px !important">
																@else
																	<img src="{{ asset('logo.png') }}" alt="{{ data_get($notiss, 'filename') }}" title="{{ data_get($notiss, 'tajuk') }}"
																		 style="height: 50% !important; width: 50% !important">
																@endif
															@else
																<img src="{{ asset('logo.png') }}" alt="{{ data_get($notiss, 'filename') }}" title="{{ data_get($notiss, 'tajuk') }}"
																	 style="height: 50% !important; width: 50% !important">
															@endif

														</figure>
													</a>
												</div>
												<div class="card-block-info" style="min-height: 210px !important">
													<h5 class="">
														<a href="javascript:;">
															{{ data_get($notiss, 'tajuk') }}
														</a>
													</h5>
													<div class="row">
														<a href="javascript:;" class="">
															<span>
																{{ data_get($notiss, 'ringkasan') }}
															</span>
														</a>
													</div>
													<div class="card-2-bottom mt-30">
														<div class="row ml-0">
															<!-- <div class="col-lg-5 col-5"> -->
																<span class="card-calender">{{ data_get($notiss, 'tarikh_notis') }}</span>
															<!-- </div> -->
														</div>
													</div>
												</div>

													<!-- <button id="goto" class="btn btn-default btn-shadow hover-up" style="" onclick="location.href = '/news/ data_get($notiss, 'id') }}';"> -->
														<!-- Teruskan -->
													<!-- </button> -->
												
											</div>
										</div>
									@endforeach

								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		@else
		@endif
	<!-- notis end  -->

	<!-- aktiviti start -->
		<section class="section-box mt-40">
			<div class="container">
				<div class="row">
					<div class="col-xl-10 col-lg-12 m-auto">
						<section class="">
							<div class="row">
								<div class="col-xl-9 col-md-12 mx-auto">
									<div class="contact-from-area padding-20-row-col">
										<h2 class="section-title mt-15 mb-5 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s" 
											style="color: white; text-shadow: 2px 2px #000000;">
											<a class="hover-up" href="activity?page=1" style="color: white">AKTIVITI e-PERAK</a>
										</h2>
										<p class="mb-30 font-md text-center wow animate__ animate__fadeInUp animated" data-wow-delay=".3s" 
										   style="color: white; text-shadow: 1px 1px #000000;">
											Terokai aktiviti dan pengalaman terbaru
										</p>
									</div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="autosizing">
					<div class="row">

						<!-- start highlight aktiviti ------------------------------------------------------------------------------ -->
						<div class="col-lg-6 col-md-12 col-sm-12 col-12 pr-15 mt-30">
							<div class="box-image-job h-100">
								@foreach($aktiviti->take(1) as $key => $aktivitis)
									<figure class=" wow animate__animated animate__fadeIn h-100" style="">

										@if( data_get($aktivitis, 'Gambar_path') )
											@if( file_exists( public_path( data_get($aktivitis, 'Gambar_path') ) ) )
												<a href="/activity/{{ data_get($aktivitis, 'id') }}">
													<img src="{!! URL::to(data_get($aktivitis, 'Gambar_path')) !!}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" 
														 class="h-100" 
														 style="border-radius: 0px 100px 0px 100px; 
														 		box-shadow: 2px 2px 4px 2px darkgrey, 0 0 25px grey, 0 0 3px lightgrey; 
														 		min-height: 500px"> <!-- position: absolute; top: 0%; left: 10%; -->
												</a>
											@else
												<a href="/activity/{{ data_get($aktivitis, 'id') }}">
													<img src="{{ asset('logo.png') }}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" title="{{ data_get($aktivitis, 'NamaAktiviti') }}"
														 class="h-100" style="border-radius: 0px 100px 0px 100px; ">
												</a>
											@endif
										@else
											<a href="/activity/{{ data_get($aktivitis, 'id') }}">
												<img src="{{ asset('logo.png') }}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" title="{{ data_get($aktivitis, 'NamaAktiviti') }}"
													 class="h-100" style="border-radius: 0px 100px 0px 100px; ">
											</a>
										@endif

									</figure>

									<div class="job-top-creator" onclick="window.location='/activity/{{ data_get($aktivitis, 'id') }}';" style="cursor: pointer !important;">
										<div class="job-top-creator-head" style="padding: 10px !important">
											<h5 style="color: white !important">{{ data_get($aktivitis, 'NamaAktiviti') }}</h5>
										</div>
										<ul>
											<li>
												<div>
													<figure><img alt="Kategori" src="{{ asset('theme/assets/imgs/theme/perak/actcat.png') }}" /></figure>
													<div class="job-info-creator">
														<strong>Kategori</strong>
														<span>{{ data_get($aktivitis, 'kategori.description') }}</span>
													</div>
												</div>
											</li>
											<li>
												<div>
													<figure><img alt="Lokasi" src="{{ asset('theme/assets/imgs/theme/perak/actplace.png') }}" /></figure>
													<div class="job-info-creator">
														<strong>Lokasi</strong>
														<span>{{ data_get($aktivitis, 'kampung.NamaKampung') }}</span>
													</div>
												</div>
											</li>
										</ul>
									</div>

									<div class="job-top-highlight">
										<div class="job-top-highlight-head" style="padding: 10px !important">
											<h6 style="color: white !important">Highlight Aktiviti Terkini</h6>
										</div>
									</div>
								@endforeach
							</div>
						</div>
						<!-- end highlight aktiviti ------------------------------------------------------------------------------ -->

						<!-- start aktiviti kecik ------------------------------------------------------------------------------ -->
						<div class="col-lg-6 col-md-12 col-sm-12 col-12 pl-15 mt-30 hover-up d-none d-lg-block">
							<div class="sidebar-shadow h-100 shadow-lg" style="">
								<div class="sidebar-heading">
									<div class="avatar-sidebar">
										<figure>
											<img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/activity.png') }}" />
										</figure>
										<div class="sidebar-info">
											<span class="sidebar-company">&nbsp;&nbsp;AKTIVITI e-PERAK</span>
											<span class="sidebar-website-text">&nbsp;&nbsp;&nbsp;Terokai aktiviti dan pengalaman terbaru</span>
											<div class="dropdowm">
												<button class="btn btn-dots btn-dots-abs-right dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
												<ul class="dropdown-menu dropdown-menu-light">
													<!-- <li> -->
														<a href="activity?page=1" class="dropdown-item" >Senarai Aktiviti</a>
													<!-- </li> -->
												</ul>
											</div>
										</div>
									</div>
								</div>

								<div class="sidebar-list-job" style="min-height: 430px;">  <!-- overflow: auto; -->
									<ul>
										@foreach($aktiviti->skip(1)->take(3) as $key => $aktivitis)
											<li>
												<div class="sidebar-text-info">

													<div class="row hover-up"  onclick="location.href = '/activity/{{ data_get($aktivitis, 'id') }}';" style="cursor: pointer">
														<div class="col-lg-4 col-md-4 col-sm-4 col-4">

															@if( data_get($aktivitis, 'Gambar_path') )
																@if( file_exists( public_path( data_get($aktivitis, 'Gambar_path') ) ) )
																	<a href="javascript:;">
																		<img src="{!! URL::to(data_get($aktivitis, 'Gambar_path')) !!}" 
																			 alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" 
																			 title="{{ data_get($aktivitis, 'NamaAktiviti') }}" >
																	</a>
																@else
																	<a href="javascript:;">
																		<img src="{{ asset('logo.png') }}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" title="{{ data_get($aktivitis, 'NamaAktiviti') }}" style="width: 100px">
																	</a>
																@endif
															@else
																<a href="javascript:;">
																	<img src="{{ asset('logo.png') }}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" title="{{ data_get($aktivitis, 'NamaAktiviti') }}" style="width: 100px">
																</a>
															@endif

														</div>

														<div class="col-lg-8 col-md-8 col-sm-8 col-8">
															<strong class="small-heading pt-0 mb-10">
																<a href="javascript:;">
																	{{ data_get($aktivitis, 'NamaAktiviti') }}
																</a>
															</strong>
															<!-- <span class="text-description"><i class="fi fi-rr-calendar"></i>
																<span class="ml-15"> data_get($aktivitis, 'Tahun') }}</span>
															</span> -->
															<span class="text-description"><i class="fi fi-rr-paper-plane"></i>
																<span class="ml-5">{{ data_get($aktivitis, 'kategori.description') }}</span>
															</span>
															<span class="text-description"><i class="fi fi-rr-marker"></i>
																<span class="ml-5">{{ data_get($aktivitis, 'kampung.NamaKampung') }}</span>
															</span>
														</div>
													</div>

												</div>
											</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
						<!-- end aktiviti ------------------------------------------------------------------------------ -->

						<!-- start aktiviti kecik ------------------------------------------------------------------------------ -->
						<div class="col-lg-6 col-md-12 col-sm-12 col-12 pl-15 hover-up d-lg-none d-xl-none" style="margin-top: 165px">
							<div class="sidebar-shadow h-100 shadow-lg" style="">
								<div class="sidebar-heading">
									<div class="avatar-sidebar">
										<figure>
											<img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/activity.png') }}" />
										</figure>
										<div class="sidebar-info">
											<span class="sidebar-company">&nbsp;&nbsp;AKTIVITI e-PERAK</span>
											<span class="sidebar-website-text">&nbsp;&nbsp;&nbsp;Terokai aktiviti dan pengalaman terbaru</span>
											<div class="dropdowm">
												<button class="btn btn-dots btn-dots-abs-right dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
												<ul class="dropdown-menu dropdown-menu-light">
													<!-- <li> -->
														<a href="activity?page=1" class="dropdown-item" >Senarai Aktiviti</a>
													<!-- </li> -->
												</ul>
											</div>
										</div>
									</div>
								</div>

								<div class="sidebar-list-job" style="min-height: 430px;">  <!-- overflow: auto; -->
									<ul>
										@foreach($aktiviti->skip(1)->take(3) as $key => $aktivitis)
											<li>
												<div class="sidebar-text-info">

													<div class="row hover-up"  onclick="location.href = '/activity/{{ data_get($aktivitis, 'id') }}';" style="cursor: pointer">
														<div class="col-lg-4 col-md-4 col-sm-4 col-4">
															
															@if( data_get($aktivitis, 'Gambar_path') )
																@if( file_exists( public_path( data_get($aktivitis, 'Gambar_path') ) ) )
																	<a href="javascript:;">
																		<img src="{!! URL::to(data_get($aktivitis, 'Gambar_path')) !!}" 
																			 alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" 
																			 title="{{ data_get($aktivitis, 'NamaAktiviti') }}" >
																	</a>
																@else
																	<a href="javascript:;">
																		<img src="{{ asset('logo.png') }}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" title="{{ data_get($aktivitis, 'NamaAktiviti') }}" style="width: 100px">
																	</a>
																@endif
															@else
																<a href="javascript:;">
																	<img src="{{ asset('logo.png') }}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" title="{{ data_get($aktivitis, 'NamaAktiviti') }}" style="width: 100px">
																</a>
															@endif

														</div>

														<div class="col-lg-8 col-md-8 col-sm-8 col-8">
															<strong class="small-heading pt-0 mb-10">
																<a href="javascript:;">
																	{{ data_get($aktivitis, 'NamaAktiviti') }}
																</a>
															</strong>
															<!-- <span class="text-description"><i class="fi fi-rr-calendar"></i>
																<span class="ml-15"> data_get($aktivitis, 'Tahun') }}</span>
															</span> -->
															<span class="text-description"><i class="fi fi-rr-paper-plane"></i>
																<span class="ml-5">{{ data_get($aktivitis, 'kategori.description') }}</span>
															</span>
															<span class="text-description"><i class="fi fi-rr-marker"></i>
																<span class="ml-5">{{ data_get($aktivitis, 'kampung.NamaKampung') }}</span>
															</span>
														</div>
													</div>

												</div>
											</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
						<!-- end aktiviti ------------------------------------------------------------------------------ -->

					</div>
				</div>
			</div>
		</section>
	<!-- aktiviti end   -->

	<!-- produk start -->
		<section class="section-box">
			<div class="container">
				<div class="autosizing">
					<div class="row">

						<!-- start produk ------------------------------------------------------------------------------ -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-30 hover-up">
							<div class="sidebar-shadow shadow-lg mb-60">
								<div class="sidebar-heading">
									<div class="avatar-sidebar">
										<figure>
											<img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/product.png') }}" />
										</figure>
										<div class="sidebar-info">
											<span class="sidebar-company">&nbsp;&nbsp;KATEGORI PRODUK TEMPATAN</span>
											<span class="sidebar-website-text"><a href="javascript:;">&nbsp;&nbsp;&nbsp;Paparkan keseluruhan produk</a></span>
										</div>
									</div>
								</div>

								<div class="section-box wow animate__animated animate__fadeIn mt-10">
									<div class="container">
										<center>
											<div class="box-swiper" style="width: 100%">
												<div class="swiper-container swiper-group-4">
													<div class="swiper-wrapper pb-70 pt-5">

														@foreach($lkpproduk as $key => $lkpproduks)

									                        <div class="swiper-slide">
									                            <div class="card-grid-3 hover-up" style="border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
									                                <div class="text-center card-grid-3-image">
									                                    <a href="/product/{{ $lkpproduks->id }}?page=1">
									                                        <figure style="padding: 30px">

																				@forelse($lkpproduks->product_icon->where('status', 1)->take(1) as $key => $icons)
																					<img src="{!! URL::to(data_get($icons, 'path')) !!}" 
																						 alt="{{ data_get($icons, 'filename') }}" >
																				@empty
																					<img src="{{ asset('theme/assets/imgs/theme/perak/deafulticon.png') }}" 
																						 alt="{{ data_get($aktivitis, 'NamaAktiviti') }}">
																				@endforelse

									                                        </figure>
									                                    </a>
									                                </div>
									                                <div class="card-block-info">
									                                    <h5 class=" mb-15 heading-md">
									                                    	<a href="/product/{{ $lkpproduks->id }}?page=1" style="font-weight: bolder">
									                                    		{{ data_get($lkpproduks, 'description') }}
									                                    	</a>
									                                    </h5>
									                                    <!-- <div class="card-2-bottom mt-50">
									                                        <div class="row">
									                                            <div class="col-lg-12 col-12">
									                                                <a href="/product/ $lkpproduks->id }}?page=1" class="btn btn-border btn-brand-hover">
									                                                	Teruskan
									                                                </a>
									                                            </div>
									                                        </div>
									                                    </div> -->
									                                </div>
									                            </div>
									                        </div>

														@endforeach

													</div>
												</div>
												<div class="swiper-button-next"></div>
												<div class="swiper-button-prev"></div>
											</div>
										</center>
									</div>
								</div>

							</div>
						</div>
						<!-- end produk ------------------------------------------------------------------------------ -->
					</div>
				</div>
			</div>
		</section>
	<!-- produk end -->

	<!-- pautan pantas start -->
		<section class="section-box" style="margin-bottom: -45px">
			<div class="row">

				<!-- start hyperlink ------------------------------------------------------------------------------ -->
				<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-30 hover-up"> -->
					<div class="">

						<div class="section-box wow animate__animated animate__fadeIn mt-10">
							<!-- <div class="container"> -->
								<center>
									<div class="box-swiper" style="width: 95%">
										<div class="swiper-container swiper-group-5">
											<div class="swiper-wrapper pb-70 pt-5">

												<div class="swiper-slide autosizinghyperlink" onclick="show1()" style="cursor: pointer">
													<div class="card-grid-2 hover-up h-100" 
														 style="margin-bottom: 0px; padding: 5px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
														<div class="text-center card-grid-2-image">
															<a href="javascript:;">
																<figure class="">
																	<img alt="" src="{{ asset('theme/assets/imgs/theme/perak/logo-malaysia.jpg') }}" style="width: 50%" title="Portal Kerajaan Malaysia"/>
																</figure>
															</a>
														</div>
														<div class="card-block-info" style="padding: 0px !important">
															<h6 class="mt-5 heading-md">
																<a href="javascript:;" style="font-size: 14px; font-weight: bolder">
																	Portal Kerajaan Malaysia
																</a>
															</h6>
														</div>
													</div>
												</div>

												<div class="swiper-slide autosizinghyperlink" onclick="show2()" style="cursor: pointer">
													<div class="card-grid-2 hover-up h-100" 
														 style="margin-bottom: 0px; padding: 5px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
														<div class="text-center card-grid-2-image">
															<a href="javascript:;">
																<figure class="">
																	<img alt="jobhub" src="{{ asset('theme/assets/imgs/theme/perak/logo-mampu.jpg') }}" style="width: 50%" title="MAMPU"/>
																</figure>
															</a>
														</div>
														<div class="card-block-info" style="padding: 0px !important">
															<h6 class="mt-5 heading-md">
																<a href="javascript:;" style="font-size: 14px; font-weight: bolder">
																	MAMPU
																</a>
															</h6>
														</div>
													</div>
												</div>

												<div class="swiper-slide autosizinghyperlink" onclick="show3()" style="cursor: pointer">
													<div class="card-grid-2 hover-up h-100" 
														 style="margin-bottom: 0px; padding: 5px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
														<div class="text-center card-grid-2-image">
															<a href="javascript:;">
																<figure class="">
																	<img alt="jobhub" src="{{ asset('theme/assets/imgs/theme/perak/logo-mdec.jpg') }}" style="width: 50%" title="Malaysia Digital Economy Corporation"/>
																</figure>
															</a>
														</div>
														<div class="card-block-info" style="padding: 0px !important">
															<h6 class="mt-5 heading-md">
																<a href="javascript:;" style="font-size: 14px; font-weight: bolder">
																	Malaysia Digital Economy Corporation
																</a>
															</h6>
														</div>
													</div>
												</div>

												<div class="swiper-slide autosizinghyperlink" onclick="show4()" style="cursor: pointer">
													<div class="card-grid-2 hover-up h-100" 
														 style="margin-bottom: 0px; padding: 5px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
														<div class="text-center card-grid-2-image">
															<a href="javascript:;">
																<figure class="">
																	<img alt="jobhub" src="{{ asset('theme/assets/imgs/theme/perak/favicon-perak.png') }}" style="width: 12%" title="Portal Rasmi Perak"/>
																</figure>
															</a>
														</div>
														<div class="card-block-info" style="padding: 0px !important">
															<h6 class="mt-5 heading-md">
																<a href="javascript:;" style="font-size: 14px; font-weight: bolder">
																	Portal Rasmi Perak
																</a>
															</h6>
														</div>
													</div>
												</div>

												<div class="swiper-slide autosizinghyperlink" onclick="show5()" style="cursor: pointer">
													<div class="card-grid-2 hover-up h-100" 
														 style="margin-bottom: 0px; padding: 5px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
														<div class="text-center card-grid-2-image">
															<a href="javascript:;">
																<figure class="">
																	<img alt="jobhub" src="{{ asset('theme/assets/imgs/theme/perak/favicon-perak.png') }}" style="width: 12%" title="Portal Rasmi PerakGIS"/>
																</figure>
															</a>
														</div>
														<div class="card-block-info" style="padding: 0px !important">
															<h6 class="mt-5 heading-md">
																<a href="javascript:;" style="font-size: 14px; font-weight: bolder">
																	Portal Rasmi PerakGIS
																</a>
															</h6>
														</div>
													</div>
												</div>

											</div>
										</div>
										<div class="swiper-button-next"></div>
										<div class="swiper-button-prev"></div>
									</div>
								</center>
							<!-- </div> -->
						</div>

					</div>
				<!-- </div> -->
				<!-- end hyperlink ------------------------------------------------------------------------------ -->

			</div>
		</section>
    <!-- pautan pantas end -->

<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')
<script type="text/javascript">
	function show1()
	{
		window.open(
			'https://www.malaysia.gov.my/portal/index',
			'_blank' // <- This is what makes it open in a new window.
			);
	}
	function show2()
	{
		window.open(
			'https://www.mampu.gov.my/',
			'_blank' // <- This is what makes it open in a new window.
			);
	}
	function show3()
	{
		window.open(
			'https://mdec.my/',
			'_blank' // <- This is what makes it open in a new window.
			);
	}
	function show4()
	{
		window.open(
			'https://www.perak.gov.my/',
			'_blank' // <- This is what makes it open in a new window.
			);
	}
	function show5()
	{
		window.open(
			'https://www.perakgis.my/',
			'_blank' // <- This is what makes it open in a new window.
			);
	}

</script>
@endpush