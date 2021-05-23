<?php

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
        $this->call([
            UserSeeder::class,
            HospitalSeeder::class,
            // CustomerSeeder::class,
            // VisitSeeder::class,
            ModalitySeeder::class,
            SidebarSeeder::class,
            // OrderChartSeeder::class,
        ]);
    }
}
