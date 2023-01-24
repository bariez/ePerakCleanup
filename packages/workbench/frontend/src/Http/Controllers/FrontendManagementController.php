<?php

namespace Workbench\Frontend\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Carbon\Carbon;
use DB;
use File;
use Redirect;
use Mail;
use Curl;

use Workbench\Site\Model\Lookup\Parlimen;
use Workbench\Site\Model\Lookup\Dun;
use Workbench\Site\Model\Lookup\Daerah;
use Workbench\Site\Model\Lookup\Mukim;
use Workbench\Site\Model\Lookup\Kampung;
use Workbench\Site\Model\Lookup\LkpMaster;
use Workbench\Site\Model\Lookup\LkpDetail;

use Workbench\Site\Model\Frontend\SoalanLazim;
use Workbench\Site\Model\Frontend\Menum;
use Workbench\Site\Model\Frontend\ContentPage;

use Workbench\Frontend\Data\Repo\FrontendManagementRepo;


class FrontendManagementController extends Controller
{
	public function __construct(FrontendManagementRepo $repos)
	{
		$this->repos = $repos;
	}

	public function index()
	{
		// dd('sini');

		// return view('dashboard::dashboard.index');
		return view('frontend::landing.index');
	}

	// logo -----------------
	public function getLogoList(Request $request)
	{
		$logo = $this->repos->logo($request);

		return view('frontend::management.logo.listlogo' ,compact('logo'));
	}

	public function getLogoAdd(Request $request)
	{
		return view('frontend::management.logo.addlogo');
	}

	public function postLogoSaveAdd(Request $request)
	{
		$data = $this->repos->regSaveLogoAdd($request);

		return redirect::to('site/logo/index')->withSuccess('Logo/Jata Berjaya Ditambah');
	}

	public function getLogoEdit(Request $request)
	{
		$data = $this->repos->logoEdit($request);

		return view('frontend::management.logo.editlogo', compact('data'));
	}

	public function postLogoSaveEdit(Request $request)
	{
		$data = $this->repos->regSaveLogoEdit($request);

		return redirect::to('site/logo/index')->withSuccess('Logo/Jata Berjaya Dikemaskini');
	}

    public function getDeleteLogo(Request $request)
	{
		$data = $this->repos->logoDelete($request);

		return redirect::to('site/logo/index')->withSuccess('Logo/Jata Berjaya Dipadam');
	}

	// banner -----------------
	public function getBannerList(Request $request)
	{
		$data = $this->repos->bannerList($request);

		return view('frontend::management.banner.list' ,compact('data'));
	}

	public function getBannerAdd(Request $request)
	{
		return view('frontend::management.banner.add');
	}

	public function postBannerSaveAdd(Request $request)
	{
		$data = $this->repos->regSaveBannerAdd($request);

		return redirect::to('site/banner/index')->withSuccess('Banner Berjaya Ditambah');
	}

	public function getBannerEdit(Request $request)
	{
		$data = $this->repos->bannerEdit($request);

		return view('frontend::management.banner.edit', compact('data'));
	}

	public function postBannerSaveEdit(Request $request)
	{
		$data = $this->repos->regSaveBannerEdit($request);

		return redirect::to('site/banner/index')->withSuccess('Banner Berjaya Dikemaskini');
	}

    public function getDeleteBanner(Request $request)
	{
		$data = $this->repos->bannerDelete($request);

		return redirect::to('site/banner/index')->withSuccess('Banner Berjaya Dipadam');
	}

	// notis -----------------
	public function getNotisList(Request $request)
	{
		$data = $this->repos->notisList($request);

		return view('frontend::management.notis.list' ,compact('data'));
	}

	public function getNotisAdd(Request $request)
	{
		$daerah = $this->repos->lkpDaerah($request);

		return view('frontend::management.notis.add', compact('daerah'));
	}

	public function postNotisSaveAdd(Request $request)
	{
		$data = $this->repos->regSaveNotisAdd($request);

		return redirect::to('site/notis/index')->withSuccess('Notis Berjaya Ditambah');
	}

	public function getNotisEdit(Request $request)
	{
		$data   = $this->repos->notisEdit($request);
		$daerah = $this->repos->lkpDaerah($request);

		return view('frontend::management.notis.edit', compact('data', 'daerah'));
	}

	public function postNotisSaveEdit(Request $request)
	{
		$data = $this->repos->regSaveNotisEdit($request);

		return redirect::to('site/notis/index')->withSuccess('Notis Berjaya Dikemaskini');
	}

	// hubungi -----------------
	public function getHubungiList(Request $request)
	{
		$data = $this->repos->hubungiList($request);

		return view('frontend::management.hubungi.list' ,compact('data'));
	}

	public function getHubungiAdd(Request $request)
	{
		// $daerah = $this->repos->lkpDaerah($request);

		return view('frontend::management.hubungi.add');
	}

	public function postHubungiSaveAdd(Request $request)
	{
		$data = $this->repos->regSaveHubungiAdd($request);

		return redirect::to('site/hubungi/index')->withSuccess('Hubungi Kami Berjaya Ditambah');
	}

	public function getHubungiEdit(Request $request)
	{
		$data   = $this->repos->hubungiEdit($request);

		return view('frontend::management.hubungi.edit', compact('data'));
	}

	public function postHubungiSaveEdit(Request $request)
	{
		$data = $this->repos->regSaveHubungiEdit($request);

		return redirect::to('site/hubungi/index')->withSuccess('Hubungi Kami Berjaya Dikemaskini');
	}

	// faq -----------------
	public function getSoalanList(Request $request)
	{
		$data = $this->repos->soalanList($request);

		return view('frontend::management.soalan.list' ,compact('data'));
	}

	public function getSoalanAdd(Request $request)
	{
		return view('frontend::management.soalan.add');
	}

	public function postSoalanSaveAdd(Request $request)
	{
		$soalan  = SoalanLazim::where('Susunan', $request->queue)
							  ->where('Status', '1')
							  ->count();

		if($soalan == 0)
		{
			$data = $this->repos->regSaveSoalanAdd($request);

			return redirect::to('site/soalan/index')->withSuccess('Soalan Lazim Berjaya Ditambah');
		}
		else
		{
			return redirect()->back()->withWarning('No Susunan Telah Wujud');
		}
	}

	public function getSoalanEdit(Request $request)
	{
		$data   = $this->repos->soalanEdit($request);

		return view('frontend::management.soalan.edit', compact('data'));
	}

	public function postSoalanSaveEdit(Request $request)
	{
		$soalan  = SoalanLazim::where('Susunan', $request->queue)
							  ->where('Status', '1')
							  ->where('id', '!=', $request->soalan_id)
							  ->count();

		if($soalan == 0)
		{
			$data = $this->repos->regSaveSoalanEdit($request);

			return redirect::to('site/soalan/index')->withSuccess('Soalan Lazim Berjaya Dikemaskini');
		}
		else
		{
			return redirect()->back()->withWarning('No Susunan Telah Wujud');
		}
	}

	// kategori produk -----------------
	public function getProductIconList(Request $request)
	{
		$data = $this->repos->producticonList($request);

		return view('frontend::management.producticon.list' ,compact('data'));
	}

	public function getProductIconAdd(Request $request)
	{
		$lkpKategoriProduk = $this->repos->lkpDetailKategoriProduk($request);

		return view('frontend::management.producticon.add', compact('lkpKategoriProduk'));
	}

	public function postProductIconSaveAdd(Request $request)
	{
		$data = $this->repos->regSaveProductIconAdd($request);

		return redirect::to('site/katprod/index')->withSuccess('Ikon Kategori Produk Berjaya Ditambah');
	}

	public function getProductIconEdit(Request $request)
	{
		$data   = $this->repos->producticonEdit($request);
		$lkpKategoriProduk = $this->repos->lkpDetailKategoriProduk($request);

		return view('frontend::management.producticon.edit', compact('data', 'lkpKategoriProduk'));
	}

	public function postProductIconSaveEdit(Request $request)
	{
		$data = $this->repos->regSaveProductIconEdit($request);

		return redirect::to('site/katprod/index')->withSuccess('Ikon Kategori Produk Berjaya Dikemaskini');
	}

	// Menu -----------------
	public function getMenuList(Request $request)
	{
		$data = $this->repos->menuList($request);

		return view('frontend::management.menu.list', compact('data'));
	}

	public function getMenuAdd(Request $request)
	{
		return view('frontend::management.menu.add');
	}

	public function postMenuSaveAdd(Request $request)
	{
		$menu  = Menum::where('susunan', $request->queue)
					  ->where('status', '1')
					  ->count();

		if($menu == 0)
		{
			$data = $this->repos->regSaveMenuAdd($request);

			return redirect::to('site/menu/index')->withSuccess('Menu Laman Utama Berjaya Ditambah');
		}
		else
		{
			return redirect()->back()->withWarning('No Susunan Telah Wujud');
		}
	}

	public function getMenuEdit(Request $request)
	{
		$data   = $this->repos->menuEdit($request);

		return view('frontend::management.menu.edit', compact('data'));
	}

	public function postMenuSaveEdit(Request $request)
	{
		$menu  = Menum::where('susunan', $request->queue)
					  ->where('status', '1')
					  ->where('id', '!=', $request->menu_id)
					  ->count();

		if($menu == 0)
		{
			$data = $this->repos->regSaveMenuEdit($request);

			return redirect::to('site/menu/index')->withSuccess('Menu Laman Utama Berjaya Dikemaskini');
		}
		else
		{
			return redirect()->back()->withWarning('No Susunan Telah Wujud');
		}
	}

	// Page -----------------
	public function getPageList(Request $request)
	{
		$data = $this->repos->pageList($request);

		return view('frontend::management.page.list', compact('data'));
	}

	public function getPageAdd(Request $request)
	{
		$menum = $this->repos->lkpMenu($request);

		return view('frontend::management.page.add', compact('menum'));
	}

	public function postPageSaveAdd(Request $request)
	{
		$data = $this->repos->regSavePageAdd($request);

		return redirect::to('site/page/index')->withSuccess('Page Berjaya Ditambah');
	}

	public function getPageEdit(Request $request)
	{
		$data   = $this->repos->pageEdit($request);
		$menum = $this->repos->lkpMenu($request);
		$menumedit = $this->repos->lkpMenuEdit($request);

		return view('frontend::management.page.edit', compact('data', 'menum', 'menumedit'));
	}

	public function postPageSaveEdit(Request $request)
	{
		$data = $this->repos->regSavePageEdit($request);

		return redirect::to('site/page/index')->withSuccess('Page Berjaya Dikemaskini');
	}



}
