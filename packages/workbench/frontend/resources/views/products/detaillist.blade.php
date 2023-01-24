<style type="text/css">
	#cardproduk
	{ 
		height: auto; 
	}
</style>

	<!-- foreach($data->take(4) as $key => $value) -->
	@foreach($data as $key => $produks)
        <div class="col-lg-4 col-md-12 col-sm-12 col-12 mt-10 hover-up" id="cardproduk" style="display: block;">
            <div class="sidebar-shadow h-100">
                <div class="sidebar-heading">
                    <div class="avatar-sidebar">
                        <div class="sidebar-info">
                            <span class="sidebar-company">
                                <h4><a href="javascript:;">{{ data_get($produks, 'NamaProduk', 'NAMA PRODUK') }}</a></h4>
                            </span>
                        </div>
                        <div class="sidebar-list-job" style="padding-top: 15px">
                            <span class="card-job-top--post-time text-md">
                                &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;{{ data_get($produks, 'pengeluar.NamaSyarikat', 'Nama Pengeluar') }}
                            </span><br>
                        </div>
                        <div class="sidebar-list-job" style="padding-top: 15px">
                            <span class="card-job-top--post-time text-md">
                                &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;{{ data_get($produks, 'Keterangan', 'Keterangan') }}
                            </span><br>
                        </div>
                        <div class="sidebar-list-job" style="padding-top: 15px">
                            <span class="card-job-top--post-time text-md">
                                &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;{{ data_get($produks, 'jenisproduk.description', 'Jenis Produk') }}
                            </span><br>
                        </div>
                        <div class="sidebar-list-job" style="padding-top: 15px">
                            <span class="card-job-top--post-time text-md">
                                &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;{{ data_get($produks, 'pengeluar.mediasosial.description', 'Media Sosial') }}
                            </span><br>
                        </div>
                        <div class="sidebar-list-job" style="padding-top: 15px">
                            <span class="card-job-top--post-time text-md">
                                &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;{{ data_get($produks, 'pengeluar.LinkMediaSosial', 'Link Media Sosial') }}
                            </span><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach