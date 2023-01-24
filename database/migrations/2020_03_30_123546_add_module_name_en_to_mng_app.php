<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModuleNameEnToMngApp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mng_app', function (Blueprint $table) {
           $table->text('module_name_en')->after('module_name')->nullable();
           $table->renameColumn('module_name', 'module_name_bm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mng_app', function (Blueprint $table) {
            //
        });
    }
}
