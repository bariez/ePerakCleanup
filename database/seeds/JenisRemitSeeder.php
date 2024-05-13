<?php

use App\Models\LkpKodJenisRemit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JenisRemitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LkpKodJenisRemit::truncate();

        DB::table('lkp_kod_jenis_remit')->insert([
            [
                'code' => 'J1',
                'description' => 'TUNAI',
                'description_eng' => 'CASH',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            //  [
            // 	'code' => 'J2',
            // 	'description' => 'TOKEN',
            // 	'description_eng' => 'TOKEN',
            // 	'status' => 1,
            // 	'created_at' => Carbon::now(),
            // 	'updated_at' => Carbon::now()
            // ],
            // [
            // 	'code' => 'J3',
            // 	'description' => 'WANG DIGITAL',
            // 	'description_eng' => 'DIGITAL CURRENCY',
            // 	'status' => 1,
            // 	'created_at' => Carbon::now(),
            // 	'updated_at' => Carbon::now()
            // ],
            [
                'code' => 'J2',
                'description' => 'PINDAHAN WANG',
                'description_eng' => 'MONEY TRANSFER',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
