<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(DispositifTableSeeder::class);
        $this->call(VulnerableTableSeeder::class);
        $this->call(AssignerTableSeeder::class);
        $this->call(ConstanteTableSeeder::class);
        $this->call(IncidentTableSeeder::class);
        $this->call(AffileeTableSeeder::class);
        $this->call(ProfilingTableSeeder::class);
        $this->call(ContactUrgenceTableSeeder::class);
        $this->call(SurveillerTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FicheMedicalesTableSeeder::class);
        $this->call(AlerteTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
    }
}
