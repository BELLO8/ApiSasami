<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnesVul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnes_vul', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('adresse', 25)->nullable();
            $table->string('telephone', 10)->nullable();
            $table->integer('age')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnes_vul');
    }
}
