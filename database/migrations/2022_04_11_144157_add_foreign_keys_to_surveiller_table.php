<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSurveillerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surveiller', function (Blueprint $table) {
            $table->foreign(['id_personne_Affilee'], 'fk_personne_Affilee')->references(['id'])->on('Affilee');
            $table->foreign(['id_personne_vulnerable'], 'fk_personne_vulnerable')->references(['id'])->on('vulnerable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surveiller', function (Blueprint $table) {
            $table->dropForeign('fk_personne_Affilee');
            $table->dropForeign('fk_personne_vulnerable');
        });
    }
}
