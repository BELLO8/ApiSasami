<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlerteUrgencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerte_urgences', function (Blueprint $table) {

            $table->id();
            $table->integer('id_alerte');
            $table->integer('id_contact_urgence');
            $table->unique(['id_alerte','id_contact_urgence']);

            $table->foreign('id_alerte')
                  ->references('id')
                  ->on('alerte')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('id_contact_urgence')
                  ->references('id')
                  ->on('contact_Urgence')
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
        Schema::dropIfExists('alerte_urgences');
    }
}
