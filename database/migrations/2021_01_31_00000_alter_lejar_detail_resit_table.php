<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLejarDetailResitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::table('tax_elejar_detail_current', function (Blueprint $table) {
            $table->string('NoLot')->after('BakiCukai')->nullable();
            $table->string('RECEIPT_NUM')->after('RECEIPT_NO')->nullable();
            $table->string('RECT_NUM')->after('RECEIPT_NO')->nullable();
            $table->string('DOC_NUM')->after('RECEIPT_NO')->nullable();
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
