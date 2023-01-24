<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxPcbCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_pcb_detail_calendar', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('fk_users')->nullable();
            $table->string('Tahun')->nullable();
            $table->string('SEQ_NO')->nullable();
            $table->string('ASSESSMENT_NO')->nullable();
            $table->string('ASSESSMENT_YEAR')->nullable();
            $table->string('CALENDAR_YEAR')->nullable();
            $table->string('TRANSACTION_CODE')->nullable();
            $table->string('POSTED_DATE')->nullable();
            $table->string('TRANSACTION_DATE')->nullable();
            $table->string('TYP')->nullable();
            $table->string('AMT')->nullable();
            $table->string('FK2_CRAL_BRCHCD')->nullable();
            $table->string('TggnCukai')->nullable();
            $table->string('BayaranCukai')->nullable();
            $table->string('DOC_NO')->nullable();
            $table->string('RECEIPT_NO')->nullable();
            $table->string('Keterangan')->nullable();
            $table->string('JnsTransaksi')->nullable();
            $table->string('BRANCH_CODE')->nullable();
            $table->string('BakiCukai')->nullable();                      
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_pcb_detail_calendar');
    }
}
