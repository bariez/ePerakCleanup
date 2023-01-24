<?php

namespace Workbench\Frontend\Data\Repo;

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

class PaginatedRepo extends Controller
{

	public function index($collection, $request, $limitori)
	{
		$offset = 0;
		$limit = $limitori;

		if($request->page == 1) // 1 - 10
		{
			$offset = 0;
		}
		else // 11 - infinity
		{
			$offset = ($request->page*$limit) - ($limit-1);
		}

		$countakt  = $collection->count();

		$totalpage = ceil($countakt/$limit);

		// dd($collection,$totalpage,$request);

		return view('frontend::landing.paginated', compact('totalpage', 'request'));
	}

}