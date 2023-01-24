<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Workbench\Site\Model\Lookup\Pemilikanrumah;
use Workbench\Site\Model\Lookup\Isirumah;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared;
use Event;
use App\Providers\AuditLog;

class KetuaIsiRumahImport implements ToCollection,WithHeadingRow
{
    /**

    * @param Collection $collection
    */
     private $idkampung; 

    public function __construct($idkampung)
    {
        $this->data = $idkampung; 
    }

    public function collection(Collection $rows)
    {

  

        foreach ($rows as $row)
        {


         $jumlah_rumah_kampung=Pemilikanrumah::where('fk_kampung',$this->data)
         ->whereNull('deleted_at')->count();

         if($jumlah_rumah_kampung==0){

          $idrumah=1;


         }else{

          $idrumah=$jumlah_rumah_kampung+1;


         }

        	// $data = Pemilikanrumah::find($row['id']);

        //if (empty($data)) {
         $ketuarumah = Pemilikanrumah::create([
               'fk_kampung'    => $this->data,
               'IdRumah' 	   => $idrumah,
               'AlamatRumah1'  => $row['alamatrumah1'],
               'AlamatRumah2'  => $row['alamatrumah2'],
               'Poskod'        => $row['poskod'],
               'StatusMilikan' => $row['statusmilikan'],
               'JenisRumah'    => $row['jenisrumah'],
               'JenisBinaan'   => $row['jenisbinaan'],
               'BilTingkat'    => $row['biltingkat'],
               'BilBilik'      => $row['bilbilik'],
               'KElektrik'     => $row['kelektrik'],
               'KTelefon'      => $row['ktelefon'],
               'KAir'          => $row['kair'],
               'KInternet'     => $row['kinternet'],
               'KAstro'        => $row['kastro'],
               'Longitud'      => $row['longitud'],
               'Latitud'       => $row['latitud'],
           ]);



          $jumlah_isirumah=Isirumah::where('fk_rumah',$ketuarumah->id)->whereNull('deleted_at')->count();

         if($jumlah_isirumah==0){

          $idisirumah=1;


         }else{

          $idisirumah=$jumlah_isirumah+1;


         }




        ///calculate tarikh lahir

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
               'fk_rumah'      	   => $ketuarumah->id,
               'IdIsiRumah'   	   => $idisirumah,
               'flag_ketua_rumah'  => 1,
               'NoKP' 	   		   => $row['nokp'],
               'Nama'        	   => $row['nama'],
               ///'Umur' 	   		   => $row['umur'],
               'Jantina'   	   	   => $jantina,
               'Bangsa'   	   	   => $row['bangsa'],
               'Pendapatan'   	   => $row['pendapatan'],
               'PenerimaBantuan'   => $row['penerimabantuan'],
               'BantuanLain'       => $row['bantuanlain'],
               'TarikhLahir'       =>  $lahir,
               'Warganegara'       => $row['warganegara'],
               'Agama'    	  	   => $row['agama'],
               'TarafKahwin'       => $row['tarafkahwin'],
               'StatusPekerjaan'   => $row['statuspekerjaan'],
               'Pekerjaan'         => $row['pekerjaan'],
               'TelNo'       	   => '0'.$row['telno'],
               'Email'       	   => $row['email'],
               'JenisPengenalan' => $row['jenispengenalan'],

           ]);
          
           // $myString = $row[8];
           // $myArray = explode(',', $myString);
           // foreach ($myArray as $value) {
           //     Courses::create([
           //          'user_id' => $user->id,
           //          'course_name' => $value,
           //     ]);
           // }

//return '1';

          $activities1='Import Pemilikan Rumah';
          $activities2='Import Isi Rumah';

          $new_value1=Pemilikanrumah::find($ketuarumah->id);
          $new_value2=Isirumah::find($isirumah->id);

          Event::dispatch(new AuditLog(auth()->user()->id,$ketuarumah->id,$activities1,'',json_encode($new_value1)));
          Event::dispatch(new AuditLog(auth()->user()->id,$isirumah->id,$activities2,'',json_encode($new_value2)));

       // }else{

       // 	  break;

       // 	  return '0';
       // }
      }




    }

    // public function rules(): array
    // {
    //     return [
    //         'id' => 'unique',
            
    //     ];
    // }

    // public function customValidationMessages()
    // {
    //     return [
    //          'id.unique' => 'Custom message',
    //     ];
    // }



}
