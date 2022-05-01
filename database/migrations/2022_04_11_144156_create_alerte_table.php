<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlerteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerte', function (Blueprint $table) {
            $table->integer('id', true);
            $table->timestamp('date_envoie');
            $table->integer('id_incident');
            $table->integer('id_contact_urgence');

            $table->unique(['id_contact_urgence']);

            $table->foreign('id_incident')
                  ->references('id')
                  ->on('incident')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('id_contact_urgence')
                  ->references('id')
                  ->on('contact_urgence')
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
        Schema::dropIfExists('alerte');
    }
}
