<?php 
namespace App\Data\Repo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Storage;
use File;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use App\Models\MngQuestion;
use App\Models\MngAnswer;
use App\Models\MngHelp;
use App\Models\MngMobile;
use App\Models\MngAnnouncement;
use App\Models\MngApp;
use App\Models\Mngfeedback;
use App\Models\MngService;
use App\Models\MngLkpQuestionFeedback;
use App\Models\MngLkpAnswerPicFeedback;
use Maatwebsite\Excel\Facades\Excel;



/**
 *  
 *
 * @package eCuti
 * @author wan.rizuan@3fresources.com
 **/
class AdminRepo
{
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/

	public function svfaq($request)
	{
		// dd($request);

		$data_faq = new MngQuestion;
		$data_faq->question_name_bm = $request->get('quest_bm');
		$data_faq->question_name_en = $request->get('quest_en');
		$data_faq->status=$request->get('status');
		$data_faq->save();

		return $data_faq->id;

	}
	public function listfaq($request)
	{


		$listfaq = MngQuestion::selectRaw("id,question_name_bm,question_name_en,status")
					 	 		->get();


		
		return $listfaq;

	} //end of function
	public function dataques($id)
	{
	
		$dataques=MngQuestion::find($id);

		return $dataques;

	}
	public function dataanswer($id)
	{
	
		$dataanswer=MngAnswer::selectRaw("id,fk_question,answer_name_en,answer_name_bm,status,CASE WHEN status=1 THEN 'Aktif' WHEN status=0 THEN 'Tidak Aktif' END AS status_v")
							->where('fk_question',$id)->get();

		return $dataanswer;

	}
	public function svefaq($request)
	{
		

		$data_faq = MngQuestion::find($request->get('id'));
		$data_faq->question_name_bm = $request->get('quest_bm');
		$data_faq->question_name_en = $request->get('quest_en');
		$data_faq->status=$request->get('status');
		$data_faq->save();

	}
	public function svansw($request)
	{
		// dd($request);

		$data_answ = new MngAnswer;
		$data_answ->fk_question = $request->get('idquest');
		$data_answ->answer_name_bm = $request->get('answ_bm');
		$data_answ->answer_name_en = $request->get('answ_en');
		$data_answ->status=$request->get('statusansw');
		$data_answ->save();

	}
	public function sveansw($request)
	{
		// dd($request);

		$data_answ = MngAnswer::find($request->get('idansweredit'));
		$data_answ->answer_name_bm = $request->get('answeredit_bm');
		$data_answ->answer_name_en = $request->get('answeredit_en');
		$data_answ->status=$request->get('statusedit');
		$data_answ->save();

	}
	public function listhelp($request)
	{


		$listhelp = MngHelp::selectRaw("id,description_en,description_bm,status")
					 	 	->get();


		
		return $listhelp;

	} //end of function
	public function svhelp($request)
	{
		
		$data_help = new MngHelp;
		$data_help->description_bm = $request->get('desc_en');
		$data_help->description_en = $request->get('desc_bm');
		$data_help->status=$request->get('status');
		$data_help->save();

	}
	public function datahelp($id)
	{
	
		$datahelp=MngHelp::find($id);

		return $datahelp;

	}
	public function svehelp($request)
	{

		$data_help = MngHelp::find($request->get('id'));
		$data_help->description_bm = $request->get('desc_bm');
		$data_help->description_en = $request->get('desc_en');
		$data_help->status=$request->get('status');
		$data_help->save();

	}
	public function listmobile($request)
	{


		$listmobile = MngMobile::selectRaw("id,mobile_module_name_bm,mobile_module_name_en,and_url,ios_url,status,icon_url")
					 	 		->get();


		
		return $listmobile;

	} //end of function
	public function svmobile($request)
	{
		// dd($request);
		$filename = '';
		if($request->img)
		{
          
            $files=$request->img;
            $folder='appicon';

            if (!file_exists(public_path().'/storage/appicon/')) {
                
                     mkdir(public_path()."/storage/".$folder);
            }
           

            $path = public_path()."/storage/appicon/";

            $shortpath = "/storage/appicon/";
            $movepath = "/public/appicon/";

            $filename= $files->getClientOriginalName();
            $paths =  $files->storeAs($movepath,$filename);

        }
		$data_mobile = new MngMobile;
		$data_mobile->mobile_module_name_bm = $request->get('namemobile_bm');
		$data_mobile->mobile_module_name_en = $request->get('namemobile_en');
		$data_mobile->and_url=$request->get('api');
		$data_mobile->ios_url=$request->get('url');
		$data_mobile->icon_url=$filename;
		$data_mobile->status=$request->get('status');
		$data_mobile->save();

	}
	public function datamobile($id)
	{
	
		$datamobile=MngMobile::find($id);

		return $datamobile;

	}
	public function svemobile($request)
	{
		$filename = '';

		$data_mobile = MngMobile::find($request->get('id'));
		$data_mobile->mobile_module_name_bm = $request->get('namemobile_bm');
		$data_mobile->mobile_module_name_en = $request->get('namemobile_en');
		$data_mobile->and_url=$request->get('api');
		$data_mobile->ios_url=$request->get('url');
		$data_mobile->status=$request->get('status');


		if($request->img)
		{
          
            $files=$request->img;
            $folder='appicon';

            if (!file_exists(public_path().'/storage/appicon/')) {
                
                     mkdir(public_path()."/storage/".$folder);
            }
           

            $path = public_path()."/storage/appicon/";

            $shortpath = "/storage/appicon/";
            $movepath = "/public/appicon/";

            $filename= $files->getClientOriginalName();
            $paths =  $files->storeAs($movepath,$filename);

            $data_mobile->icon_url=$filename;

        }

		
		$data_mobile->save();

	}
	public function listannounce($request)
	{


		$listannounce = MngAnnouncement::selectRaw("id,announcement_bm,announcement_en,body_bm,body_en,start_date,end_date,status")
					 	->get();


		
		return $listannounce;

	} //end of function
	public function svannounce($request)
	{

		$data_announce = new MngAnnouncement;
		$data_announce->announcement_bm = $request->get('announce_bm');
		if($request->get('announce_en'))
		{
			$data_announce->announcement_en = $request->get('announce_en');
		}else{

			$data_announce->announcement_en = $request->get('announce_bm');
		}
		$data_announce->body_bm = $request->get('body_bm');
		if($request->get('body_en'))
		{
			$data_announce->body_en = $request->get('body_en');
		}else{

			$data_announce->body_en = $request->get('body_bm');
		}
		$data_announce->start_date=date('Y-m-d', strtotime($request->get('start_date')));
		$data_announce->end_date=date('Y-m-d', strtotime($request->get('end_date')));
		$data_announce->status=$request->get('status');
		$data_announce->save();

	}
	public function dataannounce($id)
	{
	
		$dataannounce=MngAnnouncement::find($id);

		return $dataannounce;

	}
	public function sveannounce($request)
	{

		$data_announce = MngAnnouncement::find($request->get('id'));
		$data_announce->announcement_bm = $request->get('announce_bm');
		$data_announce->announcement_en = $request->get('announce_en');
		$data_announce->body_bm = $request->get('body_bm');
		$data_announce->body_en = $request->get('body_en');
		$data_announce->start_date=date('Y-m-d', strtotime($request->get('start_date')));
		$data_announce->end_date=date('Y-m-d', strtotime($request->get('end_date')));
		$data_announce->status=$request->get('status');
		$data_announce->save();

	}
	public function listapp($request)
	{


		$listapp = MngApp::selectRaw("id,module_name_bm,module_name_en,description_bm,description_en,API,URL,status")
				 	 	  ->get();
		
		return $listapp;

	} //end of function
	public function svapp($request)
	{
		
		$data_mobile = new MngApp;
		$data_mobile->module_name_bm = $request->get('nameapp_bm');
		$data_mobile->module_name_en = $request->get('nameapp_en');
		$data_mobile->description_bm = $request->get('desc_bm');
		$data_mobile->description_en = $request->get('desc_en');
		$data_mobile->API=$request->get('api');
		$data_mobile->URL=$request->get('url');
		$data_mobile->status=$request->get('status');
		$data_mobile->save();

	}
	public function dataapp($id)
	{
	
		$dataapp=MngApp::find($id);

		return $dataapp;

	}
	public function sveapp($request)
	{

		$data_mobile =  MngApp::find($request->get('id'));
		$data_mobile->module_name_bm = $request->get('nameapp_bm');
		$data_mobile->module_name_en = $request->get('nameapp_en');
		$data_mobile->description_bm = $request->get('desc_bm');
		$data_mobile->description_en = $request->get('desc_en');
		$data_mobile->API=$request->get('api');
		$data_mobile->URL=$request->get('url');
		$data_mobile->status=$request->get('status');
		$data_mobile->save();

	}
	public function svfeedback($request)
	{
	

		// $data_feedback = new Mngfeedback;
		// $data_feedback->date_feedback = date('Y-m-d H:i:s');

		//  if($request->get('emotion')=='happy'){
  //        $data_feedback->verygood = 1;
	 //      }else{
	 //         $data_feedback->verygood = 0;
	 //      }

	 //      if($request->get('emotion')=='everage'){
	 //         $data_feedback->statisfy = 1;
	 //      }else{
	 //         $data_feedback->statisfy = 0;
	 //      }
	 //      if($request->get('emotion')=='sad'){
	 //         $data_feedback->need_enhancement = 1;
	 //      }else{
	 //         $data_feedback->need_enhancement = 0;
	 //      }  
		// $data_feedback->comment = $request->get('remarks');

		// $data_feedback->save();



		foreach ($request->emotion as $key => $value) {

			$data=MngLkpAnswerPicFeedback::find($value);

			$feedback=new Mngfeedback;
			$feedback->fk_lkp_question_feedback=data_get($data,'fk_lkp_question_feedback');
			$feedback->fk_lkp_answer_feedback=data_get($data,'id');
			$feedback->date_feedback = date('Y-m-d H:i:s');
			$feedback->comment = $request->get('remarks');
			$feedback->save();

		}

	}
	public function listservice($request)
	{


		$listservice = MngService::orderBy('order','ASC')->get();
		
		return $listservice;

	} //end of function
	public function svservice($request)
	{

		$data_service = new MngService;
		$data_service->service_bm = $request->get('nameservice_bm');

		if($request->get('nameservice_en'))
		{
			$data_service->service_en = $request->get('nameservice_en');
		}else{
			$data_service->service_en = $request->get('nameservice_bm');
		}

		$data_service->description_bm = $request->get('desc_bm');

		if($request->get('desc_en'))
		{
			$data_service->description_en = $request->get('desc_en');
		}else{
			$data_service->description_en = $request->get('desc_bm');
		}
				
		$data_service->content_bm = $request->get('content_bm');

		if($request->get('content_en')){
			$data_service->content_en = $request->get('content_en');
		}else{
			$data_service->content_en = $request->get('content_bm');
		}

		if($request->get('status'))
		{
			$data_service->status=$request->get('status');
		}else{

			$data_service->status=1;
		}

		if($request->get('order')){

		  $data_service->order=$request->get('order');

		}else{

			$data_service->order=100;
		}

		if($request->get('access'))
		{

			$access = json_encode($request->get('access'));
			$data_service->acl=$access;

		}
		
		$data_service->save();


		if($request->get('order')){
			
			$reaarange = MngService::where('order','>=',$request->get('order'))->where('id','!=',$data_service->id)->get();
			foreach ($reaarange as $key => $value) 
			{
				$neworder = MngService::where('id','=',$value->id)->first();
				$neworder->order = $value->order+1;
				$neworder->update();
			}
		}

	}
	public function dataservice($id)
	{
	
		$dataservice=MngService::find($id);

		return $dataservice;

	}
	public function sveservice($request)
	{

		$status = $request->get('status');
		$data_service =  MngService::find($request->get('id'));
		$data_service->service_bm = $request->get('nameservice_bm');

		if($request->get('nameservice_en'))
		{
			$data_service->service_en = $request->get('nameservice_en');
		}else{
			$data_service->service_en = $request->get('nameservice_bm');
		}

		$data_service->description_bm = $request->get('desc_bm');

		if($request->get('desc_en'))
		{
			$data_service->description_en = $request->get('desc_en');
		}else{
			$data_service->description_en = $request->get('desc_bm');
		}
				
		$data_service->content_bm = $request->get('content_bm');

		if($request->get('content_en')){
			$data_service->content_en = $request->get('content_en');
		}else{
			$data_service->content_en = $request->get('content_bm');
		}

		if($request->get('order')){

		  $data_service->order=$request->get('order');

		}else{

			$data_service->order=100;
		}

		if($request->get('access'))
		{

			$access = json_encode($request->get('access'));
			$data_service->acl=$access;

		}

		$data_service->status=$status;
		
		$data_service->save();


		if($request->get('order')){
			
			$reaarange = MngService::where('order','>=',$request->get('order'))->where('id','!=',$data_service->id)->get();
			foreach ($reaarange as $key => $value) 
			{
				$neworder = MngService::where('id','=',$value->id)->first();
				$neworder->order = $value->order+1;
				$neworder->update();
			}
		}

	}


	public function listfeedback()
	{

		$listfeedback = MngLkpQuestionFeedback::selectRaw("id,quest_en,quest_bm,status")
					  ->get();

		return $listfeedback;

	} //end of function
	public function svquestfeedback($request)
	{
		

		$data_faq = new MngLkpQuestionFeedback;
		$data_faq->quest_en = $request->get('quest_en');
		$data_faq->quest_bm=$request->get('quest_bm');
		$data_faq->status=$request->get('status');
		$data_faq->save();

        

    


	}
	public function dataquesfeedback($id)
	{
	
		$dataquesfeedback=MngLkpQuestionFeedback::find($id);

		return $dataquesfeedback;

	}
	public function dataanswerfeedback($id)
	{
	
		$dataanswerfeedback=MngLkpAnswerPicFeedback::selectRaw("id,fk_lkp_question_feedback,answer_en,answer_bm,status,full_path,file_name,
													CASE WHEN status=1 THEN 'Aktif' WHEN status=0 THEN 'Tidak Aktif' END AS status_v")
													->where('fk_lkp_question_feedback',$id)
													->get();

		return $dataanswerfeedback;

	}
	public function svequestfeedback($request)
	{
		

		$data_faq = MngLkpQuestionFeedback::find($request->get('id'));
		$data_faq->quest_en = $request->get('quest_en');
		$data_faq->quest_bm=$request->get('quest_bm');
		$data_faq->status=$request->get('status');
		$data_faq->save();


		//update status answer PIC same with question

		$data_answe=MngLkpAnswerPicFeedback::where('fk_lkp_question_feedback',$request->get('id'))->get();

		foreach ($data_answe as $key => $value) {
			
			$item=MngLkpAnswerPicFeedback::find($value->id);
			$item->status=$request->get('status');
			$item->save();

		}

	}
	public function svanswrfeedback($request)
	{
		
	


		    if($request->lampiran){

        	foreach ($request->lampiran as $key => $value) 
            {

            	$files=$value;
                $folder='feedback';
                $mainapp=$request->get('idquest');


		        if (!file_exists(public_path().'/storage/feedback/')) {
		            
		                 mkdir(public_path()."/storage/".$folder);
		        }
		        if (!file_exists(public_path().'/storage/feedback/'.$mainapp)) {
		            
		                  mkdir(public_path()."/storage/feedback/".$mainapp);  
		        }
		       

		        $path = public_path()."/storage/feedback/".$mainapp;

		        $shortpath = "/storage/feedback/".$mainapp."/";
		        $movepath = "/public/feedback/".$mainapp."/";
		             // $photo->move($path, $photo->getClientOriginalName());
		        $filename= $files->getClientOriginalName();

		        $extension = $files->getClientOriginalExtension();
		            
		        $size= $files->getClientSize();

		        $paths =  $files->storeAs($movepath,$filename);

		        $svdt = new MngLkpAnswerPicFeedback;
		        $svdt->fk_lkp_question_feedback = $mainapp;
		        $svdt->answer_en=$request->get('answer_en');
		        $svdt->answer_bm=$request->get('answer_bm');
		        $svdt->date = date('Y-m-d');
		        $svdt->dir = $path;  //full path from var
		        $svdt->full_path = $shortpath; //short path from storage/medical/
		        $svdt->file_name = $filename;
		        $svdt->file_size = $size;
		        $svdt->status = 1;
		        $svdt->save();


    	}

    	}

	}
	public function sveanswrfeedback($request)
	{
				
			

				$mainapp=$request->get('idquestedit');
			    $svdt = MngLkpAnswerPicFeedback::find($request->get('idansweredit'));
		        $svdt->fk_lkp_question_feedback = $mainapp;
		        $svdt->answer_en=$request->get('answerenedit');
		        $svdt->answer_bm=$request->get('answerbmedit');
		        $svdt->status=$request->get('statusedit');
		        $svdt->save();

		    if($request->lampiranedit){

        	foreach ($request->lampiranedit as $key => $value) 
            {

            	$files=$value;
                $folder='feedback';
                $mainapp=$request->get('idquestedit');


		        if (!file_exists(public_path().'/storage/feedback/')) {
		            
		                 mkdir(public_path()."/storage/".$folder);
		        }
		        if (!file_exists(public_path().'/storage/feedback/'.$mainapp)) {
		            
		                  mkdir(public_path()."/storage/feedback/".$mainapp);  
		        }
		       

		        $path = public_path()."/storage/feedback/".$mainapp;

		        $shortpath = "/storage/feedback/".$mainapp."/";
		        $movepath = "/public/feedback/".$mainapp."/";
		             // $photo->move($path, $photo->getClientOriginalName());
		        $filename= $files->getClientOriginalName();

		        $extension = $files->getClientOriginalExtension();
		            
		        $size= $files->getClientSize();

		        $paths =  $files->storeAs($movepath,$filename);

		        $svdt = MngLkpAnswerPicFeedback::find($request->get('idansweredit'));
		        $svdt->date = date('Y-m-d');
		        $svdt->dir = $path;  //full path from var
		        $svdt->full_path = $shortpath; //short path from storage/medical/
		        $svdt->file_name = $filename;
		        $svdt->file_size = $size;
		        $svdt->status = 1;
		        $svdt->save();


    	}

    	}

	}
	 public function picfeedbcak($id){   
  

        $path = 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=150';
       
        $picture= MngLkpAnswerPicFeedback::where('fk_lkp_question_feedback','=',$id)->first();

        if($picture==''){
          $path = 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=150';
       

        }else{

          

        if($picture->file_name==''){

          $path = 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=150';
      

        }else{

          $path=$picture->full_path.$picture->file_name;


        if($picture->file_name){
            if(file_exists(public_path($path))){
                $path = asset($path);
            }
        }


        }

        }

    return $path;

}
public function datafeedback()
{

	$datafeedback=MngLkpQuestionFeedback::with('answerfeedback')->get();

	return $datafeedback;

}
public function exportfeedback($request,$type,$datefrom,$dateto,$listener)
{


         if($type==1){//pdf

         // $name='SENARAI_PEMULANGAN_DEPOSIT';
         // $attributes=['orientation' => 'Portrait'];

         // $pdf = new PdfMaker($listener->exportlistrefund(compact('type','datefrom','dateto','data')));
         // $pdf->generatePdf($name, $attributes);
         		dd($type);


         }else{//excel

         	$data="1";
   
           Excel::create('SENARAI_PEMULANGAN_DEPOSIT', function ($excel) use ($type,$datefrom,$dateto,$data){//start excel
           
           $excel->sheet('SENARAI_PEMULANGAN_DEPOSIT', function ($sheet) use ($type,$datefrom,$dateto,$data) {
           $type=$type;
           $datefrom=$datefrom;
           $dateto=$dateto;


           $sheet->row(1, function ($row) {

                
           $row->setFontSize(12);
           });

           $sheet->loadView('admin.report.excelfeedback',compact('type','datefrom','dateto','data'));


           });//end sheet


            })->export('xls');//end excel

        
         }
}
	
} //end of class