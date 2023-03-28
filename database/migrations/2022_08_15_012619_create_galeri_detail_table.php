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
        Schema::create('galeri_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_galeri_mast')->nullable();
            $table->integer('kategori')->nullable();
            $table->string('url')->nullable();
            $table->string('gambar_path')->nullable();
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
        Schema::dropIfExists('galeri_detail');
    }
};
