<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToServiceUrgenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('serviceUrgence', function (Blueprint $table) {
            $table->foreign(['alerte'], 'fk_alerte')->references(['id'])->on('alerte');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('serviceUrgence', function (Blueprint $table) {
            $table->dropForeign('fk_alerte');
        });
    }
}
