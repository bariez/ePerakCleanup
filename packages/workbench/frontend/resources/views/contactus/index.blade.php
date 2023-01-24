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
								Hubungi Kami<br/>
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

	<!-- accordion start -->

		<div class="container mt-md-30">
			<div class="row">
				<div class="col-xl-12 col-lg-12 m-auto">
					<section class="mb-50">

						<div class="row">
							<div class="col-xl-12 col-md-12 mx-auto">
								<div class="contact-from-area padding-20-row-col">
									<div class="row mt-50">

										<div class="col-md-12 mt-sm-10 wow animate__animated animate__fadeInUp" data-wow-delay=".5s" style="padding-top: 0px; padding-bottom: 20px">
											<center>
												<span style="color: white; text-shadow: 2px 2px #000000; padding-bottom: 50px; font-size: 35px; font-weight: bolder">
													<span style=" text-decoration: underline solid #404040; text-decoration-thickness: 5px; ">
														ALAMAT 
													</span>
													<span style=" text-decoration: underline solid #fefefe; text-decoration-thickness: 5px; ">
														DAN
													</span>
													<span style=" text-decoration: underline solid #ffd248; text-decoration-thickness: 5px; ">
														LOKASI
													</span>
												</span>
											</center>
										</div>

										<div class="col-md-2 mt-sm-30 wow animate__animated animate__fadeInUp" data-wow-delay=".5s" style="padding-top: 18px">
											<center>
												<img src="{{ asset('logo.png') }}" alt="e-Perak" title="e-Perak" style="">
											</center>
										</div>

										<div class="col-md-4 mt-sm-30 wow animate__animated animate__fadeInUp" data-wow-delay=".5s">

											<!-- <img alt="e-Perak" src=" asset('theme/assets/imgs/theme/perak/contactaddress.png') }}" style="width: 60px"/> -->
											<p class="mb-0 font-lg" style="color: white; text-shadow: 0 0 4px #000000; line-height: 2.0; font-weight: bolder; font-size: 30px">
												PERAKGIS
											</p>
											<p class="mb-0 font-lg" style="color: white; text-shadow: 0 0 4px #000000; line-height: 2.0; font-weight: bold;">
												<span class="test">{{ data_get($contactus, 'alamat') }}</span>
											</p>
											<p class="mb-0 font-lg" style="color: white; text-shadow: 0 0 4px #000000; line-height: 2.0; font-weight: bold;">
												TEL: {{ data_get($contactus, 'no_tel') }}
											</p>
											<p class="mb-0 font-lg" style="color: white; text-shadow: 0 0 4px #000000; line-height: 2.0; font-weight: bold;">
												FAKS: {{ data_get($contactus, 'no_faks') }}
											</p>
											<p class="mb-0 font-lg" style="color: white; text-shadow: 0 0 4px #000000; line-height: 2.0; font-weight: bold;">
												EMEL: {{ data_get($contactus, 'email') }}
											</p>

										</div>

										<div class="col-md-6 mt-sm-30 wow animate__animated animate__fadeInUp" data-wow-delay=".5s" style="padding-top: 18px">
											<div class="border-radius-15 overflow-hidden">
												<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.5982826947693!2d101.07120711523103!3d4.665491543259772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31ca936188a5de05%3A0xe8ee21bd65c10ee7!2sPerakGIS!5e0!3m2!1sen!2smy!4v1663662757322!5m2!1sen!2smy" width="100%" height="450" style="border: 2;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
													
												</iframe>
											</div>
										</div>


									</div>
								</div>
							</div>
						</div>

					</section>
				</div>
			</div>
		</div>

		<!-- <div class="container wide pb-50 mt-20">
			<div class="border-radius-15 overflow-hidden">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.5982826947693!2d101.07120711523103!3d4.665491543259772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31ca936188a5de05%3A0xe8ee21bd65c10ee7!2sPerakGIS!5e0!3m2!1sen!2smy!4v1663662757322!5m2!1sen!2smy" width="100%" height="450" style="border: 2;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
					
				</iframe>
			</div>
		</div> -->

		

		<!-- <div class="container mt-md-30"> -->
			<!-- <div class="row"> -->
				<!-- <div class="col-xl-10 col-lg-12 m-auto"> -->
					<!-- <section class="mb-50"> -->
						<!-- <h5 class="text-blue text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Get in Touch</h5> -->
						<!-- <h3 class="section-title w-75 w-md-100 mb-50 mt-15 text-center mx-auto wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
							You are always welcome to visit our little studio
						</h3>
						<div class="row mb-60">
							<div class="col-md-4 mb-4 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
								<h5 class="mb-15">Office</h5>
								205 North Michigan Avenue, Suite 810<br />Chicago, 60601, USA<br />
								<abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
								<abbr title="Email">Email: </abbr>contact@jubhub.com<br />
								<a class="btn btn-default btn-small font-weight-bold text-white mt-20 border-radius-5 btn-shadow-brand hover-up"><i class="fi-rs-marker mr-5"></i>View map</a>
							</div>
						</div> -->
						<!-- <div class="row">
							<div class="col-xl-9 col-md-12 mx-auto">
								<div class="contact-from-area padding-20-row-col">
									 <h5 class="text-blue text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">Send Message</h5> 
									<h2 class="section-title mt-15 mb-10 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s" style="color: white; text-shadow: 2px 2px #000000;">Hubungi Kami</h2>
									<div class="row mt-50">
										<div class="col-md-4 mt-sm-30 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
											<img alt="e-Perak" src=" asset('theme/assets/imgs/theme/perak/contactaddress.png') }}" style="width: 60px"/>
											<p class="text-muted font-md mb-10" style="color: white; text-shadow: 2px 2px #000000;"><b>Alamat</b></p>
											<p class="mb-0 font-lg" style="color: white; text-shadow: 2px 2px #000000;">
												 data_get($contactus, 'alamat') }}
											</p>
										</div>
										<div class="col-md-4 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
											<img alt="e-Perak" src=" asset('theme/assets/imgs/theme/perak/contactphone.png') }}" style="width: 60px"/>
											<p class="text-muted font-md mb-10" style="color: white; text-shadow: 2px 2px #000000;"><b>No Tel & Faksimili</b></p>
											<p class="mb-0 font-lg" style="color: white; text-shadow: 2px 2px #000000;">
												 data_get($contactus, 'no_tel') }} <br>
												 data_get($contactus, 'no_faks') }}
											</p>
										</div>
										<div class="col-md-4 mt-sm-30 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
											<img alt="e-Perak" src=" asset('theme/assets/imgs/theme/perak/contactemail.png') }}" style="width: 60px"/>
											<p class="text-muted font-md mb-10" style="color: white; text-shadow: 2px 2px #000000;">Emel</p>
											<p class="mb-0 font-lg" style="color: white; text-shadow: 2px 2px #000000;">
												 data_get($contactus, 'email') }}
											</p>
										</div>
									</div>
								</div>
							</div>
						</div> -->
					<!-- </section> -->
				<!-- </div> -->
			<!-- </div> -->
		<!-- </div> -->
	<!-- accordion end   -->




<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')

<script type="text/javascript">

	$(document).ready(function() 
	{
		var test = $('.test').text();
		var result = test.replace(/\,/g,',<br/>');   

		$('.test').html(result);
	});

</script>

@endpush