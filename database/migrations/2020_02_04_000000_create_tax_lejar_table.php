<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxLejarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_elejar', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('fk_users')->nullable();
            $table->string('lejar_type')->nullable();
            $table->string('income_type')->nullable();
            $table->string('description')->nullable();
            $table->string('BakiCukai')->nullable();
            $table->string('ByrnBelumBolehGuna')->nullable();
            $table->string('BakiLejar')->nullable();
                       
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
        Schema::dropIfExists('tax_elejar');
    }
}
