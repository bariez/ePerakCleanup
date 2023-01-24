
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

	<div class="modal-header">
		<h5 class="modal-title capitalall" id="projekModalLabel">Senarai Projek</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	</div>

	<div class="modal-body">

		<section class="section-box p-40">
			<div class="container" style="padding: 0px !important">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<!-- <div class="sidebar-shadow"> -->
							<!-- <div class="sidebar-heading"> -->
								<!-- <div class="avatar-sidebar"> -->
									<!-- <div class="sidebar-list-job"> -->

										<div class="table-responsive">
											<table id="projeklist" class="table table-striped">
												<thead>
													<tr style="background-color: #dddddd;">
														<th style="text-align: center">Bil</th>
														<th style="text-align: center">TAHUN</th>
														<th style="text-align: center">NAMA PROJEK</th>
														<th style="text-align: center">LOKASI</th>
														<th style="text-align: center">SUMBER KEWANGAN</th>
														<th style="text-align: center">AGENSI PELAKSANA</th>
														<th style="text-align: center">JENIS PROJEK</th>
														<th style="text-align: center">GAMBAR</th>
													</tr>
												</thead>
												<tbody>
													@forelse($data as $key => $value)
														<tr>
															<td style="text-align: center; vertical-align: top;">{{ ++$key }}</td>
															<td style="text-align: left; vertical-align: top;">{{ data_get($value, 'Tahun') }}</td>
															<td style="text-align: left; vertical-align: top;">{{ data_get($value, 'NamaProjek') }}</td>
															<td style="text-align: left; vertical-align: top;">{{ data_get($value, 'Lokasi') }}</td>
															<td style="text-align: left; vertical-align: top;">{{ data_get($value, 'Sumber') }}</td>
															<td style="text-align: left; vertical-align: top;">{{ data_get($value, 'Agensi') }}</td>
															<td style="text-align: left; vertical-align: top;">{{ data_get($value, 'jenisprojek.description') }}</td>
															<td style="text-align: left; vertical-align: top;">
																@if( data_get($value, 'Gambar_path') )
																	@if( file_exists( public_path( data_get($value, 'Gambar_path') ) ) )
																		<button style="border: 0px white" 
																				data-bs-target="#modalimageprojek" 
																				data-bs-toggle="modal" 
																				data-bs-dismiss="modal" 
																				data-idgambarprojek="{{ data_get($value, 'id') }}" 
																				onclick="gambarprojekid(this)">
																			<img class="" src="{{ data_get($value, 'Gambar_path') }}" />
																		</button>
																	@else
																		<img class="" src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" />
																	@endif
																@else
																	<img class="" src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" />
																@endif
															</td>
														</tr>
													@empty
														<tr>
															<td colspan="5" style="text-align: center">
																Tiada Data
															</td>
														</tr>
													@endforelse
												</tbody>
											</table>
										</div>

									<!-- </div> -->
								<!-- </div> -->
							<!-- </div> -->
						<!-- </div> -->
					</div>
				</div>
			</div>
		</section>

	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
	</div>

<script type="text/javascript">

	$(document).ready(function () 
	{
		$('#projeklist').DataTable(
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

</script>