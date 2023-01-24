
<style>
	table 
	{
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th 
	{
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	/*tr:nth-child(even) 
	{
		background-color: #dddddd;
	}*/
</style>

<section class="section-box">
	<div class="container" style="padding: 0px !important">
		<div class="list-recent-jobs">
			<div class="row">

				<?php

					use Workbench\Site\Model\Lookup\LkpDetail;

					$temp = array();
					$temp2 = array();

					foreach($lookupprojek as $a => $b)
					{
						$temp[$b->id] = 0;
						$temp2[$b->description] = 0;
					}

					foreach($data as $key => $value)
					{
						foreach($lookupprojek as $x => $y)
						{
							if($y->id == $value->jenisprojek->id)
							{
								$temp[$y->id] += 1;
								$temp2[$y->description] += 1;
							}
						}
					}

					foreach($temp as $aa => $bb)
					{
						// if($bb != 0)
						// {
							$name = LkpDetail::where('id', $aa)
											 ->first();
				?>
							<div class="col-lg-6 col-md-12 col-sm-12 col-12">
								<!-- Item job -->
									<div class="card-job hover-up wow animate__animated animate__fadeInUp">
										<div class="card-job-top">
											<div class="card-job-top--image">
												<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#projekModal" data-idprojek="{{ $aa }}" onclick="projekid(this)">
													<figure>
														<!-- <img alt="jobhub" src="assets/imgs/page/job/digital.png" /> -->
													</figure>
												</a>
											</div>
											<div class="card-job-top--info">
												<div class="row">
													<div class="col-lg-9 col-md-12 col-sm-12 col-12">
														<h6 class="card-job-top--info-heading">
															<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#projekModal" data-idprojek="{{ $aa }}" onclick="projekid(this)">
																{{ $name->description }}
															</a>
														</h6>
													</div>
													<div class="col-lg-3 col-md-12 col-sm-12 col-12 text-end">
														<span class="card-job-top--price">
															<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#projekModal" data-idprojek="{{ $aa }}" onclick="projekid(this)">
																{{ $bb }}
															</a>
														</span>
													</div>
												</div>
											</div>
										</div>
										<!-- <div class="card-job-description mt-20">
											
										</div> -->
										<!-- <div class="card-job-bottom mt-25">
											<div class="row">
												<div class="col-lg-12 col-sm-12 col-12">

												</div>
											</div>
										</div> -->
									</div>
								<!-- End item job -->
							</div>
				<?php
						// }
					}
				?>

			</div>
		</div>
	</div>
</section>

<!-- Modal Start -->
<div class="modal fade" id="projekModal" tabindex="-1" aria-labelledby="projekModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl"> <!-- modal-lg -->
		<div class="modal-content" id="modalpapar-projek">
		
		</div>
		<div class="modal-content p-30" id="modalloadingpapar-projek">
			<center>
				<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
			</center>
		</div>
	</div>
</div>

<div class="modal fade" id="modalimageprojek" tabindex="-1" aria-labelledby="modalimageprojekLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable">
		<div class="modal-content" id="modalimage-projek">

		</div>
		<div class="modal-content p-30" id="modalimageloadingpapar-projek">
			<center>
				<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
			</center>
		</div>
	</div>
</div>

<script type="text/javascript">

	// --------- function
	function projekid(data)
	{
		var idprojek   = $(data).data('idprojek');
		var idkampung = "{{ $request->segment(5) }}";
		
		// alert(idprojek);

		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/detail/projek/modal/')}}"+"/"+idkampung+"/"+idprojek,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#modalpapar-projek').html('');
				$('#modalpapar-projek').hide();
				$('#modalloadingpapar-projek').show();
			},
			success: function(data)
			{
				$('#modalpapar-projek').html(data);
				$('#modalloadingpapar-projek').hide();
				$('#modalpapar-projek').show();
			}
		});
	}

	function gambarprojekid(data)
	{
		var idgambarprojek = $(data).data('idgambarprojek');
		
		// alert(idgambarprojek);

		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/detail/projek/modalimage/')}}"+"/"+idgambarprojek,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#modalimage-projek').html('');
				$('#modalimage-projek').hide();
				$('#modalimageloadingpapar-projek').show();
			},
			success: function(data)
			{
				$('#modalimage-projek').html(data);
				$('#modalimageloadingpapar-projek').hide();
				$('#modalimage-projek').show();
			}
		});
	}

</script>