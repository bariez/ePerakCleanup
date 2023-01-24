
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

<section class="section-box p-40">
	<div class="container" style="padding: 0px !important">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<!-- <div class="sidebar-shadow"> -->
					<!-- <div class="sidebar-heading"> -->
						<!-- <div class="avatar-sidebar"> -->
							<!-- <div class="sidebar-list-job"> -->

								<div class="table-responsive">
									<table id="pencapaianlist" class="table table-striped">
										<thead>
											<tr style="background-color: #dddddd;">
												<th style="text-align: center">Bil</th>
												<th style="text-align: center">TAHUN</th>
												<th style="text-align: center">PERINGKAT</th>
												<th style="text-align: center">AKTIVITI</th>
												<th style="text-align: center">PENCAPAIAN</th>
												<th style="text-align: center">PENGANJUR</th>
											</tr>
										</thead>
										<tbody>
											@forelse($data as $key => $value)
												<tr>
													<td style="text-align: center">{{ ++$key }}</td>
													<td style="text-align: left">{{ data_get($value, 'Tahun') }}</td>
													<td style="text-align: left">{{ data_get($value, 'peringkat.description') }}</td>
													<td style="text-align: left">{{ data_get($value, 'Aktiviti') }}</td>
													<td style="text-align: left">{{ data_get($value, 'Pencapaian') }}</td>
													<td style="text-align: left">{{ data_get($value, 'Penganjur') }}</td>
												</tr>
											@empty
												<tr>
													<td colspan="6" style="text-align: center">
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

<script type="text/javascript">

	$(document).ready(function () 
	{
		$('#pencapaianlist').DataTable(
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