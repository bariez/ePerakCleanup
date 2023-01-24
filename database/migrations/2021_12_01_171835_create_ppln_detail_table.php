<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePplnDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppln_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fk_ppln_main')->nullable();
            $table->integer('fk_lkp_kod_pendapatan')->nullable();
            $table->integer('fk_lkp_kod_jenis_remitan')->nullable();
            $table->decimal('total',14,2)->nullable();
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
