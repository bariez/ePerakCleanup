<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMngLkpAnswerPicFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mng_lkp_answer_pic_feedback', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('answer_en')->nullable();
            $table->text('answer_bm')->nullable();
            $table->date('date')->nullable();
            $table->string('dir')->nullable();
            $table->string('full_path')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_size')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('mng_lkp_answer_pic_feedback');
    }
}
