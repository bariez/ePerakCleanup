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
    public function up()
    {
        Schema::create('profil_pengeluar', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_kampung')->nullable();
            $table->string('NamaSyarikat')->nullable();
            $table->string('NamaWakil')->nullable();
            $table->string('TelNoPejabat')->nullable();
            $table->string('TelNoBimbit')->nullable();
            $table->string('Faks')->nullable();
            $table->string('Email')->nullable();
            $table->integer('MediaSosial')->nullable();
            $table->string('LinkMediaSosial')->nullable();
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
        Schema::dropIfExists('profil_pengeluar');
    }
};
