<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constante', function (Blueprint $table) {
            $table->integer('id', true);
            $table->double('temperature')->nullable();
            $table->double('nombre_pas')->nullable();
            $table->double('frequence_res')->nullable();
            $table->double('rythme_card')->nullable();
            $table->text('coordonnee_geographique')->nullable();
            $table->timestamp('date');
            $table->integer('id_assigner')->nullable()->index('FK_assigner');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constante');
    }
}
