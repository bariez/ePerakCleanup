

	<?php

		use Workbench\Site\Model\Frontend\Logo;
		use Workbench\Site\Model\Frontend\Menum;
		use Workbench\Site\Model\Frontend\ContentPage;

		$logo  = Logo::where('status', 1)
					 ->where('type', 1)
					 ->first();

		$jata  = Logo::where('status', 1)
					 ->where('type', 2)
					 ->first();

		$menum  = Menum::where('status', 1)
					   ->with('contentpage')
					   ->get();

		$page  = ContentPage::where('status', 1)
							->whereHas('menum', function ($query)
							{
								$query->where('status', 1);
							})
							->with('menum')
							->get();

	?>



	<!-- <header class="header sticky-bar" style="background-color: #FEED21 !important; padding-top: 5px; padding-bottom: 5px; position: unset !important;"> -->
	<header class="header" style="background-image: url('{{ asset('theme/assets/imgs/theme/perak/headerbgfour.jpeg') }}') !important; background-size: cover; background-repeat: no-repeat; padding-top: 15px; padding-bottom: 15px; position: unset !important;">
		<div class="container" style="max-width: 95% !important">
			<div class="main-header">
				<div class="header-left" style="width: 100%">

					<!-- logo start ----------------------------------------------------------- -->
					<div class="header-logo ml-25" style="margin-right: 30px !important ">
						<a class="d-flex" target="_blank" href="/">
							<!-- foreach($logo as $key => $logos) -->
								<img src="{!! URL::to(data_get($jata, 'path')) !!}" alt="{{ data_get($jata, 'filename') }}" style="height: 60px">&nbsp;
								<img src="{!! URL::to(data_get($logo, 'path')) !!}" alt="{{ data_get($logo, 'filename') }}" style="height: 60px">&nbsp;&nbsp;
							<!-- endforeach -->
							<h6 class="mr-10" style=" margin-top: 17px">
								<p style="font-size: 20px; color: white">
									PORTAL RASMI e-PERAK
								</p>
							</h6>
						</a>
					</div>
					<!-- logo end ------------------------------------------------------------- -->

					<!-- menu start ----------------------------------------------------------- -->
					<div class="header-nav">
						<nav class="nav-main-menu">
							<ul class="main-menu d-none d-sm-block">
								<li class="">
									<a class="active" href="/" id="mainmenu" style="font-weight: 900; padding-right: 10px !important; color: white">
										LAMAN UTAMA 
									</a>
								</li>
								<li>
									<a class="active" href="javascript:;" id="" style="font-weight: 900; padding-right: 0px !important; padding-left: 0px !important; color: white">
										|
									</a>
								</li>
								<li class="">
									<a href="/info" id="infomenu" style="font-weight: 900; padding-left: 10px !important; padding-right: 10px !important; color: white">
										INFO PETEMPATAN
									</a>
								</li>

								@foreach($page as $key => $pages)
									<li>
										<a class="active" href="javascript:;" id="" style="font-weight: 900; padding-right: 0px !important; padding-left: 0px !important; color: white">
											|
										</a>
									</li>
									<li class="">
										<a href="/page/{{ data_get($pages, 'menum.id') }}" class="pagemenuc" id="pagemenu{{ data_get($pages, 'id') }}"  
										   style="font-weight: 900; padding-right: 10px !important; padding-left: 10px !important; color: white">
											{{ strtoupper(data_get($pages, 'menum.nama')) }}
										</a>
									</li>
								@endforeach

								<li>
									<a class="active" href="javascript:;" id="" style="font-weight: 900; padding-right: 0px !important; padding-left: 0px !important; color: white">
										|
									</a>
								</li>
								<li class="signin">
									<a href="/contactus" style="text-decoration: none; font-weight: 900; padding-right: 10px !important; padding-left: 10px !important; color: white">
										HUBUNGI KAMI
										<!-- <img src=" asset('theme/assets/imgs/theme/perak/hubungi.png') }}" alt="Hubungi Kami" title="Hubungi Kami" width="25" height="25"> -->
									</a>
								</li>
								<li>
									<a class="active" href="javascript:;" id="" style="font-weight: 900; padding-right: 0px !important; padding-left: 0px !important; color: white">
										|
									</a>
								</li>
								<li class="signin">
									<a href="/faq" style="text-decoration: none; font-weight: 900; padding-left: 10px !important; padding-right: 10px !important; color: white">
										SOALAN LAZIM
										<!-- <img src=" asset('theme/assets/imgs/theme/perak/faq.png') }}" alt="Soalan Lazim" title="Soalan Lazim" width="25" height="25"> -->
									</a>
								</li>
							</ul>
						</nav>
					</div>
					<!-- menu end ------------------------------------------------------------- -->

				</div>
				<div class="header-right" style="width: 50%">
					<div class="block-signin">

						<!-- icon kecik start ------------------------------------------------------------- -->
						<div class="header-nav" style="float: right;">
							<nav class="nav-main-menu d-none d-sm-block">
								<ul class="main-menu">
									<li class="signin">
										<a href="javascript:;" style="text-decoration: none; font-weight: 900; padding-left: 10px !important; padding-right: 10px !important">
											<!-- W3C -->
											<img src="{{ asset('theme/assets/imgs/theme/perak/wheelchair.png') }}" alt="Peta Laman" title="Peta Laman" width="23" height="26"> 
										</a>
										<ul class="sub-menu">
											<li>
												<a href="javascript:;" onclick="changeSizeByBtn('3')"><i class="fi fi-rr-zoom-in"></i>&nbsp;&nbsp;Tambah Saiz</a>
											</li>
											<li>
												<a href="javascript:;" onclick="changeSizeByBtn('2')"><i class="fi fi-rr-zoom-in"></i>&nbsp;&nbsp;Reset Saiz</a>
											</li>
											<li>
												<a href="javascript:;" onclick="changeSizeByBtn('1')"><i class="fi fi-rr-zoom-out"></i>&nbsp;&nbsp;Kurangkan Saiz</a>
											</li>
											<li>
												<a href="javascript:;"><i class="fi fi-rr-fill"></i>&nbsp;&nbsp;Grayscale</a>
											</li>
										</ul>
									</li>
									<li class="signin mr-5">
										@auth
											<div class="btn-group" role="group" aria-label="Basic example">
												<a href="/home" class="btn btn-default btn-shadow hover-up" style="color: white">Pentadbir Sistem</a>
											</div>
										@else
											<div class="btn-group" role="group" aria-label="Basic example">
												<a href="/auth/login" class="btn btn-default btn-shadow hover-up" style="color: white">Log Masuk</a>
												<a href="/auth/register" class="btn btn-light btn-shadow hover-up" style="">Daftar</a>
												<!-- <button type="button" class="btn btn-outline-light btn-shadow hover-up">Daftar</button> -->
											</div>
										@endauth
									</li>
									<li class="signin ml-5 mr-5">
										<div class="">
											{!! Form::open()->url('/search')->method('POST')->class('ui form horizontal'); !!}
											<!-- <form action="#" style="padding-top: 0px; width: 248px"> -->
												<input type="text" name="carian" id="idcarian" placeholder="Carian" >
											<!-- </form> -->
											{!! Form::close() !!}
										</div>
									</li>
								</ul>
							</nav>

							<!-- searching start ------------------------------------------------------------- -->
							<!-- <nav class="nav-main-menu d-none d-sm-block">
								<ul class="main-menu">
								</ul>
							</nav> -->
							<!-- searching end ------------------------------------------------------------- -->
						</div>
						<!-- icon kecik end --------------------------------------------------------------- -->
						
					</div>

				</div>
			</div>
		</div>
		<div class="container" style="">
			<div class="main-header">
				<div class="header-left">
				</div>
				<div class="header-right">
				</div>
			</div>
		</div>
	</header>