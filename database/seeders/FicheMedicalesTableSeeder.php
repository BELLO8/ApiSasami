<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FicheMedicalesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('fiche_medicales')->delete();
        
        \DB::table('fiche_medicales')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_personne_vulnerable' => 18,
                'poids' => 123,
                'taille' => 178,
                'probleme_medicale' => 'Probleme1,probleme2',
                'traitement' => '',
                'groupe_sanguin' => 'A',
                'contact_personne_proche' => '0707707770',
            ),
        ));
        
        
    }
}