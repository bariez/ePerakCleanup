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
        Schema::create('profil_kemudahan', function (Blueprint $table) {
            $table->id();
            $table->integer('fk_kampung')->nullable();
            $table->integer('KatKemudahan')->nullable();
            $table->integer('JenisKemudahan')->nullable();
            $table->integer('Bilangan')->nullable();
            $table->string('Unit')->nullable();
            $table->decimal('Longitud', 10, 5)->nullable();
            $table->decimal('Latitud', 10, 5)->nullable();
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
        Schema::dropIfExists('profil_kemudahan');
    }
};
