<?php

use App\Migration\PacsStakeholder;
use App\PacsStakeholder as AppPacsStakeholder;
use Illuminate\Database\Seeder;

class PacsStakeholderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stakeholders = PacsStakeholder::get();

        foreach ($stakeholders as $stakeholder) {
            AppPacsStakeholder::create([
                'pacs_installation_id' => $stakeholder->pacs_installation_id,
                'radiology_name' => $stakeholder->radiology_name,
                'phone_radiology' => $stakeholder->phone_radiology,
                'radiographer_name' => $stakeholder->radiographer_name,
                'it_hospital_name' => $stakeholder->it_hospital_name,
                'phone_it' => $stakeholder->phone_it,
                'email_it' => $stakeholder->email_it,
                'phone_radiographer' => $stakeholder->phone_radiographer,
                'email_radiographer' => $stakeholder->email_radiographer,
                'email_radiology' => $stakeholder->email_radiology,
                'user_note' => $stakeholder->user_note,
                'created_at' => $stakeholder->created_at,
                'updated_at' => $stakeholder->updated_at,
                'deleted_at' => $stakeholder->deleted_at,
            ]);
        }
    }
}
