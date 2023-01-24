<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMngFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mng_feedback', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('date_feedback');
            $table->integer('verygood')->nullable();
            $table->integer('statisfy')->nullable();
            $table->integer('need_enhancement')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('mng_feedback');
    }
}
