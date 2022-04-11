<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssignerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assigner', function (Blueprint $table) {
            $table->foreign(['id_dispositif'], 'FK_dispositif')->references(['id'])->on('dispositif');
            $table->foreign(['id_personneV'], 'FK_personneV')->references(['id'])->on('personneVulnerable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assigner', function (Blueprint $table) {
            $table->dropForeign('FK_dispositif');
            $table->dropForeign('FK_personneV');
        });
    }
}
