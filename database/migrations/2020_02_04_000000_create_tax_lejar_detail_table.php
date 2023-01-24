<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxLejarDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_elejar_detail', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('fk_users')->nullable();
            $table->string('ASSESSMENT_YEAR')->nullable();
            $table->string('JumTggnCukai')->nullable();
            $table->string('JumBayaranCukai')->nullable();
            $table->string('JumBersih')->nullable();
            $table->string('ByrnBelumBolehGuna')->nullable();
            $table->string('BakiCukaiSemasa')->nullable();
                       
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
        Schema::dropIfExists('tax_elejar_detail');
    }
}
