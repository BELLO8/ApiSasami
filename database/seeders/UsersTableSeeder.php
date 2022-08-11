<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nom' => 'Kader',
                'telephone' => '0779151729',
                'role' => 'admin',
                'password' => 'Bfujging',
                'remember_token' => NULL,
                'created_at' => '2022-05-06 17:00:45',
                'updated_at' => '2022-05-23 15:58:34',
            ),
            1 => 
            array (
                'id' => 2,
                'nom' => 'Kader',
                'telephone' => '0779151722',
                'role' => 'admin',
                'password' => '$2y$10$/1LaVp1EskFgipqVfTZBOuZm6J81yDLWb5yGkXdRBSaljijMs9aPe',
                'remember_token' => NULL,
                'created_at' => '2022-05-06 18:10:50',
                'updated_at' => '2022-05-06 18:10:50',
            ),
            2 => 
            array (
                'id' => 3,
                'nom' => 'Kader',
                'telephone' => '0779151721',
                'role' => 'service_urgences',
                'password' => '$2y$10$KMX6dxFNtw2lm03.u1KoSOGkzWy/NHRELFn7LG7AkKqExRlWf3yVG',
                'remember_token' => NULL,
                'created_at' => '2022-05-06 18:19:19',
                'updated_at' => '2022-05-06 18:19:19',
            ),
            3 => 
            array (
                'id' => 4,
                'nom' => 'Kouame',
                'telephone' => '0585070020',
                'role' => 'vulnerable',
                'password' => '$2y$10$O87H9oIBvpGZ6kmD7iQwm.roIzGWz/F75GyUYMH95HcC7NbVPBrlG',
                'remember_token' => NULL,
                'created_at' => '2022-05-09 15:25:08',
                'updated_at' => '2022-05-09 15:25:08',
            ),
            4 => 
            array (
                'id' => 10,
                'nom' => 'coulibaly',
                'telephone' => '0142255270',
                'role' => 'admin',
                'password' => '$2y$10$YDr8nfaYuXwDMI0E8J1An.0/fVlGUytW3ufVs2S9ykaneMUmPXWxS',
                'remember_token' => NULL,
                'created_at' => '2022-05-10 17:09:34',
                'updated_at' => '2022-05-10 17:09:34',
            ),
            5 => 
            array (
                'id' => 17,
                'nom' => 'Kader',
                'telephone' => '0779151759',
                'role' => 'admin',
                'password' => '$2y$10$wMmTCmUReAQq1fH8KxAYAe7mKPdlp1odMEJqD0Srq9HcCJAg.hTTW',
                'remember_token' => NULL,
                'created_at' => '2022-05-23 15:35:51',
                'updated_at' => '2022-05-23 15:35:51',
            ),
            6 => 
            array (
                'id' => 18,
                'nom' => 'coulibaly',
                'telephone' => '0142255274',
                'role' => 'admin',
                'password' => '$2y$10$0gJE/0hMFRv9hdCiPGnlW.eB6OnpnWhDnZNppXpu0fEecz2hsPM4y',
                'remember_token' => NULL,
                'created_at' => '2022-05-23 15:47:56',
                'updated_at' => '2022-05-23 15:47:56',
            ),
            7 => 
            array (
                'id' => 19,
                'nom' => 'ouattara',
                'telephone' => '0709914074',
                'role' => 'admin',
                'password' => '$2y$10$5dZOGMQAe0zFC0eZRnxwQOtwT0l126h8qzgqfzC69Tur4wJmz1PYe',
                'remember_token' => NULL,
                'created_at' => '2022-05-23 15:54:16',
                'updated_at' => '2022-05-23 15:54:16',
            ),
            8 => 
            array (
                'id' => 20,
                'nom' => 'zanhle',
                'telephone' => '0779651724',
                'role' => 'service_urgences',
                'password' => '$2y$10$yPjof8EpuKTst32x8HlfBu/60QrX7aAlxDawKIMR7zDS9ABUPvIzi',
                'remember_token' => NULL,
                'created_at' => '2022-05-23 15:56:09',
                'updated_at' => '2022-05-23 15:56:09',
            ),
            9 => 
            array (
                'id' => 22,
                'nom' => 'Yasmine',
                'telephone' => '0707070801',
                'role' => 'affiliee',
                'password' => '$2y$10$f3UiKRNYzUcrNaQ3AenAE.5apPSkZMhidb5jxlu7hsSISRbznXYqy',
                'remember_token' => NULL,
                'created_at' => '2022-05-27 11:53:29',
                'updated_at' => '2022-05-27 11:53:29',
            ),
            10 => 
            array (
                'id' => 23,
                'nom' => 'Dramer',
                'telephone' => '0788765432',
                'role' => 'service_hopital',
                'password' => '$2y$10$yR6kJA5Y01I1I6W23QQI9e2maN8X7pnxSZ2pBKaxnrELZLX71I5x.',
                'remember_token' => NULL,
                'created_at' => '2022-06-02 15:36:19',
                'updated_at' => '2022-06-02 15:36:19',
            ),
        ));
        
        
    }
}