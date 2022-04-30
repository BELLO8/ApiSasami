<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProfilingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiling', function (Blueprint $table) {
            $table->foreign(['id_assigner'], 'FK_assign')->references(['id'])->on('assigner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiling', function (Blueprint $table) {
            $table->dropForeign('FK_assigners');
        });
    }
}
