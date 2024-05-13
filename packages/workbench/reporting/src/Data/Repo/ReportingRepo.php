<?php

namespace Workbench\Reporting\Data\Repo;

use App\Events\AuditLog;
use Auth;
use Carbon\Carbon;
use DB;
use Event;
use File;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Workbench\Site\Model\Lookup\AclRoles;
use Workbench\Site\Model\Lookup\AclRoleUser;
use Workbench\Site\Model\Lookup\Users;

/**
 * @laravolt reporting
 * @author apip
 **/
class ReportingRepo
{
    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function resultAjax($request)
    {
        $name = data_get($request, 'nama'); 	// nama
        $jawa = data_get($request, 'jawatan'); 	// jawatan
        $role = data_get($request, 'role'); 	// role
        $dept = data_get($request, 'dept'); 	// dept

        // dd($name, $jawa, $role, $dept);exit;

        $data = Users::with('user_role.acl_roles')
                     ->where(function ($query) use ($name) {
                         if ($name != 'nama') {
                             $query->where('name', 'like', '%'.$name.'%');
                         } else {
                         }
                     })
                     ->where(function ($query) use ($jawa) {
                         if ($jawa != 'jawatan') {
                             $query->where('jawatan', 'like', '%'.$jawa.'%');
                         } else {
                         }
                     })
                     ->where(function ($query) use ($dept) {
                         if ($dept != 'dept') {
                             $query->where('jabatan', 'like', '%'.$dept.'%');
                         } else {
                         }
                     })
                     ->where('status', 'INACTIVE')
                     ->whereHas('user_role', function ($query) use ($role) {
                         if ($role != 'role') {
                             $query->where('role_id', '=', $role);
                         } else {
                         }
                     })
                     ->orderBy('created_at')
                     ->get();

        // dd($data);exit;

        return $data;
    }

    public function resultPdf($request)
    {
        $name = data_get($request, 'nama'); 	// nama
        $jawa = data_get($request, 'jawatan'); 	// jawatan
        $role = data_get($request, 'role'); 	// role
        $dept = data_get($request, 'dept'); 	// dept

        // dd($name, $jawa, $role, $dept);exit;

        $data = Users::with('user_role.acl_roles')
                     ->where(function ($query) use ($name) {
                         if ($name != 'nama') {
                             $query->where('name', 'like', '%'.$name.'%');
                         } else {
                         }
                     })
                     ->where(function ($query) use ($jawa) {
                         if ($jawa != 'jawatan') {
                             $query->where('jawatan', 'like', '%'.$jawa.'%');
                         } else {
                         }
                     })
                     ->where(function ($query) use ($dept) {
                         if ($dept != 'dept') {
                             $query->where('jabatan', 'like', '%'.$dept.'%');
                         } else {
                         }
                     })
                     ->where('status', 'INACTIVE')
                     ->whereHas('user_role', function ($query) use ($role) {
                         if ($role != 'role') {
                             $query->where('role_id', '=', $role);
                         } else {
                         }
                     })
                     ->orderBy('created_at')
                     ->get();

        // dd($data);exit;

        return $data;
    }

    // start lookup table ------------------------------------------------

    // plucking
    public function roleDesc()
    {
        $role = AclRoles::get();

        return $role;
    }
    // public function lkpDetailKategoriProduk()
    // {
    // 	return LkpDetail::where('fk_lkp_master', 7)
    // 					->where('status', 1)
    // 					->get();
    // }
    // public function lkpMenu()
    // {
    // 	return Menum::where('status', 1)
    // 				->get();
    // }
} //end of class
