<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('tax_company_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fk_users')->nullable();
            $table->text('Jenis_File')->nullable();
            $table->text('Nama_Syarikat')->nullable();
            $table->text('No_Rujukan')->nullable();
            $table->text('No_Roc')->nullable();
            $table->string('BakiCukai')->nullable();
            $table->string('ByrnBelumBolehGuna')->nullable();
            $table->string('BakiLejar')->nullable();
            $table->text('IT_Assm_Branch')->nullable();
            $table->text('IT_Collection_Branch')->nullable();
            $table->text('CKHT_Assm_Branch')->nullable();
            $table->text('CKHT_Collection_Branch')->nullable();
            $table->text('Bank_CD')->nullable();
            $table->text('Bank_Acct_No')->nullable();
            $table->text('Bank_Name')->nullable();
            $table->text('IT_Grp_CD')->nullable();
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
        // Schema::table('mng_service', function (Blueprint $table) {
        //     //
        // });
    }
}
