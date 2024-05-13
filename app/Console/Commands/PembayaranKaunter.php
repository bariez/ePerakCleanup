<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Curl;
use DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use Workbench\Site\Model\Payment\KaunterLesen;

class PembayaranKaunter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elesen:bayar-kaunter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get data from ar kaunter sap';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $request = new \Illuminate\Http\Request();
        //production setting
        // $url = 'https://api.ppj.gov.my/api/call/1';
        // $key = 'M0w0alY1ZlRnWFZGWG9xYUdOWUFKMXBxWFZnV2o3bmdtOG1FcGtMMA==';

        // Development setting
        $url = 'http://dev-api.ppj.gov.my/api/call/1';
        $key = 'bHNOd0tidzd4czFrUEdUTTcwOUJwNm9sUFphZUo5VWw4ZW1pY2VlNg==';

        //query table kaunter where status null always limit one for looping every 1 minutes
        $datatable = KaunterLesen::whereNull('status')->first();

        $datesap = $datatable->doc_date;
        $timesap = $datatable->created_at;

        // $datesap = '20220406';
        // $timesap = '2022-04-06 02:31:51';

        try {
            $response = Curl::to($url)
                ->withData(
                    [
                        'fid'           => '61',
                        'token'         =>  $key,
                        'created_at'    =>  $timesap,
                        'doc_date'      =>  $datesap,
                    ]
                )
                    ->returnResponseObject()
                    ->withTimeout(5000)
                    ->get();

            $data = json_decode($response->content);

            // dd($data);

            if ($data) {
                if ($data == false) {
                } else {

                    // update table

                    if (isset($data->content->result)) {
                        //loop result
                        foreach ($data->content->result->result->OUTPUT as $key => $value) {
                            $docno = trim($value->DOCUMENT_NO);
                            $date = date('Y-m-d', strtotime(trim($value->DATE)));
                            $checkdate = date('Y', strtotime(trim($value->DATE)));
                            $trans = 'none';
                            $billno = 'none';
                            if (isset($value->TRANSAKSI_NO)) {
                                $trans = trim($value->TRANSAKSI_NO);
                            }

                            if (isset($value->BILL_NO)) {
                                $billno = trim($value->BILL_NO);
                            }

                            $amount = trim($value->AMOUNT);

                            //check countertable, query 1 = if documentno = BILL_NO

                            if ($checkdate == '1970') {
                            } else {
                                $check1 = KaunterLesen::where('id', '=', $datatable->id)->where('documentno', '=', $billno)->first();
                                if ($check1) {
                                    //update
                                    $check1->sap_receipt_no = $docno;
                                    $check1->status = 1;
                                    $check1->payment_date = $date;
                                    $check1->code = 3;
                                    $check1->paid_amount = $amount;
                                    $check1->update();
                                } else {
                                    $check2 = KaunterLesen::where('id', '=', $datatable->id)->where('documentno', '=', $trans)->first();
                                    if ($check2) {
                                        //update
                                        $check2->sap_receipt_no = $docno;
                                        $check2->status = 1;
                                        $check2->payment_date = $date;
                                        $check2->code = 3;
                                        $check2->paid_amount = $amount;
                                        $check2->update();
                                    }
                                }
                            }
                        }
                    } else {
                    }
                }
            }
        } catch (RequestException $e) {
        }
    }
}
