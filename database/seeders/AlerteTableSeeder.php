<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AlerteTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('alerte')->delete();
        
        \DB::table('alerte')->insert(array (
            0 => 
            array (
                'id' => 3,
                'date_envoie' => '2022-07-10 15:27:40',
                'id_incident' => 2688,
                'id_contact_urgence' => 8,
            ),
            1 => 
            array (
                'id' => 4,
                'date_envoie' => '2022-07-10 15:27:40',
                'id_incident' => 2688,
                'id_contact_urgence' => 38,
            ),
        ));
        
        
    }
}