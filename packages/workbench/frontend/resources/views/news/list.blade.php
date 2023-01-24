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
			<div class="box-head-single" style="background-color: #f2f2f2 !important; padding-top: 0px; padding-bottom: 0px"> <!-- #9777fa -->
				<div class="container" style="min-width: 100%">
					<div class="row">
						<div class="col-md-12 capitalall" style="text-align: center; padding-bottom: 25px">
							<b><h4 style="padding-top: 25px">
								Senarai Berita e-Perak<br/>
							</h4></b>
							<h6 style="">
								Ketahui keseluruhan berita terkini
							</h6>
						</div>
					</div>
				</div>
			</div>
		</section>
    <!-- banner end   -->

    <!-- berita start -->
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
											 <!-- Form::open()->url('/news/search')->method('POST')->class('ui form horizontal') !!} -->
											{!! form()->open()->post()->action(route('frontend.postNewsFilter'))->attribute('id', 'formnewssearch')->multipart()->horizontal() !!}

												<div class="input-group">
													<input type="text" class="form-control hover-up" placeholder="Carian..." name="searchdata">
													<!-- <input type="text" class="form-control"> -->
													
													<select class="form-control hover-up" id="tahun" style="max-width: 30%" name="searchtahun">  <!-- select-active -->
														<option value="">Tahun</option>
														@foreach($year as $key => $years)
															<option value="{{ $years->tarikh_notis_date }}">{{ $years->tarikh_notis_date }}</option>
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
                                    	@foreach($notis as $key => $notiss)
		                                    <div class="card-job hover-up wow animate__animated animate__fadeIn" onclick="window.location='/news/{{ data_get($notiss, 'id') }}';"
		                                    	 style="cursor: pointer !important;">
		                                        <div class="card-job-top">
		                                            <!-- <div class="card-job-top--image"> -->
		                                                
		                                            <!-- </div> -->
		                                            <div class="card-job-top--info">
		                                                <div class="row">
		                                                    <div class="col-lg-9">
		                                                    	<h6 class="card-job-top--info-heading"><a href="/news/{{ data_get($notiss, 'id') }}">{{ data_get($notiss, 'tajuk') }}</a></h6>
		                                                        <!-- <span class="card-job-top--location text-sm">
		                                                        	<i class="fi-rr-marker"></i> Perak
		                                                        </span>
		                                                        <span class="card-job-top--type-job text-sm">
		                                                        	<i class="fi-rr-briefcase"></i> Umum
		                                                        </span> -->
		                                                        <span class="card-job-top--post-time text-sm">
		                                                        	<i class="fi fi-rr-calendar"></i> {{ data_get($notiss, 'tarikh_notis') }}
		                                                        </span>
						                                        <div class="card-job-description mt-20" style="text-align: justify;">
						                                            {!! data_get($notiss, 'ringkasan') !!}
						                                        </div>
		                                                    </div>
		                                                    <br><br>
		                                                    <div class="col-lg-3">
		                                                    	<figure>

																	@if( data_get($notiss, 'path') )
																		@if( file_exists( public_path( data_get($notiss, 'path') ) ) )
																			<img src="{!! URL::to(data_get($notiss, 'path')) !!}" 
																				 alt="{{ data_get($notiss, 'tajuk') }}" 
																				 title="{{ data_get($notiss, 'tajuk') }}" 
																				 style="float: right; width: 150px">
																		@else
																			<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" 
																				 alt="{{ data_get($notiss, 'tajuk') }}" 
																				 title="{{ data_get($notiss, 'tajuk') }}" 
																				 style="float: right; width: 150px">
																		@endif
																	@else
																		<img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" 
																			 alt="{{ data_get($notiss, 'tajuk') }}" 
																			 title="{{ data_get($notiss, 'tajuk') }}" 
																			 style="float: right; width: 150px">
																	@endif

		                                                    	</figure>
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
                                <!-- <ul class="pager">
                                    <li><a href="#" class="pager-prev"></a></li>
                                    <li><a href="#" class="pager-number active">1</a></li>
                                    <li><a href="#" class="pager-number">2</a></li>
                                    <li><a href="#" class="pager-number">3</a></li>
                                    <li><a href="#" class="pager-number">4</a></li>
                                    <li><a href="#" class="pager-number">5</a></li>
                                    <li><a href="#" class="pager-number">6</a></li>
                                    <li><a href="#" class="pager-number">7</a></li>
                                    <li><a href="#" class="pager-next"></a></li>
                                </ul> -->
                            </div>
                        </div>
					</div>
					<div class="col-lg-1  col-md-1"></div>
				</div>
			</div>
		</section>
    <!-- berita end -->

<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')
<script type="text/javascript">


</script>
@endpush