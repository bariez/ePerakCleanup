<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnnouncementBmToMngAnnouncement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mng_announcement', function (Blueprint $table) {
            $table->text('announcement_en')->after('announcement')->nullable();
            $table->renameColumn('announcement', 'announcement_bm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mng_announcement', function (Blueprint $table) {
            //
        });
    }
}
