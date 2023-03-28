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
        Schema::table('galeri_mast', function (Blueprint $table) {
            $table->renameColumn('gambar_utama_path', 'Gambar_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('galeri_mast', function (Blueprint $table) {
             $table->renameColumn('Gambar_path', 'gambar_utama_path');
        });
    }
};
