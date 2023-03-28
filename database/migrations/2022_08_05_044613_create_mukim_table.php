<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

         Schema::create('mukim', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_daerah')->nullable();
            $table->string('KodMukim')->nullable();
            $table->string('NamaMukim')->nullable();
            $table->integer('Status')->nullable();
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
        Schema::dropIfExists('mukim');
    }
};
