<?php

namespace Workbench\Dashboard\Http\Controllers;

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
use Log;
use Auth;
use Workbench\Dashboard\Data\Repo\LocationRepo;
use Workbench\Frontend\Data\Repo\PaginatedRepo;
use Workbench\Site\Model\Lookup\AclRoleUser;
use Workbench\Site\Model\Lookup\Users;

class LocationController extends Controller
{
    // =============================================================
    // 1. CONSTRUCTOR
    // =============================================================
    protected $repos;
    protected $paging;

    public function __construct(LocationRepo $repos, PaginatedRepo $paging)
    {
        $this->repos = $repos;
        $this->paging = $paging;
    }

    // =============================================================
    // 2. FUNCTION INDEXGIS (Halaman Utama)
    // =============================================================
    public function indexGis(Request $request)
    {
        $userAuth = auth()->user();
        
        if (!$userAuth) {
            return redirect('/login');
        }

        $roleuser = AclRoleUser::where('user_id', data_get($userAuth, 'id'))->first();

        // PENTING: with('daerah') supaya tajuk di view tak error
        $user = Users::with('daerah')->where('id', $userAuth->id)->first();

        // Pastikan path view ini betul ikut folder anda
        // Jika fail anda di 'admindaerah/index_location.blade.php', guna 'dashboard::admindaerah.index_location'
        // Jika di 'location/indexgis.blade.php', guna 'dashboard::location.indexgis'
        // Di sini saya guna default asal anda:
        return view('dashboard::location.indexgis', compact('roleuser', 'user'));
    }

    // =============================================================
    // 3. FUNCTION AJAXINDEX (API Peta)
    // =============================================================
    public function ajaxIndex(Request $request)
    {
        // 1. Panggil data dari repo
        $data = $this->repos->jumlahkirGis($request);
        $datalocation = $this->repos->locationGis($request);
        $kampungdata = $this->repos->kampungGis($request);
        $kemudahandata = $this->repos->kemudahanGis($request);
        $datagis = $data['pemilikanrumah'];

        $latKampung = $data['lat'];
        $longKampung = $data['long'];

        // 2. Dapatkan User & Role
        $userAuth = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($userAuth, 'id'))->first();

        // Eager load daerah untuk dapatkan NamaDaerah
        $user = Users::with('daerah')->find($userAuth->id);

        // 3. Variable Default
        $whereKampung = "1=1";
        $whereMukim   = "1=1";
        $whereDaerah  = "1=1";

        $kodMukim = '';
        $namaMukim = '';
        $daerah = ''; 

        // --- LOGIC 1: USER ADA DAERAH (ROLE 2) ---
        if ($user && $user->daerah) {
            $daerah = $user->daerah->NamaDaerah; 
            if ($roleuser->role_id == '2') {
                $whereDaerah = "NAM = '" . $daerah . "'"; 
            }
        }

        // --- LOGIC 2: USER ADA MUKIM (ROLE 3) ---
        if (!empty($user->Mukim)) {
            try {
                $mukimInfo = DB::table('dbo.mukim')
                    ->join('dbo.daerah', 'dbo.mukim.fk_daerah', '=', 'dbo.daerah.id')
                    ->where('dbo.mukim.id', $user->Mukim)
                    ->select(
                        'dbo.mukim.KodMukim', 
                        'dbo.mukim.NamaMukim', 
                        'dbo.daerah.NamaDaerah as nama_daerah_alias'
                    )
                    ->first();

                if ($mukimInfo) {
                    $kodMukim  = $mukimInfo->KodMukim;
                    $namaMukim = $mukimInfo->NamaMukim;
                    if (empty($daerah)) {
                        $daerah = $mukimInfo->nama_daerah_alias;
                    }

                    if ($roleuser->role_id == '3') {
                        $whereMukim  = "NAM = '" . $namaMukim . "'"; 
                        $whereDaerah = "NAM = '" . $daerah . "'";
                    }
                }
            } catch (\Exception $e) {
                Log::error("GIS DB Error: " . $e->getMessage());
            }
        }

        // 4. RETURN VIEW MENGIKUT ROLE
        if ($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') { 
            return view('dashboard::location.gisadmin', compact(
                'datalocation', 'datagis', 'latKampung', 'longKampung', 
                'kampungdata', 'kemudahandata',
                'whereKampung', 'whereMukim', 'whereDaerah'
            ));
        
        } elseif ($roleuser->role_id == '2') { 
            return view('dashboard::location.gisdaerah', compact(
                'datalocation', 'datagis', 'latKampung', 'longKampung', 
                'kampungdata', 'kemudahandata',
                'whereKampung', 'whereMukim', 'whereDaerah',
                'daerah' // PENTING: Variable daerah dihantar ke sini
            ));
        
        } elseif ($roleuser->role_id == '3') { 
            return view('dashboard::location.gismukim', compact(
                'datalocation', 'datagis', 'latKampung', 'longKampung', 
                'kampungdata', 'kemudahandata', 
                'kodMukim', 'namaMukim', 'daerah',
                'whereKampung', 'whereMukim', 'whereDaerah'      
            ));
        }

        return response()->json(['status' => 'error', 'message' => 'Role tidak sah'], 400);
    }
}