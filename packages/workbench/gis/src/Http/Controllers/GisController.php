<?php

namespace Workbench\Gis\Http\Controllers;

use App\Mail\StatusAccept;
use App\Mail\StatusReject;
use Carbon\Carbon;
use Curl;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Mail;
use Redirect;
use Workbench\Gis\Data\Repo\GisRepo;

class GisController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        dd('sini');
        //return view('dashboard::dashboard.index');
    }
}
