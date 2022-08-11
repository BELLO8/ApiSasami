<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('notifications')->delete();
        
        \DB::table('notifications')->insert(array (
            0 => 
            array (
                'id' => 4,
                'user_id' => 10,
                'tel_token' => 'le TOKEN NULL',
                'created_at' => '2022-06-20 11:41:07',
                'updated_at' => '2022-06-20 11:41:07',
            ),
            1 => 
            array (
                'id' => 5,
                'user_id' => 3,
                'tel_token' => 'le TOKEN NULL',
                'created_at' => '2022-06-20 11:41:19',
                'updated_at' => '2022-06-20 11:41:19',
            ),
            2 => 
            array (
                'id' => 6,
                'user_id' => 4,
                'tel_token' => 'eQPw8hcETRW3y0ZsSTQKUe:APA91bGbk30lzMt0_yUFWgsZNulNWFk4bQTHXfVeM_W9QWbqA5jMfdkwpuc0UHgD9qrof-Ag855xVIHxXNmKCje19pUmaFUqBIOjkZtsysSvSV9H7pLhCldg3QAr0Z_f2xw5Rmk202fO',
                'created_at' => '2022-06-21 12:27:16',
                'updated_at' => '2022-07-11 16:06:09',
            ),
            3 => 
            array (
                'id' => 7,
                'user_id' => 23,
                'tel_token' => 'le TOKEN NULL',
                'created_at' => '2022-07-08 12:26:33',
                'updated_at' => '2022-07-08 12:26:33',
            ),
            4 => 
            array (
                'id' => 8,
                'user_id' => 2,
                'tel_token' => 'le TOKEN NULL',
                'created_at' => '2022-08-11 07:34:59',
                'updated_at' => '2022-08-11 07:34:59',
            ),
            5 => 
            array (
                'id' => 9,
                'user_id' => 20,
                'tel_token' => 'le TOKEN NULL',
                'created_at' => '2022-08-11 09:53:04',
                'updated_at' => '2022-08-11 09:53:04',
            ),
        ));
        
        
    }
}