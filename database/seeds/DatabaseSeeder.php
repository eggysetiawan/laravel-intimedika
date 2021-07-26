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
            CustomerSeeder::class,
            // CustomerOnlySeeder::class,
            VisitSeeder::class,
            ModalitySeeder::class,
            // OfferSeeder::class,
            SidebarSeeder::class,
            DepartmentSeeder::class,

            // sync databsae
            // InventoryTypeSeeder::class,
            // InventorySeeder::class,
            // DailyJobSeeder::class,
            // PacsInstallationSeeder::class,
            // PacsSupportSeeder::class,
            // PacsStakeholderSeeder::class,
            // PacsEngineerSeeder::class,
            // MediaSeeder::class,

            // ProductSeeder::class,
            // ModalityProductSeeder::class,
        ]);
    }
}
