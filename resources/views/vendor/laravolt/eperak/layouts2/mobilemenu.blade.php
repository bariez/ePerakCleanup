
	<?php

		use Workbench\Site\Model\Frontend\Menum;
		use Workbench\Site\Model\Frontend\ContentPage;

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

			<div class="header-nav d-block d-sm-none">
				<div class="burger-icon burger-icon-white" style="top: 25px;">
					<span class="burger-icon-top"></span>
					<span class="burger-icon-mid"></span>
					<span class="burger-icon-bottom"></span>
				</div>
			</div>
			<div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar">
				<div class="mobile-header-wrapper-inner">
					<div class="mobile-header-top">
						<div class="user-account">
							<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" />
							<div class="content">
								<h6 class="user-name">Selamat Datang, <span class="text-brand">Administrator</span></h6>
								<!-- <p class="font-xs text-muted">You have 2 new messages</p> -->
							</div>
						</div>
					</div>
					<div class="mobile-header-content-area">
						<div class="perfect-scroll">
							<div class="mobile-search mobile-header-border mb-30">
								<form action="#" style="padding-top: 0px">
									<input type="text" placeholder="Carian" />
									<i class="fi-rr-search"></i>
								</form>
							</div>
							<div class="mobile-menu-wrap mobile-header-border">
								<!-- mobile menu start -->
									<nav>
										<ul class="mobile-menu font-heading">
											<li class="">
												<a class="active" href="/">Laman Utama</a>
												<!-- <ul class="sub-menu">
													<li>
														<a href="index.html">Home 1</a>
													</li>
													<li>
														<a href="index-2.html">Home 2</a>
													</li>
													<li>
														<a href="index-3.html">Home 3</a>
													</li>
												</ul> -->
											</li>
											<li class="">
												<a href="/info">Info Petempatan</a>
												<!-- <ul class="sub-menu">
													<li>
														<a href="job-grid.html">Job Grid</a>
													</li>
													<li>
														<a href="job-grid-2.html">Job Grid 2</a>
													</li>
													<li>
														<a href="job-list.html">Job List</a>
													</li>
													<li class="hr">
														<span></span>
													</li>
													<li>
														<a href="job-single.html">Job Single 01</a>
													</li>
													<li>
														<a href="job-single-2.html">Job Single 02</a>
													</li>
													<li>
														<a href="job-single-3.html">Job Single 03</a>
													</li>
												</ul> -->
											</li>
											
											@foreach($page as $key => $pages)
												<li class="">
													<a href="/page/{{ data_get($pages, 'menum.id') }}">
														{{ data_get($pages, 'menum.nama') }}
													</a>
												</li>
											@endforeach

											<li class="has-children">
												<a href="/contactus" style="">
													<img src="{{ asset('theme/assets/imgs/theme/perak/hubungi.png') }}" alt="Hubungi Kami" title="Hubungi Kami" width="25" height="25">
												</a>
												<a href="/faq" style="">
													<img src="{{ asset('theme/assets/imgs/theme/perak/faq.png') }}" alt="Soalan Lazim" title="Soalan Lazim" width="25" height="25">&nbsp;&nbsp;
												</a>
												<a href="javascript:;">
													<img src="{{ asset('theme/assets/imgs/theme/perak/wheelchair.png') }}" alt="Peta Laman" title="Peta Laman" width="23" height="26"> 
												</a>
												<ul class="sub-menu">
													<li><a href="index.html"><i class="fi fi-rr-zoom-in"></i>&nbsp;&nbsp;Tambah Saiz</a></li>
													<li><a href="index-2.html"><i class="fi fi-rr-zoom-out"></i>&nbsp;&nbsp;Kurangkan Saiz</a></li>
													<li><a href="index-3.html"><i class="fi fi-rr-fill"></i>&nbsp;&nbsp;Grayscale</a></li>
												</ul>
											</li>
										</ul>
									</nav>
								<!-- mobile menu end -->
							</div>
							<div class="mobile-account text-end">
								<!-- <h6 class="mb-10">Akaun anda</h6> -->
								<ul class="mobile-menu font-heading">
									<!-- <li>
										<a href="#">Ili Natasha</a>
									</li>
									<li>
										<a href="#">Administrator</a>
									</li> -->
									<li>
										<a href="/auth/login" class="btn btn-default btn-shadow ml-10 hover-up">Log Keluar</a>
									</li>
								</ul>
							</div>
							<!-- <div class="mobile-social-icon mb-50">
								<h6 class="mb-25">Follow Us</h6>
								<a href="#">
									<img src="{{ asset('theme/assets/imgs/theme/icons/icon-facebook.svg') }}" alt="jobhub" />
								</a>
								<a href="#">
									<img src="{{ asset('theme/assets/imgs/theme/icons/icon-twitter.svg') }}" alt="jobhub" />
								</a>
								<a href="#">
									<img src="{{ asset('theme/assets/imgs/theme/icons/icon-instagram.svg') }}" alt="jobhub" />
								</a>
								<a href="#">
									<img src="{{ asset('theme/assets/imgs/theme/icons/icon-pinterest.svg') }}" alt="jobhub" />
								</a>
								<a href="#">
									<img src="{{ asset('theme/assets/imgs/theme/icons/icon-youtube.svg') }}" alt="jobhub" />
								</a>
							</div>
							<div class="site-copyright">Copyright 2022 © JobHub. <br />Designed by AliThemes. </div> -->
						</div>
					</div>
				</div>
			</div>
		