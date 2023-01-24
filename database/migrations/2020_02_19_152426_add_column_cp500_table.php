<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCp500Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::table('tax_cp500', function (Blueprint $table) {

            $table->integer('fk_tax_inbox')->after('id')->nullable();
            $table->string('REMS_DATE')->after('NEW_IC_NO')->nullable();
            $table->string('NO_INST')->after('NEW_IC_NO')->nullable();
            $table->string('MONTH_FAIL')->after('NEW_IC_NO')->nullable();
            $table->string('DATE1')->after('NEW_IC_NO')->nullable();
            $table->string('DATE2')->after('NEW_IC_NO')->nullable();
            $table->string('DATE3')->after('NEW_IC_NO')->nullable();
            $table->string('DATE4')->after('NEW_IC_NO')->nullable();
            $table->string('DATE5')->after('NEW_IC_NO')->nullable();
            $table->string('DATE6')->after('NEW_IC_NO')->nullable();
            $table->string('AMT1')->after('NEW_IC_NO')->nullable();
            $table->string('AMT2')->after('NEW_IC_NO')->nullable();
            $table->string('AMT3')->after('NEW_IC_NO')->nullable();
            $table->string('AMT4')->after('NEW_IC_NO')->nullable();
            $table->string('AMT5')->after('NEW_IC_NO')->nullable();
            $table->string('AMT6')->after('NEW_IC_NO')->nullable();
            $table->string('JUM_SUDAH_BYR')->after('NEW_IC_NO')->nullable();
            $table->string('NEXT_MONTH_FAIL')->after('NEW_IC_NO')->nullable();
            $table->string('DATE_NEXT_MONTH')->after('NEW_IC_NO')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tax_cp500', function (Blueprint $table) {
            //
        });
    }
}
