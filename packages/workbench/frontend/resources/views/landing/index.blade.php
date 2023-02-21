@extends('laravolt::eperak.layouts.base')

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
	.capitalall
	{
		text-transform: uppercase;
	}

    #viewDiv {
      padding: 0;
      margin: 0;
      height: 100%;
      width: 100%;
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
													<center style="background-color: white;">
														<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($banners, 'filename') }}" style="max-height: 250px" title="{{ data_get($banners, 'tajuk') }}">
													</center>
												@endif
											@else
												<center style="background-color: white;">
													<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($banners, 'filename') }}" style="max-height: 250px" title="{{ data_get($banners, 'tajuk') }}">
												</center>
											@endif

										</div>
									@endforeach
								</div>
							</div>
							<div class="swiper-button-next" id="next-banner" style="margin-right: 68px; margin-top: -25px;"></div>
							<div class="swiper-button-prev" id="prev-banner" style="margin-left: 68px; margin-top: -25px;"></div>
						</div>
					</center>
				</div>
			</div>
		</section>
	<!-- banner end   -->

	<!-- peta n notis start  -->
		<section class="section-box">
			<div class="container autosizing" style="">
				<div class="row">
					<!-- peta  start  -->
					<div class="col-lg-9 col-md-9 col-sm-12 col-12" style="">
						<div class="container" style="padding-right: 0px; padding-left: 0px">
							<div class="row">
								<div class="col-xl-12 col-lg-12 m-auto">
									<section class="">
										<div class="row">
											<div class="col-xl-12 col-md-12 mx-auto">
												<div class="contact-from-area padding-20-row-col">
													<h4 class="section-title mt-15 mb-5 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s"
														style="color: white; text-shadow: 2px 2px #000000;">
														<span style="color: white">PETA</span>
													</h4>
													<!-- <p class="mb-30 font-md text-center wow animate__ animate__fadeInUp animated capitalall" data-wow-delay=".3s"
													   style="color: white; text-shadow: 1px 1px #000000;">
														Peta interaktif portal e-Perak
													</p> -->
												</div>
											</div>
										</div>
									</section>
								</div>
							</div>
						</div>
						<div class="container h-100" style="padding-right: 0px; padding-left: 0px">
							<div class="autosizingnotis">
								<div class="mt-10">
									<div class="fade show active">
										<div class="row">

                                            <div id="searchpapar" style="">

                                            </div>

                                            <div class="row" id="loadingpapar" style="display: none; margin-left: 0px;margin-right: 0px;">
                                                <center>
                                                    <img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
                                                </center>
                                            </div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- peta end -->

					<!-- notis start  -->
						@if($notis->count() != 0)
						<div class="col-lg-3 col-md-3 col-sm-12 col-12">
							<div class="container" style="padding-right: 0px; padding-left: 0px">
								<div class="row">
									<div class="col-xl-12 col-lg-12 m-auto">
										<section class="">
											<div class="row">
												<div class="col-xl-12 col-md-12 mx-auto">
													<div class="contact-from-area padding-20-row-col">
														<h4 class="section-title mt-15 mb-5 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s"
															style="color: white; text-shadow: 2px 2px #000000;">
															<div class="hover-up">
																<a href="news?page=1" style="color: white" class="" title="Senarai Berita e-Perak">BERITA</a>
															</div>
														</h4>
														<!-- <p class="mb-30 font-md text-center wow animate__ animate__fadeInUp animated capitalall" data-wow-delay=".3s"
														   style="color: white; text-shadow: 1px 1px #000000;">
															Ketahui keseluruhan berita terkini
														</p> -->
													</div>

														<!-- <div class="card-grid-3" style="background: none; border: none">
						                                    <h5 class="heading-md" style="color: white; text-shadow: 1px 1px #FFFFFF;">
						                                    	<a href="news?page=1" style="font-weight: bolder; ">
						                                    		BERITA
						                                    	</a>
						                                    </h5>
							                            </div> -->

												</div>
											</div>
										</section>
									</div>
								</div>
							</div>


							<div class="container h-100" style="padding-right: 0px; padding-left: 10px">
								<div class="autosizingnotis">
									<div class="mt-10">
										<div class="fade show active">
											<div class="row">

												<div class="box-swiper">
													<div class="swiper-container swiper-group-notis">
														<div class="swiper-wrapper">

															<!-- --------------------------------------------- -->
															@foreach($notis as $key => $notiss)
																
																<div class="swiper-slide">
																	<div class="col-lg-12 col-md-12 col-sm-12 col-12 wow animate__animated animate__fadeInUp hover-up" 
																		 data-wow-delay=".5s" 
																		 onclick="location.href = '/news/{{ data_get($notiss, 'id') }}';"
																		 style="cursor: pointer">
																		<div class="card-grid-2 h-100" style="border-top-width: 0px; border-left-width: 0px; border-right-width: 0px; border-bottom-width: 10px;">
																			<div class="text-center card-grid-2-image">
																				<a href="javascript:;">
																					<figure>

																						@if( data_get($notiss, 'path') )
																							@if( file_exists( public_path( data_get($notiss, 'path') ) ) )
																								<img src="{!! URL::to(data_get($notiss, 'path')) !!}" alt="{{ data_get($notiss, 'filename') }}" title="{{ data_get($notiss, 'tajuk') }}"
																									 style="height: 200px !important">
																							@else
																								<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($notiss, 'filename') }}" title="{{ data_get($notiss, 'tajuk') }}"
																									 style="height: 50% !important; width: 50% !important">
																							@endif
																						@else
																							<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($notiss, 'filename') }}" title="{{ data_get($notiss, 'tajuk') }}"
																								 style="height: 50% !important; width: 50% !important">
																						@endif

																					</figure>
																				</a>
																			</div>
																			<div class="card-block-info" style="padding-top: 5px; padding-bottom: 5px"><!-- min-height: 210px !important -->
																				<h6 class="">
																					<a href="javascript:;">
																						{{ data_get($notiss, 'tajuk') }}
																					</a>
																				</h6>
																				<div class="row">
																					<a href="javascript:;" class="">
																						<span>
																							{{ data_get($notiss, 'ringkasan') }}
																						</span>
																					</a>
																				</div>
																				<div class="card-2-bottom mt-30 mb-30">
																					<div class="row ml-0">
																						<!-- <div class="col-lg-5 col-5"> -->
																							<span class="card-calender">{{ data_get($notiss, 'tarikh_notis') }}</span>
																						<!-- </div> -->
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
													<div class="swiper-button-next" id="next-notis"></div>
													<div class="swiper-button-prev" id="prev-notis"></div>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>



						</div>
						@else
						@endif
					<!-- notis end  -->
				</div>
			</div>
		</section>
	<!-- peta n notis end  -->

	<!-- produk n aktiviti start -->
		<section class="section-box">  <!-- pb-70 -->
			<div class="container">
				<div class="autosizing">
					<div class="row">

						<!-- start aktiviti ------------------------------------------------------------------------------ -->
							<div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-5 wow animate__animated animate__fadeInUp pb-70" data-wow-delay=".5s">
								<div class="container" style="padding-right: 0px; padding-left: 0px">
									<div class="row">
										<div class="col-xl-10 col-lg-12 m-auto">
											<section class="">
												<div class="row">
													<div class="col-xl-12 col-md-12 mx-auto">
														<div class="contact-from-area padding-20-row-col">
															<h4 class="section-title mt-15 mb-5 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s"
																style="color: white; text-shadow: 2px 2px #000000;">
																<div class="hover-up">
																	<a class="" href="activity?page=1" style="color: white"  title="Senarai Aktiviti e-Perak">AKTIVITI</a>
																</div>
															</h4>
															<!-- <p class="mb-30 font-md text-center wow animate__ animate__fadeInUp animated capitalall" data-wow-delay=".3s"
															   style="color: white; text-shadow: 1px 1px #000000;">
																Terokai aktiviti dan pengalaman terbaru
															</p> -->
														</div>
													</div>
												</div>
											</section>
										</div>
									</div>
								</div>
								<div class="sidebar-shadow shadow-lg mt-10 wow animate__animated animate__fadeInUp" data-wow-delay=".5s" style="padding-top: 0px !important; padding-bottom: 0px !important"> <!-- h-100 -->
									<div class="sidebar-heading">
										<div class="avatar-sidebar">
											<!-- <figure>
												<img alt="e-Perak" src=" asset('theme/assets/imgs/theme/perak/activity.png') }}" />
											</figure>
											<div class="sidebar-info">
												<span class="sidebar-company">&nbsp;&nbsp;AKTIVITI e-PERAK</span>
												<span class="sidebar-website-text capitalall">&nbsp;&nbsp;&nbsp;</span>
												<div class="dropdowm">
													<button class="btn btn-dots btn-dots-abs-right dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
													<ul class="dropdown-menu dropdown-menu-light">
														<li>
															<a href="activity?page=1" class="dropdown-item" >Senarai Aktiviti</a>
														</li>
													</ul>
												</div>
											</div> -->
										</div>
									</div>

									<div class="sidebar-list-job" style="border-top: 0px; padding-top: 0px; margin-top: 0px">  <!-- overflow: auto; min-height: 430px; -->
										<ul>
											@foreach($aktiviti->take(3) as $key => $aktivitis)
												<li>
													<div class="sidebar-text-info">

														<div class="row hover-up"  onclick="location.href = '/activity/{{ data_get($aktivitis, 'id') }}';" style="cursor: pointer">
															<div class="col-lg-4 col-md-4 col-sm-4 col-4">

																@if( data_get($aktivitis, 'Gambar_path') )
																	@if( file_exists( public_path( data_get($aktivitis, 'Gambar_path') ) ) )
																		<a href="javascript:;">
																			<img src="{!! URL::to(data_get($aktivitis, 'Gambar_path')) !!}"
																				 alt="{{ data_get($aktivitis, 'NamaAktiviti') }}"
																				 title="{{ data_get($aktivitis, 'NamaAktiviti') }}" 
																				 style="width: 160px; height: 115px; object-fit: cover;">
																		</a>
																	@else
																		<a href="javascript:;">
																			<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" title="{{ data_get($aktivitis, 'NamaAktiviti') }}" style="width: 100px">
																		</a>
																	@endif
																@else
																	<a href="javascript:;">
																		<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" title="{{ data_get($aktivitis, 'NamaAktiviti') }}" style="width: 100px">
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

						<!-- start produk ------------------------------------------------------------------------------ -->
						<div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-5 wow animate__animated animate__fadeInUp pb-70" data-wow-delay=".5s">
							<div class="container" style="padding-right: 0px; padding-left: 0px">
								<div class="row">
									<div class="col-xl-12 col-lg-12 m-auto">
										<section class="">
											<div class="row">
												<div class="col-xl-12 col-md-12 mx-auto">
													<div class="contact-from-area padding-20-row-col">
														<h4 class="section-title mt-15 mb-5 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s"
															style="color: white; text-shadow: 2px 2px #000000;">
															<span style="color: white">PRODUK TEMPATAN</span>
														</h4>
														<!-- <p class="mb-30 font-md text-center wow animate__ animate__fadeInUp animated capitalall" data-wow-delay=".3s"
														   style="color: white; text-shadow: 1px 1px #000000;">
															Terokai aktiviti dan pengalaman terbaru
														</p> -->
													</div>
												</div>
											</div>
										</section>
									</div>
								</div>
							</div>
							<div class="mt-10 wow animate__animated animate__fadeInUp" data-wow-delay=".5s" style="padding-top: 0px !important; padding-bottom: 0px !important"> <!-- sidebar-shadow shadow-lg h-100 -->
								<div class="sidebar-heading">
									<div class="avatar-sidebar">
										<!-- <figure>
											<img alt="e-Perak" src=" asset('theme/assets/imgs/theme/perak/product.png') }}" />
										</figure> -->
										<!-- <div class="sidebar-info"> -->
											<!-- <span class="sidebar-company">&nbsp;&nbsp;KATEGORI PRODUK TEMPATAN</span> -->
											<!-- <span class="sidebar-website-text capitalall"><a href="javascript:;">&nbsp;&nbsp;&nbsp;</a></span> -->
										<!-- </div> -->
									</div>
								</div>

								<div class="section-box wow animate__animated animate__fadeIn wow animate__animated animate__fadeInUp" data-wow-delay=".7s"> <!-- mt-10 -->
									<div class="container">
										<center>
											<div class="box-swiper" style="width: 100%">
												<div class="swiper-container swiper-group-2">
													<div class="swiper-wrapper"> <!-- pt-5 pb-70 -->

														@foreach($lkpproduk->take(2) as $key => $lkpproduks)

									                        <div class="swiper-slide">
									                            <div class="card-grid-3 hover-up" style="border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
									                                <div class="text-center card-grid-3-image">
									                                    <a href="/product/{{ $lkpproduks->id }}?page=1">
									                                        <figure style="padding: 25px">

																				@forelse($lkpproduks->product_icon->where('status', 1)->take(1) as $key => $icons)
																					<img src="{!! URL::to(data_get($icons, 'path')) !!}"
																						 alt="{{ data_get($icons, 'filename') }}" 
																						 style="width: 40%">
																				@empty
																					<img src="{{ asset('theme/assets/imgs/theme/perak/deafulticon.png') }}"
																						 alt="{{ data_get($aktivitis, 'NamaAktiviti') }}"
																						 style="width: 40%">
																				@endforelse

									                                        </figure>
									                                    </a>
									                                </div>
									                                <div class="card-block-info">
									                                    <h5 class="heading-md">
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

												<div class="swiper-container swiper-group-2">
													<div class="swiper-wrapper mt-15"> <!-- pt-5 -->

														@foreach($lkpproduk->skip(2) as $key => $lkpproduks)

									                        <div class="swiper-slide">
									                            <div class="card-grid-3 hover-up" style="border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
									                                <div class="text-center card-grid-3-image">
									                                    <a href="/product/{{ $lkpproduks->id }}?page=1">
									                                        <figure style="padding: 25px">

																				@forelse($lkpproduks->product_icon->where('status', 1)->take(1) as $key => $icons)
																					<img src="{!! URL::to(data_get($icons, 'path')) !!}"
																						 alt="{{ data_get($icons, 'filename') }}" 
																						 style="width: 40%">
																				@empty
																					<img src="{{ asset('theme/assets/imgs/theme/perak/deafulticon.png') }}"
																						 alt="{{ data_get($aktivitis, 'NamaAktiviti') }}"
																						 style="width: 40%">
																				@endforelse

									                                        </figure>
									                                    </a>
									                                </div>
									                                <div class="card-block-info">
									                                    <h5 class="heading-md">
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
												<div class="swiper-button-next" id="next-produk" style="margin-top: -20px"></div>
												<div class="swiper-button-prev" id="prev-produk" style="margin-top: -20px"></div>
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
	<!-- produk n aktiviti end   -->

	<!-- pautan pantas start -->
		<section class="section-box" style="margin-bottom: -60px">
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
										<div class="swiper-button-next" id="next-pautan"></div>
										<div class="swiper-button-prev" id="prev-pautan"></div>
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

	$(document).ready(function ()
    {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/ajax/mapinfo')}}",
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
