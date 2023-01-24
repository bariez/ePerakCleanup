<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxSpcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_espc', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('fk_users')->nullable();
            $table->string('taxp_itrefno')->nullable();
            $table->string('empl_ref_no')->nullable();
            $table->string('stat')->nullable();
            $table->string('new_ic_no')->nullable();
            $table->string('old_ic_no')->nullable();
            $table->string('police_army')->nullable();
            $table->string('passport')->nullable();
            $table->string('FILE_TYPE')->nullable();
            $table->string('TkhLoad')->nullable();
            $table->string('Amt')->nullable();
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
        Schema::dropIfExists('tax_espc');
    }
}
