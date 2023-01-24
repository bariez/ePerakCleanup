<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTaxInboxNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::table('tax_inbox', function (Blueprint $table) {
            $table->string('TahunTaksiran1')->after('ThnTaksiran')->nullable();
            $table->string('SumberBEN')->after('ThnTaksiran')->nullable();

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
