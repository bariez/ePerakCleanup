<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parlimen', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun')->nullable();
            $table->string('negeri')->nullable();
            $table->string('KodParlimen')->nullable();
            $table->string('NamaParlimen')->nullable();
            $table->string('Parti')->nullable();
            $table->string('AhliParlimen')->nullable();
            $table->string('Jawatan')->nullable();
            $table->string('AlamatPejabat')->nullable();
            $table->string('TelNo')->nullable();
            $table->string('Faks')->nullable();
            $table->string('Email')->nullable();
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
        Schema::dropIfExists('parlimen');
    }
};
