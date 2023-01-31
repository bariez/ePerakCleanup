<?php

namespace Workbench\Site\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Mail;
use Curl;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravolt\Epicentrum\Contracts\Requests\Account\Delete;
//use Laravolt\Epicentrum\Contracts\Requests\Account\Store;
use App\Http\Requests\Account\Store;
use App\Http\Requests\Lkp\Masterstore;
use Laravolt\Epicentrum\Mail\AccountInformation;
use Laravolt\Epicentrum\Repositories\RepositoryInterface;
use Laravolt\Platform\Models\User;
use Laravolt\Support\Contracts\TimezoneRepository;

use Workbench\Site\Data\Repo\SiteRepo;
use App\Http\Requests\Account\Update;
use Workbench\Site\Model\Lookup\LkpMaster;
use Workbench\Site\Model\Lookup\LkpDetail;
use Illuminate\Support\Facades\Validator;
use Request as requests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Workbench\Site\Model\Lookup\Users;
use Workbench\Site\Model\Lookup\UserAccessLog;
use Workbench\Site\Model\Lookup\AclRoles;
use Workbench\Site\Model\Lookup\AclRoleUser;
use Workbench\Site\Model\Lookup\Parlimen;
use Workbench\Site\Model\Lookup\Dun;
use Workbench\Site\Model\Lookup\Daerah;
use Workbench\Site\Model\Lookup\Mukim;
use Workbench\Site\Model\Lookup\Kampung;
use Event;
use App\Providers\AuditLog;
use Laravolt\Epicentrum\Repositories\RoleRepository;
use Laravolt\Epicentrum\Repositories\RoleRepositoryInterface;
use Laravolt\Epicentrum\Http\Requests\Role\Store as storerole;
use Laravolt\Epicentrum\Http\Requests\Role\Update as updaterole;
use App\Http\Controllers\Auth\ApproveUserInformation;

class SiteController extends Controller
{
	 use AuthorizesRequests;
   //

    protected RepositoryInterface $repository;

    protected TimezoneRepository $timezone;

    public function __construct(RepositoryInterface $repository, TimezoneRepository $timezone,SiteRepo $repos,RoleRepositoryInterface $rolerepository)
    {
        $this->repository = $repository;
        $this->timezone = $timezone;
        $this->repos = $repos;
        $this->rolerepository = $rolerepository;
         $this->model = app(config('laravolt.epicentrum.models.user'));
    }


    public function index()
    {
       
        $data = Users::selectRaw("users.id,users.name,users.email,users.created_at,acl_roles.name as namerole,CASE
                                        WHEN users.status='ACTIVE' THEN 'Aktif'
                                        WHEN users.status='INACTIVE' THEN 'Tidak Aktif'
                                        WHEN users.status='PENDING' THEN 'Dalam Proses'
                                         WHEN users.status='BLOCKED' THEN 'Tidak Lulus'
                                        ELSE 'Aktif'
                                        END AS status")
            ->join('acl_role_user','users.id','=','acl_role_user.user_id')
            ->join('acl_roles','acl_roles.id','=','acl_role_user.role_id')
            ->whereIn('status',array('ACTIVE','INACTIVE','BLOCKED'))
            ->latest()->get();


       return view('laravolt::users.index',compact('data'));
		 //return view('dashboard::dashboard.index');


    }
    public function store(Store $request)
    {


    	
       // $this->authorize('create', User::class);

        // save to db
        $roles = $request->get('role', []);


        $user = $this->createByAdmin($request->all(), $roles);


        $password = $request->get('password');


        //hantar email

        // send account info to email
       // if ($request->has('send_account_information')) {
           // Mail::to($user)->send(new AccountInformation($user, $password));
       // }

        $new_value = $request->except(['_token','action']);
        $activities='Tambah Pengguna';

        Event::dispatch(new AuditLog(auth()->user()->id,$user->id,$activities,'',json_encode($new_value)));

        return redirect()->route('site::users.index')->withSuccess(trans('Data telah berjaya disimpan'));
    }
     public function createByAdmin(array $attributes, $roles = null)
    {
        //dd($attributes);
        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['email_verified_at'] =date('Y-m-d h:i:s');
        

          if($attributes['role']==2){//pegawai daerah
              $attributes['Daerah']=$attributes['daerah01'];

            }
            if($attributes['role']==3){//pegawai mukim
              $attributes['Daerah']=$attributes['daerah02'];
               $attributes['Mukim']=$attributes['mukim'];

            }
        $user = $this->model->fill($attributes);
        $user->save();
        $user->roles()->sync($roles);

        $roleuser=AclRoles::find($attributes['role']);


        //email ke user//

         $dataemail = array(
                'name'=>$attributes['name'],
                'email' => $attributes['email'],
                'jabatan' => $attributes['jabatan'],
                'jawatan' => $attributes['jawatan'],
                'notel' => $attributes['notel'],
                'status'=> $attributes['status'],
                'ulasan'=> '',
                'roleuser'=>data_get($roleuser,'name')

              );

       if($attributes['status']=='ACTIVE'){

        try {

         Mail::to($attributes['email'])->send(new ApproveUserInformation($dataemail));

       } catch (\Exception $e) {

            $activities='Hantar email Permohonan Baru Gagal Dihantar';
             Event::dispatch(new AuditLog(auth()->user()->id,$user->id,$activities,$attributes['email'],$e));
            
         }

       }


        return $user;
    }

     public function create()
    {
        
        //$this->authorize('create', User::class);
        $statuses = $this->repository->availableStatus();
        $roles = app('laravolt.epicentrum.role')->all()->pluck('name', 'id');
        $multipleRole = config('laravolt.epicentrum.role.multiple');
        $timezones = $this->timezone->all();

        $role=AclRoles::all();
        $daerah  = Daerah::where('status',1)->get();
        $mukim=Mukim::where('status',1)->get();

        return view('laravolt::users.create', compact('statuses', 'roles', 'multipleRole', 'timezones','role','daerah','mukim'));
    }
    public function edit($id)
    {
        $user = $this->repository->findById($id);
        $statuses = $this->repository->availableStatus();
        $timezones = $this->timezone->all();
        $roles = app('laravolt.epicentrum.role')->all()->pluck('name', 'id');
        $multipleRole = config('laravolt.epicentrum.role.multiple');
        $roleEditable = config('laravolt.epicentrum.role.editable');
        $tab='account';
        $role=AclRoles::all();
        $daerah  = Daerah::where('status',1)->get();
        $mukim=Mukim::where('status',1)->get();

        $roleuser=AclRoleUser::where('user_id',$user->id)->first();



        return view('laravolt::users.edit', compact('user', 'statuses', 'timezones', 'roles', 'multipleRole', 'roleEditable','tab','role','daerah','mukim','roleuser'));
    }

    public function destroy(Delete $request, $id)
    {
        try {
            $this->repository->delete($id);

            return redirect(route('epicentrum::users.index'))->withSuccess(trans('laravolt::message.user_deleted'));
        } catch (QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
    public function update(Update $request, $id)
    {
       //dd($request);
 
        $old_value=User::with('roles')->where('id',$id)->first();

        try {

      
           $user= $this->repository->updateAccount($id, $request->except('_token', '_method','role','daerah01edit','daerah01','daerah02','mukimedit','mukim','hantar'), $request->get('role', []));

           $updateuser=User::find($id);


          if($request->role==2){//pegawai daerah
            if($request->daerah01==null){
              $updateuser->Daerah=$request->daerah01edit;
            }else{
               $updateuser->Daerah=$request->daerah01;

              
              }
            }

     
            if($request->role==3){//pegawai mukim

              $updateuser->Daerah=$request->daerah02;
              if($request->mukim==null){
              $updateuser->Mukim=$request->mukimedit;
            }else{
               $updateuser->Mukim=$request->mukim;

              
              }

            }

              $updateuser->save();

        $new_value = $request->except(['_token','action']);
        $activities='Kemaskini Pengguna';

        Event::dispatch(new AuditLog(auth()->user()->id,$user->id,$activities,json_encode($old_value),json_encode($new_value)));

            return redirect()->back()->withSuccess('Data Telah dikemaskini');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function passwordedit($id)
    {
        // $user = auth()->user();

        $user = user::find($id);

        $statuses = $this->repository->availableStatus();
         $multipleRole = config('laravolt.epicentrum.role.multiple');
        $roleEditable = config('laravolt.epicentrum.role.editable');
        $roles = app('laravolt.epicentrum.role')->all()->pluck('name', 'id');

        return view('my.password.edit_admin', compact('user','statuses','multipleRole', 'roleEditable','roles'));
    }
    public function approveindex()
    {
       
        $role=AclRoles::all();
           $data = Users::selectRaw("users.id,users.name,users.email,users.created_at,CASE
                                        WHEN users.status='ACTIVE' THEN 'Aktif'
                                        WHEN users.status='INACTIVE' THEN 'Tidak Aktif'
                                        WHEN users.status='PENDING' THEN 'Dalam Proses'
                                         WHEN users.status='BLOCKED' THEN 'Tidak Lulus'
                                        ELSE 'Aktif'
                                        END AS status")
            ->where('status','PENDING')
            ->latest()->get();

       return view('laravolt::users.approveindex',compact('role','data'));
         //return view('dashboard::dashboard.index');


    }
   
    public function approve($id)
    {
        $user = $this->repository->findById($id);
        $statuses = $this->repository->availableStatus();
        $timezones = $this->timezone->all();
        $roles = app('laravolt.epicentrum.role')->all()->pluck('name', 'id');
        $multipleRole = config('laravolt.epicentrum.role.multiple');
        $roleEditable = config('laravolt.epicentrum.role.editable');
        $tab='account';
        $role=AclRoles::all();
        $daerah  = Daerah::where('status',1)->get();
        $mukim=Mukim::where('status',1)->get();
     

        return view('laravolt::users.approve', compact('user', 'statuses', 'timezones', 'roles', 'multipleRole', 'roleEditable','tab','role','daerah','mukim'));
    }
    public function approveusers(Update $request, $id)
    {

        try {


            $this->repository->updateAccount($id, $request->except('_token', '_method','role','daerah01','daerah02','mukim','hantar'), $request->get('role', []));

            $updateuser=Users::find($id);
            if($request->role==2){//pegawai daerah
              $updateuser->daerah=$request->daerah01;

            }
            if($request->role==3){//pegawai mukim
              $updateuser->Daerah=$request->daerah02;
               $updateuser->Mukim=$request->mukim;

            }
            $updateuser->Ulasan=$request->ulasan;
            $updateuser->save();

            $roleuser=AclRoles::find($request->role);


        //email ke user

             $dataemail = array(
                'name'=>data_get($updateuser,'name'),
                'email' => data_get($updateuser,'email'),
                'jabatan' => data_get($updateuser,'jabatan'),
                'jawatan' => data_get($updateuser,'jawatan'),
                'notel' => data_get($updateuser,'notel'),
                'status'=> $request->status,
                'ulasan'=> $request->ulasan,
                'roleuser'=>data_get($roleuser,'name')


              );


      try {

        Mail::to(data_get($updateuser,'email'))->send(new ApproveUserInformation($dataemail));

       } catch (\Exception $e) {

            $activities='Hantar email Kelulusan Pengguna Gagal Dihantar';
             Event::dispatch(new AuditLog(auth()->user()->id,$id,$activities,data_get($updateuser,'email'),$e));
            
         }

             $new_value = $request->except(['_token','action']);
             $activities='Kelulusan Pengguna';

        Event::dispatch(new AuditLog(auth()->user()->id,$id,$activities,'',json_encode($new_value)));

            return redirect('/site/approveindex')->withSuccess('Data Telah dikemaskini');
        } catch (\Exception $e) {

            return redirect()->back()->withError($e->getMessage());
        }

        
        //hantar email

        // send account info to email
       // if ($request->has('send_account_information')) {
           // Mail::to($user)->send(new AccountInformation($user, $password));
       // }
    }
    public function lookupindex()
    {

        $datamaster = LkpMaster::selectRaw("lkp_master.id,lkp_master.name,a.name as parent_name,CASE
                                        WHEN lkp_master.status=0 THEN 'Tidak Aktif'
                                        WHEN lkp_master.status=1 THEN 'Aktif'
                                        ELSE 'Aktif'
                                        END AS status")
                 ->leftjoin('lkp_master as a','a.id','=','lkp_master.parent_id')->get();

        return view('site::lookup.index',compact('datamaster'));
       //return view('laravolt::users.index');
         //return view('dashboard::dashboard.index');


    }
    public function geteditmaster($id)
    {

         $datamaster  = LkpMaster::find($id);
         $mainlookup  = LkpMaster::where('status',1)->get();

        return view('site::lookup.editmaster',compact('datamaster','mainlookup'));


    }
    public function createmaster()
    {
        $mainlookup  = LkpMaster::where('status',1)->get();

        return view('site::lookup.createmaster',compact('mainlookup'));
    }
    public function storemaster(Request $request)
    {

     

          $validator = Validator::make($request->all(), [
            'name'     => 'required|max:255|unique:lkp_master,name',
            'status'=>'required'
           
        ]);
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

            $storemaster =  $this->repos->storemaster($request);

            return redirect::to('/site/lookup/index')->withSuccess(__('Data telah berjaya ditambah'));

        }


    }
    public function editmaster(Request $request,$id)
    {

          $validator = Validator::make($request->all(), [
            'name'     => 'required|max:255|unique:lkp_master,name,'.$id,
            'status'=>'required'
           
        ]);
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

            $editmaster =  $this->repos->editmaster($request,$id);

            return redirect::to('/site/lookup/index')->withSuccess(__('Data telah berjaya dikemaskini'));

        }


    }
    public function listdatalookup()
    {

        $lkpmaster=requests::segment(4);

        $data = LkpDetail::selectRaw("lkp_detail.id,lkp_master.name,lkp_detail.description,a.description as catname,CASE WHEN lkp_detail.status=0 THEN 'Tidak Aktif'
                                        WHEN lkp_detail.status=1 THEN 'Aktif'
                                        ELSE 'Aktif'
                                        END AS status")
            ->leftjoin('lkp_master','lkp_master.id','=','lkp_detail.fk_lkp_master')
            ->leftjoin('lkp_detail as a','a.id','=','lkp_detail.category_detail')->where('lkp_master.id',$lkpmaster)->get();

        return view('site::lookup.listdatalookup',compact('lkpmaster','data'));
       //return view('laravolt::users.index');
         //return view('dashboard::dashboard.index');


    }
     public function createdetail($idmaster)
    {
        
      

        $mainlookup  = LkpMaster::selectRaw('lkp_master.id,lkp_master.name,a.name as parent_name,a.id as parent_id')
                                 ->leftjoin('lkp_master as a','a.id','=','lkp_master.parent_id')
                                 ->where('lkp_master.id',$idmaster)
                                 ->first();

       

        $kategoridetail=LkpDetail::where('fk_lkp_master',data_get($mainlookup,'parent_id'))
                                    ->get();



        return view('site::lookup.createdetail',compact('mainlookup','kategoridetail'));
    }

     public function storedetail(Request $request)
    {

        //   $validator = Validator::make($request->all(), [
        //     'description'     => 'required|max:255|unique:lkp_detail,description,fk_lkp_master,' .$request->masterid,
        //     'status'=>'required'
           
        // ]);

          $validator = Validator::make($request->all(), [
            'description' => [
                              Rule::unique('lkp_detail')
                              ->where('description', $request->description)
                              ->where('fk_lkp_master', $request->masterid)
                             // ->where('id', $id)
             ],
             'description' =>'required|max:255',
            'status'=>'required'
           
        ]);
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

            $storedetail =  $this->repos->storedetail($request);

            return redirect::to('/site/lkpmaster/listdatalookup/'.$request->masterid)->withSuccess(__('Data telah berjaya ditambah'));

        }


    }
     public function geteditkdetail($iddetail)
    {
        
      
      $datadetail=LkpDetail::find($iddetail);

        $mainlookup  = LkpMaster::selectRaw('lkp_master.id,lkp_master.name,a.name as parent_name,a.id as parent_id')
                                 ->leftjoin('lkp_master as a','a.id','=','lkp_master.parent_id')
                                 ->where('lkp_master.id',data_get($datadetail,'fk_lkp_master'))
                                 ->first();

        $kategoridetail=LkpDetail::where('fk_lkp_master',data_get($mainlookup,'parent_id'))
                                    ->get();



        return view('site::lookup.editdetail',compact('mainlookup','kategoridetail','datadetail'));
    }
    public function editdetail(Request $request,$id)
    {

          $validator = Validator::make($request->all(), [
            'description'     => 'required|max:255|unique:lkp_detail,description,'.$id,
            'status'=>'required'
           
        ]);

        // $validator = Validator::make($request->all(), [
        //     'description' => [
        //                         Rule::unique('lkp_detail')
        //                       //->where('description', $request->description)
        //                       // ->where('fk_lkp_master', $request->masterid)
        //                       ->where('id', $id)
        //      ],
        //     'status'=>'required'
           
        // ]);

         
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

            $storedetail =  $this->repos->editdetail($request,$id);

            return redirect::to('/site/lkpmaster/listdatalookup/'.$request->masterid)->withSuccess(__('Data telah berjaya dikemaskini'));

        }


    }
    public function accesslog($userid)
    {
      $userid=$userid;
      $data=UserAccessLog::with('users')->where('user_id',$userid)->get();

      $user=Users::find($userid);

      if(data_get($user,'status')=='ACTIVE'){
        $status='Aktif';
      }else if(data_get($user,'status')=='INACTIVE'){
         $status='Tidak Aktif';
      }else if(data_get($user,'status')=='BLOCKED'){
         $status='Tidak Lulus';
      }else{
        $status='Dalam Proses';
      }

      if(env('DB_CONNECTION') == 'mysql')
      {

        $role=AclRoleUser::selectRaw("users.id,GROUP_CONCAT(acl_roles.name) AS role")
              ->join('acl_roles','acl_roles.id','=','acl_role_user.role_id')
              ->join('users','acl_role_user.user_id','=','users.id')
              ->where('users.id',$userid)
              ->groupBy('users.id')
              ->first();

        

      }else{
       $role=AclRoleUser::selectRaw("users.id,STRING_AGG(acl_roles.name, ',') as role")
              ->join('acl_roles','acl_roles.id','=','acl_role_user.role_id')
              ->join('users','acl_role_user.user_id','=','users.id')
              ->where('users.id',$userid)
              ->groupBy('users.id')
              ->first();

      }


      return view('site::system.accesslog.index',compact('userid','data','user','role','status'));
    }

    public function parlimenindex()
    {
        $parlimen=Parlimen::all();
        return view('site::system.parlimen.listparlimen',compact('parlimen'));
       //return view('laravolt::users.index');
         //return view('dashboard::dashboard.index');


    }
    public function addparlimen()
    {

             //$jawatan=
             return view('site::system.parlimen.addparlimen');

    }

    public function saveparlimen(Request $request)
    {


          $validator = Validator::make($request->all(), [
   
             'kod'     => 'unique:parlimen,KodParlimen'
        ]);
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

             $saveparlimen =  $this->repos->saveparlimen($request);

           return redirect::to('/site/parlimen/index')->withSuccess(__('Data telah berjaya dikemaskini'));

        }


    }
    public function editparlimen($id){

            $id=$id;
       
            $parlimen=Parlimen::find($id);

             return view('site::system.parlimen.editparlimen',compact('parlimen','id'));

    }
    public function saveeditparlimen(Request $request)
    {


          $validator = Validator::make($request->all(), [
   

               'kod'     => 'unique:parlimen,KodParlimen,'.$request->idparlimen,
           
        ]);
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

             $saveeditparlimen =  $this->repos->saveeditparlimen($request);

           return redirect::to('/site/parlimen/index')->withSuccess(__('Data telah berjaya dikemaskini'));

        }


    }
     public function viewparlimen($id){

            $id=$id;
       
            $parlimen=Parlimen::find($id);

             return view('site::system.parlimen.viewparlimen',compact('parlimen','id'));

    }
    public function dunindex()
    {
        $dun=Dun::with('parlimen')->get();
        return view('site::system.dun.listdun',compact('dun'));
       //return view('laravolt::users.index');
         //return view('dashboard::dashboard.index');


    }
    public function adddun()
    {

             //$jawatan=
            $parlimen=Parlimen::where('status',1)->get();
             return view('site::system.dun.adddun',compact('parlimen'));

    }
    public function savedun(Request $request)
    {

          $validator = Validator::make($request->all(), [
   
             'kod'     => 'unique:dun,KodDun'
        ]);
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

             $savedun =  $this->repos->savedun($request);

           return redirect::to('/site/dun/index')->withSuccess(__('Data telah berjaya dikemaskini'));

        }


    }
     public function editdun($id){

            $id=$id;
       
            $dun=Dun::find($id);
            $parlimen=Parlimen::where('status',1)->get();

            return view('site::system.dun.editdun',compact('dun','id','parlimen'));

    }
    public function saveeditdun(Request $request)
    {

          $validator = Validator::make($request->all(), [
             'kod'     => 'unique:dun,KodDun,'.$request->iddun,
        ]);
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

             $saveeditdun =  $this->repos->saveeditdun($request);

           return redirect::to('/site/dun/index')->withSuccess(__('Data telah berjaya dikemaskini'));

        }


    }
    public function viewdun($id){

            $id=$id;
       
            $dun=Dun::find($id);
            $parlimen=Parlimen::find(data_get($dun,'fk_parlimen'));

             return view('site::system.dun.viewdun',compact('dun','id','parlimen'));

    }
     public function daerahindex()
    {
        $daerah=Daerah::all();;
        return view('site::system.daerah.listdaerah',compact('daerah'));
       //return view('laravolt::users.index');
         //return view('dashboard::dashboard.index');


    }
    public function adddaerah()
    {

        return view('site::system.daerah.adddaerah');

    }
    public function savedaerah(Request $request)
    {

          $validator = Validator::make($request->all(), [
   
             'kod'     => 'unique:daerah,KodDaerah',
             'nama'     => 'unique:daerah,NamaDaerah'
        ]);
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

             $savedaerah =  $this->repos->savedaerah($request);

           return redirect::to('/site/daerah/index')->withSuccess(__('Data telah berjaya dikemaskini'));

        }


    }
    public function editdaerah($id){

            $id=$id;
       
            $daerah=Daerah::find($id);
            return view('site::system.daerah.editdaerah',compact('daerah','id'));

    }
    public function saveeditdaerah(Request $request)
    {

          $validator = Validator::make($request->all(), [

             'kod'     => 'unique:daerah,KodDaerah,'.$request->iddaerah,
             'nama'     => 'unique:daerah,NamaDaerah,'.$request->iddaerah,
        ]);
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

             $saveeditdaerah =  $this->repos->saveeditdaerah($request);

           return redirect::to('/site/daerah/index')->withSuccess(__('Data telah berjaya dikemaskini'));

        }


    }
    public function viewdaerah($id){

            $id=$id;
       
            $daerah=Daerah::find($id);
             return view('site::system.daerah.viewdaerah',compact('daerah','id'));

    }
     public function mukimindex()
    {
        $mukim=Mukim::with('daerah')->get();
        return view('site::system.mukim.listmukim',compact('mukim'));
       //return view('laravolt::users.index');
         //return view('dashboard::dashboard.index');


    }
    public function addmukim()
    {

             //$jawatan=
            $daerah=Daerah::where('status',1)->get();
             return view('site::system.mukim.addmukim',compact('daerah'));

    }
    public function savemukim(Request $request)
    {

          $validator = Validator::make($request->all(), [
   
             'kod'     => 'unique:mukim,KodMukim'
        ]);
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

             $savemukim =  $this->repos->savemukim($request);

           return redirect::to('/site/mukim/index')->withSuccess(__('Data telah berjaya dikemaskini'));

        }


    }
    public function editmukim($id){

            $id=$id;
            
            $mukim=Mukim::find($id);
            $daerah=Daerah::where('status',1)->get();
            return view('site::system.mukim.editmukim',compact('daerah','id','mukim'));

    }
    public function saveeditmukim(Request $request)
    {


          $validator = Validator::make($request->all(), [
   
             // 'KodMukim'=> 'unique:mukim,NamaMukim,'.$request->idmukim.'|unique:mukim,KodMukim,'.$request->idmukim,

             'KodMukim' => Rule::unique('mukim')->where(function ($query) use ($request) {
             return $query->where('NamaMukim', $request->nama)
                ->where('KodMukim', $request->KodMukim)
                ->where('id', '<>',$request->idmukim);
})
            

        ]);

       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

             $saveeditmukim =  $this->repos->saveeditmukim($request);

           return redirect::to('/site/mukim/index')->withSuccess(__('Data telah berjaya dikemaskini'));

        }


    }
    public function viewmukim($id){

            $id=$id;
            
            $mukim=Mukim::find($id);
            $daerah=Daerah::find(data_get($mukim,'fk_daerah'));
            return view('site::system.mukim.viewmukim',compact('daerah','id','mukim'));

    }
    public function kampungindex()
    {
        $kampung=Kampung::with('parlimen','dun','daerah','mukim')->get();
        return view('site::system.kampung.listkampung',compact('kampung'));
       //return view('laravolt::users.index');
         //return view('dashboard::dashboard.index');


    }
    public function addkampung()
    {

             //$jawatan=
            $parlimen=Parlimen::where('status',1)->get();
            $daerah=Daerah::where('status',1)->get();
            $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();
            $jeniskampung=LkpDetail::where('status',1)->where('fk_lkp_master',28)->get();
            return view('site::system.kampung.addkampung',compact('parlimen','daerah','catpenempatan','jeniskampung'));

    }
      public function dun($parlimenid)
    {

       $dun  = Dun::where('fk_parlimen',$parlimenid)->get();

       return view('site::system.dun',compact('dun'));

    }
     public function mukim($daerahid)
    {

       $mukim  = Mukim::where('fk_daerah',$daerahid)->get();

       return view('site::system.mukim',compact('mukim'));

    }
    public function induk($parlimen,$dun,$daerah,$mukim)
    {


         $getinduk  = Kampung::where('fk_parlimen',$parlimen)
                          ->where('fk_dun',$dun)
                          ->where('fk_daerah',$daerah)
                          ->where('fk_mukim',$mukim)
                          ->whereNull('IdKampungInduk')
                          ->where('status',1)
                          ->get();

       


       return view('site::system.induk',compact('getinduk'));

    }
    public function savekampung(Request $request)
    {

             $savekampung =  $this->repos->savekampung($request);

           return redirect::to('/site/kampung/index')->withSuccess(__('Data telah berjaya dikemaskini'));

    }
    public function editkampung($id){

            $id=$id;
            
            $kampung=Kampung::with('parlimen','dun','daerah','mukim','catpetempatan','kgtradisonal')->where('id',$id)->first();

         
            $parlimen=Parlimen::where('status',1)->get();
            $dun=Dun::where('status',1)->get();
            $daerah=Daerah::where('status',1)->get();
            $catpenempatan=LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();
            $jeniskampung=LkpDetail::where('status',1)->where('fk_lkp_master',28)->get();

             $dunedit=Dun::where('status',1)->where('fk_parlimen',data_get($kampung,'fk_parlimen'))->get();
              $mukimedit  = Mukim::where('status',1)->where('fk_daerah',data_get($kampung,'fk_daerah'))->get();
            return view('site::system.kampung.editkampung',compact('kampung','id','parlimen','daerah','catpenempatan','jeniskampung','dun','dunedit','mukimedit'));

    }
    public function saveeditkampung(Request $request)
    {

             $saveeditkampung =  $this->repos->saveeditkampung($request);

           return redirect::to('/site/kampung/index')->withSuccess(__('Data telah berjaya dikemaskini'));

    }
    public function viewkampung($id){

            $id=$id;
            
            $kampung=Kampung::with('parlimen','dun','daerah','mukim','catpetempatan','kgtradisonal')->where('id',$id)->first();

         
            $parlimen=Parlimen::find(data_get($kampung,'fk_parlimen'));
            $dun=Dun::find(data_get($kampung,'fk_dun'));
            $daerah=Daerah::find(data_get($kampung,'fk_daerah'));
            $catpenempatan=LkpDetail::find(data_get($kampung,'KategoriPetempatan'));
            $jeniskampung=LkpDetail::find(data_get($kampung,'JenisKgTradisional'));
            $dunedit=Dun::find(data_get($kampung,'fk_dun'));
            $mukimedit  = Mukim::find(data_get($kampung,'fk_mukim'));

            $kampunginduk=Kampung::find(data_get($kampung,'IdKampungInduk'));
            return view('site::system.kampung.viewkampung',compact('kampung','id','parlimen','daerah','catpenempatan','jeniskampung','dun','dunedit','mukimedit','kampunginduk'));

    }
    public function indexpermission()
    {
       

           $permissions = config('laravolt.epicentrum.models.permission')::whereRaw("name like '%manage-app-%'")->orwhereRaw("name like '*'")->get();

             // $permissions = config('laravolt.sepicentrum.models.permission')::get();

        return view('laravolt::permissions.edit', compact('permissions'));
    }

    public function updatepermission()
    {
        foreach (request('permission', []) as $key => $description) {
            config('laravolt.epicentrum.models.permission')::whereId($key)->update(['description' => $description]);
        }

        return redirect()->back()->withSuccess('Kebenaran Pengguna telah dikemaskini');
    }
    public function indexrole()
    {
        //$roles = $this->repository->all();

      $roles = $this->rolerepository->all();

      //dd($roles);

        return view('laravolt::roles.index', compact('roles'));
    }

    public function rolecreate()
    {
        $permissions = config('laravolt.epicentrum.models.permission')::whereRaw("name like '%manage-app-%'")->orwhereRaw("name like '*'")->get();
       //$permissions = config('laravolt.epicentrum.models.permission')::get();

        return view('laravolt::roles.create', compact('permissions'));
    }
    public function rolestore(storerole $request)
    {
        $role = $this->rolerepository->create($request->all());

        return redirect()->route('site::roles.index')->withSuccess(trans('Peranan Telah Ditambah'));
    }

     public function rolesedit($id)
    {
        $role = $this->rolerepository->findById($id);
        $permissions = config('laravolt.epicentrum.models.permission')::whereRaw("name like '%manage-app-%'")->orwhereRaw("name like '*'")->get();
         // $permissions = config('laravolt.epicentrum.models.permission')::get();
        $assignedPermissions = old('permissions', $role->permissions()->pluck('id')->toArray());

        return view('laravolt::roles.edit', compact('role', 'permissions', 'assignedPermissions','id'));
    }
    public function rolesdestroy(Request $request)
    {
  

        $this->rolerepository->delete($request->idrole);

        return redirect()->route('site::roles.index')->withSuccess(trans('Peranan telah Dipadam'));
    }
    public function rolesupdate(Request $request)
    {


       $table = app(config('laravolt.epicentrum.models.role'))->getTable();

       $validator = Validator::make($request->all(), [
   
              'name'        => "required|unique:$table,name,$request->idrole",
        ]);
       
        if($validator->fails()) {
           return back()->withErrors($validator)->withInput($request->all());
        }else{

           $role = $this->rolerepository->update($request->idrole, $request->all());
        return redirect()->route('site::roles.index')->withSuccess(trans('Peranan telah Dikemaskini'));

        }
       
    }
    public function getmukim($daerahid)
    {

       $mukim  = Mukim::where('fk_daerah',$daerahid)->get();

       return view('laravolt::users.mukim',compact('mukim'));

    }
    public function auditlogindex()
    {

      $user=Users::all();
      $role=AclRoles::all();
      
      return view('site::system.auditlog.index',compact('user','role'));
     //return view('dashboard::dashboard.index');


    }
    public function searchlog(Request $request)
    {
        

          $user     = $request->user;
          $datefrom = $request->dateform;
          $dateto   = $request->dateto;
          $kat      = $request->kat;

           $result = $this->repos->resultsearch($user,$datefrom,$dateto,$kat);


         return view('site::system.auditlog.searchresult',compact('result','user','datefrom','dateto','kat'));

    }
    public function searchusers($idrole)
    {
         $result = Users::whereHas('user_role', function ($query) use ($idrole) {
                          return $query->where('role_id', '=', $idrole);
                      })->get();

         return view('site::system.auditlog.searchusers',compact('result'));

    }
     public function exportauditlog($type,$user,$datefrom,$dateto,$kat)
    {


      
    


           
    if($type=='2'){//excel

            $collectionparam = collect([$user,$datefrom,$dateto,$kat]);

        return Excel::download(new ExportAuditLogController($collectionparam,$this->repos), 'LAPORAN_AUDIT_LOG.xlsx');

      }else{//pdf


        $data=$this->repos->resultsearch($user,$datefrom,$dateto,$kat);




      if($user==0){
            $user_p='';
        }else{
            $user_p=Users::find($user);
        }

        if($datefrom==0){
            $datefrom_p='';
        }else{
            $datefrom_p=date('d-m-Y', strtotime($datefrom));
        }

        if($dateto==0){
            $dateto_p='';
        }else{
            $dateto_p=date('d-m-Y', strtotime($dateto));
        }

        if($kat==0){
            $jenis_kat='';
        }else{
            $jenis_kat=AclRoles::find($kat);
        }



          $data = [

                'user_p' => data_get($user_p,'name'),
                'datefrom_p' => $datefrom_p,
                'dateto_p' => $dateto_p,
                'jenis_kat' => data_get($jenis_kat,'name'),
                'data'=>$data,
                 'date'  => date('d-m-Y'),
                'title'=>'Laporan Audit Log'
                
            ];



         $pdf = PDF::loadView('site::system.auditlog.pdfAuditlog', $data);
         $pdf->setPaper('A4', 'landscape');
            return $pdf->download('LAPORAN_AUDIT_LOG.pdf');



      }

    }








}