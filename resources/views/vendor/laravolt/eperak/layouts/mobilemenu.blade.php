
	<?php

		use Workbench\Site\Model\Frontend\Menum;
		use Workbench\Site\Model\Frontend\ContentPage;
		use Workbench\Site\Model\Lookup\AclRoleUser;

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

	?>

			<!-- <div class="header-nav d-block d-sm-none d-md-none"> -->
			<div class="header-nav d-lg-none d-xl-none">
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
								<h6 class="user-name">Selamat Datang <br/>
									@auth
										<span class="text-brand">{{ data_get($roleuser, 'acl_roles.name') }}</span></h6>
									@else
									@endauth
								<!-- <p class="font-xs text-muted">You have 2 new messages</p> -->
							</div>
						</div>
					</div>
					<div class="mobile-header-content-area">
						<div class="perfect-scroll" style="width: unset !important;">
							<!-- <div class="mobile-search mobile-header-border mb-30"> -->
								<!-- <form action="#" style="padding-top: 0px">
									<input type="text" placeholder="Carian" />
									<i class="fi-rr-search"></i>
								</form> -->

								{!! form()->open()->post()->action(route('frontend.postSearch'))->attribute('id', 'formsearch')->multipart()->horizontal() !!}
									<input type="text" name="carian" id="idcarian" placeholder="Carian..." style="min-width: 250px">
								{!! Form::close() !!}

								<!--  Form::open()->url('/search')->method('POST')->style('padding-top: 0px'); !!} -->
									<!-- <i class="fi-rr-search"></i><input type="text" name="carian" id="idcarian" placeholder="Carian..." style="min-width: 250px"> -->
								<!--  Form::close() !!} -->

							<!-- </div> -->
							<div class="mobile-menu-wrap mobile-header-border">
								<!-- mobile menu start -->
									<nav>
										<ul class="mobile-menu font-heading">
											<li class="">
												<a class="active" href="/">Laman Utama</a>
											</li>
											<li class="">
												<a href="/info">Info Petempatan</a>
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
												<a href="#">
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
													<!-- <li>
														<a href="javascript:;"><i class="fi fi-rr-fill"></i>&nbsp;&nbsp;Grayscale</a>
													</li> -->
												</ul>
											</li>
										</ul>
									</nav>
								<!-- mobile menu end -->
							</div>
							<div class="mobile-account text-end">
								<ul class="mobile-menu font-heading">
									<li>

										@auth
											<div class="btn-group" role="group" aria-label="Basic example">
												<a href="/home" class="btn btn-default btn-shadow hover-up" style="color: white; background-color: #432712">
													{{ data_get($roleuser, 'acl_roles.name') }}
												</a>
                                                <a href="/auth/addlog/{{(auth()->user()->id)}}" class="btn btn-light btn-shadow hover-up" style="color: #432712">LOG KELUAR</a>
											</div>
										@else
											<div class="btn-group" role="group" aria-label="Basic example">
												<a href="/auth/register" class="btn btn-light btn-shadow hover-up" style="color: #432712">Daftar</a>
												<a href="/auth/login" class="btn btn-default btn-shadow hover-up" style="color: white; background-color: #432712">Log Masuk</a>
												<!-- <button type="button" class="btn btn-outline-light btn-shadow hover-up">Daftar</button> -->
											</div>
										@endauth

									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
