<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AffileeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('affilee')->delete();
        
        \DB::table('affilee')->insert(array (
            0 => 
            array (
                'id' => 3,
                'nom' => 'Yasmine',
                'prenom' => 'kouame',
                'adresse' => 'Abidjan',
                'telephone' => '0707070801',
                'age' => 24,
            ),
        ));
        
        
    }
}