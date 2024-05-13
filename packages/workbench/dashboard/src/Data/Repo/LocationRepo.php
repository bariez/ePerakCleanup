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

/**
 * @laravolt site
 * @author m.shameel@3fresources.com
 **/
class LocationRepo
{
    public function jumlahkirGis($request)
    {
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        $pemilikanrumah = VwKampungRumah::with('pemilikanrumah', 'mukim', 'daerah')
                                        // ->skip(0)->take(10)
                                        ->get();

        if ($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') { // pentadbir sistem n Ptinggi n Dataentri
            $latlong = Pemilikanrumah::first();
        } elseif ($roleuser->role_id == '2') { // PDaerah
            $latlong = Pemilikanrumah::whereHas('kampung.mukim.daerah', function ($query) use ($user) {
                $query->where('fk_daerah', '=', $user->Daerah);
            })
                                        ->with('kampung.mukim.daerah')
                                        ->first();
        } elseif ($roleuser->role_id == '3') { // Pmukim
            $latlong = Pemilikanrumah::whereHas('kampung', function ($query) use ($user) {
                $query->where('fk_mukim', '=', $user->Mukim);
            })
                                        ->with('kampung.mukim')
                                        ->first();
        }

        $lat = $latlong->Latitud;
        $long = $latlong->Longitud;

        return compact('pemilikanrumah', 'lat', 'long');
    }

    public function locationGis($request)
    {
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        if ($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') { // pentadbir sistem n Ptinggi n Dataentri
            $locationgis = VwKetuaIsiRumah::get();
        } elseif ($roleuser->role_id == '2') { // PDaerah
            $locationgis = VwKetuaIsiRumah::where('fk_daerah', $user->Daerah)
                            ->get();
        } elseif ($roleuser->role_id == '3') { // Pmukim
            $locationgis = VwKetuaIsiRumah::where('fk_mukim', $user->Mukim)
                            ->get();
        }

        return $locationgis;
    }

    public function kampungGis($request)
    {
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        if ($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') { // pentadbir sistem n Ptinggi n Dataentri
            $kampung = Kampung::with('daerah', 'mukim')
                        ->first();
        } elseif ($roleuser->role_id == '2') { // PDaerah
            $kampung = Kampung::where('fk_daerah', $user->Daerah)
                        ->with('daerah', 'mukim')
                        ->first();
        } elseif ($roleuser->role_id == '3') { // Pmukim
            $kampung = Kampung::where('fk_mukim', $user->Mukim)
                        ->with('daerah', 'mukim')
                        ->first();
        }

        return $kampung;
    }

    public function kemudahanGis($request)
    {
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        $lkpdetail = LkpDetail::where('fk_lkp_master', 4)
                            ->where('status', 1)
                            // ->where('id', 14)
                            ->get();

        $typekemudahan = [];

        foreach ($lkpdetail as $key => $value2) {
            if ($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') { // pentadbir sistem n Ptinggi n Dataentri
                $kemudahamawam = VwKemudahanAwam::where('KatKemudahan', $value2->id)
                                            // ->skip(0)->take(10)
                                            ->get();

                foreach ($kemudahamawam as $key2 => $value3) {
                    $typekemudahans = (object) [];

                    $typekemudahans->KatKemudahan = $value3->KatKemudahan;
                    $typekemudahans->JenisKemudahan = $value3->JenisKemudahan;
                    $typekemudahans->NamaKemudahan = $value3->NamaKemudahan;
                    $typekemudahans->Latitud = $value3->Latitud;
                    $typekemudahans->Longitud = $value3->Longitud;
                    $typekemudahans->Description = $value3->Description;
                    $typekemudahans->NamaMukim = $value3->NamaMukim;
                    $typekemudahans->NamaDaerah = $value3->NamaDaerah;

                    $typekemudahan[] = $typekemudahans;
                }
            } elseif ($roleuser->role_id == '2') { // PDaerah
                $kemudahamawam = VwKemudahanAwam::where('KatKemudahan', $value2->id)
                                                ->where('fk_daerah', $user->Daerah)
                                                ->get();

                foreach ($kemudahamawam as $key2 => $value3) {
                    $typekemudahans = (object) [];

                    $typekemudahans->KatKemudahan = $value3->KatKemudahan;
                    $typekemudahans->JenisKemudahan = $value3->JenisKemudahan;
                    $typekemudahans->NamaKemudahan = $value3->NamaKemudahan;
                    $typekemudahans->Latitud = $value3->Latitud;
                    $typekemudahans->Longitud = $value3->Longitud;
                    $typekemudahans->Description = $value3->Description;
                    $typekemudahans->NamaMukim = $value3->NamaMukim;
                    $typekemudahans->NamaDaerah = $value3->NamaDaerah;

                    $typekemudahan[] = $typekemudahans;
                }
            } elseif ($roleuser->role_id == '3') { // Pmukim
                $kemudahamawam = VwKemudahanAwam::where('KatKemudahan', $value2->id)
                                                ->where('fk_mukim', $user->Mukim)
                                                ->get();

                foreach ($kemudahamawam as $key2 => $value3) {
                    $typekemudahans = (object) [];

                    $typekemudahans->KatKemudahan = $value3->KatKemudahan;
                    $typekemudahans->JenisKemudahan = $value3->JenisKemudahan;
                    $typekemudahans->NamaKemudahan = $value3->NamaKemudahan;
                    $typekemudahans->Latitud = $value3->Latitud;
                    $typekemudahans->Longitud = $value3->Longitud;
                    $typekemudahans->Description = $value3->Description;
                    $typekemudahans->NamaMukim = $value3->NamaMukim;
                    $typekemudahans->NamaDaerah = $value3->NamaDaerah;

                    $typekemudahan[] = $typekemudahans;
                }
            }
        }

        return $typekemudahan;
    }
}
