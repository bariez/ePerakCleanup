<?php

namespace Workbench\Site\Http\Controllers;

use Carbon\Carbon;
use DB;
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
use Mail;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Redirect;
use Workbench\Site\Data\Repo\SiteRepo;
use Workbench\Site\Model\Application\ApplicationSetup;
use Workbench\Site\Model\Lookup\AclRoles;
use Workbench\Site\Model\Lookup\AclRoleUser;
use Workbench\Site\Model\Lookup\UserAccessLog;
use Workbench\Site\Model\Lookup\Users;

class ExportAuditLogController extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, ShouldAutoSize, FromView, WithDrawings
{
    protected $collectionparam;

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('e-Perak');
        $drawing->setPath(public_path('logo.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function __construct(Collection $collectionparam, SiteRepo $repos)
    {
        $this->user = $collectionparam[0];
        $this->datefrom = $collectionparam[1];
        $this->dateto = $collectionparam[2];
        $this->kat = $collectionparam[3];

        $this->repos = $repos;
    }

    // public function view(): View
    // {
//     return view('admin.feedback.excelfeedback', [
//         'params' =>  $this->collectionparam,
//     ]);
    //  }

    public function view(): View
    {
        $user = $this->user;
        $datefrom = $this->datefrom;
        $dateto = $this->dateto;
        $kat = $this->kat;

        $data = $this->repos->resultsearch($user, $datefrom, $dateto, $kat);

        if ($user == 0) {
            $user_p = '';
        } else {
            $user_p = Users::find($user);
        }

        if ($datefrom == 0) {
            $datefrom_p = '';
        } else {
            $datefrom_p = date('d-m-Y', strtotime($datefrom));
        }

        if ($dateto == 0) {
            $dateto_p = '';
        } else {
            $dateto_p = date('d-m-Y', strtotime($dateto));
        }

        if ($kat == 0) {
            $jenis_kat = '';
        } else {
            $jenis_kat = AclRoles::find($kat);
        }

        $filter = [
            'user_p' => data_get($user_p, 'name'),
            'datefrom_p' => $datefrom_p,
            'dateto_p' => $dateto_p,
            'jenis_kat' => data_get($jenis_kat, 'name'),

        ];

        return view('site::system.auditlog.excelAuditlog', [
            'data'=>$data,
            'filter' => $filter,
            'date'  => date('d-m-Y'),
            'title'=>'Audit Log',

        ]);
    }
}
