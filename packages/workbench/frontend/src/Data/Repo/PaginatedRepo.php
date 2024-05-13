<?php

namespace Workbench\Frontend\Data\Repo;

use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Carbon\Carbon;
use Curl;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Mail;
use Redirect;
use Workbench\Site\Model\Lookup\Daerah;
use Workbench\Site\Model\Lookup\Dun;
use Workbench\Site\Model\Lookup\Kampung;
use Workbench\Site\Model\Lookup\LkpDetail;
use Workbench\Site\Model\Lookup\LkpMaster;
use Workbench\Site\Model\Lookup\Mukim;
use Workbench\Site\Model\Lookup\Parlimen;

class PaginatedRepo extends Controller
{
    public function index($collection, $request, $limitori)
    {
        $offset = 0;
        $limit = $limitori;

        if ($request->page == 1) { // 1 - 10
            $offset = 0;
        } else { // 11 - infinity
            $offset = ($request->page * $limit) - ($limit - 1);
        }

        $countakt = $collection->count();

        $totalpage = ceil($countakt / $limit);

        // dd($collection,$totalpage,$request);

        return view('frontend::landing.paginated', compact('totalpage', 'request'));
    }
}
