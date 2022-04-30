<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiling', function (Blueprint $table) {
            $table->integer('id', true);
            $table->double('temperatureM')->nullable();
            $table->double('nombre_pasM')->nullable();
            $table->double('frequence_resM')->nullable();
            $table->double('rythme_cardM')->nullable();
            $table->timestamp('date');
            $table->integer('id_assigner')->nullable()->index('FK_assign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiling');
    }
}
