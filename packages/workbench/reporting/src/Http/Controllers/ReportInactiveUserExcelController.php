<?php

namespace Workbench\Reporting\Http\Controllers;

use Auth;
use Carbon\Carbon;
use DB;
use Event;
use File;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Ixudra\Curl\Facades\Curl;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use PDF;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Redirect;
use Workbench\Reporting\Data\Repo\ReportingRepo;
use Workbench\Site\Model\Lookup\AclRoles;
use Workbench\Site\Model\Lookup\AclRoleUser;
use Workbench\Site\Model\Lookup\Users;

class ReportInactiveUserExcelController extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, ShouldAutoSize, FromView //,WithDrawings
{
    public function view() : View
    {
        $name = request()->nama;
        $jawa = request()->jawatan;
        $role = request()->role;
        $dept = request()->dept;

        // dd($name, $jawa, $role, $dept);exit;

        $data = Users::with('user_role.acl_roles')
                     ->where(function ($query) use ($name) {
                         if ($name != 'nama') {
                             $query->where('name', 'like', '%'.$name.'%');
                         } else {
                             $query;
                         }
                     })
                     ->where(function ($query) use ($jawa) {
                         if ($jawa != 'jawatan') {
                             $query->where('jawatan', 'like', '%'.$jawa.'%');
                         } else {
                             $query;
                         }
                     })
                     ->where(function ($query) use ($dept) {
                         if ($dept != 'dept') {
                             $query->where('jabatan', 'like', '%'.$dept.'%');
                         } else {
                             $query;
                         }
                     })
                     ->where('status', 'INACTIVE')
                     ->whereHas('user_role', function ($query) use ($role) {
                         if ($role != 'role') {
                             $query->where('role_id', '=', $role);
                         } else {
                             $query;
                         }
                     })
                     ->orderBy('created_at')
                     ->get();

        // dd($data);exit;

        return view('reporting::reporting.userlogin.excel', compact('data'));
    }
}
