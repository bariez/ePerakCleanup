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

    .nav {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        padding-left: 0;
        margin-bottom: 0;
        list-style: none;
    }

    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
    }

    .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #fff;
        border-color: #dee2e6 #dee2e6 #fff;
    }
</style>
@endpush

<!-- start -------------------------------------------------------------------------------------------------------- -->

	<!-- banner start -->
		<section class="section-box" style="padding-top: 0px">
			<div class="box-head-single" style="background-color: #f2f2f2 !important; padding-top: 0px; padding-bottom: 0px">
				<div class="container" style="min-width: 100%">
					<div class="row">
						<div class="col-md-12" style="text-align: center; padding-bottom: 25px">
							<b><h4 style="color: black; padding-top: 25px">
								Carian<br/>
							</h4></b>
							<h6 style="color: black">
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
	    <section class="section-box">
			<div class="container">
				<div class="row">
					<div class="col-lg-1 col-md-1 col-sm-12 col-12">&nbsp;</div>
					<div class="col-lg-10 col-md-10 col-sm-12 col-12">
						<div class="sidebar-shadow">
						<!-- accordion start -->
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <h3 class="mb-30 wow animate__animated animate__fadeInUp">
                                Keputusan Carian
                            </h3>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" style="font-size: 20px;">Profil Aktiviti</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" style="font-size: 20px;">Profil Produk</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false" style="font-size: 20px;">Notis</button>
                                </li>
                            </ul>
                            <div class="tab-content p-10" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="table-responsive mt-10">
                                        <table id="tab-aktiviti" class="table table-striped" style="font-size: 16px">
                                            <thead>
                                                <tr style="background-color: #dddddd;">
                                                    <th style="text-align: center">BIL</th>
                                                    <th style="text-align: center">NAMA AKTIVITI</th>
                                                    <th style="text-align: center">PENGANJUR</th>
                                                    <th style="text-align: center">KETERANGAN</th>
                                                    <th style="text-align: center">TAHUN</th>
                                                    <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(data_get($data, 'aktiviti'))
                                                    @forelse(data_get($data, 'aktiviti') as $key => $carians)
                                                        <tr>
                                                            <td style="text-align: center">{{ ++$key }}</td>
                                                            <td style="text-align: left">{{ data_get($carians, 'NamaAktiviti') }}</td>
                                                            <td style="text-align: left">{{ data_get($carians, 'Penganjur') }}</td>
                                                            <td style="text-align: left">{{ data_get($carians, 'Keterangan') }}</td>
                                                            <td style="text-align: center">{{ data_get($carians, 'Tahun') }}</td>
                                                            <td style="text-align: center">
                                                                <a href="/activity/{{ data_get($carians,'id') }}" ><i class="fi fi-rr-search"></i>
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
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="table-responsive mt-10">
                                        <table id="tab-produk" class="table table-striped" style="font-size: 16px">
                                            <thead>
                                                <tr style="background-color: #dddddd;">
                                                    <th style="text-align: center">BIL</th>
                                                    <th style="text-align: center">NAMA PRODUK</th>
                                                    <th style="text-align: center">KETERANGAN</th>
                                                    <th style="text-align: center">KATEGORI PRODUK</th>
                                                    <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(data_get($data, 'produk'))
                                                    @forelse(data_get($data, 'produk') as $key => $carians)
                                                        <tr>
                                                            <td style="text-align: center">{{ ++$key }}</td>
                                                            <td style="text-align: left">{{ data_get($carians, 'NamaProduk') }}</td>
                                                            <td style="text-align: left">{{ data_get($carians, 'Keterangan') }}</td>
                                                            <td style="text-align: center">{{ data_get($carians, 'kategori.description') }}</td>
                                                            <td style="text-align: center">
                                                                <a href="/product/{{ data_get($carians,'KategoriProduk') }}?page=1" ><i class="fi fi-rr-search"></i>
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
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="table-responsive mt-10">
                                        <table id="tab-notis" class="table table-striped" style="font-size: 16px">
                                            <thead>
                                                <tr style="background-color: #dddddd;">
                                                    <th style="text-align: center">BIL</th>
                                                    <th style="text-align: center">TAJUK</th>
                                                    <th style="text-align: center">KETERANGAN</th>
                                                    <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(data_get($data, 'notis'))
                                                    @forelse(data_get($data, 'notis') as $key => $carians)
                                                        <tr>
                                                            <td style="text-align: center">{{ ++$key }}</td>
                                                            <td style="text-align: left">{{ data_get($carians, 'tajuk') }}</td>
                                                            <td style="text-align: left">{!! data_get($carians, 'keterangan') !!}</td>
                                                            <td style="text-align: center">
                                                                <a href="/news/{{ data_get($carians,'id') }}" ><i class="fi fi-rr-search"></i>
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
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
        $('#tab-aktiviti').DataTable(
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

        $('#tab-produk').DataTable(
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

        $('#tab-notis').DataTable(
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

@endpush
