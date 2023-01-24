<?php 
namespace Workbench\Dashboard\Data\Repo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Workbench\Site\Model\Lookup\Kampung;


/**
 *  
 *
 * @laravolt site
 * @author fezrul@3fresources.com
 **/
class DashboardRepo
{
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public function countallpetemptan($request)
    {

  		// if($request->catpetempatan !=0){

    	$results=Kampung::selectRaw("count(kampung.id) as countpetempatan,lkp_detail.description as category")
    					  ->leftjoin('parlimen','parlimen.id','=','kampung.fk_parlimen')
    					  ->leftjoin('dun','dun.id','=','kampung.fk_dun')
    					  ->leftjoin('daerah','daerah.id','=','kampung.fk_daerah')
    					  ->leftjoin('mukim','mukim.id','=','kampung.fk_mukim')
    					  ->join('lkp_detail','lkp_detail.id','=','kampung.KategoriPetempatan');

		    if($request->parlimen!=0){
		    	$results->where('kampung.fk_parlimen',$request->parlimen);
		    }

		    if($request->dun!=0){
		    	$results->where('kampung.fk_dun',$request->dun);

		    }
		    if($request->daerah!=0){
		    	$results->where('kampung.fk_daerah',$request->daerah);

		    }

		    if($request->mukim!=0){
		    	$results->where('kampung.fk_mukim',$request->mukim);

		    }

		    if($request->catpetempatan!=0){

          if($request->catpetempatan==4){//kg tradisional
            $results->where('kampung.KategoriPetempatan',$request->catpetempatan)
                    ->whereNull('kampung.IdKampungInduk');

          }else{
            $results->where('kampung.KategoriPetempatan',$request->catpetempatan);

          }
		    	

		    }else{
          $results->whereNull('kampung.IdKampungInduk');
        }

        if($request->kampung!=0){
          $results->where('kampung.id',$request->kampung);

        }


		 // ->where('kampung.KategoriPetempatan',$request->catpetempatan)
		 

		    $final=$results->where('kampung.status',1)
                       ->where('lkp_detail.status',1)
                       ->groupby('lkp_detail.description')->first();

      return $final;

  //   	}else{

		// if($request->parlimen==0){
  //   		$parlimen='';

  //   	}else{
  //   		$parlimen='and fk_parlimen='.$request->parlimen;

  //   	}

  //   	if($request->dun==0){
  //   		$dun='';

  //   	}else{
  //   		$dun='and fk_dun='.$request->dun;

  //   	}
  //   	if($request->daerah==0){
  //   		$daerah='';

  //   	}else{
  //   		$daerah='and fk_daerah='.$request->daerah;

  //   	}

  //   	if($request->mukim==0){
  //   		$mukim='';

  //   	}else{
  //   		$mukim='and fk_mukim='.$request->mukim;

  //   	}

  //   	if($request->catpetempatan==0){
  //   		$catpetempatan='';

  //   	}else{
  //   		 $catpetempatan='and KategoriPetempatan='.$request->catpetempatan;

  //   	}

  //      if($request->kampung==0){
  //         $kampung='';
  //       }else{
  //         $kampung='and id='.$request->kampung;

  //       }


  //   		 $results = DB::select("SELECT
		// 			  CASE
		// 				WHEN a.jum_tempatan IS NULL THEN '0'
		// 				ELSE a.jum_tempatan
		// 				END AS jum_tempatan,
		// 			  lkp_detail.id,
		// 			  lkp_detail.description
  //                   FROM
  //                     (
  //                       lkp_detail
  //                       left JOIN
  //                         (SELECT
  //                           COUNT(kampung.id) AS jum_tempatan,
		// 					kampung.KategoriPetempatan
  //                         FROM
  //                          kampung
  //                         WHERE (
  //                             kampung.status=1
  //                              ".$parlimen."
  //                              ".$dun."
  //                              ".$daerah."
  //                              ".$mukim."
  //                              ".$catpetempatan."
  //                              ".$kampung."
  //                              and kampung.deleted_at is null
  //                              and kampung.IdKampungInduk is null

                            
  //                           )
  //                         GROUP BY kampung.KategoriPetempatan) a
  //                         ON (
  //                           (
  //                             lkp_detail.id = a.KategoriPetempatan
							  
						
  //                           )
  //                         )
  //                     )where lkp_detail.fk_lkp_master=3
  //                   ORDER BY a.jum_tempatan DESC");

  //   		  return $results;

  //   	}

    	 
    	
   }

	
} //end of class