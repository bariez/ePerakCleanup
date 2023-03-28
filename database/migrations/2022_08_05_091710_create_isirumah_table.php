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
        Schema::create('isirumah', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_rumah')->nullable();
            $table->string('IdIsiRumah')->nullable();
            $table->string('NoKP')->nullable();
            $table->string('Nama')->nullable();
            $table->string('Umur')->nullable();
            $table->integer('Jantina')->nullable();
            $table->integer('Bangsa')->nullable();
            $table->decimal('Pendapatan', 10, 5)->nullable();
            $table->integer('PenerimaBantuan')->nullable();
            $table->string('BantuanLain')->nullable();
            $table->date('TarikhLahir')->nullable();
            $table->integer('Warganegara')->nullable();
            $table->integer('Agama')->nullable();
            $table->integer('TarafKahwin')->nullable();
            $table->integer('StatusPekerjaan')->nullable();
            $table->string('Pekerjaan')->nullable();
            $table->string('TelNo')->nullable();
            $table->string('Email')->nullable();
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
        Schema::dropIfExists('isirumah');
    }
};
