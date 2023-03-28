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
        Schema::create('menum', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->string('url')->nullable();
            $table->integer('susunan')->nullable();
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
        Schema::dropIfExists('menum');
    }
};
