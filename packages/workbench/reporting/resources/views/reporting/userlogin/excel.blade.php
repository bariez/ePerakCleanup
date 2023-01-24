<!DOCTYPE html>
<html>
	<head>

		<style type="text/css">
			td.sirim
			{
				padding: 0px 0px 0px 0px; /* atas kanan bawah kiri */
				margin : 0px 0px 0px 0px; /* atas kanan bawah kiri */

			}
			.border
			{
		    	border: 1px solid black;
		    	border-collapse: collapse;
			}
			.borderkanan
			{
		    	border-right: 1px solid black;
		    	padding: 2px;
		    	border-collapse: collapse;
			}
			.ringgit
			{
				text-align: right;
				padding: 2px;
			}
			.diva4
			{
			    height:267mm;
			}
		</style>
		<meta charset="UTF-8">
	</head>
	<body>

		<table style="width:100%; font-size: 12px" class="border">
			<tbody>
				<tr>
					<td class="border" style="text-align: center">
						
					</td>
				</tr>
				<tr>
					<td colspan="8" class="border" style="text-align: center">
						<b>LAPORAN PENGGUNA YANG TIDAK AKTIF LEBIH DARI ENAM BULAN</b>
					</td>
				</tr>
			</tbody>
		</table>

		<table style="width:100%; font-size: 10px" class="border">
			<tbody>
				<tr>
					<td class="border" style="text-align: center">
						<b>Bil</b>
					</td>
					<td class="border" style="text-align: center">
						<b>NAMA PENUH</b>
					</td>
					<td class="border" style="text-align: center">
						<b>JAWATAN</b>
					</td>
					<td class="border" style="text-align: center">
						<b>JABATAN/ AGENSI</b>
					</td>
					<td class="border" style="text-align: center">
						<b>KATEGORI PENGGUNA</b>
					</td>
					<td class="border" style="text-align: center">
						<b>STATUS</b>
					</td>
					<td class="border" style="text-align: center">
						<b>TARIKH DAFTAR</b>
					</td>
					<td class="border" style="text-align: center">
						<b>LOG MASUK TERAKHIR</b>
					</td>
				</tr>
				@forelse($data as $key => $dt)
					<tr>
						<td class="border" style="text-align: center" valign="top">
							{{ ++$key }}
						</td>	
						<td class="border" style="text-align: left" valign="top">
							{{ data_get($dt, 'name') }}
						</td>	
						<td class="border" style="text-align: left" valign="top">
							{{ data_get($dt, 'jawatan') }}
						</td>	
						<td class="border" style="text-align: left" valign="top">
							{{ data_get($dt, 'jabatan') }}
						</td>	
						<td class="border" style="text-align: center" valign="top">
							{{ data_get($dt, 'user_role.acl_roles.name') }}
						</td>	
						<td class="border" style="text-align: center" valign="top">
							{{ data_get($dt, 'status') }}
						</td>	
						<td class="border" style="text-align: center" valign="top">
							{{ date('d-m-Y h:i a', strtotime(data_get($dt, 'created_at'))) }}
						</td>	
						<td class="border" style="text-align: center" valign="top">
							{{ date('d-m-Y h:i a', strtotime(data_get($dt, 'last_login_at'))) }}
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





	</body>
</html>

