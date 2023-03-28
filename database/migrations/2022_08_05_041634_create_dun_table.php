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
        Schema::create('dun', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_parlimen')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('KodDun')->nullable();
            $table->string('NamaDun')->nullable();
            $table->string('Parti')->nullable();
            $table->string('AhliDun')->nullable();
            $table->string('Jawatan')->nullable();
            $table->string('AlamatPejabat1')->nullable();
            $table->string('TelNo')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('dun');
    }
};
