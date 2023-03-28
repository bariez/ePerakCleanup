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
        Schema::create('profil_pentadbiran', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_kampung')->nullable();
            $table->string('Sesi')->nullable();
            $table->string('NamaAhli')->nullable();
            $table->string('NoKP')->nullable();
            $table->string('Jawatan')->nullable();
            $table->string('Biro')->nullable();
            $table->string('Gambar_path')->nullable();
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
        Schema::dropIfExists('profil_pentadbiran');
    }
};
