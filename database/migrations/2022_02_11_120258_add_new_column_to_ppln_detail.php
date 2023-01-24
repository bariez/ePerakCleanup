<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToPplnDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ppln_detail', function (Blueprint $table) {
            $table->integer('fk_lkp_country_code')->after('fk_lkp_kod_jenis_remitan')->nullable();
            $table->date('date_bank_lulus')->after('fk_lkp_country_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ppln_detail', function (Blueprint $table) {
            //
        });
    }
}
