<?php

namespace App\Data\Repo;

use App\Models\LkpTemplate;
use App\Models\MngApp;
use App\Models\MngService;
use App\Models\TaxCp500;
use App\Models\TaxInbox;
use App\Models\TaxProfile;
use App\Models\TaxTemplate;
use App\Models\UserSetting;
use App\User;
use Auth;
use Carbon\Carbon;
use Curl;
use DateTime;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

/**
 * @author wan.rizuan@3fresources.com
 **/
class TemplateRepo
{
    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function template($id)
    {
        $templatebody = '';

        $language = \App::getLocale();

        $data = TaxInbox::where('id', '=', $id)->first();
        $type = LkpTemplate::where('type', '=', $data->Sumber)->where('status', '=', 1)->first();
        $users = auth()->user();
        $id = $users->id;
        $user = User::where('id', $id)->first();
        $checkprofile = TaxProfile::where('fk_users', '=', $user->id)->first();

        $rawdata = [
            'TAX_PAYER_NAME1' => $user->name,
            'NEW_IC_NO' => $user->reference_id,
            'FILE_TYPE' => $user->doc_type,
            'IT_REF_NO' => $user->tax_no,
            'SKIM_DATE' => '',
            'ASSESSMENT_YEAR' => '',
            'TOTAL_AMOUNT_CP500' => 0,
            'IT_COL_BRANCH' => '',
            'BRANCH_NAME' => '',
            'CP500TABLE' => '',
            'REMS_DATE' => '',
            'NO_INST' => '',
            'MONTH_FAIL' => '',
            'AMT1' => 0,
            'DATE1' => '',
        ];

        $rawdata = (object) $rawdata;

        // dd($rawdata);

        $template = TaxTemplate::where('fk_lkp_template', '=', $type->id)->where('status', '=', 1)->first();

        if ($template) {
            if ($language == 'en') {
                $body = $template->detail_en;
                if ($body) {
                } else {
                    $body = $template->detail;
                }
            } else {
                $body = $template->detail;
            }

            if ($data->RefId) {
                $checkcp500 = TaxCp500::where('refid', '=', $data->RefId)->first();
                if ($checkcp500) {
                    $rawdata = TaxCp500::where('refid', '=', $data->RefId)->first();
                } else {
                    $loadcp500 = $this->api_cp500($data->RefId);
                    if ($loadcp500) {
                        $rawdata = TaxCp500::where('refid', '=', $data->RefId)->first();
                    }
                }
            } else {
                // dd($rawdata);
                $checkcp500g = TaxCp500::where('fk_tax_inbox', '=', $id)->first();

                if ($checkcp500g) {
                    if ($checkcp500g->NEW_IC_NO) {
                        $rawdata = TaxCp500::where('fk_tax_inbox', '=', $id)->first();
                    } else {
                        $loadcp500g = $this->api_cp500g($id);
                        if ($loadcp500g) {
                            $rawdatas = TaxCp500::where('fk_tax_inbox', '=', $id)->first();
                            if ($rawdatas->NEW_IC_NO) {
                                $rawdata = $rawdatas;
                            }
                        }
                    }
                } else {
                    $loadcp500g = $this->api_cp500g($id);
                    if ($loadcp500g) {
                        $rawdatas = TaxCp500::where('fk_tax_inbox', '=', $id)->first();
                        if ($rawdatas->NEW_IC_NO) {
                            $rawdata = $rawdatas;
                        }
                    }
                }
            }

            // dd($rawdata);

            $templatedata = [

                '[TAX_PAYER_NAME1]',
                '[NEW_IC_NO]',
                '[FILE_TYPE]',
                '[IT_REF_NO]',
                '[SKIM_DATE]',
                '[ASSESSMENT_YEAR]',
                '[TOTAL_AMOUNT_CP500]',
                '[IT_COL_BRANCH]',
                '[BRANCH_NAME]',
                '[CP500TABLE]',
                '[REMS_DATE]',
                '[NO_INST]',
                '[MONTH_FAIL]',
                '[AMT1]',
                '[DATE1]',
                '[Subjek]',
                '[Mesej]',
                '[Daripada]',
                '[NoId]',
                '[NoFail]',
                '[TarikhNotis]',
                '[TarikhTerima]',
                '[Unread]',
                '[JenisFail]',
                '[RefNo]',
                '[Nama]',
                '[Emel]',
                '[NoBaucar]',
                '[NamaBank]',
                '[NoAkaun]',
                '[NoEft]',
                '[TkhRefund]',
                '[BankPembayar]',
                '[Sumber]',
                '[Status]',
                '[Filler]',
                '[FolderId]',
                '[FolderDate]',
                '[AmaunKredit]',
                '[ThnTaksiran]',
                '[RefId]',
                '[NamaSyarikat]',
                '[TahunTaksiran1]',
                '[SumberBEN]',

            ];

            // dd($rawdata);

            $bodydata = [

                $rawdata->TAX_PAYER_NAME1,
                $rawdata->NEW_IC_NO,
                $rawdata->FILE_TYPE,
                $rawdata->IT_REF_NO,
                date('d/m/Y', strtotime($rawdata->SKIM_DATE)),
                $rawdata->ASSESSMENT_YEAR,
                number_format($rawdata->TOTAL_AMOUNT_CP500, 2, '.', ','),
                $rawdata->IT_COL_BRANCH,
                $rawdata->BRANCH_NAME,
                "<div id='home'></div>",
                date('d/m/Y', strtotime($rawdata->REMS_DATE)),
                $rawdata->NO_INST,
                $rawdata->MONTH_FAIL,
                number_format($rawdata->AMT1, 2, '.', ','),
                date('d/m/Y', strtotime($rawdata->DATE1)),
                $data->Subjek,
                $data->Mesej,
                $data->Daripada,
                $data->NoId,
                $data->NoFail,
                date('d/m/Y', strtotime($data->TarikhNotis)),
                date('d/m/Y', strtotime($data->TarikhTerima)),
                $data->Unread,
                $data->JenisFail,
                $user->reference_id,
                $user->name,
                $user->email,
                $data->NoBaucar,
                $data->NamaBank,
                $data->NoAkaun,
                $data->NoEft,
                date('d/m/Y', strtotime($data->TkhRefund)),
                $data->BankPembayar,
                $data->Sumber,
                $data->Status,
                $data->Filler,
                $data->FolderId,
                $data->FolderDate,
                $data->AmaunKredit,
                $data->ThnTaksiran,
                $data->RefId,
                $data->NamaSyarikat,
                $data->TahunTaksiran1,
                $data->SumberBEN,
            ];

            // dd($bodydata);

            $templatebody = str_replace($templatedata, $bodydata, $body);
        } else {
            $templatebody = 'No Template Created for this type : '.$data->Sumber;
        }

        return $templatebody;
    }

    public function api_cp500($refid)
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

        $response500 = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/CP500')
                ->withData(
                    [
                        'RefID' => $refid,
                        'JnsSijil' => $user->doc_type,
                        'NoRujukan' => $user->tax_no,
                        'Sumber' => 'CP500',
                    ]
                )
                ->withHeaders(['ApiAuthorization:'.$auth])
                ->returnResponseObject()
                ->post();

        $content500 = $response500->content;
        $response500 = json_decode($content500);
        if (isset($response500->Message)) {
            return 0;
        }
        $data500 = $response500->Model->CP500Data;

        foreach ($data500 as $key =>$data500) {
            $checkcp500 = TaxCp500::where('fk_users', '=', $id)->where('refid', '=', $data500->Id)->delete();

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

            return $data500new->id;
        }
    }

    public function api_cp500g($ids)
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

        $response500 = Curl::to('https://mytax2.hasil.gov.my/MyTaxApi/api/CP500Gagal')
                ->withData(
                    [
                        'JnsSijil' => $user->doc_type,
                        'NoRujukan' => $user->tax_no,
                    ]
                )
                ->withHeaders(['ApiAuthorization:'.$auth])
                ->returnResponseObject()
                ->post();

        $content500 = $response500->content;
        $response500 = json_decode($content500);
        // dd($response500);

        if (isset($response500->Message)) {
            return 0;
        }
        $data500 = $response500->Model;

        $checkcp500 = TaxCp500::where('fk_users', '=', $id)->where('fk_tax_inbox', '=', $ids)->first();

        if ($checkcp500) {
            return $checkcp500->id;
        } else {
            $data500new = new TaxCp500;
            $data500new->fk_users = $id;
            $data500new->TAX_PAYER_NAME1 = $data500->TAX_PAYER_NAME1;
            $data500new->NEW_IC_NO = $data500->NEW_IC_NO;
            $data500new->IT_REF_NO = $data500->IT_REF_NO;
            $data500new->FILE_TYPE = $data500->FILE_TYPE;
            $data500new->JUM_PERLU_BYR = $data500->JUM_PERLU_BYR;
            $data500new->SKIM_DATE = $data500->SKIM_DATE;
            $data500new->ASSESSMENT_YEAR = $data500->ASSESSMENT_YEAR;
            $data500new->MIN_DUE_AMOUNT = $data500->MIN_DUE_AMOUNT;
            $data500new->IT_COL_BRANCH = $data500->IT_COL_BRANCH;
            $data500new->BRANCH_NAME = $data500->BRANCH_NAME;
            $data500new->TOTAL_AMOUNT_CP500 = $data500->TOTAL_AMOUNT_CP500;
            $data500new->INSTALLMENT_TYPE_CODE = $data500->INSTALLMENT_TYPE_CODE;
            $data500new->fk_tax_inbox = $ids;

            $data500new->REMS_DATE = $data500->REMS_DATE;
            $data500new->DATE1 = $data500->DATE1;
            $data500new->DATE2 = $data500->DATE2;
            $data500new->DATE3 = $data500->DATE3;
            $data500new->DATE4 = $data500->DATE4;
            $data500new->DATE5 = $data500->DATE5;
            $data500new->DATE6 = $data500->DATE6;
            $data500new->JUM_SUDAH_BYR = $data500->JUM_SUDAH_BYR;
            $data500new->AMT1 = $data500->AMT1;
            $data500new->AMT2 = $data500->AMT2;
            $data500new->AMT3 = $data500->AMT3;
            $data500new->AMT4 = $data500->AMT4;
            $data500new->AMT5 = $data500->AMT5;
            $data500new->AMT6 = $data500->AMT6;
            $data500new->NO_INST = $data500->NO_INST;
            $data500new->MONTH_FAIL = $data500->MONTH_FAIL;
            $data500new->DATE_NEXT_MONTH = $data500->DATE_NEXT_MONTH;
            $data500new->save();

            return $data500new->id;
        }
    }
} //end of class
