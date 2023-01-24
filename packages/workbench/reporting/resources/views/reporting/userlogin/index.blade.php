@extends('laravolt::layout.app2')

@section('content')

<style type="text/css">

</style>

	<div id="actionbar" class="ui two column grid content__body p-3">
	    <div class="column middle aligned">
	        <h3 class="ui header m-t-xs">
	            LAPORAN PENGGUNA TIDAK AKTIF 
	        </h3>
	    </div>
	</div>

	<br>

	<h4 class="ui top attached header">
		LAPORAN PENGGUNA TIDAK AKTIF LEBIH DARI ENAM BULAN
	</h4>

	<div class="ui attached segment">
		<div class="column sixteen wide">
			<div class="ui form">
				<div class="fields">
					<div class="one wide field"></div>

					<div class="seven wide field">
						<div class="ui form">

							<div class="fields">
								<div class="three wide field">
									<label>Nama Penuh</label>
								</div>
								<div class="eleven wide field">
									<input type="text" 
											name="nama" id="idnama" 
											placeholder="Nama Penuh">
								</div>
							</div>

						</div>
					</div>

					<div class="seven wide field">
						<div class="ui form">

							<div class="fields">
								<div class="three wide field">
									<label>Jawatan</label>
								</div>
								<div class="eleven wide field">
									<input type="text" 
											name="jawatan" id="idjawatan" 
											placeholder="Jawatan">
								</div>
							</div>

						</div>
					</div>

					<div class="one wide field"></div>
				</div>

				<div class="fields">
					<div class="one wide field"></div>

					<div class="seven wide field">
						<div class="ui form">

							<div class="fields">
								<div class="three wide field">
									<label>Kategori Pengguna</label>
								</div>
								<div class="eleven wide field">
									<div class="ui fluid search selection dropdown" id="selrole">
										<input type="hidden" name="roledesc" id="idrole">
										<i class="dropdown icon"></i>
										<div class="default text">Sila Pilih</div>
										<div class="menu">
											<div class="item" data-value="">Sila Pilih</div>
											@foreach($roleDesc as $key => $value)
												<div class="item" 
													 data-value="{{ data_get($value, 'id') }}" 
													 data-text="{{ data_get($value, 'name') }}">
													{{ data_get($value, 'name') }}
												</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="seven wide field">
						<div class="ui form">

							<div class="fields">
								<div class="three wide field">
									<label>Jabatan/ Agensi</label>
								</div>
								<div class="eleven wide field">
									<input type="text" 
											name="dept" id="iddept" 
											placeholder="Jabatan/ Agensi">
								</div>
							</div>

						</div>
					</div>

					<div class="one wide field"></div>
				</div>

				<div class="ui divider section"></div>

				<div class="ui buttons right floated">
					<a class="ui button" href="{!! URL::to('reporting/userlogin/index') !!}">Set Semula</a>
					<div class="or" data-text="@"></div>
					<a href="javascript:;" class="ui blue button" 
					   id="clicksubmit" type="button"
					   style="border-radius: 4px 4px 4px 4px;background-color: #432712;color: white">&nbsp;&nbsp;&nbsp;Carian&nbsp;&nbsp;&nbsp;</a>
				</div>
				<br/><br/><br/>
			</div>
		</div>
	</div>

	<!-- sila tunggu is here -->
	<div class="ui container-fluid content__body p-3" id="ajaxpleasewaitmain" style="display: none;">
		<div class="ui segments panel">
			<div class="ui segment p-3">
				<div class="ui blue sliding indeterminate progress" >
					<div class="bar">
						<div class="progress">Sila Tunggu Sebentar</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="ui container-fluid content__body p-3" id="ajaxlistmain" style="display: none">
		<div class="ui segments panel" >
			<div class="ui segment p-3" id="result">

				<div class="ui buttons right floated">
					<a href="javascript:;"  class="ui red button"  onclick="pdfclick()"   title="PDF">&nbsp;PDF&nbsp;</a>
					<div class="or" data-text="@"></div>
					<a href="javascript:;"  class="ui green button"  onclick="excelclick()" title="EXCEL">EXCEL</a>
				</div>
				<br/><br/>

				<div class="container">
					<div class="overflow-x-auto p-1">
						<table id="data-table" class="display" >
							<thead style="width:100%; font-size: 12px; background-color:#87b0fb">
								<tr>
									<th style="text-align: center;">Bil</th>
									<th style="text-align: left;">NAMA PENUH</th>
									<th style="text-align: left;">JAWATAN</th>
									<th style="text-align: left;">JABATAN/ AGENSI</th>
									<th style="text-align: center;">KATEGORI PENGGUNA</th>
									<th style="text-align: center;">STATUS</th>
									<th style="text-align: center;">TARIKH DAFTAR</th>
									<th style="text-align: center;">LOG MASUK TERAKHIR</th>
								</tr>
							</thead>
							<tbody id="tbody-data">

							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection
@push('script')

<script type="text/javascript">

	$(document).ready(function() 
	{

	});

	$('#clicksubmit').click(function(e)
	{
		var val_nama 	= document.getElementById("idnama").value;
		var val_jawatan = document.getElementById("idjawatan").value;
		var val_role 	= document.getElementById("idrole").value;
		var val_dept 	= document.getElementById("iddept").value;

		if( !val_nama )
		{
			var val_nama = 'nama';
		}
		if( !val_jawatan )
		{
			var val_jawatan   = 'jawatan';
		}
		if( !val_role )
		{
			var val_role  = 'role';
		}
		if( !val_dept )
		{
			var val_dept= 'dept';
		}

		$.ajax(
		{
			type: "get",
			url : "{{ URL::to('/reporting/userlogin/ajax') }}"+"/"+val_nama+"/"+val_jawatan+"/"+val_role+"/"+val_dept,
			beforeSend: function ()
			{
				document.getElementById('ajaxpleasewaitmain').style.display = "block";
				document.getElementById('ajaxlistmain').style.display = "none";

				table = $('#data-table').DataTable().destroy();
			},
			success: function (result)
			{
				document.getElementById('ajaxpleasewaitmain').style.display = "none";
				document.getElementById('ajaxlistmain').style.display = "block";

				var data = result.dataresult;
				var html = "";

				for(var i = 0, j = 1; i < data.length; i++, j++)
				{
					html += "<tr>";

					html += 	"<td style='text-align: center;'>"+j;
					html += 	"</td>";

					if(data[i].name)
					{
						html += "<td style='text-align: left'>"+data[i].name;
					}
					else
					{
						html += "<td><center> - </center>";
					}

					if(data[i].jawatan)
					{
						html += "<td style='text-align: left'>"+data[i].jawatan;
					}
					else
					{
						html += "<td><center> - </center>";
					}

					if(data[i].jabatan)
					{
						html += "<td style='text-align: left'>"+data[i].jabatan;
					}
					else
					{
						html += "<td><center> - </center>";
					}

					if(data[i].user_role.acl_roles.name)
					{
						html += "<td style='text-align: center'>"+data[i].user_role.acl_roles.name;
					}
					else
					{
						html += "<td><center> - </center>";
					}

					if(data[i].status)
					{
						html += "<td style='text-align: center'>"+data[i].status;
					}
					else
					{
						html += "<td><center> - </center>";
					}

					if(data[i].created_at)
					{
						var mydate = new Date(data[i].created_at);
						var cadd     = String(mydate.getDate()).padStart(2, '0');
						var camm     = String(mydate.getMonth() + 1).padStart(2, '0');
						var cayy   = mydate.getFullYear();

						html += "<td style='text-align: center'>"+cadd+"/"+camm+"/"+cayy; 
					}
					else
					{
						html += "<td><center> - </center>";
					}

					if(data[i].last_login_at)
					{
						var mydate = new Date(data[i].last_login_at);
						var lldd     = String(mydate.getDate()).padStart(2, '0');
						var llmm     = String(mydate.getMonth() + 1).padStart(2, '0');
						var llyy   = mydate.getFullYear();

						html += "<td style='text-align: center'>"+lldd+"/"+llmm+"/"+llyy; 
					}
					else
					{
						html += "<td><center> - </center>";
					}

						html += "</td>";

					html += "</tr>";
				}

				$("#tbody-data").html(html);

				$('#data-table').DataTable( 
				{
					"lengthChange": false,
					"language": 
					{
						"search":  "Carian:",
						"info":     "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
						"infoEmpty": "Paparan 0 hingga 0 daripada 0 jumlah data",
						"paginate": 
						{
							"first":      "Pertama",
							"last":       "Terakhir",
							"next":       "Seterusnya",
							"previous":   "Sebelumnya"
						},
					}
				});



			}

		});

	});

	function pdfclick()
	{
		var val_nama 	= document.getElementById("idnama").value;
		var val_jawatan = document.getElementById("idjawatan").value;
		var val_role 	= document.getElementById("idrole").value;
		var val_dept 	= document.getElementById("iddept").value;

		if( !val_nama )
		{
			var val_nama = 'nama';
		}
		if( !val_jawatan )
		{
			var val_jawatan   = 'jawatan';
		}
		if( !val_role )
		{
			var val_role  = 'role';
		}
		if( !val_dept )
		{
			var val_dept= 'dept';
		}

		window.open(
			"/reporting/userlogin/pdf/"+val_nama+"/"+val_jawatan+"/"+val_role+"/"+val_dept,
			"-_blank"
		);
	}

	function excelclick()
	{
		var val_nama 	= document.getElementById("idnama").value;
		var val_jawatan = document.getElementById("idjawatan").value;
		var val_role 	= document.getElementById("idrole").value;
		var val_dept 	= document.getElementById("iddept").value;

		if( !val_nama )
		{
			var val_nama = 'nama';
		}
		if( !val_jawatan )
		{
			var val_jawatan   = 'jawatan';
		}
		if( !val_role )
		{
			var val_role  = 'role';
		}
		if( !val_dept )
		{
			var val_dept= 'dept';
		}

		window.open(
			"/reporting/userlogin/excel/"+val_nama+"/"+val_jawatan+"/"+val_role+"/"+val_dept,
			"-_blank"
		);
	}

</script>
@endpush