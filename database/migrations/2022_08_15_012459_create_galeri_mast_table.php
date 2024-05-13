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
        Schema::create('galeri_mast', function (Blueprint $table) {
            $table->id();
            $table->string('Tajuk')->nullable();
            $table->text('Keterangan')->nullable();
            $table->integer('Status')->nullable();
            $table->string('gambar_utama_path')->nullable();
            $table->string('filename')->nullable();
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
        Schema::dropIfExists('galeri_mast');
    }
};
