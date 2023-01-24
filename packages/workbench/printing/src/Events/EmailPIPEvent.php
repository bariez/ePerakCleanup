<?php
namespace Workbench\Site\Events;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Workbench\Site\Model\Project;

class EmailPIPEvent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //get data here to use below
        $this->email = $this->email();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    protected function email()
    {
        // dd("sini");
        // $email = $value->email;
        $email = 'izzat@3fresources.com';

        $data = DB::table('vw_project_email')->where('status_email','=',null)->get();

        $i = 1;
        $j = 1;
        $k = 1;
        $l = 1;

        foreach ($data as $key_result => $value_result) {
            $target_cod = "";
            $target_cod_exist = 0;
            $completion_date = "";
            $id = "";
            $project_no = "";
            $developer_name = "";
            $developer_email = "";
            $id = "";
            
            foreach ($value_result as $key_sub_result => $value_sub_result) {
                if($key_sub_result == 'Target FiTCD/ COD Date'){
                    if($value_sub_result){
                     
                        $target_cod = date_create(date('Y-m-d', strtotime(str_replace('/', '-', $value_sub_result))));

                        $target_cod_exist = 1;   
                    }
                }
                if($key_sub_result == 'Completion Date'){
                    $completion_date = date_create(date('Y-m-d', strtotime(str_replace('/', '-', $value_sub_result))));
                }
                if($key_sub_result == 'Id'){
                    $id = $value_sub_result;
                }
                if($key_sub_result == 'Project No'){
                    $project_no = $value_sub_result;
                }
                if($key_sub_result == 'Developer Name'){
                    $developer_name = $value_sub_result;
                }
                if($key_sub_result == 'Developer PIC Email'){
                    $developer_email = $value_sub_result;
                }
                if($key_sub_result == 'Id'){
                    $id = $value_sub_result;
                }


            }

            $curr_date = date_create(date('Y-m-d'));
            
            if($target_cod_exist){
                if($completion_date != ""){
                    $diff_date=date_diff($target_cod,$completion_date);
                    $diff = $diff_date->format("%R%a");
                    

                }else{

                    $diff_date=date_diff($target_cod,$curr_date);
                    $diff = $diff_date->format("%R%a");
                    
                }

                if((int)$diff >= 90){
                    $color_arr[$id] = "#FF0000";
                    $color_font[$id] = "white";
                    
                    $valuedata = array(
                        'project_no' => $project_no,
                        'developer_name' => $developer_name,
                        'developer_email' => $developer_email,
                        'header' => "Project Completion Date is overdue",
                        'background_color' =>  "#FF0000",
                        'color' => "white"
                        
                    );

                    $email = $developer_email;

                    // dump($valuedata);

                    // if($i == 2){

                        $header = "Project Completion Date is overdue";

                         Mail::send('site::email.overdue',$valuedata, function($message) use($email,$header){
                                     $message->from('admindgms@tnb.gov.my', $header);
                                     $message->cc('syarifah.syahidatul@tnb.com.my', 'fadzliyanaar@tnb.com.my');
                                     // $message->bcc('izzat@3fresources.com');
                                     $message->to($email)->subject($header);
                                     });


                        $update = Project::where('id','=',$id)->first();
                        $update->status_email = 1;

                        $update->save();
                    // }



                    $i++;   
                    
                }else if((int)$diff > 0 && (int)$diff < 30){
                    $color_arr[$id] = "#FF8C00";
                    $color_font[$id] = "#339";
                    // array_push($color_arr,"#FF8C00");

                    $valuedata = array(
                        'project_no' => $project_no,
                        'developer_name' => $developer_name,
                        'developer_email' => $developer_email,
                        'header' => "Project Completion Date less than 30 day’s",
                        'background_color' =>  "#FF8C00",
                        'color' => "#339"
                        
                    );

                    $email = $developer_email;

                    // dump($valuedata);

                    // if($j == 2){

                    $header = "Project Completion Date less than 30 day’s";

                     Mail::send('site::email.less_than_30',$valuedata, function($message) use($email,$header){
                                 $message->from('admindgms@tnb.gov.my', $header);
                                 $message->cc('syarifah.syahidatul@tnb.com.my', 'fadzliyanaar@tnb.com.my');
                                 // $message->bcc('izzat@3fresources.com');
                                 $message->to($email)->subject($header);
                                 });

                        $update = Project::where('id','=',$id)->first();
                        $update->status_email = 1;

                        $update->save();
                    // }

                    $j++;                       
                    
                }else if((int)$diff >= 30 && (int)$diff < 60){
                    $color_arr[$id] = "#FFFF00";
                    $color_font[$id] = "#339";
                    // array_push($color_arr,"#FFFF00");

                    $valuedata = array(
                        'project_no' => $project_no,
                        'developer_name' => $developer_name,
                        'developer_email' => $developer_email,
                        'header' => "Project Completion Date less than 60 day’s",
                        'background_color' =>  "#FF8C00",
                        'color' => "#339"
                        
                    );

                    $email = $developer_email;

                    // dump($valuedata);
                    
                    // if($k == 2){

                    $header = "Project Completion Date less than 60 day’s";

                     Mail::send('site::email.less_than_60',$valuedata, function($message) use($email,$header){
                                 $message->from('admindgms@tnb.gov.my', $header);
                                 $message->cc('syarifah.syahidatul@tnb.com.my', 'fadzliyanaar@tnb.com.my');
                                 // $message->bcc('izzat@3fresources.com');
                                 $message->to($email)->subject($header);
                                 });

                        $update = Project::where('id','=',$id)->first();
                        $update->status_email = 1;

                        $update->save();
                    // }

                    $k++;                       
                    
                }else if((int)$diff >= 60 && (int)$diff < 90){
                    $color_arr[$id] = "#FFFF99";
                    $color_font[$id] = "#339";
                    // array_push($color_arr,"#FFFF99");

                    $valuedata = array(
                        'project_no' => $project_no,
                        'developer_name' => $developer_name,
                        'developer_email' => $developer_email,
                        'header' => "Project Completion Date less than 90 day’s",
                        'background_color' =>  "#FFFF99",
                        'color' => "#339"
                        
                    );

                    $email = $developer_email;

                    // dump($valuedata);

                    // if($l == 2){
                    $header = "Project Completion Date less than 90 day’s";

                     Mail::send('site::email.less_than_90',$valuedata, function($message) use($email,$header){
                                 $message->from('admindgms@tnb.gov.my', $header);
                                 $message->cc('syarifah.syahidatul@tnb.com.my', 'fadzliyanaar@tnb.com.my');
                                 // $message->bcc('izzat@3fresources.com');
                                 $message->to($email)->subject($header);
                                 });

                        $update = Project::where('id','=',$id)->first();
                        $update->status_email = 1;

                        $update->save();
                    // }

                    $l++;
                    
                }else if((int)$diff <= 0){
                    $color_arr[$id] = "";
                    $color_font[$id] = "#339";
                    // array_push($color_arr,"#fff");

                    
                } 
            }else{
                    $color_arr[$id] = "";
                    $color_font[$id] = "#339";

            }
        }


        dump($i);
        dump($j);
        dump($k);
        dump($l);

       
    }
}