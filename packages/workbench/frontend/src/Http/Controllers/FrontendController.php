<?php
namespace Workbench\Frontend\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
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
use Workbench\Site\Model\Lookup\AclRoleUser;

use Workbench\Frontend\Data\Repo\FrontendRepo;
use Workbench\Frontend\Data\Repo\PaginatedRepo;

class FrontendController extends Controller
{
	public function __construct(FrontendRepo $repos, PaginatedRepo $paging)
	{
		$this->repos = $repos;
		$this->paging = $paging;
	}

	public function index()
	{
		// dd('sini');

		// return view('dashboard::dashboard.index');
		$banner = $this->repos->feBanner();
		$notis  = collect($this->repos->feNotis('landing'));
		$aktiviti  = $this->repos->feAktiviti('list');
		$lkpproduk  = $this->repos->feLkpDetailProduk();
		$icon  = $this->repos->feIcon();

		// counter
		$counter = $this->repos->addCountPelawat();

		// latest edit
		$editdate = $this->repos->findDateLatest();

		return view('frontend::landing.index', compact('banner', 'notis', 'aktiviti', 'lkpproduk','icon', 'counter', 'editdate'));
	}

	public function getNewsList(Request $request)
	{
		$year = $this->repos->tahunNews($request);

		$notisAll  = collect($this->repos->feNotis('list'));

		$limitori = 10;

		$notis = $this->setPaginate($request, $notisAll, $limitori);

		$paginated = $this->paging->index($notisAll, $request, $limitori);

		return view('frontend::news.list', compact('notis', 'paginated', 'year'));
	}

	public function postNewsFilter(Request $request)
	{
		// dd($request);exit;
		return redirect::to('/news/searchresult?tahun='.data_get($request, 'searchtahun').'&data='.data_get($request, 'searchdata').'&page=1');
	}

	public function getNewsFilterList(Request $request)
	{
		$year = $this->repos->tahunNews($request);

		$notisAll  = collect($this->repos->feNotisFilter($request));

		$limitori = 10;

		$notis = $this->setPaginate($request, $notisAll, $limitori);

		$paginated = $this->paging->index($notisAll, $request, $limitori);
// dd($request, $year, $notisAll, $limitori, $notis, $paginated);exit;
		return view('frontend::news.listfilter', compact('notis', 'paginated', 'year', 'request'));
	}

	public function getNewsDetail(Request $request)
	{
		$notis  = $this->repos->feNotisDetail($request);

		return view('frontend::news.detail', compact('notis'));
	}

	public function getActivityList(Request $request)
	{
		$year = $this->repos->tahunAktiviti($request);

		$aktivitiAll  = $this->repos->feAktiviti('list');

		$limitori = 10;

		$aktiviti = $this->setPaginate($request, $aktivitiAll, $limitori);

		$paginated = $this->paging->index($aktivitiAll, $request, $limitori);

		return view('frontend::activities.list', compact('aktiviti', 'paginated', 'year'));
	}

	public function postActivityFilter(Request $request)
	{
		// dd($request);exit;
		return redirect::to('/activity/searchresult?tahun='.data_get($request, 'searchtahun').'&data='.data_get($request, 'searchdata').'&page=1');
	}

	public function getActivityFilterList(Request $request)
	{
		$year = $this->repos->tahunAktiviti($request);

		$aktivitiAll  = $this->repos->feAktivitifilter($request);

		$limitori = 10;

		$aktiviti = $this->setPaginate($request, $aktivitiAll, $limitori);

		$paginated = $this->paging->index($aktivitiAll, $request, $limitori);

		return view('frontend::activities.listfilter', compact('aktiviti', 'paginated', 'year', 'request'));
	}

	public function getActivityDetail(Request $request)
	{
		$aktiviti  = $this->repos->feAktivitiDetail($request);

		return view('frontend::activities.detail', compact('aktiviti'));
	}

	// public function getProductList()
	// {
	// 	$produk  = $this->repos->feProduk();
	// 	$lkpproduk  = $this->repos->feLkpDetailProduk();

	// 	return view('frontend::products.list', compact('produk', 'lkpproduk'));
	// }

	public function getProductDetail(Request $request) // sini product
	{
		$daerah 		= $this->repos->daerah($request);
		$mukim 			= $this->repos->mukim($request);
		$kampung 		= $this->repos->kampung($request);

		$lkpproduk  = $this->repos->feLkpDetailProduk();
		$produkAll  = $this->repos->feProduk($request);

		$limitori = 6;

		$produk = $this->setPaginate($request, $produkAll, $limitori);

		$paginated = $this->paging->index($produkAll, $request, $limitori);

		return view('frontend::products.detail', compact('daerah', 'mukim', 'kampung', 'produk', 'paginated', 'lkpproduk', 'request'));
	}

	public function postProductSearch(Request $request)
	{
		$searchdaerah = $request->searchdaerah;
		$searchmukim = $request->searchmukim;
		$searchkampung = $request->searchkampung;

		if($searchdaerah)
		{
			$searchdaerah = $request->searchdaerah;
		}
		else
		{
			$searchdaerah = '0';
		}

		if($searchmukim)
		{
			$searchmukim = $request->searchmukim;
		}
		else
		{
			$searchmukim = '0';
		}

		if($searchkampung)
		{
			$searchkampung = $request->searchkampung;
		}
		else
		{
			$searchkampung = '0';
		}

		return redirect::to('/product/'.data_get($request, 'idtype').'/searchresult?daerah='.$searchdaerah.'&mukim='.$searchmukim.'&kampung='.$searchkampung.'&page=1');
	}

	public function getProductFilterList(Request $request)
	{
		// dd($request->daerah, $request->mukim, $request->kampung);exit;
		$daerah 		= $this->repos->daerah($request);
		$mukim 			= $this->repos->mukim($request);
		$kampung 		= $this->repos->kampung($request);

		$lkpproduk  = $this->repos->feLkpDetailProduk();
		$produkAll  = $this->repos->feProdukFilter($request);

		$limitori = 6;

		$produk = $this->setPaginate($request, $produkAll, $limitori);

		$paginated = $this->paging->index($produkAll, $request, $limitori);

		return view('frontend::products.detailfilter', compact('daerah', 'mukim', 'kampung', 'produk', 'paginated', 'lkpproduk', 'request'));
	}

	public function getProductDetailList(Request $request) // sini ajax
	{
		$data = $this->repos->feProdukList($request);

		return view('frontend::products.detaillist', compact('data'));
	}

	public function getFaqList(Request $request)
	{
		$faq = $this->repos->feFaq();

		return view('frontend::faq.index', compact('faq'));
	}

	public function getContactUsList(Request $request)
	{
		$contactus = $this->repos->feContactUs();

		return view('frontend::contactus.index', compact('contactus'));
	}

	public function getPageDetail(Request $request)
	{
		$page = $this->repos->fePage($request);

		return view('frontend::page.detail', compact('page'));
	}

	// Info penempatan ---------------------------------------------------------------

	public function getInfoPenempatan(Request $request)
	{
		$parlimen 		= $this->repos->parlimen($request);
		$dun 			= $this->repos->dun($request);
		$daerah 		= $this->repos->daerah($request);
		$mukim 			= $this->repos->mukim($request);
		$catpenempatan	= $this->repos->lkpDetail($request);
		$kampung 		= $this->repos->kampung($request);

		$user     = auth()->user();
		$roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))
							   ->first();

		return view('frontend::info.index', compact('parlimen','dun','daerah','mukim','catpenempatan', 'kampung', 'roleuser', 'user'));
	}

	public function getAjaxMukim(Request $request)
	{
		$mukim = $this->repos->ajaxMukim($request);

		$user     = auth()->user();
		$roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))
							   ->first();

		return view('frontend::info.ajax.ajaxmukim', compact('mukim', 'roleuser', 'user'));
	}

	public function getAjaxParlimenDaerah(Request $request)
	{
		$parlimen = $this->repos->ajaxParlimenDaerah($request);

		return view('frontend::info.ajax.ajaxparlimendaerah', compact('parlimen'));
	}

	public function getAjaxParlimenMukim(Request $request)
	{
		$parlimen = $this->repos->ajaxParlimenMukim($request);

		return view('frontend::info.ajax.ajaxparlimenmukim', compact('parlimen'));
	}

	public function getAjaxDun(Request $request)
	{
		$dun = $this->repos->ajaxDun($request);

		return view('frontend::info.ajax.ajaxdun', compact('dun'));
	}

	public function getAjaxKampung(Request $request)
	{
		$kampung = $this->repos->ajaxKampung($request);

		return view('frontend::info.ajax.ajaxkampung', compact('kampung'));
	}

	public function getAjaxResult(Request $request)
	{
		$result = $this->repos->ajaxResult($request);

		return view('frontend::info.ajax.ajaxresult', compact('result'));
	}

	public function getInfoDetail(Request $request)
	{
		$data = $this->repos->dataKampung($request);

		$jantina = $this->repos->dataJantina($request);
		$bangsa  = $this->repos->dataBangsa($request);
		$taraf   = $this->repos->dataTarafPerkahwinan($request);
		$jpkk    = $this->repos->dataJpkk($request);

		// dd($bangsa);exit;

		return view('frontend::info.detail', compact('data', 'request', 'jantina', 'bangsa', 'taraf', 'jpkk'));
	}

	public function getAjaxMap(Request $request)
	{
        $data = $this->repos->jumlahkirGis($request);
        $kirkampung = $this->repos->kirGis($request);
        $kampungdata = $this->repos->kampungGis($request);
        $kemudahandata = $this->repos->kemudahanGis($request);
        $datagis = $data['pemilikanrumah'];
        $latKampung = $data['lat'];
        $longKampung = $data['long'];
        $id_kampung = $request->idkampung;

		$user     = auth()->user();
		$roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))
							   ->first();

        if($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') // pentadbir sistem n Ptinggi n Dataentri
        {
            return view('frontend::info.ajax.detail.gismap.ajaxmapnegeri',compact('datagis','id_kampung','latKampung','longKampung','kirkampung','kampungdata','kemudahandata'));
        }
        elseif($roleuser->role_id == '2') // PDaerah
        {
            return view('frontend::info.ajax.detail.gismap.ajaxmapdaerah',compact('datagis','id_kampung','latKampung','longKampung','kirkampung','kampungdata','kemudahandata'));
        }
        elseif($roleuser->role_id == '3') // Pmukim
        {
            return view('frontend::info.ajax.detail.gismap.ajaxmapmukim', compact('datagis','id_kampung','latKampung','longKampung','kirkampung','kampungdata','kemudahandata'));
        }
	}

	public function getAjaxActivity(Request $request)
	{
		$data = $this->repos->dataAktiviti($request);

		return view('frontend::info.ajax.detail.aktiviti.ajaxaktiviti', compact('data', 'request'));
	}

	public function getAjaxActivityModal(Request $request)
	{
		$data = $this->repos->dataAktivitiModal($request);

		return view('frontend::info.ajax.detail.aktiviti.ajaxaktivitimodal', compact('data'));
	}

	public function getAjaxActivityModalImage(Request $request)
	{
		$data = $this->repos->dataAktivitiModal($request);

		return view('frontend::info.ajax.detail.aktiviti.ajaxaktivitimodalimage', compact('data'));
	}

	public function getInfoDetailListAktiviti(Request $request)
	{
		$kampung = $this->repos->dataKampung($request);

		$data = $this->repos->dataAktivitiList($request);

		return view('frontend::info.ajax.detail.aktiviti.aktivitilist', compact('kampung', 'data'));
	}

	public function getAjaxPencapaian(Request $request)
	{
		$data = $this->repos->dataPencapaianList($request);

		return view('frontend::info.ajax.detail.pencapaian.ajaxpencapaianlist', compact('data'));
	}

	public function getAjaxInfra(Request $request)
	{
		$lookup = $this->repos->lkpDetailInfra($request);

		$lkpDetailInfra = $this->repos->dataLkpDetailInfra($request);

		$data = $this->repos->dataInfra($request);

		return view('frontend::info.ajax.detail.infra.ajaxinfra', compact('data', 'lkpDetailInfra', 'request','lookup'));
	}

	public function getAjaxInfraList(Request $request)
	{
		$data = $this->repos->dataInfraList($request);

		return view('frontend::info.ajax.detail.infra.ajaxinfralist', compact('data', 'request'));
	}

	public function getAjaxProduk(Request $request)
	{
		$lkpDetailProduk = $this->repos->lkpDetailProduk($request);

		// $data = $this->repos->dataProduk($request);

		return view('frontend::info.ajax.detail.produk.ajaxproduk', compact('lkpDetailProduk', 'request'));
	}

	public function getAjaxProdukList(Request $request)
	{
		$data = $this->repos->dataProdukList($request);

		return view('frontend::info.ajax.detail.produk.ajaxproduklist', compact('data'));
	}

	public function getAjaxProjek(Request $request)
	{
		$lookupprojek = $this->repos->lkpDetailProjek($request);
		$lkpDetailProjek = $this->repos->dataLkpDetailProjek($request);

		$data = $this->repos->dataProjek($request);

		return view('frontend::info.ajax.detail.projek.ajaxprojek', compact('data', 'lkpDetailProjek', 'request', 'lookupprojek'));
	}

	public function getAjaxProjekList(Request $request)
	{
		$data = $this->repos->dataProjekList($request);

		return view('frontend::info.ajax.detail.projek.ajaxprojeklist', compact('data', 'request'));
	}

	public function getAjaxProjekModalImage(Request $request)
	{
		$data = $this->repos->dataProjekModal($request);

		return view('frontend::info.ajax.detail.projek.ajaxprojekmodalimage', compact('data'));
	}

	public function getAjaxGaleri(Request $request)
	{
		$data = $this->repos->dataGaleri($request);

		return view('frontend::info.ajax.detail.galeri.ajaxgaleri', compact('data', 'request'));
	}

	public function getAjaxGaleriModal(Request $request)
	{
		$data = $this->repos->dataGaleriModal($request);

		return view('frontend::info.ajax.detail.galeri.ajaxgalerimodal', compact('data'));
	}

	public function postSearch(Request $request)
	{
		$data = $this->repos->dataListCarian($request);

		return view('frontend::searching.list' ,compact('data'));
	}

	public function setPaginate($request, $collection, $limitori)
	{
		$limit = $limitori;

		$offset = ($request->page*$limit) - ($limit);

		$data  = $collection->toArray();

		$data  = array_slice($data, $offset, $limit);

		return collect($data);
	}

    // MAP INFO

    public function getAjaxMapinfo(Request $request)
    {
        $data = $this->repos->jumlahGis($request);
        // $kirkampung = $this->repos->mainkirGis($request);
        // $kampungdata = $this->repos->mainkampungGis($request);

        // $datagis = $data['pemilikanrumah'];

        $latKampung = $data['lat'];
        $longKampung = $data['long'];

        return view('frontend::landing.mapinfo', compact('data','latKampung','longKampung'));
    }

	// ------------------------------------------------------------------------
	public function getDemo(Request $request)
	{
		// dd('sini');

		$banner = $this->repos->feBanner();
		$notis  = collect($this->repos->feNotis('landing'));
		$aktiviti  = $this->repos->feAktiviti('list');
		$lkpproduk  = $this->repos->feLkpDetailProduk();

		if($request->no == '2') // demo 2
		{
			return view('frontend::landing.index2', compact('banner', 'notis', 'aktiviti', 'lkpproduk'));
		}
		else if($request->no == '3') // demo 3
		{
			return view('frontend::landing.index3', compact('banner', 'notis', 'aktiviti', 'lkpproduk'));
		}
		else // ori
		{
			return view('frontend::landing.index', compact('banner', 'notis', 'aktiviti', 'lkpproduk'));
		}
	}
	// ------------------------------------------------------------------------







}
