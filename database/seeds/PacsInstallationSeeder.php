<?php

use App\Migration\PacsInstallation;
use App\PacsInstallation as AppPacsInstallation;
use App\PacsStakeholder;
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
        $pacs_installations = PacsInstallation::with('stakeholder')->get();

        foreach ($pacs_installations as $installations) {
            AppPacsInstallation::create([
                'id' => $installations->id,
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

            PacsStakeholder::create([
                'pacs_installation_id' => $installations->stakeholder->pacs_installation_id,
                'radiology_name' => $installations->stakeholder->radiology_name,
                'phone_radiology' => $installations->stakeholder->phone_radiology,
                'radiographer_name' => $installations->stakeholder->radiographer_name,
                'it_hospital_name' => $installations->stakeholder->it_hospital_name,
                'phone_it' => $installations->stakeholder->phone_it,
                'email_it' => $installations->stakeholder->email_it,
                'phone_radiographer' => $installations->stakeholder->phone_radiographer,
                'email_radiographer' => $installations->stakeholder->email_radiographer,
                'email_radiology' => $installations->stakeholder->email_radiology,
                'user_note' => $installations->stakeholder->user_note,
                'created_at' => $installations->stakeholder->created_at,
                'updated_at' => $installations->stakeholder->updated_at,
                'deleted_at' => $installations->stakeholder->deleted_at,
            ]);
        }
    }
}
