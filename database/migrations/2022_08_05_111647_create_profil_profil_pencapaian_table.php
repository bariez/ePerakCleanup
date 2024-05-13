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
        Schema::create('profil_pencapaian', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_kampung')->nullable();
            $table->integer('Peringkat')->nullable();
            $table->integer('Tahun')->nullable();
            $table->string('Aktiviti')->nullable();
            $table->string('Keterangan')->nullable();
            $table->integer('Pencapaian')->nullable();
            $table->string('Penganjur')->nullable();
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
        Schema::dropIfExists('profil_pencapaian');
    }
};
