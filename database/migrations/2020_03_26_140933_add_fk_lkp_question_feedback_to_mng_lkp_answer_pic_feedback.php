<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkLkpQuestionFeedbackToMngLkpAnswerPicFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mng_lkp_answer_pic_feedback', function (Blueprint $table) {
           $table->integer('fk_lkp_question_feedback')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mng_lkp_answer_pic_feedback', function (Blueprint $table) {
            //
        });
    }
}
