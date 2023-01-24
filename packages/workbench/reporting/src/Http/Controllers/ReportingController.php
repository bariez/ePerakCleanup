<?php

namespace Workbench\Reporting\Http\Controllers;

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
use Auth;
use PDF;

use Maatwebsite\Excel\Facades\Excel;
use Workbench\Reporting\Data\Repo\ReportingRepo;

use Workbench\Site\Model\Lookup\Parlimen;
use Workbench\Site\Model\Lookup\Dun;
use Workbench\Site\Model\Lookup\Daerah;
use Workbench\Site\Model\Lookup\Mukim;
use Workbench\Site\Model\Lookup\Kampung;
use Workbench\Site\Model\Lookup\LkpMaster;
use Workbench\Site\Model\Lookup\LkpDetail;
use Workbench\Site\Model\Lookup\AclRoleUser;

use Workbench\Dashboard\Data\Repo\DashboardRepo;


/**
 *  
 *
 * @laravolt reporting
 * @author apip
 **/
class ReportingController extends Controller
{
	public function __construct(ReportingRepo $reportingrepo, DashboardRepo $repos)
	{
		$this->reportingrepo = $reportingrepo;
		$this->repos = $repos;
	}

	public function index()
	{
		dd('Index For Reporting Module');
	}

	public function getUserLoginIndex(Request $request)
	{
		
		$roleDesc = $this->reportingrepo->roleDesc();

		return view('reporting::reporting.userlogin.index', compact('roleDesc'));
	}

	public function getUserLoginAjax(Request $request)
	{
		$dataresult = $this->reportingrepo->resultAjax($request);

		return compact('dataresult');
	}

	public function getUserLoginPrint(Request $request)
	{
		$now = Carbon::now();

		if($request->type=='pdf') // pdf
		{
			$data = $this->reportingrepo->resultPdf($request);

			$pdf = PDF::loadView('reporting::reporting.userlogin.pdf', compact('data', 'request'))->setPaper('a4', 'landscape');

			return $pdf->stream("Laporan_Pengguna_Tidak_Aktif_Melebihi_6_Bulan_".$now->format('d-M-y_His').".pdf");
		}
		elseif($request->type=='excel') // excel
		{
			$type="xlsx";

			return Excel::download(new ReportInactiveUserExcelController, "Laporan_Pengguna_Tidak_Aktif_Melebihi_6_Bulan_".$now->format('d-M-y_His').".".$type);
		}
		else
		{
			dd('Tiada Data');
		}
	}

	public function getStatistic()
	{
		$parlimen  = Parlimen::where('status',1)
							 ->get();

		$dun  = Dun::where('status', 1)
				   ->get();

		$user = auth()->user();
		$roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))
							   ->first();

		if(data_get($roleuser,'role_id') == 2 || data_get($roleuser,'role_id') == 3)
		{
			$daerahuser = data_get($user,'Daerah');
			$daerah 	= Daerah::find($daerahuser);
			$mukimuser 	= data_get($user,'Mukim');
			$mukim 		= Mukim::find($mukimuser);
		}
		else
		{
			$daerahuser = '';
			$daerah 	= Daerah::where('status', 1)->get();
			$mukimuser 	= '';
			$mukim 		= Mukim::where('status', 1)->get();
		}

		$catpenempatan = LkpDetail::where('status', 1)
								  ->where('fk_lkp_master', 3)
								  ->get();



		// return view('dashboard::admin.index', compact('parlimen','dun','daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));
		return view('reporting::reporting.statistic.index', compact('parlimen','dun','daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));
	}

	public function getStatisticPrint(Request $request)
	{
		$now = Carbon::now();

		// data result ----------------------------------------------------------

		$user = auth()->user();
		$roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))
							   ->first();

		if($request->parlimen == 0)
		{
			$countpetempatan  = Kampung::selectRaw('count(id) AS jum_petempatan');
		}
		else
		{
			$countpetempatan  = Kampung::selectRaw('count(id) AS jum_petempatan')->where('fk_parlimen', $request->parlimen);
		}

		if($request->dun != 0)
		{
			$countpetempatan->where('fk_dun', $request->dun);
		}

		if($request->daerah != 0)
		{
			$countpetempatan->where('fk_daerah', $request->daerah);
		}
		if($request->mukim != 0)
		{
			$countpetempatan->where('fk_mukim', $request->mukim);
		}
		if($request->catpetempatan != 0)
		{
			if($request->catpetempatan == 4)
			{//kg tradisional
				$countpetempatan->where('KategoriPetempatan', $request->catpetempatan)
								->whereNull('IdKampungInduk');
			}
			else
			{
				$countpetempatan->where('KategoriPetempatan', $request->catpetempatan);
			}

			$searchcat = 1;
		}
		else
		{
			$searchcat = 0;
			$countpetempatan->whereNull('IdKampungInduk');
		}
		if($request->kampung != 0)
		{
			$countpetempatan->where('id', $request->kampung);
		}

		$result = $countpetempatan->where('status', 1)->first();
		$resultall = $this->repos->countallpetemptan($request);
		$category = LkpDetail::find($request->catpetempatan);

		// end data result ----------------------------------------------------------
// dd($resultall);exit;
		$data = $this->reportingrepo->resultPdf($request);

		$pdf = PDF::loadView('reporting::reporting.statistic.pdf', compact('data', 'request', 'result', 'resultall'))->setPaper('a4', 'landscape');

		return $pdf->stream("Laporan_Statistik_".$now->format('d-M-y_His').".pdf");
	}



	// dashboard content --------------------------------------------------------------------------------------------------------------------------------
	public function countpetempatan(Request $request)
	{
		if($request->parlimen==0)
		{
			$countpetempatan  = Kampung::selectRaw('count(id) AS jum_petempatan');
		}
		else
		{
			$countpetempatan  = Kampung::selectRaw('count(id) AS jum_petempatan')->where('fk_parlimen',$request->parlimen);
		}

		if($request->dun!=0)
		{
			$countpetempatan->where('fk_dun',$request->dun);
		}

		if($request->daerah!=0)
		{
			$countpetempatan->where('fk_daerah',$request->daerah);
		}

		if($request->mukim!=0)
		{
			$countpetempatan->where('fk_mukim',$request->mukim);
		}

		if($request->catpetempatan!=0)
		{
			if($request->catpetempatan==4)
			{//kg tradisional
				$countpetempatan->where('KategoriPetempatan',$request->catpetempatan)
								->whereNull('IdKampungInduk');
			}
			else
			{
				$countpetempatan->where('KategoriPetempatan',$request->catpetempatan);
			}
			$searchcat=1;
		}
		else
		{
			$searchcat=0;
			$countpetempatan->whereNull('IdKampungInduk');
		}

		if($request->kampung!=0)
		{
			$countpetempatan->where('id',$request->kampung);
		}

		if($request->kampung!=0)
		{
			$countpetempatan->where('id',$request->kampung);
		}

		$result=$countpetempatan->where('status',1)->first();

		$resultall=$this->repos->countallpetemptan($request);

		$category=LkpDetail::find($request->catpetempatan);

		return view('reporting::reporting.statistic.ajax.countpetempatan', compact('result','resultall','searchcat','category', 'request'));
	}

	// public function countdata(Request $request)
	// {
	// 	if($request->parlimen==0)
	// 	{
	// 		$countpetempatan  = Kampung::selectRaw('count(id) AS jum_petempatan');
	// 	}
	// 	else
	// 	{
	// 		$countpetempatan  = Kampung::selectRaw('count(id) AS jum_petempatan')->where('fk_parlimen',$request->parlimen);
	// 	}

	// 	if($request->dun!=0)
	// 	{
	// 		$countpetempatan->where('fk_dun',$request->dun);
	// 	}

	// 	if($request->daerah!=0)
	// 	{
	// 		$countpetempatan->where('fk_daerah',$request->daerah);
	// 	}

	// 	if($request->mukim!=0)
	// 	{
	// 		$countpetempatan->where('fk_mukim',$request->mukim);
	// 	}

	// 	if($request->catpetempatan!=0)
	// 	{
	// 		if($request->catpetempatan==4)
	// 		{//kg tradisional
	// 			$countpetempatan->where('KategoriPetempatan',$request->catpetempatan)
	// 							->whereNull('IdKampungInduk');
	// 		}
	// 		else
	// 		{
	// 			$countpetempatan->where('KategoriPetempatan',$request->catpetempatan);
	// 		}
	// 		$searchcat=1;
	// 	}
	// 	else
	// 	{
	// 		$searchcat=0;
	// 		$countpetempatan->whereNull('IdKampungInduk');
	// 	}

	// 	if($request->kampung!=0)
	// 	{
	// 		$countpetempatan->where('id',$request->kampung);
	// 	}

	// 	if($request->kampung!=0)
	// 	{
	// 		$countpetempatan->where('id',$request->kampung);
	// 	}

	// 	$result=$countpetempatan->where('status',1)->count();

	// 	return compact('result');
	// }

} // end of class