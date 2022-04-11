<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceUrgenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviceUrgence', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nom')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone', 10)->nullable();
            $table->string('fixe', 10)->nullable();
            $table->integer('alerte')->nullable()->index('fk_alerte');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serviceUrgence');
    }
}
