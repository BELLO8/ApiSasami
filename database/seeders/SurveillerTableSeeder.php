<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SurveillerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('surveiller')->delete();
        
        \DB::table('surveiller')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_personne_vulnerable' => 18,
                'id_personne_Affilee' => 3,
            ),
        ));
        
        
    }
}