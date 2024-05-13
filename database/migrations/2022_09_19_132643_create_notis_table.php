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
        Schema::create('notis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_daerah')->nullable();
            $table->string('tajuk')->nullable();
            $table->longText('keterangan')->nullable();
            $table->integer('kategori')->nullable();
            $table->string('tarikh_mula')->nullable();
            $table->string('tarikh_akhir')->nullable();

            $table->string('alt')->nullable();
            $table->string('path')->nullable();
            $table->string('filename')->nullable();

            $table->integer('status')->nullable();

            $table->timestamps();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notis');
    }
};
