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
use PDF;
use Workbench\Site\Model\Lookup\Parlimen;
use Workbench\Site\Model\Lookup\Dun;
use Workbench\Site\Model\Lookup\Daerah;
use Workbench\Site\Model\Lookup\Mukim;
use Workbench\Site\Model\Lookup\Kampung;
use Workbench\Site\Model\Lookup\LkpMaster;
use Workbench\Site\Model\Lookup\LkpDetail;
use Workbench\Site\Model\Lookup\Users;
use Workbench\Site\Model\Lookup\Pemilikanrumah;
use Workbench\Site\Model\Lookup\ProfilKemudahan;
use Workbench\Site\Model\Lookup\VwKemudahanDetail;
use Workbench\Site\Model\Lookup\Isirumah;
use Workbench\Site\Model\Lookup\AclRoleUser;
use Workbench\Site\Model\Lookup\VwKatPendapatan;
use Workbench\Site\Model\Lookup\VwKerja;
use Workbench\Site\Model\Lookup\VwPendapatanPenduduk;
use Workbench\Site\Model\Lookup\VwKahwinDetail;
use Workbench\Site\Model\Lookup\VwKemudahanAwamDetail;
use Workbench\Site\Model\Lookup\VwJenisRumahDetail;
use Workbench\Site\Model\Lookup\VwStatusMilikanDetail;
use Workbench\Site\Model\Lookup\VwKemudahanAsas;
use Workbench\Site\Model\Lookup\VwKemudahanAsasDetail;
use Workbench\Site\Model\Lookup\VwAgeDetail;



use Workbench\Dashboard\Data\Repo\DashboardRepo;


class DashboardController extends Controller
{


    public function __construct(DashboardRepo $repos)
    {

      $this->repos = $repos;

    }


    public function indexadmin()
    {


      $parlimen  = Parlimen::where('status',1)->get();
      $dun  = Dun::where('status',1)->get();
      // $daerah  = Daerah::where('status',1)->get();
      // $mukim=Mukim::where('status',1)->get();


      $user = auth()->user();
      $roleuser=AclRoleUser::with('acl_roles')->where('user_id',data_get($user,'id'))->first();

      if(data_get($roleuser,'role_id') ==2 || data_get($roleuser,'role_id')==3){

      $daerahuser=data_get($user,'Daerah');
      $daerah  = Daerah::find($daerahuser);
      $mukimuser=data_get($user,'Mukim');
      $mukim  = Mukim::find($mukimuser);

      }else{
        $daerah  = Daerah::where('status',1)->get();
        $mukim=Mukim::where('status',1)->get();
        $daerahuser='';
        $mukimuser='';

      }

      $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();
      return view('dashboard::admin.index',compact('parlimen','dun','daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));

    }
    public function indexadmin2()
    {


      $parlimen  = Parlimen::where('status',1)->get();
      $dun  = Dun::where('status',1)->get();
      // $daerah  = Daerah::where('status',1)->get();
      // $mukim=Mukim::where('status',1)->get();


      $user = auth()->user();
      $roleuser=AclRoleUser::with('acl_roles')->where('user_id',data_get($user,'id'))->first();

      if(data_get($roleuser,'role_id') ==2 || data_get($roleuser,'role_id')==3){

      $daerahuser=data_get($user,'Daerah');
      $daerah  = Daerah::find($daerahuser);
      $mukimuser=data_get($user,'Mukim');
      $mukim  = Mukim::find($mukimuser);

      }else{
        $daerah  = Daerah::where('status',1)->get();
        $mukim=Mukim::where('status',1)->get();
        $daerahuser='';
        $mukimuser='';

      }

      $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();
      return view('dashboard::admin.index_2',compact('parlimen','dun','daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));

    }
    public function indexadmin3()
    {


      $parlimen  = Parlimen::where('status',1)->get();
      $dun  = Dun::where('status',1)->get();
      // $daerah  = Daerah::where('status',1)->get();
      // $mukim=Mukim::where('status',1)->get();


      $user = auth()->user();
      $roleuser=AclRoleUser::with('acl_roles')->where('user_id',data_get($user,'id'))->first();

      if(data_get($roleuser,'role_id') ==2 || data_get($roleuser,'role_id')==3){

      $daerahuser=data_get($user,'Daerah');
      $daerah  = Daerah::find($daerahuser);
      $mukimuser=data_get($user,'Mukim');
      $mukim  = Mukim::find($mukimuser);

      }else{
        $daerah  = Daerah::where('status',1)->get();
        $mukim=Mukim::where('status',1)->get();
        $daerahuser='';
        $mukimuser='';

      }

      $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();
      return view('dashboard::admin.index_3',compact('parlimen','dun','daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));

    }

    public function admindaerah(Request $request)
    {
        $user = auth()->user();
        $roleuser=AclRoleUser::where('user_id',data_get($user,'id'))->first();

        $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();

        $daerahuser=data_get($user,'Daerah');
        $daerah  = Daerah::find($daerahuser);
        $mukimuser=data_get($user,'Mukim');
        $mukim  = Mukim::find($mukimuser);

        return view('dashboard::admindaerah.index_dashboard', compact('roleuser', 'catpenempatan', 'daerahuser', 'daerah', 'mukimuser', 'request'));
    }

    public function admindaerahlocation()
    {
        $user = auth()->user();
        $roleuser=AclRoleUser::where('user_id',data_get($user,'id'))->first();

        $daerahuser=data_get($user,'Daerah');
        $daerah  = Daerah::find($daerahuser);

        return view('dashboard::admindaerah.index_location', compact('daerah'));
    }

    public function showcardstatdo()
    {
        // $parlimen  = Parlimen::where('status',1)->get();
        // $dun  = Dun::where('status',1)->get();
        //get user login
        $user = auth()->user();
        $roleuser=AclRoleUser::where('user_id',data_get($user,'id'))->first();

        // $daerahuser=data_get($user,'Daerah');
        // $daerah  = Daerah::find($daerahuser);
        // $mukim=Mukim::where('status',1)->get();
        $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();

        if(data_get($roleuser,'role_id') ==2 || data_get($roleuser,'role_id')==3)
        {
            $daerahuser=data_get($user,'Daerah');
            $daerah  = Daerah::find($daerahuser);
            $mukimuser=data_get($user,'Mukim');
            $mukim  = Mukim::find($mukimuser);
        }
        else
        {
            $daerah  = Daerah::where('status',1)->get();
            $mukim=Mukim::where('status',1)->get();
            $daerahuser='';
            $mukimuser='';
        }

        // return view('dashboard::admindaerah.index',compact('daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));
        return view('dashboard::admindaerah.ajax.statistic',compact('daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));
    }
     public function penghulumukim()
    {

       $user = auth()->user();
       // $daerahuser=data_get($user,'Daerah');
       // $mukimuser=data_get($user,'Mukim');
       // $daerah  = Daerah::find($daerahuser);
       // $mukim=Mukim::find($mukimuser);
       $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();

      $user = auth()->user();
      $roleuser=AclRoleUser::with('acl_roles')->where('user_id',data_get($user,'id'))->first();

      if(data_get($roleuser,'role_id') ==2 || data_get($roleuser,'role_id')==3){

      $daerahuser=data_get($user,'Daerah');
      $daerah  = Daerah::find($daerahuser);
      $mukimuser=data_get($user,'Mukim');
      $mukim  = Mukim::find($mukimuser);

      }else{
        $daerah  = Daerah::where('status',1)->get();
        $mukim=Mukim::where('status',1)->get();
        $daerahuser='';
        $mukimuser='';

      }


      return view('dashboard::penghulumukim.index',compact('daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));

    }
    public function dataentry()
    {
      return view('dashboard::dataentry.index');

    }
    // public function topmanage()
    // {

    //   $parlimen  = Parlimen::where('status',1)->get();
    //   $dun  = Dun::where('status',1)->get();
     
    //   $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();

    //   $user = auth()->user();
    //   $roleuser=AclRoleUser::where('user_id',data_get($user,'id'))->first();

    //   if(data_get($roleuser,'role_id') ==2 || data_get($roleuser,'role_id')==3){

    //   $daerahuser=data_get($user,'Daerah');
    //   $daerah  = Daerah::find($daerahuser);
    //   $mukimuser=data_get($user,'Mukim');
    //   $mukim  = Mukim::find($mukimuser);

    //   }else{
    //     $daerah  = Daerah::where('status',1)->get();
    //     $mukim=Mukim::where('status',1)->get();
    //     $daerahuser='';
    //     $mukimuser='';

    //   }
    //   return view('dashboard::topmng.index_1',compact('parlimen','dun','daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));


    // }
    public function topmanage($type)
    {

     // $test=DB::select("exec sp_summary_kerja");

      //dd($test);
      $type=$type;
      

      return view('dashboard::topmng.index_2',compact('type'));


    }
    public function topmanagelocation()
    {
        $user = auth()->user();
        $roleuser=AclRoleUser::where('user_id',data_get($user,'id'))->first();

        $daerahuser=data_get($user,'Daerah');
        $daerah  = Daerah::find($daerahuser);

        return view('dashboard::topmng.index_location', compact('daerah'));
    }

    public function showcarian(){

      $parlimen  = Parlimen::where('status',1)->get();
      $dun  = Dun::where('status',1)->get();
      
      
      $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();

      $user = auth()->user();
      $roleuser=AclRoleUser::where('user_id',data_get($user,'id'))->first();

      if(data_get($roleuser,'role_id') ==2 || data_get($roleuser,'role_id')==3){

      $daerahuser=data_get($user,'Daerah');
      $daerah  = Daerah::find($daerahuser);
      $mukimuser=data_get($user,'Mukim');
      $mukim  = Mukim::find($mukimuser);

      }else{
        $daerah  = Daerah::where('status',1)->get();
        $mukim=Mukim::where('status',1)->get();
        $daerahuser='';
        $mukimuser='';

      }
      
      return view('dashboard::topmng.searchkampung.index',compact('parlimen','dun','daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));
     //return view('dashboard::dashboard.index');



    }
     public function ketuaisirumah($idkampung){

            $idkampung=$idkampung;
            // $ketuaisirumah=Isirumah::with('rumah')->where('rumah.fk_kampung',$idkampung)->get();

             $ketuaisirumah=Isirumah::whereHas('rumah', function ($query)use($idkampung) {
                            return $query->where('fk_kampung', '=', $idkampung);
                        })->where('flag_ketua_rumah',1)->orderBy('fk_rumah','asc')->get();

     
            //$ketuaisirumah=Pemilikanrumah::with('kampung')->where('fk_kampung',$idkampung)->get();

             $kamusdata=LkpDetail::with('lkpmaster')->get();
             $infokampung=Kampung::find($idkampung);

             $user = auth()->user();
             $roleuser=AclRoleUser::where('user_id',data_get($user,'id'))->first();
             



             return view('dashboard::topmng.searchkampung.isirumah.listketuaisirumah',compact('idkampung','ketuaisirumah','kamusdata','infokampung','roleuser'));

    }
        public function viewketua($idisirumah,$idkampung){

            $idisirumah=$idisirumah;
            $idkampung=$idkampung;
            $infokampung=Kampung::find($idkampung);
            $ketuaisirumah=Isirumah::with('rumah')->where('id',$idisirumah)->first();

            $jantina=LkpDetail::find(data_get($ketuaisirumah,'Jantina'));
            $warga=LkpDetail::find(data_get($ketuaisirumah,'Warganegara'));
            $bangsa=LkpDetail::find(data_get($ketuaisirumah,'Bangsa'));
            $agama=LkpDetail::find(data_get($ketuaisirumah,'Agama'));
            $taraf=LkpDetail::find(data_get($ketuaisirumah,'TarafKahwin'));
            $statuskerja=LkpDetail::find(data_get($ketuaisirumah,'StatusPekerjaan'));
            $bantuanbulanan=LkpDetail::find(data_get($ketuaisirumah,'PenerimaBantuan'));
            $statusmilik=LkpDetail::find(data_get($ketuaisirumah,'rumah.StatusMilikan'));
            $jenisrumah=LkpDetail::find(data_get($ketuaisirumah,'rumah.JenisRumah'));
            $binaanrumah=LkpDetail::find(data_get($ketuaisirumah,'rumah.JenisBinaan'));
            $biltingkat=LkpDetail::find(data_get($ketuaisirumah,'rumah.BilTingkat'));
            $bilbilik=LkpDetail::find(data_get($ketuaisirumah,'rumah.BilBilik'));
            $jenispengenalan=LkpDetail::find(data_get($ketuaisirumah,'JenisPengenalan'));;

             // $ketuaisirumah=Isirumah::whereHas('rumah', function ($query)use($idkampung) {
             //                return $query->where('fk_kampung', '=', $idkampung);
             //            })->get();

     
            //$ketuaisirumah=Pemilikanrumah::with('kampung')->where('fk_kampung',$idkampung)->get();

             return view('dashboard::topmng.searchkampung.isirumah.viewketuaisirumah',compact('idisirumah',
                'ketuaisirumah','jantina','warga','bangsa','agama','taraf','statuskerja','bantuanbulanan','statusmilik','jenisrumah','binaanrumah','biltingkat','bilbilik','idkampung','jenispengenalan','infokampung'));

    }
        public function ahliisirumah($idkampung,$idrumah)
    {

            $idkampung=$idkampung;
            $idrumah=$idrumah;
            
            // $ketuaisirumah=Isirumah::with('rumah')->where('rumah.fk_kampung',$idkampung)->get();

             $ahliisirumah=Isirumah::whereHas('rumah', function ($query)use($idkampung) {
                            return $query->where('fk_kampung', '=', $idkampung);
                        })->where('flag_ketua_rumah',0)->where('fk_rumah',$idrumah)->get();
             $user = auth()->user();
             $roleuser=AclRoleUser::where('user_id',data_get($user,'id'))->first();
            
            //$ketuaisirumah=Pemilikanrumah::with('kampung')->where('fk_kampung',$idkampung)->get();
             $kamusdata=LkpDetail::with('lkpmaster')->get();
              $infokampung=Kampung::find($idkampung);
             return view('dashboard::topmng.searchkampung.isirumah.listahliisirumah',compact('idkampung','ahliisirumah','idrumah','kamusdata','infokampung','roleuser','infokampung'));

    }
     public function viewahli($idahli,$idkampung,$idrumah)
     {

            $idahli=$idahli;
            $idkampung=$idkampung;
            $idrumah=$idrumah;
            $infokampung=Kampung::find($idkampung);

             $ahliisirumah=Isirumah::with('rumah')->where('id',$idahli)->first();

            $jantina=LkpDetail::find(data_get($ahliisirumah,'Jantina'));
            $warga=LkpDetail::find(data_get($ahliisirumah,'Warganegara'));
            $bangsa=LkpDetail::find(data_get($ahliisirumah,'Bangsa'));
            $agama=LkpDetail::find(data_get($ahliisirumah,'Agama'));
            $taraf=LkpDetail::find(data_get($ahliisirumah,'TarafKahwin'));
            $statuskerja=LkpDetail::find(data_get($ahliisirumah,'StatusPekerjaan'));
            $bantuanbulanan=LkpDetail::find(data_get($ahliisirumah,'PenerimaBantuan'));
            $jenispengenalan=LkpDetail::find(data_get($ahliisirumah,'JenisPengenalan'));
           
         return view('dashboard::topmng.searchkampung.isirumah.viewahli',compact('idkampung','jantina','warga','bangsa','agama','taraf','statuskerja','bantuanbulanan','idrumah','idahli','ahliisirumah','jenispengenalan','infokampung'));

    }

    public function showcardstat()
    {
        $parlimen  = Parlimen::where('status',1)->get();
        $dun  = Dun::where('status',1)->get();
        $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();

        $user = auth()->user();
        $roleuser=AclRoleUser::where('user_id',data_get($user,'id'))->first();

        if(data_get($roleuser,'role_id') ==2 || data_get($roleuser,'role_id')==3)
        {
            $daerahuser=data_get($user,'Daerah');
            $daerah  = Daerah::find($daerahuser);
            $mukimuser=data_get($user,'Mukim');
            $mukim  = Mukim::find($mukimuser);
        }
        else
        {
            $daerah  = Daerah::where('status',1)->get();
            $mukim=Mukim::where('status',1)->get();
            $daerahuser='';
            $mukimuser='';
        }

        return view('dashboard::topmng.statistik',compact('parlimen','dun','daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));
    }
    
    public function homeindex()
    {
        
        return view('dashboard::index');

    }
    public function countpetempatan(Request $request)
    {

       if($request->parlimen==0){
        $countpetempatan  = Kampung::selectRaw('count(id) AS jum_petempatan');


       }else{
        $countpetempatan  = Kampung::selectRaw('count(id) AS jum_petempatan')->where('fk_parlimen',$request->parlimen);

       }
       
       if($request->dun!=0){
        $countpetempatan->where('fk_dun',$request->dun);
       }

       if($request->daerah!=0){
        $countpetempatan->where('fk_daerah',$request->daerah);
       }
       if($request->mukim!=0){
        $countpetempatan->where('fk_mukim',$request->mukim);
       }

       if($request->catpetempatan!=0){
        if($request->catpetempatan==4){//kg tradisional
          $countpetempatan->where('KategoriPetempatan',$request->catpetempatan)
                          ->whereNull('IdKampungInduk');
        }else{
           $countpetempatan->where('KategoriPetempatan',$request->catpetempatan);
        }
        $searchcat=1;
       }else{
        $searchcat=0;
        $countpetempatan->whereNull('IdKampungInduk');
       }
       if($request->kampung!=0){
       $countpetempatan->where('id',$request->kampung);
       }

        if($request->kampung!=0){
        $countpetempatan->where('id',$request->kampung);
       }

         
       $result=$countpetempatan->where('status',1)->first();

       $resultall=$this->repos->countallpetemptan($request);

       $category=LkpDetail::find($request->catpetempatan);



        return view('dashboard::admin.countpetempatan',compact('result','resultall','searchcat','category'));
       }
    public function countdata(Request $request)
    {

       if($request->parlimen==0){
        $countpetempatan  = Kampung::selectRaw('count(id) AS jum_petempatan');


       }else{
        $countpetempatan  = Kampung::selectRaw('count(id) AS jum_petempatan')->where('fk_parlimen',$request->parlimen);

       }
       
       if($request->dun!=0){
        $countpetempatan->where('fk_dun',$request->dun);
       }

       if($request->daerah!=0){
        $countpetempatan->where('fk_daerah',$request->daerah);
       }
       if($request->mukim!=0){
        $countpetempatan->where('fk_mukim',$request->mukim);
       }

       if($request->catpetempatan!=0){
        if($request->catpetempatan==4){//kg tradisional
          $countpetempatan->where('KategoriPetempatan',$request->catpetempatan)
                          ->whereNull('IdKampungInduk');
        }else{
           $countpetempatan->where('KategoriPetempatan',$request->catpetempatan);
        }
        $searchcat=1;
       }else{
        $searchcat=0;
        $countpetempatan->whereNull('IdKampungInduk');
       }
       if($request->kampung!=0){
       $countpetempatan->where('id',$request->kampung);
       }

        if($request->kampung!=0){
        $countpetempatan->where('id',$request->kampung);
       }

         
       $result=$countpetempatan->where('status',1)->count();
  
       return compact('result');
        
       }

    public function chart1(Request $request)
    {
        if($request->parlimen==0)
        {
            $parlimen='';
        }
        else
        {
            $parlimen='and kampung.fk_parlimen='.$request->parlimen;
        }

        if($request->dun==0)
        {
            $dun='';
        }
        else
        {
            $dun='and kampung.fk_dun='.$request->dun;
        }

        if($request->daerah==0)
        {
            $daerah='';
        }
        else
        {
            $daerah='and kampung.fk_daerah='.$request->daerah;
        }

        if($request->mukim==0)
        {
            $mukim='';
        }
        else
        {
            $mukim='and kampung.fk_mukim='.$request->mukim;
        }

        if($request->catpetempatan==0)
        {
            $catpetempatan='';
            $kampunginduk='and kampung.IdKampungInduk is null';
        }
        else
        {
            $catpetempatan='and kampung.KategoriPetempatan='.$request->catpetempatan;

            if($request->catpetempatan==4)
            {
                $kampunginduk='and kampung.IdKampungInduk is null';
            }
            else
            {
                $kampunginduk='';
            }
        }

        if($request->kampung==0)
        {
            $kampung='';
        }
        else
        {
            $kampung='and kampung.id='.$request->kampung;
        }

        $data= DB::select("
          select 
              lkp_detail.description as label,
              count(pemilikanrumah.id) as data, 
              lkp_detail.id as idlkp
          from
              pemilikanrumah
              join kampung
              on pemilikanrumah.fk_kampung=kampung.id
              join lkp_detail
              on lkp_detail.id=pemilikanrumah.StatusMilikan
              join isirumah
              on isirumah.fk_rumah=pemilikanrumah.id
          where
              kampung.status=1
              and isirumah.flag_ketua_rumah=1
              and kampung.KategoriPetempatan=4
              and pemilikanrumah.deleted_at is null
              and kampung.deleted_at is null
               ".$parlimen."
               ".$dun."
               ".$daerah."
               ".$mukim."
               ".$catpetempatan."
               ".$kampunginduk."
               ".$kampung."
          group by lkp_detail.description, lkp_detail.id");

        // dd($data);exit;

        $data_query = "";
        $data_label = "";
        $arr_label = [];
        $arr_data = [];
        $arr_status = [];
        $arr_idlkp = [];

        if(sizeof($data) > 0)
        {
            foreach ($data as $key => $value) 
            {
                // dd($value);
                $data_query = "";
                $data_label = "";
                $data_idlkp = "";
                $i = 0;

                foreach ($value as $key_sub => $value_sub) 
                {
                    // dd($value);
                    if($key_sub == "label")
                    {
                        array_push($arr_status, $value_sub);
                    }
                    elseif ($key_sub == "idlkp") 
                    {
                       array_push($arr_idlkp, $value_sub);
                    }
                    else
                    {
                        if($i == 1)
                        {
                            $data_query = $value_sub;
                            $data_label = $key_sub;
                        }
                        else
                        {
                            $data_query .= ",".$value_sub;
                            $data_label .= ",".$key_sub;
                        }
                    }

                    $i++;

                }
                array_push($arr_data, $data_query);
                array_push($arr_label, $data_label);
            }
        }

        return compact('arr_status','arr_data','arr_label', 'arr_idlkp');
    }

    public function chart25()
    {
 

            $data=DB::select("exec sp_summary_status_milikan");

              $data_query = "";
              $data_label = "";
              $arr_label = [];
              $arr_data = [];
              $arr_status = [];

           
              $data_query = "";
              $data_label = "";
             
              $arr_label = [];
              $arr_data = [];
              $arr_jenis = [];
              $arr_bg = [];
              $arr_all_data = [];


              $backgroundColor = ["#caf270","#45c490","#008d93","#2e5468","#5b9bbd"];

           if(sizeof($data) > 0){
                    $flag_label = 0;
                    $j = 0;
                    
                    foreach ($data as $key => $value) {
                            
                        $data_query = [];
                        $data_label = [];
                        $data_bg = [];
                        $i = 0;

                        foreach ($value as $key_sub => $value_sub) {
                            if($key_sub != "StatusMilikan"){
                                if($flag_label == 0){
                                  array_push($arr_label, $key_sub);
                                }
                            }
                        }


                       $data_bg["background"] = $backgroundColor[$j];
                            
                        $arr_temp = [];
                        foreach ($value as $key_sub => $value_sub) {

                            if($key_sub == "StatusMilikan"){
                                $data_label["label"] = $value_sub;
                                 
                            }else{
                               if($value_sub=='NULL'){
                                  $value_data=0;

                                }else{
                                   $value_data=$value_sub;

                                }
                                $arr_temp[] = $value_data;

                            }

                            $i++;
                        }

                        $data_query["data"] = $arr_temp;

                        $j++;

                        array_push($arr_jenis, $data_label);
                        array_push($arr_data, $data_query);
                        array_push($arr_bg, $data_bg);
                        
                        // if($flag_label == 0){
                        //   array_push($arr_label, $data_label);
                        // }
                        
                        $flag_label = 1;
                    }

                }

                foreach ($arr_jenis as $key => $value) {
                  $arr_all_data[] = [$value, $arr_bg[$key], $arr_data[$key]];
                }

               //dd($arr_jenis);
                // dd($arr_data,$arr_label,$arr_jenis,$arr_bg,$arr_all_data,$jumjeniskerja);

               return compact('arr_data','arr_label','arr_jenis','arr_all_data');

       }
    
    public function chart2(Request $request)
    {
        if($request->parlimen==0)
        {
            $parlimen='';
        }
        else
        {
            $parlimen='and kampung.fk_parlimen='.$request->parlimen;
        }

        if($request->dun==0)
        {
            $dun='';
        }
        else
        {
            $dun='and kampung.fk_dun='.$request->dun;
        }

        if($request->daerah==0)
        {
            $daerah='';
        }
        else
        {
            $daerah='and kampung.fk_daerah='.$request->daerah;
        }

        if($request->mukim==0)
        {
            $mukim='';
        }
        else
        {
            $mukim='and kampung.fk_mukim='.$request->mukim;
        }

        if($request->catpetempatan==0)
        {
            $catpetempatan='';
            $kampunginduk='and kampung.IdKampungInduk is null';
        }
        else
        {
            $catpetempatan='and kampung.KategoriPetempatan='.$request->catpetempatan;

            if($request->catpetempatan==4)
            {
                $kampunginduk='and kampung.IdKampungInduk is null';
            }
            else
            {
                $kampunginduk='';
            }
        }

        if($request->kampung==0)
        {
            $kampung='';
        }
        else
        {
            $kampung='and kampung.id='.$request->kampung;
        }

        $sumjenisrumah=Pemilikanrumah::selectRaw('pemilikanrumah.id as sumjenisrumah')
                                     ->join('kampung','kampung.id','=','pemilikanrumah.fk_kampung')
                                     ->where('kampung.status',1)
                                     ->whereNotNull('pemilikanrumah.JenisRumah');

        if($request->parlimen!=0)
        {
            $sumjenisrumah->where('kampung.fk_parlimen',$request->parlimen);
        }

        if($request->dun!=0)
        {
            $sumjenisrumah->where('kampung.fk_dun',$request->dun);
        }

        if($request->daerah!=0)
        {
            $sumjenisrumah->where('kampung.fk_daerah',$request->daerah);
        }

        if($request->mukim!=0)
        {
            $sumjenisrumah->where('kampung.fk_mukim',$request->mukim);
        }

        if($request->catpetempatan!=0)
        {
            if($request->catpetempatan==4)
            {
                $sumjenisrumah->where('kampung.KategoriPetempatan',$request->catpetempatan)->whereNull('kampung.IdKampungInduk');
            }
            else
            {
                $sumjenisrumah->where('kampung.KategoriPetempatan',$request->catpetempatan);
            }   
        }
        else
        {
            $sumjenisrumah->whereNull('kampung.IdKampungInduk');
        }

        if($request->kampung!=0)
        {
            $sumjenisrumah->where('kampung.id',$request->kampung);
        }

        $jumjenisrumah=$sumjenisrumah->count();

        $data = DB::select("
                select 
                    lkp_detail.description as label,
                    count(pemilikanrumah.id) as value,
                    lkp_detail.id as idlkp
                from
                    pemilikanrumah
                    join kampung
                      on pemilikanrumah.fk_kampung=kampung.id
                    join lkp_detail
                      on lkp_detail.id=pemilikanrumah.JenisRumah
                    join isirumah
                      on isirumah.fk_rumah=pemilikanrumah.id
                where
                    kampung.status=1
                    and isirumah.flag_ketua_rumah=1
                    and kampung.KategoriPetempatan=4
                    and pemilikanrumah.deleted_at is null
                    and kampung.deleted_at is null
                    and isirumah.deleted_at is null
                    ".$parlimen."
                    ".$dun."
                    ".$daerah."
                    ".$mukim."
                    ".$catpetempatan."
                    ".$kampunginduk."
                    ".$kampung."
               group by lkp_detail.description, lkp_detail.id");

        // $data_query = "";
        // $data_label = "";
        // $arr_label = [];
        // $arr_data = [];
        // $arr_status = [];

        $data_query = "";
        $data_label = "";
        $arr_label = [];
        $arr_data = [];
        $arr_jenis = [];
        $arr_status = [];
        $arr_idlkp = [];

        if(sizeof($data) > 0)
        {
            foreach ($data as $key => $value) 
            {
                // dd($value);
                $data_query = "";
                $data_label = "";
                $i = 0;

                foreach ($value as $key_sub => $value_sub) 
                {
                    // dd($value);
                    if($key_sub == "label")
                    {
                        array_push($arr_jenis, $value_sub);
                    }
                    elseif ($key_sub == "idlkp") 
                    {
                       array_push($arr_idlkp, $value_sub);
                    }
                    else
                    {
                        if($i == 1)
                        {
                            $data_query = $value_sub;
                            $data_label = $key_sub;
                        }
                        else
                        {
                            $data_query .= ",".$value_sub;
                            $data_label .= ",".$key_sub;
                        }
                    }
                    $i++;
                }

                array_push($arr_data, $data_query);
                array_push($arr_label, $data_label);
            }
        }
        // dd($arr_data);
        return compact('arr_data','arr_label','arr_jenis','jumjenisrumah', 'arr_idlkp');
    }

    public function chart3(Request $request)
    {
        if($request->parlimen==0)
        {
            $parlimen='';
        }
        else
        {
            $parlimen='and kampung.fk_parlimen='.$request->parlimen;
        }
        
        if($request->dun==0)
        {
            $dun='';
        }
        else
        {
            $dun='and kampung.fk_dun='.$request->dun;
        }

        if($request->daerah==0)
        {
            $daerah='';
        }
        else
        {
            $daerah='and kampung.fk_daerah='.$request->daerah;
        }

        if($request->mukim==0)
        {
            $mukim='';
        }
        else
        {
            $mukim='and kampung.fk_mukim='.$request->mukim;
        }

        if($request->catpetempatan==0)
        {
            $catpetempatan='';
            $kampunginduk='and kampung.IdKampungInduk is null';
        }
        else
        {
            $catpetempatan='and kampung.KategoriPetempatan='.$request->catpetempatan;

            if($request->catpetempatan==4)
            {
                $kampunginduk='and kampung.IdKampungInduk is null';
            }
            else
            {
                $kampunginduk='';
            }
        }

        if($request->kampung==0)
        {
            $kampung='';
        }
        else
        {
            $kampung='and kampung.id='.$request->kampung;
        }

        $sumkemudahan=ProfilKemudahan::selectRaw('profil_kemudahan.id as sumkemudahan')
                                      ->join('kampung','kampung.id','=','profil_kemudahan.fk_kampung')
                                      ->where('kampung.status',1);

        if($request->parlimen!=0)
        {
            $sumkemudahan->where('kampung.fk_parlimen',$request->parlimen);
        }

        if($request->dun!=0)
        {
            $sumkemudahan->where('kampung.fk_dun',$request->dun);
        }

        if($request->daerah!=0)
        { 
            $sumkemudahan->where('kampung.fk_daerah',$request->daerah);
        }

        if($request->mukim!=0)
        {
            $sumkemudahan->where('kampung.fk_mukim',$request->mukim);
        }

        if($request->catpetempatan!=0)
        {
            if($request->catpetempatan==4)
            {
                $sumkemudahan->where('kampung.KategoriPetempatan',$request->catpetempatan)->whereNull('kampung.IdKampungInduk');
            }
            else
            {
                $sumkemudahan->where('kampung.KategoriPetempatan',$request->catpetempatan);
            }
        }
        else
        {
            $sumkemudahan->whereNull('kampung.IdKampungInduk');
        }

        if($request->kampung!=0)
        {
            $sumkemudahan->where('kampung.id',$request->kampung);
        }

        $jumkemudahan=$sumkemudahan->count();

        $data = DB::select("
                select 
                    lkp_detail.description as label,
                    count(profil_kemudahan.id) as value,
                    lkp_detail.id as idlkp
                from
                    profil_kemudahan
                    join kampung
                      on profil_kemudahan.fk_kampung=kampung.id
                    join lkp_detail
                      on lkp_detail.id=profil_kemudahan.KatKemudahan
                where
                    kampung.status=1
                    and profil_kemudahan.deleted_at is null
                    and kampung.deleted_at is null
                    ".$parlimen."
                    ".$dun."
                    ".$daerah."
                    ".$mukim."
                    ".$catpetempatan."
                    ".$kampunginduk."
                    ".$kampung."
                group by lkp_detail.description, lkp_detail.id");

        $data_query = "";
        $data_label = "";
        $arr_label = [];
        $arr_data = [];
        $arr_status = [];
        $arr_jenis = [];
        $arr_idlkp = [];

        if(sizeof($data) > 0)
        {
            foreach ($data as $key => $value) 
            {
                // dd($value);
                $data_query = "";
                $data_label = "";
                $i = 0;

                foreach ($value as $key_sub => $value_sub) 
                {
                    // dd($value);
                    if($key_sub == "label")
                    {
                        array_push($arr_jenis, $value_sub);
                    }
                    elseif ($key_sub == "idlkp") 
                    {
                       array_push($arr_idlkp, $value_sub);
                    }
                    else
                    {
                        if($i == 1)
                        {
                            $data_query = $value_sub;
                            $data_label = $key_sub;
                        }
                        else
                        {
                            $data_query .= ",".$value_sub;
                            $data_label .= ",".$key_sub;
                        }
                    }

                    $i++;
                }

                array_push($arr_data, $data_query);
                array_push($arr_label, $data_label);
            }
        }

        return compact('arr_data','arr_label','arr_jenis','jumkemudahan', 'arr_idlkp');
    }

    public function chart4(Request $request)
    {
        if($request->parlimen==0)
        {
            $parlimen='';
        }
        else
        {
            $parlimen='and fk_parlimen='.$request->parlimen;
        }

        if($request->dun==0)
        {
            $dun='';
        }
        else
        {
            $dun='and fk_dun='.$request->dun;
        }

        if($request->daerah==0)
        {
            $daerah='';
        }
        else
        {
            $daerah='and fk_daerah='.$request->daerah;
        }

        if($request->mukim==0)
        {
            $mukim='';
        }
        else
        {
            $mukim='and fk_mukim='.$request->mukim;
        }

        if($request->catpetempatan==0)
        {
            $catpetempatan='';
            $kampunginduk='and IdKampungInduk is null';
        }
        else
        {
            $catpetempatan='and KategoriPetempatan='.$request->catpetempatan;

            if($request->catpetempatan==4)
            {
                $kampunginduk='and IdKampungInduk is null';
            }
            else
            {
                $kampunginduk='';
            }
        }

        if($request->kampung==0)
        {
            $kampung='';
        }
        else
        {
            $kampung='and idKampung='.$request->kampung;
        }

        $data = DB::select("
                  select 
                      label,
                      sum(case when ya='1' then 1 else 0 end) as YA,
                      sum(case when ya='0' then 1 else 0 end) as TIDAK,
                      case
                          when label='ELEKTRIK' 
                          then '1'
                          when label='AIR' 
                          then '2'
                          when label='ASTRO' 
                          then '3'
                          when label='INTERNET' 
                          then '4'
                          when label='TELEFON' 
                          then '5'
                      END as rownumber
                  from 
                      vw_kemudahan_detail
                  where 
                      label is not null
                      ".$parlimen."
                      ".$dun."
                      ".$daerah."
                      ".$mukim."
                      ".$catpetempatan."
                      ".$kampunginduk."
                      ".$kampung."
                      and KategoriPetempatan=4
                      and flag_ketua_rumah=1
                  group by label");

        $data_query = "";
        $data_label = "";
        $arr_label = [];
        $arr_data = [];
        $arr_status = [];
        $arr_ya = [];
        $arr_tidak=[];
        $arr_idlkp = [];

        // dd($data);

        if(sizeof($data) > 0)
        {
            foreach ($data as $key => $value) 
            {
                // dd($value);
                $data_query = "";
                $data_label = "";
                $i = 0;

                foreach ($value as $key_sub => $value_sub) 
                {
                    // dd($value);
                    if($key_sub == "label")
                    {
                        array_push($arr_status, $value_sub);
                    }
                    elseif ($key_sub == "rownumber") 
                    {
                       array_push($arr_idlkp, $value_sub);
                    }
                    else
                    {
                        if($key_sub == "YA")
                        {
                            array_push($arr_ya, $value_sub);
                        }
                        if($key_sub == "TIDAK")
                        {
                            array_push($arr_tidak, $value_sub);
                        }
                        if($i == 1)
                        {
                            $data_query = $value_sub;
                            $data_label = $key_sub;
                        }
                        else
                        {
                            $data_query .= ",".$value_sub;
                            $data_label .= ",".$key_sub;
                        }
                    }

                    $i++;
                }

                array_push($arr_data, $data_query);
                array_push($arr_label, $data_label);
            }
        }

        return compact('arr_status','arr_data','arr_label','arr_ya','arr_tidak', 'arr_idlkp');
    }

  public function chart5(Request $request)
    {


        if($request->parlimen==0){
              $parlimen='';

            }else{
              $parlimen='and kampung.fk_parlimen='.$request->parlimen;

            }

            if($request->dun==0){
              $dun='';

            }else{
              $dun='and kampung.fk_dun='.$request->dun;

            }
            if($request->daerah==0){
              $daerah='';

            }else{
              $daerah='and kampung.fk_daerah='.$request->daerah;

            }

            if($request->mukim==0){
              $mukim='';

            }else{
              $mukim='and kampung.fk_mukim='.$request->mukim;

            }

             if($request->catpetempatan==0){
              $catpetempatan='';
              $kampunginduk='and kampung.IdKampungInduk is null';

            }else{
               $catpetempatan='and kampung.KategoriPetempatan='.$request->catpetempatan;


               if($request->catpetempatan==4){
                $kampunginduk='and kampung.IdKampungInduk is null';

               }else{
                $kampunginduk='';
               }

            }

           if($request->kampung==0){
             $kampung='';
            }else{
             $kampung='and kampung.id='.$request->kampung;

            }

          // $sumjenisrumah=Pemilikanrumah::selectRaw("count(pemilikanrumah.id) as sumjenisrumah")                       ->whereHas('kampung', function ($query){
          //                                           return $query->where('status', '=', 1);
          //                               })->whereNotNull('JenisRumah')->;

              $sumjeniskerja=Isirumah::selectRaw('isirumah.id as sumjeniskerja')
                      ->join('pemilikanrumah','isirumah.fk_rumah','=','pemilikanrumah.id')
                      ->join('kampung','kampung.id','=','pemilikanrumah.fk_kampung')
                      ->where('kampung.status',1)
                      ->whereNotNull('isirumah.StatusPekerjaan');

          if($request->parlimen!=0){   
                  $sumjeniskerja->where('kampung.fk_parlimen',$request->parlimen);
                 }
                 if($request->dun!=0){   
                  $sumjeniskerja->where('kampung.fk_dun',$request->dun);
                 }
                 if($request->daerah!=0){   
                  $sumjeniskerja->where('kampung.fk_daerah',$request->daerah);
                 }
                 if($request->mukim!=0){   
                  $sumjeniskerja->where('kampung.fk_mukim',$request->mukim);
                 }
               if($request->catpetempatan!=0){
                   if($request->catpetempatan==4){
                     $sumjeniskerja->where('kampung.KategoriPetempatan',$request->catpetempatan)->whereNull('kampung.IdKampungInduk');
                   }else{
                     $sumjeniskerja->where('kampung.KategoriPetempatan',$request->catpetempatan);
                   }   
                 
                 }else{
                  $sumjeniskerja->whereNull('kampung.IdKampungInduk');

                 }
                 if($request->kampung!=0){   
                  $sumjeniskerja->where('kampung.id',$request->kampung);
                 }

          $jumjeniskerja=$sumjeniskerja->count();

          $data= DB::select("select lkp_detail.description as label, count(isirumah.id) as value, lkp_detail.id as idlkp
              from
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
              lkp_detail.id=isirumah.StatusPekerjaan

               ".$parlimen."
               ".$dun."
               ".$daerah."
               ".$mukim."
               ".$catpetempatan."
               ".$kampunginduk."
               ".$kampung."
              group by lkp_detail.description, lkp_detail.id");

              $data_query = "";
              $data_label = "";
              $arr_label = [];
              $arr_data = [];
              $arr_status = [];

           
              $data_query = "";
              $data_label = "";
              $arr_label = [];
              $arr_data = [];
              $arr_jenis = [];
              $arr_idlkp = [];

              if(sizeof($data) > 0)
              {
                  foreach ($data as $key => $value) 
                  {
                      // dump($value);
                      $data_query = "";
                      $data_label = "";
                      $data_idlkp = "";
                      $i = 0;

                      foreach ($value as $key_sub => $value_sub) 
                      {
                          // dump($value);
                          if($key_sub == "label")
                          {
                              array_push($arr_jenis, $value_sub);
                          }
                          elseif ($key_sub == "idlkp") 
                          {
                             array_push($arr_idlkp, $value_sub);
                          }
                          else
                          {
                              if($i == 1)
                              {
                                  $data_query = $value_sub;
                                  $data_label = $key_sub;
                              }
                              else
                              {
                                  $data_query .= ",".$value_sub;
                                  $data_label .= ",".$key_sub;
                              }
                          }
                          $i++;
                      }

                      array_push($arr_data, $data_query);
                      array_push($arr_label, $data_label);
                  }
              }

              // dd($arr_data);

              return compact('arr_data','arr_label','arr_jenis', 'arr_idlkp','jumjeniskerja');
       }
   public function chart5all()
   {

         $sumjeniskerja=LkpDetail::selectRaw('description')
              ->where('fk_lkp_master',22)
              ->where('status',1);


          $jumjeniskerja=$sumjeniskerja->count();

           $sumdaerah=Daerah::selectRaw('NamaDaerah')
                      ->where('status',1);


          $jumdaerah=$sumdaerah->count();
      

            $data=DB::select("exec sp_summary_kerja");

              $data_query = "";
              $data_label = "";
              $arr_label = [];
              $arr_data = [];
              $arr_status = [];

           
              $data_query = "";
              $data_label = "";
             
              $arr_label = [];
              $arr_data = [];
              $arr_jenis = [];
              $arr_bg = [];
              $arr_all_data = [];


              $backgroundColor = ["#caf270","#45c490","#008d93","#2e5468"];

           if(sizeof($data) > 0){
                    $flag_label = 0;
                    $j = 0;
                    
                    foreach ($data as $key => $value) {
                            
                        $data_query = [];
                        $data_label = [];
                        $data_bg = [];
                        $i = 0;

                        foreach ($value as $key_sub => $value_sub) {
                            if($key_sub != "jenis_kerja"){
                                if($flag_label == 0){
                                  array_push($arr_label, $key_sub);
                                }
                            }
                        }


                       $data_bg["background"] = $backgroundColor[$j];
                            
                        $arr_temp = [];
                        foreach ($value as $key_sub => $value_sub) {

                            if($key_sub == "jenis_kerja"){
                                $data_label["label"] = $value_sub;
                                 
                            }else{
                                $arr_temp[] = $value_sub;

                            }

                            $i++;
                        }

                        $data_query["data"] = $arr_temp;

                        $j++;

                        array_push($arr_jenis, $data_label);
                        array_push($arr_data, $data_query);
                        array_push($arr_bg, $data_bg);
                        
                        // if($flag_label == 0){
                        //   array_push($arr_label, $data_label);
                        // }
                        
                        $flag_label = 1;
                    }

                }

                foreach ($arr_jenis as $key => $value) {
                  $arr_all_data[] = [$value, $arr_bg[$key], $arr_data[$key]];
                }

               //dd($arr_jenis);
                // dd($arr_data,$arr_label,$arr_jenis,$arr_bg,$arr_all_data,$jumjeniskerja);

               return compact('arr_data','arr_label','arr_jenis','arr_all_data','jumjeniskerja');
       }

    public function chart6(Request $request)
    {
        if($request->parlimen==0)
        {
            $parlimen='';
        }
        else
        {
            $parlimen='and kampung.fk_parlimen='.$request->parlimen;
        }

        if($request->dun==0)
        {
            $dun='';
        }
        else
        {
            $dun='and kampung.fk_dun='.$request->dun;
        }

        if($request->daerah==0)
        {
            $daerah='';
        }
        else
        {
            $daerah='and kampung.fk_daerah='.$request->daerah;
        }

        if($request->mukim==0)
        {
            $mukim='';
        }
        else
        {
            $mukim='and kampung.fk_mukim='.$request->mukim;
        }

        if($request->catpetempatan==0)
        {
            $catpetempatan='';
            $kampunginduk='and kampung.IdKampungInduk is null';
        }
        else
        {
            $catpetempatan='and kampung.KategoriPetempatan='.$request->catpetempatan;

            if($request->catpetempatan==4)
            {
                $kampunginduk='and kampung.IdKampungInduk is null';
            }
            else
            {
                $kampunginduk='';
            }
        }

        if($request->kampung==0)
        {
            $kampung='';
        }
        else
        {
            $kampung='and kampung.id='.$request->kampung;
        }

        $sumjeniskawin=Isirumah::selectRaw('isirumah.id as sumjeniskawin')
                              ->join('pemilikanrumah','isirumah.fk_rumah','=','pemilikanrumah.id')
                              ->join('kampung','kampung.id','=','pemilikanrumah.fk_kampung')
                              ->where('kampung.status',1)
                              ->whereNotNull('isirumah.TarafKahwin');
        
        if($request->parlimen!=0)
        {
            $sumjeniskawin->where('kampung.fk_parlimen',$request->parlimen);
        }

        if($request->dun!=0)
        {
            $sumjeniskawin->where('kampung.fk_dun',$request->dun);
        }

        if($request->daerah!=0)
        {
            $sumjeniskawin->where('kampung.fk_daerah',$request->daerah);
        }

        if($request->mukim!=0)
        {
            $sumjeniskawin->where('kampung.fk_mukim',$request->mukim);
        }

        if($request->catpetempatan!=0)
        {
            if($request->catpetempatan==4)
            {
                $sumjeniskawin->where('kampung.KategoriPetempatan',$request->catpetempatan)->whereNull('kampung.IdKampungInduk');
            }
            else
            {
                $sumjeniskawin->where('kampung.KategoriPetempatan',$request->catpetempatan);
            }
        }
        else
        {
            $sumjeniskawin->whereNull('kampung.IdKampungInduk');
        }

        if($request->kampung!=0)
        {
            $sumjeniskawin->where('kampung.id',$request->kampung);
        }

        $jumjeniskawin=$sumjeniskawin->count();

        $data = DB::select("
                select 
                    lkp_detail.description as label,
                    count(isirumah.id) as value,
                    lkp_detail.id as idlkp
                from
                    isirumah
                    join pemilikanrumah
                      on isirumah.fk_rumah=pemilikanrumah.id
                    join kampung
                      on kampung.id=pemilikanrumah.fk_kampung
                    join lkp_detail
                      on lkp_detail.id=isirumah.TarafKahwin
                    ".$parlimen."
                    ".$dun."
                    ".$daerah."
                    ".$mukim."
                    ".$catpetempatan."
                    ".$kampunginduk."
                    ".$kampung."
                    and isirumah.deleted_at is null
                group by lkp_detail.description, lkp_detail.id");

        $data_query = "";
        $data_label = "";
        $arr_label = [];
        $arr_data = [];
        $arr_jenis = [];
        $arr_status = [];
        $arr_idlkp = [];

        if(sizeof($data) > 0)
        {
            foreach ($data as $key => $value) 
            {
                // dd($value);
                $data_query = "";
                $data_label = "";
                $i = 0;

                foreach ($value as $key_sub => $value_sub) 
                {
                    // dd($value);
                    if($key_sub == "label")
                    {
                        array_push($arr_jenis, $value_sub);
                    }
                    elseif ($key_sub == "idlkp") 
                    {
                       array_push($arr_idlkp, $value_sub);
                    }
                    else
                    {
                        if($i == 1)
                        {
                            $data_query = $value_sub;
                            $data_label = $key_sub;
                        }
                        else
                        {
                            $data_query .= ",".$value_sub;
                            $data_label .= ",".$key_sub;
                        }
                    }
                    $i++;
                }

                array_push($arr_data, $data_query);
                array_push($arr_label, $data_label);
            }
        }

        return compact('arr_data','arr_label','arr_jenis','jumjeniskawin', 'arr_idlkp');
    }

    public function chart7(Request $request)
    {
        if($request->parlimen==0)
        {
            $parlimen='';
        }
        else
        {
            $parlimen='and fk_parlimen='.$request->parlimen;
        }

        if($request->dun==0)
        {
            $dun='';
        }
        else
        {
            $dun='and fk_dun='.$request->dun;
        }

        if($request->daerah==0)
        {
            $daerah='';
        }
        else
        {
            $daerah='and fk_daerah='.$request->daerah;
        }

        if($request->mukim==0)
        {
            $mukim='';
        }
        else
        {
            $mukim='and fk_mukim='.$request->mukim;
        }

        if($request->catpetempatan==0)
        {
            $catpetempatan='';
            $kampunginduk='and IdKampungInduk is null';
        }
        else
        {
            $catpetempatan='and KategoriPetempatan='.$request->catpetempatan;

            if($request->catpetempatan==4)
            {
                $kampunginduk='and IdKampungInduk is null';
            }
            else
            {
                $kampunginduk='';
            }
        }

        if($request->kampung==0)
        {
            $kampung='';
        }
        else
        {
            $kampung='and idKampung='.$request->kampung;
        }

        $data= DB::select("
                select
                    peringkat as label,
                    sum(kira) as value,
                    case
                        when peringkat='KANAK-KANAK & REMAJA AWAL 0-14' 
                        then '1'
                        when peringkat='BELIA AWAL 15-18' 
                        then '2'
                        when peringkat='BELIA PETENGAHAN 19-24' 
                        then '3'
                        when peringkat='BELIA AKHIR 25-30' 
                        then '4'
                        when peringkat='BELIA DEWASA 31-40' 
                        then '5'
                        when peringkat='DEWASA 41-64' 
                        then '6'
                        when peringkat='WARGA EMAS 65 ++' 
                        then '7'
                    END as ROWNUMBER
                from 
                    vw_age_detail
                where peringkat is not null
                    ".$parlimen."
                    ".$dun."
                    ".$daerah."
                    ".$mukim."
                    ".$catpetempatan."
                    ".$kampunginduk."
                    ".$kampung."
                group by peringkat 
                ORDER BY ROWNUMBER desc");

        $data_query = "";
        $data_label = "";
        $arr_label = [];
        $arr_data = [];
        $arr_status = [];
        $arr_idlkp = [];

        // dd($data);exit;

        if(sizeof($data) > 0)
        {
            foreach ($data as $key => $value) 
            {
                // dd($value);
                $data_query = "";
                $data_label = "";
                $i = 0;

                foreach ($value as $key_sub => $value_sub) 
                {
                    // dd($value);
                    if($key_sub == "label")
                    {
                        array_push($arr_status, $value_sub);
                    }
                    elseif ($key_sub == "ROWNUMBER") 
                    {
                       array_push($arr_idlkp, $value_sub);
                    }
                    else
                    {
                        if($key_sub == "value")
                        {
                            if($i == 1)
                            {
                                $data_query = $value_sub;
                                $data_label = $key_sub;
                            }
                            else
                            {
                                $data_query .= ",".$value_sub;
                                $data_label .= ",".$key_sub;
                            }
                        }
                    }

                    $i++;
                }

                array_push($arr_data, $data_query);
                array_push($arr_label, $data_label);
            }
        }

        return compact('arr_status','arr_data','arr_label', 'arr_idlkp');
    }

 public function chart8(Request $request)
    {


        if($request->parlimen==0){
              $parlimen='';

            }else{
              $parlimen='and fk_parlimen='.$request->parlimen;

            }

            if($request->dun==0){
              $dun='';

            }else{
              $dun='and fk_dun='.$request->dun;

            }
            if($request->daerah==0){
              $daerah='';

            }else{
              $daerah='and fk_daerah='.$request->daerah;

            }

            if($request->mukim==0){
              $mukim='';

            }else{
              $mukim='and fk_mukim='.$request->mukim;

            }

              if($request->catpetempatan==0){
              $catpetempatan='';
              $kampunginduk='and IdKampungInduk is null';

            }else{
               $catpetempatan='and KategoriPetempatan='.$request->catpetempatan;


               if($request->catpetempatan==4){
                $kampunginduk='and IdKampungInduk is null';

               }else{
                $kampunginduk='';
               }

            }

           if($request->kampung==0){
             $kampung='';
            }else{
             $kampung='and idKampung='.$request->kampung;

            }

          $data= DB::select("select
               peringkat as label,sum(kira) as value ,
                case
                 when peringkat='KURANG RM 2500' then '1'
                 when peringkat='RM 2500-RM 4500' then '2'
                 when peringkat='RM 4501-RM 9999' then '3'
                 when peringkat='LEBIH RM 10000' then '4'
               END as ROWNUMBER
               from vw_pendapatan_detail
               where peringkat is not null
               ".$parlimen."
               ".$dun."
               ".$daerah."
               ".$mukim."
               ".$catpetempatan."
               ".$kampunginduk."
               ".$kampung."
              group by peringkat 
              ORDER BY ROWNUMBER asc");

              $data_query = "";
              $data_label = "";
              $arr_label = [];
              $arr_data = [];
              $arr_status = [];
              $arr_idlkp = [];

              if(sizeof($data) > 0)
              {
                  foreach ($data as $key => $value) 
                  {
                      // dd($value);
                      $data_query = "";
                      $data_label = "";
                      $i = 0;

                      foreach ($value as $key_sub => $value_sub) 
                      {
                          // dd($value);
                          if($key_sub == "label")
                          {
                              array_push($arr_status, $value_sub);
                          }
                          elseif ($key_sub == "ROWNUMBER") 
                          {
                             array_push($arr_idlkp, $value_sub);
                          }
                          else
                          {
                              if($key_sub == "value")
                              {
                                  if($i == 1)
                                  {
                                      $data_query = $value_sub;
                                      $data_label = $key_sub;
                                  }
                                  else
                                  {
                                      $data_query .= ",".$value_sub;
                                      $data_label .= ",".$key_sub;
                                  }
                              }
                          }
                          $i++;
                      }

                      array_push($arr_data, $data_query);
                      array_push($arr_label, $data_label);
                  }
              }

              return compact('arr_status','arr_data','arr_label', 'arr_idlkp');
       }
    public function chart8all()
    {


         $jumgaji=4;
         $sumdaerah=Daerah::selectRaw('NamaDaerah')
                      ->where('status',1);


          $jumdaerah=$sumdaerah->count();

           $data=DB::select("exec sp_summary_pendapatan");

              $data_query = "";
              $data_label = "";
              $arr_label = [];
              $arr_data = [];
              $arr_status = [];

           
              $data_query = "";
              $data_label = "";
             
              $arr_label = [];
              $arr_data = [];
              $arr_jenis = [];
              $arr_bg = [];
              $arr_all_data = [];


              $backgroundColor = ["#caf270","#45c490","#008d93","#2e5468"];


               if(sizeof($data) > 0){
                    $flag_label = 0;
                    $j = 0;
                    
                    foreach ($data as $key => $value) {
                            
                        $data_query = [];
                        $data_label = [];
                        $data_bg = [];
                        $i = 0;

                        foreach ($value as $key_sub => $value_sub) {
                            if($key_sub != "TANGGAGAJI"){
                                if($flag_label == 0){
                                  array_push($arr_label, $key_sub);
                                }
                            }
                        }


                       $data_bg["background"] = $backgroundColor[$j];
                            
                        $arr_temp = [];
                        foreach ($value as $key_sub => $value_sub) {

                            if($key_sub == "TANGGAGAJI"){
                                $data_label["label"] = $value_sub;
                                 
                            }else{
                                $arr_temp[] = $value_sub;

                            }

                            $i++;
                        }

                        $data_query["data"] = $arr_temp;

                        $j++;

                        array_push($arr_jenis, $data_label);
                        array_push($arr_data, $data_query);
                        array_push($arr_bg, $data_bg);
                        
                        // if($flag_label == 0){
                        //   array_push($arr_label, $data_label);
                        // }
                        
                        $flag_label = 1;
                    }

                }

                foreach ($arr_jenis as $key => $value) {
                  $arr_all_data[] = [$value, $arr_bg[$key], $arr_data[$key]];
                }

               //dd($arr_jenis);
             // dd($arr_data,$arr_label,$arr_jenis,$arr_bg,$arr_all_data,$jumgaji);

               return compact('arr_data','arr_label','arr_jenis','arr_all_data','jumgaji');
       }


    public function chart10()
    {

        $pendapatan=VwKatPendapatan::orderby('NamaDaerah')->get();

          return view('dashboard::topmng.kat_pendapatan',compact('pendapatan'));




    }
    public function chart12()
    {

          $kerja=collect(DB::select("exec sp_summary_kerja_by_daerah"));


          $statuskerja=LkpDetail::where('fk_lkp_master',22)->where('status',1)->get();

         // dd($statuskerja);

          return view('dashboard::topmng.kat_kerja',compact('kerja','statuskerja'));


    }
   public function chart15()
   {

         // $sumjeniskerja=LkpDetail::selectRaw('description')
         //      ->where('fk_lkp_master',22)
         //      ->where('status',1);


         //  $jumjeniskerja=$sumjeniskerja->count();

         //   $sumdaerah=Daerah::selectRaw('NamaDaerah')
         //              ->where('status',1);


         //  $jumdaerah=$sumdaerah->count();
      

            $data=DB::select("exec sp_summary_taraf_kahwin");

              $data_query = "";
              $data_label = "";
              $arr_label = [];
              $arr_data = [];
              $arr_status = [];

           
              $data_query = "";
              $data_label = "";
             
              $arr_label = [];
              $arr_data = [];
              $arr_jenis = [];
              $arr_bg = [];
              $arr_all_data = [];


              $backgroundColor = ["#caf270","#45c490","#008d93","#2e5468"];

           if(sizeof($data) > 0){
                    $flag_label = 0;
                    $j = 0;
                    
                    foreach ($data as $key => $value) {
                            
                        $data_query = [];
                        $data_label = [];
                        $data_bg = [];
                        $i = 0;

                        foreach ($value as $key_sub => $value_sub) {
                            if($key_sub != "taraf_kahwin"){
                                if($flag_label == 0){
                                  array_push($arr_label, $key_sub);
                                }
                            }
                        }


                       $data_bg["background"] = $backgroundColor[$j];
                            
                        $arr_temp = [];
                        foreach ($value as $key_sub => $value_sub) {

                            if($key_sub == "taraf_kahwin"){
                                $data_label["label"] = $value_sub;
                                 
                            }else{

                              if($value_sub=='NULL'){
                                  $value_data=0;

                                }else{
                                   $value_data=$value_sub;

                                }
                                $arr_temp[] = $value_data;

                            }

                            $i++;
                        }

                        $data_query["data"] = $arr_temp;

                        $j++;

                        array_push($arr_jenis, $data_label);
                        array_push($arr_data, $data_query);
                        array_push($arr_bg, $data_bg);
                        
                        // if($flag_label == 0){
                        //   array_push($arr_label, $data_label);
                        // }
                        
                        $flag_label = 1;
                    }

                }

                foreach ($arr_jenis as $key => $value) {
                  $arr_all_data[] = [$value, $arr_bg[$key], $arr_data[$key]];
                }

                // dd($arr_data,$arr_label,$arr_jenis,$arr_bg,$arr_all_data,$jumjeniskerja);

               return compact('arr_data','arr_label','arr_jenis','arr_all_data');
    }
     public function chart16()
    {

          $taraf_kahwin=collect(DB::select("exec sp_summary_taraf_kahwin_by_daerah"));


          $statuskahwin=LkpDetail::where('fk_lkp_master',23)->where('status',1)->get();

         // dd($statuskerja);

          return view('dashboard::topmng.kat_kahwin',compact('taraf_kahwin','statuskahwin'));


    }
    public function chart19()
    {
 

            $data=DB::select("exec sp_summary_kemudahan_awam");

              $data_query = "";
              $data_label = "";
              $arr_label = [];
              $arr_data = [];
              $arr_status = [];

           
              $data_query = "";
              $data_label = "";
             
              $arr_label = [];
              $arr_data = [];
              $arr_jenis = [];
              $arr_bg = [];
              $arr_all_data = [];


              $backgroundColor = ["#caf270","#45c490","#008d93","#2e5468","#5b9bbd"];

           if(sizeof($data) > 0){
                    $flag_label = 0;
                    $j = 0;
                    
                    foreach ($data as $key => $value) {
                            
                        $data_query = [];
                        $data_label = [];
                        $data_bg = [];
                        $i = 0;

                        foreach ($value as $key_sub => $value_sub) {
                            if($key_sub != "kemudahan_awam"){
                                if($flag_label == 0){
                                  array_push($arr_label, $key_sub);
                                }
                            }
                        }


                       $data_bg["background"] = $backgroundColor[$j];
                            
                        $arr_temp = [];
                        foreach ($value as $key_sub => $value_sub) {

                            if($key_sub == "kemudahan_awam"){
                                $data_label["label"] = $value_sub;
                                 
                            }else{
                               if($value_sub=='NULL'){
                                  $value_data=0;

                                }else{
                                   $value_data=$value_sub;

                                }
                                $arr_temp[] = $value_data;

                            }

                            $i++;
                        }

                        $data_query["data"] = $arr_temp;

                        $j++;

                        array_push($arr_jenis, $data_label);
                        array_push($arr_data, $data_query);
                        array_push($arr_bg, $data_bg);
                        
                        // if($flag_label == 0){
                        //   array_push($arr_label, $data_label);
                        // }
                        
                        $flag_label = 1;
                    }

                }

                foreach ($arr_jenis as $key => $value) {
                  $arr_all_data[] = [$value, $arr_bg[$key], $arr_data[$key]];
                }

               //dd($arr_jenis);
                // dd($arr_data,$arr_label,$arr_jenis,$arr_bg,$arr_all_data,$jumjeniskerja);

               return compact('arr_data','arr_label','arr_jenis','arr_all_data');
       }
    public function chart20()
    {

          $kemudahan_awam=collect(DB::select("exec sp_summary_kemudahan_awam_by_daerah"));


          $status_kemudahan_awam=LkpDetail::where('fk_lkp_master',4)->where('status',1)->get();

         // dd($statuskerja);

          return view('dashboard::topmng.kat_kemudahan_awam',compact('kemudahan_awam','status_kemudahan_awam'));


    }
    public function chart23()
    {
 

            $data=DB::select("exec sp_summary_jenis_rumah");

              $data_query = "";
              $data_label = "";
              $arr_label = [];
              $arr_data = [];
              $arr_status = [];

           
              $data_query = "";
              $data_label = "";
             
              $arr_label = [];
              $arr_data = [];
              $arr_jenis = [];
              $arr_bg = [];
              $arr_all_data = [];


              $backgroundColor = ["#caf270","#45c490","#008d93","#2e5468","#5b9bbd"];

           if(sizeof($data) > 0){
                    $flag_label = 0;
                    $j = 0;
                    
                    foreach ($data as $key => $value) {
                            
                        $data_query = [];
                        $data_label = [];
                        $data_bg = [];
                        $i = 0;

                        foreach ($value as $key_sub => $value_sub) {
                            if($key_sub != "JenisRumah"){
                                if($flag_label == 0){
                                  array_push($arr_label, $key_sub);
                                }
                            }
                        }


                       $data_bg["background"] = $backgroundColor[$j];
                            
                        $arr_temp = [];
                        foreach ($value as $key_sub => $value_sub) {

                            if($key_sub == "JenisRumah"){
                                $data_label["label"] = $value_sub;
                                 
                            }else{
                               if($value_sub=='NULL'){
                                  $value_data=0;

                                }else{
                                   $value_data=$value_sub;

                                }
                                $arr_temp[] = $value_data;

                            }

                            $i++;
                        }

                        $data_query["data"] = $arr_temp;

                        $j++;

                        array_push($arr_jenis, $data_label);
                        array_push($arr_data, $data_query);
                        array_push($arr_bg, $data_bg);
                        
                        // if($flag_label == 0){
                        //   array_push($arr_label, $data_label);
                        // }
                        
                        $flag_label = 1;
                    }

                }

                foreach ($arr_jenis as $key => $value) {
                  $arr_all_data[] = [$value, $arr_bg[$key], $arr_data[$key]];
                }

               //dd($arr_jenis);
                // dd($arr_data,$arr_label,$arr_jenis,$arr_bg,$arr_all_data,$jumjeniskerja);

               return compact('arr_data','arr_label','arr_jenis','arr_all_data');
       }
    public function chart24()
    {

          $jenis_rumah=collect(DB::select("exec sp_summary_jenis_rumah_by_daerah"));


          $status_jenis_rumah=LkpDetail::where('fk_lkp_master',11)->where('status',1)->get();

         // dd($statuskerja);

          return view('dashboard::topmng.jenis_rumah',compact('jenis_rumah','status_jenis_rumah'));


    }
     public function chart21()
    {

          $status_milikan=collect(DB::select("exec sp_summary_status_milikan_by_daerah"));


          $status_jenis_milikan=LkpDetail::where('fk_lkp_master',10)->where('status',1)->get();

         // dd($statuskerja);

          return view('dashboard::topmng.status_milikan',compact('status_milikan','status_jenis_milikan'));


    }
     public function chart18()
    {

        $kemudahanasas= VwKemudahanAsas::all();


          //$status_jenis_milikan=LkpDetail::where('fk_lkp_master',10)->where('status',1)->get();

         // dd($statuskerja);

          return view('dashboard::topmng.kemudahan_asas',compact('kemudahanasas'));


    }
    public function chart26()
    {
         $data=DB::select("exec sp_summary_age");

              $data_query = "";
              $data_label = "";
              $data_row = "";
              $arr_label = [];
              $arr_data = [];
              $arr_status = [];
              $arr_row = [];

           
              $data_query = "";
              $data_label = "";
             
              $arr_label = [];
              $arr_data = [];
              $arr_jenis = [];
              $arr_bg = [];
              $arr_all_data = [];


              $backgroundColor = ["#caf270","#45c490","#008d93","#2e5468","#5b9bbd","#2b3187","#c2d180"];

           if(sizeof($data) > 0){
                    $flag_label = 0;
                    $j = 0;
                    
                    foreach ($data as $key => $value) {
                            
                        $data_query = [];
                        $data_label = [];
                        $data_bg = [];
                        $i = 0;

                        foreach ($value as $key_sub => $value_sub) {
                            if($key_sub != "label" && $key_sub != "ROWNUMBER"){
                                if($flag_label == 0){
                                  array_push($arr_label, $key_sub);
                                }
                            }
                        }


                       $data_bg["background"] = $backgroundColor[$j];
                            
                        $arr_temp = [];
                        foreach ($value as $key_sub => $value_sub) {

                            if($key_sub == "label"){
                                $data_label["label"] = $value_sub;
                                 
                            }else{

                              if($key_sub == "ROWNUMBER"){
                                 $data_row = $value_sub;

                              }else{

                                if($value_sub=='NULL'){
                                  $value_data=0;

                                }else{
                                   $value_data=$value_sub;

                                }
                                $arr_temp[] = $value_data;

                              }
                            

                            }

                            $i++;
                        }

                        $data_query["data"] = $arr_temp;

                        $j++;

                        array_push($arr_jenis, $data_label);
                        array_push($arr_data, $data_query);
                        array_push($arr_bg, $data_bg);
                         array_push($arr_row, $data_row);
                        
                        // if($flag_label == 0){
                        //   array_push($arr_label, $data_label);
                        // }
                        
                        $flag_label = 1;
                    }

                }

                foreach ($arr_jenis as $key => $value) {
                  $arr_all_data[] = [$value, $arr_bg[$key], $arr_data[$key]];
                }

                // dd($arr_data,$arr_label,$arr_jenis,$arr_bg,$arr_all_data,$jumjeniskerja);

               return compact('arr_data','arr_label','arr_jenis','arr_all_data');
       }
     public function chart27()
    {

         $umur=collect(DB::select("exec sp_summary_age_by_daerah"));



         // dd($statuskerja);

          return view('dashboard::topmng.kat_umur',compact('umur'));




    }

    public function detailpendapatan(Request $request)
    {
        
        $daerah=Daerah::find($request->fk_daerah);
        $type=$request->types;
        
        if($request->types==1){
          $pendapatan='KURANG RM 2500';
        }else if($request->types==2){
          $pendapatan='RM 2,500 - RM 4,500';
        }else if($request->types==3){
          $pendapatan='RM 4,501 - RM 9,999';
        }else if($request->types==4){
          $pendapatan='LEBIH RM 10,000';

        }else{
          $pendapatan='';

        }

        if($request->types==0){
          $detailpendapatan= VwPendapatanPenduduk::with('daerah','mukim','parlimen','dun')->where('fk_daerah',$request->fk_daerah)->get();

        }else{
          $detailpendapatan=VwPendapatanPenduduk::with('daerah','mukim','parlimen','dun')->where('fk_daerah',$request->fk_daerah)->where('no_peringkat',$request->types)->get();

        }


         return view('dashboard::topmng.detailpendapatan',compact('detailpendapatan','daerah','pendapatan','type','daerah'));

    }
    public function detailallkerja(Request $request)
    {
        
        $daerah=Daerah::find($request->fk_daerah);
        $status=LkpDetail::find($request->types);
        $type=$request->types;

        if($request->types==0){
          $detailkerja= VwKerja::where('fk_daerah',$request->fk_daerah)->get();

        }else{
          $detailkerja=VwKerja::where('fk_daerah',$request->fk_daerah)->where('StatusPekerjaan',$request->types)->get();

        }


         return view('dashboard::topmng.detailkerja',compact('detailkerja','daerah','status','type','daerah'));

    }
     public function exportdetailkerja($filetype,$daerahid,$type)
    {

      
        $daerah=Daerah::find($daerahid);
        $status=LkpDetail::find($type);
        $type=$type;
        $daerahid=$daerahid;


     
        if($type==0){
          $detailkerja= VwKerja::where('fk_daerah',data_get($daerah,'id'))->get();

        }else{
          $detailkerja=VwKerja::where('fk_daerah',data_get($daerah,'id'))->where('StatusPekerjaan',$type)->get();

        }




          $data = [

                'daerah' => data_get($daerah,'NamaDaerah'),
                'status' =>data_get($status,'description'),
                'type'=>$type,
                'daerahid'=>$daerahid,
                'detailkerja' => $detailkerja,
                'date'  => date('d-m-Y'),
                'title'=>'Maklumat Pekerjaan Penduduk'
                
            ];



         $pdf = PDF::loadView('dashboard::topmng.pdfdetailkerja', $data);
         $pdf->setPaper('A4', 'landscape');
            return $pdf->download('LAPORAN_STATUS_PERKERJAAN.pdf');





    }
     public function exportdetailpendapatan($filetype,$daerahid,$type)
    {

      
        $daerah=Daerah::find($daerahid);
        $type=$type;
        $daerahid=$daerahid;

        if($type==1){
          $pendapatan='KURANG RM 2500';
        }else if($type==2){
          $pendapatan='RM 2,500 - RM 4,500';
        }else if($type==3){
          $pendapatan='RM 4,501 - RM 9,999';
        }else if($type==4){
          $pendapatan='LEBIH RM 10,000';

        }else{
          $pendapatan='';

        }



        if($type==0){
          $detailpendapatan= VwPendapatanPenduduk::with('daerah','mukim','parlimen','dun')->where('fk_daerah',$daerahid)->get();

        }else{
          $detailpendapatan=VwPendapatanPenduduk::with('daerah','mukim','parlimen','dun')->where('fk_daerah',$daerahid)->where('no_peringkat',$type)->get();

        }


          $data = [

                'daerah' => data_get($daerah,'NamaDaerah'),
                'pendapatan' =>$pendapatan,
                'type'=>$type,
                'daerahid'=>$daerahid,
                'detailpendapatan' => $detailpendapatan,
                'date'  => date('d-m-Y'),
                'title'=>'Maklumat Pendapatan Penduduk'
                
            ];



         $pdf = PDF::loadView('dashboard::topmng.pdfdetailpendapatan', $data);
         $pdf->setPaper('A4', 'landscape');
         return $pdf->download('LAPORAN_PENDAPATAN_PENDUDUK.pdf');





    }

    public function detailallkahwin(Request $request){

        
        $daerah=Daerah::find($request->fk_daerah);
        $status=LkpDetail::find($request->types);
        $type=$request->types;

        if($request->types==0){
          $detailkahwin= VwKahwinDetail::where('fk_daerah',$request->fk_daerah)->get();

        }else{
          $detailkahwin=VwKahwinDetail::where('fk_daerah',$request->fk_daerah)->where('TarafKahwin',$request->types)->get();

        }


         return view('dashboard::topmng.detailkahwin',compact('detailkahwin','daerah','status','type','daerah'));

    }
     public function exportdetailkahwin($filetype,$daerahid,$type)
    {

      
        $daerah=Daerah::find($daerahid);
        $status=LkpDetail::find($type);
        $type=$type;
        $daerahid=$daerahid;


     
        if($type==0){
          $detailkahwin= VwKahwinDetail::where('fk_daerah',data_get($daerah,'id'))->get();

        }else{
          $detailkahwin=VwKahwinDetail::where('fk_daerah',data_get($daerah,'id'))->where('TarafKahwin',$type)->get();

        }




          $data = [

                'daerah' => data_get($daerah,'NamaDaerah'),
                'status' =>data_get($status,'description'),
                'type'=>$type,
                'daerahid'=>$daerahid,
                'detailkahwin' => $detailkahwin,
                'date'  => date('d-m-Y'),
                'title'=>'MAKLUMAT TARAF PERKAHWINAN PENDUDUK'
                
            ];



         $pdf = PDF::loadView('dashboard::topmng.pdfdetailkahwin', $data);
         $pdf->setPaper('A4', 'landscape');
            return $pdf->download('LAPORAN_TARAF_PERKAHWINAN_PENDUDUK.pdf');





    }
    public function detailkemudahan(Request $request)
    {
        
        $daerah=Daerah::find($request->fk_daerah);
        $status=LkpDetail::find($request->types);
        $type=$request->types;

        if($request->types==0){
          $detailkemudahan= VwKemudahanAwamDetail::where('fk_daerah',$request->fk_daerah)->get();

        }else{
          $detailkemudahan=VwKemudahanAwamDetail::where('fk_daerah',$request->fk_daerah)->where('kat_kemudahan_id',$request->types)->get();

        }


         return view('dashboard::topmng.detailkemudahan',compact('detailkemudahan','daerah','status','type','daerah'));

    }
     public function exportdetailkemudahan($filetype,$daerahid,$type)
    {

      
        $daerah=Daerah::find($daerahid);
        $status=LkpDetail::find($type);
        $type=$type;
        $daerahid=$daerahid;


     
        if($type==0){
          $detailkemudahan= VwKemudahanAwamDetail::where('fk_daerah',data_get($daerah,'id'))->get();

        }else{
          $detailkemudahan=VwKemudahanAwamDetail::where('fk_daerah',data_get($daerah,'id'))->where('kat_kemudahan_id',$type)->get();

        }




          $data = [

                'daerah' => data_get($daerah,'NamaDaerah'),
                'status' =>data_get($status,'description'),
                'type'=>$type,
                'daerahid'=>$daerahid,
                'detailkemudahan' => $detailkemudahan,
                'date'  => date('d-m-Y'),
                'title'=>'KEMUDAHAN AWAM & INFRASTRUKTUR'
                
            ];



         $pdf = PDF::loadView('dashboard::topmng.pdfdetailkemudahan', $data);
         $pdf->setPaper('A4', 'landscape');
            return $pdf->download('LAPORAN_KEMUDAHAN_AWAM.pdf');





    }
    public function detailjenisrumah(Request $request){

        
        $daerah=Daerah::find($request->fk_daerah);
        $status=LkpDetail::find($request->types);
        $type=$request->types;

        if($request->types==0){
          $detailjenisrumah= VwJenisRumahDetail::where('fk_daerah',$request->fk_daerah)->get();
        }else{
          $detailjenisrumah=VwJenisRumahDetail::where('fk_daerah',$request->fk_daerah)->where('JenisRumah',$request->types)->get();

        }


         return view('dashboard::topmng.detailjenisrumah',compact('detailjenisrumah','daerah','status','type','daerah'));

    }
     public function exportjenisrumah($filetype,$daerahid,$type)
    {

      
        $daerah=Daerah::find($daerahid);
        $status=LkpDetail::find($type);
        $type=$type;
        $daerahid=$daerahid;


     
        if($type==0){
          $detailjenisrumah= VwJenisRumahDetail::where('fk_daerah',data_get($daerah,'id'))->get();

        }else{
          $detailjenisrumah=VwJenisRumahDetail::where('fk_daerah',data_get($daerah,'id'))->where('JenisRumah',$type)->get();

        }




          $data = [

                'daerah' => data_get($daerah,'NamaDaerah'),
                'status' =>data_get($status,'description'),
                'type'=>$type,
                'daerahid'=>$daerahid,
                'detailjenisrumah' => $detailjenisrumah,
                'date'  => date('d-m-Y'),
                'title'=>'JENIS RUMAH'
                
            ];



         $pdf = PDF::loadView('dashboard::topmng.pdfdetailjenisrumah', $data);
         $pdf->setPaper('A4', 'landscape');
            return $pdf->download('LAPORAN_JENIS_RUMAH.pdf');





    }
    public function detailstatusmilikan(Request $request)
    {

        
        $daerah=Daerah::find($request->fk_daerah);
        $status=LkpDetail::find($request->types);
        $type=$request->types;

        if($request->types==0){
          $detailstatusmilikan= VwStatusMilikanDetail::where('fk_daerah',$request->fk_daerah)->get();
        }else{
          $detailstatusmilikan=VwStatusMilikanDetail::where('fk_daerah',$request->fk_daerah)->where('StatusMilikan',$request->types)->get();

        }


         return view('dashboard::topmng.detailstatusmilikan',compact('detailstatusmilikan','daerah','status','type','daerah'));

    }
    public function exportstatusmilikan($filetype,$daerahid,$type)
    {

      
        $daerah=Daerah::find($daerahid);
        $status=LkpDetail::find($type);
        $type=$type;
        $daerahid=$daerahid;


     
        if($type==0){
          $detailstatusmilikan= VwStatusMilikanDetail::where('fk_daerah',data_get($daerah,'id'))->get();

        }else{
          $detailstatusmilikan=VwStatusMilikanDetail::where('fk_daerah',data_get($daerah,'id'))->where('StatusMilikan',$type)->get();

        }




          $data = [

                'daerah' => data_get($daerah,'NamaDaerah'),
                'status' =>data_get($status,'description'),
                'type'=>$type,
                'daerahid'=>$daerahid,
                'detailstatusmilikan' => $detailstatusmilikan,
                'date'  => date('d-m-Y'),
                'title'=>'STATUS PEMILIKAN RUMAH'
                
            ];



         $pdf = PDF::loadView('dashboard::topmng.pdfdetailstatusmilikan', $data);
         $pdf->setPaper('A4', 'landscape');
            return $pdf->download('LAPORAN_STATUS_MILIKAN.pdf');





    }
    public function detailkemudahanasas(Request $request)
    {

        
        $daerah=Daerah::find($request->fk_daerah);
        $type=$request->types;
        $kemudahan=$request->kemudahan;


        if($request->types==0){
          $result= VwKemudahanAsasDetail::where('fk_daerah',$request->fk_daerah)
                                         ->whereNotNull('KAir')->whereNotNull('KElektrik')
                                         ->whereNotNull('KAstro')->whereNotNull('KInternet')
                                         ->whereNotNull('KTelefon')->get();
        }else{

          $detailkemudahanasas=VwKemudahanAsasDetail::where('fk_daerah',$request->fk_daerah);
                                                    
         if($type=='a1'){

            $detailkemudahanasas->where('KAir','1');

          }
           if($type=='a0'){

            $detailkemudahanasas->where('KAir','0');

          }
           if($type=='e1'){

            $detailkemudahanasas->where('KElektrik','1');

          }
           if($type=='e0'){

            $detailkemudahanasas->where('KElektrik','0');

          }
           if($type=='s1'){

            $detailkemudahanasas->where('KAstro','1');

          }
           if($type=='s0'){

            $detailkemudahanasas->where('KAstro','0');

          }
          if($type=='y1'){

            $detailkemudahanasas->where('KInternet','1');

          }
           if($type=='y0'){

            $detailkemudahanasas->where('KInternet','0');

          }
          if($type=='t1'){

            $detailkemudahanasas->where('KTelefon','1');

          }
           if($type=='t0'){

            $detailkemudahanasas->where('KTelefon','0');

          }


          $result=$detailkemudahanasas->get();
     

        }



         return view('dashboard::topmng.detailkemudahanasas',compact('daerah','type','result','kemudahan'));

    }
    public function exportdetailkemudahanasas($filetype,$daerahid,$type,$kemudahan)
    {

      
        $daerah=Daerah::find($daerahid);
        $type=$type;
        $kemudahan=$kemudahan;


     
        if($type==0){
          $result= VwKemudahanAsasDetail::where('fk_daerah',$daerahid)
                                         ->whereNotNull('KAir')->whereNotNull('KElektrik')
                                         ->whereNotNull('KAstro')->whereNotNull('KInternet')
                                         ->whereNotNull('KTelefon')->get();
        }else{

          $detailkemudahanasas=VwKemudahanAsasDetail::where('fk_daerah',$daerahid);
                                                    
         if($type=='a1'){

            $detailkemudahanasas->where('KAir','1');

          }
           if($type=='a0'){

            $detailkemudahanasas->where('KAir','0');

          }
           if($type=='e1'){

            $detailkemudahanasas->where('KElektrik','1');

          }
           if($type=='e0'){

            $detailkemudahanasas->where('KElektrik','0');

          }
           if($type=='s1'){

            $detailkemudahanasas->where('KAstro','1');

          }
           if($type=='s0'){

            $detailkemudahanasas->where('KAstro','0');

          }
          if($type=='y1'){

            $detailkemudahanasas->where('KInternet','1');

          }
           if($type=='y0'){

            $detailkemudahanasas->where('KInternet','0');

          }
          if($type=='t1'){

            $detailkemudahanasas->where('KTelefon','1');

          }
           if($type=='t0'){

            $detailkemudahanasas->where('KTelefon','0');

          }


          $result=$detailkemudahanasas->get();
     

        }




          $data = [

                'daerah' => data_get($daerah,'NamaDaerah'),
                'kemudahan' =>$kemudahan,
                'type'=>$type,
                'daerahid'=>$daerahid,
                'result' => $result,
                'date'  => date('d-m-Y'),
                'title'=>'KEMUDAHAN ASAS RUMAH'
                
            ];



         $pdf = PDF::loadView('dashboard::topmng.pdfdetailkemudahanasas', $data);
         $pdf->setPaper('A4', 'landscape');
            return $pdf->download('KEMUDAHAN_ASAS_RUMAH.pdf');





    }
    public function detailage(Request $request){

        
        $daerah=Daerah::find($request->fk_daerah);
        $type=$request->types;

        if($type==1){
          $umur='KANAK-KANAK & REMAJA AWAL 0-14';

        }elseif($type==2){
          $umur='BELIA AWA 15-18';

        }elseif($type==3){
          $umur='BELIA PETENGAHAN 19-24';

        }elseif($type==4){
          $umur='BELIA AKHIR 25-30';

        }elseif($type==5){
          $umur='BELIA DEWASA 31-40';

        }elseif($type==6){
          $umur='DEWASA 41-64';

        }else{
          $umur='WARGA EMAS 65 ++';

        }


         if($request->types==0){
              $daerahfilter='and fk_daerah='.$request->fk_daerah;
               $peringkat='';

            }else{
              $peringkat='and peringkat='.$type;
              $daerahfilter='and fk_daerah='.$request->fk_daerah;

            }


         $detailage= DB::select("select  Nama,NoKP,TelNo,Pekerjaan,Umur,NamaKampung,NamaDaerah,fk_daerah,NamaDun,NamaMukim,NamaParlimen,peringkat 
            from(
            select
               Nama,NoKP,TelNo,Pekerjaan,Umur,NamaKampung,NamaDaerah,fk_daerah,NamaDun,NamaMukim,NamaParlimen,peringkat,
                case
                 when peringkat='KANAK-KANAK & REMAJA AWAL 0-14' then '1'
                 when peringkat='BELIA AWAL 15-18' then '2'
                 when peringkat='BELIA PETENGAHAN 19-24' then '3'
                 when peringkat='BELIA AKHIR 25-30' then '4'
                 when peringkat='BELIA DEWASA 31-40' then '5'
                 when peringkat='DEWASA 41-64' then '6'
                 when peringkat='WARGA EMAS 65 ++' then '7'
               END as ROWNUMBER
               from vw_age_detail
               where peringkat is not null
               and kira=1
               ".$daerahfilter."
              ) as x
              where
              x.ROWNUMBER=".$type."");




        // if($request->types==0){
        //   $detailage= VwAgeDetail::where('fk_daerah',$request->fk_daerah)->where('kira',1)->get();

        // }else{
        //   $detailage=VwAgeDetail::where('fk_daerah',$request->fk_daerah)->where('peringkat',$type)->where('kira',1)->get();

        // }


         return view('dashboard::topmng.detailage',compact('detailage','type','daerah','umur'));

    }
    public function exportdetailage($filetype,$daerahid,$type)
    {

      
        $daerah=Daerah::find($daerahid);
        $type=$type;
        $daerahid=$daerahid;


        if($type==1){
          $umur='KANAK-KANAK & REMAJA AWAL 0-14';

        }elseif($type==2){
          $umur='BELIA AWAL 15-18';

        }elseif($type==3){
          $umur='BELIA PETENGAHAN 19-24';

        }elseif($type==4){
          $umur='BELIA AKHIR 25-30';

        }elseif($type==5){
          $umur='BELIA DEWASA 31-40';

        }elseif($type==6){
          $umur='DEWASA 41-64';

        }else{
          $umur='WARGA EMAS 65 ++';

        }


     
          if($type==0){
              $daerahfilter='and fk_daerah='.$daerahid;
             //  $peringkat='';

            }else{
             // $peringkat='and peringkat='.$type;
              $daerahfilter='and fk_daerah='.$daerahid;

            }


         $detailage= DB::select("select  Nama,NoKP,TelNo,Pekerjaan,Umur,NamaKampung,NamaDaerah,fk_daerah,NamaDun,NamaMukim,NamaParlimen,peringkat 
            from(
            select
               Nama,NoKP,TelNo,Pekerjaan,Umur,NamaKampung,NamaDaerah,fk_daerah,NamaDun,NamaMukim,NamaParlimen,peringkat,
                case
                 when peringkat='KANAK-KANAK & REMAJA AWAL 0-14' then '1'
                 when peringkat='BELIA AWAL 15-18' then '2'
                 when peringkat='BELIA PETENGAHAN 19-24' then '3'
                 when peringkat='BELIA AKHIR 25-30' then '4'
                 when peringkat='BELIA DEWASA 31-40' then '5'
                 when peringkat='DEWASA 41-64' then '6'
                 when peringkat='WARGA EMAS 65 ++' then '7'
                 END as ROWNUMBER
                 from vw_age_detail
                 where peringkat is not null
                 and kira=1
                 ".$daerahfilter."
                ) as x
                where
              x.ROWNUMBER=".$type."");




          $data = [

                'daerah' => data_get($daerah,'NamaDaerah'),
                'umur'=>$umur,
                'type'=>$type,
                'daerahid'=>$daerahid,
                'detailage' => $detailage,
                'date'  => date('d-m-Y'),
                'title'=>'MAKLUMAT UMUR PENDUDUK'
                
            ];



         $pdf = PDF::loadView('dashboard::topmng.pdfdetailage', $data);
         $pdf->setPaper('A4', 'landscape');
            return $pdf->download('LAPORAN_UMUR_PENDUDUK.pdf');





    }

    public function dun($parlimenid)
    {

       $dun  = Dun::where('fk_parlimen',$parlimenid)->get();

       return view('dashboard::dun',compact('dun'));

    }
    public function mukim($daerahid)
    {

       $mukim  = Mukim::where('fk_daerah',$daerahid)->get();

       return view('dashboard::mukim',compact('mukim'));

    }
    public function parlimenKampung($daerahid,$mukimid)
    {

     $parlimenKampung  = Kampung::selectRaw('distinct(parlimen.id),parlimen.NamaParlimen')
                        ->leftjoin('parlimen','parlimen.id','=','kampung.fk_parlimen');

    if($daerahid==0){
        $parlimenKampung=$parlimenKampung;

    }else{
         $parlimenKampung=$parlimenKampung->where('fk_daerah',$daerahid);
    }

    if($mukimid!=0){
         $parlimenKampung=$parlimenKampung->where('fk_mukim',$mukimid);
     }

      $parlimenKampung=$parlimenKampung->whereNull('IdKampungInduk')->get();

    return view('dashboard::parlimenkampung',compact('parlimenKampung'));

    }
    public function topmanagebaru()
    {

      $parlimen  = Parlimen::where('status',1)->get();
      $dun  = Dun::where('status',1)->get();
     
      $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();

      $user = auth()->user();
      $roleuser=AclRoleUser::where('user_id',data_get($user,'id'))->first();

      if(data_get($roleuser,'role_id') ==2 || data_get($roleuser,'role_id')==3){

      $daerahuser=data_get($user,'Daerah');
      $daerah  = Daerah::find($daerahuser);
      $mukimuser=data_get($user,'Mukim');
      $mukim  = Mukim::find($mukimuser);

      }else{
        $daerah  = Daerah::where('status',1)->get();
        $mukim=Mukim::where('status',1)->get();
        $daerahuser='';
        $mukimuser='';

      }
      return view('dashboard::topmng.statistik',compact('parlimen','dun','daerah','mukim','catpenempatan','roleuser','daerahuser','mukimuser'));


    }


}
