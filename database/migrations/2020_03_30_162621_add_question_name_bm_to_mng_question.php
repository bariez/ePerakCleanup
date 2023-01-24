<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuestionNameBmToMngQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mng_question', function (Blueprint $table) {
           $table->text('question_name_en')->after('question_name')->nullable();
           $table->renameColumn('question_name', 'question_name_bm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mng_question', function (Blueprint $table) {
            //
        });
    }
}
