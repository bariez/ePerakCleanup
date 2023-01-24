@extends('laravolt::eperak.layouts.base')

@section('content')

<!-- start-------------------------------------------------------------------------------------------------------- -->

@push('style')
<style type="text/css">

	.select2-container--default
	{
		/*padding: 11px 15px 13px 15px !important;*/
		border: 1px solid rgba(6, 18, 36, 0.1) !important;
		width: 20% !important;

	}
	.capitalall
	{
		text-transform: uppercase;
	}

</style>
@endpush

<!-- start -------------------------------------------------------------------------------------------------------- -->

	<!-- banner start -->
		<section class="section-box" style="padding-top: 0px">
			<div class="box-head-single" style="background-color: #f2f2f2 !important; padding-top: 0px; padding-bottom: 0px"> <!-- #9777fa #648CC9 -->
				<div class="container" style="min-width: 100%">
					<div class="row">
						<div class="col-md-12 capitalall" style="text-align: center; padding-bottom: 25px">
							<b><h4 style="color: black; padding-top: 25px">
								Aktiviti e-Perak<br/>
							</h4></b>
							<h6 style="color: black">
								Terokai aktiviti dan pengalaman terbaru
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
		<section class="section-box">
			<div class="container mt-15">
				<div class="row flex-row-reverse">

					<div class="col-lg-1  col-md-1"></div>
					<div class="col-lg-10 col-md-10 col-sm-12 col-12">

                        <div class="content-page">
                            <div class="job-list-list mb-15">

                            	<div class="list-recent-jobs">
                                    <div class="card-job wow animate__animated animate__fadeIn">
                                        <div class="card-job-top">

											<!-- carian here --------------------------- -->
											 <!-- Form::open()->url('/activity/search')->method('POST')->class('ui form horizontal') !!} -->
											{!! form()->open()->post()->action(route('frontend.postActivityFilter'))->attribute('id', 'formactivitysearch')->multipart()->horizontal() !!}

												<div class="input-group">
													<input type="text" class="form-control hover-up" placeholder="Carian..." name="searchdata">
													<!-- <input type="text" class="form-control"> -->
													
													<select class="form-control hover-up" id="tahun" style="max-width: 30%" name="searchtahun">  <!-- select-active -->
														<option value="">Tahun</option>
														@foreach($year as $key => $years)
															<option value="{{ $years->Tahun }}">{{ $years->Tahun }}</option>
														@endforeach
													</select>
													<div class="input-group-append">
														<div class="btn-group" role="group" aria-label="Basic example">
															<button type="submit" class="btn btn-default btn-shadow hover-up" 
																	style="color: white; background-color: #432712; border-radius: 0px  10px 10px 0px; height: 50px ">
																Carian
															</button>
															
														</div>
													</div>
												</div>

											{!! Form::close() !!}
											<!-- carian end --------------------------- -->
										</div>
									</div>
								</div>

                                <div class="list-recent-jobs">
                                    <!-- Item job -->
	                                    @foreach($aktiviti as $key => $aktivitis)
		                                    <div class="card-job hover-up wow animate__animated animate__fadeIn" onclick="window.location='/activity/{{ data_get($aktivitis, 'id') }}';" 
		                                    	 style="cursor: pointer !important;">
		                                        <div class="card-job-top">
		                                            <!-- <div class="card-job-top--image"> -->
		                                                
		                                            <!-- </div> -->
		                                            <div class="card-job-top--info">
		                                                <div class="row">
		                                                    <div class="col-lg-9">
		                                                    	<h6 class="card-job-top--info-heading"><a href="/activity/{{ data_get($aktivitis, 'id') }}">{{ data_get($aktivitis, 'NamaAktiviti') }}</a></h6>
		                                                        <span class="card-job-top--post-time text-sm">
		                                                        	<i class="fi fi-rr-paper-plane"></i>{{ data_get($aktivitis, 'kategori.description') }}
		                                                        </span>
		                                                        <span class="card-job-top--post-time text-sm">
		                                                        	<i class="fi fi-rr-marker"></i>{{ data_get($aktivitis, 'kampung.NamaKampung') }}
		                                                        </span>
		                                                        <span class="card-job-top--post-time text-sm">
		                                                        	<i class="fi fi-rr-calendar"></i>{{ data_get($aktivitis, 'Tahun') }}
		                                                        </span>
						                                        <div class="card-job-description mt-20" style="text-align: justify;">
						                                            {{ data_get($aktivitis, 'Keterangan') }}
						                                        </div>
		                                                    </div>
		                                                    <br><br>
		                                                    <div class="col-lg-3">

																@if( data_get($aktivitis, 'Gambar_path') )
																	@if( file_exists( public_path( data_get($aktivitis, 'Gambar_path') ) ) )
																		<img src="{!! URL::to(data_get($aktivitis, 'Gambar_path')) !!}" 
																			 alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" 
																			 title="{{ data_get($aktivitis, 'NamaAktiviti') }}" 
																			 style="float: right; width: 150px">
																	@else
																		<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" 
																			 alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" 
																			 title="{{ data_get($aktivitis, 'NamaAktiviti') }}" 
																			 style="float: right; width: 150px">
																	@endif
																@else
																	<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" 
																		 alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" 
																		 title="{{ data_get($aktivitis, 'NamaAktiviti') }}" 
																		 style="float: right; width: 150px">
																@endif

		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                @endforeach
                                    <!-- End item job -->
                                </div>
                            </div>
                            <div class="paginations">
                                {!! $paginated !!}
                            </div>
                        </div>
					</div>
					<div class="col-lg-1  col-md-1"></div>
				</div>
			</div>
		</section>
    <!-- aktiviti end -->

<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')
<script type="text/javascript">
	// $('select').select2();

</script>
@endpush