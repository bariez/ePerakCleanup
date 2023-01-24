<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Curl;
use Workbench\Site\Model\Payment\KaunterLesen;



class ArKaunter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elesen:ar-kaunter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send data to ar kaunter sap';

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
            

            // for action = 1
            //query table kaunter where insert_new_sap_status = S always limit one for looping every 1 minutes
            $data1 = KaunterLesen::whereNot('insert_new_sap_status','=','S')->whereIn('sub_syscode',['AD','DE'])->first();
            try
            {

                $response = Curl::to($url)
                ->withData( 
                      array
                      ( 
                            'fid'           => '60',
                            'token'         =>  $key,
                            'action'        =>  '1',
                            'documentno'    => $data1->documentno,
                            'doc_date'      => date("Ymd", strtotime($data1->doc_date)),
                            'description'   => $data1->description,
                            'paid_amount'   => floatval($data1->paid_amount),
                            'payment_date'  => '00000000',    
                      ) 
                    )
                    ->returnResponseObject()
                    ->get();

                $data = json_decode($response->content);
                if($data)
                {
                    if($data == false)
                    {
                        
                    }else
                    {

                        // update table

                        if(isset($data->content->result))
                        {
                            $data1->insert_new_sap_status = $data->content->result->status;
                            $data1->insert_sap_message = $data->content->result->message;
                            $data1->updated_at = $created;
                            $data1->update();
                        }
                        else
                        {
                          
                        }
                       
                    }
                 
                }

            } catch (RequestException $e){

               
            }


            // for action = 2
            //query table kaunter where update_sap_message = S always limit one for looping every 1 minutes
            $data2 = KaunterLesen::whereNot('update_sap_message','=','S')->whereIn('sub_syscode',['AD','DE'])->first();
            try
            {

                $response = Curl::to($url)
                ->withData( 
                      array
                      ( 
                            'fid'           => '60',
                            'token'         =>  $key,
                            'action'        =>  '2',
                            'documentno'    => $data2->documentno,
                            'doc_date'      => date("Ymd", strtotime($data2->doc_date)),
                            'description'   => $data2->description,
                            'paid_amount'   => floatval($data2->paid_amount),
                            'payment_date'  => date("Ymd", strtotime($data2->payment_date)),
                      ) 
                    )
                    ->returnResponseObject()
                    ->get();

                $data = json_decode($response->content);
                if($data)
                {
                    if($data == false)
                    {
                        
                    }else
                    {

                        // update table

                        if(isset($data->content->result))
                        {
                            $data2->update_sap_status = $data->content->result->status;
                            $data2->update_sap_message = $data->content->result->message;
                            $data2->updated_at = $created;
                            $data2->update();
                        }
                        else
                        {
                          
                        }
                       
                    }
                 
                }

            } catch (RequestException $e){

               
            }
            


            
    }
}
