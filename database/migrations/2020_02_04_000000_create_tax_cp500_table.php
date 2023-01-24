<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxCp500Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_cp500', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('fk_users')->nullable();
            $table->string('TAX_PAYER_NAME1')->nullable();
            $table->string('NEW_IC_NO')->nullable();
            $table->string('IT_REF_NO')->nullable();
            $table->string('FILE_TYPE')->nullable();
            $table->string('JUM_PERLU_BYR')->nullable();
            $table->string('SKIM_DATE')->nullable();
            $table->string('ASSESSMENT_YEAR')->nullable();
            $table->string('BASIS_START_DATE')->nullable();
            $table->string('BASIS_END_DATE')->nullable();
            $table->string('MIN_DUE_AMOUNT')->nullable();
            $table->string('MAX_DUE_AMOUNT')->nullable();
            $table->string('IT_COL_BRANCH')->nullable();
            $table->string('BRANCH_NAME')->nullable();
            $table->string('TOTAL_AMOUNT_CP500')->nullable();
            $table->string('INSTALLMENT_TYPE_CODE')->nullable();
            $table->string('refid')->nullable();
            $table->string('BIL_PERLU_BYR')->nullable();
            $table->string('JumlahAnsuran')->nullable();
            $table->string('BilAnsuranBayaran')->nullable();
                      
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
        Schema::dropIfExists('tax_cp500');
    }
}
