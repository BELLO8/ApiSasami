<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToIncidentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incident', function (Blueprint $table) {
            $table->foreign(['id_dispositif'], 'FK_dispositifs')->references(['id'])->on('dispositif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incident', function (Blueprint $table) {
            $table->dropForeign('FK_dispositifs');
        });
    }
}
