<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notis', function (Blueprint $table) {
            $table->text('ringkasan')->after('tajuk')->nullable();
            $table->string('tarikh_notis')->after('kategori')->nullable();
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
        Schema::table('notis', function (Blueprint $table) {
            //
        });
    }
};
