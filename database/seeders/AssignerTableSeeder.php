<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AssignerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('assigner')->delete();
        
        \DB::table('assigner')->insert(array (
            0 => 
            array (
                'id' => 1,
                'freq_enrg' => 2,
                'date' => '2022-06-16 15:47:55',
                'id_personneV' => 18,
                'id_dispositif' => 1,
            ),
            1 => 
            array (
                'id' => 16,
                'freq_enrg' => 10,
                'date' => '2022-07-11 15:47:51',
                'id_personneV' => 36,
                'id_dispositif' => 12,
            ),
        ));
        
        
    }
}