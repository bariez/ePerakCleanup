<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnswerNameEnToMngAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mng_answer', function (Blueprint $table) {
           $table->text('answer_name_en')->after('answer_name')->nullable();
           $table->renameColumn('answer_name', 'qanswer_name_bm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mng_answer', function (Blueprint $table) {
            //
        });
    }
}
