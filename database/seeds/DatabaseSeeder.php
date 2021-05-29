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
            CustomerOnlySeeder::class,
            VisitSeeder::class,
            ModalitySeeder::class,
            // OfferSeeder::class,
            SidebarSeeder::class,
            DepartmentSeeder::class,
            // OrderChartSeeder::class,
        ]);
    }
}
