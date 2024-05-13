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
class SearchRepo
{
    public function api_profile($request)
    {
        try {
            $response = Curl::to(env('API_DOMAIN').'/SSOService.svc/user/getprofile')
            ->withData(
                [
                    'idno' => $request->idenno,
                    'idtype' => $request->idtype,
                ]
            )
                ->returnResponseObject()
                ->get();

            $data = json_decode($response->content);

            $datatest = [

                'idno' => $request->idenno,
                'idtype' => $request->idtype,
                'API URL' => env('API_DOMAIN').'/SSOService.svc/user/getprofile',
                'result' => $data,

            ];
            // dd($datatest);

            if ($data) {
                if ($data == false) {
                    return 1;
                } elseif (($data->RefId == null) or ($data->Name == null)) {
                    return 1;
                } elseif ($data->TaxRefNo == null) {
                    // dd('sini');
                    //return 1;
                    $user = User::where('reference_id', '=', $request->idenno)->first();
                    if ($user) {
                        $usersearcher = auth()->user();
                        $lang = $usersearcher->language;
                        $user->language = $lang;
                        if (isset($request->tax)) {
                            $user->tax_no = $request->tax;
                        }

                        $user->update();
                    } else {
                        // $pieces = explode(" ", $data->TaxRefNo);

                        // $noru = ltrim($pieces[1], '0');
                        // if(strlen($noru) > 8)
                        // {
                        //     $newrujukan = $noru;
                        // }else
                        // {
                        //     $newrujukan = '0'.$noru;
                        // }

                        $usersearcher = auth()->user();
                        $lang = $usersearcher->language;

                        $users = new User;
                        $users->name = $request->name;
                        $users->email = $request->email;
                        $users->reference_id = $request->idenno;
                        $users->reference_type = $request->idtype;
                        $users->tax_no = $request->tax;
                        $users->doc_type = '';
                        $users->language = $lang;
                        $users->save();
                    }

                    return $data;
                } else {
                    $pieces = explode(' ', $data->TaxRefNo);

                    $noru = ltrim($pieces[1], '0');
                    if (strlen($noru) > 8) {
                        $newrujukan = $noru;
                    } else {
                        $newrujukan = '0'.$noru;
                    }

                    $user = User::where('reference_id', '=', $request->idenno)->first();
                    if ($user) {
                        $usersearcher = auth()->user();
                        $lang = $usersearcher->language;
                        $user->language = $lang;
                        $user->tax_no = $newrujukan;
                        $user->doc_type = $pieces[0];
                        $user->update();
                    } else {
                        $pieces = explode(' ', $data->TaxRefNo);

                        $noru = ltrim($pieces[1], '0');
                        if (strlen($noru) > 8) {
                            $newrujukan = $noru;
                        } else {
                            $newrujukan = '0'.$noru;
                        }

                        $usersearcher = auth()->user();
                        $lang = $usersearcher->language;

                        $users = new User;
                        $users->name = str_replace('+', ' ', $data->Name);
                        $users->email = $data->Email;
                        $users->reference_id = $request->idenno;
                        $users->reference_type = $request->idtype;
                        $users->tax_no = $newrujukan;
                        $users->doc_type = $pieces[0];
                        $users->language = $lang;
                        $users->save();
                    }

                    return $data;
                }
            }
        } catch (RequestException $e) {
            return [];
        }
    }

    public function api_profile_page($request)
    {
        try {
            $user = User::where('reference_id', '=', $request->idenno)->first();
            $response = Curl::to(env('API_DOMAIN').'/SSOService.svc/user/getprofile')
            ->withData(
                [
                    'idno' => $user->reference_id,
                    'idtype' => $user->reference_type,
                ]
            )
                ->returnResponseObject()
                ->get();

            $data = json_decode($response->content);
            // dd($data);

            if ($data) {
                if ($data == false) {
                    return $data = [];
                }
            }

            return $data;
        } catch (RequestException $e) {
            return $data = [];
        }
    }

    public function api_profile_add($request)
    {
        try {
            $users = User::where('reference_id', '=', $request->idenno)->first();

            $user = User::where('id', '=', $users->id)->first();
            // dd($user);

            $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
            $randnumber = rand(1000000000, 2000000000);
            $epoch = time();
            $sekatan = '1';
            $baki = '0.00';
            $refund = '0.00';
            $inbox = 0;

            $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
            $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
            $nonce = $randnumber;
            $string = $userid.$key.$nonce.$epoch;
            $token = hash_hmac('sha256', $string, $key);

            $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

            $response = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/LejarMyProfile')
                              ->withData(
                                  [
                                      'JnsSijil' => $user->doc_type,
                                      'NoRujukan' => $user->tax_no,
                                  ]
                              )
                                ->withHeaders(['ApiAuthorization:'.$auth])
                                ->returnResponseObject()
                                 ->post();

            $returns = json_decode($response->content);

            $datas = [
                'API' => 'https://mytax2.hasil.gov.my/MyTaxApi/api/LejarMyProfile',

                'JnsSijil' => $user->doc_type,
                'NoRujukan' => $user->tax_no,
                'result' => $returns,
            ];

            // dd($datas);

            // dd($returns);

            if ($returns) {
                if ($returns == false) {
                    return 1;
                }
                if ($returns->Success == false) {
                    return 1;
                }
                $data = $returns->Model->LejarMyProfile;
                $user = User::where('reference_id', '=', $user->reference_id)->first();
                if ($data->E_MAIL == '') {
                } else {
                    $user->email = $data->E_MAIL;
                }
                if ($data->NAMA == '') {
                } else {
                    $user->name = $data->NAMA;
                }
                if ($data->NOCUKAI == '') {
                } else {
                    $user->tax_no = substr($data->NOCUKAI, 2);
                    $user->doc_type = substr($data->NOCUKAI, 0, 2);
                }

                $user->update();

                $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
                if ($checkprofile) {
                    $add = $data->LINE_1.''.$data->LINE_2.''.$data->LINE_3.''.$data->POSTCODE.''.$data->CITY.''.$data->STATE;
                    if ($add !== '') {
                        $checkprofile->address = $data->LINE_1.' '.$data->LINE_2.' '.$data->LINE_3.' '.$data->POSTCODE.' '.$data->CITY.' '.$data->STATE;
                    }

                    if ($data->MOBILE_PHONE_NO) {
                        $checkprofile->handphone_no = $data->MOBILE_PHONE_NO;
                    }

                    if ($data->PHONE_NO) {
                        $checkprofile->homephone_no = $data->PHONE_NO;
                    }

                    $checkprofile->update();
                } else {
                    $add = $data->LINE_1.''.$data->LINE_2.''.$data->LINE_3.''.$data->POSTCODE.''.$data->CITY.''.$data->STATE;

                    $profile = new TaxProfile;
                    $profile->fk_users = $user->id;
                    if ($add !== '') {
                        $profile->address = $data->LINE_1.' '.$data->LINE_2.' '.$data->LINE_3.' '.$data->POSTCODE.' '.$data->CITY.' '.$data->STATE;
                    }
                    if ($data->MOBILE_PHONE_NO) {
                        $profile->handphone_no = $data->MOBILE_PHONE_NO;
                    }

                    if ($data->PHONE_NO) {
                        $profile->homephone_no = $data->PHONE_NO;
                    }

                    $profile->save();
                }
            }

            return $returns;
        } catch (RequestException $e) {
            return $e;
        }
    }

    public function api_comlist($request)
    {
        $users = User::where('reference_id', '=', $request->idenno)->first();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();

        $datacom = Comlist::where('fk_users', '=', $id)->delete();
        if ($user->reference_id == '740406145191') {
            $idno = '830708025338';
            $idtype = '1';
        } else {
            $idno = $user->reference_id;
            $idtype = $user->reference_type;
        }

        $responserefunds = Curl::to(env('API_DOMAIN').'/SSOService.svc/user/getoeflist')
            ->withData(
                [
                    'idno' => $idno, //'830708025338',//$user->reference_id,
                    'idtype' => $idtype, //'1'//$user->reference_type
                ]
            )
            ->returnResponseObject()
            ->get();

        $contentrefund = $responserefunds->content;
        $responsrefund = json_decode($contentrefund);

        // dd($responserefunds);

        $datacom = Comlist::where('fk_users', '=', $id)->delete();

        if ($responsrefund) {
            if ($responsrefund == false) {
                return 0;
            }
            foreach ($responsrefund as $key => $value) {
                $datacom = Comlist::where('fk_users', '=', $id)->where('No_Rujukan', '=', $value->No_Rujukan)->first();
                if ($value->No_Rujukan) {
                    $newdata = new Comlist;
                    $newdata->fk_users = $id;
                    $newdata->Jenis_File = $value->Jenis_File;
                    $newdata->Nama_Syarikat = $value->Nama_Syarikat;
                    $newdata->No_Roc = $value->No_Roc;
                    $newdata->No_Rujukan = $value->No_Rujukan;
                    $newdata->Status_OeF = $value->Status_OeF;
                    $newdata->Tarikh_Daftar = $value->Tarikh_Daftar;
                    $newdata->save();
                }
                // code...
            }
        } else {

            // dd('xde');
        }
    }

    public function api_elejar($request)
    {
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();

        $user = User::where('reference_id', '=', $request->idenno)->first();
        $id = $user->id;

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $noru = ltrim($user->tax_no, '0');
        if (strlen($noru) > 8) {
            $newrujukan = $noru;
        } else {
            $newrujukan = '0'.$noru;
        }

        $responselejars = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/LejarPaparanTerperinci')
          ->withData(
              [
                  'JnsSijil' => $user->doc_type, //'SG',//
                  'NoRujukan' =>  $noru, //'00100938090'//
              ]
          )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentlejar = $responselejars->content;
        $responselejar = json_decode($contentlejar);

        // dd($responselejar);
        if (isset($responselejar->Message)) {
            $report = ApiReport::where('api_id', '=', '5')->first();
            if ($report) {
                $report->api_error = $responselejar->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 5;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/LejarPaparanTerperinci';
                $newreport->api_error = $responselejar->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if (isset($responselejar->ErrorMessage)) {
            $report = ApiReport::where('api_id', '=', '5')->first();
            if ($report) {
                $report->api_error = $responselejar->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 5;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/LejarPaparanTerperinci';
                $newreport->api_error = $responselejar->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if (isset($responselejar->Success)) {
            if ($responselejar->Success == false) {
                $report = ApiReport::where('api_id', '=', '5')->first();
                if ($report) {
                    $report->api_error = $responselejar;
                    $report->date = date('Y-m-d h:i:s');
                    $report->update();
                } else {
                    $newreport = new ApiReport;
                    $newreport->api_id = 5;
                    $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/LejarPaparanTerperinci';
                    $newreport->api_error = $responselejar;
                    $newreport->date = date('Y-m-d h:i:s');
                    $newreport->save();
                }

                return 0;
            }
        }

        if ($responselejar == false) {
            $report = ApiReport::where('api_id', '=', '5')->first();
            if ($report) {
                $report->api_error = $responselejars->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 5;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/LejarPaparanTerperinci';
                $newreport->api_error = $responselejars->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        $report = ApiReport::where('api_id', '=', '5')->delete();

        $model = $responselejar->Model;
        $income = $model->LejarBakiCukaiInd;
        $properties = $model->LejarBakiCukaiCKHT;
        $arrayclosing = $model->LejarBakiPenutup;
        $arraycalendar = $model->LejarPaparanTerperinci_TahunKalendar;
        $arraycurrent = $model->LejarPaparanTerperinci_TahunTaksiran;
        $profiledata = $model->LejarInfoPC;

        $arraypcbcal = $model->PenyataPCB_TahunKalendar;
        $arraypcbtak = $model->PenyataPCB_TahunTaksiran;

        $arrayclosingprop = $model->LejarBakiPenutupCKHT;
        $arraycalendarprop = $model->LejarPaparanTerperinciCKHT_TahunKalendar;
        $arraycurrentprop = $model->LejarPaparanTerperinciCKHT_TahunTaksiran;

        // dd($arraycalendar);

        $checkincome = TaxElejar::where('fk_users', '=', $id)->where('lejar_type', '=', 'INDIVIDU')->where('income_type', '=', 'SALARY')->delete();

        $profiledatacheck = TaxProfile::where('fk_users', '=', $id)->first();
        if ($profiledatacheck) {
            $profiledatacheck->IT_Collection_Branch = $profiledata->IT_Collection_Branch;
            $profiledatacheck->IT_Assm_Branch = $profiledata->IT_Assm_Branch;
            $profiledatacheck->CKHT_Assm_Branch = $profiledata->CKHT_Assm_Branch;
            $profiledatacheck->CKHT_Collection_Branch = $profiledata->CKHT_Collection_Branch;
            $profiledatacheck->Bank_CD = $profiledata->Bank_CD;
            $profiledatacheck->Bank_Acct_No = $profiledata->Bank_Acct_No;
            $profiledatacheck->Bank_Name = $profiledata->Bank_Name;
            $profiledatacheck->Name = $profiledata->Name;
            $profiledatacheck->IT_Grp_CD = $profiledata->IT_Grp_CD;
            $profiledatacheck->update();
        }

        $checarrayclosing = TaxElejarDetail::where('fk_users', '=', $id)->where('lejar_type', '=', 'INDIVIDU')->delete();
        foreach ($arrayclosing as $key => $vclosing) {
            $arrayclosingnew = new TaxElejarDetail;
            $arrayclosingnew->fk_users = $id;
            $arrayclosingnew->lejar_type = 'INDIVIDU';
            $arrayclosingnew->income_type = 'SALARY';
            $arrayclosingnew->ASSESSMENT_YEAR = $vclosing->ASSESSMENT_YEAR;
            $arrayclosingnew->JumTggnCukai = $vclosing->JumTggnCukai;
            $arrayclosingnew->JumBayaranCukai = $vclosing->JumBayaranCukai;
            $arrayclosingnew->JumBersih = $vclosing->JumBersih;
            $arrayclosingnew->ByrnBelumBolehGuna = $vclosing->ByrnBelumBolehGuna;
            $arrayclosingnew->BakiCukaiSemasa = $vclosing->BakiCukaiSemasa;
            $arrayclosingnew->save();
        }

        foreach ($arrayclosingprop as $key => $vclosing) {
            $arrayclosingnew = new TaxElejarDetail;
            $arrayclosingnew->fk_users = $id;
            $arrayclosingnew->lejar_type = 'INDIVIDU';
            $arrayclosingnew->income_type = 'PROPERTIES';
            $arrayclosingnew->ASSESSMENT_YEAR = $vclosing->ASSESSMENT_YEAR;
            $arrayclosingnew->JumTggnCukai = $vclosing->JumTggnCukai;
            $arrayclosingnew->JumBayaranCukai = $vclosing->JumBayaranCukai;
            $arrayclosingnew->JumBersih = $vclosing->JumBersih;
            $arrayclosingnew->ByrnBelumBolehGuna = $vclosing->ByrnBelumBolehGuna;
            $arrayclosingnew->BakiCukaiSemasa = $vclosing->BakiCukaiSemasa;
            $arrayclosingnew->save();
        }

        $checarraycalendar = TaxElejarDetailCalendar::where('fk_users', '=', $id)
                                                    ->delete();

        foreach ($arraycalendar as $key => $vcal) {
            $arraycalnew = new TaxElejarDetailCalendar;
            $arraycalnew->fk_users = $id;
            $arraycalnew->income_type = 'SALARY';
            $arraycalnew->Tahun = $vcal->Tahun;
            $arraycalnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
            $arraycalnew->ASSESSMENT_NOM = $vcal->ASSESSMENT_NOM;
            $arraycalnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
            $arraycalnew->SEQ_NO = $vcal->SEQ_NO;
            $arraycalnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
            $arraycalnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
            $arraycalnew->POSTED_DATE = $vcal->POSTED_DATE;
            $arraycalnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
            $arraycalnew->TYP = $vcal->TYP;
            $arraycalnew->AMT = $vcal->AMT;
            $arraycalnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
            $arraycalnew->TggnCukai = $vcal->TggnCukai;
            $arraycalnew->BayaranCukai = $vcal->BayaranCukai;
            $arraycalnew->DOC_NO = trim($vcal->DOC_NO);
            $arraycalnew->RECEIPT_NO = $vcal->RECEIPT_NO;
            $arraycalnew->Keterangan = $vcal->Keterangan;
            $arraycalnew->BRANCH_CODE = $vcal->BRANCH_CODE;
            $arraycalnew->JnsTransaksi = $vcal->JnsTransaksi;
            $arraycalnew->BakiCukai = $vcal->BakiCukai;

            $arraycalnew->NoLot = $vcal->NoLot;
            $arraycalnew->RECEIPT_NUM = $vcal->RECEIPT_NUM;
            $arraycalnew->RECT_NUM = $vcal->RECT_NUM;
            $arraycalnew->DOC_NUM = $vcal->DOC_NUM;

            $arraycalnew->save();
        }

        foreach ($arraycalendarprop as $key => $vcal) {
            $arraycalnew = new TaxElejarDetailCalendar;
            $arraycalnew->fk_users = $id;
            $arraycalnew->income_type = 'PROPERTIES';
            $arraycalnew->Tahun = $vcal->Tahun;
            $arraycalnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
            $arraycalnew->ASSESSMENT_NOM = $vcal->ASSESSMENT_NOM;
            $arraycalnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
            $arraycalnew->SEQ_NO = $vcal->SEQ_NO;
            $arraycalnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
            $arraycalnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
            $arraycalnew->POSTED_DATE = $vcal->POSTED_DATE;
            $arraycalnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
            $arraycalnew->TYP = $vcal->TYP;
            $arraycalnew->AMT = $vcal->AMT;
            $arraycalnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
            $arraycalnew->TggnCukai = $vcal->TggnCukai;
            $arraycalnew->BayaranCukai = $vcal->BayaranCukai;
            $arraycalnew->DOC_NO = trim($vcal->DOC_NO);
            $arraycalnew->RECEIPT_NO = $vcal->RECEIPT_NO;
            $arraycalnew->Keterangan = $vcal->Keterangan;
            $arraycalnew->BRANCH_CODE = $vcal->BRANCH_CODE;
            $arraycalnew->JnsTransaksi = $vcal->JnsTransaksi;
            $arraycalnew->BakiCukai = $vcal->BakiCukai;

            $arraycalnew->NoLot = $vcal->NoLot;
            $arraycalnew->RECEIPT_NUM = $vcal->RECEIPT_NUM;
            $arraycalnew->RECT_NUM = $vcal->RECT_NUM;
            $arraycalnew->DOC_NUM = $vcal->DOC_NUM;

            $arraycalnew->save();
        }

        $checarraycurrent = TaxElejarDetailCurrent::where('fk_users', '=', $id)->where('lejar_type', '=', 'INDIVIDU')
                                ->delete();

        foreach ($arraycurrent as $key => $vcal) {
            $arraycurrentnew = new TaxElejarDetailCurrent;
            $arraycurrentnew->fk_users = $id;
            $arraycurrentnew->lejar_type = 'INDIVIDU';
            $arraycurrentnew->income_type = 'SALARY';
            $arraycurrentnew->Tahun = $vcal->Tahun;
            $arraycurrentnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
            $arraycurrentnew->ASSESSMENT_NOM = $vcal->ASSESSMENT_NOM;
            $arraycurrentnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
            $arraycurrentnew->SEQ_NO = $vcal->SEQ_NO;
            $arraycurrentnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
            $arraycurrentnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
            $arraycurrentnew->POSTED_DATE = $vcal->POSTED_DATE;
            $arraycurrentnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
            $arraycurrentnew->TYP = $vcal->TYP;
            $arraycurrentnew->AMT = $vcal->AMT;
            $arraycurrentnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
            $arraycurrentnew->TggnCukai = $vcal->TggnCukai;
            $arraycurrentnew->BayaranCukai = $vcal->BayaranCukai;
            $arraycurrentnew->DOC_NO = trim($vcal->DOC_NO);
            $arraycurrentnew->RECEIPT_NO = $vcal->RECEIPT_NO;
            $arraycurrentnew->Keterangan = $vcal->Keterangan;
            $arraycurrentnew->BRANCH_CODE = $vcal->BRANCH_CODE;
            $arraycurrentnew->JnsTransaksi = $vcal->JnsTransaksi;
            $arraycurrentnew->BakiCukai = $vcal->BakiCukai;

            $arraycurrentnew->NoLot = $vcal->NoLot;
            $arraycurrentnew->RECEIPT_NUM = $vcal->RECEIPT_NUM;
            $arraycurrentnew->RECT_NUM = $vcal->RECT_NUM;
            $arraycurrentnew->DOC_NUM = $vcal->DOC_NUM;

            $arraycurrentnew->save();
        }

        foreach ($arraycurrentprop as $key => $vcal) {
            $arraycurrentnew = new TaxElejarDetailCurrent;
            $arraycurrentnew->fk_users = $id;
            $arraycurrentnew->lejar_type = 'INDIVIDU';
            $arraycurrentnew->income_type = 'PROPERTIES';
            $arraycurrentnew->Tahun = $vcal->Tahun;
            $arraycurrentnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
            $arraycurrentnew->ASSESSMENT_NOM = $vcal->ASSESSMENT_NOM;
            $arraycurrentnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
            $arraycurrentnew->SEQ_NO = $vcal->SEQ_NO;
            $arraycurrentnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
            $arraycurrentnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
            $arraycurrentnew->POSTED_DATE = $vcal->POSTED_DATE;
            $arraycurrentnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
            $arraycurrentnew->TYP = $vcal->TYP;
            $arraycurrentnew->AMT = $vcal->AMT;
            $arraycurrentnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
            $arraycurrentnew->TggnCukai = $vcal->TggnCukai;
            $arraycurrentnew->BayaranCukai = $vcal->BayaranCukai;
            $arraycurrentnew->DOC_NO = trim($vcal->DOC_NO);
            $arraycurrentnew->RECEIPT_NO = $vcal->RECEIPT_NO;
            $arraycurrentnew->Keterangan = $vcal->Keterangan;
            $arraycurrentnew->BRANCH_CODE = $vcal->BRANCH_CODE;
            $arraycurrentnew->JnsTransaksi = $vcal->JnsTransaksi;
            $arraycurrentnew->BakiCukai = $vcal->BakiCukai;

            $arraycurrentnew->NoLot = $vcal->NoLot;
            $arraycurrentnew->RECEIPT_NUM = $vcal->RECEIPT_NUM;
            $arraycurrentnew->RECT_NUM = $vcal->RECT_NUM;
            $arraycurrentnew->DOC_NUM = $vcal->DOC_NUM;

            $arraycurrentnew->save();
        }

        //pcb
        $arraypcbcalcheck = TaxPcbDetailCalendar::where('fk_users', '=', $id)
                                ->delete();

        foreach ($arraypcbcal as $key => $vcal) {
            $arraycalnew = new TaxPcbDetailCalendar;
            $arraycalnew->fk_users = $id;
            $arraycalnew->Tahun = $vcal->Tahun;
            $arraycalnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
            // $arraycalnew->ASSESSMENT_NOM = $vcal->ASSESSMENT_NOM;
            $arraycalnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
            $arraycalnew->SEQ_NO = $vcal->SEQ_NO;
            $arraycalnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
            $arraycalnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
            $arraycalnew->POSTED_DATE = $vcal->POSTED_DATE;
            $arraycalnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
            $arraycalnew->TYP = $vcal->TYP;
            $arraycalnew->AMT = $vcal->AMT;
            $arraycalnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
            $arraycalnew->TggnCukai = $vcal->TggnCukai;
            $arraycalnew->BayaranCukai = $vcal->BayaranCukai;
            $arraycalnew->DOC_NO = trim($vcal->DOC_NO);
            $arraycalnew->RECEIPT_NO = $vcal->RECEIPT_NO;
            $arraycalnew->Keterangan = $vcal->Keterangan;
            $arraycalnew->BRANCH_CODE = $vcal->BRANCH_CODE;
            $arraycalnew->JnsTransaksi = $vcal->JnsTransaksi;
            $arraycalnew->BakiCukai = $vcal->BakiCukai;

            $arraycalnew->NoLot = $vcal->NoLot;
            $arraycalnew->RECEIPT_NUM = $vcal->RECEIPT_NUM;
            $arraycalnew->RECT_NUM = $vcal->RECT_NUM;
            $arraycalnew->DOC_NUM = $vcal->DOC_NUM;

            $arraycalnew->save();
        }

        $arraypcbtakcheck = TaxPcbDetailTahun::where('fk_users', '=', $id)
                                ->delete();

        foreach ($arraypcbtak as $key => $vcal) {
            $arraycalnew = new TaxPcbDetailTahun;
            $arraycalnew->fk_users = $id;
            $arraycalnew->Tahun = $vcal->Tahun;
            $arraycalnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
            // $arraycalnew->ASSESSMENT_NOM = $vcal->ASSESSMENT_NOM;
            $arraycalnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
            $arraycalnew->SEQ_NO = $vcal->SEQ_NO;
            $arraycalnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
            $arraycalnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
            $arraycalnew->POSTED_DATE = $vcal->POSTED_DATE;
            $arraycalnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
            $arraycalnew->TYP = $vcal->TYP;
            $arraycalnew->AMT = $vcal->AMT;
            $arraycalnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
            $arraycalnew->TggnCukai = $vcal->TggnCukai;
            $arraycalnew->BayaranCukai = $vcal->BayaranCukai;
            $arraycalnew->DOC_NO = trim($vcal->DOC_NO);
            $arraycalnew->RECEIPT_NO = $vcal->RECEIPT_NO;
            $arraycalnew->Keterangan = $vcal->Keterangan;
            $arraycalnew->BRANCH_CODE = $vcal->BRANCH_CODE;
            $arraycalnew->JnsTransaksi = $vcal->JnsTransaksi;
            $arraycalnew->BakiCukai = $vcal->BakiCukai;

            $arraycalnew->NoLot = $vcal->NoLot;
            $arraycalnew->RECEIPT_NUM = $vcal->RECEIPT_NUM;
            $arraycalnew->RECT_NUM = $vcal->RECT_NUM;
            $arraycalnew->DOC_NUM = $vcal->DOC_NUM;

            $arraycalnew->save();
        }

        $newincome = new TaxElejar;
        $newincome->fk_users = $id;
        $newincome->lejar_type = 'INDIVIDU';
        $newincome->income_type = 'SALARY';
        $newincome->description = 'Cukai Pendapatan';
        $newincome->BakiCukai = $income->BakiCukai;
        $newincome->ByrnBelumBolehGuna = $income->ByrnBelumBolehGuna;
        $newincome->BakiLejar = $income->BakiLejar;
        $newincome->save();

        $checkprop = TaxElejar::where('fk_users', '=', $id)->where('lejar_type', '=', 'INDIVIDU')->where('income_type', '=', 'PROPERTIES')->delete();

        $newprop = new TaxElejar;
        $newprop->fk_users = $id;
        $newprop->lejar_type = 'INDIVIDU';
        $newprop->income_type = 'PROPERTIES';
        $newprop->description = 'Cukai Keuntungan Harta Tanah';
        $newprop->BakiCukai = $properties->BakiCukaiCKHT;
        $newprop->ByrnBelumBolehGuna = $properties->ByrnBelumBolehGunaCKHT;
        $newprop->BakiLejar = $properties->BakiLejarCKHT;
        $newprop->save();

        return 1;
    }

    public function api_elejarcomlist($ids)
    {
        $idc = $ids;

        $profiledatacheck = Comlist::where('id', '=', $idc)->first();
        $id = $profiledatacheck->fk_users;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $comprofile = Comlist::where('id', '=', $idc)->first();

        // dd($profiledatacheck);

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $noru = ltrim($comprofile->No_Rujukan, '0');
        if (strlen($noru) > 8) {
            $newrujukan = $noru;
        } else {
            $newrujukan = '0'.$noru;
        }
        // $responselejar = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/LejarPaparanTerperinci')
        // $responselejar = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarSenaraiSyarikat')
        // $responselejar = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCKHT')

        $responselejars = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarPaparanTerperinciSyarikat')
          ->withData(
              [
                  'JnsSijil' => $comprofile->Jenis_File,
                  'NoRujukan' => $newrujukan,
              ]
          )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentlejar = $responselejars->content;
        $responselejar = json_decode($contentlejar);

        // dd($responselejar);
        if (isset($responselejar->Message)) {
            $report = ApiReport::where('api_id', '=', '6')->first();
            if ($report) {
                $report->api_error = $responselejar->Message;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 6;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarPaparanTerperinciSyarikat';
                $newreport->api_error = $responselejar->Message;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if ($responselejar->HasError == true) {
            $report = ApiReport::where('api_id', '=', '6')->first();
            if ($report) {
                $report->api_error = $responselejar->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 6;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarPaparanTerperinciSyarikat';
                $newreport->api_error = $responselejar->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if ($responselejar == false) {
            $report = ApiReport::where('api_id', '=', '6')->first();
            if ($report) {
                $report->api_error = $responselejars->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 6;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarPaparanTerperinciSyarikat';
                $newreport->api_error = $responselejars->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        $report = ApiReport::where('api_id', '=', '6')->delete();

        $responselejarckht = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCKHT')

         // $responselejar = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarPaparanTerperinciSyarikat')
          ->withData(
              [
                  'JnsSijil' => $comprofile->Jenis_File,
                  'NoRujukan' => $newrujukan,
              ]
          )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentlejarckht = $responselejarckht->content;
        $responselejarckht = json_decode($contentlejarckht);

        // dd($responselejarckht);

        if (isset($responselejarckht->Message)) {
            $report = ApiReport::where('api_id', '=', '13')->first();
            if ($report) {
                $report->api_error = $responselejarckht->Message;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 13;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCKHT';
                $newreport->api_error = $responselejarckht->Message;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if ($responselejarckht == false) {
            $report = ApiReport::where('api_id', '=', '13')->first();
            if ($report) {
                $report->api_error = $responselejarckht;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 13;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCKHT';
                $newreport->api_error = $responselejarckht;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if (isset($responselejarckht->HasError)) {
            if ($responselejarckht->HasError == true) {
                $report = ApiReport::where('api_id', '=', '13')->first();
                if ($report) {
                    $report->api_error = $responselejarckht->ErrorMessage;
                    $report->date = date('Y-m-d h:i:s');
                    $report->update();
                } else {
                    $newreport = new ApiReport;
                    $newreport->api_id = 13;
                    $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCKHT';
                    $newreport->api_error = $responselejarckht->ErrorMessage;
                    $newreport->date = date('Y-m-d h:i:s');
                    $newreport->save();
                }

                return 0;
            }
        }

        $report = ApiReport::where('api_id', '=', '13')->delete();

        $model = $responselejar->Model;
        $modelckht = $responselejarckht->Model;

        $profiledata = $model->LejarInfoSykt;
        $income = $model->LejarBakiCukaiSykt;
        $arrayclosing = $model->LejarBakiPenutupSykt;
        $arraycurrent = $model->LejarPaparanTerperinciSykt_TahunTaksiran;

        $properties = $modelckht->LejarBakiCukaiCKHT2;
        $arrayclosingprop = $modelckht->LejarBakiPenutupCKHT2;
        $arraycurrentprop = $modelckht->LejarPaparanTerperinciCKHT_TahunTaksiran2;
        $arraycalendarprop = $modelckht->LejarPaparanTerperinciCKHT_TahunKalendar2;

        if ($income->BakiCukaiSykt == '') {
            $baki = 0.00;
        } else {
            $baki = $income->BakiCukaiSykt;
        }

        if ($properties->BakiCukaiCKHT == '') {
            $bakickht = 0.00;
        } else {
            $bakickht = $income->BakiCukaiSykt;
        }

        $profiledatacheck = Comlist::where('id', '=', $idc)->first();

        $profiledatacheck->BakiCukai = str_replace(',', '', $baki);
        $profiledatacheck->ByrnBelumBolehGuna = $income->ByrnBelumBolehGunaSykt;
        $profiledatacheck->BakiLejar = $income->BakiLejarSykt;

        $profiledatacheck->BakiCukaiCkht = str_replace(',', '', $bakickht);
        $profiledatacheck->ByrnBelumBolehGunaCkht = $properties->ByrnBelumBolehGunaCKHT;
        $profiledatacheck->BakiLejarCkht = $properties->BakiLejarCKHT;

        $profiledatacheck->IT_Collection_Branch = $profiledata->IT_Collection_Branch;
        $profiledatacheck->IT_Assm_Branch = $profiledata->IT_Assm_Branch;
        $profiledatacheck->CKHT_Assm_Branch = $profiledata->CKHT_Assm_Branch;
        $profiledatacheck->CKHT_Collection_Branch = $profiledata->CKHT_Collection_Branch;
        $profiledatacheck->Bank_CD = $profiledata->Bank_CD;
        $profiledatacheck->Bank_Acct_No = $profiledata->Bank_Acct_No;
        $profiledatacheck->Bank_Name = $profiledata->Bank_Name;
        $profiledatacheck->IT_Grp_CD = $profiledata->IT_Grp_CD;
        $profiledatacheck->update();

        $checarrayclosing = TaxElejarDetail::where('fk_users', '=', $id)->delete();
        foreach ($arrayclosing as $key => $vclosing) {
            $arrayclosingnew = new TaxElejarDetail;
            $arrayclosingnew->fk_users = $id;
            $arrayclosingnew->lejar_type = 'SYARIKAT';
            $arrayclosingnew->income_type = 'SALARY';
            $arrayclosingnew->fk_lkp_tcl = $idc;
            $arrayclosingnew->ASSESSMENT_YEAR = $vclosing->ASSESSMENT_YEAR;
            $arrayclosingnew->JumTggnCukai = $vclosing->JumTggnCukai;
            $arrayclosingnew->JumBayaranCukai = $vclosing->JumBayaranCukai;
            $arrayclosingnew->JumBersih = $vclosing->JumBersih;
            $arrayclosingnew->ByrnBelumBolehGuna = $vclosing->ByrnBelumBolehGuna;
            $arrayclosingnew->BakiCukaiSemasa = $vclosing->BakiCukaiSemasa;
            $arrayclosingnew->save();
        }

        foreach ($arrayclosingprop as $key => $vclosing) {
            $arrayclosingnew = new TaxElejarDetail;
            $arrayclosingnew->fk_users = $id;
            $arrayclosingnew->lejar_type = 'SYARIKAT';
            $arrayclosingnew->income_type = 'PROPERTIES';
            $arrayclosingnew->fk_lkp_tcl = $idc;
            $arrayclosingnew->ASSESSMENT_YEAR = $vclosing->ASSESSMENT_YEAR;
            $arrayclosingnew->JumTggnCukai = $vclosing->JumTggnCukai;
            $arrayclosingnew->JumBayaranCukai = $vclosing->JumBayaranCukai;
            $arrayclosingnew->JumBersih = $vclosing->JumBersih;
            $arrayclosingnew->ByrnBelumBolehGuna = $vclosing->ByrnBelumBolehGuna;
            $arrayclosingnew->BakiCukaiSemasa = $vclosing->BakiCukaiSemasa;
            $arrayclosingnew->save();
        }

        $checarraycurrent = TaxElejarDetailCurrent::where('fk_users', '=', $id)->delete();

        foreach ($arraycurrent as $key => $vcal) {
            $arraycurrentnew = new TaxElejarDetailCurrent;
            $arraycurrentnew->fk_users = $id;
            $arraycurrentnew->lejar_type = 'SYARIKAT';
            $arraycurrentnew->income_type = 'SALARY';
            $arraycurrentnew->fk_lkp_tcl = $idc;
            $arraycurrentnew->Tahun = $vcal->Tahun;
            $arraycurrentnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
            $arraycurrentnew->ASSESSMENT_NOM = $vcal->ASSESSMENT_NOM;
            $arraycurrentnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
            $arraycurrentnew->SEQ_NO = $vcal->SEQ_NO;
            $arraycurrentnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
            $arraycurrentnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
            $arraycurrentnew->POSTED_DATE = $vcal->POSTED_DATE;
            $arraycurrentnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
            $arraycurrentnew->TYP = $vcal->TYP;
            $arraycurrentnew->AMT = $vcal->AMT;
            $arraycurrentnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
            $arraycurrentnew->TggnCukai = $vcal->TggnCukai;
            $arraycurrentnew->BayaranCukai = $vcal->BayaranCukai;
            $arraycurrentnew->DOC_NO = trim($vcal->DOC_NO);
            $arraycurrentnew->RECEIPT_NO = $vcal->RECEIPT_NO;
            $arraycurrentnew->Keterangan = $vcal->Keterangan;
            $arraycurrentnew->BRANCH_CODE = $vcal->BRANCH_CODE;
            $arraycurrentnew->BakiCukai = $vcal->BakiCukai;

            $arraycurrentnew->JnsTransaksi = $vcal->JnsTransaksi;

            $arraycurrentnew->NoLot = $vcal->NoLot;
            $arraycurrentnew->RECEIPT_NUM = $vcal->RECEIPT_NUM;
            $arraycurrentnew->RECT_NUM = $vcal->RECT_NUM;
            $arraycurrentnew->DOC_NUM = $vcal->DOC_NUM;

            $arraycurrentnew->save();
        }

        foreach ($arraycurrentprop as $key => $vcal) {
            $arraycurrentnew = new TaxElejarDetailCurrent;
            $arraycurrentnew->fk_users = $id;
            $arraycurrentnew->lejar_type = 'SYARIKAT';
            $arraycurrentnew->income_type = 'PROPERTIES';
            $arraycurrentnew->fk_lkp_tcl = $idc;
            $arraycurrentnew->Tahun = $vcal->Tahun;
            $arraycurrentnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
            $arraycurrentnew->ASSESSMENT_NOM = $vcal->ASSESSMENT_NOM;
            $arraycurrentnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
            $arraycurrentnew->SEQ_NO = $vcal->SEQ_NO;
            $arraycurrentnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
            $arraycurrentnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
            $arraycurrentnew->POSTED_DATE = $vcal->POSTED_DATE;
            $arraycurrentnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
            $arraycurrentnew->TYP = $vcal->TYP;
            $arraycurrentnew->AMT = $vcal->AMT;
            $arraycurrentnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
            $arraycurrentnew->TggnCukai = $vcal->TggnCukai;
            $arraycurrentnew->BayaranCukai = $vcal->BayaranCukai;
            $arraycurrentnew->DOC_NO = trim($vcal->DOC_NO);
            $arraycurrentnew->RECEIPT_NO = $vcal->RECEIPT_NO;
            $arraycurrentnew->Keterangan = $vcal->Keterangan;
            $arraycurrentnew->BRANCH_CODE = $vcal->BRANCH_CODE;
            $arraycurrentnew->BakiCukai = $vcal->BakiCukai;

            $arraycurrentnew->JnsTransaksi = $vcal->JnsTransaksi;

            $arraycurrentnew->NoLot = $vcal->NoLot;
            $arraycurrentnew->RECEIPT_NUM = $vcal->RECEIPT_NUM;
            $arraycurrentnew->RECT_NUM = $vcal->RECT_NUM;
            $arraycurrentnew->DOC_NUM = $vcal->DOC_NUM;

            $arraycurrentnew->save();
        }

        $checarraycalendar = TaxElejarDetailCalendar::where('fk_users', '=', $id)->delete();

        foreach ($arraycalendarprop as $key => $vcal) {
            $arraycalnew = new TaxElejarDetailCalendar;
            $arraycalnew->fk_users = $id;
            $arraycalnew->lejar_type = 'SYARIKAT';
            $arraycalnew->income_type = 'PROPERTIES';
            $arraycalnew->fk_lkp_tcl = $idc;
            $arraycalnew->Tahun = $vcal->Tahun;
            $arraycalnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
            $arraycalnew->ASSESSMENT_NOM = $vcal->ASSESSMENT_NOM;
            $arraycalnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
            $arraycalnew->SEQ_NO = $vcal->SEQ_NO;
            $arraycalnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
            $arraycalnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
            $arraycalnew->POSTED_DATE = $vcal->POSTED_DATE;
            $arraycalnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
            $arraycalnew->TYP = $vcal->TYP;
            $arraycalnew->AMT = $vcal->AMT;
            $arraycalnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
            $arraycalnew->TggnCukai = $vcal->TggnCukai;
            $arraycalnew->BayaranCukai = $vcal->BayaranCukai;
            $arraycalnew->DOC_NO = trim($vcal->DOC_NO);
            $arraycalnew->RECEIPT_NO = $vcal->RECEIPT_NO;
            $arraycalnew->Keterangan = $vcal->Keterangan;
            $arraycalnew->BRANCH_CODE = $vcal->BRANCH_CODE;
            $arraycalnew->BakiCukai = $vcal->BakiCukai;

            $arraycalnew->JnsTransaksi = $vcal->JnsTransaksi;

            $arraycalnew->NoLot = $vcal->NoLot;
            $arraycalnew->RECEIPT_NUM = $vcal->RECEIPT_NUM;
            $arraycalnew->RECT_NUM = $vcal->RECT_NUM;
            $arraycalnew->DOC_NUM = $vcal->DOC_NUM;

            $arraycalnew->save();
        }

        $checkincome = TaxElejar::where('fk_users', '=', $id)->where('lejar_type', '=', 'SYARIKAT')->where('income_type', '=', 'SALARY')->delete();

        // dd($properties);

        $newincome = new TaxElejar;
        $newincome->fk_users = $id;
        $newincome->lejar_type = 'SYARIKAT';
        $newincome->income_type = 'SALARY';
        $newincome->description = 'Cukai Pendapatan';
        $newincome->BakiCukai = $income->BakiCukaiSykt;
        $newincome->ByrnBelumBolehGuna = $income->ByrnBelumBolehGunaSykt;
        $newincome->BakiLejar = $income->BakiLejarSykt;
        $newincome->save();

        $checkprop = TaxElejar::where('fk_users', '=', $id)->where('lejar_type', '=', 'SYARIKAT')->where('income_type', '=', 'PROPERTIES')->delete();

        $newprop = new TaxElejar;
        $newprop->fk_users = $id;
        $newprop->lejar_type = 'SYARIKAT';
        $newprop->income_type = 'PROPERTIES';
        $newprop->description = 'Cukai Keuntungan Harta Tanah';
        $newprop->BakiCukai = $properties->BakiCukaiCKHT;
        $newprop->ByrnBelumBolehGuna = $properties->ByrnBelumBolehGunaCKHT;
        $newprop->BakiLejar = $properties->BakiLejarCKHT;
        $newprop->save();
    }

    public function api_profile_pageindex($user)
    {
        try {

            // $user = User::where('reference_id','=',$request->idenno)->first();
            $response = Curl::to(env('API_DOMAIN').'/SSOService.svc/user/getprofile')
            ->withData(
                [
                    'idno' => $user->reference_id,
                    'idtype' => $user->reference_type,
                ]
            )
                ->returnResponseObject()
                ->get();

            $data = json_decode($response->content);
            // dd($data);

            if ($data) {
                if ($data == false) {
                    return $data = [];
                }
            }

            return $data;
        } catch (RequestException $e) {
            return $data = [];
        }
    }

    public function api_profile_pagesearch($request)
    {
        try {
            $randnumber = rand(1000000000, 2000000000);
            $epoch = time();
            $sekatan = '1';
            $baki = '0.00';
            $refund = '0.00';
            $inbox = 0;

            $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
            $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
            $nonce = $randnumber;
            $string = $userid.$key.$nonce.$epoch;
            $token = hash_hmac('sha256', $string, $key);

            $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

            $response = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/LejarMyProfile')
                              ->withData(
                                  [
                                      // 'JnsSijil' => 'SG',
                                      'NoRujukan' => $request->refno,
                                  ]
                              )
                                ->withHeaders(['ApiAuthorization:'.$auth])
                                ->returnResponseObject()
                                 ->post();

            $returns = json_decode($response->content);
            $data = [

                'NoRujukan' => $request->refno,
                'API URL' => 'https://mytax2.hasil.gov.my/MyTaxApi/api/LejarMyProfile',
                'result' => $returns,
            ];

            // dd($data);

            if ($returns) {
                if ($returns == false) {
                    return [];
                }
                if ($returns->Success == false) {
                    return [];
                }
                $data = $returns->Model->LejarMyProfile;

                if ($data->NOCUKAI == null) {
                    return [];
                }

                return $data;
            }

            return [];
        } catch (RequestException $e) {
            return [];
        }
    }

    public function api_resit($file, $rujukan, $resit, $type)
    {
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $noru = ltrim($rujukan, '0');
        if (strlen($noru) > 8) {
            $newrujukan = $noru;
        } else {
            $newrujukan = '0'.$noru;
        }

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responserefunds = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCetakanResit')
            ->withData(
                [
                    'JnsSijil' => $file,
                    'NoRujukan' => '00'.$newrujukan,
                    'NoResit' => $resit,

                    // 'JnsSijil' => 'SG',
                    // 'NoRujukan' => '100938090',
                    // 'NoResit' => '20077815178'

                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentrefund = $responserefunds->content;
        $responsrefund = json_decode($contentrefund);

        $data = [

            'API URL' => 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCetakanResit',
            'JnsSijil' => $file,
            'NoRujukan' => '00'.$newrujukan,
            'NoResit' => $resit,
            'result' => $responsrefund,
        ];

        dd($data);
        if ($responsrefund == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '11')->first();
            if ($report) {
                $report->api_error = $responserefunds->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 11;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCetakanResit';
                $newreport->api_error = $responserefunds->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsrefund->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '11')->first();
            if ($report) {
                $report->api_error = $responsrefund->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 11;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCetakanResit';
                $newreport->api_error = $responsrefund->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsrefund->Success == true) {
                // dd($type);
                if ($type == 1) {
                    $data[] = $responsrefund->Model->CetakanResitBayaranInd;
                } else {
                    $data[] = $responsrefund->Model->CetakanResitBayaranSyarikat;
                }

                $report = ApiReport::where('api_id', '=', '11')->delete();

                return $data;
            }
        }
    }

    public function searchcomdata($id)
    {
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $noru = ltrim($id, '0');
        if (strlen($noru) > 8) {
            $newrujukan = $noru;
        } else {
            $newrujukan = '0'.$noru;
        }

        $responselejars = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarPaparanTerperinciSyarikat')
          ->withData(
              [
                  // 'JnsSijil' => $comprofile->Jenis_File,
                  'NoRujukan' => $newrujukan,
              ]
          )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentlejar = $responselejars->content;
        $responselejar = json_decode($contentlejar);

        // dd($responselejar);
        if (isset($responselejar->Message)) {
            $report = ApiReport::where('api_id', '=', '6')->first();
            if ($report) {
                $report->api_error = $responselejar->Message;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 6;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarPaparanTerperinciSyarikat';
                $newreport->api_error = $responselejar->Message;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if ($responselejar->HasError == true) {
            $report = ApiReport::where('api_id', '=', '6')->first();
            if ($report) {
                $report->api_error = $responselejar->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 6;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarPaparanTerperinciSyarikat';
                $newreport->api_error = $responselejar->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if ($responselejar == false) {
            $report = ApiReport::where('api_id', '=', '6')->first();
            if ($report) {
                $report->api_error = $responselejars->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 6;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarPaparanTerperinciSyarikat';
                $newreport->api_error = $responselejars->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        $report = ApiReport::where('api_id', '=', '6')->delete();

        $responselejarckht = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCKHT')

          ->withData(
              [
                  // 'JnsSijil' => $comprofile->Jenis_File,
                  'NoRujukan' => $newrujukan,
              ]
          )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentlejarckht = $responselejarckht->content;
        $responselejarckht = json_decode($contentlejarckht);

        if (isset($responselejarckht->Message)) {
            $report = ApiReport::where('api_id', '=', '13')->first();
            if ($report) {
                $report->api_error = $responselejarckht->Message;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 13;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCKHT';
                $newreport->api_error = $responselejarckht->Message;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if ($responselejarckht == false) {
            $report = ApiReport::where('api_id', '=', '13')->first();
            if ($report) {
                $report->api_error = $responselejarckht;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 13;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCKHT';
                $newreport->api_error = $responselejarckht;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if (isset($responselejarckht->HasError)) {
            if ($responselejarckht->HasError == true) {
                $report = ApiReport::where('api_id', '=', '13')->first();
                if ($report) {
                    $report->api_error = $responselejarckht->ErrorMessage;
                    $report->date = date('Y-m-d h:i:s');
                    $report->update();
                } else {
                    $newreport = new ApiReport;
                    $newreport->api_id = 13;
                    $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCKHT';
                    $newreport->api_error = $responselejarckht->ErrorMessage;
                    $newreport->date = date('Y-m-d h:i:s');
                    $newreport->save();
                }

                return 0;
            }
        }

        $report = ApiReport::where('api_id', '=', '13')->delete();

        $model = $responselejar->Model;
        $modelckht = $responselejarckht->Model;

        $model = $responselejar->Model;
        $modelckht = $responselejarckht->Model;

        $profiledata = $model->LejarInfoSykt;
        $income = $model->LejarBakiCukaiSykt;
        $arrayclosing = $model->LejarBakiPenutupSykt;
        $arraycurrent = $model->LejarPaparanTerperinciSykt_TahunTaksiran;

        $properties = $modelckht->LejarBakiCukaiCKHT2;
        $arrayclosingprop = $modelckht->LejarBakiPenutupCKHT2;
        $arraycurrentprop = $modelckht->LejarPaparanTerperinciCKHT_TahunTaksiran2;
        $arraycalendarprop = $modelckht->LejarPaparanTerperinciCKHT_TahunKalendar2;

        $data = [

            'salary' => $income,
            'ckht'   => $modelckht,
            'profile'=> $profiledata,

        ];

        return $data;
    }
}
