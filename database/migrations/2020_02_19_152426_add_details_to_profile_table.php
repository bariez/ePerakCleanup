<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tax_profile', function (Blueprint $table) {
            $table->string('IT_Collection_Branch')->after('homephone_no')->nullable();
            $table->string('IT_Assm_Branch')->after('homephone_no')->nullable();
            $table->string('CKHT_Assm_Branch')->after('homephone_no')->nullable();
            $table->string('CKHT_Collection_Branch')->after('homephone_no')->nullable();
            $table->string('Bank_CD')->after('homephone_no')->nullable();
            $table->string('Bank_Acct_No')->after('homephone_no')->nullable();
            $table->string('Bank_Name')->after('homephone_no')->nullable();
            $table->string('Name')->after('homephone_no')->nullable();
            $table->string('IT_Grp_CD')->after('homephone_no')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tax_profile', function (Blueprint $table) {
            //
        });
    }
}
