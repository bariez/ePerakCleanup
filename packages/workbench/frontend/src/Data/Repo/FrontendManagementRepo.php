<?php

namespace Workbench\Frontend\Data\Repo;

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
use Workbench\Site\Model\Frontend\Banner;
use Workbench\Site\Model\Frontend\ContentPage;
use Workbench\Site\Model\Frontend\Hubungi;
use Workbench\Site\Model\Frontend\Logo;
use Workbench\Site\Model\Frontend\Menum;
use Workbench\Site\Model\Frontend\Notis;
use Workbench\Site\Model\Frontend\ProductIcon;
use Workbench\Site\Model\Frontend\SoalanLazim;
use Workbench\Site\Model\Lookup\Daerah;
use Workbench\Site\Model\Lookup\Dun;
use Workbench\Site\Model\Lookup\GaleriDetail;
use Workbench\Site\Model\Lookup\GaleriMast;
use Workbench\Site\Model\Lookup\Isirumah;
use Workbench\Site\Model\Lookup\Kampung;
use Workbench\Site\Model\Lookup\LkpDetail;
use Workbench\Site\Model\Lookup\LkpMaster;
use Workbench\Site\Model\Lookup\Mukim;
use Workbench\Site\Model\Lookup\Parlimen;
use Workbench\Site\Model\Lookup\Pemilikanrumah;
use Workbench\Site\Model\Lookup\ProfilAktiviti;
use Workbench\Site\Model\Lookup\ProfilKemudahan;
use Workbench\Site\Model\Lookup\ProfilPencapaian;
use Workbench\Site\Model\Lookup\ProfilProduk;
use Workbench\Site\Model\Lookup\ProfilProjek;

/**
 * @laravolt site
 * @author apip
 **/
class FrontendManagementRepo
{
    /**
     * undocumented function
     *
     * @return void
     * @author
     **/

    // logo ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function logo($request)
    {
        $logo = Logo::orderBy('status', 'DESC')
                     ->get();
        // ->where('status', 1)
        // ->get();

        return $logo;
    }

    public function regSaveLogoAdd($request)
    {
        if (data_get($request, 'status') == 1) {
            $deactivate = Logo::where('type', $request->type)
                              ->where('status', 1)
                              ->first();

            if ($deactivate) {
                $deactivate->status = 0;
                $deactivate->update();
            }
        }

        // dd($cekaktiflogo);exit;

        $logo = new Logo;

        $logo->alt = $request->info;
        $logo->type = $request->type;
        $logo->status = $request->status;
        $logo->save();

        $activities = 'Tambah Logo';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $logo->id, $activities, '', json_encode($new_value)));

        if ($request->logo) {
            $this->upload('logo', $request->logo, $logo->id, 1);
        }
    }

    public function logoEdit($request)
    {
        $data = Logo::find($request->logo_id);

        return $data;
    }

    public function regSaveLogoEdit($request)
    {
        if (data_get($request, 'status') == 1) {
            $deactivate = Logo::where('type', $request->type)
                              ->where('status', 1)
                              ->first();

            if ($deactivate) {
                $deactivate->status = 0;
                $deactivate->update();
            }
        }

        $logo = Logo::find($request->logo_id);
        $old_value = json_encode($logo);

        $logo->alt = $request->info;
        $logo->type = $request->type;
        $logo->status = $request->status;
        $logo->update();

        $activities = 'Kemaskini Logo';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $logo->id, $activities, $old_value, json_encode($new_value)));

        if ($request->logo) {
            $this->upload('logo', $request->logo, $logo->id, 1);
        }
    }

    public function logoDelete($request)
    {
        $data = Logo::find($request->logo_id);
        $data->delete();

        // return $data;
    }

    // banner ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function bannerList($request)
    {
        $banner = Banner::get();
        // ->where('status', 1)
        // ->get();

        return $banner;
    }

    public function regSaveBannerAdd($request)
    {
        // dd($request);exit;
        $banner = new Banner;

        $banner->tajuk = $request->title;
        $banner->keterangan = $request->desc;
        $banner->tarikh_mula = $request->start_date;
        $banner->tarikh_akhir = $request->end_date;
        $banner->status = $request->status;
        $banner->save();

        $activities = 'Tambah Banner';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $banner->id, $activities, '', json_encode($new_value)));

        if ($request->image) {
            $this->upload('banner', $request->image, $banner->id, 2);
        }
    }

    public function bannerEdit($request)
    {
        $data = Banner::find($request->banner_id);

        return $data;
    }

    public function regSaveBannerEdit($request)
    {
        $banner = Banner::find($request->banner_id);
        $old_value = json_encode($banner);

        $banner->tajuk = $request->title;
        $banner->keterangan = $request->desc;
        $banner->tarikh_mula = $request->start_date;
        $banner->tarikh_akhir = $request->end_date;
        $banner->status = $request->status;
        $banner->update();

        $activities = 'Kemaskini Banner';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $banner->id, $activities, $old_value, json_encode($new_value)));

        if ($request->image) {
            $this->upload('banner', $request->image, $banner->id, 2);
        }
    }

    public function bannerDelete($request)
    {
        $data = Banner::find($request->banner_id);
        $data->delete();

        // return $data;
    }

    // notis ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function notisList($request)
    {
        $notis = Notis::get();
        // ->where('status', 1)
        // ->get();

        return $notis;
    }

    public function regSaveNotisAdd($request)
    {
        $formatdate = date('Y-M-d', strtotime($request->notis_date));

        // dd($formatdate, $request->notis_date);exit;
        $notis = new Notis;

        $notis->tajuk = $request->title;
        $notis->fk_daerah = $request->lokasi;
        $notis->ringkasan = $request->summary;
        $notis->keterangan = $request->desc;
        $notis->tarikh_notis = $request->notis_date;
        $notis->tarikh_mula = $request->start_date;
        $notis->tarikh_akhir = $request->end_date;
        $notis->status = $request->status;

        $notis->tarikh_notis_date = $formatdate;

        $notis->save();

        $activities = 'Tambah Notis';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $notis->id, $activities, '', json_encode($new_value)));

        if ($request->image) {
            $this->upload('notis', $request->image, $notis->id, 3);
        }
    }

    public function notisEdit($request)
    {
        $data = Notis::find($request->notis_id);

        return $data;
    }

    public function regSaveNotisEdit($request)
    {
        $formatdate = date('Y-M-d', strtotime($request->notis_date));

        $notis = Notis::find($request->notis_id);
        $old_value = json_encode($notis);

        $notis->tajuk = $request->title;
        $notis->fk_daerah = $request->lokasi;
        $notis->ringkasan = $request->summary;
        $notis->keterangan = $request->desc;
        $notis->tarikh_notis = $request->notis_date;
        $notis->tarikh_mula = $request->start_date;
        $notis->tarikh_akhir = $request->end_date;
        $notis->status = $request->status;

        $notis->tarikh_notis_date = $formatdate;

        $notis->update();

        $activities = 'Kemaskini Notis';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $notis->id, $activities, $old_value, json_encode($new_value)));

        if ($request->image) {
            $this->upload('notis', $request->image, $notis->id, 3);
        }
    }

    // hubungi ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function hubungiList($request)
    {
        $hubungi = Hubungi::get();
        // ->where('status', 1)
        // ->get();

        return $hubungi;
    }

    public function regSaveHubungiAdd($request)
    {
        // dd($request);exit;
        $hubungi = new Hubungi;

        $hubungi->nama = $request->nama;
        $hubungi->alamat = $request->address;
        $hubungi->no_tel = $request->phone;
        $hubungi->no_faks = $request->faks;
        $hubungi->email = $request->emel;
        $hubungi->status = $request->status;
        $hubungi->save();

        $activities = 'Tambah Hubungi Kami';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $hubungi->id, $activities, '', json_encode($new_value)));
    }

    public function hubungiEdit($request)
    {
        $data = Hubungi::find($request->hubungi_id);

        return $data;
    }

    public function regSaveHubungiEdit($request)
    {
        $hubungi = Hubungi::find($request->hubungi_id);
        $old_value = json_encode($hubungi);

        $hubungi->nama = $request->nama;
        $hubungi->alamat = $request->address;
        $hubungi->no_tel = $request->phone;
        $hubungi->no_faks = $request->faks;
        $hubungi->email = $request->emel;
        $hubungi->status = $request->status;
        $hubungi->update();

        $activities = 'Kemaskini Hubungi Kami';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $hubungi->id, $activities, $old_value, json_encode($new_value)));
    }

    // soalan lazim -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function soalanList($request)
    {
        $soalan = SoalanLazim::get();
        // ->where('status', 1)
        // ->get();

        return $soalan;
    }

    public function regSaveSoalanAdd($request)
    {
        $soalan = new SoalanLazim;

        $soalan->Soalan = $request->question;
        $soalan->Jawapan = $request->answer;
        $soalan->Susunan = $request->queue;
        $soalan->Status = $request->status;
        $soalan->save();

        $activities = 'Tambah Soalan Lazim';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $soalan->id, $activities, '', json_encode($new_value)));
    }

    public function soalanEdit($request)
    {
        $data = SoalanLazim::find($request->soalan_id);

        return $data;
    }

    public function regSaveSoalanEdit($request)
    {
        $soalan = SoalanLazim::find($request->soalan_id);
        $old_value = json_encode($soalan);

        $soalan->Soalan = $request->question;
        $soalan->Jawapan = $request->answer;
        $soalan->Susunan = $request->queue;
        $soalan->Status = $request->status;
        $soalan->update();

        $activities = 'Kemaskini Soalan Lazim';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $soalan->id, $activities, $old_value, json_encode($new_value)));
    }

    // Product icon -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function producticonList($request)
    {
        $data = ProductIcon::with('lkp_detail')->get();
        // ->where('status', 1)
        // ->get();

        return $data;
    }

    public function regSaveProductIconAdd($request)
    {
        // dd($request);exit;
        if (data_get($request, 'status') == 1) {
            $deactivate = ProductIcon::where('fk_lkp_detail', $request->katprod)
                                     ->where('status', 1)
                                     ->first();

            if ($deactivate) {
                $deactivate->status = 0;
                $deactivate->update();
            }
        }

        // dd($request);exit;
        $icon = new ProductIcon;

        $icon->fk_lkp_detail = $request->katprod;
        $icon->status = $request->status;
        $icon->save();

        $activities = 'Tambah Ikon Produk Kategori';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $icon->id, $activities, '', json_encode($new_value)));

        if ($request->icon) {
            $this->upload('ikonkatproduk', $request->icon, $icon->id, 4);
        }
    }

    public function producticonEdit($request)
    {
        $data = ProductIcon::find($request->katprod_id);

        return $data;
    }

    public function regSaveProductIconEdit($request)
    {
        // dd($request);exit;
        if (data_get($request, 'status') == 1) {
            $deactivate = ProductIcon::where('fk_lkp_detail', $request->katprod)
                                     ->where('status', 1)
                                     ->first();

            if ($deactivate) {
                $deactivate->status = 0;
                $deactivate->update();
            }
        }

        $icon = ProductIcon::find($request->katprod_id);
        $old_value = json_encode($icon);

        $icon->fk_lkp_detail = $request->katprod;
        $icon->status = $request->status;
        $icon->update();

        $activities = 'Kemaskini Ikon Produk Kategori';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $icon->id, $activities, $old_value, json_encode($new_value)));

        if ($request->icon) {
            $this->upload('ikonkatproduk', $request->icon, $icon->id, 4);
        }
    }

    // Menu -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function menuList($request)
    {
        $data = Menum::get();
        // ->where('status', 1)
        // ->get();

        return $data;
    }

    public function regSaveMenuAdd($request)
    {
        // dd($request);exit;
        $menu = new Menum;

        $menu->nama = ucwords($request->name);
        // $menu->url		= $request->url;
        $menu->susunan = $request->queue;
        $menu->status = $request->status;
        $menu->save();

        $activities = 'Tambah Menu Laman Utama';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $menu->id, $activities, '', json_encode($new_value)));
    }

    public function menuEdit($request)
    {
        $data = Menum::find($request->menu_id);

        return $data;
    }

    public function regSaveMenuEdit($request)
    {
        $menu = Menum::find($request->menu_id);
        $old_value = json_encode($menu);

        $menu->nama = ucwords($request->name);
        // $menu->url		= $request->url;
        $menu->susunan = $request->queue;
        $menu->status = $request->status;
        $menu->update();

        $activities = 'Kemaskini Menu Laman Utama';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $menu->id, $activities, $old_value, json_encode($new_value)));
    }

    // Page -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function pageList($request)
    {
        $data = ContentPage::get();
        // ->where('status', 1)
        // ->get();

        return $data;
    }

    public function regSavePageAdd($request)
    {
        // dd($request);exit;
        $page = new ContentPage;

        $page->fk_menum = $request->fkmenu;
        $page->nama = $request->title;
        $page->content = $request->pagecontent;
        $page->status = $request->status;
        $page->save();

        $activities = 'Tambah Page';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $page->id, $activities, '', json_encode($new_value)));

        if ($request->image) {
            $this->upload('page', $request->image, $page->id, 5);
        }
    }

    public function pageEdit($request)
    {
        $data = ContentPage::find($request->page_id);

        return $data;
    }

    public function regSavePageEdit($request)
    {
        $page = ContentPage::find($request->page_id);
        $old_value = json_encode($page);

        $page->fk_menum = $request->fkmenu;
        $page->nama = $request->title;
        $page->content = $request->pagecontent;
        $page->status = $request->status;
        $page->update();

        $activities = 'Kemaskini Page';
        $new_value = $request->except(['_token', 'action']);

        Event::dispatch(new AuditLog(auth()->user()->id, $page->id, $activities, $old_value, json_encode($new_value)));

        if ($request->image) {
            $this->upload('page', $request->image, $page->id, 5);
        }
    }

    // start function ------------------------------------------------

    public function upload($folder, $files, $id, $type)
    {
        if ($type == 1) {
            $data = Logo::find($id);

            $activities = 'Upload Logo';
        } elseif ($type == 2) {
            $data = Banner::find($id);

            $activities = 'Upload Banner';
        } elseif ($type == 3) {
            $data = Notis::find($id);

            $activities = 'Upload Notis';
        } elseif ($type == 4) {
            $data = ProductIcon::find($id);

            $activities = 'Upload Ikon Kategori Produk';
        } elseif ($type == 5) {
            $data = ContentPage::find($id);

            $activities = 'Upload Page';
        } else {
        }

        $old_value = data_get($data, 'path');

        $files = $files;
        $folder = $folder;
        $date = date('Ymd');

        if (! file_exists(public_path().'/uploads')) {
            mkdir(public_path().'/uploads');
        }
        if (! file_exists(public_path().'/uploads/eperak')) {
            mkdir(public_path().'/uploads/eperak');
        }
        if (! file_exists(public_path().'/uploads/eperak/frontend')) {
            mkdir(public_path().'/uploads/eperak/frontend');
        }
        if (! file_exists(public_path().'/uploads/eperak/frontend/'.$folder)) {
            mkdir(public_path().'/uploads/eperak/frontend/'.$folder);
        }
        if (! file_exists(public_path().'/uploads/eperak/frontend/'.$folder.'/'.$date)) {
            mkdir(public_path().'/uploads/eperak/frontend/'.$folder.'/'.$date);
        }

        $path = public_path().'/uploads/eperak/frontend/'.$folder.'/'.$date;
        $filename = str_replace(' ', '', $files->getClientOriginalName());

        $shortpath = '/uploads/eperak/frontend/'.$folder.'/'.$date.'/'.$filename;

        $files->move($path, str_replace(' ', '', $files->getClientOriginalName()));

        $data->path = $shortpath;
        $data->filename = $filename;
        $data->update();

        $new_value = $shortpath;

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, $old_value, $new_value));
    }

    // start lookup table ------------------------------------------------

    // plucking
    public function lkpDaerah()
    {
        return Daerah::where('status', 1)->get();
    }

    public function lkpDetailKategoriProduk()
    {
        return LkpDetail::where('fk_lkp_master', 7)
                        ->where('status', 1)
                        ->get();
    }

    public function lkpMenu()
    {
        return Menum::where('status', 1)
                    ->whereNotIn('id', function ($query) {
                        $query->select(DB::raw('fk_menum FROM content_page'));
                    })
                    ->get();
    }

    public function lkpMenuEdit($request)
    {
        return Menum::with('contentpage')
                    ->whereHas('contentpage', function ($query) use ($request) {
                        $query->where('id', '=', $request->page_id);
                    })
                    ->first();
    }
} //end of class
