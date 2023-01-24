<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobileModuleNameEnEnToMngMobile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mng_mobile', function (Blueprint $table) {
           $table->text('mobile_module_name_en')->after('mobile_module_name')->nullable();
           $table->renameColumn('mobile_module_name', 'mobile_module_name_bm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mng_mobile', function (Blueprint $table) {
            //
        });
    }
}
