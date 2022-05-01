<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAlerteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alerte', function (Blueprint $table) {
            $table->foreign(['id_incident'], 'fk_incident')->references(['id'])->on('incident');
            $table->foreign(['id_contact_urgence'], 'fk_c_urgence')->references(['id'])->on('contact_urgence');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alerte', function (Blueprint $table) {
            $table->dropForeign('fk_incident');
        });
    }
}
