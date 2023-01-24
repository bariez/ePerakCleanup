

    <?php

        use Workbench\Site\Model\Frontend\Logo;
        use Workbench\Site\Model\Frontend\Hubungi;

        $logo  = Logo::where('status', 1)
                     ->where('type', 1)
                     ->first();

        $jata  = Logo::where('status', 1)
                     ->where('type', 2)
                     ->first();

        $contactus  = Hubungi::where('status', 1)
                             ->first();

    ?>



	<!-- <footer class="footer pt-50 " style="background: #FEED21;"> --> <!-- mt-10 -->
    <footer class="footer pt-50" style="background-image: url('{{ asset('theme/assets/imgs/theme/perak/bgfooterfive.jpeg') }}') !important; /*background-size: cover; background-repeat: no-repeat;*/ padding-top: 5px; padding-bottom: 5px;">        
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12">
                    
                    <!-- logo start ----------------------------------------------------------- -->
                    <div class="header-logo mr-0 ml-25">
                        <a class="d-flex" target="_blank" href="/">
                            <!-- foreach($logo as $key => $logos) -->
                                <img src="{!! URL::to(data_get($jata, 'path')) !!}" alt="{{ data_get($jata, 'filename') }}" style="height: 60px">&nbsp;
                                <img src="{!! URL::to(data_get($logo, 'path')) !!}" alt="{{ data_get($logo, 'filename') }}" style="height: 60px">&nbsp;&nbsp;
                            <!-- endforeach -->
                            <h6 class="mt-20 mr-10" style="color: white">
                                <strong>PORTAL RASMI e-PERAK</strong>
                            </h6>
                        </a>
                    </div>
                    <!-- logo end ------------------------------------------------------------- -->

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
                            <li><a href="javascript:;" style="color: white">49638</a></li>
                            <li><a href="javascript:;" style="color: white">{{ date('d-M-Y') }} 08:35:21<!-- <p id="demo"></p> --> </a></li>
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