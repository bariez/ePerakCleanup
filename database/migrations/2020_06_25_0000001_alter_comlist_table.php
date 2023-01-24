<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterComlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::table('tax_company_list', function (Blueprint $table) {
            $table->text('Status_OeF')->after('No_Roc')->nullable();
            $table->text('Tarikh_Daftar')->after('No_Roc')->nullable();
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
