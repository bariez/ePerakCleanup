<?php

namespace Workbench\Dashboard\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Mail;
use Curl;

use Workbench\Dashboard\Data\Repo\LocationRepo;
use Workbench\Frontend\Data\Repo\PaginatedRepo;
use Workbench\Site\Model\Lookup\AclRoleUser;
use Workbench\Site\Model\Lookup\Users;

class LocationController extends Controller
{

    public function __construct(LocationRepo $repos, PaginatedRepo $paging)
	{
		$this->repos = $repos;
		$this->paging = $paging;
	}

    public function ajaxIndex(Request $request)
	{
        $data = $this->repos->jumlahkirGis($request);
        $datalocation = $this->repos->locationGis($request);
        $kampungdata = $this->repos->kampungGis($request);
        $kemudahandata = $this->repos->kemudahanGis($request);
        $datagis = $data['pemilikanrumah'];

        $latKampung = $data['lat'];

        $longKampung = $data['long'];

        $user     = auth()->user();
		$roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))
							   ->first();

        if($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') // pentadbir sistem n Ptinggi n Dataentri
        {
            return view('dashboard::location.gisadmin', compact('datalocation','datagis','latKampung','longKampung','kampungdata','kemudahandata'));
        }
        elseif($roleuser->role_id == '2') // PDaerah
        {
            return view('dashboard::location.gisdaerah', compact('datalocation','datagis','latKampung','longKampung','kampungdata','kemudahandata'));
        }
        elseif($roleuser->role_id == '3') // Pmukim
        {
            return view('dashboard::location.gismukim', compact('datalocation','datagis','latKampung','longKampung','kampungdata','kemudahandata'));
        }
	}

    public function indexGis(Request $request)
    {
        $data = auth()->user();
        $roleuser=AclRoleUser::where('user_id',data_get($data,'id'))->first();

        $user = Users::with('daerah')
                    ->where('id', $data->id)
                    ->first();

        return view('dashboard::location.indexgis', compact('roleuser', 'user'));
    }



}
