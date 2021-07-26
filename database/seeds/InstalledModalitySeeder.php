<?php

use App\Migration\InstalledModality as MigrationInstalledModality;
use App\User;
use Illuminate\Database\Seeder;

class InstalledModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teknik_modality = MigrationInstalledModality::all();

        foreach ($teknik_modality as $modality) {
            $user = User::where('username', $modality->username)->first();

            if ($modality->fk_instalasi) {
                $modalityable_id = $modality->fk_instalasi;
                $modalityable_type = 'App\Installation';
            } else {
                $modalityable_id = $modality->fk_service;
                $modalityable_type = 'App\Service';
            }

            $user->installed_modalities()->create([
                'id' => $modality->pk_modality,
                'modalityable_id' => $modalityable_id,
                'modalityable_type' => $modalityable_type,
                'modality_id' => $modality->fk_mod,
                'name' => $modality->modality,
            ]);
        }
    }
}
