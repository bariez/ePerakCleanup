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
        Schema::table('lkp_detail', function (Blueprint $table) {
            $table->renameColumn('cat_detail', 'category_detail');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lkp_detail', function (Blueprint $table) {
            $table->renameColumn('category_detail', 'cat_detail');
        });
    }
};
