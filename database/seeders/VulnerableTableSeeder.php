<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VulnerableTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vulnerable')->delete();
        
        \DB::table('vulnerable')->insert(array (
            0 => 
            array (
                'id' => 18,
                'nom' => 'Kouame',
                'prenom' => 'Alain',
                'adresse' => 'Abidjan',
                'telephone' => '0585070020',
                'age' => 78,
            ),
            1 => 
            array (
                'id' => 36,
                'nom' => 'zozo1',
                'prenom' => 'toto',
                'adresse' => 'Côte d\'Ivoire',
                'telephone' => '0142255270',
                'age' => 44,
            ),
        ));
        
        
    }
}