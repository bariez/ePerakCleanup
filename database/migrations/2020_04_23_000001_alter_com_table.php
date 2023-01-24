<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterComTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::table('tax_company_list', function (Blueprint $table) {
            $table->string('BakiCukaiCkht')->after('BakiCukai')->nullable();
            $table->string('ByrnBelumBolehGunaCkht')->after('ByrnBelumBolehGuna')->nullable();
            $table->string('BakiLejarCkht')->after('BakiLejar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('mng_service', function (Blueprint $table) {
        //     //
        // });
    }
}
