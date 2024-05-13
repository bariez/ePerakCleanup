<?php

namespace Workbench\Dataentry\Http\Controllers;

use App\Imports\AhliIsiRumahImport;
use App\Imports\KetuaIsiRumahImport;
use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use App\Events\AuditLog;
use Carbon\Carbon;
use Curl;
use DB;
use Event;
use File;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use PDF;
use Redirect;
use Workbench\Dataentry\Data\Repo\DataentryRepo;
use Workbench\Site\Model\Lookup\AclRoleUser;
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
use Workbench\Site\Model\Lookup\ProfilPengeluar;
use Workbench\Site\Model\Lookup\ProfilPentadbiran;
use Workbench\Site\Model\Lookup\ProfilProduk;
use Workbench\Site\Model\Lookup\ProfilProjek;
use Workbench\Site\Model\Lookup\VwJantina;

class DataentryController extends Controller
{
    public function __construct(DataentryRepo $repos)
    {
        $this->repos = $repos;
    }

    public function index()
    {
        $parlimen = Parlimen::where('status', 1)->get();
        $dun = Dun::where('status', 1)->get();

        $catpenempatan = LkpDetail::where('status', 1)->where('fk_lkp_master', 3)->get();

        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        if (data_get($roleuser, 'role_id') == 2 || data_get($roleuser, 'role_id') == 3) {
            $daerahuser = data_get($user, 'Daerah');
            $daerah = Daerah::find($daerahuser);
            $mukimuser = data_get($user, 'Mukim');
            $mukim = Mukim::find($mukimuser);
        } else {
            $daerah = Daerah::where('status', 1)->get();
            $mukim = Mukim::where('status', 1)->get();
            $daerahuser = '';
            $mukimuser = '';
        }

        return view('dataentry::searchkampung.index', compact('parlimen', 'dun', 'daerah', 'mukim', 'catpenempatan', 'roleuser', 'daerahuser', 'mukimuser'));
        //return view('dashboard::dashboard.index');
    }

    public function dun($parlimenid)
    {
        $dun = Dun::where('fk_parlimen', $parlimenid)->get();

        return view('dataentry::searchkampung.dun', compact('dun'));
    }

    public function parlimenKampung($daerahid, $mukimid)
    {
        $parlimenKampung = Kampung::selectRaw('distinct(parlimen.id),parlimen.NamaParlimen')
                        ->leftjoin('parlimen', 'parlimen.id', '=', 'kampung.fk_parlimen');

        if ($daerahid == 0) {
            $parlimenKampung = $parlimenKampung;
        } else {
            $parlimenKampung = $parlimenKampung->where('fk_daerah', $daerahid);
        }

        if ($mukimid != 0) {
            $parlimenKampung = $parlimenKampung->where('fk_mukim', $mukimid);
        }

        $parlimenKampung = $parlimenKampung->whereNull('IdKampungInduk')->get();

        return view('dataentry::searchkampung.parlimenkampung', compact('parlimenKampung'));
    }

    public function mukim($daerahid)
    {
        $mukim = Mukim::where('fk_daerah', $daerahid)->get();

        return view('dataentry::searchkampung.mukim', compact('mukim'));
    }

    public function kampung($parlimenid, $dunid, $daerahid, $mukimid, $catpenempatan, $kampungid)
    {
        $kampung = Kampung::selectRaw('id,NamaKampung');

        if ($parlimenid == 0) {
            $kampung = $kampung;
        } else {
            $kampung = Kampung::where('fk_parlimen', $parlimenid);
        }

        if ($dunid != 0) {
            $kampung = $kampung->where('fk_dun', $dunid);
        }

        if ($daerahid != 0) {
            $kampung = $kampung->where('fk_daerah', $daerahid);
        }
        if ($mukimid != 0) {
            $kampung = $kampung->where('fk_mukim', $mukimid);
        }
        if ($catpenempatan != 0) {
            if ($catpenempatan == 4) {
                $kampung = $kampung->where('KategoriPetempatan', $catpenempatan)
                                ->whereNull('IdKampungInduk');
            } else {
                $kampung = $kampung->where('KategoriPetempatan', $catpenempatan);
            }
        } else {
            $kampung = $kampung->whereNull('IdKampungInduk');
        }
        if ($kampungid != 0) {
            $kampung = $kampung->where('id', $kampung);
        }

        $kampung = $kampung->get();

        return view('dataentry::searchkampung.kampung', compact('kampung'));
    }

    public function resultsearch(Request $request)
    {
        $result = $this->repos->resultsearch($request);

        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        return view('dataentry::searchkampung.searchresult', compact('result', 'roleuser'));
    }

    public function mainmenu($id, $tabmain, $tabdetail, $iddetail)
    {
        $tabmain = $tabmain;
        $tabdetail = $tabdetail;
        $id = $id;
        $iddetail = $iddetail;

        $data_kampung = Kampung::find($id);

        return view('dataentry::searchkampung.mainmenu', compact('tabmain', 'tabdetail', 'id', 'iddetail', 'data_kampung'));
    }

    public function editkampung($id, $tabmain, $tabdetail, $iddetail)
    {
        $tabmain = $tabmain;
        $tabdetail = $tabdetail;
        $id = $id;
        $iddetail = $iddetail;

        $datakampung = Kampung::find($id);

        return view('dataentry::searchkampung.tab1.edit_profil_kg', compact('tabmain', 'tabdetail', 'id', 'iddetail', 'datakampung'));
    }

    // add NEW 21/02/2024
    public function menuKampungEdit()
    {
        $tabmain = 1;
        $tabdetail = 1;
        //	$idMenu=$idMenu;
        $iddetail = 0;

        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        $id = $user->Kampung;

        $datakampung = Kampung::find($id);

        // return view('dataentry::searchkampung.tab1.edit_profil_kg',compact('tabmain','tabdetail','id','iddetail','datakampung'));
        return redirect::to('/dataentry/searchkampung/editkampung/'.$id.'/'.$tabmain.'/'.$tabdetail.'/'.$iddetail);
    }

    public function menuKampungEditIsi()
    {
        $tabmain = 1;
        $tabdetail = 1;
        //	$idMenu=$idMenu;
        $iddetail = 0;

        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        $id = $user->Kampung;
        $datakampung = Kampung::find($id);

        //  return view('dataentry::isirumah.ketuaisirumah.listketuaisirumah',compact('idkampung','ketuaisirumah','kamusdata','infokampung','roleuser'));
        return redirect::to('/dataentry/searchkampung/isirumah/ketuaisirumah/'.$id);
    }

    //until here

    public function gettab($id, $tabmain, $tabdetail, $iddetail)
    {
        $tabmain = $tabmain;
        $tabdetail = $tabdetail;
        $id = $id;
        $iddetail = $iddetail;

        if ($tabmain == 1) {
            return $this->profil($id, $tabmain, $tabdetail, $iddetail);
        } elseif ($tabmain == 3) {
            return $this->kemudahan($id, $tabmain, $tabdetail, $iddetail);
        } elseif ($tabmain == 4) {
            return $this->pencapaian($id, $tabmain, $tabdetail, $iddetail);
        } elseif ($tabmain == 5) {
            return $this->aktiviti($id, $tabmain, $tabdetail, $iddetail);
        } elseif ($tabmain == 6) {
            return $this->produk($id, $tabmain, $tabdetail, $iddetail);
        } elseif ($tabmain == 7) {
            return $this->projek($id, $tabmain, $tabdetail, $iddetail);
        } elseif ($tabmain == 8) {
            return $this->galeri($id, $tabmain, $tabdetail, $iddetail);
        } else {
            return $this->strukorg($id, $tabmain, $tabdetail, $iddetail);
        }

        // return view('dataentry::searchkampung.tab1.edit_profil_kg',compact('tabmain','tabdetail'));
    }

    public function profil($id, $tabmain, $tabdetail, $iddetail)
    {
        $tabmain = $tabmain;
        $tabdetail = $tabdetail;
        $id = $id;
        $iddetail = $iddetail;
        $currentyear = date('Y');

        $kampung = Kampung::with('parlimen', 'dun', 'daerah', 'mukim', 'catpetempatan')->where('id', $id)->first();

        $namapengerusi = ProfilPentadbiran::where('fk_kampung', $id)
                        ->where('jawatan', '141')->orderBy('Sesi', 'desc')->where('status', 1)->first();

        return view('dataentry::searchkampung.tab1.profilkampung', compact('kampung', 'tabmain', 'tabdetail', 'id', 'iddetail', 'namapengerusi'));
    }

    public function strukorg($id, $tabmain, $tabdetail, $iddetail)
    {
        $tabmain = $tabmain;
        $tabdetail = $tabdetail;
        $id = $id;
        $iddetail = $iddetail;
        $jawatan = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 26)->get();

        $pentadbiran = ProfilPentadbiran::with('kampung', 'jawatan')
                        ->where('fk_kampung', $id)->get();

        $data_pentadbiran = ProfilPentadbiran::with('kampung', 'jawatan')
                             ->where('id', $iddetail)->first();

        if ($tabdetail == 1) {
            return view('dataentry::searchkampung.tab2.strukorg', compact('pentadbiran', 'tabmain', 'tabdetail', 'id', 'iddetail'));
        } elseif ($tabdetail == 2) {
            return view('dataentry::searchkampung.tab2.addstrukorg', compact('pentadbiran', 'tabmain', 'tabdetail', 'id', 'iddetail', 'jawatan'));
        } elseif ($tabdetail == 4) {
            return view('dataentry::searchkampung.tab2.viewstrukorg', compact('pentadbiran', 'tabmain', 'tabdetail', 'id', 'iddetail', 'jawatan', 'data_pentadbiran'));
        } else {//edit

            $iddetail = $iddetail;

            return view('dataentry::searchkampung.tab2.editstrukorg', compact('pentadbiran', 'tabmain', 'tabdetail', 'id', 'iddetail', 'jawatan', 'data_pentadbiran'));
        }
    }

    public function savekampung(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namepengerusi'=>'required',
            'alamtsurat'=>'required',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        } else {
            $savekampung = $this->repos->savekampung($request);

            return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/2/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
        }
    }

    public function savestruktur(Request $request)
    {

        //   $validator = Validator::make($request->all(), [
        //     'tahun'     => 'required',
        //     'nama'=>'required',
        //     'nokp'=>'required',
        //     'jawatan'=>'required',
        //     'biro'=>'required',
        //     'gambar'=>'required',
        //     'status'=>'required'

        // ]);

        // if($validator->fails()) {
        //    return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/2/2/0')->withErrors($validator)->withInput($request->all())else{

        //check pengerusi

        $pengerusi = ProfilPentadbiran::where('fk_kampung', $request->idkampung)
                    ->where('jawatan', $request->jawatan)
                    ->where('Sesi', $request->tahun)->where('Status', 1)->count();

        if ($pengerusi > 0) {
            return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/2/2/0')->withErrors(__('Data Pengerusi Telah Wujud'));
        } else {
            $savestruktur = $this->repos->savestruktur($request);

            return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/2/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
        }
    }

    public function editstruktur(Request $request)
    {

        //   $validator = Validator::make($request->all(), [
        //     'tahun'     => 'required',
        //     'nama'=>'required',
        //     'nokp'=>'required',
        //     'jawatan'=>'required',
        //     'biro'=>'required',
        //     'gambar'=>'required',
        //     'status'=>'required'

        // ]);

        // if($validator->fails()) {
        //    return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/2/2/0')->withErrors($validator)->withInput($request->all())else{

        $pengerusi = ProfilPentadbiran::where('fk_kampung', $request->idkampung)
                    ->where('jawatan', $request->jawatan)
                    ->where('Sesi', $request->tahun)->where('Status', 1)->where('id', '<>', $request->iddetail)->count();

        if ($pengerusi > 0) {
            return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/2/3/'.$request->iddetail)->withErrors(__('Data Pengerusi Telah Wujud'));
        } else {
            $editstruktur = $this->repos->editstruktur($request);

            return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/2/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
        }
    }

    public function deletestruk($deletestruk, $idkampung)
    {
        $deletestruk = ProfilPentadbiran::find($deletestruk);
        $deletestruk->delete();

        return redirect::to('/dataentry/searchkampung/editkampung/'.$idkampung.'/2/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function kemudahan($id, $tabmain, $tabdetail, $iddetail)
    {
        $tabmain = $tabmain;
        $tabdetail = $tabdetail;
        $id = $id;
        $iddetail = $iddetail;
        $catkemudahan = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 4)->get();
        $unit = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 15)->get();

        $kemudahan = ProfilKemudahan::with('kampung', 'katkemudahan', 'jeniskemudahan', 'unit')
                        ->where('fk_kampung', $id)->get();

        $data_kemudahan = ProfilKemudahan::with('kampung', 'katkemudahan', 'jeniskemudahan', 'unit')
                             ->where('id', $iddetail)->first();

        $jeniskemudahan = LkpDetail::where('category_detail', data_get($data_kemudahan, 'KatKemudahan'))->get();

        if ($tabdetail == 1) {
            return view('dataentry::searchkampung.tab3.listkemudahan', compact('kemudahan', 'tabmain', 'tabdetail', 'id', 'iddetail'));
        } elseif ($tabdetail == 2) {
            return view('dataentry::searchkampung.tab3.addkemudahan', compact('kemudahan', 'tabmain', 'tabdetail', 'id', 'iddetail', 'catkemudahan', 'unit'));
        } elseif ($tabdetail == 3) {
            return view('dataentry::searchkampung.tab3.editkemudahan', compact('kemudahan', 'tabmain', 'tabdetail', 'id', 'iddetail', 'catkemudahan', 'data_kemudahan', 'unit', 'jeniskemudahan'));
        } else {//edit

            $iddetail = $iddetail;

            return view('dataentry::searchkampung.tab3.viewkemudahan', compact('kemudahan', 'tabmain', 'tabdetail', 'id', 'iddetail', 'catkemudahan', 'data_kemudahan', 'unit', 'jeniskemudahan'));
        }
    }

    public function jeniskemudahan($catid)
    {
        $jeniskemudahan = LkpDetail::where('category_detail', $catid)->get();

        return view('dataentry::searchkampung.tab3.jeniskemudahan', compact('jeniskemudahan'));
    }

    public function savekemudahan(Request $request)
    {
        $savekemudahan = $this->repos->savekemudahan($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/3/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function editkemudahan(Request $request)
    {
        $savekemudahan = $this->repos->editkemudahan($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/3/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function deletekemudahan($deletekemudahan, $idkampung)
    {
        $deletekemudahan = ProfilKemudahan::find($deletekemudahan);
        $deletekemudahan->delete();

        return redirect::to('/dataentry/searchkampung/editkampung/'.$idkampung.'/3/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function pencapaian($id, $tabmain, $tabdetail, $iddetail)
    {
        $tabmain = $tabmain;
        $tabdetail = $tabdetail;
        $id = $id;
        $iddetail = $iddetail;
        $peringkat = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 18)->get();

        $pencapaian = ProfilPencapaian::with('kampung', 'peringkat')
                        ->where('fk_kampung', $id)->get();

        $data_pencapaian = ProfilPencapaian::with('kampung', 'peringkat')
                             ->where('id', $iddetail)->first();

        if ($tabdetail == 1) {
            return view('dataentry::searchkampung.tab4.listpencapaian', compact('pencapaian', 'tabmain', 'tabdetail', 'id', 'iddetail'));
        } elseif ($tabdetail == 2) {
            return view('dataentry::searchkampung.tab4.addpencapaian', compact('pencapaian', 'tabmain', 'tabdetail', 'id', 'iddetail', 'peringkat'));
        } elseif ($tabdetail == 3) {
            return view('dataentry::searchkampung.tab4.editpencapaian', compact('pencapaian', 'tabmain', 'tabdetail', 'id', 'iddetail', 'peringkat', 'data_pencapaian'));
        } else {//edit

            $iddetail = $iddetail;

            return view('dataentry::searchkampung.tab4.viewpencapaian', compact('pencapaian', 'tabmain', 'tabdetail', 'id', 'iddetail', 'peringkat', 'data_pencapaian'));
        }
    }

    public function savepencapaian(Request $request)
    {
        $savepencapaian = $this->repos->savepencapaian($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/4/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function editpencapaian(Request $request)
    {
        $editpencapaian = $this->repos->editpencapaian($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/4/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function deletepencapaian($deletepencapaian, $idkampung)
    {
        $deletepencapaian = ProfilPencapaian::find($deletepencapaian);
        $deletepencapaian->delete();

        return redirect::to('/dataentry/searchkampung/editkampung/'.$idkampung.'/4/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function aktiviti($id, $tabmain, $tabdetail, $iddetail)
    {
        $tabmain = $tabmain;
        $tabdetail = $tabdetail;
        $id = $id;
        $iddetail = $iddetail;
        $peringkat = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 18)->get();
        $kategori = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 6)->get();

        $aktiviti = ProfilAktiviti::with('kampung', 'peringkat', 'kategori')
                        ->where('fk_kampung', $id)->get();

        $data_aktiviti = ProfilAktiviti::with('kampung', 'peringkat', 'kategori')->where('id', $iddetail)->first();

        if ($tabdetail == 1) {
            return view('dataentry::searchkampung.tab5.listaktiviti', compact('aktiviti', 'tabmain', 'tabdetail', 'id', 'iddetail', 'kategori'));
        } elseif ($tabdetail == 2) {
            return view('dataentry::searchkampung.tab5.addaktiviti', compact('aktiviti', 'tabmain', 'tabdetail', 'id', 'iddetail', 'peringkat', 'kategori'));
        } elseif ($tabdetail == 3) {
            return view('dataentry::searchkampung.tab5.editaktiviti', compact('aktiviti', 'tabmain', 'tabdetail', 'id', 'iddetail', 'peringkat', 'data_aktiviti', 'kategori'));
        } else {//edit

            $iddetail = $iddetail;

            return view('dataentry::searchkampung.tab5.viewaktiviti', compact('aktiviti', 'tabmain', 'tabdetail', 'id', 'iddetail', 'peringkat', 'data_aktiviti', 'kategori'));
        }
    }

    public function saveaktiviti(Request $request)
    {
        $saveaktiviti = $this->repos->saveaktiviti($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/5/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function editaktiviti(Request $request)
    {
        $editaktiviti = $this->repos->editaktiviti($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/5/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function deleteaktiviti($deleteaktiviti, $idkampung)
    {
        $deleteaktiviti = ProfilAktiviti::find($deleteaktiviti);
        $deleteaktiviti->delete();

        return redirect::to('/dataentry/searchkampung/editkampung/'.$idkampung.'/5/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function produk($id, $tabmain, $tabdetail, $iddetail)
    {
        $tabmain = $tabmain;
        $tabdetail = $tabdetail;
        $id = $id;
        $iddetail = $iddetail; //if tabmain==5 & tabmain==4 iddetail=idpengeluar else iddetail=idproduk

        $mediasosial = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 9)->get();

        $pengeluar = ProfilPengeluar::with('kampung', 'mediasosial')
                        ->where('fk_kampung', $id)->get();

        $data_pengeluar = ProfilPengeluar::with('kampung', 'mediasosial')
                             ->where('id', $iddetail)->first();

        $produk = ProfilProduk::with('kampung', 'pengeluar', 'kategori', 'jenisproduk')
                        ->where('fk_kampung', $id)->where('fk_pengeluar', $iddetail)->get();

        $data_produk = ProfilProduk::with('kampung', 'pengeluar', 'kategori', 'jenisproduk')
                        ->where('id', $iddetail)->first();
        $catproduk = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 7)->get();
        $jenisproduk = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 8)->get();

        if ($tabdetail == 1) {
            return view('dataentry::searchkampung.tab6.listpengeluar', compact('pengeluar', 'tabmain', 'tabdetail', 'id', 'iddetail'));
        } elseif ($tabdetail == 2) {
            return view('dataentry::searchkampung.tab6.addpengeluar', compact('tabmain', 'tabdetail', 'id', 'iddetail', 'mediasosial'));
        } elseif ($tabdetail == 3) {
            return view('dataentry::searchkampung.tab6.editpengeluar', compact('pengeluar', 'tabmain', 'tabdetail', 'id', 'iddetail', 'mediasosial', 'data_pengeluar'));
        } elseif ($tabdetail == 5) {
            return view('dataentry::searchkampung.tab6.listproduk', compact('produk', 'tabmain', 'tabdetail', 'id', 'iddetail', 'data_pengeluar'));
        } elseif ($tabdetail == 8) {
            $data_pengeluar2 = ProfilPengeluar::with('kampung', 'mediasosial')
                             ->where('id', data_get($data_produk, 'fk_pengeluar'))->first();

            return view('dataentry::searchkampung.tab6.editproduk', compact('data_produk', 'tabmain', 'tabdetail', 'id', 'iddetail', 'catproduk', 'data_pengeluar2', 'jenisproduk'));
        } elseif ($tabdetail == 7) {
            $data_pengeluar2 = ProfilPengeluar::with('kampung', 'mediasosial')
                             ->where('id', data_get($data_produk, 'fk_pengeluar'))->first();

            return view('dataentry::searchkampung.tab6.viewproduk', compact('data_produk', 'tabmain', 'tabdetail', 'id', 'iddetail', 'catproduk', 'data_pengeluar2', 'jenisproduk'));
        } elseif ($tabdetail == 6) {
            return view('dataentry::searchkampung.tab6.addproduk', compact('data_pengeluar', 'tabmain', 'tabdetail', 'id', 'iddetail', 'catproduk'));
        } else {//edit

            $iddetail = $iddetail;

            return view('dataentry::searchkampung.tab6.viewpengeluar', compact('pengeluar', 'tabmain', 'tabdetail', 'id', 'iddetail', 'mediasosial', 'data_pengeluar'));
        }
    }

    public function savepengeluar(Request $request)
    {
        $savepengeluar = $this->repos->savepengeluar($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/6/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function editpengeluar(Request $request)
    {
        $editpengeluar = $this->repos->editpengeluar($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/6/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function deletepengeluar($deletepengeluar, $idkampung)
    {
        $delete_produk = ProfilProduk::where('fk_pengeluar', $deletepengeluar);
        $delete_produk->delete();

        $deletepengeluar = ProfilPengeluar::find($deletepengeluar);
        $deletepengeluar->delete();

        return redirect::to('/dataentry/searchkampung/editkampung/'.$idkampung.'/6/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function jenisproduk($catid)
    {
        $jenisproduk = LkpDetail::where('category_detail', $catid)->get();

        return view('dataentry::searchkampung.tab6.jenisproduk', compact('jenisproduk'));
    }

    public function saveproduk(Request $request)
    {
        $saveproduk = $this->repos->saveproduk($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/6/5/'.$request->iddetail)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function editproduk(Request $request)
    {
        $editproduk = $this->repos->editproduk($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/6/5/'.$request->pengeluar)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function deleteproduk($deleteproduk, $idkampung, $idpengeluar)
    {
        $deleteproduk = ProfilProduk::find($deleteproduk);
        $deleteproduk->delete();

        return redirect::to('/dataentry/searchkampung/editkampung/'.$idkampung.'/6/5/'.$idpengeluar)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function projek($id, $tabmain, $tabdetail, $iddetail)
    {
        $tabmain = $tabmain;
        $tabdetail = $tabdetail;
        $id = $id;
        $iddetail = $iddetail;
        $jenisprojek = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 25)->get();

        $projek = ProfilProjek::with('kampung', 'jenisprojek')
                                 ->where('fk_kampung', $id)->get();

        $data_projek = ProfilProjek::with('kampung', 'jenisprojek')
                                         ->where('id', $iddetail)->first();

        if ($tabdetail == 1) {
            return view('dataentry::searchkampung.tab7.listprojek', compact('projek', 'tabmain', 'tabdetail', 'id', 'iddetail'));
        } elseif ($tabdetail == 2) {
            return view('dataentry::searchkampung.tab7.addprojek', compact('projek', 'tabmain', 'tabdetail', 'id', 'iddetail', 'jenisprojek'));
        } elseif ($tabdetail == 3) {
            return view('dataentry::searchkampung.tab7.editprojek', compact('projek', 'tabmain', 'tabdetail', 'id', 'iddetail', 'jenisprojek', 'data_projek'));
        } else {//edit

            $iddetail = $iddetail;

            return view('dataentry::searchkampung.tab7.viewprojek', compact('projek', 'tabmain', 'tabdetail', 'id', 'iddetail', 'jenisprojek', 'data_projek'));
        }
    }

    public function saveprojek(Request $request)
    {
        $saveprojek = $this->repos->saveprojek($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/7/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function editprojek(Request $request)
    {
        $editprojek = $this->repos->editprojek($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/7/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function deleteprojek($deleteprojek, $idkampung)
    {
        $deleteprojek = ProfilProjek::find($deleteprojek);
        $deleteprojek->delete();

        return redirect::to('/dataentry/searchkampung/editkampung/'.$idkampung.'/7/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function galeri($id, $tabmain, $tabdetail, $iddetail)
    {
        $tabmain = $tabmain;
        $tabdetail = $tabdetail;
        $id = $id;
        $iddetail = $iddetail;
        //if tabdetail==3 or tabdetail==5 OR tabdetail==4 iddetail=idgaleri_mast else iddetail=idgaleridetail

        $galeri = GaleriMast::selectRaw("id,Tajuk,Keterangan,(SELECT COUNT(id) FROM galeri_detail WHERE fk_galeri_mast=galeri_mast.id and deleted_at is null) AS bil_gambar,CASE
                                        WHEN galeri_mast.status=0 THEN 'Tidak Aktif'
                                        WHEN galeri_mast.status=1 THEN 'Aktif'
                                        ELSE 'Aktif'
                                        END AS STATUS,Gambar_path,filename")
                            ->with('kampung')->where('fk_kampung', $id)->get();

        //$data_galeri = GaleriMast::with('kampung')->where('id',$iddetail)->first();
        $data_galeri = GaleriMast::with('kampung')->where('id', $iddetail)->first();

        $galeri_detail = GaleriDetail::with('galerimast', 'type')->where('fk_galeri_mast', $iddetail)->get();

        $data_galeri_detail = GaleriDetail::with('galerimast', 'type')->where('id', $iddetail)->first();

        $typefile = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 27)->get();

        if ($tabdetail == 1) {
            return view('dataentry::searchkampung.tab8.listgaleri', compact('galeri', 'tabmain', 'tabdetail', 'id', 'iddetail'));
        } elseif ($tabdetail == 2) {
            return view('dataentry::searchkampung.tab8.addgaleri', compact('galeri', 'tabmain', 'tabdetail', 'id', 'iddetail'));
        } elseif ($tabdetail == 3) {
            return view('dataentry::searchkampung.tab8.editgaleri', compact('galeri', 'tabmain', 'tabdetail', 'id', 'iddetail', 'data_galeri'));
        } elseif ($tabdetail == 5) {
            return view('dataentry::searchkampung.tab8.listgaleridetail', compact('galeri_detail', 'tabmain', 'tabdetail', 'id', 'iddetail', 'data_galeri', 'typefile'));
        } else {//view

            $iddetail = $iddetail;

            return view('dataentry::searchkampung.tab8.viewgaleri', compact('galeri', 'tabmain', 'tabdetail', 'id', 'iddetail', 'data_galeri'));
        }
    }

    public function savegaleri(Request $request)
    {
        $savegaleri = $this->repos->savegaleri($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/8/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function editgaleri(Request $request)
    {
        $editgaleri = $this->repos->editgaleri($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/8/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function deletegaleri($deletegaleri, $idkampung)
    {
        $deletegaleri = GaleriMast::find($deletegaleri);
        $deletegaleri->delete();

        return redirect::to('/dataentry/searchkampung/editkampung/'.$idkampung.'/8/1/0')->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function addgaleridetail(Request $request)
    {
        $addgaleridetail = $this->repos->addgaleridetail($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampung.'/8/5/'.$request->idgalerimast)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function deletegaleridetail($deletegaleridetail, $idkampung, $idgaleri)
    {
        $deletegaleridetail = GaleriDetail::find($deletegaleridetail);
        $deletegaleridetail->delete();

        return redirect::to('/dataentry/searchkampung/editkampung/'.$idkampung.'/8/5/'.$idgaleri)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function editgaleridetail(Request $request)
    {
        $editgaleridetail = $this->repos->editgaleridetail($request);

        return redirect::to('/dataentry/searchkampung/editkampung/'.$request->idkampungedit.'/8/5/'.$request->idgalerimastedit)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function cetakprofil($type, $idkampung)
    {
        if ($type == '2') {//excel

            $collectionparam = collect([$type]);

            return Excel::download(new ExportTestController($collectionparam), 'LAPORAN_PEMBAHARUAN_LESEN.xlsx');
        } else {//pdf

            $data = $this->repos->cetakprofil($idkampung);

            $kemudahan = ProfilKemudahan::with('kampung', 'katkemudahan', 'jeniskemudahan', 'unit')
                            ->where('fk_kampung', $idkampung)->get();
            $pencapaian = ProfilPencapaian::with('kampung', 'peringkat')
                            ->where('fk_kampung', $idkampung)->get();
            $aktiviti = ProfilAktiviti::with('kampung', 'peringkat', 'kategori')
                          ->where('fk_kampung', $idkampung)->get();
            $projek = ProfilProjek::with('kampung', 'jenisprojek')
                          ->where('fk_kampung', $idkampung)->get();

            $namapengerusi = ProfilPentadbiran::where('fk_kampung', $idkampung)
                        ->where('jawatan', '141')->orderBy('Sesi', 'desc')->where('status', 1)->first();

            $kampung = Kampung::find($idkampung);

            $penghulumukim = Mukim::find(data_get($kampung, 'fk_mukim'));
            $pegawaidaerah = Daerah::find(data_get($kampung, 'fk_daerah'));
            $jantina = Isirumah::selectRaw('lkp_detail.description as label,count(isirumah.id) as value')
                          ->join('pemilikanrumah', 'pemilikanrumah.id', '=', 'isirumah.fk_rumah')
                          ->join('kampung', 'kampung.id', '=', 'pemilikanrumah.fk_kampung')
                          ->join('lkp_detail', 'lkp_detail.id', '=', 'isirumah.Jantina')
                          ->where('kampung.id', $idkampung)
                          ->groupBy('lkp_detail.description')->get();

            $bangsa = DB::select("SELECT
                      CASE
                        WHEN a.bil IS NULL THEN '0'
                        ELSE a.bil
                        END AS bil,
                      lkp_detail.id,
                         case
                         when lkp_detail.description='MELAYU' then 'A'
                         when lkp_detail.description='CINA' then 'B'
                          when lkp_detail.description='INDIA' then 'C'
                           when lkp_detail.description='LAIN-LAIN' then 'D'
                        ELSE 'E'
                        END AS rownum,
                      lkp_detail.description
                    FROM
                      (
                        lkp_detail
                        left JOIN
                          (SELECT
                            COUNT(isirumah.id) AS bil,
                            isirumah.Bangsa as bangsa
                          FROM
                           isirumah
                           join
                            pemilikanrumah
                            on
                            isirumah.fk_rumah=pemilikanrumah.id
                            join
                            kampung
                            on kampung.id=pemilikanrumah.fk_kampung
                            join
                            lkp_detail
                            on
                            lkp_detail.id=isirumah.Bangsa
                          WHERE (
                              kampung.status=1
                              and
                              kampung.deleted_at is null
                             and kampung.id =".$idkampung.'
                            )
                          GROUP BY isirumah.Bangsa) a
                          ON (
                            (
                              lkp_detail.id = a.bangsa


                            )
                          )
                      )where lkp_detail.fk_lkp_master=20
                    ORDER BY rownum asc');

            $data = [

                'data' => $data,
                'kemudahan'=>$kemudahan,
                'pencapaian'=>$pencapaian,
                'aktiviti'=>$aktiviti,
                'projek'=>$projek,
                'title'=>'Profil Pentadbiran',
                'namapengerusi'=>$namapengerusi,
                'penghulumukim'=>$penghulumukim,
                'pegawaidaerah'=>$pegawaidaerah,
                'jantina'=>$jantina,
                'bangsa'=>$bangsa,

            ];

            $pdf = PDF::loadView('dataentry::searchkampung.cetakan.pdf.cetakanprofil', $data);

            // $pdf->setPaper('A4', 'landscape');
            return $pdf->download('cetakan_profil.pdf');
            // return $pdf->stream('cetakan_profil.pdf');
        }
    }

    public function cetakkir($type, $idkampung, $idrumah)
    {
        $idkampung = $idkampung;
        $idrumah = $idrumah;

        if ($type == '2') {//excel

            $collectionparam = collect([$type]);

            return Excel::download(new ExportTestController($collectionparam), 'LAPORAN_PEMBAHARUAN_LESEN.xlsx');
        } else {//pdf

            $data = $this->repos->cetakKIR($idrumah, $idkampung);
            $namakamapung = Kampung::find($idkampung);

            $data = [

                'data' => $data,
                'namakmapung'=>  data_get($namakamapung, 'NamaKampung'),

                'title'=>'MAKLUMAT KETUA ISI RUMAH & AHLI ISI RUMAH',

            ];

            $pdf = PDF::loadView('dataentry::isirumah.cetakan.pdf.cetakanKIR', $data);

            $pdf->setPaper('A4', 'landscape');

            return $pdf->download('cetakan_KIR.pdf');
            //return $pdf->stream('cetakan_KIR.pdf');
        }
    }

    public function cetakkirAll($type, $idkampung)
    {
        $idkampung = $idkampung;

        if ($type == '2') {//excel

            $collectionparam = collect([$type]);

            return Excel::download(new ExportTestController($collectionparam), 'LAPORAN_PEMBAHARUAN_LESEN.xlsx');
        } else {//pdf

            $data = $this->repos->cetakkirAll($idkampung);
            $namakamapung = Kampung::find($idkampung);

            $data = [
                'data' => $data,
                'namakmapung'=> data_get($namakamapung, 'NamaKampung'),
                'title'=>'MAKLUMAT KETUA ISI RUMAH & AHLI ISI RUMAH',
            ];

            $pdf = PDF::loadView('dataentry::isirumah.cetakan.pdf.cetakanKIR', $data);

            $pdf->setPaper('A4', 'landscape');

            return $pdf->download('cetakan_KIR.pdf');
        }
    }

    public function ketuaisirumah($idkampung)
    {
        $idkampung = $idkampung;

        $ketuaisirumah = Isirumah::whereHas('rumah', function ($query) use ($idkampung) {
            return $query->where('fk_kampung', '=', $idkampung);
        })->where('flag_ketua_rumah', 1)->orderBy('fk_rumah', 'asc')->get();

        $kamusdata = LkpDetail::with('lkpmaster')->get();
        $infokampung = Kampung::find($idkampung);

        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        return view('dataentry::isirumah.ketuaisirumah.listketuaisirumah', compact('idkampung', 'ketuaisirumah', 'kamusdata', 'infokampung', 'roleuser'));
    }

    public function addketua($idkampung)
    {
        $idkampung = $idkampung;
        $infokampung = Kampung::find($idkampung);
        $jantina = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 19)->get();
        $warga = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 17)->get();
        $bangsa = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 20)->get();
        $agama = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 21)->get();
        $taraf = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 23)->get();
        $statuskerja = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 22)->get();
        $bantuanbulanan = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 24)->get();
        $statusmilik = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 10)->get();
        $jenisrumah = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 11)->get();
        $binaanrumah = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 12)->get();
        $biltingkat = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 13)->get();
        $bilbilik = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 14)->get();
        $jenispengenalan = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 29)->get();
        $Status = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 32)->get();

        return view('dataentry::isirumah.ketuaisirumah.addketuaisirumah', compact('idkampung', 'jantina', 'warga', 'bangsa', 'agama', 'taraf', 'statuskerja', 'bantuanbulanan', 'statusmilik', 'jenisrumah', 'binaanrumah', 'biltingkat', 'bilbilik', 'jenispengenalan', 'Status', 'infokampung'));
    }

    public function saveketuarumah(Request $request)
    {
        $saveketuarumah = $this->repos->saveketuarumah($request);

        return redirect::to('/dataentry/searchkampung/isirumah/ketuaisirumah/'.$request->idkampung)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function editketua($idisirumah, $idkampung)
    {
        $idisirumah = $idisirumah;
        $idkampung = $idkampung;
        $ketuaisirumah = Isirumah::with('rumah')->where('id', $idisirumah)->first();
        $infokampung = Kampung::find($idkampung);

        $jantina = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 19)->get();
        $warga = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 17)->get();
        $bangsa = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 20)->get();
        $agama = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 21)->get();
        $taraf = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 23)->get();
        $statuskerja = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 22)->get();
        $bantuanbulanan = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 24)->get();
        $statusmilik = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 10)->get();
        $jenisrumah = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 11)->get();
        $binaanrumah = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 12)->get();
        $biltingkat = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 13)->get();
        $bilbilik = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 14)->get();
        $jenispengenalan = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 29)->get();
        $Status = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 32)->get();

        $filexists = file_exists(public_path(data_get($ketuaisirumah, 'rumah.Gambar_path')));

        return view('dataentry::isirumah.ketuaisirumah.editketuaisirumah', compact('idisirumah',
            'ketuaisirumah', 'jantina', 'warga', 'bangsa', 'agama', 'taraf', 'statuskerja', 'bantuanbulanan', 'statusmilik', 'jenisrumah', 'binaanrumah', 'biltingkat', 'bilbilik', 'idkampung', 'jenispengenalan', 'Status', 'filexists', 'infokampung'));
    }

    public function editketuarumah(Request $request)
    {
        $editketuarumah = $this->repos->editketuarumah($request);

        return redirect::to('/dataentry/searchkampung/isirumah/ketuaisirumah/'.$request->idkampung)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function viewketua($idisirumah, $idkampung)
    {
        $idisirumah = $idisirumah;
        $idkampung = $idkampung;
        $infokampung = Kampung::find($idkampung);
        $ketuaisirumah = Isirumah::with('rumah')->where('id', $idisirumah)->first();

        $jantina = LkpDetail::find(data_get($ketuaisirumah, 'Jantina'));
        $warga = LkpDetail::find(data_get($ketuaisirumah, 'Warganegara'));
        $bangsa = LkpDetail::find(data_get($ketuaisirumah, 'Bangsa'));
        $agama = LkpDetail::find(data_get($ketuaisirumah, 'Agama'));
        $taraf = LkpDetail::find(data_get($ketuaisirumah, 'TarafKahwin'));
        $statuskerja = LkpDetail::find(data_get($ketuaisirumah, 'StatusPekerjaan'));
        $bantuanbulanan = LkpDetail::find(data_get($ketuaisirumah, 'PenerimaBantuan'));
        $statusmilik = LkpDetail::find(data_get($ketuaisirumah, 'rumah.StatusMilikan'));
        $jenisrumah = LkpDetail::find(data_get($ketuaisirumah, 'rumah.JenisRumah'));
        $binaanrumah = LkpDetail::find(data_get($ketuaisirumah, 'rumah.JenisBinaan'));
        $biltingkat = LkpDetail::find(data_get($ketuaisirumah, 'rumah.BilTingkat'));
        $bilbilik = LkpDetail::find(data_get($ketuaisirumah, 'rumah.BilBilik'));
        $jenispengenalan = LkpDetail::find(data_get($ketuaisirumah, 'JenisPengenalan'));
        $Status = LkpDetail::find(data_get($ketuaisirumah, 'Status'));

        return view('dataentry::isirumah.ketuaisirumah.viewketuaisirumah', compact('idisirumah',
            'ketuaisirumah', 'jantina', 'warga', 'bangsa', 'agama', 'taraf', 'statuskerja', 'bantuanbulanan', 'statusmilik', 'jenisrumah', 'binaanrumah', 'biltingkat', 'bilbilik', 'idkampung', 'jenispengenalan', 'Status', 'infokampung'));
    }

    public function ahliisirumah($idkampung, $idrumah)
    {
        $idkampung = $idkampung;
        $idrumah = $idrumah;

        $ahliisirumah = Isirumah::whereHas('rumah', function ($query) use ($idkampung) {
            return $query->where('fk_kampung', '=', $idkampung);
        })->where('flag_ketua_rumah', 0)->where('fk_rumah', $idrumah)->get();
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        //$ketuaisirumah=Pemilikanrumah::with('kampung')->where('fk_kampung',$idkampung)->get();
        $kamusdata = LkpDetail::with('lkpmaster')->get();
        $infokampung = Kampung::find($idkampung);

        return view('dataentry::isirumah.ahliisirumah.listahliisirumah', compact('idkampung', 'ahliisirumah', 'idrumah', 'kamusdata', 'infokampung', 'roleuser', 'infokampung'));
    }

    public function addahli($idkampung, $idrumah)
    {
        $idkampung = $idkampung;
        $idrumah = $idrumah;
        $infokampung = Kampung::find($idkampung);
        $jantina = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 19)->get();
        $warga = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 17)->get();
        $bangsa = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 20)->get();
        $agama = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 21)->get();
        $taraf = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 23)->get();
        $statuskerja = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 22)->get();
        $bantuanbulanan = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 24)->get();

        $jenispengenalan = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 29)->get();

        return view('dataentry::isirumah.ahliisirumah.addahli', compact('idkampung', 'jantina', 'warga', 'bangsa', 'agama', 'taraf', 'statuskerja', 'bantuanbulanan', 'idrumah', 'jenispengenalan', 'infokampung'));
    }

    public function saveahli(Request $request)
    {
        $saveahli = $this->repos->saveahli($request);

        return redirect::to('/dataentry/searchkampung/isirumah/ahliisirumah/'.$request->idkampung.'/'.$request->idrumah)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function editahli($idahli, $idkampung, $idrumah)
    {
        $idahli = $idahli;
        $idkampung = $idkampung;
        $idrumah = $idrumah;
        $infokampung = Kampung::find($idkampung);

        $ahliisirumah = Isirumah::with('rumah')->where('id', $idahli)->first();

        $jantina = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 19)->get();
        $warga = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 17)->get();
        $bangsa = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 20)->get();
        $agama = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 21)->get();
        $taraf = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 23)->get();
        $statuskerja = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 22)->get();
        $bantuanbulanan = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 24)->get();
        $jenispengenalan = LkpDetail::selectRaw('id,description')->where('status', 1)->where('fk_lkp_master', 29)->get();

        return view('dataentry::isirumah.ahliisirumah.editahli', compact('idkampung', 'jantina', 'warga', 'bangsa', 'agama', 'taraf', 'statuskerja', 'bantuanbulanan', 'idrumah', 'idahli', 'ahliisirumah', 'jenispengenalan', 'infokampung'));
    }

    public function editahlirumah(Request $request)
    {
        $editahlirumah = $this->repos->editahlirumah($request);

        return redirect::to('/dataentry/searchkampung/isirumah/ahliisirumah/'.$request->idkampung.'/'.$request->idrumah)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function viewahli($idahli, $idkampung, $idrumah)
    {
        $idahli = $idahli;
        $idkampung = $idkampung;
        $idrumah = $idrumah;
        $infokampung = Kampung::find($idkampung);

        $ahliisirumah = Isirumah::with('rumah')->where('id', $idahli)->first();

        $jantina = LkpDetail::find(data_get($ahliisirumah, 'Jantina'));
        $warga = LkpDetail::find(data_get($ahliisirumah, 'Warganegara'));
        $bangsa = LkpDetail::find(data_get($ahliisirumah, 'Bangsa'));
        $agama = LkpDetail::find(data_get($ahliisirumah, 'Agama'));
        $taraf = LkpDetail::find(data_get($ahliisirumah, 'TarafKahwin'));
        $statuskerja = LkpDetail::find(data_get($ahliisirumah, 'StatusPekerjaan'));
        $bantuanbulanan = LkpDetail::find(data_get($ahliisirumah, 'PenerimaBantuan'));
        $jenispengenalan = LkpDetail::find(data_get($ahliisirumah, 'JenisPengenalan'));

        return view('dataentry::isirumah.ahliisirumah.viewahli', compact('idkampung', 'jantina', 'warga', 'bangsa', 'agama', 'taraf', 'statuskerja', 'bantuanbulanan', 'idrumah', 'idahli', 'ahliisirumah', 'jenispengenalan', 'infokampung'));
    }

    public function deleteahli($idahli, $idkampung, $idrumah)
    {
        $deleteahli = Isirumah::find($idahli);
        $deleteahli->delete();
        $idkampung = $idkampung;
        $idrumah = $idrumah;

        return redirect::to('/dataentry/searchkampung/isirumah/ahliisirumah/'.$idkampung.'/'.$idrumah)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function deleteketua($idketua, $idkampung, $idrumah)
    {
        $deleteketua = Isirumah::find($idketua);
        $deleteketua->delete();
        $idkampung = $idkampung;

        $deleteahli = Isirumah::where('fk_rumah', $idrumah)->get();

        foreach ($deleteahli as $key => $value) {
            $searchahli = Isirumah::find($value->id);
            $searchahli->delete();
        }

        return redirect::to('/dataentry/searchkampung/isirumah/ketuaisirumah/'.$idkampung)->withSuccess(__('Data telah berjaya dikemaskini'));
    }

    public function importketuarumah(Request $request)
    {
        $path1 = $request->file('fileimport')->store('temp');
        $path = storage_path('app').'/'.$path1;

        $idkampung = $request->idkampung;

        $data = Excel::import(new KetuaIsiRumahImport($idkampung), $path);

        return back()->withSuccess(__('Data telah berjaya diImport'));
    }

    public function importisirumah(Request $request)
    {

        //$path = $request->file('fileimport')->getRealPath();

        $path1 = $request->file('fileimport')->store('temp');
        $path = storage_path('app').'/'.$path1;

        $idrumah = $request->idrumah;
        // $data = Excel::load($path, function($reader) {})->get();
        $data = Excel::import(new AhliIsiRumahImport($idrumah), $path);

        return back()->withSuccess(__('Data telah berjaya diImport'));
    }

    public function typefile($typeid, $action)
    {
        if ($typeid == 146) {//video

            if ($action == 'add') {
                return view('dataentry::searchkampung.tab8.url');
            } else {
                return view('dataentry::searchkampung.tab8.urledit');
            }
        } else {
            if ($action == 'edit') {
                return view('dataentry::searchkampung.tab8.gambar');
            } else {
                return view('dataentry::searchkampung.tab8.gambar_add');
            }
        }
    }

    public function deletekampung($idkampung)
    {
        $searchpemilikanrumah = Pemilikanrumah::where('fk_kampung', $idkampung)->get();

        foreach ($searchpemilikanrumah as $key => $value) {
            $searchisirumah = Isirumah::where('fk_rumah', data_get($value, 'id'))->get();

            foreach ($searchisirumah as $key2 => $value2) {
                $deleteisirumah = Isirumah::find(data_get($value2, 'id'));
                $deleteisirumah->delete();
                // code...
            }

            $deletepemilikan = Pemilikanrumah::find(data_get($value, 'id'));
            $deletepemilikan->delete();
        }

        $deletekampung = Kampung::find($idkampung);
        $deletekampung->delete();

        return redirect::to('/dataentry/searchkampung/index')->withSuccess(__('Data telah berjaya dipadam'));
    }

    public function gambaredit($id)
    {
        $data_galeri = GaleriDetail::find($id);

        return view('dataentry::searchkampung.tab8.gambaredit', compact('data_galeri'));
    }
}
