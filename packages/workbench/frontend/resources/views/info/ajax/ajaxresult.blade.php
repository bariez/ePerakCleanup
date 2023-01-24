
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

<div class="table-responsive">
	<table id="kampunglist" class="table table-striped" style="font-size: 16px">
		<thead>
			<tr style="background-color: #dddddd;">
				<th style="text-align: center">Bil</th>
				<th style="text-align: center">DAERAH</th>
				<th style="text-align: center">MUKIM</th>
				<th style="text-align: center">PARLIMEN</th>
				<th style="text-align: center">DUN</th>
				<th style="text-align: center">KATEGORI PETEMPATAN</th>
				<th style="text-align: center">NAMA KAMPUNG</th>
				<!-- <th style="text-align: center">TINDAKAN</th> -->
			</tr>
		</thead>
		<tbody>
			@forelse($result as $key => $results)
				<tr>
					<td style="text-align: center">{{ ++$key }}</td>
					<td style="text-align: left">{{ data_get($results, 'daerah.NamaDaerah') }}</td>
					<td style="text-align: left">{{ data_get($results, 'mukim.NamaMukim') }}</td>
					<td style="text-align: left">{{ data_get($results, 'parlimen.NamaParlimen') }}</td>
					<td style="text-align: left">{{ data_get($results, 'dun.NamaDun') }}</td>
					<td style="text-align: left">{{ data_get($results, 'catpetempatan.description') }}</td>
					<td style="text-align: left">
						<a href="/info/{{ data_get($results,'id') }}" style="font-weight: bolder">
							{{ data_get($results, 'NamaKampung') }}&nbsp;&nbsp;<i class="fi fi-rr-search"></i>
						</a>
						<span style=" font-size: 12px">
							<ul class="list-group list-group-flush" style="padding-left: 20px !important; padding-right: 20px !important; ">
								@forelse($results->kampung_rangkaian as $key2 => $rangkaian)
									<li class="list-group-item" style="padding: 4px !important; background-color: inherit;">
										<i class="fa fa-anchor" aria-hidden="true"></i> {{ $rangkaian->NamaKampung }}
									</li>
								@empty
								@endforelse
							</ul>
						</span>
					</td>
					<!-- <td style="text-align: center;">
						<a href="/info/ data_get($results,'id') }}" >
							<i class="fi fi-rr-search"></i>
						</a>
					</td> -->
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
</div>

<script type="text/javascript">

	$(document).ready(function () 
	{
		$('#kampunglist').DataTable(
		{
			"language": 
			{
				"lengthMenu"	: "Papar _MENU_ data",
				"zeroRecords"	: "Tiada Data",
				"info"			: "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data", // Memaparkan muka _PAGE_ dari _PAGES_
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