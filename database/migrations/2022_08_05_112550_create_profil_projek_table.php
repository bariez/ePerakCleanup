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
        Schema::create('profil_projek', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_kampung')->nullable();
            $table->integer('Tahun')->nullable();
            $table->string('NamaProjek')->nullable();
            $table->string('Lokasi')->nullable();
            $table->string('Sumber')->nullable();
            $table->string('Agensi')->nullable();
            $table->string('JenisProjek')->nullable();
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
        Schema::dropIfExists('profil_projek');
    }
};
