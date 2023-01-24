<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionEngToLkpKodJenisRemitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lkp_kod_jenis_remit', function (Blueprint $table) {
           $table->string('description_eng')->after('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lkp_kod_jenis_remit', function (Blueprint $table) {
            //
        });
    }
}
