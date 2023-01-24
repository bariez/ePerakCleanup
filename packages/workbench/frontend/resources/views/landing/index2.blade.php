@extends('laravolt::eperak.layouts2.base')

@section('content')
<!-- start-------------------------------------------------------------------------------------------------------- -->

@push('style')
<style type="text/css">
	.autosizing 
	{ 
		height: auto; 
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
											<a target="_blank" href="{!! URL::to(data_get($banners, 'path')) !!}">
												<img src="{!! URL::to(data_get($banners, 'path')) !!}" alt="{{ data_get($banners, 'filename') }}" width="100%" height="100%">
											</a>
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

    <!-- berita n aktiviti start -->
	    <section class="section-box">
			<div class="container">
				<div class="autosizing">
					<div class="row">
						<!-- senarai berita -->
						<div class="col-lg-6 col-md-12 col-sm-12 col-12 pr-15 mt-30 hover-up">
							<div class="sidebar-shadow h-100 shadow-lg" style="">
								<div class="sidebar-heading">
									<div class="avatar-sidebar">
										<figure>
											<img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/news.png') }}" />
										</figure>
										<div class="sidebar-info">
											<span class="sidebar-company">&nbsp;&nbsp;Berita e-Perak</span>
											<span class="sidebar-website-text">&nbsp;&nbsp;&nbsp;Ketahui keseluruhan berita terkini demo 2</span>
											<div class="dropdowm">
												<button class="btn btn-dots btn-dots-abs-right dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
												<ul class="dropdown-menu dropdown-menu-light">
													<!-- <li> -->
														<a href="news?page=1" class="dropdown-item" >Senarai Berita</a>
													<!-- </li> -->
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="sidebar-list-job" style="min-height: 430px;">  <!-- overflow: auto; -->
									<ul>
										@foreach($notis as $key => $notiss)
											<li>
												<div class="sidebar-text-info">

													<div class="row hover-up">
														<div class="col-lg-4 col-md-4 col-sm-4 col-4">
															<a href="/news/{{ data_get($notiss, 'id') }}">
																<img src="{!! URL::to(data_get($notiss, 'path')) !!}" alt="{{ data_get($notiss, 'filename') }}" >
															</a>
														</div>

														<div class="col-lg-8 col-md-8 col-sm-8 col-8">
															<strong class="small-heading pt-0 mb-10">
																<a href="/news/{{ data_get($notiss, 'id') }}" style="text-transform: uppercase;">
																	{{ data_get($notiss, 'tajuk') }}
																</a>
															</strong>
															<span class="text-description">
																{{ data_get($notiss, 'ringkasan') }}
															</span>
															<span class="text-description"><i class="fi fi-rr-calendar"></i>
																<span class="ml-5">{{ data_get($notiss, 'tarikh_notis') }}</span>
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

						<!-- senarai aktiviti -->
						<div class="col-lg-6 col-md-12 col-sm-12 col-12 pl-15 mt-30 hover-up">
							<div class="sidebar-shadow h-100 shadow-lg" style="">
								<div class="sidebar-heading">
									<div class="avatar-sidebar">
										<figure>
											<img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/activity.png') }}" />
										</figure>
										<div class="sidebar-info">
											<span class="sidebar-company">&nbsp;&nbsp;Aktiviti e-Perak</span>
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
										@foreach($aktiviti->take(4) as $key => $aktivitis)
											<li>
												<div class="sidebar-text-info">

													<div class="row hover-up">
														<div class="col-lg-4 col-md-4 col-sm-4 col-4">

															<!-- if( file_exists( public_path( data_get($aktivitis, 'Gambar_path') ) ) ) -->
															@if( $aktivitis->Gambar_path )
																<a href="/activity/{{ data_get($aktivitis, 'id') }}">
																	<img src="{!! URL::to(data_get($aktivitis, 'Gambar_path')) !!}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" >
																</a>
															@else
																<a href="/activity/{{ data_get($aktivitis, 'id') }}">
																	<img src="{{ asset('logo.png') }}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" style="width: 100px">
																</a>
															@endif

														</div>

														<div class="col-lg-8 col-md-8 col-sm-8 col-8">
															<strong class="small-heading pt-0 mb-10">
																<a href="/activity/{{ data_get($aktivitis, 'id') }}">
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

						<!-- senarai produk -->
						<div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-30 hover-up">
							<div class="sidebar-shadow shadow-lg mb-40">
								<div class="sidebar-heading">
									<div class="avatar-sidebar">
										<figure>
											<img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/product.png') }}" />
										</figure>
										<div class="sidebar-info">
											<span class="sidebar-company">&nbsp;&nbsp;Kategori Produk Tempatan</span>
											<span class="sidebar-website-text"><a href="/product">&nbsp;&nbsp;&nbsp;Paparkan keseluruhan produk</a></span>
										</div>
									</div>
								</div>

								<div class="section-box wow animate__animated animate__fadeIn mt-10">
									<div class="container">
										<center>
											<div class="box-swiper" style="width: 75%">
												<div class="swiper-container swiper-group-4">
													<div class="swiper-wrapper pb-70 pt-5">

														@foreach($lkpproduk as $key => $lkpproduks)
															<!-- <div class="swiper-slide hover-up">
																<div class="item-logo">
																	<a href="/product">
																		<img class="p-65" src=" URL::to(data_get($lkpproduks, 'product_icon.path')) !!}" 
																			 alt=" data_get($lkpproduks, 'product_icon.filename') }}" >
																		 data_get($lkpproduks, 'description') }} <br> <br>
																	</a>
																</div>
															</div> -->

									                        <div class="swiper-slide">
									                            <div class="card-grid-3 hover-up">
									                                <div class="text-center card-grid-3-image">
									                                    <a href="/product/{{ $lkpproduks->id }}">
									                                        <figure>
									                                        	<img src="{!! URL::to(data_get($lkpproduks, 'product_icon.path')) !!}" 
									                                        		 alt="{{ data_get($lkpproduks, 'product_icon.filename') }}" >
									                                        </figure>
									                                    </a>
									                                </div>
									                                <div class="card-block-info">
									                                    <h5 class="mt-15 heading-md">
									                                    	<a href="/product/{{ $lkpproduks->id }}">
									                                    		{{ data_get($lkpproduks, 'description') }}
									                                    	</a>
									                                    </h5>
									                                    <div class="card-2-bottom mt-50">
									                                        <div class="row">
									                                            <div class="col-lg-12 col-12">
									                                                <a href="/product/{{ $lkpproduks->id }}" class="btn btn-border btn-brand-hover">
									                                                	Teruskan
									                                                </a>
									                                            </div>
									                                        </div>
									                                    </div>
									                                </div>
									                            </div>
									                        </div>

														@endforeach

														<!-- <div class="swiper-slide hover-up">
															<div class="item-logo">
																<a href="/product">
																	<img class="p-65" alt="jobhub" src="{{ asset('theme/assets/imgs/theme/perak/service.png') }}" />
																	Perkhidmatan <br> <br>
																</a>
															</div>
														</div>

														<div class="swiper-slide hover-up">
															<div class="item-logo">
																<a href="/product">
																	<img class="p-65" alt="jobhub" src="{{ asset('theme/assets/imgs/theme/perak/health.png') }}" />
																	Kesihatan <br> <br>
																</a>
															</div>
														</div>

														<div class="swiper-slide hover-up">
															<div class="item-logo">
																<a href="/product">
																	<img class="p-65" alt="jobhub" src="{{ asset('theme/assets/imgs/theme/perak/craft.png') }}" />
																	Kraf Tangan <br> <br>
																</a>
															</div>
														</div> -->

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
					</div>
				</div>
			</div>
		</section>
	<!-- berita n aktiviti end   -->

<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')
<script type="text/javascript">
	
</script>
@endpush