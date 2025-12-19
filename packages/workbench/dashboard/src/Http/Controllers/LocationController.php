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
    // 2. FUNCTION INDEXGIS (Untuk Paparan Halaman Utama)
    // =============================================================
    public function indexGis(Request $request)
    {
        $userAuth = auth()->user();
        
        // Redirect jika session expired
        if (!$userAuth) {
            return redirect('/login');
        }

        $roleuser = AclRoleUser::where('user_id', data_get($userAuth, 'id'))->first();

        $user = Users::with('daerah')
                    ->where('id', $userAuth->id)
                    ->first();

        // PEMBETULAN UTAMA:
        // Kita HANYA hantar 'roleuser' dan 'user'. 
        // JANGAN hantar 'datalocation' di sini (ini punca error page putih/500).
        return view('dashboard::location.indexgis', compact('roleuser', 'user'));
    }

    // =============================================================
    // 3. FUNCTION AJAXINDEX (Untuk Data Peta & Logic Mukim)
    // =============================================================
    public function ajaxIndex(Request $request)
    {
        // Panggil data dari repo
        $data = $this->repos->jumlahkirGis($request);
        $datalocation = $this->repos->locationGis($request);
        $kampungdata = $this->repos->kampungGis($request);
        $kemudahandata = $this->repos->kemudahanGis($request);
        $datagis = $data['pemilikanrumah'];

        $latKampung = $data['lat'];
        $longKampung = $data['long'];

        // Dapatkan User & Role
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        // Variable Default
        $kodMukim = '';
        $namaMukim = '';
        $daerah = '';

        // Check ID Mukim User
        if (!empty($user->Mukim)) {
            
            // PEMBETULAN DATABASE:
            // Menggunakan 'NamaDaerah' (huruf besar/kecil mesti tepat ikut DB anda)
            
            try {
                $mukimInfo = DB::table('dbo.mukim')
                    ->join('dbo.daerah', 'dbo.mukim.fk_daerah', '=', 'dbo.daerah.id')
                    ->where('dbo.mukim.id', $user->Mukim)
                    ->select(
                        'dbo.mukim.KodMukim', 
                        'dbo.mukim.NamaMukim', 
                        'dbo.daerah.NamaDaerah as nama_daerah_alias' // <-- Guna NamaDaerah
                    )
                    ->first();

                if ($mukimInfo) {
                    $kodMukim  = $mukimInfo->KodMukim;
                    $namaMukim = $mukimInfo->NamaMukim;
                    $daerah    = $mukimInfo->nama_daerah_alias;
                }
            } catch (\Exception $e) {
                Log::error("GIS DB Error: " . $e->getMessage());
            }
        }

        Log::info("GIS Debug -> User: " . $user->id . " | Kod: $kodMukim | Mukim: $namaMukim | Daerah: $daerah");

        // Return View Mengikut Role (AJAX sahaja)
        if ($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') { 
            return view('dashboard::location.gisadmin', compact('datalocation', 'datagis', 'latKampung', 'longKampung', 'kampungdata', 'kemudahandata'));
        
        } elseif ($roleuser->role_id == '2') { 
            return view('dashboard::location.gisdaerah', compact('datalocation', 'datagis', 'latKampung', 'longKampung', 'kampungdata', 'kemudahandata'));
        
        } elseif ($roleuser->role_id == '3') { 
            // Penghulu Mukim
            return view('dashboard::location.gismukim', compact(
                'datalocation', 
                'datagis', 
                'latKampung', 
                'longKampung', 
                'kampungdata', 
                'kemudahandata', 
                'kodMukim',   
                'namaMukim',  
                'daerah'      
            ));
        }

        return response()->json(['status' => 'error', 'message' => 'Role tidak sah'], 400);
    }
}