

    <?php

        use Workbench\Site\Model\Frontend\Logo;
        use Workbench\Site\Model\Frontend\Hubungi;
        use Workbench\Site\Model\Frontend\Counter;
        use Workbench\Site\Model\Lookup\AuditLog;

        $logo  = Logo::where('status', 1)
                     ->where('type', 1)
                     ->first();

        $jata  = Logo::where('status', 1)
                     ->where('type', 2)
                     ->first();

        $contactus  = Hubungi::where('status', 1)
                             ->first();

        $counter  = Counter::first();

        $editdate = AuditLog::orderBy('id', 'desc')
                            ->first();

    ?>



	<!-- <footer class="footer pt-50 " style="background: #FEED21;"> --> <!-- mt-10 -->
    <footer class="footer pt-50" style="background-image: url('{{ asset('theme/assets/imgs/theme/perak/bgfooterfive.jpeg') }}') !important; /*background-size: cover; background-repeat: no-repeat;*/ padding-top: 5px; padding-bottom: 5px;">        
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="header-logo">
						<a href="/" class="d-flex">
							<!-- <img alt="e-Perak" src="{{ asset('theme/assets/imgs/theme/perak/favicon-perak.png') }}" style="height: 60px" />&nbsp;&nbsp;&nbsp; -->

                                @if( data_get($jata, 'path') )
                                    @if( file_exists( public_path( data_get($jata, 'path') ) ) )
                                        <img src="{!! URL::to(data_get($jata, 'path')) !!}" alt="{{ data_get($jata, 'filename') }}" title="Jata" style="height: 60px">&nbsp;
                                    @else
                                        <img src="{{ asset('logo.png') }}" alt="{{ data_get($jata, 'filename') }}" title="Jata" style="height: 60px">&nbsp;
                                    @endif
                                @else
                                    
                                @endif

                                @if( data_get($logo, 'path') )
                                    @if( file_exists( public_path( data_get($logo, 'path') ) ) )
                                        <img src="{!! URL::to(data_get($logo, 'path')) !!}" alt="{{ data_get($logo, 'filename') }}" title="Logo" style="height: 60px">&nbsp;&nbsp;
                                    @else
                                        <img src="{{ asset('logo.png') }}" alt="{{ data_get($jata, 'filename') }}" title="Logo" style="height: 60px">&nbsp;
                                    @endif
                                @else
                                    
                                @endif

                                <h6 class="mr-10" style=" margin-top: 18px">
                                    <p style="color: white; font-size: 30px; font-family: Cambria, Perpetua, Times New Roman">
                                        PORTAL RASMI e-PERAK 
                                    </p>
                                </h6>
						</a>
					</div>
					<div class="mt-20 mb-20" style="text-align: justify; color: white">
						Mendokumentasikan profil kampung Jawatankuasa Pembangunan dan Keselamatan Kampung (JPKK) di seluruh negeri Perak dalam bentuk spatial dan atribut selain membantu kerajaan negeri dan 
						828 JPKK dalam merancang projek-projek dan program-program pembangunan di kawasan luar bandar
					</div>
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-3 col-xs-12">
					<h6 style="color: white">Hubungi Kami</h6>
					<ul class="menu-footer mt-20">
                        <li>
                            <a href="javascript:;" style="color: white">
                            	Portal e-Perak
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" style="color: white">
                            	{{ data_get($contactus, 'alamat') }}
                            </a>
                        </li>
					</ul>
				</div>
				<div class="col-md-2 col-xs-12">
                    <h6 class="d-none d-sm-block">&nbsp;</h6>
                    <ul class="menu-footer mt-20">
                        <li><a href="javascript:;" style="color: white">Emel : {{ data_get($contactus, 'email') }}</a></li>
                        <li><a href="javascript:;" style="color: white">No. Tel: {{ data_get($contactus, 'no_tel') }}</a></li>
                        <li><a href="javascript:;" style="color: white">No. Fax: {{ data_get($contactus, 'no_faks') }}</a></li>
                    </ul>
				</div>
			</div>
            <div class="footer-bottom mt-50" style="border-top: 1px solid white;">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <center style="color: white">© 2022 e-Perak, Perak Darul Ridzuan. Hak cipta terpelihara. Tiada bahagian laman web ini boleh diterbitkan tanpa kebenaran bertulis dari pihak e-Perak.</center>
                    </div>
                    <div class="col-md-1 col-xs-12"></div>
                    <div class="col-md-3 col-xs-6 text-end">
                        <ul class="menu-footer">
                            <li><a href="javascript:;" style="color: white">Jumlah Pelawat :</a></li>
                            <li><a href="javascript:;" style="color: white">Dikemaskini Pada :</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-xs-6">
                        <ul class="menu-footer">
                            <li><a href="javascript:;" style="color: white">{{ data_get($counter, 'count') }}</a></li>
                            <li><a href="javascript:;" style="color: white">{{ date('d-M-Y h:i:s A', strtotime( data_get($editdate, 'created_at') )) }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
		</div>
	</footer>


<!-- <script>
    setInterval(myTimer, 1000);

    function myTimer() 
    {
        const date = new Date();
        document.getElementById("demo").innerHTML = date.toLocaleTimeString();
    }
</script> -->