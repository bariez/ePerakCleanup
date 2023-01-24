<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Workbench\Site\Model\Lookup\Isirumah;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Event;
use App\Providers\AuditLog;
class AhliIsiRumahImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
     private $idrumah;

    public function __construct($idrumah)
    {
        $this->data = $idrumah; 
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {

        	// $data = Pemilikanrumah::find($row['id']);

        //if (empty($data)) {

         $jumlah_isirumah=Isirumah::where('fk_rumah',$this->data)->whereNull('deleted_at')->count();

         if($jumlah_isirumah==0){

          $idisirumah=1;


         }else{

          $idisirumah=$jumlah_isirumah+1;


         }

          $tahunic=substr($row['nokp'],0,2);

         $bulanic=substr($row['nokp'],2,2);

         $hariic=substr($row['nokp'],4,2);


         $dob=explode(" ",$tahunic);

         $startyear=substr($row['nokp'],0,1);

        $lastno=substr($row['nokp'],11);


        if($startyear==0 || $startyear==1 || $startyear==2){

          $pangkal='20';

        }else{
          $pangkal='19';


        }

        $lahir=$pangkal.$tahunic.'-'.$bulanic.'-'.$hariic;

        if ($lastno % 2 == 0) {
            $jantina='114';
          }else{
            $jantina='113';

          }





          $isirumah = Isirumah::create([
               'fk_rumah'      	   => $this->data,
               'IdIsiRumah'   	   => $idisirumah,
               'flag_ketua_rumah'  => 0,
               'NoKP' 	   		   => $row['nokp'],
               'Nama'        	   => $row['nama'],
               //'Umur' 	   		   => $row['umur'],
               'Jantina'   	   	   => $jantina,
               'Bangsa'   	   	   => $row['bangsa'],
               'Pendapatan'   	   => $row['pendapatan'],
               'PenerimaBantuan'   => $row['penerimabantuan'],
               'BantuanLain'       => $row['bantuanlain'],
               'TarikhLahir'       => $lahir,
               'Warganegara'       => $row['warganegara'],
               'Agama'    	  	   => $row['agama'],
               'TarafKahwin'       => $row['tarafkahwin'],
               'StatusPekerjaan'   => $row['statuspekerjaan'],
               'Pekerjaan'         => $row['pekerjaan'],
               'TelNo'       	   => '0'.$row['telno'],
               'Email'       	   => $row['email'],
               'JenisPengenalan'           => $row['jenispengenalan'],
           ]);



          $activities2='Import Isi Rumah';
          $new_value2=Isirumah::find($isirumah->id);
          Event::dispatch(new AuditLog(auth()->user()->id,$isirumah->id,$activities2,'',json_encode($new_value2)));


      }




    }
   
}
