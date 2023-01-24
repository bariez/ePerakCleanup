
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

					foreach($lookup as $a => $b)
					{
						$temp[$b->id] = 0;
						$temp2[$b->description] = 0;
					}

					foreach($data as $key => $value)
					{
						foreach($lookup as $x => $y)
						{
							if($y->id == $value->lkpdetail->id)
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
												<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#infraModal" data-idinfra="{{ $aa }}" onclick="infraid(this)">
													<figure>
														<!-- <img alt="jobhub" src="assets/imgs/page/job/digital.png" /> -->
													</figure>
												</a>
											</div>
											<div class="card-job-top--info">
												<div class="row">
													<div class="col-lg-9 col-md-12 col-sm-12 col-12">
														<h6 class="card-job-top--info-heading">
															<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#infraModal" data-idinfra="{{ $aa }}" onclick="infraid(this)">
																{{ $name->description }}
															</a>
														</h6>
													</div>
													<div class="col-lg-3 col-md-12 col-sm-12 col-12 text-end">
														<span class="card-job-top--price">
															<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#infraModal" data-idinfra="{{ $aa }}" onclick="infraid(this)">
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
<div class="modal fade" id="infraModal" tabindex="-1" aria-labelledby="infraModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-xl"> <!-- modal-lg -->
		<div class="modal-content" id="modalpapar-infra">
			<!-- <div class="modal-header">
				<h5 class="modal-title" id="infraModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div> -->
		</div>

		<div class="modal-content p-30" id="modalloadingpapar-infra">
			<center>
				<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
			</center>
		</div>
	</div>
</div>

<script type="text/javascript">

	// $(document).ready(function () 
	// {
	// 	$('#pencapaianlist').DataTable(
	// 	{
	// 		"language": 
	// 		{
	// 			"lengthMenu"	: "Papar _MENU_ data",
	// 			"zeroRecords"	: "Tiada Data",
	// 			"info"			: "Memaparkan muka _PAGE_ dari _PAGES_",
	// 			"infoEmpty"		: "Tiada Data",
	// 			"infoFiltered"	: "(Menapis dari _MAX_ data keseluruhan)",
	// 			"search"		: "Carian:",
	// 			"paginate"		: 
	// 			{
	// 				"first"		: "Pertama",
	// 				"last"		: "Terakhir",
	// 				"next"		: "Seterusnya",
	// 				"previous"	: "Sebelumnya"
	// 			},
	// 		}
	// 	});
	// });


	// --------- function
	function infraid(data)
	{
		var idinfra   = $(data).data('idinfra');
		var idkampung = "{{ $request->segment(5) }}";
		
		// alert(idinfra);

		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/detail/infra/modal/')}}"+"/"+idkampung+"/"+idinfra,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#modalpapar-infra').html('');
				$('#modalpapar-infra').hide();
				$('#modalloadingpapar-infra').show();
			},
			success: function(data)
			{
				$('#modalpapar-infra').html(data);
				$('#modalloadingpapar-infra').hide();
				$('#modalpapar-infra').show();
			}
		});
	}

</script>