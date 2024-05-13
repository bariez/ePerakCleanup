<?php

namespace Workbench\Site\Data\Repo;

use App\Providers\AuditLog;
use Auth;
use Carbon\Carbon;
use DB;
use Event;
use File;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Workbench\Site\Model\Lookup\AuditLog as adlog;
use Workbench\Site\Model\Lookup\Daerah;
use Workbench\Site\Model\Lookup\Dun;
use Workbench\Site\Model\Lookup\Kampung;
use Workbench\Site\Model\Lookup\LkpDetail;
use Workbench\Site\Model\Lookup\LkpMaster;
use Workbench\Site\Model\Lookup\Mukim;
use Workbench\Site\Model\Lookup\Parlimen;

/**
 * @laravolt site
 * @author fezrul@3fresources.com
 **/
class SiteRepo
{
    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function storemaster($request)
    {
        $data = new LkpMaster;

        $data->name = $request->get('name');
        $data->parent_id = $request->get('mainlookup');
        $data->status = $request->get('status');

        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Lkp_Master';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        return $data->id;
    }

//
    public function editmaster($request, $id)
    {
        $data = LkpMaster::find($id);
        $old_value = json_encode($data);

        $data->name = $request->get('name');
        $data->parent_id = $request->get('mainlookup');
        $data->status = $request->get('status');

        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Lkp_Master';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, $old_value, json_encode($new_value)));

        return $data->id;
    }//

    public function storedetail($request)
    {
        $data = new LkpDetail;

        $data->fk_lkp_master = $request->get('masterid');
        $data->description = $request->get('description');
        $data->category_detail = $request->get('kategori');
        $data->status = $request->get('status');

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Lkp_Detail';

        $data->save();

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        return $data->id;
    }//

    public function editdetail($request, $id)
    {
        $data = LkpDetail::find($id);
        $old_value = json_encode($data);

        $data->fk_lkp_master = $request->get('masterid');
        $data->description = $request->get('description');
        $data->category_detail = $request->get('kategori');
        $data->status = $request->get('status');

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Lkp_Detail';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, $old_value, json_encode($new_value)));

        $data->save();
    }

//
    public function upload($folder, $files, $id, $type)
    {
        if ($type == 1) {
            $data = Parlimen::find($id);

            $activities = 'Kemkasini Gambar Parlimen';
        } else {
            $data = Dun::find($id);

            $activities = 'Kemkasini Gambar Dun';
        }

        $old_value = data_get($data, 'Gambar_path');

        $files = $files;
        $folder = $folder;

        $date = date('Ymd');

        if ($files != null) {
            if (! file_exists(public_path().'/uploads')) {
                mkdir(public_path().'/uploads');
            }

            if (! file_exists(public_path().'/uploads/eperak')) {
                mkdir(public_path().'/uploads/eperak');
            }

            if (! file_exists(public_path().'/uploads/eperak/'.$folder)) {
                mkdir(public_path().'/uploads/eperak/'.$folder);
            }

            if (! file_exists(public_path().'/uploads/eperak/'.$folder.'/'.$date)) {
                mkdir(public_path().'/uploads/eperak/'.$folder.'/'.$date);
            }

            $path = public_path().'/uploads/eperak/'.$folder.'/'.$date;

            $filename = $files->getClientOriginalName();

            $shortpath = '/uploads/eperak/'.$folder.'/'.$date.'/'.$filename;
            // $photo->move($path, $photo->getClientOriginalName());
            $filename = $files->getClientOriginalName();

            $extension = $files->getClientOriginalExtension();

            $size = $files->getSize();

            $files->move($path, $files->getClientOriginalName());

            $data->Gambar_path = $shortpath; //short path from storage/medical/

            $data->filename = $filename; //short path from storage/medical/
            $data->save();

            $new_value = $shortpath;

            Event::dispatch(new AuditLog(auth()->user()->id, $id, $activities, $old_value, $new_value));
        }
    }

    public function saveparlimen($request)
    {
        $data = new Parlimen;
        $data->tahun = $request->tahun;
        $data->KodParlimen = $request->kod;
        $data->NamaParlimen = $request->nama;
        $data->Parti = $request->parti;
        $data->AhliParlimen = $request->ahli;
        $data->Jawatan = $request->jawatan;
        $data->AlamatPejabat = $request->alamat;
        $data->TelNo = $request->notel;
        $data->Faks = $request->faks;
        $data->Email = $request->email;
        $data->Status = $request->status;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Parlimen';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        $this->upload('gambarparlimen', $request->gambar, $data->id, 1);
    }

//
    public function saveeditparlimen($request)
    {
        $data = Parlimen::find($request->idparlimen);
        $old_value = json_encode($data);
        $data->tahun = $request->tahun;
        $data->KodParlimen = $request->kod;
        $data->NamaParlimen = $request->nama;
        $data->Parti = $request->parti;
        $data->AhliParlimen = $request->ahli;
        $data->Jawatan = $request->jawatan;
        $data->AlamatPejabat = $request->alamat;
        $data->TelNo = $request->notel;
        $data->Faks = $request->faks;
        $data->Email = $request->email;
        $data->Status = $request->status;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Parlimen';

        Event::dispatch(new AuditLog(auth()->user()->id, $request->idparlimen, $activities, $old_value, json_encode($new_value)));

        $this->upload('gambarparlimen', $request->gambar, $request->idparlimen, 1);
    }

//
    public function savedun($request)
    {
        $data = new Dun;
        $data->fk_parlimen = $request->parlimen;
        $data->tahun = $request->tahun;
        $data->KodDun = $request->kod;
        $data->NamaDun = $request->nama;
        $data->Parti = $request->parti;
        $data->AhliDun = $request->ahli;
        $data->Jawatan = $request->jawatan;
        $data->AlamatPejabat = $request->alamat;
        $data->TelNo = $request->notel;
        $data->status = $request->status;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Dun';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        $this->upload('gambardun', $request->gambar, $data->id, 2);
    }

//
    public function saveeditdun($request)
    {
        $data = Dun::find($request->iddun);
        $old_value = json_encode($data);
        $data->fk_parlimen = $request->parlimen;
        $data->tahun = $request->tahun;
        $data->KodDun = $request->kod;
        $data->NamaDun = $request->nama;
        $data->Parti = $request->parti;
        $data->AhliDun = $request->ahli;
        $data->Jawatan = $request->jawatan;
        $data->AlamatPejabat = $request->alamat;
        $data->TelNo = $request->notel;
        $data->status = $request->status;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Dun';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, $old_value, json_encode($new_value)));

        $this->upload('gambardun', $request->gambar, $data->id, 2);
    }

//
    public function savedaerah($request)
    {
        $data = new Daerah;
        $data->KodDaerah = $request->kod;
        $data->NamaDaerah = $request->nama;
        $data->NamaPegawaiDaerah = $request->namapegawai;
        $data->Status = $request->status;
        $data->url_gis = $request->urlgis;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Daerah';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));
    }

//
    public function saveeditdaerah($request)
    {
        $data = Daerah::find($request->iddaerah);
        $old_value = json_encode($data);
        $data->KodDaerah = $request->kod;
        $data->NamaDaerah = $request->nama;
        $data->NamaPegawaiDaerah = $request->namapegawai;
        $data->Status = $request->status;
        $data->url_gis = $request->urlgis;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Daerah';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, $old_value, json_encode($new_value)));
    }

//
    public function savemukim($request)
    {
        $data = new Mukim;
        $data->fk_daerah = $request->daerah;
        $data->KodMukim = $request->kod;
        $data->NamaMukim = $request->nama;
        $data->NamaPenghuluMukim = $request->namapenghulu;
        $data->status = $request->status;
        $data->url_gis = $request->urlgis;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Mukim';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));
    }

//
    public function saveeditmukim($request)
    {
        $data = Mukim::find($request->idmukim);
        $old_value = json_encode($data);
        $data->fk_daerah = $request->daerah;
        $data->KodMukim = $request->KodMukim;
        $data->NamaMukim = $request->nama;
        $data->NamaPenghuluMukim = $request->namapenghulu;
        $data->status = $request->status;
        $data->url_gis = $request->urlgis;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Mukim';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, $old_value, json_encode($new_value)));
    }

//
    public function savekampung($request)
    {
        $data = new Kampung;
        $data->fk_parlimen = $request->parlimen;
        $data->fk_dun = $request->dun;
        $data->fk_daerah = $request->daerah;
        $data->fk_mukim = $request->mukim;
        $data->kod = $this->generatekod($request->parlimen, $request->dun, $request->daerah, $request->mukim);
        $data->IdKampung = $this->generateidkampung($data->kod, $request->daerah, $request->mukim);
        if ($request->cat == 4 || $request->cat == 5 || $request->cat == 6 || $request->cat == 9) {
            $data->NamaKampung = $request->namakampung;
        } else {
            if ($request->cat == 7) {//taman
                $data->NamaKampung = $request->namataman;
            } else {//serata
                $data->NamaKampung = $request->namaserata;
            }
        }

        $data->IdKampungInduk = $request->kginduk;
        $data->KategoriPetempatan = $request->cat;
        $data->JenisKgTradisional = $request->kgtradisional;
        $data->NamaJPKK = $request->namajpkk;
        $data->AlamatJPKK = $request->alamatjpkk;
        $data->status = $request->status;
        $data->url_gis = $request->urlgis;
        // $data->Longitud=$request->Longitud;
        // $data->Latitud=$request->Latitud;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Kampung';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));
    }

//
    public function saveeditkampung($request)
    {
        $data = Kampung::find($request->idkampung);

        $data->fk_parlimen = $request->parlimen;

        if ($request->dun == '') {
            $data->fk_dun = $request->dunedit;
        } else {
            $data->fk_dun = $request->dun;
        }

        $data->fk_daerah = $request->daerah;
        if ($request->mukim == '') {
            $data->fk_mukim = $request->mukimedit;
        } else {
            $data->fk_mukim = $request->mukim;
        }

        if ($request->cat == 4 || $request->cat == 5 || $request->cat == 6 || $request->cat == 9) {
            if ($request->namakampung == '') {
                $data->NamaKampung = $request->namakampungedit;
            } else {
                $data->NamaKampung = $request->namakampung;
            }
        } else {
            if ($request->cat == 7) {//taman

                if ($request->namataman == '') {
                    $data->NamaKampung = $request->namataman;
                } else {
                    $data->NamaKampung = $request->namatamanedit;
                }
            } else {//serata

                if ($request->namaserata == '') {
                    $data->NamaKampung = $request->namaserata;
                } else {
                    $data->NamaKampung = $request->namaserataedit;
                }
            }
        }

        if ($request->kgtradisional == 148) {//kampung rangkaian
            $data->IdKampungInduk = $request->indukedit;
        } else {//kampung induk
            $data->IdKampungInduk = null;
        }

        $data->KategoriPetempatan = $request->cat;
        $data->JenisKgTradisional = $request->kgtradisional;
        $data->NamaJPKK = $request->namajpkk;
        $data->AlamatJPKK = $request->alamatjpkk;
        $data->status = $request->status;
        $data->url_gis = $request->urlgis;
        // $data->Longitud=$request->Longitud;
        // $data->Latitud=$request->Latitud;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Kampung';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));
    }

//
    public function generatekod($parlimen, $dun, $daerah, $mukim)
    {
        $countkampung = Kampung::where('fk_parlimen', $parlimen)
                              ->where('fk_dun', $dun)
                              ->where('fk_daerah', $daerah)
                              ->where('fk_mukim', $mukim)
                              ->count();

        if ($countkampung < 10) {
            $id = '00'.$countkampung + 1;
        } else {
            if ($countkampung >= 10 && $countkampung <= 99) {
                $id = '0'.$countkampung + 1;
            } else {
                $id = $countkampung + 1;
            }
        }

        return $id;
    }

    public function generateidkampung($kodkampung, $daerah, $mukim)
    {
        $koddaerah = Daerah::find($daerah);
        $kodmukim = Mukim::find($mukim);

        $idkampung = '08'.data_get($koddaerah, 'KodDaerah').data_get($kodmukim, 'KodMukim').$kodkampung;

        return $idkampung;
    }

    public function resultsearch($user, $datefrom, $dateto, $kat)
    {
        $user = $user;
        $datefrom = $datefrom;
        $dateto = $dateto;
        $kat = $kat;

        $daterange = [date('Y-m-d 00:00:00', strtotime($datefrom)), date('Y-m-d 23:59:59', strtotime($dateto))];

        $data = adlog::with('users', 'users.user_role.acl_roles')
              ->where(function ($query) use ($user) {
                  if ($user != '0') {
                      $query->where('fk_user', '=', $user);
                  } else {
                      $query;
                  }
              })
              ->where(function ($query) use ($datefrom, $dateto, $daterange) {
                  if ($datefrom != '0' && $dateto != '0') {
                      $query->whereBetween('created_at', $daterange);
                  } else {
                      $query;
                  }
              })
              ->whereHas('users.user_role', function ($query) use ($kat) {
                  if ($kat != '0') {
                      $query->where('role_id', '=', $kat);
                  }
              })
              ->orderby('created_at', 'asc')->get();

        return $data;
    }
} //end of class
