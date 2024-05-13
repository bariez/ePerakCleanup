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
        Schema::create('profil_aktiviti', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_kampung')->nullable();
            $table->string('NamaAktiviti')->nullable();
            $table->string('Penganjur')->nullable();
            $table->integer('Kategori')->nullable();
            $table->text('Keterangan')->nullable();
            $table->integer('Peringkat')->nullable();
            $table->string('Gambar_path')->nullable();
            $table->integer('Tahun')->nullable();
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
        Schema::dropIfExists('profil_aktiviti');
    }
};
