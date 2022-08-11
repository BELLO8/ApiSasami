<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DispositifTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dispositif')->delete();
        
        \DB::table('dispositif')->insert(array (
            0 => 
            array (
                'id' => 1,
                'reference' => 'DISPnd2554',
            'details' => 'Un dispositif connecté qui mesure la fréquence cardiaque est-il un dispositif médical communicant (DMC) ou un objet connecté de santé',
                'telephone' => '0585070020',
                'Adresse_ip' => '192.168.252.16',
                'status' => 'deconnecter',
                'date' => '2022-05-23 10:50:09',
            ),
            1 => 
            array (
                'id' => 2,
                'reference' => 'DISPaP61',
            'details' => 'Un dispositif connecté qui mesure la fréquence cardiaque est-il un dispositif médical communicant (DMC) ou un objet connecté de santé',
                'telephone' => '0789765643',
                'Adresse_ip' => '192.168.43.1',
                'status' => 'connecté',
                'date' => '2022-05-21 11:15:17',
            ),
            2 => 
            array (
                'id' => 4,
                'reference' => 'DISPmF417',
            'details' => 'Un dispositif connecté qui mesure la fréquence cardiaque est-il un dispositif médical communicant (DMC) ou un objet connecté de santé',
                'telephone' => '0709874252',
                'Adresse_ip' => '192.164.43.1',
                'status' => 'deconnecter',
                'date' => '2022-05-21 11:15:11',
            ),
            3 => 
            array (
                'id' => 7,
                'reference' => 'DISPvq318',
            'details' => 'Un dispositif connecté qui mesure la fréquence cardiaque est-il un dispositif médical communicant (DMC) ou un objet connecté de santé',
                'telephone' => '0142255270',
                'Adresse_ip' => '192.423.423.3',
                'status' => 'deconnecter',
                'date' => '2022-05-21 11:15:08',
            ),
            4 => 
            array (
                'id' => 8,
                'reference' => 'DISPTT147',
            'details' => 'Un dispositif connecté qui mesure la fréquence cardiaque est-il un dispositif médical communicant (DMC) ou un objet connecté de santé',
                'telephone' => '0707103461',
                'Adresse_ip' => '192.164.132.1',
                'status' => 'deconnecter',
                'date' => '2022-05-21 11:15:00',
            ),
            5 => 
            array (
                'id' => 12,
                'reference' => 'DISPN5493',
                'details' => 'dispositif sinon',
                'telephone' => '4225527012',
                'Adresse_ip' => '192.423.423.8',
                'status' => 'Deconne',
                'date' => '2022-05-23 20:33:29',
            ),
        ));
        
        
    }
}