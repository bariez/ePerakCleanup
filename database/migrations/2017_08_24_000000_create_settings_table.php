<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration
{
    /**
     * Set up the options.
     */
    public function __construct()
    {
        $this->table = config('setting.database.table', 'settings');
        $this->key = config('setting.database.key', 'key');
        $this->value = config('setting.database.value', 'value');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string($this->key)->index();
            $table->text($this->value);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop($this->table);
    }
}
