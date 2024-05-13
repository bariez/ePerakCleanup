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
        if (Schema::hasColumn('profil_produk', 'fk_kampung')) {
            return;
        }
        Schema::table('profil_produk', function (Blueprint $table) {
            $table->integer('fk_kampung')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('profil_produk', 'fk_kampung')) {
            return;
        }

        Schema::table('profil_produk', function (Blueprint $table) {
            $table->dropColumn('fk_kampung');
        });
    }
};
