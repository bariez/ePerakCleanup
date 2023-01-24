<?php

namespace Workbench\Dashboard\Http\Controllers;

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
use Workbench\Site\Model\Lookup\Users;
use Workbench\Site\Model\Lookup\Pemilikanrumah;
use Workbench\Site\Model\Lookup\ProfilKemudahan;
use Workbench\Site\Model\Lookup\VwKemudahanDetail;
use Workbench\Site\Model\Lookup\Isirumah;
use Workbench\Site\Model\Lookup\AclRoleUser;

use Workbench\Dashboard\Data\Repo\DashboardDORepo;

/**
 *  
 *
 * @laravolt site
 * @author apip
 **/
class DashboardDOController extends Controller
{
	public function __construct(DashboardDORepo $repos)
	{
		$this->repos = $repos;
	}

	public function getTableChart(Request $request)
	{
		if($request->type == 1)
		{
			$data = $this->repos->tablechart1($request);
		}
		elseif($request->type == 2)
		{
			$data = $this->repos->tablechart2($request);
		}
		elseif($request->type == 3)
		{
			$data = $this->repos->tablechart3($request);
		}
		elseif($request->type == 4)
		{
			$data = $this->repos->tablechart4($request);
		}
		elseif($request->type == 5)
		{
			$data = $this->repos->tablechart5($request);
		}
		elseif($request->type == 6)
		{
			$data = $this->repos->tablechart6($request);
		}
		elseif($request->type == 7)
		{
			$data = $this->repos->tablechart7($request);
		}
		elseif($request->type == 8)
		{
			$data = $this->repos->tablechart8($request);
		}
		else
		{
			dd($request);exit;
		}

		return compact('data');
	}

	public function getMukim(Request $request)
	{
		if($request->mukim_id)
		{
			$mukim = Mukim::find($request->mukim_id);
			$data = $mukim->NamaMukim;
		}
		else
		{
			$data = '-';
		}

		return $data;
	}

	public function getParlimen(Request $request)
	{
		if($request->parlimen_id)
		{
			$parlimen = Parlimen::find($request->parlimen_id);
			$data = $parlimen->NamaParlimen;
		}
		else
		{
			$data = '-';
		}

		return $data;
	}

	public function getDun(Request $request)
	{
		if($request->dun_id)
		{
			$dun = Dun::find($request->dun_id);
			$data = $dun->NamaDun;
		}
		else
		{
			$data = '-';
		}

		return $data;
	}

	public function getKatpet(Request $request)
	{
		if($request->katpet_id)
		{
			$lkpdetail 	= LkpDetail::find($request->katpet_id);
			$data 		= $lkpdetail->description;
		}
		else
		{
			$data = '-';
		}

		return $data;
	}

	public function getKampung(Request $request)
	{
		if($request->kg_id)
		{
			$lkpdetail 	= Kampung::find($request->kg_id);
			$data 		= $lkpdetail->NamaKampung;
		}
		else
		{
			$data = '-';
		}

		return $data;
	}
}