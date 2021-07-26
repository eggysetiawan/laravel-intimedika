<?php

use App\Installation;
use App\Migration\Installation as MigrationInstallation;
use Illuminate\Database\Seeder;

class InstallationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $installations = MigrationInstallation::all();

        foreach ($installations as $installation) {
            Installation::create([
                'id' => $ins,
            ]);
        }
    }
}
