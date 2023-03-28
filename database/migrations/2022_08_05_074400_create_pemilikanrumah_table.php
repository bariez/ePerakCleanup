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
        Schema::create('pemilikanrumah', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_kampung')->nullable();
            $table->string('IdRumah')->nullable();
            $table->string('AlamatRumah1')->nullable();
            $table->string('AlamatRumah2')->nullable();
            $table->integer('Poskod')->nullable();
            $table->integer('StatusMilikan')->nullable();
            $table->integer('JenisRumah')->nullable();
            $table->integer('JenisBinaan')->nullable();
            $table->integer('BilTingkat')->nullable();
            $table->integer('BilBilik')->nullable();
            $table->string('KElektrik')->nullable();
            $table->string('KTelefon')->nullable();
            $table->string('KAir')->nullable();
            $table->string('KInternet')->nullable();
            $table->string('KAstro')->nullable();
            $table->decimal('Longitud', 10, 5)->nullable();
            $table->decimal('Latitud', 10, 5)->nullable();
            $table->string('Gambar_path')->nullable();
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
        Schema::dropIfExists('pemilikanrumah');
    }
};
