@extends('laravolt::eperak.layouts.base')

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

<!-- start -------------------------------------------------------------------------------------------------------- -->

	<!-- banner start -->
		<section class="section-box" style="padding-top: 0px">
			<div class="box-head-single" style="background-color: #f2f2f2 !important; padding-top: 0px; padding-bottom: 0px">
				<div class="container" style="min-width: 100%">
					<div class="row">
						<div class="col-md-12" style="text-align: center; padding-bottom: 25px">
							<b><h4 style="color: white; padding-top: 25px">
								Kategori Produk Tempatan<br/>
							</h4></b>
							<h6 style="color: white">
								Terokai produk dan barangan tempatan di Perak
							</h6>
							
							<!-- <br><br> -->
							<!-- <a href="#" class="btn btn-secondary btn-shadow ml-10 hover-up">Lihat Terperinci</a> -->

						</div>
					</div>
				</div>
			</div>
		</section>
    <!-- banner end   -->

    <!-- aktiviti start -->
		<section class="section-box mt-30">
			<div class="container">
				<div class="row">
					<div class="col-lg-1  col-md-1"></div>
					<div class="col-lg-10 col-md-10 col-sm-12 col-12">

			            <div class="container">
			                <div class="row align-items-end">
			                    <div class="col-lg-6">
			                        <h3 class="section-title wow animate__animated animate__fadeInUp">Produk Tempatan</h3>
			                        <!-- <p class="text-md-lh28 color-black-5wow animate__animated animate__fadeInUp" data-wow-delay=".1s">data</p> -->
			                    </div>
			                    <div class="col-lg-6 text-xl-end text-start">
			                        <ul class="nav nav-right float-xl-end float-start" role="tablist">
			                        	@foreach($lkpproduk as $key => $lkpproduks)
				                            <li class="wow animate__animated animate__fadeIn" data-wow-delay=".1s">
				                                <button id="nav-tab-{{ data_get($lkpproduks, 'id') }}" 
				                                		type="button" role="tab" 
				                                		data-bs-toggle="tab" 
				                                		data-bs-target="#tab-{{ data_get($lkpproduks, 'id') }}" 
				                                		aria-controls="tab-{{ data_get($lkpproduks, 'id') }}" 
				                                		aria-selected="true">
				                                	{{ data_get($lkpproduks, 'description') }}
				                                </button>
				                            </li>
				                        @endforeach
			                        </ul>
			                    </div>
			                </div>
			                <div class="mt-35">
			                    <div class="tab-content" id="myTabContent-1">
			                    	@foreach($lkpproduk as $key => $lkpproduks)
				                        <div class="tab-pane fade show active autosizing" id="tab-{{ data_get($lkpproduks, 'id') }}" role="tabpanel" aria-labelledby="tab-{{ data_get($lkpproduks, 'id') }}">
				                            <div class="row">

				                                @foreach($produk->take(9) as $key => $value)
													<div class="col-lg-4 col-md-12 col-sm-12 col-12 mt-10 hover-up" id="cardproduk">
														<div class="sidebar-shadow h-100">
															<div class="sidebar-heading">
																<div class="avatar-sidebar">
																	<div class="sidebar-info">
																		<span class="sidebar-company">
																			<h4><a href="javascript:;">{{ data_get($value, 'NamaProduk', 'NAMA PRODUK') }}</a></h4>
																		</span>
																	</div>
																	<div class="sidebar-list-job" style="padding-top: 15px">
																		<span class="card-job-top--post-time text-md">
																			&nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;{{ data_get($value, 'pengeluar.NamaSyarikat', 'Nama Pengeluar') }}
																		</span><br>
																	</div>
																	<div class="sidebar-list-job" style="padding-top: 15px">
																		<span class="card-job-top--post-time text-md">
																			&nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;{{ data_get($value, 'Keterangan', 'Keterangan') }}
																		</span><br>
																	</div>
																	<div class="sidebar-list-job" style="padding-top: 15px">
																		<span class="card-job-top--post-time text-md">
																			&nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;{{ data_get($value, 'jenisproduk.description', 'Jenis Produk') }}
																		</span><br>
																	</div>
																	<div class="sidebar-list-job" style="padding-top: 15px">
																		<span class="card-job-top--post-time text-md">
																			&nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;{{ data_get($value, 'pengeluar.mediasosial.description', 'Media Sosial') }}
																		</span><br>
																	</div>
																	<div class="sidebar-list-job" style="padding-top: 15px">
																		<span class="card-job-top--post-time text-md">
																			&nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;{{ data_get($value, 'pengeluar.LinkMediaSosial', 'Link Media Sosial') }}
																		</span><br>
																	</div>
																</div>
															</div>
														</div>
													</div>
												@endforeach

				                            </div>
				                        </div>
			                        @endforeach

			                    </div>
			                </div>
			            </div>


					</div>
					<div class="col-lg-1  col-md-1"></div>
				</div>
			</div>
		</section>

        <section class="section-box mt-40">
        </section>
    <!-- aktiviti end -->

<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')
<script type="text/javascript">


</script>
@endpush