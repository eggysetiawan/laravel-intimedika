<?php

use App\User;
use App\Customer;
use App\Installation;
use App\InstalledModality;
use Illuminate\Database\Seeder;
use App\Migration\Installation as MigrationInstallation;

class InstallationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Note: Delete row 148,205,207 from teknik_instalasi

        $teknik_instalasi = MigrationInstallation::all();

        foreach ($teknik_instalasi as $installation) {


            if ($installation->sales) {
                $sales_ids = User::where('username', str_replace(['intiwid', 'intiwidteknik', 'intiwid02'], 'intiwid01', $installation->sales))->first();
                $sales_id = $sales_ids->id;
            } else {
                $sales_id = 2;
            }
            $user_ids = User::where('username', str_replace('intwidteknik', 'intiwid01', $installation->username))->first();
            $user_id = $user_ids->id;

            if (Customer::find($installation->fk_cust)) {
                $installations = Installation::create([
                    'id' => $installation->pk_instalasi,
                    'modality_id' => $installation->fk_mod,
                    'customer_id' => $installation->fk_cust,
                    'user_id' => $user_id,
                    'sn' => $installation->sn,
                    'date' => $installation->tgl_instalasi,
                    'is_installed' => $installation->instalasi,
                    'is_tested' => $installation->uji_fungsi,
                    'is_trained' => $installation->training,
                    'note' => $installation->keterangan_instalasi,
                    'pre_installation_note' => $installation->prainstalasi,
                    'reference' => $installation->referensi,
                    'sales_id' => $sales_id,
                    'created_at' => $installation->created_at,
                ]);

                if ($installation->fk_sw) {
                    $installations->softwares()->attach($installation->fk_sw);
                }

                if ($installation->fk_modality && InstalledModality::find($installation->fk_modality)) {
                    $installations->installed_mods()->attach($installation->fk_modality);
                }
            }
        }
    }
}
