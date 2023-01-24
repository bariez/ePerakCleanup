@extends('laravolt::eperak.layouts.base')

@section('content')

<!-- start-------------------------------------------------------------------------------------------------------- -->

@push('style')
<style type="text/css">
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
	.capitalall
	{
		text-transform: uppercase;
	}

	/*tr:nth-child(even) 
	{
		background-color: #dddddd;
	}*/
</style>
@endpush

<!-- start -------------------------------------------------------------------------------------------------------- -->

	<!-- banner start -->
		<section class="section-box" style="">
			<div class="box-head-single" style="background-color: #f2f2f2 !important; padding-top: 0px; padding-bottom: 0px">
				<div class="container" style="min-width: 100%">
					<div class="row">
						<div class="col-md-12" style="text-align: center; padding-bottom: 25px">
							<b><h4 style="padding-top: 25px">
								{{ data_get($kampung, 'NamaKampung') }}<br/>
							</h4></b>
							<h6 style="">
								&nbsp;{{ data_get($kampung, 'mukim.NamaMukim') }}, {{ data_get($kampung, 'daerah.NamaDaerah') }}
							</h6>
							
							<!-- <br><br> -->
							<!-- <a href="#" class="btn btn-secondary btn-shadow ml-10 hover-up">Lihat Terperinci</a> -->

						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- banner end   -->


	<!-- senarai aktiviti start -->
	    <section class="section-box">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="sidebar-shadow">
							<div class="sidebar-heading">
								<div class="avatar-sidebar">
									<!-- <figure> -->
										<!-- <img alt="e-Perak" src=" asset('/theme/assets/imgs/theme/perak/activity.png') }}" /> -->
									<!-- </figure> -->
									<div class="sidebar-info">
										<span class="sidebar-company capitalall" style="padding-top: 16px;">&nbsp;&nbsp;&nbsp;Senarai Aktiviti</span>
										<!-- <span class="sidebar-website-text">&nbsp;</span> -->
									</div>
								</div>
							</div>

							<div class="sidebar-list-job">
								<div class="section-box wow animate__animated animate__fadeIn mt-10 mb-15">
									<div class="container">
										<div class="row">
											<!-- <form> -->

												<table id="aktivitilist" class="table table-striped">
													<thead>
														<tr style="background-color: #dddddd;">
															<th style="text-align: center">Bil</th>
															<th style="text-align: center">TAHUN</th>
															<th style="text-align: center">JENIS AKTIVITI</th>
															<th style="text-align: center">AKTIVITI</th>
															<th style="text-align: center"></th>
														</tr>
													</thead>
													<tbody>
														@forelse($data as $key => $value)
															<tr>
																<td style="text-align: center">{{ ++$key }}</td>
																<td style="text-align: center">{{ data_get($value, 'Tahun') }}</td>
																<td style="text-align: left">{{ data_get($value, 'kategori.description') }}</td>
																<td style="text-align: left">{{ data_get($value, 'NamaAktiviti') }}</td>
																<td style="text-align: center;">
																	<a href="javascript:;" 
																	   data-bs-toggle="modal" 
																	   data-bs-target="#aktivitiModal" 
																	   data-idaktiviti="{{ data_get($value, 'id') }}" 
																	   onclick="forwardid(this)">
																		<i class="fi fi-rr-eye"></i>
																	</a>
																</td>
															</tr>
														@empty
															<tr>
																<td colspan="8" style="text-align: center">
																	Tiada Data
																</td>
															</tr>
														@endforelse
													</tbody>
												</table>

											<!-- </form> -->
										</div>
									</div>
								</div>
							</div>

							<div class="sidebar-list-job">
								<div class=" wow animate__animated animate__fadeIn">
									<div class="container">
										<div class="row">

				                            <div class="text-end">
				                                <a href="/info/{{ data_get($kampung, 'id') }}" class="btn btn-secondary">Kembali</a>
				                            </div>

										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- senarai aktiviti end   -->

<!-- Modal Start -->
<div class="modal fade" id="aktivitiModal" tabindex="-1" aria-labelledby="aktivitiModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable"> <!-- modal-lg -->
		<div class="modal-content" id="modalpapar">
			<!-- <div class="modal-header">
				<h5 class="modal-title" id="aktivitiModalLabel">Modal title</h5>
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

		<div class="modal-content p-30" id="modalloadingpapar">
			<center>
				<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
			</center>
		</div>
	</div>
</div>

<div class="modal fade" id="modalimageaktiviti" tabindex="-1" aria-labelledby="modalimageaktivitiLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content" id="modalimage">
			<!-- <div class="modal-header">
				<h5 class="modal-title" id="aktivitiModalLabel">{{ data_get($data, 'NamaAktiviti') }}</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-content p-30" id="modalloadingpapar">
				<center>
					<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
				</center>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" data-bs-target="#aktivitiModal" data-bs-toggle="modal" data-bs-dismiss="modal">Kembali</button>
			</div> -->
		</div>

		<div class="modal-content p-30" id="modalimageloadingpapar">
			<center>
				<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
			</center>
		</div>
	</div>
</div>
<!-- Modal End -->

<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')
<script type="text/javascript">

	$(document).ready(function () 
	{
		$('#aktivitilist').DataTable(
		{
			"language": 
			{
				"lengthMenu"	: "Papar _MENU_ data",
				"zeroRecords"	: "Tiada Data",
				"info"			: "Memaparkan muka _PAGE_ dari _PAGES_",
				"infoEmpty"		: "Tiada Data",
				"infoFiltered"	: "(Menapis dari _MAX_ data keseluruhan)",
				"search"		: "Carian:",
				"paginate"		: 
				{
					"first"		: "Pertama",
					"last"		: "Terakhir",
					"next"		: "Seterusnya",
					"previous"	: "Sebelumnya"
				},
			}
		});
	});

	// --------- function
	function forwardid(data)
	{
		var idaktiviti = $(data).data('idaktiviti');
		
		// alert(idaktiviti);

		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/detail/aktiviti/modal/')}}"+"/"+idaktiviti,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#modalpapar').html('');
				$('#modalpapar').hide();
				$('#modalloadingpapar').show();
			},
			success: function(data)
			{
				$('#modalpapar').html(data);
				$('#modalloadingpapar').hide();
				$('#modalpapar').show();
			}
		});
	}

	function gambarid(data)
	{
		var idgambar = $(data).data('idgambar');
		
		// alert(idgambar);

		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/detail/aktiviti/modalimage/')}}"+"/"+idgambar,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#modalimage').html('');
				$('#modalimage').hide();
				$('#modalimageloadingpapar').show();
			},
			success: function(data)
			{
				$('#modalimage').html(data);
				$('#modalimageloadingpapar').hide();
				$('#modalimage').show();
			}
		});
	}

</script>
@endpush