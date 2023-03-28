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
        Schema::create('profil_produk', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_kampung')->nullable();
            $table->integer('fk_pengeluar')->nullable();
            $table->string('NamaProduk')->nullable();
            $table->string('Keterangan')->nullable();
            $table->integer('KategoriProduk')->nullable();
            $table->integer('JenisProduk')->nullable();
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
        Schema::dropIfExists('profil_produk');
    }
};
