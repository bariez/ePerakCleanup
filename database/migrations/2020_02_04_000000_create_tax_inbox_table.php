<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxInboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_inbox', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Subjek')->nullable();
            $table->string('Mesej')->nullable();
            $table->string('Daripada')->nullable();
            $table->string('NoId')->nullable();
            $table->string('NoFail')->nullable();
            $table->string('TarikhNotis')->nullable();
            $table->string('TarikhTerima')->nullable();
            $table->string('Unread')->nullable();
            $table->string('JenisFail')->nullable();
            $table->string('RefNo')->nullable();
            $table->string('Nama')->nullable();
            $table->string('Emel')->nullable();
            $table->string('NoBaucar')->nullable();
            $table->string('NamaBank')->nullable();
            $table->string('NoAkaun')->nullable();
            $table->string('NoEft')->nullable();
            $table->string('TkhRefund')->nullable();
            $table->string('BankPembayar')->nullable();
            $table->string('Sumber')->nullable();
            $table->string('Status')->nullable();
            $table->string('Filler')->nullable();
            $table->string('FolderId')->nullable();
            $table->string('FolderDate')->nullable();
            $table->string('AmaunKredit')->nullable();
            $table->string('ThnTaksiran')->nullable();
            $table->string('RefId')->nullable();
            $table->string('NamaSyarikat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_inbox');
    }
}
