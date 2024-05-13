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
use App\Models\TaxTemplateLookup;
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
class ApiRepo
{
    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    //id = 17

    public function api_profile()
    {
        try {
            $user = auth()->user();
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

            $datas = [

                'api url' => env('API_DOMAIN').'/SSOService.svc/user/getprofile',
                'idno' => $user->reference_id,
                'idtype' => $user->reference_type,
                'result' => $data,

            ];
            // dd($datas);

            if ($data) {
                if ($data == false) {
                    return $this->api_profile_add();
                }

                $user = User::where('reference_id', '=', $user->reference_id)->first();
                $user->email = $data->Email;
                $user->name = $data->Name;
                $user->tax_no = substr($data->TaxRefNo, 3);
                $user->doc_type = substr($data->TaxRefNo, 0, 2);
                $user->update();

                $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
                if ($checkprofile) {
                    $checkprofile->address = $data->Address;
                    $checkprofile->handphone_no = $data->HandPhoneNo;
                    $checkprofile->homephone_no = $data->HomePhoneNo;
                    $checkprofile->tax_cert_status = $data->CertValidity;
                    $checkprofile->tax_cert_type = $data->CertType;
                    $checkprofile->update();
                } else {
                    $profile = new TaxProfile;
                    $profile->fk_users = $user->id;
                    $profile->address = $data->Address;
                    $profile->handphone_no = $data->HandPhoneNo;
                    $profile->homephone_no = $data->HomePhoneNo;
                    $profile->tax_cert_status = $data->CertValidity;
                    $profile->tax_cert_type = $data->CertType;
                    $profile->save();
                }
            }

            return $this->api_profile_add();
        } catch (RequestException $e) {
            return $this->api_profile_add();
        }
    }

    public function api_profile_page()
    {
        try {
            $user = auth()->user();
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

            $datas = [

                'idno' => $user->reference_id,
                'idtype' => $user->reference_type,
                'url' => env('API_DOMAIN').'/SSOService.svc/user/getprofile',
                'data' => $data,

            ];

            // dd($datas);
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

    public function api_profile_add()
    {
        try {
            $users = auth()->user();

            $user = User::where('id', '=', $users->id)->first();

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

                    if ($data->Bank_Acct_No) {
                        $checkprofile->Bank_Acct_No = $data->Bank_Acct_No;
                    }

                    if ($data->Branch_CKHT) {
                        $checkprofile->CKHT_Collection_Branch = $data->Branch_CKHT;
                    }

                    if ($data->Bank_Name) {
                        $checkprofile->Bank_Name = $data->Bank_Name;
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

                    if ($data->Bank_Acct_No) {
                        $profile->Bank_Acct_No = $data->Bank_Acct_No;
                    }

                    if ($data->Branch_CKHT) {
                        $profile->CKHT_Collection_Branch = $data->Branch_CKHT;
                    }

                    if ($data->Bank_Name) {
                        $profile->Bank_Name = $data->Bank_Name;
                    }

                    $profile->save();
                }
            }

            return $returns;
        } catch (RequestException $e) {
            return $e;
        }
    }

    //1
    public function api_inbox()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;

        // $checinboxfirstime = TaxInbox::where('NoId','=',$user->reference_id)->delete();

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);

        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        if ($user->tax_no == null) {
            return 0;
        }

        $responses = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/Mailbox')
                  ->withData(
                      [
                          'JnsSijil' => $user->doc_type,
                          'NoRujukan' => ltrim($user->tax_no, '0'),

                      ]
                  )
                    ->withHeaders(['ApiAuthorization:'.$auth])
                    ->returnResponseObject()
                    ->post();

        $content = $responses->content;
        $response = json_decode($content);

        $data = [

            'JnsSijil' => $user->doc_type,
            'NoRujukan' => $user->tax_no,
            'api' => 'https://mytax2.hasil.gov.my/MyTaxApi/api/Mailbox',
            'response' => $response,

        ];
        // dd($data);

        if ($responses->content == false) {
            $report = ApiReport::where('api_id', '=', '1')->first();
            if ($report) {
                $report->api_error = $responses->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 1;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/Mailbox';
                $newreport->api_error = $responses->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if ($response->Success == false) {
            $report = ApiReport::where('api_id', '=', '1')->first();
            if ($report) {
                $report->api_error = $response->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 1;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/Mailbox';
                $newreport->api_error = $response->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if (isset($response->Message)) {
            $report = ApiReport::where('api_id', '=', '1')->first();
            if ($report) {
                $report->api_error = $response->Message;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 1;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/Mailbox';
                $newreport->api_error = $response->Message;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }
        if ($response == false) {
            $report = ApiReport::where('api_id', '=', '1')->first();
            if ($report) {
                $report->api_error = $responses->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 1;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/Mailbox';
                $newreport->api_error = $responses->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        $data = $response->Model->MailboxData;
        // $checinboxfirstime = TaxInbox::where('NoId','=',$user->reference_id)
        //                          ->delete();

        foreach ($data as $key => $value) {

            // dd($value->NoId);

            $Subjek = $value->Subjek;
            $Mesej = $value->Mesej;
            $Daripada = $value->Daripada;
            $NoId = $value->NoId;
            $NoFail = $value->NoFail;
            $TarikhNotis = new DateTime($value->TarikhNotis);
            $TarikhTerima = $value->TarikhTerima;
            if ($value->Unread == true) {
                $Unread = 'true';
            } else {
                $Unread = 'false';
            }
            $JenisFail = $value->JenisFail;
            $RefNo = $value->RefNo;
            $Nama = $value->Nama;
            $Emel = $value->Emel;
            $NoBaucar = $value->NoBaucar;
            $NamaBank = $value->NamaBank;
            $NoAkaun = $value->NoAkaun;
            $NoEft = $value->NoEft;
            $TkhRefund = $value->TkhRefund;
            $BankPembayar = $value->BankPembayar;
            $Sumber = $value->Sumber;
            $Status = $value->Status;
            $Filler = $value->Filler;
            $FolderId = $value->FolderId;
            $FolderDate = $value->FolderDate;
            $AmaunKredit = $value->AmaunKredit;
            $ThnTaksiran = $value->ThnTaksiran;
            $RefId = $value->RefId;
            $NamaSyarikat = $value->NamaSyarikat;
            $ThnTaksiran1 = $value->ThnTaksiran1;
            $SumberBEN = $value->SumberBEN;

            $checklookup = LkpTemplate::where('type', '=', $Sumber)->first();
            if ($checklookup) {
            } else {
                $newlookup = new LkpTemplate;
                $newlookup->type = $Sumber;
                $newlookup->status = 1;
                $newlookup->save();
            }

            $checklookup = LkpTemplate::where('type', '=', $SumberBEN)->first();
            if ($checklookup) {
            } else {
                $newlookup = new LkpTemplate;
                $newlookup->type = $SumberBEN;
                $newlookup->status = 1;
                $newlookup->save();
            }

            $checklookupdata = TaxTemplateLookup::where('code', '=', '[SumberBEN]')->first();
            if ($checklookupdata) {
            } else {
                $newlookup = new TaxTemplateLookup;
                $newlookup->label = 'SumberBEN Inbox';
                $newlookup->code = '[SumberBEN]';
                $newlookup->save();
            }

            $checklookupdata = TaxTemplateLookup::where('code', '=', '[TahunTaksiran1]')->first();
            if ($checklookupdata) {
            } else {
                $newlookup = new TaxTemplateLookup;
                $newlookup->label = 'Tahun Taksiran1 (Inbox)';
                $newlookup->code = '[TahunTaksiran1]';
                $newlookup->save();
            }

            $datecon = $TarikhNotis->format('Y-m-d h:i:s');

            $checinboxfirstime = TaxInbox::where('NoId', '=', $user->reference_id)
                                    ->where('TarikhNotis', '=', $datecon)
                                    ->where('Sumber', '=', $Sumber)
                                    ->where('ThnTaksiran', '=', $ThnTaksiran)
                                    ->first();
            if ($checinboxfirstime) {
            } else {
                $newinbox = new TaxInbox;
                $newinbox->Subjek = $Subjek;
                $newinbox->Mesej = $Mesej;
                $newinbox->Daripada = $Daripada;
                $newinbox->NoId = $NoId;
                $newinbox->NoFail = $NoFail;
                $newinbox->TarikhNotis = $TarikhNotis->format('Y-m-d h:i:s'); //$TarikhNotis;
                $newinbox->TarikhTerima = $TarikhTerima;
                $newinbox->Unread = $Unread;
                $newinbox->JenisFail = $JenisFail;
                $newinbox->RefNo = $RefNo;
                $newinbox->Nama = $Nama;
                $newinbox->Emel = $Emel;
                $newinbox->NoBaucar = $NoBaucar;
                $newinbox->NamaBank = $NamaBank;
                $newinbox->NoAkaun = $NoAkaun;
                $newinbox->NoEft = $NoEft;
                $newinbox->TkhRefund = $TkhRefund;
                $newinbox->BankPembayar = $BankPembayar;
                $newinbox->Sumber = $Sumber;
                $newinbox->Status = $Status;
                $newinbox->Filler = $Filler;
                $newinbox->FolderId = $FolderId;
                $newinbox->FolderDate = $FolderDate;
                $newinbox->AmaunKredit = $AmaunKredit;
                $newinbox->ThnTaksiran = $ThnTaksiran;
                $newinbox->RefId = $RefId;
                $newinbox->NamaSyarikat = $NamaSyarikat;
                $newinbox->TahunTaksiran1 = $ThnTaksiran1;
                $newinbox->SumberBEN = $SumberBEN;
                $newinbox->save();
            }
        }

        $report = ApiReport::where('api_id', '=', '1')->delete();
    }

    public function api_individu()
    {
        $user = auth()->user();

        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '0';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);

        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $response = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/individu')
                          ->withData(
                              [
                                  'JnsSijil' => $user->doc_type,
                                  'NoRujukan' => $user->tax_no,
                              ]
                          )
                            ->withHeaders(['ApiAuthorization:'.$auth])
                            ->returnResponseObject()
                             ->post();

        $data = json_decode($response->content);
        // dd($data);

        if ($data) {
            if ($data == false) {
                return $this->api_lejarindividu();
            }
            if (array_key_exists('Success', $data)) {
                if ($data->Success == true) {
                    if ($data->Model->SekatanPerjalanan == true) {
                        $sekatan = '1';
                    }

                    $baki = $data->Model->BakiCukai;
                    $refund = $data->Model->BayaranBalik->JumRefund;
                    $inbox = $data->Model->InboxUnreadCount;
                }
            }

            if ($checkprofile) {
                $checkprofile->tax_balance = $baki;
                $checkprofile->tax_refund = $refund;
                $checkprofile->tax_restrain = $sekatan;
                $checkprofile->update();
            } else {
                $profile = new TaxProfile;
                $profile->fk_users = $user->id;
                $profile->tax_balance = $baki;
                $profile->tax_refund = $refund;
                $profile->tax_restrain = $sekatan;
                $profile->save();
            }
        } else {
            if ($checkprofile) {
            } else {
                $profile = new TaxProfile;
                $profile->fk_users = $user->id;
                $profile->tax_balance = $baki;
                $profile->tax_refund = $refund;
                $profile->tax_restrain = $sekatan;
                $profile->save();
            }
        }

        return $this->api_lejarindividu();
    }

    //2
    public function api_lejarindividu()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responselejars = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/LejarIndividu')
              ->withData(
                  [
                      'JnsSijil' => $user->doc_type,
                      'NoRujukan' => $user->tax_no,
                  ]
              )
                ->withHeaders(['ApiAuthorization:'.$auth])
                ->returnResponseObject()
                 ->post();

        $datalejar = json_decode($responselejars->content);

        // dd($datalejar);
        if (isset($datalejar->Message)) {
            $report = ApiReport::where('api_id', '=', '2')->first();
            if ($report) {
                $report->api_error = $datalejar->Message;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 2;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/LejarIndividu';
                $newreport->api_error = $datalejar->Message;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if ($datalejar == false) {
            $report = ApiReport::where('api_id', '=', '2')->first();
            if ($report) {
                $report->api_error = $responselejars->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 2;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/LejarIndividu';
                $newreport->api_error = $responselejars->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if ($datalejar->Success == false) {
            $report = ApiReport::where('api_id', '=', '2')->first();
            if ($report) {
                $report->api_error = $datalejar->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 2;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/LejarIndividu';
                $newreport->api_error = $datalejar->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        $report = ApiReport::where('api_id', '=', '2')->delete();
        $datalejarmasuk = $datalejar->Model->LejarBakiCukaiInd;

        if ($checkprofile) {
            $checkprofile->tax_balance = $datalejarmasuk->BakiCukai;
            $checkprofile->update();
        } else {
        }
    }

    //3
    public function api_cp500()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
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

        //checkinbox :
        $checinboxfirstime = TaxInbox::where('NoId', '=', $user->reference_id)->first();
        if ($checinboxfirstime) {
        } else {
            $datainbox = $this->api_inbox();
        }

        $checinboxcp500 = TaxInbox::where('NoId', '=', $user->reference_id)->where('Sumber', '=', 'CP500')->get();
        // dd($checinboxcp500);
        foreach ($checinboxcp500 as $key => $value) {
            $checkcp500dataw = TaxCp500::where('refid', '=', $value->RefId)->delete();
            $checkcp500data = TaxCp500::where('refid', '=', $value->RefId)->first();
            if ($checkcp500data) {
            } else {
                $response500s = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/CP500')
                ->withData(
                    [
                        'RefID' => $value->RefId,
                        'JnsSijil' => $user->doc_type,
                        'RefNo' => $user->tax_no,
                        'Sumber' => 'CP500',
                    ]
                )

                ->withHeaders(['ApiAuthorization:'.$auth])
                ->returnResponseObject()
                ->post();
                // dd($response500s);

                $content500 = $response500s->content;
                $response500 = json_decode($content500);

                // dd($response500);
                if (isset($response500->Message)) {
                    $report = ApiReport::where('api_id', '=', '3')->first();
                    if ($report) {
                        $report->api_error = $response500->Message;
                        $report->date = date('Y-m-d h:i:s');
                        $report->update();
                    } else {
                        $newreport = new ApiReport;
                        $newreport->api_id = 3;
                        $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/CP500';
                        $newreport->api_error = $response500->Message;
                        $newreport->date = date('Y-m-d h:i:s');
                        $newreport->save();
                    }

                    return 0;
                }

                if ($response500 == false) {
                    $report = ApiReport::where('api_id', '=', '3')->first();
                    if ($report) {
                        $report->api_error = $response500s->error;
                        $report->date = date('Y-m-d h:i:s');
                        $report->update();
                    } else {
                        $newreport = new ApiReport;
                        $newreport->api_id = 3;
                        $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/CP500';
                        $newreport->api_error = $response500s->error;
                        $newreport->date = date('Y-m-d h:i:s');
                        $newreport->save();
                    }

                    return 0;
                }
                $data500 = $response500->Model->CP500Data;
                $report = ApiReport::where('api_id', '=', '3')->delete();

                foreach ($data500 as $key =>$data500) {
                    $data500new = new TaxCp500;
                    $data500new->fk_users = $id;
                    $data500new->TAX_PAYER_NAME1 = $data500->TAX_PAYER_NAME1;
                    $data500new->NEW_IC_NO = $data500->NEW_IC_NO;
                    $data500new->IT_REF_NO = $data500->IT_REF_NO;
                    $data500new->FILE_TYPE = $data500->FILE_TYPE;
                    $data500new->JUM_PERLU_BYR = $data500->JUM_PERLU_BYR;
                    $data500new->SKIM_DATE = $data500->SKIM_DATE;
                    $data500new->ASSESSMENT_YEAR = $data500->ASSESSMENT_YEAR;
                    $data500new->BASIS_START_DATE = $data500->BASIS_START_DATE;
                    $data500new->BASIS_END_DATE = $data500->BASIS_END_DATE;
                    $data500new->MIN_DUE_AMOUNT = $data500->MIN_DUE_AMOUNT;
                    $data500new->MAX_DUE_AMOUNT = $data500->MAX_DUE_AMOUNT;
                    $data500new->IT_COL_BRANCH = $data500->IT_COL_BRANCH;
                    $data500new->BRANCH_NAME = $data500->BRANCH_NAME;
                    $data500new->TOTAL_AMOUNT_CP500 = $data500->TOTAL_AMOUNT_CP500;
                    $data500new->INSTALLMENT_TYPE_CODE = $data500->INSTALLMENT_TYPE_CODE;
                    $data500new->BIL_PERLU_BYR = $data500->BIL_PERLU_BYR;
                    $data500new->refid = $data500->Id;
                    $data500new->JumlahAnsuran = $data500->JumlahAnsuran;
                    $data500new->save();
                }
            }
        }
    }

    //4
    public function api_cp204()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        // $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        // $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        // $nonce = $randnumber;
        // $string = $userid.$key.$nonce.$epoch;
        // $token = hash_hmac('sha256', $string, $key);
        // $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $comprofile = Comlist::where('fk_users', '=', $id)->where('Jenis_File', '=', 'C')->get();
        if ($comprofile) {
            foreach ($comprofile as $key => $value) {
                $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
                $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
                $nonce = $randnumber;
                $string = $userid.$key.$nonce.$epoch;
                $token = hash_hmac('sha256', $string, $key);
                $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

                $noru = ltrim($value->No_Rujukan, '0');
                if (strlen($noru) > 8) {
                    $newrujukan = $noru;
                } else {
                    $newrujukan = '0'.$noru;
                }

                $response204s = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/CP204')
                  ->withData(
                      [
                          'JnsSijil' => $value->Jenis_File, //'C',//$user->doc_type,
                          'NoRujukan' => $newrujukan, //'487931008',//$user->tax_no
                      ]
                  )
                    ->withHeaders(['ApiAuthorization:'.$auth])
                    ->returnResponseObject()
                    ->post();

                $content204 = $response204s->content;
                $response204 = json_decode($content204);
                // dd($response204);

                if (isset($response204->ErrorMessage)) {
                    $data = [];
                    $report = ApiReport::where('api_id', '=', '4')->first();
                    if ($report) {
                        $report->api_error = $response204->ErrorMessage;
                        $report->date = date('Y-m-d h:i:s');
                        $report->update();
                    } else {
                        $newreport = new ApiReport;
                        $newreport->api_id = 4;
                        $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/CP204';
                        $newreport->api_error = $response204->ErrorMessage;
                        $newreport->date = date('Y-m-d h:i:s');
                        $newreport->save();
                    }

                    return $data;
                } else {
                    if ($response204 == false) {
                        $data = [];

                        $report = ApiReport::where('api_id', '=', '4')->first();
                        if ($report) {
                            $report->api_error = $response204s->error;
                            $report->date = date('Y-m-d h:i:s');
                            $report->update();
                        } else {
                            $newreport = new ApiReport;
                            $newreport->api_id = 4;
                            $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/CP204';
                            $newreport->api_error = $response204s->error;
                            $newreport->date = date('Y-m-d h:i:s');
                            $newreport->save();
                        }

                        return $data;
                    }

                    if ($response204->Success == false) {
                        $data = [];

                        $report = ApiReport::where('api_id', '=', '4')->first();
                        if ($report) {
                            $report->api_error = $response204->Message;
                            $report->date = date('Y-m-d h:i:s');
                            $report->update();
                        } else {
                            $newreport = new ApiReport;
                            $newreport->api_id = 4;
                            $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/CP204';
                            $newreport->api_error = $response204->Message;
                            $newreport->date = date('Y-m-d h:i:s');
                            $newreport->save();
                        }

                        return $data;
                    } else {
                        $newarray = [];

                        $report = ApiReport::where('api_id', '=', '4')->delete();

                        foreach ($response204->Model->DetailRekod204 as $datanew) {
                            if (($datanew->asm_yr == date('Y')) and ($datanew->C_NAME = $value->Nama_Syarikat)) {
                                $newarray[] = $datanew;
                            }
                        }

                        if ($newarray) {
                            $data[$value->Nama_Syarikat] = collect($newarray)->sortBy('bil_ans')->toArray();
                        }
                    }
                }
            }
        }

        return $data;
    }

    //5
    public function api_elejar()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
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

        $responselejars = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/LejarPaparanTerperinci')
          ->withData(
              [
                  'JnsSijil' => $user->doc_type, //'SG',//
                  'NoRujukan' => $user->tax_no, //'00100938090'//
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
    }

    //6
    public function api_elejarcom()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
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

        // $responselejar = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarSenaraiSyarikat')
        $responselejars = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarPaparanTerperinciSyarikat')
          ->withData(
              [
                  'JnsSijil' => $user->doc_type,
                  'NoRujukan' => $user->tax_no,
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
        $model = $responselejar->Model;
        $income = $model->LejarBakiCukaiSykt;
        $arrayclosing = $model->LejarBakiPenutupSykt;
        $arraycurrent = $model->LejarPaparanTerperinciSykt_TahunTaksiran;
        $profiledata = $model->LejarInfoSykt;
        // $properties = $model->LejarBakiCukaiCKHT;
        // $arraycalendar = $model->LejarPaparanTerperinci_TahunKalendar;
        // $arraypcbcal = $model->PenyataPCB_TahunKalendar;
        // $arraypcbtak = $model->PenyataPCB_TahunTaksiran;
        // $arrayclosingprop  = $model->LejarBakiPenutupCKHT;
        // $arraycalendarprop = $model->LejarPaparanTerperinciCKHT_TahunKalendar;
        // $arraycurrentprop = $model->LejarPaparanTerperinciCKHT_TahunTaksiran;

        $checkincome = TaxElejar::where('fk_users', '=', $id)->where('lejar_type', '=', 'SYARIKAT')->where('income_type', '=', 'SALARY')->delete();
        $newincome = new TaxElejar;
        $newincome->fk_users = $id;
        $newincome->lejar_type = 'SYARIKAT';
        $newincome->income_type = 'SALARY';
        $newincome->description = 'Cukai Pendapatan';
        $newincome->BakiCukai = $income->BakiCukaiSykt;
        $newincome->ByrnBelumBolehGuna = $income->ByrnBelumBolehGunaSykt;
        $newincome->BakiLejar = $income->BakiLejarSykt;
        $newincome->save();

        // $checkprop = TaxElejar::where('fk_users','=',$id)->where('lejar_type','=','SYARIKAT')->where('income_type','=','PROPERTIES')->delete();

        //     $newprop = new TaxElejar;
        //     $newprop->fk_users           = $id;
        //     $newprop->lejar_type         = 'INDIVIDU';
        //     $newprop->income_type        = 'PROPERTIES';
        //     $newprop->description        = 'Cukai Keuntungan Harta Tanah';
        //     $newprop->BakiCukai          = $properties->BakiCukaiCKHT;
        //     $newprop->ByrnBelumBolehGuna = $properties->ByrnBelumBolehGunaCKHT;
        //     $newprop->BakiLejar          = $properties->BakiLejarCKHT;
        //     $newprop->save();

        // $profiledatacheck = TaxProfile::where('fk_users','=',$id)->first();
        // if($profiledatacheck)
        // {
        //     $profiledatacheck->IT_Collection_Branch = $profiledata->IT_Collection_Branch;
        //     $profiledatacheck->IT_Assm_Branch = $profiledata->IT_Assm_Branch;
        //     $profiledatacheck->CKHT_Assm_Branch = $profiledata->CKHT_Assm_Branch;
        //     $profiledatacheck->CKHT_Collection_Branch = $profiledata->CKHT_Collection_Branch;
        //     $profiledatacheck->Bank_CD = $profiledata->Bank_CD;
        //     $profiledatacheck->Bank_Acct_No = $profiledata->Bank_Acct_No;
        //     $profiledatacheck->Bank_Name = $profiledata->Bank_Name;
        //     $profiledatacheck->Name = $profiledata->Name;
        //     $profiledatacheck->IT_Grp_CD = $profiledata->IT_Grp_CD;
        //     $profiledatacheck->update();
        // }

        $checarrayclosing = TaxElejarDetail::where('fk_users', '=', $id)->where('lejar_type', '=', 'SYARIKAT')->delete();
        foreach ($arrayclosing as $key => $vclosing) {
            $arrayclosingnew = new TaxElejarDetail;
            $arrayclosingnew->fk_users = $id;
            $arrayclosingnew->lejar_type = 'SYARIKAT';
            $arrayclosingnew->income_type = 'SALARY';
            $arrayclosingnew->ASSESSMENT_YEAR = $vclosing->ASSESSMENT_YEAR;
            $arrayclosingnew->JumTggnCukai = $vclosing->JumTggnCukai;
            $arrayclosingnew->JumBayaranCukai = $vclosing->JumBayaranCukai;
            $arrayclosingnew->JumBersih = $vclosing->JumBersih;
            $arrayclosingnew->ByrnBelumBolehGuna = $vclosing->ByrnBelumBolehGuna;
            $arrayclosingnew->BakiCukaiSemasa = $vclosing->BakiCukaiSemasa;
            $arrayclosingnew->save();
        }

        $checarraycurrent = TaxElejarDetailCurrent::where('fk_users', '=', $id)->where('lejar_type', '=', 'SYARIKAT')
                                ->delete();

        foreach ($arraycurrent as $key => $vcal) {
            $arraycurrentnew = new TaxElejarDetailCurrent;
            $arraycurrentnew->fk_users = $id;
            $arraycurrentnew->lejar_type = 'SYARIKAT';
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

        // foreach ($arrayclosingprop as $key => $vclosing)
        // {

        //         $arrayclosingnew = new TaxElejarDetail;
        //         $arrayclosingnew->fk_users = $id;
        //         $arrayclosingnew->income_type = 'PROPERTIES';
        //         $arrayclosingnew->ASSESSMENT_YEAR = $vclosing->ASSESSMENT_YEAR;
        //         $arrayclosingnew->JumTggnCukai = $vclosing->JumTggnCukai;
        //         $arrayclosingnew->JumBayaranCukai = $vclosing->JumBayaranCukai;
        //         $arrayclosingnew->JumBersih = $vclosing->JumBersih;
        //         $arrayclosingnew->ByrnBelumBolehGuna = $vclosing->ByrnBelumBolehGuna;
        //         $arrayclosingnew->BakiCukaiSemasa = $vclosing->BakiCukaiSemasa;
        //         $arrayclosingnew->save();
        // }

        // $checarraycalendar = TaxElejarDetailCalendar::where('fk_users','=',$id)
        //                                             ->delete();

        // foreach ($arraycalendar as $key => $vcal)
        // {

        //     $arraycalnew = new TaxElejarDetailCalendar;
        //     $arraycalnew->fk_users = $id;
        //     $arraycalnew->income_type = 'SALARY';
        //     $arraycalnew->Tahun = $vcal->Tahun;
        //     $arraycalnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
        //     $arraycalnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
        //     $arraycalnew->SEQ_NO = $vcal->SEQ_NO;
        //     $arraycalnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
        //     $arraycalnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
        //     $arraycalnew->POSTED_DATE = $vcal->POSTED_DATE;
        //     $arraycalnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
        //     $arraycalnew->TYP = $vcal->TYP;
        //     $arraycalnew->AMT = $vcal->AMT;
        //     $arraycalnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
        //     $arraycalnew->TggnCukai = $vcal->TggnCukai;
        //     $arraycalnew->BayaranCukai = $vcal->BayaranCukai;
        //     $arraycalnew->DOC_NO = $vcal->DOC_NO;
        //     $arraycalnew->RECEIPT_NO = $vcal->RECEIPT_NO;
        //     $arraycalnew->Keterangan = $vcal->Keterangan;
        //     $arraycalnew->BRANCH_CODE = $vcal->BRANCH_CODE;
        //     $arraycalnew->BakiCukai = $vcal->BakiCukai;
        //     $arraycalnew->save();

        // }

        // foreach ($arraycalendarprop as $key => $vcal)
        // {

        //     $arraycalnew = new TaxElejarDetailCalendar;
        //     $arraycalnew->fk_users = $id;
        //     $arraycalnew->income_type = 'PROPERTIES';
        //     $arraycalnew->Tahun = $vcal->Tahun;
        //     $arraycalnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
        //     $arraycalnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
        //     $arraycalnew->SEQ_NO = $vcal->SEQ_NO;
        //     $arraycalnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
        //     $arraycalnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
        //     $arraycalnew->POSTED_DATE = $vcal->POSTED_DATE;
        //     $arraycalnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
        //     $arraycalnew->TYP = $vcal->TYP;
        //     $arraycalnew->AMT = $vcal->AMT;
        //     $arraycalnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
        //     $arraycalnew->TggnCukai = $vcal->TggnCukai;
        //     $arraycalnew->BayaranCukai = $vcal->BayaranCukai;
        //     $arraycalnew->DOC_NO = $vcal->DOC_NO;
        //     $arraycalnew->RECEIPT_NO = $vcal->RECEIPT_NO;
        //     $arraycalnew->Keterangan = $vcal->Keterangan;
        //     $arraycalnew->BRANCH_CODE = $vcal->BRANCH_CODE;
        //     $arraycalnew->BakiCukai = $vcal->BakiCukai;
        //     $arraycalnew->save();

        // }

        // foreach ($arraycurrentprop as $key => $vcal)
        // {

        //         $arraycurrentnew = new TaxElejarDetailCurrent;
        //         $arraycurrentnew->fk_users = $id;
        //         $arraycurrentnew->income_type = 'PROPERTIES';
        //         $arraycurrentnew->Tahun = $vcal->Tahun;
        //         $arraycurrentnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
        //         $arraycurrentnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
        //         $arraycurrentnew->SEQ_NO = $vcal->SEQ_NO;
        //         $arraycurrentnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
        //         $arraycurrentnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
        //         $arraycurrentnew->POSTED_DATE = $vcal->POSTED_DATE;
        //         $arraycurrentnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
        //         $arraycurrentnew->TYP = $vcal->TYP;
        //         $arraycurrentnew->AMT = $vcal->AMT;
        //         $arraycurrentnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
        //         $arraycurrentnew->TggnCukai = $vcal->TggnCukai;
        //         $arraycurrentnew->BayaranCukai = $vcal->BayaranCukai;
        //         $arraycurrentnew->DOC_NO = $vcal->DOC_NO;
        //         $arraycurrentnew->RECEIPT_NO = $vcal->RECEIPT_NO;
        //         $arraycurrentnew->Keterangan = $vcal->Keterangan;
        //         $arraycurrentnew->BRANCH_CODE = $vcal->BRANCH_CODE;
        //         $arraycurrentnew->BakiCukai = $vcal->BakiCukai;
        //         $arraycurrentnew->save();

        // }

        //pcb
        // $arraypcbcalcheck = TaxPcbDetailCalendar::where('fk_users','=',$id)
        //                         ->delete();

        // foreach ($arraypcbcal as $key => $vcal)
        // {

        //         $arraycalnew = new TaxPcbDetailCalendar;
        //         $arraycalnew->fk_users = $id;
        //         $arraycalnew->Tahun = $vcal->Tahun;
        //         $arraycalnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
        //         $arraycalnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
        //         $arraycalnew->SEQ_NO = $vcal->SEQ_NO;
        //         $arraycalnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
        //         $arraycalnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
        //         $arraycalnew->POSTED_DATE = $vcal->POSTED_DATE;
        //         $arraycalnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
        //         $arraycalnew->TYP = $vcal->TYP;
        //         $arraycalnew->AMT = $vcal->AMT;
        //         $arraycalnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
        //         $arraycalnew->TggnCukai = $vcal->TggnCukai;
        //         $arraycalnew->BayaranCukai = $vcal->BayaranCukai;
        //         $arraycalnew->DOC_NO = $vcal->DOC_NO;
        //         $arraycalnew->RECEIPT_NO = $vcal->RECEIPT_NO;
        //         $arraycalnew->Keterangan = $vcal->Keterangan;
        //         $arraycalnew->BRANCH_CODE = $vcal->BRANCH_CODE;
        //         $arraycalnew->BakiCukai = $vcal->BakiCukai;
        //         $arraycalnew->save();

        // }

        // $arraypcbtakcheck = TaxPcbDetailTahun::where('fk_users','=',$id)
        //                         ->delete();

        // foreach ($arraypcbtak as $key => $vcal)
        // {

        //         $arraycalnew = new TaxPcbDetailTahun;
        //         $arraycalnew->fk_users = $id;
        //         $arraycalnew->Tahun = $vcal->Tahun;
        //         $arraycalnew->ASSESSMENT_NO = $vcal->ASSESSMENT_NO;
        //         $arraycalnew->ASSESSMENT_YEAR = $vcal->ASSESSMENT_YEAR;
        //         $arraycalnew->SEQ_NO = $vcal->SEQ_NO;
        //         $arraycalnew->CALENDAR_YEAR = $vcal->CALENDAR_YEAR;
        //         $arraycalnew->TRANSACTION_CODE = $vcal->TRANSACTION_CODE;
        //         $arraycalnew->POSTED_DATE = $vcal->POSTED_DATE;
        //         $arraycalnew->TRANSACTION_DATE = $vcal->TRANSACTION_DATE;
        //         $arraycalnew->TYP = $vcal->TYP;
        //         $arraycalnew->AMT = $vcal->AMT;
        //         $arraycalnew->FK2_CRAL_BRCHCD = $vcal->FK2_CRAL_BRCHCD;
        //         $arraycalnew->TggnCukai = $vcal->TggnCukai;
        //         $arraycalnew->BayaranCukai = $vcal->BayaranCukai;
        //         $arraycalnew->DOC_NO = $vcal->DOC_NO;
        //         $arraycalnew->RECEIPT_NO = $vcal->RECEIPT_NO;
        //         $arraycalnew->Keterangan = $vcal->Keterangan;
        //         $arraycalnew->BRANCH_CODE = $vcal->BRANCH_CODE;
        //         $arraycalnew->BakiCukai = $vcal->BakiCukai;
        //         $arraycalnew->save();

        // }
    }

    //7
    public function api_spc()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
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

        $responses = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/eSPC')
          ->withData(
              [

                  'JnsSijil' => $user->doc_type,
                  'NoRujukan' => $user->tax_no,

              ]
          )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $content = $responses->content;
        $response = json_decode($content);

        if ($response == false) {
            $report = ApiReport::where('api_id', '=', '7')->first();
            if ($report) {
                $report->api_error = $responses->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 7;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPC';
                $newreport->api_error = $responses->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }
        }

        if (isset($response->Message)) {
            $report = ApiReport::where('api_id', '=', '7')->first();
            if ($report) {
                $report->api_error = $response->Message;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 7;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPC';
                $newreport->api_error = $response->Message;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }
        } else {
            $report = ApiReport::where('api_id', '=', '7')->delete();
            $data = $response->Model;

            $arrayspc = $data->ePSCData;

            $checkdataspc = TaxEspc::where('fk_users', '=', $id)
                                        ->delete();

            foreach ($arrayspc as $key => $data) {
                $taxp_itrefno = $data->taxp_itrefno;
                $empl_ref_no = $data->empl_ref_no;
                $stat = $data->stat;
                $new_ic_no = $data->new_ic_no;
                $old_ic_no = $data->old_ic_no;
                $police_army = $data->police_army;
                $passport = $data->passport;
                $FILE_TYPE = $data->FILE_TYPE;
                $TkhLoad = $data->TkhLoad;
                $Amt = $data->Amt;
                $JumlahAnsuran = $data->JumlahAnsuran;
                $BilAnsuranBayaran = $data->BilAnsuranBayaran;

                $newspc = new TaxEspc;
                $newspc->fk_users = $id;
                $newspc->taxp_itrefno = $data->taxp_itrefno;
                $newspc->empl_ref_no = $data->empl_ref_no;
                $newspc->stat = $data->stat;
                $newspc->new_ic_no = $data->new_ic_no;
                $newspc->old_ic_no = $data->old_ic_no;
                $newspc->police_army = $data->police_army;
                $newspc->passport = $data->passport;
                $newspc->FILE_TYPE = $data->FILE_TYPE;
                $newspc->TkhLoad = $data->TkhLoad;
                $newspc->Amt = $data->Amt;
                $newspc->JumlahAnsuran = $data->JumlahAnsuran;
                $newspc->BilAnsuranBayaran = $data->BilAnsuranBayaran;
                $newspc->save();
            }
        }

        // dd($response);
    }

    //8
    public function api_refundind()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responserefunds = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/RefundStatus')
            ->withData(
                [
                    'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentrefund = $responserefunds->content;
        $responsrefund = json_decode($contentrefund);

        // dd($responserefund);

        if ($responsrefund == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '8')->first();
            if ($report) {
                $report->api_error = $responserefunds->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 8;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/RefundStatus';
                $newreport->api_error = $responserefunds->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsrefund->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '8')->first();
            if ($report) {
                $report->api_error = $responsrefund->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 8;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/RefundStatus';
                $newreport->api_error = $responsrefund->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsrefund->Success == true) {
                // dd('sini');
                $data[] = $responsrefund->Model->RekodStatusRefund;
                $report = ApiReport::where('api_id', '=', '8')->delete();

                return $data;
            }
        }
    }

    //8
    public function api_refundindc($data)
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        // $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responserefunds = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/RefundStatus')
            ->withData(
                [
                    'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentrefund = $responserefunds->content;
        $responsrefund = json_decode($contentrefund);

        // dd($responsrefund);

        if (isset($responsrefund->Message)) {
            // $data = [];
            $report = ApiReport::where('api_id', '=', '8')->first();
            if ($report) {
                $report->api_error = $responsrefund->Message;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 8;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/RefundStatus';
                $newreport->api_error = $responsrefund->Message;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if ($responsrefund == false) {
            // $data = [];
            $report = ApiReport::where('api_id', '=', '8')->first();
            if ($report) {
                $report->api_error = $responserefunds->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 8;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/RefundStatus';
                $newreport->api_error = $responserefunds->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsrefund->ErrorMessage)) {
            // $data = [];
            $report = ApiReport::where('api_id', '=', '8')->first();
            if ($report) {
                $report->api_error = $responsrefund->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 8;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/RefundStatus';
                $newreport->api_error = $responsrefund->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsrefund->Success == true) {
                if ($responsrefund->Model->RekodStatusRefund) {

                    // $data['INDIVIDU'] = $responsrefund->Model->RekodStatusRefund;

                    $year = [];

                    foreach ($responsrefund->Model->RekodStatusRefund as $key => $value) {
                        // if(isset $year[$value->yr])
                        // {
                        $year[$value->yr][] =

                             [
                                 'seq'               => $value->seq,
                                 'tkh'               => $value->tkh,
                                 'Keteranganbm'      => $value->Keteranganbm,
                                 'Keteranganbi'      => $value->Keteranganbi,
                                 'ktrgan_pembatalan' => $value->ktrgan_pembatalan,
                                 'amt'               => $value->amt,
                                 'type'              => $value->type,
                                 'Kategori'          => $value->Kategori,
                                 'yr'                => $value->yr,

                             ];
                        // }
                    }

                    if ($user->language == 'en') {
                        $data['INDIVIDUAL'] = $year;
                        krsort($data['INDIVIDUAL'], SORT_NUMERIC);
                    } else {
                        $data['INDIVIDU'] = $year;
                        krsort($data['INDIVIDU'], SORT_NUMERIC);
                    }
                } else {
                }

                $report = ApiReport::where('api_id', '=', '8')->delete();

                return $data;
            }
        }
    }

    //9
    public function api_refundcom()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $comprofile = Comlist::where('fk_users', '=', $id)->count();
        if ($comprofile > 0) {
            $comprofile = Comlist::where('fk_users', '=', $id)->where('Status_OeF', '=', 'Aktif')->get();
            foreach ($comprofile as $key => $value) {
                $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
                $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
                $nonce = $randnumber;
                $string = $userid.$key.$nonce.$epoch;
                $token = hash_hmac('sha256', $string, $key);
                $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

                $noru = ltrim($value->No_Rujukan, '0');
                if (strlen($noru) > 8) {
                    $newrujukan = $noru;
                } else {
                    $newrujukan = '0'.$noru;
                }

                $responserefunds = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/RefundSyarikat')
                        ->withData(
                            [
                                'JnsSijil' => $value->Jenis_File, //$user->doc_type,
                                'NoRujukan' => $newrujukan, //'2121760800',//$user->tax_no
                            ]
                        )
                        ->withHeaders(['ApiAuthorization:'.$auth])
                        ->returnResponseObject()
                        ->post();

                $contentrefund = $responserefunds->content;
                $responsrefund = json_decode($contentrefund);

                if ($responsrefund == false) {
                    $datarespond = [];
                    $report = ApiReport::where('api_id', '=', '9')->first();
                    if ($report) {
                        $report->api_error = $responserefunds->error;
                        $report->date = date('Y-m-d h:i:s');
                        $report->update();
                    } else {
                        $newreport = new ApiReport;
                        $newreport->api_id = 9;
                        $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/RefundSyarikat';
                        $newreport->api_error = $responserefunds->error;
                        $newreport->date = date('Y-m-d h:i:s');
                        $newreport->save();
                    }
                }
                // dd($responserefund);
                if (isset($responsrefund->ErrorMessage)) {
                    $data = [];
                    $report = ApiReport::where('api_id', '=', '9')->first();
                    if ($report) {
                        $report->api_error = $responsrefund->ErrorMessage;
                        $report->date = date('Y-m-d h:i:s');
                        $report->update();
                    } else {
                        $newreport = new ApiReport;
                        $newreport->api_id = 9;
                        $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/RefundSyarikat';
                        $newreport->api_error = $responsrefund->ErrorMessage;
                        $newreport->date = date('Y-m-d h:i:s');
                        $newreport->save();
                    }
                } else {

                    // $datarespond = $responsrefund->Model->RefundStatusSyarikat;
                    $report = ApiReport::where('api_id', '=', '9')->delete();

                    if (isset($responsrefund->Success)) {
                        if ($responsrefund->Success == false) {
                            $data = [];
                        } else {
                            if ($responsrefund->Model->RefundStatusSyarikat) {
                                // $data[$value->Nama_Syarikat] = $responsrefund->Model->RefundStatusSyarikat;

                                foreach ($responsrefund->Model->RefundStatusSyarikat as $key => $values) {
                                    $data[$value->Nama_Syarikat][] =

                                        [
                                            'seq'               => $values->seq,
                                            'tkh'               => $values->tkh,
                                            'Keteranganbm'      => $values->Keteranganbm,
                                            'Keteranganbi'      => $values->Keteranganbi,
                                            'ktrgan_pembatalan' => $values->ktrgan_pembatalan,
                                            'amt'               => $values->amt,
                                            'type'              => $values->type,

                                        ];
                                }
                            }
                        }
                    } else {
                        $data = [];
                    }
                }
            }
        }

        $datas['COMPANY'] = $data;

        return $this->api_refundindc($datas);

        // return $data;
    }

    //10
    public function api_spccom()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
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
        try {
            $responsespcs = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/eSPCSyarikat')
              ->withData(
                  [
                      'JnsSijil' => $user->doc_type,
                      'NoRujukan' => $user->tax_no,
                  ]
              )
                ->withHeaders(['ApiAuthorization:'.$auth])
                ->returnResponseObject()
                ->post();

            $contentspc = $responsespcs->content;
            $responsespc = json_decode($contentspc);

            // dd($responsespc);

            if ($responsespc == null) {
                $data = [];
                $report = ApiReport::where('api_id', '=', '10')->first();
                if ($report) {
                    $report->api_error = $responsespcs->error;
                    $report->date = date('Y-m-d h:i:s');
                    $report->update();
                } else {
                    $newreport = new ApiReport;
                    $newreport->api_id = 10;
                    $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPCSyarikat';
                    $newreport->api_error = $responsespcs->error;
                    $newreport->date = date('Y-m-d h:i:s');
                    $newreport->save();
                }

                return $data;
            }
            if ($responsespc == false) {
                $data = [];
                $report = ApiReport::where('api_id', '=', '10')->first();
                if ($report) {
                    $report->api_error = $responsespcs->error;
                    $report->date = date('Y-m-d h:i:s');
                    $report->update();
                } else {
                    $newreport = new ApiReport;
                    $newreport->api_id = 10;
                    $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPCSyarikat';
                    $newreport->api_error = $responsespcs->error;
                    $newreport->date = date('Y-m-d h:i:s');
                    $newreport->save();
                }

                return $data;
            }

            if ($responsespc->Success == false) {
                $data = [];
                $report = ApiReport::where('api_id', '=', '10')->first();
                if ($report) {
                    $report->api_error = $responsespc->ErrorMessage;
                    $report->date = date('Y-m-d h:i:s');
                    $report->update();
                } else {
                    $newreport = new ApiReport;
                    $newreport->api_id = 10;
                    $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPCSyarikat';
                    $newreport->api_error = $responsespc->ErrorMessage;
                    $newreport->date = date('Y-m-d h:i:s');
                    $newreport->save();
                }

                return $data;
            }

            if (isset($responsespc->Message)) {
                $data = [];
                $report = ApiReport::where('api_id', '=', '10')->first();
                if ($report) {
                    $report->api_error = $responsespc->Message;
                    $report->date = date('Y-m-d h:i:s');
                    $report->update();
                } else {
                    $newreport = new ApiReport;
                    $newreport->api_id = 10;
                    $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPCSyarikat';
                    $newreport->api_error = $responsespc->Message;
                    $newreport->date = date('Y-m-d h:i:s');
                    $newreport->save();
                }

                return $data;
            } else {

                // return $responsespc->Model->DetailRekod204;

                if (! isset($responsespc->Success)) {

                    // dd($response204->ErrorMessage);
                } else {
                    $report = ApiReport::where('api_id', '=', '10')->delete();

                    $checkdataspc = TaxEspc::where('fk_users', '=', $id)->delete();

                    $data = $responsespc->Model;

                    $arrayspc = $data->ePSCSyarikatData;

                    foreach ($arrayspc as $key => $data) {
                        $taxp_itrefno = trim($data->taxp_itrefno);
                        $empl_ref_no = trim($data->empl_ref_no);
                        $stat = $data->stat;
                        $name = trim($data->name);
                        $new_ic_no = $data->new_ic_no;
                        $old_ic_no = $data->old_ic_no;
                        $police_army = $data->police_army;
                        $passport = $data->passport;
                        $FILE_TYPE = $data->FILE_TYPE;
                        $TkhLoad = $data->TkhLoad;
                        $Amt = $data->Amt;
                        // $JumlahAnsuran = $data->JumlahAnsuran;
                        // $BilAnsuranBayaran = $data->BilAnsuranBayaran;

                        $newspc = new TaxEspc;
                        $newspc->fk_users = $id;
                        $newspc->taxp_itrefno = $user->doc_type.' '.trim($data->taxp_itrefno);
                        $newspc->empl_ref_no = trim($data->empl_ref_no);
                        $newspc->name = trim($data->name);
                        $newspc->stat = $data->stat;
                        $newspc->statbi = $data->statBI;
                        $newspc->new_ic_no = $data->new_ic_no;
                        $newspc->old_ic_no = $data->old_ic_no;
                        $newspc->police_army = $data->police_army;
                        $newspc->passport = $data->passport;
                        $newspc->FILE_TYPE = $data->FILE_TYPE;
                        $newspc->TkhLoad = $data->TkhLoad;
                        $newspc->Amt = $data->Amt;
                        // $newspc->JumlahAnsuran = $data->JumlahAnsuran;
                        // $newspc->BilAnsuranBayaran = $data->BilAnsuranBayaran;
                        $newspc->save();
                    }
                }
            }
        } catch (RequestException $e) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '10')->first();
            if ($report) {
                $report->api_error = $e;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 10;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPCSyarikat';
                $newreport->api_error = $responsespc->Message;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }
    }

    public function api_comlist()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
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

        // dd($responsrefund);

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

    //6
    public function api_elejarcomlist($ids)
    {
        $idc = $ids;
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $comprofile = Comlist::where('id', '=', $idc)->first();

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

        $checkincome = TaxElejar::where('fk_users', '=', $id)->where('lejar_type', '=', 'SYARIKAT')->where('income_type', '=', 'SALARY')->delete();

        // dd($properties);

        $newincome = new TaxElejar;
        $newincome->fk_users = $id;
        $newincome->lejar_type = 'SYARIKAT';
        $newincome->income_type = 'SALARY';
        $newincome->description = 'Cukai Pendapatan';
        $newincome->BakiCukai = $baki;
        $newincome->ByrnBelumBolehGuna = $income->ByrnBelumBolehGunaSykt;
        $newincome->BakiLejar = $income->BakiLejarSykt;
        $newincome->save();

        $checkprop = TaxElejar::where('fk_users', '=', $id)->where('lejar_type', '=', 'SYARIKAT')->where('income_type', '=', 'PROPERTIES')->delete();

        $newprop = new TaxElejar;
        $newprop->fk_users = $id;
        $newprop->lejar_type = 'SYARIKAT';
        $newprop->income_type = 'PROPERTIES';
        $newprop->description = 'Cukai Keuntungan Harta Tanah';
        $newprop->BakiCukai = $bakickht;
        $newprop->ByrnBelumBolehGuna = $properties->ByrnBelumBolehGunaCKHT;
        $newprop->BakiLejar = $properties->BakiLejarCKHT;
        $newprop->save();

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

        $checarrayclosing = TaxElejarDetail::where('fk_lkp_tcl', '=', $idc)->delete();
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

        $checarraycurrent = TaxElejarDetailCurrent::where('fk_lkp_tcl', '=', $idc)->delete();

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

        $checarraycalendar = TaxElejarDetailCalendar::where('fk_lkp_tcl', '=', $idc)->delete();

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
    }

    //11
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
                    'NoRujukan' => $newrujukan,
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

        // dd($responsrefund);
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
                // dd('sini');
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

    //10
    public function api_spclist()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];
        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $comprofile = Comlist::where('fk_users', '=', $id)->count();
        // dd($comprofile);
        if ($comprofile > 0) {
            $comprofile = Comlist::where('fk_users', '=', $id)->get();
            $checkdataspc = TaxEspc::where('fk_users', '=', $id)->delete();
            // dd('sini');
            foreach ($comprofile as $key => $value) {
                $noru = ltrim($value->No_Rujukan, '0');
                if (strlen($noru) > 8) {
                    $newrujukan = $noru;
                } else {
                    $newrujukan = '0'.$noru;
                }

                $responsespcs = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/eSPCSyarikat')
                        ->withData(
                            [
                                'JnsSijil' => $value->Jenis_File, //$user->doc_type,
                                'NoRujukan' => $newrujukan, //'2121760800',//$user->tax_no
                            ]
                        )
                        ->withHeaders(['ApiAuthorization:'.$auth])
                        ->returnResponseObject()
                        ->post();

                $contentspc = $responsespcs->content;
                $responsespc = json_decode($contentspc);

                if ($responsespc == false) {
                    $data = [];
                    $report = ApiReport::where('api_id', '=', '10')->first();
                    if ($report) {
                        $report->api_error = $responsespcs->error;
                        $report->date = date('Y-m-d h:i:s');
                        $report->update();
                    } else {
                        $newreport = new ApiReport;
                        $newreport->api_id = 10;
                        $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPCSyarikat';
                        $newreport->api_error = $responsespcs->error;
                        $newreport->date = date('Y-m-d h:i:s');
                        $newreport->save();
                    }

                    return $data;
                }
                // dd($responsespc);
                if (isset($responsespc->Message)) {
                    $data = [];
                    $report = ApiReport::where('api_id', '=', '10')->first();
                    if ($report) {
                        $report->api_error = $responsespc->Message;
                        $report->date = date('Y-m-d h:i:s');
                        $report->update();
                    } else {
                        $newreport = new ApiReport;
                        $newreport->api_id = 10;
                        $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPCSyarikat';
                        $newreport->api_error = $responsespc->Message;
                        $newreport->date = date('Y-m-d h:i:s');
                        $newreport->save();
                    }

                    return $data;
                } else {

                    // return $responsespc->Model->DetailRekod204;

                    if ($responsespc->Success == false) {

                        // dd($response204->ErrorMessage);
                    } else {
                        $report = ApiReport::where('api_id', '=', '10')->delete();

                        $data = $responsespc->Model;

                        $arrayspc = $data->ePSCSyarikatData;

                        foreach ($arrayspc as $key => $data) {
                            $taxp_itrefno = trim($data->taxp_itrefno);
                            $empl_ref_no = trim($data->empl_ref_no);
                            $name = trim($data->name);
                            $stat = $data->stat;
                            $new_ic_no = $data->new_ic_no;
                            $old_ic_no = $data->old_ic_no;
                            $police_army = $data->police_army;
                            $passport = $data->passport;
                            $FILE_TYPE = $data->FILE_TYPE;
                            $TkhLoad = $data->TkhLoad;
                            $Amt = $data->Amt;
                            // $JumlahAnsuran = $data->JumlahAnsuran;
                            // $BilAnsuranBayaran = $data->BilAnsuranBayaran;

                            $newspc = new TaxEspc;
                            $newspc->fk_users = $id;
                            $newspc->taxp_itrefno = $value->Jenis_File.' '.trim($data->taxp_itrefno);
                            $newspc->empl_ref_no = trim($data->empl_ref_no);
                            $newspc->name = trim($data->name);
                            $newspc->stat = $data->stat;
                            $newspc->new_ic_no = $data->new_ic_no;
                            $newspc->old_ic_no = $data->old_ic_no;
                            $newspc->police_army = $data->police_army;
                            $newspc->passport = $data->passport;
                            $newspc->FILE_TYPE = $data->FILE_TYPE;
                            $newspc->TkhLoad = $data->TkhLoad;
                            $newspc->Amt = $data->Amt;
                            // $newspc->JumlahAnsuran = $data->JumlahAnsuran;
                            // $newspc->BilAnsuranBayaran = $data->BilAnsuranBayaran;
                            $newspc->save();
                        }
                    }
                }
            }
        }

        $responses = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/eSPC')
              ->withData(
                  [

                      'JnsSijil' => $user->doc_type,
                      'NoRujukan' => $user->tax_no,

                  ]
              )
                ->withHeaders(['ApiAuthorization:'.$auth])
                ->returnResponseObject()
                ->post();

        $content = $responses->content;
        $response = json_decode($content);
        // dd($response);

        if ($response == false) {
            $report = ApiReport::where('api_id', '=', '7')->first();
            if ($report) {
                $report->api_error = $responses->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 7;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPC';
                $newreport->api_error = $responses->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        }

        if (isset($response->Message)) {
            $report = ApiReport::where('api_id', '=', '7')->first();
            if ($report) {
                $report->api_error = $response->Message;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 7;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPC';
                $newreport->api_error = $response->Message;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return 0;
        } else {
            if (! isset($response->Model)) {
                $report = ApiReport::where('api_id', '=', '7')->first();
                if ($report) {
                    $report->api_error = $responses->error;
                    $report->date = date('Y-m-d h:i:s');
                    $report->update();
                } else {
                    $newreport = new ApiReport;
                    $newreport->api_id = 7;
                    $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eSPC';
                    $newreport->api_error = $responses->error;
                    $newreport->date = date('Y-m-d h:i:s');
                    $newreport->save();
                }

                return 0;
            }

            $report = ApiReport::where('api_id', '=', '7')->delete();
            $data = $response->Model;

            $arrayspc = $data->ePSCData;

            $checkdataspc = TaxEspc::where('fk_users', '=', $id)->delete();
            foreach ($arrayspc as $key => $data) {
                $taxp_itrefno = trim($data->taxp_itrefno);
                $empl_ref_no = trim($data->empl_ref_no);
                $stat = $data->stat;
                $new_ic_no = $data->new_ic_no;
                $old_ic_no = $data->old_ic_no;
                $police_army = $data->police_army;
                $passport = $data->passport;
                $FILE_TYPE = $data->FILE_TYPE;
                $TkhLoad = $data->TkhLoad;
                $Amt = $data->Amt;
                // $JumlahAnsuran = $data->JumlahAnsuran;
                // $BilAnsuranBayaran = $data->BilAnsuranBayaran;

                $newspc = new TaxEspc;
                $newspc->fk_users = $id;
                $newspc->taxp_itrefno = $user->doc_type.' '.trim($data->taxp_itrefno);
                $newspc->empl_ref_no = trim($data->empl_ref_no);
                $newspc->name = trim($users->name);
                $newspc->stat = $data->stat;
                $newspc->new_ic_no = $data->new_ic_no;
                $newspc->old_ic_no = $data->old_ic_no;
                $newspc->police_army = $data->police_army;
                $newspc->passport = $data->passport;
                $newspc->FILE_TYPE = $data->FILE_TYPE;
                $newspc->TkhLoad = $data->TkhLoad;
                $newspc->Amt = $data->Amt;
                // $newspc->JumlahAnsuran = $data->JumlahAnsuran;
                // $newspc->BilAnsuranBayaran = $data->BilAnsuranBayaran;
                $newspc->save();
            }
        }

        return $this->api_spccom();

        // return $this->api_refundindc($data);

        return 0;
    }

    public function api_graph()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $donuts = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCukaiDonut')
            ->withData(
                [
                    // 'JnsSijil' => 'SG',//$user->doc_type,
                    // 'NoRujukan' => '20388708050',//$user->tax_no
                    'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $graph = $donuts->content;
        $responsgraph = json_decode($graph);

        // dd($responsgraph);

        if ($responsgraph == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '12')->first();
            if ($report) {
                $report->api_error = $donuts->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 12;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCukaiDonut';
                $newreport->api_error = $donuts->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsgraph->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '12')->first();
            if ($report) {
                $report->api_error = $responsgraph->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 12;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/LejarCukaiDonut';
                $newreport->api_error = $responsgraph->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsgraph->Success == true) {
                $report = ApiReport::where('api_id', '=', '12')->delete();
                if ($responsgraph->Model->DonutIndModel) {
                    $data[] = $responsgraph->Model->DonutIndModel;

                    return $data;
                }

                if ($responsgraph->Model->DonutSyktModel) {
                    $data[] = $responsgraph->Model->DonutSyktModel;

                    return $data;
                }

                return $data;
            }
        }
    }

    public function api_cp500surat()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responsecp500j = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/CP500CetakSurat')
            ->withData(
                [
                    'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        // dd($responsecp500);

        $contentrefund = $responsecp500j->content;
        $responsecp500s = json_decode($contentrefund);

        if ($responsecp500s == false) {
            $datarespond = [];
            $report = ApiReport::where('api_id', '=', '14')->first();
            if ($report) {
                $report->api_error = $responsecp500j->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 14;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/CP500CetakSurat';
                $newreport->api_error = $responsecp500j->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }
        }

        if (isset($responsecp500s->ErrorMessage)) {
            $datarespond = [];
            $report = ApiReport::where('api_id', '=', '14')->first();
            if ($report) {
                $report->api_error = $responsecp500s->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 14;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/CP500CetakSurat';
                $newreport->api_error = $responsecp500s->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }
        } else {

            // $datarespond = $responsrefund->Model->RefundStatusSyarikat;
            $report = ApiReport::where('api_id', '=', '14')->delete();

            if (isset($responsecp500s->Success)) {
                if ($responsecp500s->Success == false) {
                    $data = [];
                } else {
                    $data = $responsecp500s->Model;
                }
            } else {
                $data = [];
            }
        }

        return $data;
    }

    //15
    public function api_ebe()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responseebe = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/eBE_Submit')
            ->withData(
                [
                    // 'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentebe = $responseebe->content;
        $responsebe = json_decode($contentebe);

        $test[] = [
            'url' => 'https://mytax2.hasil.gov.my/MyTaxAPI/api/eBE_Submit',
            'return' => $responsebe->Model,
        ];

        // dd($test);

        if ($responsebe == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '15')->first();
            if ($report) {
                $report->api_error = $responseebe->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 15;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/eBE_Submit';
                $newreport->api_error = $responseebe->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsebe->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '15')->first();
            if ($report) {
                $report->api_error = $responsebe->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 15;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/eBE_Submit';
                $newreport->api_error = $responsebe->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsebe->Success == true) {
                // dd('sini');
                $data[] = $responsebe->Model;
                $report = ApiReport::where('api_id', '=', '15')->delete();

                return $data;
            }
        }
    }

    public function api_ebe2()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responseebe = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/eBESubmit18')
            ->withData(
                [
                    // 'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentebe = $responseebe->content;
        $responsebe = json_decode($contentebe);

        // dd($responseebe);

        if ($responsebe == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '15')->first();
            if ($report) {
                $report->api_error = $responseebe->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 15;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/eBESubmit18';
                $newreport->api_error = $responseebe->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsebe->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '15')->first();
            if ($report) {
                $report->api_error = $responsebe->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 15;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/eBESubmit18';
                $newreport->api_error = $responsebe->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsebe->Success == true) {
                // dd('sini');
                $data[] = $responsebe->Model;
                $report = ApiReport::where('api_id', '=', '15')->delete();

                return $data;
            }
        }
    }

    public function api_ebelogin()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responseebe = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/eBETkhLog2019')
            ->withData(
                [
                    // 'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentebe = $responseebe->content;
        $responsebe = json_decode($contentebe);

        // dd($responseebe);

        if ($responsebe == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '16')->first();
            if ($report) {
                $report->api_error = $responseebe->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 16;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/eBETkhLog2019';
                $newreport->api_error = $responseebe->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsebe->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '16')->first();
            if ($report) {
                $report->api_error = $responsebe->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 16;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/eBETkhLog2019';
                $newreport->api_error = $responsebe->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsebe->Success == true) {
                // dd('sini');
                // dd($responsebe);
                $data[] = $responsebe->Model;
                $report = ApiReport::where('api_id', '=', '16')->delete();

                // dd($data);
                return $data;
            }
        }
    }

    public function api_ebelogin2()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responseebe = Curl::to('https://mytax2.hasil.gov.my/MyTaxAPI/api/eBETkhLog2018')
            ->withData(
                [
                    // 'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentebe = $responseebe->content;
        $responsebe = json_decode($contentebe);

        // dd($responseebe);

        if ($responsebe == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '16')->first();
            if ($report) {
                $report->api_error = $responseebe->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 16;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/eBETkhLog2018';
                $newreport->api_error = $responseebe->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsebe->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '16')->first();
            if ($report) {
                $report->api_error = $responsebe->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 16;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/eBETkhLog2018';
                $newreport->api_error = $responsebe->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsebe->Success == true) {
                // dd('sini');
                // dd($responsebe);
                $data[] = $responsebe->Model;
                $report = ApiReport::where('api_id', '=', '16')->delete();

                // dd($data);
                return $data;
            }
        }
    }

    public function api_eBE_TkhLog()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responseebe = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/eBE_TkhLog')
            ->withData(
                [
                    // 'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentebe = $responseebe->content;
        $responsebe = json_decode($contentebe);

        // dd($responseebe);

        if ($responsebe == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '16')->first();
            if ($report) {
                $report->api_error = $responseebe->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 16;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/eBETkhLog2018';
                $newreport->api_error = $responseebe->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsebe->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '16')->first();
            if ($report) {
                $report->api_error = $responsebe->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 16;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxAPI/api/eBETkhLog2018';
                $newreport->api_error = $responsebe->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsebe->Success == true) {
                // dd('sini');
                // dd($responsebe);
                $data[] = $responsebe->Model;
                $report = ApiReport::where('api_id', '=', '16')->delete();

                // dd($data);
                return $data;
            }
        }
    }

    public function api_sekatan()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '0';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        // $userid = '766DD633-2AEA-4118-A50C-90816130EA3D';
        // $key = 'g9QjKIzyAuk0xj6U67KobRAceOa7EK2fWhWiSAu+BOBnejaVetCbkyBdoqUhnhn6vjz2N1BivU7UqQkQcLgvEw==';

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';

        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        try {
            $response = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/sekatanperjalanan')
            ->withData(
                [
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

            $content = $response->content;
            $responsekatan = json_decode($content);

            $datas = [

                'userid' => '766DD633-2AEA-4118-A50C-90816130EA3D',
                'key' => 'g9QjKIzyAuk0xj6U67KobRAceOa7EK2fWhWiSAu+BOBnejaVetCbkyBdoqUhnhn6vjz2N1BivU7UqQkQcLgvEw==',
                'api url' => 'https://mytax2.hasil.gov.my/MyTaxApi/api/sekatanperjalanan',
                'NoRujukan' => $user->tax_no,
                'result' => $responsekatan,

            ];
            // dd($datas);

            if ($content == false) {
                $report = ApiReport::where('api_id', '=', '17')->first();
                if ($report) {
                    $report->api_error = $response->error;
                    $report->date = date('Y-m-d h:i:s');
                    $report->update();
                } else {
                    $newreport = new ApiReport;
                    $newreport->api_id = 17;
                    $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/sekatanperjalanan';
                    $newreport->api_error = $response->error;
                    $newreport->date = date('Y-m-d h:i:s');
                    $newreport->save();
                }

                return $data;
            }

            if (isset($responsekatan->ErrorMessage)) {
                $report = ApiReport::where('api_id', '=', '17')->first();
                if ($report) {
                    $report->api_error = $responsekatan->ErrorMessage;
                    $report->date = date('Y-m-d h:i:s');
                    $report->update();
                } else {
                    $newreport = new ApiReport;
                    $newreport->api_id = 17;
                    $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/sekatanperjalanan';
                    $newreport->api_error = $responsekatan->ErrorMessage;
                    $newreport->date = date('Y-m-d h:i:s');
                    $newreport->save();
                }

                return $data;
            } else {

                // return $responsespc->Model->DetailRekod204;

                if ($responsekatan->Success == true) {
                    $report = ApiReport::where('api_id', '=', '17')->delete();

                    $data = $responsekatan->Model->SekatanPerjalananData;
                    // dd($data);

                    if ($data == []) {
                        // dd('xde');

                        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
                        $checkprofile->tax_restrain = $sekatan;
                        $checkprofile->update();
                    } else {
                        // dd('ade');
                        $sekatan = 1;
                        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
                        $checkprofile->tax_restrain = $sekatan;
                        $checkprofile->update();
                    }
                }

                return $data;
            }
        } catch (RequestException $e) {
            $report = ApiReport::where('api_id', '=', '17')->first();
            if ($report) {
                $report->api_error = $e;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 17;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/sekatanperjalanan';
                $newreport->api_error = $e;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }
    }

    public function api_ebe20()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responseebe = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/eBE_Submit20')
            ->withData(
                [
                    // 'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentebe = $responseebe->content;
        $responsebe = json_decode($contentebe);

        // dd($responseebe);

        if ($responsebe == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '15')->first();
            if ($report) {
                $report->api_error = $responseebe->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 15;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eBE_Submit20';
                $newreport->api_error = $responseebe->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsebe->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '15')->first();
            if ($report) {
                $report->api_error = $responsebe->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 15;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eBE_Submit20';
                $newreport->api_error = $responsebe->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsebe->Success == true) {
                // dd('sini');
                $data[] = $responsebe->Model;
                $report = ApiReport::where('api_id', '=', '15')->delete();

                return $data;
            }
        }
    }

    public function api_ebelogin20()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responseebe = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/eBETkhLog20')
            ->withData(
                [
                    // 'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentebe = $responseebe->content;
        $responsebe = json_decode($contentebe);

        // dd($responseebe);

        if ($responsebe == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '16')->first();
            if ($report) {
                $report->api_error = $responseebe->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 16;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eBETkhLog20';
                $newreport->api_error = $responseebe->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsebe->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '16')->first();
            if ($report) {
                $report->api_error = $responsebe->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 16;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eBETkhLog20';
                $newreport->api_error = $responsebe->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsebe->Success == true) {
                // dd('sini');
                // dd($responsebe);
                $data[] = $responsebe->Model;
                $report = ApiReport::where('api_id', '=', '16')->delete();

                // dd($data);
                return $data;
            }
        }
    }

    public function api_cp500test($a, $b, $c)
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
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

        //checkinbox :

        // $a = '1018012';
        // $b = 'SG';
        // $c = '20956855000';

        $response500s = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/CP500')
                ->withData(
                    [
                        'RefID' => $a,
                        'JnsSijil' => $b,
                        'RefNo' => $c,
                        'Sumber' => 'CP500',
                    ]
                )

                ->withHeaders(['ApiAuthorization:'.$auth])
                ->returnResponseObject()
                ->post();
        dd($response500s);

        $content500 = $response500s->content;
        $response500 = json_decode($content500);

        $data = [

            'JnsSijil' => $b,
            'NoRujukan' => $c,
            'RefNo' => $a,
            'API RETURN' => $response500s,
        ];

        dd($data);
    }

    public function api_ebe21()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responseebe = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/eBE_Submit21')
            ->withData(
                [
                    // 'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentebe = $responseebe->content;
        $responsebe = json_decode($contentebe);

        $datas = [
            'API' => 'https://mytax2.hasil.gov.my/MyTaxApi/api/eBE_Submit21',
            'NoRujukan' => $user->tax_no,
            'result' => $responseebe,
        ];

        // dd($datas);

        if ($responsebe == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '15')->first();
            if ($report) {
                $report->api_error = $responseebe->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 15;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eBE_Submit21';
                $newreport->api_error = $responseebe->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsebe->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '15')->first();
            if ($report) {
                $report->api_error = $responsebe->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 15;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eBE_Submit21';
                $newreport->api_error = $responsebe->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;
            if (isset($responsebe->Success)) {
                if ($responsebe->Success == true) {
                    // dd('sini');
                    $data[] = $responsebe->Model;
                    $report = ApiReport::where('api_id', '=', '15')->delete();

                    return $data;
                }
            }
        }
    }

    public function api_ebelogin21()
    {
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();
        $randnumber = rand(1000000000, 2000000000);
        $epoch = time();
        $sekatan = '1';
        $baki = '0.00';
        $refund = '0.00';
        $inbox = 0;
        $data = [];

        $userid = '5C0860C2-8746-4548-8E75-F8BF476F92D9';
        $key = 'ePXWiyyp65N1afx/gL8zwzkNhcAp9ZxKS/Yf3wIBv7Kq0hIa9BdP3d4rdBfKGbEweBs1ZsRfJ6jT9vo+46ySTw==';
        $nonce = $randnumber;
        $string = $userid.$key.$nonce.$epoch;
        $token = hash_hmac('sha256', $string, $key);
        $auth = $userid.':'.$token.':'.$nonce.':'.$epoch;

        $responseebe = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/eBETkhLog21')
            ->withData(
                [
                    // 'JnsSijil' => $user->doc_type,
                    'NoRujukan' => $user->tax_no,
                ]
            )
            ->withHeaders(['ApiAuthorization:'.$auth])
            ->returnResponseObject()
            ->post();

        $contentebe = $responseebe->content;
        $responsebe = json_decode($contentebe);

        // dd($responseebe);

        if ($responsebe == false) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '16')->first();
            if ($report) {
                $report->api_error = $responseebe->error;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 16;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eBETkhLog21';
                $newreport->api_error = $responseebe->error;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        }

        if (isset($responsebe->ErrorMessage)) {
            $data = [];
            $report = ApiReport::where('api_id', '=', '16')->first();
            if ($report) {
                $report->api_error = $responsebe->ErrorMessage;
                $report->date = date('Y-m-d h:i:s');
                $report->update();
            } else {
                $newreport = new ApiReport;
                $newreport->api_id = 16;
                $newreport->api_url = 'https://mytax2.hasil.gov.my/MyTaxApi/api/eBETkhLog21';
                $newreport->api_error = $responsebe->ErrorMessage;
                $newreport->date = date('Y-m-d h:i:s');
                $newreport->save();
            }

            return $data;
        } else {

            // return $responsespc->Model->DetailRekod204;

            if ($responsebe->Success == true) {
                // dd('sini');
                // dd($responsebe);
                $data[] = $responsebe->Model;
                $report = ApiReport::where('api_id', '=', '16')->delete();

                // dd($data);
                return $data;
            }
        }
    }
}
