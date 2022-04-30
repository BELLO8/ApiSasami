<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositif', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('reference', 15)->nullable();
            $table->text('details', 100)->nullable();
            $table->smallInteger('telephone');
            $table->string('Adresse_ip', 46)->nullable();
            $table->string('status',25)->default('non connecté');
            $table->timestamp('date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispositif');
    }
}
