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
								Soalan Lazim<br/>
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

	<!-- section title   -->
		<section class="section-box">
			<div class="container pt-50">
				<div class="w-60 w-md-100 mx-auto text-center">
					<h3 class="mb-30 wow animate__animated animate__fadeInUp" style="color: white; text-shadow: 2px 2px #000000;">
						TERDAPAT PERSOALAN TENTANG KAMI ?
					</h3>
					<p class="mb-30 text-muted wow animate__animated animate__fadeInUp font-lg" style="text-shadow: 1px 1px #000000;">
						Ketahui apa yang berlaku dan temukan pengalaman hebat di sistem baru kami.
					</p>
				</div>
			</div>
		</section>
	<!-- section title end -->

	<!-- section contact us -->
		<section class="section-box bg-blue-full mt-30 mb-30 pt-30 pb-30">
			<div class="container" style="">
				<!-- <img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/faqquestion.png') }}" style="width: 60px"/> -->
				
				<div class="row">
					<div class="col-lg-2">&nbsp;</div>
					<div class="col-lg-4">
						<center>
							<h4 class="mb-20">
								Anda perlukan bantuan?<br>Mempunyai pertanyaan?
							</h4>
							<p class="text-gray-200">
								Hubungi kami dan kami akan menjawab semua kemusykilan anda.
								<br><br><br>
								<div class="box-button-shadow ">
									<a href="/contactus" class="btn btn-default">Hubungi Kami</a>
								</div>
							</p>
						</center>
					</div>
					<div class="col-lg-4">
						<img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/faqquestion3.png') }}" style="width: 240px; display: block; margin-left: auto; margin-right: auto; "/>
					</div>
					<div class="col-lg-2">&nbsp;</div>
				</div>
			</div>
		</section>
	<!-- section contact us end -->

	<!-- accordion start -->
	    <section class="section-box">
			<div class="container">
				<div class="row">
					<div class="col-lg-1 col-md-1 col-sm-12 col-12">&nbsp;</div>
					<div class="col-lg-10 col-md-10 col-sm-12 col-12">
						<div class="sidebar-shadow">
						<!-- accordion start -->
							<div class="accordion accordion-flush" id="accordionFlushExample">
								<h3 class="mb-30 wow animate__animated animate__fadeInUp capitalall">
									Soalan Lazim
								</h3>

								<!-- 1st accordion start -->
									@foreach($faq as $key => $faqs)
										<div class="accordion-item">
											<h2 class="accordion-header" id="flush-heading{{ data_get($faqs, 'Susunan') }}">
												<button class="accordion-button collapsed btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ data_get($faqs, 'Susunan') }}" aria-expanded="true" aria-controls="flush-collapse{{ data_get($faqs, 'Susunan') }}" >
													{{ data_get($faqs, 'Soalan') }}
												</button>
											</h2>
											<!-- <br/> -->
											<div id="flush-collapse{{ data_get($faqs, 'Susunan') }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ data_get($faqs, 'Susunan') }}" data-bs-parent="#accordionFlushExample" style="">
												<div class="accordion-body">

													<div class="content-single p-30" id="ajordion-{{ data_get($faqs, 'Susunan') }}" style="text-align: justify;">
														{{ data_get($faqs, 'Jawapan') }}
													</div>

												</div>
											</div>
										</div>
									@endforeach
								<!-- 1st accordion end   -->

							</div>
						<!-- accordion end   -->
						</div>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-12 col-12">&nbsp;</div>
				</div>
			</div>
		</section>
	<!-- accordion end   -->

<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')

<script type="text/javascript">

	$(document).ready(function() 
	{

	});

</script>

@endpush