<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToConstanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('constante', function (Blueprint $table) {
            $table->foreign(['id_assigner'], 'FK_assigner')->references(['id'])->on('assigner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('constante', function (Blueprint $table) {
            $table->dropForeign('FK_assigner');
        });
    }
}
