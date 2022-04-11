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
            $table->integer('frequenceD')->nullable();
            $table->date('dates')->nullable();
            $table->integer('id_personneV')->nullable()->index('FK_personneV');
            $table->integer('id_dispositif')->nullable()->index('FK_dispositif');
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
