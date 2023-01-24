<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fk_users');
            $table->string('tax_balance');
            $table->string('tax_refund');
            $table->string('tax_restrain');
            $table->string('tax_cert_status');
            $table->string('tax_cert_type');
            $table->string('address');
            $table->string('handphone_no');
            $table->string('homephone_no');
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
        Schema::dropIfExists('tax_profile');
    }
}
