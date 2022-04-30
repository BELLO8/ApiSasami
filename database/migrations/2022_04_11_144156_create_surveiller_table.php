<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveillerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveiller', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_personne_vulnerable')->nullable()->index('fk_personne_vulnerable');
            $table->integer('id_personne_Affilee')->nullable()->index('fk_personne_Affilee');
            $table->unique(['id_personne_vulnerable','id_personne_Affilee']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveiller');
    }
}
