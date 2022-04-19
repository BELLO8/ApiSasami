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
            $table->foreign(['personne_Affilee'], 'fk_personne_Affilee')->references(['id'])->on('personneAffilee');
            $table->foreign(['personne_vulnerable'], 'fk_personne_vulnerable')->references(['id'])->on('profile');
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
