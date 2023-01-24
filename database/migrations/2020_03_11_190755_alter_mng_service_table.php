<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMngServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::table('mng_service', function (Blueprint $table) {
            $table->text('service')->charset(null)->nullable()->change();
            $table->renameColumn('service', 'service_bm');
            $table->text('service_en')->after('service')->nullable();
            $table->text('description')->charset(null)->nullable()->change();
            $table->renameColumn('description', 'description_bm');
            $table->text('description_en')->after('description')->nullable();
            $table->integer('API')->charset(null)->nullable()->change();
            $table->renameColumn('API', 'order');
            $table->text('URL')->charset(null)->nullable()->change();
            $table->renameColumn('URL', 'content_bm');
            $table->text('content_en')->after('URL')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('mng_service', function (Blueprint $table) {
        //     //
        // });
    }
}
