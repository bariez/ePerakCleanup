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
        Schema::create('content_page', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_menum')->nullable();
            $table->string('nama')->nullable();
            $table->longText('content')->nullable();
            $table->integer('susunan')->nullable();

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
        Schema::dropIfExists('content_page');
    }
};
