

	<?php

		use Workbench\Site\Model\Frontend\Logo;
		use Workbench\Site\Model\Frontend\Menum;
		use Workbench\Site\Model\Frontend\ContentPage;
		use Workbench\Site\Model\Lookup\AclRoleUser;

		$logo  = Logo::where('status', 1)
					 // ->where('type', 1)
					 ->get();

		// $jata  = Logo::where('status', 1)
		// 			 ->where('type', 2)
		// 			 ->first();

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

		$user     = auth()->user();
		$roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))
							   ->with('acl_roles')
							   ->first();

							   // dd($roleuser->acl_roles->name);exit;

	?>



	<!-- <header class="header sticky-bar" style="background-color: #FEED21 !important; padding-top: 5px; padding-bottom: 5px; position: unset !important;"> -->
	<header class="header sticky-bar" style="background-image: url('{{ asset('theme/assets/imgs/theme/perak/headerbgfive.jpeg') }}') !important; background-size: cover; background-repeat: no-repeat; padding-top: 15px; padding-bottom: 15px; position: unset !important;">

		<!-- end first row ------------------------------------------------------------- -->
			<div class="container" style="max-width: 95% !important">
				<div class="main-header">

					<!-- logo big device start ----------------------------------------------------------- -->
					<div class="header-left d-none d-lg-block" style="width: 80%">
						<div class="header-logo" style="margin-right: 10px !important ">
							<div class="d-flex">
								<!-- foreach($logo as $key => $logos) -->

								@if( data_get($logo->where('type', 2)->first(), 'path') )
									@if( file_exists( public_path( data_get($logo->where('type', 2)->first(), 'path') ) ) )
										<a href="/">
											<img src="{!! URL::to(data_get($logo->where('type', 2)->first(), 'path')) !!}" alt="{{ data_get($logo->where('type', 2)->first(), 'filename') }}" title="Jata" style="height: 60px">&nbsp;
										</a>
									@else
										<a href="/">
											<img src="{{ asset('logo.png') }}" alt="{{ data_get($logo->where('type', 2)->first(), 'filename') }}" title="Jata" style="height: 60px">&nbsp;
										</a>
									@endif
								@else

								@endif

								@if( data_get($logo->where('type', 1)->first(), 'path') )
									@if( file_exists( public_path( data_get($logo->where('type', 1)->first(), 'path') ) ) )
										<a href="/">
											<img src="{!! URL::to(data_get($logo->where('type', 1)->first(), 'path')) !!}" alt="{{ data_get($logo->where('type', 1)->first(), 'filename') }}" title="Logo" style="height: 60px">&nbsp;&nbsp;
										</a>
									@else
										<a href="/">
											<img src="{{ asset('logo.png') }}" alt="{{ data_get($logo->where('type', 1)->first(), 'filename') }}" title="Logo" style="height: 60px">&nbsp;
										</a>
									@endif
								@else

								@endif

								<!-- endforeach -->
								<h6 class="mr-10" style=" margin-top: 18px">
									<a href="/">
										<p style="color: white; font-size: 50px; font-family: Cambria, Perpetua, Times New Roman">
											PORTAL RASMI e-PERAK
										</p>
									</a>
								</h6>
							</div>
						</div>
					</div>
					<!-- logo end ------------------------------------------------------------- -->

					<!-- icon kecik start ------------------------------------------------------------- -->
					<div class="header-right d-none d-lg-block" style="width: 50%; margin-right: 0px">
						<div class="block-signin">
							<div class="header-nav" style="float: right;">
								<!-- <nav class="nav-main-menu d-none d-sm-block"> -->
								<nav class="nav-main-menu d-none d-lg-block">
									<ul class="main-menu">
										<!-- start icon ------------------------------------------------------------- -->
											<li class="signin">
												<a href="javascript:;" style="text-decoration: none; padding: 3px; padding-top: 10px; padding-right: 5px; ">
													<img src="{{ asset('theme/assets/imgs/theme/perak/wheelchair3.png') }}" alt="Bantuan" title="Bantuan" width="23" height="26">
												</a>
												<ul class="sub-menu">
													<li>
														<a href="javascript:;" onclick="changeSizeByBtn('3')"><i class="fi fi-rr-zoom-in"></i>&nbsp;&nbsp;Tambah Saiz</a>
													</li>
													<li>
														<a href="javascript:;" onclick="changeSizeByBtn('2')"><i class="fi fi-rr-zoom-in"></i>&nbsp;&nbsp;Set Semula Saiz</a>
													</li>
													<li>
														<a href="javascript:;" onclick="changeSizeByBtn('1')"><i class="fi fi-rr-zoom-out"></i>&nbsp;&nbsp;Kurangkan Saiz</a>
													</li>
													<!-- <li>
														<a href="javascript:;"><i class="fi fi-rr-fill"></i>&nbsp;&nbsp;Grayscale</a>
													</li> -->
												</ul>
											</li>
											<li class="signin">
												<a href="/contactus" style="text-decoration: none; padding: 3px; padding-top: 10px; padding-right: 5px;">
													<img src="{{ asset('theme/assets/imgs/theme/perak/hubungi3.png') }}" alt="Hubungi Kami" title="Hubungi Kami" width="25" height="25">
												</a>
											</li>
											<li class="signin">
												<a href="/faq" style="text-decoration: none; padding: 3px; padding-top: 10px; padding-right: 5px;">
													<img src="{{ asset('theme/assets/imgs/theme/perak/faq3.png') }}" alt="Soalan Lazim" title="Soalan Lazim" width="25" height="25">
												</a>
											</li>
											<li class="signin">
												<a href="javascript:;" style="text-decoration: none; padding: 3px; padding-top: 10px; padding-right: 15px;">
													<img src="{{ asset('theme/assets/imgs/theme/perak/search.png') }}" alt="Carian" title="Carian" width="23" height="26">
												</a>
												<ul class="sub-menu">
													<li style="padding-left: 10px; padding-right: 10px">
														 <!-- Form::open()->url('/search')->method('POST')->class('ui form horizontal'); !!} -->
														{!! form()->open()->post()->action(route('frontend.postSearch'))->attribute('id', 'formsearch')->multipart()->horizontal() !!}
															<input type="text" name="carian" id="idcarian" placeholder="Carian..." style="min-width: 250px">
														{!! Form::close() !!}
													</li>
												</ul>
											</li>
										<!-- end icon ------------------------------------------------------------- -->

										<!-- start login button ------------------------------------------------------------- -->
											<li class="signin mr-5">
												@auth
													<div class="btn-group" role="group" aria-label="Basic example">
														<a href="/home" class="btn btn-default btn-shadow hover-up" style="color: white; background-color: #432712">
															{{ data_get($roleuser, 'acl_roles.name') }}
														</a>
                                                        <a href="/auth/addlog/{{(auth()->user()->id)}}" class="btn btn-light btn-shadow hover-up" style="color: #432712">LOG KELUAR</a>
													</div>
												@else
													<div class="btn-group" role="group" aria-label="Basic example">
														<a href="/auth/login" class="btn btn-default btn-shadow hover-up" style="color: white; background-color: #432712">Log Masuk</a>
														<a href="/auth/register" class="btn btn-light btn-shadow hover-up" style="color: #432712">Daftar</a>
														<!-- <button type="button" class="btn btn-outline-light btn-shadow hover-up">Daftar</button> -->
													</div>
												@endauth
											</li>
										<!-- end login button ------------------------------------------------------------- -->
									</ul>
								</nav>
							</div>
						</div>
					</div>
					<!-- icon kecik end --------------------------------------------------------------- -->

					<!-- logo small device start ----------------------------------------------------------- -->
					<div class="header-left d-lg-none d-xl-none" style="width: 100%">
						<div class="header-logo" style="margin-right: 10px !important ">
							<div class="d-flex">
								<!-- foreach($logo as $key => $logos) -->

								@if( data_get($logo->where('type', 2)->first(), 'path') )
									@if( file_exists( public_path( data_get($logo->where('type', 2)->first(), 'path') ) ) )
										<a href="/">
											<img src="{!! URL::to(data_get($logo->where('type', 2)->first(), 'path')) !!}" alt="{{ data_get($logo->where('type', 2)->first(), 'filename') }}" title="Jata" style="height: 60px">&nbsp;
										</a>
									@else
										<img src="{{ asset('logo.png') }}" alt="{{ data_get($logo->where('type', 2)->first(), 'filename') }}" title="Jata" style="height: 60px">&nbsp;
									@endif
								@else

								@endif

								@if( data_get($logo->where('type', 1)->first(), 'path') )
									@if( file_exists( public_path( data_get($logo->where('type', 1)->first(), 'path') ) ) )
										<a href="/">
											<img src="{!! URL::to(data_get($logo->where('type', 1)->first(), 'path')) !!}" alt="{{ data_get($logo->where('type', 1)->first(), 'filename') }}" title="Logo" style="height: 60px">&nbsp;&nbsp;
										</a>
									@else
										<a href="/">
											<img src="{{ asset('logo.png') }}" alt="{{ data_get($logo->where('type', 1)->first(), 'filename') }}" title="Logo" style="height: 60px">&nbsp;
										</a>
									@endif
								@else

								@endif

								<!-- endforeach -->
								<a href="/">
									<h6 class="mr-10" style=" margin-top: 7px">
										<div class="d-md-block d-sm-none d-none">
											<p style="color: white; font-size: 50px; font-family: Cambria, Perpetua, Times New Roman">
												PORTAL RASMI e-PERAK
											</p>
										</div>
										<div class="d-md-none d-sm-block">
											<p style="color: white; font-size: 30px; font-family: Cambria, Perpetua, Times New Roman">
												PORTAL RASMI e-PERAK
											</p>
										</div>
									</h6>
								</a>
							</div>
						</div>
					</div>
					<!-- logo end ------------------------------------------------------------- -->

					<!-- icon kecik start ------------------------------------------------------------- -->
					<div class="header-right d-lg-none d-xl-none" style="width: 0%; margin-right: 0px">
						<div class="block-signin">
							<div class="header-nav" style="float: right;">
								<!-- <nav class="nav-main-menu d-none d-sm-block"> -->
								<nav class="nav-main-menu d-none d-lg-block">
									<ul class="main-menu">
										<!-- start icon ------------------------------------------------------------- -->
											<li class="signin">
												<a href="javascript:;" style="text-decoration: none; padding: 3px; padding-top: 10px; padding-right: 5px; ">
													<img src="{{ asset('theme/assets/imgs/theme/perak/wheelchair3.png') }}" alt="Bantuan" title="Bantuan" width="23" height="26">
												</a>
												<ul class="sub-menu">
													<li>
														<a href="javascript:;" onclick="changeSizeByBtn('3')"><i class="fi fi-rr-zoom-in"></i>&nbsp;&nbsp;Tambah Saiz</a>
													</li>
													<li>
														<a href="javascript:;" onclick="changeSizeByBtn('2')"><i class="fi fi-rr-zoom-in"></i>&nbsp;&nbsp;Set Semula Saiz</a>
													</li>
													<li>
														<a href="javascript:;" onclick="changeSizeByBtn('1')"><i class="fi fi-rr-zoom-out"></i>&nbsp;&nbsp;Kurangkan Saiz</a>
													</li>
													<!-- <li>
														<a href="javascript:;"><i class="fi fi-rr-fill"></i>&nbsp;&nbsp;Grayscale</a>
													</li> -->
												</ul>
											</li>
											<li class="signin">
												<a href="/contactus" style="text-decoration: none; padding: 3px; padding-top: 10px; padding-right: 5px;">
													<img src="{{ asset('theme/assets/imgs/theme/perak/hubungi3.png') }}" alt="Hubungi Kami" title="Hubungi Kami" width="25" height="25">
												</a>
											</li>
											<li class="signin">
												<a href="/faq" style="text-decoration: none; padding: 3px; padding-top: 10px; padding-right: 15px;">
													<img src="{{ asset('theme/assets/imgs/theme/perak/faq3.png') }}" alt="Soalan Lazim" title="Soalan Lazim" width="25" height="25">
												</a>
											</li>
											<!-- <li class="signin">
												<a href="javascript:;" style="text-decoration: none; padding: 3px; padding-top: 10px; padding-right: 15px;">
													<img src=" asset('theme/assets/imgs/theme/perak/search.png') }}" alt="Carian" title="Carian" width="23" height="26">
												</a>
												<ul class="sub-menu">
													<li style="padding-left: 10px; padding-right: 10px">
														 Form::open()->url('/search')->method('POST')->class('ui form horizontal'); !!}
															<input type="text" name="carian" id="idcarian" placeholder="Carian..." style="min-width: 250px">
														 Form::close() !!}
													</li>
												</ul>
											</li> -->
										<!-- end icon ------------------------------------------------------------- -->

										<!-- start login button ------------------------------------------------------------- -->
											<li class="signin mr-5">
												@auth
													<div class="btn-group" role="group" aria-label="Basic example">
														<a href="/home" class="btn btn-default btn-shadow hover-up" style="color: white; background-color: #432712">
															{{ data_get($roleuser, 'acl_roles.name') }}
														</a>
                                                        <a href="/auth/addlog/{{(auth()->user()->id)}}" class="btn btn-light btn-shadow hover-up" style="color: #432712">LOG KELUAR</a>
													</div>
												@else
													<div class="btn-group" role="group" aria-label="Basic example">
														<a href="/auth/login" class="btn btn-default btn-shadow hover-up" style="color: white; background-color: #432712">Log Masuk</a>
														<a href="/auth/register" class="btn btn-light btn-shadow hover-up" style="color: #432712">Daftar</a>
														<!-- <button type="button" class="btn btn-outline-light btn-shadow hover-up">Daftar</button> -->
													</div>
												@endauth
											</li>
										<!-- end login button ------------------------------------------------------------- -->
									</ul>
								</nav>
							</div>
						</div>
					</div>
					<!-- icon kecik end --------------------------------------------------------------- -->



				</div>
			</div>
		<!-- end first row ------------------------------------------------------------- -->

		<!-- start menu foreach ------------------------------------------------------------- -->
			<div class="container" style="">
				<div class="main-header">
					<div class="header-nav">
						<nav class="nav-main-menu">
							<!-- <ul class="main-menu d-none d-sm-block"> -->
							<ul class="main-menu d-none d-lg-block">
								<li class="">
									<a class="active" href="/" id="mainmenu" style="font-weight: 900; padding-right: 7px !important; padding-left: 0px !important; color: white; font-size: 14.5px; text-shadow: 0 0 5px #000000;">
										LAMAN UTAMA
									</a>
								</li>
								<li>
									<a class="active" href="javascript:;" id="" style="font-weight: 900; padding-right: 0px !important; padding-left: 0px !important; color: white; font-size: 7px">
										|
									</a>
								</li>
								<li class="">
									<a href="/info" id="infomenu" style="font-weight: 900; padding-left: 7px !important; padding-right: 7px !important; color: white; font-size: 14.5px; text-shadow: 0 0 5px #000000;">
										INFO PETEMPATAN
									</a>
								</li>

								@foreach($page as $key => $pages)
									<li>
										<a class="active" href="javascript:;" id="" style="font-weight: 900; padding-right: 0px !important; padding-left: 0px !important; color: white; font-size: 7px">
											|
										</a>
									</li>
									<li class="">
										<a href="/page/{{ data_get($pages, 'menum.id') }}" class="pagemenuc" id="pagemenu{{ data_get($pages, 'id') }}"
										   style="font-weight: 900; padding-right: 7px !important; padding-left: 7px !important; color: white; font-size: 14.5px; text-shadow: 0 0 5px #000000;">
											{{ strtoupper(data_get($pages, 'menum.nama')) }}
										</a>
									</li>
								@endforeach

								<li>
									<a class="active" href="javascript:;" id="" style="font-weight: 900; padding-right: 0px !important; padding-left: 0px !important; color: white; font-size: 7px">
										|
									</a>
								</li>
								<li class="signin">
									<a href="/contactus" id="contactus" style="text-decoration: none; font-weight: 900; padding-right: 7px !important; padding-left: 7px !important; color: white; font-size: 14.5px; text-shadow: 0 0 5px #000000;">
										HUBUNGI KAMI
										<!-- <img src=" asset('theme/assets/imgs/theme/perak/hubungi.png') }}" alt="Hubungi Kami" title="Hubungi Kami" width="25" height="25"> -->
									</a>
								</li>
								<li>
									<a class="active" href="javascript:;" id="" style="font-weight: 900; padding-right: 0px !important; padding-left: 0px !important; color: white; font-size: 7px">
										|
									</a>
								</li>
								<li class="signin">
									<a href="/faq" id="faq" style="text-decoration: none; font-weight: 900; padding-left: 10px !important; padding-right: 10px !important; color: white; font-size: 14.5px; text-shadow: 0 0 5px #000000;">
										SOALAN LAZIM
										<!-- <img src=" asset('theme/assets/imgs/theme/perak/faq.png') }}" alt="Soalan Lazim" title="Soalan Lazim" width="25" height="25"> -->
									</a>
								</li>
								<li>
									<a class="active" href="javascript:;" id="" style="font-weight: 900; padding-right: 0px !important; padding-left: 0px !important; color: white; font-size: 7px">
										|
									</a>
								</li>
								<li class="signin">
									<a href="/manual" id="manual" style="text-decoration: none; font-weight: 900; padding-left: 10px !important; padding-right: 10px !important; color: white; font-size: 14.5px; text-shadow: 0 0 5px #000000;">
										MANUAL PENGGUNA
										<!-- <img src=" asset('theme/assets/imgs/theme/perak/manual.png') }}" alt="Manual Pengguna" title="Manual Pengguna" width="25" height="25"> -->
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		<!-- end menu foreach ------------------------------------------------------------- -->

	</header>
