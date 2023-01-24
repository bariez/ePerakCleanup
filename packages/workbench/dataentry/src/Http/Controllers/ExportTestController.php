<?php

namespace Workbench\Dataentry\Http\Controllers;

use Illuminate\Routing\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Workbench\Report\Data\Repo\ReportLicenseAppRepo;
use Ixudra\Curl\Facades\Curl;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;






use File;
use Redirect;
use Mail;


class ExportTestController extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder,ShouldAutoSize,FromView
{


 
 protected $collectionparam;

    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setName('Logo');
    //     $drawing->setDescription('ELESEN');
    //     $drawing->setPath(public_path('logo.png'));
    //     $drawing->setHeight(90);
    //     $drawing->setCoordinates('A1');

    //     return $drawing;
    // }


 public function __construct(Collection $collectionparam) {

            $this->type = $collectionparam[0];
           
        }



// public function view(): View
// {
//     return view('admin.feedback.excelfeedback', [
//         'params' =>  $this->collectionparam,
//     ]);
//  }

public function view(): View
{
    

    $type = $this->type;
   
     return view('dataentry::searchkampung.exceltest', [
                'type'=>$type,


            ]);

       


}
 
}
