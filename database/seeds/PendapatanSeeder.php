<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PendapatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lkp_kod_pendapatan')->insert([
            [
                'code' => 'R1',
                'description' => 'PENGGAJIAN',
                'description_eng' => 'EMPLOYMENT',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'R2',
                'description' => 'PERNIAGAAN',
                'description_eng' => 'BUSINESS',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'R3',
                'description' => 'PERKONGSIAN',
                'description_eng' => 'PARTNERSHIP',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'R4',
                'description' => 'DIVIDEN',
                'description_eng' => 'DIVIDEN',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'R5',
                'description' => 'FAEDAH',
                'description_eng' => 'INTERESTS',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'R6',
                'description' => 'DISKAUN',
                'description_eng' => 'DISCOUNTS',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'R7',
                'description' => 'SEWA',
                'description_eng' => 'RENTAL',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'R8',
                'description' => 'ROYALTI',
                'description_eng' => 'ROYALTY',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'R9',
                'description' => 'PREMIUM',
                'description_eng' => 'PREMIUM',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'R10',
                'description' => 'ANUITI',
                'description_eng' => 'ANNUITIES',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'R11',
                'description' => 'PENCEN',
                'description_eng' => 'PENSIONS',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'R12',
                'description' => 'LAIN-LAIN PENDAPATAN',
                'description_eng' => 'OTHERS INCOME',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
