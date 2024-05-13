<?php

namespace App\Data\Repo;

use App\Models\ApiReport;
use App\Models\Comlist;
use App\Models\LkpTemplate;
use App\Models\MngAnnouncement;
use App\Models\MngAnswer;
use App\Models\MngApp;
use App\Models\Mngfeedback;
use App\Models\MngHelp;
use App\Models\MngMobile;
use App\Models\MngQuestion;
use App\Models\MngService;
use App\Models\PplnDetail;
use App\Models\PplnMain;
use App\Models\TaxCp500;
use App\Models\TaxElejar;
use App\Models\TaxElejarDetail;
use App\Models\TaxElejarDetailCalendar;
use App\Models\TaxElejarDetailCurrent;
use App\Models\TaxEspc;
use App\Models\TaxInbox;
use App\Models\TaxPcbDetailCalendar;
use App\Models\TaxPcbDetailTahun;
use App\Models\TaxProfile;
use App\User;
use Auth;
use Carbon\Carbon;
use Curl;
use DateTime;
use DB;
use File;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

/**
 * @author
 **/
class BorangRepo
{
    public function addpendapatan($id, $type, $profile, $com, $user, $request)
    {

        //search exsisting incometax no

        $exsist = PplnMain::where('fk_users', $id)->where('type', $type)->count();

        $exsistmain = PplnMain::where('fk_users', $id)->where('type', $type)->first();

        if ($exsist == 1) {
            if ($request->tarikh_terima == '01/01/1970') {
                $tarikh_terima = '';
            } else {
                $tarikh_terima = $request->tarikh_terima;
            }

            $addexsistmain = new PplnDetail;
            $addexsistmain->fk_ppln_main = $exsistmain->id;
            $addexsistmain->fk_lkp_kod_pendapatan = $request->kod_pendapatan;
            $addexsistmain->fk_lkp_kod_jenis_remitan = $request->kod_remit;
            $addexsistmain->date_remit = $request->tarikh_remit;
            $addexsistmain->date_bank_lulus = $tarikh_terima;
            $addexsistmain->fk_lkp_country_code = $request->kod_negara;
            $addexsistmain->total = $request->amoun_remit;
            $addexsistmain->com_id = data_get($com, 'No_Rujukan');
            $addexsistmain->save();

            //update total peremitan

            $total_detail = PplnDetail::where('fk_ppln_main', data_get($exsistmain, 'id'))->sum('total');

            $update_total = PplnMain::find(data_get($exsistmain, 'id'));
            $update_total->total_peremitan = $total_detail;
            $update_total->save();
        } else {//not exsist

            if ($request->tarikh_terima == '01/01/1970') {
                $tarikh_terima = '';
            } else {
                $tarikh_terima = $request->tarikh_terima;
            }

            $addpendapatan = new PplnMain;
            $addpendapatan->fk_users = $id;
            $addpendapatan->type = $type;
            $addpendapatan->tax_payer_name = $user->name;
            $addpendapatan->incometax_no = $user->tax_no;
            $addpendapatan->tax_payer_reference_no = $user->reference_id;
            $addpendapatan->phone_no = $profile->homephone_no;
            $addpendapatan->handphone_no = $profile->handphone_no;
            $addpendapatan->email = $user->email;
            $addpendapatan->save();

            $adddetail = new PplnDetail;
            $adddetail->fk_ppln_main = $addpendapatan->id;
            $adddetail->fk_lkp_kod_pendapatan = $request->kod_pendapatan;
            $adddetail->fk_lkp_kod_jenis_remitan = $request->kod_remit;
            $adddetail->date_remit = $request->tarikh_remit;
            $addexsistmain->date_bank_lulus = $tarikh_terima;
            $addexsistmain->fk_lkp_country_code = $request->kod_negara;
            $adddetail->total = $request->amoun_remit;
            $adddetail->com_id = data_get($com, 'No_Rujukan');
            $adddetail->save();

            $total_detail = PplnDetail::where('fk_ppln_main', $addpendapatan->id)->sum('total');

            $update_total = PplnMain::find($addpendapatan->id);
            $update_total->total_peremitan = $total_detail;
            $update_total->save();
        }
    }

    public function data_remit_detail($id, $comid, $type)
    {
        if ($type == 1) {//individu
            $main = PplnMain::where('fk_users', $id)->where('type', $type)->first();

            $listdetail = PplnDetail::where('fk_ppln_main', data_get($main, 'id'))->with('lkp_kod_pendapatan', 'lkp_kod_jenis_remitan', 'lkp_country_code')->get();
        } else {
            $main = PplnMain::where('fk_users', $id)->where('type', $type)->first();

            $listdetail = PplnDetail::where('fk_ppln_main', data_get($main, 'id'))->where('com_id', $comid)->with('lkp_kod_pendapatan', 'lkp_kod_jenis_remitan', 'lkp_country_code')->get();
        }

        return $listdetail;
    }

    public function total_pendapatan($id, $comid, $type)
    {
        $main = PplnMain::where('fk_users', $id)->where('type', $type)->first();

        if ($type == 1) {//individu

            $total_detail = PplnDetail::where('fk_ppln_main', data_get($main, 'id'))->sum('total');
        } else {//ade company

            $total_detail = PplnDetail::where('fk_ppln_main', data_get($main, 'id'))->where('com_id', $comid)->sum('total');
        }

        return $total_detail;
    }

    public function editpendapatan($id, $type, $comid, $request)
    {
        $updatedetail = PplnDetail::find($request->iddetail);

        //$updatedetail->fk_ppln_main = $exsistmain->id;
        $updatedetail->fk_lkp_kod_pendapatan = $request->ekod_pendapatan;
        $updatedetail->fk_lkp_kod_jenis_remitan = $request->ekod_remit;
        $updatedetail->date_remit = $request->etarikh_remit;
        $updatedetail->date_bank_lulus = $request->etarikh_terima;
        $updatedetail->fk_lkp_country_code = $request->ekod_negara;
        $updatedetail->total = $request->eamoun_remit;
        $updatedetail->save();

        $update_total = PplnMain::where('fk_users', $id)->where('type', $type)->first();

        $total_detail = PplnDetail::where('fk_ppln_main', data_get($update_total, 'id'))->sum('total');

        $update_total->total_peremitan = $total_detail;
        $update_total->save();
    }

    public function delete_apply($iddetail, $id, $type)
    {
        $delete_apply = PplnDetail::find($iddetail);

        //$updatedetail->fk_ppln_main = $exsistmain->id;
        $delete_apply->delete();

        //sum total

        $update_total = PplnMain::where('fk_users', $id)->where('type', $type)->first();

        $total_detail = PplnDetail::where('fk_ppln_main', data_get($update_total, 'id'))->sum('total');

        $update_total->total_peremitan = $total_detail;
        $update_total->save();
    }

    public function main_ppln($id, $type)
    {
        $main = PplnMain::where('fk_users', $id)->where('type', $type)->first();

        return $main;
    }
}
