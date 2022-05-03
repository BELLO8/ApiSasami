<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFicheMedicalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_medicales', function (Blueprint $table) {
            $table->id();
            $table->integer('id_personne_vulnerable');
            $table->integer('poids');
            $table->integer('taille');
            $table->text('probleme_medicale');
            $table->text('traitement');
            $table->string('groupe_sanguin');
            $table->string('contact_personne_proche');

            $table->foreign('id_personne_vulnerable')
                  ->references('id')
                  ->on('vulnerable')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fiche_medicales');
    }
}
