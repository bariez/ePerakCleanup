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
        Schema::create('kampung', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_parlimen')->nullable();
            $table->integer('fk_dun')->nullable();
            $table->integer('fk_derah')->nullable();
            $table->integer('fk_mukim')->nullable();
            $table->string('IdKampung')->nullable();
            $table->string('NamaPegawaiDaerah')->nullable();
            $table->string('NamaPenghuluMukim')->nullable();
            $table->string('NamaKampung')->nullable();
            $table->string('IdKampungInduk')->nullable();
            $table->string('KategoriPetempatan')->nullable();
            $table->string('JenisKgTradisional')->nullable();
            $table->string('NamaJPKK')->nullable();
            $table->string('NamaPengerusi')->nullable();
            $table->string('AlamatJPKK')->nullable();
            $table->string('TelNo')->nullable();
            $table->string('Sejarah')->nullable();
            $table->decimal('Longitud', 10, 5)->nullable();
            $table->decimal('Latitud', 10, 5)->nullable();
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
        Schema::dropIfExists('kampung');
    }
};
