<?php

namespace Workbench\Dashboard\Data\Repo;

use Auth;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Laravolt\Lookup\Models\Lookup;
use Workbench\Site\Model\Lookup\AclRoleUser;
use Workbench\Site\Model\Lookup\Isirumah;
use Workbench\Site\Model\Lookup\Kampung;
use Workbench\Site\Model\Lookup\LkpDetail;
use Workbench\Site\Model\Lookup\Pemilikanrumah;
use Workbench\Site\Model\Lookup\VwKampungRumah;
use Workbench\Site\Model\Lookup\VwKemudahanAwam;
use Workbench\Site\Model\Lookup\VwKetuaIsiRumah;

class LocationRepo
{
    public function jumlahkirGis($request)
    {
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        // Ambil data pemilikan rumah
        $pemilikanrumah = VwKampungRumah::with('pemilikanrumah', 'mukim', 'daerah')->get();

        $latlong = null;

        // Logic Latitude/Longitude Pusat
        if ($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') { 
            $latlong = Pemilikanrumah::first();
        } elseif ($roleuser->role_id == '2') { // PDaerah
            $latlong = Pemilikanrumah::whereHas('kampung.mukim.daerah', function ($query) use ($user) {
                $query->where('fk_daerah', '=', $user->Daerah);
            })->with('kampung.mukim.daerah')->first();
        } elseif ($roleuser->role_id == '3') { // PMukim
            $latlong = Pemilikanrumah::whereHas('kampung', function ($query) use ($user) {
                $query->where('fk_mukim', '=', $user->Mukim);
            })->with('kampung.mukim')->first();
        }

        $lat = $latlong ? $latlong->Latitud : 0;
        $long = $latlong ? $latlong->Longitud : 0;

        return compact('pemilikanrumah', 'lat', 'long');
    }

    public function locationGis($request)
    {
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();
        
        $locationgis = collect(); 

        if ($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') { 
            $locationgis = VwKetuaIsiRumah::get();
        } elseif ($roleuser->role_id == '2') { 
            $locationgis = VwKetuaIsiRumah::where('fk_daerah', $user->Daerah)->get();
        } elseif ($roleuser->role_id == '3') { 
            $locationgis = VwKetuaIsiRumah::where('fk_mukim', $user->Mukim)->get();
        }

        return $locationgis;
    }

    public function kampungGis($request)
    {
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();
        
        $kampung = null;

        if ($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') { 
            $kampung = Kampung::with('daerah', 'mukim')->first();
        } elseif ($roleuser->role_id == '2') { 
            $kampung = Kampung::where('fk_daerah', $user->Daerah)->with('daerah', 'mukim')->first();
        } elseif ($roleuser->role_id == '3') { 
            $kampung = Kampung::where('fk_mukim', $user->Mukim)->with('daerah', 'mukim')->first();
        }

        return $kampung;
    }

    public function kemudahanGis($request)
    {
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        $lkpdetail = LkpDetail::where('fk_lkp_master', 4)->where('status', 1)->get();
        $typekemudahan = [];

        foreach ($lkpdetail as $key => $value2) {
            $kemudahamawam = collect();

            if ($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') { 
                $kemudahamawam = VwKemudahanAwam::where('KatKemudahan', $value2->id)->get();
            } elseif ($roleuser->role_id == '2') { 
                $kemudahamawam = VwKemudahanAwam::where('KatKemudahan', $value2->id)->where('fk_daerah', $user->Daerah)->get();
            } elseif ($roleuser->role_id == '3') { 
                $kemudahamawam = VwKemudahanAwam::where('KatKemudahan', $value2->id)->where('fk_mukim', $user->Mukim)->get();
            }

            foreach ($kemudahamawam as $key2 => $value3) {
                $obj = (object) [];
                $obj->KatKemudahan = $value3->KatKemudahan;
                $obj->NamaKemudahan = $value3->NamaKemudahan;
                $obj->Latitud = $value3->Latitud;
                $obj->Longitud = $value3->Longitud;
                $typekemudahan[] = $obj;
            }
        }

        return $typekemudahan;
    }
}