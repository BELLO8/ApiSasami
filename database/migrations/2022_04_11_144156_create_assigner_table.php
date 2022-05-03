<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigner', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('freq_enrg')->nullable();
            $table->timestamp('date');
            $table->integer('id_personneV');
            $table->integer('id_dispositif');
            $table->unique(['id_personneV', 'id_dispositif']);
            $table->unique('id_dispositif');

            $table->foreign('id_personneV')
                ->references('id')
                ->on('vulnerable')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_dispositif')
                ->references('id')
                ->on('dispositif')
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
        Schema::dropIfExists('assigner');
    }
}
