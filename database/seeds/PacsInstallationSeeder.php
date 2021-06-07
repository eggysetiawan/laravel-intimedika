<?php

use App\Migration\PacsInstallation;
use App\PacsInstallation as AppPacsInstallation;
use Illuminate\Database\Seeder;

class PacsInstallationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pacs_installations = PacsInstallation::get();

        foreach ($pacs_installations as $installations) {
            AppPacsInstallation::create([
                'slug' => $installations->slug,
                'hospital_id' => $installations->hospital_id,
                'user_id' => $installations->user_id,
                'anydesk_server' => $installations->anydesk_server,
                'anydesk_workstation' => $installations->anydesk_workstation,
                'handover_date' => $installations->handover_date,
                'start_installation_date' => $installations->start_installation_date,
                'finish_installation_date' => $installations->finish_installation_date,
                'training_date' => $installations->training_date,
                'warranty_start' => $installations->warranty_start,
                'warranty_end' => $installations->warranty_end,
                'created_at' => $installations->created_at,
                'updated_at' => $installations->updated_at,
                'deleted_at' => $installations->deleted_at,
            ]);
        }
    }
}
