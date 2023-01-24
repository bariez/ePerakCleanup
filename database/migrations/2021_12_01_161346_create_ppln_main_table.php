<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePplnMainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppln_main', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tax_payer_name')->nullable();
            $table->string('incometax_no')->nullable();
            $table->string('tax_payer_reference_no')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('handphone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('total_peremitan')->nullable();
            $table->string('declaration_name')->nullable();
            $table->string('ic_passpport_no')->nullable();
            $table->string('position')->nullable();
            $table->date('submit_date')->nullable();
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
        Schema::dropIfExists('ppln_main');
    }
}
