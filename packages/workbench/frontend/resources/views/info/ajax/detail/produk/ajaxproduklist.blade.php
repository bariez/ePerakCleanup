<style type="text/css">
	#cardproduk
	{ 
		height: auto; 
	}
</style>

	<!-- foreach($data->take(4) as $key => $value) -->
	<div class="cardproduk">
		<div class="row" style="padding-top: 20px">
			@foreach($data as $key => $value)

                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 hover-up wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                                                    <div class="card-grid-2 hover-up h-100" style="border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
                                                        <div class="text-center card-grid-2-image">
                                                            <figure>

                                                                @if( data_get($value, 'Gambar_path') )
                                                                    @if( file_exists( public_path( data_get($value, 'Gambar_path') ) ) )
                                                                        <img src="{!! URL::to(data_get($value, 'Gambar_path')) !!}" alt="{{ data_get($value, 'NamaProduk') }}" title="{{ data_get($value, 'NamaProduk') }}" 
                                                                             style="height: 300px !important">
                                                                    @else
                                                                        <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($value, 'NamaProduk') }}" title="{{ data_get($value, 'NamaProduk') }}"
                                                                             style="height: 50% !important; width: 50% !important">
                                                                    @endif
                                                                @else
                                                                    <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($value, 'NamaProduk') }}" title="{{ data_get($value, 'NamaProduk') }}"
                                                                         style="height: 50% !important; width: 50% !important">
                                                                @endif

                                                            </figure>
                                                        </div>
                                                        <div class="card-block-info" style="min-height: 210px !important">

                                                            <div class="avatar-sidebar capitalall">
                                                                <div class="sidebar-info">
                                                                    <span class="sidebar-company">
                                                                        <h5>
                                                                            <span style="font-weight: bolder">
                                                                                {{ data_get($value, 'NamaProduk') == null 
                                                                                 ? 'NAMA PRODUK' 
                                                                                 : data_get($value, 'NamaProduk') }}
                                                                            </span>
                                                                        </h5>
                                                                    </span>
                                                                </div>
                                                                <div class="sidebar-list-job" style="padding-top: 15px">
                                                                    <span class="card-job-top--post-time text-md" style="font-size: 14px !important">
                                                                        &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;
                                                                        {{ data_get($value, 'pengeluar.NamaSyarikat') == null 
                                                                         ? data_get($value, 'pengeluar.NamaWakil') 
                                                                         : data_get($value, 'pengeluar.NamaSyarikat') }}
                                                                    </span><br>
                                                                </div>
                                                                <div class="sidebar-list-job" style="padding-top: 15px">
                                                                    <span class="card-job-top--post-time text-md" style="font-size: 14px !important">
                                                                        &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;
                                                                        {{ data_get($value, 'Keterangan') == null 
                                                                         ? 'Keterangan' 
                                                                         : data_get($value, 'Keterangan') }}
                                                                    </span><br>
                                                                </div>
                                                                <div class="sidebar-list-job" style="padding-top: 15px">
                                                                    <span class="card-job-top--post-time text-md" style="font-size: 14px !important">
                                                                        &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;
                                                                        {{ data_get($value, 'jenisproduk.description') == null 
                                                                         ? 'Jenis Produk' 
                                                                         : data_get($value, 'jenisproduk.description') }}
                                                                    </span><br>
                                                                </div>
                                                                <div class="sidebar-list-job" style="padding-top: 15px">
                                                                    <span class="card-job-top--post-time text-md" style="font-size: 14px !important">
                                                                        &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;
                                                                        {{ data_get($value, 'pengeluar.mediasosial.description') == null 
                                                                         ? 'Media Sosial' 
                                                                         : data_get($value, 'pengeluar.mediasosial.description') }}
                                                                    </span><br>
                                                                </div>
                                                                <div class="sidebar-list-job" style="padding-top: 15px">
                                                                    <span class="card-job-top--post-time text-md" style="font-size: 14px !important">
                                                                        &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;

                                                                        @if( data_get($value, 'pengeluar.LinkMediaSosial') )
                                                                            <a href="http://{{ data_get($value, 'pengeluar.LinkMediaSosial') }}" style="font-weight: bolder;" target="_blank">
                                                                                {{ data_get($value, 'pengeluar.LinkMediaSosial') }}
                                                                            </a>
                                                                        @else
                                                                            Link Media Sosial
                                                                        @endif
                                                                        
                                                                    </span><br>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

			@endforeach
		</div>
	</div>